@if($p_fields)
<div class="row"> 

  @foreach($p_fields['profile_fields'] as $row)

   <div class="col-sm-6 form-group">
      <label for="{{ $row->field_name ?? '' }}">{{ $row->label ?? '' }} @if($row->required == 1) <span class="red_star">*</span>@endif </label>
      <input type="@if($row->field_type){{$row->field_type}}@else {{'text'}}@endif" class="form-control" id="{{ $row->field_name ?? '' }}{{$m}}" name="{{ $row->field_name ?? '' }}{{$m}}" value=""/>
      
    </div>
  @endforeach
    
</div>
@endif               