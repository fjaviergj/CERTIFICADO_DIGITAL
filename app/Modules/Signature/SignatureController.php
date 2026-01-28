<?php

declare(strict_types=1);

namespace App\Modules\Signature;

use App\Core\View;

class SignatureController
{
    /**
     * Paso 1: Mostrar formulario de solicitud
     */
    public function index(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            header('Location: /');
            exit;
        }

        View::render('@Signature/create_request', [
            'title' => 'Nueva Solicitud'
        ]);
    }

    /**
     * Paso 2: Procesar datos del formulario y preparar para firma
     */
    public function prepare(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /signature/request');
            exit;
        }

        $requestType = $_POST['request_type'] ?? 'GENERIC';
        $subject = $_POST['subject'] ?? '';
        $content = $_POST['content'] ?? '';

        if (empty($subject) || empty($content)) {
            View::render('@Auth/error', ['error' => 'El asunto y el contenido son obligatorios.']);
            return;
        }

        // Estructura de "Documento Original" (JSON para máxima eficiencia)
        $docData = [
            'metadata' => [
                'type' => $requestType,
                'created_at' => date('Y-m-d H:i:s'),
                'user_id' => $_SESSION['user_id'],
                'user_name' => $_SESSION['user_name'] ?? 'Usuario',
                'user_dni' => $_SESSION['user_dni'] ?? ''
            ],
            'request' => [
                'subject' => $subject,
                'content' => $content
            ]
        ];

        $docContent = (string) json_encode($docData, JSON_UNESCAPED_UNICODE);

        // Guardar en sesión para el siguiente paso
        $_SESSION['doc_to_sign'] = $docContent;
        $_SESSION['request_type'] = $requestType;

        header('Location: /signature/sign');
        exit;
    }

    /**
     * Paso 3: Mostrar pantalla de firma con el contenido preparado
     */
    public function sign(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $docContent = $_SESSION['doc_to_sign'] ?? null;
        if (!$docContent) {
            header('Location: /signature/request');
            exit;
        }

        $service = new AutoFirmaService();
        $dataToSignB64 = $service->prepareDocument($docContent);

        View::render('@Signature/test', [
            'dataToSign' => $dataToSignB64,
            'title' => 'Firme su Solicitud',
            'certSerial' => $_SESSION['cert_serial'] ?? ''
        ]);
    }

    public function process(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Obtener la firma del POST
        $signature = $_POST['signature'] ?? '';
        $usuarioId = $_SESSION['user_id'] ?? null;

        if (empty($signature) || !$usuarioId) {
            View::render('@Auth/error', [
                'error' => 'No se recibió ninguna firma o la sesión ha expirado.'
            ]);
            return;
        }

        $service = new AutoFirmaService();
        $originalDoc = $_SESSION['doc_to_sign'] ?? '';

        if ($service->validateSignature($signature, $originalDoc)) {
            // 1. Generar CSV
            $csv = $service->generateCSV();

            // 2. Guardar en Base de Datos
            $docService = new \App\Modules\Documents\DocumentService();
            $docService->saveSignedDocument(
                (int) $usuarioId,
                $_SESSION['request_type'] ?? 'GENERIC',
                $originalDoc,
                $signature,
                $csv
            );

            // 3. Generar PDF
            $pdfService = new \App\Modules\Documents\PdfService();
            $pdfContent = $pdfService->generateReceipt($originalDoc, $signature, $csv);

            // 4. Forzar descarga del PDF
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="justificante_' . $csv . '.pdf"');
            echo $pdfContent;

            // Limpiar sesión temporal
            unset($_SESSION['doc_to_sign']);
            exit;
        } else {
            View::render('@Auth/error', ['error' => 'La firma electrónica no es válida.']);
        }
    }

    public function success(): void
    {
        View::render('@Signature/success', [
            'title' => 'Trámite Completado'
        ]);
    }

    public function list(): void
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
        $usuarioId = $_SESSION['user_id'] ?? null;

        if (!$usuarioId) {
            header('Location: /');
            exit;
        }

        $db = \App\Config\Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM documentos WHERE usuario_id = :uid ORDER BY fecha_creacion DESC");
        $stmt->execute([':uid' => $usuarioId]);
        $documentos = $stmt->fetchAll();

        View::render('@Documents/list', [
            'documentos' => $documentos,
            'title' => 'Mis Documentos'
        ]);
    }
}
