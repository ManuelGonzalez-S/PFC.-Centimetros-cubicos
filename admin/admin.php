<?php

use function PHPSTORM_META\type;

require_once('../database.php');
$database = new Database();
$cabeceras = [];
$tablas = ["equipos", "pilotos", "coches", "patrocinadores", "circuitos"];

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
        case "equipos":
            $tablaRelacion = null;
            break;

        case "pilotos":
            $tablaRelacion = 'equipos';
            break;

        case "coches":
            $tablaRelacion = 'pilotos';
            break;

        case "patrocinadores":
            $tablaRelacion = 'equipos';
            break;

        case "circuitos":
            $tablaRelacion = 'temporada';
            break;
    }

    return $tablaRelacion;
}

function botonCrear($aux, $database)
{

    $columnas = labelFormularioColumnas($aux);

    $cabeceras = labelFormularioCabeceras($aux);

    $relacion = cogerRelacion($aux);

    $relacion = $database->getTabla($relacion);

    print '<!-- Botón en HTML (lanza el modal en Bootstrap) -->';
    print '        <a href="#victorModal" role="button" class="btn btn-large btn-primary" data-toggle="modal" id="crear">+ Crear</a>';

    print '        <!-- Modal / Ventana / Overlay en HTML -->';
    print '        <div id="victorModal" class="modal fade">';
    print '            <div class="modal-dialog">';
    print '                <div class="modal-content">';
    print '                    <div class="modal-header">';
    print "                        <h4 class='modal-title'>Añadir a $aux:</h4>";
    print '                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
    print '                    </div>';
    print '                    <div class="modal-body">';

    for ($i = 0; $i < sizeof($cabeceras); $i++) {

        $campo = $cabeceras[$i];

        if($aux != 'equipos'){
            if ($campo != 'id') {

                print '                        <div class="mb-3">';
                print "                            <label for='recipient-name' class='col-form-label'>$campo:</label>";
                
                if($i != sizeof($cabeceras)-1){
                    print '                            <input type="text" class="form-control" id="recipient-name" name="nombre">';
                }
    
                print '                        </div>';
            }
        }else{
            if ($campo != 'id') {

                print '                        <div class="mb-3">';
                print "                            <label for='recipient-name' class='col-form-label'>$campo:</label>";
                print '                            <input type="text" class="form-control" id="recipient-name" name="nombre">';
                print '                        </div>';
            }
        }

        
    }


    // ETIQUETA SELECT
    if ($relacion != null) {
        print '                        <div class="mb-3">';
        print "                                 <select name='cars' id='cars'>";

        foreach ($relacion as $campo) {
            print "                                     <option value='" . $campo['id'] . "'>" . $campo['nombre'] . "</option>";
        }
        print "                             </select>";
        print '                        </div>';
    }
    print '                    </div>';
    print '                    <div class="modal-footer">';
    print '                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>';
    print '                        <button type="button" class="btn btn-primary">Confirmar</button>';
    print '                    </div>';
    print '                </div>';
    print '            </div>';
    print '        </div>';
}

function labelFormularioColumnas($aux)
{
    switch ($aux) {
        case "equipos":
            $cabeceras = ["id", "Puntos", "nombre", "poles", "podios", "titulos", "victorias"];
            break;
        case "pilotos":
            $cabeceras = ["id", "Nombre", "Puntos", "Dorsal", "nacionalidad", "Equipos_id"];
            break;
        case "coches":
            $cabeceras = ["id", "nombre", "Modelo", "Motor", "Pilotos_id", "Equipos_id"];
            break;
        case "circuitos":
            $cabeceras = ["id", "Nombre", "Longitud", "Numero_de_curvas", "Temporada_id"];
            break;
        case "patrocinadores":
            $cabeceras = ["id", "Nombre", "Equipos_id"];
            break;
    };

    return $cabeceras;
}

function labelFormularioCabeceras($aux)
{
    switch ($aux) {
        case "equipos":
            $cabeceras = ["id", "Puntos", "Nombre", "Poles", "Podios", "Titulos", "Victorias"];
            break;
        case "pilotos":
            $cabeceras = ["id", "Nombre", "Puntos", "Dorsal", "Nacionalidad", "Equipo"];
            break;
        case "coches":
            $cabeceras = ["id", "Nombre", "Modelo", "Motor", "Equipo", "Piloto"];
            break;
        case "circuitos":
            $cabeceras = ["id", "Nombre", "Longitud", "Numero de curvas", "Temporada"];
            break;
        case "patrocinadores":
            $cabeceras = ["id", "Nombre", "Equipo"];
            break;
    };

    return $cabeceras;
}

function imprimirTabla($nombreTabla)
{;
    $database = new Database();
    $resultados = $database->getTabla($nombreTabla);
    print '<table>
    <thead>
         <tr>';
    switch ($nombreTabla) {
        case "equipos":
            $cabeceras = ["Acciones", "id", "Puntos", "nombre", "poles", "podios", "titulos", "victorias"];
            break;
        case "pilotos":
            $cabeceras = ["Acciones", "id", "nombre", "Puntos", "Dorsal", "nacionalidad", "Equipos_id"];
            break;
        case "coches":
            $cabeceras = ["Acciones", "id", "nombre", "Modelo", "Motor", "Pilotos_id", "Equipos_id"];
            break;
        case "circuitos":
            $cabeceras = ["Acciones", "id", "nombre", "Longitud", "Numero_de_curvas", "Temporada_id"];
            break;
        case "patrocinadores":
            $cabeceras = ["Acciones", "id", "nombre", "Equipos_id"];
            break;
    };
    foreach ($cabeceras as $campo) {
        print '<th>' . $campo . '</th>';
    };
    print '</tr>
    </thead>
    <tbody>';

    foreach ($resultados as $row) {
        print '<tr><td>
        <a><button>update</button></a>
        <a href="delete.php?id=' . $row['id'] . '"><button>delete</button></a>
        </td>';
        for ($i = 1; $i < sizeof($cabeceras); $i++) {
            print '<td>' . $row[$cabeceras[$i]] . '</td>';
        }
        print '</tr>';
    }
    print '</tbody>
</table>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Document</title>
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
                    print '<a href="?tabla=' . $tabla . '"><button class="entidad">' . $tabla . '</button></a>';
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
                botonCrear($aux, $database);
                imprimirTabla($aux);
            }
            ?>

        </section>

    </main>

    <footer></footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>