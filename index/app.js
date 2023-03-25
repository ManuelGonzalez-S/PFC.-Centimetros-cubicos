
let main = document.getElementsByTagName('main')[0];

let body = document.getElementsByTagName('body')[0];

body.addEventListener('load',cargarPagina());

function cargarPagina(){

    generarNoticias();

    generarTablaClasificacionPilotos();

    mostrarEquipos();

    generarFooter();
}

// Genera seccion de noticias
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

// Genera tabla Clasificacion de los pilotos
function generarTablaClasificacionPilotos(){


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

// Devuelve los nombres de los pilotos
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

// Genera la seccion de equipos
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

// Devuelve los nombres de los equipos
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

// Devuelve los nombres de los equipos sin espacios para las imagenes
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

// Genera el footer
function generarFooter(){

    generarRRSS();

    generarProteccion();

    generarContacto();

    generarCopyright();

}

function generarRRSS(){
    let footer = document.getElementsByTagName('footer')[0];

    let div;

    let imagen;

    let fuentes = imagenesRRSS();

    div = document.createElement('div');
    div.setAttribute('id','rrss');

    let titulo = document.createElement('h3');
    titulo.innerHTML = 'Redes Sociales';

    div.appendChild(titulo);

    for(let i = 0; i < 3; i++){
        imagen = document.createElement('img');
        imagen.setAttribute('src','../img/' + fuentes[i] +'.jpg');

        div.appendChild(imagen);
    }

    footer.appendChild(div);
}

function imagenesRRSS(){
    let imagenes = [];

    imagenes.push('instagram');
    imagenes.push('twitter');
    imagenes.push('facebook')

    return imagenes;
}

function generarProteccion(){

    let footer = document.getElementsByTagName('footer')[0];

    let div = document.createElement('div');
    div.setAttribute('id','proteccion');

    let titulo = document.createElement('h3');
    titulo.innerHTML = 'Protección de datos';

    div.appendChild(titulo);

    let p = document.createElement('p');
    p.innerHTML = 'Politica de cookies';

    div.appendChild(p);

    p = document.createElement('p');
    p.innerHTML = 'Politica de privacidad';

    div.appendChild(p);

    p = document.createElement('p');
    p.innerHTML = 'Aviso legal';

    div.appendChild(p);

    footer.appendChild(div);
}

function generarContacto(){

    let footer = document.getElementsByTagName('footer')[0];

    let div;

    div = document.createElement('div');
    div.setAttribute('id','contacto');

    let titulo = document.createElement('h3');
    titulo.innerHTML = 'Contacto';

    div.appendChild(titulo);

    let p = document.createElement('p');
    p.innerHTML = 'ejemplo@gmail.com';

    div.appendChild(p);

    p = document.createElement('p');
    p.innerHTML = 'tel: 913 64 51 57';

    div.appendChild(p);

    footer.appendChild(div);


}

function generarCopyright(){

    let footer = document.getElementsByTagName('footer')[0];

    let div;

    div = document.createElement('div');
    div.setAttribute('id','copyright');

    let p = document.createElement('p');
    p.innerHTML = '© Copyright';

    div.appendChild(p);

    footer.appendChild(div);

}