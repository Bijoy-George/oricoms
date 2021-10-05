<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
<div class="table-widget">
  <table width="100%" id="process_lists" class="table">
    <thead>
      <tr>
        <th width="30" class="text-center">{{__('#')}}</th>
        <th>{{__('Stage')}}</th>
        <th>{{__('Action')}}</th>
        <th>{{__('Positive Response')}}</th>
        <th>{{__('Negative Response')}}</th>
        <th>{{__('Action Time (Mins)')}}</th>
        <th>{{__('Expiry Time (Mins)')}}</th>
        <th>{{__('Content')}}</th>
        <th class="text-center">{{__('Action')}}</th>
      </tr>
    </thead>
    <tbody>
    
    @if(count($results)>0)
    @php $i = ($results->currentpage()-1) * $results->perpage() +  1; @endphp
    @foreach ($results as $process)
    <tr>
      <td class="text-center">{{$i++}}</td>
      <td><strong>{{$process->process_name}}</strong></td>
      <td>{{Helpers::get_auto_process_action($process->action) }}</td>
      <td>{{$process->response_pos}}</td>
      <td>{{$process->response_neg}}</td>
      <td>{{$process->action_time}}</td>
      <td>{{$process->expiry_time}}</td>
      <td>@isset($process->content){{Helpers::get_template_subject($process->content) }}@endisset </td>
      <td class="text-center"> {{--@if( Helpers::checkPermission('sales automation edit'))--}} <a href="{{route('sales_automation_customer.edit', $process->id)}}"  class="btn btn-outline-secondary btn-sm"><i class="far fa-edit"></i></a> 
        <!--<a href="javascript:void(0)" onclick="deletePop('sales_automation_customer/' + {{ $process->id }},{{ $process->id }})" class="btn btn-default">
						<i class="fa fa-trash" aria-hidden="true"></i></a>--> 
        {{--@endif--}} </td>
    </tr>
    @endforeach
    @else
    <tr >
      <td>No Data Found</td>
    </tr>
    @endif
      </tbody>
    
      </tbody>
    
  </table>
</div>
<div class="d-flex justify-content-end first"> {{ $results->render() }}</div>
