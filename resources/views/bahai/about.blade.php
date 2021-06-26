@extends('template')
@section('cnt')
@include('layout.headers.home')
<div class="informacion-about">
    <div class="ochenta-especial">
        <div class="agrupar-info">
            <h1 class='blog-post-titulo autor-boton'>Titulo de About</h1>
            <p class='pe-post'>"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"</p>
            <img class="responsimage" src="{{asset('/img/hero02.jpg')}}" />
        </div>
    </div>
    <div class="footer-grupo">
    <div class="linea-uno">
      <p class="footer-text">
        About
      </p>
      <p class="footer-text">
        Help
      </p>
      <p class="footer-text">
        Resources
      </p>
      <p class="footer-text">
        Materials
      </p>
    </div>

    <div class="linea-dos">
      <p class="footer-text">
        Terms of Use
      </p>
      <p class="footer-text">
        Privacy Policy
      </p>
    </div>

    <div style='margin-top:10px;' class="linea-tres">
      <p class="copyright">
        © bahaistudygroup | 2021
      </p>
    </div>

  </div>
</div>
@stop