const abrirMenu = document.getElementById('menu-pequeno');
const cerrarMenu = document.getElementById('equis-menupe');
const hamburguesa = document.getElementById('burger');
const paginaCompleta = document.querySelector('.general-container');

// abrirMenu.addEventListener('click', show);
// cerrarMenu.addEventListener('click', close);

function show(){
    abrirMenu.style.display = 'flex';
    paginaCompleta.style.display = 'none';
    // cerrarMenu.style.display = 'flex'
}


function cerrar(){
    abrirMenu.style.display = 'none';
    paginaCompleta.style.display = 'flex';
    // cerrarMenu.style.display = 'none';
    console.log(abrirMenu);
    console.log(paginaCompleta);

}