@extends('layouts.listpage')

@section('content')
<aside class="sidebar">
  <div class="search-box">
    <form action="{{url('/search_chat_history')}}" method="POST" class="listing form-common" name="form-common">
      <div class="row align-items-center">
        <input type="hidden" name="_token"  value="{{ csrf_token() }}">
        <input type="hidden" name="customer_id" id="customer_id" value="{{$customerid}}">
        <div class="col-sm-1 text-center text-sm-left">
          <h2 class="m-0">Search</h2>
        </div>
        <div class="col-sm-1 mb-2 mb-sm-0">
          <input type="text" class="form-control" placeholder="Message" id="search_keywords" name="search_keywords" >
        </div>
        <div class="col-sm-2 mb-2 mb-sm-0">
          <select name="lead_src_list" id="lead_src_list" class="form-control">
            <option value="0">Select Source</option>
            
					@foreach($chat_src_list as $source)
					
            <option value="{{$source->id}}">{{$source->name}}</option>
            
					@endforeach
				
          </select>
        </div>
        <div class="col-sm-2 mb-2 mb-sm-0">
          <select name="agent_list" id="agent_list" class="form-control">
            <option value="0">Select Agent</option>
            	
					@foreach($agent_list as $agent)
					
            <option value="{{$agent->id}}">{{$agent->name}}</option>
            
					@endforeach
				
          </select>
        </div>
        <div class="col-sm-2 mb-2 mb-sm-0">
          <input type="text" class="date_picker form-control" placeholder="Chat Start Date" id="start_date" name="start_date" autocomplete="off"/>
        </div>
        <div class="col-sm-2 mb-2 mb-sm-0">
          <input type="text"  class="date_picker form-control" placeholder="Chat End Date" id="end_date" name="end_date" autocomplete="off"/>
        </div>
        <div class="col-sm-2 mb-2 mb-sm-0">
          <input type="hidden" name="pageno" id="pageno" value="1">
          <button type="submit " class="btn btn-primary" id="">Find</button>
          <button  class="btn btn-danger" id="s2" onclick="ressetListForm(this);">Reset</button>
          <button  class="btn btn-success" id="export" onclick="exportChatHistoryList(this);">Export</button>
        </div>
      </div>
    </form>
  </div>
</aside>
<div class="content-area pt-0">
  <div class="panel-body no_data" id="no_data"></div>
  <div id="alert_msg"></div>
  <div id="list"></div>
</div>
@endsection