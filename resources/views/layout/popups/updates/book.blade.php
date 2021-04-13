<div id="caja-up-book" class='pop-up-general'>
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

    <form enctype="multipart/form-data" method=POST action='{{route('update.book.post')}}' class='wrap-r'>
    <input name="_method" type="hidden" value="PUT">
    {!! csrf_field() !!}
        <input type="hidden" name="book_id" class="logic-book-up-popup-id"/>
        <label class="texto-may" for='date'>name</label>
        <input class="logic-book-up-popup-name hachecuatro autor-nombre" max='50' placeholder="BOOK NAME" name='name' type='text'>
        <select class="logic-book-up-popup-author libro-nombre hachetres" name='author_id'>
          @foreach($authors_books as $a)
          <option value={{$a->id}}>{{$a->name}} {{$a->lastname}}</option>
          @endforeach
        </select>
        <textarea class="logic-book-up-popup-desc descripcion-libro-crear pe" maxlength='200' placeholder='Description... Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.' name='description'></textarea>
        <label class="texto-may" for='date'>release date</label>
        <input class='logic-book-up-popup-dor' name='date' type='date'>
        <label class="texto-may" for='number_pages'>number of pages</label>
        <input placeholder="SELECT NUMBER PAGES" class="logic-book-up-popup-number hachecuatro autor-nombre" min='0' max='3000' name='number_pages' type='number'>
        <br>
        <label class="texto-min-bot" for='logic-image-update'>Upload Cover Image</label>
        <input style='display:none;' id='logic-image-update' type='file' accept='.png' name='image'>
        <button class="join-ficha-pop">UPDATE</button>
      </form>
	  <div style='display: flex; justify-content: center; align-items: center; height: 100%; '>
	    <button onclick="closePopup('caja-up-book')">X</button>        
	   </div>
    </div>
  </div>
</div>
</div>