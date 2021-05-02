<div id="caja-up-author" class='pop-up-general'>
<div class="full-libro">
  <div class="ficha-crear">
    <div class="parte-izq-crear">
      <div class="textos-iqcrear">
        <h1 class="crear-titulo">Update Author</h1>
        <p class="crear-texto">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
          ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
          aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore
          eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
          mollit anim id est laborum</p>
      </div>
    </div>
    <div class="formulario-crear">

      <form class="ancho" enctype="multipart/form-data" method=POST action='{{route('update.author.post')}}' class='wrap-r'>
        {!! csrf_field() !!}
        <input name="_method" type="hidden" value="PUT">

        <input type='hidden' value="" class="logic-author-up-popup-id" name='author_id'/>

        <label class="texto-pequ">name</label>
        <input required class="logic-author-up-popup-name hachecuatro autor-nombre"  max='50' placeholder="AUTHOR NAME" name='name'  type='text'>

        <label class="texto-pequ">lastname</label>
        <input required class="logic-author-up-popup-ltname hachecuatro autor-nombre"  max='50' placeholder="AUTHOR LASTNAME" name='lastname'  type='text'>

        <button class="join-ficha-pop">UPDATE</button>
      </form>
      
    {{-- POR FAVOR NO BORRAR ESTE FORMULARIO DE ABAJO --}}

    {{--   <form method='POST' action='{{route('delete.author.post')}}' id="delete">
        {!! csrf_field() !!}
        <input name="_method" type="hidden" value="delete">
        <input name="author_id" type="hidden" class='logic-author-up-popup-id2' value="">
        <button disabled class="logic-author-del-popup-btn join-ficha-pop">DELETE</button> 
      </form> --}}
    <div class="equis">
      <a onclick="closePopup('caja-up-author')" id="equis">X</a>        
    </div>
    </div>
  </div>
</div>
</div>