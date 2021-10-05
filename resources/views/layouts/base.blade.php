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
<!--<input type="hidden" name="qry_type" id="qry_type" value="{{Helpers::get_query_type()}}">
<input type="hidden" name="get_dept" id="get_dept" value="{{Helpers::get_department()}}">
<input type="hidden" name="get_desig" id="get_desig" value="{{Helpers::get_designation()}}">-->
<input type="hidden" name="host_count" id="host_count" value="{{Helpers::get_host_count()}}">
<input type="hidden" name="cmpny_id" id="cmpny_id" value="{{ Auth::User()->cmpny_id ?? '' }}">
<input type="hidden" name="lang1" id="lang1" value="{{ config('constant.LANG_ENG') }}">
<input type="hidden" name="lang2" id="lang2" value="{{ config('constant.LANG_MALA') }}">
@yield('nav-bar-code')
@yield('common-popups')
<section class="page-wrapper"> @yield('content') </section>
<footer>{{config('constant.site_title')}} Contact Center CRM | &copy; OrisysIndia</footer>
@yield('footer-css-js')
@yield('footer-custom-css-js')
</body>
</html>