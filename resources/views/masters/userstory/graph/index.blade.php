@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Add Task
@endsection
@section('content')

<div class="content-area">
  <div class="row justify-content-center">
    <div class="col-sm-7 text-right">
	
	
	<a href="{{url('projects')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a>
	
	</div>
    <div class="col-sm-7 mt-3">
      <div class="widget">
        <h2>{{__('Project Chart')}}</h2>
        <div class="widget-content pt-3">  

        @if(isset($res))
				  {!! Form::model($res, ['method' => 'POST', 'name' => 'frm-plan-discount', 'class' => 'form-common form-offer', 'url' => 'projectgraph']) !!}
				  @else
				  {!! Form::open(array('url' => 'projectgraph', 'class' => 'form-common form-offer', 'method'=>'POST')) !!}
				@endif

        {{ csrf_field() }}
			
		
        </div>
		<script src="http://www.chartjs.org/dist/2.7.3/Chart.bundle.js"></script>
  <script src="http://www.chartjs.org/samples/latest/utils.js"></script>
  <style>
  canvas {
    -moz-user-select: none;
    -webkit-user-select: none;
    -ms-user-select: none;
  }
  </style>
  </head>
  <body>
    <div id="container" style="width: 75%;">
    <canvas id="canvas"></canvas>
    </div>
    <script>
    var chartdata = {
    type: 'bar',
    data: {
    labels: <?php echo json_encode($ProjectName); ?>,
    // labels: month,
    datasets: [
    {
    label: 'Project Status',
    backgroundColor: '#26B99A',
    borderWidth: 1,
    data: <?php echo json_encode($Data); ?>
    }
    ]
    },
    options: {
    scales: {
    yAxes: [{
    ticks: {
    beginAtZero:true
    }
    }]
    }
    }
    }
    var ctx = document.getElementById('canvas').getContext('2d');
    new Chart(ctx, chartdata);
    </script>
		
          {!! Form::close() !!}
          
                  </div>
                </div>
            </div>
        </div>
   
@endsection


 
