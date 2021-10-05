@extends('layouts.app')

@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Group
@endsection

@section('content')




<div class="content-area ">
    <header class="row align-items-center mb-2">
    <div class="col-sm-5 text-sm-left mb-3 mb-sm-0">
            <h2 class="m-0">Groups</h2>
          <small><a  href="{{ url('/groups') }}">Groups</a> /  Edit Group </small>
                </div>
       <div class="col-sm-7 text-sm-right">
          <a title="Go Back" href="javascript:history.go(-1)" class="btn btn-outline-info ml-1"><i class="fas fa-chevron-left"></i></a>
        </div>
</header>

<div class="widget">
  <div class="widget-heading">
    <div class="row">
      <div class="col-12 col-md-6">
        <h2> Edit Group </h2>
      </div>
    </div>
  </div>
  <div class="table-widget table-responsive mt-0 pt-0 p-3">
     {!! Form::model($group, ['method' => 'POST', 'class' => 'form-common editGroupForm', 'route' => ['groups.store']]) !!}
    <div class="row justify-content-center" style="border-bottom: 1px solid #eee;margin-bottom: 20px;padding-bottom: 20px;">
     <div class="col-md-4">
      <div class="message"></div>
      <div class="form-group">
        <label for="group_name">Group Name</label>
         {{ Form::hidden('id', null, ['id' => 'id']) }}
      {{ Form::text('name', null, array('class' => 'form-control','id' => 'name', 'required' => true)) }} 
      <span class="error" id="name_err"></span>
      <span class="input-success" id="grp_id1" style="display:none"><i class="fa fa-check" aria-hidden="true"></i></span>
      </div>
      
      </div>
      <div class="col-md-1 mt-2">
        <div class="form-group mt-4">
       <input type="submit" name="Save" class="btn btn-primary btn-block reset-pageno" value="Save"/>
      </div>
      </div>
    </div>
          {!! Form::close() !!}
        <div class="row">
          <div class="col-md-8 ">
          {!! Form::open(array('url' => '/groups/'.$group->id.'/contacts_search',  'id' => 'campaign-form', 'name' => 'form-common', 'class' => 'listing form-common', 'method'=>'POST')) !!}
            <div class="row">
              <div class="col-4">
                <input id="search_keywords" class="form-control input-rounded" placeholder="Search customers" name="search_keywords" type="search">
               </div>
               <div class="col-2">
                  <input class="btn btn-primary btn-block reset-pageno" type="submit" value="Search">
                </div>
                <div class="col-2">
                  <button class="btn btn-outline-danger btn-block reset-pageno" value="Reset" onclick="ressetListForm(this);" id="s2">Reset</button>
                </div>
               
            </div>
            {{ Form::hidden('pageno', '1', ['id' => 'pageno']) }}
            {!! Form::close() !!}
          </div>
    <div class="col-md-4 text-right"> 
      @if(Helpers::checkPermission('group lead import')) 
      <a title="Add customers to group" href="{{ url('/groups/'.$group->id.'/lead_import') }}" class="btn btn-success ml-2"><i class="fas fa-user-plus"></i> Add customers</a>
    @endif
      @if(Helpers::checkPermission('group excel import')) 
      <a title="Import Customers from Excel" href="{{ url('/groups/'.$group->id.'/excel_import') }}"  class="btn btn-outline-info ml-1"><i class="fas fa-file-import"></i> Import Excel</a>
      @endif
      @if(count($group->excel_batches))
      <button class="btn btn-primary" onClick="showImportedExcelList({{ $group->id }})">Show Imported Excel Files</button>
      @endif </div>
      </div>
    <div class="row">
      <div id="list" class="col-md-12"></div>
      <div class="col-md-12" id="imported-excel-list"></div>
    </div>
  </div>



</div>
</div>




@endsection

@section('footer-custom-css-js') 
<script src="{{ asset('js/groups/edit-group.js') }}"></script> 
@endsection