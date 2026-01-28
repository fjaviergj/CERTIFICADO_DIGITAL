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
            background-color: #f4f6f8;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background: white;
            padding: 3rem;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            text-align: center;
            max-width: 500px;
            width: 90%;
        }

        h1 {
            color: #28a745;
            margin-bottom: 1rem;
        }

        p {
            color: #555;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .btn-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            transition: opacity 0.2s;
        }

        .btn-primary {
            background-color: #0056b3;
            color: white;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn:hover {
            opacity: 0.9;
        }
    </style>
</head>

<body>
    <div class="card">
        <div style="font-size: 4rem; color: #28a745; margin-bottom: 1rem;">✓</div>
        <h1>¡Trámite Completado!</h1>
        <p>El documento ha sido firmado correctamente y se ha generado su Código Seguro de Verificación (CSV).</p>

        <div class="btn-group">
            <a href="/documents/list" class="btn btn-primary">Ver Mis Documentos</a>
            <a href="/dashboard" class="btn btn-secondary">Volver al Dashboard</a>
        </div>
    </div>
</body>

</html>