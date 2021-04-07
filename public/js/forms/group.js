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
	console.log(groupData.book)
	// get book id for the form
	// get container id for the form

	if(typeof groupData.book != "undefined" && typeof groupData.author != "undefined" && typeof groupData.max_size != "undefined" && typeof groupData.description != "undefined" ){
	openPopup('caja-group'); 
	document.querySelector('#logic-group-popup-book').value = groupData.book.inner;
	document.querySelector('#logic-group-popup-author').value = groupData.author.inner;
	document.querySelector('#logic-group-popup-author-id').value = groupData.author.id;
	document.querySelector('#logic-group-popup-book-id').value = groupData.book.id;
	document.querySelector('#logic-group-popup-containier-id');

	document.querySelector('#logic-group-popup-descriptions').innerHTML = groupData.description;
	document.querySelector('#logic-group-popup-max-size').value = groupData.max_size;
	}
	else{
		console.log(groupData.book);
	}

}