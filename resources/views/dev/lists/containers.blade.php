@extends('template')
@section('cnt')

<h1>List of all containers stored</h1>
<br>
<br>
	@foreach($containers as $c)
<div style='display: flex;  flex-direction: column; width: 500px; border:1px solid black;'>

		<h3>{{$c->name}}</h3>
	 	<br>
	 	<h4>Authors in Container</h4>
	 	@foreach($aic as $a)
	 		@if($a->group_container_id == $c->id)
	 			<p>{{$a->author->name}} {{$a->author->lastname}}</p>
	 		@endif
	 	@endforeach
	 	<br>
	 	<a href=#>edit info</a>
	 	<a href={{route('store.group', [$c->id])}}>create group</a>
</div>

	@endforeach
<br>
<a href={{route('welcome')}}>home</a>
@stop