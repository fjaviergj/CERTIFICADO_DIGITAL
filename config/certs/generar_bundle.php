<?php

declare(strict_types=1);

/**
 * Script para fusionar certificados FNMT en formato PEM
 * 
 * Este script toma los certificados raíz de la FNMT descargados en formato .cer
 * y los convierte/fusiona en un único archivo bundle.pem válido para Apache.
 */

$certsDir = __DIR__;
$outputFile = $certsDir . '/fnmt_bundle.pem';

// Archivos de entrada esperados (los que descargaste de la FNMT)
$inputFiles = [
    'AC_Raiz_FNMT-RCM_SHA256.cer',    // Primer certificado raíz
    'AC_Raiz_FNMT-RCM_SHA256.pem',    // Por si está en PEM
    'AC_Raiz_FNMT-RCM_G2.cer',        // Segundo certificado raíz
    'AC_Raiz_FNMT-RCM_G2.pem',        // Por si está en PEM
];

$pemCertificates = [];

echo "=== Fusionando Certificados FNMT ===\n\n";

foreach ($inputFiles as $file) {
    $filePath = $certsDir . '/' . $file;
    
    if (!file_exists($filePath)) {
        echo "⚠️  Archivo no encontrado: $file (ignorando)\n";
        continue;
    }
    
    echo "📄 Procesando: $file\n";
    
    $content = file_get_contents($filePath);
    if ($content === false) {
        echo "❌ Error leyendo: $file\n";
        continue;
    }
    
    // Si ya está en formato PEM (comienza con -----BEGIN CERTIFICATE-----)
    if (str_contains($content, '-----BEGIN CERTIFICATE-----')) {
        echo "   ✅ Ya está en formato PEM\n";
        $pemCertificates[] = trim($content);
    } 
    // Si está en formato DER/binario (.cer), convertir a PEM
    else {
        echo "   🔄 Convirtiendo de DER a PEM...\n";
        
        // Usar openssl_x509_read para leer el certificado binario
        $x509 = openssl_x509_read($content);
        
        if ($x509 === false) {
            echo "   ❌ Error: No se pudo leer el certificado\n";
            continue;
        }
        
        // Exportar a formato PEM
        $pemOutput = '';
        if (openssl_x509_export($x509, $pemOutput)) {
            echo "   ✅ Convertido correctamente\n";
            $pemCertificates[] = trim($pemOutput);
        } else {
            echo "   ❌ Error al exportar a PEM\n";
        }
        
        openssl_x509_free($x509);
    }
    
    echo "\n";
}

if (empty($pemCertificates)) {
    echo "❌ ERROR: No se pudo procesar ningún certificado.\n";
    echo "\nAsegúrate de haber descargado los certificados de:\n";
    echo "https://www.sede.fnmt.gob.es/descargas/certificados-raiz-de-la-fnmt\n";
    echo "\nY guardarlos en: $certsDir\n";
    exit(1);
}

echo "=== Generando Bundle ===\n\n";
echo "📝 Certificados válidos encontrados: " . count($pemCertificates) . "\n";

// Fusionar todos los certificados PEM en un solo archivo
$bundleContent = implode("\n", $pemCertificates);

// Guardar el bundle
if (file_put_contents($outputFile, $bundleContent) === false) {
    echo "❌ ERROR: No se pudo escribir el archivo de salida\n";
    exit(1);
}

echo "✅ Bundle creado correctamente: fnmt_bundle.pem\n";
echo "\n=== Verificación ===\n\n";

// Verificar que el bundle es válido
$bundleVerify = file_get_contents($outputFile);
$certCount = substr_count($bundleVerify, '-----BEGIN CERTIFICATE-----');

echo "📊 Certificados en el bundle: $certCount\n";

if ($certCount >= 2) {
    echo "✅ El bundle contiene al menos 2 certificados (correcto para FNMT)\n";
    echo "\n🎉 ¡COMPLETADO! Apache debería poder leer este archivo ahora.\n";
} else {
    echo "⚠️  ADVERTENCIA: Solo se encontró $certCount certificado(s)\n";
    echo "   Se esperan al menos 2 para validación completa de FNMT\n";
}

echo "\n";
