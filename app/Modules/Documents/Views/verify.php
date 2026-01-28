<?php
/**
 * @var ?array $documento
 * @var ?string $error
 * @var string $csv
 */
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotejo de Documentos - Certificado Digital</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        :root {
            --primary: #2563eb;
            --success: #10b981;
            --error: #ef4444;
            --bg: #f8fafc;
            --card-bg: #ffffff;
            --text: #1e293b;
            --text-muted: #64748b;
            --border: #e2e8f0;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg);
            color: var(--text);
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 1rem;
        }

        .container {
            width: 100%;
            max-width: 650px;
        }

        .card {
            background: var(--card-bg);
            padding: 2.5rem;
            border-radius: 1.5rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border);
        }

        h1 {
            font-weight: 600;
            font-size: 1.75rem;
            margin-bottom: 0.5rem;
            color: #0f172a;
            text-align: center;
        }

        .subtitle {
            color: var(--text-muted);
            text-align: center;
            margin-bottom: 2rem;
            font-size: 0.95rem;
        }

        .search-box {
            background: #f1f5f9;
            padding: 1.5rem;
            border-radius: 1rem;
            margin-bottom: 2rem;
        }

        .form-group {
            display: flex;
            gap: 0.75rem;
        }

        input[type="text"] {
            flex: 1;
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            border: 1px solid var(--border);
            font-family: inherit;
            font-size: 1rem;
            text-transform: uppercase;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 0.75rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn:hover {
            background-color: #1d4ed8;
            transform: translateY(-1px);
        }

        .alert {
            padding: 1rem;
            border-radius: 0.75rem;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .alert-error {
            background-color: #fef2f2;
            color: var(--error);
            border: 1px solid #fee2e2;
        }

        .result-card {
            border: 2px solid var(--success);
            border-radius: 1rem;
            padding: 1.5rem;
            background-color: #f0fdf4;
        }

        .result-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: var(--success);
            font-weight: 600;
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }

        .data-table td {
            padding: 0.75rem 0;
            border-bottom: 1px solid #dcfce7;
        }

        .data-table td:first-child {
            font-weight: 600;
            color: var(--text-muted);
            width: 35%;
        }

        .btn-download {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
            margin-top: 1.5rem;
            background-color: #065f46;
            text-decoration: none;
        }

        .footer-link {
            text-align: center;
            margin-top: 2rem;
        }

        .footer-link a {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.875rem;
        }

        .footer-link a:hover {
            color: var(--primary);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <h1>Cotejo de Documentos</h1>
            <p class="subtitle">Verifique la autenticidad e integridad de sus documentos mediante el Código Seguro de
                Verificación (CSV).</p>

            <div class="search-box">
                <form action="/verify" method="GET" class="form-group">
                    <input type="text" name="csv" value="<?= htmlspecialchars($csv) ?>"
                        placeholder="Ej: XXXX-XXXX-XXXX-XXXX" required maxlength="19">
                    <button type="submit" class="btn">Cotejar</button>
                </form>
            </div>

            <?php if ($error): ?>
                <div class="alert alert-error">
                    <span>⚠️</span>
                    <span><?= htmlspecialchars($error) ?></span>
                </div>
            <?php endif; ?>

            <?php if ($documento): ?>
                <div class="result-card">
                    <div class="result-header">
                        <span>✅</span>
                        <span>DOCUMENTO VÁLIDO</span>
                    </div>

                    <table class="data-table">
                        <tr>
                            <td>Tipo de Trámite</td>
                            <td><?= htmlspecialchars($documento['tipo_tramite']) ?></td>
                        </tr>
                        <tr>
                            <td>Fecha de Firma</td>
                            <td><?= date('d/m/Y H:i:s', strtotime($documento['fecha_firma'])) ?></td>
                        </tr>
                        <tr>
                            <td>CSV</td>
                            <td><code><?= htmlspecialchars($documento['csv']) ?></code></td>
                        </tr>
                        <tr>
                            <td>Hash de Integridad</td>
                            <td><small><?= substr($documento['hash_firma'], 0, 32) ?>...</small></td>
                        </tr>
                    </table>

                    <a href="/verify/download?csv=<?= urlencode($documento['csv']) ?>" target="_blank"
                        class="btn btn-download">
                        📥 Visualizar Copia Auténtica (PDF)
                    </a>
                </div>
            <?php endif; ?>

            <div class="footer-link">
                <a href="/">← Volver a la página de inicio</a>
            </div>
        </div>
    </div>
</body>

</html>