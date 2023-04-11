<?php
function conexion()
{
    $conexion = new mysqli('localhost', 'root', '', 'centimetroscubicos');
    $conexion->set_charset("utf8");

    return $conexion;
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
            <a href="#clasificacion">
                <li>CLASIFICACIÓN</li>
            </a>
            <a href="#equipos">
                <li>EQUIPOS</li>
            </a>
            <a href="../login/login.html">
                <li>LOGIN</li>
            </a>
        </ul>
    </nav>
    <main>
        <section id="noticias">
            <?php

            $noticias = ['AlfaRomeo', 'Alphatauri','Alpine'];

                for ($i=0; $i < 3; $i++) { 
                    print('<div class= "noticia">');
                    print('<img src= "../img/'.$noticias[$i]. '.jpg">');

                    print('<div class="info">');
                    print('<h2>Titulo de la noticia</h2>');
                    print('<p>Descripción de la noticia</p>');
                    print('</div>');


                    print('</div>');
                }
            ?>
        </section>
        <section id="clasificacion">
            <?php

            $baseDatos = conexion();


            // Genera la tabla de clasificacion

            $query = "select *,pilotos.puntos as 'puntosPil', Equipos.nombre as 'nombreEquipo' from pilotos inner join Equipos on equipos.id = pilotos.Equipos_id order by pilotos.Puntos desc;";

            $sentencia = $baseDatos->query($query);

            $titulos = ['Clasificación', 'Puntos', 'Piloto', 'Nacionalidad', 'Equipo'];

            print('<table id="tablaClasificacion">');
            print('<thead>');
            print('<tr>');
            for ($i = 0; $i < sizeof($titulos); $i++) {
                print('<th>');
                print($titulos[$i]);
                print('</th>');
            }
            print('</tr>');
            print('</thead>');

            $campos = ['puntosPil', 'Nombre', 'nacionalidad', 'nombreEquipo'];

            print('<tbody>');

            $contador = 1;

            // Genera cada fila
            while ($baseDatos = $sentencia->fetch_assoc()) {
                print('<tr>');

                print('<td>');
                print($contador);
                print('</td>');

                // Genera cada elemento de la fila
                for ($i = 0; $i < sizeof($campos); $i++) {
                    print('<td>');

                    print($baseDatos[$campos[$i]]);

                    print('</td>');
                }
                print('</tr>');

                $contador += 1;
            }

            print('</tbody>');

            print('</table>');
            ?>
        </section>

        <section id="equipos">
            <?php

            $baseDatos = conexion();

            $query = 'SELECT * from equipos';

            $sentencia = $baseDatos->query($query);

            while ($baseDatos = $sentencia->fetch_assoc()) {

                $nombreEquipo = str_replace(' ','',$baseDatos['nombre']);
                print('<div id =' . $nombreEquipo . '>');

                print('<a class=infoEquipos href= "../equipo/equipo.php?idEquipo='.$baseDatos['id'].'&nombreEquipo='.$baseDatos['nombre'].'">');
                print($baseDatos['nombre']);
                print('</a>');

                print('</div>');
            }

            ?>
        </section>
    </main>
    <footer></footer>
</body>
<script src="app.js"></script>

</html>