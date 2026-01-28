<?php

declare(strict_types=1);

namespace App\Modules\Documents;

use App\Core\Pdf\PdfManager;

class PdfService
{
    /**
     * Genera el justificante (Copia Auténtica) usando el PdfManager core.
     */
    public function generateReceipt(string $content, string $signature, string $csv): string
    {
        $manager = new PdfManager();
        return $manager->generateAuthenticCopy($content, $signature, $csv);
    }
}
