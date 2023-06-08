<?php

session_start();

if (isset($_SESSION['user'])) {

    if ($_SESSION['user']['permisos'] == '0') {
        header('Location: ../index/index.php');
    }
} else {
    header('Location: ../index/index.php');
}

require_once('../database.php');
$database = new Database();
$cabeceras = [];
$tablas = ["15_equipos", "15_pilotos", "15_coches", "15_patrocinadores", "15_circuitos", "15_noticias"];
$i = 0;
$cont = 0;

if (isset($_GET['tabla'])) {
    $aux = $_GET['tabla'];
    if (!in_array($aux, $tablas)) {
        print '<h1>La tabla no existe</h1>';
        $aux = null;
    }
}

function cogerRelacion($aux)
{

    switch ($aux) {
        case "15_equipos":
            $tablaRelacion = null;
            break;

        case "15_pilotos":
            $tablaRelacion = '15_equipos';
            break;

        case "15_coches":
            $tablaRelacion = '15_pilotos';
            break;

        case "15_patrocinadores":
            $tablaRelacion = '15_equipos';
            break;

        case "15_circuitos":
            $tablaRelacion = '15_temporadas';
            break;
        case '15_noticias':
            $tablaRelacion = null;
            break;
    }

    return $tablaRelacion;
}

function labelFormularioColumnas($aux)
{
    switch ($aux) {
        case "15_equipos":
            $cabeceras = ['Acciones',"id", "Puntos", "nombre", "poles", "podios", "titulos", "victorias"];
            break;
        case "15_pilotos":
            $cabeceras = ['Acciones',"id", "nombre", "Puntos", "Dorsal", "nacionalidad", "equipos_id"];
            break;
        case "15_coches":
            $cabeceras = ['Acciones',"id", "nombre", "Modelo", "Motor", "pilotos_id", "equipos_id"];
            break;
        case "15_circuitos":
            $cabeceras = ['Acciones',"id", "nombre", "Longitud", "Numero_de_curvas", "temporadas_id"];
            break;
        case "15_patrocinadores":
            $cabeceras = ['Acciones',"id", "nombre", "equipos_id"];
            break;
    };

    return $cabeceras;
}

function labelFormularioCabeceras($aux)
{
    switch ($aux) {
        case "15_equipos":
            $cabeceras = ["id", "Puntos", "Nombre", "Poles", "Podios", "Titulos", "Victorias"];
            break;
        case "15_pilotos":
            $cabeceras = ["id", "Nombre", "Puntos", "Dorsal", "Nacionalidad", "Equipo"];
            break;
        case "15_coches":
            $cabeceras = ["id", "Nombre", "Modelo", "Motor" ,"Piloto"];
            break;
        case "15_circuitos":
            $cabeceras = ["id", "Nombre", "Longitud", "Numero de curvas", "Temporada"];
            break;
        case "15_patrocinadores":
            $cabeceras = ["id", "Nombre", "Equipo"];
            break;
        case "15_noticias":
            $cabeceras = ['id', 'Titulo', 'Descripcion', 'Ruta de imagen'];
            break;
    };

    return $cabeceras;
}

function imprimirTabla($nombreTabla)
{
    $database = new Database();
    $resultados = $database->getTabla($nombreTabla);

    switch ($nombreTabla) {
        case "15_equipos":
            $cabeceras = ["Acciones", "id", "Puntos", "nombre", "poles", "podios", "titulos", "victorias"];
            break;
        case "15_pilotos":
            $resultados = $database->getPilotosEquipos2();
            $cabeceras = ["Acciones", "id", "nombre", "Puntos", "Dorsal", "nacionalidad", "Equipo"];
            break;
        case "15_coches":
            $resultados = $database->getConductorEquipo();
            $cabeceras = ["Acciones", "id", "nombre", "Modelo", "Motor", "piloto", "Equipo"];
            break;
        case "15_circuitos":
            $resultados = $database->getEquipoCircuito();
            $cabeceras = ["Acciones", "id", "nombre", "Longitud", "Numero_de_curvas", "Temporada"];
            break;
        case "15_patrocinadores":
            $resultados = $database->getEquipoPatrocinado();
            $cabeceras = ["Acciones", "id", "nombre", "Equipo"];
            break;
        case "15_noticias":
            $cabeceras = ['Acciones', 'id', 'titulo', 'descripcion', 'rutaImagen'];
            break;
    }
    
    print '<table>
    <thead>
         <tr>';

         foreach ($cabeceras as $campo) {
            print '<th>' . $campo . '</th>';
        }
        ;
        print '</tr>
        </thead>
        <tbody>';
        foreach ($resultados as $row) {
            print '<tr>
            <td>';
            echo '<a href="../update/edit.php?tabla=' . $nombreTabla . '&&id=' . $row['id'] . '"><button>Update</button></a>';
            echo '<a href="../delete/delete.php?tabla=' . $nombreTabla . '&&id=' . $row['id'] . '"><button>Delete</button></a>
            </td>';
            for ($i = 1; $i < sizeof($cabeceras); $i++) {
                print '<td>' . $row[$cabeceras[$i]] . '</td>';
            }
            print '</tr>';
        }
    print '</tbody>
</table>';
}

function noAsignados($nombreTabla)
{

    if (!($nombreTabla == "15_equipos" || $nombreTabla == "15_noticias" || $nombreTabla == "15_circuitos")) {
        $database = new Database();

        if ($nombreTabla == "15_coches") {
            $resultados = $database->getNullPilotos($nombreTabla);
            $longitud = $database->getLongitudPilotosNull($nombreTabla);
        } else {
            $resultados = $database->getNullEquipos($nombreTabla);
            $longitud = $database->getLongitudEquiposNull($nombreTabla);
        }

        $cabeceras = labelFormularioCabeceras($nombreTabla);

        if ($longitud > 0) {
            print '<p>DATOS NO ASIGNADOS</p>';
            print '<table>
    <thead>
         <tr>';
            foreach ($cabeceras as $campo) {
                print '<th>' . $campo . '</th>';
            }
            print '</tr>
    </thead>
    <tbody>';

            $cabeceras = labelFormularioColumnas($nombreTabla);

            foreach ($resultados as $row) {
                print '<tr>
        <td>';
                echo '<a href="../update/edit.php?tabla=' . $nombreTabla . '&&id=' . $row['id'] . '"><button>Update</button></a>';
                echo '<a href="../delete/delete.php?tabla=' . $nombreTabla . '&&id=' . $row['id'] . '"><button>Delete</button></a>
        </td>';
                for ($i = 1; $i < sizeof($cabeceras); $i++) {
                    print '<td>' . $row[$cabeceras[$i]] . '</td>';
                }
                print '</tr>';
            }
            print '</tbody>
</table>';
        }
    }
}

function crearForm($aux, $database)
{
    $cabeceras = labelFormularioCabeceras($aux);

    $relacion = cogerRelacion($aux);

    $relacion = $database->getTabla($relacion);

    print '<input type="text" value=' . $aux . ' name=tabla hidden>';

    for ($i = 0; $i < sizeof($cabeceras); $i++) {

        $campo = $cabeceras[$i];

        $camposNumericos = ['puntos', 'poles', 'podios', 'titulos', 'victorias', 'dorsal', 'numero_de_curvas', 'longitud'];

        if ($aux == '15_noticias') {

            if ($campo != 'id') {
                print '<div>';
                print " <label>$campo:</label>";

                if ($i != sizeof($cabeceras)) {
                    $placeholder = strtolower(trim($campo));
                    $campo = str_replace(' ', '_', strtolower(trim($campo)));
                    print '<input type="text"  maxlength="50"  class="inputTexto" name="' . $campo . '" placeholder="Inserte ' . $placeholder . ' aqui" onblur="validarInputTexto(' . $i . ')">';
                }
                print '</div>';
            }
        } else if ($aux != '15_equipos') {
            if ($campo != 'id') {

                if (in_array(str_replace(' ', '_', strtolower(trim($campo))), $camposNumericos)) {
                    $tipo = 'number';
                    $clase = 'inputNumero';
                } else {
                    $tipo = 'text';
                    $clase = 'inputTexto';
                }

                print '<div>';
                print " <label>$campo:</label>";

                if ($i != sizeof($cabeceras) - 1) {
                    $placeholder = strtolower(trim($campo));
                    $campo = str_replace(' ', '_', strtolower(trim($campo)));
                    print '<input class="' . $clase . '" type="' . $tipo . '" name="' . $campo . '" placeholder="Inserte ' . $placeholder . ' aqui"';

                    if($clase = 'inputTexto'){
                        print ' maxlength="50" ';
                    }

                    print '>';
                }

                print '</div>';
            }
        } else {
            if ($campo != 'id') {

                if (in_array(str_replace(' ', '_', strtolower(trim($campo))), $camposNumericos)) {
                    $tipo = 'number';
                    $clase = 'inputNumero';
                } else {
                    $tipo = 'text';
                    $clase = 'inputTexto';
                }

                print '<div>';
                print " <label>$campo:</label>";
                $placeholder = strtolower(trim($campo));
                $campo = str_replace(' ', '_', strtolower(trim($campo)));
                echo ' <input class="' . $clase . '" type="' . $tipo . '" name="' . $campo . '" placeholder="Inserte ' . $placeholder . ' aqui"';

                if($clase = 'inputTexto'){
                    print ' maxlength="50" ';
                }

                print '>';
                print '</div>';
            }
        }
    }

    // ETIQUETA SELECT
    // SI NO SE TRATA DE CREAR UN EQUIPO:
    // SE PASA EL ID A ASOCIAR CON name='id_foranea'
    if ($relacion != null && $aux != '15_coches') {
        print '<div>';
        print "<select name='id_foranea'>";

        foreach ($relacion as $campo) {
            print "<option value='" . $campo['id'] . "'>" . $campo['nombre'] . "</option>";
        }
        print "</select>";
        print '</div>';

        // EN OTRO CASO, SE PASA COMO
        // name='piloto_id' name='equipo_id'
    } else if ($aux == '15_coches') {


        print '<div>';
        print "<select name='piloto_id'>";

        foreach ($relacion as $campo) {
            print "<option value='" . $campo['id'] . "'>" . $campo['nombre'] . "</option>";
        }

        print "</select>";
        print '</div>';

        $equipos = $database->getTabla('15_equipos');

        print '<div>';
        print "<label>Equipo:</label>";
        print "<select name='equipo_id'>";

        foreach ($equipos as $campo) {
            print "<option value='" . $campo['id'] . "'>" . $campo['nombre'] . "</option>";
        }
        print "</select>";
        print '</div>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Administracion</title>
</head>

<body>
    <nav>
        <ul>
            <li>
                <a href="../index/index.php" id="volver">
                    <button> <img src="../img/hacia-atras.png"> VOLVER</button>
                </a>
            </li>
        </ul>
    </nav>
    <main>
        <section class="acciones">
            <p>Seleccionar la tabla para modificarla</p>
            <div class="entidades">
                <?php

                foreach ($tablas as $tabla) {
                    $i++;

                    print '<a href="?tabla=' . $tabla . '"><button class="entidad">' . str_replace('15_', '', $tabla) . '</button></a>';
                }
                ?>
            </div>
        </section>
        <section class="tablaDatos">
            <p>TABLA DE DATOS</p>
            <?php
            if (!isset($aux)) {
                print '<h1>SELECCIONA UNA TABLA PARA MOSTRAR SUS DATOS</h1>';
            } else {
                print ' <button onclick="window.modal.showModal();" id="crear">+ Crear</button>';
                imprimirTabla($aux);
                noAsignados($aux);
            }
            ?>

        </section>
        <dialog id="modal">

            <form action="../create/create.php" method="POST">

                <?php

                print '<div id="modal-encabezado">';
                print " <h4>Añadir a " . str_replace('15_', '', $aux) . " :</h4>";
                print '</div>';

                print '<div id="modal-cuerpo">';
                crearForm($aux, $database);
                print '</div>';
                ?>

                <div id="modal-acciones">
                    <button onclick="window.modal.close()" type="button" id="botonCancelar"><strong>Cancelar</strong></button>
                    <button type="submit" id="botonConfirmar"><strong>Confirmar</strong></button>
                </div>

            </form>

        </dialog>

    </main>

    <footer></footer>

</body>
<script src="app.js"></script>

</html>