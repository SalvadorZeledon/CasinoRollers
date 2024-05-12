const btnInicioSesion = document.getElementById("btnInicioSesion");
const btnRegistro = document.getElementById("btnRegistro");
const btnInicioSesionR =  document.getElementById("btnInicioSesionR");
const btnRegistroR = document.getElementById("btnresgistroR");
const formRegistro = document.querySelector(".registro");
const formInicio = document.querySelector(".inicio-sesion");

document.addEventListener("DOMContentLoaded", function() {
    // Obtenemos una referencia al botón
    var botonRedireccionar = document.getElementById("botonRedireccionar");
    
    // Agregamos un evento clic al botón
    botonRedireccionar.addEventListener("click", function() {
        // Redireccionamos al usuario a otro archivo HTML
        window.location.href = "/CasinoRollers/Index.html";
    });
});

btnRegistro.addEventListener("click", e => {
    formInicio.classList.add("invisible");
    formRegistro.classList.remove("invisible");
});

btnInicioSesionR.addEventListener("click", e => {
    formRegistro.classList.add("invisible");
    formInicio.classList.remove("invisible");
});
