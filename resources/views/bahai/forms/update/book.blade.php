@extends('template')
@section('cnt')

<h1>update book form</h1>
<form enctype="multipart/form-data" method=POST action='{{route('update.book.post')}}' class='wrap-r'>
<input name="_method" type="hidden" value="PUT">
{!! csrf_field() !!}
<input type='hidden' value="{{Crypt::encryptString($book->id)}}" name='book_id'/>
<label for='name'>name</label>
<input id='name' max='50' value='{{$book->name}}' name='name'  type='text'>
<br>
<label for='description'>decription</label>
<textarea style='width:300px; height: 100px; resize: none;' id='description' max='120' name='description'  type='text'>{{$book->description}}</textarea>
<br>
<label for='author_id'>autor</label>
<select style='width:200px; height:30px;'name='author_id' id='author_id'>
	@foreach($authors as $a)
		@if($a->id == $book->author_id)
		<option selected value={{$a->id}}>{{$a->name}} {{$a->lastname}}</option>
		@else
		<option value={{$a->id}}>{{$a->name}} {{$a->lastname}}</option>
		@endif
	@endforeach	
</select>
<br>
<label for='date'>release date</label>
<input id='date' value="{{date("Y-m-d", strtotime( $book->date ))}}" name='date'  type='date'>
<br>
<label for='number_pages'>number of pages</label>
<input id='number_pages' value={{$book->number_pages}} name='number_pages'  type='number'>
<br>

@if($book->book_image_id != NULL)
<label for='image'>change image</label>
<img src='{{Storage::disk("s3")->url("bahai-dev/".$book->bookImage->code)}}'/>
@else
<label for='image'>insert image</label>
@endif
<input style='display:none;'id='image' type='file' accept='.png' name='image'>

<p>{!! $errors->first('file')!!}</p>
<br>
<button>UPDATE</button>
</form>
<form method='POST' action='{{route('delete.book.post')}}' id="delete">
	{!! csrf_field() !!}
	<input name="_method" type="hidden" value="delete">
	<input name="book_id" type="hidden" value="{{Crypt::encryptString($book->id)}}">
	<button>DELETE</button>	
</form>
<a href={{route('welcome')}}>home</a>


<script>
	document.querySelector('#delete').addEventListener('click', function(e){
		e.preventDefault();
		if(confirm('You want to delete?')){
			document.querySelector('#delete').submit();
		}
	})

</script>
@stop