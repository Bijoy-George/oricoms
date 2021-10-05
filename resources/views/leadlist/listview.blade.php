<script type="text/javascript">
  $(".anchor-wrap").click(function() {
    var lstLocation = $(this).attr("data-href");
    window.location = lstLocation;
});
</script>


<div class="row">
  <div class="col-12 @if( Helpers::checkPermission('lead status summary')) col-md-9 @endif ">
    <div class="table-widget table-responsive">
      <input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
      <table width="100%" id="lead_lists" class="table">
        <thead>
          <tr>
            <th width="10">#</th>
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
        
        @php  $i = ($results->currentpage()-1) * $results->perpage() +  1;  @endphp 
        @if(count($results)>0)
        @foreach($results as $res)
        <tr class="anchor-wrap" data-href="{{url('profile')}}/0/{{$res->id}}">
          <td>{{$i++}}</td>
          @if($profile_has_photo)
          <td class="p-1 text-center"><div class="listproimg"><img src="@if(!empty($res->profile_photo)) {{ url('uploads/profile/'.$res->profile_photo) }} @else {{ asset('img/avatar.svg') }} @endif" width="30" alt=""/></div></td>
          @endif
          @foreach($deflt_fields as $fields)
          @if ($fields->field_name == 'country_id')
          <td> {{$res->getCountry->name ?? ''}} </td>
          @elseif ($fields->field_name == 'state_id')
          <td> {{$res->getState->name ?? ''}} </td>
          @elseif ($fields->field_name == 'district_id')
          <td> {{$res->getDistrict->name ?? ''}} </td>
          @else
          <td> {{$res[$fields->field_name]}} </td>
          @endif
          @endforeach
          @php $details = $res->profile_details; @endphp
          
          @foreach($cust_fields as $val)
          @php $fieldid = $val->id;$flag = 1; @endphp
          
          @foreach($details as $detail)

          @if($detail->field_id == $fieldid)
          <td>{{ $detail['ProfileOptions']['options'] ??  $detail['ProfileOptions']['options'] ?? $detail->value ?? $detail->value ?? '' }}</td>
          @php $flag = 2; @endphp
          @endif
          @endforeach
          @if($flag == 1)
          <td>&nbsp;</td>
          @endif
          @endforeach
          <td align="center"><a href="{{url('profile')}}/0/{{$res->id}}" class="btn " data-toggle="tooltip" data-placement="top" title="View customer profile"><i class="fas fa-chevron-right"></i></a></td>
        </tr>
        @endforeach
        @else
        <tr > 
          <!--<td colspan="{{$row_count}}">No Data Found</td>-->
          <td colspan="8" class="text-center bg-white">No Data Found</td>
        </tr>
        @endif
        </tbody>
        
      </table>
    </div>
    <div class="d-flex justify-content-end first"> {{ $results->render() }}</div>
  </div>
  @if( Helpers::checkPermission('lead status summary'))
<div class="col-12 col-md-3">
    <div class="widget mt-3">
    <h2>{{ !empty(Helpers::get_company_meta('customer_label')) ? Helpers::get_company_meta('customer_label') : 'Customer Profiles' }} <a class="help-tooltip" data-toggle="tooltip" data-placement="top" title="{{ !empty(Helpers::get_company_meta('customer_label')) ? Helpers::get_company_meta('customer_label') : 'Customer Profiles' }} "><img src="{{ asset('img/ic_help_outline.svg') }}" alt="Help" height="20"></a></h2>
    <div class="widget-scroller table-responsive">
      <table class="table border-table escalation-summary" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
            <tbody>
                <tr class="Total" >
                    <td><i class="fas fa-users"></i> Total</td>
                    <td align="center"><a href="#" >@isset($total_customer_count){{$total_customer_count}}@endisset</a></td>
                </tr>
                @foreach ($status_customer_counts as $profile_status_value => $profile_status_data)
                  <tr class="Processing" style="color: {{ $profile_status_data['status_color'] ?? '' }};">
                      <td><i class="fas {{ $profile_status_data['status_icon'] ?? '' }}"></i> {{ $profile_status_data['status_name'] ?? '' }}</td>
                      <td align="center"><a href="#">{{ $profile_status_data['customer_count'] ?? 0 }}</a></td>                               
                  </tr>
                @endforeach    
        </tbody>
      </table>
    </div>
  </div>
</div>
@endif



