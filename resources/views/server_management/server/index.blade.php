@extends('layouts.listpage')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Project
@endsection
@section('content')
 <form action="{{url('/search_server')}}" method="POST" class="listing form-common" name="form-common">
<aside class="sidebar">
  <!-- <div class="search-box">
	  <div class="row align-items-center justify-content-center"> -->
       <!--  <input type="hidden" name="_token"  value="{{ csrf_token() }}">
        <div class="col-sm-1"><h2 class="m-0">Search</h2></div> -->
<!-- <div class="col-sm-2 form-group"> -->
        <input type="hidden" class="form-control" placeholder="Keyword" id="search_keywords" name="search_keywords">
       <!--  </div> -->
		<!-- <div class="col-sm-1 form-group"> -->
		<input type="hidden" name="pageno" id="pageno" value="1">
		<!-- <button type="submit " class="btn btn-primary btn-block" id="">{{__('Find ')}}</button> -->
        <!-- </div> -->
        <!-- <div class="col-sm-1 form-group"> -->
        <!-- <button  class="btn btn-outline-danger btn-block" id="s2" onclick="ressetListForm(this);">{{__('Reset ')}}</button> -->
    <!-- </div>
    </div> -->
</aside>
<div class="message"></div>
<div class="content-area">
	<header class="row align-items-center">
    <div class="col-sm-5">
      <h2 class="m-0">{{__('Servers')}} <span id="totalcount"></span></h2>
      <small>Available Servers</small>
    </div>
    <div class="col-sm-7 text-right">
	   <a href="{{route('server.create')}}" class="btn btn-success ml-2"><img src="{{ asset('img/ic_add.svg') }}"  alt=""/> Add New Server</a>
     <a href="{{url('/server_qamonitoring')}}" class="btn btn-success ml-2"><img src="{{ asset('img/ic_search.svg') }}"  alt=""/> Monitoring</a>
      <a title="File Export" href="#" class="btn btn-outline-info ml-1"  onclick="exportserverreport();"><i class="fas fa-file-import"></i></a>	  
    </div>

  </header>
    <div class="panel-body no_data" id="no_data"></div>
    <div id="list"></div>
</div>
</div>
</form>
@endsection
@section('footer-custom-css-js')
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
       url:  url +'/server_details1',
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
