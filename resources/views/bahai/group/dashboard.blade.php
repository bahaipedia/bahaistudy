@extends('template')
@section('cnt')

<div class="columna-grupo">
	<input id='participant_route' value='{{route('api.group.participant', [Crypt::encryptString($group->id)])}}' type='hidden'/>
	@if(auth()->check())
		<input id='beat_route' value='{{route('api.group.beat')}}' type='hidden'/>
		<input type='hidden' value='{{Crypt::encryptString(auth()->user()->id)}}' id='user_beat'/>
		<input type='hidden' value='{{Crypt::encryptString($group->id)}}' id='group_beat'/>
	@endif
	{!! csrf_field() !!}

	{{--<h1>{{$group->name}}</h1>--}}
<div class="informacion">

		<img class="imagen-libro-dash" src="{{asset('/img/ki.png')}}" />
		<div class="informacion-dash">
			<h4 class="autor-nombre-dash">{{$group->book->author->name}} {{$group->book->author->lastname}}</h4>
			<h3 class="libro-nombre-dash">{{$group->book->name}}</h3>
			<h5 class="integrantes-dash">
				{{$group->participants_count}} Participants
			</h5>
			<h5 class="host-dash">
				@if($group->host_id != NULL)	
				<b>HOST:</b> {{$group->host->name}} {{$group->host->lastname}}
				@else
	<h5>NO HOST IN THIS GROUP</h5>
	@endif
			</h5>
			<p class="bloqtext-dash">
				{{$group->description}}
			</p>
			<div class="botones-dash">
				@if($group->is_participant == 0 && auth()->check())
				<form method='POST' action='{{route('group.join')}}'>
					{!! csrf_field() !!}
					<input name='id' value='{{$group->id}}' type='hidden'/>
					<button class="login-boton dashposition">join</button>
				</form>
				{{-- HICE ESTE ELSE, ESTÁ BIEN HECHO? SIII 👏--}}
				@else
				<a class="chat-dash" href='{{route('group.chat', [str_replace(' ', '-', str_replace('/', ' ', str_replace('#', 'n', $group->book->name))), $group->route])}}'>JOIN CHAT</a>
			@endif
		</div>
		</div>
		</div>


{{--

	<p>book: {{$group->book->name}} by {{$group->book->author->name}} {{$group->book->author->lastname}}</p>
	
	<p>name: {{$group->name}}</p>

	<p>url: <a href='{{$group->url}}'>{{$group->url}}</a></p>
	<span style='font-size:12px; display: flex;'>
	@foreach($at as $a)
		<span>AT: {{$weekday[$a->day_of_week]}} {{date("h:i", strtotime( $a->start_at ))}} to {{date("h:i", strtotime( $a->finish_at ))}} ||</span>
	@endforeach
	</span>
</div>

--}}


{{-- 

<div style='font-size:12px; display: flex;  flex-direction: column; width: 90%; height: 150px; border:1px solid black;'>
<p>messages</p>

</div>
@if(auth()->check())
<textarea placeholder='Write your message here' style='display: flex; align-items: center;  flex-direction: column; width: 90%; height: 30px; border:1px solid black;' ></textarea>
@endif
<br>
<div style='font-size:12px; display: flex;  align-items: center; justify-content: center; flex-direction: column; width: 90%; height: 60px;'>
	@if(auth()->check())

		@if(auth()->user()->id === $group->host_id)
			<form method='POST' action='{{route('group.stepdown')}}'>
				{!! csrf_field() !!}
				<input name='id' value='{{$group->id}}' type='hidden'/>
				<button style='width:150px;'>step down as a host</button>
			</form>


		@elseif($group->host_id === NULL && auth()->user()->email_validated != NULL && $group->is_participant != 0)
			<form method='POST' action='{{route('group.stepup')}}'>
				{!! csrf_field() !!}
				<input name='id' value='{{$group->id}}' type='hidden'/>
				<button style='width:150px;'>be the host</button>
			</form>
		@endif

		@if(auth()->user()->id !== $group->host_id && auth()->check() && $group->is_participant != 0)
		<form method='POST' action='{{route('group.leave')}}'>
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
		<a href='{{route('update.group', [Crypt::encryptString($group->id)])}}'>edit info</a>
	@endif
	@endif
	<a href={{route('welcome')}}>home</a>
		--}}


<div class="participants-list">
	<h2 class="parti-dash">List of participants<br></h2>
		<h4 class="max-dash">(max {{$group->max_size}})</h4>
	<div id='participant'>
		@foreach($participants as $p)
			@if($p->user_id == $group->host_id)
			<div class="particip-dash">
			<div class="perfil-dash"></div>
			<h4 class="dash-list">{{$p->user->name}} {{$p->user->lastname}} (HOST)</h4>
			</div>
			@else
			<div class="particip-dash">
				<div class="perfil-dash"></div>
			<h4 class="dash-list">{{$p->user->name}} {{$p->user->lastname}} </h4>
			</div>
			@endif
		@endforeach
		</div>
</div>
</div>


<script>
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

					document.querySelector('#participant').innerHTML += +data[1][i].name+' '+data[1][i].lastname+' (HOST)
					document.querySelector('#host').innerHTML = 'host: '+data[1][i].name+' '+data[1][i].lastname
				}
				else{
					document.querySelector('#participant').innerHTML += +data[1][i].name+' '+data[1][i].lastname+
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
</script>
@stop