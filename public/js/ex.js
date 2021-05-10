// DEPRECATED
function closePopup(element){
 	document.getElementById(element).style.display = "none";
	document.querySelector("body").style.overflow = 'auto';
}
function openPopup(element){
	document.getElementById(element).style.display = "flex";
	document.querySelector("body").style.overflow = 'hidden';
}