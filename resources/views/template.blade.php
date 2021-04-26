<!DOCTYPE html>
<html>

<head>
  <link href="{{asset('css/template.css')}}" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap"
    rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet" />
  <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css" />
  {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> --}}
  <title>Bahai</title>
</head>

<body>
  {{-- <div class="general-container"> --}}

  @include('layout.popups.login')
  @include('layout.popups.user-info')
  @yield('cnt')
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script> --}}
  <script src='{{asset('/js/menu.js')}}'></script>
  <script src='{{asset('/js/popups.js')}}'></script>
  {{-- </div> --}}
</body>


</html>