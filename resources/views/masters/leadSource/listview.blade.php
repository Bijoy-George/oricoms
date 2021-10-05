<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
<div class="table-widget" >
  <table width="100%" id="leadsourcetypes_lists" class="table">
    <thead>
      <tr>
        <th width="30" class="text-center">{{__('#')}}</th>
        <th>{{__('Lead Source')}}</th>
        <th>{{__('Source Key')}}</th>
        <th>{{__('Lead Source Type')}}</th>
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
      <td>{{$leadsource->source_key}}</td>
      <td>@if(isset($leadsource->lead_source_type_id))
        @if(isset($leadsource->GetLeadSourceType->source_type))
        {{$leadsource->GetLeadSourceType->source_type}}@else @endif
        @endif</td>
      <td> @if($leadsource->status == 1){{__('Active')}}
        @else{{__('Inactive')}}
        @endif</td>
      <td class="text-center" ><!--@if( Helpers::checkPermission('lead source delete'))
					<a href="javascript:void(0)" onclick="deletePop('lead_sources/' + {{ $leadsource->id }},{{ $leadsource->id }})" class="btn btn-default">
					<i class="fa fa-trash" aria-hidden="true"></i></a>
					@endif --> 
        
        @if( Helpers::checkPermission('lead source edit')) <a href="{{route('lead_sources.edit', $leadsource->id)}}"  class="btn btn-outline-secondary btn-sm"><i class="far fa-edit"></i></a></td>
      @endif </tr>
    @endforeach
    @else
    <tr >
      <td>No Data Found</td>
    </tr>
    @endif
      </tbody>
    
  </table>
</div>
<div class="d-flex justify-content-end first"> {{ $results->render() }}</div>
