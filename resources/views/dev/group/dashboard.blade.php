@extends('template')
@section('cnt')
<!--
<div class="container-general">
  <div class="informacion">
    <div class="imagen-libro"></div>
    <div class="informacion-libro">
      <h4 class="autor-nombre">BAHÁ'U'LLÁH</h4>
      <h3 class="libro-nombre">{{$group->name}}</h3>
      <h5 class="">7 integrantes</h5>
      <h5 class="host">
        <b>HOST:</b> DAVID HASLIP
      </h5>
      <p class="bloqtext">
        Description... Lorem ipsum dolor sit amet, consectetur adipiscing
        elit, sed do eiusmod tempor incididunt ut labore et dolore magna
        aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
        do eiusmod tempor incididunt ut labore et dolore magna aliqua.
      </p>
      <button class="show-more chat">
        group chat
      </button>
    </div>
  </div>
  <dv class="participants-list">
    <h3 class="participants-title">
      List of participa
      <div class="persona">
        <div class="foto-perfil"></div>
        <h4 class="nombre-participante">
          Jeanniffer Pimentel
        </h4>
      </div>
      <div class="persona">

        <div class="foto-perfil"></div>
        <h4 class="nombre-participante">
          David Haslip
        </h4>
      </div>
      <div class="persona">
        <div class="foto-perfil"></div>
        <h4 class="nombre-participante">
          Jeanniffer Pimentel
        </h4>
      </div>
      <div class="persona">
        <div class="foto-perfil"></div>
        <h4 class="nombre-participante">
          David Haslip
        </h4>
      </div>
      <div class="persona">
        <div class="foto-perfil"></div>
        <h4 class="nombre-participante">
          Jeanniffer Pimentel
        </h4>
      </div>
      <div class="persona">
        <div class="foto-perfil"></div>
        <h4 class="nombre-participante">
          David Haslip
        </h4>
      </div>
		-->
<input id='participant_route' value='{{route('dev.api.group.participant', [Crypt::encryptString($group->id)])}}' type='hidden'/>
@if(auth()->check())
	<input id='beat_route' value='{{route('dev.api.group.beat')}}' type='hidden'/>
	<input type='hidden' value='{{Crypt::encryptString(auth()->user()->id)}}' id='user_beat'/>
	<input type='hidden' value='{{Crypt::encryptString($group->id)}}' id='group_beat'/>
@endif
{!! csrf_field() !!}

<div style='display: flex;  flex-direction: column; align-items: center; justify-content: flex-start; width: 100%; height: 95vh;'>
<h1>{{$group->name}}</h1>
@if($group->is_participant == 0)
	<form method='POST' action='{{route('dev.group.join')}}'>
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
</div>


<input id='route' value='{{route('api.group.participant', [Crypt::encryptString($group->id)])}}' type='hidden' />
<div
  style='display: flex;  flex-direction: column; align-items: center; justify-content: flex-start; width: 100%; height: 95vh;'>
  <h1>{{$group->name}}</h1>
  @if($group->is_participant == 0)
  <form method='POST' action='{{route('group.join')}}'>
    {!! csrf_field() !!}
    <input name='id' value='{{$group->id}}' type='hidden' />
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
      <p>host: {{$group->host->name}} {{$group->host->lastname}}</p>
      @else
      <p>host: no host yet</p>
      @endif
      <p>url: <a href='{{$group->url}}'>{{$group->url}}</a></p>
      <span style='font-size:12px; display: flex;'>
        @foreach($at as $a)
        <span>AT: {{$weekday[$a->day_of_week]}} {{date("h:i", strtotime( $a->start_at ))}} to
          {{date("h:i", strtotime( $a->finish_at ))}} ||</span>
        @endforeach
      </span>
    </div>
    <div style='display: flex;  flex-direction: column; width: 30%;'>
      <p>participants, (max {{$group->max_size}})</p>
      <br>
      <div id='participant'>
        @foreach($participants as $p)
        @if($p->user_id == $group->host_id)
        <p style="font-size: 12px">{{$p->user->name}} {{$p->user->lastname}}</p>
        @else
        <p style="font-size: 12px">{{$p->user->name}} {{$p->user->lastname}}</p>
        @endif
        @endforeach
      </div>
    </div>
  </div>
  <div style='flex-grow: 2'></div>
		@if(auth()->user()->id === $group->host_id)
			<form method='POST' action='{{route('dev.group.stepdown')}}'>
				{!! csrf_field() !!}
				<input name='id' value='{{$group->id}}' type='hidden'/>
				<button style='width:150px;'>step down as a host</button>
			</form>

  <div
    style='font-size:12px; display: flex;  flex-direction: column; width: 90%; height: 150px; border:1px solid black;'>
    <p>messages</p>

  </div>
  @if(auth()->check())
  <textarea placeholder='Write your message here'
    style='display: flex; align-items: center;  flex-direction: column; width: 90%; height: 30px; border:1px solid black;'></textarea>
  @endif
  <br>
  <div
    style='font-size:12px; display: flex;  align-items: center; justify-content: center; flex-direction: column; width: 90%; height: 60px;'>
    @if(auth()->check())

    @if(auth()->user()->id === $group->host_id)
    <form method='POST' action='{{route('group.stepdown')}}'>
      {!! csrf_field() !!}
      <input name='id' value='{{$group->id}}' type='hidden' />
      <button style='width:150px;'>step down as a host</button>
    </form>


    @elseif($group->host_id === NULL && auth()->user()->email_validated == 1 && $group->is_participant != 0)
    <form method='POST' action='{{route('group.stepup')}}'>
      {!! csrf_field() !!}
      <input name='id' value='{{$group->id}}' type='hidden' />
      <button style='width:150px;'>be the host</button>
    </form>
    @endif

    @if(auth()->user()->id !== $group->host_id && auth()->check() && $group->is_participant != 0)
    <form method='POST' action='{{route('group.retire')}}'>
      {!! csrf_field() !!}
      <input name='id' value='{{$group->id}}' type='hidden' />
      <button style='width:200px;'>step down of the group</button>
    </form>
    @endif
    @endif

  </div>
  @if(!auth()->check())
  <a href={{route('login')}}>login</a>
  <a href={{route('register')}}>register</a>
  @endif
  @if(auth()->user()->id === $group->host_id)
  <a href='{{route('update.group', [Crypt::encryptString($group->id)])}}'>edit info</a>
  @endif
  <a href={{route('welcome')}}>home</a>
</div>
		@elseif($group->host_id === NULL && auth()->user()->email_validated != NULL && $group->is_participant != 0)
			<form method='POST' action='{{route('dev.group.stepup')}}'>
				{!! csrf_field() !!}
				<input name='id' value='{{$group->id}}' type='hidden'/>
				<button style='width:150px;'>be the host</button>
			</form>
		@endif

		@if(auth()->user()->id !== $group->host_id && auth()->check() && $group->is_participant != 0)
		<form method='POST' action='{{route('dev.group.retire')}}'>
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
<!--
<script>
	setInterval(function() {
		var url = document.querySelector('#route').value;
		$.ajax({
			url: url,
			type: "GET",
			success: function(data) {
				renderParticipant(data);
			}
		});
	}, 5000)

	onlineStatus = document.querySelectorAll('.online-status')
	console.log(onlineStatus[1])
	var cript = 
	setInterval(function(){
		var url = document.querySelector('#participant_route').value;
		var url2 = document.querySelector('#beat_route').value;

		$.ajax({
	        url: url,
	        type: "GET",
	        success: function(data){
	   			renderParticipant(data);
	        }
		});

		$.ajax({

		headers: {
        'X-CSRF-Token': $('input[name="_token"]').val()
   		},
    	data: {
    		'id': document.querySelector('#user_beat').value,
    		'group_id': document.querySelector('#group_beat').value,
		},
        url: url2,
        type: "POST",
        success: function(data){
        }
	});
	}, 15000)

	

	function renderParticipant(data){
		document.querySelector('#participant').innerHTML = '';
		for(var i = 0; i<data[1].length; i++){
			
				if(data[1][i].id == data[0].host_id){

					document.querySelector('#participant').innerHTML += '<p style="font-size: 12px">'+data[1][i].name+' '+data[1][i].lastname+' (HOST) </p>'
					document.querySelector('#host').innerHTML = 'host: '+data[1][i].name+' '+data[1][i].lastname
				}
				else{
					document.querySelector('#participant').innerHTML += '<p style="font-size: 12px">'+data[1][i].name+' '+data[1][i].lastname+'</p>'
				}
			}
		if(data[0].host_id == null){
				document.querySelector('#host').innerHTML = 'NO HOST IN THIS GROUP'
		}

		for(var ii = 0; ii<data[2].length; ii++){
			var dt = new Date();
         	var tz = dt.getTimezoneOffset();
         	var actual = ((dt/1000)-tz);
			if(new Date(data[2][ii].last_online_at).getTime()/1000 - actual - 18285 > 0){
				// is online
			}
			else{
				// is not online
			}
		}

	}


function renderParticipant(data) {
  document.querySelector('#participant').innerHTML = '';
  for (var i = 0; i < data.length; i++) {
    document.querySelector('#participant').innerHTML += '<p style="font-size: 12px">' + data[i].name + ' ' + data[i]
      .lastname + '</p>'
  }
}
*/
</script>
-->
@stop