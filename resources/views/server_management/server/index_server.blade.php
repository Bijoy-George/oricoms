@extends('layouts.listpage')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Project
@endsection
@section('content')
 <form action="/server_details_list" method="POST" class="listing form-common" name="form-common">
<aside class="sidebar">
  <div class="search-box">
	  <div class="row align-items-center justify-content-center">
        <input type="hidden" name="_token"  value="{{ csrf_token() }}">
        <div class="col-sm-1"><h2 class="m-0">Search</h2></div>
<div class="col-sm-4 form-group">
  <div class="row"> 

        <div class="col-sm mb-2 ">
    {{ Form::text('startdate', null, array('id' => 'startdate','class' => 'date_picker form-control','placeholder' => 'Start date','autocomplete' => 'off')) }}
        <!--<input name="startdate" id="startdate"  type="text" placeholder="Start date" class="date_picker form-control" autocomplete="off">-->
      </div>
      <div class="col-sm mb-2 ">
    {{ Form::text('enddate', null, array('id' => 'enddate','class' => 'date_picker form-control','placeholder' => 'End date','autocomplete' => 'off')) }}
       <!-- <input name="enddate" id="enddate"  type="text" placeholder="End date" class="date_picker form-control" autocomplete="off">-->
      </div>
        <input type="hidden" id="server_id" name="server_id" value="{{$id}}">
    </div>    
  </div>
		<div class="col-sm-2 form-group">
		<input type="hidden" name="pageno" id="pageno" value="1">
		<button type="submit " class="btn btn-primary btn-block" id="">{{__('Find ')}}</button>
        </div>
        <div class="col-sm-2 form-group">
        <button  class="btn btn-outline-danger btn-block" id="s2" onclick="ressetListForm(this);">{{__('Reset ')}}</button>
    </div>
    </div>
</aside>
<div class="content-area">
	<header class="row align-items-center">
    
  </header>
    <div class="panel-body no_data" id="no_data"></div>
    <div id="list"></div>
</div>
</div>
</form>
@endsection
<!-- @section('footer-custom-css-js')
<script type="text/javascript" src="https://www.google.com/jsapi"></script> 
<script src="{{ asset('js/tiny_mce/tiny_mce.js') }}"></script> 
<script src="{{ asset('js/tinymce.js') }}"></script> 

<script src="{{ asset('js/translation.js') }}"></script> 
<script type="text/javascript">
  function server_detailss(id)
  {
    // alert(id);
    var url = $("#base_url").val();
    var server_id = $("#server_id").val();
    
    $.ajax({
       type: "POST",
       url:  url +'/server_details_list',
       data: {
         "id": id,
         // "server_id": server_id,
       },    
        success: function (data) {
            var response = JSON.parse(data);
            $("#service_name_wrapper").empty().html(response.services1);
            $("#server_id_wrapp").empty().val(response.server_id);
            $("#service_id_wrapp").empty().val(response.service_id);
            $("#service_details_wrapper").show();
        }
    });
  }
</script>
@endsection
 -->