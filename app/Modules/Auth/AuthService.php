<?php

declare(strict_types=1);

namespace App\Modules\Auth;

use App\Config\Database;
use App\Modules\Auth\DTO\UserDto;
use PDO;

class AuthService
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * Busca un usuario por su número de serie de certificado.
     * Si no existe, lo crea.
     */
    public function findOrCreateUser(string $serialNumber, string $commonName, string $dniNie): UserDto
    {
        // 1. Buscar usuario existente
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE serial_number = :serial LIMIT 1");
        $stmt->execute([':serial' => $serialNumber]);
        $user = $stmt->fetch();

        if ($user) {
            // Actualizar último acceso
            $update = $this->db->prepare("UPDATE usuarios SET ultimo_acceso = NOW() WHERE id = :id");
            $update->execute([':id' => $user['id']]);

            return UserDto::fromArray($user);
        }

        // 2. Crear nuevo usuario si no existe
        $insert = $this->db->prepare("
            INSERT INTO usuarios (serial_number, dni_nie, nombre_completo, fecha_registro, ultimo_acceso) 
            VALUES (:serial, :dni, :nombre, NOW(), NOW())
        ");

        $insert->execute([
            ':serial' => $serialNumber,
            ':dni' => $dniNie,
            ':nombre' => $commonName
        ]);

        $newId = (int) $this->db->lastInsertId();

        return new UserDto(
            id: $newId,
            serialNumber: $serialNumber,
            dniNie: $dniNie,
            nombreCompleto: $commonName
        );
    }
}
