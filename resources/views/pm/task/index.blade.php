@extends('layouts.listpage')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Customer Nature
@endsection
@section('content')
@if(Helpers::checkPermission('task management'))
 <form action="{{url('/search_project_tasks')}}" method="POST" class="listing form-common" name="form-common">
<aside class="sidebar">
  <div class="search-box">
   
	  <div class="row align-items-center justify-content-center">
        <input type="hidden" name="_token"  value="{{ csrf_token() }}">
        <!--<div class="col-sm-1"><h2 class="m-0">Search</h2></div>-->
		<div class="col-sm-2 form-group">
        <input type="text" class="form-control" placeholder="SearchKeyword" id="search_keywords" name="search_keywords">
        </div>
		<?php 
			$members = Helpers::getUserByPermission('tracker create','yes'); 
	    ?>
		<div class="col-sm-1 form-group">
		<select name="members" class="form-control" id="members" >
		<option value>Select Member</option>
				@if(count($members)){
					@foreach ($members as $member)
						 <option value="{{$member['id']}}">{{$member['name']}}</option>
					@endforeach
				@endif
		</select>
		</div>
		<div class="col-sm-1 form-group">
		<select name="project_id" class="form-control" id="project_id" >
		<option value>Select Project</option>
				@if(count($projects)){
					@foreach ($projects as $key => $value)
						 <option value="{{$key}}">{{$value}}</option>
					@endforeach
				@endif
		</select>
		</div>
		<script type="text/javascript">
			$('#members').picker({containerWidth: 465, search: true});
		</script>
		
		<div class="col-sm-1 form-group">
        {{ Form::select('priority', [null=>'Priority'] +$priority, null, ['id' => 'priority', 'class' => 'form-control']) }}	
        </div>
		<div class="col-sm-1 form-group">
        {{ Form::select('category', [null=>'Category'] +$category, null, ['id' => 'category', 'class' => 'form-control']) }}	
        </div>
		<div class="col-sm-1 form-group" style="display: none;">
        {{ Form::select('status', [null=>'Status'] +$status, null, ['id' => 'status', 'class' => 'form-control']) }}	
        </div>
		<div class="col-sm-1 form-group">
        {{ Form::text('start_date', null, array('id' => 'start_date','class' => 'date_picker form-control','placeholder' => 'Start ','autocomplete' => 'off')) }}	
        </div>
		<div class="col-sm-1 form-group">
        {{ Form::text('end_date', null, array('id' => 'end_date','class' => 'date_picker form-control','placeholder' => 'End ','autocomplete' => 'off')) }}	
        </div>
		<div class="col-sm-1 form-group">
		<input type="hidden" name="pageno" id="pageno" value="1">
		<button type="submit " class="btn btn-primary btn-block" id="">{{__('Find ')}}</button>
        </div>
        <div class="col-sm-1 form-group">
        <button  class="btn btn-outline-danger btn-block" id="s2" onclick="ressetListForm(this);">{{__('Reset ')}}</button>
        </div>
        <div class="col-sm-1 form-group">
        <a href="{{url('/view_details')}}"  class="btn btn-primary btn-sm">View</a>
        </div>
	
    </div>
</aside>
<?php 
$open_key = key($status); ?>

<input type="hidden" id="open_key" value={{ $open_key }} > 
<aside class="sidebar">
	<div class="search-box">
		<nav>
		<div class="nav nav-tabs" id="nav-tab" role="tablist">
				@foreach($status as $key => $stat)

		<a class="nav-item nav-link <?php if ($open_key == $key){?> active <?php }?> "id="tabclick_{{$key}}" data-toggle="tab" href="#openstatus" role="tab" aria-controls="basic-prof" aria-selected="true" onclick="getstatus({{$key}})">{{$stat}}</a>


         		@endforeach
				 		
        
		</div>
		</nav>
	</div>
</aside>
<script>

</script>

<div class="message mt-2"></div>
<div class="content-area">
	<header class="row align-items-center">
    <div class="col-sm-5">
      <h2 class="m-0">{{__('TASKS')}} <span id="totalcount"></span></h2>
      <small>Available Tasks</small>
    </div>
    <div class="col-sm-7 text-right"><!--<a href="{{url('settings')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}" alt=""></a> -->@if( Helpers::checkPermission('task create')) 
	   <a href="{{route('project_task_pm.create')}}" class="btn btn-success ml-2"><img src="{{ asset('img/ic_add.svg') }}"  alt=""/> Add New Task</a>
		   @endif
		   <a title="File Export" href="#" class="btn btn-outline-info ml-1"  onclick="exporttasks();"><i class="fas fa-file-import"></i></a>
    </div>
  </header>

    <div class="panel-body no_data" id="no_data"></div>
    <div id="list"></div>
</div>
</div>
</form>

<script type="text/javascript">
	
	$(document).ready(function() {

		 var open = document.getElementById("open_key").value;

		$("#status").val(open);
		$(".listing").submit();


	    });

	function getstatus(id)
	{
		var status_val = id;
		$("#status").val(status_val);
		$(".listing").submit();

	}
</script>

@endif
@endsection 
