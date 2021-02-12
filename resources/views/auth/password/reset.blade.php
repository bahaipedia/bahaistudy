@extends('template')
@section('cnt')

<h1>password reset form</h1>
<form method=POST action='{{route('auth.reset.password.post')}}' class='wrap-r'>
{!! csrf_field() !!}
<input name='valemail' type=hidden value={{$email}}/>
<input name='token' type=hidden value={{$token}}/>

<label for='email'>email</label>
<input id='email' name='email' required type='email'>

<label for='password'>new password</label>
<input id='password' name='password' required type='password'>
<label for='c-password'>confirm password</label>
<input id='c-password' name='password' required type='password'>
<p>{!! $errors->first('email', '<p>not email founded</p>')!!}</p>

<br>
<button>CHANGE PASSWORD</button>
</form>
<a href={{route('register')}}>register</a>
<a href={{route('welcome')}}>home</a>
@stop
