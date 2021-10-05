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
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
@yield('header-css-js')
@yield('header-custom-css-js')
</head>
<body>
<input type="hidden" name="base_url" id="base_url" value="{{url('/')}}">
<input type="hidden" name="lang1" id="lang1" value="{{ config('constant.LANG_ENG') }}">
<input type="hidden" name="lang2" id="lang2" value="{{ config('constant.LANG_MALA') }}">
@yield('nav-bar-code')
@yield('common-popups')
<section class="page-wrapper outside_base"> @yield('content') </section>
<footer>{{config('constant.site_title')}} Contact Center CRM | &copy; OrisysIndia</footer>
@yield('footer-css-js')
@yield('footer-custom-css-js')
</body>
</html>