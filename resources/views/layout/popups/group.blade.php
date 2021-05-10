<div id="caja-group" class='pop-up-general'>
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

      <form class="ancho" enctype="multipart/form-data" method=POST action='{{route('store.group.post')}}'>
        {!! csrf_field() !!}
        <input type="hidden"  id='logic-group-popup-container-id'>
        <input type="hidden" name='book_id' id='logic-group-popup-book-id'>
        <input type="hidden" name='author_id' id='logic-group-popup-author-id'>
        <input type="hidden" id='get-book-api' value={{route('api.author.book')}}>
        <select onchange='getAuthors(this)'  class="in-pop" name='group_container_id'>
        <option  disabled selected>CHOOSE CONTAINER</option>
          @foreach($containers as $c)
            <option  data-link='{{route('api.container.author', [$c->id])}}' value='{{$c->id}}'>{{$c->name}}</option>
          @endforeach
        </select>
        <br>
        <select class="logic-an" id="logic-author-element" style='cursor:pointer' onchange='getBooks(this);' name="author_id">
          <option disabled selected value='0'>Choose the Author</option>
        </select>
        <br>

        <select class='libro-nombre hachetres formulario-libro logic-bn' required name='book_id' id="logic-book-element">
          <option disabled selected >Choose the Author</option>
        </select>

        <textarea required id='logic-group-popup-descriptions' style='height: 90px;' class="descripcion-libro-crear pe" max='120' name='description'
          type='text'>Description... Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</textarea>
        <textarea class="descripcion-libro-crear pe" style='height: 90px;'placeholder="add a host comment" max='120' name='host_comments'
          type='text'></textarea>
        <label class="texto-pequ">number of particiapants</label>
        <input required id='logic-group-popup-max-size' name='max_size' min="2" max="20" type='number'>
        <label class="texto-pequ">meeting url</label>
        <input  max='250'  name='url' type='text'>
        <br>
        <input class="in-pop" id='start_at' type='time' name='start_at' />
        <input class="in-pop" id='finish_at' type='time' name='finish_at' />
        <select class="in-pop" name='day_of_week' id='day_of_week'>
          <option value='0'>Sunday</option>
          <option value='1'>Monday</option>
          <option value='2'>Tuesday</option>
          <option value='3'>Wensday</option>
          <option value='4'>Thursday</option>
          <option value='5'>Friday</option>
          <option value='6'>Saturday</option>
        </select>
        <button  class="join-ficha-pop">CREATE</button>
      </form>
	  <div class="equis">
	    <a onclick="closePopup('caja-group'); refreshForm();" id="equis">X</a>        
	   </div>
    </div>
  </div>
</div>
</div>