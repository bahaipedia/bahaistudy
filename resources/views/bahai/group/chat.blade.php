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
        <h6 class="subti-libro">{{$group->book->name}}</h6>
        <h4 class="chat-list">
        with {{$group->host->name}} {{$group->host->lastname}}
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
        {{$group->book->name}}
      </h3>
      <h4 class="chat-list-dos">
        <p>
        @foreach($participants as $p)
          {{$p->user->name}}, 
        @endforeach
        </p>
      </h4>
      </div>
    </div>
      <div class="todos-los-mensajes" style='overflow-y: scroll'>
      @foreach($messages as $m)
        @if($m->user_id != auth()->user()->id)
        <div class="msj-recibido">
          <div class="perfil-chat-dos centrar"></div>
          <div class="textos-chat">
          <h5 class="autor-envia-uno">{{$m->user->name}} {{$m->user->lastname}}</h5>
          <p class="texto-enviado-uno">{{$m->message}}Lorem ipsum, dolor, sit amet consectetur adipisicing elit. Unde maiores tempora, sit error consequatur eveniet similique dignissimos, sunt vero nesciunt dicta debitis amet labore sint minima ipsam dolore nam delectus.</p>
        </div>
        </div>
            <div class="msj-recibido">
          <div class="perfil-chat-dos centrar"></div>
          <div class="textos-chat">
          <h5 class="autor-envia-uno">{{$m->user->name}} {{$m->user->lastname}}</h5>
          <p class="texto-enviado-uno">{{$m->message}}Lorem ipsum, dolor, sit amet consectetur adipisicing elit. Unde maiores tempora, sit error consequatur eveniet similique dignissimos, sunt vero nesciunt dicta debitis amet labore sint minima ipsam dolore nam delectus.</p>
        </div>
        </div>
        @else
      <div class="msj-enviado" style='justify-content: flex-end; height: auto;'>
        <div class="textos-chat">
          <h5 class="autor-envia">{{$m->user->name}} {{$m->user->lastname}}</h5>
          <p class="texto-enviado">{{$m->message}}Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe id, tenetur ducimus voluptatum? Vitae ducimus obcaecati, consequatur repellat non libero, est corporis repudiandae nemo dolor rerum dicta sunt sequi sit.</p>
        </div>
        <div class="perfil-chat"></div>
      </div>
      @endif
      @endforeach
    </div>
    {{-- <div class="todos-los-mensajes">
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
    </div> --}}
    <div class="escribir-mensaje">
      <textarea class="" placeholder='Write your message here'></textarea>
    </div>
  </div>
</div>

@stop