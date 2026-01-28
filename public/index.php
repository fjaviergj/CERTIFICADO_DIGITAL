<?php

declare(strict_types=1);

use App\Config\App;
use App\Core\View;

// Cargar autoloader de Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Configuración de registro de errores centralizado
ini_set('log_errors', '1');
ini_set('error_log', __DIR__ . '/../error_log.txt');

// Manejo de errores básico para desarrollo
if (App::isDebug()) {
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', '0');
    error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
}

// Router muy básico (MVP)
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Normalizar URI (eliminar query params y slash final si existe, excepto raiz)
$path = rtrim($requestUri, '/');
if (empty($path)) {
    $path = '/';
}

// Rutas
try {
    switch ($path) {
        case '/':
            // Home / Login
            (new \App\Modules\Auth\AuthController())->index();
            break;

        case '/auth/login-cert':
            // Login con certificado
            (new \App\Modules\Auth\AuthController())->loginWithCertificate();
            break;

        case '/auth/register':
            // Formulario registro (si aplica, o automatico)
            (new \App\Modules\Auth\AuthController())->register();
            break;

        case '/auth/logout':
            // Cerrar sesión
            (new \App\Modules\Auth\AuthController())->logout();
            break;

        case '/dashboard':
            // Panel principal usuario logueado
            // Middleware check session aqui
            (new \App\Modules\Auth\AuthController())->dashboard();
            break;

        case '/signature/test':
            // Pantalla prueba firma
            (new \App\Modules\Signature\SignatureController())->index();
            break;

        case '/signature/process':
            // Proceso de firma (POST)
            if ($requestMethod === 'POST') {
                (new \App\Modules\Signature\SignatureController())->process();
            } else {
                View::render('errors/405', ['msg' => 'Method not allowed']);
            }
            break;

        case '/signature/success':
            (new \App\Modules\Signature\SignatureController())->success();
            break;

        case '/documents/list':
            (new \App\Modules\Signature\SignatureController())->list();
            break;

        case '/verify':
            // Verificación de CSV
            (new \App\Modules\Documents\DocumentsController())->verify();
            break;

        case '/verify/download':
            // Descarga desde verificación
            (new \App\Modules\Documents\DocumentsController())->downloadOriginal();
            break;

        default:
            http_response_code(404);
            echo "<h1>404 Not Found</h1>";
            break;
    }
} catch (\Throwable $e) {
    // Registrar error en el log
    error_log((string) $e);

    http_response_code(500);
    if (App::isDebug()) {
        echo "<h1>Error del Servidor</h1>";
        echo "<pre>" . htmlspecialchars((string) $e) . "</pre>";
    } else {
        echo "<h1>Error Interno</h1>";
    }
}
