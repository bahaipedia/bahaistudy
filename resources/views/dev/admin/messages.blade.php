@extends('template')
@section('cnt')
	<h1>List of messages</h1>
	<input type='hidden' id='message-search-route' value='{{route('dev.admin.api.messages')}}'/>
	<input id='search' oninput='searchMessage(this)'/>
	<div style='width:100%; align-items: flex-start; justify-content: flex-start;'>
	@foreach($messages as $m)
	<span>{{$m->user->name}} {{$m->user->lastname}}  <b>{{$m->message}}</b> in group {{$m->group->name}} - {{$m->created_at}}</span>
	<br>
	@endforeach
	</div>
	<script src='{{asset('js/admin/messages.js')}}'></script>
@stop