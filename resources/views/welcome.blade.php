<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css" />
  <title>Bahai</title>

  <link rel="stylesheet" href="styles.css" />
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap"
    rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet" />
</head>

<body>

  <div class="general-container">
    <div id="barra">
      <img id="logotipo" src="../public/img/logotype.svg" />
      <div id="enlaces">
        <a href="#">ABOUT</a>
        <a href="#">HELP</a>
        <a href="#">RESOURCES</a>
        <a href="#">MATERIALS</a>
        <a href="{{route('dev.welcome')}}">DEV</a>
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

    <div id="hero-image">
      <div id="textos">
        <h1 id="hero-title">Welcome to BahaiStudy.Group,</h1>
        <h2 id="hero-subtitle">
          a website designed to
          <b id="resaltar">
            help you connect with individuals who want to study
          </b>
          the Writings in a group setting.
        </h2>
        <div id="alert">
          <i class="icono"></i>
          <h5 class="hero-texto">
            Notes that this website is not functional at this time but we are
            creating it now. Study groups will be held virtually, are open to
            everyone, and there is no cost or other requirements to join. The
            group can decide what specific format the meetings should have,
            click here for a suggested format.
          </h5>
        </div>
      </div>
      <div id="flecha">
      </div>
    </div>

    <div class="contenedor">
      <div class="subtitulo">
        <h3>Works of the Central Figures</h3>
      </div>
      <i class="puntos"></i>
    </div>
    <div class="barra-info">
      <div class="contenedor-vistas">
        <i class="cuadricula"> </i>
        <i class="lista"> </i>
      </div>

      <div class="contenedor-busqueda">
        <h5 class="filtro">filter</h5>
        <h5 class="filtro">sort</h5>
        <h5 class="filtro">search</h5>
      </div>
    </div>

    <div id="contenedor-libros">
      @foreach($groups as $g)
      <div class="ficha-libro">
        {{-- Jeannifer you can see here how to link the img url --}}
        <img class="portada-libro" src="{{asset('/img/ki.png')}}" />
        <div class="parte-derecha-ficha">
          <h4 class="autor-nombre">{{$g->book->author->name}} {{$g->book->author->lastname}}</h4>
          <h3 class="libro-nombre">{{$g->book->name}}</h3>
          <p class="spaces">({{$g->max_size}} spaces available)</p>
          <p class="descripcion-libro">
            {{$g->description}}
          </p>
          <a class="join-ficha" href='{{route('group.dashboard', [$g->route])}}'>JOIN</a>
        </div>
      </div>
      @endforeach
    </div>

    <div class="contenedor segundo">
      <div class="subtitulo">
        <h3>Works of the House of Justice</h3>
      </div>
      <i class="puntos"></i>
      <!--FILTROS-->
      <div class="barra-info">
        <div class="contenedor-vistas">
          <i class="cuadricula"></i>
          <i class="lista"></i>
        </div>
        <div class="contenedor-busqueda">
          <h5 class="amarilloline">filter</h5>
          <h5 class="amarilloline">sort</h5>
          <h5 class="amarilloline">search</h5>

        </div>
      </div>

      <div class="contenedor-lista">
        <!--LISTA - LIBRO 001-->
        <div class="lista-libro">
          <div class="circulo-libro"></div>
          <div class="autor-libro">
            <h4 class="autor-nombre amarillo">BAHA'U'LLÁH</h4>
            <h3 class="libro-nombre">The Kitáb-I-Iqán</h3>
          </div>
          <p class="descripcion-libro-lista">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
            eiusmod tempor incididunt ut labore et dolore magna aliqua.
          </p>
          <div class="spaces-part">
            <p class="spaces">(3 spaces available)</p>
          </div>
          <button class="join-plus">+</button>
        </div>

        <!--LISTA - LIBRO 002-->
        <div class="lista-libro">
          <div class="circulo-libro"></div>
          <div class="autor-libro">
            <h4 class="autor-nombre amarillo">BAHA'U'LLÁH</h4>
            <h3 class="libro-nombre">The Kitáb-I-Iqán</h3>
          </div>
          <p class="descripcion-libro-lista">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
            eiusmod tempor incididunt ut labore et dolore magna aliqua.
          </p>
          <div class="spaces-part">
            <p class="spaces">(3 spaces available)</p>
          </div>
          <button class="join-plus">+</button>
        </div>

        <!--LISTA - LIBRO 003-->
        <div class="lista-libro">
          <div class="circulo-libro"></div>
          <div class="autor-libro">
            <h4 class="autor-nombre amarillo">BAHA'U'LLÁH</h4>
            <h3 class="libro-nombre">The Kitáb-I-Iqán</h3>
          </div>
          <p class="descripcion-libro-lista">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
            eiusmod tempor incididunt ut labore et dolore magna aliqua.
          </p>
          <div class="spaces-part">
            <p class="spaces">(3 spaces available)</p>
          </div>
          <button class="join-plus">+</button>
        </div>

        <!--LISTA - LIBRO 004-->
        <div class="lista-libro">
          <div class="circulo-libro"></div>
          <div class="autor-libro">
            <h4 class="autor-nombre amarillo">BAHA'U'LLÁH</h4>
            <h3 class="libro-nombre">The Kitáb-I-Iqán</h3>
          </div>
          <p class="descripcion-libro-lista">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
            eiusmod tempor incididunt ut labore et dolore magna aliqua.
          </p>
          <div class="spaces-part">
            <p class="spaces">(3 spaces available)</p>
          </div>
          <button class="join-plus">+</button>
        </div>

        <!--LISTA - LIBRO 005-->
        <div class="lista-libro">
          <div class="circulo-libro"></div>
          <div class="autor-libro">
            <h4 class="autor-nombre amarillo">BAHA'U'LLÁH</h4>
            <h3 class="libro-nombre">The Kitáb-I-Iqán</h3>
          </div>
          <p class="descripcion-libro-lista">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
            eiusmod tempor incididunt ut labore et dolore magna aliqua.
          </p>
          <div class="spaces-part">
            <p class="spaces">(3 spaces available)</p>
          </div>
          <button class="join-plus">+</button>
        </div>

        <button class="show-more-lista ">
          SHOW EVERYTHING
        </button>
      </div>
    </div>
    <div class="footer">
      <div class="linea-uno">
        <p class="footer-text">
          About
        </p>
        <p class="footer-text">
          Help
        </p>
        <p class="footer-text">
          Resources
        </p>
        <p class="footer-text">
          Materials
        </p>
      </div>

      <div class="linea-dos">
        <p class="footer-text">
          Terms of Use
        </p>
        <p class="footer-text">
          Privacy Policy
        </p>
      </div>

      <div class="linea-tres">
        <p class="copyright">
          © bahaistudygroup | 2021
        </p>
      </div>

    </div>
    {{-- Jeannifer you can see here how to link the 'js' url --}}
    <script src='{{asset('/js/ex.js')}}'></script>
</body>

</html>