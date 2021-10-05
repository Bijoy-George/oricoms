@extends('layouts.outsidepage')
@section('title')
{{config('constant.site_title')}} - Survey
@endsection
@section('content')
<div class="row m-0 align-items-center justify-content-center feedback-survey text-white">
<div class="col-md-6 text-center py-4 ">
  <h2>{{__('Survey')}}</h2>
</div>
<div class="col-md-12"></div>
<div class="col-md-6">
  <div class="form-container p-3"> @if($surv_exist != 0)
    <div class="alert alert-secondary" role="alert">
      <h2 class="m-0 text-center">Survey Already Submitted.</h2>
    </div>
    @elseif($check_expiry == 0)
    <div class="alert alert-secondary" role="alert">
      <h2 class="m-0 text-center">Survey expred.</h2>
    </div>
    @else
    <form class="form-common" role="form" method="POST" action="{{ url('api/survey_insertion') }}" autocomplete="off">
      <div class="row justify-content-center text-center">
        <div id="msg" class="alert" role="alert"></div>
        @if($survey_qstn)
        <div class="col-sm-12" id="qstn"> @php 
          $i=1; @endphp
          @foreach($survey_qstn as $value)
          <div class="form-group">
            <h4><?php echo $i.'. '.$value['survey_mal_qstn']['questions'];?></h4>
            <input type="hidden" name="qstn[<?php echo $value['id'];?>]" value="<?php echo $value['qstn_id_lang2'];?>" >
            <?php if(isset($value['survey_mal_qstn']['option1']) && !empty($value['survey_mal_qstn']['option1'])){?>
            <input  type="radio" name="questions[<?php echo $value['id'];?>]"  value="option1" class="custom-radio" id="radio-1-{{$value['survey_mal_qstn']['id']}}">
            <label for="radio-1-{{$value['survey_mal_qstn']['id']}}" class="custom-checkbox-label">{{$value['survey_mal_qstn']['option1']}}</label>
            <?php } ?>
            <?php if(isset($value['survey_mal_qstn']['option2']) && !empty($value['survey_mal_qstn']['option2'])){?>
            <input  type="radio" name="questions[<?php echo $value['id'];?>]"  value="option2" class="custom-radio" id="radio-2-{{$value['survey_mal_qstn']['id']}}">
            <label for="radio-2-{{$value['survey_mal_qstn']['id']}}" class="custom-checkbox-label">{{$value['survey_mal_qstn']['option2']}}</label>
            <?php } ?>
            <?php if(isset($value['survey_mal_qstn']['option3']) && !empty($value['survey_mal_qstn']['option3'])){?>
            <input  type="radio" name="questions[<?php echo $value['id'];?>]"  value="option3" class="custom-radio" id="radio-3-{{$value['survey_mal_qstn']['id']}}">
            <label for="radio-3-{{$value['survey_mal_qstn']['id']}}" class="custom-checkbox-label">{{$value['survey_mal_qstn']['option3']}}</label>
            <?php } ?>
            <?php if(isset($value['survey_mal_qstn']['option4']) && !empty($value['survey_mal_qstn']['option4'])){?>
            <input  type="radio" name="questions[<?php echo $value['id'];?>]"  value="option4" class="custom-radio" id="radio-4-{{$value['survey_mal_qstn']['id']}}">
            <label for="radio-4-{{$value['survey_mal_qstn']['id']}}" class="custom-checkbox-label">{{$value['survey_mal_qstn']['option4']}}</label>
            <?php } ?>
            <?php if(isset($value['survey_mal_qstn']['option5']) && !empty($value['survey_mal_qstn']['option5'])){?>
            <input  type="radio" name="questions[<?php echo $value['id'];?>]"  value="option5" class="custom-radio" id="radio-5-{{$value['survey_mal_qstn']['id']}}">
            <label for="radio-5-{{$value['survey_mal_qstn']['id']}}" class="custom-checkbox-label">{{$value['survey_mal_qstn']['option5']}}</label>
            <?php } ?>
            <?php if(isset($value['survey_mal_qstn']['option6']) && !empty($value['survey_mal_qstn']['option6'])){?>
            <input  type="radio" name="questions[<?php echo $value['id'];?>]"  value="option6" class="custom-radio" id="radio-6-{{$value['survey_mal_qstn']['id']}}">
            <label for="radio-6-{{$value['survey_mal_qstn']['id']}}" class="custom-checkbox-label">{{$value['survey_mal_qstn']['option6']}}</label>
            <?php } ?>
          </div>
          @php $i++; @endphp
          @endforeach </div>
      </div>
      @endif
      
      {{ Form::hidden('campaign_id',$survey_det->campaign_id) }}
      
      {{ Form::hidden('langtype',$langtype) }}
      
      
      
      {{ Form::hidden('contact_id',$survey_det->contact_id) }}
      
      {{ Form::hidden('batch_id',$survey_det->batch_id) }}
      
      {{ Form::hidden('common_id',$survey_det->id) }}
      
      {{ Form::hidden('survey_id',$surveyid) }}
      
      {{ Form::hidden('customer_id',$survey_det->customer_id) }}
      
      {{ Form::hidden('company_id',$survey_det->cmpny_id) }}
      
      {{ Form::hidden('authentication_key',$authentication) }}
      <div class="col-md-10 form-group">
        <button type="reset" class="btn btn-outline-danger px-4" > {{__('Reset')}} </button>
        <button type="submit" class="btn btn-success px-4"> {{__('Save')}} </button>
      </div>
    </form>
    @endif </div>
</div>
@endsection 