<div class="widget" >
    <h2 class="m-0"><?php echo $data['graph_title'].' of '.$batch_details->title;?></h2>
    <div class="widget-content" id="batch-detail-graph" style="height: 300px;"></div>
</div>

<div class="widget report-widget">
        <h2 class="m-0"><i class="fas fa-file-excel"></i> Batch Follow-up Report</span></h2>
        <div class="widget-content p-3"><a href="javascript:void(0)" onclick="exportManualCallBatchReport({{$batch_id}},'xlsx')" id="xlsx" class="btn btn-primary">Download Excel xlsx</a> <a href="javascript:void(0)" onclick="exportManualCallBatchReport({{$batch_id}},'csv')" id="csv" class="btn btn-primary">Download CSV</a></div>
</div>

<!-- <script src="{{ asset('js/highcharts.js') }}"></script>  -->
<script>
Highcharts.chart('batch-detail-graph', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: ''
    },
    credits: false,
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
			depth: 35,
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: 'Count',
        colorByPoint: true,
		innerSize: '70%',
        data: [<?php echo $data['graph'];?>]
    }]
});
</script>
