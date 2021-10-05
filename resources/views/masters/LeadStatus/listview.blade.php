<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
    <div class="table-widget" >
      <table width="100%" id="querytype_lists" class="table">
        <thead>
          <tr>
					<th width="30" class="text-center">{{__('#')}}</th>					
					<th>{{__('Company')}}</th>
					<th>{{__('Company_status')}}</th>
					<th>{{__('Status')}}</th>
					<th class="text-center">{{__('Action')}}</th>
				  </tr>
        </thead>
        @if(count($results)>0)
        @php $i = ($results->currentpage()-1) * $results->perpage() +  1; @endphp 
        @foreach ($results as $res)

          @php $s = Helpers::get_company_dets($res->cmpny_id)->ori_cmp_org_name; @endphp
          
        <tbody>
        <tr>
          <td class="text-center">{{$i++}}</td>
          <td><strong>{{$s}}</strong></td>
          <td>{{$res->customer}}</td>
          <td>
          @if($res->status == 1){{__('Active')}}
          @else{{__('Inactive')}}
          @endif</td>
          <td class="text-center" >

          
          <a href="{{route('lead_status.edit', $res->id)}}"  class="btn btn-outline-secondary btn-sm"><i class="far fa-edit"></i></a>
          
          
        </td>  
          </tr>
        @endforeach
        @else
            <tr>
            <td>No Data Found</td>
            </tr>
          
        </tbody>

        
        @endif
      </table>
    </div>
<div class="d-flex justify-content-end first"> {{ $results->render() }}</div>