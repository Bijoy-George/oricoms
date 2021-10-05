@extends('layouts.login')
@section('title')
{{config('constant.site_title')}} - Login
@endsection
@section('content')

<section class="login-wrapper">
<div class="container-fluid">
<div class="row">
  <div class="col-md-6 auth-left">
   
    <div class="login-text">
       <div class="logo-login"> <img src="{{url('/')}}/img/logo-white.png" alt=""/></div>
      <h1>Welcome to Oricoms</h1>
      <h4>Innovative digital <br/>
Communicating solutions</h4>
    </div>
  </div>
  <div class="col-md-6 auth-right">

    <div class="login-container">
      <form class="" id="login_form" role="form" method="POST" action="{{ route('login') }}" autocomplete="off">
        <h2>Login</h2>
    <p>Please sign in to access your account</p>
     
      <input id="login_error" type="hidden" class="form-control" name="login_error" value="0">
      @csrf
      @if (count($errors) > 0)
      <div class="alert alert-danger"> <strong>Whoops!</strong> @foreach ($errors->all() as $error)
        {{ $error }}
        @endforeach </div>
      @endif
      @if (session('error'))
      @if( session('error') == 'login_error')
      <div class="alert alert-danger">
        <input id="login_error" type="hidden" class="form-control" name="login_error" value="1">
        You have already loggedin with other machine, Do you want to continue here? <span class='login_yes_no' onclick="document.getElementById('sign_in').click();"> Yes </span>&nbsp;<a class='login_yes_no' href="{{ url('/login') }}">No</a> </div>
      @else
      <div class="alert alert-danger"> {{ session('error') }} </div>
      @endif
      @endif
      @if (session('success'))
      <div class="alert alert-success"> {{ session('success') }} </div>
      @endif
      @if (session('message'))
      <div class="alert alert-info"> {{ session('message') }} </div>
      @endif
      @if (session('status'))
      <div class="alert alert-info"> {{ session('status') }} </div>
      @endif
      <div class="form-group">
        <label class="m-0" for="email">{{ __('E-Mail') }}/{{ __('User Name') }}</label>
        <div class="">
          <input id="login" type="text" class="form-control{{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}" name="login" value="{{ old('username') ?: old('email') }}" required autofocus>
          @if ($errors->has('username') || $errors->has('email')) <span class="validation-error"><i class="far fa-times-circle"></i> <span class="validation-tooltip"> {{ $errors->first('username') ?: $errors->first('email') }} </span> </span> @endif </div>
      </div>
      <div class="form-group">
        <label class="m-0" for="password">{{ __('Password') }}</label>
        <div class="">
          <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
          @if ($errors->has('password')) <span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('password') }}</strong> </span> @endif 
        </div>
      </div>
      <div class="form-group">
        <div class="">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember"> {{ __('Remember Me') }} </label>
             <a class=" btn-link forgot" href="{{ route('password.request') }}"> {{ __('Forgot Your Password?') }} </a>
          </div>
        </div>
      </div>
      <div class="form-group mb-0">
        <div class="">
          <button type="submit" class="btn btn-blue btn-block"> {{ __('Login') }} </button>
          </div>
      </div>

       <div class="form-group">
        <div class="text-center pt-3 pb-2">
            <label class="form-check-label" for="remember"> Don't have an account? <a class="sign_in-btn" href="{{url('registration')}}">Create New</a> </label>
        </div>
      </div>


    </form>
    </div>

  </div>

</div>
</div>
</section>


@endsection 