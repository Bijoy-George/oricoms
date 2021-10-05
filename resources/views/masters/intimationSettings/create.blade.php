@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Intimations
@endsection
@section('content')
<div class="content-area">
<div class="row justify-content-center">
<div class="col-sm-7 text-right"><a href="{{url('settings')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a> </div>
<div class="col-md-7 mt-3">
  <div class="widget">
  <h2>{{__('Escalation Report Settings')}}</h2>
    <div class="widget-content">
      <p class="response"></p>
      @if(isset($intimations))
      {!! Form::model($intimations, ['method' => 'POST', 'class' => 'form-common', 'route' => ['intimation_settings.store']]) !!}
      @else
      {!! Form::open(array('route' => 'intimation_settings.store', 'class' => 'form-common', 'method'=>'POST')) !!}
      @endif
      
      
      {{ csrf_field() }}
      <div class="message"></div>
      {{--@isset($channels)  @foreach($channels as $chn)  @if($chn->channel==1)  checked @endif @endforeach @endisset
      @isset($channels)  @foreach($channels as $chn)  @if($chn->channel==2)  checked @endif @endforeach @endisset
      @isset($intervals)  @foreach($intervals as $interval)  @if($interval->time_interval==1)  checked @endif @endforeach @endisset
      @isset($intervals)  @foreach($intervals as $interval)  @if($interval->time_interval==2)  checked @endif @endforeach @endisset
      @isset($intervals)  @foreach($intervals as $interval)  @if($interval->time_interval==3)  checked @endif @endforeach @endisset
      @isset($intervals)  @foreach($intervals as $interval)  @if($interval->time_interval==4)  checked @endif @endforeach @endisset
      @isset($intervals)  @foreach($intervals as $interval)  @if($interval->time_interval==6)  checked @endif @endforeach @endisset--}}
        <div class="col-sm-12">
          <div class="form-group">
          <input type="hidden" id="user_id" name="user_id" value="{{$user_id}}">
          <h6><strong>Select Channel</strong></h6>
          <input type="checkbox" name="channel[]" id="sms" value="1" <?php if(isset($channels)) { foreach($channels as $chn) { if($chn->channel==1) { echo "checked"; } } }      ?> class="custom-checkbox">
          <label for="sms" class="custom-checkbox-label pr-3">SMS</label>
          <input type="checkbox" name="channel[]" id="email" value="2" <?php if(isset($channels)) { foreach($channels as $chn) { if($chn->channel==2) { echo "checked"; } } }      ?> class="custom-checkbox">
          <label for="email" class="custom-checkbox-label">Email</label>
          </div>
          <div class="form-group">
          <h6><strong>Set Interval</strong></h6>
          
            <input type="checkbox" name="interval[]" id="immediate" value="1"  <?php if(isset($intervals)) { foreach($intervals as $inter) { if($inter->time_interval==1) { echo "checked"; } } }      ?> class="custom-checkbox">
            <label for="immediate" class="custom-checkbox-label pr-3">Immediate</label>
            <input type="checkbox" name="interval[]" id="daily" value="2"  <?php if(isset($intervals)) { foreach($intervals as $inter) { if($inter->time_interval==2) { echo "checked"; } } }      ?> class="custom-checkbox">
            <label for="daily" class="custom-checkbox-label pr-3">Daily</label>
            <input type="checkbox" name="interval[]" id="weekly" value="3"  <?php if(isset($intervals)) { foreach($intervals as $inter) { if($inter->time_interval==3) { echo "checked"; } } }      ?> class="custom-checkbox">
            <label for="weekly" class="custom-checkbox-label pr-3">Weekly</label>
            <input type="checkbox" name="interval[]" id="monthly" value="4"  <?php if(isset($intervals)) { foreach($intervals as $inter) { if($inter->time_interval==4) { echo "checked"; } } }      ?> class="custom-checkbox">
            <label for="monthly" class="custom-checkbox-label pr-3">Monthly</label>
            <input type="checkbox" name="interval[]" id="esc_settings" value="6"  <?php if(isset($intervals)) { foreach($intervals as $inter) { if($inter->time_interval==6) { echo "checked"; } } }      ?> class="custom-checkbox">
            <label for="esc_settings" class="custom-checkbox-label pr-3">Superior Intimations</label>
            {{--{{ Form::checkbox('interval[]', config('constant.INTIMATION_IMMEDIATE'), '@isset($intervals)  @foreach($intervals as $interval)  @if($interval->time_interval==1)  checked @endif @endforeach @endisset', array('id' => 'immediate')) }} Immediate
            {{ Form::checkbox('interval[]', config('constant.INTIMATION_DAILY'), '@isset($intervals)  @foreach($intervals as $interval)  @if($interval->time_interval==2)  checked @endif @endforeach @endisset', array('id' => 'daily')) }} Daily
            {{ Form::checkbox('interval[]', config('constant.INTIMATION_WEEKLY'), '@isset($intervals)  @foreach($intervals as $interval)  @if($interval->time_interval==3)  checked @endif @endforeach @endisset', array('id' => 'weekly')) }} Weekly
            {{ Form::checkbox('interval[]', config('constant.INTIMATION_MONTHLY'), '@isset($intervals)  @foreach($intervals as $interval)  @if($interval->time_interval==4)  checked @endif @endforeach @endisset', array('id' => 'monthly')) }} Monthly
            {{ Form::checkbox('interval[]', config('constant.INTIMATION_SUPERIOR'), '@isset($intervals)  @foreach($intervals as $interval)  @if($interval->time_interval==6)  checked @endif @endforeach @endisset', array('id' => 'esc_settings')) }} Superior Intimations--}} 
            </div>
            <!--<label for="process_name" class="col-md-4 control-label">{{__('Process Name')}}</label>
				<div class="col-md-6 form-group">						
				{{--	{{ Form::text('process_name', null, array('class' => 'form-control','id' => 'process_name')) }}	--}}
						<span class="error" id ="process_name_err"></span>
				</div>-->
            
            <div class="form-group text-right">
              <button type="reset" class="btn btn-outline-danger px-3" >{{__('Reset')}}</button>
              <button type="submit" class="btn btn-primary px-3">{{__('Save')}}</button>
            </div>
          {{ Form::hidden('id', null, array('class' => 'form-control' )) }}
          {!! Form::close() !!}
          </form>
        </div>
    </div>
  </div>
</div>
@endsection 