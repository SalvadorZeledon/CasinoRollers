document.addEventListener("DOMContentLoaded", () => {
    const formLogin = document.querySelector("#formInicioSesion");
    const inputEmail = document.querySelector('#formInicioSesion input[name="email"]');
    const inputPassword = document.querySelector('#formInicioSesion input[name="password"]');
    const checkboxTerms = document.getElementById('terms');
    const btnInicioSesion = document.querySelector("#btnInicioSesion");
    const alertaError = document.querySelector("#formInicioSesion .alerta-error");
    const alertaExito = document.querySelector("#formInicioSesion .alerta-exito");
  
    const emailRegex = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
    const passwordRegex = /^.{4,12}$/;
  
    let estadoValidacionCampos = {
      email: false,
      password: false,
      terms: false
    };
  
    formLogin.addEventListener("submit", (e) => {
      e.preventDefault();
      enviarFormulario();
    });
  
    inputEmail.addEventListener("input", () => {
      validarCampo(emailRegex, inputEmail, "Por favor, introduce un correo electrónico válido.");
    });
  
    inputPassword.addEventListener("input", () => {
      validarCampo(passwordRegex, inputPassword, "La contraseña debe tener entre 4 y 12 caracteres.");
    });
  
    checkboxTerms.addEventListener("change", () => {
      estadoValidacionCampos.terms = checkboxTerms.checked;
      validarFormulario();
    });
  
    function validarCampo(regularExpresion, campo, mensaje) {
      const esValido = regularExpresion.test(campo.value);
      if (esValido) {
        eliminarAlerta(campo.parentElement.parentElement);
        estadoValidacionCampos[campo.name] = true;
        campo.parentElement.classList.remove("error");
      } else {
        estadoValidacionCampos[campo.name] = false;
        campo.parentElement.classList.add("error");
        mostrarAlerta(campo.parentElement.parentElement, mensaje);
      }
      validarFormulario();
    }
  
    function mostrarAlerta(referencia, mensaje) {
      eliminarAlerta(referencia);
      const alertaDiv = document.createElement("div");
      alertaDiv.classList.add("alerta");
      alertaDiv.textContent = mensaje;
      referencia.appendChild(alertaDiv);
    }
  
    function eliminarAlerta(referencia) {
      const alerta = referencia.querySelector(".alerta");
      if (alerta) alerta.remove();
    }
  
    function validarFormulario() {
      const camposValidos = Object.values(estadoValidacionCampos).every(value => value === true);
  
      if (camposValidos && estadoValidacionCampos.terms) {
        alertaError.classList.remove("alertaError");
        btnInicioSesion.disabled = false; // Habilitar el botón de inicio de sesión
      } else {
        alertaError.textContent = "Por favor, completa todos los campos y acepta los términos y condiciones.";
        alertaError.classList.add("alertaError");
        btnInicioSesion.disabled = true; // Deshabilitar el botón de inicio de sesión
      }
    }
  
    function enviarFormulario() {
      const camposNoVacios = [inputEmail, inputPassword];
  
      const camposValidos = camposNoVacios.every(campo => campo.value.trim() !== "");
  
      if (camposValidos && estadoValidacionCampos.terms) {
        // Aquí puedes realizar la lógica para enviar el formulario
        formLogin.reset();
        alertaExito.textContent = "¡Inicio de sesión exitoso!";
        alertaExito.classList.add("alertaExito");
        setTimeout(() => {
          alertaExito.classList.remove("alertaExito");
        }, 3000);
      } else {
        alertaExito.classList.remove("alertaExito");
        alertaError.textContent = "Por favor, completa todos los campos y acepta los términos y condiciones.";
        alertaError.classList.add("alertaError");
        setTimeout(() => {
          alertaError.classList.remove("alertaError");
        }, 3000);
      }
    }
  });
 