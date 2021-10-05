<div class="form-group">
	<label for="query_type" class="control-label">{{__('Select Query Type')}}<span class="red_star">*</span></label>
	<select class="form-control" id="query_type1" name="query_type" onchange="get_status_form(0);">
      <option value="0">Query Type</option>
      @foreach($query_types as $key => $types)
        <option value="{{$types->id}}" @isset($fb_det->query_type){{  $fb_det->query_type == $types->id ? 'selected="selected"' : '' }} @endisset  >{{$types->query_type}}</option>
       @endforeach
    </select>
    
	<span class="error" id="query_type_err"></span>
	</div>
<div class="clearfix"></div><br>
<div class="form-group" id="status_div">
</div>