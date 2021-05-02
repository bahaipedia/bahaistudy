// Message logic
var message = {}
message.render = {}
message.box = document.querySelector('#message-box');
message.box.scrollTop = message.box.scrollHeight;

// message.span = document.querySelectorAll('.message-span');
message.string = document.querySelector('#message-string').value;
message.form = document.querySelector('#message-form');
message.input = document.querySelector('#message-input');
message.group_id = document.querySelector('#group_id').value
message.user_id = document.querySelector('#user_id').value

message.route = document.querySelector('#message-route').value
message.query = document.querySelector('#message-poll').value;
var messageTimer;

function messagePoll(){
  var url = message.query+'/'+sessionStorage.getItem('t');
   $.ajax({
      url: url,
      type: "GET",
      success: function(data){
          sessionStorage.setItem('t', (new Date()/1000))
          for(var i = 0; i<data.length; i++){
            messageRender(data[i].message, data[i].self, data[i].user_info, 'get')
          }
          messageTimer = setTimeout(messagePoll,5000);
      }
    });
}

firstMessagePoll();
function firstMessagePoll(){
   var url = message.query;
   $.ajax({
      url: url,
      type: "GET",
      success: function(data){
          sessionStorage.setItem('t', (new Date()/1000))
          for(var i = 0; i<data.length; i++){
            messageRender(data[i].message, data[i].self, data[i].user_info, 'get')
          }
          messageTimer = setTimeout(messagePoll,5000);
      }
    });
}

function messageRender(newMessage, user, info, method){
    message.render.container = document.createElement('div')
    message.render.circle = document.createElement('div')
    message.render.subcontainer = document.createElement('div')
    message.render.info = document.createElement('h5')
    message.render.text = document.createElement('p')

    if(user == 'self'){
      message.render.container.className = 'msj-enviado';
      message.render.circle.className = 'perfil-chat';
      message.render.subcontainer.className = "textos-chat"
      message.render.info.className = 'autor-envia';
      message.render.text.className = 'texto-enviado';
      message.render.text.innerHTML = newMessage;
      message.render.info.innerHTML = message.string;
      message.render.subcontainer.appendChild(message.render.info);
      message.render.subcontainer.appendChild(message.render.text);
      message.render.container.appendChild(message.render.subcontainer);
      message.render.container.appendChild(message.render.circle);
    }else{
      message.render.container.className = 'msj-recibido';
      message.render.circle.className = 'perfil-chat-dos';
      message.render.subcontainer.className = "textos-chat-derecha"

      message.render.info.className = 'autor-envia-uno';
      message.render.text.className = 'texto-enviado-uno';
      message.render.text.innerHTML = newMessage;
      message.render.info.innerHTML = info;
      message.render.subcontainer.appendChild(message.render.info);
      message.render.subcontainer.appendChild(message.render.text);
      message.render.container.appendChild(message.render.circle);
      message.render.container.appendChild(message.render.subcontainer);
    }
    if(method == 'push'){
      message.render.text.style.color = 'black'
    }
    message.box.appendChild(message.render.container)
    message.box.scrollTop = message.box.scrollHeight;
    return message.render.text;
}

message.form.addEventListener('keyup', function(e){
  if(e.keyCode == 13){
    clearTimeout(messageTimer);
    newMessage = message.input.value;
    message.input.value = '';
    var renderMessage = messageRender(newMessage, 'self', '', 'push')

    message.box.scrollTop = message.box.scrollHeight;
    // message.box.scrollTop = message.box.scrollTopMax;
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('input[name="_token"]').val()
      },
      data: {
        'new_message': newMessage,
        'group_id': message.group_id,
      },
      url: message.route,
      type: "POST",
      success: function(data){
        messageTimer = setTimeout(messagePoll,10000);
        renderMessage.style.color = '#95989a';
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        renderMessage.style.color = 'red';
      }
    });

  }
})
  
