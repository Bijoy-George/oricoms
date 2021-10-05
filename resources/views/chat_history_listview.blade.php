<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
<div class="table-widget table-responsive">
  <table width="100%" id="querytype_lists" class="table table-striped">
    <thead>
      <tr>
        <th width="30" class="text-center">{{__('#')}}</th>
        <th>{{__('Chat From')}}</th>
        <th>{{__('Chat To')}}</th>
        <th>{{__('Message')}}</th>
        <th>{{__('Source Type')}}</th>
        <th>{{__('Date')}}</th>
      </tr>
    </thead>
    <tbody>
    
    @if(count($results)>0)
    @php 
    $i = ($results->currentpage()-1) * $results->perpage() +  1; 
    $name = "";
    
    function startsWithCheck($string, $startString) 
    { 
    $len = strlen($startString); 
    return (substr($string, 0, $len) === $startString); 
    } 
    @endphp
    @foreach ($results as $row)
    <tr>
      <td class="text-center">{{$i++}}</td>
      <td> @if($row->chat_from_type==1) 
        <!-- Chat from = Customer --> 
        {{$row->ChatThread->Customer->first_name}}
        @else 
        <!-- Chat from = Agent --> 
        {{$row->ChatThread->Agent->name}}
        @endif </td>
      <td> @if($row->chat_from_type==1) 
        <!-- Chat from = Customer, Chat to = Agent --> 
        {{$row->ChatThread->Agent->name}}
        @else 
        <!-- Chat from = Agent, Chat to = Customer --> 
        {{$row->ChatThread->Customer->first_name}}
        @endif </td>
      <td> @php
        if($row->chat_from_type==1)
        {
        $name = $row->ChatThread->Customer->first_name;
        }
        else
        {
        $name = $row->ChatThread->Agent->name;
        }
        
        if(startsWithCheck($row->chat_body,"Sending|"))
        {
        $explodeMessage = explode("|",$row->chat_body);
        $message = $explodeMessage[2];
        $message_content = $name . " has shared the file ";
        echo $message_content;
        @endphp <a target="_blank" href="{{url('/uploads/chat_documents')}}@php echo '/'.$explodeMessage[1]; @endphp"> @php echo $explodeMessage[2]; @endphp </a> @php
        }
        else
        {
        echo $row->chat_body;
        }
        @endphp </td>
      <td>{{$row->ChatThread->LeadSource->name}}</td>
      <td>{{$row->created_at}}</td>
    </tr>
    @endforeach
    @else
    <tr >
      <td colspan="8" class="text-center bg-white">No Data Found</td>
    </tr>
    @endif
      </tbody>
  </table>
</div>
<div class="d-flex justify-content-end first"> {{ $results->render() }}</div>