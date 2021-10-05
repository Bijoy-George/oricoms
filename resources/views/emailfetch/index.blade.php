@extends('layouts.listpage')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Emailfetch
@endsection
@section('content')
<div class="col-md-12 count-padder overall-count" id="mail_count_div"></div>
<aside class="sidebar">
  <div class="search-box py-4"> {!! Form::open(array('route' => 'search_emailfetchlist', 'class' => 'listing form-common', 'method'=>'POST', 'name' => 'form-common')) !!}
    <div class="row align-items-center justify-content-center">
      <div class="col-1">
        <h2 class="m-0">{{__('Search')}}</h2>
        {{ Form::hidden('read', (isset($read)) ? $read : '' ) }}
        {{ Form::hidden('unread', (isset($unread)) ? $unread : '' ) }}
        {{ Form::hidden('answered', (isset($answered_c)) ? $answered_c : '' ) }} </div>
      <div class="col-5"> {{ Form::text('search_keywords', (isset($emailid)) ? $emailid : '', array('id' => 'search_keywords','class' => 'form-control search-input','placeholder' => 'Search mail')) }} </div>
      <div class="col-1"> {{ Form::submit('Find', array('class' => 'btn btn-primary btn-block')) }}
        {{ Form::hidden('pageno', 1, array('id' => 'pageno')) }} </div>
      <div class="col-1"> {{ Form::button('Reset', array('class' => 'btn btn-outline-danger btn-block', 'onclick' => 'ressetListForm(this);', 'id' => 's2', 'type' => '')) }} </div>
    </div>
    <input type="hidden" class="callback" value="load_mail_thread">
    {!! Form::close() !!} </div>
</aside>

<div class="content-area">
  <div class="row">
    <div class="col-12">
      <div class="mail-wrapper">
        <div class="mail-profile-wrapper">
          <h4>Profile</h4>
          <div class="mail-profile"></div>
          <div class="mail-enquiry-form"></div>
        </div>
        <div class="mail-left">
          <h2>Mailbox <span id="totalcount" class="badge badge-pill badge-secondary"></span></h2>
          <div id="list"><div class="col-md-12 text-center py-3" >Loading...</div></div>
        </div>
        <div class="mail-right">
          <div class="mail-content" id="email-content">
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



@endsection
@section('header-custom-css-js')
<script src="{{ asset('tel/intlTelInput.js') }}"></script>
<link rel="stylesheet" href="{{ asset('tel/intlTelInput.css') }}">
<script type="text/javascript" src="{{ asset('js/profile.js') }}"></script>
<style type="text/css">
  .mail-wrapper {
    position: relative;
    overflow: hidden;
  }
  .mail-profile-wrapper {
    position: absolute;
    width: 420px;
    left: -100%;
    top: 0;
    height: 100%;
    background: #fff;
    z-index: 99;
    padding: 10px;
    overflow: auto;
    transition: all ease .9s;
  }
  .mail-profile-wrapper.open {
    left: 0;
  }
  .mail-enquiry-form .col-mail-12 {
    flex: 100%;
    max-width: 100%;
  }
  .mail-enquiry-form .col-mail-4 {
    flex: 33.33%;
    max-width: 100%;
  }
</style>
@endsection