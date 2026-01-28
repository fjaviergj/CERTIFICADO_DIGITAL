<?php

declare(strict_types=1);

namespace App\Config;

class App
{
    public const APP_NAME = 'Certificado Digital POC';
    public const ENV = 'development'; // 'production' or 'development'

    // Rutas del sistema
    public const ROOT_DIR = __DIR__ . '/../../';
    public const VIEW_DIR = self::ROOT_DIR . 'app/Modules/'; // Vistas modulares por defecto
    public const LOG_DIR = self::ROOT_DIR . 'logs/';

    /**
     * Obtiene la URL base de la aplicación de forma dinámica.
     */
    public static function getAppUrl(): string
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        return $protocol . "://" . $host;
    }

    public static function isDebug(): bool
    {
        // @phpstan-ignore-next-line
        return self::ENV === 'development';
    }
}
