@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Import customers
@endsection
@section('content')
<div class="content-area">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <header class="row">
         <div class="col-sm-6 text-sm-left mb-3 mb-sm-0 ">
          <h2 class="m-0 mt-2">Customer Excel Import</h2>
        </div>
         <div class="col-sm-6 text-sm-right">
          <a title="Go Back" href="javascript:history.go(-1)" class="btn btn-outline-info ml-1"><i class="fas fa-chevron-left"></i></a>
        </div>
      </header>
      <div class="widget mt-3">
        <h2 class="m-0">{{ __('Customer Excel Import') }}</h2>
        <div class="widget-content p-3">
        	<div> @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert"> {{ Session::get('success') }} </div>
        @endif </div>
      @if (!empty(session('error')))
      <div class="alert alert-danger alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{ session('error') }} </div>
      @endif
      
      {!! Form::open(array('url' => '/import_customer_select_fields', 'method'=>'POST', 'name' => 'form-upload', 'files' => true)) !!}
      <div class="row">

        <div class="col-md-12 form-group text-center"> 
         <div class="download-wrp">
           {{ Form::label('download', __('Please download the sample excel file for reference')) }}
          <div class="clear"></div>
          <a href="/Import_Leads_sample.xls" class="btn btn-primary"><i class="fas fa-download"></i> <span>{{ __('Download Sample File') }}</span> </a> 
         </div>
         
        </div>
        <div class="col-md-12 form-group"> {{ Form::label('file', __('Excel File')) }}

          <div class="file-container">
             {{ Form::file('file', ['id' => 'file', 'class' => 'form-control-file']) }}
          <span tabindex="0" for="my-file" class="input-file-trigger"><p class="file-return"><i class="fas fa-upload"></i>Upload Image</p></span>
          </div>
          @if ($errors->has('file')) <span class="error" id ="file_err">{{ $errors->first('file') }}</span> @endif
           </div>
            <div class="col-md-12 form-group"> {{ Form::label('comments', __('Comments')) }}
          {{ Form::textarea('comments', '', ['id' => 'comments', 'class' => 'form-control', 'rows' => '4', 'cols' => '50']) }}
          @if ($errors->has('comments')) <span class="error" id ="comments_err">{{ $errors->first('comments') }}</span> @endif 
        </div>
        <div class="col-md-12 text-right">
          <button class="btn btn-primary">Import</button>
        </div>
      </div>
      {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('footer-custom-css-js') 
<script src="{{ asset('js/groups/group.js') }}"></script> 
@endsection