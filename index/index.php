<?php

require_once('../database.php');

$database = new Database();

session_start();

function crearNoticia($titulo, $descripcion, $rutaImagen)
{

    print '<div class= "noticia">';
    print '<img src= "../img/' . $rutaImagen . '">';

    print '<div class="info">';
    print "<h2>$titulo</h2>";
    print "<p>$descripcion</p>";
    print '</div>';


    print '</div>';
}

function obtenerNoticiasAleatorias($conexion)
{

    // Obtener las noticias que tienen el campo "mostrar" con valor 1
    $consultaNoticias = "SELECT * FROM noticias";
    $resultadoNoticias = $conexion->ejecutarSql($consultaNoticias);
    $noticiasDisponibles = $resultadoNoticias->fetchAll(PDO::FETCH_ASSOC);

    // Obtener el número total de noticias disponibles
    $totalNoticias = count($noticiasDisponibles);

    // Obtener tres números aleatorios distintos
    $numerosAleatorios = array();
    while (count($numerosAleatorios) < 3) {
        $numeroAleatorio = rand(0, $totalNoticias - 1);
        if (!in_array($numeroAleatorio, $numerosAleatorios)) {
            $numerosAleatorios[] = $numeroAleatorio;
        }
    }

    // Obtener las noticias aleatorias seleccionadas
    $noticiasAleatorias = array();
    foreach ($numerosAleatorios as $numero) {
        $noticiasAleatorias[] = $noticiasDisponibles[$numero];
    }

    // Cerrar la conexión
    $conexion = null;

    // Devolver el array de noticias aleatorias
    return $noticiasAleatorias;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Centimetros Cúbicos</title>
</head>

<body>
    <nav>
        <ul>
            <li><img src="../img/logo.jpg"></li>
            <a href="#">
                <li>INICIO</li>
            </a>
            <a href="#noticias">
                <li>NOTICIAS</li>
            </a>
            <a href="#cambiarClasificacion">
                <li>CLASIFICACIÓN</li>
            </a>
            <a href="#equipos">
                <li>EQUIPOS</li>
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
                print '<a href="../login/login.php?accion=login
                ">
                            <li>LOGIN</li>
                        </a>';
            }
            ?>

        </ul>
    </nav>
    <main>
        <section id="noticias">
            <?php

            $noticiasAleatorias = obtenerNoticiasAleatorias($database);

            foreach ($noticiasAleatorias as $noticia) {


                crearNoticia($noticia['titulo'], $noticia['descripcion'], '../' . $noticia['rutaImagen']);
            }

            ?>
        </section>
        <section id="clasificacion">
            <button id="cambiarClasificacion" onclick="cambiarClasificacion()">Mostrar clasificación de equipos</button>
            <?php

            // Genera la tabla de clasificacion
            $resultados = $database->getPilotosEquipos();

            $titulos = ['Clasificación', 'Puntos', 'Piloto', 'Nacionalidad', 'Equipo'];

            print '<table id="tablaClasificacionPilotos">';
            print '<thead>';
            print '<tr>';
            for ($i = 0; $i < sizeof($titulos); $i++) {
                print '<th>';
                print $titulos[$i];
                print '</th>';
            }
            print '</tr>';
            print '</thead>';

            $campos = ['Puntos', 'nombre', 'nacionalidad', 'nombreEquipo'];

            print '<tbody>';

            $contador = 1;

            // Genera cada fila
            foreach ($resultados as $piloto) {
                print '<tr>';

                print '<td>';
                print $contador;
                print '</td>';

                // Genera cada elemento de la fila
                for ($i = 0; $i < sizeof($campos); $i++) {
                    print '<td>';

                    print $piloto[$campos[$i]];

                    print '</td>';
                }
                print '</tr>';

                $contador++;
            }

            print '</tbody>';

            print '</table>';

            $resultados = $database->getEquiposClasi();

            $titulos = ['Clasificación', 'Nombre', 'Puntos', 'Podios', 'Poles', 'Victorias', 'Titulos'];

            $campos = ['nombre', 'Puntos', 'podios', 'poles', 'victorias', 'titulos'];

            print '<table id= tablaClasificacionEquipos>';

            print '<thead>';
            print '<tr>';
            for ($i = 0; $i < sizeof($titulos); $i++) {
                print '<th>';
                print $titulos[$i];
                print '</th>';
            }

            print '</tr>';
            print '</thead>';

            print '<tbody>';

            $contador = 1;

            foreach ($resultados as $equipo) {

                print '<tr>';

                print '<td>';
                print $contador;
                print '</td>';

                for ($i = 0; $i < sizeof($campos); $i++) {
                    print '<td>';
                    print $equipo[$campos[$i]];
                    print '</td>';
                }

                $contador++;

                print '</tr>';
            }

            print '</tbody>';

            print '</table>';

            ?>
        </section>

        <section id="equipos">
            <?php

            $resultados = $database->getTabla('equipos');

            foreach ($resultados as $baseDatos) {

                $nombreEquipo = str_replace(' ', '', $baseDatos['nombre']);
                print '<div id =' . $nombreEquipo . '>';

                print '<a class=infoEquipos href= "../equipo/equipo.php?idEquipo=' . $baseDatos['id'] . '">';
                print $baseDatos['nombre'];
                print '</a>';

                print '</div>';
            }

            ?>
        </section>
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