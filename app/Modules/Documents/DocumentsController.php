<?php

declare(strict_types=1);

namespace App\Modules\Documents;

use App\Core\View;
use App\Config\Database;

class DocumentsController
{
    /**
     * Página de verificación de CSV.
     */
    public function verify(): void
    {
        $csv = $_GET['csv'] ?? '';
        $documento = null;
        $error = null;

        if (!empty($csv)) {
            $db = Database::getConnection();
            $stmt = $db->prepare("SELECT * FROM documentos WHERE csv = :csv LIMIT 1");
            $stmt->execute([':csv' => $csv]);
            $documento = $stmt->fetch();

            if (!$documento) {
                $error = "No se ha encontrado ningún documento con el CSV proporcionado.";
            }
        }

        View::render('@Documents/verify', [
            'documento' => $documento,
            'error' => $error,
            'csv' => $csv
        ]);
    }

    /**
     * Descargar el PDF original desde la verificación usando CSV.
     */
    public function downloadOriginal(): void
    {
        $csv = $_GET['csv'] ?? '';
        if (empty($csv)) {
            die("CSV no proporcionado");
        }

        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM documentos WHERE csv = :csv LIMIT 1");
        $stmt->execute([':csv' => $csv]);
        $doc = $stmt->fetch();

        if (!$doc) {
            die("Documento no encontrado o CSV inválido");
        }

        // Regenerar el justificante para descarga
        $pdfService = new PdfService();
        $pdfContent = $pdfService->generateReceipt(
            $doc['contenido_xml'],
            $doc['firma_electronica'],
            $doc['csv']
        );

        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="justificante_' . $doc['csv'] . '.pdf"');
        echo $pdfContent;
        exit;
    }
}
