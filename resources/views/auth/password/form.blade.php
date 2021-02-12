@extends('template')
@section('cnt')

<h1>password reset form</h1>
<form method=POST action='{{route('auth.reset.password.validate')}}' class='wrap-r'>
{!! csrf_field() !!}
	
<label for='email'>email</label>
<input id='email' name='email' required type='email'>
<p>{!! $errors->first('email', '<p>not email founded</p>')!!}</p>
<br>
<button>SEND EMAIL</button>
</form>
<a href={{route('register')}}>register</a>
<a href={{route('welcome')}}>home</a>
@stop