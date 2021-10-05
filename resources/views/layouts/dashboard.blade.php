@extends('layouts.app')
@section('header-custom-css-js')
<!-------- Chat Window CSS Start---------------->
<!-- require:dependencies -->
@php
    // Checking whether the logged in user is a chat agent or not. 
    // 1st parameter represents the role type that needs to be checked
    $is_chat_agent = Helpers::get_company_meta("chat_agent");

    $user_role_id = Auth::User()->role_id;
    $unserialize_user_roles = unserialize($user_role_id);
    foreach($unserialize_user_roles as $role)
    {
        if($role == $is_chat_agent)
        {
            $chat_enable_flag = 1;
        }
        else
        {
            $chat_enable_flag = 0;
        }
    }
    //$cmpny_plan_id = Helpers::get_cmpny_plan_id();
    if($chat_enable_flag == 1)
    {
@endphp
<link href="{{ asset('/jsxc/build/css/jsxc.css') }}" media="all" rel="stylesheet" type="text/css" />
<!--  endrequire -->
<link href="{{ asset('/jsxc/connect/css/liveChat.css') }}" media="all" rel="stylesheet" type="text/css" />
@php
    }
@endphp
<!-------- Chat Window CSS Stop---------------->

<script src="{{ asset('js/highcharts.js') }}"></script>
<script src="{{ asset('js/heatmap.js') }}"></script>
<script src="{{ asset('js/drilldown.js') }}"></script>

@endsection

@section('footer-custom-css-js')

<script>
$(function() {
    $( "#ann_searchQuery" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd/mm/yy',
        showMonthAfterYear: true,
        onSelect: function (selected) {
            var from = selected.split("/");
            var f = new Date(from[2], from[1] - 1, from[0]);
            var dt = new Date(f);
            dt.setDate(dt.getDate() + 1);
            $("#ann_searchQuery1").datepicker("option", "minDate", dt);
            drawGraph();
        },
        onChangeMonthYear: function (year, month, inst) {
            var selectedMonth = parseInt(inst.selectedMonth)+1;
            if(selectedMonth < 10)
            {
                var temp = "0"+selectedMonth;
            }
            else
            {
                var temp = selectedMonth;
            }
            if(inst.selectedDay < 10)
            {
                var temp1 = "0"+inst.selectedDay;
            }
            else
            {
                var temp1 = inst.selectedDay;
            }
			$("#ann_searchQuery").val(temp1+"/"+temp+"/"+inst.selectedYear);
        }
    });
    $( "#ann_searchQuery1" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd/mm/yy',
        showMonthAfterYear: true,
        onSelect: function (selected) {
        $("#ann_searchQuery1").val(this.value);
            var from = selected.split("/");
            var f = new Date(from[2], from[1] - 1, from[0]);
            var dt = new Date(f);
            dt.setDate(dt.getDate() - 1);
            $("#ann_searchQuery").datepicker( "option", "maxDate", dt);
            drawGraph();
        },
        onChangeMonthYear: function (year, month, inst) {
            var selectedMonth = parseInt(inst.selectedMonth)+1;
            if(selectedMonth < 10)
            {
                var temp = "0"+selectedMonth;
            }
            else
            {
                var temp = selectedMonth;
            }
            if(inst.selectedDay < 10)
            {
                var temp1 = "0"+inst.selectedDay;
            }
            else
            {
                var temp1 = inst.selectedDay;
            }
            $("#ann_searchQuery1").val(temp1+"/"+temp+"/"+inst.selectedYear);
        }
    });

});
function drawGraph() {
	showLoader();
	var ann_start_date  = $('#ann_searchQuery').val();
	var ann_end_date    = $('#ann_searchQuery1').val();
    
	$.ajaxSetup({
		header:$('meta[name="csrf-token"]').attr('content')
	});
	var ann_search_keywords;
	var token       =   '{{csrf_token()}}';
	ann_search_keywords =   $("#ann_search_keywords").val();
     
	$.ajax({
		type: "post",
		dataType: "html",
		url: "{{ url('/dashboardGraph') }}",
		data: {
			"_token": token,
			"ann_start_date": ann_start_date,
			"ann_end_date": ann_end_date,
		},
                
	}).done(function(data)
    {
            $("#graphcontainer").empty().html(data);
			hideLoader();
    })
    .fail(function(jqXHR, ajaxOptions, thrownError)
    {
        $("#graphcontainer").empty().html('No Record Found');
		hideLoader();
    });
}

function set_session() {
	
    var token       =   '{{csrf_token()}}';
	var url = $("#base_url").val();
	$.ajax({
            type: "post",
            url:  url+"/dismiss_pop_sbcr_exp",
            data: {
                   "_token": token
                },
        });
}
    
$(document).ready(function()
{
	drawGraph();
});
</script>

<!-------- Chat Window JS Start---------------->
@php
    if($chat_enable_flag == 1)
    {
@endphp
<!-- require:dependencies -->
<script src="{{ asset('/jsxc/build/lib/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('/jsxc/build/lib/jquery.fullscreen.js') }}"></script>
<!--<script src="{{ asset('/jsxc/build/lib/jsxc.dep.js') }}"></script>-->
<!--  endrequire -->
<!-- jsxc library -->
<!--<script src="{{ asset('/jsxc/build/jsxc.js') }}"></script>-->
@php
   $uuser_id=Auth::User()->id;
   $uemail=Auth::User()->email;
   $uusername=Auth::User()->username;
@endphp
<!-- init script -->
<!--<script src="{{ asset('/jsxc/connect/js/chatConnection.js') }}"></script>-->
<script>
     xmppConnection.initConnection({
        xmpp_connction_url : 'https://chat.oricoms.com:5280/http-bind',
        host:'localhost',
        resource:'my_chat',
        user_name:'<?php echo $uusername; ?>',
        password:'<?php echo $uusername; ?>',
        external_data_url:'https://support.orisys.in/api/push_customer_name'
     })
</script>
@php
    }
@endphp
<!-------- Chat Window JS Stop---------------->
@endsection