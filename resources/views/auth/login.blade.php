@extends('template')
@section('cnt')

<h1>login form</h1>
<form method=POST action='{{route('login')}}' class='wrap-r'>
{!! csrf_field() !!}
	
<label for='email'>email</label>
<input id='email' name='email' required type='email'>
<br>

<label for='password'>password</label>
<input id='password' name='password' required type='password'>
<p>{!! $errors->first('email', '<p>please check</p>')!!}</p>
<br>
<button>LOGIN</button>
</form>
<a href={{route('register')}}>register</a>
<a href={{route('welcome')}}>home</a>
@stop