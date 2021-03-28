@extends('template')
@section('cnt')
@include('layout.headers.group')
<input id='group_id' type='hidden' value='{{Crypt::encryptString($group->id)}}'/>
<input id='message-route' value='{{route('group.message')}}' type='hidden'/>
@if(auth()->check())
  <input type='hidden' id='val' value='true'/>
  <input id='beat_route' value='{{route('api.group.beat')}}' type='hidden'/>
  <input id='participant_route' value='{{route('api.group.participant', [Crypt::encryptString($group->id)])}}' type='hidden'/>
  

  <input type='hidden' value='{{Crypt::encryptString(auth()->user()->id)}}' id='user_id'/>
  <input type='hidden' value='{{Crypt::encryptString($group->id)}}' id='group_beat'/>
  <input id='message-string' value='{{auth()->user()->name}} {{auth()->user()->lastname}}' type='hidden'/>
  <input id='message-poll' value='{{route('api.message.poll', [$group->id])}}' type='hidden'/>

@else
  <input id='participant_route' value='' type='hidden'/>

<input type='hidden' id='val' value='false'/>
  <input id='beat_route' value='' type='hidden'/>
  <input type='hidden' value='' id='user_id'/>
  <input type='hidden' value='' id='group_beat'/>
<input id='message-string' value='' type='hidden'/>
<input id='message-poll' value='{{route('api.message.poll', [$group->id])}}' type='hidden'/>
@endif
{!! csrf_field() !!}

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
      <div class="todos-los-mensajes" id='message-box' style='overflow-y: scroll'>
      @foreach($messages as $m)
        @if(auth()->check() && $m->user_id == auth()->user()->id)
          <div class="msj-enviado" style=''>
            <div class="textos-chat">
              <h5 class="autor-envia">{{$m->user->name}} {{$m->user->lastname}}</h5>
              <p class="texto-enviado">{{$m->message}}</p>
            </div>
            <div class="perfil-chat"></div>
          </div>
        @else
          <div class="msj-recibido">
              <div class="perfil-chat-dos"></div>
              <div class="textos-chat">
                <h5 class="autor-envia-uno">{{$m->user->name}} {{$m->user->lastname}}</h5>
                <p class="texto-enviado-uno">{{$m->message}}</p>
              </div>
          </div>
       @endif
      @endforeach
    </div>
    @if(auth()->user())

    <form method="POST" id='message-form' class="escribir-mensaje"}}>
      <textarea id='message-input' placeholder='Write your message here'></textarea>
    </div>
    @else
     <form id='message-form' class="escribir-mensaje">
      <textarea disabled id='message-input' placeholder='Write your message here'></textarea>
    </form>
    @endif
  </div>
</div>
<script type="text/javascript" src='{{asset('/js/group/status.js')}}'></script>

<script type="text/javascript" src='{{asset('/js/group/message.js')}}'></script>
@stop