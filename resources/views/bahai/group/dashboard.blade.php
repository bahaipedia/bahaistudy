@extends('template')
@section('cnt')

{{-- estudia la ruta como si fuera un view -> view/layout..etc --}}
@include('layout.headers.group')

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
<div class="ficha-info">
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
				@else
				<a class="chat-dash" href='{{route('group.chat', [str_replace(' ', '-', str_replace('/', ' ', str_replace('#', 'n', $group->book->name))), $group->route])}}'>JOIN CHAT</a>
			@endif
		</div>
		</div>
	</div>
		</div>


<div class="participants-list">
	<h2 class="parti-dash">List of participants<br></h2>
		<h4 class="max-dash">(max {{$group->max_size}})</h4>
	<div id='participant'>
		@foreach($participants as $p)
			@if($p->user_id == $group->host_id)
			<div class="particip-dash">
			<h4 class="dash-list">{{$p->user->name}} {{$p->user->lastname}} (HOST)</h4>

			@if($group->host_id == auth()->user()->id)
			<div class="host-boton">STEP DOWN AS A HOST</div>
			@elseif($group->host_id == NULL)
			<div class="host-boton" href='#'>BE THE HOST</div>
			@endif

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


{{-- <script>
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
</script> --}}
@stop