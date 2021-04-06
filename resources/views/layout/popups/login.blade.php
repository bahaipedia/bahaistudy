<div id="caja-login" class='pop-up-general'>
    <div class="organizar-elementos">
      <div class="cerrar">
        <a onclick="closePopup('caja-login')" href="#" id="equis">X</a>        
    </div>
    <img class="logotipo-verti" src="{{asset('/img/logo-color.svg')}}" />

    <form method=POST action='{{route('login')}}' class='wrap-r'>
      {!! csrf_field() !!}

      <label for='email'> </label>
      <input id='email' type='email' class='formulario' name=' email' required type='email' placeholder='your email'>
      <br>

      <label for='password'></label>
      <input id='password' class='formulario' name='password' required type='password' placeholder='password'>
      <p>{!! $errors->first('email', '<p>please check</p>')!!}</p>
      <button class=" login-boton posicion-boton">LOGIN</button>
    </form>
    <p class="texto-pequeno">Don't have an account? <a class="#" onclick="openPopup('caja-register'); closePopup('caja-login')">Register</a></p>
  </div>
</div>