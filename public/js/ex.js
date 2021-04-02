const iniciarCaja = document.getElementById("caja-centrada");
const cerrar = document.getElementById("equis");
const botonIniciar = document.querySelector(".login");
const cuerpoWeb = document.getElementsByTagName("BODY")[0];
const crearFicha = document.querySelector(".join-ficha-pop");
const fichaLibro = document.querySelector(".cajaFicha");
iniciarCaja.style.display = "none";

/* RELACIONADO CON INICIAR SESION */
function iniciarSesion() {
  iniciarCaja.style.display = "flex";
  cuerpoWeb.style.overflow = "hidden";
}
function cerrarCaja() {
  iniciarCaja.style.display = "none";
  cuerpoWeb.style.overflow = "auto";
}
cerrar.onclick = function() {
  cerrarCaja();
};
botonIniciar.onclick = function() {
  iniciarSesion();
};

/* RELACIONADO CON CREAR UN NUEVO LIBRO */

function cajadeFicha() {}

crearFicha.onclick = function() {
  cajadeFicha();
};
