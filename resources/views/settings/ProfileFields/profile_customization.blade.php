<div class="col-md-6 mt-3">
  <div class="widget">
    <h2 class="m-0">Customize default fields</h2>
    <div class="widget-content">
      <table width="100%" id="lead_lists" class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">{{__('Fields')}}</th>
            <th scope="col">{{__('Label')}}</th>
            <th scope="col">{{__('Required Fields')}}</th>
            <th scope="col">{{__('Unique Fields')}}</th>
            <th scope="col">{{__('Report Fields')}}</th>
            <th scope="col">{{__('Field Status')}}</th>
            <th scope="col">{{__('Action')}}</th>
          </tr>
        </thead>
        <tbody>
        
        @php $i=1; @endphp	
        @foreach ($results as $val)	
        @php $status=config('constant.ACTIVE');
        $status_inactive=config('constant.INACTIVE')
        @endphp
        <tr>
          <td >{{$i++}} </td>
          <td >{{$val->field_label}} </td>
          <td >@if($val['def_profile_fields']['status'] == $status)@if($val['def_profile_fields']['label']){{$val['def_profile_fields']['label']}} @else {{ '--'}}@endif @else {{'--'}} @endif</td>
          <td >@if($val['def_profile_fields']['status'] == $status)@if($val['def_profile_fields']['required'] == 1) <i class="fas fa-check"></i> @elseif($val['def_profile_fields']['required'] == 2)<i class="fas fa-times"></i>@else {{'--'}} @endif  @else {{'--'}} @endif </td>
          <td >@if($val['def_profile_fields']['status'] == $status)@if($val['def_profile_fields']['is_unique'] == 1) <i class="fas fa-check"></i> @elseif($val['def_profile_fields']['is_unique'] == 2)<i class="fas fa-times"></i>@else {{'--'}} @endif  @else {{'--'}} @endif </td>
          <td >@if($val['def_profile_fields']['status'] == $status)@if($val['def_profile_fields']['report_field'] == 1) <i class="fas fa-check"></i> @elseif($val['def_profile_fields']['report_field'] == 2)<i class="fas fa-times"></i>@else {{'--'}} @endif  @else {{'--'}} @endif </td>
          <td >@if($val['def_profile_fields']['status'] == $status) <i class="fas fa-check"></i> @elseif($val['def_profile_fields']['status'] == $status_inactive)<i class="fas fa-times"></i>@else {{'--'}} @endif</td>
          <td > @if($val['def_profile_fields']['status'] == $status) <a href="javascript:void(0)" onclick="show_fields(@if($val['def_profile_fields']['id']){{$val['def_profile_fields']['id']}}@else{{0}}@endif,{{$val->id}},@if($val->id ==15 || $val->id == 16){{config('constant.UPLOAD_FEILD')}} @else {{config('constant.DEFAULT_FEILD')}}@endif)" class="btn btn-default"><i class="fa fa-edit"></i></a> @endif
            @if($val['def_profile_fields']['status'] == $status) <a href="javascript:void(0)" onclick="deletePop('remove_profile_fields',{{$val['def_profile_fields']['id']}})" class="btn btn-default"><i class="fa fa-trash" aria-hidden="true"></i></a> @endif
            
            @if($val['def_profile_fields']['status'] == $status_inactive || $val['def_profile_fields']['status'] == NULL) <a href="javascript:void(0)" onclick="activatePop('activate_profile_fields',{{$val->id}},@if($val->id ==15 || $val->id == 16){{config('constant.UPLOAD_FEILD')}} @else {{config('constant.DEFAULT_FEILD')}}@endif)" class="btn btn-default"><i class="fas fa-toggle-on"></i></a> @endif </td>
        </tr>
        @endforeach
        </tbody>
        
      </table>
    </div>
  </div>
</div>
<div class="col-md-6 mt-3">
  <div class="widget">
    <h2 class="m-0">For Custom Fields <a href="javascript:void(0)" onclick="show_fields(0,0,{{config('constant.CUSTOM_FIELD')}})" class="btn btn-outline-secondary btn-sm px-4"><i class="fa fa-plus"></i>New Field</a></h2>
    <div class="widget-content">
      <table width="100%" id="lead_lists" class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">{{__('Label')}}</th>
            <th scope="col">{{__('Required Fields')}}</th>
            <th scope="col">{{__('Unique Fields')}}</th>
            <th scope="col">{{__('Report Fields')}}</th>
            <th scope="col">{{__('Field Status')}}</th>
            <th scope="col">{{__('Action')}}</th>
          </tr>
        </thead>
        <tbody>
        
        @if(count($results_custom) > 0)
        @php $i=1; @endphp	
        @foreach ($results_custom as $values)	
        @php $status=config('constant.ACTIVE');
        $status_inactive=config('constant.INACTIVE')
        @endphp
        <tr>
          <td >{{$i++}} </td>
          <td >@if($values['label']){{$values['label']}} @else {{ '--'}}@endif </td>
          <td >@if($values['status'] == $status)@if($values['required'] == 1) <i class="fas fa-check"></i> @elseif($values['required'] == 2)<i class="fas fa-times"></i>@else {{'--'}} @endif  @else {{'--'}} @endif </td>
          <td >@if($values['status'] == $status)@if($values['is_unique'] == 1) <i class="fas fa-check"></i> @elseif($values['is_unique'] == 2)<i class="fas fa-times"></i>@else {{'--'}} @endif  @else {{'--'}} @endif </td>
          <td >@if($values['status'] == $status)@if($values['report_field'] == 1) <i class="fas fa-check"></i> @elseif($values['report_field'] == 2)<i class="fas fa-times"></i>@else {{'--'}} @endif  @else {{'--'}} @endif </td>
          <td >@if($values['status'] == $status) <i class="fas fa-check"></i> @elseif($values['status'] == $status_inactive)<i class="fas fa-times"></i>@else {{$status_inactive.'SS--'}} @endif</td>
          <td > @if($values['status'] != $status_inactive) <a href="javascript:void(0)" onclick="show_fields({{$values['id']}},0,{{config('constant.CUSTOM_FIELD')}})" class="btn btn-default"><i class="fa fa-edit"></i></a> @endif
            @if($values['status'] == $status) <a href="javascript:void(0)" onclick="deletePop('remove_profile_fields',{{$values['id']}})" class="btn btn-default"><i class="fa fa-trash" aria-hidden="true"></i></a> @endif
            @if($values['status'] == $status_inactive) <a href="javascript:void(0)" onclick="activatePop('activate_profile_fields',{{$values['id']}},2)" class="btn btn-default"><i class="fas fa-toggle-on"></i></a> @endif </td>
        </tr>
        @endforeach		
        @else
        <tr>
          <td colspan="7" class="text-center">No Data Found </td>
        </tr>
        @endif
          </tbody>
        
      </table>
    </div>
  </div>
</div>
