@extends('template')
@section('cnt')
<div class="cajaFicha">
<h1>new book form</h1>
<form enctype="multipart/form-data" method=POST action='{{route('dev.store.book.post')}}' class='wrap-r'>
{!! csrf_field() !!}

<label for='name'>name</label>
<input id='name' max='50' value='book #' name='name'  type='text'>
<br>
<label for='description'>decription</label>
<textarea style='width:300px; height: 100px; resize: none;' id='description' max='120' name='description'  type='text'>example of a large text</textarea>
<br>
<label for='author_id'>autor</label>
<select style='width:200px; height:30px;'name='author_id' id='author_id'>
	@foreach($authors as $a)
		<option value={{$a->id}}>{{$a->name}} {{$a->lastname}}</option>
	@endforeach	
</select>
<br>
<label for='date'>release date</label>
<input id='date' name='date'  type='date'>
<br>
<label for='number_pages'>number of pages</label>
<input id='number_pages' value=400 name='number_pages'  type='number'>
<br>
<label for='image'>select image</label>
<input style='display:none;'id='image' type='file' accept='.png' name='image'>
<p>{!! $errors->first('file')!!}</p>
<br>
<button>CREATE</button>
</form>
<a href={{route('dev.welcome')}}>home</a>
</div>
@stop