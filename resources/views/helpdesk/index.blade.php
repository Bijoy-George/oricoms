@extends('layouts.listpage')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Helpdesk
@endsection
@section('content')
<aside class="sidebar">
  <div class="search-box">
    <form action="{{url('/helpdesk_search')}}" method="POST" class="listing form-common" name="form-common" id ="help_desk_con">
      <div class="row align-items-center">
        <div class="col-md-1">
          <h2 class="m-0">{{__('Search')}}</h2>
        </div>
        <input type="hidden" name="_token"  value="{{ csrf_token() }}">
        <div class="col-md form-group">
          <input type="text" class="form-control" placeholder="Keyword" id="search_keywords" name="search_keywords" >
        </div>
	@if(Auth::User()->cmpny_id == 32)
	<div class="col-md form-group">
	
	<select name="escalate" class="form-control" id="escalate">
	<option value="0">Select</option>
	  <option value="1">Escalated</option>
	  <option value="2">Not escalated</option>

	</select>
	        </div>
	@endif
        <div class="col-md form-group"> 
		{{ Form::select('query_types', $query_types, null, ['id' => 'query_types', 'class' => 'get_query_cat get_query_status form-control']) }} </div>
		<div class="col-md form-group"> {{ Form::select('query_category', ['' => 'Select'], null, ['class' => 'faq_cat_id form-control', 'id' => 'query_category']) }} </div>
        <div class="col form-group"> {{ Form::select('query_status', ['' => 'Select'], null, ['class' => 'query_status form-control', 'id' => 'query_status']) }} </div>
        @if(Auth::user()->cmpny_id == 14)
		<div class="col-md form-group"> {{ Form::select('demo', $demo, null, ['class' => 'demo form-control', 'id' => 'demo']) }} </div>
		<div class="col-md form-group"> {{ Form::select('sub_category', $sub_category, null, ['class' => 'faq_cat_id form-control', 'id' => 'sub_category']) }} </div>
	@endif
        <div class="col-md form-group">
          <input name="startdate" id="startdate"  type="text" placeholder="Start date" class="date_picker form-control" autocomplete="off">
        </div>
        <div class="col-md form-group">
          <input name="enddate" id="enddate"  type="text" placeholder="End date" class="date_picker form-control" autocomplete="off">
        </div>
        
        <div class="col-md">
          <input type="hidden" name="pageno" id="pageno" value="1">
		  <input type="hidden" name="query_status_hide_val" id="query_status_hide_val" value="">
          <button type="submit " class="btn btn-primary btn-block reset-pageno" id="">{{__('Find')}}</button>
        </div>
	
	@if(Auth::User()->cmpny_id == 32)<div class="col-md">
         {{ Form::button('Assign to Agent', array('class' => 'btn btn-outline-primary btn-block', 'onclick' => 'showAgentAssignModal()', 'id' => 's2', 'type' => '')) }}
	 </div>
	{{ Form::hidden('selectedContacts', null, ['id' => 'selectedContacts']) }}
    {{ Form::hidden('excludedContacts', null, ['id' => 'excludedContacts']) }}
    {{ Form::hidden('selectedAll', null, ['id' => 'selectedAll']) }}
            @endif
        <div class="col-md">
          <button  class="btn btn-outline-danger btn-block reset-pageno" id="s2" onclick="ressetListForm_withCountBox(this);">{{__('Reset')}}</button>
        </div>
      </div>
    </form>
  </div>
</aside>

<div class="content-area">
  <header class="row align-items-center text-center">
    <div class="col-sm-5 text-sm-left mb-3 mb-sm-0">
      <h2 class="m-0">{{__('Enquiries')}} <span id="totalcount"></span></h2>
      <small>{{__('List of leads generated')}}</small>
    </div>
    <div class="col-sm-7 text-sm-right">
      <a title="Add Customer" href="{{url('profile')}}" class="btn btn-success ml-2"><i class="fas fa-user-plus"></i></a>
      @if( Helpers::checkPermission('export in helpdesk'))
      @if (Auth::user()->cmpny_id == config('constant.DISHA_CMPNY'))
        <a title="Disha Export" href="javascript:void(0)" onclick="exportDishaHelpdesk()" class="btn btn-outline-info ml-1"><i class="fas fa-file-export"></i></a>
      @endif
      @if (Auth::user()->cmpny_id == config('constant.EHEALTH_CMPNY'))
        <a title="Ehealth Export" href="javascript:void(0)" onclick="exportEhealthHelpdesk()" class="btn btn-outline-info ml-1"><i class="fas fa-file-export"></i></a>
      @endif
	@if (Auth::user()->cmpny_id != 32)
      <a title="File Export" href="javascript:void(0)" onclick="exportHelpdesk()" class="btn btn-outline-info ml-1"><i class="fas fa-file-export"></i></a>
       @endif
	@endif 
      <a title="Go Back" href="javascript:history.go(-1)" class="btn btn-outline-info ml-1"><i class="fas fa-chevron-left"></i></a>
    </div>
  </header>
    <div class="message"></div>
    <div class="panel-body no_data" id="no_data"></div>
    <div id="list"></div>
</div>

<div class="modal fade" id="assignAgent" role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
  <form role="form" method="POST" class="" name="assignAgentForm" action="#" id="assignAgentForm">
    @csrf
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Assign Agent</h5>
        </div>
        <div class="modal-body">
            <div class="message"></div>
        <div class="form-group">
        {{ Form::label('agent', __('Agent')) }}
        {{ Form::select('agent', ['' => 'Select Agent'], NULL, array('class' => 'form-control', 'id' => 'agent')) }}
        <span class="error" id ="agents_err"></span>
      </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id" id="id" value="">
          <!--<input type="hidden" name="" id="pageid" value="">-->
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          <button type="button" class="btn btn-primary" onclick="assignAgent()">Yes</button>
        </div>
      </div>
    </div><div id="msg"></div>
  </form>
</div>
<script>
function showAgentAssignModal()
{
  var url = $("#base_url").val();
  $.ajax({
      type: "POST",
        dataType:"json",//return type expected as json
        url:  url + "/get_agent_list",      
        success: function(agents)
        {  
          $('#agent').empty();
          $('#agent').html('<option value="">Select Agent</option>');
            $.each(agents,function(agentId,agentName){
              
                var opt="<option value='"+agentId+"'>"+agentName+" </option>";

                $('#agent').append(opt);
            });
                
        }
    });
  $('#assignAgent .error').empty();
  $('#assignAgent .form-control').removeClass('red_border');
  $('#assignAgent .form-control').removeClass('text-danger');
  $('#assignAgent').modal({backdrop: false, keyboard: false});
}

</script>

@endsection
