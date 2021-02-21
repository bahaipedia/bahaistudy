@extends('template')
@section('cnt')

<h1>new container form</h1>
<form enctype="multipart/form-data" method=POST action='{{route('store.container.post')}}' class='wrap-r'>
{!! csrf_field() !!}

<label for='name'>name</label>
<input id='name' max='50' value='example' name='name'  type='text'>
<br>
<label for='description'>decription</label>
<textarea style='width:300px; height: 100px; resize: none;' id='description' max='120' name='description'  type='text'>example of a large text</textarea>
<br>



<label for='weight'>weight</label>
<input id='weight' min='1' max='10' step='1' value='example' name='weight'  type='number'>
<br>
@for($i=0; $i<2; $i++)
	<label for={{'author_'.$i}}>{{'author_'.$i}}</label>
	{{-- in the user interface we have to avoid repeat when author is selected --}}
	<select name={{'author['.$i.']'}}>
		@foreach($authors as $a)
			<option value={{$a->id}}>{{$a->name}} {{$a->lastname}}</option>
		@endforeach
	</select>
@endfor
<br>
<button>CREATE</button>
</form>
<a href={{route('welcome')}}>home</a>


</script>
@stop