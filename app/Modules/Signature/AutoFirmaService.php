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
            error_log("[AutoFirma] Firma vacía recibida");
            return false;
        }

        $logFile = App::ROOT_DIR . 'signature_debug.log';
        if (!is_dir(dirname($logFile)))
            mkdir(dirname($logFile), 0777, true);

        $log = function ($msg) use ($logFile) {
            file_put_contents($logFile, "[" . date('Y-m-d H:i:s') . "] " . $msg . "\n", FILE_APPEND);
        };

        $log("--- Iniciando validación de firma (CMS/DER) ---");

        try {
            // 1. Decodificar la firma de Base64 (obtenemos el binario DER)
            $signatureDer = base64_decode($signatureB64, true);
            if ($signatureDer === false) {
                $log("Error: No se pudo decodificar Base64 de la firma");
                return false;
            }

            // 2. Crear archivos temporales
            $tmpFileSig = tempnam(sys_get_temp_dir(), 'sig_');
            $tmpFileData = tempnam(sys_get_temp_dir(), 'dat_');

            // Escribimos el binario directamente (formato DER)
            file_put_contents($tmpFileSig, $signatureDer);
            file_put_contents($tmpFileData, $originalData);

            // 3. Ruta del bundle de CAs (usamos realpath para evitar problemas en Windows)
            $caPath = realpath(App::ROOT_DIR . 'config/certs/fnmt_bundle.pem');
            $certFiles = ($caPath && file_exists($caPath)) ? [$caPath] : [];

            $log("Bundle CA: " . ($caPath ? "Cargado ($caPath)" : "NO encontrado"));

            // Flags:
            // OPENSSL_CMS_BINARY: Tratar datos como binarios
            // OPENSSL_CMS_NOSIGS: No verificar la firma (solo para pruebas extremas, no usar)
            $flags = OPENSSL_CMS_BINARY;
            if (empty($certFiles)) {
                $flags |= OPENSSL_CMS_NOVERIFY;
                $log("Aviso: Usando NOVERIFY por falta de bundle");
            }

            // 4. Validar firma usando CMS (superior a PKCS7 para CAdES)
            // IMPORTANTE: Al ser mode=implicit, los datos YA ESTÁN dentro de la firma.
            // Primero intentamos validar SIN pasar el archivo de datos (Attached)
            // Si falla, reintentamos pasando los datos originales por si acaso fuera Detached.

            $result = openssl_cms_verify(
                $tmpFileSig,
                $flags,
                null,
                $certFiles,
                $caPath ?: null,
                null, // Los datos están dentro si es mode=implicit
                null,
                null,
                OPENSSL_ENCODING_DER
            );

            // Si falla sin datos, probamos con datos externos (por si acaso o para integridad)
            if (!$result) {
                $log("Fallo inicial (Attached), reintentando con datos externos (Detached)...");
                $result = openssl_cms_verify(
                    $tmpFileSig,
                    $flags,
                    null,
                    $certFiles,
                    $caPath ?: null,
                    $tmpFileData,
                    null,
                    null,
                    OPENSSL_ENCODING_DER
                );
            }

            $log("Resultado openssl_cms_verify FINAL: " . ($result ? "VERDADERO" : "FALSO"));

            if (!$result) {
                while ($msg = openssl_error_string()) {
                    $log("OpenSSL Error: " . $msg);
                }

                // Fallback de desarrollo: intentar validar solo integridad (sin cadena de confianza)
                $log("Intentando validación solo de integridad (NOVERIFY)...");
                $resultIntegrity = openssl_cms_verify(
                    $tmpFileSig,
                    OPENSSL_CMS_NOVERIFY | OPENSSL_CMS_BINARY,
                    null,
                    [],
                    null,
                    $tmpFileData,
                    null,
                    null,
                    OPENSSL_ENCODING_DER
                );

                $log("Resultado integridad: " . ($resultIntegrity ? "VERDADERO" : "FALSO"));

                if ($resultIntegrity && App::isDebug()) {
                    $log("ACEPTANDO firma por integridad en modo debug.");
                    $result = true;
                }
            }

            // Limpieza
            @unlink($tmpFileSig);
            @unlink($tmpFileData);

            $log("Finalizado: " . ($result ? "ÉXITO" : "FALLO"));
            return $result;

        } catch (\Throwable $e) {
            $log("Excepción crítica: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Genera un identificador único (CSV - Código Seguro de Verificación)
     */
    public function generateCSV(): string
    {
        $bytes = random_bytes(8); // 64 bits de entropía
        $hex = strtoupper(bin2hex($bytes));
        // Formato: XXXX-XXXX-XXXX-XXXX
        return substr($hex, 0, 4) . '-' . substr($hex, 4, 4) . '-' . substr($hex, 8, 4) . '-' . substr($hex, 12, 4);
    }
}
