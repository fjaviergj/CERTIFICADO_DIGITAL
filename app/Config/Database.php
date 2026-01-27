<?php

declare(strict_types=1);

namespace App\Config;

class Database
{
    private const DB_HOST = 'localhost';
    private const DB_NAME = 'certificado_digital';
    private const DB_USER = 'root';
    private const DB_PASS = ''; // Ajustar según entorno local
    private const DB_CHARSET = 'utf8mb4';

    public static function getConnection(): \PDO
    {
        $dsn = sprintf(
            'mysql:host=%s;dbname=%s;charset=%s',
            self::DB_HOST,
            self::DB_NAME,
            self::DB_CHARSET
        );

        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            return new \PDO($dsn, self::DB_USER, self::DB_PASS, $options);
        } catch (\PDOException $e) {
            // En producción, loguear error y mostrar mensaje genérico.
            // Para desarrollo, lanzamos la excepción.
            throw new \RuntimeException('Error de conexión a la base de datos: ' . $e->getMessage());
        }
    }
}
