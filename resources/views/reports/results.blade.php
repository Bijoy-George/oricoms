<div class="row">
  <div class="col-md-10">
    <div class="widget">
      <div id="container"></div>
    </div>
  </div>
  <div class="col-md-2">
    <h5>Feedback Rating</h5>
    <h6>Agent Name: <span id="agent_name"></span></h6>
    <h6>Date: <span id="selected_date"></span></h6>
    <div class="table-widget table-responsive">
      <table width="100%" id="" class="table">
        <tr>
          <td><b>Excellent</b></td>
          <td id="excellent_rtng">0</td>
        </tr>
        <tr>
          <td><b>Good</b></td>
          <td id="good_rtng">0</td>
        </tr>
        <tr>
          <td><b>Average</b></td>
          <td id="average_rtng">0</td>
        </tr>
        <tr>
          <td><b>Bad</b></td>
          <td id="bad_rtng">0</td>
        </tr>
        <tr>
          <td><b>Very Bad</b></td>
          <td id="verybad_rtng">0</td>
        </tr>
      </table>
    </div>
  </div>
</div>
<script>
Highcharts.chart('container', {

  chart: {
    type: 'heatmap',
    marginTop: 40,
    marginBottom: 80,
    plotBorderWidth: 1
  },


  title: {
    text: ''
  },

  xAxis: {
    categories: ['<?php echo $range; ?>']
  },

  yAxis: {
    categories: ['<?php echo $agents; ?>'],
    title: null
  },

  colorAxis: {
    min: 0,
    minColor: '#FFFFFF',
    maxColor: Highcharts.getOptions().colors[0]
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
      fetch_feedback_rating(this.series.xAxis.categories[this.point.x],this.series.yAxis.categories[this.point.y]);
      return '<b>' + this.series.xAxis.categories[this.point.x] + '</b> <br><b>' +
        this.point.value + '</b> chats for <br><b>' + this.series.yAxis.categories[this.point.y] + '</b>';
        
    }
  },
  credits: false,
  series: [{
    name: 'Chat Report per employee',
    borderWidth: 1,
    data: [<?php echo $count_arr; ?>],
    dataLabels: {
      enabled: true,
      color: '#000000'
    },
    events: {
      click: function(event) {
      }
    }
  }]

});

function fetch_feedback_rating(xvalue,yvalue)
{
  $.ajax({
            type: "post",
            url: "/fetch_feedback_rating",
            data: {
              "date": xvalue,
              "agentname": yvalue,
            },
        }).done(function(data)
        {
          var response = parse_JSON(data);
          if(response.success==true)
          {
            $("#agent_name").html(response.agent_name);
            $("#selected_date").html(response.list_result.date);
            if(response.list_result.excellent===null)
            {
              $("#excellent_rtng").html(0);
            }
            else
            {
              $("#excellent_rtng").html(response.list_result.excellent);
            }

            if(response.list_result.good===null)
            {
              $("#good_rtng").html(0);
            }
            else
            {
              $("#good_rtng").html(response.list_result.good);
            }

            if(response.list_result.average===null)
            {
              $("#average_rtng").html(0);
            }
            else
            {
              $("#average_rtng").html(response.list_result.average);
            }
            
            if(response.list_result.bad===null)
            {
              $("#bad_rtng").html(0);
            }
            else
            {
              $("#bad_rtng").html(response.list_result.bad);
            }

            if(response.list_result.very_bad===null)
            {
              $("#verybad_rtng").html(0);
            }
            else
            {
              $("#verybad_rtng").html(response.list_result.very_bad);
            }
          }
          else
          {
            $("#agent_name").html(response.agent_name);
            $("#selected_date").html(response.selected_date);
            $("#excellent_rtng").html(0);
            $("#good_rtng").html(0);
            $("#average_rtng").html(0);
            $("#bad_rtng").html(0);
            $("#verybad_rtng").html(0);
          }
          
        }).fail(function(jqXHR, ajaxOptions, thrownError)
        {
          console.log('No response');
        });
}
</script>