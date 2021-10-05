 @if(count($default_field) > 0 && count($tab_det) >0 )
 @php $i=1; @endphp
<nav>
<div id="auto_stage_desc" class="stage_link" style="text-align:center;"></div>
  <div class="nav nav-tabs" id="nav-tab" role="tablist"> @foreach($tab_det as $tabs)
    @php $tab_name=str_replace(' ', '_', strtolower($tabs->name)); @endphp <a class="nav-item nav-link @if($i==1){{'active'}}@endif" id="nav-profile-tab" data-toggle="tab" href="#{{$tab_name}}" role="tab" aria-controls="basic-prof" aria-selected="true">{{$tabs->name}}</a> @php $i++; @endphp
    @endforeach </div>
</nav>
<form class="form-profile" id="form-profile" method="post" action="{{ url('save_profile') }}" autocomplete="off">
  <input type="hidden" name="_token" class="_token" value="{{ csrf_token() }}">
  <input type="hidden" name="pid" id="pid"  value="{{ $user_details->id ?? '' }}">
  <input type="hidden" name="flag" id="flag"  value="0">
  <input type="hidden" name="show_cus_details" id="show_cus_details"  value="{{$show_cus_details}}">
  <input type="hidden" id="country_code" name="country_code" value="">
  <div class="tab-content mb-3" id="nav-tabContent"> 
    <?php if($show_cus_details){ ?>

    @php $j=1; @endphp
    @foreach($tab_det as $tabs)
    @php $tab_name=str_replace(' ', '_', strtolower($tabs->name)); @endphp
    <div class="tab-pane fade box-shadow @if($j==1){{'show active'}}@endif" id="{{$tab_name}}" role="tabpanel" aria-labelledby="nav-profile-tab"> @if($tabs->type == 2)
      <div class="row row-eq-height"> @php 
        $tid=$tabs->id;
        if(isset($tab_arr[$tid]) && !empty($tab_arr[$tid])){
        $tab_count=$tab_arr[$tid];
        }else{
        $tab_count=1;
        }
        @endphp
        @for($k=1;$k<=$tab_count;$k++)
        @foreach($tabs['profile_fields'] as $d_field)
        @php  $field_name=$d_field->field_name.$k; @endphp
        @php $cus_value='';
        if($user_details){
        foreach($user_details['profile_details'] as $result){
        if($result->field_name==$field_name){
        $cus_value=$result->value;
        } 
        }
        }
        @endphp
        <div class="col-sm-6 form-group">
          <label for="{{ $d_field['field_name'] ?? '' }}">{{ $d_field->label ?? '' }} @if($d_field->required == 1) <span class="red_star">*</span>@endif </label>
          <input type="text" @if($d_field['GetFieldType']['min_length']) minlength="{{$d_field['GetFieldType']['min_length']}}" @endif @if($d_field['GetFieldType']['max_length']) maxlength="{{$d_field['GetFieldType']['max_length']}}" @endif class="form-control" id="{{ $d_field['field_name'] ?? '' }}{{$k}}" name="{{ $d_field['field_name'] ?? '' }}{{$k}}" value="{{$cus_value ?? '' }}" @if($d_field['GetFieldType']['expression'])  pattern="{{$d_field['GetFieldType']['expression']}}" @endif />
        </div>
        @endforeach
        
        @endfor
	
        <input type="hidden" name="{{$tab_name}}" id="{{$tab_name}}" class="{{$tab_name}} form-control" value="{{$k}}">
        <div id="add_more{{$tab_name}}" class="add_more{{$tab_name}} col-sm-12 form-group"> </div>
      </div>
      <div class="text-right">
        <input type="button" class="btn btn-sm px-4 btn-success" onclick="add_more_btn({{$tabs->id}},'{{$tab_name}}')" value="Add more" />
        <button type="reset" class="btn btn-sm px-4 btn-outline-danger" >{{__('Reset')}}</button>
        <button type="submit" class="btn btn-sm px-4 btn-primary"> {{__('Save')}} </button>
      </div>
      @else
<div class="row row-eq-height">
@if(Auth::user()->cmpny_id == 32)
<div class="col-sm-6 form-group">
<label for="title" class="control-label">{{{__('Call from')}}}<span class="red_star">*</span></label>
				<select name="query_type_f" class="get_query_catt form-control" id="query_type_f">
					<option value="">Select</option> 
         			 @foreach ($query_types as $query_type)             
      				<option data-short-code="{{$query_type->short_code}}" data-type="{{$query_type->type}}" value="{{$query_type->id}}">{{$query_type->query_type}}</option>
		     		@endforeach 
       			 </select> 				
				<span class="error" id="query_type_err"></span></div>
<div class="col-sm-6 form-group pen_no" style="display:none;">
					<label for="pen_no" class="control-label">{{__('Pen No')}}<span class="red_star" id="pen_man" style= "display:none;">*</span></label>
					{{ Form::text('pen_no', null, array('id' => 'pen_nor','class' => 'form-control','autocomplete'=>'off')) }}
					<span class="error" id="pen_no_err"></span>
				</div>

@endif
</div>

      <div class="row row-eq-height"> @foreach($tabs['profile_fields'] as $d_field)
        @php  $field_name=$d_field['field_name']; @endphp
        @php $cus_value='';
              if($user_details){
              foreach($user_details['profile_details'] as $result){
              if($result->field_name==$field_name){
              $cus_value=$result->value;
              } 
              }
              }
        @endphp

        @if($d_field['field_type'] == 1 || $d_field['field_type'] == 4 || $d_field['field_type'] == 13 || $d_field['field_type'] == 14 || $d_field['field_type'] == 15)
              <div  class="col-sm-6 form-group">
              <label for="{{ $d_field['field_name'] ?? '' }}">{{ $d_field->label ?? '' }} @if($d_field->required == 1) <span class="red_star">*</span>@endif </label>
              
              <input  type="text" @if($d_field['GetFieldType']['min_length']) minlength="{{$d_field['GetFieldType']['min_length']}}" @endif @if($d_field['GetFieldType']['max_length']) maxlength="{{$d_field['GetFieldType']['max_length']}}" @endif  class="form-control" id="{{ $d_field['field_name'] ?? '' }}" name="{{ $d_field['field_name'] ?? '' }}" value="@if($d_field['type'] == 2){{ $cus_value ?? '' }}@else{{ $user_details->$field_name ?? '' }}@endif" @if($d_field['GetFieldType']['expression']) pattern="{{$d_field['GetFieldType']['expression']}}" @endif/>
            </div>
        @endif
        @if($d_field['field_type'] == 8)
            <div class="col-sm-6 form-group">
              <label for="{{ $d_field['field_name'] ?? '' }}">{{ $d_field->label ?? '' }} @if($d_field->required == 1) <span class="red_star">*</span>@endif </label>
              <textarea class="form-control" id="{{$d_field['field_name'] ?? '' }}" name="{{$d_field['field_name'] ?? '' }}">@if($d_field['type'] == 2){{$cus_value ?? ''}}@else{{$user_details->$field_name ?? ''}}@endif</textarea>
            </div>
        @endif
        @if($d_field['field_type'] == 5)
        @php
        if(!empty($user_details->$field_name)){
         $date_val=$user_details->$field_name;
        }else{
          $date_val='';
        }
        @endphp
            <div class="col-sm-6 form-group">
              <label for="{{ $d_field['field_name'] ?? '' }}">{{ $d_field->label ?? '' }} @if($d_field->required == 1) <span class="red_star">*</span>@endif </label>
              <input type="text" class="form-control date_picker" id="{{ $d_field['field_name'] ?? '' }}" name="{{ $d_field['field_name'] ?? '' }}" value="@if($d_field['type'] == 2) {{ !empty($cus_value) ? date('d/m/Y', strtotime($cus_value)) : '' }}@else{{ $date_val ?? date('d/m/Y', strtotime($date_val)) ?? '' }}@endif"/>
            </div>
        @endif
        @if($d_field['field_type'] == 2)
            <div class="col-sm-6 form-group">
              <label for="{{ $d_field['field_name'] ?? '' }}">{{ $d_field->label ?? '' }} @if($d_field->required == 1) <span class="red_star">*</span>@endif </label>
              <select name="{{ $d_field['field_name'] ?? '' }}" id="{{ $d_field['field_name'] ?? '' }}" class="form-control {{$d_field['field_name']??''}}">
                <option value="">Select</option>
                @foreach($d_field['GetOptions'] as $op)
                <option class="{{$op->class ??''}}" value="{{$op->id}}" @if($d_field->type == 2) @if($cus_value ==$op->id ) {{'selected'}}@endif @else @if($user_details->$field_name  == $op->id) {{'selected'}} @endif @endif >{{$op->options}}</option>
                @endforeach
              </select>
            </div>
        @endif
        @if($d_field['field_type'] == 10)
            <div class="col-sm-6 form-group">
              <label for="{{ $d_field['field_name'] ?? '' }}">{{ $d_field->label ?? '' }} @if($d_field->required == 1) <span class="red_star">*</span>@endif </label><br>
              
                @foreach($d_field['GetOptions'] as $op)
                <input class="custom-radio d-none" id="rad_{{$op->id}}_{{$op->options}}"   name="{{ $d_field['field_name'] ?? '' }}" type="radio" value="{{$op->id}}" @if($d_field->type == 2) @if($cus_value ==$op->id ) {{'checked'}}@endif @else @if($user_details->$field_name  == $op->id) {{'checked'}} @endif @endif>
                <label for="rad_{{$op->id}}_{{$op->options}}" class="control-label custom-checkbox-label">{{$op->options}}</label>
                @endforeach
              
            </div>
        @endif
        @if($d_field['field_type'] == 9)
            <div class="col-sm-6 form-group">
              <label for="{{ $d_field['field_name'] ?? '' }}">{{ $d_field->label ?? '' }} @if($d_field->required == 1) <span class="red_star">*</span>@endif </label><br>
                @php

                $unser=unserialize($cus_value);

                
                @endphp
                @foreach($d_field['GetOptions'] as $op)
                                 
                <input class="custom-checkbox d-none" id="ch_{{$op->id}}_{{$op->options}}" name="{{ $d_field['field_name'] ?? '' }}[]" type="checkbox" value="{{$op->id}}"  @if($d_field->type == 2) @if(!empty($cus_value) && in_array($op->id, $unser)) {{'checked'}}@endif @else @if($user_details->$field_name  == $op->id) {{'checked'}} @endif @endif >

                 <label for="ch_{{$op->id}}_{{$op->options}}" class="control-label custom-checkbox-label">{{$op->options}}</label>   
                
                @endforeach
              
            </div>
        @endif
        @if($d_field['field_type'] == 6)
        <div class="col-sm-6 form-group">
          <label for="{{ $d_field['field_name'] ?? '' }}">{{ $d_field->label ?? '' }} @if($d_field->required == 1) <span class="red_star">*</span>@endif </label><br>
          <input class="form-control" type="datetime-local" id="{{ $d_field['field_name'] ?? '' }}" name="{{ $d_field['field_name'] ?? '' }}" value="{{$cus_value ?? '' }}">

        </div>
        @endif
        @if($d_field['field_type'] == 7)
        <div class="col-sm-6 form-group">
          <label for="{{ $d_field['field_name'] ?? '' }}">{{ $d_field->label ?? '' }} @if($d_field->required == 1) <span class="red_star">*</span>@endif </label><br>
          <input  class="form-control"  type="time" id="{{ $d_field['field_name'] ?? '' }}" name="{{$d_field['field_name']}}" value="{{$cus_value ?? '' }}">
         
        </div>

        @endif
         @if($d_field['field_type'] == 11)
        <div class="col-sm-6 form-group">
      <?php $cus_v = unserialize($cus_value); ?>
          <label for="{{ $d_field['field_name'] ?? '' }}">{{ $d_field->label ?? '' }} @if($d_field->required == 1) <span class="red_star">*</span>@endif </label><br>
             <select  style="height:auto !important" multiple  name="{{ $d_field['field_name'] ?? '' }}[]" id="{{ $d_field['field_name'] ?? '' }}" class="form-control">
                <option value="">Select</option>
                @foreach($d_field['GetOptions'] as $op)
                <option value="{{$op->id}}" @if($d_field->type == 2) 
                  @if(is_array($cus_v)) @if(in_array($op->id,$cus_v)) {{'selected'}}@endif @endif @else @if($user_details->$field_name  == $op->id) {{'selected'}} @endif @endif >{{$op->options}}</option>
                @endforeach
              </select>
        </div>
        @endif
        
         @if($d_field['field_type'] == 12)
        <div class="col-sm-6 form-group">
          <label for="{{ $d_field['field_name'] ?? '' }}">{{ $d_field->label ?? '' }} @if($d_field->required == 1) <span class="red_star">*</span>@endif </label><br>
         <input type="url" name="{{ $d_field['field_name'] ?? '' }}" id="{{ $d_field['field_name'] ?? '' }}" class="form-control" value="{{$cus_value ?? '' }}">

        </div>
        @endif


        @if($d_field['field_type'] == 3)
        @if($d_field['field_name']!='mobile')
        <div class="col-sm-6 form-group">
         <label>{{$d_field->label}}@if($d_field->required == 1) <span class="red_star">*</span>@endif </label>
        @if( Helpers::checkPermission('outbound call'))
                      @if(!empty($user_details->mobile) && !empty($user_details->country_code) && $user_details->country_code !='+')
                       <a href="{{config('constant.callcenter_url')}}/callmeout.php?number={{$user_details->country_code.$user_details->mobile}}&extension={{ Auth::user()->extension }}&callerid={{ Helpers::get_company_meta('outbound_caller_id') }}" target="_blank"><i class="fa fa-phone" aria-hidden="true"></i></a>
                      @elseif(!empty($user_details->mobile)){{ $user_details->mobile }} @elseif(@isset($search_val) &&!empty($search_val))
                      <a href="{{config('constant.callcenter_url')}}/callmeout.php?number={{ $search_val }}&extension={{ Auth::user()->extension }}&callerid={{ Helpers::get_company_meta('outbound_caller_id') }}" target="_blank"><i class="fa fa-phone" aria-hidden="true"></i></a>
                      @endif
                  @endif
                  <input type="tel" id="{{ $d_field['field_name'] ?? '' }}" class="mobile" @if($d_field['GetFieldType']['min_length']) minlength="{{$d_field['GetFieldType']['min_length']}}" @endif @if($d_field['GetFieldType']['max_length']) maxlength="{{$d_field['GetFieldType']['max_length']}}" @endif  placeholder="Primary Mobile Number" name="{{ $d_field['field_name'] ?? '' }}" class="form-control"  value="@if(!empty($user_details->mobile) && !empty($user_details->country_code) && $user_details->country_code !='+'){{ $user_details->country_code.$user_details->mobile }} @elseif(!empty($user_details->mobile)){{ $user_details->mobile }} @elseif(@isset($search_val) &&!empty($search_val)){{ $search_val }} @endif" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                 
                     
              
                      
       </div>
          @endif

        @endif
       
        @if($d_field['field_name'] == 'mobile')
      
           <div class="col-sm-6 form-group">
                <label for="{{ $d_field['field_name'] ?? '' }}">{{ $d_field->label ?? '' }} @if($d_field->required == 1) <span class="red_star">*</span>@endif </label>
                  @if( Helpers::checkPermission('outbound call'))
                      @if(!empty($user_details->mobile) && $user_details->country_code !='+')
                       <a href="{{config('constant.callcenter_url')}}/callmeout.php?number={{$user_details->country_code.$user_details->mobile}}&extension={{ Auth::user()->extension }}&callerid={{ Helpers::get_company_meta('outbound_caller_id') }}" target="_blank"><i class="fa fa-phone" aria-hidden="true"></i></a>
                      @elseif(!empty($user_details->mobile)){{ $user_details->mobile }} @elseif(@isset($search_val) &&!empty($search_val))
                      <a href="{{config('constant.callcenter_url')}}/callmeout.php?number={{ $search_val }}&extension={{ Auth::user()->extension }}&callerid={{ Helpers::get_company_meta('outbound_caller_id') }}" target="_blank"><i class="fa fa-phone" aria-hidden="true"></i></a>
                      @endif
                  @endif
                  
                <input type="tel" id="mobile" @if($d_field['GetFieldType']['min_length']) minlength="{{$d_field['GetFieldType']['min_length']}}" @endif @if($d_field['GetFieldType']['max_length']) maxlength="{{$d_field['GetFieldType']['max_length']}}" @endif  placeholder="Primary Mobile Number" name="mobile" class="form-control"  value="@if(!empty($user_details->mobile) && !empty($user_details->country_code) && $user_details->country_code !='+'){{ $user_details->country_code.$user_details->mobile }} @elseif(!empty($user_details->mobile)){{ $user_details->mobile }} @elseif(@isset($search_val) &&!empty($search_val)){{ $search_val }} @endif" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>


              </div>
        @elseif($d_field['field_name'] == 'customer_nature')
          <div class="col-sm-6 form-group">
            <label for="{{ $d_field['field_name'] ?? '' }}">{{ $d_field->label ?? '' }} @if($d_field->required == 1) <span class="red_star">*</span>@endif </label>
            <select name="customer_nature" class="form-control">
              <option value="">Select</option>
                @foreach ($cus_nature as $nature)
                  <option value="{{ $nature->id }}" @if(isset($user_details->customer_nature) && $user_details->customer_nature  == $nature->id) {{'selected'}} @endif >{{ $nature->customer_nature }}</option>
              
                @endforeach
             </select>
          </div>
        @elseif($d_field['field_name'] == 'source')
          <div class="col-sm-6 form-group">
            <label for="{{ $d_field['field_name'] ?? '' }}">{{ $d_field->label ?? '' }} @if($d_field->required == 1) <span class="red_star">*</span>@endif </label>
            <select name="{{ $d_field['field_name'] ?? '' }}" id="{{ $d_field['field_name'] ?? '' }}" class="form-control">
              <option value="">Select</option>
              
                @foreach ($sources_arr as $s_arr)
                
              <option value="{{ $s_arr->id }}" @if(isset($user_details->$field_name) && $user_details->$field_name  == $s_arr->id) {{'selected'}} @endif >{{ $s_arr->name }}</option>
              
                @endforeach
                
                
            </select>
          </div>
        @elseif($d_field['field_name'] == 'profile_status')
          <div class="col-sm-6 form-group">
            <label for="{{ $d_field['field_name'] ?? '' }}">{{ $d_field->label ?? '' }} @if($d_field->required == 1) <span class="red_star">*</span>@endif </label>
            <select name="{{ $d_field['field_name'] ?? '' }}" id="{{ $d_field['field_name'] ?? '' }}" class="form-control">
              <?php $profile_status = config('constant.profile_status'); ?>
			  @foreach ($profile_status as $key =>$type)
				@if(isset($pro_status) && !empty($pro_status))
				<option value="{{$key}}"{{  $pro_status == $key ? 'selected="selected"' : '' }} >{{$type}}</option>
				@else
				<option value="{{$key}}"@if(!empty($user_details->profile_status)){{  $user_details->profile_status == $key ? 'selected="selected"' : '' }} @endif  >{{$type}}</option>
			@endif
			  @endforeach    
			  <!--<option value="">Select</option>
              <option value="{{config('constant.LEAD')}}" @if(isset($user_details->profile_status) && $user_details->profile_status  == config('constant.LEAD')) {{'selected'}} @endif >Lead</option>
              <option value="{{config('constant.CUSTOMER')}}" @if(isset($user_details->profile_status) && $user_details->profile_status  == config('constant.CUSTOMER')) {{'selected'}} @endif >Customer</option>
           --> </select>
          </div>
        @elseif($d_field['field_name'] == 'dnd')
          <div class="col-sm-6 form-group">
            <label for="{{ $d_field['field_name'] ?? '' }}">{{ $d_field->label ?? '' }} @if($d_field->required == 1) <span class="red_star">*</span>@endif </label>
            <select name="{{ $d_field['field_name'] ?? '' }}" id="{{ $d_field['field_name'] ?? '' }}" class="form-control">
              <option value="">Select</option>
              <option value="1" @if(isset($user_details->dnd) && $user_details->dnd  == 1) {{'selected'}} @endif >Yes</option>
              <option value="0" @if(isset($user_details->dnd) && $user_details->dnd  == 0) {{'selected'}} @endif >No</option>
            </select>
          </div>  
          @elseif($d_field['field_name'] == 'hide_details')
          <div class="col-sm-6 form-group">
            <label for="{{ $d_field['field_name'] ?? '' }}">{{ $d_field->label ?? ''}}@if($d_field->required == 1) <span class="red_star">*</span>@endif </label>
            <select name="{{ $d_field['field_name'] ?? '' }}" id="{{ $d_field['field_name'] ?? '' }}" class="form-control">
              <option value="0" @if(isset($user_details->hide_details) && $user_details->hide_details  == 0) {{'selected'}} @endif >No</option>
              <option value="1" @if(isset($user_details->hide_details) && $user_details->hide_details  == 1) {{'selected'}} @endif >Yes</option>
            </select>
          </div>

        @elseif($d_field['field_name'] == 'country_id')
        @php $is_other_country = FALSE; @endphp
          <div class="col-sm-6 form-group">
              <label for="{{ $d_field['field_name'] ?? '' }}">{{ $d_field->label ?? '' }} @if($d_field->required == 1) <span class="red_star">*</span>@endif </label>
              <select name="{{ $d_field['field_name'] ?? '' }}"  class="form-control {{ $d_field['field_name'] ?? '' }}" >
                <option value="">Select </option>
                @foreach ($country_arr as $con)
                <option value="{{ $con->id }}" data-other="{{$con->is_other}}" @if(isset($user_details->$field_name) && $user_details->$field_name  == $con->id)
                  @if($con->is_other == 1)
                  @php $is_other_country = TRUE; @endphp
                  @endif
                  {{'selected'}} @elseif (Helpers::get_company_meta('default_country') == $con->id)
                  @if($con->is_other == 1)
                  @php $is_other_country = TRUE; @endphp
                  @endif
                  {{'selected'}} @endif >{{ $con->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-sm-6 form-group other_country" @if(!$is_other_country) style="display: none;" @endif >
              <label for="other_country">Other Country </label>
              <input type="text" class="form-control" name="other_country" id="other_country" value="@if(isset($user_details->other_country)) {{$user_details->other_country}} @endif">
            </div>
        @elseif($d_field['field_name'] == 'state_id')
            <div class="col-sm-6 form-group">
              <label for="{{ $d_field['field_name'] ?? '' }}">{{ $d_field->label ?? '' }} @if($d_field->required == 1) <span class="red_star">*</span>@endif </label>
              <select name="{{ $d_field['field_name'] ?? '' }}" class="form-control {{ $d_field['field_name'] ?? '' }}" >
              </select>
            </div>
        @elseif($d_field['field_name'] == 'district_id')
            <div class="col-sm-6 form-group">
              <label for="{{ $d_field['field_name'] ?? '' }}">{{ $d_field->label ?? '' }} @if($d_field->required == 1) <span class="red_star">*</span>@endif </label>
              <select name="{{ $d_field['field_name'] ?? '' }}" class="form-control  setEnquiryDistrict {{ $d_field['field_name'] ?? '' }} @if(Helpers::get_company_meta('officer_detail_show') == 1) {{'officer_details'}} @endif"  >
              </select>
            </div>
        @elseif($d_field['field_name'] == 'local_body_type')
            <div class="col-sm-6 form-group">
              <label for="{{ $d_field['field_name'] ?? '' }}">{{ $d_field->label ?? '' }} @if($d_field->required == 1) <span class="red_star">*</span>@endif </label>
              <select name="{{ $d_field['field_name'] ?? '' }}"  class="form-control {{ $d_field['field_name'] ?? '' }}" >
                <option value="">Select </option>
                @foreach ($localbodytype_arr as $localbody)
                <option value="{{ $localbody->id }}" @if(isset($user_details->$field_name) && $user_details->$field_name  == $localbody->id) {{'selected'}} @endif >{{ $localbody->type }}</option>
                @endforeach
              </select>
            </div>
        @elseif($d_field['field_name'] == 'corporation_id')
            <div id="" style="display: none" class="col-sm-6 form-group corporation_div">
              <label for="{{ $d_field['field_name'] ?? '' }}">{{ $d_field->label ?? '' }} @if($d_field->required == 1) <span class="red_star">*</span>@endif </label>
              <select name="{{ $d_field['field_name'] ?? '' }}" class="form-control {{ $d_field['field_name'] ?? '' }}" >
              </select>
            </div>
        @elseif($d_field['field_name'] == 'muncipality_id')
            <div   style="display: none" class="col-sm-6 form-group muncipality_div">
              <label for="{{ $d_field['field_name'] ?? '' }}">{{ $d_field->label ?? '' }} @if($d_field->required == 1) <span class="red_star">*</span>@endif </label>
              <select name="{{ $d_field['field_name'] ?? '' }}" class="form-control {{ $d_field['field_name'] ?? '' }}" >
              </select>
            </div>
        @elseif($d_field['field_name'] == 'panchayath_type')
            <div  style="display: none" class="col-sm-6 form-group pan_type_div" >
              <label for="{{ $d_field['field_name'] ?? '' }}">{{ $d_field->label ?? '' }} @if($d_field->required == 1) <span class="red_star">*</span>@endif </label>
              <select name="{{ $d_field['field_name'] ?? '' }}" class="form-control {{ $d_field['field_name'] ?? '' }}" >
              </select>
            </div>
        @elseif($d_field['field_name'] == 'district_panchayath_id')
            <div  style="display: none" class="col-sm-6 form-group dis_pan_div" >
              <label for="{{ $d_field['field_name'] ?? '' }}">{{ $d_field->label ?? '' }} @if($d_field->required == 1) <span class="red_star">*</span>@endif </label>
              <select name="{{ $d_field['field_name'] ?? '' }}" class="form-control {{ $d_field['field_name'] ?? '' }}" >
              </select>
            </div>
        @elseif($d_field['field_name'] == 'block_panchayath_id')
            <div   style="display: none" class="col-sm-6 form-group blk_pan_div" >
              <label for="{{ $d_field['field_name'] ?? '' }}">{{ $d_field->label ?? '' }} @if($d_field->required == 1) <span class="red_star">*</span>@endif </label>
              <select name="{{ $d_field['field_name'] ?? '' }}"  class="form-control {{ $d_field['field_name'] ?? '' }}" >
              </select>
            </div>
        @elseif($d_field['field_name'] == 'grama_panchayath_id')
            <div style="display: none" class="col-sm-6 form-group gra_pan_div" >
              <label for="{{ $d_field['field_name'] ?? '' }}">{{ $d_field->label ?? '' }} @if($d_field->required == 1) <span class="red_star">*</span>@endif </label>
              <select name="{{ $d_field['field_name'] ?? '' }}" class="form-control {{ $d_field['field_name'] ?? '' }}" >
              </select>
            </div>
        @elseif($d_field['field_name'] == 'panchayath_id')
            <div style="display: none" class="col-sm-6 form-group pan_div" >
              <label for="{{ $d_field['field_name'] ?? '' }}">{{ $d_field->label ?? '' }} @if($d_field->required == 1) <span class="red_star">*</span>@endif </label>
              <select name="{{ $d_field['field_name'] ?? '' }}"  class="form-control {{ $d_field['field_name'] ?? '' }}">
              </select>
            </div>
        @elseif($d_field['field_name'] == 'taluk_id')
            <div class="col-sm-6 form-group">
              <label for="{{ $d_field['field_name'] ?? '' }}">{{ $d_field->label ?? '' }} @if($d_field->required == 1) <span class="red_star">*</span>@endif </label>
              <select name="{{ $d_field['field_name'] ?? '' }}"  class="form-control {{ $d_field['field_name'] ?? '' }}" >
              </select>
            </div>
        @elseif($d_field['field_name'] == 'village_id')
            <div class="col-sm-6 form-group">
              <label for="{{ $d_field['field_name'] ?? '' }}">{{ $d_field->label ?? '' }} @if($d_field->required == 1) <span class="red_star">*</span>@endif </label>
              <select name="{{ $d_field['field_name'] ?? '' }}"  class="form-control {{ $d_field['field_name'] ?? '' }}" >
              </select>
            </div>
        @else
        
        @endif
        @endforeach

         @if($tabs->type == 3 && !empty($attchment_fields))
        <div class="advancedUpload_profile_attachment">Attachments</div>
        <input type="hidden" value="" name="attachments" id="attach_attachments">
       
            @if(isset($user_details['GetProfileAttachment']) && count($user_details['GetProfileAttachment']) > 0)
             <p>Selected Attachments</p>
                  @foreach($user_details['GetProfileAttachment'] as $attach)

                  <a href="{{ url('download_fbreport/'.$attach->attachment_file_name.'/attachments') }}">{{$attach->attachment_original_name}}</a>
                  <br>

                  @endforeach
                @endif
           


        @endif
        @if(Helpers::checkPermission('profile create'))
        <div class="col-md-12 text-right">
          <button type="reset" class="btn btn-outline-danger btn-sm px-4" >{{__('Reset')}}</button>
           <button type="button" class="btn btn-sm px-4 btn-primary" id="submit_tab3" onclick="upload_profile_pic()"> {{__('Save')}} </button>
        </div>
        @endif </div>
      @endif </div>
    @php $j++; @endphp
    @endforeach 

  <?php } else{ ?>
    <div class="tab-content mb-3">
        <div class="tab-pane fade box-shadow show active">
        <p>The customer details have been hidden</p>
        </div>
      </div>

  <?php }?>

  </div>
</form>
<script type="text/javascript">
  $('.country_id').trigger('change');


    var vars = {};
  var successFiles1  = [];
var errorFiles1    = [];
 var uploadObj_attachment = $(".advancedUpload_profile_attachment").uploadFile({
  url:"/mail_attachment_upload",
  multiple:true,
  autoSubmit:false,
  fileName:"file",
  allowedTypes:"jpg,png,jpeg,pdf",
  maxFileSize:1024*1024*2,
  maxFileCount:5,
  returnType:'json',
  multiple:true,
  dragDrop:true,
  showStatusAfterSuccess:true,
  showDelete:false,
  showDone:false,
  dynamicFormData: function ()
  {
      var data = {type:2}
      return data;
  },
  onSelect:function(files) {
  
    setTimeout(function() {
      $("div.ajax-file-upload-error").remove();
    }, 5000);
  },
  onSuccess:function(files,data,xhr)
  {
   console.log(111)
    successFiles1.push({
      originalName: data.original_name,
      mimeType: data.mime_type,
      savedName: data.saved_name
    });

     attachments = JSON.stringify(successFiles1);

     //$("#attachments").val(attachments);
     console.log(attachments)
     $("#attach_attachments").val(attachments);
      setTimeout(function() {
      $(".ajax-file-upload-statusbar").remove();
    }, 1000);
     $(".form-profile").submit();
    return;

    
  },
  onError: function(files, status, errMsg, pd)
  {
   
    errorFiles1.push(files[0]);
    return;
  },
  afterUploadAll: function(obj)
  {
   
    setTimeout(function() {
      $(".ajax-file-upload-statusbar").has(".ajax-file-upload-error").remove();
    }, 5000);
    if (errorFiles1.length !== 0)
    {
      console.log('Failure123');
    }
    else {

      console.log('Success123');
      var callbackFunc  = $("#callbackFunc").val();
      if (callbackFunc !== '' && typeof callbackFunc != "undefined")
      {
        window[callbackFunc](2);
      }
    }
   
    }

});
</script> 
@endif 
<style type="text/css">
  .hide_item{ display: none; }
  .hide_details .form-group{ display:none; }
</style>
<script>
  $(document).ready(function() {


    if($("#community").val() != ''){
       $("#community > option").each(function() {
          if($(this).val() != $("#community").val()) {
                $(this).addClass('hide_item');
          }
     
      });
    }
   




    $('#shg_membership_holder_nam').parent().hide();
      $('#shg_relationship_with_stu').parent().hide();

     var con_val = $('input[type="radio"]:checked').val(); 
     // console.log(Value);
     if(con_val =="15")
     {
      $('#shg_membership_holder_nam').parent().show();
      $('#shg_relationship_with_stu').parent().show();
     }
     @if (!isset($user_details) || empty($user_details))
      getState.call($('.form-profile .country_id'), {{ Helpers::get_company_meta('default_country') }}, {{ Helpers::get_company_meta('default_state') }});
      getDistrict.call($('.form-profile .state_id'), {{ Helpers::get_company_meta('default_state') }});
     @endif
  });


  $('input[type="radio"]').change(function(){
   
    if($(this).val()=="15") {
      $('#shg_membership_holder_nam').parent().show();
      $('#shg_relationship_with_stu').parent().show();
    }
    else {
      $('#shg_membership_holder_nam').parent().hide();
      $('#shg_relationship_with_stu').parent().hide();
    }
  });


  $('#form-profile #religion').on('change', function() {
    var this_val = $(this).val();
    $("#community").val('');
    var com_val=($('select[name="religion"] :selected').attr('class'));
      $("#community > option").each(function() {
          if(this_val == ''){ 
              $(this).addClass('hide_item');
          }
          else if($(this).val() !='') { 
              if ( !$( this ).hasClass(com_val) && com_val!=null) {
                $(this).addClass('hide_item');
              }
              else {
                $(this).removeClass('hide_item');
              }
          }     
      });
  });
  
        /// CODE TO SHOW AUTO PROCESS STATUS STARTS
		$(document).ready(function(){ load_doctors();
        var token = '{{csrf_token()}}';
        var id = $('#profile_id').val();
        var cmpny_id = $('#cmpny_id').val();
		var stageurl = "{{url('customer_stage_history')}}/"+id+"/"+cmpny_id;
        $.ajax({
            type: "POST",
            url: "{{ url('/get_auto_process_status') }}",
            data: {
                "_token": token,
                "id": id,
                "cmpny_id": cmpny_id,
            },
            success: function(msg) {
                var msg = $.trim(msg);
                if(msg != ''){
                  $('#auto_stage_desc').html('<a href="'+stageurl+'" target="_blank" class="alert-link"  data-placement="top" title="Stage History">' + msg +  '</a>');
                }
            }
        });
		});
        /// CODE TO SHOW AUTO PROCESS STATUS ENDS
		
		function load_doctors()
{
	 var url = $("#base_url").val();
	console.log("load_doc");
	$.ajax({
        url: url+"/get_doctors_list",
        type: "POST",
        data: { 
        },
        dataType: "json",
    }).done(function(data){//alert("success");
	//$('#doctor_detail').append("<option value=''>Select Doctor</option>");
        if (data != 0) {        
           // $('.doctor_detail').empty();
            $('#doctor_detail').append("<option value=''>Select Doctor</option>");
            $.each(data, function(i, d) { //console.log(d.specialization);
               // var opt = $('<option />');
               //  var opt = "<option value='" + d.mobile + "'>" + d.name + "("+d.specialization+") </option>";
                $('.doctor_detail').append("<option value='" + d.mobile + "'>" + d.name + "("+d.specialization+") </option>");
            });
        } else {
            $('.doctor_detail').empty();
            $('.doctor_detail').append("<option value=''>Select Doctor</option>");
        }
    }).fail(function(jqXHR, ajaxOptions, thrownError){
          console.log('No response from get_sub_category section');
    });
}

$(document).on('change', '.doctor_detail', function(){ 
    var url = $("#base_url").val();
    var doc_number = $(this).val();
	$('.call_redirect_doctor').empty();
	$('.call_redirect_doctor').remove();
	$.ajax({
        url: url+"/get_call_url_doctor",
        type: "POST",
        data: { 
            "doc_number":doc_number,
        },
        dataType: "json",
    }).done(function(results){//alert("f");
		console.log(results);
		$('.doctor_detail').parent().append('<div class="call_redirect_doctor"></div>');
		$('.call_redirect_doctor').append('<label>Call Number</label><br><a href="'+results.url+'/callmeout.php?number='+results.number+'&extension='+results.extension+'&callerid='+results.callerid+'" target="_blank"><i class="fa fa-phone" aria-hidden="true"></i>'+results.number+'</a>');
    }).fail(function(jqXHR, ajaxOptions, thrownError){
         // alert('No response from district section');
    });
    
});
$(document).on('change', '.get_callfrom', function(){
    var con = "#"+$(this).closest("form").attr('id')+" ";
    var url = $("#base_url").val();
    var issue = $(this).val();
  
    $.ajax({
        url: url+"/enquiry/create",
        type: "POST",
        data: { 
            "issue":issue
        },
        dataType: "json",
    }).done(function(data){
        if (data != 0) {        
            var x = 1;
            
        } else {
            var x = 2;
            
        }
    }).fail(function(jqXHR, ajaxOptions, thrownError){
          console.log('No response from show enquiry form section');
    });
});
$(document).on('change', '.get_query_catt', function(){
    
    var url = $("#base_url").val();
    var query_typeon = $(this).val();
   if(query_typeon == 85){
    $('.pen_no').css('display', 'block');
    $('#pen_man').css('display', 'inline-block');
    $('#insti_man').css('display', 'inline-block');	
   }
   else if (query_typeon == 86) {
    $('.pen_no').css('display', 'block');
    $('#pen_man').css('display', 'inline-block');
    $('#insti_man').css('display', 'inline-block');
   }
  else if (query_typeon == 88) {
    $('#insti_man').css('display', 'inline-block');
   }
   else{
    $('.pen_no').css('display', 'none');
    $('#pen_man').css('display', 'none');
    $('#insti_man').css('display', 'none');
   }
var query_type = $(this).find(':selected').data('type');
    if(query_type == 1){
        $(".escalate_box").show();
    }else{
        $(".escalate_box").hide();
    }
$.ajax({
		url: url+"/get_call_from",
		type: "POST",
		data: { 
			"issue":query_typeon
		},
		dataType: "json",
	}).done(function(data){
		if (data != 0) { 
		
			$('.get_query_cat').empty();
						$.each(data, function(i, d) { 
				var opt = $('<option />');
						opt = "<option value='" + d.id + "'>" + d.query_type + " </option>";
				$('.get_query_cat').append(opt);
			});
                        		} else {
			$('.get_query_cat').empty();
			$('.get_query_cat').append("<option value=''>Select Nature of call</option>");
		}
	}).fail(function(jqXHR, ajaxOptions, thrownError){
		  console.log('No response from show enquiry form section');
	});
});
$(document).on('change', '.get_query_catt', function(){
    
    var url = $("#base_url").val();
    var query_typeon = $(this).val();

 $.ajax({
        url: url+"/get_query_status",
        type: "POST",
        data: { 
            "query_type":query_typeon
        },
        dataType: "json",
    }).done(function(data){
        if (data != 0) {        
            $('.query_status').empty();
            $('.query_status').append("<option value=''>Select Status</option>");
            $.each(data, function(i, d) { 
                var opt = $('<option />');
                        opt = "<option value='" + d.id + "'>" + d.name + " </option>";
                $('.query_status').append(opt);
            });
        } else {
            $('.query_status').empty();
            $('.query_status').append("<option value=''>Select Status</option>");
        }
    }).fail(function(jqXHR, ajaxOptions, thrownError){
          console.log('No response from show enquiry form section');
    });
});
$(document).on('change', '.get_query_catt', function(){
    
    var url = $("#base_url").val();
    var query_typeon = $(this).val();
	
 $.ajax({
        url: url+"/get_category",
        type: "POST",
        data: { 
            "query_type":query_typeon
        },
        dataType: "json",
    }).done(function(data){
        if (data != 0) {        
            $('.faq_cat_id').empty();
                        $('.faq_cat_id').append("<option value=''>Select Designation</option>");

            $.each(data, function(i, d) { 
                var opt = $('<option />');
                                    opt = "<option data-short-code='"+d.short_code+"' data-other='"+d.is_other+"' value='" + d.id + "'>" + d.category_name + " </option>";
                
                $('.faq_cat_id').append(opt);
            });
        } else {
            $('.faq_cat_id').empty();
        }
    }).fail(function(jqXHR, ajaxOptions, thrownError){
          console.log('No response from show enquiry form section');
    });
 });

$(document).on('change', '.pen_no', function(){
    
    var url = $("#base_url").val();
    var pen_number = $(pen_nor).val();
	document.getElementById('pen_norr').value=pen_number;
	    	 $.ajax({
        url: url+"/curl_test",
        type: "POST",
        data: { 
            "pen_number":pen_number
        },
        dataType: "json",

	
    }).done(function(data){
        if (data != 0) {  
	console.log(data);      
            $('#first_name').empty();
                         $('#first_name').val(data.users.firstName);
	    $('#last_name').empty();
			$('#last_name').val(data.users.lastName);
	    $('#email').empty();
			$('#email').val(data.users.email);
	    $('#district_ide').empty();
			var opt = $('<option />');
                                    opt = "<option  value='" + data.did + "'>" + data.dname + " </option>";
                
                $('#district_ide').append(opt);
	$('#institution').empty();
			var opt = $('<option />');
                                    opt = "<option  value='" + data.test_id + "'>" + data.users.hospitalName+ " </option>";
                
                $('#institution').append(opt);

	                   } else {
            $('#first_name').empty();
		$('#institution').empty();
		$('#district_ide').empty();
		$('#last_name').empty();
		$('#email').empty();
        }
    }).fail(function(jqXHR, ajaxOptions, thrownError){
          console.log('No response from show enquiry form section');
    });
 });
</script>