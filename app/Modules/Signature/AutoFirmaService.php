<?php

declare(strict_types=1);

namespace App\Modules\Signature;

use App\Config\App;

class AutoFirmaService
{
    /**
     * Prepara el documento para ser firmado.
     * En este POC, convertimos un texto simple a Base64.
     * En real, esto generaría el hash o el XML completo.
     */
    public function prepareDocument(string $content): string
    {
        // Para AutoFirma en modo básico, solemos enviar el contenido en Base64.
        return base64_encode($content);
    }

    /**
     * Valida una firma electrónica (PKCS#7 / CAdES).
     * @param string $signatureB64 Firma en Base64 devuelta por AutoFirma.
     * @param string $originalData Datos originales que fueron firmados.
     * @return bool
     */
    public function validateSignature(string $signatureB64, string $originalData): bool
    {
        if (empty($signatureB64)) {
            return false;
        }

        try {
            // 1. Decodificar la firma
            $signatureDer = base64_decode($signatureB64, true);
            if ($signatureDer === false) {
                return false;
            }

            // 2. Crear archivos temporales para la validación (OpenSSL requiere archivos)
            $tmpFileSig = tempnam(sys_get_temp_dir(), 'sig_');
            $tmpFileData = tempnam(sys_get_temp_dir(), 'dat_');

            file_put_contents($tmpFileSig, $signatureDer);
            file_put_contents($tmpFileData, $originalData);

            // 3. Ruta de los certificados CA (FNMT) para validar la cadena de confianza
            $caPath = App::ROOT_DIR . 'config/certs/fnmt_bundle.pem';

            if (!file_exists($caPath)) {
                // Si no hay certificado CA, solo podemos verificar la integridad, no la confianza.
                // Usamos PKCS7_NOVERIFY para saltar la validación de la CA en desarrollo si falta el archivo.
                $flags = PKCS7_NOVERIFY | PKCS7_BINARY;
            } else {
                $flags = PKCS7_BINARY;
            }

            // 4. Validar
            // Nota: openssl_pkcs7_verify retorna 1 si OK, -1 error, 0 fallo firma
            $result = openssl_pkcs7_verify($tmpFileSig, $flags, null, [$caPath], $caPath, $tmpFileData);

            // Limpieza
            @unlink($tmpFileSig);
            @unlink($tmpFileData);

            return $result === 1;

        } catch (\Throwable $e) {
            error_log("Error en validación de firma: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Genera un identificador único (CSV - Código Seguro de Verificación)
     */
    public function generateCSV(): string
    {
        return strtoupper(bin2hex(random_bytes(8))); // 16 caracteres hex
    }
}
