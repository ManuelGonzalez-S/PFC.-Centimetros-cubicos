function generarTablaClasificacion(){

    let main = document.getElementsByTagName('main')[0];

    let tabla = document.createElement('table');

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
    tabla.appendChild(body)
    main.appendChild(tabla);
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