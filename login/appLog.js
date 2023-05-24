let regexText= /^[^\d]{4,}$/;

let nombre = document.getElementById('nombre');

nombre.setAttribute('onkeyup', 'validarInputNombre()');

let mensajeNombre = document.getElementById('mensajeNombre');

function validarInputNombre(){

    if(nombre.value.length > 0){
        console.log('Tiene contenido');
        if(regexText.test(nombre.value)){
            nombre.classList.remove('inputInvalido');
            nombre.classList.add('inputValido');

            mensajeNombre.innerHTML = '';
        }else{
            nombre.classList.remove('inputValido');
            nombre.classList.add('inputInvalido');

            mensajeNombre.innerHTML = 'No se admiten numeros ni nombres de menos de 4 letras';
    
        }
        validarBoton();
    }else{
        nombre.classList.remove('inputValido');
        nombre.classList.remove('inputInvalido');

        mensajeNombre.innerHTML = '';
    }
    
}

let contraseña = document.getElementById('contraseña');

contraseña.setAttribute('onkeyup','validarInputContra()');

let regexPass= /(?=.*\d{2})(?=.*[A-Z])+((?=.*[. - _ , =])+).{7,}/;

function validarInputContra(){

    if(contraseña.value.length > 0){
        if(regexPass.test(contraseña.value)){
            contraseña.classList.remove('inputInvalido');
            contraseña.classList.add('inputValido');

            if(contraseñaCopia != null){
                validarInputContraIguales();
            }else{
                mensajeContra.innerHTML = '';
            }
            
        }else{
            contraseña.classList.remove('inputValido');
            contraseña.classList.add('inputInvalido');
    
            if(contraseñaCopia == null){
                mensajeContra.innerHTML = 'La contraseña no cumple los requisitos';
            }
        }
    
        validarBoton();
    }else{
        contraseña.classList.remove('inputValido');
        contraseña.classList.remove('inputInvalido');

        mensajeContra.innerHTML = '';
    }
    

}


let inputs = document.getElementsByTagName('input');

let botonEnviar = document.getElementById('botonEnviar');

function validarBoton(){

    let inputsValidos = document.getElementsByClassName('inputValido');

    if(inputsValidos.length == inputs.length - 1){
        botonEnviar.disabled = false;
    }else{
        botonEnviar.disabled = true;
    }
}

let botonVisibilidad = document.getElementById('visibleContra');

let imagen = document.getElementById('ojoVisible');

botonVisibilidad.addEventListener("click", function() {
    if (contraseña.type === "password") {
        contraseña.type = "text";
        imagen.src= "../img/ojoAbierto.png";
    } else {
        contraseña.type = "password";
        imagen.src= "../img/ojoCerrado.png";
    }
});



// SOLO APARECE EN REGISTER
let contraseñaCopia = document.getElementById('contraseñaCopia');

let imagenCopia = document.getElementById('ojoVisibleCopia');

let botonVisibilidadCopia = document.getElementById('visibleContraCopia');

if(botonVisibilidadCopia != null){
    botonVisibilidadCopia.addEventListener("click", function() {
        if (contraseñaCopia.type === "password") {
            contraseñaCopia.type = "text";
            imagenCopia.src= "../img/ojoAbierto.png";
        } else {
            contraseñaCopia.type = "password";
            imagenCopia.src= "../img/ojoCerrado.png";
        }
    });
}


if(contraseñaCopia != null){
    contraseñaCopia.setAttribute('onkeyup','validarInputContraIguales()');
}

let mensajeContra = document.getElementById('mensajeContra');

function validarInputContraIguales(){

    if(contraseña.value.length > 0 || contraseñaCopia.value.length > 0){
        if(regexPass.test(contraseñaCopia.value) && (contraseña.value == contraseñaCopia.value)){
            contraseñaCopia.classList.remove('inputInvalido');
            contraseñaCopia.classList.add('inputValido');

            mensajeContra.innerHTML = '';
            
        }else{
            contraseñaCopia.classList.remove('inputValido');
            contraseñaCopia.classList.add('inputInvalido');

            mensajeContra.innerHTML = 'Las contraseñas no coiciden o no cumplen los requisitos';
    
        }
    
        validarBoton();

    }else{

        contraseñaCopia.classList.remove('inputValido');
        contraseñaCopia.classList.remove('inputInvalido');

        mensajeContra.innerHTML = '';

    }
    

}