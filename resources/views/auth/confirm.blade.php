@extends('template')
@section('cnt')

<h1>An email confirmation was sended to {{auth()->user()->email}}</h1>
<p>Please confirm the email to continue</p>
<br>
<a href={{route('welcome')}}>home</a>

@stop