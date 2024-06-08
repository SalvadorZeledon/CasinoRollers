
<?php 

// Iniciar sesión
session_start();

// Verificar si el usuario ha iniciado sesin
if (!isset($_SESSION["user"])) {

    // Si el usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesin
    echo '
        <script> 
            alert("Porfavor debes iniciar sesion");
        </script>
    ';
    header("Location: /CasinoRollers/Index.php");
    session_destroy();
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rollers Casino Catalogo:</title>
    <link rel="stylesheet" href="/View/CSS/Style_Index/styleindex.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link rel="icon" href="/View/CSS/img/LogoRollersCasinoICO.ico">
    <link rel="stylesheet" href="/View/prueba.css">
</head>
<body>
    <header class="header">
            <nav class="navbar">
                <img src="/View/CSS/img/EsteBANNERbLACK.png" alt="Logo CR" class="logo">

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
                    <li class="li_links"><a href="mailto:tecnicalsupport@rollerscasinosv.com" class="link">Soporte</a></li>
                    <li class="li_links"><a href="Ranking.php" class="link">Ranking</a></li>
                    <li class="li_links"><a href="cerrarsesion.php" class="link">Cerrar Sesión</a></li>
                </ul>
            </nav>
        </header>
    
    <div class="NombreCasino">
        <h1>CATALOGO DE JUEGOS</h1>
    </div>
    
    <main>
        
        <section class="game">
            <div class="img1">
                <img src="/View/CSS/img/BannerParoImparUNOF.png" alt="Dados par o impar">
            </div>
            <h2>Par o Impar</h2>
            
            <p>¡Adivina si la suma de los dados será par o impar y gana grandes premios!</p>
            <a href="/Model/DadosParoImar.php">Jugar ahora</a>
        </section>
        
        <section class="game">
            <div class="img2">
                <img src="/View/CSS/img/BannerCasinoNumGrandeUF.png" alt="Dados par o impar">
            </div>
            <h2>Número más Grande</h2>
            <p>Intenta adivinar cuál será el número más grande y gana emocionantes premios.</p>
            <a href="/Model/NumeroMasGrande.php">Jugar ahora</a>
        </section>
    </main>

   
</body>

<footer class="footer-distributed">

    <div class="footer-left">
        <h3>Rollers<span>Casino</span></h3>

        <p class="footer-links">
            <a href="#">Home</a>
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
            <strong>RollersCasino</strong> es una marca dedicada a la creacion de software y tecnologías web.
            Esta plataforma fue desarrolla en referencia a la Ley Organica de la LNB, para más información lease los
        <a href="terminosycondiciones.html"><strong>Términos y Condiciones.</strong></a>
        </p>
        
    </div>
</footer>


</html>