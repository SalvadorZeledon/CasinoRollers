function rollDice() {
    //primero validamos que se seleccione una opcion "par o impar"
    const choice = document.querySelector('input[name="choice"]:checked');
    if (!choice) {
        alert("Por favor, selecciona Par o Impar.");
        return;
    }

    const bet = choice.value;
    const dado1 = Math.floor(Math.random() * 6) + 1;
    const dado2 = Math.floor(Math.random() * 6) + 1;
    const total = dado1 + dado2;

    lanzamientoDeDados(dado1, dado2, function() {
        //con este mostramos los resultados de los dados despues de generar la animacion.
        document.querySelector(".img1").setAttribute("src","/CasinoRollers/view/CSS/img/dado" + dado1 + ".png");
        document.querySelector(".img2").setAttribute("src","/CasinoRollers/view/CSS/img/dado" + dado2 + ".png");
    });

    resutlados(bet, total);

}

//Funcion que genera la animacion de los dados
function lanzamientoDeDados(dado1, dado2, callback) {
    const diceElements = document.querySelectorAll('.dice'); // Obtener elementos de los dados
    const numImages = 6; // Número de imágenes de dados disponibles
    const duration = 500; // Duración total de la animación en milisegundos
    const interval = 50; // Intervalo de tiempo entre cambios en milisegundos

    let finishedAnimations = 0; // Contador para el número de animaciones terminadas

    diceElements.forEach(dice => {
        const initialImageIndex = Math.floor(Math.random() * numImages) + 1; // Valor inicial aleatorio del dado
            let currentImageIndex = initialImageIndex;
        let tiempoTranscurrido = 0;
    
        const animacion = setInterval(() => {
            currentImageIndex = (currentImageIndex % numImages) + 1; // Avanza al siguiente valor del dado
            const imageUrl = `/CasinoRollers/view/CSS/img/dado${currentImageIndex}.png`; // Ruta de la imagen correspondiente al valor actual del dado
            dice.querySelector('img').setAttribute('src', imageUrl); // Cambiar la imagen y mostrarla en el HTML
    
            tiempoTranscurrido += interval;
    
            if (tiempoTranscurrido >= duration) {
            clearInterval(animacion);
            finishedAnimations++;
    
            if (finishedAnimations === diceElements.length) {
                // Todas las animaciones han terminado, llamar a la función de devolución de llamada
                callback();
            }
            }
        }, interval); 
    });
}


//funcion que calcula el ganador y muestra los resultados
function resutlados(bet, total){
    const isPar = total % 2 === 0;
    let resultado;
    if ((bet === "par" && isPar) || (bet === "impar" && !isPar)) {
        resultado = "¡Ganaste!";
    } else {
        resultado = "¡Perdiste!";
    }

    const resultDiv = document.getElementById("result");
    resultDiv.textContent = `Resultado: Los dados suman ${total}. ${resultado}`;

}