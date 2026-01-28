<?php
/**
 * @var ?string $title
 */
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Nueva Solicitud' ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
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
        }

        .container {
            width: 100%;
            max-width: 600px;
            padding: 2rem;
        }

        .card {
            background: var(--card-bg);
            padding: 2.5rem;
            border-radius: 1.5rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border);
        }

        h1 {
            font-weight: 600;
            font-size: 1.875rem;
            margin-bottom: 0.5rem;
            color: #0f172a;
        }

        p.subtitle {
            color: var(--text-muted);
            margin-bottom: 2rem;
            font-size: 1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            color: #334155;
        }

        input[type="text"],
        select,
        textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            border: 1px solid var(--border);
            background-color: #fff;
            color: var(--text);
            font-family: inherit;
            font-size: 1rem;
            transition: all 0.2s;
            box-sizing: border-box;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        textarea {
            resize: vertical;
            min-height: 120px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 0.875rem;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 0.75rem;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 1rem;
        }

        .btn:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .btn:active {
            transform: translateY(0);
        }

        .nav-links {
            display: flex;
            justify-content: space-between;
            margin-top: 1.5rem;
            font-size: 0.875rem;
        }

        .nav-links a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }

        .nav-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <h1>Nueva Solicitud</h1>
            <p class="subtitle">Complete los datos del trámite para proceder a la firma electrónica.</p>

            <form action="/signature/prepare" method="POST">
                <div class="form-group">
                    <label for="request_type">Tipo de Trámite</label>
                    <select id="request_type" name="request_type" required>
                        <option value="GENERIC">Solicitud Genérica</option>
                        <option value="LICENSE">Solicitud de Licencia</option>
                        <option value="SUBSIDY">Solicitud de Subvención</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="subject">Asunto</label>
                    <input type="text" id="subject" name="subject" required placeholder="Ej: Solicitud de certificado de empadronamiento">
                </div>

                <div class="form-group">
                    <label for="content">Descripción / Mensaje</label>
                    <textarea id="content" name="content" required placeholder="Escriba aquí los detalles de su solicitud..."></textarea>
                </div>

                <button type="submit" class="btn">Continuar a la Firma</button>
            </form>

            <div class="nav-links">
                <a href="/dashboard">← Volver al Dashboard</a>
                <a href="/auth/logout" style="color: #ef4444;">Cerrar Sesión</a>
            </div>
        </div>
    </div>
</body>

</html>
