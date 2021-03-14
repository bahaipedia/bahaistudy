@extends('template')
@section('cnt')

<h1>{{$header}}</h1>
<p>{{$message}}</p>
<br>
<a href={{route('dev.welcome')}}>home</a>

@stop