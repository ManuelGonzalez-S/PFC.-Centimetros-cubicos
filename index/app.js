
let mostrarTabla = true;

let botonClasificacion = document.getElementById('cambiarClasificacion');

let tablaEquipos = document.getElementById('tablaClasificacionEquipos');

let tablaPilotos = document.getElementById('tablaClasificacionPilotos');

function cambiarClasificacion(){

    if(mostrarTabla){

        botonClasificacion.innerHTML = 'Mostrar clasificacion de pilotos';
        tablaPilotos.style.display = 'none';
        tablaEquipos.style.display = 'table';
        mostrarTabla = false;

    }else{

        botonClasificacion.innerHTML = 'Mostrar clasificacion de equipos';
        tablaEquipos.style.display = 'none';
        tablaPilotos.style.display = 'table';
        mostrarTabla = true;
    }

    console.log(mostrarTabla);

}