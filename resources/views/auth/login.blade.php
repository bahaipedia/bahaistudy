@extends('template')
@section('cnt')
<div class="centrado">
  <div class="caja-centrada">
    <div class="cerrar">
      <a href="{{route('welcome')}}" class="equis">x</a>
    </div>
    <img class="logotipo" src="{{asset('/img/logo-color.svg')}}" />

    <form method=POST action='{{route('login')}}' class='wrap-r'>
      {!! csrf_field() !!}

      <label for='email'> </label>
      <input id='email' type='email' class='formulario' name=' email' required type='email' placeholder='your email'>
      <br>

      <label for='password'></label>
      <input id='password' class='formulario' name='password' required type='password' placeholder='password'>
      <p>{!! $errors->first('email', '
      <p>please check</p>')!!}</p>
      <button class=" login-boton posicion-boton">LOGIN</button>
    </form>
    <p class="texto-pequeno">Don't have an account? <a class="registrar" href={{route('register')}}>Register</a></p>
  </div>
</div>
@stop