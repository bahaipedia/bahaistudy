<div id="caja-author" class='pop-up-general'>
<div class="full-libro">
  <div class="ficha-crear">
    <div class="parte-izq-crear">
      <div class="textos-iqcrear">
        <h1 class="crear-titulo">New Author</h1>
        <p class="crear-texto">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
          ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
          aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore
          eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
          mollit anim id est laborum</p>
      </div>
    </div>
    <div class="formulario-crear">

      <form class="ancho" method=POST action='{{route('store.author.post')}}'>
        {!! csrf_field() !!}

        <label class="texto-may">name</label>
        <input required class="hachecuatro autor-nombre"  max='50' placeholder="AUTHOR NAME" name='name'  type='text'>

        <label class="texto-may">lastname</label>
        <input required class="hachecuatro autor-nombre"  max='50' placeholder="AUTHOR LASTNAME" name='lastname'  type='text'>
   
        <label class="texto-may">date of birth</label>
        <input required name='date_of_birth' type='date'>

        <label class="texto-may">nationality</label>
        <input required class="hachecuatro autor-nombre"  max='50' placeholder="NATIONALITY"  name='nationality'  type='text'>        
       
        <button class="join-ficha-pop">CREATE</button>
      </form>
    <div style='display: flex; justify-content: center; align-items: center; height: 100%; '>
      <a onclick="closePopup('caja-author')" href="#" id="equis">X</a>        
    </div>
    </div>
  </div>
</div>
</div>