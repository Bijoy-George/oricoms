@extends('layouts.app')

@section('header-custom-css-js')
<link href="{{ asset('css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script> 
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"> -->
@endsection 

@section('footer-custom-css-js')
<script src="{{ asset('js/listing.js') }}"></script>
@endsection

