@if(count($opt_arr) >0)
<label for="title" class="control-label">{{__('Options')}}<span class="red_star">*</span></label>
@foreach($opt_arr as $opt)
<input type="text" name="new_option[{{$opt->id}}]" value="{{$opt->options}}" class="form-control"> <a href="#" onclick="remove_field_options({{$opt->id}})">Remove</a>
<br/>
@endforeach
@endif
            
         
            