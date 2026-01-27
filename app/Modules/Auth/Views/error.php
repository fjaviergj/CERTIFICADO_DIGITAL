<?php
/**
 * @var string|null $error
 * @var string|null $details
 */
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Error de Acceso</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 2rem;
            background-color: #fff0f0;
            color: #d8000c;
            text-align: center;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 2rem;
            border-radius: 8px;
            border: 1px solid #d8000c;
        }

        h1 {
            margin-top: 0;
        }

        pre {
            background: #f9f9f9;
            padding: 1rem;
            text-align: left;
            overflow: auto;
            border-radius: 4px;
            border: 1px solid #ccc;
            color: #333;
        }

        .btn {
            display: inline-block;
            margin-top: 1rem;
            background-color: #333;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>¡Ups! Algo salió mal</h1>
        <p><?= htmlspecialchars($error ?? 'Error desconocido') ?></p>

        <?php if (isset($details)): ?>
            <details>
                <summary>Ver detalles técnicos</summary>
                <pre><?= htmlspecialchars($details) ?></pre>
            </details>

            <?php if (str_contains($details, 'NONE')): ?>
                <div
                    style="background: #fffbe6; border: 1px solid #ffe58f; padding: 15px; margin-top: 20px; color: #856404; text-align: left;">
                    <strong>🔧 Ayuda Técnica:</strong><br>
                    Apache no está enviando el certificado. Revisa tu archivo de VirtualHost y asegúrate de tener:
                    <ul style="margin: 5px 0;">
                        <li><code>SSLVerifyClient require</code></li>
                        <li><code>SSLOptions +StdEnvVars +ExportCertData</code></li>
                        <li><code>SSLCACertificateFile</code> apuntando al bundle de la FNMT.</li>
                    </ul>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <a href="/" class="btn">Volver al Inicio</a>
    </div>
</body>

</html>