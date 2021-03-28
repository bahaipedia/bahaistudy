@extends('template')
@section('cnt')

<h1>general configuration</h1>
<form method=POST action='{{route('dev.admin.configurations.post')}}' class='wrap-r'>
{!! csrf_field() !!}
<label for='app_name'>website name</label>
<input name='app_name' style=' border:1px solid black;' value='{{$configurations->app_name}}' type='text'>
<br>
<label for='app_description'>website description</label>
<textarea name='app_description' style=' width: 500px; height:100px;  border:1px solid black;' >{{$configurations->app_description}}</textarea>
<br>
<label for='app_description_hight'>website description highlight</label>
<textarea name='app_description_hight'  style='width: 500px; height:100px; border:1px solid black;' >{{$configurations->app_description_hight}}</textarea>
<br>
<label for='app_description_low'>website description extra</label>
<textarea name='app_description_low' style=' width: 500px; height:100px;  border:1px solid black;'>{{$configurations->app_description_low}}</textarea>
<br>
<label for='app_notes'>website notes</label>
<textarea name='app_notes' style=' width: 500px; height:100px;  border:1px solid black;' >{{$configurations->app_notes}}</textarea>
<br>
<label for='groups_per_host'>group per host</label>
<input name='groups_per_host' style='width:100px; border:1px solid black;'type='number' value='{{$configurations->groups_per_host}}' min='1' max='30'>
<br>
<label for='lastname'>user must confirm email for create a group</label>
<input type='checkbox' name='lastname'>
<br>
<label for='lastname'>send email when group was created</label>
<input type='checkbox' name='lastname'>
<br>
<label for='lastname'>send email when account was created</label>
<input type='checkbox' name='lastname'>
<br>
<label for='lastname'>send email when host is stepped down</label>
<input type='checkbox' name='lastname'>
<br>

<button>UPDATE</button>
</form>

<a href={{route('dev.welcome')}}>home</a>