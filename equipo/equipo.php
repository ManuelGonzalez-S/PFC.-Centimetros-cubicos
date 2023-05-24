<?php

require_once('../database.php');

$database = new Database();

$maxValorPosible = $database->getNumeroEquipos();

session_start();

if (isset($_GET['idEquipo'])) {
    $id = $_GET['idEquipo'];

    $id = intval($id);

    foreach ($maxValorPosible as $resultado) {
        $maxValorPosible = $resultado['suma'];
    }

    if ($id > $maxValorPosible || $id <= 0) {
        $id = null;
    }
}

function cogerNombreEquipo($id, $database)
{

    $nombre = $database->getTablaSegunCampoID('equipos', 'id', $id, 1);

    return $nombre;
}

function crearImagen($id, $database)
{


    $sentencia = $database->getTablaenBaseAID('equipos', $id, 1);

    foreach ($sentencia as $equipo) {

        $nombreEquipo = str_replace(' ', '', $equipo['nombre']);

        print '<img src = "../img/' . $nombreEquipo . '.jpg">';
    }
}

function crearImagenCoche($id, $database)
{

    $sentencia = $database->getTablaenBaseAID('equipos', $id, 1);

    foreach ($sentencia as $baseDatos) {

        $nombreEquipo = str_replace(' ', '', $baseDatos['nombre']);

        print '<img id="imagenCoche" src = "../img/' . $nombreEquipo . 'Coche.jpg">';
    }
}

function cogerPilotos($id, $database)
{

    $sentencia = $database->getTablaSegunCampoID('pilotos', 'Equipos_id', $id, 2);

    return $sentencia;
}

function crearImagenPiloto($id, $numero, $database)
{

    $sentencia = cogerPilotos($id, $database);

    $aux = [];

    foreach ($sentencia as $fila) {
        $aux[] = $fila;
    }


    $nombre = str_replace(' ', '', $aux[$numero]['nombre']);

    print '<img class=imgPiloto src="../img/' . $nombre . '.jpg">';
}

function crearPalmares($id, $database)
{

    $sentencia = $database->getTablaenBaseAID('equipos', $id, 1);

    foreach ($sentencia as $baseDatos) {

        print '<p>';
        print '<strong>';
        print 'Poles: ';
        print '</strong>';
        print $baseDatos['poles'];
        print '</p>';

        print '<p>';
        print '<strong>';
        print 'Podios: ';
        print '</strong>';
        print $baseDatos['podios'];
        print '</p>';

        print '<p>';
        print '<strong>';
        print 'Titulos: ';
        print '</strong>';
        print $baseDatos['titulos'];
        print '</p>';

        print '<p>';
        print '<strong>';
        print 'Victorias: ';
        print '</strong>';
        print $baseDatos['victorias'];
        print '</p>';
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="equipo.css">
    <title>Document</title>
</head>

<body>
    <nav>
        <ul>
            <li><img src="../img/logo.jpg"></li>
            <a href="../index/index.php">
                <li>INICIO</li>
            </a>
            <a href="../index/index.php#noticias">
                <li>NOTICIAS</li>
            </a>
            <a href="../index/index.php#clasificacion">
                <li>CLASIFICACIÓN</li>
            </a>
            <a href="../index/index.php#equipos">
                <li>EQUIPOS</li>
            </a>
            <a href="../login/login.html">
                <li>LOGIN</li>
            </a>
            <?php
            if (isset($_SESSION['user'])) {

                print '<li id="menuUsuario">';
                print '<button id="usuario">';
                print $_SESSION['user']['nombre'];
                print '</button>';
                print '<div>';
                print '<img id="userImg" src="../img/user.png" alt="Opciones de usuario">';
                print '</div>';
                print '<ul id="menu" class="submenu">';
                if ($_SESSION['user']['permisos'] == '1') {
                    print '<a href=../admin/admin.php>';
                    print '<button>';
                    print 'Ir a administración';
                    print '</button>';
                    print '</a>';
                }
                print '<a href=../login/logout.php>';
                print '<button>';
                print 'Cerrar sesión';
                print '</button>';
                print '</a>';
                print '</ul>';

                print '</li>';
            } else {
                print '<a href="../login/login.html
                ">
                            <li>LOGIN</li>
                        </a>';
            }
            ?>
        </ul>
    </nav>

    <main>
        <?php

        if (isset($id) && gettype($id) == "integer") {

            // Abre el id de la imagen del equipo y su titulo
            print '<div id="imagen">';

            $nombreEquipo = cogerNombreEquipo($id, $database);

            // Muestra el nombre del equipo
            print '<h1>';
            foreach ($nombreEquipo as $nombre) {
                print $nombre['nombre'];
            }
            print '</h1>';

            // Muestra el logo del equipo
            crearImagen($id, $database);

            print '</div>';

            // Muestra un titulo que da información acerca del coche
            print '<h2>';
            print 'Acerca del coche:';
            print '</h2>';

            print '<div id="contenido">';

            // Muestra la imagen del coche
            print '<div id="coche">';
            crearImagenCoche($id, $database);
            print '</div>';


            print '<div id="info">';

            print '<div id="infoPrincipal">';

            print '<div id="infoCoche">';

            // Muestra la imagen del coche con un bucle
            $coche = $database->getTablaSegunCampoID('coches', 'Equipos_id', $id, 1);

            foreach ($coche as $campo) {

                print '<h3>' . 'Información del coche:' . '</h3>';

                print '<p>';
                print '<strong>';
                print 'Nombre: ';
                print '</strong>';
                print $campo['nombre'];
                print '</p>';

                print '<p>';
                print '<strong>';
                print 'Modelo: ';
                print '</strong>';
                print $campo['Modelo'];
                print '</p>';

                print '<p>';
                print '<strong>';
                print 'Motor: ';
                print '</strong>';
                print $campo['Motor'];
                print '</p>';
            }

            // Cierra el div de la informacion del coche
            print '</div>';

            print '<div id="infoPatrocinadores">';

            print '<h3>' . 'Patrocinadores:' . '</h3>';

            // Seccion de los patrocinadores
            print '<div id=patrocinadores>';
            $patrocinadores = $database->getTablaSegunCampoID('patrocinadores', 'Equipos_id', $id, 20);

            // Muestra la información de los patrocinadores
            foreach ($patrocinadores as $patrocinador) {
                print '<p>';
                print $patrocinador['nombre'];
                print '</p>';
            }

            // Cierra el div de los patrocinadores
            print '</div>';

            // Cierra el div que contiene a los patrocinadores y el titulo
            print '</div>';

            // Cierra el div con la informacion principal
            print '</div>';

            // Abre el div que contiene el palmarés del equipo
            print '<div id="palmares">';

            // Muestra el titulo
            print '<h2>';
            print 'Palmarés del equipo:';
            print '</h2>';

            // Crea un div con el palmarés del equipo
            print '<div>';
            crearPalmares($id, $database);
            print '</div>';

            // Cierra el div del palmares
            print '</div>';

            // Cierra el div con la informacion del equipo
            print '</div>';

            // Cierra el div con id contenido
            print '</div>';

            // Crea el div que va a contener a los pilotos
            print '<div id="acercaPilotos">';

            // Crea un titulo
            print '<h2>';
            print 'Estadisticas de los pilotos:';
            print '</h2>';

            // Crea un div con la informacion de los pilotos
            print '<div id="infoPilotos">';

            // Muestra los pilotos
            $pilotos = cogerPilotos($id, $database);

            // Crea un div con los pilotos
            print '<div id="pilotos">';

            $contador = 0;

            // Crea un div para cada piloto
            foreach ($pilotos as $piloto) {

                print '<div class="piloto">';

                print '<div>';
                print '<p class=nombrePiloto>' . $piloto['nombre'] . ':</p>';

                print '<p>';
                print '<strong>';
                print 'Puntos: ';
                print '</strong>';
                print $piloto['Puntos'];
                print '</p>';

                print '<p>';
                print '<strong>';
                print 'Dorsal: ';
                print '</strong>';
                print $piloto['Dorsal'];
                print '</p>';

                print '<p>';
                print '<strong>';
                print 'Nacionalidad: ';
                print '</strong>';
                print $piloto['nacionalidad'];
                print '</p>';

                print '</div>';

                crearImagenPiloto($id, $contador, $database);
                $contador++;

                print '</div>';
            }

            // Cierra el div que contiene a los pilotos
            print '</div>';

            // Cierra el div que contiene la info de los pilotos
            print '</div>';

            // Cierra el div acerca de los pilotos
            print '</div>';
        } else {

            // Si el id no es válido (obtenido de la url, se muestra un mensaje de error
            print '<h1 class=tituloError>';
            print 'No se puede cargar la página';
            print '</h1>';
            print '<h2 class=tituloError>';
            print 'Porfavor vuelva a la pagina anterior y seleccione de nuevo el equipo que desea ver';
            print '</h2>';
        }

        ?>

    </main>

    <footer>
        <div id="rrss">
            <h3>Redes Sociales</h3>
            <img src="../img/instagram.jpg">
            <img src="../img/twitter.jpg">
            <img src="../img/facebook.jpg">
        </div>
        <div id="proteccion">
            <h3>Protección de datos</h3>
            <p>
                <a href="https://ayudaleyprotecciondatos.es/modelo-politica-cookies/" target="_blank">Politica de cookies</a>
            </p>
            <p>
                <a href="https://www.fia.com/data-privacy-notice" target="_blank">Politica de privacidad</a>
            </p>
            <p>
                <a href="https://www.fia.com/es/aviso-de-proteccion-de-datos" target="_blank">Aviso legal</a>
            </p>
        </div>
        <div id="contacto">
            <h3>Contacto</h3>
            <p>ejemplo@gmail.com</p>
            <p>tel: 913 64 51 57</p>
        </div>
        <div id="copyright">
            <p>© Copyright 2023</p>
        </div>
    </footer>
</body>
<script src="app.js"></script>
</html>