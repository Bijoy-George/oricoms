<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
<div class="table-widget" >
  <table width="100%" id="leadsourcetypes_lists" class="table">
    <thead>
      <tr>
        <th width="30" class="text-center">{{__('#')}}</th>
        <th>{{__('Lead Source')}}</th>
        <th>{{__('Source Key')}}</th>
        <th>{{__('Status')}}</th>
        <th class="text-center">{{__('Action')}}</th>
      </tr>
    </thead>
    <tbody>
    
    @if(count($results)>0)
    @php $i = ($results->currentpage()-1) * $results->perpage() +  1; @endphp 
    @foreach ($results as $leadsource)
    <tr>
      <td class="text-center">{{$i++}}</td>
      <td><strong>{{$leadsource->name}}</strong></td>
      <td>@if(isset($leadsource->source_key) && !empty($leadsource->source_key))
							{{$leadsource->source_key}}
						@else
						    <a href="#" id="@php echo $leadsource->id; @endphp" onclick="generateRandomKey(this.id);return false;">Generate Key </a>
						    <span id="@php echo $leadsource->id; @endphp_status"></span>
	  @endif</td>
      <td> @if($leadsource->status == 1){{__('Active')}}
        @else{{__('Inactive')}}
        @endif
	  </td>
      <td class="text-center" >
        @if( Helpers::checkPermission('lead source edit')) <a href="{{url('/lead_sources/'.$leadsource->id.'/edit/'.$leadsource->lead_source_type_id)}}"  class="btn btn-outline-secondary btn-sm"><i class="far fa-edit"></i></a>
	  </td>
      @endif </tr>
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
