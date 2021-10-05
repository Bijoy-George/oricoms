/* 
 * Profile js function and global variables
 */
$.ajaxSetup({ 
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var parse_JSON = function (data) {
    try {
        var obj = JSON && JSON.parse(data) || $.parseJSON(data);
        return obj;
    } catch (e) {
        // not json
        console.log(data);
        console.log("Oops, it looks like there is an issue, we are looking to fix it");
        return false;
    }

};
$(document).ready(function () {
   
  

    /*
     * Just add the .form-profile class on the form you want to submit
     * define the method and action
     * optionally you can define a custom callback function 
     * for response handling
     */
   $(document).on('submit', '.form-common-profile', function (e) {
  e.preventDefault();
  var form = this;

    if($(form).hasClass('tinymce')){
      tinyMCE.triggerSave();
    }
        var form_id = $(form).attr('id');
        var method = $(form).attr('method');
        var action = $(form).attr('action');var action2 = action;
        var name = $(form).attr('name');
        var callback = $(form).find("input.callback");
        var arg     = $(form).find("input.arg").val();
        var datastring = $(form).serialize();
        var submit_btn = $(form).find('button[type=submit]');
        var reset_btn = $(form).find('button[type=reset]');
        var pageReset = $(form).attr('page-reset');

        if (callback.length > 0) {
            callback = callback.val();
        } else {
            callback = false;
        }
    var page = $("#pageno").val();
    if (typeof page !== 'undefined' )
    {
            if (typeof pageReset !== typeof undefined && pageReset !== 'false')
            {
                page = 1;
                $("#pageno").val(page);
            }
      action = action+'?page='+page;
    } 
   
        hideAlertFormCommon(form);
        submit_btn.attr('disabled', 'disabled');
        reset_btn.attr('disabled', 'disabled');
        submit_btn.html('Please wait..');
        $( form ).find(".form-control").removeClass("red_border");
        $( form ).find(".form-control").removeClass("text-danger");
        $( form ).find("span.error").empty();


       


        $.ajax({
            type: method,
            url: action,
            data: datastring,     
      dataType: "json",
            success: function (data) {
        
        var response = data;
        if(response.success==true)
        {
           
          if (typeof response.html !== 'undefined' )
          {
            $('#list').html(response.html);
            totalcount = $("#list_count").val();
            if (totalcount == null){ totalcount = 0; }
            $("#totalcount").html('('+totalcount+')');
          }
          if (typeof response.html2 !== 'undefined' )
          { 
            $('#list2').html(response.html2);
            load_selected_template();
            
          }
          if (typeof response.html3 !== 'undefined' )
          { 
            $('#list3').html(response.html3);
            load_selected_sms_template();
            
          }
          if (typeof response.html4 !== 'undefined' )
          { 
            $('#list4').html(response.html4);
            load_selected_push_template();
            
          }

          if (typeof response.message !== 'undefined' )
          { 
            $("#msg").fadeIn('fast');
            $("#msg").addClass('alert-success').removeClass('alert-danger');
            $("#msg").html('Saved Successfully.');
            $('#msg').delay(1000).fadeOut(2500);

                        if (response.reset == true)
                        {
                            form.reset();
                        }if (response.reload == true)
                        {   //alert();
                            window.location.reload();
                        }if ($(form).hasClass('reload'))
                        {   //alert();
                            window.location.reload();
                        }

                        
          }
                    if (response.refresh == true)
                    {
                        $('.listing').submit();
                    }
          submit_btn.removeAttr("disabled");
          reset_btn.removeAttr("disabled");
          submit_btn.html('Submit');
          $(form).removeAttr('page-reset');
          if (callback) { //show_helpdesk_listing(response, form, submit_btn);
                    if(arg == 0){
                        window[callback]();
                    }else{
                        window[callback](response, form, submit_btn);
                    }
                }
          
        }
        else if(response.success==false)
        { 
          

          if (typeof response.message !== 'undefined' )
          {

              $("#msg").fadeIn('fast');
              $("#msg").addClass('alert-danger').removeClass('alert-success');
              $("#msg").html('Something went wrong.');
              $('#msg').delay(1000).fadeOut(2500);    

            
          }
                   if (response.reset != false)
                      {
                          form.reset();
                      }
                    if (response.refresh == true)
                    {
                        $('.listing').submit();
                    }
                    submit_btn.removeAttr("disabled");
                    reset_btn.removeAttr("disabled");
                    submit_btn.html('Submit');
                    $(form).removeAttr('page-reset');
          
          
        }
        else
        {
          //alertFormCommon("Result Error");
        }

                 
                  },
            error: function (data) {  

                $("#msg").fadeIn('fast');
                $("#msg").addClass('alert-danger').removeClass('alert-success');
                $("#msg").html('Something went wrong.');
                $('#msg').delay(1000).fadeOut(2500);

                $.each(data.responseJSON.errors, function (i) {

                    $.each(data.responseJSON.errors, function (key, val) {
                       
                        $( form ).find("#"+key).addClass("red_border");
                        $( form ).find("#"+key).addClass("text-danger");
                        $( form ).find("#"+key+'_err').html(val);
                       
                    });
                });
                submit_btn.removeAttr("disabled");
                reset_btn.removeAttr("disabled");
                submit_btn.html('Submit');
                $(form).removeAttr('page-reset');
            }
        });

        return false;
    });
    $(document).on('submit', '.form-profile', function (e) {
        e.preventDefault();

        var mobile=$('#mobile').val();
        if(mobile !="" && typeof mobile !== 'undefined'){
             var countryData   = $("#mobile").intlTelInput("getSelectedCountryData");
             var intlNumber    = $("#mobile").intlTelInput("getNumber");
             var country_code = countryData.dialCode;
             if(country_code == null || country_code == undefined || country_code == '')
             {
               country_code = '';
             }else if(country_code != '')
             {
             $('#country_code').val('+'+country_code);
             }else{
                $('#country_code').val(country_code);
             }
        }

        var form = this;
        var method = $(form).attr('method');
        var action = $(form).attr('action');
        var callback = $(form).find("input.callback");
        var datastring = $(form).serialize();
        var submit_btn = $(form).find('button[type=submit]');

        if (callback.length > 0) {
            callback = callback.val();
        } else {
            callback = false;
        }
        
        hideAlertFormCommon(form);
        submit_btn.attr('disabled', 'disabled');
         $(".form-control").removeClass("red_border");
        $.ajax({
            type: method,
            url: action,
            data: datastring,
            success: function (data) {
        

                var response = parse_JSON(data);
                if (callback) {
                    window[callback](response, form, submit_btn);
                } else {	 		
					if (response.status === "error") {
                        $("#msg").fadeIn('fast');
                        $("#msg").addClass('alert-danger').removeClass('alert-success');
                        $("#msg").html('Something went wrong.');
                        $('#msg').delay(1000).fadeOut(2500);
                        $("#msg").attr("tabindex", -1).focus();
                    } else if (response.status === "success") {
                        
                        $('#pid').val(response.profile_id);
                        $('#customer_id').val(response.profile_id);
						
                        
						            show_profile_header(response.profile_id);
                        //view_profile(response.profile_id,'');
            						if($("#flag").val() == 1){ 
            							$(".enquiry_form").submit();

                          
            							show_helpdesk_listing($("#pid").val());
            							show_followup_listing($("#pid").val());
            						}else{
                          $("#msg").fadeIn('fast');
                          $("#msg").addClass('alert-success').removeClass('alert-danger');
                          $("#msg").html('Saved Successfully.');
                          $('#msg').delay(1000).fadeOut(2500);
                          $("#msg").attr("tabindex", -1).focus();
                        }
                    }
                    submit_btn.removeAttr("disabled");
                }
                submit_btn.removeAttr("disabled");
            },
            error: function (data) { 
                  $("#msg").fadeIn('fast');
                  $("#msg").addClass('alert-danger').removeClass('alert-success');
                  $("#msg").html('Validation error1');
                  $('#msg').delay(1000).fadeOut(2500);
                  $("#msg").attr("tabindex", -1).focus();

                  $(".msg").show();
                  $(".msg").addClass("alert");
                  $(".msg").addClass("alert-danger");
                  $(".msg").html("Validation error");
                  setTimeout(function() {
                       $(".msg").empty();
                       $(".msg").removeClass("alert-danger");
                       $(".msg").removeClass("alert");
                  }, 3000);
                var items = [];
                var j=0;
                $.each(data.responseJSON.errors, function (i) {
                    $.each(data.responseJSON.errors, function (key, val) {
                       $("#"+key).addClass("red_border");
                       
                       if(j == 0){
                       items.push('<li>'+val+'</li>');
                       }
                       j++;
                    });
                });
                $('#msg').html(items);
                 submit_btn.removeAttr("disabled");
               
            }
        });

        return false;
    });
	     $(document).on('submit', '.form-search', function (e) { 
        e.preventDefault();

         $("#phone").intlTelInput({
             allowDropdown: false,
             autoHideDialCode: true,
             separateDialCode: true,
            });
         var countryData_search   = $("#phone").intlTelInput("getSelectedCountryData");
         var country_code_search = countryData_search.dialCode;
          if(country_code_search == null || country_code_search == undefined || country_code_search == '')
                 {
                   country_code_search = '';
                 }
              else if(country_code_search != '')
                 {
                 $('#country_cd').val('+'+country_code_search);
                     }
                 else{
                    $('#country_cd').val(country_code_search);
                 }
       
         /*  remove country flag*/
         $("#phone").intlTelInput("destroy");


        search_keywords =   $("#search_keywords").val();
        phone =   $("#phone").val();
        if(search_keywords == '' && phone == '')
            {
                $("#no_data").show();
                view_profile(0,'');
                resetResult()
                return false; 
            }

        var form = this;
        var method = $(form).attr('method');
        var action = $(form).attr('action');
        var callback = $(form).find("input.callback");
        var datastring = $(form).serialize();
        var submit_btn = $(form).find('button[type=submit]');

        if (callback.length > 0) {
            callback = callback.val();
        } else {
            callback = false;
        }
 
        hideAlertFormCommon(form);
        //submit_btn.attr('disabled', 'disabled');
        $.ajax({
            type: method,
            url: action,
            data: datastring,
            success: function (data) {
              var response = parse_JSON(data);
              var msg=response.user_det;
              var df_field=response.default_field;
             
                  if(msg)
                      {
                        $(".search-results").show();
                        $("#no_data").hide();
                        $(".res").html('');
                        var userLenght = msg.length;
                        
                        if(userLenght == 1 && typeof msg[0].id != 'undefined'){
                            var profile_id = msg[0].id
                            $(".search-results").hide();
                            view_profile(profile_id,'');
                            
                        }else if(userLenght == 0){  
                            var search_val_phone = $("#phone").val();
                            var country_cd_search_val = $("#country_cd").val();
                            var search_val = country_cd_search_val+search_val_phone;
                            if($.isNumeric(search_val_phone)){
                            view_profile(0,search_val)
                            }else{
                              view_profile(0);
                            }
                            
                        }
                        else{
                        $.each(msg, function(i, usr) 
                          {
                            var result      = "<tr id='res' class='res'>";
                              $.each(df_field, function(j, fld) 
                              {
                                var path        = '#'; 
                               
                                default_fields=fld.field_name;
                                var result_val= usr[default_fields];
                                var res=(result_val == null) ? '':result_val
                                result+="<td>"+result_val+"</td>";
                                
                              });
                              var profile_id  = (usr.id == null) ? '':usr.id;
                              result+="<td><a onclick=view_profile("+profile_id+",'') class='btn btn-default'><i class='fa fa-copy' aria-hidden='true'></i></a></td></tr>";
                              
                              $("#user_list > tbody").append(result);
                          });
                          if ($('#copy_user').is(':empty')){
                                view_profile(0,'');
                              }
                        }
                          
                      }
                      if(msg  =='' || msg == undefined || msg == null)
                      {
                          $("#no_data").show();
                          $("#no_data").html("No records matching with search keys.")
                          $(".search-results").hide();                   
                      } 
               
            },
            error: function (data) {
                  $.each(data.responseJSON.errors, function (i) {
                      $.each(data.responseJSON.errors, function (key, val) {
                         $("#"+key).addClass("red_border");
                         
                      });
                  });
                 submit_btn.removeAttr("disabled");
               
            }
        });

        return false;
    });
	 $('.form-search').submit();
     /*$(document).on('submit', '.get-profile', function (e) {
        alert()
       
     });*/


});

/*
     * get user details
     * define the method and action
     * optionally you can define a custom callback function 
     * for response handling
 */

function view_profile(profile_id,search_val)
{
        $(".search-results").hide();
        var token = $('._token').val();
        var url = $('#get_profile').val();
        var pro_status = $('#pro_status').val();
        
        if(profile_id == 0){
          var profile_id=$('#profile_id').val();
        }
        var request_mob=$('#phone').val();
        $.ajax({
            url: url,
            type: "POST",
             data: {
                "_token": token,
                "profile_id":profile_id,
                "request_mob":request_mob,
                "search_val":search_val,
                "profile_status":pro_status,
            }
        }).done(function(data){
			
			
			var response = parse_JSON(data);
			if(response.success==true)
			{
				 
        if (typeof response.html !== 'undefined' )
				{
					$('#copy_user').html(response.html);
					var util_class=$('#util_class').val();
            $("#mobile").intlTelInput({
                  separateDialCode: true,
                  utilsScript: util_class
              });
            $(".mobile").intlTelInput({
                  separateDialCode: true,
                  utilsScript: util_class
              });
            show_profile_header(response.customer_id);
           // var show_enquiry_form = $('#show_enquiry_form').val();
            //if(typeof show_enquiry_form !== typeof undefine && show_enquiry_form == 1)
            {
            
						show_enquiry_form(response.customer_id);
            }
						show_helpdesk_listing(response.customer_id);
						show_followup_listing(response.customer_id);
						show_chathistory_listing(response.customer_id);
            show_survey_listing(response.customer_id);
            show_email_sms_listing(response.customer_id);
            show_officer_email_sms_listing(response.customer_id);
				}

				
			}
			else
			{
				alertFormCommon("Result Error");
			}	
				
           
			  
			  
            
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              console.log('No response from server');
        });
}

    function resetResult()
    {
      $(".search-results").hide();
      $("#no_data").hide();
      $(".res").html('');
      $("#search_keywords").val('');
      $("#phone").val('');
    }
	
	function show_enquiry_form(customer_id){
		var url = $("#base_url").val();
    var pid = $("#pid").val();
		$.ajax({
            url: url+"/enquiry/create",
            type: "POST",
			data: { 
			"customer_id":pid
			}
        }).done(function(data){
            $("#enquiry_form_con").empty().html(data);            
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              console.log('No response from show enquiry form section');
        });
	}
	function show_profile_header(customer_id){
    var url = $("#base_url").val();
    var pid = $("#pid").val();
    $.ajax({
            url: url+"/get_profile_header",
            type: "POST",
      data: { 
      "customer_id":pid
      }
        }).done(function(data){
            $("#profile_header").empty().html(data);            
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              console.log('No response from show enquiry form section');
        });
  }
	function save_profile_enquiry(){
    $('.add_to_faq').val('0');
		$(".form-profile").submit();
	}
	
	$(document).on('click', '#save_profile_enquiry', function (e) {
		$("#flag").val(1);
		save_profile_enquiry();
	});
	
	function show_email_sms_listing(customer_id = null, type = null, limit = null){ 
        var url = $("#base_url").val();
        var pid = $("#pid").val();
        $.ajax({
            url: url+"/email_sms_listing",
            type: "POST",
            data: { 
            "customer_id":pid,
            "type":type,
            "limit":limit
            }
        }).done(function(data){ 
            $("#email_sms_listing").empty().html(data);            
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              console.log('No response from email sms listing section');
        });
    }
	function show_officer_email_sms_listing(customer_id = null, type = null, limit = null){ 
        var url = $("#base_url").val();
        var pid = $("#pid").val();
        $.ajax({
            url: url+"/officer_email_sms_listing",
            type: "POST",
            data: { 
            "customer_id":pid,
            "type":type,
            "limit":limit
            }
        }).done(function(data){ 
            $("#officer_email_sms_listing").empty().html(data);            
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              console.log('No response from escalation email listing section');
        });
    }
	function show_helpdesk_listing(customer_id = null, type = null, limit = null){ 
        var url = $("#base_url").val();
        var pid = $("#pid").val();
        $.ajax({
            url: url+"/helpdesk_listing",
            type: "POST",
            data: { 
            "customer_id":pid,
            "type":type,
            "limit":limit
            }
        }).done(function(data){ 
            $("#helpdesk_listing").empty().html(data);
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              console.log('No response from helpdesk listing section');
        });
    }
  function show_survey_listing(customer_id = null){ 
        var url = $("#base_url").val();
        var pid = $("#pid").val();
        var p_survey_id = $("#p_survey_id").val(); 
        
        $.ajax({
            url: url+"/survey_in_profile",
            type: "POST",
            data: { 
            "customer_id":pid,
            "p_survey_id":p_survey_id
            
            }
        }).done(function(data){ 
            $("#survey_listing").empty().html(data);            
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              console.log('No response from survey listing section');
        });
    }	
	function show_chathistory_listing(customer_id = null){ 
        var url = $("#base_url").val();
        var pid = $("#pid").val();
        $.ajax({
            url: url+"/chathistory_listing",
            type: "POST",
            data: { 
            "customer_id":pid,
            }
        }).done(function(data){ 
            $("#chathistory_listing").empty().html(data);            
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              console.log('No response from chathistory listing section');
        });
    }
	
	function show_followup_listing(customer_id = null, type = null, limit = null){
		var url = $("#base_url").val();
		var pid = $("#pid").val();
		$.ajax({
            url: url+"/followup_listing",
            type: "POST",
			data: { 
			"customer_id":pid,
      "type":type,
			"limit":limit
			}
        }).done(function(data){ 
            $("#followup_listing").empty().html(data);            
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              console.log('No response from followup listing section');
        });
	}
  function show_listing(){
    //show_enquiry_form();

    show_officer_email_sms_listing();
    show_email_sms_listing();
    show_helpdesk_listing();
    show_followup_listing();
    show_chathistory_listing();
    show_survey_listing();
  }
	$(document).on('change', '.sort_helpdesk', function(){
		show_helpdesk_listing(null, $(this).val());
	});
	$(document).on('change', '.sort_followup', function(){
		show_followup_listing(null, $(this).val());
	});
	$(document).on('click', '.date_time_picker', function(){
		$(this).datetimepicker({
			inline: true,
			format: 'DD/MM/YYYY hh:mm:A',
		});   

	});

  $(document).on('click', '#faqadd', function (e) {
      var query_type = $("#query_type").val(); 
      var query_category = $("#query_category").val(); 
      var req_title = $("#req_title").val(); 
      var question = tinymce.get('question').getContent(); 
      var answer = tinymce.get('answer').getContent(); 
      var url = $("#base_url").val();
      $.ajax({
            url: url+"/add_faq/",
            type: "POST",
            data: { 
              "query_type":query_type,
              "query_category":query_category,
              "req_title":req_title,
              "question":question,
              "answer":answer
            }
        }).done(function(data){ 
            console.log("success");          
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              console.log('Fail');
        });
  });

  function add_more_btn(tabid,tabname) {
    
        var url = $("#base_url").val();
        var i = $('.'+tabname).val();
        $.ajax({
            url: url+"/more_profile_fields/",
            type: "POST",
            data: { 
              "i": i,
              "tabid":tabid
            }
        }).done(function(data){ 
           $(".add_more"+tabname).append(data);
           i++;
           $('.'+tabname).val(i);    
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              console.log('Fail');
        });

        
    } 


       function upload_profile_pic(){ 
       var attachmentCount = $('.ajax-file-upload-statusbar').length;
      if (attachmentCount > 0)
      {
   
        uploadObj_attachment.startUpload();
       
      
        
        return;
      }else{

      $(".form-profile").submit();
      }
    }
       function upload_profile(){ 
       var attachmentCount = $('.ajax-file-upload-statusbar').length;
      if (attachmentCount > 0)
      {
        uploadObj_profilepic.startUpload();
       
       
      
        
        return;
      }
    }
      function get_email_sms_details(id) {
        $.ajax({
            type: "POST",
            url: "/get_email_sms_detail",
            dataType: "json",
            data: {
                "id": id,


            },
           success: function(msg){
             $('#popupContainer').show();
              var content = msg.subject;
                var subject = '';
                content = msg.content;
                subject = msg.subject;
                var content = msg.content;
                content = content.replace(/\+/g, " ");
                $("#descrip").empty().html(content);
                $("#subject_email").empty().html(subject);
                var c_date = msg.created_at;
                var opened_count = msg.sendgrid_open_response.length;
                var last_action_time = msg.updated_at;
                var delivered_response = msg.sendgrid_delivered_response;
                var delivered_time = null;
                if (delivered_response != null)
                {
                  delivered_time = delivered_response.created_at;
                }
                var delivery_history = msg.sendgrid_response;
                $("ul.timeline").empty();
                delivery_history.forEach(function(delivery_his) {
                  $("ul.timeline").append('<li class="timeline-list clearfix"><h4>'+delivery_his.event.charAt(0).toUpperCase()+delivery_his.event.slice(1)+'</h4><span>'+delivery_his.created_at+'</span></li>');
                });
                $("ul.timeline").append('<li class="timeline-list clearfix"><h4>Queued</h4><span>'+msg.created_at+'</span></li>');
                var newDate;
                var lastActionTime;
                var deliveredTime;
                if (c_date != null) {
                    date = new Date(c_date);
                    year = date.getFullYear();
                    month = date.getMonth() + 1;
                    dt = date.getDate();
                    hr = date.getHours();
                    mi = date.getMinutes();
                    se = date.getSeconds();

                    if (dt < 10) {
                        dt = '0' + dt;
                    }
                    if (month < 10) {
                        month = '0' + month;
                    }
                    if (hr < 10)
                    {
                      hr = '0' + hr;
                    }
                    if (mi < 10)
                    {
                      mi = '0' + mi;
                    }
                    if (se < 10)
                    {
                      se = '0' + se;
                    }

                    newDate = dt + '/' + month + '/' + year + ' ' + hr + ':' + mi + ':' + se;
                } else {
                    newDate = '-NA-';
                }
                if (last_action_time != null) {
                    date = new Date(last_action_time);
                    year = date.getFullYear();
                    month = date.getMonth() + 1;
                    dt = date.getDate();
                    hr = date.getHours();
                    mi = date.getMinutes();
                    se = date.getSeconds();

                    if (dt < 10) {
                        dt = '0' + dt;
                    }
                    if (month < 10) {
                        month = '0' + month;
                    }
                    if (hr < 10)
                    {
                      hr = '0' + hr;
                    }
                    if (mi < 10)
                    {
                      mi = '0' + mi;
                    }
                    if (se < 10)
                    {
                      se = '0' + se;
                    }

                    lastActionTime = dt + '/' + month + '/' + year + ' ' + hr + ':' + mi + ':' + se;
                } else {
                    lastActionTime = '-NA-';
                }
                if (delivered_time != null) {
                    date = new Date(delivered_time);
                    year = date.getFullYear();
                    month = date.getMonth() + 1;
                    dt = date.getDate();
                    hr = date.getHours();
                    mi = date.getMinutes();
                    se = date.getSeconds();

                    if (dt < 10) {
                        dt = '0' + dt;
                    }
                    if (month < 10) {
                        month = '0' + month;
                    }
                    if (hr < 10)
                    {
                      hr = '0' + hr;
                    }
                    if (mi < 10)
                    {
                      mi = '0' + mi;
                    }
                    if (se < 10)
                    {
                      se = '0' + se;
                    }

                    deliveredTime = dt + '/' + month + '/' + year + ' ' + hr + ':' + mi + ':' + se;
                } else {
                    deliveredTime = '-NA-';
                }
                $("#opened_count").empty().html(opened_count);
                $("#last_action_time").empty().html(lastActionTime);
                $("#created_date").empty().html(newDate);
                $("#delivered_time").empty().html(deliveredTime);
                $("#initiated_time").empty().html(newDate);
                if (msg.sent_type == 2)
                {
                  $('#delivery-report-divider').show();
                  $('#delivery-report-wrapper').show();
                  $('#delivery-history-divider').show();
                  $('#delivery-history-wrapper').show();
                }
                else
                {
                  $('#delivery-report-divider').hide();
                  $('#delivery-report-wrapper').hide();
                  $('#delivery-history-divider').hide();
                  $('#delivery-history-wrapper').hide();
                }
            }
        });
  }
