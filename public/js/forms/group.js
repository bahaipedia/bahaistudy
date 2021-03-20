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
	console.dir(element.options)
	$.ajax({
        url: url,
        type: "GET",
        success: function(result){
        	bookElement.innerHTML = '';
	        for(r of result){
	        	console.log(r)
		        op = document.createElement('option')
		        op.value = r.id;
		        op.innerHTML = r.name.toUpperCase();
		        bookElement.appendChild(op);
	       	}
        }
     });
	console.log(`The container is ${containerId}`)
	console.log(`The author is ${authorId}`)
}