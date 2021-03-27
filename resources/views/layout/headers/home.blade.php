<div id="barra">
  <img id="logotipo" src="{{asset('/img/logotype.svg')}}" />
  <div id="enlaces">
    <a class="b-principal" href="#">ABOUT</a>
    <a class="b-principal" href="#">HELP</a>
    <a class="b-principal" href="#">RESOURCE</a>
    <a class="b-principal" href="#">MATERIALS</a>
    <a class="b-principal" href="{{route('dev.welcome')}}">DEV</a>
    @if(auth()->user() !== NULL)
    <div class="user">
      <div class="profile-pic"> </div>
      <a class="nombre" href=" #">{{auth()->user()->name}} {{auth()->user()->lastname}}</a>
    </div>
    @else
    <div class="login">
      <a class="login-boton" href={{route('login')}}>LOGIN</a>
    </div>
    @endif

  </div>
</div>