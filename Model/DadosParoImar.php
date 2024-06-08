<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["resultado"])) {
    // Procesar los datos aquí (sin mostrar nada en la salida)
    if (isset($_SESSION["userId"])) {
        $userId = $_SESSION["userId"];
        $resultado = $_POST["resultado"];

        // Preparar y ejecutar la llamada al procedimiento almacenado para actualizar el progreso del usuario
        require_once "../controler/conexion.php";
        $stmt = $conn->prepare("CALL ActualizarProgreso(?, ?)");
        $stmt->bind_param("is", $userId, $resultado);
        $stmt->execute();

        // Consultar el nuevo valor de fichas desde la base de datos
        $stmt = $conn->prepare("SELECT fichas FROM user WHERE ID = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->bind_result($fichas);
        $stmt->fetch();
        $stmt->close();

        // Devolver una respuesta JSON con los datos que necesitas mostrar después
        echo json_encode(array("fichas" => $fichas));
        $conn->close();
        exit; // Terminar la ejecución del script PHP después de enviar la respuesta JSON
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego de Dados</title>
    <link rel="stylesheet" href="../View/CSS/DadosParoImpar.css">
    <link rel="stylesheet" href="../View/CSS/monedas.css">
    <link rel="stylesheet" href="../View/prueba.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" href="../View/CSS/img/LogoRollersCasinoICO.ico">
</head>
<body>
    <header class="header">
        <nav class="navbar">
            <a href="principal.php">
                <img src="../View/CSS/img/EsteBANNERbLACK.png" alt="Logo CR" class="logo">
            </a>

            <label class="labe_hamburguesa" for="menu_hamburguesa">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="35"
                    height="35"
                    fill="currentColor"
                    class="list_icon"
                    viewBox="0 0 16 16"
                >
                    <path
                        fill-rule="evenodd"
                        d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"
                    />
                </svg>
            </label>

            <input class="menu_hamburguesa" type="checkbox" name="" id="menu_hamburguesa">

            <ul class="ul_links">
                <li class="li_links"><a href="principal.php" class="link">Home</a></li>
                <li class="li_links"><a href="mailto:tecnicalsupport@rollerscasinosv.com" class="link">Soporte</a></li>
                <li class="li_links"><a href="Ranking.php" class="link">Ranking</a></li>
                <li class="li_links"><a href="cerrarsesion.php" class="link">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function obtenerFichas() {
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "../Controler/getFichas.php", true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var response = JSON.parse(xhr.responseText);
                            document.getElementById('fichas').textContent = response.fichas;
                            document.getElementById('nombreUsuario').textContent = response.nombre;
                        } else {
                            console.error("Error al obtener las fichas.");
                        }
                    }
                };
                xhr.send();
            }

            obtenerFichas();
            setInterval(obtenerFichas, 1000);
        });
    </script>
    
    <div class="monedas-container">
        <img class="moneda-img" src="../View/CSS/img/Moneda.png" alt="Moneda">
        <p><span id="nombreUsuario"><?php echo $_SESSION['user']; ?></span> | Fichas disponibles: <span id="fichas"><?php echo $_SESSION['fichas']; ?></span></p>
    </div>
    <!-- El resto del código sigue igual -->
</body>
</html>

<div class="container">
    <h1>¿Par<span> Oh</span> Impar?</h1>
    <div class="indicaciones">
        <h2>Indicaciones: </h2>
        <p> Predice si la suma de dos dados será par o impar antes de lanzarlos. Asegrate de tener al menos 1 moneda virtual para participar, ya que cada partida cuesta una moneda. ¿Tienes lo que se necesita para acertar? ¡Elige tu opción y presiona "Lanzar Dados"! </p>
    </div>

    <div class="opciones">
        <label>
            <input type="radio" name="choice" value="par"> Par
        </label>
        <label>
            <input type="radio" name="choice" value="impar"> Impar
        </label>
    </div>
    

    <div class="container-img">
        <div class="player">
            <div class="dice" id="dado1"><img class="img1" src="../View/CSS/img/dado3.png" alt=""></div>
        </div>
        <div class="player">
            <div class="dice" id="dado3"><img class="img2" src="../View/CSS/img/dado5.png" alt=""></div>
        </div>


    </div>
    
    <div id="result"></div>
    <div id="mensaje"></div>
    <div id="mensaje2"></div>
    <button onclick="rollDice()">Tirar</button>

    <form id="progresoForm" action="" method="post">
        <input type="hidden" id="resultadoInput" name="resultado" value="">
    </form>
</div>

<script>
function rollDice() {
    verificarFichas(function(fichas) {
        if (fichas > 0) {
            // Primero validamos que se seleccione una opción "par o impar"
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
                // Con este mostramos los resultados de los dados después de generar la animación.
                document.querySelector(".img1").setAttribute("src", "../View/CSS/img/dado" + dado1 + ".png");
                document.querySelector(".img2").setAttribute("src", "../View/CSS/img/dado" + dado2 + ".png");
                resutlados(bet, total);
            });

            const Par = total % 2 === 0;
            if ((bet === "par" && Par) || (bet === "impar" && !Par)) {
                let resultado = 'ganados';
                enviarResultado(resultado);
            } else {
                let resultado = 'perdidos';
                enviarResultado(resultado);
            }
        } else {
            alert("No tienes suficientes fichas para jugar.");
        }
    });
}

function verificarFichas(callback) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../Controler/validarFichas.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                callback(response.fichas);
            } else {
                console.error("Error al verificar las fichas del usuario");
                callback(0);
            }
        }
    };
    xhr.send();
}

document.addEventListener('DOMContentLoaded', function() {
    verificarFichas(function(fichas) {
        document.getElementById('fichas-valor').textContent = fichas;
    });
});

function enviarResultado(resultado) {
    console.log("Enviando resultado:", resultado);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../Controler/actprogreso.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                // Supongamos que el nuevo valor de fichas viene en la respuesta
                if (response.fichas !== undefined) {
                    actualizarFichas(response.fichas);
                }
            } else {
                console.error("Error al enviar los datos al servidor");
            }
        }
    };
    xhr.send("resultado=" + resultado);
}

function actualizarFichas(fichas) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../Controler/updateFichas.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    console.log("Fichas actualizadas correctamente.");
                } else {
                    console.error("Error al actualizar las fichas:", response.message);
                }
            }
        }
    };
    xhr.send("fichas=" + fichas);
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
            const imageUrl = `../View/CSS/img/dado${currentImageIndex}.png`; // Ruta de la imagen correspondiente al valor actual del dado
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

</script>
<footer class="footer-distributed">

    <div class="footer-left">
        <h3>Rollers<span>Casino</span></h3>

        <p class="footer-links">
            <a href="principal.php">Home</a>
        </p>

        <p class="footer-company-name">Copyright © 2024 <strong>RollersCasino</strong> Todos los derechos reservados</p>
    </div>

    <div class="footer-center">
        <div>
            
            <p><span>Dirección:</span>
                Universidad de Sonsonate</p>
        </div>

        <div>
            <br>
            <p><span>Dirección de contacto:</span>
            
            <p><a href="mailto:tecnicalsupport@rollerscasinosv.com">tecnicalsupport@rollerscasinosv.com</a></p>
        </div>
    </div>
    <div class="footer-right">
        <p class="footer-company-about">
            <span>Acerca de la compañia</span>
            <strong>RollersCasino</strong> es una marca dedicada a la creacion de software y tecnologas web.
            Esta plataforma fue desarrolla en referencia a la Ley Organica de la LNB, para más informacin lease los
        <a href="terminosycondiciones.html"><strong>Términos y Condiciones.</strong></a>
        </p>
        
    </div>
</footer>

</body>
</html>