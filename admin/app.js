let tabla = document.getElementsByTagName('table')[0];
let thead;

let body = document.getElementsByTagName('body')[0];

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
        Posicion: 7,
        Puntos: 55,
        Pais: 'Reino Unido'
    }
}

crearCabecera();

function crearCabecera() {
    thead = document.createElement('thead');
    tabla.appendChild(thead);
    tr = document.createElement('tr');

    let titulos = ['Acciones', 'Equipo','Posición','Puntos','Pais'];

    for (let i = 0; i < titulos.length; i++) {
        th = document.createElement('th');
        th.innerHTML = titulos[i];
        tr.appendChild(th);
    }
    
    thead.appendChild(tr);
    tbody = document.createElement('tbody');
    tabla.appendChild(tbody);
    for (equipos in tablaEquipos) {
        tuplas = document.createElement(`tr`)
        tbody.appendChild(tuplas);
        actualizar = document.createElement('button');
        borrar = document.createElement('button');
        editar = document.createElement('button');
        actualizar.innerHTML = 'Actualizar';
        borrar.innerHTML = 'Borrar';
        editar.innerHTML = 'Editar';
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