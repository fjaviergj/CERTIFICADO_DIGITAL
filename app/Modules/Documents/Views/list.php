<?php
/**
 * @var array $documentos
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

        main {
            max-width: 1000px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .table-container {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        th,
        td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #333;
        }

        .csv-badge {
            font-family: monospace;
            background: #e9ecef;
            padding: 4px 8px;
            border-radius: 4px;
            font-weight: bold;
        }

        .btn {
            display: inline-block;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 0.85rem;
        }

        .btn-view {
            background-color: #0056b3;
            color: white;
        }

        .btn-back {
            color: #0056b3;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo"><strong>Certificado Digital POC</strong></div>
        <nav>
            <a href="/dashboard" style="text-decoration: none; color: #555;">Dashboard</a>
        </nav>
    </header>

    <main>
        <a href="/dashboard" class="btn-back">← Volver al Dashboard</a>

        <div class="table-container">
            <h2>Mis Documentos Firmados</h2>
            <p>Listado de documentos procesados con firma electrónica y CSV.</p>

            <?php if (empty($documentos)): ?>
                <p style="text-align: center; padding: 2rem; color: #888;">No has firmado ningún documento todavía.</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Trámite</th>
                            <th>CSV</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($documentos as $doc): ?>
                            <tr>
                                <td>
                                    <?= date('d/m/Y H:i', strtotime($doc['fecha_firma'])) ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($doc['tipo_tramite']) ?>
                                </td>
                                <td><span class="csv-badge">
                                        <?= htmlspecialchars($doc['csv']) ?>
                                    </span></td>
                                <td>
                                    <a href="/verify/download?id=<?= $doc['id'] ?>" target="_blank"
                                        class="btn btn-view">Descargar PDF</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </main>
</body>

</html>