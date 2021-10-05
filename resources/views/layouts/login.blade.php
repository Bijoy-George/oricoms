<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="msapplication-TileColor" content="#1D3B6D">
<meta name="theme-color" content="#1D3B6D">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- CSRF Token
<meta name="csrf-token" content="{{ csrf_token() }}"> -->
<title>@yield('title')</title>

<!-- Styles -->
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
<link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('fonts/css/fontawesome-all.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/preloader.css') }}">
<link href="{{ asset('fonts/css/all.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/web.css') }}" rel="stylesheet">
<link href="{{ asset('css/custom.css') }}" rel="stylesheet">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<link href="{{ asset('css/main.css') }}" rel="stylesheet">

<!-- Scripts --> 
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>  
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('js/location.js') }}"></script>
<script src="{{ asset('js/registration.js') }}"></script> 
<script src="{{ asset('js/common.js') }}"></script>



<script src="{{ asset('tel/utils.js') }}"></script> 
<script src="{{ asset('tel/intlTelInput.js') }}"></script> 
<link href="{{ asset('tel/intlTelInput.css') }}" rel="stylesheet">

</head>
<body class="login-body">
<input type="hidden" name="base_url" id="base_url" value="{{url('/')}}">
<!--<nav class="navbar navbar-expand-lg navbar-light fixed-top">
  <div class="container"> <a class="navbar-brand" href="/"><img src="{{ asset('img/oricoms-logo.svg') }}" height="40" alt=""/></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active"> <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a> </li>
        <li class="nav-item"> <a class="nav-link" href="/#features">Features</a> </li>
        <li class="nav-item"> <a class="nav-link" href="#">Pricing</a> </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"> <a class="nav-link px-4" href="{{url('login')}}">Login</a> </li>
        <li class="nav-item"> <a class="btn btn-orange-outline" href="{{url('registration')}}">Register</a> </li>
      </ul>
    </div>
  </div>
</nav>-->
@yield('content') 
<script src="{{ asset('js/jquery.preloader.min.js') }}"></script>
</body>
</html>