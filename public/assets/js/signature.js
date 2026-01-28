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
    sign: function (dataB64, certSerial, callbackSuccess, callbackError) {
        // Formato CAdES (el estándar para firmas electrónicas en España)
        // Algoritmo SHA256 con RSA
        const format = "CAdES";
        const algorithm = "SHA256withRSA";

        // Filtro para usar el mismo certificado que el de login
        // La firma IMPLÍCITA (Attached) incluye los datos dentro del CMS, facilitando la validación en PHP
        let extraParams = "mode=implicit";
        if (certSerial) {
            // Sintaxis de filtrado oficial: filters: Key1=Val1;Key2=Val2
            extraParams += "\nfilters=serialnumber=" + certSerial;
        }

        console.log("Invocando AutoFirma (Implicit). Filtro serial:", certSerial || "ninguno");

        try {
            // 1. Verificar si AutoScript está disponible (Cargado en la vista)
            if (typeof AutoScript !== 'undefined') {
                AutoScript.sign(dataB64, algorithm, format, extraParams, callbackSuccess, callbackError);
                return;
            }

            // 2. Si no hay AutoScript (fallback o error de carga)
            console.warn("AutoScript.js no detectado. Reintentando con aviso al usuario.");

            const msg = "Para realizar la firma real, es necesario tener instalada la aplicación AutoFirma.\n\n" +
                "No se ha detectado el componente oficial de integración.\n" +
                "¿Desea intentar una SIMULACIÓN de firma para pruebas de desarrollo?";

            if (confirm(msg)) {
                setTimeout(() => {
                    const fakeSignature = "SIM_SIG_" + btoa(Date.now().toString());
                    callbackSuccess(fakeSignature);
                }, 1500);
            } else {
                callbackError("Falta componente AutoScript.js.");
            }
        } catch (e) {
            console.error("Excepción al llamar a AutoScript:", e);
            callbackError(e.message);
        }
    }
};

document.addEventListener('DOMContentLoaded', function () {
    // Inicializar el componente oficial si está disponible
    if (typeof AutoScript !== 'undefined') {
        try {
            console.log("Inicializando componente oficial AutoScript...");
            AutoScript.cargarAppAfirma();
        } catch (e) {
            console.error("Error al inicializar AutoScript:", e);
        }
    }

    const btnSign = document.getElementById('btn-sign');
    const form = document.getElementById('form-signature');
    const inputSignature = document.getElementById('input-signature');

    if (btnSign) {
        btnSign.addEventListener('click', function () {
            const dataToSign = btnSign.dataset.content; // Base64
            const certSerial = btnSign.dataset.certSerial;

            btnSign.disabled = true;
            btnSign.innerText = "Abriendo AutoFirma...";

            AutoFirmaClient.sign(dataToSign, certSerial, function (signature) {
                // Success
                console.log("Firma recibida exitosamente");
                inputSignature.value = signature;
                form.submit();
            }, function (error) {
                // Error
                alert("Error al firmar: " + error);
                btnSign.disabled = false;
                btnSign.innerText = "Firmar Documento";
            });
        });
    }
});
