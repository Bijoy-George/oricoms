<?php if(isset($template_details) && (!empty($template_details))){


$cur_date=date('Y-m-d H:i:s');
  ?>

<div class="row m-0">
  <div class="col-md-12" >
    <div id="msg_sms" style="display:none;padding: 20px 2px!important;"><span></span></div>
  </div>
  <div class="col-md-12 form-group">
    <input class="form-control" placeholder="Subject" type="text" value="@if(!empty($template_details->subject)){{ $template_details->subject }} @endif" name="new_subject" id="new_subject_sms">
    <span id="new_sub_err"></span> </div>
  <div class="col-md-12 form-group">
    <input class="form-control" placeholder="Mobile number" type="text" value="@if(!empty($user_details['mobile'])){{ $user_details['mobile'] }} @endif" name="new_mobile" id="new_mobile">
    <span id="new_recipients_err"></span> 
    <!--<span class="email-date links"><i class="fa fa-clock-o" aria-hidden="true"></i> {{Helpers::common_date_conversion($cur_date,3) }}</span>--> 
    <span class=""> </span> </div>
  <!--<div class="col-md-12 form-group"> 
    <div class="col-sm-6">
          <select class="form-control" id="greeting" name="greeting"  onchange="get_greeting(this.value);">
                      <option value="">Select Contacts  </option>
                      <option value="first_name" >First Name</option>
                      <option value="last_name" >Last Name</option>
                      <option value="emailid" >Email id</option>
                      
                      
            </select>
            <span id="new_greeting_err"></span>

          </div>
  </div>-->
  <div class="col-sm-6"> <span id="new_greeting_err"></span> </div>

  <div class="col-md-12 form-group">
    <div id="mail_template_cmp_title" style="display:none;"></div>
    <!--<label><span style="color:#d9534f;">* </span>Mandatory field</label>-->
    <input type="text" id="cmp_title_sms" name="" class="form-control" placeholder="Please enter the title">
    <span id="cmp_title_err"></span> </div>
  <div class="col-md-12 form-group">
    <textarea id="new_content_sms" name="new_content" class="req_description form-control" placeholder="Request">@if(!empty($template_details->content)){{ $template_details->content }} @endif</textarea>
    <span id="new_content_err"></span> </div>
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
<?php }else{?>
<p>No Data Found</p>
<?php } ?>

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