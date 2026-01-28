<?php

declare(strict_types=1);

namespace App\Core\Pdf;

use App\Config\App;
use TCPDF;

/**
 * Clase encargada de la generación de documentos PDF con estándares de la Administración Pública.
 */
class PdfManager
{
    /**
     * Genera un PDF "Copia Auténtica" a partir de los datos originales, firma y CSV.
     * 
     * @param string $originalData JSON con los datos del trámite.
     * @param string $signatureB64 Firma electrónica en Base64.
     * @param string $csv Código Seguro de Verificación.
     * @return string Contenido binario del PDF.
     */
    public function generateAuthenticCopy(string $originalData, string $signatureB64, string $csv): string
    {
        $data = json_decode($originalData, true);
        $metadata = $data['metadata'] ?? [];
        $request = $data['request'] ?? [];

        // Crear instancia de TCPDF
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Configuración del documento
        $pdf->SetCreator(App::APP_NAME);
        $pdf->SetAuthor($metadata['user_name'] ?? 'Usuario');
        $pdf->SetTitle('Copia Auténtica - ' . $csv);
        $pdf->SetSubject('Justificante de Firma Electrónica');

        // Eliminar cabeceras y pies por defecto
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Establecer márgenes
        $pdf->SetMargins(15, 20, 15);
        $pdf->SetAutoPageBreak(TRUE, 25);

        // Añadir página
        $pdf->AddPage();

        // --- CABECERA ---
        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->Cell(0, 10, 'COMPROBANTE DE REGISTRO ELECTRÓNICO', 0, 1, 'C');
        $pdf->Ln(2);

        $pdf->SetFont('helvetica', '', 9);
        $pdf->SetTextColor(100, 100, 100);
        $pdf->Cell(0, 5, 'Este documento es un comprobante de la firma electrónica realizada en nuestra plataforma.', 0, 1, 'C');
        $pdf->Ln(5);

        // --- DATOS DEL TRÁMITE ---
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(0, 10, 'DATOS DE LA SOLICITUD', 'B', 1, 'L');
        $pdf->Ln(5);

        $this->addRow($pdf, 'Asunto:', $request['subject'] ?? 'Sin asunto');
        $this->addRow($pdf, 'Tipo de Trámite:', $metadata['type'] ?? 'GENERIC');
        $this->addRow($pdf, 'Fecha de Solicitud:', $metadata['created_at'] ?? date('Y-m-d H:i:s'));
        $this->addRow($pdf, 'Firmante:', ($metadata['user_name'] ?? 'Usuario') . ' (' . ($metadata['user_dni'] ?? 'N/A') . ')');

        $pdf->Ln(10);

        $pdf->SetFont('helvetica', 'B', 11);
        $pdf->Cell(0, 10, 'CONTENIDO / MENSAJE', 0, 1, 'L');
        $pdf->SetFont('helvetica', '', 10);
        $pdf->MultiCell(0, 10, $request['content'] ?? 'Sin contenido', 1, 'L', false, 1);

        $pdf->Ln(15);

        // --- INFORMACIÓN LEGAL Y FIRMA ---
        $pdf->SetFont('helvetica', 'I', 8);
        $pdf->SetTextColor(80, 80, 80);
        $html = "
            <p><b>Información de Firma:</b><br>
            Este documento ha sido generado tras un proceso de firma electrónica certificada. 
            La autenticidad de esta copia puede ser verificada mediante el CSV (Código Seguro de Verificación) indicado a continuación.</p>
        ";
        $pdf->writeHTML($html, true, false, true, false, '');

        // --- ESTAMPADO DE CSV Y QR (PIE DE PÁGINA ESPECIAL) ---
        $this->renderStamping($pdf, $csv);

        // Devolver el PDF como string binario
        return $pdf->Output('', 'S');
    }

    /**
     * Añade una fila de datos al PDF.
     */
    private function addRow(TCPDF $pdf, string $label, string $value): void
    {
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->Cell(60, 7, $label, 0, 0, 'L');
        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(0, 7, $value, 0, 1, 'L');
    }

    /**
     * Renderiza el recuadro de validación con CSV y QR.
     */
    private function renderStamping(TCPDF $pdf, string $csv): void
    {
        // 1. Guardar estado de auto-page-break y desactivarlo temporalmente
        $autoPageBreak = $pdf->getAutoPageBreak();
        $pdf->SetAutoPageBreak(false);

        $verifyUrl = App::getAppUrl() . '/verify?csv=' . $csv;

        // Estilo para el QR (Mejorado para lectura móvil)
        $style = [
            'border' => false,
            'padding' => 1, // Margen de seguridad (Quiet Zone)
            'fgcolor' => [0, 0, 0],
            'bgcolor' => [255, 255, 255], // Fondo blanco para máximo contraste
            'module_width' => 1,
            'module_height' => 1
        ];

        // 2. Posicionar al final de la página actual
        $y = $pdf->GetPageHeight() - 40;

        // Dibujar borde del recuadro de validación
        $pdf->SetLineStyle(['width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => [150, 150, 150]]);
        $pdf->SetFillColor(245, 245, 245);
        $pdf->RoundedRect(15, $y, $pdf->GetPageWidth() - 30, 25, 2, '1111', 'DF');

        // Código QR - Nivel de corrección 'M' (Medium) para mayor robustez
        $pdf->write2DBarcode($verifyUrl, 'QRCODE,M', 20, $y + 2.5, 20, 20, $style, 'N');

        // Texto de validación (usando SetXY para forzar posición absoluta)
        $pdf->SetXY(45, $y + 5);
        $pdf->SetFont('helvetica', 'B', 9);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(0, 5, 'CÓDIGO SEGURO DE VERIFICACIÓN (CSV)', 0, 0, 'L');

        $pdf->SetXY(45, $y + 10);
        $pdf->SetFont('courier', 'B', 11);
        $pdf->Cell(0, 5, $csv, 0, 0, 'L');

        $pdf->SetXY(45, $y + 16);
        $pdf->SetFont('helvetica', '', 7);
        $pdf->SetTextColor(37, 99, 235); // Azul enlace
        $pdf->Cell(0, 5, 'Verificable en: ' . $verifyUrl, 0, 0, 'L', false, $verifyUrl);

        // 3. Restaurar estado de auto-page-break
        $pdf->SetAutoPageBreak($autoPageBreak, 25);
    }
}
