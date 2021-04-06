<div id="caja-container" class='pop-up-general'>
<div class="full-libro">
  <div class="ficha-crear">
    <div class="parte-izq-crear">
      <img class="portada-libro crear-grupo" src="{{asset('/img/books.png')}}" />
      <div class="textos-iqcrear">
        <h1 class="crear-titulo">Containers</h1>
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
	    <a onclick="closePopup('caja-container')" href="#" id="equis">X</a>        
	   </div>
    </div>
  </div>
</div>
</div>


<h1>new container form</h1>
<form enctype="multipart/form-data" method=POST action='{{route('store.container.post')}}' class='wrap-r'>
{!! csrf_field() !!}

<label for='name'>name</label>
<input id='name' max='50' value='example' name='name'  type='text'>
<br>
<label for='description'>decription</label>
<textarea style='width:300px; height: 100px; resize: none;' id='description' max='120' name='description'  type='text'>example of a large text</textarea>
<br>


{{-- 
<label for='weight'>weight</label>
<input id='weight' min='1' max='10' step='1' value='example' name='weight'  type='number'>
<br>
@for($i=0; $i<2; $i++)
  <label for={{'author_'.$i}}>{{'author_'.$i}}</label>
  in the user interface we have to avoid repeat when author is selected
  <select name={{'author['.$i.']'}}>
    @foreach($authors as $a)
      <option value={{$a->id}}>{{$a->name}} {{$a->lastname}}</option>
    @endforeach
  </select>
@endfor
<br>
<button>CREATE</button>
</form>
<a href={{route('welcome')}}>home</a> --}}

