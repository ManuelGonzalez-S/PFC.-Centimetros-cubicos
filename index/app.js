
let main = document.getElementsByTagName('main')[0];

let body = document.getElementsByTagName('body')[0];

body.addEventListener('load',cargarPagina());

function cargarPagina(){

    generarNoticias();

    generarTablaClasificacion();

    mostrarEquipos();
}

function generarNoticias(){

    let section = document.createElement('section');
    section.setAttribute('id','noticias');

    let div;

    let info;

    let titulo;

    let texto;

    let equipos = devolverEquiposJuntos();

    let imagen;

    for(let i = 0; i < 3; i++){
        div = document.createElement('div');
        div.setAttribute('class','noticia')

        imagen = document.createElement('img');
        imagen.setAttribute('src','../img/' + equipos[i] + '.jpg');

        info = document.createElement('div');
        info.setAttribute('class','info');

        titulo = document.createElement('h2');
        titulo.innerHTML = 'Titulo de la noticia';

        texto = document.createElement('p');
        texto.innerHTML = 'Descripción de la noticia';

        info.appendChild(titulo);

        info.appendChild(texto);

        div.appendChild(imagen);

        div.appendChild(info);
        
        section.appendChild(div);
    }

    main.appendChild(section);

}

function generarTablaClasificacion(){


    let titulos = ['Clasificación','Piloto','Puntos','Equipo'];
 
    let section = document.createElement('section');;
    section.setAttribute('id','clasificacion');

    let tabla = document.createElement('table');
    tabla.setAttribute('id','tablaClasificacion')

    let head = document.createElement('thead');
    let tr = document.createElement('tr');
    let th;

    let pilotos = devolverNombresPilotos();

    for(let i = 0; i < titulos.length;i++){
        th = document.createElement('th');
        th.innerHTML = titulos[i]
        tr.appendChild(th);
    }

    head.appendChild(tr);


    let body = document.createElement('tbody');
    
    let td;

    for(let i = 1;i <= pilotos.length;i++){
        tr = document.createElement('tr');
        
        td = document.createElement('td');
        td.innerHTML = i;

        tr.appendChild(td);

        td = document.createElement('td');
        td.innerHTML = pilotos[i - 1];

        tr.appendChild(td);

        td = document.createElement('td');
        td.innerHTML = 0;

        tr.appendChild(td);

        td = document.createElement('td');
        td.innerHTML = 0;

        tr.appendChild(td);

        body.appendChild(tr);
    }

    tabla.appendChild(head);
    tabla.appendChild(body);
    section.appendChild(tabla);

    main.appendChild(section);
}

function devolverNombresPilotos(){
    let pilotos = [];

    pilotos.push('Alonso');

    pilotos.push('Verstappen');

    pilotos.push('Checo Pérez');

    pilotos.push('Stroll');

    pilotos.push('Hamilton');

    pilotos.push('Albon');

    return pilotos;
}

function mostrarEquipos(){

    let section = document.createElement('section');
    section.setAttribute('id','equipos');

    let card;

    let p;

    let equipos = devolverEquipos();

    let idEquipos = devolverEquiposJuntos();

    for(let i = 0; i < 10; i++){

        card = document.createElement('div');
        p  = document.createElement('p');
        p.setAttribute('class','infoEquipos');

        p.innerHTML = equipos[i];

        card.setAttribute('id', idEquipos[i]);
        card.appendChild(p);
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