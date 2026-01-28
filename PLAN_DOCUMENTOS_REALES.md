# 📑 Plan de Implementación: Documentación Real y Garantías Legales (CSV)

Este documento sirve como hoja de ruta para la siguiente fase del proyecto, donde pasaremos de datos de prueba a un sistema de documentos electrónicos con estándares de la Administración Pública.

## 1. Objetivo
Sustituir la firma de códigos aleatorios por la firma de **solicitudes reales**, garantizando:
- **Ahorro de espacio**: Almacenamiento de datos + firma en Base de Datos (no archivos PDF físicos).
- **Validez Legal**: Implementación de Código Seguro de Verificación (CSV).
- **Consistencia**: Generación de "Copias Auténticas" en PDF al vuelo.

---

## 2. Panteamiento Técnico: El "Original Electrónico"

### Bases de Datos (Estrategia Máximo Ahorro)
En lugar de guardar un archivo `.pdf` de 500KB por cada firma, guardaremos:
1.  **Datos del Trámite**: Estructura JSON/XML con la información del formulario (Nombre, DNI, Solicitud, etc.).
2.  **Sello de Firma**: El bloque Base64 de la firma electrónica generada por AutoFirma.
3.  **CSV**: Identificador único alfanumérico.

*Este método permite que 1.000 firmas ocupen unos pocos MegaBytes en lugar de Gigabytes.*

### Generación del PDF (Copia Auténtica)
Utilizaremos la librería **TCPDF** para PHP:
- **Plantilla**: Se define mediante código PHP que dibuja la estructura (Logos, textos legales, tablas).
- **Dinamismo**: El PDF se genera solo cuando el usuario hace clic en "Descargar", inyectando los datos de la BD en la plantilla.
- **Marca de Firma**: Se incluirá un recuadro lateral o pie de página con el texto oficial: 
  > *"Firmado electrónicamente por [Usuario] el [Fecha]. CSV: [Código]. Verificable en [URL_PUNTO_VERIFICACION]"*.

---

## 3. Hoja de Ruta de Implementación

### Fase 1: Entorno y Librerías
- Instalación de `tecnickcom/tcpdf` mediante Composer.
- Configuración de la carpeta `app/Core/Pdf` para gestionar las plantillas.

### Fase 2: Formulario de Solicitud Real
- Creación de una vista de formulario para que el usuario introduzca datos reales.
- El `SignatureController` recibirá estos datos y preparará el XML/JSON para AutoFirma.

### Fase 3: Estampado de CSV y Firma
- Mejora de `AutoFirmaService` para generar CSVs únicos siguiendo un patrón seguro.
- Lógica de "estampado": colocar visualmente el CSV en el margen del documento PDF generado.

### Fase 4: Punto de Verificación (CSV)
- Desarrollo de la página pública de verificación (`/verify`) donde cualquier tercero, introduciendo solo el CSV, pueda obtener el documento original y validar su integridad.

---

## 4. Garantías Legales
Este sistema cumplirá con:
- **Integridad**: La firma electrónica asegura que los datos no han sido modificados.
- **Autenticidad**: El certificado digital vincula al firmante de forma inequívoca.
- **No Repudio**: El firmante no puede negar la autoría de la firma.
- **Disponibilidad**: El CSV permite que el documento físico (impreso) pueda ser cotejado con el digital.

---
*Documento preparado por Antigravity para FJavier. Listo para ser retomado en la próxima sesión.*
