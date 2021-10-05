@extends('layouts.listpage')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Followups
@endsection
@section('content')
<div class="content-area">
  <div class="message"></div>
    <div class="panel-body no_data" id="no_data"></div>
	<input type="hidden" id="customer_id" value="{{$id}}">
	<input type="hidden" id="cmpny_id" value="{{$cmpny_id}}">
    <div id="list"></div>
</div>
<script type="text/javascript">
$(document).ready(function(){ 
var token = '{{csrf_token()}}';
var customer_id = $('#customer_id').val();
var cmpny_id = $('#cmpny_id').val();
        $.ajax({
            type: "post",
            dataType: "html",
           url: "{{ url('/stage_history') }}",
     
            data: {
                  "_token": token,
                  "customer_id": customer_id,
                  "cmpny_id": cmpny_id,
                 },
            
        })
        .done(function(data)
        {
            console.log('data'+data); 
            $("#list").empty().html(data);
            
            location.hash = page;
        })
        .fail(function(jqXHR, ajaxOptions, thrownError)
        {
            $("#list").empty().html('No Record Found');
        });
		
});
</script>	
@endsection	