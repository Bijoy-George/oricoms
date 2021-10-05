@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Survey
@endsection
@section('content')

@php 
$question_ids=array();
$eng_arr=array();
$mal_arr=array();
$lang1_arr=array();
$lang2_arr=array();
if(isset($survey_details['question_ids']) && !empty($survey_details['question_ids'])){
$question_ids=$survey_details['question_ids'];


 
foreach($question_ids as $val){
if($val->qstn_id_lang1 !='' && $val->qstn_id_lang1 !=NULL)
{
$eng_arr['qstn_id_lang1']=$val->qstn_id_lang1;
$eng_arr['id']=$val->id;
$lang1_arr[]=$eng_arr;
}
if($val->qstn_id_lang2 !='' && $val->qstn_id_lang2 !=NULL){
$mal_arr['qstn_id_lang2']=$val->qstn_id_lang2;
$mal_arr['id']=$val->id;
$lang2_arr[]=$mal_arr;
}
}
}

@endphp

<div class="content-area">
  <div class="row justify-content-center">
    <div class="col-sm-7 text-right"><a href="{{url('survey')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a> </div>
    <div class="col-sm-7 mt-3">
      <div class="widget">

                <h2>{{__('New Survey')}}</h2>
                <div class="widget-content pt-3"> 
                {!! Form::open(array('route' => 'survey.store', 'class' => 'form-common', 'method'=>'POST')) !!}
                <input type="hidden" name="sid" value="@if($sid){{ $sid ?? '' }}@endif" id="sid" />

                {{ csrf_field() }}
                <div class="row m-0 align-items-center">
                @if(session('message'))
                 <div class="alert alert-danger"> {{session('message')}}</div>
                @endif
                
                @if(session('success'))
                 <div class="alert alert-success"> {{session('success')}}</div>
                @endif
        <div class="message"></div>
        <div class="row col-md-12">
        <div class="col-md-6" > 
                <div class="form-group">
                     <input type="checkbox" name="is_english" onclick="check_survey()" class="custom-checkbox" id="is_english" value="{{config('constant.LANG_ENG')}}"  @if(isset($survey_details->is_lang1) && $survey_details->is_lang1 == config('constant.LANG_ENG')){{ 'checked'}} @endif>
                     <label class="custom-checkbox-label" for="is_english"> Languag1 </label>
                </div>
                <div id="english_div">
                    <div class="form-group">
                        <label  for="name" class="col-md-12 control-label">{{__('Survey Name ( Language1 )')}} </label>
                        <div class="col-md-12 ">
                        <input id="eng_sur_name" type="text"  class="form-control" name="eng_sur_name"   value="@if(!empty($survey_details->survey_name_lang1)){{ $survey_details->survey_name_lang1 }} @endif"  >

                        <span id="eng_sur_err"></span> 
                        </div>
                    </div>
                   <div class="clearfix"></div><br>
                    <div class="form-group">
                        <label  for="name" class="col-md-12 control-label">{{__('Description ( Language1 )')}} </label>
                        <div class="col-md-12 ">
                        <textarea id="eng_desc"  class="form-control" name="eng_desc"    >@if(!empty($survey_details->desc_lang1)){{ $survey_details->desc_lang1 }} @endif</textarea>

                        <span id="eng_desc_err"></span> 
                        </div>
                    </div>
                    <div class="clearfix"></div><br>
                    <?php

                  if(empty($lang1_arr) || count($lang1_arr)==0){ 
                    for($i=0;$i<3;$i++){?>
                    <div class="form-group">
                        <label  for="name" class="col-md-12 control-label">{{__(' Questions ( Language1 )')}} </label>
                        <div class="col-md-12 ">
                        <select class="form-control" name="eng_q{{$i}}" id="eng_q{{$i}}" >
                            <option value="0" >Select</option>
                               @foreach($eng_questions as $qstn)
                              <option value="{{$qstn->id}}" @if(isset($lang1_arr) && count($lang1_arr) > 0)  @if(in_array($qstn->id, $lang1_arr)) selected="selected" @endif @endif>{{$qstn->questions}}</option>
                              @endforeach
                            </select>
                            <span id="eng_q_err"></span> 
                        </div>
                    </div>
                    <div class="clearfix"></div><br>
                    
                   

                    
                     <?php } ?>
                      <input type="hidden" name="f_count" id="f_count" class="f_count form-control" value="{{$i}}">
                 <?php }else{

                    $i=0;
                    foreach ($lang1_arr as  $value) {

                      ?>
                      <div class="form-group">
                        <label  for="name" class="col-md-12 control-label">{{__('Questions ( Language1 )')}} </label>
                        <div class="col-md-12 ">
                        <select class="form-control" name="eng_q{{$i}}" id="eng_q{{$i}}" >
                            <option value="0" >Select</option>
                               @foreach($eng_questions as $qstn)
                              <option value="{{$qstn->id}}"   @if($qstn->id == $value['qstn_id_lang1']) selected="selected" @endif >{{$qstn->questions}}</option>
                              @endforeach
                            </select>
                            <span id="eng_q_err"></span> 
                        </div>
                    </div>
                   
                    <input type="hidden" name="relation_id{{$i}}" class="form-control" value="@isset($value['id']){{ $value['id'] }}@endisset">

                     <div class="clearfix"></div><br>                       
                    <?php $i++; } ?>

                    <input type="hidden" name="f_count" id="f_count" class="f_count form-control" value="{{$i}}">
                    <?php  }?>
                     <div id="new_question_div" class="new_question_div"> </div>
                     <div class="clearfix"></div><br>
                    
                    

                </div>
        </div>    
        <div class="col-md-6" >
                <div class="form-group">
                 <input type="checkbox" name="is_malayalam" onclick="check_survey()"  class="custom-checkbox" id="is_malayalam" value="{{config('constant.LANG_MALA')}}"  @if(isset($survey_details->is_lang2) && $survey_details->is_lang2 == config('constant.LANG_MALA')){{ 'checked'}} @endif>
                 <label class="custom-checkbox-label" for="is_malayalam"> Language2</label>
                 </div>
                 <div id="malayalam_div">
                     <div class="form-group">
                        <label  for="name" class="col-md-12 control-label">{{__('Survey Name ( Language2 )')}} </label>
                        <div class="col-md-12 ">
                         <input id="mal_sur_name" type="text"  class="form-control" name="mal_sur_name"   value="@if(!empty($survey_details->survey_name_lang2)){{ $survey_details->survey_name_lang2 }} @endif"  >
                        <span id="mal_sur_err"></span> 
                        </div>
                    </div>
                    <div class="clearfix"></div><br>
                    <div class="form-group">
                        <label  for="name" class="col-md-12 control-label"> {{__('Description ( Language2 )')}}  </label>
                        <div class="col-md-12 ">
                        <textarea id="mala_desc"   class="form-control" name="mala_desc"     >@if(!empty($survey_details->desc_lang2)){{ $survey_details->desc_lang2 }} @endif</textarea>

                        <span id="mala_desc_err"></span> 
                        </div>
                    </div>
                    <div class="clearfix"></div><br>
                    

                    <?php if(empty($lang2_arr) || count($lang2_arr)==0){
                    for($i=0;$i<3;$i++){?>
                    <div class="form-group">
                        <label  for="name" class="col-md-12 control-label"> {{__('Questions ( Language2 )')}}  </label>
                        <div class="col-md-12 ">
                        <select class="form-control" name="mala_q{{$i}}" id="mala_q{{$i}}" >
                               <option value="0" >Select</option>
                               @foreach($mala_questions as $qstn)
                              <option value="{{$qstn->id}}" >{{$qstn->questions}}</option>
                              @endforeach
                            </select>
                            <span id="mala_q_err"></span> 
                        </div>
                    </div>
                    <div class="clearfix"></div><br>
                    <?php } ?>
                    

                     <input type="hidden" name="f_count_mala" id="f_count_mala" class="f_count_mala form-control" value="{{$i}}">
                 <?php }else{

                    $i=0;
                    foreach ($lang2_arr as  $value) {

                      ?>
                      <div class="form-group">
                        <label  for="name" class="col-md-12 control-label"> {{__('Questions ( Language2 )')}}</label>
                        <div class="col-md-12 ">
                        <select class="form-control" name="mala_q{{$i}}" id="mala_q{{$i}}" >
                            <option value="0" >Select</option>
                               @foreach($mala_questions as $qstn)
                              <option value="{{$qstn->id}}"   @if($qstn->id == $value['qstn_id_lang2']) selected="selected" @endif >{{$qstn->questions}}</option>
                              @endforeach
                            </select>
                            <span id="eng_q_err"></span> 
                        </div>
                    </div>
                   
                    <input type="hidden" name="relation_id{{$i}}" class="form-control" value="@isset($value['id']){{ $value['id'] }}@endisset">

                     <div class="clearfix"></div><br>                       
                    <?php $i++; } ?>

                    <input type="hidden" name="f_count_mala" id="f_count_mala" class="f_count_mala form-control" value="{{$i}}">
                    <?php  }?>
                     <div id="new_question_div_mala" class="new_question_div_mala"> </div>
                     
                </div>
        </div>  
        <div class="clearfix"></div><br>  
          
         
        <div class="col-md-8 col-md-offset-8"> 
         <div class="form-group" id="expiry_div">
                <label class="custom-checkbox-label" for="expiry_date"> Expiry Date</label>
                 <input type="text" name="expiry_date"   class="form-control date_picker" id="expiry_date" value="@if(!empty($survey_details->expiry_date)){{ $survey_details->expiry_date }} @endif">
                 
         </div> 
        <div class="form-group text-right"><br>
                <button type="submit" id="sur_submit" class="btn btn-primary">
                  {{__('Save')}}
                </button>
                <button type="button" id="more_submit" onclick="new_questions()" class="btn btn-success">
                  {{__('Add more Questions')}}
                </button>
                     
        </div>
        </div>
        
       

                      
        </div>  
        {!! Form::close() !!}
          
          
        </div>
            </div>
        </div>
    </div>
</div>

@endsection

