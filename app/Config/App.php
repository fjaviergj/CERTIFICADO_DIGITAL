<?php

declare(strict_types=1);

namespace App\Config;

class App
{
    public const APP_NAME = 'Certificado Digital POC';
    public const APP_URL = 'https://certificado.local'; // Debe coincidir con VirtualHost
    public const ENV = 'development'; // 'production' or 'development'

    // Rutas del sistema
    public const ROOT_DIR = __DIR__ . '/../../';
    public const VIEW_DIR = self::ROOT_DIR . 'app/Modules/'; // Vistas modulares por defecto
    public const LOG_DIR = self::ROOT_DIR . 'logs/';

    public static function isDebug(): bool
    {
        // @phpstan-ignore-next-line
        return self::ENV === 'development';
    }
}
