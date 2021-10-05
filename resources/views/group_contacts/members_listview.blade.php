<div class="content-widget">
  <input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
  <table width="100%" id="lead_lists" class="table">
    <thead>
      <tr>
        <th>#</th>
        @if($profile_has_photo)
          <th width="38"></th>
        @endif
        @foreach($deflt_fields as $fields)
        <th>{{$fields->label}}</th>
        @endforeach
        @foreach($cust_fields as $val)
        <th>{{$val->label}}</th>
        @endforeach
        <th class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>
    
    @php  $i = ($results->currentpage()-1) * $results->perpage() +  1; 	@endphp 
    @if(count($results)>0)
    @foreach($results as $res)
    <tr>
      <td>{{$i++}}</td>
      @if($profile_has_photo)
          <td class="p-1 text-center"><div class="listproimg"><img src="@if(!empty($res->profile_photo)) {{ url('uploads/profile/'.$res->profile_photo) }} @else {{ asset('img/avatar.svg') }} @endif" width="30" alt=""/></div></td>
      @endif
      <!-- <td class="p-1 text-center"><img src="{{ asset('img/avatar.svg') }}" width="30" alt=""/></td> -->
      @foreach($deflt_fields as $fields)
      <td> {{$res[$fields->field_name]}} </td>
      @endforeach
      @php $details = $res->contact_details; @endphp
      
      @foreach($cust_fields as $val)
      @php $fieldid = $val->id;$flag = 1; @endphp
      
      @foreach($details as $detail)
      @if($detail->field_id == $fieldid)
      <td>{{$detail->value}}</td>
      @php $flag = 2; @endphp
      @endif
      @endforeach
      @if($flag == 1)
      <td>&nbsp;</td>
      @endif
      @endforeach
      <td align="center">
        <a href="javascript:void(0)" onclick="deletePop('/group_contacts/' + {{ $group->id }} + '/delete', {{ $res->id }})" class="btn btn-sm btn-outline-danger">
          <i class="fas fa-trash-alt"></i>
      </td>
    </tr>
    @endforeach
    @else
    <tr > 
      <td colspan="8" class="text-center bg-white">No Data Found</td>
    </tr>
    @endif
    </tbody>
    
  </table>
</div>
<div class="d-flex justify-content-end first"> {{ $results->render() }}</div>
