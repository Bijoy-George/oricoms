<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<meta name="msapplication-TileColor" content="#FF4A03">
<meta name="theme-color" content="#FF4A03">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title')</title>
<link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
@yield('header-css-js')
@yield('header-custom-css-js')
</head>
<body class="web-body">
@yield('nav-bar-code')
@yield('content')

@yield('footer-css-js')
@yield('footer-custom-css-js')
</body>
</html>