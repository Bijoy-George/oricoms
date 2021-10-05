@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - FAQ
@endsection
@section('content')
<div class="content-area">
  <header class="row align-items-center justify-content-center text-center pb-3">
    <div class="col-sm-5 text-sm-left mb-3 mb-sm-0">
      <h2 class="m-0">{{__('Add Faq')}}</h2>
    </div>
    <div class="col-sm-5 text-sm-right"><a href="{{url('faqs')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a></div>
  </header>
  @if(isset($res))
  {!! Form::model($res, ['method' => 'POST', 'id' => 'faq_form', 'class' => 'tinymce form-common', 'route' => ['faqs.store']]) !!}
  @else
  {!! Form::open(array('route' => 'faqs.store',  'id' => 'faq_form','class' => 'tinymce form-common', 'method'=>'POST')) !!}
  @endif
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="widget">
        <h2>Language 1</h2>
        <div class="widget-content">
          <div class="row m-0">
            <div class="col-md-12 form-group">
              <label for="query_title_lang1" class="control-label mb-1">{{__('Title')}}</label>
              {{ Form::text('query_title_lang1', null, array('id' => 'query_title_lang1','class' => 'lang_trans form-control' )) }} <span class="error" id="query_title_lang1_err"></span> </div>
            <div class="col-md-12 form-group">
              <label for="question_lang1" class="control-label mb-1">{{__('Question')}}</label>
              {{ Form::textarea('question_lang1', null, array('id' => 'question_lang1', 'class' => 'lang_trans tinymce form-control' )) }} </div>
            <div class="col-md-12 form-group">
              <label for="answer_lang1" class="control-label mb-1">{{__('Answer')}}</label>
              {{ Form::textarea('answer_lang1', null, array('id' => 'answer_lang1', 'class' => 'lang_trans tinymce form-control' )) }} </div>
            <div class="col-md-12 form-group">
              <label for="answer_lang1_short" class="control-label mb-1">{{__('Answer Short')}}</label>
              {{ Form::textarea('answer_lang1_short', null, array('rows' => '3', 'id' => 'answer_lang1_short', 'class' => 'lang_trans form-control' )) }} </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-5">
      <div class="widget">
        <h2>Language 2</h2>
        <div class="widget-content">
          <div class="row m-0">
            <div class="col-md-12 form-group">
              <label for="query_title_lang2" class="control-label mb-1">{{__('Title')}}</label>
              {{ Form::text('query_title_lang2', null, array('id' => 'query_title_lang2','class' => 'form-control' )) }} <span class="error" id="query_title_lang1_err"></span> </div>
            <div class="col-md-12 form-group">
              <label for="question_lang2" class="control-label mb-1">{{__('Question')}}</label>
              {{ Form::textarea('question_lang2', null, array('id' => 'question_lang2', 'class' => 'tinymce form-control' )) }} </div>
            <div class="col-md-12 form-group">
              <label for="answer_lang2" class="control-label mb-1">{{__('Answer')}}</label>
              {{ Form::textarea('answer_lang2', null, array('id' => 'answer_lang2', 'class' => 'tinymce form-control' )) }} </div>
            <div class="col-md-12 form-group">
              <label for="answer_lang2_short" class="control-label mb-1">{{__('Answer Short')}}</label>
              {{ Form::textarea('answer_lang2_short', null, array('rows' => '3', 'id' => 'answer_lang2_short', 'class' => 'form-control' )) }} </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-10">
      <div class="widget">
        <h2 class="m-0">{{__('More Options')}}</h2>
        <div class="widget-content">
          <div class="row m-0">
            <!--<div class="col-md-4 form-group">
              <label for="query_type_id" class="control-label mb-1">{{__('Department')}}<span class="red_star">*</span></label>
              {{ Form::select('query_type_id', $query_types, null, ['id' => 'query_type_id1', 'class' => 'get_query_cat get_query_status form-control']) }} <span class="error" id="query_type_id_err"></span> </div>-->
            <div class="col-md-4 form-group">
              <label for="faq_cat_id" class="cat_list control-label mb-1">{{__('Categories')}}</label>
              {{ Form::select('faq_cat_id', $query_categories, null, ['id' => 'faq_cat_id', 'class' => 'faq_cat_id form-control']) }} </div>
            <div class="col-md-4 form-group">
              <label for="keywords" class="control-label mb-1">{{__('Keywords')}}<span class="red_star">*</span></label>
              {{ Form::text('keywords', null, array('id' => 'keywords','class' => 'form-control' )) }} <span class="error" id="keywords_err"></span> </div>
				  <?php 
              $drp = array(config('constant.INACTIVE') => 'Inactive', config('constant.ACTIVE') => 'Active');
              $disabled = "";
           ?>
           @if(!Helpers::checkPermission('faq activate'))
					  <?php 
            if(isset($res)){
              $disabled = "disabled"; 
            }else{ 
              $drp = array(config('constant.INACTIVE') => 'Inactive');
            }
            ?>
				  @endif
            <div class="col-md-4 form-group">
              <label for="status" class="control-label mb-1">{{__('Status')}}</label>
              {{ Form::select('status',$drp, null, ['id' => 'status', 'class' => 'form-control',$disabled]) }} <span class="error" id ="status_err"></span> </div>
            <div class="col-md-4 form-group">
              <label for="show_in_chat_auto_reply" class="control-label mb-1">{{__('Show in chat auto reply')}}</label>
              {{ Form::select('show_in_chat_auto_reply', $drp, null, ['id' => 'show_in_chat_auto_reply', 'class' => 'form-control',$disabled]) }} <span class="error" id ="show_in_chat_auto_reply_err"></span> </div>

          </div>
        </div>
      </div>
    </div>
    <div class="col-md-10"> {{ Form::hidden('id', null, array('class' => 'form-control' )) }}
      <div class="form-group text-center">
        <div class="message"></div>
        <button type="reset" class="btn btn-outline-danger px-4" > {{__('Reset')}} </button>
        <button type="submit" class="btn btn-primary px-4"> {{__('Save')}} </button>
      </div>
    </div>
  </div>
  {!! Form::close() !!} </div>
@endsection
@section('footer-custom-css-js') 
<script src="{{ asset('js/tiny_mce/tiny_mce.js') }}"></script> 
<script src="{{ asset('js/tinymce.js') }}"></script> 
<script type="text/javascript" src="https://www.google.com/jsapi"></script> 
<script src="{{ asset('js/translation.js') }}"></script> 
@endsection