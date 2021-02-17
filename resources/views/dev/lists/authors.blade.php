@extends('template')
@section('cnt')

<h1>List of all authors stored</h1>
<br>
<br>

@foreach($authors as $a)
	<p>{{$a->name}} {{$a->lastname}} <a href=#>edit info</a></p>
@endforeach

<br>
<a href={{route('welcome')}}>home</a>
@stop