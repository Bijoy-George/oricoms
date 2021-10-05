<link href="{{ asset('css/stagestyle.css') }}" rel="stylesheet">

<div class="container">
  <div class="row">
    <div class="col-sm-3 text-right"><h4 class="stage-title">Customer Journey</h4></div>
<div class="col-md-7">
      <div class="user-info">
        <span id="no_data"></span>
        <div class="user-pic"><a href="{{url('profile')}}/0/{{$customer_details->id}}"><img src="{{url('/')}}/images/default-avatar.jpg"></a></div>
        <div class="user-detail">
          <h1>@if(!empty($customer_details->first_name)){{strip_tags($customer_details->first_name)}} @endif
            @if(!empty($customer_details->middle_name)){{strip_tags($customer_details->middle_name)}}@endif
          @if(!empty($customer_details->last_name)){{strip_tags($customer_details->last_name)}}@endif</h1>
          
          </div>
      </div>
    </div>
  </div>
  
    
		<?php $i = ($stage_historys->currentpage()-1) * $stage_historys->perpage() +  1;?>
    @foreach($stage_historys as $stg_history)
	<div class="row stage-row">
    <div class="col-sm-3 text-right p-0">
    	@if(!empty($stg_history->auto_process_id))
      		<h3>Stage - {{strip_tags($stg_history->auto_process_id)}}</h3>
      @endif
      @if(!empty($stg_history->created_at))
      <p><small>Created at {{strip_tags($stg_history->created_at)}}</small></p>
      @endif
    </div>
    <div class="col-sm-1 text-center">
      @if(empty($stg_history->action))
      <span class="stage-info empty"><img src="{{url('/')}}/images/ic_no-action.svg"></span>
      @endif
      @if(!empty($stg_history->action) && $stg_history->action == 1)
      <!--<a href="" class="stage-info sms">--><div class="stage-info sms"><img src="{{url('/')}}/images/ic_sms.svg" data-toggle="tooltip" data-placement="top" title="Communication via SMS"></div><!--</a>-->
      @endif
      @if(!empty($stg_history->action) && $stg_history->action == 2)
      <!--<a href="" class="stage-info email">--><div class="stage-info email"><img src="{{url('/')}}/images/ic_email_outline.svg" data-toggle="tooltip" data-placement="top" title="Communication via Email"></div><!--</a>-->
      @endif
      @if(!empty($stg_history->action) && $stg_history->action == 3)
      <!--<a href="" class="stage-info call">--><div class="stage-info call"><img src="{{url('/')}}/images/ic_call.svg" data-toggle="tooltip" data-placement="top" title="Communication via Manual Call"></div><!--</a>-->
      @endif
	  @if(!empty($stg_history->action) && $stg_history->action == 4)
      <!--<a href="" class="stage-info call">--><div class="stage-info call"><img src="{{url('/')}}/images/ic_call.svg" data-toggle="tooltip" data-placement="top" title="Communication via Autodial"></div><!--</a>-->
      @endif
    </div>
    <div class="col-sm-7 stage-details empty @if(empty($stg_history->action)) empty @endif @if(!empty($stg_history->action) && $stg_history->action == 1) sms @endif @if(!empty($stg_history->action) && $stg_history->action == 2) email @endif @if(!empty($stg_history->action) && $stg_history->action == 3) Manual call @endif
	@if(!empty($stg_history->action) && $stg_history->action == 4) Autodial @endif">
      @if(!empty($stg_history->process_name))
      <p class="content"><strong>Process Name: </strong>{{strip_tags($stg_history->process_name)}}</p>
  <p>
  @if(!empty($stg_history->action) && $stg_history->action == 1) sms @endif @if(!empty($stg_history->action) && $stg_history->action == 2) email @endif @if(!empty($stg_history->action) && $stg_history->action == 3) Manual call @endif
  @if(!empty($stg_history->action) && $stg_history->action == 4) Autodial @endif
  
  </p>
      @endif
      @if(!empty($stg_history->process))
      <p class="content"><strong>Process: </strong>{{strip_tags($stg_history->process)}}</p>
      @endif
      @if(!empty($stg_history->action_time) && ($stg_history->action_time!='0000-00-00 00:00:00'))
      <p class="content"><strong>Action Time: </strong>{{strip_tags($stg_history->action_time)}}</p>
      @endif
    </div>
    

<div class="clearfix"></div>
    </div>
    @endforeach
    @if(count($stage_historys) <= 0)
    <div class="no_data">
      <h3 class="no_data">No Data Found</h3>
    </div>
    @endif
    	<div class="text-right" > {!! $stage_historys->render() !!}</div>
    
</div>


