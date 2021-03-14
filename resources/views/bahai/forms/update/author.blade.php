@extends('template')
@section('cnt')

<h1>new author form</h1>
<form enctype="multipart/form-data" method=POST action='{{route('update.author.post')}}' class='wrap-r'>
{!! csrf_field() !!}
<input name="_method" type="hidden" value="PUT">

<input type='hidden' value="{{Crypt::encryptString($author->id)}}" name='author_id'/>

<label for='name'>name</label>
<input id='name' max='50' value='{{$author->name}}' name='name'  type='text'>
<br>
<label for='lastname'>lastname</label>
<input id='lastname' max='50' value='{{$author->lastname}}' name='lastname'  type='text'>
<br>
<label for='date_of_birth'></label>
<input id='date_of_birth' name='date_of_birth' value='{{date("Y-m-d", strtotime( $author->date_of_birth ))}}'  type='date'>
<br>
<label for='nationality'>nationality</label>
<input id='nationality' max='50' value='{{$author->nationality}}' name='nationality'  type='text'>
<br>

<button>UPDATE</button>
</form>

<form method='POST' action='{{route('delete.author.post')}}' id="delete">
	{!! csrf_field() !!}
	<input name="_method" type="hidden" value="delete">
	<input name="author_id" type="hidden" value="{{Crypt::encryptString($author->id)}}">
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