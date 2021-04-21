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
		@if($group->book->book_image_id !== NULL && Storage::disk('s3')->exists("bahai-dev/".$group->book->bookImage->code))
        <img class="imagen-libro-dash" src='{{Storage::disk("s3")->url("bahai-dev/".$group->book->bookImage->code)}}' onclick="openPopup('caja-up-group', ['group', '{{route("api.update.group", [Crypt::encryptString($group->id)])}}'])" src="{{asset('/img/ki.png')}}" />
        @else
        <img class="imagen-libro-dash portada-libro" />
        @endif
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
					<button class="login-boton chat-dash">JOIN GROUP</button>
				</form>
				@elseif(auth()->check())
				<form method='POST' action='{{route('group.leave')}}'>
					{!! csrf_field() !!}
					<input name='id' value='{{$group->id}}' type='hidden'/>
					<button class="chat-dash">LEAVE GROUP</button>
				</form>
				@endif
				<a class="chat-dash" href='{{route('group.chat', [str_replace(' ', '-', str_replace('/', ' ', str_replace('#', 'n', $group->book->name))), $group->route])}}'>GO TO CHAT</a>

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
				@if(auth()->user() && $p->user_id == auth()->user()->id)
				<form method='POST' action='{{route('group.stepdown')}}'>
					{!! csrf_field() !!}
					<input name='id' value='{{$group->id}}' type='hidden'/>
					<button class="host-boton">STEP DOWN AS A HOST</button>
				</form>
				@endif
				</div>
				@else
				<div class="particip-dash">
				<h4 class="dash-list">{{$p->user->name}} {{$p->user->lastname}} </h4>
				@if(auth()->user() && $group->host_id == NULL && $p->user_id == auth()->user()->id)
				<form method='POST' action='{{route('group.stepup')}}'>
					{!! csrf_field() !!}
					<input name='id' value='{{$group->id}}' type='hidden'/>
					<button class="host-boton">BECOME THE HOST</button>
				</form>
				@endif
				</div>
				@endif
	
			@endforeach
			</div>
	</div>

		</div>
</div>
@stop