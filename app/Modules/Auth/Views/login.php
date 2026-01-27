<?php
/**
 * @var string|null $title
 */
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Login' ?></title>
    <style>
        body {
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f2f5;
        }

        .card {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
        }

        h1 {
            margin-bottom: 2rem;
            color: #333;
            font-size: 1.5rem;
        }

        .btn {
            display: inline-block;
            background-color: #0056b3;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background 0.3s;
        }

        .btn:hover {
            background-color: #004494;
        }

        .info {
            margin-top: 1rem;
            font-size: 0.9rem;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="card">
        <h1>Acceso con Certificado</h1>
        <p>Para acceder, debe tener instalado su certificado digital en el navegador o su DNI electrónico conectado.</p>

        <br>

        <a href="/auth/login-cert" class="btn">Acceder con Certificado Digital</a>

        <div style="margin-top: 20px;">
            <a href="/verify" style="color: #666; font-size: 0.9rem;">Verificar un documento (CSV)</a>
        </div>

        <div class="info">
            <p>Soporta FNMT y DNIe</p>
        </div>
    </div>
</body>

</html>