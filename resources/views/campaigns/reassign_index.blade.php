@extends('layouts.campaign')

@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Campaign Reassign
@endsection

@section('tab-content')
<aside class="sidebar">
  <div class="search-box"> 
  	{!! Form::open(array('url' => '/campaigns/'.$campaign->id.'/contact_list_search', 'class' => 'listing form-common', 'method'=>'POST', 'name' => 'form-common')) !!}
    <div class="row align-items-center">
     {{ Form::hidden('campaign', $campaign->id, ['id' => 'campaign']) }}
	<div class="form-group col-md-2">
		{{ Form::select('batch', $batches, null, ['class' => 'form-control', 'id' => 'batch']) }}
	</div>
	<div class="form-group col-md-2">
		{{ Form::select('group', ['' => 'Select Group'], null, ['class' => 'form-control', 'id' => 'group']) }}
	</div>
	<div class="form-group col-md-2">
		{{ Form::select('campaign_channel', $campaign_channels, null, ['class' => 'form-control', 'id' => 'campaign_channel', 'onchange' => 'fetchCommunicationStatus()']) }}
	</div>
	<div class="form-group col-md-2">
		{{ Form::select('communication_status', ['' => 'Select Communication Status'], null, ['class' => 'form-control', 'id' => 'communication_status']) }}
	</div>
	<div class="form-group col-md-2">
		{{ Form::text('search_keywords', null, array('class' => 'form-control', 'id' => 'search_keywords', 'placeholder' => 'Search with keywords')) }}
	</div>
	{{ Form::hidden('pageno', 1, array('id' => 'pageno')) }}
	<div class=" col-md-1">
		{{ Form::submit('Find', array('class' => 'btn btn-primary btn-block reset-pageno reset-contacts')) }}
	</div>
	<div class=" col-md-1">
		<button class="btn btn-outline-danger btn-block reset-pageno reset-contacts" onclick="ressetListForm(this);resetBatchGroupChannel();" type="">Reset</button>
	</div>
	
    </div>

    {!! Form::close() !!} 
	</div>
</aside>
<div class="content-area">
	<header class="row align-items-center">
		<div class="col-sm-5 text-sm-left mb-3 mb-sm-0">
			<h2 class="m-0">
				Reassign Campaign 
			</h2>
			<small><a href="javascript:history.go(-1)">Campaigns</a> /  Reassign Campaign  </small>
		</div>
		<div class="col-sm-7 text-sm-right">
			<a title="Go Back" href="javascript:history.go(-1)" class="btn btn-outline-info ml-1"><i class="fas fa-chevron-left"></i></a>
		</div>
	</header>
</div>
<div class="content-area pt-0">
	<div class="widget">
		<div class="widget-heading">
			<div class="row">
				<div class="col-12 col-md-6">
					<h2>Reassign Campaign Contacts	</h2>
				</div>
				<div class="col-12 col-md-6 text-right">
					{{ Form::button('Reassign', array('class' => 'btn btn-success btn-sm mt-1 mr-1', 'onclick' => 'showReassignContactForm()')) }}
				</div>
			</div>
		</div>
		<div class="table-widget table-responsive mt-0 pt-0 p-3">
			{{ Form::hidden('selectedContacts', null, ['id' => 'selectedContacts']) }}
			{{ Form::hidden('excludedContacts', null, ['id' => 'excludedContacts']) }}
			<div class="panel-body no_data" id="no_data"></div>
	    	<div id="list"></div>
		</div>
	</div>
</div>




<div class="modal fade" id="reassignGroup" role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
  <form role="form" method="POST" class="" name="reassignGroupForm" action="#" id="reassignGroupForm">
    @csrf
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      	<div class="modal-header">
	        <h5 class="modal-title">Create New Group</h5>
      	</div>
        <div class="modal-body">
          	<div class="message"></div>
	  		<div class="form-group">
				{{ Form::label('name', __('Group Name')) }}
				{{ Form::text('name', null, array('class' => 'form-control', 'id' => 'name')) }}
				<span class="error" id ="name_err"></span>
			</div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id" id="id" value="">
          <input type="hidden" name="process_type" id="process_type" value="{{ config('constant.BP_REASSIGN_GROUP_IMPORT') }}">
          <!--<input type="hidden" name="" id="pageid" value="">-->
          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="abortReassign()">No</button>
          <button type="button" class="btn btn-primary" onclick="reassignContacts()">Yes</button>
        </div>
      </div>
    </div>
  </form>
</div>
<!-- Deletion modal end --> 

@endsection

@section('footer-custom-css-js')
	<script src="{{ asset('js/campaigns/reassign.js') }}"></script>
@endsection