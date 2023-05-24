<?php

function crearFormulario($accion)
{
    print "<form method='POST' action='logear.php'>";
    print "<input type='hidden' name='accion' value='$accion'>";

    if ($accion == 'login') {
        print '<div>';
        print "<label for='emailL'>Nombre:</label>";
        print '<div class="divOjo">';
        print "<input id='nombre' autocomplete='off' type='text' name='emailL' placeholder='Noobmaster' required>";
        print '</div>';
        print '</div>';

        print '<div>';
        print '<span id="mensajeNombre">';
        print '</span>';
        print '</div>';

        print '<section>';
        print "<label for='passL'>Contraseña:</label>";
        print '<div class="divOjo">';
        
        print "<input id='contraseña' type='password' placeholder='Ejemplo12.' class='contraseñaL' name='passL' required>";
        

        print '<button type="button" id="visibleContra"><img id="ojoVisible" src="../img/ojoCerrado.png"></button>';
        print '</div>';
        print '</section>';

        print '<div>';
        print '<span id="mensajeContra">';
        print '</span>';
        print '</div>';

        print '<div>';
        print '<p>';
        print 'Recuerda que la contraseña tiene minimo 7 caracteres, 2 digitos, una mayuscula y un simbolo (. - _ , =)';
        print '</p>';
        print '</div>';
    } elseif ($accion == 'register') {
        print '<div>';
        print "<label for='nombreR'>Nombre:</label>";
        print '<div class="divOjo">';
        print "<input id='nombre' autocomplete='off' type='text' name='nombreR' placeholder='Noobmaster' required>";
        print '</div>';
        print '</div>';

        print '<span id="mensajeNombre">';
        print '</span>';

        print '<section>';
        print "<label for='passR'>Contraseña:</label>";
        print '<div class="divOjo">';
        
        print "<input id='contraseña' type='password' placeholder='Ejemplo12.' name='passR' required>";
        

        print '<button type="button" id="visibleContra"><img id="ojoVisible" src="../img/ojoCerrado.png"></button>';
        print '</div>';
        print '</section>';

        print '<section>';
        print "<label for='passR2'>Repetir Contraseña:</label>";
        print '<div class="divOjo">';
        
        print "<input type='password' id='contraseñaCopia' placeholder='Lo de arriba boludo' name='passR2' required>";

        print '<button type="button" id="visibleContraCopia"><img id="ojoVisibleCopia" src="../img/ojoCerrado.png"></button>';
        print '</div>';
        print '</section>';

        print '<span id="mensajeContra">';
        print '</span>';

        print '<div>';
        print '<p>';
        print 'La contraseña tiene que tener minimo 7 caracteres, 2 digitos, una mayuscula y un simbolo (. - _ , =)';
        print '</p>';
        print '</div>';
    }

    print "<button type='submit' id='botonEnviar' value='Enviar' disabled>Enviar</button>";
    print "</form>";

    print '<div id="ultimo">';
    if ($accion == 'register') {
        print '<p>¿Ya tienes una cuenta?</p>';
        print '<a href="?accion=login">';
        print '<button>Iniciar sesión</button>';
        print '</a>';
    } else {
        print '<p>¿No tienes cuenta?</p>';
        print '<a href="?accion=register">';
        print '<button>Registrarse</button>';
        print '</a>';
    }
    print '</div>';
}

if (isset($_GET['accion'])) {
    $accion = $_GET['accion'];
} else {
    header('Location: ../index/index.php');
}

?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='style.css'>
    <title><?php print strtoupper($accion) ?></title>
</head>

<body>
    <nav>
        <ul>
            <img src='../img/logo.jpg'>
            <a href='../index/index.php'>
                <li>INICIO</li>
            </a>
            <a href='../index/index.php#noticias'>
                <li>NOTICIAS</li>
            </a>
            <a href='../index/index.php#clasificacion'>
                <li>CLASIFICACIÓN</li>
            </a>
            <a href='../index/index.php#equipos'>
                <li>EQUIPOS</li>
            </a>
        </ul>
    </nav>
    <main>
        <?php
        if (isset($accion)) {
            if ($accion == 'login' || $accion == 'register') {
                crearFormulario($accion);
            } else {
                header('Location: ../index/index.php');
            }
        }
        ?>
    </main>
    <footer></footer>
</body>
<script src='appLog.js'></script>

</html>