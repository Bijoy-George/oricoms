<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
<div class="table-widget" >
  <table width="100%" id="leadsourcetypes_lists" class="table">
    <thead>
      <tr>
        <th width="30" class="text-center">{{__('#')}}</th>
        <th>{{__('Company Name')}}</th>
        <th>{{__('Email')}}</th>
        <th>{{__('Phone')}}</th>
        <th>{{__('Plan')}}</th>
		    <th>{{__('Status')}}</th>
        <th>{{__('Created')}}</th>
		    <th class="text-center">{{__('Action')}}</th>
      </tr>
    </thead>
    <tbody>
    
    @if(count($results)>0)
    @php $i = ($results->currentpage()-1) * $results->perpage() +  1; @endphp 
    @foreach ($results as $company)
   
    <tr>
        <td class="text-center">{{$i++}}</td>
        <td><strong>{{$company->ori_cmp_org_name}}</strong></td>
        <td>{{$company->ori_cmp_org_email}}</td>
        <td>{{$company->ori_cmp_org_phone}}</td>
        <td>{{$company->plan}}</td>
		    <td>
				@if($company->status == config('constant.ACTIVE')){{__('Active')}}
				@else{{__('Inactive')}}
				@endif
		    </td>
        @php $created_date = $company->created_at ?? NULL @endphp
        @php $created = \Carbon\Carbon::parse($created_date)->format('d/m/y') @endphp
        <td>{{$created}}</td>
        <td class="text-center" >
		 <a href="javascript:void(0)" title="Delete" onclick="deletePop('company/' + {{ $company->id }})" class="btn btn-default"><i class="fa fa-trash"></i></a>
		
        <a href="{{route('company.edit', $company->id)}}" title="Edit Details" class="btn btn-outline-secondary btn-sm"><i class="far fa-edit"></i></a>
		 </td>
    </tr>
    @endforeach
    @else
    <tr >
      <td colspan="7" align="center">No Data Found</td>
    </tr>
    @endif
      </tbody>
    
  </table>
</div>
<div class="d-flex justify-content-end first"> {{ $results->render() }}</div>
