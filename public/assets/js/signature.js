/**
 * Helper sencillo para invocar AutoFirma a través del protocolo afirma://
 * O usando AutoScript.js si estuviera disponible.
 * Aquí usaremos la invocación por protocolo (Standalone) que es lo más moderno y no requiere Java en el navegador.
 */

const AutoFirmaClient = {
    /**
     * Inicia el proceso de firma.
     * @param {string} dataB64 Datos en Base64 a firmar.
     * @param {function} callbackSuccess Callback con la firma resultante.
     * @param {function} callbackError Callback en caso de error.
     */
    sign: function(dataB64, callbackSuccess, callbackError) {
        // Formato CAdES (el estándar para firmas electrónicas en España)
        // Algoritmo SHA256 con RSA
        const format = "CAdES";
        const algorithm = "SHA256withRSA";
        const extraParams = "mode=implicit"; // Firma implícita incluye los datos originales en la firma

        console.log("Invocando AutoFirma para formato:", format);

        // 1. Intentar usar AutoScript.js de la administración si está cargado
        if (typeof AutoScript !== 'undefined') {
            AutoScript.sign(dataB64, algorithm, format, extraParams, callbackSuccess, callbackError);
            return;
        }

        // 2. Si no hay AutoScript (lo más común si no se ha descargado el .js),
        // mostramos una advertencia detallada.
        const msg = "Para realizar la firma real, es necesario:\n" +
            "1. Tener instalada la aplicación AutoFirma en su ordenador.\n" +
            "2. El desarrollador debe descargar 'AutoScript.js' de la web oficial de firmaelectronica.gob.es y colocarlo en el proyecto.\n\n" +
            "¿Desea realizar una SIMULACIÓN de firma para probar el flujo del servidor?";

        if (confirm(msg)) {
            // Simulamos un retraso de red/proceso
            setTimeout(() => {
                const fakeSignature = "SIM_SIG_" + btoa(Date.now().toString());
                callbackSuccess(fakeSignature);
            }, 1500);
        } else {
            callbackError("Operación cancelada por el usuario o falta de requisitos técnicos.");
        }
    }
};

document.addEventListener('DOMContentLoaded', function() {
    const btnSign = document.getElementById('btn-sign');
    const form = document.getElementById('form-signature');
    const inputSignature = document.getElementById('input-signature');

    if(btnSign) {
        btnSign.addEventListener('click', function() {
            const dataToSign = btnSign.dataset.content; // Base64
            
            btnSign.disabled = true;
            btnSign.innerText = "Abriendo AutoFirma...";

            AutoFirmaClient.sign(dataToSign, function(signature) {
                // Success
                console.log("Firma recibida:", signature);
                inputSignature.value = signature;
                form.submit();
            }, function(error) {
                // Error
                alert("Error al firmar: " + error);
                btnSign.disabled = false;
                btnSign.innerText = "Firmar Documento";
            });
        });
    }
});
