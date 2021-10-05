<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
<?php   if(isset($thread_details) && (count($thread_details) > 0)){
        $i = ($thread_details->currentpage()-1) * $thread_details->perpage() +  1; 
        $k=0;
        ?>

    <ul class="mails-list" id="email_lists">
@foreach($thread_details as $thread)
<?php 
        $thread_id = $thread->thread_id;
        $email_det = $email_details[$thread_id];
        $url = '/mail/'.$thread_id;
        $k++;
        ?>
@if($k==1)
<input type="hidden" id="current_thread" value="{{$thread_id}}"/>
@endif
@if(!empty($email_det)&& $email_det->count()>0)
<li id="default maillist-id-{{$thread_id}}" onclick="javascript:open_thread('{{$thread_id}}');" <?php if($email_det->read_status == 1){?> class="default read"  <?php }elseif($k == 1){ ?>class="default read"  <?php } else{?>class="default unread"  <?php } ?>> <a >
  <h1>{{$email_det->from}} @if($thread->cnt>1) <span>({{$thread->cnt}})</span> @endif</h1>
  <?php $email_name = \App\EmailFetchAttachment::select('file_name') ->where('attachment_id', '=', $email_det->id)->get(); ?>
  <small>{{$email_det->subject}}</small> <span>{{Helpers::common_date_conversion($thread->received_date,3) }}</span>
  <?php if(isset($email_det->answered) && ($email_det->answered == 1)){?> <span class="flag-wrp"><i class="fab fa-font-awesome-flag"></i></span> <?php } ?>@if($email_name->count()>0)<i class="fas fa-paperclip"></i> @endif 
  </a> </li>
@endif
    @endforeach
    </ul>
    <div class="col-md-12 first">{!! $thread_details->render() !!}</div>
      </div>
<?php }else{ ?>
      <div class="col-md-12 text-center py-3" id="no_data">No emails found</div>
<?php }?>
<style type="text/css">
.default{
      cursor: pointer !important;
}
.mails-list i.fas.fa-paperclip {
    font-weight: 900 !important;
    color: #4fade4e0;
}
</style>

<script type="text/javascript">

   $(document).ready(function()
    {
      $('.mails-list li:first').addClass('active');
      $(document).on('click', '.mails-list li',function(event)
    {
        $('.mails-list li').removeClass('active');
        $(this).addClass('active');
    });
  });
   $("li.unread").on('click', function(){
    $(this).removeClass("unread");
    $(this).addClass("read");
  });
</script>


