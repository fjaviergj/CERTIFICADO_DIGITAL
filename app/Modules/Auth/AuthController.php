<?php

declare(strict_types=1);

namespace App\Modules\Auth;

use App\Core\View;
use App\Config\App;

class AuthController
{
    public function index(): void
    {
        // Si ya está logueado, redirigir a dashboard
        if (session_status() === PHP_SESSION_NONE)
            session_start();

        if (isset($_SESSION['user_id'])) {
            header('Location: /dashboard');
            exit;
        }

        View::render('@Auth/login', [
            'title' => 'Acceso con Certificado Digital'
        ]);
    }

    public function loginWithCertificate(): void
    {
        // 1. Verificar si el servidor nos pasó datos del certificado
        // En Apache SSLOptions +StdEnvVars +ExportCertData
        $sslClientVerify = $_SERVER['SSL_CLIENT_VERIFY'] ?? '';

        if ($sslClientVerify !== 'SUCCESS') {
            View::render('@Auth/error', [
                'error' => 'No se ha detectado un certificado válido. Por favor, asegúrese de tener su certificado instalado y seleccione el correcto.',
                'details' => "SSL_CLIENT_VERIFY: $sslClientVerify"
            ]);
            return;
        }

        // 2. Obtener datos del certificado
        $certData = $_SERVER['SSL_CLIENT_CERT'] ?? null;
        if (!$certData) {
            View::render('@Auth/error', [
                'error' => 'El servidor validó el certificado pero no pudo leer los datos del mismo.',
            ]);
            return;
        }

        // 3. Procesar certificado
        try {
            $parsedCert = openssl_x509_parse($certData);
            if (!$parsedCert) {
                throw new \RuntimeException('Error al parsear el certificado X.509');
            }

            // Extraer Serial Number del certificado (Hexadecimal)
            $serialNumber = (string) ($parsedCert['serialNumberHex'] ?? $parsedCert['serialNumber']);
            $subject = $parsedCert['subject'];

            // Lógica para extraer DNI/NIE
            $dniNie = $this->extractDni($subject);
            $nombreCompleto = $subject['CN'] ?? 'Desconocido';

            // Llamar al AuthService para buscar o crear usuario
            $authService = new AuthService();
            $user = $authService->findOrCreateUser($serialNumber, $nombreCompleto, $dniNie);

            // Iniciar sesión
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_name'] = $user->nombreCompleto;
            $_SESSION['dni_nie'] = $user->dniNie;
            $_SESSION['cert_serial'] = $user->serialNumber;

            header('Location: /dashboard');
            exit;

        } catch (\Throwable $e) {
            View::render('@Auth/error', [
                'error' => 'Error procesando los datos del certificado.',
                'details' => $e->getMessage()
            ]);
        }
    }

    /**
     * Extrae el DNI/NIE de los datos del subject del certificado.
     */
    private function extractDni(array $subject): string
    {
        // En certificados FNMT de Persona Física, el DNI suele estar en 'serialNumber' dentro del subject
        // Ojo: no confundir con el serialNumber del certificado completo.
        if (isset($subject['serialNumber'])) {
            // A veces viene con prefijo IDCES- o similar
            return preg_replace('/[^a-zA-Z0-9]/', '', $subject['serialNumber']);
        }

        // Si no, intentar buscarlo en el Common Name (CN) con una regex
        $cn = $subject['CN'] ?? '';
        if (preg_match('/(\d{8}[A-Z]|[XYZ]\d{7}[A-Z])/i', $cn, $matches)) {
            return $matches[0];
        }

        return 'DESC-0000';
    }

    public function register(): void
    {
        header('Location: /');
        exit;
    }

    public function dashboard(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            header('Location: /');
            exit;
        }

        View::render('@Auth/dashboard', [
            'userName' => $_SESSION['user_name'] ?? 'Usuario',
            'dniNie' => $_SESSION['dni_nie'] ?? 'N/A',
            'certSerial' => $_SESSION['cert_serial'] ?? 'N/A'
        ]);
    }
}
