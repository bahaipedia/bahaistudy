var poll = {}
poll.query = {}
poll.user = {}
poll.user.autheticated = document.querySelector('#val').value
poll.user.id = document.querySelector('#user_id').value
poll.group_id = document.querySelector('#group_id').value;
// in blade 
poll.query.beat = document.querySelector('#beat_route').value;
poll.query.participant = document.querySelector('#participant_route').value;

getPoll();
function getPoll(){
   $.ajax({
      url: poll.query.participant,
      type: "GET",
      success: function(data){
          setTimeout(getPoll,15000);
          // renderParticipant(data);
          statusParticipant(data[2])
      }
    });
}


if(poll.user.autheticated == 'true'){
  beatPoll();
  function beatPoll(){

    $.ajax({
      headers: {
        'X-CSRF-Token': $('input[name="_token"]').val()
      },
      data: {
        'id': poll.user.id,
        'group_id': poll.group_id
      },
      url: poll.query.beat,
      type: "POST",
      success: function(data){
          setTimeout(beatPoll,15000);
      }
    });
  }
}
   
  function statusParticipant(data){
    for(time of data){
      var offset = new Date()/1000 + new Date().getTimezoneOffset()*60
      var online = new Date(time.last_online_at).getTime()/1000
        if(offset-15 > online){
          console.log(time.id, 'this user is offline')
        }
        else{
          console.log(time.id, 'this user is online')
        }
    }
  }


// onlineStatus = document.querySelectorAll('.online-status')
// participant = document.querySelector('#participant');
// document.querySelector('#user_beat').value,
// document.querySelector('#group_beat').value,
// host = document.querySelector('#host');
// participantsQuery = document.querySelector('#participant_route').value;
// var beatQuery = document.querySelector('#beat_route').value;
  // function renderParticipant(data){
  //   participant.innerHTML = '';
  //   host.innerHTML = '';
  //   for(var i = 0; i<data[1].length; i++){
  //     var participantHost = document.createElement('p')
  //     // css class here
  //     // participantHost.className = '..'
  //     participantHost.style.fontSize = '12px';
  //     if(data[1][i].id == data[0].host_id){
  //       participantHostText = document.createTextNode(`${data[1][i].name} ${data[1][i].lastname} (HOST)`)
  //       hostText = document.createTextNode(`host: ${data[1][i].name} ${data[1][i].lastname}`)
  //     }
  //     else{
  //       participantHostText = document.createTextNode(`${data[1][i].name} ${data[1][i].lastname}`)
  //     }
  //     participantHost.appendChild(participantHostText) 
  //     participant.appendChild(participantHost);
  //     }
  //     if(data[0].host_id == null){
  //       hostText = document.createTextNode(`NO HOST IN THIS GROUP`)
  //     }
  //     host.appendChild(hostText)
  //   }