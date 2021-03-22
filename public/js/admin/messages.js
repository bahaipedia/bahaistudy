let i = 0
var check;
var input;
var url = document.querySelector('#message-search-route').value;
function searchMessage(e){
	input = e.value;
	i = 0
	if( typeof check != 'undefined'){
		clearInterval(check);
	}
	check = setInterval(beat.bind(e.value), 100)
}

function beat(value){
	i++;
	if(i > 2){
		i = 0;
		clearInterval(check);
		var url = document.querySelector('#message-search-route').value;
		url = `${url}/${input}`;
			$.ajax({
	        url: url,
	        type: "GET",
	        success: function(data){
	    		console.log(data)
	        }
      	});
	}
}