<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
<div class="table-widget table-responsive">
  <table width="100%" id="faq_lists" class="table m-0">
    <thead>
      <tr>
        <th width="30" class="text-center">#</th>
        <th>Question in lang1</th>
        <th>Question in lang2</th>
        <th>Answer in lang1</th>
        <th>Answer in lang2</th>
        <th>Keywords</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    
    @php  $i = ($results->currentpage()-1) * $results->perpage() +  1; 	@endphp 
    @if(count($results)>0)
    @foreach ($results as $res)
    <tr class="@if($res->status == config('constant.INACTIVE')) inactive_faq @endif">
      <td class="text-center">{{$i++}}</td>
      <td>{{strip_tags($res->question_lang1)}}</td>
      <td>{{strip_tags($res->question_lang2)}}</td>
      <td>{{strip_tags($res->answer_lang1)}}</td>
      <td>{{strip_tags($res->answer_lang2)}}</td>
      <td>{{$res->keywords}}</td>
      <td ><!--<button id="delitem" name="delitem" onclick="deletePop({{$res->id}})" class="btn btn-default"><i class="fa fa-trash" aria-hidden="true"></i></button>--> 
        <a href="{{route('faqs.edit', $res->id)}}"  class="btn btn-default"><i class="far fa-edit"></i></a></td>
    </tr>
    @endforeach
    @else
    <tr >
      <td colspan="7">No Data Found</td>
    </tr>
    @endif
      </tbody>
    
  </table>
</div>
<div class="d-flex justify-content-end first"> {{ $results->render() }}</div>
