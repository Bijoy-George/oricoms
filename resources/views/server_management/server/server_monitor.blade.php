@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Project
@endsection

@section('content')
  <form action="/server_qamonitoring" class="listing form-common" name="form-common" method="POST">
@csrf
  <div class="message"></div>
    <div class="row align-items-center justify-content-center">
       
<div class="col-sm-4 form-group">
  <div class="row"> 
    
    </div>   
  </div>
    </div>
       
        <div>
   <label for="status" class="control-label mb-1">{{__('Select Server Stage')}}</label>
            {{ Form::select('status', ['' => 'Select Stage'] + config('constant.server_stages'),null,['id' => 'status', 'class' => 'form-control']) }} 
                  <button  type="submit" class="btn btn-primary px-4">Monitoring</button>

             
<div id="list"></div>
      </div>        

   
</form>
@endsection
