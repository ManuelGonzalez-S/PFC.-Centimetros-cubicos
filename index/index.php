<?php

require_once('../database.php');

$database = new Database();

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

            $noticias = ['AstonMartin', 'Alphatauri', 'Alpine'];
            $noticiasTitulo = ['Alonso ilusiona', 'Alphatauri en problemas', 'Alpine en busca de mejorar su coche'];
            $noticiasDescripcion = ['Alonso busca la 33 en el próximo GP de Azerbaiyán', 'El equipo ha perdido su patrocinador más importante', 'El equipo busca conseguir más puntos que el año pasado y ser aspirante al titulo el año que viene'];

            for ($i = 0; $i < 3; $i++) {
                print '<div class= "noticia">';
                print '<img src= "../img/' . $noticias[$i] . '.jpg">';

                print '<div class="info">';
                print "<h2>$noticiasTitulo[$i]</h2>";
                print "<p>$noticiasDescripcion[$i]</p>";
                print '</div>';


                print '</div>';
            }
            ?>
        </section>
        <section id="clasificacion">
            <?php

            // Genera la tabla de clasificacion
            $resultados = $database->getPilotosEquipos();

            $titulos = ['Clasificación', 'Puntos', 'Piloto', 'Nacionalidad', 'Equipo'];

            print '<table id="tablaClasificacion">';
            print '<thead>';
            print '<tr>';
            for ($i = 0; $i < sizeof($titulos); $i++) {
                print '<th>';
                print $titulos[$i];
                print '</th>';
            }
            print '</tr>';
            print '</thead>';

            $campos = ['Puntos', 'Nombre', 'nacionalidad', 'nombreEquipo'];

            print '<tbody>';

            $contador = 1;

            // Genera cada fila
            foreach ($resultados as $baseDatos) {
                print '<tr>';

                print '<td>';
                print $contador;
                print '</td>';

                // Genera cada elemento de la fila
                for ($i = 0; $i < sizeof($campos); $i++) {
                    print '<td>';

                    print $baseDatos[$campos[$i]];

                    print '</td>';
                }
                print '</tr>';

                $contador++;
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
    <footer></footer>
</body>
<script src="app.js"></script>

</html>