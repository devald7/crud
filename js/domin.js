document.addEventListener("DOMContentLoaded", function () {
    var inputCorreo = document.getElementsByName("txtEmail")[0];

    inputCorreo.addEventListener("input", function () {
        var correo = inputCorreo.value;
        var dominioPermitido = "@unapiquitos.edu.pe";

        if (correo.endsWith(dominioPermitido)) {
            // El correo es válido
            inputCorreo.setCustomValidity(""); // Restablece la validación personalizada
        } else {
            // El correo no es válido
            inputCorreo.setCustomValidity("No se puede usar ese nombre de dominio.");
        }
    });
});