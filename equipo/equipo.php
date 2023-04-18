<?php

$id = $_GET['idEquipo'];
$nombreEquipo = $_GET['nombreEquipo'];

function conexion()
{
    $conexion = new mysqli('localhost', 'root', '', 'centimetroscubicos');
    $conexion->set_charset("utf8");

    return $conexion;
}

function getEquipos($id)
{

    $conexion = conexion();

    $sql = 'SELECT * FROM equipos where id = ' . $id;

    return $conexion->query($sql);
}

function getCoche($id)
{
    $conexion = conexion();

    $sql = 'SELECT * FROM coches WHERE equipos_id = ' . $id . ' limit 1;';

    return $conexion->query($sql);
}

function getPilotos($id)
{
    $conexion = conexion();

    $sql = 'SELECT * FROM pilotos WHERE equipos_id = ' . $id;

    return $conexion->query($sql);
}

function getPatrocinadores($id)
{
    $conexion = conexion();

    $sql = 'SELECT * FROM patrocinadores WHERE equipos_id =' . $id;

    return $conexion->query($sql);
}

function crearImagen($id)
{

    $baseDatos = conexion();

    $query = 'SELECT * FROM equipos where id = ' . $id;

    $sentencia = $baseDatos->query($query);

    while ($baseDatos = $sentencia->fetch_assoc()) {

        $nombreEquipo = str_replace(' ', '', $baseDatos['nombre']);

        print('<img src = "../img/' . $nombreEquipo . '.jpg">');
    }
}

function crearImagenCoche($id)
{
    $baseDatos = conexion();

    $query = 'SELECT * FROM equipos WHERE id =' . $id;

    $sentencia = $baseDatos->query($query);

    while ($baseDatos = $sentencia->fetch_assoc()) {

        $nombreEquipo = str_replace(' ', '', $baseDatos['nombre']);

        print('<img id="imagenCoche" src = "../img/' . $nombreEquipo . 'Coche.jpg">');
    }
}

function cogerPilotos($id)
{

    $baseDatos = conexion();

    $query = 'SELECT * FROM pilotos WHERE Equipos_id =' . $id;

    $sentencia = $baseDatos->query($query);

    return $sentencia;
}

function crearImagenPiloto($id, $numero)
{

    $sentencia = cogerPilotos($id);

    $aux = [];

    while ($fila = mysqli_fetch_assoc($sentencia)) {
        $aux[] = $fila;
    }


    $nombre = str_replace(' ', '', $aux[$numero]['Nombre']);

    print('<img class=imgPiloto src="../img/' . $nombre . '.jpg">');
}

function crearPalmares($id){

    $baseDatos = conexion();

    $query = 'SELECT * FROM equipos WHERE id =' . $id;

    $sentencia = $baseDatos->query($query);

    while ($baseDatos = $sentencia->fetch_assoc()){

        print('<p>');
        print('<strong>');
        print('Poles: ');
        print('</strong>');
        print($baseDatos['poles']);
        print('</p>');

        print('<p>');
        print('<strong>');
        print('Podios: ');
        print('</strong>');
        print($baseDatos['podios']);
        print('</p>');

        print('<p>');
        print('<strong>');
        print('Titulos: ');
        print('</strong>');
        print($baseDatos['titulos']);
        print('</p>');

        print('<p>');
        print('<strong>');
        print('Victorias: ');
        print('</strong>');
        print($baseDatos['victorias']);
        print('</p>');
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
            <a href="../index/index.php">
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
        </ul>
    </nav>

    <main>
        <div id="imagen">

            <?php

            print('<h1>' . $nombreEquipo . '</h1>');

            crearImagen($id);
            ?>

        </div>

        <h2>Acerca del coche:</h2>

        <div id="contenido">

            <div id="coche">
                <?php
                crearImagenCoche($id);
                ?>
            </div>

            <div id="info">

                <div id="infoPrincipal">

                    <div id="infoCoche">

                        <?php

                        $coche = getCoche($id);

                        while ($baseDatos = $coche->fetch_assoc()) {

                            print('<h3>' . 'Información del coche:' . '</h3>');

                            print('<p>');
                            print('Nombre: ' . $baseDatos['nombre']);
                            print('</p>');

                            print('<p>');
                            print('Modelo: ' . $baseDatos['Modelo']);
                            print('</p>');

                            print('<p>');
                            print('Motor: ' . $baseDatos['Motor']);
                            print('</p>');
                        }

                        ?>

                    </div>

                    <div id="infoPatrocinadores">
                        <?php

                        print('<h3>' . 'Patrocinadores:' . '</h3>');

                        print('<div id=patrocinadores>');
                        $patrocinadores = getPatrocinadores($id);

                        while ($patrocinador = $patrocinadores->fetch_assoc()) {
                            print('<p>');
                            print($patrocinador['Nombre']);
                            print('</p>');
                        }
                        print('</div>');
                        ?>
                    </div>
                </div>

                <div id="palmares">

                    <h2>Palmarés del equipo:</h2>
                        <div>
                            <?php
                                crearPalmares($id);
                            ?>
                        </div>
                </div>

            </div>

        </div>

        <div id="acercaPilotos">


            <h2>Estadisticas de los pilotos:</h2>

            <div id="infoPilotos">
                <?php

                $pilotos = getPilotos($id);

                print('<h3>' . 'Pilotos:' . '</h3>');

                print('<div id="pilotos">');

                $contador = 0;

                while ($baseDatos = $pilotos->fetch_assoc()) {

                    print('<div class="piloto">');

                    print('<div>');
                    print('<p class=nombrePiloto>' . $baseDatos['Nombre'] . ':</p>');

                    print('<p>');
                    print('Puntos: ' . $baseDatos['Puntos']);
                    print('</p>');

                    print('<p>');
                    print('Dorsal: ' . $baseDatos['Dorsal']);
                    print('</p>');

                    print('<p>');
                    print('Nacionalidad: ' . $baseDatos['nacionalidad']);
                    print('</p>');

                    print('</div>');

                    crearImagenPiloto($id, $contador);
                    $contador++;

                    print('</div>');
                }

                print('</div>');

                ?>
            </div>

        </div>

        </div>

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

</html>