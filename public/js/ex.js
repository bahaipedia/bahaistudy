function closePopup(element){
 	document.getElementById(element).style.display = "none";
	document.querySelector("body").style.overflow = 'auto';
}
function openPopup(element){
	document.getElementById(element).style.display = "flex";
	document.querySelector("body").style.overflow = 'hidden';
}


/* RELACIONADO CON CREAR UN NUEVO LIBRO */

// function cajadeFicha() {}

// crearFicha.onclick = function() {
//   cajadeFicha();
// };
// const cerrar = document.getElementById("equis");
// const botonIniciar = document.querySelector(".login");
// const cuerpoWeb = document.getElementsByTagName("BODY")[0];
// const crearFicha = document.querySelector(".join-ficha-pop");
// const fichaLibro = document.querySelector(".cajaFicha");

/* RELACIONADO CON INICIAR SESION */
// function iniciarSesion() {
//   iniciarCaja.style.display = "flex";
//   cuerpoWeb.style.overflow = "hidden";
// }
// function cerrarCaja() {
//   iniciarCaja.style.display = "none";
//   cuerpoWeb.style.overflow = "auto";
// }

// cerrar.onclick = function() {
//   cerrarCaja();
// };
// botonIniciar.onclick = function() {
//   iniciarSesion();
// };