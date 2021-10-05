

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<meta name="msapplication-TileColor" content="#0062CD">
<meta name="theme-color" content="#0062CD">
<meta name="mobile-web-app-capable" content="yes">
<title>Wallboard - NHM TEST</title>
<link rel="shortcut icon" href="{{ asset('img_wallboard/favicon.ico') }}">
<link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,900|Roboto:400,700" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" type="text/css">
<style>
* {
	-webkit-text-size-adjust: 100%;
	-ms-text-size-adjust: 100%;
	transition: all .5s;
	-moz-transition: all .5s;
	-webkit-transition: all .5s;
	-o-transition: all .5s;
	box-sizing: border-box;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
}

body {font-family: 'Nunito', sans-serif;font-weight:600;}
.bg-light {background-color:#E3E7EB;}
.bg-blue {background-color:#0062CD;}
.bg-dk-blue {background-color:#00489A;}
.bg-red {background-color:#EE2C49;}
.bg-yellow {background-color:#EE9D2C;}
.bg-green {background-color:#00B540;}
.bg-orange-gradient {
	background: #f36523; /* Old browsers */
	background: -moz-linear-gradient(top, #f36523 0%, #e5470d 100%); /* FF3.6-15 */
	background: -webkit-linear-gradient(top, #f36523 0%,#e5470d 100%); /* Chrome10-25,Safari5.1-6 */
	background: linear-gradient(to bottom, #f36523 0%,#e5470d 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f36523', endColorstr='#e5470d',GradientType=0 ); /* IE6-9 */
	}
.bg-blue-gradient {
	background: #0062cd; /* Old browsers */
	background: -moz-linear-gradient(top, #0062cd 0%, #2897d3 100%); /* FF3.6-15 */
	background: -webkit-linear-gradient(top, #0062cd 0%,#2897d3 100%); /* Chrome10-25,Safari5.1-6 */
	background: linear-gradient(to bottom, #0062cd 0%,#2897d3 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#0062cd', endColorstr='#2897d3',GradientType=0 ); /* IE6-9 */
	}
h1, h2, h3, h4, h5, .navbar-brand {font-weight:900}


.row-widget {position:relative;}
.row-widget .col-sm-2 h4 {background-color:#fff;
padding:10px 15px;border-radius:5px;-webkit-border-radius:5px;}
.row-widget h4 {margin:0;}
.row-widget:before {
	width:12px;
	height:12px;
	content:'';
	left:20px;
	top:19px;
	background-color:#090;
	border-radius:50%;
	z-index:99;
	position:absolute;
	}
.row-widget:after {
  content: '';
  position: absolute;
  top: 17px;
  left: 18px;
  width: 16px;
  height: 16px;
  background:#090;
  opacity: 0;
  border-radius: 100%;
  transform-origin: 50% 50%;
  z-index:9999;
  
}
@keyframes ripple {
  0%, 35% {
    transform: scale(0);
    opacity: 1;
  }
  50% {
    transform: scale(1.5);
    opacity: 0.8;
  }
  100% {
    opacity: 0;
    transform: scale(4);
  }
}

.row-widget:after {
  animation: ripple 1.2s ease-out infinite;
  animation-delay: 1s;
}
.highlight {
	color:#090;
	}
.card {overflow:hidden;}
.graph-area {height:200px; background-color:#CD2155;}

.widget {
	border-radius:0.25rem;
	-webkit-border-radius:0.25rem;
	box-shadow: 0 1px 3px 0 rgba(0,0,0,.2), 0 1px 1px 0 rgba(0,0,0,.14), 0 2px 1px -1px rgba(0,0,0,.12);
    -webkit-box-shadow: 0 1px 3px 0 rgba(0,0,0,.2), 0 1px 1px 0 rgba(0,0,0,.14), 0 2px 1px -1px rgba(0,0,0,.12);
	overflow:hidden;
	position:relative;
	}
.widget h2{
	display:block;
	margin:0;
	text-align:center;
	font-size:18px;
	padding:8px 10px;
	font-weight:600
	}
.highlighted-widget h1 {
	font-size:50px;
	}

@media (min-width: 768px) {
.page-wrapper {padding:25px 40px;}	
	}
@media (max-width: 768px) {
.page-wrapper {padding:20px;}	
	}

</style>
<!--<link rel="stylesheet" href="css/style.css" type="text/css">-->
</head>

<body class="bg-blue">
<input type="hidden" name="base_url" id="base_url" value="{{url('/')}}">
<input type="hidden" name="cmpny_id" id="cmpny_id" value="{{ Auth::User()->cmpny_id ?? '' }}">
<section class="page-wrapper">
  <div class="container text-center">
    <h2 class="mb-4 text-white">NHM - Live Wallboard TEST </h2>
  </div>
  <div class="row row-eq-height">
    <div class="col-md-2 mb-4">
      <div class="widget bg-white d-flex" style="height:100%;"> <img src="{{ asset('img_wallboard/oricoms-logo.svg') }}" width="100%" class="align-self-center" alt=""/> </div>
    </div>
    <div class="col-md-5 mb-4">
      <div class="widget p-3 bg-blue-gradient text-white highlighted-widget">
        <div class="row align-items-center">
          <div class="col-7 d-flex align-items-center">
            <div><h1 class="m-0" id="call_waiting"></h1></div>
            <div class="p-3"><h5 class="m-0">Total calls in queue</h5></div>
          </div>
		  <div class="col-7 d-flex align-items-center">
            <div><h1 class="m-0" id="pf_count"></h1></div>
            <div class="p-3"><h5 class="m-0">Total Profiles / Calls</h5></div>
          </div>
          <!--<div class="col-5 d-flex align-items-center">
            <div><h2 class="m-0" id="calls_today"></h2></div>
            <div class="p-3"><h5 class="m-0">Total calls today</h5></div>
          </div>-->
        </div>
      </div>
    </div>
    <div class="col-md-5"></div>
  </div>
  <div class="row" id="parent_div">

  </div>
  
  {{-- <div class="col-md-12 p-2">
  <div class="widget text-white">
    <h2>Enquiry By Department <a class="help-tooltip" data-toggle="tooltip" data-placement="top" title="Helpdesk"><img src="{{ asset('img/ic_help_outline.svg') }}" height="20" alt="Help"/></a></h2>
    <div class="widget-content" id="container-query-category-week"> </div>
  </div>
</div>
  <div class="row">
  @if (isset($cmpny_query_types) && !empty($cmpny_query_types))
      @foreach ($cmpny_query_types as $query_type_id => $query_type_name)
      <div class="col-md-4 p-2">
        <div class="widget text-white">
                <h2>{{ $query_type_name }} <a class="help-tooltip" data-toggle="tooltip" data-placement="top" title="Helpdesk"><img src="{{ asset('img/ic_help_outline.svg') }}" height="20" alt="Help"/></a></h2>
                <div class="widget-content " id="graph_{{ $query_type_name }}"> </div>
              </div>
      </div>
      @endforeach
<input type="hidden" id="query_types" value="{{ json_encode($cmpny_query_types) }}">
@endif
</div>
  --}}
</section>



<script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script> 
<script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script> 
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>


<script type="text/javascript" src="{{ asset('js/highcharts.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/heatmap.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/drilldown.js') }}"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.js"></script>

<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->
    <!-- Incldue Pusher Js Client via CDN -->
    <script src="https://js.pusher.com/4.2/pusher.min.js"></script>
    <!-- Alert whenever a new notification is pusher to our Pusher Channel -->
 
    <script>
    //Remember to replace key and cluster with your credentials.
    var pusher = new Pusher('37f1e79773e00e8cd10d', {
      cluster: 'ap2',
      encrypted: true
    });
 
    //Also remember to change channel and event name if your's are different.
    var channel = pusher.subscribe('notify');
    channel.bind('notify-event', function(message) { //alert("hello");
		$('#parent_div').empty();
		var call_waiting = message['call_waiting'].length;
		$('#call_waiting').html(call_waiting);
		var calls_today_av = 0;
		var calls_today_br = 0;
		var agents_call = 0;
		var pf_count = 99999;
		$('#pf_count').html(message['profile_array']['profile_count']);
		//console.log("!!!!!!!!!!!!!!!!!!!!!!!"+message['profile_array']);
		for(var j=0;j<message['agents_available'].length;j++)
		{
			calls_today_av = parseInt(calls_today_av)+parseInt(message['agents_available'][j]['calls_today']);
		}
		for(var k=0;k<message['agents_on_break'].length;k++)
		{
			calls_today_br = parseInt(calls_today_br)+parseInt(message['agents_on_break'][k]['calls_today']);
		}
		for(var l=0;l<message['agents_on_call'].length;l++)
		{
			agents_call = parseInt(agents_call)+parseInt(message['agents_on_call'][l]['calls_today']);
		}
		var calls_today = calls_today_av + calls_today_br + agents_call;
		$('#calls_today').html(calls_today);
        //alert("gt");
		//$('#count123').html(message);
		//console.log(message['queue_status'][0]["answered_calls"]);
		for(var i=0;i<message['queue_status'].length;i++)
		{
			var colr = i%4;
			if(colr == 0)
			{
				var cls = "red";
			}
			else if(colr == 1)
			{
				var cls = "green";
			}
			else if(colr == 2)
			{
				var cls = "yellow";
			}
			else
			{
				var cls = "dark";
			}
			var queue_no = message["queue_status"][i]["queue_no"];
			var calls_in_queue = message["queue_status"][i]["calls_in_queue"];
			var answered_calls = message["queue_status"][i]["answered_calls"];
			var abandoned_calls = message["queue_status"][i]["abandoned_calls"];
			var average_hold_time = message["queue_status"][i]["average_hold_time"];
			var average_talk_time = message["queue_status"][i]["average_talk_time"];
			$('#parent_div').append('<div class="col-md-4 mb-4"><div class="widget bg-dk-blue"><h2 class="bg-'+cls+' text-white">Queue number - '+queue_no+'</h2><div class="px-3 py-1 text-white"><div class="row row-eq-height align-items-center"><div class="col-4 text-center p-2"><p class="m-0">Active Calls</p><h1 class="m-0">'+answered_calls+'</h1></div> <div class="col-5 p-2"><div><small>In queue</small> <strong>'+calls_in_queue+'</strong></div><div><small>Avg. hold time</small> <strong>'+average_hold_time+'</strong></div><div><small>Avg. talk time</small> <strong>'+average_talk_time+'</strong></div></div><div class="col-3 p-2"><div><img src="{{asset("img_wallboard/ic-headset_mic.svg")}}" width="20" alt=""/> '+answered_calls+'</div><div><img src="{{asset("img_wallboard/ic-call_missed.svg")}}" width="20" alt=""/> '+abandoned_calls+'</div><div><img src="{{asset("img_wallboard/ic-access_time.svg")}}" width="20" alt=""/> '+abandoned_calls+'</div></div></div></div></div>'); 
		}
		
    });
	
	$(document).ready(function(){
		load_wallboard();
		//load_wallboard_heatmap();//replaced with category_queries_week_api() function
		fetchQueryTypeGraphData();
		category_queries_week_api();
	});
	
	var channel1 = pusher.subscribe('notify1');
    channel1.bind('notify-event1', function(data) {
			
//console.log(result);
var query_types = $("#query_types").val();
  if (query_types == '')
  {
    return false;
  }
  query_types = JSON.parse(query_types);
jQuery.each(query_types, function(query_type_id, query_type_name) {
var result = JSON.parse(data);
//console.log(query_type_name);console.log(query_type_id);
//console.log(result.pie_one[0].qtype_id);console.log("ends a set here............");
if(query_type_id == result.pie_one[0].qtype_id)
{
          Highcharts.chart('graph_' + query_type_name, {
            chart: {
                type: 'pie'
                    },
                        title: {
                          text: ''
                          
                        },
                        tooltip: {
                          pointFormat: '{series.name}: <b> {point.y} ({point.percentage:.1f}%)</b>'
                        },
                        credits:false,
                        plotOptions: {
                          pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            depth: 35,
                            dataLabels: {
                              enabled: true,
                              format: '{point.name}: {point.y} ({point.percentage:.1f}%)'
                            },
                            showInLegend: true
                            
                          }
                        },
                        series: [{
                          animation: true,
						  type: 'pie',
                          name: query_type_name,
                          data: result.pie_one,
                          colors: ['#FA5C7C','#727CF5','#0ACF97','#17A589','#D4AC0D','#E67E22','#EC7063']
                        }],
                        lang: {
                                noData: "No " + query_type_name + "Enquiry Found."
                            },
                            noData: {
                                style: {
                                    fontWeight: 'bold',
                                    fontSize: '12px',
                                    color: '#303030'
                                }
                            }
                      });
}
		 });	
		
	});
	
	
	
	var channel2 = pusher.subscribe('notify2');
    channel2.bind('notify-event2', function(data) {
		var result=JSON.parse(data);
		Highcharts.chart('container-query-category-week', {
			chart: {
				type: 'heatmap',
				//marginTop: 0,
				//marginBottom: 80,
				plotBorderWidth: 1,
				plotBorderColor:'rgba(0,0,0,0.05)'
			},
			title: {
				text: ''
			},
			credits: false,

			xAxis: {
				categories: result.name
			},

			yAxis: {
				categories: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Total'],
				title: null
			},

			colorAxis: {
				min: 0,
				minColor: '#FFFFFF',
				maxColor: '#0062CC'
			},

			legend: {
				align: 'right',
				layout: 'vertical',
				margin: 0,
				verticalAlign: 'top',
				y: 25,
				symbolHeight: 280
			},

			tooltip: {
				formatter: function () {
          var ticketsCount = this.series.userOptions.separate_data[this.point.x][this.point.y][0];
          var followupsCount = this.series.userOptions.separate_data[this.point.x][this.point.y][1];
					// return '<b>' + this.series.xAxis.categories[this.point.x] + '</b> Lead <br><b>' +
					// 	this.point.value + '  <b>' + this.series.yAxis.categories[this.point.y] + '</b>';
          return '<b>' + this.point.value + ' ' + this.series.xAxis.categories[this.point.x] + ' Queries <br>' +
            ticketsCount + ' Tickets & ' + followupsCount + ' Followups <br> on ' + this.series.yAxis.categories[this.point.y] + 's</b>';
				}
			},

			series: [{
				animation: true,
				name: 'Enquiry By Department',
				borderColor: '#fff',
            	borderWidth: 0.5,
				data: result.value,
        separate_data: result.separated_value,
				dataLabels: {
					enabled: true,
					color: '#000000'
				}
			}]

		});
		
	});

  /*function load_wallboard_heatmap()
	{	var url = $("#base_url").val();
		$.ajax({
            type: "get",
            url: url+"/load_wallboard_heatmap",
			dataType: "json",
			data: {},
        }).done(function(data){
			
			var result=JSON.parse(JSON.stringify(data));
		Highcharts.chart('container-query-category-week', {
			chart: {
				type: 'heatmap',
				//marginTop: 0,
				//marginBottom: 80,
				plotBorderWidth: 1,
				plotBorderColor:'rgba(0,0,0,0.05)'
			},
			title: {
				text: ''
			},
			credits: false,

			xAxis: {
				categories: result.name
			},

			yAxis: {
				categories: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Total'],
				title: null
			},

			colorAxis: {
				min: 0,
				minColor: '#FFFFFF',
				maxColor: '#0062CC'
			},

			legend: {
				align: 'right',
				layout: 'vertical',
				margin: 0,
				verticalAlign: 'top',
				y: 25,
				symbolHeight: 280
			},

			tooltip: {
				formatter: function () {
          var ticketsCount = this.series.userOptions.separate_data[this.point.x][this.point.y][0];
          var followupsCount = this.series.userOptions.separate_data[this.point.x][this.point.y][1];
					// return '<b>' + this.series.xAxis.categories[this.point.x] + '</b> Lead <br><b>' +
					// 	this.point.value + '  <b>' + this.series.yAxis.categories[this.point.y] + '</b>';
          return '<b>' + this.point.value + ' ' + this.series.xAxis.categories[this.point.x] + ' Queries <br>' +
            ticketsCount + ' Tickets & ' + followupsCount + ' Followups <br> on ' + this.series.yAxis.categories[this.point.y] + 's</b>';
				}
			},

			series: [{
				animation: true,
				name: 'Enquiry By Department',
				borderColor: '#fff',
            	borderWidth: 0.5,
				data: result.value,
        separate_data: result.separated_value,
				dataLabels: {
					enabled: true,
					color: '#000000'
				}
			}]

		});
                  
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              console.log('No response from categories');
        });
	}	*/
	

function fetchQueryTypeGraphData()
{
  var query_types = $("#query_types").val();
  var url = $("#base_url").val();
  var cmpny_id = $("#cmpny_id").val();
  var ann_end_date = moment().format('DD/MM/YYYY');
  var ann_start_date = moment().subtract(1, 'months').format('DD/MM/YYYY');

  if (query_types == '')
  {
    return false;
  }
  query_types = JSON.parse(query_types);

  jQuery.each(query_types, function(query_type_id, query_type_name) {

      $.ajax({
        type:"post",
        url: url+"/api/general_enquiry_pie_chart",
        data:{
          "cmpny_id": cmpny_id,
          "ann_start_date": ann_start_date,
          "ann_end_date": ann_end_date,
          "category": query_type_id,
        },
        success:function(data)
        {
          var result = JSON.parse(data);

          Highcharts.chart('graph_' + query_type_name, {
            chart: {
                type: 'pie'
                    },
                        title: {
                          text: ''
                          
                        },
                        tooltip: {
                          pointFormat: '{series.name}: <b> {point.y} ({point.percentage:.1f}%)</b>'
                        },
                        credits:false,
                        plotOptions: {
                          pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            depth: 35,
                            dataLabels: {
                              enabled: true,
                              format: '{point.name}: {point.y} ({point.percentage:.1f}%)'
                            },
                            showInLegend: true
                            
                          }
                        },
                        series: [{
                          animation: true,
						  type: 'pie',
                          name: query_type_name,
                          data: result.pie_one,
                          colors: ['#FA5C7C','#727CF5','#0ACF97','#17A589','#D4AC0D','#E67E22','#EC7063']
                        }],
                        lang: {
                                noData: "No " + query_type_name + "Enquiry Found."
                            },
                            noData: {
                                style: {
                                    fontWeight: 'bold',
                                    fontSize: '12px',
                                    color: '#303030'
                                }
                            }
                      });
        }
    });
  });

  
}

function category_queries_week_api(){

	var ann_end_date = moment().format('DD/MM/YYYY');
	var ann_start_date = moment().subtract(1, 'months').format('DD/MM/YYYY');
    var url = $("#base_url").val();
    var cmpny_id = $("#cmpny_id").val();
  //  var ann_start_date = '01/01/2019';
    
     
    $.ajax({
            type: "POST",
            url: url+"/api/query_category_week",
      data: {
                "cmpny_id": cmpny_id,
                "ann_start_date": ann_start_date,
                "ann_end_date": ann_end_date
            },
        }).done(function(data){
            var result=JSON.parse(data);
		Highcharts.chart('container-query-category-week', {
			chart: {
				type: 'heatmap',
				//marginTop: 0,
				//marginBottom: 80,
				plotBorderWidth: 1,
				plotBorderColor:'rgba(0,0,0,0.05)'
			},
			title: {
				text: ''
			},
			credits: false,

			xAxis: {
				categories: result.name
			},

			yAxis: {
				categories: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Total'],
				title: null
			},

			colorAxis: {
				min: 0,
				minColor: '#FFFFFF',
				maxColor: '#0062CC'
			},

			legend: {
				align: 'right',
				layout: 'vertical',
				margin: 0,
				verticalAlign: 'top',
				y: 25,
				symbolHeight: 280
			},

			tooltip: {
				formatter: function () {
          var ticketsCount = this.series.userOptions.separate_data[this.point.x][this.point.y][0];
          var followupsCount = this.series.userOptions.separate_data[this.point.x][this.point.y][1];
					// return '<b>' + this.series.xAxis.categories[this.point.x] + '</b> Lead <br><b>' +
					// 	this.point.value + '  <b>' + this.series.yAxis.categories[this.point.y] + '</b>';
          return '<b>' + this.point.value + ' ' + this.series.xAxis.categories[this.point.x] + ' Queries <br>' +
            ticketsCount + ' Tickets & ' + followupsCount + ' Followups <br> on ' + this.series.yAxis.categories[this.point.y] + 's</b>';
				}
			},

			series: [{
				animation: true,
				name: 'Enquiry By Department',
				borderColor: '#fff',
            	borderWidth: 0.5,
				data: result.value,
        separate_data: result.separated_value,
				dataLabels: {
					enabled: true,
					color: '#000000'
				}
			}]

		});
                  
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              console.log('No response');
        });
   }
 
    </script>
</body>

</html>

