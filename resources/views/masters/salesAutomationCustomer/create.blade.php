@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Sales Automation
@endsection
@section('content')
<div class="content-area">
  <div class="row justify-content-center">
    <div class="col-sm-7 text-right"><a href="{{url('sales_automation_customer')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a> </div>
    <div class="col-sm-7 mt-3">
      <div class="widget">
        <h2>{{__('Add Auto Process')}}</h2>
        <div class="widget-content pt-3"> @if(isset($automated_process))
          {!! Form::model($automated_process, ['method' => 'POST', 'class' => 'form-common', 'route' => ['sales_automation_customer.store']]) !!}
          @else
          {!! Form::open(array('route' => 'sales_automation_customer.store', 'class' => 'form-common', 'method'=>'POST')) !!}
          @endif
          {{ csrf_field() }}
          <div class="row m-0 align-items-center">
            <div class="col-md-12"> <span class="response"></span>
              <div class="message"></div>
            </div>
            <div class="col-sm-6 form-group">
              <label for="process_name" class="control-label mb-1">{{__('Process Name')}}</label>
              {{ Form::text('process_name', null, array('class' => 'form-control','id' => 'process_name')) }} <span class="error" id ="process_name_err"></span>
            </div>
            <div class="col-sm-6 form-group">
            <label for="action" class="control-label mb-1">{{__('Communication')}}</label>
              <select class="form-control" id="action" name="action">
                <option value="">Please Select</option>
                
						@foreach($results as $data)
                        
                <option value="{{ $data['GetTemplateType']['id'] }}" <?php if(isset($automated_process->action) && ($automated_process->action==$data['GetTemplateType']['id'])) { echo "selected"; }  ?>>{{ $data['GetTemplateType']['name'] }}</option>
                
						@endforeach
						
              </select>
              <span class="error" id="action_err"></span> </div>
              <div class="col-md-6 form-group">
            <label for="response_pos" class="control-label mb-1">{{__('Positive Response')}}</label>
             {{ Form::select('response_pos', [null=>'Please Select'] +$process, null, ['id' => 'response_pos', 'class' => 'form-control']) }} <span class="error" id="response_pos_err"></span> </div>
            <div class="col-md-6 form-group"><label for="response_neg" class="control-label mb-1">{{__('Negative Response')}}</label>
             {{ Form::select('response_neg', [null=>'Please Select'] +$process, null, ['id' => 'response_neg', 'class' => 'form-control']) }} <span class="error" id="response_neg_err"></span> </div>
            <div class="col-md-6 form-group"><label for="action_time" class="control-label mb-1">{{__('Action Time (Mins)')}}</label>
             {{ Form::text('action_time', null, array('class' => 'form-control','id' => 'action_time')) }} <span class="error" id ="action_time_err"></span> </div>
            <div class="col-md-6 form-group"><label for="expiry_time" class="control-label mb-1">{{__('Expiry Time (Mins)')}}</label>
             {{ Form::text('expiry_time', null, array('class' => 'form-control','id' => 'expiry_time')) }} <span class="error" id ="expiry_time_err"></span> </div>
            <div class="col-md-6 form-group"><label for="content" class="control-label mb-1">{{__('Content')}}</label>
             {{ Form::select('content', [null=>'Please Select'] +$templates, null, ['id' => 'content', 'class' => 'form-control']) }} <span class="error" id="content_err"></span> </div>
            <div class="col-md-6 form-group"><label for="process_type" class="control-label mb-1">{{__('Process Type')}}</label>
             {{ Form::select('process_type', [null=>'Please Select'] +array(config('constant.AUTO_PROCESS_TYPE_NOTF') => 'Notificational',config('constant.AUTO_PROCESS_TYPE_PROMO') => 'Promotional',config('constant.AUTO_PROCESS_TYPE_TRANS') => 'Transactional'), null, ['id' => 'process_type', 'class' => 'form-control']) }} <span class="error" id="process_type_err"></span> </div>
            <div class="col-md-6 form-group"><label for="query_type" class="control-label mb-1">{{__('Query Type')}}</label>
             {{ Form::select('query_type', [null=>'Please Select'] +$query_type, null, ['id' => 'query_type', 'class' => 'form-control']) }} <span class="error" id="query_type_err"></span> </div>
            <div class="col-md-6 form-group"><label for="query_status" class="control-label mb-1">{{__('Query Status')}}</label>
             {{ Form::select('query_status', [null=>'Please Select'] +$query_status, null, ['id' => 'query_status', 'class' => 'form-control']) }} <span class="error" id="query_status_err"></span> </div>
            <div class="col-md-6 form-group"><label for="customer_nature" class="control-label mb-1">{{__('Customer Nature')}}</label>
             {{ Form::select('customer_nature', [null=>'Please Select'] +$customer_nature, null, ['id' => 'customer_nature', 'class' => 'form-control']) }} <span class="error" id="customer_nature_err"></span> </div>
            <div class="col-md-6 form-group"><label for="priority" class="control-label mb-1">{{__('Priority')}}</label>
             {{ Form::select('priority', [null=>'Please Select'] +$priority, null, ['id' => 'priority', 'class' => 'form-control']) }} <span class="error" id="priority_err"></span> </div>
            <div class="col-md-6 form-group"><label for="lead_source_id" class="control-label mb-1">{{__('Lead Source')}}</label>
             {{ Form::select('lead_source_id', [null=>'Please Select'] +$lead_sources, null, ['id' => 'lead_source_id', 'class' => 'form-control']) }} <span class="error" id="lead_source_id_err"></span> </div>
          
        {{ Form::hidden('id', null, array('class' => 'form-control' )) }}
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