@extends('template')
@section('cnt')
<input id='route' value='{{route('api.group.participant', [Crypt::encryptString($group->id)])}}' type='hidden'/>
<div style='display: flex;  flex-direction: column; align-items: center; justify-content: flex-start; width: 100%; height: 95vh;'>
<h1>{{$group->name}}</h1>
@if($group->is_participant == 0)
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
	<p>host: {{$group->host->name}} {{$group->host->lastname}}</p>
	@else
	<p>host: no host yet</p>
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
		<p style="font-size: 12px">{{$p->user->name}} {{$p->user->lastname}}</p>
		@else
		<p style="font-size: 12px">{{$p->user->name}} {{$p->user->lastname}}</p>
		@endif
	@endforeach
	</div>
</div>
</div>
<div style='flex-grow: 2'></div>

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


		@elseif($group->host_id === NULL && auth()->user()->email_validated == 1 && $group->is_participant != 0)
			<form method='POST' action='{{route('group.stepup')}}'>
				{!! csrf_field() !!}
				<input name='id' value='{{$group->id}}' type='hidden'/>
				<button style='width:150px;'>be the host</button>
			</form>
		@endif

		@if(auth()->user()->id !== $group->host_id && auth()->check() && $group->is_participant != 0)
		<form method='POST' action='{{route('group.retire')}}'>
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
	@endif
	@if(auth()->user()->id === $group->host_id)
		<a href='{{route('update.group', [Crypt::encryptString($group->id)])}}'>edit info</a>
	@endif
	<a href={{route('welcome')}}>home</a>
</div>
<script>
	setInterval(function(){
		var url = document.querySelector('#route').value;
		$.ajax({
	        url: url,
	        type: "GET",
	        success: function(data){
	   			renderParticipant(data);
	        }
		});
	}, 5000)
	function renderParticipant(data){
		document.querySelector('#participant').innerHTML = '';
		for(var i = 0; i<data.length; i++){
			document.querySelector('#participant').innerHTML += '<p style="font-size: 12px">'+data[i].name+' '+data[i].lastname+'</p>'
		}
	}


</script>
@stop