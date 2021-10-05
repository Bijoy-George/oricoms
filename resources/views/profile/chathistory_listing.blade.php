<div class="widget">
	<h2>{{__('Chat History')}} 
		@if(count($chat_history)>0) 
		@foreach($chat_history as $row) 
        @if(count($row->ChatThreadLogs)>0) 
		<a  href="{{url('/chat_reports/'.$customer_id)}}"  target="_blank"  class="btn btn-outline-secondary btn-sm px-4" >View all</a>
		@endif
		@endforeach
		@endif
	</h2>
    
 <div class="table-widget table-responsive mt-0 pt-0">   
<table width="100%" id="chat_history_req" class="table height-small history-table m-0">
		<thead>
			<tr class="anchor-wrap">
				<th>#</th>
				<th scope="col">Chat From</th>
				<th scope="col">Chat To</th>
				<th scope="col">Message</th>
				<th scope="col">Source Type</th>
				<th scope="col">Date (IST) </th>
			</tr>
		</thead>
    <tbody>
    
    @php  $i = 1; 
      function startsWithCheck($string, $startString) 
      { 
        $len = strlen($startString); 
        return (substr($string, 0, $len) === $startString); 
      } 
    @endphp
    @if(count($chat_history)>0) 
      @foreach($chat_history as $row) 
        @if(count($row->ChatThreadLogs)>0) 
          @foreach($row->ChatThreadLogs as $val)
            <tr>
              <td scope="col">{{$i}} </td>
              <td scope="col"> 
                @if($val->chat_from_type==1) 
                  <!-- Chat from = Customer --> 
                  {{$row->Customer->first_name}}
                @else 
                  <!-- Chat from = Agent --> 
                  {{$row->Agent->name}}
                @endif </td>
              <td scope="col">
                @if($val->chat_from_type==1) 
                  <!-- Chat from = Customer, Chat to = Agent --> 
                  {{$row->Agent->name}}
                @else 
                  <!-- Chat from = Agent, Chat to = Customer --> 
                  {{$row->Customer->first_name}}
                @endif </td>
              <td scope="col">
                @php    
                  if($val->chat_from_type==1) 
                  {
                    $name = $row->Customer->first_name;
                  } 
                  else
                  {
                    $name = $row->Agent->name;
                  } 

                  if(startsWithCheck($val->chat_body,"Sending|"))
                  {
                    $explodeMessage = explode("|",$val->chat_body);
                    $message = $explodeMessage[2];
                    $message_content = $name . " has shared the file ";
                    echo $message_content; 
                @endphp
                    <a target="_blank" href="{{url('/uploads/chat_documents')}}@php echo '/'.$explodeMessage[1]; @endphp">
                    @php echo $explodeMessage[2]; @endphp
                    </a>
                @php
                  }
                  else
                  {
                    echo $val->chat_body; 
                  }
                @endphp
              </td>
              <td scope="col">{{$row['LeadSource']['name']}}</td>
              <td scope="col">{{$val->created_at}}</td>
            </tr>
          @php $i++ @endphp
          @endforeach
        @else
          <tr>
            <td colspan="6" class="text-center">No Data Found</td>
          </tr>
        @endif
      @endforeach
    @else
      <tr>
        <td colspan="6" class="text-center">No Data Found</td>
      </tr>
    @endif
    </tbody>
  </table>
</div>
</div>
