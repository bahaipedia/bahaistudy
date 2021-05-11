<div id="caja-config" class='pop-up-general' >
<div class="full-libro" style='width:50%'>
  <div class="ficha-crear config-blanco">
    
    <div class="formulario-crear">

<form method=POST action='{{route('dev.admin.configurations.post')}}' class='config-pop'>

{!! csrf_field() !!}
<label for='app_name' class="hachecuatro extra">website name</label>
<input name='app_name' spellcheck="false" class="texta" value='{{$configurations->app_name}}' type='text'>

<label for='app_description' class="hachecuatro extra">website description</label>
<textarea name='app_description' class="texta" spellcheck="false">{{$configurations->app_description}}</textarea>

<label for='app_description_hight' class="hachecuatro extra">website description highlight</label>
<textarea name='app_description_hight' class="texta" spellcheck="false">{{$configurations->app_description_hight}}</textarea>

<label for='app_description_low' class="hachecuatro extra">website description extra</label>
<textarea name='app_description_low' class="texta" spellcheck="false">{{$configurations->app_description_low}}</textarea>

<label for='app_notes' class="hachecuatro extra">website notes</label>
<textarea name='app_notes' class="texta" spellcheck="false">{{$configurations->app_notes}}</textarea>
<div class="org-horizontal">
<label for='groups_per_host' class="hachecuatro extra">group per host</label>
<input name='groups_per_host' class="texta peque" type='number' value='{{$configurations->groups_per_host}}' min='1' max='30'>
</div>
<br>

<span class="checkbox">
  <label  for='send_created_a_study_group' class="texto-check" >user must confirm email for create a group</label>
  @if($configurations->validation_per_group_creation != 1)
  <input type='checkbox' name='validation_per_group_creation'>
  @else
  <input type='checkbox' name='validation_per_group_creation'checked>
  @endif
</span>

<span class="checkbox">
  <label for='validation_per_group_creation' class="texto-check">send email when group was created</label>
  @if($configurations->send_created_a_study_group != 1)
    <input type='checkbox' name='send_created_a_study_group'/>
  @else
    <input type='checkbox' name='send_created_a_study_group' checked/>
  @endif
</span>

<span class="checkbox">
  <label for='send_created_account' class="texto-check">send email when account was created</label>
  @if($configurations->send_created_account != 1)
    <input type='checkbox' name='send_created_account'>
  @else
    <input type='checkbox' name='send_created_account' checked>
  @endif
</span>

<span class="checkbox">
  <label for='send_host_stepped_down' class="texto-check">send email when host is stepped down</label>
  @if($configurations->send_host_stepped_down != 1)
  <input type='checkbox' name='send_host_stepped_down'>
  @else
  <input type='checkbox' name='send_host_stepped_down' checked>
  @endif
</span>
<button class="join-ficha">UPDATE</button>
</form>
	  <div class="equis">
	    <a onclick="closePopup('caja-config')" id="equis">X</a>        
	   </div>
    </div>
  </div>
</div>
</div>
