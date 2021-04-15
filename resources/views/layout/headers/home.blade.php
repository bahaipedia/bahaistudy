<div id="barra">
  <a href='{{route('welcome')}}'><img id="logotipo" style='cursor:pointer;' src="{{asset('/img/logotype.svg')}}" /></a>
  <div id="enlaces">
    <a class="b-principal">ABOUT</a>
    <a class="b-principal">HELP</a>
    <a class="b-principal">RESOURCE</a>
    <a class="b-principal" href="#">MATERIALS</a>
    <a class="b-principal" href="{{route('dev.welcome')}}">DEV</a>
    @if(auth()->user() !== NULL)
    <div class="user">
      <div class="profile-pic"> </div>
      <a class="nombre" href=" #">{{auth()->user()->name}} {{auth()->user()->lastname}}</a>
    </div>
    @else
    <div class="login">
      <a class="login-boton" onclick='openPopup("caja-login")' href=#>LOGIN</a>
    </div>
    @endif

  </div>
</div>
