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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
        <div id="login">
          <a class="login-boton" href="#"
          {{--{{route('login')}}
          --}}>LOGIN</a>
        </div>
        @endif

      </div>
    </div>

        <div id="caja-centrada">

          <div class="organizar-elementos">
            <div class="cerrar">
              <a href="{{route('welcome')}}" id="equis">X</a>
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
    <!-- 

      Jeannifer te deje esto for para que renderizara los contenedores lo limite a tres, es decir que si creas un nuevo no va a parecer
      los deje de modo que tengan 3 libros para que aparezca el scrollbar, otro 2 libros para que no tenga el scrollbar

      y otro vacio con un texto para que tomes en cuenta contenedores que no tengan grupos ( en cuanto a disenio y maquetacion )
-->
    @foreach($containers as $c)

    <div class="contenedor">
      <div class="subtitulo espacio">
        <h3>Works of the Central Figures</h3>
      </div>
      <img class="puntos" src="{{asset('/img/puntos.svg')}}" />
    <div class="barra-info">
      <div class="contenedor-vistas">
        <img class="cuadricula" src="{{asset('/img/cuadricula.svg')}}" />
        <img class="lista" src="{{asset('/img/lista.svg')}}" />
      </div>

      <div class="contenedor-busqueda">
        <h5 class="filtro">filter</h5>
        <h5 class="filtro">sort</h5>
        <h5 class="filtro">search</h5>
      </div>
    </div>
    <div id="contenedor-libros">
      @php $count = 0 @endphp

      @foreach($groups as $g)
      @if($g->group_container_id == $c->id)
      @php $count++ @endphp

      <div class="ficha-libro">
        <img class="portada-libro" src="{{asset('/img/ki.png')}}" />
        <div class="parte-derecha-ficha">
          <h4 class="autor-nombre">{{$g->book->author->name}} {{$g->book->author->lastname}}</h4>
          <h3 class="libro-nombre">{{$g->name}}</h3>
          <p class="spaces">({{$g->available}} spaces available of {{$g->max_size}})</p>
          <p class="descripcion-libro">
            {{$g->description}}
          </p>
          <span class="parte-derecha-ficha-espacio"></span>
          <a class="join-ficha" href='{{route('group.dashboard', [$g->route])}}'>JOIN</a>
        </div>
      </div>

      @endif

      @endforeach
<!-- CREATE NEW GROUP -->
@if(auth()->check())
<form method=POST action='{{route('store.group.post')}}' class='wrap-r'>
      <div class="ficha-libro">
        <div class="izquierda">
        <img class="portada-libro new-group" src="{{asset('/img/books.png')}}" />
        {{-- <form enctype="multipart/form-data" method=POST action='{{route('dev.store.book.post')}}' class='wrap-r'> --}}
          {!! csrf_field() !!}
        <input type='hidden' value='{{$c->id}}' name='group_container_id'/>
        <h3 class="sobre-imagen">Create New Group</h3>
        </div>
        <div class="parte-derecha-ficha-crear">
          <div class="custom-select">
              <select class="autor-nombre hachecuatro desplegable-autor" data-container='{{$c->id}}' onchange='getBooks(this)' name="book_id">
              @foreach($authors as $a)
              @if($a->group_container_id == $c->id)
              <option data-link='{{route('api.author.book', [$a->author->id])}}' value='{{$a->author->id}}'>{{$a->author->name}} {{$a->author->lastname}}
              </option>
              @endif
              @endforeach
            </select>
          </div>
            <select class= 'libro-nombre hachetres formulario-libro' required name='book_id' id='book-element-{{$c->id}}'>
              <option disabled selected >Choose the Author</option>
            </select>
            <input type='number' class='formulario-max pe-max max-group' required name='max_size' placeholder='Maximum Group Size'/>
            <input type='description' required name='description' id='name' class="descripcion-libro-form pe" rows="3" cols="15" placeholder="Description... Lorem ipsum dolor sit amet."/>
            <span class="parte-derecha-ficha-espacio"></span>
            <button class="join-ficha">CREATE</button>
        </div>
      </div>
    </form>
    @endif
    <div class="">
      <div class="izquierda-show">
        <h3 class="sobre-show">Show <br> Everything</h3>
      </div>
    </div>
  </div>
    </div>
    @endforeach
    <div class="contenedor">
      <div class="subtitulo espacio">
        <h3>Works of the House of Justice</h3>
      </div>
      <img class="puntos" src="{{asset('/img/puntos.svg')}}" />
      <!--FILTROS-->
      <div class="barra-info">
        <div class="contenedor-vistas">
          <img class="cuadricula" src="{{asset('/img/cuadricula.svg')}}" />
          <img class="lista" src="{{asset('/img/lista.svg')}}" />
        </div>
        <div class="contenedor-busqueda">
          <h5 class="amarilloline">filter</h5>
          <h5 class="amarilloline">sort</h5>
          <h5 class="amarilloline">search</h5>

        </div>
      </div>

      <div class="contenedor-lista">
        @foreach($groups as $g)
        <!--LISTA - LIBRO 001-->
        <div class="lista-libro">
          <div class="ticincoizquierda">
        <img class="portada-libro-pequeno circular" src="{{asset('/img/ki.png')}}" />
          <div class="autor-libro">
            <h4 class="autor-nombre amarillo">{{$g->book->author->name}} {{$g->book->author->lastname}}</h4>
            <h3 class="libro-nombre">{{$g->book->name}}</h3>
          </div>
          </div>
<div class="cinculibroizquierda">
          <p class="descripcion-libro-lista">
            {{$g->description}} {{$g->description}} {{$g->description}}

          </p>
        </div>
          <div class="spaces-part">
            <p class="spaces-lista">({{$g->max_size}} spaces available)</p>
          </div>
          <div class="derecha-cinco"> 
            <a href="{{route('group.dashboard', [$g->route])}}">
          <img class="join-plus" src="{{asset('/img/plus-sign.svg')}}" />
            </a>
        </div>
        </div>
        @endforeach
      </div>

      <button class="show-more-lista ">
        EVERYTHING
      </button>

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
        <script src='{{asset('/js/forms/group.js')}}'></script>
</body>

</html>