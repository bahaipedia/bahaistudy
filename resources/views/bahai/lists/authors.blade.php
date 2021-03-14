@extends('template')
@section('cnt')

<h1>List of all authors stored</h1>
<br>
<br>

@foreach($authors as $a)
<div style='display: flex;  flex-direction: column; width: 500px; border:1px solid black;'>

	<p>{{$a->name}} {{$a->lastname}} <a href={{route('update.author', [Crypt::encryptString($a->id)])}}>edit info</a></p>
</div>
@endforeach

<br>
<a href={{route('welcome')}}>home</a>
@stop