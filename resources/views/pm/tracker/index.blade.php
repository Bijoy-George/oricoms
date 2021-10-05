@extends('layouts.listpage')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Customer Nature
@endsection
@section('content')


 <form action="{{url('/search_tracker')}}" method="POST" class="listing form-common" name="form-common">
<aside class="sidebar">
  <div class="search-box">
   
	  <div class="row align-items-center justify-content-center">
        <input type="hidden" name="_token"  value="{{ csrf_token() }}">
        <div class="col-sm-1"><h2 class="m-0">Search</h2></div>
		<div class="col-sm-2 form-group">
        <input type="text" class="form-control" placeholder="Keyword" id="search_keywords" name="search_keywords">
        </div>
		<?php 
			$members = Helpers::getUserByPermission('tracker create','yes'); 
	    ?>
		{{--<div class="col-sm-1 form-group">
		<select name="members" class="form-control" id="members" >
		<option value>Select Member</option>
				@if(count($members)){
					@foreach ($members as $member)
						 <option value="{{$member['id']}}">{{$member['name']}}</option>
					@endforeach
				@endif
		</select>
		</div>--}}
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
            <a class="nav-item nav-link  <?php if ($open_key == $key){?> active <?php }?>" id="nav-profile-tab" data-toggle="tab" href="#openstatus" role="tab" aria-controls="basic-prof" aria-selected="true" onclick="getstatus({{$key}})">{{$stat}}</a>
            @endforeach
            </div>
        </nav>
    </div>
</aside>


<div class="content-area">
	<header class="row align-items-center">
    <div class="col-sm-5">
      <h2 class="m-0">{{__('My Tasks')}} <span id="totalcount"></span></h2>
      <small>{{Helpers::get_workhours_period()}}</small>
    </div>
    <div class="col-sm-7 text-right"><a href="{{url('tracker_list')}}" class="btn btn-warning"><img src="{{ asset('img/ic_chat_list.png') }}" alt=""><span style="color:#fff;">All Members Track History</span></a> @if( Helpers::checkPermission('task create')) 
	   <a href="{{route('project_task_pm.create')}}" class="btn btn-success ml-2"><img src="{{ asset('img/ic_add.svg') }}"  alt=""/> Add New Task</a>
		   @endif
    </div>
  </header>

    <div class="panel-body no_data" id="no_data"></div>
    <div id="list"></div>
    <div class="col-md-6">
  <div class="widget">
    <h2>Tasks<a class="help-tooltip" data-toggle="tooltip" data-placement="top" title="Summarizes Tickets & Service requests under various agents"><img src="{{ asset('img/ic_help_outline.svg') }}" height="20" alt="Help"/></a></h2>
    <div class="widget-content" id="task-container" style="height:250px"> </div>
  </div>
</div> 
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script type="text/javascript">
  // Radialize the colors

</script>
<style type="text/css">
  .highcharts-figure, .highcharts-data-table table {
    min-width: 320px; 
    max-width: 660px;
    margin: 1em auto;
}

.highcharts-data-table table {
  font-family: Verdana, sans-serif;
  border-collapse: collapse;
  border: 1px solid #EBEBEB;
  margin: 10px auto;
  text-align: center;
  width: 100%;
  max-width: 500px;
}
.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}
.highcharts-data-table th {
  font-weight: 600;
    padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
    padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}
.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

</style>
</div>
</div>

</form>

 <script>
 	function task_graph()
  {
  	
    var url = $("#base_url").val();
   

  $.ajax({
    type:"post",
    url: url+"/tasks_graph",
    data:{
    },
    success:function(data)
    {
    // console.log(data);
    var result = JSON.parse(data);
    var graph = JSON.parse(result);
    console.log(graph);
    Highcharts.setOptions({
    colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
        return {
            radialGradient: {
                cx: 0.5,
                cy: 0.3,
                r: 0.7
            },
            stops: [
                [0, color],
                [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
            ]
        };
    })
});

Highcharts.chart('task-container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Task summary'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                connectorColor: 'silver'
            }
        }
    },
    series: [{
        name: 'Task',
        data: graph



    }]
});
}
});
}
 </script>

<script type="text/javascript">
	$(document).ready(function() {
   task_graph();
    
});
</script>
<script type="text/javascript">
    
    $(document).ready(function () {

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

@endsection 
