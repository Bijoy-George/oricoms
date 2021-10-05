/* 
 * dashboard js function and global variables
 */


 
$.ajaxSetup({ 
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function feedback_rating_api(){
    var url = $("#base_url").val();
    var cmpny_id=$("#cmpny_id").val();
    var ann_searchQuery=$("#ann_searchQuery").val();
    var ann_searchQuery1=$("#ann_searchQuery1").val();
     
    $.ajax({
            type: "POST",
            url: url+"/api/feedback_rating",
      data: {
                "cmpny_id": cmpny_id,
                "ann_start_date": ann_searchQuery,
                "ann_end_date": ann_searchQuery1,

            },
        }).done(function(data){

         $('#fb_rating_div').html(data)
                  
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              console.log('No response from show feedback form section');
        });
   }
function trending_queryies_api(){
    var url = $("#base_url").val();
    var cmpny_id=$("#cmpny_id").val();
  //  var ann_searchQuery=$("#ann_searchQuery").val();
  //  var ann_searchQuery1=$("#ann_searchQuery1").val();
     
    $.ajax({
            type: "POST",
            url: url+"/api/trending_query",
      data: {
                "cmpny_id": cmpny_id,

            },
        }).done(function(data){

         $('#trending_queryies_div').html(data)
                  
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              console.log('No response from show feedback form section');
        });
   }

function survey_api(){
    var url = $("#base_url").val();
    var cmpny_id=$("#cmpny_id").val();
    var ann_searchQuery=$("#ann_searchQuery").val();
    var ann_searchQuery1=$("#ann_searchQuery1").val(); 
    $.ajax({
            type: "POST",
            url: url+"/api/survey_graph",
      data: {
                "cmpny_id": cmpny_id,
                "ann_start_date": ann_searchQuery,
                "ann_end_date": ann_searchQuery1,

            },
        }).done(function(data){
            var result=JSON.parse(data)
           
           Highcharts.chart('container-survey', {
            chart: {
                type: 'column'
            },
            title: {
                text: ''
            },
            xAxis: {
                categories: result.survey_det
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Total Survey'
                },
                stackLabels: {
                    enabled: true,
                    style: {
                        fontWeight: 'bold',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                    }
                }
            },
            legend: {
                align: 'right',
                x: -30,
                verticalAlign: 'top',
                y: 25,
                floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                borderColor: '#CCC',
                borderWidth: 1,
                shadow: false
            },
            tooltip: {
                headerFormat: '<b>{point.x}</b><br/>',
                pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                    }
                }
            },
			credits: false,
            series: [{
                animation: true,
				name: 'Not submitted',
                color:'#FA5C7C',
                data: result.survey_count.not_submitted
            },{
                name: 'Submitted survey',
                color:'#0ACF97',
                data:result.survey_count.submitted
            }]
        });
                  
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              console.log('No response from show feedback form section');
        });
   }
   
function category_queries_week_api(){
    var url = $("#base_url").val();
    var cmpny_id=$("#cmpny_id").val();
    var ann_start_date=$("#ann_searchQuery").val();
    var ann_end_date=$("#ann_searchQuery1").val();
     
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
				categories: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
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


function fetchQueryTypeGraphData()
{
  var query_types = $("#query_types").val();
  var url = $("#base_url").val();
  var cmpny_id = $("#cmpny_id").val();
  var ann_start_date  = $('#ann_searchQuery').val();
  var ann_end_date    = $('#ann_searchQuery1').val();

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
function feedback_statistics(){
    var url = $("#base_url").val();
    var cmpny_id=$("#cmpny_id").val();
    var ann_start_date  = $('#ann_searchQuery').val();
    var ann_end_date    = $('#ann_searchQuery1').val(); 
    $.ajax({
            type: "POST",
            url: url+"/api/feedback_statistics",
      data: {
                "cmpny_id": cmpny_id,
                "ann_start_date": ann_start_date,
                "ann_end_date": ann_end_date,

            },
        }).done(function(data){
            var result=JSON.parse(data)
        
      console.log()


            Highcharts.chart('fbcontainer', {
      chart: {
            type: 'pie'
          },
          title: {
            text: ''
            
          },
          tooltip: {
            pointFormat: '{series.name}: <b>{point.y} ({point.percentage:.1f}%)</b>'
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
            name: 'FEEDBACKS',
            colorByPoint: true,
            data: result.fb_pie,
            colors: ['#BB8FCE','#4A235A','#2E86C1','#17A589','#D4AC0D','#E67E22','#EC7063']
        }],
    "drilldown": {
    "series": result.fb_drilldown
    },
  lang: {
          noData: "No Feedback Found."
      },
      noData: {
          style: {
              fontWeight: 'bold',
              fontSize: '12px',
              color: '#303030'
          }
      }
                    
                });
                  
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              console.log('No response from show feedback form section');
        });
   }

  function leads_line_chart()
  {
    var url = $("#base_url").val();
    var cmpny_id = $("#cmpny_id").val();
    var ann_start_date  = $('#ann_searchQuery').val();
    var ann_end_date    = $('#ann_searchQuery1').val();

  $.ajax({
    type:"post",
    url: url+"/api/lead_line_graph_api",
    data:{
      "cmpny_id": cmpny_id,
      "ann_start_date": ann_start_date,
      "ann_end_date": ann_end_date
    },
    success:function(data)
    {
      // var result = JSON.parse(data);
      var series_data = [];
      var leads_series_data = [];
      if (data[1] != undefined)
      {
        var leads_graph  = data[1];
        leads_graph_series_name = data[1].series_name;
        leads_graph_data = data[1].data;
        jQuery.each(leads_graph_data, function(index,value) {
          var date = value[0];
          var date = date.split(',');
          var dateYear = date[0];
          var dateMonth = date[1];
          var dateDate = date[2];
          var utcdate = Date.UTC(dateYear,dateMonth,dateDate);
          var lead_count = value[1];
          leads_series_data.push([utcdate, lead_count]);
          // console.log(date);
          // console.log(lead_count);
        });
        series_data.push({
          name : leads_graph_series_name,
          data : leads_series_data
        });
      }

      // var customers_series_data = [];
      // if (data[2] != undefined)
      // {
      //   var customers_graph  = data[2];
      //   customers_graph_series_name = data[2].series_name;
      //   customers_graph_data = data[2].data;
      //   jQuery.each(customers_graph_data, function(index,value) {
      //     var date = value[0];
      //     var date = date.split(',');
      //     var dateYear = date[0];
      //     var dateMonth = date[1];
      //     var dateDate = date[2];
      //     var utcdate = Date.UTC(dateYear,dateMonth,dateDate);
      //     var customer_count = value[1];
      //     customers_series_data.push([utcdate, customer_count]);
      //     // console.log(date);
      //     // console.log(lead_count);
      //   });
      //   series_data.push({
      //     name : customers_graph_series_name,
      //     data : customers_series_data
      //   });
      // }

      var enquiries_series_data = [];
      if (data[3] != undefined)
      {
        var enquiries_graph  = data[3];
        enquiries_graph_series_name = data[3].series_name;
        enquiries_graph_data = data[3].data;
        jQuery.each(enquiries_graph_data, function(index,value) {
          var date = value[0];
          var date = date.split(',');
          var dateYear = date[0];
          var dateMonth = date[1];
          var dateDate = date[2];
          var utcdate = Date.UTC(dateYear,dateMonth,dateDate);
          var enquiry_count = value[1];
          enquiries_series_data.push([utcdate, enquiry_count]);
          // console.log(date);
          // console.log(lead_count);
        });
        series_data.push({
          name : enquiries_graph_series_name,
          data : enquiries_series_data
        });
      }

      if (series_data == [])
      {
        series_data.push({
          name : 'No Data',
          data : []
        })
      }

      Highcharts.setOptions({
        global: {
          useUTC: false
        }
      });
       Highcharts.chart('leads_line_chart', {
            chart: {
              type: 'spline'
            },
            title: {
              text: ''
            },
            subtitle: {
              text: ''
            },
            xAxis: {
              type: 'datetime',
              dateTimeLabelFormats: { // don't display the dummy year
                month: '%e. %b %Y',
                year: '%Y'
              },
              title: {
                text: 'Date'
              }
            },
            yAxis: {
              title: {
                text: data.Y_title
              },
              min: 0
            },
            tooltip: {
              headerFormat: '<b>{series.name}</b><br>',
              pointFormat: '{point.x:%e. %b %Y}: {point.y}'
            },
            credits: false,
            plotOptions: {
              spline: {
                marker: {
                  enabled: true
                }
              }
            },
            series: series_data,
            colors:["#d5305a","#0080db"],
          });

  
}
});
}

function helpdesk_summary_api(){
    var url = $("#base_url").val();
    var cmpny_id=$("#cmpny_id").val();
    var ann_start_date=$("#ann_searchQuery").val();
    var ann_end_date=$("#ann_searchQuery1").val();
     
    $.ajax({
            type: "POST",
            url: url+"/api/helpdesk_summary",
      data: {
                "cmpny_id": cmpny_id,
                "ann_start_date": ann_start_date,
                "ann_end_date": ann_end_date
            },
        }).done(function(data){
            var result=JSON.parse(data);
    Highcharts.chart('container-helpdesk-summary', {
      chart: {
        type: 'heatmap',
        //marginTop: 20,
        //marginBottom: 80,
        plotBorderWidth: 1,
		plotBorderColor:'rgba(0,0,0,0.05)'
      },
      title: {
        text: ''
      },
      credits: false,

      xAxis: {
        categories: result.query_type_names
      },

      yAxis: {
        categories: result.query_status_names,
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
        y: 0,
        symbolHeight: 280
      },

      tooltip: {
        formatter: function () {
          return '<b>' + this.series.xAxis.categories[this.point.x] + '</b> Query <br><b>' +
            this.point.value + '  <b>' + this.series.yAxis.categories[this.point.y] + '</b>';
        }
      },

      series: [{
        animation: true,
		name: 'Helpdesk',
        borderColor: 'rgba(0,0,0,0.05)',
        borderWidth: 1,
        data: result.value,
        dataLabels: {
          enabled: true,
          color: '#222'
        }
      }]

    });
                  
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              console.log('No response');
        });
   }

   function agentwise_helpdesk_summary_api(){
    var url = $("#base_url").val();
    var cmpny_id=$("#cmpny_id").val();
    var ann_start_date=$("#ann_searchQuery").val();
    var ann_end_date=$("#ann_searchQuery1").val();
     
    $.ajax({
            type: "POST",
            url: url+"/api/agentwise_helpdesk_summary",
      data: {
                "cmpny_id": cmpny_id,
                "ann_start_date": ann_start_date,
                "ann_end_date": ann_end_date
            },
        }).done(function(data){
            var result=JSON.parse(data);
    Highcharts.chart('container-agent-helpdesk-summary', {
      chart: {
        type: 'heatmap',
        //marginTop: 20,
        //marginBottom: 80,
        plotBorderWidth: 1,
    plotBorderColor:'rgba(0,0,0,0.05)'
      },
      title: {
        text: ''
      },
      credits: false,

      xAxis: {
        categories: result.agent_names
      },

      yAxis: {
        categories: result.query_status_names,
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
        y: 0,
        symbolHeight: 280
      },

      tooltip: {
        formatter: function () {
          return '<b>' + this.series.xAxis.categories[this.point.x] + '</b> Query <br><b>' +
            this.point.value + '  <b>' + this.series.yAxis.categories[this.point.y] + '</b>';
        }
      },

      series: [{
        animation: true,
    name: 'Helpdesk',
        borderColor: 'rgba(0,0,0,0.05)',
        borderWidth: 1,
        data: result.value,
        dataLabels: {
          enabled: true,
          color: '#222'
        }
      }]

    });
                  
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              console.log('No response');
        });
   }

   function escalation_summary_api(){
    var url = $("#base_url").val();
    var cmpny_id=$("#cmpny_id").val();
    var ann_start_date=$("#ann_searchQuery").val();
    var ann_end_date=$("#ann_searchQuery1").val();
     
    $.ajax({
            type: "POST",
            url: url+"/api/escalation_summary",
      data: {
                "cmpny_id": cmpny_id,
                "ann_start_date": ann_start_date,
                "ann_end_date": ann_end_date
            },
        }).done(function(data){
            var result=JSON.parse(data);
    Highcharts.chart('container-escalation-summary', {
      chart: {
        type: 'heatmap',
        //marginTop: 40,
        //marginBottom: 80,
        plotBorderWidth: 1,
		plotBorderColor:'rgba(0,0,0,0.05)'
      },
      title: {
        text: ''
      },
      credits: false,

      xAxis: {
        categories: result.query_type_names
      },

      yAxis: {
        categories: result.query_status_names,
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
        y: 0,
        symbolHeight: 280
      },

      tooltip: {
        formatter: function () {
          return '<b>' + this.series.xAxis.categories[this.point.x] + '</b> Query <br><b>' +
            this.point.value + '  <b>' + this.series.yAxis.categories[this.point.y] + '</b>';
        }
      },

      series: [{
        animation: true,
		name: 'Helpdesk',
        borderColor: 'rgba(0,0,0,0.05)',
        borderWidth: 1,
        data: result.value,
        dataLabels: {
          enabled: true,
          color: '#222'
        }
      }]

    });
                  
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              console.log('No response');
        });
 }
 
    function reg_by_country_time(){
    var url = $("#base_url").val();
    var cmpny_id=$("#cmpny_id").val();
    var ann_start_date=$("#ann_searchQuery").val();
    var ann_end_date=$("#ann_searchQuery1").val();
     
    $.ajax({
            type: "POST",
            url: url+"/api/reg_by_country_time",
      data: {
                "cmpny_id": cmpny_id,
                "ann_start_date": ann_start_date,
                "ann_end_date": ann_end_date
            },
        }).done(function(data){
            var result=JSON.parse(data);
			
    Highcharts.chart('container-country-registration', {
      chart: {
        type: 'heatmap',
        //marginTop: 40,
        //marginBottom: 80,
        plotBorderWidth: 1,
		plotBorderColor:'rgba(0,0,0,0.05)'
      },
      title: {
        text: ''
      },
      credits: false,

      xAxis: {
        categories: ['00:00-01:00', '01:00-02:00', '02:00-03:00', '03:00-04:00', '04:00-05:00', '05:00-06:00', '06:00-07:00', '07:00-08:00', '08:00-09:00', '09:00-10:00', '10:00-11:00', '11:00-12:00', '12:00-13:00', '13:00-14:00', '14:00-15:00', '15:00-16:00', '16:00-17:00', '17:00-18:00', '18:00-19:00', '19:00-20:00', '20:00-21:00', '21:00-22:00', '22:00-23:00', '23:00-24:00']
      },

      yAxis: {
        categories: result.country_names,
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
        y: 0,
        symbolHeight: 280
      },

      tooltip: {
        formatter: function () {
          return '<b>' + this.series.xAxis.categories[this.point.x] + '</b> Query <br><b>' +
            this.point.value + '  <b>' + this.series.yAxis.categories[this.point.y] + '</b>';
        }
      },

      series: [{
        animation: true,
		name: 'Customer Registration',
        borderColor: 'rgba(0,0,0,0.05)',
        borderWidth: 1,
        data: result.time_wise_arr,
        dataLabels: {
          enabled: true,
          color: '#222'
        }
      }]

    });
                  
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              console.log('No response');
        });
 }

 function lead_source_week_api(){
    var url = $("#base_url").val();
    var cmpny_id=$("#cmpny_id").val();
    var ann_start_date=$("#ann_searchQuery").val();
    var ann_end_date=$("#ann_searchQuery1").val();
     
    $.ajax({
            type: "POST",
            url: url+"/api/lead_source_week",
      data: {
                "cmpny_id": cmpny_id,
                "ann_start_date": ann_start_date,
                "ann_end_date": ann_end_date
            },
        }).done(function(data){
            var result=JSON.parse(data);
    Highcharts.chart('container-lead-source-week', {
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
        categories: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
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
          return '<b>' + this.series.xAxis.categories[this.point.x] + '</b> Lead <br><b>' +
            this.point.value + '  <b>' + this.series.yAxis.categories[this.point.y] + '</b>';
        }
      },

      series: [{
        animation: true,
        name: 'Leads',
        borderColor: '#fff',
              borderWidth: 0.5,
        data: result.value,
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

   function daily_followup_api()
   {
    var url = $("#base_url").val();
    var cmpny_id=$("#cmpny_id").val();
    var user_id = $('#user_id').val();

    $.ajax({
            type: "POST",
            url: url+"/api/daily_followup",
      data: {
                "cmpny_id": cmpny_id,
                "user_id": user_id
            },
        }).done(function(data){
            var result=JSON.parse(data);
            if (result.length)
            {
              $.each(result, function(key,value) {
                console.log(value);
                $('#daily-followup-table').append('<tr><td><h6>'+ value.first_name + ' ' + value.last_name + '</h6></td><td><span>' + value.mobile +'</span></td><td width="40"><a href="profile/'+ value.mobile +'/0/0/0/0/' + value.id + '"class="btn btn-success"><i class="fa fa-phone" aria-hidden="true"></i></a></td></tr>');
              });
            }
            else
            {
              $('#daily-followup-table').html('<tr><td><center><h6>No Data Found</h6></center></td></tr>');
            }
            // $('#daily-followup-table').append('<tr></tr>');
                  
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              console.log('No response');
        });

   }
function todays_performance_api()
   {
    var url = $("#base_url").val();
    var cmpny_id=$("#cmpny_id").val();
    var user_id = $('#user_id').val();

    $.ajax({
            type: "POST",
            url: url+"/api/todays_performance",
      data: {
                "cmpny_id": cmpny_id,
                "user_id": user_id
            },
        }).done(function(data){
            var result=JSON.parse(data);
            // $('#current-month-performance #contacted').html(result.contact_c);
            $('#todays-performance #valid').html(result.valid_customers_count);
            $('#todays-performance #success').html(result.total_success_count);
            $('#todays-performance #call_later').html(result.call_later_count);
            $('#todays-performance #wrong_number').html(result.wrong_number_count);
            $('#todays-performance #no_response').html(result.no_response_count);
            $('#todays-performance #distant_location').html(result.distant_location_count);
            $('#todays-performance #dnd').html(result.dnd_response_count);
            $('#todays-performance #vehicles_sold').html(result.vehicles_sold_count);
            $('#todays-performance #miscellaneous').html(result.miscellaneous_count);
            $('#todays-performance #interested').html(result.interested_count);
            $('#todays-performance #notinterested').html(result.notinterested_count);
            return false;
                  
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              console.log('No response');
        });

   }
   function agent_performance_api()
   {
    var url = $("#base_url").val();
    var cmpny_id=$("#cmpny_id").val();
    var user_id = $('#user_id').val();

    $.ajax({
            type: "POST",
            url: url+"/api/agent_performance",
      data: {
                "cmpny_id": cmpny_id,
                "user_id": user_id
            },
        }).done(function(data){
            var result=JSON.parse(data);
		     	
			
   var tr = $("<tr />")
  $.each(result.agent_name, function(key, value) {
      tr.append(
         $("<td />", {
           html: value
          })[0].outerHTML
       );
     });
   $('#agent-performance > tbody:last-child').append(tr);

  var tr1 = $("<tr />")
  $.each(result.valid_customers_count, function(key, value) {
     tr1.append(
         $("<td />", {
           html: value
          })[0].outerHTML
       );
   });
   $('#agent-performance > tbody:last-child').append(tr1)
   
  var tr2 = $("<tr />")
  $.each(result.total_success_count, function(key, value) {
      tr2.append(
         $("<td />", {
           html: value
          })[0].outerHTML
       );
     });
   $('#agent-performance > tbody:last-child').append(tr2)
  
 var tr10 = $("<tr />")
  $.each(result.total_interested_count, function(key, value) {
      tr10.append(
         $("<td />", {
           html: value
          })[0].outerHTML
       );
     });
   $('#agent-performance > tbody:last-child').append(tr10)
   
 var tr11 = $("<tr />")
  $.each(result.total_notinterested_count, function(key, value) {
      tr11.append(
         $("<td />", {
           html: value
          })[0].outerHTML
       );
     });
   $('#agent-performance > tbody:last-child').append(tr11)
      
  var tr3 = $("<tr />")
  $.each(result.call_later_count, function(key, value) {
     tr3.append(
         $("<td />", {
           html: value
          })[0].outerHTML
       );
    });
   $('#agent-performance > tbody:last-child').append(tr3)
   
  var tr5 = $("<tr />")
  $.each(result.no_response_count, function(key, value) {
      tr5.append(
         $("<td />", {
           html: value
          })[0].outerHTML
       );
    });
   $('#agent-performance > tbody:last-child').append(tr5) 
            // $('#current-month-performance #contacted').html(result.contact_c);
            //$('#agent-performance #agent_name').html(result.agent_name);
           // $('#agent-performance #valid_agent').html(result.valid_customers_count);
           // $('#agent-performance #success_agent').html(result.total_success_count);
           // $('#agent-performance #call_later_agent').html(result.call_later_count);
           // $('#agent-performance #wrong_number_agent').html(result.wrong_number_count);
           // $('#agent-performance #no_response_agent').html(result.no_response_count);
           // $('#agent-performance #distant_location_agent').html(result.distant_location_count);
           // $('#agent-performancee #dnd_agent').html(result.dnd_response_count);
           // $('#agent-performance #vehicles_sold_agent').html(result.vehicles_sold_count);
           // $('#agent-performance #miscellaneous_agent').html(result.miscellaneous_count);
            return false;
                  
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              console.log('No response');
        });

   }
 
   function lead_source_conversion_api(){
    var url = $("#base_url").val();
    var cmpny_id=$("#cmpny_id").val();
    var ann_start_date=$("#ann_searchQuery").val();
    var ann_end_date=$("#ann_searchQuery1").val();
     
    $.ajax({
            type: "POST",
            url: url+"/api/lead_source_conversion",
      data: {
                "cmpny_id": cmpny_id,
                "ann_start_date": ann_start_date,
                "ann_end_date": ann_end_date
            },
        }).done(function(data){
            var result=JSON.parse(data);
    Highcharts.chart('container-lead-source-conversion', {
      chart: {
        type: 'heatmap',
        //marginTop: 20,
        //marginBottom: 80,
        plotBorderWidth: 1,
    plotBorderColor:'rgba(0,0,0,0.05)'
      },
      title: {
        text: ''
      },
      credits: false,

      xAxis: {
        categories: result.lead_source_names
      },

      yAxis: {
        categories: result.profile_status_names,
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
        y: 0,
        symbolHeight: 280
      },

      tooltip: false,

      series: [{
        animation: true,
    name: 'Helpdesk',
        borderColor: 'rgba(0,0,0,0.05)',
        borderWidth: 1,
        data: result.value,
        dataLabels: {
          enabled: true,
          color: '#222'
        }
      }]

    });
                  
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              console.log('No response');
        });
   }

feedback_rating_api();
trending_queryies_api();
if ($('div#container-survey').length)
{
  survey_api();
}
if ($('div.ticket-followup').length)
{
  fetchQueryTypeGraphData();
}
if ($('div#container-query-category-week').length)
{
  category_queries_week_api();
}
if ($('div#fbcontainer').length)
{
  feedback_statistics();
}
if ($('div#leads_line_chart').length)
{
  leads_line_chart();
}
if ($('div#container-helpdesk-summary').length)
{
  helpdesk_summary_api();
}
if ($('div#container-agent-helpdesk-summary').length)
{
  agentwise_helpdesk_summary_api();
}
if ($('div#container-escalation-summary').length)
{
  escalation_summary_api();
}
if ($('div#container-country-registration').length)
{
  reg_by_country_time();
}
if ($('div#container-lead-source-week').length)
{
  lead_source_week_api();
}
if ($('div#daily-followup-table').length)
{
  daily_followup_api();
}
if ($('div#container-lead-source-conversion').length)
{
  lead_source_conversion_api();
}
if ($('table#todays-performance').length)
{
  todays_performance_api();
}
if ($('table#agent-performance').length)
{
  
  agent_performance_api();
}

