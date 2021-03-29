@extends('template')
@section('cnt')

<h1>update user form</h1>
<form enctype="multipart/form-data" method=POST action='{{route('dev.update.user.post')}}' class='wrap-r'>
{!! csrf_field() !!}
<input name="_method" type="hidden" value="PUT">

<input type='hidden' value="{{Crypt::encryptString($user->id)}}" name='user_id'/>

<label for='name'>name</label>
<input id='name' max='50' value='{{$user->name}}' name='name'  type='text'>
<br>
<label for='lastname'>lastname</label>
<input id='lastname' max='50' value='{{$user->lastname}}' name='lastname'  type='text'>
<br>
<label for='email'>email</label>
<input id='email' name='email' value='{{$user->email}}'  >
<br>

<label for='notifications'>notifications</label>
@if($user->notifications != 1)
	<input type='checkbox' name='notifications'/>
@else
	<input type='checkbox' name='notifications' checked/>
@endif
<br>

<button>UPDATE</button>
</form>
<a href={{route('dev.welcome')}}>home</a>
@stop