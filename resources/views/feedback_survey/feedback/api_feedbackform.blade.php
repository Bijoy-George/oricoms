@if($result_arr['is_exist'] != 0)
<div class="alert alert-secondary" role="alert"><h2 class="m-0 text-center">Feedback Already Submitted.</h2></div>
@else
<form class="form-common" role="form" method="POST" action="{{ url('api/feedback_insertion') }}" autocomplete="off">
 <div class="row justify-content-center text-center">
 <div class="col-md-12">
  <div id="msg" role="alert"></div>
  </div>
  <input type="hidden" name="_token" class="_token" value="{{ csrf_token() }}">
  <div class="col-md-12 form-group"> @php
    $i=1;@endphp
    
    @foreach ($result_arr['questions'] as $value)
    <h4><?php echo $value['eng_questions']['questions'];?></h4>
    @if($value['eng_questions']['option1'])
    <input required type="radio" name="questions[<?php echo $value['eng_questions']['id'];?>]" id="radio-1-{{$value['eng_questions']['id']}}" class="custom-radio" value="{{$value['eng_questions']['option1']}}" >
    <label for="radio-1-{{$value['eng_questions']['id']}}" class="custom-checkbox-label">{{$value['eng_questions']['option1']}}</label>
    @endif
    @if($value['eng_questions']['option2'])
    <input  required type="radio" name="questions[<?php echo $value['eng_questions']['id'];?>]" id="radio-2-{{$value['eng_questions']['id']}}" class="custom-radio" value="{{$value['eng_questions']['option2']}}" >
    <label for="radio-2-{{$value['eng_questions']['id']}}" class="custom-checkbox-label">{{ $value['eng_questions']['option2'] }}</label>
    @endif
    @if($value['eng_questions']['option3'])
    <input  required type="radio" name="questions[<?php echo $value['eng_questions']['id'];?>]" id="radio-3-{{$value['eng_questions']['id']}}" class="custom-radio" value="{{ $value['eng_questions']['option3'] }}" >
    <label for="radio-3-{{$value['eng_questions']['id']}}" class="custom-checkbox-label">{{$value['eng_questions']['option3']}}</label>
    @endif
    @if($value['eng_questions']['option4'])
    <input  required type="radio" name="questions[<?php echo $value['eng_questions']['id'];?>]" id="radio-4-{{$value['eng_questions']['id']}}" class="custom-radio" value="{{$value['eng_questions']['option4']}}" >
    <label for="radio-4-{{$value['eng_questions']['id']}}" class="custom-checkbox-label">{{$value['eng_questions']['option4']}}</label>
    @endif
    @if($value['eng_questions']['option5'])
    <input  type="radio" name="questions[<?php echo $value['eng_questions']['id'];?>]" id="radio-5-{{$value['eng_questions']['id']}}" class="custom-radio" value="<?php echo $value['eng_questions']['option5']; ?>" >
    <label for="radio-5-{{$value['eng_questions']['id']}}" class="custom-checkbox-label"><?php echo $value['eng_questions']['option5']; ?></label>
    @endif
    @if($value['eng_questions']['option6'])
    <input  required type="radio" name="questions[<?php echo $value['eng_questions']['id'];?>]" id="radio-6-{{$value['eng_questions']['id']}}" class="custom-radio" value="{{$value['eng_questions']['option6']}}" >
    <label for="radio-6-{{$value['eng_questions']['id']}}" class="custom-checkbox-label">{{$value['eng_questions']['option6']}}</label>
    @endif
    
    
    @php  
    $i++; @endphp
    @endforeach </div>
  @if($result_arr['is_rating'] == 1)
  <div class="col-md-12 form-group" id="rating_div">
    <h4>{{__('How do you rate your overall experience?')}}</h4>
      <input required type="radio" name="rating" id="rating-1" class="custom-radio" value="5" >
      <label for="rating-1" class="custom-checkbox-label">Excellent</label>
      <input required type="radio" name="rating" id="rating-2" class="custom-radio" value="4" >
      <label for="rating-2" class="custom-checkbox-label">Good</label>
      <input required type="radio" name="rating" id="rating-3" class="custom-radio" value="3" >
      <label for="rating-3" class="custom-checkbox-label">Average</label>
      <input required type="radio" name="rating" id="rating-4" class="custom-radio" value="2" >
      <label for="rating-4" class="custom-checkbox-label">Bad</label>
      <input required type="radio" name="rating" id="rating-5" class="custom-radio" value="1" >
      <label for="rating-5" class="custom-checkbox-label">Very Bad</label>
  </div>
  @endif
  
  {{ Form::hidden('fid',$result_arr['fid']) }}
  {{ Form::hidden('authentication_key',$result_arr['authentication']) }}
  {{ Form::hidden('customer_id',$result_arr['customer_id']) }}
  {{ Form::hidden('type',$result_arr['type']) }}
  {{ Form::hidden('company_id',$result_arr['company_id']) }}
  
  @if($result_arr['is_comment'] == 1)
  <div class="col-md-10 form-group">
    <label for="comments"> {{__('Comments :')}}</label>
    <textarea class="form-control" type="textarea" name="comments" id="comments" placeholder="Your Comments" maxlength="6000" rows="3"></textarea>
  </div>
  @endif
  <div class="col-md-10 form-group">
    <button type="reset" class="btn btn-outline danger px-4" > {{__('Reset')}} </button>
    <button type="submit" class="btn btn-success px-4"> {{__('Save')}} </button>
    
  </div>
  </div>
</form>
@endif