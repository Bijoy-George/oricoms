<div class="content-widget">
  <input type="hidden" name="list_count" id="list_count" value="@isset($contact_count){{$contact_count}}@endisset">
  <table width="100%" id="lead_lists" class="table">
    <thead>
      <tr>
        <th>#</th>
        <th width="38"></th>
        @foreach($deflt_fields as $fields)
        <th>{{$fields->label}}</th>
        @endforeach
        @foreach($cust_fields as $val)
        <th>{{$val->label}}</th>
        @endforeach
        <th>
          <input type="checkbox" id="select-all" onclick="selectAllCustomers()">
        </th>
      </tr>
    </thead>
    <tbody>
    
    @php  $i = ($contacts->currentpage()-1) * $contacts->perpage() +  1; 	@endphp 
    @if(count($contacts)>0)
    @foreach($contacts as $res)
    <tr>
      <td>{{$i++}}</td>
      <td class="p-1 text-center"><img src="{{ asset('img/avatar.svg') }}" width="30" alt=""/></td>
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
      <td>
        <input type="checkbox" class="contact-select" name="customer_id[]" id="customer_id[]" value="{{ $res->id }}" onClick="toggleContact(this)">
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
<div class="d-flex justify-content-end first"> {{ $contacts->render() }}</div>
