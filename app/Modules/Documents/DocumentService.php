<?php

declare(strict_types=1);

namespace App\Modules\Documents;

use App\Config\Database;
use PDO;

class DocumentService
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * Guarda un documento firmado en la base de datos.
     */
    public function saveSignedDocument(
        int $usuarioId,
        string $tipoTramite,
        string $contenidoXml,
        string $firmaB64,
        string $csv
    ): int {
        $stmt = $this->db->prepare("
            INSERT INTO documentos (
                usuario_id, 
                tipo_tramite, 
                contenido_xml, 
                firma_electronica, 
                hash_firma, 
                csv, 
                estado, 
                fecha_creacion, 
                fecha_firma
            ) VALUES (
                :usuario_id, 
                :tipo, 
                :contenido, 
                :firma, 
                :hash, 
                :csv, 
                'FIRMADO', 
                NOW(), 
                NOW()
            )
        ");

        $hashFirma = hash('sha256', $firmaB64);

        $stmt->execute([
            ':usuario_id' => $usuarioId,
            ':tipo' => $tipoTramite,
            ':contenido' => $contenidoXml,
            ':firma' => $firmaB64,
            ':hash' => $hashFirma,
            ':csv' => $csv
        ]);

        return (int) $this->db->lastInsertId();
    }
}
