@extends('template')
@section('cnt')

<h1>List of all containers stored</h1>
<br>
<br>
	@foreach($containers as $c)
<div style='display: flex;  flex-direction: row; width: 90%; border:1px solid black;'>
	<div style='display: flex;  flex-direction: column; width: 30%;border-right:1px solid black;'>
		<h3>{{$c->name}}</h3>
		<p>weight: {{$c->weight}}</p>
	 	<br>
	 	<h4>Authors in Container</h4>
	 	@foreach($aic as $a)
	 		@if($a->group_container_id == $c->id)
	 			<p>{{$a->author->name}} {{$a->author->lastname}}</p>
	 		@endif
	 	@endforeach
	 	<br>
	 	<a href=#>edit info</a>
	 	<a href={{route('dev.store.group', [$c->id])}}>create group</a>
	</div>
	<div style='display: flex;  flex-direction: column; width: 70%;border-bottom: :1px solid black;'>
		@foreach($groups as $g)
	 		@if($g->group_container_id == $c->id)	
	 		<span style='display: flex; flex-direction: column;'></span>
			<a href='{{route('dev.group.dashboard', [$g->route])}}' style='display: flex;'>
				<span>{{$g->name}} ||</span>
				<span>{{$g->description}} ||</span>
				<span>{{$g->book->name}}, </span>
				<span>{{$g->book->author->name}} {{$g->book->author->lastname}}</span>
			</a>
			{{-- HERE CAN BE THE CHANGE CONTAINER INTERACTION -> IT SHOULD WARNING OF CHANGING THE BOOK, ETC ( WITH FRONT END OR UX ) <a>change container</a> --}}
			</span>
			<span style='font-size:12px; display: flex;'>
			@foreach($at as $a)
				@if($a->group_id == $g->id)
				<span>AT: {{$weekday[$a->day_of_week]}} {{date("h:i", strtotime( $a->start_at ))}} to {{date("h:i", strtotime( $a->finish_at ))}} ||</span>
				@endif
			@endforeach
			</span>
			@endif

		@endforeach
	</div>
</div>

	@endforeach
<br>
<a href={{route('dev.welcome')}}>home</a>
@stop