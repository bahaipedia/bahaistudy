<div id="caja-register" class='pop-up-general'>
    <div class="organizar-elementos" style="height: 650px;">
      <div class="cerrar">
        <a onclick="closePopup('caja-register')" id="equis">X</a>        
    </div>
    <img class="logotipo-verti" src="{{asset('/img/logo-color.svg')}}" />

    <form action='{{route('register.post')}}' method=POST class='wrap-r'>
     {!! csrf_field() !!}
      <input placeholder='name' name='name' class='formulario texto-form' required type='text'>
      <br>
      <input placeholder='email' name='email' class='formulario' required type='email'>
      <br>
      <input placeholder='password' name='password' class='formulario' required type='password'>
      <br>
      <input id='c-password' placeholder='repeat password' name='password' class='formulario' required type='password'>
      <br>
      <button class=" login-boton posicion-boton">REGISTER</button>
</form>
    <p class="texto-pequeno">Already have an account? <a class="#" onclick="closePopup('caja-register'); openPopup('caja-login');">Login</a></p>
  </div>

</div>



