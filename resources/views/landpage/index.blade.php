@extends('layouts.baselandpage')
@section('header-css-js')
<link href="https://fonts.googleapis.com/css?family=Raleway:400,700,800|Roboto:300,400,500,700" rel="stylesheet">
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('fonts/css/fontawesome-all.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/web.css') }}" rel="stylesheet">
<script src="{{ asset('js/app.js') }}"></script> 
@endsection
@section('content')
<section class="landing-container">
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <a class="logo-container"><img src="{{ asset('img/logo-white.png') }}"></a>
        <h1>Benficial in proposing inquiries,<br/>Integrate in projects, Get real-time reports and more </h1>

        <a class="login-btn" href="{{url('login')}}">Login</a>
        <div class="landing-img">
          <img src="{{ asset('img/support.png') }}">
        </div>
      </div>
    </div>
  </div> 
<div class="landing-footer clearfix">
  <span class="FL">support@orisys.in</span>
  <span class="FR">+0471 273 7850</span>
</div>
<footer class="text-center py-3">{{config('constant.site_title')}} Contact Center CRM | &copy; OrisysIndia</footer>
</section>







  
@endsection 
@section('footer-css-js') 
<script src="{{ asset('js/jquery.preloader.min.js') }}"></script> 
<script>
$(window).scroll(function() {    
    var scroll = $(window).scrollTop();
    if (scroll >= 50) {$(".navbar").addClass('bg-white');} else {$(".navbar").removeClass('bg-white');}
});
$(function() {
    $('a[href^="#"]').click(function() {
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.substr(1) +']');
        if (target.length) {
            $('html,body').animate({
              scrollTop: target.offset().top-50
            }, 1000);
            return false;
        }
    });
});
</script> 
@endsection