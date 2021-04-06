<div id="caja-group" class='pop-up-general'>
<div class="full-libro">
  <div class="ficha-crear">
    <div class="parte-izq-crear">
      <img class="portada-libro crear-grupo" src="{{asset('/img/books.png')}}" />
      <div class="textos-iqcrear">
        <h1 class="crear-titulo">Instructions</h1>
        <p class="crear-texto">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
          ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
          aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore
          eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
          mollit anim id est laborum</p>
      </div>
    </div>
    <div class="formulario-crear">

      <form class="ancho" enctype="multipart/form-data" method=POST action='{{route('dev.store.book.post')}}'>
        {!! csrf_field() !!}
        <input class="hachecuatro autor-nombre" max='50' value='book #' name='name' type='text'>
        <br>
        <select class="libro-nombre hachetres" name='author_id'>
          @foreach($authors as $a)
          <option value={{$a->id}}>{{$a->name}} {{$a->lastname}}</option>
          @endforeach
        </select>
        <textarea class="descripcion-libro-crear pe" max='200' name='description'
          type='text'>Description... Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</textarea>
        <label class="texto-may">release date</label>
        <input  name='date' type='date'>
        <label class="texto-may">number of pages</label>
        <input  value=400 name='number_pages' type='number'>
        <br>
       
        <p>{!! $errors->first('file')!!}</p>
        <a href="#" class="join-ficha-pop">CREATE</a>
      </form>
	  <div style='display: flex; justify-content: center; align-items: center; height: 100%; '>
	    <a onclick="closePopup('caja-group')" href="#" id="equis">X</a>        
	   </div>
    </div>
  </div>
</div>
</div>