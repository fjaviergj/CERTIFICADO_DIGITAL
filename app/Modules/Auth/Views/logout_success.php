<?php
/**
 * @var string $title
 */
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>
        <?= $title ?>
    </title>
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
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
        }

        h1 {
            color: #28a745;
            margin-bottom: 1.5rem;
        }

        p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .warning-box {
            background-color: #fff3cd;
            border: 1px solid #ffeeba;
            color: #856404;
            padding: 1rem;
            border-radius: 6px;
            font-size: 0.9rem;
            margin-bottom: 2rem;
            text-align: left;
        }

        .btn {
            display: inline-block;
            background-color: #0056b3;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="card">
        <h1>Sesión Cerrada</h1>
        <p>Has salido de la aplicación correctamente.</p>

        <div class="warning-box">
            <strong>⚠️ Aviso importante sobre el certificado:</strong>
            <br><br>
            Por seguridad, para que el navegador le vuelva a solicitar su certificado digital y lo "olvide" de la
            memoria,
            <strong>debe cerrar completamente el navegador</strong> (todas sus pestañas).
            <br><br>
            Mientras no cierre el navegador, este seguirá enviando su certificado automáticamente si intenta acceder de
            nuevo.
        </div>

        <a href="/" class="btn">Volver al Inicio</a>
    </div>
</body>

</html>