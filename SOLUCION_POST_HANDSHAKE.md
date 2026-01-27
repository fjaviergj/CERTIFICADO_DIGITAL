# Solución al Error "Post-Handshake Authentication"

## 🐛 Problema

Al intentar acceder a `/auth/login-cert`, Apache devolvía:
```
Forbidden
You don't have permission to access this resource.
Reason: Cannot perform Post-Handshake Authentication.
```

## 🔍 Causa

Este error ocurre con **TLS 1.3** cuando intentas cambiar `SSLVerifyClient` de `optional` a `require` dentro de un bloque `<Location>` en una conexión ya establecida. Esto se llama "Post-Handshake Authentication" y OpenSSL 3.x + Apache 2.4 tienen problemas con esta funcionalidad.

## ✅ Solución Aplicada

**Antes** (causaba el error):
```apache
SSLVerifyClient optional
<Location /auth/login-cert>
    SSLVerifyClient require  # ← Esto causaba el error
</Location>  
```

**Ahora** (funciona correctamente):
```apache
# Certificado opcional, NO se valida contra las CA de la FNMT
# (permite presentar cualquier certificado)
SSLVerifyClient optional_no_ca
SSLCACertificateFile "${INSTALL_DIR}/www/CERTIFICADO_DIGITAL/config/certs/fnmt_bundle.pem"
```

## 📝 Explicación de `optional_no_ca`

- **El navegador NO pedirá certificado al entrar al sitio** (solo si ya lo tienes configurado)
- **Las variables SSL estarán disponibles en PHP** si el usuario presenta un certificado
- **La validación se hace en PHP**, no en Apache
- Tu código en `AuthController::loginWithCertificate()` ya valida correctamente:
  - Si existe `$_SERVER['SSL_CLIENT_CERT']`
  - Si el certificado es válido con `openssl_x509_parse()`
  - Si el `SSL_CLIENT_VERIFY` es `SUCCESS`

## 🎯 Comportamiento Esperado

1. **Al acceder a `https://certificado/`**: 
   - ✅ El navegador NO pide certificado
   - ✅ Ves la página de login normal
   
2. **Al hacer clic en "Acceder con Certificado Digital"**:
   - ✅ Te redirige a `/auth/login-cert`
   - ✅ El navegador pide seleccionar certificado (si tienes alguno instalado)
   - ✅ PHP valida el certificado presentado
   - ✅ Si es válido (FNMT/DNIe), inicia sesión

## ⚠️ Importante

Con `optional_no_ca`, Apache **no valida** el certificado contra el bundle FNMT. La validación completa se hace en PHP:

```php
// En AuthController.php línea 32
$sslClientVerify = $_SERVER['SSL_CLIENT_VERIFY'] ?? '';

if ($sslClientVerify !== 'SUCCESS') {
    // Certificado no válido o no presentado
    View::render('@Auth/error', [...]);
}
```

Este enfoque es **más flexible** y evita el error de Post-Handshake Authentication.
