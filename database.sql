-- ============================================================================
-- BASE DE DATOS: certificado_digital
-- ============================================================================
-- 
-- IMPORTANTE: Antes de importar este archivo, debes crear la base de datos.
-- 
-- Opción 1: Crear la base de datos desde phpMyAdmin
--   1. Acceder a http://localhost/phpmyadmin
--   2. Clic en "Nueva" (crear base de datos)
--   3. Nombre: certificado_digital
--   4. Cotejamiento: utf8mb4_unicode_ci
--   5. Clic en "Crear"
--   6. Seleccionar la BD creada e importar este archivo
-- 
-- Opción 2: Crear la base de datos con SQL
--   Ejecuta este comando antes de importar:
--   
--   CREATE DATABASE certificado_digital 
--   CHARACTER SET utf8mb4 
--   COLLATE utf8mb4_unicode_ci;
--
-- Una vez creada la BD, importa este archivo en ella.
-- ============================================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `serial_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Numero de serie del certificado',
  `dni_nie` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_completo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ultimo_acceso` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `serial_number` (`serial_number`),
  KEY `dni_nie` (`dni_nie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `tipo_tramite` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenido_xml` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Datos originales a firmar',
  `firma_electronica` mediumtext COLLATE utf8mb4_unicode_ci COMMENT 'Resultado PKCS#7 en Base64',
  `hash_firma` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'SHA256 de la firma',
  `csv` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Codigo Seguro de Verificacion',
  `estado` enum('PENDIENTE','FIRMADO','ERROR') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDIENTE',
  `fecha_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_firma` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `csv` (`csv`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `fk_documentos_usuarios` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


COMMIT;
