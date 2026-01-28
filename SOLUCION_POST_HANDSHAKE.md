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

## ✅ Solución Definitiva (Alineada con experiencia de usuario)

Para evitar que el navegador pida el certificado nada más entrar en la web, y para evitar el error de **Post-Handshake Authentication** en Apache/OpenSSL con TLS 1.3, la configuración recomendada es:

1.  **Forzar TLS 1.2** para el VirtualHost (permite renegociación segura).
2.  **SSLVerifyClient none** a nivel global del host.
3.  **SSLVerifyClient require** dentro de un bloque `<Location /auth/login-cert>`.

**Configuración en `httpd-ssl.conf`**:
```apache
<VirtualHost *:443>
    # ...
    SSLProtocol -all +TLSv1.2
    
    SSLVerifyClient none
    SSLCACertificateFile "c:/wamp64/www/CERTIFICADO_DIGITAL/config/certs/fnmt_bundle.pem"
    
    <Directory "...">
        # ...
    </Directory>

    <Location /auth/login-cert>
        SSLVerifyClient require
        SSLOptions +StdEnvVars +ExportCertData
    </Location>
    # ...
</VirtualHost>
```

## 🎯 Comportamiento Logrado

1.  **Al acceder a `https://certificado/`**: 
    - ✅ El navegador **NO** pide certificado.
    - ✅ La página de inicio carga de forma fluida.
    
2.  **Al pulsar en "Acceder con Certificado Digital"**:
    - ✅ Se redirige a `/auth/login-cert`.
    - ✅ El navegador lanza el popup para elegir certificado (gracias a TLS 1.2 y `require`).
    - ✅ PHP recibe los datos y valida correctamente.

Este enfoque es el estándar para portales de administración o sitios donde la autenticación con certificado es un método de login y no una condición para todo el dominio.
