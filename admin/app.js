let tabla = document.getElementsByTagName('table')[0];
let thead;

let tablaEquipos = {
    redbullRacing: {
        posicion: 1,
        puntos: 759,
        pais: 'Austria'
    },
    ferrari: {
        posicion: 2,
        puntos: 554,
        pais: 'Italia'
    },
    mercedes: {
        posicion: 3,
        puntos: 515,
        pais: 'Alemania'
    },
    bwt: {
        posicion: 4,
        puntos: 173,
        pais: 'Francia'
    },
    mcLaren: {
        posicion: 5,
        puntos: 159,
        pais: 'Reino Unido'
    },
    AlfaRomeo: {
        posicion: 6,
        puntos: 55,
        pais: 'Suiza'
    },
    AstonMartin: {
        posicion: 7,
        puntos: 55,
        pais: 'Reino Unido'
    }
}

function crearTabla() {
    crearCabecera();
}

crearTabla();

function crearCabecera() {
    thead = document.createElement('thead');
    tabla.appendChild(thead);
    tr = document.createElement('tr');

    nombres = document.createElement('th');
    nombres.innerHTML = 'equipos';
    accion1 = document.createElement('th');
    accion1.innerHTML = 'acciones'
    thead.appendChild(tr);
    tr.appendChild(accion1);
    tr.appendChild(nombres);
    for (stats in tablaEquipos['AstonMartin']) {
        th = document.createElement('th');
        th.innerHTML = stats;
        tr.appendChild(th);
    }
    tbody = document.createElement('tbody');
    tabla.appendChild(tbody);
    for (equipos in tablaEquipos) {
        tuplas = document.createElement(`tr`)
        tbody.appendChild(tuplas);
        actualizar = document.createElement('button');
        borrar = document.createElement('button');
        editar = document.createElement('button');
        actualizar.innerHTML = 'update';
        borrar.innerHTML = 'delete';
        editar.innerHTML = 'edit';
        tuplas.appendChild(actualizar);
        tuplas.appendChild(borrar);
        tuplas.appendChild(editar);
        td = document.createElement('td');
        td.innerHTML = equipos;
        tuplas.appendChild(td);
        for (datos in tablaEquipos[equipos]) {

            tdDatos = document.createElement('td');
            tdDatos.innerHTML = tablaEquipos[equipos][datos];
            tuplas.appendChild(tdDatos);
        }
    }
}