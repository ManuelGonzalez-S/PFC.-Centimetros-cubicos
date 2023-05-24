let valStrings = /^[a-zA-Z\s]{1,}$/;
let valNumber = /^\d+$/;
let form = document.forms[0];
let datos = [];

function recogerInputs() {
    let num;
    let i = 2;
    parar = false
    
    while (!parar) {
        num = form[i];
        i++;
        if (num.tagName == 'BUTTON') {
            parar = true;
        } else if (num.tagName == 'INPUT') {
            datos.push(num)
        }
    }
    return datos
}

recogerInputs();
console.log(document.getElementsByTagName('input').length);

function addRegex(){
    for (i =0; i <datos.length;i++){
        console.log(datos[i])
        datos[i].setAttribute('onkeyup', `validar(name)`)
    }
}

function validar(nombre){
    nombreAux = form['elements'][nombre]['value'];
    dato = form['elements'][nombre]['type'];
    let regexEval = /^$/;
    if (dato == 'text'){
        regexEval = valStrings;
    } else if (dato == 'number'){
        regexEval = valNumber;
    }
    if (regexEval.test(nombreAux)){
        form['elements'][nombre].classList.add('correcto');
        form['elements'][nombre].classList.remove('incorrecto');
    } else if (!regexEval.test(nombreAux)){
        form['elements'][nombre].classList.add('incorrecto');
        form['elements'][nombre].classList.remove('correcto');
    }
    
}
console.log(form[0]['elements']);



// continuar();

// regexInput();
addRegex();
// console.log((form[0][7].tagName))


