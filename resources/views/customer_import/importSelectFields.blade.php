@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - leads
@endsection
@section('content')

<div class="container">
    <div class="col-sm-2"></div>
  <div class=" col-sm-8">
    <div class="widget widget-padder">

      <h2>Import Leads</h2>
     
      <div class="widget-padder"> @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert"> {{ Session::get('success') }} </div>
        @endif
        
        @if ($message = Session::get('error'))
        <div class="alert alert-danger" role="alert"> {{ Session::get('error') }} </div>
        @endif
        <h5>Map fields from file:</h5>
        <form action="{{ URL::to('importExcelLeadtable') }}" method="post" enctype="multipart/form-data">
          <input type="hidden" value="{{$leadsource}}" name="leadsource"/>
            <input type="hidden" name="filename" value="{{$filename}}">
            @foreach($table_column as $key => $value)
                <div class="form-group col-lg-6">
                    <label for="{{$key}}" class="control-label">{{$value}}</label>
                    <select id="{{$key}}"  class="form-control" name="{{$key}}" >
                      <option value="">Select File Heading</option>
                      @foreach($headings as $key => $value)
                      @if($value!='')
                      <option value="{{$value}}">{{$value}}</option>
                      @endif
                      @endforeach
                    </select>

                </div>
            @endforeach
          {{ csrf_field() }}
          <div class="text-right">
            <button class="btn btn-primary">Import</button>
          </div>
        </form>
    </div>
  </div>
</div>
</div>

@endsection