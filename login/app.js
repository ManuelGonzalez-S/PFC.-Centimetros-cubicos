let pass, nombre, apellido, email;
let body = document.getElementsByTagName('body')[0];
let admin = document.getElementById('admin');
let main = document.getElementsByTagName('main')[0];
let formularios = document.forms;
let formulario1 = formularios[0];
let formulario2 = formularios[1];


function registrar(){
    main.removeChild(admin);
    main.appendChild(formulario2);
    main.removeChild(formulario1);
    main.appendChild(admin);
}

function volverLogin(){
    main.removeChild(admin);
    main.appendChild(formulario1);
    main.removeChild(formulario2);
    main.appendChild(admin);

}

function cargarLogin(){
    main.removeChild(formulario2);
}


function getDatosLogin(){
    email = formulario1['elements']['emailL']['value'];
    pass = formulario1['elements']['passL']['value'];
    console.log(email);
    console.log(pass)
}

function getDatosRegistro(){
    nombre =formulario2['elements']['nombreR']['value'];
    apellido = formulario2['elements']['apellidoR']['value'];
    email = formulario2['elements']['emailR']['value'];
    pass = formulario2['elements']['passR']['value'];
    pass = formulario2['elements']['pass2R']['value'];

    console.log(nombre);
    console.log(apellido);
    console.log(email);
    console.log(pass);
}



function addUsuario (){
    
}