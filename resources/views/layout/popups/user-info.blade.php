<div class="logic-popup-settings usuario-menu">
  <div class="logic-popup-settings usuario-contenido">
    <div class="logic-popup-settings usuario-hipervinculos">
 {{--      <div class="logic-popup-settings texto-usuario">
        <a class='logic-popup-settings' href='{{route('dev.admin.configurations')}}'>Settings</a>
        <div class="logic-popup-settings texto-boton usuario-boton-config"></div>
      </div>
      <div class="logic-popup-settings separacion"></div> --}}
      <div class="logic-popup-settings texto-usuario">
        <a class='logic-popup-settings' href={{route('logout')}}>Logout</a>
        <div class="logic-popup-settings texto-boton usuario-boton-salir"></div>
      </div>
      @if(auth()->user() !== NULL && auth()->user()->email_validated == NULL)
      <div class="logic-popup-settings separacion"></div>
      <div class="logic-popup-settings texto-usuario">
        <a class='logic-popup-settings' href={{route('confirm.email')}}>Confirm Email</a>
        <div class="logic-popup-settings texto-boton usuario-boton-salir"></div>
      </div>
      @endif
    </div>
  </div>
</div>
