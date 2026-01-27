<?php

declare(strict_types=1);

namespace App\Modules\Documents;

use TCPDF;

class PdfService
{
    public function generateReceipt(string $content, string $signature, string $csv): string
    {
        // Crear instancia TCPDF
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        // Metadatos
        $pdf->SetCreator('Antigravity POC');
        $pdf->SetAuthor('Sistema de Certificación');
        $pdf->SetTitle('Justificante de Firma');

        // Sin cabeceras default
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Pagina
        $pdf->AddPage();

        // Contenido HTML
        $html = <<<EOD
        <h1>Justificante de Firma Electrónica</h1>
        <hr>
        <p><strong>Código Seguro de Verificación (CSV):</strong> $csv</p>
        <p><strong>Fecha:</strong>_DATE_</p>
        <br>
        <h3>Contenido Firmado:</h3>
        <pre>$content</pre>
        <br>
        <h3>Firma Digital (Extracto):</h3>
        <pre>_SIGNATURE_</pre>
        EOD;

        $html = str_replace('_DATE_', date('d/m/Y H:i:s'), $html);
        $html = str_replace('_SIGNATURE_', substr($signature, 0, 100) . '...', $html);

        $pdf->writeHTML($html, true, false, true, false, '');

        // Generar archivo en memoria (string)
        return $pdf->Output('justificante.pdf', 'S');
    }
}
