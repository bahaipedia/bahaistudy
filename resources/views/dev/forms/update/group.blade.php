@extends('template')
@section('cnt')

<h1>new group for '{{$container->name}}' container</h1>
<form enctype="multipart/form-data" method='POST' action='{{route('update.group.post')}}' class='wrap-r'>
{!! csrf_field() !!}
<input name="_method" type="hidden" value="PUT">
<input type='hidden' value="{{Crypt::encryptString($group->id)}}" name='group_id'/>

<label for='group_container_id'>change container</label>
{{-- rethink this logic --}}
{{-- <select id='group_container_id' name='group_container_id'>
@foreach($containers as $c)
	@if($c->id == $group->group_container_id)
	<option value='{{$c->id}}' selected>{{$c->name}}</option>
	@else
	<option value='{{$c->id}}'>{{$c->id}}{{$group->group_container_id}}{{$c->name}}</option>
	@endif
@endforeach --}}
</select>
<label for='name'>change name</label>
<input id='name' max='50' value='{{$group->name}}' name='name'  type='text'>
<br>
<label for='url'>change meeting url</label>
<input id='url' max='250' value='{{$group->url}}' name='url'  type='text'>
<br>
<label for='description'>change decription</label>
<textarea style='width:300px; height: 100px; resize: none;' id='description' max='120' name='description'  type='text'>{{$group->description}}</textarea>
<br>
<label for='host_comments'>change host comments</label>
<textarea style='width:300px; height: 100px; resize: none;' id='host_comments' max='120' name='host_comments'  type='text'>{{$group->host_comments}}</textarea>
<br>
<label for='book_id'>change book</label>
<select id='book_id' name='book_id'>
@foreach($books as $b)
	@if($b->id == $group->book_id)
	<option selected value='{{$b->id}}'>{{$b->name}}</option>
	@else
	<option value='{{$b->id}}'>{{$b->name}}</option>
	@endif
@endforeach
</select>
<label for='max_size'>users allowed to join the group</label>
<input id='max_size' min='1' max='20' value='{{$group->max_size}}' step='1' name='max_size'  type='number'>
<br>
<br>
{{-- with front end discution for better implementation --}}
{{-- <label for='start_at'>from</label>
<input id='start_at' type='time' name='start_at'/>
<label for='finish_at'>to</label>
<input id='finish_at' type='time' name='finish_at'/>
<label for='day_of_week'>weekday</label>
<select name='day_of_week' id='day_of_week'>
	<option value='0'>Sunday</option>
	<option value='1'>Monday</option>
	<option value='2'>Tuesday</option>
	<option value='3'>Wensday</option>
	<option value='4'>Thursday</option>
	<option value='5'>Friday</option>
	<option value='6'>Saturday</option>
</select> --}}
<br>
<button>UPDATE</button>
</form>
<form method='POST' action='{{route('delete.group.post')}}' id="delete">
	{!! csrf_field() !!}
	<input name="_method" type="hidden" value="delete">
	<input name="group_id" type="hidden" value="{{Crypt::encryptString($group->id)}}">
	<button>DELETE</button>	
</form>
<a href={{route('welcome')}}>home</a>


<script>
	document.querySelector('#delete').addEventListener('click', function(e){
		e.preventDefault();
		if(confirm('You want to delete?')){
			document.querySelector('#delete').submit();
		}
	})

</script>
@stop