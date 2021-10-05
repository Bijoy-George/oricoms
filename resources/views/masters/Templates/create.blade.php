@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Template
@endsection
@section('content')
<?php if(isset($cat_results->type) && !empty($cat_results->type))
        {
          $cat_type=$cat_results->type;
        }else{
          $cat_type='';
        }
?>
<div class="content-area">
  <div class="row justify-content-center">
    <div class="col-sm-7 text-right"><a href="{{url('templates')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a> </div>
    <div class="col-sm-7 mt-3">
      <div class="widget">
        <h2>{{__('Templates')}}</h2>
        <div class="widget-content pt-3"> 
            @if(isset($cat_results))
                        {!! Form::model($cat_results, ['method' => 'POST', 'class' => 'tinymce form-common', 'route' => ['templates.store']]) !!}
                @else
                        {!! Form::open(array('route' => 'templates.store', 'class' => 'tinymce form-common', 'method'=>'POST')) !!}
                @endif
          {{ csrf_field() }}
          <div class="row m-0 align-items-center">
            <div class="col-md-12"> <span class="response"></span>
              <div class="message"></div>
            </div>
              {{ Form::hidden('id', null, array('class' => 'form-control' )) }}
            <div class="col-sm-12 form-group">
                <label for="category" class="control-label mb-1">{{__('Title')}}<span class="red_star">*</span></label>
                {{ Form::text('title', null, array('class' => 'form-control','id' => 'title' , 'required' => true)) }}	
                <span id ="title_err"></span>
            </div>

            <div class="col-sm-12 form-group">
                <label for="subject" class="control-label mb-1">{{__('Subject')}}<span class="red_star">*</span></label>
                {{ Form::text('subject', null, array('class' => 'form-control','id' => 'subject' , 'required' => true)) }}	
                <span id ="subject_err"></span>
            </div>

            <div class="col-sm-6 form-group">
                <label for="category" class="control-label mb-1">{{__('SMS / EMAIL')}}<span class="red_star">*</span></label>
                @if(!empty($id))<input id="type" type="hidden" class="form-control" name="type" value="{{ $cat_results->type }}">  @endif
                <select class="form-control" id="template_type" name="type"  required="true">
                   <option value="">Type</option>

                   <option value="{{ config('constant.CH_SMS') }}" @if(isset($cat_results->type) && $cat_results->type == config('constant.CH_SMS')){{ 'selected' }} @endif> SMS</option>

                   <option value="{{config('constant.CH_EMAIL')}}" @if(isset($cat_results->type) && $cat_results->type == config('constant.CH_EMAIL')){{ 'selected' }} @endif> EMAIL</option>

                   <option value="{{config('constant.CH_PUSH_MESSAGES')}}" @if(isset($cat_results->type) && $cat_results->type == config('constant.CH_PUSH_MESSAGES')){{ 'selected' }} @endif> PUSH MESSAGES</option>
                </select>
            </div>

            <div class="email_content_div col-sm-12 form-group" id="email_content_div" @if($cat_type != config('constant.CH_EMAIL') || empty($id) || $cat_type == 0)  style="display:none" @endif >
                <label for="content" class="control-label mb-1">Content</label>
                <textarea id="content" name="content" class="tinymce form-control">@if(!empty($cat_results->content)){{ $cat_results->content }} @endif</textarea>
                <span id ="content_err" class="error"></span>
            </div>

            <div class="sms_content_div col-sm-12 form-group" id="sms_content_div" @if($cat_type != config('constant.CH_SMS') || empty($id) || $cat_type == 0){ style="display:none" } @endif>
                <label for="category" class="control-label mb-1">Content</label>
                <textarea maxlength='{{config('constant.sms_max_length')}}' id="sms_content" name="sms_content"  class="sms_content req_reply1 form-control" rows="3">@if(!empty($cat_results->content)){{ $cat_results->content }} @endif</textarea>
                                    <span id ="sms_content_err" class="error"></span>
                <span id="bal" class="pull-right"><span id="remain" class="pull-right"></span></span>
            </div>

            <div class="push_content_div col-sm-12 form-group" id="push_content_div" @if($cat_type != config('constant.CH_PUSH_MESSAGES') || empty($id) || $cat_type == 0){ style="display:none" } @endif>
                <label for="category" class="control-label mb-1">Content</label>
                <textarea maxlength='{{config('constant.push_message_max_length')}}' id="push_content" name="push_content"  class="push_content req_reply1 form-control" rows="3">@if(!empty($cat_results->content)){{ $cat_results->content }} @endif</textarea>
                <span id ="push_content_err" class="error"></span>
                <span id="bal" class="pull-right"><span id="remain_push" class="pull-right"></span></span>
            </div>
            <div class="col-md-6 mb-2">
                <input type="checkbox" name="is_show" class="check_list custom-checkbox" id="is_show" @if(isset($cat_results->is_show) && $cat_results->is_show == config('constant.IS_DISPLAY') ){{ 'checked' }} @endif>
                <label for="is_show" class="custom-checkbox-label text-capitalize">{{__('Want to show in Front end')}}</label>
                 <span class="error" id ="is_show_err"></span>
            </div>
            <div class="col-sm-6 form-group">
                <label for="category" class="control-label mb-1">{{__('Sort Order')}}</label>
                @if(isset($cat_results)) 	
                        {{ Form::number('sort_order', null, array('class' => 'form-control' ,'id' => 'sort_order','max' =>'99')) }}
                        @else
                        {{ Form::number('sort_order', 0, array('class' => 'form-control' ,'id' => 'sort_order','max' =>'99','min'=>'0')) }}	
                        @endif	
                <span id ="sort_order_err"></span>			
            </div>
            <div class="col-sm-6 form-group">
                <label for="status" class="control-label mb-1">{{__('Status')}}</label>
                {{ Form::select('status', array(config('constant.ACTIVE')=> 'Active', config('constant.INACTIVE')=>'Inactive'), null, ['id' => 'status', 'class' => 'form-control']) }}		
                <span id ="status_err"></span>
            </div>
        <input id="sms" type="hidden" class="form-control" name="sms" value="{{ config('constant.CH_SMS') }}">
			<input id="email" type="hidden" class="form-control" name="email" value="{{ config('constant.CH_EMAIL') }}">
			<input id="push_msg" type="hidden" class="form-control" name="push_msg" value="{{ config('constant.CH_PUSH_MESSAGES') }}">
        <div class="col-md-12 form-group text-right">
            <button type="reset" class="btn btn-outline-danger px-4" > {{__('Reset')}} </button>
            <button type="submit" class="btn btn-primary px-4"> {{__('Save')}} </button>
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
<script src="{{ asset('js/tiny_mce/tiny_mce.js') }}"></script> 
<script src="{{ asset('js/tinymce.js') }}"></script> 
@endsection