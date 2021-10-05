<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
<div class="table-widget">
  <table width="100%" id="process_lists" class="table">
    <thead>
      <tr>
        <th width="30" class="text-center">{{__('#')}}</th>
        <th>{{__('Title')}}</th>
        <th>{{__('Comment')}}</th>
        <th>{{__('View')}}</th>
      </tr>
    </thead>
    <tbody>
    
    @if(count($results)>0)
    @php $i = ($results->currentpage()-1) * $results->perpage() +  1; @endphp
    @foreach ($results as $process)
    <tr>
      <td class="text-center">{{$i++}}</td>
      <td><strong>{{$process->title}}</strong></td>
      <td>{{$process->comment}}</td>
      <td><a href="{{$process->link}}">{{$process->link}}</a></td>
        </td>
    </tr>
    @endforeach
    @else
    <tr >
      <td colspan="4" class="text-center">{{__('No Data Found')}}</td>
    </tr>
    @endif
      </tbody>
    
      </tbody>
    
  </table>
</div>
<div class="d-flex justify-content-end first"> {{ $results->render() }}</div>
