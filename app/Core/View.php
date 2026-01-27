<?php

declare(strict_types=1);

namespace App\Core;

use App\Config\App;

class View
{
    /**
     * Renderiza una vista/plantilla.
     * 
     * @param string $viewPath Ruta relativa desde app/templates/ o app/Modules/
     * @param array $data Datos a pasar a la vista
     */
    public static function render(string $viewPath, array $data = []): void
    {
        // Extract variables to be used in the template
        extract($data);

        // Limpieza de buffer de salida por seguridad
        // ob_start(); // Opcional si queremos capturar output

        // Busqueda de archivo
        $fullPath = App::VIEW_DIR . $viewPath . '.php';

        // Soporte rapido para vistas de modulos si la ruta empieza con @
        if (str_starts_with($viewPath, '@')) {
            // Ejemplo: @Auth/login -> app/Modules/Auth/Views/login.php
            $parts = explode('/', substr($viewPath, 1));
            $module = array_shift($parts);
            $view = implode('/', $parts);
            $fullPath = App::ROOT_DIR . "app/Modules/$module/Views/$view.php";
        }

        if (!file_exists($fullPath)) {
            throw new \RuntimeException("Vista no encontrada: $fullPath");
        }

        // Renderizado básico incluye header y footer por defecto, 
        // a menos que sea un fragmento. Lo simplificamos incluyendo directo.
        require $fullPath;
    }

    public static function json(array $data, int $status = 200): void
    {
        header('Content-Type: application/json');
        http_response_code($status);
        echo json_encode($data);
        exit;
    }
}
