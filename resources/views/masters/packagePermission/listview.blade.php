<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
<div class="table-widget" >
  <table width="100%" id="leadsourcetypes_lists" class="table">
    <thead>
      <tr>
        <th width="30" class="text-center">{{__('#')}}</th>
        <th>{{__('Package Title')}}</th>
        <th>{{__('Plan')}}</th>
        <th>{{__('Permissions')}}</th>
        <th class="text-center">{{__('Action')}}</th>
      </tr>
    </thead>
    <tbody>
    
    @if(count($results)>0)
    @php $i = ($results->currentpage()-1) * $results->perpage() +  1; @endphp 
    @foreach ($results as $data)
    <tr>
        <td class="text-center">{{$i++}}</td>
        <td><strong>{{$data->package_name}}</strong></td>
        <td>{{$data->plans->plan}}</td>
        <td >
		@if(! is_null($data->permission_under_package))
        @php
            $access_permission = unserialize($data->permission_under_package);
            $access_permission_name='';
		      foreach($access_permission as $row)
                {
                    $access_permission_name.=$row['permission_name'].', ';
                }
                $access_permission_name = rtrim($access_permission_name,', ');
        @endphp
            {{ str_limit($access_permission_name, 300) }}
		@endif
        </td>
		
        <td class="text-center" >
        
        <a href="javascript:void(0)" title="Delete" onclick="deletePop('packages/' + {{ $data->id }})" class="btn btn-default"><i class="fa fa-trash"></i></a>

		<a href="{{route('packages.edit', $data->id)}}" title="Edit Details" class="btn btn-outline-secondary btn-sm"><i class="far fa-edit"></i></a>
		
		</td>
      </tr>
    @endforeach
    @else
    <tr >
      <td colspan="5" align="center">No Data Found</td>
    </tr>
    @endif
      </tbody>
    
  </table>
</div>
<div class="d-flex justify-content-end first"> {{ $results->render() }}</div>
