const iniciarCaja = document.getElementById("caja-centrada");
const cerrar = document.getElementById("equis");
const botonIniciar = document.getElementById("login");
iniciarCaja.style.display = "none";

/* RELACIONADO CON INICIAR SESION */
function iniciarSesion() {
  iniciarCaja.style.display = "block";
}
function cerrarCaja() {
  iniciarCaja.style.display = "none";
}
cerrarCaja.onclick = function() {
  cerrarCaja();
};
botonIniciar.onclick = function() {
  iniciarSesion();
};

/* RELACIONADO CON CREAR NUEVA CAJA */