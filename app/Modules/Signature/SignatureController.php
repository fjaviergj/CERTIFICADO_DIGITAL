<?php

declare(strict_types=1);

namespace App\Modules\Signature;

use App\Core\View;

class SignatureController
{
    public function index(): void
    {
        // Verificar sesión
        if (session_status() === PHP_SESSION_NONE)
            session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /');
            exit;
        }

        // Simular un documento a firmar (XML)
        $docContent = "<?xml version='1.0'?><tramite><id>123</id><usuario>{$_SESSION['user_id']}</usuario><fecha>" . date('Y-m-d H:i:s') . "</fecha></tramite>";

        // Guardar en sesión temporalmente para verificar luego
        $_SESSION['doc_to_sign'] = $docContent;

        // Preparar para la vista
        $service = new AutoFirmaService();
        $dataToSignB64 = $service->prepareDocument($docContent);

        View::render('@Signature/test', [
            'dataToSign' => $dataToSignB64,
            'title' => 'Firma de Documento',
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
                'POC_TRAMITE',
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
}
