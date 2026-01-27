<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Verificación de Documentos (CSV)</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f4f6f8;
            padding: 2rem;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .success {
            color: green;
            border: 1px solid green;
            padding: 1rem;
            border-radius: 4px;
            background: #e8f5e9;
        }

        .error {
            color: red;
            border: 1px solid red;
            padding: 1rem;
            border-radius: 4px;
            background: #ffebee;
        }

        .btn {
            display: inline-block;
            background: #0056b3;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 1rem;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 1rem 0;
        }

        table td {
            padding: 8px;
            border-bottom: 1px solid #eee;
        }

        .label {
            font-weight: bold;
            color: #555;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Cotejo de Documentos</h1>
        <p>Introduzca el Código Seguro de Verificación (CSV) impreso en el justificante para validar su autenticidad.
        </p>

        <form action="/verify" method="GET">
            <input type="text" name="csv" value="<?= htmlspecialchars($csv ?? '') ?>" placeholder="Ej: 8B3F..."
                required>
            <button type="submit" class="btn">Verificar</button>
        </form>

        <?php if (isset($error)): ?>
            <div class="error" style="margin-top: 1rem;">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <?php if (isset($documento) && $documento): ?>
            <div class="success" style="margin-top: 1rem;">
                <h3>✓ Documento Válido</h3>
                <table>
                    <tr>
                        <td class="label">Trámite:</td>
                        <td>
                            <?= htmlspecialchars($documento['tipo_tramite']) ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Fecha Firma:</td>
                        <td>
                            <?= htmlspecialchars($documento['fecha_firma']) ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">CSV:</td>
                        <td>
                            <?= htmlspecialchars($documento['csv']) ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Hash Firma:</td>
                        <td><small>
                                <?= htmlspecialchars($documento['hash_firma']) ?>
                            </small></td>
                    </tr>
                </table>
                <a href="/verify/download?id=<?= $documento['id'] ?>" class="btn">Visualizar Original</a>
            </div>
        <?php endif; ?>

        <br>
        <a href="/" style="color: #666; text-decoration: none;">← Volver al inicio</a>
    </div>
</body>

</html>