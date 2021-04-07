var authorStatus = 0;
var authorContainer = document.querySelector('#author-in-container');
function newAuthor(element){
	if(element.dataset.used == undefined && element.value != null  && authorStatus < 7){
		authorStatus++;
		var value = element.value;
		var newElement = document.createElement('select');
		newElement.name = `author[${authorStatus}]`;
		newElement.innerHTML = element.innerHTML;
		if(authorStatus == 1){
			deleteOption = document.createElement('option');
			deleteOption.innerHTML = 'NOT SELECT ONE'
			deleteOption.value = null;
			newElement.appendChild(deleteOption);
		}
		authorContainer.appendChild(newElement);
		newElement.addEventListener('change', function(){
			newAuthor(newElement);
		});
	}
	element.dataset.used = true;
}