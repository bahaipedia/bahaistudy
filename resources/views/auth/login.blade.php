@extends('template')
@section('cnt')
<div class="caja-centrada">
  <a href={{route('welcome')}}>home</a>

  <h1>login form</h1>
  <form method=POST action='{{route('login')}}' class='wrap-r'>
    {!! csrf_field() !!}

    <!--  <label for='email'></label> -->
    <input id='email' class="formulario" name='email' required type='email' placeholder='email'>
    <br>

    <!-- <label for='password'></label>-->
    <input id='password' name='password' required type='password' placeholder='password'>
    <p>{!! $errors->first('email', '
    <p>please check</p>')!!}</p>
    <br>
    <button class="login-boton">LOGIN</button>
  </form>
  <p class="texto-pequeno">Don't have an account? <a class="registrar" href={{route('register')}}>Register</a></p>
</div>
@stop