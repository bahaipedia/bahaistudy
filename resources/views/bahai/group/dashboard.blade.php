@extends('template')
@section('cnt')

{{-- estudia la ruta como si fuera un view -> view/layout..etc --}}
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


<div class="columna-grupo">
  {{--<h1>{{$group->name}}</h1>--}}
  <div class="informacion">
    <div class="container-ochenta">
      <div class="parte-superior">
        <div class="ficha-info">
          @if($group->book->book_image_id !== NULL &&
          Storage::disk('s3')->exists("bahai-dev/".$group->book->bookImage->code))
          <img class="imagen-libro-dash" src='{{Storage::disk("s3")->url("bahai-dev/".$group->book->bookImage->code)}}'
            onclick="openPopup('caja-up-group', ['group', '{{route("api.update.group", [Crypt::encryptString($group->id)])}}'])"
            src="{{asset('/img/ki.png')}}" />

          @else
          <img class="imagen-libro-dash portada-libro" />
          @endif
          <div class="informacion-dash">
            <h4 class="autor-nombre-dash">{{$group->book->author->name}} {{$group->book->author->lastname}}</h4>
            <h3 class="libro-nombre-dash">{{$group->book->name}}</h3>
            <h5 class="integrantes-dash">
              {{$group->participants_count}} Participants
            </h5>
            <h5 class="host-dash">
              @if($group->host_id != NULL)
              <b>HOST:</b> {{$group->host->name}} {{$group->host->lastname}}
              @else
              <h5>NO HOST IN THIS GROUP</h5>
              @endif
            </h5>
            <p class="bloqtext-dash">
              {{$group->description}}
            </p>
            <div class="botones-dash">
              @if($group->is_participant == 0 && auth()->check())
              <form method='POST' action='{{route('group.join')}}'>
                {!! csrf_field() !!}
                <input name='id' value='{{$group->id}}' type='hidden' />
                <button class="login-boton chat-dash">JOIN GROUP</button>
              </form>
              @elseif(auth()->check())
              <form method='POST' action='{{route('group.leave')}}'>
                {!! csrf_field() !!}
                <input name='id' value='{{$group->id}}' type='hidden' />
                <button class="chat-dash">LEAVE GROUP</button>
              </form>
              @endif
             {{--  <a class="chat-dash"
                href='{{route('group.chat', [str_replace(' ', '-', str_replace('/', ' ', str_replace('#', 'n', $group->book->name))), $group->route])}}'>GO
                TO CHAT</a> --}}
            </div>
          </div>
        </div>

        <div class="participants-list">
          <h2 class="parti-dash">List of participants<br></h2>
          <h4 class="max-dash">(max {{$group->max_size}})</h4>
          <div id='participant'>
            @foreach($participants as $p)
            @if(auth()->user() && $p->user_id == $group->host_id)
            <div class="particip-dash">
              <h4 class="dash-list"><span class='dash-status-allways' data-din='{{$p->user_id}}'></span><span class='dash-name'>{{$p->user->name}} {{$p->user->lastname}} (HOST)</span></h4>
              @if(auth()->user() && $p->user_id == auth()->user()->id)
              <form method='POST' action='{{route('group.stepdown')}}'>
                {!! csrf_field() !!}
                <input name='id' value='{{$group->id}}' type='hidden' />
                <button class="host-boton">STEP DOWN AS A HOST</button>
              </form>
              @endif
            </div>
            @elseif(auth()->user() && $p->user_id == auth()->user()->id)
             <div class="particip-dash">
              <h4 class="dash-list"><span class='dash-status-allways' data-din='{{$p->user_id}}'></span><span class='dash-name'>{{$p->user->name}} {{$p->user->lastname}} </span></h4>
              @if(auth()->user() && $group->host_id == NULL)
              <form method='POST' action='{{route('group.stepup')}}'>
                {!! csrf_field() !!}
                <input name='id' value='{{$group->id}}' type='hidden' />
                <button class="host-boton">BECOME THE HOST</button>
              </form>
              @endif
            </div>
            @else
            <div class="particip-dash">
              <h4 class="dash-list"><span class='dash-status' data-din='{{$p->user_id}}'></span><span class='dash-name'>{{$p->user->name}} {{$p->user->lastname}} </span></h4>
            </div>
            @endif

            @endforeach
          </div>
        </div>
      </div>
<!--     <div class='parte-espacio'></div> -->
      <div class="parte-inferior">
        <div  class="parte-mensajes">

        <div id="message-box" class='mensajes-almacenados'>
        <div class="load">
  <hr/><hr/><hr/><hr/>
</div>

<script>
     
    </script>

				{{-- <div class="msj-enviado">
					<div class="textos-chat">
						<h5 class="autor-envia">
							Fabio B 
						</h5>
						<p class="texto-enviado">
							Ejemplo de mensaje que me envia fabio
						</p>
					</div>
					<div class="perfil-chat"></div>
				</div>
				<div class="msj-recibido">
					<div class="perfil-chat-dos"></div>
					<div class="textos-chat-derecha">
						<h5 class="autor-envia-uno">
							Jeanniffer Pimentel
						</h5>
						<p class="texto-enviado-uno">
							Ejemplo de mensaje que responde Jeanniffer
						</p>
					</div>
				</div> --}}
      
        </div>
        <div class='parte-espacio'></div>

        <form onkeydown="return event.key != 'Enter';" id='message-form' class="escribir-mensaje">
        @if(auth()->check() && $group->is_participant == 1)
        <input class="input-tres message-input" id='message-input'  placeholder='Write your message here'></input>
        @else
        <input class="input-tres" disabled id='message-input'  placeholder='Join group to write a message'></input>
        @endif
        </form>
      </div>
      {{-- <div class="parte-escribir-txt"> --}}
    {{--     <form id='message-form' class="escribir-mensaje">
          @if(auth()->check() && $group->is_participant == 1)
          <input class="input-tres" id='message-input'  placeholder='Write your message here'></input>
          @else
          <input class="input-tres" disabled id='message-input'  placeholder='Join group to write a message'></input>
          @endif
        </form>
      </div> --}}
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src='{{asset('/js/group/status.js')}}'></script>
<script type="text/javascript" src='{{asset('/js/group/message.js')}}'></script>
@stop