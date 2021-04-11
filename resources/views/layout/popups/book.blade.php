<div id="caja-book" class='pop-up-general'>
<div class="full-libro">
  <div class="ficha-crear">
    <div class="parte-izq-crear">
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

      <form class="ancho" enctype="multipart/form-data" method=POST action='{{route('store.book.post')}}'>
        {!! csrf_field() !!}
        <label class="texto-may" for='date'>name</label>
        <input class="hachecuatro autor-nombre" max='50' placeholder="BOOK NAME" name='name' type='text'>
        <select class="libro-nombre hachetres" name='author_id' id='author_id'>
          @foreach($authors_books as $a)
          <option value={{$a->id}}>{{$a->name}} {{$a->lastname}}</option>
          @endforeach
        </select>
        <textarea class="descripcion-libro-crear pe" maxlength='200' placeholder='Description... Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.' name='description'></textarea>
        <label class="texto-may" for='date'>release date</label>
        <input id='date' name='date' type='date'>
        <label class="texto-may" for='number_pages'>number of pages</label>
        <input id='number_pages'  placeholder="SELECT NUMBER PAGES" class="hachecuatro autor-nombre" min='0' max='3000' name='number_pages' type='number'>
        <br>
        <label class="texto-min-bot" for='image'>Upload Cover Image</label>
        <input style='display:none;' id='image' type='file' accept='.png' name='image'>
        <p>{!! $errors->first('file')!!}</p>
        <button class="join-ficha-pop">CREATE</button>
      </form>
	  <div class="equis">
	    <a onclick="closePopup('caja-book')" href="#" id="equis">X</a>        
	   </div>
    </div>
  </div>
</div>
</div>