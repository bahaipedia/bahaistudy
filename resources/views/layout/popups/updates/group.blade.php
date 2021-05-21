<div id="caja-up-group" class='pop-up-general'>
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

        <form class="ancho" enctype="multipart/form-data" method=POST action='{{route('update.group.post')}}' class='ancho'>
        <input name="_method" type="hidden" value="PUT">
        {!! csrf_field() !!}
        <input type="hidden" class='logic-group-up-popup-id' name='group_id'>

        <input required disabled class="logic-group-up-popup-name hachecuatro autor-nombre" value='book #' name='name' type='text'>
        <br>
        <input required class="logic-group-up-popup-author hachecuatro autor-nombre" value='author' disabled>
        <textarea required  style='height: 90px;' class="logic-group-up-popup-desc descripcion-libro-crear pe" max='120' name='description'
          type='text'>Description... Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</textarea>

        <textarea class="logic-group-up-popup-host descripcion-libro-crear pe" style='height: 90px;'placeholder="add a host comment" max='120' name='host_comments'
          type='text'></textarea>

        <label class="texto-may">number of participants</label>
        <input required class='logic-group-up-popup-max-size' name='max_size' min="2" max="20" type='number'>

        <label class="texto-may">meeting url</label>
        <input class='logic-group-up-popup-url' max='250'  name='url' type='text'>



        <br>

{{--         <input type='time' name='start_at' />
        <input type='time' name='finish_at' />
        <select name='day_of_week'>
          <option value='0'>Sunday</option>
          <option value='1'>Monday</option>
          <option value='2'>Tuesday</option>
          <option value='3'>Wensday</option>
          <option value='4'>Thursday</option>
          <option value='5'>Friday</option>
          <option value='6'>Saturday</option>
        </select> --}}
        
        <button  class="join-ficha-pop">UPDATE</button>
      </form>

     {{-- POR FAVOR NO BORRAR ESTE FORMULARIO DE ABAJO --}}
<div class="eliminar">
      <form method='POST' action='{{route('delete.group.post')}}'>
        {!! csrf_field() !!}
        <input name="_method" type="hidden" value="delete">
        <input name="group_id" type="hidden" class='logic-group-up-popup-id2' value="">
        <button  disabled class="logic-group-del-popup-btn trash"></button>
      </form>
      </div>
	  <div class="equis">
	    <a onclick="closePopup('caja-up-group'); refreshForm();" id="equis">X</a>        
	   </div>
    </div>
  </div>
</div>
</div>