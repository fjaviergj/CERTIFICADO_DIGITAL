<?php
/**
 * @var string $userName
 * @var string $certSerial
 */
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Usuario</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }

        header {
            background: #fff;
            padding: 1rem 2rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .user-info {
            font-weight: bold;
            color: #333;
        }

        main {
            max-width: 800px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .panel {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-top: 0;
        }

        .action-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin-top: 2rem;
        }

        .action-card {
            border: 1px solid #e1e4e8;
            padding: 1.5rem;
            border-radius: 6px;
            text-align: center;
            transition: transform 0.2s;
        }

        .action-card:hover {
            transform: translateY(-5px);
            border-color: #0056b3;
        }

        .btn {
            display: inline-block;
            background-color: #0056b3;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 1rem;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">Certificado Digital POC</div>
        <div class="user-info">
            Hola, <?= htmlspecialchars($userName) ?>
            <small>(<?= htmlspecialchars($certSerial) ?>)</small>
        </div>
    </header>

    <main>
        <div class="panel">
            <h2>Gestiones Disponibles</h2>
            <p>Bienvenido a su área personal. Seleccione una operación:</p>

            <div class="action-grid">
                <div class="action-card">
                    <h3>Firma de Documentos</h3>
                    <p>Prueba de integración con AutoFirma para firmar un documento XML/PDF.</p>
                    <a href="/signature/test" class="btn">Iniciar Firma</a>
                </div>

                <div class="action-card">
                    <h3>Mis Documentos</h3>
                    <p>Consulte los documentos firmados anteriormente.</p>
                    <a href="#" class="btn" style="background-color: #6c757d;">Próximamente</a>
                </div>
            </div>
        </div>
    </main>
</body>

</html>