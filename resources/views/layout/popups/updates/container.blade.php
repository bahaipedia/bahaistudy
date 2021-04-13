<div id="caja-up-container" class='pop-up-general'>
<div class="full-libro">
  <div class="ficha-crear">
    <div class="parte-izq-crear">
      <div class="textos-iqcrear">
        <h1 class="crear-titulo">Containers Update</h1>
        <p class="crear-texto">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
          ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
          aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore
          eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
          mollit anim id est laborum</p>
      </div>
    </div>
    <div class="formulario-crear">
        <form class="ancho" enctype="multipart/form-data" method=POST action='{{route('update.container.post')}}' class='wrap-r'>
        <input name="_method" type="hidden" value="PUT">
        {!! csrf_field() !!}

        {{-- Uhmm, no se como hacer acá para formatearlo de la misma manera que los de--}}
        <input type='hidden' class="logic-cont-up-popup-id hachecuatro autor-nombre" name='container_id'/>
        <input required class="logic-cont-up-popup-name hachecuatro autor-nombre" max='50' placeholder="CONTAINER NAME" name='name' type='text'>
        <label class="texto-pequ">container description</label>

        <textarea required  class="logic-cont-up-popup-desc descripcion-libro-crear pe" maxlength='200' placeholder='Description... Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.' name='description'></textarea>

        {{-- <div id='author-in-container'>
          <select required name="author[0]" onchange='newAuthor(this);'>
            <option value='null' disabled selected>SELECT ONE AUTHOR</option>
              @foreach($authors_books as $a)
                <option value='{{$a->id}}'>{{$a->name}} {{$a->lastname}}</option>
              @endforeach
          </select>
        </div> --}}
        <label class="texto-pequ">container weight</label>
        <input required placeholder="SELECT CONTAINER WEIGHT" class="logic-cont-up-popup-weight hachecuatro autor-nombre" name='weight' min='0' max='10' type='number'>
        <br>

        <button class="join-ficha-pop">UPDATE</button>
      </form>
	  <div class="equis">
	    <a onclick="closePopup('caja-up-container')" id="equis">X</a>        
	   </div>
    </div>
  </div>
</div>
</div>
