<?php if(isset($email_details) && (count($email_details) > 0)){?>






@foreach($email_details as $email_det)

<header class="email-content-header mt-2">
  <div class="row">
    <div class="col-12 col-md-6 pt-2">
      <h5><img width="30" height="30" alt="profile" src="{{ asset('img/avatar.svg') }}"/> {{$email_det->from_name}}</h5>
    </div>
	
    <div class="col-12 col-md-6 text-right">
      <a class="btn mail-btn mail-profile-btn" title="Profile" onclick="javascript:toggle_profile('{{$email_det->from}}')"><i class="fa fa-user-circle" aria-hidden="true"></i></a>
      <a href="/profile/0/0/0/0/0/0/{{$email_details[0]->from}}/" class="btn mail-btn" title="Generate Lead"><i class="fa fa-list-alt" aria-hidden="true"></i></a>
      @if($email_det->from!=config('constant.mail_send_from'))
      <a href="javascript:void(0);" class="btn mail-btn" title="attachment"><i class="fas fa-paperclip"></i></a>
      <a onclick="get_mail_template('{{$email_det->thread_id}}')" data-toggle="modal" data-target="#mailtemplate" class="btn mail-btn" title="Reply"><i class="fas fa-reply"></i></a>
      @endif
      <p class="datemail">{{Helpers::common_date_conversion($email_det->received_date,3) }}</p>
    </div>
  </div>
</header>

<section class="email-content-body">
  <h1 class="m-0">{{$email_details[0]->subject}}</h1>
</section>
<strong>To: {{$email_det->to}}</strong><br>
	 @if(isset($email_det->Cc_email) && !empty($email_det->Cc_email))
      <strong>Cc: {{$email_det->Cc_email}}</strong>
      @endif

<article class="py-3">
  <?php 
                $message = $email_det->message;

                $message  = preg_replace('/--[\r\n]+.*/s', '', $message);
                        print $message;
                ?>
</article>
<footer>
  <?php
		  $email_name = \App\EmailFetchAttachment::select('file_name') ->where('attachment_id', '=', $email_det->id)->get();?>
  <?php if(count($email_name)>0){ ?>
  <div class="py-3">
  <h5>Attachments (2)</h5>
  <div class="attachments">
    <?php foreach($email_name as $emailname){
                            $emailname = $emailname->file_name;
                            $filepath = public_path().'/emails/'.$emailname;
                            $info = pathinfo($filepath);
                            $ext = $info['extension'];
                    ?>
    @if(isset($emailname) && !empty($emailname)&& (File::exists($filepath)))
    @if($ext == "pdf"|| $ext == "PDF") <a href="download_attachment/{{$emailname}}" class="btn btn-outline-secondary mr-3" title="{{$emailname}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> {{$emailname}}</a> @elseif($ext == "xls"|| $ext == "xlsx") <a href="download_attachment/{{$emailname}}" class="btn btn-outline-secondary mr-3" title="{{$emailname}}"><i class="fa fa-file-excel-o" aria-hidden="true"></i> {{$emailname}}</a> @elseif($ext == "doc"|| $ext == "docx") <a href="download_attachment/{{$emailname}}" class="btn btn-outline-secondary mr-3" title="{{$emailname}}"><i class="fa fa-file-text-o" aria-hidden="true"></i> {{$emailname}}</a> @elseif($ext == "jpg"|| $ext == "png"|| $ext == "jpeg"|| $ext == "gif"|| $ext == "JPG"|| $ext == "PNG"|| $ext == "JPEG"|| $ext == "GIF") <a href="download_attachment/{{$emailname}}" class="btn btn-outline-secondary mr-3" title="{{$emailname}}"><i class="fa fa-picture-o" aria-hidden="true"></i> {{$emailname}}</a> @else <a href="download_attachment/{{$emailname}}" class="btn btn-outline-secondary mr-3" title="{{$emailname}}"><i class="fa fa-file-o" aria-hidden="true"></i> {{$emailname}}</a> @endif
    @endif
    <?php } ?>
  </div>
  </div>
  <?php } ?>
  
</footer>
@endforeach
<section class="email-footer py-3">
          <!--<div class="reply-box" id="reply-box1">
              <input type="hidden" value="" id="replay-mail-id">
          <div class="form-group">
            <textarea class="form-control" id="reply-field" placeholder="Type your reply"></textarea>
          </div>
          <div class="text-right">
              <input type="submit" class="btn btn-danger px-4" value="Send" onclick="send_replay()">
              </div>
          <div class="clearfix"></div>
        </div> -->
			<div class="text-right">
			<input type="hidden" value="{{$email_details[0]->id}}" id="replay-mail-id">
			<input type="hidden" value="{{$email_details[0]->subject}}" id="replay_subject">
				<button type="button" title="Replay" id="email" class="btn btn-secondary btn-sm" onclick="get_mail_template('{{$email_det->from}}')" data-toggle="modal" data-target="#mailtemplate"><i class="material-icons">mail</i></button>
			</div>
			<div class="clearfix"></div>
<?php }else{ ?>
<div class="row align-items-center justify-content-center" style="height:100%;">
  <div class="col-md-12 text-center py-3" id="no_data">
    <h3>Your inbox is empty</h3>
  </div>
</div>
<?php }?>
