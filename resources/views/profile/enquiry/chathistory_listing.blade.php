<div class="widget">
  <h2>{{__('Chat History Listing')}} <a  href="{{url('/chat_reports/'.$customer_id)}}"  target="_blank"  class="btn btn-outline-secondary btn-sm px-4" >View all</a></h2>
  <div class="table-responsive">
    <table width="100%" id="chat_history_req" class="table table-striped history-table m-0">
      <thead>
        <tr>
          <th>#</th>
          <th scope="col">Chat From</th>
          <th scope="col">Chat To</th>
          <th scope="col">Message</th>
          <th scope="col">Source Type</th>
          <th scope="col">Date (IST) </th>
        </tr>
      </thead>
      <tbody>
      
      @php  $i = 1; 	 @endphp 
      @if(count($chat_history)>0)
      @foreach($chat_history as $row)
      @foreach($row->ChatThreadLogs as $val)
      <tr>
        <td scope="col">{{$i}} </td>
        <td scope="col"> @if($val->chat_from_type==1) 
          <!-- Chat from = Customer --> 
          {{$row->Customer->first_name}}
          @else 
          <!-- Chat from = Agent --> 
          {{$row->Agent->name}}
          @endif </td>
        <td scope="col"> @if($val->chat_from_type==1) 
          <!-- Chat from = Customer, Chat to = Agent --> 
          {{$row->Agent->name}}
          @else 
          <!-- Chat from = Agent, Chat to = Customer --> 
          {{$row->Customer->first_name}}
          @endif </td>
        <td scope="col">{{$val->chat_body}}</td>
        <td scope="col">{{$row['LeadSource']['name']}}</td>
        <td scope="col">{{$val->created_at}}</td>
      </tr>
      @php $i++ @endphp
      @endforeach
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
