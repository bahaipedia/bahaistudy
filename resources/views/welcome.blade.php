<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css" />
  <title>Bahai</title>

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
  @include('layout.popups.login')
  @include('layout.popups.group')
  @include('layout.popups.book')
  @include('layout.popups.author')
  @include('layout.popups.container')
  @include('layout.popups.register')
  @include('layout.popups.alert')
  @include('layout.popups.user-info')
  @include('layout.popups.config')


  @include('layout.popups.updates.author')
  @include('layout.popups.updates.book')
  @include('layout.popups.updates.container')
  @include('layout.popups.updates.group')



  <div class="general-container">
    @include('layout.headers.home')
    @if(auth()->user())
    <div class="botones-flotantes">
      <a class="nuevo-autor" title="Config" onclick="openPopup('caja-config')">
      </a>
      <a class="nuevo-autor" title="New Author" onclick="openPopup('caja-author')">
      </a>
      <a class="nuevo-libro" title="New Book" onclick="openPopup('caja-book')">
      </a>
      <a class="nuevo-container" title="New Container" onclick="openPopup('caja-container')">
      </a>
    </div>
    @endif

    <div id="hero-image" style='cursor:default;'>
      <div id="textos">
        <h1 id="hero-title">{{$configurations->app_name}},</h1>
        <h2 id="hero-subtitle">
          {{$configurations->app_description}}
          <b id="resaltar">
             {{$configurations->app_description_hight}}
          </b>
           {{$configurations->app_description_low}}
        </h2>
        <div id="alert">
          <h5 class="hero-texto">
            {{$configurations->app_notes}}
          </h5>
        </div>
      </div>
      <div id="flecha">
      </div>
    </div>

    @foreach($containers as $c)

    <div class="contenedor">
      <div class="subtitulo espacio">
        <div class="parte-izquierda">
        <h3 style='cursor:default'>{{$c->name}}</h3>
         @if(auth()->user())<a onclick="openPopup('caja-up-container', ['container', '{{route("api.update.container", [Crypt::encryptString($c->id)])}}'])" class="edit-boton"></a>@endif
        </div>
         <h4 class="ver-todo">VIEW ALL ></h4>
        </div>
    <div class="barra-info">
      <div class="contenedor-vistas">
        <img class="cuadricula" src="{{asset('/img/cuadricula.svg')}}" />
        <img class="lista" src="{{asset('/img/lista.svg')}}" />
      </div>
    </div>
    <div id="contenedor-libros">
      @php $count = 0 @endphp

      @foreach($groups as $g)
      @if($g->group_container_id == $c->id)
      @php $count++ @endphp

      <div class="ficha-libro" style='cursor:default;'>
        @if($g->book->book_image_id !== NULL && Storage::disk('s3')->exists("bahai-dev/".$g->book->bookImage->code))
        <img class="portada-libro new-group" src='{{Storage::disk("s3")->url("bahai-dev/".$g->book->bookImage->code)}}' onclick="openPopup('caja-up-group', ['group', '{{route("api.update.group", [Crypt::encryptString($g->id)])}}'])" src="{{asset('/img/ki.png')}}" />
        @else
        <img class="portada-libro" />
        @endif
        <div class="parte-derecha-ficha">
          <div class="titulo-boton">
          <h4 class="autor-nombre" >{{$g->book->author->name}} {{$g->book->author->lastname}}</h4>
         @if(auth()->user())<a class="edit-boton-ficha" onclick="openPopup('caja-up-author', ['author', '{{route("api.update.author", [Crypt::encryptString($g->book->author_id)])}}'])"></a> @endif
        </div>
        <div class="autor-boton" >
         <h3 class="libro-nombre">{{$g->book->name}}</h3>
           @if(auth()->user())<a class="edit-boton-brown" onclick="openPopup('caja-up-book', ['book', '{{route("api.update.book", [Crypt::encryptString($g->book->id)])}}'])"> </a>@endif
        </div>
          <p class="spaces">({{$g->available}} of {{$g->max_size}} spaces available)</p>
          <p class="descripcion-libro">
            {{$g->description}}
          </p>
          <span class="parte-derecha-ficha-espacio"></span>
          <a class="join-ficha margen-ficha" href='{{route('group.dashboard', [str_replace(' ', '-', str_replace('/', ' ', str_replace('#', 'n', $g->book->name))), $g->route])}}'>VIEW</a>
        </div>
      </div>

      @endif

      @endforeach
<!-- CREATE NEW GROUP -->
{{--
@if(auth()->check() && $create_group)
      <div class="ficha-libro">
        <div class="izquierda">
        <img class="portada-libro new-group" src="{{asset('/img/books.png')}}" />
        <h3 style='cursor:default;' class="sobre-imagen">Create New Group</h3>
        </div>
        <div class="parte-derecha-ficha-crear">
          <form  class='wrap-r'>
          <div class="custom-select">
              <select class="autor-nombre hachecuatro desplegable-autor logic-an" data-container='{{$c->id}}' style='cursor:pointer' onchange='getBooks(this); createGroup(this);' name="author_id">
              <option disabled selected value='0'>Choose the Author</option>
              
              @foreach($authors as $a)
              @if($a->group_container_id == $c->id && $a->author->status === NULL)
              <option data-link='{{route('api.author.book', [$a->author->id])}}' value='{{$a->author->id}}'>{{$a->author->name}} {{$a->author->lastname}}
              </option>
              @endif
              @endforeach
            </select>
            </div>
            <select onchange='createGroup(this);' class='libro-nombre hachetres formulario-libro logic-bn' required name='book_id' id='book-element-{{$c->id}}'>
              <option disabled selected >Choose the Author</option>
            </select>
            <input onchange='createGroup(this);' type='number' class='formulario-max pe-max max-group logic-mg' required name='max_size' placeholder='Maximum Group Size'/>
            <textarea onchange='createGroup(this);' type='description' required name='description'  class="descripcion-libro-form pe logic-de" rows="3" cols="15" placeholder="Description... Lorem ipsum dolor sit amet."></textarea>
            <span class="parte-derecha-ficha-espacio"></span>
            <span onclick="renderInfoGroup(this);" data-container='{{$c->id}}' style='cursor:pointer' class="join-ficha-pop margen-ficha">CREATE</span>
          </form>
          </div>
      </div>
    @endif
   --}}
  </div>
    </div>
    @endforeach
   {{--  <div class="contenedor">
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
        @if($g->book->book_image_id !== NULL && Storage::disk('s3')->exists("bahai-dev/".$g->book->bookImage->code))
        <img class="portada-libro-pequeno circular" src='{{Storage::disk("s3")->url("bahai-dev/".$g->book->bookImage->code)}}'/>
        @else
        <img class="portada-libro-pequeno circular" src="{{asset('/img/ki.png')}}" />
        @endif
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
            <a href='{{route('group.dashboard', [str_replace(' ', '-', str_replace('/', ' ', str_replace('#', 'n', $g->book->name))), $g->route])}}'>
          <img class="join-plus" src="{{asset('/img/plus-sign.svg')}}" />
            </a>
        </div>
        </div>
        @endforeach
      </div> --}}


</div>
        <div class="footer">
          <div class="linea-uno">
            <p  class="footer-text">
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

          <div style='margin-top:10px;' class="linea-tres">
            <p class="copyright">
              © bahaistudygroup | 2021
            </p>
          </div>

        </div>
        <script src='{{asset('/js/popups.js')}}'></script>
        <script src='{{asset('/js/forms/group.js')}}'></script>
        <script src='{{asset('/js/forms/containers.js')}}'></script>
        <script src='{{asset('/js/menu.js')}}'></script>

</body>

</html>