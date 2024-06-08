const btnInicioSesion = document.getElementById("btnInicioSesion");
const btnRegistro = document.getElementById("btnRegistro");
const btnInicioSesionR =  document.getElementById("btnInicioSesionR");
const btnRegistroR = document.getElementById("btnresgistroR");
const formRegistro = document.querySelector(".registro");
const formInicio = document.querySelector(".inicio-sesion");

btnRegistro.addEventListener("click", e => {
    formInicio.classList.add("hide");
    formRegistro.classList.remove("hide");
});

btnInicioSesionR.addEventListener("click", e => {
    formRegistro.classList.add("hide");
    formInicio.classList.remove("hide");
});