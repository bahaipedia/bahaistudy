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

<label for='send_created_a_study_group'>user must confirm email for create a group</label>

@if($configurations->validation_per_group_creation != 1)
<input type='checkbox' name='validation_per_group_creation'>
@else
<input type='checkbox' name='validation_per_group_creation' checked>
@endif
<br>

<label for='validation_per_group_creation'>send email when group was created</label>
@if($configurations->send_created_a_study_group != 1)
	<input type='checkbox' name='send_created_a_study_group'/>
@else
	<input type='checkbox' name='send_created_a_study_group' checked/>
@endif
<br>

<label for='send_created_account'>send email when account was created</label>
@if($configurations->send_created_account != 1)
	<input type='checkbox' name='send_created_account'>
@else
	<input type='checkbox' name='send_created_account' checked>
@endif

<br>

<label for='send_host_stepped_down'>send email when host is stepped down</label>
@if($configurations->send_host_stepped_down != 1)

<input type='checkbox' name='send_host_stepped_down'>
@else
<input type='checkbox' name='send_host_stepped_down' checked>
@endif
<br>

<button>UPDATE</button>
</form>

<a href={{route('dev.welcome')}}>home</a>