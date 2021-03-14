@extends('template')
@section('cnt')

<h1>List of all books stored</h1>
<br>
<br>

@foreach($books as $b)
<div style='display: flex;  flex-direction: column; width: 500px; border:1px solid black;'>

	<p>{{$b->name}} <a href='{{route('update.book', [Crypt::encryptString($b->id)])}}'>edit info</a></p>
</div>
@endforeach

<br>
<a href={{route('welcome')}}>home</a>
@stop