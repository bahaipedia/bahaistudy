var openUserPopupStatus = false;
function openUserPopup(){
	if(openUserPopupStatus == false){
		document.querySelector('.usuario-menu').style.display = 'block';
		openUserPopupStatus = true;
	}
	else{
		document.querySelector('.usuario-menu').style.display = 'none';
		openUserPopupStatus = false;
	}
}

function closeUserPopup(e){
	if(document.querySelector('.usuario-menu').style.display == 'block' && !e.target.className.includes('logic-popup-settings') && e.target.id != 'login-popup-name'){
		document.querySelector('.usuario-menu').style.display = 'none';
		openUserPopupStatus = false;
	}
}
document.querySelector('body').addEventListener('click', closeUserPopup);
