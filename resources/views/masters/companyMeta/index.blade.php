@extends('layouts.listpage')

@section('content')

<div class="widget">
	<form action="{{url('/search_company_meta')}}" method="POST" class="listing form-common" name="form-common">
		<h2>Companymeta...<span id="totalcount"></span></h2>
		<a href="{{url('settings')}}" type="button" class="floating-btn btn-back"></a>
		<div class="search_box">
			<input type="hidden" name="_token"  value="{{ csrf_token() }}">
			<div class="col-sm-3 form-group">
				<input type="text" class="form-control" placeholder="Keyword" id="search_keywords" name="search_keywords" >
			</div>
			<div class="col-sm-1 form-group">
				<input type="hidden" name="pageno" id="pageno" value="1">
				<button type="submit " class="btn btn-primary" id="">Find </button>
			</div>
			<div class="col-sm-1 form-group">
			<button  class="btn btn-danger" id="s2" onclick="ressetListForm(this);">Reset </button>
			</div>
			<div class="clearfix"></div>
		</div>
	</form>
    <div class="panel-body no_data" id="no_data"></div>
    <div id="list"></div>
</div>

@endsection 
