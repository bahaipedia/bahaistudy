@extends('template')
@section('cnt')

<h1>List of all books stored</h1>
<br>
<br>

@foreach($books as $b)
	<p>{{$b->name}} <a href=#>edit info</a></p>
@endforeach

<br>
<a href={{route('welcome')}}>home</a>
@stop