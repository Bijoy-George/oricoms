@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Profile Fields
@endsection
@section('content')
<div class="content-area">
  <div class="row justify-content-center">
  	<div class="col-sm-12 text-right"><a href="{{url('settings')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a><form name="form-common" action="{{url('/profile_custom_list')}}" method="post" class="listing form-common">
			      <input type="hidden" name="_token"  value="{{ csrf_token() }}">
			     </form></div>
                 <div id="list" class="row m-0"></div>
  </div>
</div>

<div class="modal fade" id="field_details" role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Field Details</h4>
        </div>
        
        <div class="modal-body" >
            <div  id="field_popup">
          
            </div>
        </div>
        
      </div>
  </div>
</div>
@endsection