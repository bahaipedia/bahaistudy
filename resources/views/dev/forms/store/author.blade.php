@extends('template')
@section('cnt')

<h1>new author form</h1>
<form enctype="multipart/form-data" method=POST action='{{route('dev.store.author.post')}}' class='wrap-r'>
{!! csrf_field() !!}

<label for='name'>name</label>
<input id='name' max='50' value='example' name='name'  type='text'>
<br>
<label for='lastname'>lastname</label>
<input id='lastname' max='50' value='example' name='lastname'  type='text'>
<br>

<label for='date_of_birth'>date_of_birth</label>
<input id='date_of_birth' name='date_of_birth'  type='date'>
<br>
<label for='nationality'>nationality</label>
<input id='nationality' max='50' value='example' name='nationality'  type='text'>
<br>

<button>CREATE</button>
</form>
<a href={{route('dev.welcome')}}>home</a>
@stop