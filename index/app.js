
let main = document.getElementsByTagName('main')[0];

main.addEventListener('load',cargarPagina());

function cargarPagina(){

    generarTablaClasificacion();

    mostrarEquipos();
}

function generarTablaClasificacion(){

    let tabla = document.getElementById('tablaClasificacion');

    let section = document.getElementById('clasificacion');

    let boton = document.getElementById('generarClasificacion');

    if(tabla != null){
        section.replaceChildren();
        boton.innerHTML = 'Mostrar tabla de clasificaciones';
    }else{

        let tabla = document.createElement('table');
        tabla.setAttribute('id','tablaClasificacion')

        let head = document.createElement('thead');
        let tr = document.createElement('tr');
        let th;

        let pilotos = devolverNombresPilotos();

        for(let i = 0; i < pilotos.length;i++){
            th = document.createElement('th');
            th.innerHTML = pilotos[i]
            tr.appendChild(th);
        }

        head.appendChild(tr);


        let body = document.createElement('tbody');
        
        let td;

        for(let i = 0;i < pilotos.length;i++){
            tr = document.createElement('tr');
    
            for(let j = 0; j < pilotos.length; j++){
                td = document.createElement('td');
                td.innerHTML = j;
    
                tr.appendChild(td);
            }
            body.appendChild(tr);
        }

        tabla.appendChild(head);
        tabla.appendChild(body);
        section.appendChild(tabla);

        boton.innerHTML = 'Ocultar tabla de clasificaciones';
    }
}

function devolverNombresPilotos(){
    let pilotos = [];

    pilotos.push('Alonso');

    pilotos.push('Verstappen');

    pilotos.push('Checo Perez');

    pilotos.push('Stroll');

    pilotos.push('Hamilton');

    pilotos.push('Albon');

    return pilotos;
}

function mostrarEquipos(){

    let section = document.createElement('section');
    section.setAttribute('id','equipos');

    let card;

    let equipos = devolverEquipos();

    let idEquipos = devolverEquiposJuntos();

    for(let i = 0; i < 10; i++){

        card = document.createElement('div');
        // card.innerHTML = equipos[i];
        card.setAttribute('id', idEquipos[i]);
        section.appendChild(card);
    }

    main.appendChild(section);
}

function devolverEquipos(){

    let lista = [];

    lista.push('Mercedes');
    lista.push('Red Bull');
    lista.push('Aston Martin');
    lista.push('Alfa Romeo');
    lista.push('Haas');
    lista.push('Alphatauri');
    lista.push('Ferrari');
    lista.push('Mclaren');
    lista.push('Williams');
    lista.push('Alpine');

    lista.sort();

    return lista;
}

function devolverEquiposJuntos(){

    let lista = [];

    lista.push('Mercedes');
    lista.push('RedBull');
    lista.push('AstonMartin');
    lista.push('AlfaRomeo');
    lista.push('Haas');
    lista.push('Alphatauri');
    lista.push('Ferrari');
    lista.push('Mclaren');
    lista.push('Williams');
    lista.push('Alpine');

    lista.sort();

    return lista;
}