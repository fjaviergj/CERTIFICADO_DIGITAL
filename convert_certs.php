<?php

$sourceDir = __DIR__ . '/config/certs/';
$outputFile = $sourceDir . 'fnmt_bundle.pem';

$filesToProcess = [
    'AC_Raiz_FNMT-RCM_SHA256.cer',
    'AC_Raiz_FNMT-RCM_G2.cer'
];

$bundleContent = '';

echo "Iniciando conversión de certificados...n";

foreach ($filesToProcess as $filename) {
    $path = $sourceDir . $filename;
    
    if (!file_exists($path)) {
        echo "ADVERTENCIA: No se encuentra $filename. Saltando...n";
        continue;
    }

    $content = file_get_contents($path);
    
    // Check if it's already PEM (contains "BEGIN CERTIFICATE")
    if (strpos($content, 'BEGIN CERTIFICATE') !== false) {
        echo "Procesando $filename (Formato: PEM detectado)n";
        $bundleContent .= $content . "n";
    } else {
        echo "Procesando $filename (Formato: DER detectado -> Convirtiendo a PEM)n";
        $pem = "-----BEGIN CERTIFICATE-----n";
        $pem .= chunk_split(base64_encode($content), 64, "n");
        $pem .= "-----END CERTIFICATE-----n";
        $bundleContent .= $pem . "n";
    }
}

if (empty($bundleContent)) {
    echo "ERROR: No se pudo generar contenido para el bundle.n";
    exit(1);
}

if (file_put_contents($outputFile, $bundleContent)) {
    echo "ÉXITO: Cadena de certificados creada en: $outputFilen";
} else {
    echo "ERROR: No se pudo escribir el archivo $outputFilen";
    exit(1);
}
