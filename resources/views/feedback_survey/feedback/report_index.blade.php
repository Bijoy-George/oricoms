@extends('layouts.listpage')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Feedback
@endsection
@section('content')

 <form action="{{url('/report_feedbacklist')}}" method="POST" class="listing form-common" name="form-common">
<aside class="sidebar">
  <div class="search-box">
   
	  <div class="row align-items-center justify-content-center">
        <input type="hidden" name="_token"  value="{{ csrf_token() }}">
		<input type="hidden" name="fb_report_const" id="fb_report_const"  value="{{ config('constant.BP_FB_REPORT') }}">
        <input type="hidden" name="cmpny_id" id="cmpny_id"  value="{{ Auth::user()->cmpny_id }}">
        <input type="hidden" name="created_by" id="created_by"  value="{{ Auth::user()->id }}">
        <div class="col-sm-1"><h2 class="m-0">Search</h2></div>
<div class="col-sm-3 form-group">
        {{ Form::select('search_keywords', $channels, null, ['id' => 'search_keywords', 'class' => 'form-control fb_type_cls']) }}
        </div>
		<div class="col-sm-3 form-group">
       {{ Form::select('agent_id', $agents, null, ['id' => 'agent_id', 'class' => 'form-control']) }}
        </div>
		<div class="col-sm-3 form-group">
        @php $rating_arr = config('constant.FB_RATING'); @endphp
      <select class="form-control" id="rating_id" name="rating_id" >
       <option value="0">Select Rating</option>
       @foreach($rating_arr  as $r_key => $rat)
       <option value="{{$r_key}}">{{$rat}}</option>
       @endforeach        
      </select> 
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
<div class="content-area">
	<header class="row align-items-center">
    <div class="col-sm-5">
      <h2 class="m-0">{{__('Report')}} </h2>
      <small></small>
    </div>
    <div class="col-sm-7 text-right"><a href="{{url('settings')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}" alt=""></a>
      <a href="#" onclick="export_fb_report()"  class="btn btn-outline-info ml-1"><i class="material-icons">import_export</i> Export</a> 
    </div>
  </header>

	<div class="panel-body no_data" id="alert_msg"></div> 
    <div class="panel-body no_data" id="no_data"></div>
    <div id="list"></div>
</div>
</div>
</form>


{{--<div class="widget">
<div class="col-sm-12 text-right"><a href="{{url('settings')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a>
</div>
  <h2>Report</h2>
    <a href="{{url('settings')}}" type="button" class="floating-btn btn-back"></a>
    
    <div class="search_box">
    <form name="form-common" action="{{url('/report_feedbacklist')}}" method="post" class="listing form-common">
      <input type="hidden" name="_token"  value="{{ csrf_token() }}">
      <input type="hidden" name="fb_report_const" id="fb_report_const"  value="{{ config('constant.BP_FB_REPORT') }}">
      <input type="hidden" name="cmpny_id" id="cmpny_id"  value="{{ Auth::user()->cmpny_id }}">
      <input type="hidden" name="created_by" id="created_by"  value="{{ Auth::user()->id }}">
      <div class="col-sm-3 form-group">
        
        {{ Form::select('search_keywords', $channels, null, ['id' => 'search_keywords', 'class' => 'form-control fb_type_cls']) }}
      </div>
      <div class="col-sm-3 form-group">
        
        {{ Form::select('agent_id', $agents, null, ['id' => 'agent_id', 'class' => 'form-control']) }}
      </div>
      <div class="col-sm-3 col form-group">
      @php $rating_arr = config('constant.FB_RATING'); @endphp
      <select class="form-control" id="rating_id" name="rating_id" >
       <option value="0">Select Rating</option>
       @foreach($rating_arr  as $r_key => $rat)
       <option value="{{$r_key}}">{{$rat}}</option>
       @endforeach        
      </select>   
                           
      </div>
      <div class="col-sm-1 form-group">
        <input type="hidden" name="pageno" id="pageno" value="1">
        <button type="submit " class="btn btn-primary btn-full" id="">Find </button>
      <!--  <button type="submit " class="btn btn-danger btn-full" id="s2" onclick="resetForm();">Reset </button>-->
      </div>
      <div class="col-sm-1 form-group">
        <button  class="btn btn-danger" id="s2" onclick="ressetListForm(this);">Reset </button>
        
      </div>

      <div class="clearfix"></div>
    </form>
    </div>
    <div class="panel-body no_data" id="alert_msg"></div> 
    <div class="panel-body no_data" id="no_data"></div>
    <div id="list"></div>
</div>--}}
<!--  popup -->
<div class="modal fade" id="feedback_details" role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Feedback Details</h4>
        </div>
        <div class="modal-body" >
            <div  id="follo_popup">
          
            </div>
        </div>
        <div class="modal-footer">
        <div id="msg_err" style=""></div>
       
         
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
  </div>
</div>

@endsection 
