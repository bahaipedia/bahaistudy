@extends('template')
@section('cnt')

<input id='participant_route' value='{{route('api.group.participant', [Crypt::encryptString($group->id)])}}' type='hidden'/>
<input id='beat_route' value='{{route('api.group.beat')}}' type='hidden'/>

@if(auth()->check())
  <input type='hidden' id='val' value='yes'/>
  <input type='hidden' value='{{Crypt::encryptString(auth()->user()->id)}}' id='user_beat'/>
  <input type='hidden' value='{{Crypt::encryptString($group->id)}}' id='group_beat'/>
@else
  <input type='hidden' id='val' value='no'/>
@endif
{!! csrf_field() !!}

<div style='display: flex;  flex-direction: column; align-items: center; justify-content: flex-start; width: 100%; height: 95vh;'>
<h1>{{$group->name}}</h1>
@if($group->is_participant == 0 && auth()->check())
  <form method='POST' action='{{route('group.join')}}'>
    {!! csrf_field() !!}
    <input name='id' value='{{$group->id}}' type='hidden'/>
    <button style='width:150px;'>join</button>
  </form>
@endif
<br>
<br>
<div style='display: flex;  flex-direction: row; width: 90%; border:1px solid black;'>
<div style='display: flex;  flex-direction: column; width: 70%;'>
  <p>book: {{$group->book->name}} by {{$group->book->author->name}} {{$group->book->author->lastname}}</p>
  
  <p>name: {{$group->name}}</p>
  <p>description: {{$group->description}}</p>
  @if($group->host_id != NULL)  
  <p id='host'>host: {{$group->host->name}} {{$group->host->lastname}}</p>
  @else
  <p id='host'>NO HOST IN THIS GROUP</p>
  @endif
  <p>url: <a href='{{$group->url}}'>{{$group->url}}</a></p>
  <span style='font-size:12px; display: flex;'>
  @foreach($at as $a)
    <span>AT: {{$weekday[$a->day_of_week]}} {{date("h:i", strtotime( $a->start_at ))}} to {{date("h:i", strtotime( $a->finish_at ))}} ||</span>
  @endforeach
  </span>
</div>
<div style='display: flex;  flex-direction: column; width: 30%;'>
  <p>participants, (max {{$group->max_size}})</p>
  <br>
  <div id='participant'>
  @foreach($participants as $p)
    @if($p->user_id == $group->host_id)
    <p style="font-size: 12px">{{$p->user->name}} {{$p->user->lastname}} (HOST) </p>
    @else
    <p style="font-size: 12px">{{$p->user->name}} {{$p->user->lastname}} </p>
    @endif
   
  @endforeach
  </div>
</div>
<div style='display: flex;  flex-direction: column; width: 30%;'>
  <p>drop participants</p>
  
  <br>
  <div id='participant'>
  @foreach($participants as $p)
  @if(auth()->user()->role == 1)
    <form method='POST' action='{{route('dev.admin.group.drop')}}'>
      {!! csrf_field() !!}

      <input type='hidden' name='id' value='{{Crypt::encryptString($p->user->id)}}'/>
      <input type='hidden' name='group_id' value='{{$group->id}}'/>
      <button>drop</button>
    </form>
  @endif
  @endforeach
  </div>
</div>
</div>
<div style='flex-grow: 2'></div>

<div id='message-box' style='font-size:12px; display: flex;  flex-direction: column; width: 90%; height: 150px; border:1px solid black; overflow-y: auto;'>
@if(auth()->check())
<input type='hidden' id='message-string' value='{{auth()->user()->name}} {{auth()->user()->lastname}} said:'/>
@else
<input type='hidden' id='message-string' value='none'/>

@endif
<input id='message_poll' value='{{route('dev.api.message.poll', [$group->id])}}' type='hidden'/>

@foreach($messages as $m)
  @if(auth()->check() && $m->user_id == auth()->user()->id)
    <span data-id='{{$m->id}}' class='message-span' style='align-self: flex-end;'><span style='color:grey;'>{{$m->user->name}} {{$m->user->lastname}} said:</span><span>{{$m->message}}</span></span>
  @else
    <span data-id='{{$m->id}}' class='message-span' style='align-self: flex-start;'><span style='color:grey;'>{{$m->user->name}} {{$m->user->lastname}} said:</span><span>{{$m->message}}</span></span>
  @endif
@endforeach
</div>

{{-- THIS FUNTION WAS EDITED --}}
<form method="POST" id='message-form' style='display: flex; align-items: center;  flex-direction: column; width: 90%; height: 30px; ' action={{route('dev.group.message')}}>
<input id='message-route' value='{{route('dev.group.message')}}' type='hidden'/>
<input id='message-group' value='{{$group->id}}' type='hidden'/>
@if(auth()->user())
<textarea id='message-input' placeholder='Write your message here' style='display: flex; align-items: center;  flex-direction: column; width: 100%;  border:1px solid black;' ></textarea>
</form>
@endif
<br>
<div style='font-size:12px; display: flex;  align-items: center; justify-content: center; flex-direction: column; width: 90%; height: 60px;'>
  @if(auth()->check())

    @if(auth()->user()->id === $group->host_id)
      <form method='POST' action='{{route('dev.group.stepdown')}}'>
        {!! csrf_field() !!}
        <input name='id' value='{{$group->id}}' type='hidden'/>
        <button style='width:150px;'>step down as a host</button>
      </form>


    @elseif($group->host_id === NULL && auth()->user()->email_validated != NULL && $group->is_participant != 0)
      <form method='POST' action='{{route('dev.group.stepup')}}'>
        {!! csrf_field() !!}
        <input name='id' value='{{$group->id}}' type='hidden'/>
        <button style='width:150px;'>be the host</button>
      </form>
    @endif

    @if(auth()->user()->id !== $group->host_id && auth()->check() && $group->is_participant != 0)
    <form method='POST' action='{{route('dev.group.leave')}}'>
      {!! csrf_field() !!}
      <input name='id' value='{{$group->id}}' type='hidden'/>
      <button style='width:200px;'>step down of the group</button>
    </form>
    @endif
  @endif

</div>
  @if(!auth()->check())
    <a href={{route('login')}}>login</a>
    <a href={{route('register')}}>register</a>
  @else
  @if(auth()->user()->id === $group->host_id)
    <a href='{{route('dev.update.group', [Crypt::encryptString($group->id)])}}'>edit info</a>
  @endif
  @endif
  <a href={{route('welcome')}}>home</a>
</div>
<script>

  
  onlineStatus = document.querySelectorAll('.online-status')

  participant = document.querySelector('#participant');
  host = document.querySelector('#host');
  // logic if user is not logged in
  poll();
  function poll(){
    var participantsQuery = document.querySelector('#participant_route').value;
     $.ajax({
        url: participantsQuery,
        type: "GET",
        success: function(data){
            setTimeout(poll,5000);
            renderParticipant(data);
            statusParticipant(data[2])
        }
      });
  }


  if(document.querySelector('#val').value == 'yes'){
    beatPoll();
    function beatPoll(){
      var beatQuery = document.querySelector('#beat_route').value;
      // Render host logic
      $.ajax({
        headers: {
          'X-CSRF-Token': $('input[name="_token"]').val()
        },
        data: {
          'id': document.querySelector('#user_beat').value,
          'group_id': document.querySelector('#group_beat').value,
        },
        url: beatQuery,
        type: "POST",
        success: function(data){
            setTimeout(beatPoll,15000);
        }
      });
    }
  }
   
  function statusParticipant(data){
    for(time of data){
      // console.log(new Date().getTimezoneOffset())
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

  function renderParticipant(data){
    participant.innerHTML = '';
    host.innerHTML = '';
    for(var i = 0; i<data[1].length; i++){
      var participantHost = document.createElement('p')
      // css class here
      // participantHost.className = '..'
      participantHost.style.fontSize = '12px';
      if(data[1][i].id == data[0].host_id){
        participantHostText = document.createTextNode(`${data[1][i].name} ${data[1][i].lastname} (HOST)`)
        hostText = document.createTextNode(`host: ${data[1][i].name} ${data[1][i].lastname}`)
      }
      else{
        participantHostText = document.createTextNode(`${data[1][i].name} ${data[1][i].lastname}`)
      }
      participantHost.appendChild(participantHostText) 
      participant.appendChild(participantHost);
      }
      if(data[0].host_id == null){
        hostText = document.createTextNode(`NO HOST IN THIS GROUP`)
      }
      host.appendChild(hostText)
    }


  // Message logic
  message = {}
  message.box = document.querySelector('#message-box');
  message.span = document.querySelectorAll('.message-span');
  message.box.scrollTop = message.box.scrollHeight;
  message.string = document.querySelector('#message-string').value;
  message.form = document.querySelector('#message-form');
  message.input = document.querySelector('#message-input');
  message.render = {}
  // class Menssage(){
  //   constructor(){

  //   }
  // }
  var messageQuery = document.querySelector('#message_poll').value;
  var messageTimer;
  messagePoll();
  function messagePoll(){
    var url = messageQuery;
     $.ajax({
        url: url,
        type: "GET",
        success: function(data){
            message.box.innerHTML = ''
            for(var i = 0; i<data.length; i++){
              messageRender(data[i].message, data[i].self, data[i].user_info, 'get')
            }
            messageTimer = setTimeout(messagePoll,5000);
        }
      });
  }


  function messageRender(newMessage, user, info, method){
      message.render.container = document.createElement('span')
      message.render.info = document.createElement('span')
      message.render.info.style.color = 'grey';
      message.render.text = document.createElement('span')
      message.render.text.style.color = 'black'

      if(user == 'self'){
        message.render.container.style.alignSelf = 'flex-end';        
        message.render.info.innerHTML = message.string;
      }else{
        message.render.container.style.alignSelf = 'flex-start';
        message.render.info.innerHTML = info;
      }
      if(method == 'push'){
        message.render.text.style.color = 'grey'
      }
      message.render.container.appendChild(message.render.info);
      message.render.container.appendChild(message.render.text);
      message.box.appendChild(message.render.container)
      message.render.text.innerHTML = newMessage;
      message.box.scrollTop = message.box.scrollHeight;
      // message.box.scrollTop = message.box.scrollTopMax;
      return message.render.text;
  }

  message.form.addEventListener('keyup', function(e){
    if(e.keyCode == 13){
      clearTimeout(messageTimer);
      newMessage = message.input.value;
      message.input.value = '';
      var renderMessege = messageRender(newMessage, 'self', '', 'push')
      message.box.scrollTop = message.box.scrollHeight;
      // message.box.scrollTop = message.box.scrollTopMax;
      $.ajax({
        headers: {
          'X-CSRF-Token': $('input[name="_token"]').val()
        },
        data: {
          'new_message': newMessage,
          'group_id': document.querySelector('#group_beat').value,
        },
        url: document.querySelector('#message-route').value,
        type: "POST",
        success: function(data){
          messageTimer = setTimeout(messagePoll,5000);

          renderMessege.style.color = 'black';
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
          renderMessege.style.color = 'red';
        }
      });
    }
  })
  


</script>
@stop