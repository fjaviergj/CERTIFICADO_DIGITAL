# 🛠️ GUÍA COMPLETA DE CONFIGURACIÓN Y DESPLIEGUE

Esta es la guía definitiva para poner en marcha el proyecto de **Autenticación con Certificado Digital y Firma con AutoFirma**. Sigue los pasos en orden para configurar correctamente WampServer con HTTPS y autenticación mediante certificados digitales.

---

## 📋 ÍNDICE VISUAL

```
┌─────────────────────────────────────────────────────────────┐
│ 1. Requisitos del Sistema (PHP, Apache, MySQL)             │
│ 2. Certificados SSL para el Servidor (mkcert)              │
│ 3. Certificados FNMT (Validación de Usuarios)              │
│ 4. Configuración de Apache (VirtualHosts + SSL)            │
│ 5. Configuración del Sistema (hosts de Windows)            │
│ 6. Base de Datos MySQL                                     │
│ 7. Integración con AutoFirma                               │
│ 8. Pruebas y Verificación                                  │
└─────────────────────────────────────────────────────────────┘
```

---

## 1. REQUISITOS DEL SISTEMA

### ✅ Software Necesario

#### A) PHP 8.2+ (ya instalado en WampServer)

**Extensiones requeridas** en `php.ini`:
- ✔️ `openssl` (validación de firmas y certificados)
- ✔️ `pdo_mysql` (conexión a base de datos)
- ✔️ `mbstring` (manejo de cadenas de texto complejas)
- ⚪ `gd` (opcional, manipulación de imágenes)

**Verificar** desde WampServer:
1. Icono de WampServer (bandeja del sistema) → PHP → Extensiones PHP
2. Asegurarse de que las extensiones marcadas están activas

---

#### B) Apache 2.4+ (ya instalado en WampServer)

**Módulos Apache requeridos**:
- ✔️ `ssl_module` (soporte HTTPS)
- ✔️ `socache_shmcb_module` (caché de sesiones SSL)
- ✔️ `rewrite_module` (URLs amigables)

**Verificar** módulos activos:
```bash
C:\wamp64\bin\apache\apache2.4.66.1\bin\httpd.exe -M | findstr ssl
```

Salida esperada:
```
ssl_module (shared)
socache_shmcb_module (shared)
```

Si faltan, activarlos desde:
- Icono WampServer → Apache → Módulos Apache → marcar los módulos necesarios

---

#### C) MySQL 8.0+ (ya instalado en WampServer)

- ✔️ Servidor MySQL corriendo
- ✔️ Acceso a phpMyAdmin

---

### 📥 Software Externo (Descarga Manual)

1. **mkcert** (generador de certificados SSL locales)
   - Descargar de: [github.com/FiloSottile/mkcert/releases](https://github.com/FiloSottile/mkcert/releases)
   - Archivo: `mkcert-vX.X.X-windows-amd64.exe`
   - Renombrar a: `mkcert.exe`
   - Ubicar en: `C:\mkcert\`

2. **AutoFirma** (aplicación de firma electrónica)
   - Descargar de: [firmaelectronica.gob.es](https://firmaelectronica.gob.es/Home/Descargas.html)
   - Instalar la versión para Windows

3. **Certificado Digital Personal**
   - Obtener de la FNMT o utilizar DNIe
   - Instalar en el navegador (Chrome, Firefox o Edge)

---

## 2. CERTIFICADOS SSL DEL SERVIDOR (HTTPS)

> [!NOTE]
> **Estado actual**: ✅ **YA COMPLETADO** en este proyecto. Los certificados ya están generados en `C:\wamp64\bin\Certs\Site\certificado.*`

Para quienes clonen el repositorio y necesiten recrear los certificados:

### Paso 2.1: Instalar la CA Local de mkcert

Abrir **Símbolo del sistema como Administrador** y ejecutar:

```bash
cd C:\mkcert
mkcert -install
```

Esto crea e instala una Autoridad de Certificación local en Windows y navegadores.

---

### Paso 2.2: Generar Certificado SSL para el Dominio Local

```bash
cd C:\mkcert
mkcert certificado.local certificado localhost 127.0.0.1 ::1
```

Se generarán dos archivos:
- `certificado.local+4.pem` (certificado)
- `certificado.local+4-key.pem` (clave privada)

---

### Paso 2.3: Convertir a Formato Compatible con WampServer

Ejecutar estos comandos en **Símbolo del sistema** (ajustar el nombre del archivo si es diferente):

```batch
:: 1️⃣ Convertir certificado de PEM a CRT
C:\wamp64\bin\apache\apache2.4.66.1\bin\openssl.exe x509 -outform pem -in "certificado.local+4.pem" -out certificado.crt

:: 2️⃣ Renombrar clave privada
rename "certificado.local+4-key.pem" certificado.key

:: 3️⃣ Crear archivo PFX (opcional, para importar en Windows)
C:\wamp64\bin\apache\apache2.4.66.1\bin\openssl.exe pkcs12 -export -out certificado.pfx -inkey certificado.key -in certificado.crt -passout pass:

:: 4️⃣ Mover archivos a la carpeta de WampServer
move /Y certificado.crt C:\wamp64\bin\Certs\Site\
move /Y certificado.key C:\wamp64\bin\Certs\Site\
move /Y certificado.pfx C:\wamp64\bin\Certs\Site\

:: 5️⃣ Limpiar archivos temporales
del "certificado.local+4.pem"
```

---

## 3. CERTIFICADOS FNMT (VALIDACIÓN DE USUARIOS)

> [!NOTE]
> **Estado actual**: ✅ **YA COMPLETADO**. El archivo `fnmt_bundle.pem` ya está generado correctamente en `config/certs/`.

Para entender de dónde proviene y cómo renovarlo en el futuro:

### Paso 3.1: Descargar Certificados Raíz de la FNMT

Apache necesita conocer las **Autoridades de Certificación (CA)** de confianza para validar los certificados digitales de los usuarios.

**Fuente oficial**: [Certificados Raíz de la FNMT](https://www.sede.fnmt.gob.es/descargas/certificados-raiz-de-la-fnmt)

**Certificados necesarios** (descargar en formato `.cer`):

1. **AC Raíz FNMT-RCM (SHA256)**
   - Buscar en la web: "AC Raíz FNMT-RCM"
   - Descargar el certificado (botón "Certificado")
   - Guardar como: `AC_Raiz_FNMT-RCM_SHA256.cer` en `config/certs/`

2. **AC Raíz FNMT-RCM G2**
   - Buscar en la web: "AC Raíz FNMT-RCM G2"
   - Descargar el certificado (botón "Certificado")
   - Guardar como: `AC_Raiz_FNMT-RCM_G2.cer` en `config/certs/`

---

### Paso 3.2: Generar el Bundle de Certificados

Apache solo permite cargar **un único archivo** de CAs mediante la directiva `SSLCACertificateFile`. Por eso, fusionamos ambos certificados.

#### Opción A: Script PHP Automático (Recomendado)

Ya existe un script en el proyecto para hacer esto automáticamente:

```powershell
cd C:\wamp64\www\CERTIFICADO_DIGITAL\config\certs
C:\wamp64\bin\php\php8.4.16\php.exe generar_bundle.php
```

El script:
- Detecta automáticamente los archivos `.cer` o `.pem`
- Los convierte a formato PEM si es necesario
- Los fusiona en `fnmt_bundle.pem`
- Verifica que el bundle es válido

---

#### Opción B: Conversión Manual con OpenSSL

Si prefieres hacerlo manualmente:

```powershell
# Ir a la carpeta de certificados
cd C:\wamp64\www\CERTIFICADO_DIGITAL\config\certs

# Convertir el primer certificado de DER a PEM
C:\wamp64\bin\apache\apache2.4.66.1\bin\openssl.exe x509 -inform DER -in AC_Raiz_FNMT-RCM_SHA256.cer -out AC_Raiz_FNMT-RCM_SHA256.pem

# Convertir el segundo certificado (ya está en PEM, confirmamos formato)
C:\wamp64\bin\apache\apache2.4.66.1\bin\openssl.exe x509 -inform PEM -in AC_Raiz_FNMT-RCM_G2.cer -out AC_Raiz_FNMT-RCM_G2.pem

# Fusionar ambos en un solo bundle
Get-Content AC_Raiz_FNMT-RCM_SHA256.pem,AC_Raiz_FNMT-RCM_G2.pem | Set-Content fnmt_bundle.pem -Encoding ASCII
```

---

### Paso 3.3: Verificar el Bundle

Para confirmar que el bundle es válido:

```powershell
# Ver cuántos certificados contiene (debe mostrar "2")
Select-String -Path fnmt_bundle.pem -Pattern "BEGIN CERTIFICATE" | Measure-Object

# Ver información del bundle
certutil -dump fnmt_bundle.pem
```

**Salida esperada**: 
- Debe contener **2 certificados**
- `certutil` debe mostrar información detallada sin errores

> [!IMPORTANT]
> **NO intentes copiar y pegar el contenido del `.cer`** manualmente en un editor de texto. Los certificados en formato binario (DER) se corrompen al copiarlos como texto. Siempre usa OpenSSL para la conversión.

---

## 4. CONFIGURACIÓN DE APACHE

### Paso 4.1: Configurar el Archivo Hosts de Windows

Este paso permite acceder al sitio usando el nombre `certificado` en lugar de `localhost`.

**Archivo**: `C:\Windows\System32\drivers\etc\hosts`

**Acción**:
1. Abrir **Bloc de Notas como Administrador**
2. Abrir el archivo `hosts`
3. Añadir al final (si no existe):

```
127.0.0.1  certificado
```

4. Guardar y cerrar

---

### Paso 4.2: Verificar VirtualHost HTTP (Puerto 80)

> [!NOTE]
> **Estado actual**: ✅ **YA CONFIGURADO** en `httpd-vhosts.conf`

**Archivo**: `C:\wamp64\bin\apache\apache2.4.66.1\conf\extra\httpd-vhosts.conf`

**Configuración esperada**:

```apache
<VirtualHost *:80>
	ServerName certificado
	DocumentRoot "${INSTALL_DIR}/www/CERTIFICADO_DIGITAL/public"
	<Directory  "${INSTALL_DIR}/www/CERTIFICADO_DIGITAL/public/">
		Options +Indexes +Includes +FollowSymLinks +MultiViews
		AllowOverride All
		Require local
	</Directory>
</VirtualHost>
```

> [!IMPORTANT]
> **Usar `${INSTALL_DIR}`** en lugar de rutas absolutas para mantener portabilidad de la configuración.

---

### Paso 4.3: Configurar VirtualHost HTTPS con Autenticación de Cliente

**Archivo**: `C:\wamp64\bin\apache\apache2.4.66.1\conf\extra\httpd-ssl.conf`

**Configuración necesaria**:

```apache
## BEGIN OF SSL VIRTUAL HOST certificado CONTEXT
Define SERVERNAMEVHOSTSSL certificado
Define DOCUMENTROOTVHOSTSSL ${INSTALL_DIR}/www/CERTIFICADO_DIGITAL/public

<VirtualHost *:443>
	ServerName ${SERVERNAMEVHOSTSSL}
	DocumentRoot "${DOCUMENTROOTVHOSTSSL}"
	
	# ====================================================
	# CONFIGURACIÓN SSL BÁSICA
	# ====================================================
	SSLEngine on
	SSLCertificateFile      "${CERTIFS}/Site/${SERVERNAMEVHOSTSSL}.crt"
	SSLCertificateKeyFile   "${CERTIFS}/Site/${SERVERNAMEVHOSTSSL}.key"
	
	# ====================================================
	# AUTENTICACIÓN CON CERTIFICADO DIGITAL DE CLIENTE
	# ====================================================
	# Certificado OPCIONAL a nivel global (no todo el sitio lo requiere)
	SSLVerifyClient optional
	# Profundidad de verificación de la cadena de certificados
	SSLVerifyDepth 3
	# CA de confianza (FNMT) para validar certificados de usuario
	SSLCACertificateFile "${INSTALL_DIR}/www/CERTIFICADO_DIGITAL/config/certs/fnmt_bundle.pem"
	
	<Directory "${DOCUMENTROOTVHOSTSSL}/">
		Options +Indexes +Includes +FollowSymLinks +MultiViews
		AllowOverride all
		Require local
		# Exportar variables SSL a PHP (disponibles aunque no haya certificado)
		SSLOptions +StdEnvVars +ExportCertData
	</Directory>
	
	# ====================================================
	# RUTA QUE REQUIERE CERTIFICADO OBLIGATORIO
	# ====================================================
	<Location /auth/login-cert>
		# Aquí SÍ exigir certificado digital
		SSLVerifyClient require
		SSLOptions +StdEnvVars +ExportCertData
	</Location>
	
	CustomLog "${INSTALL_DIR}/logs/custom.log" "%t %h %{SSL_PROTOCOL}x %{SSL_CIPHER}x \"%r\" %b"
</VirtualHost>
## END OF SSL VIRTUAL HOST certificado CONTEXT
```

**Explicación de las directivas SSL**:

| Directiva | Ubicación | Función |
|-----------|-----------|---------|
| `SSLVerifyClient optional` | VirtualHost | Permite el acceso **sin certificado** al sitio general (home, verificación, etc.), pero permite que el usuario presente uno si está disponible. |
| `SSLVerifyClient require` | `<Location /auth/login-cert>` | **Obliga** al navegador a presentar certificado digital **solo en esta ruta específica** (login con certificado). |
| `SSLVerifyDepth 3` | VirtualHost | Permite validar cadenas de certificados con hasta 3 niveles (certificado de usuario → CA intermedia → CA raíz FNMT). |
| `SSLCACertificateFile` | VirtualHost | Indica qué Autoridades de Certificación son de confianza. Aquí apuntamos al bundle FNMT descargado. |
| `SSLOptions +StdEnvVars` | Directory + Location | Exporta información del certificado a variables `$_SERVER` en PHP (como `SSL_CLIENT_S_DN`, `SSL_CLIENT_VERIFY`). |
| `SSLOptions +ExportCertData` | Directory + Location | Exporta el certificado completo en formato PEM a `$_SERVER['SSL_CLIENT_CERT']`. **Esencial** para que PHP pueda procesarlo con `openssl_x509_parse()`. |

> [!IMPORTANT]
> **Ventajas de esta configuración**:
> - ✅ Páginas públicas (`/`, `/verify`) accesibles sin certificado
> - ✅ Solo `/auth/login-cert` requiere certificado obligatorio  
> - ✅ Mejor experiencia de usuario (no se pide certificado para todo)
> - ✅ El dashboard usa sesión PHP, no necesita certificado en cada petición

---

### Paso 4.4: Verificar Sintaxis de Apache

Antes de reiniciar el servidor, **verificar que no hay errores de sintaxis**:

```bash
C:\wamp64\bin\apache\apache2.4.66.1\bin\httpd.exe -t
```

**Salida esperada**:
```
Syntax OK
```

Si hay errores, corregir antes de continuar.

---

### Paso 4.5: Reiniciar WampServer

**Desde el menú de WampServer**:
1. Clic derecho en el icono de WampServer (bandeja del sistema)
2. **Reiniciar todos los servicios**

**Verificar que Apache está corriendo**:
- El icono de WampServer debe estar **verde**
- Si está naranja o rojo, revisar `C:\wamp64\logs\apache_error.log`

---

## 5. BASE DE DATOS (MySQL)

### Paso 5.1: Crear la Base de Datos

1. Acceder a **phpMyAdmin**: `http://localhost/phpmyadmin`
2. Ir a la pestaña **SQL**
3. Crear base de datos:

```sql
CREATE DATABASE certificado_digital CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

---

### Paso 5.2: Importar el Esquema

1. Seleccionar la base de datos `certificado_digital`
2. Ir a **Importar**
3. Seleccionar el archivo: `c:\wamp64\www\CERTIFICADO_DIGITAL\database.sql`
4. Ejecutar

---

### Paso 5.3: Verificar la Conexión en PHP

**Archivo**: `app/Config/Database.php`

Si tu usuario/contraseña de MySQL es diferente de `root` / `""` (vacío), editar el archivo con tus credenciales.

---

## 6. INTEGRACIÓN CON AUTOFIRMA

El proyecto utiliza el script oficial **AutoScript.js** proporcionado por el Ministerio de Asuntos Económicos y Transformación Digital.

### 📥 Descarga de archivos oficiales
En caso de necesitar actualizar los archivos o desplegar desde cero, siga estos pasos:

1. **Acceder al Portal CTT**: [Portal de Administración Electrónica - Cliente @firma](https://administracionelectronica.gob.es/ctt/clienteafirma/descargas)
2. **Descargar AutoScript**: Busque el paquete **AutoScript v1.9** (o versión superior disponible). Aparecerá como un archivo ZIP.
3. **Extraer y Copiar**: 
   - Extraiga el contenido del ZIP.
   - Localice el archivo `js/autoscript.js`.
   - Cópielo a la carpeta del proyecto en: `public/assets/js/AutoScript.js`.

### ⚙️ Configuración en la aplicación
La aplicación detectará automáticamente la presencia de `AutoScript.js`. 

- **Modo Real**: Si `AutoScript.js` está presente, se invocará a la aplicación AutoFirma instalada en el equipo del usuario mediante el protocolo `afirma://`.
- **Modo Simulado**: Si el archivo no existe, la aplicación mostrará un aviso y permitirá realizar una firma simulada para pruebas de flujo de servidor.

> [!IMPORTANT]
> **AutoFirma Desktop** debe estar instalada en el ordenador del usuario final para que la firma funcione. Se puede descargar desde [firmaelectronica.gob.es](https://firmaelectronica.gob.es/Home/Descargas.html).

---

## 7. PRUEBAS Y VERIFICACIÓN

### ✅ Checklist de Verificación Pre-Producción

#### 1. Verificar Certificados SSL del Servidor

```bash
dir C:\wamp64\bin\Certs\Site\certificado.*
```

**Archivos esperados**:
- ✔️ `certificado.crt`
- ✔️ `certificado.key`

---

#### 2. Verificar Bundle FNMT

```bash
type C:\wamp64\www\CERTIFICADO_DIGITAL\config\certs\fnmt_bundle.pem
```

Debe contener **dos bloques** `-----BEGIN CERTIFICATE-----`.

---

#### 3. Verificar Módulos Apache Activos

```bash
C:\wamp64\bin\apache\apache2.4.66.1\bin\httpd.exe -M | findstr "ssl rewrite"
```

**Salida esperada**:
```
rewrite_module (shared)
ssl_module (shared)
socache_shmcb_module (shared)
```

---

#### 4. Test de Resolución de Dominio Local

```bash
ping certificado
```

**Salida esperada**:
```
Haciendo ping a certificado [127.0.0.1] ...
```

Si falla, revisar el archivo `hosts`.

---

#### 5. Test de Autenticación con Certificado Digital

**Pasos**:

1. Abrir navegador (Chrome, Firefox o Edge)
2. Navegar a: `https://certificado/auth/login-cert`
3. **Verificación crítica**: El navegador debe mostrar un **popup para seleccionar certificado digital**
   - Si no aparece el popup, la configuración SSL de Apache está incompleta
4. Seleccionar tu certificado FNMT o DNIe
5. **Resultado esperado**:
   - Redirección automática a `/dashboard`
   - Sesión iniciada con tus datos del certificado
   - Nombre y DNI/NIE visibles en el dashboard

---

#### 6. Test de Firma de Documentos

1. En el dashboard, ir a **"Firmar Documento"**
2. Introducir datos ficticios
3. **Si AutoFirma está instalado**: Se abrirá la aplicación para firmar
4. **Si no está instalado**: Se genera un PDF de prueba (modo simulado)

---

### 🔧 Troubleshooting (Resolución de Problemas)

| Síntoma | Causa Probable | Solución |
|---------|----------------|----------|
| **Puerto 443 ya en uso** | Otro servicio (Skype, IIS, VMware) está usando el puerto 443 | Ejecutar `netstat -ano \| findstr :443` para identificar el proceso. Detener el proceso conflictivo o cambiar el puerto en Apache. |
| **"Cannot find SSLCACertificateFile"** | Ruta incorrecta al bundle FNMT | Verificar que `fnmt_bundle.pem` existe en `config/certs/` y que la ruta en `httpd-ssl.conf` es correcta. |
| **Navegador no pide certificado** | Falta `SSLVerifyClient require` en el VirtualHost | Revisar `httpd-ssl.conf` y asegurar que la directiva está presente en `<VirtualHost *:443>`. |
| **`$_SERVER['SSL_CLIENT_CERT']` está vacío** | Falta `SSLOptions +ExportCertData` | Añadir la directiva dentro del bloque `<Directory>` del VirtualHost HTTPS. |
| **Error 403 "Forbidden"** | Apache requiere certificado pero el navegador no lo envió | Verificar que tienes un certificado FNMT/DNIe instalado en el navegador. |
| **"No se detecta certificado válido"** en la app | El certificado no está firmado por la FNMT | Verificar que `fnmt_bundle.pem` contiene los certificados raíz correctos. |

---

### 📊 Verificación de Variables SSL en PHP

Si necesitas debuggear, añade temporalmente en `app/Modules/Auth/AuthController.php`:

```php
// Al inicio de loginWithCertificate()
var_dump([
    'SSL_CLIENT_VERIFY' => $_SERVER['SSL_CLIENT_VERIFY'] ?? 'NO SET',
    'SSL_CLIENT_CERT' => isset($_SERVER['SSL_CLIENT_CERT']) ? 'PRESENT' : 'NO SET',
    'SSL_CLIENT_S_DN' => $_SERVER['SSL_CLIENT_S_DN'] ?? 'NO SET'
]);
exit;
```

**Valores esperados**:
- `SSL_CLIENT_VERIFY` → `"SUCCESS"`
- `SSL_CLIENT_CERT` → `"PRESENT"`
- `SSL_CLIENT_S_DN` → String con el Distinguished Name del certificado

---

## 8. COMANDOS DE MANTENIMIENTO

### Reiniciar Solo Apache (sin MySQL)

```bash
net stop wampapache64
net start wampapache64
```

### Ver Logs de Errores de Apache

```bash
type C:\wamp64\logs\apache_error.log
```

### Limpiar Caché de SSL de Apache

```bash
del C:\wamp64\tmp\ssl_gcache_data*
```

---

## 📚 REFERENCIAS ADICIONALES

- [Documentación oficial de mod_ssl (Apache)](https://httpd.apache.org/docs/2.4/mod/mod_ssl.html)
- [mkcert en GitHub](https://github.com/FiloSottile/mkcert)
- [Certificados FNMT](https://www.sede.fnmt.gob.es/descargas/certificados-raiz-de-la-fnmt)
- [AutoFirma - Documentación](https://firmaelectronica.gob.es/Home/Descargas.html)

---

## ✅ RESUMEN EJECUTIVO

Para poner en marcha este proyecto desde cero:

1. ✔️ Instalar WampServer con PHP 8.2+, Apache 2.4+, MySQL 8.0+
2. ✔️ Generar certificados SSL locales con `mkcert`
3. ✔️ Descargar bundle FNMT (ya incluido en el repositorio)
4. ✔️ Configurar Apache con VirtualHosts HTTP y HTTPS
5. ✔️ Añadir autenticación SSL de cliente en `httpd-ssl.conf`
6. ✔️ Configurar archivo `hosts` de Windows
7. ✔️ Importar base de datos
8. ✔️ Probar acceso a `https://certificado/auth/login-cert`

**¿Todo funciona?** Si el navegador te pide seleccionar certificado, ¡enhorabuena! 🎉
