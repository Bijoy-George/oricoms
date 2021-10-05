@if($field_type)
@if($field_type && $field_type == config('constant.DEFAULT_FEILD') || $field_type && $field_type == config('constant.UPLOAD_FEILD'))
@php $action='update_default_fields'; @endphp
@elseif($field_type && $field_type == config('constant.CUSTOM_FIELD'))
@php $action='update_custom_fields'; @endphp
@endif
	<form name="form-common" action="{{url('/'.$action)}}" method="post" class="form-common">


	<div class="message"></div>
<div class="row">

				{{ Form::hidden('field_id',$field_id) }}
				{{ Form::hidden('id',$id) }}
	 			@php $status=config('constant.ACTIVE');
		         	  $status_inactive=config('constant.INACTIVE')
		          @endphp
				<label for="field_label" class="col-md-4 control-label">{{__('Field Label')}}</label>
				<div class="col-md-6 form-group">						
						<input type="text" name="field_label" class="form-control" id="field_label" value="@if(isset($fields->label)){{$fields->label}}@endif"	><br/>
						<span id ="field_label_err"></span>							
				</div>
				<label for="field_label" class="col-md-4 control-label">{{__('Select Profile Tab')}}</label>
				<div class="col-md-6 form-group">						
						<select name="tab_id" id="tab_id" class="form-control" onchange="check_report_fields(this.value)">
							<option value="">Select</option>
							@foreach($tab_det as $value)
							<option value="{{$value->id ?? '' }}" @if(isset($fields->tab_id) && $fields->tab_id == $value->id){{'selected'}}@endif>{{$value->name ?? '' }}</option>
							@endforeach
						</select><br/>
												
				</div> 
				<input type="hidden" name="field_type" class="form-control" value="{{$field_type}}" id="field_type">
				<label for="sort_order" class="col-md-4 control-label">{{__('Sort Order')}}</label>
				<div class="col-md-6 form-group">						
						<input type="text" name="sort_order" class="form-control" id="sort_order" value="@if(isset($fields->sort_order)){{$fields->sort_order}}@endif"	>
						<span id ="sort_order_err"></span>							
				</div>
				<label for="is_required" class="col-md-4 control-label">{{__('Field Required')}}</label>
				<div class="col-md-6 form-group">						
						<input type="checkbox" name="is_required" id="is_required" value="1" 	@if(isset($fields->required) && $fields->required ==1){{'checked'}}@endif>
						<span id ="is_required_err"></span>							
				</div>
				<label for="is_unique" class="col-md-4 control-label">{{__('Field Unique')}}</label>
				<div class="col-md-6 form-group">						
						<input type="checkbox" name="is_unique" id="is_unique" value="1" 	@if(isset($fields->is_unique) && $fields->is_unique ==1){{'checked'}}@endif>
						<span id ="is_unique_err"></span>							
				</div>
				
				
				<label id="report_field_lab" for="report_field" class="col-md-4 control-label">{{__('Mark as Report Field')}}</label>
				<div class="col-md-6 form-group" id="report_field_div">						
						<input type="checkbox" name="report_field" id="report_field"  value="1"	@if(isset($fields->report_field) && $fields->report_field ==1){{'checked'}}@endif>
						<span id ="report_field_err"></span>							
				</div>
				@if($action == 'update_custom_fields')
				<label id="report_field_lab" for="report_field" class="col-md-4  control-label">{{__('Field Type')}}</label>
				<div class="col-md-6 form-group">						
						<select name="field_type_val" id="field_type_val" class="form-control" >
							<option value="">Select</option>
							@foreach($field_types_arr as $f_arr)
							<option value="{{$f_arr->id ?? '' }}" @if(isset($fields->field_type) && $fields->field_type == $f_arr->id){{'selected'}}@endif>{{$f_arr->name ?? '' }}</option>
							@endforeach
						</select>
						<span id ="field_field_class_err"></span>							
				</div>
				@endif
				@if(isset($fields->field_type) && $fields->type == 2 && ($fields->field_type == 2 || $fields->field_type == 9 || $fields->field_type == 10))
				<label id="field_options" for="field_options" class="col-md-4  control-label">{{__('Option values')}}</label>
				<div class="col-md-6 form-group">						
						<a target="_blank" href="{{url('add_field_options')}}">Click Here to add Options</a>
						<span id ="field_options_err"></span>							
				</div>
				@endif
				
		
</div>
@if(isset($fields->status) && $fields->status == $status_inactive)

@else
<button type="submit " class="btn btn-primary btn-full">Submit </button>
@endif
<button type="button" class="btn btn-default" data-dismiss="modal"  onclick="refresh()">Close</button>
</form>				
				
@endif                 
<script type="text/javascript">
	
	check_report_fields('{{$fields->tab_id ?? '' }}');
</script>					
				