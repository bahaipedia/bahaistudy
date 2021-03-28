@extends('template')
@section('cnt')
@include('layout.headers.group')

<div class="contenedor-chat">
  <div class="grupos-izquierda">
    <h3 class="espacio-grupos">Groups</h3>
      <div class="select-chat-group">
        <div class="perfil-dash">
        </div>
        <div class="informacion-chat">
        <h6 class="subti-libro">The Kitáb-I-Íqán Book</h6>
        <h4 class="chat-list">
        with Fabio Bonfanti
        </h4>
        </div>
      </div>
</div>
  <div class="chats-derecha">
    <div class="barra-superior-estatica">
      <div class="perfil-chat">

      </div>
      <div class="organizar-superior">
      <h3 class="espacio-grupos">
        The Kitáb-I-Íqán Book
      </h3>
      <h4 class="chat-list-dos">
        Jeanniffer, David, Fabio, Joe, John, Daniel & Name
      </h4>
      </div>
    </div>
    <div class="todos-los-mensajes">
      <div class="msj-recibido">
        <div class="perfil-chat-dos centrar"></div>
        <div class="textos-chat">
        <h5 class="autor-envia-uno">Jeanniffer Pimentel</h5>
        <p class="texto-enviado-uno">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
      </div>
      </div>
      <div class="msj-enviado">
        <div class="textos-chat">
        <h5 class="autor-envia">Jeanniffer Pimentel</h5>
        <p class="texto-enviado">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
      </div>
        <div class="perfil-chat centrar-uno"></div>
      </div>
    </div>
    <div class="escribir-mensaje">
      <textarea class="" placeholder='Write your message here'></textarea>
    </div>
  </div>
</div>

@stop