@extends('template')
@section('cnt')

<h1>new group for '{{$container->name}}' container</h1>
<form enctype="multipart/form-data" method=POST action='{{route('dev.store.group.post')}}' class='wrap-r'>
  {!! csrf_field() !!}
  <input type='hidden' name='group_container_id' value={{$container->id}}>
  <label for='name'>name</label>
  <input id='name' max='50' value='group #' name='name' type='text'>
  <br>
  <label for='url'>meeting url</label>
  <input id='url' max='250' value='https://meet.google.com/' name='url' type='text'>
  <br>
  <label for='description'>decription</label>
  <textarea style='width:300px; height: 100px; resize: none;' id='description' max='120' name='description'
    type='text'>example of a group description</textarea>
  <br>
  <label for='host_comments'>host comments</label>
  <textarea style='width:300px; height: 100px; resize: none;' id='host_comments' max='120' name='host_comments'
    type='text'>example of a host comment for the group</textarea>
  <br>
  <label>select book</label>
  <select name='book_id'>
    @foreach($books as $b)
    <option value='{{$b->id}}'>{{$b->name}}</option>
    @endforeach
  </select>
  <label for='max_size'>users allowed to join the group</label>
  <input id='max_size' min='1' max='20' step='1' name='max_size' type='number'>
  <br>
  <br>
  <label for='start_at'>from</label>
  <input id='start_at' type='time' name='start_at' />
  <label for='finish_at'>to</label>
  <input id='finish_at' type='time' name='finish_at' />
  <label for='day_of_week'>weekday</label>
  <select name='day_of_week' id='day_of_week'>
    <option value='0'>Sunday</option>
    <option value='1'>Monday</option>
    <option value='2'>Tuesday</option>
    <option value='3'>Wensday</option>
    <option value='4'>Thursday</option>
    <option value='5'>Friday</option>
    <option value='6'>Saturday</option>
  </select>
  <br>
  <button>CREATE</button>

</form>
<a href={{route('dev.welcome')}}>home</a>

@stop