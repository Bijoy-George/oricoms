$.ajaxSetup({ 
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function () {
//  add_multiplefields_dynamic();
	mail_count_dashboard();
  add_multiplefields_companymeta();
//  add_multiplefields_projectmeta();
  $('.form-offer').ready(function () {
		var plan	=	$(".plan_id").val();
        getCoupons(plan);
       // getOffers(plan);
  });
	
  /* Make first tab as a selected one on chnanel gateway page in default */
  $("ul.channel_gateway").each(function(){ 
    $(this).find('li:first').addClass('active');
  });

	check_survey();
  
					/* get parent categories under selected query types */
					
	$('#query_type_id').on('change', function() 
	{
		var sel_query_type	=	$("#query_type_id").val();
		//alert(sel_query_type);
		var url = $("#base_url").val();
		$.ajax({
            type: "POST",
            url: url+"/get_cat_by_qtype",
			dataType: "json",
			data: {
                sel_query_type: sel_query_type

            },
        }).done(function(data){
			if (data != 0) {        
						$('.parent_category_id').empty();
						$('.parent_category_id').append("<option value=''>Select Category</option>");
						$.each(data, function(i, d) {
							var opt = $('<option />');
								opt = "<option value='" + d.id + "'>" + d.category_name + " </option>";
							$('.parent_category_id').append(opt);
						});
					} else {
						$('.parent_category_id').empty();
						$('.parent_category_id').append("<option value=''>Select Category</option>");
					}
                  
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              console.log('No response from categories');
        });
	});				
			
					/* get appropriate div on changing template type */
					
	$(document).on('change', '#template_type', function (e)
    { 
        var val=$(this).val();
		var sms=$("#sms").val();
		var email=$("#email").val();
		var push_msg=$("#push_msg").val();
	
		 if(val == sms)
		   {			
			$('#sms_content_div').show();
			$('#email_content_div').hide();
			$('#push_content_div').hide();
		   }
		   else if(val == email){
			$('.email_content_div').show();
			$('.sms_content_div').hide();
			$('.push_content_div').hide();
		   }
		   else if(val == push_msg){
			$('.push_content_div').show();
			$('.sms_content_div').hide();
			$('.email_content_div').hide();
		   }else{
			$('.sms_content_div').hide();
			$('.email_content_div').hide();
			$('.push_content_div').hide();
		   }
        
    });
	  
     $(document).on('keydown keydown paste', '.sms_content', function (e)
      { 
        var $t        =   $(this);
        setTimeout(function()
          { 
              var max =   $t.attr('maxlength')*1;
              if ($t.val().length>max) 
                {
                    $t.val($t.val().substr(0,max));
                }
              $('#remain').text(max-$t.val().length);
          },0);
        
    });
	$('.push_content').bind('keyup keydown paste',function(e) 
      { 
        var $t        =   $(this);
        setTimeout(function()
          { 
              var max =   $t.attr('maxlength')*1;
              if ($t.val().length>max) 
                {
                    $t.val($t.val().substr(0,max));
                }
              $('#remain_push').text(max-$t.val().length);
          },0);
    });

  
});

function open_thread(thread) {
    $("#current_thread").val(thread);
		load_mail_thread();
    }
function load_mail_thread() {

     var thread =  $("#current_thread").val();
	 var url 	= $("#base_url").val();  
     

        $.ajax({
            type: "post",
            dataType: "html",
           url: url+"/load_mail_thread",   
     
            data: {
                  "thread": thread,
                },
            
        })
        .done(function(data)
        {
            
            $("#email-content").empty().html(data);
            $('#reply-box').hide();
            mail_count_dashboard()
        })
        .fail(function(jqXHR, ajaxOptions, thrownError)
        {
             $("#email-content").empty().html('No Record Found');
        }); 
   
  
}

function mail_count_dashboard()
  {
    var url = $("#base_url").val();
    $.ajax({
      type: "post",
      dataType: "html",
      url: url+"/mail_count_dashboard",
      
      dataType: "html",
      
    }).done(function(msg) {
        $('#mail_count_div').show();
        $('#mail_count_div').html(msg);
        
    }).fail(function(jqXHR, ajaxOptions, thrownError){
          console.log('Coupon details are not available1213');
    }); 
    
    
  }

  function toggle_profile(mail)
  {
    if ($('.mail-profile-wrapper').hasClass('open'))
    {
      $('.mail-profile-wrapper').removeClass('open');
    }
    else
    {
      $('.mail-profile-wrapper').addClass('open');
    }

    var url = $("#base_url").val();

    $.ajax({
      type: "post",
      url: url+"/get_profile_by_email",
      data: {
        email: mail
      }
      
    }).done(function(data) {
        data = JSON.parse(data);
        var status = data.status;
        if (status)
        {
          var requestData = {
            'profile_id': data.customer_id
          };
        }
        else
        {
          var requestData = {};
        }
        $.ajax({
          type: "post",
          dataType: "html",
          url: url+"/view_profile",
          data: requestData,
          
          dataType: "html",
          
        }).done(function(data) {
          connsole.log(data);
            data = JSON.parse(data);
            $('.mail-profile').html(data.html);
            $("#mobile").intlTelInput({
               separateDialCode: true,
            });
            if (status != 1)
            {
              $('.mail-profile #email').val(mail);
            }
            
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              console.log('Profile is not available');
        });
        // $('.mail-profile').html(data.html);
        
    }).fail(function(jqXHR, ajaxOptions, thrownError){
          console.log('Profile is not available');
    });

    $.ajax({
      type: "post",
      url: url+"/enquiry/create",
      
    }).done(function(data) {
      // console.log(data);
      $('.mail-enquiry-form').html(data);
        // data = JSON.parse(data);
        // $('.mail-profile').html(data.html);
        
    }).fail(function(jqXHR, ajaxOptions, thrownError){
          console.log('Enquiry Form is not available');
    });
  }

$(document).on('change', '#fb_type', function(){ 	
      var url = $("#base_url").val();
      var fb_type = $("#fb_type").val(); 
      if(fb_type == "") {
            $(':input[type="submit"]').prop('disabled', true); 
            return false;
         }else {
            $(':input[type="submit"]').prop('disabled', false);
        }
            
		$.ajax({
            type: "POST",
            url: url+"/get_feedback_form",
			data: {
                fb_type: fb_type

            },
        }).done(function(data){

        	var response = parse_JSON(data);
			if(response.success==true)
			{
	    	if (typeof response.html !== 'undefined' )
				{
					$('#final_result').html(response.html);
					get_status_form();

				}
			}
                  
        }).fail(function(jqXHR, ajaxOptions, thrownError){
               console.log('No response from show feedback form section');
        });
   });

	function get_status_form(){
	
      var url = $("#base_url").val();
      var enq_type = $("#query_type1").val(); 
      var fb_type = $('#fb_type').val();

      if (enq_type == 0 || fb_type == 0) {

       
            $(':input[type="submit"]').prop('disabled', true); 
            return false;
        } else {
        	$(':input[type="submit"]').prop('disabled', false);
        }
     
		$.ajax({
            type: "POST",
            url: url+"/feedback_status_form",
			data: {
                "enq_type": enq_type,
                "fb_type": fb_type,

            },
        }).done(function(data){

        	var response = parse_JSON(data);
			if(response.success==true)
			{
	    	if (typeof response.html !== 'undefined' )
				{
					$('#status_div').html(response.html);

				}
			}
                  
        }).fail(function(jqXHR, ajaxOptions, thrownError){
               console.log('No response from show feedback form section');
        });
   }
   
   
    function get_mail_template(thread_id)
	{  
    var url = $("#base_url").val();	
    var campaign_type = $('input[name=campaign_type]:checked').val();
     
        $.ajax({
            type: "POST",
             url:  url+"/load_mail_template", 
             data: {
                  "thread_id": thread_id,
		              "cc_required":'1',
                  "campaign_type":campaign_type,
                 
                },
            dataType: "html",
            success: function(msg){
              // console.log(msg)
              $("#mail_template_div").html(msg);
              $("#mailtemplate").modal();
              $('.listing2').submit();
            }
        });
	}
	
	function load_selected_template() {
    $.ajaxSetup({
        header:$('meta[name="csrf-token"]').attr('content')
        });
    var temp_id       =  $("#current_temp_id").val();
    var campaign_type =  $("#campaign_type").val();
    var email_thread  =  $("#user_email").val(); 
  	console.log(email_thread);
    var url = $("#base_url").val();
    if (typeof temp_id === "undefined") 
    {
      $("#email-content1").empty().html('');
      // return false;

    }

        $.ajax({
            type: "post",
            dataType: "html",
            url: url+"/load_selected_template",
     
            data: {
                  "temp_id": temp_id,
                  "campaign_type": campaign_type,
                  "new_email":email_thread
                },
            
        })
        .done(function(data)
        { 
           // $("#mailtemplate").modal('show');
            $("#email-content1").empty().html(data);
            $('#reply-box').hide();

        })
        .fail(function(jqXHR, ajaxOptions, thrownError)
        {
             $("#email-content1").empty().html('No Record Found');
        });
    }
	
	function select_template(id) {
    $("#current_temp_id").val(id);
    $("#select_temp_flag").val(1);
      load_selected_template();
    }
	function select_sms_template(id) {
    $("#current_temp_id_sms").val(id);
    $("#select_temp_flag").val(1);
	  load_selected_sms_template();
    }
	function select_push_template(id) {
    $("#current_temp_id_push").val(id);
    $("#select_temp_flag").val(1);
	  load_selected_push_template();
    }
    function more_feedback_det(id,fbtype)
    { 
    var url = $("#base_url").val();
    $('#feedback_details').modal({backdrop: 'static', keyboard: false})
    $("#msg_err").html("");
    $('#follo_popup').html('');
    $.ajax({
            type: "POST",
            dataType: "html",
            url: url+"/more_feedback_det",
            data: {
                "id": id,
                "type": fbtype,

            },
        }).done(function(msg){

           
            $('#follo_popup').html(msg);
        }).fail(function(jqXHR, ajaxOptions, thrownError){
               console.log('No response from show feedback form section');
        });

    }
	
  
  
	function get_helpdesk_history(docket_number='', re_open_status = false)
  {
    $("#doc_no").val(docket_number);
    if(re_open_status == 1){ 
        $(".re_open_sec").show();
    }else{
      $(".re_open_sec").hide();
    }
    $('#f_details').modal({backdrop: 'static', keyboard: false})
    
    $("#msg_err").html("");
    var url = $("#base_url").val();
    $.ajax({
      type: "POST",
      dataType: "html",
      url: url+"/get_helpdesk_history",
      data: {"docket_number": docket_number},
      
    }).done(function(msg) {
        $('.follo_popup').show();
        $('.follo_popup').html(msg);
        
    }).fail(function(jqXHR, ajaxOptions, thrownError){
           console.log('No response from get_helpdesk_history');
    });
    
    } 
  function get_followup_history(id='', re_open_status = false)
	{
		if(re_open_status == 1){ 
				$(".re_open_sec").show();
		}else{
			$(".re_open_sec").hide();
		}
		$('#f_details1').modal({backdrop: 'static', keyboard: false})
		$("#msg_err").html("");
		var url = $("#base_url").val();
		$.ajax({
			type: "POST",
			dataType: "html",
			url: url+"/get_followup_history",
			data: {"id": id},
			
		}).done(function(msg) {
				$('.follo_popup').show();
			  $('.follo_popup').html(msg);
			  
		}).fail(function(jqXHR, ajaxOptions, thrownError){
				   console.log('No response from get_followup_history');
		});
		
    } 
	
	
	function enquiry_listing_popup(follow_id)
	{ 
		var url = $("#base_url").val();
		$('#myModal').modal({backdrop: 'static', keyboard: false})
		$.ajax({
            type: "POST",
			dataType: "html",
			url: url+"/enquiry_listing",
            data: {"follow_id": follow_id, },
		}).done(function(msg) {
				$('.popupContainer').show();
				$("#popupContainer").html(msg);
			  
		}).fail(function(jqXHR, ajaxOptions, thrownError){
				   console.log('No response from followup section');
		});        
	}
  
	function change_height(h) {
        var readmore = $('.r'+h);
        if (readmore.text() == 'Read more') {
            readmore.text("Read less");
        } else {
            readmore.text("Read more");
        }           
        
        $('.'+h).toggleClass("heightAuto");
	};
	
	
  function delete_fb_question(rid)
  {
      if(rid == 0)
      {
          return false;
      }
      var url = $("#base_url").val();
      $.ajax({
              type: "POST",
              url: url+"/delete_fb_question",
              data: {
                  "rid": rid,
                  
              },
          }).done(function(msg){
           
            var fb_type = $("#fb_type").val();
            if(fb_type == 5)
            {
               $("#fb_type").trigger("change");
             }else{
              get_status_form();
             }
           
            
              
           
          }).fail(function(jqXHR, ajaxOptions, thrownError){
                 console.log('No response from show feedback form section');
          });
  }

  function check_survey()
   { 
      var mal_cons=$('#lang2').val();
      var eng_cons=$('#lang1').val();;
      var eng_check=$('input[name=is_english]:checked').val();
      var mal_check=$('input[name=is_malayalam]:checked').val(); 

      if(eng_check == eng_cons)
      {
        $('#english_div').show();
      }else{
        $('#english_div').hide(); 

      }

      if(mal_check == mal_cons)
      {
        $('#malayalam_div').show();
      }else{
        $('#malayalam_div').hide(); 
      }
      if(eng_check == eng_cons || mal_check == mal_cons){
        $('#sur_submit').removeAttr("disabled");
        $('#more_submit').removeAttr("disabled"); 
        $('#expiry_div').show();
      }else{
      $('#sur_submit').attr("disabled", "disabled");
      $('#more_submit').attr("disabled", "disabled"); 
      $('#expiry_div').hide();
      }
   }

   function new_questions() {
       
        var i = $('#f_count').val();
        var url = $("#base_url").val();
       
        if(i <= 4){
                     
                $.ajax({
                    type: "post",
                    dataType: "html",
                    url: url+"/add_more_questions",
                    data: {
                       
                        "i": i,
                        "type":1
                    },
                    success: function(msg) {
                        $(".new_question_div").append(msg);
                        i++;
                        $('.f_count').val(i);
                        if(i == 5)
                        {
                          $('#more_submit').attr("disabled", "disabled"); 
                        }

                    }
                });
                 var j = $('.f_count_mala').val();
                $.ajax({
                    type: "post",
                    dataType: "html",
                    url: url+"/add_more_questions", 
                    data: {
                       "i": j,
                        "type":2
                    },
                    success: function(msg) {
                        $(".new_question_div_mala").append(msg);
                        j++;
                        $('.f_count_mala').val(j);
                        if(j == 5)
                        {
                          $('#more_submit').attr("disabled", "disabled"); 
                        }
                    }
                });
   }else{
       
        $('#more_submit').attr("disabled", "disabled"); 
        
    }
    }

    function attachmentUpload()
    {
      $("#callbackFunc").val("compose_mail");
      var attachmentCount = $('.ajax-file-upload-statusbar').length;
      if (attachmentCount > 0)
      {
        uploadObj.startUpload();
        return;
      }
      else
      {
        compose_mail(2);
      }
    }
	

  function cmn_attachment_upload(x)
    { 
     //console.log(uploadObj); 
      //$("#callbackFunc").val("compose_mail");
      var attachmentCount = $('#enquiry_form .ajax-file-upload-statusbar').length;
      if (attachmentCount > 0)
      {
        uploadObj.startUpload();
        return;
      }
      else
      {
        return;
      }
    }
  function dynamic_attachment_upload(inc1)
    { 
      console.log('inc1--'+inc1);
      console.log(vars['uploadObj'+inc1]);
      //$("#callbackFunc").val("compose_mail");
      var attachmentCount = $('#enquiry_form'+inc1+' .ajax-file-upload-statusbar').length;
      if (attachmentCount > 0)
      {
        vars['uploadObj'+inc1].startUpload();
        return;
      }
      else
      {
        console.log('else of dynamic_attachment_upload');
        $("#enquiry_form"+inc1).submit();
      }
    }

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
  }
  else if(tag == 'registration_code')
  {
    var title='[[ Registration Code ]]';
  }
  else if(tag == 'called_name')
  {
    var title='[[ Called Name ]]';
  }
  else
  {
    var title='';
  }
  tinymce.get('new_content').execCommand('mceInsertContent', false, title);
}
    
	function compose_mail(channel) {

    console.log('success');
    console.log(channel);
    var campaignId  = $("#campaign_id").val();
    var survey_id   = $("#survey_id").val();
    var profileId = '';
	if(campaignId == null)
	{ 
    profileId = $('#pid').val();
		campaignId ='';
	}
  var template_id = '';
   if (channel==3 && survey_id == '')
  {
    template_id = "#manualcall_template ";
  }
  
   else if (channel==3 && survey_id != '')
  {
  template_id = "#manualcall_template_survey ";
  }
  else if (channel==4)
  {
    template_id = "#autodial_template ";
  }
    var survey_id  = $("#survey_id").val();
		var is_replay_mail_id  = $("#replay-mail-id").val();
		var url = $("#base_url").val();
        var new_subject = $('#new_subject').val();
		if(typeof is_replay_mail_id != 'undefined' && is_replay_mail_id != '')
		{
			new_subject = $("#replay_subject").val();
		}
		
        var new_email = $('#new_email').val();
var ccmail = $('#ccmail').val();
		var new_mobile = $('#new_mobile').val();
        var cmp_title = $('#cmp_title').val();
        var attachments = '';
		if(channel==1)
		{
			cmp_title = $('#cmp_title_sms').val();
			var new_subject = $('#new_subject_sms').val();
			var new_content = $('#new_content_sms').val();
		}
    if (channel == 2)
    {
      var new_content = '';
      if (typeof tinymce != 'undefined')
      {
        var new_content = tinymce.get('new_content').getContent();
        tinyMCE.triggerSave();
        attachments = JSON.stringify(successFiles);
      }
    }
		if(channel==3 && survey_id == '')
		{
			cmp_title = $('#cmp_title_manual').val();
			new_content = $('#new_content_manual').val();
			var query_status = $('#query_status_manual').val();
		}
    if(channel==3 && survey_id != '')
    {
      cmp_title = $('#cmp_title_manual_survey').val();
      new_content = $('#cmp_title_manual_survey').val();
    }
		if(channel==4 && survey_id=='')
		{ 
			cmp_title = $('#cmp_title_auto').val();
			var new_subject = $('#new_subject_auto').val();
			var new_content = $('#new_content_auto').val();
			var query_status = $('#query_status').val();
		} 
    if(channel==4 && survey_id != '')
    { 
      cmp_title = $('#cmp_title_auto_survey').val();
      var new_subject = $('#cmp_title_auto_survey').val();
      var new_content = $('#cmp_title_auto_survey').val();
    }
		if(channel==6)
		{
			cmp_title = $('#cmp_title_push').val();
			var new_subject = $('#new_subject_push').val();
			var new_content = $('#new_content_push').val();
		} 
		
		var channel_gateway = $('#channel_gateway').val();
    var schedule = $('#schedule').val();
        var query_type = $(template_id + '#query_type').val();
        var faq_cat_id = $(template_id + '#faq_cat_id').val();
		var priority = $('#priority').val();
		var query_subcategory = $(template_id + '#query_category').val();
        var flag = 0;
        if ((channel!=3) && (new_subject == "")) {
            $('#new_subject').focus();
            $("#new_sub_err").html('<span style="color:red;font-size: 11px;position: absolute;">Please Specify Mail Subject</span>');
            flag = 1;
        }
        if (campaignId == "" && ((new_email == "") || (new_mobile == ""))) {
            $('#new_subject').focus(); 
            $("#new_recipients_err").html('<span style="color:red;font-size: 11px;position: absolute;">Please Specify Email ID</span>');
            flag = 1;
        }

        if ((channel!=3) && ((new_content == "")||(typeof new_content === 'undefined'))) {
            //tinyMCE.get('new_content').focus();alert(new_content);
            $("#new_content_err").html('<span style="color:red;font-size: 11px;position: absolute;">Please Specify Mail Content</span>');
            flag = 1;
        }
        if (campaignId != "" && cmp_title == "") {
            $('#cmp_title').focus(); 
            $("#cmp_title_err").html('<span style="color:red;font-size: 11px;position: absolute;">Please Specify Batch Title</span>');
            flag = 1;
        }
		if ((channel == 3) && (query_status == '')) {
            $('#cmp_title').focus(); 
            $("#msg_manual").html('<span style="color:red;font-size: 11px;position: absolute;">Please Select Query Status</span>');
            flag = 1;
        }
		if ((channel == 4) && (query_status == '')) {
            $('#cmp_title').focus(); 
            $("#msg_auto").html('<span style="color:red;font-size: 11px;position: absolute;">Please Select Query Status</span>');
            flag = 1;
        }
		
        if (flag == 1) {
            return false;
        }
        new_content = encodeURIComponent(new_content);
        $.ajax({
            type: "POST",
            url: url+"/compose_mail_template",
            data: {
                "new_subject": new_subject,
                "new_email": new_email,
			"ccmail": ccmail,
				"new_mobile": new_mobile,
				"channel": channel,
        "channel_gateway": channel_gateway,
                "new_content": new_content,
                "campaign_id": campaignId,
                "survey_id": survey_id,
                "cmp_title": cmp_title,
				"schedule": schedule,
                "query_type": query_type,
                "faq_cat_id": faq_cat_id,
				"priority": priority,
				"query_subcategory": query_subcategory,
				"query_status": query_status,
				"attachments": attachments,
				"is_replay_mail_id": is_replay_mail_id,
        "customer_id": profileId
            },
            success: function(msg) { 
                $("#new_sub_err").html('');
                $("#new_recipients_err").html('');
                $("#new_content_err").html('');
				if(channel==2)
				{
					$('#msg_mail').show();
					$('#msg_mail').focus();
					$('#msg_mail').html('<span style="color:green;font-size: 15px;position: absolute;"><b>Mail Scheduled Successfully</b></span>');
					setTimeout(function() {
            $("#mailtemplate").modal('hide');
            $('#msg_mail').html('');
            $('#msg_mail').hide();
          }, 3000);
				}
                if(channel==1)
				{
					$('#msg_sms').show();
					$('#msg_sms').focus();
					$('#msg_sms').html('<span style="color:green;font-size: 15px;position: absolute;"><b>SMS Scheduled Successfully</b></span>');
					$("#smstemplate").modal('show');
				}
				if(channel==3 && survey_id == '')
				{
					$('#msg_manual').show();
					$('#msg_manual').focus();
					$('#msg_manual').html('<span style="color:green;font-size: 15px;position: absolute;"><b>Manual Call Scheduled Successfully</b></span>');
					$('#cmp_title_manual').val('');
					$("#query_category option:first").attr('selected','selected');
					$("#priority option:first").attr('selected','selected');
					$("#manualcall_template").modal('show');
				}
        if(channel==3 && survey_id != '')
        {
          $('#msg_survey_manual').show();
          $('#msg_survey_manual').focus();
          $('#msg_survey_manual').html('<span style="color:green;font-size: 15px;position: absolute;"><b>Manual Call Scheduled Successfully</b></span>');
          $('#cmp_title_manual').val('');
          $("#query_category option:first").attr('selected','selected');
          $("#priority option:first").attr('selected','selected');
          $("#manualcall_template_survey").modal('show');
        }
				if(channel==4 && survey_id == '')
				{
					$('#msg_auto').show();
					$('#msg_auto').focus();
					$('#msg_auto').html('<span style="color:green;font-size: 15px;position: absolute;"><b>Call Scheduled Successfully</b></span>');
					$('#cmp_title_auto').val('');
					$('#new_subject_auto').val('');
					$('#new_content_auto').val('');
					$("#schedule option:first").attr('selected','selected');
					$("#query_type option:first").attr('selected','selected');
					$("#faq_cat_id option:first").attr('selected','selected');
				}
        if(channel==4 && survey_id != '')
        {
          $('#msg_survey_auto').show();
          $('#msg_survey_auto').focus();
          $('#msg_survey_auto').html('<span style="color:green;font-size: 15px;position: absolute;"><b>Call Scheduled Successfully</b></span>');
          $('#cmp_title_auto').val('');
          $('#new_subject_auto').val('');
          $('#new_content_auto').val('');
          $("#schedule option:first").attr('selected','selected');
          $("#query_type option:first").attr('selected','selected');
          $("#faq_cat_id option:first").attr('selected','selected');
        }
				if(channel==6)
				{
					$('#msg_push').show();
					$('#msg_push').focus();
					$('#msg_push').html('<span style="color:green;font-size: 15px;position: absolute;"><b>Push Scheduled Successfully</b></span>');
					$('#cmp_title_push').val('');
					$("#push_template").modal('show');
				}
				$('#cmp_title').val('');
				$('#cmp_title_sms').val('');
				
				
            }
        });
}
	
	function exportDataLeads() {
			
        $.ajaxSetup({
        header:$('meta[name="csrf-token"]').attr('content')
        });
        var token       =   '{{csrf_token()}}';
		
        var query_type          =   $("#query_type").val();if(query_type==''){ query_type='NULL' }
		var category_type  =   $("#category_type").val();if(category_type==''){ category_type='NULL' }
        var sub_category  =   $("#sub_category").val();if(sub_category==''){ sub_category='NULL' }
        var status_type          =   $("#status_type").val();if(status_type==''){ status_type='NULL' }
        var search_date_dr          =   $("#search_date_dr").val();if(search_date_dr==''){ search_date_dr='NULL' }
		var otp_status		= $("#otp-status").val();if(otp_status==''){ otp_status='NULL' }
		var norka_status	= $("#norka-status").val();if(norka_status==''){ norka_status='NULL' }
        var search_keywords =   $("#search_keywords").val();if(search_keywords==''){ search_keywords='NULL' }
		var req_nxt_follow  =   $("#req_nxt_follow").val();if(req_nxt_follow==''){ req_nxt_follow='NULL' }
        var searchQuery=$('#searchQuery').val();if(searchQuery==''){ searchQuery='NULL' }
        var searchQuery1=$('#searchQuery1').val();if(searchQuery1==''){ searchQuery1='NULL' }
        
        $.ajax({
            type: "post",
           url: '{{ url("/exportDatahelpdesks") }}',
     
            data: {
				
				"_token":token,
				"query_type":query_type,
				"category_type":category_type,
				"sub_category":sub_category,
				"status_type":status_type,
				"search_date_dr":search_date_dr,
				"otp_status":otp_status,
				"norka_status":norka_status,
				"search_keywords":search_keywords,
				"req_nxt_follow":req_nxt_follow,
				"searchQuery":searchQuery,
				"searchQuery1":searchQuery1,
			},
            
        })
        .done(function(data)
        { 
          $('#alert_msg').html("<font style='color:#1bb51b;'><b>Export scheduled successfully. You can download excel from your notifications when the processing is complete</b></font>");
        })
        .fail(function(jqXHR, ajaxOptions, thrownError)
        {
            $('#alert_msg').html("<font style='color:#d5305a;'><b>Export Failed</b></font>");
        });
	}
    function show_fields(id,field_id,field_type)
    {

      $('#field_details').modal({backdrop: 'static', keyboard: false})
      $('#field_popup').html('');
     
      var url = $("#base_url").val();
      $.ajax({
              type: "POST",
              url: url+"/show_fields",
              data: {
                  "id": id,
                  "field_id":field_id,
                  "field_type":field_type
              },
          }).done(function(msg){
           
            $('#field_popup').html(msg);
           
          }).fail(function(jqXHR, ajaxOptions, thrownError){
                 console.log('No response server');
          });

    }

    function more_survey_det(surveyid,process_count,response_count)
    {
    if(surveyid == '')
    {
      return false;
    } 
    var startdate=$('#startdate').val();
    var enddate=$('#enddate').val();
    
    if(startdate == "" || startdate == null){
        startdate =   0;
      }else{
        
        var startdate =   startdate.replace(/\//g, '-');
        
      }
       if(enddate == "" || enddate == null){
        enddate =   0;
      }else{
        var enddate =   enddate.replace(/\//g, '-');
      }
    batch_id=$('#batch_id').val();
    camp_id=$('#campaign').val();
    var url = $("#base_url").val();
    window.open(url+'/more_survey_det'+'/'+batch_id+'/'+startdate+'/'+enddate+'/'+camp_id+'/'+process_count+'/'+response_count+'/'+surveyid, "", "width="+screen.availWidth+",height="+screen.availHeight);
    /*
    $('#details').modal({backdrop: 'static', keyboard: false})
    $("#msg_err").html("");
    $('#popup_content').html('');
    $.ajax({
            type: "POST",
            dataType: "html",
            url: url+"/more_survey_det",
            data: {
                "surveyid": surveyid,
                "total_response": total_response,
                "survey_count": survey_count,
            },
        }).done(function(msg){
          $('#popup_content').html(msg);
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              alert('No response from show survey form section');
        });*/

    }

    function export_fb_report() {
      
    var search_keywords    = $("#search_keywords").val();
    var agent_id  = $("#agent_id").val();
    var rating_id  = $("#rating_id").val();
    var batch_type  = $("#fb_report_const").val(); 
    var cmpny_id  = $("#cmpny_id").val();
    var created_by  = $("#created_by").val();
       $.ajax({
            type: "post",
            url: '/index.php/export_fb_report',
     
        data: {
        
                "type": batch_type,
                "rating_id":rating_id,
                "agent_id":agent_id,
                "cmpny_id":cmpny_id,
                "created_by":created_by,
                "search_keyword":search_keywords,
                "file_name":"feedback_report",
                "group_id":null,
                "excluded_contacts":'',
              },
            
        })
        .done(function(data)
        { 
          $('#alert_msg').html("<font style='color:#1bb51b;'><b>Export scheduled successfully. You can download excel from your notifications when the processing is complete</b></font>");
        })
        .fail(function(jqXHR, ajaxOptions, thrownError)
        {
            $('#alert_msg').html("<font style='color:#d5305a;'><b>Export Failed</b></font>");
        });
    }
    function export_survey_report(surveyid,process_count,response_count) {
     
    var batch_id    = $("#batch_id").val();
    var campaign  = $("#campaign").val();
    var startdate  = $("#startdate").val();
    var enddate  = $("#enddate").val(); 
    
    
       $.ajax({
            type: "post",
            url: '/index.php/export_survey_report',
     
        data: {
        
                "batch_id": batch_id,
                "campaign":campaign,
                "startdate":startdate,
                "enddate":enddate,
                "response_count":response_count,
                "process_count":process_count,
                "survey_id":surveyid,
             
              },
            
        })
        .done(function(data)
        { 
          $('#alert_msg').html("<font style='color:#1bb51b;'><b>Export scheduled successfully. You can download excel from your notifications when the processing is complete</b></font>");
        })
        .fail(function(jqXHR, ajaxOptions, thrownError)
        {
            $('#alert_msg').html("<font style='color:#d5305a;'><b>Export Failed</b></font>");
        });
    }
    function survey_customer_report(surveyid,process_count,response_count) {
     
    var batch_id    = $("#batch_id").val();
    var campaign  = $("#campaign").val();
    var startdate  = $("#startdate").val();
    var enddate  = $("#enddate").val(); 
    
    
       $.ajax({
            type: "post",
            url: '/index.php/survey_customer_report',
     
        data: {
        
                "batch_id": batch_id,
                "campaign":campaign,
                "startdate":startdate,
                "enddate":enddate,
                "response_count":response_count,
                "process_count":process_count,
                "survey_id":surveyid,
             
              },
            
        })
        .done(function(data)
        { 
          $('#alert_msg').html("<font style='color:#1bb51b;'><b>Export scheduled successfully. You can download excel from your notifications when the processing is complete</b></font>");
        })
        .fail(function(jqXHR, ajaxOptions, thrownError)
        {
            $('#alert_msg').html("<font style='color:#d5305a;'><b>Export Failed</b></font>");
        });
    }
	
	function exportChatHistoryList()
	{
		var customerid      = $("#customer_id").val();
		var search_keywords = $("#search_keywords").val();
		var source_type     = $("#lead_src_list").val();
		var agentid         = $("#agent_list").val();
		var start_date      = $("#start_date").val();
		var end_date        = $("#end_date").val();
		
		if(start_date!="")
		{
			var start_date1 = start_date.split('/');
			start_date = start_date1[1]+"-"+start_date1[0]+"-"+start_date1[2];
		}
    else
    {
      start_date = '00-00-0000';
    }
		if(end_date!="")
		{
			var end_date1 = end_date.split('/');
			end_date = end_date1[1]+"-"+end_date1[0]+"-"+end_date1[2];
		}
    else
    {
      end_date = "00-00-0000";
    }
    $.ajax({
            type: "post",
            url: '/index.php/export_chat_report',
            data: {
                "customerid": customerid,
                "search_keywords":search_keywords,
                "source_type":source_type,
                "agentid":agentid,
                "start_date":start_date,
                "end_date":end_date,
              },            
        })
        .done(function(data)
        { 
          $('#alert_msg').html("<font style='color:#1bb51b;'><b>Export has been scheduled successfully. You can download excel from your notifications list when the file has been generated.</b></font>");
        })
        .fail(function(jqXHR, ajaxOptions, thrownError)
        {
            $('#alert_msg').html("<font style='color:#d5305a;'><b>Export has failed</b></font>");
        });
	}
	
	function get_sms_template(mobile)
	{  
		var url = $("#base_url").val();	
     
        $.ajax({
            type: "POST",
             url:  url+"/load_sms_template", 
             data: {
                  "mobile": mobile,
                 
                },
            dataType: "html",
            success: function(msg){
              console.log(msg)
              $("#sms_template_div").html(msg);
              $("#smstemplate").modal();
              $('.listing2').submit();
            }
        });
	}
    
	function get_push_template(mobile)
	{  
		var url = $("#base_url").val();	
     
        $.ajax({
            type: "POST",
             url:  url+"/load_push_template", 
             data: {
                  "mobile": mobile,
                 
                },
            dataType: "html",
            success: function(msg){
              console.log(msg)
              $("#push_template_div").html(msg);
              $('.listing2').submit();
            }
        });
	}
	function load_selected_sms_template() {
    var temp_id =  $("#current_temp_id_sms").val();
    var new_mobile =  $("#user_mobile").val(); 
    var url = $("#base_url").val();
    
    if (typeof temp_id === "undefined") 
    {
      $("#sms-content1").empty().html('');
      return false;

    }

        $.ajax({
            type: "post",
            dataType: "html",
           url: url+"/load_selected_sms_template",
     
            data: {
                  "temp_id": temp_id,
                  "new_mobile":new_mobile
                },
            
        })
        .done(function(data)
        { 
           // $("#mailtemplate").modal('show');
            $("#sms-content1").empty().html(data);
            $('#reply-box').hide();

        })
        .fail(function(jqXHR, ajaxOptions, thrownError)
        {
             $("#sms-content1").empty().html('No Record Found');
        });
    }
	
	
	function load_selected_push_template() {
    var temp_id =  $("#current_temp_id_push").val();
    var new_mobile =  $("#user_mobile").val(); 
  
    
    if (typeof temp_id === "undefined") 
    {
      $("#sms-content1").empty().html('');
      return false;

    }

        $.ajax({
            type: "post",
            dataType: "html",
           url: "/load_selected_push_template",
     
            data: {
                  "temp_id": temp_id,
                  "new_mobile":new_mobile
                },
            
        })
        .done(function(data)
        { 
           // $("#mailtemplate").modal('show');
            $("#push-content1").empty().html(data);
            $('#reply-box').hide();

        })
        .fail(function(jqXHR, ajaxOptions, thrownError)
        {
             $("#push-content1").empty().html('No Record Found');
        });
    }

    $(document).on('click', 'ul.channel_gateway li', function (e) {
      var ul_id = $(this).parent().attr('id');
      if(!$(this).hasClass('active')){

        var con_name = $(this).attr('class');
        $('ul#'+ul_id+'.channel_gateway li').removeClass('active');
        $(this).addClass('active');
        var block = $(this).data('block'); 
        $('#'+block+'_container '+'.gat_con').hide();
        $('#'+con_name).show();
      }
    });

  function get_campaign_batch()
  {
        var campaign=$('#campaign').val();
        var url = $("#base_url").val(); 
         $.ajax({
            type: "post",
            dataType: "json",
           url: url+"/get_campaign_batch",
     
            data: {
                  "campaign": campaign,
                  
                },
        })
        .done(function(data)
        { 
           if (data != 0) {

                    $('#batch_id').empty();
                    $('#batch_id').append("<option value='0'>Select Batch</option>");
                    $.each(data, function(i, d) {
                        var opt = $('<option />');
                          opt = "<option value='" + d.id + "'>" + d.title + " </option>";
                        $('#batch_id').append(opt);

                    });
            } else {
                $('#batch_id').empty();
                $('#batch_id').append("<option value='0'>Select Batch</option>");
            }

        })
        .fail(function(jqXHR, ajaxOptions, thrownError)
        {
             
        });

      
  }

  function check_report_fields(tid)
  {
   
        var url = $("#base_url").val(); 
         $.ajax({
            type: "post",
            url: url+"/check_report_fields",
     
            data: {
                  "tid": tid,
                  },
        })
        .done(function(data)
        { 
           if(data > 0){console.log('11')
             $('#report_field_lab').show();
            $('#report_field_div').show();
           
           }else{
            $('#report_field_div').hide();
            $('#report_field_lab').hide();
           }

        })
        .fail(function(jqXHR, ajaxOptions, thrownError)
        {
             
        });
  }

  function generateRandomKey(clicked_id)
  {
    var url = $("#base_url").val(); 
    $.ajax({
            type: "post",
            url: url+"/generate_random_key_for_chat",
            data: {
                  "lead_src_id": clicked_id,
                  },
          })
          .done(function(data)
          { 
            $('.listing').submit();
          })
          .fail(function(jqXHR, ajaxOptions, thrownError)
          {

          });
  }
  
  function add_new_querystatus(channel)
  {
	  
	  var url = $("#base_url").val(); 
	  if(channel==3)
	  {
		  var new_query_status = $("#new_query_status_manual").val();
	  }
	  else
	  {
		  new_query_status = $("#new_query_status").val();
	  }
	  
	  
    $.ajax({
            type: "post",
            url: url+"/add_new_querystatus",
            data: {
                  "new_query_status": new_query_status,
                  },
          })
          .done(function(data)
          { 
            $("#new_query_status").val('');$("#new_query_status_manual").val('');
			$('#query_status_manual').append("<option value="+data+">"+new_query_status+"</option>");
			$('#query_status').append("<option value="+data+">"+new_query_status+"</option>");
		
			
          })
          .fail(function(jqXHR, ajaxOptions, thrownError)
          {
			 console.log("failed");
          });
  }
  
        /**** Add Coupon code ****/   
			   
	function add_coupon()
	{
		var plan_id	= $('.plan_id').val();
		$('#coupon_info').modal({backdrop: 'static', keyboard: false})
		var url = $("#base_url").val();
		$.ajax({
			type: "post",
			dataType: "html",
			url: url+"/add_coupon",
			data: {
				"plan_id": plan_id,
				},
			
		}).done(function(msg) {
			  $('.offerContainer').show();
			  $('.offerContainer').html(msg);
			  
		}).fail(function(jqXHR, ajaxOptions, thrownError){
			    console.log('Coupon details are not available1213');
		}); 
		
    }
	      /**** Get coupon details ****/   
			   
	function getCoupons(plan_id=''){
		var url = $("#base_url").val();
		$.ajax({
			type: "post",
			dataType: "json",
			url: url+"/couponlisting",
			data: {
				"plan_id": plan_id,
				},
			
		}).done(function(msg) {
			  $('.coupon_details').html(msg.html);
			  
		}).fail(function(jqXHR, ajaxOptions, thrownError){
			   
		}); 
		
    }
	
	      /**** Get offers ****/   
			   
	function getOffers(plan_id=''){
		var url = $("#base_url").val();
		$.ajax({
			type: "post",
			dataType: "json",
			url: url+"/discountofferlisting",
			data: {
				"plan_id": plan_id,
				},
			
		}).done(function(msg) {
			  $('.offer_details').html(msg.html);
			  
		}).fail(function(jqXHR, ajaxOptions, thrownError){
			   
		}); 
		
    }
	
	    /**** Add Offers for plan ****/   
			   
	function add_offer()
	{
		var plan_id	= $('.plan_id').val();
		$('#coupon_info').modal({backdrop: 'static', keyboard: false})
		var url = $("#base_url").val();
		$.ajax({
			type: "post",
			dataType: "html",
			url: url+"/add_discount_offer",
			data: {
				"plan_id": plan_id,
				},
			
		}).done(function(msg) {
			  $('.offerContainer').show();
			  $('.offerContainer').html(msg);
			  
		}).fail(function(jqXHR, ajaxOptions, thrownError){
			    console.log('Coupon details are not available1213');
		}); 
		
    }

    function download_history(doc_no,hid) {
      
  
       $.ajax({
            type: "post",
            url: '/download_history',
     
        data: {
        
                "doc_no": doc_no,
                "hid":hid,
               
              },
            
        })
        .done(function(data)
        { 
            $("#msg").fadeIn('fast');
            $("#msg").addClass('alert-success').removeClass('alert-danger');
            $("#msg").html('Export scheduled successfully. You can download excel from your notifications when the processing is complete.');
            $('#msg').delay(1000).fadeOut(2500);
          })
        .fail(function(jqXHR, ajaxOptions, thrownError)
        {
              $("#msg").fadeIn('fast');
              $("#msg").addClass('alert-danger').removeClass('alert-success');
              $("#msg").html('Download Failed.');
              $('#msg').delay(1000).fadeOut(2500);  
            
        });
    }
	
		//// FUNCTION FOR ADD MULTIPLE IN SALES AUTOMATION
	
	/*function add_multiplefields_dynamic()
	{ 
		var url = $("#base_url").val();
		//var qry_type = $("#qry_type").val();
		var get_dept = $("#get_dept").val();
		var get_desig = $("#get_desig").val();
		var maxField = 10; 
		var addButton = $('.add_button'); 
		var wrapper = $('.field_wrapper'); 
		var fieldHTML = '<b>Intimation To</b><div><div class="form-group"><input type="hidden" name="district[]" class="form-control" value="1"><label for="district_sel" class="control-label mb-1">District condition</label><select name="district_sel[]" class="form-control"><option value="0">District condition not included</option><option value="1">District condition included</option>	</select></div>	<div class="form-group"><input type="hidden" name="deptmt[]" class="form-control" value="2"><label for="deptmt_sel" class="control-label mb-1">Department</label><select class="form-control" name="deptmt_sel[]">'+get_dept+'</select></div><div class="form-group">	<input type="hidden" name="designation[]" class="form-control" value="3"><label for="designation_sel" class="control-label mb-1">Designation</label><select class="form-control" name="designation_sel[]">'+get_desig+'</select>	</div><div class="form-group"><input type="hidden" name="taluk[]" class="form-control" value="4"><label for="taluk_sel" class="control-label mb-1">Taluk condition</label><select class="form-control" name="taluk_sel[]"><option value="0">Taluk condition not included</option><option value="1">Taluk condition included</option></select></div><a href="javascript:void(0);" class="remove_button"><img style="width:20px;height:20px;" src="'+url+'/img/remove.png"/></a></div>';  
		var x = 1; 
		
		
		$(addButton).click(function(){
			if(x < maxField){ 
				x++; 
				$(wrapper).append(fieldHTML); 
			}
		});
		
		
		$(wrapper).on('click', '.remove_button', function(e){
			e.preventDefault();
			$(this).parent('div').remove(); 
			x--; 
		});
		
		
		var addButton_cc = $('.add_button_cc');
		var wrapper_cc = $('.field_wrapper_cc'); 
		var fieldHTML_cc = '<b>Intimation CC To</b><div><div class="form-group"><input type="hidden" name="district_cc[]" class="form-control" value="1"><label for="district_sel_cc" class="control-label mb-1">District condition</label><select name="district_sel_cc[]" class="form-control"><option value="0">District condition not included</option><option value="1">District condition included</option>	</select></div>	<div class="form-group"><input type="hidden" name="deptmt_cc[]" class="form-control" value="2"><label for="deptmt_sel_cc" class="control-label mb-1">Department</label><select name="deptmt_sel_cc[]" class="form-control">'+get_dept+'</select></div><div class="form-group">	<input type="hidden" name="designation_cc[]" class="form-control" value="3"><label for="designation_sel_cc" class="control-label mb-1">Designation</label><select class="form-control" name="designation_sel_cc[]">'+get_desig+'</select>	</div><div class="form-group"><input type="hidden" name="taluk_cc[]" class="form-control" value="4"><label for="taluk_sel_cc" class="control-label mb-1">Taluk condition</label><select class="form-control" name="taluk_sel_cc[]"><option value="0">Taluk condition not included</option><option value="1">Taluk condition included</option></select></div><a href="javascript:void(0);" class="remove_button_cc"><img style="width:20px;height:20px;" src="'+url+'/img/remove.png"/></a></div>'; 
		var x = 1; 
		
		
		$(addButton_cc).click(function(){
			if(x < maxField){ 
				x++; 
				$(wrapper_cc).append(fieldHTML_cc); 
			}
		});
		
		
		$(wrapper_cc).on('click', '.remove_button_cc', function(e){
			e.preventDefault();
			$(this).parent('div').remove(); 
			x--; 
		});
	}*/
	
	function add_multiplefields_companymeta()
	{
		var url = $("#base_url").val();
		var host_count = $("#host_count").val();
		var maxField = 10; 
		var addButton = $('.add_button_companymeta'); 
		var wrapper = $('.field_wrapper_companymeta'); 
		var i = 2;	
		if(host_count >= i)
		{
			i = parseInt(host_count)+1;
		}
		var x = 1; 
		$(addButton).click(function(){
			if(x < maxField){ 
				var fieldHTML = '<div><div class="row row-eq-height"><div class="col-sm-4 form-group"><input type="text" name="mail_server_host_'+i+'" id="mail_server_host_'+i+'" class="form-control"></div><div class="col-sm-4 form-group"><input type="text" name="mail_server_username_'+i+'" id="mail_server_username_'+i+'" class="form-control"></div><div class="col-sm-4 form-group"><input type="password" name="mail_server_password_'+i+'" id="mail_server_password_'+i+'" class="form-control" ></div></div><a href="javascript:void(0);" class="remove_button" id="remove_'+i+'"><img style="width:20px;height:20px;" src="'+url+'/img/remove.png"/></a></div>'; 
				x++; i++;
				$(wrapper).append(fieldHTML); 
			}
		});
		
		
		$(wrapper).on('click', '.remove_button', function(e){
			e.preventDefault();
			var ids = $(this).attr('id');
			var res = ids.substring(7);//alert(res);
			if(res>=2)
			{
				$.ajax({
					type: "post",
					url: url+'/remove_mail_server',
			 
					data: {
							"res": res,
						  },
						
					})
					.done(function(data)
					{ 
						console.log("removed");
					})
					.fail(function(jqXHR, ajaxOptions, thrownError)
					{						 
						console.log("error");
					});
				}
				$(this).parent('div').remove(); 
				x--; i--;
			});
	}

  function get_all_options()
  {
    var field_id = $('#field_id').val();
    var url = $("#base_url").val();
        $.ajax({
          type: "post",
          url: url+'/get_all_options',
       
          data: {
              "field_id": field_id,
              },
            
          })
          .done(function(data)
          { 
            $('#opt_div').html(data);
          })
          .fail(function(jqXHR, ajaxOptions, thrownError)
          {            
            console.log("error");
          });
        
  }
  function remove_field_options(id)
  {
   
    var url = $("#base_url").val();
        $.ajax({
          type: "post",
          url: url+'/remove_field_options',
       
          data: {
              "id": id,
              },
            
          })
          .done(function(data)
          { 
            get_all_options();
          })
          .fail(function(jqXHR, ajaxOptions, thrownError)
          {            
            console.log("error");
          });
        
  }

  function exportFollowups()
  {
    var url = $("#base_url").val();
    var search_keywords = $("#search_keywords").val();
    var query_types = $("#query_types").val();
    var query_category = $("#query_category").val();
    var query_status = $("#query_status").val();
    var startdate = $("#startdate").val();
    var enddate = $("#enddate").val();
    $.ajax({
          type: "POST",
          url:  url + "/export_followups",
          data: {
                    "search_keywords": search_keywords,
                    "query_types": query_types,
                    "query_category": query_category,
                    "query_status": query_status,
                    "startdate": startdate,
                    "enddate": enddate
          }, 
                
          success: function(msg) {
              $(".message").addClass("alert");
              $(".message").addClass("alert-success");
              $('.message').html("Export has been initiated. You will be notified after completion.");

              setTimeout(function() {
                  $(".message").empty();
                  $(".message").removeClass("alert-success");
                  $(".message").removeClass("alert");
              }, 3000);
          }
    });
  }

  function exportHelpdesk()
  {
    var url = $("#base_url").val();
    var search_keywords = $("#search_keywords").val();
    var query_types = $("#query_types").val();
    var query_category = $("#query_category").val();
    var query_status = $("#query_status").val();
    var startdate = $("#startdate").val();
    var enddate = $("#enddate").val();
    $.ajax({
          type: "POST",
          url:  url + "/export_helpdesk",
          data: {
                    "search_keywords": search_keywords,
                    "query_types": query_types,
                    "query_category": query_category,
                    "query_status": query_status,
                    "startdate": startdate,
                    "enddate": enddate
          }, 
                
          success: function(msg) {
              $(".message").addClass("alert");
              $(".message").addClass("alert-success");
              $('.message').html("Export has been initiated. You will be notified after completion.");

              setTimeout(function() {
                  $(".message").empty();
                  $(".message").removeClass("alert-success");
                  $(".message").removeClass("alert");
              }, 3000);
          }
    });
  }
  function exportDishaHelpdesk()
  {
    var url = $("#base_url").val();
    var search_keywords = $("#search_keywords").val();
    var query_types = $("#query_types").val();
    var query_category = $("#query_category").val();
    var query_status = $("#query_status").val();
    var startdate = $("#startdate").val();
    var enddate = $("#enddate").val();
    $.ajax({
          type: "POST",
          url:  url + "/export_disha_helpdesk",
          data: {
                    "search_keywords": search_keywords,
                    "query_types": query_types,
                    "query_category": query_category,
                    "query_status": query_status,
                    "startdate": startdate,
                    "enddate": enddate
          }, 
                
          success: function(msg) {
              $(".message").addClass("alert");
              $(".message").addClass("alert-success");
              $('.message').html("Export has been initiated. You will be notified after completion.");

              setTimeout(function() {
                  $(".message").empty();
                  $(".message").removeClass("alert-success");
                  $(".message").removeClass("alert");
              }, 3000);
          }
    });
  }
function exportEhealthHelpdesk()
  {
    var url = $("#base_url").val();
    var search_keywords = $("#search_keywords").val();
    var query_types = $("#query_types").val();
    var query_category = $("#query_category").val();
    var query_status = $("#query_status").val();
    var startdate = $("#startdate").val();
    var enddate = $("#enddate").val();
    $.ajax({
          type: "POST",
          url:  url + "/export_ehealth_helpdesk",
          data: {
                    "search_keywords": search_keywords,
                    "query_types": query_types,
                    "query_category": query_category,
                    "query_status": query_status,
                    "startdate": startdate,
                    "enddate": enddate
          }, 
                
          success: function(msg) {
              $(".message").addClass("alert");
              $(".message").addClass("alert-success");
              $('.message').html("Export has been initiated. You will be notified after completion.");

              setTimeout(function() {
                  $(".message").empty();
                  $(".message").removeClass("alert-success");
                  $(".message").removeClass("alert");
              }, 3000);
          }
    });
  }
	function exportleads()
  {
    var url = $("#base_url").val();
    var search_keywords = $("#search_keywords").val();
    var startdate = $("#startdate").val();
    var enddate = $("#enddate").val();
    $.ajax({

            type: "post",
            url: url + "/export_leads",
            data: {
                    "search_keywords" : search_keywords,
                    "startdate"       : startdate,
                    "enddate"         : enddate,

                  },
                   success: function(msg) {
              $(".message").addClass("alert");
        $(".message").addClass("alert-success");
        $('.message').html("Export has been initiated. You will be notified after completion.");

              setTimeout(function() {
                  $(".message").empty();
                  $(".message").removeClass("alert-success");
                  $(".message").removeClass("alert");
              }, 3000);
          }
    });

  }

  function exportDishaLeads()
  {
    var url = $("#base_url").val();
    var search_keywords = $("#search_keywords").val();
    var startdate = $("#startdate").val();
    var enddate = $("#enddate").val();
    $.ajax({

            type: "post",
            url: url + "/export_disha_leads",
            data: {
                    "search_keywords" : search_keywords,
                    "startdate"       : startdate,
                    "enddate"         : enddate,

                  },
                   success: function(msg) {
              $(".message").addClass("alert");
        $(".message").addClass("alert-success");
        $('.message').html("Export has been initiated. You will be notified after completion.");

              setTimeout(function() {
                  $(".message").empty();
                  $(".message").removeClass("alert-success");
                  $(".message").removeClass("alert");
              }, 3000);
          }
    });

  }

  function customerWithHelpdeskExport()
  {
    var url = $("#base_url").val();
    var search_keywords = $("#search_keywords").val();
    var startdate = $("#startdate").val();
    var enddate = $("#enddate").val();
    $.ajax({

            type: "post",
            url: url + "/export_leads_with_helpdesk",
            data: {
                    "search_keywords" : search_keywords,
                    "startdate"       : startdate,
                    "enddate"         : enddate,

                  },
                   success: function(msg) {
              $(".message").addClass("alert");
        $(".message").addClass("alert-success");
        $('.message').html("Export has been initiated. You will be notified after completion.");

              setTimeout(function() {
                  $(".message").empty();
                  $(".message").removeClass("alert-success");
                  $(".message").removeClass("alert");
              }, 3000);
          }
    });

  }
  
  /*	function add_multiplefields_projectmeta()
	{
		var url = $("#base_url").val();
		var vendor_count = $("#vendor_count").val();
		var maxField = 10; 
		var addButton = $('.add_button_projectmeta'); 
		var wrapper = $('.field_wrapper_projectmeta'); 
		var i = 2;	
		if(vendor_count >= i)
		{
			i = parseInt(vendor_count)+1;
		}
		var x = 1; 
		$(addButton).click(function(){
			if(x < maxField){ 
				var fieldHTML = '<div><div class="row row-eq-height"><div class="col-sm-4 form-group"><input type="text" name="vendor[]" id="vendor'+i+'" class="form-control"></div><div class="col-sm-4 form-group"><input type="text" name="vendor_email[]" id="vendor_email'+i+'" class="form-control"></div><div class="col-sm-4 form-group"><input type="password" name="vendor_phone[]" id="vendor_phone'+i+'" class="form-control" ></div></div><a href="javascript:void(0);" class="remove_button" id="remove_'+i+'"><img style="width:20px;height:20px;" src="'+url+'/img/remove.png"/></a></div>'; 
				x++; i++;
				$(wrapper).append(fieldHTML); 
			}
		});
		
		
		$(wrapper).on('click', '.remove_button', function(e){
			e.preventDefault();
			var ids = $(this).attr('id');
			var res = ids.substring(7);//alert(res);
			if(res>=2)
			{
				/*$.ajax({
					type: "post",
					url: url+'/remove_mail_server',
			 
					data: {
							"res": res,
						  },
						
					})
					.done(function(data)
					{ 
						console.log("removed");
					})
					.fail(function(jqXHR, ajaxOptions, thrownError)
					{						 
						console.log("error");
					});
				}
				$(this).parent('div').remove(); 
				x--; i--;
			});
	}*/

  function exporttasks()
  {
    var url = $("#base_url").val();
    var search_keywords = $("#search_keywords").val();
    var members = $("#members").val();
    var project_id = $("#project_id").val();
    var priority = $("#priority").val();
    var category = $("#category").val();
    var status = $("#status").val();
    var startdate = $("#start_date").val();
    var enddate = $("#end_date").val();
    $.ajax({

            type: "post",
            url: url + "/export_taskslist",
            data: {
                    "search_keywords" : search_keywords,
                    "members" : members,
                    "project_id" : project_id,
                    "priority" : priority,
                    "category" : category,
                    "status" : status,
                    "startdate"       : startdate,
                    "enddate"         : enddate,

                  },
                   success: function(msg) {
              $(".message").addClass("alert");
        $(".message").addClass("alert-success");
        $('.message').html("Export has been initiated. You will be notified after completion.");

              setTimeout(function() {
                  $(".message").empty();
                  $(".message").removeClass("alert-success");
                  $(".message").removeClass("alert");
              }, 3000);
          }
    });

  }
  function exporttrackerlog()
  {
    var url = $("#base_url").val();
    var prjt_id = $("#prjt_id").val();
    var task = $("#task").val();
    var from_time = $("#from_time").val();
    var to_time = $("#to_time").val();
    var status = $("#status").val();
    $.ajax({

            type: "post",
            url: url + "/export_trackerlog",
            data: {
                    "prjt_id" : prjt_id,
                    "prjt_id" : prjt_id,
                    "task" : task,
                    "from_time" : from_time,
                    "to_time" : to_time,
                    "status" : status,

                  },
                   success: function(msg) {
              $(".message").addClass("alert");
        $(".message").addClass("alert-success");
        $('.message').html("Export has been initiated. You will be notified after completion.");

              setTimeout(function() {
                  $(".message").empty();
                  $(".message").removeClass("alert-success");
                  $(".message").removeClass("alert");
              }, 3000);
          }
    });

  }

function exportserverreport()
  {
    var url = $("#base_url").val();
    var startdate = $("#startdate").val();
    var stage= $("#status").val();
    $.ajax({

            type: "post",
            url: url + "/export_server_report",
            data: {
                    "startdate" : startdate,
                    "stage" : stage,
                  },
                   success: function(msg) {
              $(".message").addClass("alert");
        $(".message").addClass("alert-success");
        $('.message').html("Export has been initiated. You will be notified after completion.");

              setTimeout(function() {
                  $(".message").empty();
                  $(".message").removeClass("alert-success");
                  $(".message").removeClass("alert");
              }, 3000);
          }
    });

  }

// export-projcet
function exportprojecttasks()
  {
    var url = $("#base_url").val();
    var search_keywords = $("#search_keywords").val();
    var status = $("#status").val();
    var startdate = $("#start_date").val();
    var enddate = $("#end_date").val();
    $.ajax({

            type: "post",
            url: url + "/export_projectlist",
            data: {
                    "search_keywords" : search_keywords,
                    "status" : status,
                    "startdate"       : startdate,
                    "enddate"         : enddate,

                  },
                   success: function(msg) {
              $(".message").addClass("alert");
        $(".message").addClass("alert-success");
        $('.message').html("Export has been initiated. You will be notified after completion.");

              setTimeout(function() {
                  $(".message").empty();
                  $(".message").removeClass("alert-success");
                  $(".message").removeClass("alert");
              }, 3000);
          }
    });

  }
//Export-Project-working-hours
 
function exportprojecthours()
  {
    var url = $("#base_url").val();
    // var search_keywords = $("#search_keywords").val();
    // var status = $("#status").val();
    var startdate = $("#start_date").val();
    var enddate = $("#end_date").val();
    $.ajax({

            type: "post",
            url: url + "/export_projecthours",
            data: {
                    // "search_keywords" : search_keywords,
                    // "status" : status,
                    "startdate"       : startdate,
                    "enddate"         : enddate,

                  },
                   success: function(msg) {
              $(".message").addClass("alert");
        $(".message").addClass("alert-success");
        $('.message').html("Export has been initiated. You will be notified after completion.");

              setTimeout(function() {
                  $(".message").empty();
                  $(".message").removeClass("alert-success");
                  $(".message").removeClass("alert");
              }, 3000);
          }
    });

  }
//Export Tracker working hours

function exporttrackerhours()
  {
    var url = $("#base_url").val();
    // var search_keywords = $("#search_keywords").val();
    // var status = $("#status").val();
    var startdate = $("#start_date").val();
    var enddate = $("#end_date").val();
    var prjt_id = $("#prjt_id").val();
    $.ajax({

            type: "post",
            url: url + "/export_trackerhours",
            data: {
                    // "search_keywords" : search_keywords,
                    // "status" : status,
                    "startdate"       : startdate,
                    "enddate"         : enddate,
                    "prjt_id"         : prjt_id,

                  },
                   success: function(msg) {
              $(".message").addClass("alert");
        $(".message").addClass("alert-success");
        $('.message').html("Export has been initiated. You will be notified after completion.");

              setTimeout(function() {
                  $(".message").empty();
                  $(".message").removeClass("alert-success");
                  $(".message").removeClass("alert");
              }, 3000);
          }
    });

  }
function exporttask()
  {
    var url = $("#base_url").val();
    var search_keywords = $("#search_keywords").val();
    var query_types = $("#query_types").val();
   
    var query_status = $("#query_status").val();
    $.ajax({
          type: "POST",
          url:  url + "/export_ehealth_task",
          data: {
                    "search_keywords": search_keywords,
                    "query_types": query_types,
                    
                    "query_status": query_status,
                    
          }, 
                
          success: function(msg) {
              $(".message").addClass("alert");
              $(".message").addClass("alert-success");
              $('.message').html("Export has been initiated. You will be notified after completion.");

              setTimeout(function() {
                  $(".message").empty();
                  $(".message").removeClass("alert-success");
                  $(".message").removeClass("alert");
              }, 3000);
          }
    });
  }
function toggleContact(checkbox)
{
  var selectAll = $('#select-all').prop('checked');
  var selectedContacts  = $('#selectedContacts').val();
  var excludedContacts  = $('#excludedContacts').val();
	
  if (excludedContacts == "")
  {
    excludedContacts = [];
  }
  else
  {
    excludedContacts    = excludedContacts.split(',');
  }

  if (selectedContacts == "")
  {
    selectedContacts = [];
  }
  else
  {
    selectedContacts    = selectedContacts.split(',');
  }
  
  if (selectAll && $(checkbox).prop('checked') === false && excludedContacts.indexOf($(checkbox).val()) < 0)
  {
    excludedContacts.push($(checkbox).val());
    excludedContacts = excludedContacts.join(',');
    console.log('excludedContacts:');
    console.log(excludedContacts);
    $('#excludedContacts').val(excludedContacts);
  }
  else if (selectAll && $(checkbox).prop('checked') === false && excludedContacts.indexOf($(checkbox).val()) > -1)
  {
    excludedContacts.splice($.inArray($(checkbox).val(), excludedContacts), 1);
    excludedContacts = excludedContacts.join(',');
    console.log('excludedContacts:');
    console.log(excludedContacts);
    $('#excludedContacts').val(excludedContacts);
  }
  else if (selectAll === false && $(checkbox).prop('checked') && selectedContacts.indexOf($(checkbox).val()) < 0)
  {
    selectedContacts.push($(checkbox).val());
    selectedContacts = selectedContacts.join(',');
    console.log('selectedContacts:');
    console.log(selectedContacts);
    $('#selectedContacts').val(selectedContacts);
  }
  else if (selectAll === false && $(checkbox).prop('checked') === false && selectedContacts.indexOf($(checkbox).val()) > -1)
  {
    selectedContacts.splice($.inArray($(checkbox).val(), selectedContacts), 1);
    selectedContacts = selectedContacts.join(',');
    console.log('selectedContacts:');
    console.log(selectedContacts);
    $('#selectedContacts').val(selectedContacts);
  }
}
function assignAgent()
{
  var form          = $('#assignAgentForm')[0];
  var url           = $("#base_url").val();
  var agents        = $("#agent").val();
  var search_keywords     = $("#search_keywords").val();
  var startDate           = $("#startdate").val();
  var endDate             = $("#enddate").val();
  var selectedContacts   = $("#selectedContacts").val();
  var excluded_contacts   = $("#excludedContacts").val();
  var selectedAll           = $('#select-all').prop('checked');
  console.log(selectedContacts);
  console.log(excluded_contacts);
  $( form ).find('.error').empty();
  $( form ).find('.form-control').removeClass('red_border');
  $( form ).find('.form-control').removeClass('text-danger');
  if (selectedAll === false && selectedContacts == '')
  {
    $('#assignAgent .message').addClass("alert");
    $('#assignAgent .message').addClass("alert-danger");
    $('#assignAgent .message').html('Please select atleast one enquiry.');

    setTimeout(function() {
      $('#assignAgent .message').empty();
      $('#assignAgent .message').removeClass("alert-danger");
      $('#assignAgent .message').removeClass("alert");
    }, 3000);
  }
	else {
    showLoader();
    $.ajax({
    type:'post',
    url:  url + "/assign_agents",
    data: {
      'agents': agents,
      'search_keywords': search_keywords,
      'start_date': startDate,
      'end_date': endDate,
      'selected_contacts': selectedContacts,
      'excluded_contacts': excluded_contacts,
      'selected_all': selectedAll
    },
    success:function(data)
    {
	var response = JSON.parse(data);
	$("#msg").fadeIn('fast');
                        $("#msg").addClass('alert-success').removeClass('alert-danger');
                        $("#msg").html(response.message);
                        $('#msg').delay(1000).fadeOut(2500);
                        hideLoader();
			form.reset();
	 },
        error: function(data){
                $("#msg").fadeIn('fast');
                $("#msg").addClass('alert-danger').removeClass('alert-success');
                $("#msg").html('Validation Error.');
                $('#msg').delay(1000).fadeOut(2500); 
		hideLoader();
	       }
	});
	}
}

 function get_email_sms_detail(p_key,type,created_at){
    var url = $("#base_url").val();
    $.ajax({
          type: "POST",
          url:  url + "/get_email_sms_detail_report",
          data: {
            "p_key": p_key,
            "type": type,
          },
          success: function(msg) {
            if(type == 1){
              $("#mail_sms_template #temp_head").html('SMS Template');
            }else{
             $("#mail_sms_template #temp_head").html('Email Template');
            }
            $("#mail_sms_template_div").html("<p class='date_con'><span class='show_date'>Date : "+created_at+"</span></p>"+msg);
          },
    });
  }
