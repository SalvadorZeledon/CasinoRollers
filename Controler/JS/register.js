document.addEventListener("DOMContentLoaded", () => {
    const formRegister = document.querySelector(".form-register");
    const inputUser = document.querySelector('.form-register input[name="userName"]');
    const inputEdad = document.querySelector('.form-register input[name="edad"]');
    const inputPass = document.querySelector('.form-register input[name="password2"]');
    const inputEmail = document.querySelector('.form-register input[name="email2"]');
    const alertaError = document.querySelector(".form-register .alerta-error");
    const alertaExito = document.querySelector(".form-register .alerta-exito");
  
    const userNameRegex = /^[a-zA-Z0-9\_\-]{4,16}$/;
    const emailRegex = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
    const passwordRegex = /^.{4,12}$/;
    const edadnumber = /^(1[89]|[2-9]\d)$/; // Números entre 18 y 99
  
    const estadoValidacionCampos = {
      userName: false,
      email2: false,
      password2: false,
      edad: false,
    };
  
    formRegister.addEventListener("submit", (e) => {
      e.preventDefault();
      enviarFormulario();
    });
  
    inputUser.addEventListener("input", () => {
      validarCampo(userNameRegex, inputUser, "El usuario tiene que ser de 4 a 16 dígitos y solo puede contener letras, números, guiones y guión bajo.");
    });
  
    inputEmail.addEventListener("input", () => {
      validarCampo(emailRegex, inputEmail, "El correo solo puede contener letras, números, puntos, guiones y guión bajo.");
    });
  
    inputPass.addEventListener("input", () => {
      validarCampo(passwordRegex, inputPass, "La contraseña tiene que ser de 4 a 12 dígitos.");
    });
  
    inputEdad.addEventListener("input", () => {
      validarCampo(edadnumber, inputEdad, "Tienes que ser mayor de 18 años.");
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
  
    function enviarFormulario() {
      const campos = [inputUser, inputEdad, inputPass, inputEmail];
      let camposValidos = true;
  
      campos.forEach((campo) => {
        if (!campo.value.trim() || !estadoValidacionCampos[campo.name]) {
          camposValidos = false;
          campo.parentElement.classList.add("error");
        }
      });
  
      if (camposValidos) {
        formRegister.reset();
        alertaExito.textContent = "Te registraste correctamente";
        alertaExito.classList.add("alertaExito");
        alertaError.classList.remove("alertaError");
        setTimeout(() => {
          alertaExito.classList.remove("alertaExito");
        }, 3000);
      } else {
        alertaExito.classList.remove("alertaExito");
        alertaError.textContent = "El usuario no pudo ser registrado: Datos incompletos";
        alertaError.classList.add("alertaError");
        setTimeout(() => {
          alertaError.classList.remove("alertaError");
        }, 3000);
      }
    }
  });