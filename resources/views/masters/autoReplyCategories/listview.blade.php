<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
<div class="table-widget" >
  <table width="100%" id="faqcategory_lists" class="table">
    <thead>
      <tr>
        <th width="30" class="text-center">{{__('#')}}</th>
        <th>{{__('Category Name')}}</th>
        <th>{{__('Status')}}</th>
        <th class="text-center">{{__('Action')}}</th>
      </tr>
    </thead>
    <tbody>
    
    @if(count($results)>0)
    @php $i = ($results->currentpage()-1) * $results->perpage() +  1; @endphp 
    @foreach ($results as $autoReplyCategory)
    <tr>
      <td class="text-center">{{$i++}}</td>
      <td><strong>{{$autoReplyCategory->name}}</strong></td>
      <td> @if($autoReplyCategory->status == 1){{__('Active')}}
        @else{{__('Inactive')}}
        @endif</td>
      <td class="text-center" >
       <a href="{{route('auto_reply_categories.edit', $autoReplyCategory->id)}}"  class="btn btn-outline-secondary btn-sm"><i class="far fa-edit"></i></a></td>
      </tr>
    @endforeach
    @else
    <tr >
      <td colspan="4" align="center">No Data Found</td>
    </tr>
    @endif
      </tbody>
    
  </table>
</div>
<div class="d-flex justify-content-end first"> {{ $results->render() }}</div>
