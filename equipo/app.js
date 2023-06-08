let usuario = document.getElementById('menuUsuario');
let menu = document.getElementById('menu');

if(usuario != null){
  usuario.addEventListener('click', function() {
    menu.classList.toggle('visible');
  });
}
