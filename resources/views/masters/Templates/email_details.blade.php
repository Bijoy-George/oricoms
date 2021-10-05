<?php if(isset($template_details->id) && (!empty($template_details->id))){


$cur_date=date('Y-m-d H:i:s');
  ?>

<div class="row m-0">
  <div class="col-md-12" >
    <div id="msg_mail" style="display:none;padding: 20px 2px!important;"><span></span></div>
  </div>
  <div class="col-md-12 form-group">
     <input class="form-control" placeholder="Subject" type="text" value="@if(!empty($user_details->subject)){{ $user_details->subject }} @elseif(!empty($template_details->subject)){{ $template_details->subject }} @endif" name="new_subject" id="new_subject">
    <span id="new_sub_err"></span> </div>
  <div class="col-md-4 form-group">
    <input class="form-control" placeholder="Email Address" type="text" value="@if(!empty($user_details->from)){{ $user_details->from }} @elseif(!empty($email_thread)) {{ $email_thread }} @endif" name="new_email" id="new_email">
    <span id="new_recipients_err"></span> 
    <!--<span class="email-date links"><i class="fa fa-clock-o" aria-hidden="true"></i> {{Helpers::common_date_conversion($cur_date,3) }}</span>--> 
    <span class=""> </span> </div>
  <div class="col-md-4 form-group">
    <select class="form-control" id="greeting" name="greeting"  onchange="get_greeting(this.value);">
      <option value="">Select Contacts </option>
      <option value="first_name" >First Name</option>
      <option value="last_name" >Last Name</option>
      <option value="emailid" >Email id</option>
      <option value="registration_code" >Registration Code</option>
      <option value="called_name" >Called Name</option>
    </select>
    <span id="new_greeting_err"></span> </div>
    <div class="col-md-4 form-group">
        <header id="ccmail-header">
           <?php $cc_email='';
          if(!empty($user_details->Cc_email)){ $cc_email=trim( $user_details->Cc_email); }
          if(!empty($user_details->Cc_email) && !empty($user_details->to)){$cc_email=$cc_email.',';}
          if(!empty($user_details->to)){$cc_email=$cc_email.trim($user_details->to);} 
          ?>
          <input class="form-control" value="{{$cc_email}}" placeholder="Cc" type="text" name="ccmail" id="ccmail">
        </header>
    </div>
  <div class="col-md-12"><span class="form-group" id="new_greeting_err"></span></div>
  <div class="col-md-12">

    <div id="mail_template_cmp_title" style="display:none;"></div>
    <!--<label><span style="color:#d9534f;"> </span>Mandatory field</label>-->
    <input type="text" id="cmp_title" name="" class="form-control" placeholder="Please enter the title">
    <input type="hidden" id="campaign_type" name="campaign_type" value="{{$campaign_type}}" class="form-control" placeholder="Please enter the title">
    <br>
    <span id="cmp_title_err"></span>
    @if($campaign_type != '')
      <?php 
      if($campaign_type == 1){
        $meta_name = 'notification_email_group';
      }elseif($campaign_type == 2) {
        $meta_name = 'promotion_email_group';
      }elseif($campaign_type == 3){
        $meta_name = 'transcation_email_group';
      }
      ?>
      <select class="form-control" id="channel_gateway" name="channel_gateway">
        <option value="">Select Channel Gateway</option>      
          <?php 
            $gateways = Helpers::get_company_meta($meta_name);
            if(!empty($gateways)){
              $gateways = unserialize($gateways); 
              if(count($gateways) > 0){
                foreach ($gateways as $key => $value) { 
                  $val = explode('_', $value); $from_email = '';
                  if(is_array($val)){
                    $gateway = $val[0];
                    $account_no = $val[1];
                    $from_email = Helpers::get_company_meta($gateway.'_from_email_'.$account_no);
                  }                  
                  ?>
                  <option value="{{$value}}">{{$value}} - {{$from_email}}</option>
                <?php
                }
              }
            }
          ?>
      </select>
    @endif
    <textarea id="new_content" name="new_content" class="tinymce req_description form-control" placeholder="Request">@if(!empty($template_details->content)){{ $template_details->content }} @endif</textarea>
    <span id="new_content_err"></span> <br>
    <div class="form-group">
      <div id="advancedUpload">Upload</div>
      <!-- <input type="hidden" value="" id="batchId" /> --> 
      <!-- <input type="hidden" value="" id="emailId" /> --> 
      <!-- <input type="hidden" value="" id="emailType"> -->
      <input type="hidden" value="" id="callbackFunc">
      <!-- <input type="hidden" value="" id="campaignId"> --> 
    </div>
  </div>
  <!-- <section class="email-footer">
      <div class="reply-box" id="reply-box">
          <input type="hidden" value="" id="replay-mail-id">
      <div class="form-group">
        <textarea class="form-control" id="reply-field" placeholder="Type your reply"></textarea>
      </div>
          <input type="submit" class="btn btn-danger pull-right" value="Submit" onclick="send_replay()">
      <div class="clearfix"></div>
    </div>
    </section>--> 
  
</div>
<?php }else{?>
<div class="py-5 text-center">No Data Found</div>
<?php } ?>
<script src="{{ asset('js/tiny_mce/tiny_mce.js') }}"></script> 
<script src="{{ asset('js/tinymce.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('css/uploadfile.min.css') }}">
<script src="{{ asset('js/jquery.uploadfile.min.js') }}" type="text/javascript"></script> 
<script>
$(document).ready(function() {
  $('#ccmail-header').hide();
    var cc_required = $('#cc_required').val();
    //var cc_required = 1;
  //alert(cc_required);
    if (cc_required)
    {
      $('#ccmail-header').show();
    }
  });

  var successFiles  = [];
var errorFiles    = [];
var uploadObj = $("#advancedUpload").uploadFile({
  url:"/mail_attachment_upload",
  multiple:true,
  autoSubmit:false,
  fileName:"file",
  allowedTypes:"jpg,png,jpeg,pdf",
  maxFileSize:1024*1024*2,
  maxFileCount:5,
  returnType:'json',
  showStatusAfterSuccess:true,
  showDelete:false,
  showDone:false,
  onSelect:function(files) {
    console.log('Submitted:');
    console.log('Submitted Files:');
    console.log(files);
    // uploadObj.reset();
    setTimeout(function() {
      $("div.ajax-file-upload-error").remove();
    }, 5000);
  },
  onSuccess:function(files,data,xhr)
  {
    console.log(123);
    console.log('Files:');
    console.log(files);
    console.log('Data:');
    console.log(data);
    console.log('XHR:');
    console.log(xhr);
    successFiles.push({
      originalName: data.original_name,
      mimeType: data.mime_type,
      savedName: data.saved_name
    });
    return;

    //$("#mesg").addClass('alert');
    //$("#mesg").addClass('alert-success');
    //$("#mesg span").html('Query added successfully.');
  },
  onError: function(files, status, errMsg, pd)
  {
    console.log('Error');
    console.log('Files:');
    console.log(files);
    console.log('Status:');
    console.log(status);
    console.log('Error Message:');
    console.log(errMsg);
    console.log('pd:');
    console.log(pd);
    errorFiles.push(files[0]);
    return;
  },
  afterUploadAll: function(obj)
  {
    console.log('Upload finished');
    console.log('Obj');
    console.log(obj);
    console.log('Error Files');
    console.log(errorFiles);
    console.log('Successful Files');
    console.log(successFiles);
    setTimeout(function() {
      $(".ajax-file-upload-statusbar").has(".ajax-file-upload-error").remove();
    }, 5000);
    if (errorFiles.length !== 0)
    {
      console.log('Failure123');
    }
    else {
      console.log('Success123');
      var callbackFunc  = $("#callbackFunc").val();
      if (callbackFunc !== '' && typeof callbackFunc != "undefined")
      {
        window[callbackFunc](2);
      }
    }
    // var token       = '{{csrf_token()}}';
    // var email_type  = parseInt($("#emailType").val());
    // var id          = 0;
    // if (email_type == 1)
    // {
    //   id = $("#batchId").val();
    // }
    // else if (email_type == 2)
    // {
    //   id = $("#emailId").val();
    // }
    //   $.ajax({
    //     type: "POST",
    //      url:  "{{ url('/updateAttachmentEmailBatchStatus') }}",
    //      data: {
    //         "_token": token,
    //         "id": id,
    //         "email_type": email_type
    //       },
    //     success: function(){
    //         $("#new_sub_err").html('');
    //         $("#new_recipients_err").html('');
    //         $("#new_content_err").html('');
    //         $('#msg_mail').show();
    //         $('#msg_mail').focus();
    //         $('#msg_mail').html('<span style="color:green;font-size: 15px;position: absolute;"><b>Mail Scheduled Successfully</b></span>');
    //         setTimeout(function() {
    //           $('#msg_mail').html('');
    //         }, 3000);
    //     }
    //   });
    }

});
</script> 

<!--
<link href="{{ asset('css/jquery.multiselect.css') }}" rel="stylesheet">


<script src="{{ asset('js/jquery.multiselect.js') }}"></script>
<script type="text/javascript">
$('#chit_id').multiselect({
    columns: 1,
    placeholder: 'Choose Chits',
   
});

  tinyMCE.init({
    mode : "textareas",
    editor_selector:"req_description",
    body_class: 'elm1=req_description1, elm2=enq_description1, elm3=sug_description1',
    elements : "ajaxfilemanager",
    theme : "advanced",
    convert_urls: false,
    plugins : "autolink,lists,pagebreak,style,table,advhr,advimage,save,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",
    height : "390",
    width  : "580",
    relative_urls : false,
    theme_advanced_buttons1 : "bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,",
    //theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,bullist,numlist,|,undo,redo,|,fullscreen",
    theme_advanced_toolbar_location : "top",
    theme_advanced_toolbar_align : "left",
    theme_advanced_statusbar_location : "bottom",
    file_browser_callback : "ajaxfilemanager",
    valid_elements: '*[*]',
   extended_valid_elements : '*[*]',
   element_format : 'html',
   template_external_list_url : "lists/template_list.js",
   external_link_list_url : "lists/link_list.js",
   external_image_list_url : "lists/image_list.js",
   media_external_list_url : "lists/media_list.js",

    style_formats : [
      {title : 'Bold text', inline : 'b'},
      {title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
      {title : 'Table styles'},
      {title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
    ],

    template_replace_values : {
      username : "Some User",
      staffid : "991234"
    }
  });
  function ajaxfilemanager(field_name, url, type, win) { //alert(url);
      var ajaxfilemanagerurl = "{{URL::to('/')}}/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php";
       var view = 'thumbnail';
      switch (type) {
        case "image":
        view = 'thumbnail';
          break;
        case "media":
          break;
        case "flash": 
          break;
        case "file":
          break;
        default:
          return false;
      }
            tinyMCE.activeEditor.windowManager.open({
                url: "{{URL::to('/')}}/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php",
                width: 782,
                height: 440,
                inline : "yes",
                close_previous : "no"
            },{
                window : win,
                input : field_name
            });
} 

jQuery.fn.extend({
insertAtCaret: function(myValue){
  return this.each(function(i) {
    if (document.selection) {
      //For browsers like Internet Explorer
      this.focus();
      sel = document.selection.createRange();
      sel.text = myValue;
      this.focus();
    }
    else if (this.selectionStart || this.selectionStart == '0') {
      //For browsers like Firefox and Webkit based
      var startPos = this.selectionStart;
      var endPos = this.selectionEnd;
      var scrollTop = this.scrollTop;
      this.value = this.value.substring(0, startPos)+myValue+this.value.substring(endPos,this.value.length);
      this.focus();
      this.selectionStart = startPos + myValue.length;
      this.selectionEnd = startPos + myValue.length;
      this.scrollTop = scrollTop;
    } else {
      this.value += myValue;
      this.focus();
    }
  })
}
});

function get_greeting(tag)
{
  if(tag == 'first_name')
  {
   var title=title='[[ First Name ]] ';
   
  }else if(tag == 'last_name')
  {
    var title='[[ Last Name ]] ';
  }else if(tag == 'emailid')
  {
    var title='[[ Email ]]';
  }else
  {
    var title='';
  }
  tinymce.get('new_content').execCommand('mceInsertContent', false, title);
}



</script>
-->
