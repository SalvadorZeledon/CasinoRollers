
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tabla de Posiciones</title>
  <link rel="icon" href="../View/CSS/img/LogoRollersCasinoICO.ico">
  <link rel="stylesheet" href="../View/RankingStyle.css">
</head>
<head>
  <title>Tabla de Posiciones</title>

</head>
<body>
<header class="header">
    <nav class="navbar">
    <a href="principal.php">
                <img src="../View/CSS/img/EsteBANNERbLACK.png" alt="Logo CR" class="logo">
            </a href="">

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
<div class="table-container">
    <h2>Tabla de Posiciones</h2>
    <table>
        <tr>
            <th>Top</th>
            <th>Nombre</th>
            <th class="hide-on-mobile">Fichas</th>
            <th class="hide-on-mobile">Juegos Ganados</th>
            <th class="hide-on-mobile">Juegos Perdidos</th>
            <th class="hide-on-mobile">Empate</th>
            <th>Puntaje</th>
        </tr>
        <?php include '../Controler/top.php'; ?>
    </table>
</div>

</body>
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
            <strong>RollersCasino</strong> es una marca dedicada a la creacion de software y tecnologías web.
            Esta plataforma fue desarrolla en referencia a la Ley Organica de la LNB, para más información lease los
        <a href="terminosycondiciones.html"><strong>Términos y Condiciones.</strong></a>
        </p>
        
    </div>
</footer>
</html>

