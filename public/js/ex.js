const iniciarCaja = document.getElementById("caja-centrada");
const cerrar = document.getElementById("equis");
const botonIniciar = document.querySelector(".login");
iniciarCaja.style.display = "none";

/* RELACIONADO CON INICIAR SESION */
function iniciarSesion() {
  iniciarCaja.style.display = "flex";
}
function cerrarCaja() {
  iniciarCaja.style.display = "none";
}
cerrar.onclick = function() {
  cerrarCaja();
};
botonIniciar.onclick = function() {
  iniciarSesion();
};

/* RELACIONADO CON CREAR NUEVA CAJA */