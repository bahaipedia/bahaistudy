{{-- 😢 sorry por el css embebido pero trate de hacerlo para que sea dinamica el estilo de la barra y no dependa de la cantidad --}}
<div id="barra">
  <img id="logotipo" src="{{asset('/img/logotype.svg')}}" />

  <div style='justify-content:flex-end' id="enlaces">
    <a style='margin-left:50px;' class="b-principal" href="{{route('welcome')}}">HOME</a>
    <a style='margin-left:50px;' class="b-principal" href="{{route('dev.welcome')}}">DEV</a>
    @if(auth()->user() !== NULL)
    <div style='margin-left:50px;' class="user">
      <div class="profile-pic"> </div>
      <a class="nombre" href=" #">{{auth()->user()->name}} {{auth()->user()->lastname}}</a>
    </div>
    @else
    <div style='margin-left:50px;' class="login">
      <a class="login-boton" href={{route('login')}}>LOGIN</a>
    </div>
    @endif

  </div>
</div>