@extends('template')
@section('cnt')

<h1>List of all containers stored</h1>
<br>
<br>
	@foreach($users as $u)
<div style='display: flex;  flex-direction: column; width: 500px; border:1px solid black;'>

		<h3>{{$u->name}} {{$u->lastname}}</h3>
		<p>{{$u->email}}</p>

	 	

	 	<form method='POST' action='{{route('auth.role')}}'>
			{!! csrf_field() !!}
			<input type='hidden' value="{{Crypt::encryptString($u->id)}}" name='user_id'/>
	 		<input style='width:50px;' value='{{$u->role}}' type='number' name='role' min='0' max='2' step='1' required/><button style='width:200px;'>change rol</button>
		</form>

	 	@if($u->id != auth()->user()->id)
	 		@if($u->status == NULL)
			 	<form method='POST' action='{{route('auth.disable')}}'>
					{!! csrf_field() !!}
					<input type='hidden' name='user_id' value='{{Crypt::encryptString($u->id)}}'/>
					<button style='width:200px;'>disable user</button>
				</form>
			@else
				<form method='POST' action='{{route('auth.enable')}}'>
					{!! csrf_field() !!}
					<input type='hidden' name='user_id' value='{{Crypt::encryptString($u->id)}}'/>
					<button style='width:200px;'>enable user</button>
				</form>
			@endif
		@endif

	 	<a href={{route('dev.update.user', [Crypt::encryptString($u->id)])}}>edit info</a>

</div>

	@endforeach
<br>
<a href={{route('dev.welcome')}}>home</a>
@stop