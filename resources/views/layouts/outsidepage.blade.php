@extends('layouts.outside_base')
@section('header-css-js')

<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('fonts/css/fontawesome-all.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/outer-forms.css') }}" rel="stylesheet">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<link href="{{ asset('css/main.css') }}" rel="stylesheet">
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('js/registration.js') }}"></script>
<script src="{{ asset('js/common.js') }}"></script>
<link href="{{ asset('css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
@endsection
@section('nav-bar-code')


         
            {{ csrf_field() }}
          
@endsection
@section('footer-css-js')
<script src="{{ asset('js/popper.min.js') }}"></script> 
<link rel="stylesheet" href="{{ asset('css/preloader.css') }}">
<script src="{{ asset('js/jquery.preloader.min.js') }}"></script>  
@endsection

