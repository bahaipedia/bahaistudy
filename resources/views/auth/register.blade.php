@extends('template')
@section('cnt')

<h1>register form</h1>

<form action='{{route('register.post')}}' method=POST class='wrap-r'>
{!! csrf_field() !!}
<label for='name'>name</label>
<input id='name' name='name' required type='text'>
<p>{!! $errors->first('name', '<p>something wrong with the name</p>')!!}</p>
<label for='lastname'>lastname</label>
<input id='lastname' name='lastname' required type='text'>
<p>{!! $errors->first('lastname', '<p>something wrong with the name</p>')!!}</p>
<br>
<label for='email'>email</label>
<input id='email' name='email' required type='email'>
<p>{!! $errors->first('email', '<p>something wrong with the email</p>')!!}</p>
<br>
<label for='password'>password</label>
<input id='password' name='password' required type='password'>
<p>{!! $errors->first('password', '<p>something wrong with the password</p>')!!}</p>
<br>
<label for='c-password'>confirm password</label>
<input id='c-password' name='password' required type='password'>
<br>
<button>REGISTER</button>
</form>
<a href={{route('login')}}>login</a>
<a href={{route('welcome')}}>home</a>
@stop