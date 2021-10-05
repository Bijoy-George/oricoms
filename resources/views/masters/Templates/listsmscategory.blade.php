<?php   if(isset($thread_details) && (count($thread_details) > 0)){
        $i = ($thread_details->currentpage()-1) * $thread_details->perpage() +  1; 
        $k=0;
        ?>
    <ul class="email-list" id="sms_lists1">
@foreach($thread_details as $thread)
<?php 
        $id = $thread->id;
      
        $k++;
        
        ?>
@if($k==1)
<input type="hidden" id="current_temp_id_sms" value="{{$id}}"/>

@endif

<li id="default smslist-id-{{$id}}" class="default" onclick="javascript:select_sms_template('{{$id}}');">
  <h2 class="email-id"><i class="far fa-comment-alt"></i> {{$thread->title}}</h2>
  <span class="email-subject">{{$thread->subject}}</span> 
  </li>

    @endforeach
    </ul>
    <div class="col-md-12 text-right second">{!! $thread_details->render() !!}</div>
      </div>
<?php }else{ ?>
      <div class="py-5 text-center">No Data Found</div>
<?php }?>

