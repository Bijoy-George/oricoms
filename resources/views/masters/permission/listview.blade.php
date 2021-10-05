<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
<div class="table-widget" >
  <table width="100%" id="leadsourcetypes_lists" class="table">
    <thead>
      <tr>
        <th width="30" class="text-center">{{__('#')}}</th>
        <th>{{__('Permission Name')}}</th>
        <th class="text-center">{{__('Action')}}</th>
      </tr>
    </thead>
    <tbody>
    
    @if(count($results)>0)
    @php $i = ($results->currentpage()-1) * $results->perpage() +  1; @endphp 
    @foreach ($results as $data)
    <tr>
        <td class="text-center">{{$i++}}</td>
        <td><strong>{{$data->name}}</strong></td>
        <td class="text-center" >
        
        <a href="javascript:void(0)" title="Delete" onclick="deletePop('permissions/' + {{ $data->id }})" class="btn btn-default"><i class="fa fa-trash"></i></a>

		<a href="{{route('permissions.edit', $data->id)}}" title="Edit Details" class="btn btn-outline-secondary btn-sm"><i class="far fa-edit"></i></a>
		
		</td>
      </tr>
    @endforeach
    @else
    <tr >
      <td colspan="3" align="center">No Data Found</td>
    </tr>
    @endif
      </tbody>
    
  </table>
</div>
<div class="d-flex justify-content-end first"> {{ $results->render() }}</div>
