@extends('template')
@section('cnt')
	<h1>List of messages</h1>
	<input type='hidden' id='message-search-route' value='{{route('dev.admin.api.messages')}}'/>
	<input id='search' oninput='searchMessage(this)'/>
	<div id='messages-box' style='width:100%; align-items: flex-start; justify-content: flex-start;'>
	@foreach($messages as $m)
	<p>{{$m->user->name}} {{$m->user->lastname}} {{$m->message}} in group {{$m->group->name}} - {{$m->created_at}}</p>
	@endforeach
	</div>
	<script src='{{asset('js/admin/messages.js')}}'></script>
@stop