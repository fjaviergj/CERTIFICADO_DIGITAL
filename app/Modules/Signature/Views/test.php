<?php
/**
 * @var ?string $title
 * @var string $dataToSign
 */
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Firma' ?></title>
    <style>
        body {
            font-family: sans-serif;
            padding: 2rem;
            background: #f4f6f8;
            text-align: center;
        }

        .card {
            background: white;
            max-width: 600px;
            margin: 0 auto;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        pre {
            background: #eee;
            padding: 10px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .btn {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 12px 24px;
            font-size: 1rem;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn:hover {
            background-color: #218838;
        }

        .btn:disabled {
            background-color: #ccc;
            cursor: wait;
        }
    </style>
</head>

<body>
    <div class="card">
        <h1>Firmar Documento</h1>
        <p>A continuación se firmará un documento XML de prueba.</p>

        <div style="text-align: left; margin: 20px 0;">
            <strong>Datos a firmar (Base64):</strong>
            <pre><?= $dataToSign ?></pre>
        </div>

        <button id="btn-sign" class="btn" data-content="<?= $dataToSign ?>">Firmar con AutoFirma</button>

        <!-- Formulario oculto para enviar la firma al servidor -->
        <form id="form-signature" action="/signature/process" method="POST" style="display:none;">
            <input type="hidden" name="signature" id="input-signature">
        </form>
    </div>

    <!-- Script de integración -->
    <script src="/assets/js/signature.js"></script>
</body>

</html>