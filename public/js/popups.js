function closePopup(element){
 	document.getElementById(element).style.display = "none";
	document.querySelector("body").style.overflow = 'auto';
}
function openPopup(element, type){
	document.getElementById(element).style.display = "flex";
	document.querySelector("body").style.overflow = 'hidden';
	if(typeof type != 'undefined' && type[0] == 'author'){authorUpdate(type[1])}
	if(typeof type != 'undefined' && type[0] == 'book'){bookUpdate(type[1])}
	if(typeof type != 'undefined' && type[0] == 'container'){containerUpdate(type[1])}
	if(typeof type != 'undefined' && type[0] == 'group'){groupUpdate(type[1])}


}
function authorUpdate(url){
	document.querySelector('.logic-author-up-popup-id').value = '';
	document.querySelector('.logic-author-up-popup-nat').value = '';
	document.querySelector('.logic-author-up-popup-dob');
	document.querySelector('.logic-author-up-popup-name').value = '';
	document.querySelector('.logic-author-up-popup-ltname').value = '';
	$.ajax({
      url: url,
      type: "GET",
      success: function(data){
		document.querySelector('.logic-author-up-popup-id').value = data.crypt;
      	document.querySelector('.logic-author-up-popup-nat').value = data.nationality;
		document.querySelector('.logic-author-up-popup-dob').value = data.date;
		document.querySelector('.logic-author-up-popup-name').value = data.name;
		document.querySelector('.logic-author-up-popup-ltname').value = data.lastname;
      }
    });
}

function bookUpdate(url){
	document.querySelector('.logic-book-up-popup-id').value = '';
	document.querySelector('.logic-book-up-popup-author').value = '';
	document.querySelector('.logic-book-up-popup-dor').value = '';
	document.querySelector('.logic-book-up-popup-name').value = '';
	document.querySelector('.logic-book-up-popup-desc').value = '';
	document.querySelector('.logic-book-up-popup-number').value = '';
	$.ajax({
      url: url,
      type: "GET",
      success: function(data){
		document.querySelector('.logic-book-up-popup-id').value = data.crypt;
		document.querySelector('.logic-book-up-popup-author').value = data.author_id;
		document.querySelector('.logic-book-up-popup-dor').value = data.date;
		document.querySelector('.logic-book-up-popup-name').value = data.name;
		document.querySelector('.logic-book-up-popup-desc').value = data.description;
		document.querySelector('.logic-book-up-popup-number').value = data.number_pages;

      	
      }
    });
}

function containerUpdate(url){
	console.log(url)
	$.ajax({
      url: url,
      type: "GET",
      success: function(data){
		console.log(data)
		document.querySelector('.logic-cont-up-popup-id').value = data.crypt;
		document.querySelector('.logic-cont-up-popup-name').value = data.name;
		document.querySelector('.logic-cont-up-popup-desc').value = data.description;
		document.querySelector('.logic-cont-up-popup-weight').value = data.weight;
      }
    });
}


function groupUpdate(url){
	$.ajax({
      url: url,
      type: "GET",
      success: function(data){
		console.log(data)
		document.querySelector('.logic-group-up-popup-url').value = data.url;
		document.querySelector('.logic-group-up-popup-max-size').value = data.max_size;
		document.querySelector('.logic-group-up-popup-host').value = data.host_comments;
		document.querySelector('.logic-group-up-popup-author').value = data.author;
		document.querySelector('.logic-group-up-popup-name').value = data.name;
		document.querySelector('.logic-group-up-popup-desc').value = data.description;
		document.querySelector('.logic-group-up-popup-id').value = data.crypt;
      }
    });
}

ft = false;
function openUserPopup(){
	if(ft == false){
		document.querySelector('.usuario-menu').style.display = 'block';
		ft = true;
	}
	else{
		document.querySelector('.usuario-menu').style.display = 'none';
		ft = false;
	}
}

function closeUserPopup(e){
	if(document.querySelector('.usuario-menu').style.display == 'block' && !e.target.className.includes('logic-popup-settings') && e.target.id != 'login-popup-name'){
		document.querySelector('.usuario-menu').style.display = 'none';
		ft = false;
	}
}


document.querySelector('body').addEventListener('click', closeUserPopup);
