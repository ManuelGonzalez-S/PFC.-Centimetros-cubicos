<?php

$id = $_GET['idEquipo'];

require_once('../database.php');

$database = new Database();

function cogerNombreEquipo($id,$database){

    $nombre = $database->getTablaSegunCampoID('equipos','id',$id,1);

    return $nombre;

}

function crearImagen($id,$database)
{


    $sentencia = $database->getTablaenBaseAID('equipos',$id,1);

    foreach($sentencia as $equipo) {

        $nombreEquipo = str_replace(' ', '', $equipo['nombre']);

        print('<img src = "../img/' . $nombreEquipo . '.jpg">');
    }
}

function crearImagenCoche($id,$database){

    $sentencia = $database->getTablaenBaseAID('equipos',$id,1);

    foreach($sentencia as $baseDatos) {

        $nombreEquipo = str_replace(' ', '', $baseDatos['nombre']);

        print('<img id="imagenCoche" src = "../img/' . $nombreEquipo . 'Coche.jpg">');
    }
}

function cogerPilotos($id,$database){

    $sentencia = $database->getTablaSegunCampoID('pilotos','Equipos_id',$id,2);

    return $sentencia;
}

function crearImagenPiloto($id, $numero, $database)
{

    $sentencia = cogerPilotos($id,$database);

    $aux = [];

    foreach($sentencia as $fila) {
        $aux[] = $fila;
    }


    $nombre = str_replace(' ', '', $aux[$numero]['Nombre']);

    print('<img class=imgPiloto src="../img/' . $nombre . '.jpg">');
}

function crearPalmares($id,$database){

    $sentencia = $database->getTablaenBaseAID('equipos',$id,1);

    foreach($sentencia as $baseDatos){

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
        </ul>
    </nav>

    <main>
        <div id="imagen">

            <?php

            $nombreEquipo = cogerNombreEquipo($id,$database);

            print('<h1>');
            foreach ($nombreEquipo as $nombre) {
                print($nombre['nombre']);
            }
            print ('</h1>');

            crearImagen($id,$database);
            ?>

        </div>

        <h2>Acerca del coche:</h2>

        <div id="contenido">

            <div id="coche">
                <?php
                crearImagenCoche($id,$database);
                ?>
            </div>

            <div id="info">

                <div id="infoPrincipal">

                    <div id="infoCoche">

                        <?php

                        $coche = $database->getTablaSegunCampoID('coches','Equipos_id',$id,1);

                        foreach($coche as $campo) {

                            print('<h3>' . 'Información del coche:' . '</h3>');

                            print('<p>');
                            print('<strong>');
                            print('Nombre: ');
                            print('</strong>');
                            print($campo['nombre']);
                            print('</p>');

                            print('<p>');
                            print('<strong>');
                            print('Modelo: ');
                            print('</strong>');
                            print($campo['Modelo']);
                            print('</p>');

                            print('<p>');
                            print('<strong>');
                            print('Motor: ');
                            print('</strong>');
                            print($campo['Motor']);
                            print('</p>');
                        }

                        ?>

                    </div>

                    <div id="infoPatrocinadores">
                        <?php

                        print('<h3>' . 'Patrocinadores:' . '</h3>');

                        print('<div id=patrocinadores>');
                        $patrocinadores = $database->getTablaenBaseAID('patrocinadores',$id,1);

                        foreach($patrocinadores as $patrocinador) {
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
                                crearPalmares($id,$database);
                            ?>
                        </div>
                </div>

            </div>

        </div>

        <div id="acercaPilotos">


            <h2>Estadisticas de los pilotos:</h2>

            <div id="infoPilotos">
                <?php

                $pilotos = cogerPilotos($id,$database);

                print('<h3>' . 'Pilotos:' . '</h3>');

                print('<div id="pilotos">');

                $contador = 0;

                foreach($pilotos as $piloto) {

                    print('<div class="piloto">');

                    print('<div>');
                    print('<p class=nombrePiloto>' . $piloto['Nombre'] . ':</p>');

                    print('<p>');
                    print('<strong>');
                    print('Puntos: ');
                    print('</strong>');
                    print($piloto['Puntos']);
                    print('</p>');

                    print('<p>');
                    print('<strong>');
                    print('Dorsal: ');
                    print('</strong>');
                    print($piloto['Dorsal']);
                    print('</p>');

                    print('<p>');
                    print('<strong>');
                    print('Nacionalidad: ');
                    print('</strong>');
                    print($piloto['nacionalidad']);
                    print('</p>');

                    print('</div>');

                    crearImagenPiloto($id, $contador,$database);
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