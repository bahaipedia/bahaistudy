console.log('group form')

function getBooks(element){
	var containerId = element.dataset.container;
	var authorId = element.value;
	var bookElement = document.querySelector(`#book-element-${containerId}`)
	var url;
	for(option of element.options){
		if(option.value == authorId){
			url = option.dataset.link
		}
	} 
	$.ajax({
        url: url,
        type: "GET",
        success: function(result){
        	bookElement.innerHTML = '';
        	if(result.length == 0){
        		op = document.createElement('option')
		        op.innerHTML = 'NO BOOK YET';
		        op.disabled = 'true';
		        op.selected = 'true';
		        op.value = 0;
		        bookElement.appendChild(op);
        	}
        	else{
        		op = document.createElement('option')
		        op.innerHTML = 'SELECT BOOK';
		        op.disabled = 'true';
		        op.selected = 'true';
		        op.value = 0;
		        bookElement.appendChild(op);
        	}
	        for(r of result){
		        op = document.createElement('option')
		        op.value = r.id;
		        op.innerHTML = r.name.toUpperCase();
		        bookElement.appendChild(op);
	       	}
        }
     });
}

var groupData = {}
function createGroup(element){
	if(element.name == 'description'){
		groupData.description = element.value;
	}
	if(element.name == 'max_size'){
		groupData.max_size = element.value;
	}
	if(element.name == 'book_id'){
		groupData.book = {}
		groupData.book.value = element.value
		groupData.book.inner = element.options[element.options.selectedIndex].label
	}
	if(element.name == 'author_id'){
		groupData.author = {}
		groupData.author.value = element.value
		groupData.author.inner = element.options[element.options.selectedIndex].label
	}
}

function renderInfoGroup(element){
	console.log(element.dataset.container)
	// get book id for the form
	// get container id for the form
	if(typeof groupData.book != "undefined" && typeof groupData.author != "undefined" && typeof groupData.max_size != "undefined" && typeof groupData.description != "undefined" ){
	openPopup('caja-group'); 
	document.querySelector('#logic-group-popup-book').value = groupData.book.inner;
	document.querySelector('#logic-group-popup-author').value = groupData.author.inner;
	document.querySelector('#logic-group-popup-author-id').value = groupData.author.value;
	document.querySelector('#logic-group-popup-book-id').value = groupData.book.value;
	document.querySelector('#logic-group-popup-container-id').value = element.dataset.container;
	document.querySelector('#logic-group-popup-descriptions').innerHTML = groupData.description;
	document.querySelector('#logic-group-popup-max-size').value = groupData.max_size;
	}
	else{
		console.log(groupData.book);
	}
}

function refreshForm(){
	groupData = {}
	var lbn = document.querySelectorAll('.logic-bn');
	console.log(lbn)
	console.log(lbn.length)
	var lan = document.querySelectorAll('.logic-an');
	var lmg = document.querySelectorAll('.logic-mg');
	var lde = document.querySelectorAll('.logic-de');
	for (var i = 0; i<lbn.length; i++){
		console.log('hi')
		lbn[i].value = 0;
		lan[i].value = 0;
		lmg[i].value = 0;
		lde[i].value = '';
	}

}