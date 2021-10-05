@extends('layouts.app')

@section('header-custom-css-js')

<script src="{{ asset('js/calender.js') }}"></script>
<script src="{{ asset('tel/intlTelInput.js') }}"></script>
<link rel="stylesheet" href="{{ asset('tel/intlTelInput.css') }}">
<link href="{{ asset('css/custom.css') }}" rel="stylesheet">
<script src="{{ asset('js/moment.min.js') }}"></script>
<link href="{{ asset('css/bootstrap-datetimepicker.css') }}" rel="stylesheet">
<script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script> 
<script src="{{ asset('js/profile.js') }}"></script>
<script src="{{ asset('js/location.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('css/uploadfile.min.css') }}">
<script src="{{ asset('js/jquery.uploadfile.min.js') }}" type="text/javascript"></script>
@endsection
