/* 
 * Common js function and global variables
 */
$.ajaxSetup({ 
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
var page_refresh = function () {
    window.location.reload(true);
};
var page_redirect = function ($page) {
    window.location = $page;
};
var parse_JSON = function (data) {
    try {
        var obj = JSON && JSON.parse(data) || $.parseJSON(data);
        return obj;
    } catch (e) {
        // not json
        console.log(data);
        alert("Oops, it looks like there is an issue, we are looking to fix it");
        return false;
    }

};
var update_part = function ($target, $elem) {
    $.ajax({
        type: "POST",
        url: $target,
        success: function (data) {
            $($elem).html(data);
        },
        error: function () {
            return false;
        }
    });
};
var hideAlertFormCommon = function ($form) {
   // $.magnificPopup.close();
};
var hideProgressModal = function () {
   // $.magnificPopup.close();
};
var alertFormCommon = function ($str, $form) {
    hideProgressModal();
    $("#alert-modal .message").html($str);
    /*$.magnificPopup.open({
        items: {
            src: '#alert-modal'
        },
        type: 'inline',
        preloader: false,
        modal: true
    });*/
};

var form_basic_reload = function (response, form, submit_btn) {

    if (response.status === "error") {
        alertFormCommon(response.message, form);
    } else if (response.status === "success") {
        alertFormCommon(response.message, form);
        $(form)[0].reset();
        window.location.reload();
    }
    submit_btn.removeAttr("disabled");
};

var form_basic_no_reload = function (response, form, submit_btn) {

    if (response.status === "error") {
        alertFormCommon(response.message, form);
    } else if (response.status === "success") {
        alertFormCommon(response.message, form);
        $(form)[0].reset();
    }
    submit_btn.removeAttr("disabled");
};

var form_basic_redirect = function (response, form, submit_btn) {

    if (response.status === "error") {
        alertFormCommon(response.message, form);
    } else if (response.status === "success") {
        alertFormCommon(response.message, form);
        $(form)[0].reset();
        var redirect_url = $(form).find("input.callback-path").val();
		
		if (typeof response.company_id !== 'undefined' )
		{
			var redirect_url =	redirect_url+'/'+response.months+'/'+response.plan+'/'+response.amount+'/'+response.company_id+'/'+response.percent_off+'/'+response.off_amt+'/'+response.coup_amt+'/'+response.coupon;
		}
		
        window.location = redirect_url;
    }
    submit_btn.removeAttr("disabled");
};

 function selected_check_box_pagination(response, form, submit_btn)
	{
		/*if(global_select_all_id == 1)
		{ 
		  $('.selectall1').prop('checked', true);
		  $('.selectall1').prop('checked', true);
		  $('.case').each(function() { 
						this.checked = true;  });

		  $.each(global_exclude_arr,function(i,d){
				  $('#customer_id'+d).prop('checked', false); 
				});
		}else{ 
		  $('.case').each(function() { 
						this.checked = false; 
		   });
		}*/
		
		 if(global_select_all_id == 1)
            { 
              $('.selectall1').prop('checked', true);
              $('.selectall1').prop('checked', true);
              $('.case').each(function() { 
                            this.checked = true;  });


              var arr = global_exclude_arr;
             // console.log(global_exclude_arr)
              jQuery.each(arr, function() {
                  var value = this;
                  $('input:checkbox[value="' + value + '"]').prop('checked', false);
              });

            }else{ 
              $('.case').each(function() { 
                            this.checked = false; 
               });

              console.log(global_include_arr)
              var arr1 = global_include_arr;
              
              jQuery.each(arr1, function() {
                  var value = this;
                  $('input:checkbox[value="' + value + '"]').prop('checked', true);
              });

            }	
		
	}
					/** function for loader show and hide starts **/
					
	function showLoader()
    {
		$('.loader-container').show();
        $('.loader-container').preloader({
            zIndex: 1000,
            setRelative: false
        });
        $('.loader-back').show();
    }
                   
				   
	function hideLoader()
    {
		$('.loader-container').preloader('remove');
        $('.loader-container').hide();
        $('.loader-back').hide();
    }

						/** loader function ends **/	
$(document).ready(function () {
	
listNotifications();
updateUnreadCount();

setInterval(function(){ updateUnreadCount(); }, 10000);
setInterval(function(){ listNotifications(); }, 10000);



    /*
     * Just add the .form-common class on the form you want to submit
     * define the method and action
     * optionally you can define a custom callback function 
     * for response handling
     */
    $(document).on('submit', '.form-common', function (e) {
        e.preventDefault();
		showLoader();
        var form = this;

		if($(form).hasClass('tinymce')){
			tinyMCE.triggerSave();
		}
		
		
		if($(form).hasClass('frmcoutycode')){
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
console.log('formname'+name);
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
	/* 	   var page2 = $("#pageno2").val();
		if (typeof page2 !== 'undefined' )
		{
            if (typeof pageReset !== typeof undefined && pageReset !== 'false')
            {
                page2 = 1;
                $("#pageno2").val(page2);
            }
			action2 = action2+'?page2='+page2;
		 	action = action2;
		} */  
        hideAlertFormCommon(form);
        submit_btn.attr('disabled', 'disabled');
        reset_btn.attr('disabled', 'disabled');
        submit_btn.html('Please wait..');
		$( form ).find(".form-control").removeClass("red_border");
		$( form ).find(".form-control").removeClass("text-danger");
        $( form ).find("span.error").empty();


        add_to_faq =  $( form ).find("#add_to_faq").val();
        if(add_to_faq == '1'){
             var url = $("#base_url").val();
            var action = url+"/add_faq";
        }


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
						$( form ).find("#totalcount").html('('+totalcount+')');
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
                        $('#deleteRecord').modal('hide');
                        $('#activateRecord').modal('hide');

						/*$( form ).find(".message").addClass("alert");
						$( form ).find(".message").addClass("alert-success");
						$( form ).find('.message').html(response.message);

                        setTimeout(function() {
                            $( form ).find(".message").empty();
                            $( form ).find(".message").removeClass("alert-success");
                            $( form ).find(".message").removeClass("alert");
                            $('#deleteRecord').modal('hide');
                            $('#activateRecord').modal('hide');
                        }, 3000);*/
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
					
					if (typeof response.plan_id !== 'undefined' )
					{
						$('.plan_id').val(response.plan_id)
					}
				
                    if (response.refresh == true)
                    {
                        $('.listing').submit();
                    }
					
				}
				else if(response.success==false)
				{ 
					

					if (typeof response.message !== 'undefined' )
					{

                        $("#msg").fadeIn('fast');
                        $("#msg").addClass('alert-danger').removeClass('alert-success');
                        $("#msg").html(response.message);
                        $('#msg').delay(1000).fadeOut(2500); 

                        /*$( form ).find(".message").addClass("alert");
						$( form ).find(".message").addClass("alert-danger");
						$( form ).find('.message').html(response.message);
                        $( form ).find('.message').html(response.message);
                        setTimeout(function() {
                            $( form ).find(".message").empty();
                            $( form ).find(".message").removeClass("alert-danger");
                            $( form ).find(".message").removeClass("alert");
                        }, 3000);*/
					}else{
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
					
				}
				else
				{
					//alertFormCommon("Result Error");
				}
                submit_btn.removeAttr("disabled");
                reset_btn.removeAttr("disabled");
                submit_btn.html('Submit');
                $(form).removeAttr('page-reset');
                /* Hide pop-up after submiting form */
                if($( form ).hasClass('hide_modal')){ 
                    var modal_name = $('.modal_name').val();
                    $("#"+modal_name).modal('hide'); 
                }
				if (callback) { //show_helpdesk_listing(response, form, submit_btn);
                    if(arg == 0){
                        window[callback]();
                    }else{
                        window[callback](response, form, submit_btn);
                    }
                }
				hideLoader();		
            },
            error: function (data) {  

                $("#msg").fadeIn('fast');
                $("#msg").addClass('alert-danger').removeClass('alert-success');
                $("#msg").html('Validation Error.');
                $('#msg').delay(1000).fadeOut(2500);

                /*$( form ).find(".message").addClass("alert");
                        $( form ).find(".message").addClass("alert-danger");
                        $( form ).find('.message').html("Validation error");

                        setTimeout(function() {
                            $( form ).find(".message").empty();
                            $( form ).find(".message").removeClass("alert-danger");
                            $( form ).find(".message").removeClass("alert");
                        }, 3000);*/

				$.each(data.responseJSON.errors, function (i) {

                    $.each(data.responseJSON.errors, function (key, val) {
                       /*$("#"+form_id+" #"+key).addClass("red_border");
                       $("#"+form_id+" #"+key).addClass("text-danger");
                       $("#"+form_id+" #"+key+'_err').html(val);*/


                        $( form ).find("#"+key).addClass("red_border");
                        $( form ).find("#"+key).addClass("text-danger");
                        $( form ).find("#"+key+'_err').html(val);
                       
                    });
                });
                submit_btn.removeAttr("disabled");
                reset_btn.removeAttr("disabled");
                submit_btn.html('Submit');
                $(form).removeAttr('page-reset');
				hideLoader();
            }
        });

        return false;
    });
	
	
	$(document).on('submit', '.form-upload', function (e) {
        e.preventDefault();
        var form = this;
        
        if($(form).hasClass('tinymce')){
            tinyMCE.triggerSave();
        }

        var form = this;
        var form_id = $(form).attr('id');
        var method = $(form).attr('method');
        var action = $(form).attr('action');
        var name = $(form).attr('name');
        var callback = $(form).find("input.callback");
        var arg     = $(form).find("input.arg").val();
        var datastring = new FormData(this);
        var submit_btn = $(form).find('button[type=submit]');
        var submit_btn = $(form).find('button[type=submit]');
        var reset_btn = $(form).find('button[type=reset]');
        var page_reset = $(form).attr('page-reset');
        console.log('formname'+name);

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

        add_to_faq =  $( form ).find("#add_to_faq").val();
        if(add_to_faq == '1'){
            var url = $("#base_url").val();
            var action = url+"/add_faq";
        }
        $.ajax({
            type: method,
            url: action,
            data: datastring,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                //var response = parse_JSON(data);
				var response = data;
                if(response.success==true)
                {
                     
                    if (typeof response.html !== 'undefined' )
                    {
                        $('#list').html(response.html);
                        totalcount = $("#list_count").val();
                        $( form ).find("#totalcount").html('('+totalcount+')');
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


                        /*$( form ).find(".message").addClass("alert");
                        $( form ).find(".message").addClass("alert-success");
                        $( form ).find('.message').html(response.message);

                        setTimeout(function() {
                            $( form ).find(".message").empty();
                            $( form ).find(".message").removeClass("alert-success");
                            $( form ).find(".message").removeClass("alert");
                            $('#deleteRecord').modal('hide');
                            $('#activateRecord').modal('hide');
                        }, 3000);*/
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
                    
                }
                else if(response.success==false)
                { 
                    

                    if (typeof response.message !== 'undefined' )
                    {

                        $("#msg").fadeIn('fast');
                        $("#msg").addClass('alert-danger').removeClass('alert-success');
                        $("#msg").html('Something went wrong.');
                        $('#msg').delay(1000).fadeOut(2500); 

                        /*$( form ).find(".message").addClass("alert");
                        $( form ).find(".message").addClass("alert-danger");
                        $( form ).find('.message').html(response.message);
                        $( form ).find('.message').html(response.message);
                        setTimeout(function() {
                            $( form ).find(".message").empty();
                            $( form ).find(".message").removeClass("alert-danger");
                            $( form ).find(".message").removeClass("alert");
                        }, 3000);*/
                    }
                     if (response.reset != false)
                        {
                            form.reset();
                        }
                    if (response.refresh == true)
                    {
                        $('.listing').submit();
                    }
                    
                }
                else
                {
                    //alertFormCommon("Result Error");
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
            },
            error: function (data) {  

                $("#msg").fadeIn('fast');
                $("#msg").addClass('alert-danger').removeClass('alert-success');
                $("#msg").html('Validation Error.');
                $('#msg').delay(1000).fadeOut(2500);

                /*$( form ).find(".message").addClass("alert");
                        $( form ).find(".message").addClass("alert-danger");
                        $( form ).find('.message').html("Validation error");

                        setTimeout(function() {
                            $( form ).find(".message").empty();
                            $( form ).find(".message").removeClass("alert-danger");
                            $( form ).find(".message").removeClass("alert");
                        }, 3000);*/

                $.each(data.responseJSON.errors, function (i) {

                    $.each(data.responseJSON.errors, function (key, val) {
                       /*$("#"+form_id+" #"+key).addClass("red_border");
                       $("#"+form_id+" #"+key).addClass("text-danger");
                       $("#"+form_id+" #"+key+'_err').html(val);*/


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
	
	$(document).on('click', '.popup-modal-dismiss', function (e) {
        //$.magnificPopup.close();
    });

    $(document).on('click', 'button[type="reset"]', function (e) {
        var form = $(this).closest("form");
        $( form ).find(".form-control").removeClass("red_border");
        $( form ).find(".form-control").removeClass("text-danger");
        $( form ).find("span.error").empty();
    });
	
  $('body').on('click', '.first .pagination a', function(e) {
                e.preventDefault();


                var pagination = $(this).attr('href');
				var fields = pagination.split('?page=');

				var url = fields[0];
				var page = fields[1];
				$("#pageno").val(page);
				$('.listing').submit();
            });
	
	 		
	$('body').on('click', '.second .pagination a', function(e) {
                e.preventDefault();

				  var pagination = $(this).attr('href');
				var fields = pagination.split('?page=');

				var url = fields[0];
				var page = fields[1];
				$("#pageno").val(page); 
				$('.listing2').submit();
            }); 
  
	$('.listing').submit();
    //If you need to reset pageno of a listing page on an element click (for eg. find button), add a class "reset-pageno" to the element
    $('.reset-pageno').on('click', function() {
        $('.listing').attr('page-reset', 'true');
    });
	
	//common function for showing datepicker
	
/* 	$('.date_time_picker').datepicker({
			format: 'DD/MM/YYYY hh:mm:A',
	}); */
	
	/* $(".date_picker.date_time_picker").live("click", function(){
		$(this).datepicker({ 
			format: 'dd/mm/yy',
			inline: true
		});
	}); */
	$('.date_picker').datepicker({
			dateFormat: 'dd/mm/yy'
			/* changeMonth: true,
            changeYear: true,
            
			showMonthAfterYear: true,
            onSelect: function (selected) {
			//var dt = new Date(selected);
            var from = selected.split("/");
           var f = new Date( from[1] - 1,from[2], from[0]);
		   var f;
            var dt = new Date(f);
            dt.setDate(dt.getDate());
            ('.date_picker').datepicker("option", "minDate", dt);
            
        } ,
        onChangeMonthYear: function (year, month, inst) {
            var selectedMonth = parseInt(inst.selectedMonth)+1;
            if(selectedMonth < 10)
            {
                var temp = "0"+selectedMonth;
            }
            else
            {
                var temp = selectedMonth;
            }
            if(inst.selectedDay < 10)
            {
                var temp1 = "0"+inst.selectedDay;
            }
            else
            {
                var temp1 = inst.selectedDay;
            }
        ('.date_picker').val(temp1+"/"+temp+"/"+inst.selectedYear);
        } */ 
        }); 
	
});

	/* $(".date_time_picker").live("click", function(){
		$(this).datepicker({ 
			format: 'dd/mm/yy',
			inline: true
		});
	}); */


/* 	jQuery(window).on(function(){
		applyDatePicker();   
	});

	function applyDatePicker(){
		jQuery(".date_time_picker").datepicker({
			inline: true,
			dateFormat: 'dd-mm-YY'
		});   

	}; */

   
function ressetListForm()
{
    document.forms["form-common"].reset();
}
function ressetListForm_withCountBox()
{
    document.forms["form-common"].reset();
	$('.query_status').empty();
	$('.query_status').append("<option value='0'>Select Status</option>");
}

//common function for showing popup for deletion
function deletePop(actionUrl, id = null)
{	
    $("#deleteRecord form").attr('action', actionUrl);
	$("#deleteRecord #id").val(id);
	$('#deleteRecord').modal({backdrop: false, keyboard: false});
}
function activatePop(actionUrl, categoryid = null,type=null)
{   
    $("#activateRecord form").attr('action', actionUrl);
    $("#activateRecord #categoryid").val(categoryid);
    if(type != null)
    {
        $("#activateRecord #type").val(type);
    }
    $('#activateRecord').modal({backdrop: false, keyboard: false});
}
$(document).on('change', '.get_query_cat', function(){ 
    $(".opt_field").hide();
    var short_code = $(this).find(':selected').data('short-code');
    if(short_code != ''){ $("."+short_code).show(); }

    var query_type = $(this).find(':selected').data('type');
    if(query_type == 1){
        $(".escalate_box").show();
    }else{
        $(".escalate_box").hide();
    }
    var con = "#"+$(this).closest("form").attr('id')+" ";
    var url = $("#base_url").val();
    var query_type = $(this).val();
     //var form = $(this).parent('form').get(0);

   // alert(form); 
    $.ajax({
        url: url+"/get_category",
        type: "POST",
        data: { 
            "query_type":query_type
        },
        dataType: "json",
    }).done(function(data){
        if (data != 0) {        
            $(con+'.faq_cat_id').empty();
            $(con+'.faq_cat_id').append("<option value=''>Select Category</option>");
            $.each(data, function(i, d) { 
                var opt = $('<option />');
                    opt = "<option data-short-code='"+d.short_code+"' value='" + d.id + "'>" + d.category_name + " </option>";
                $(con+'.faq_cat_id').append(opt);
            });
        } else {
            $(con+'.faq_cat_id').empty();
            $(con+'.faq_cat_id').append("<option value=''>Select Category</option>");
        }
    }).fail(function(jqXHR, ajaxOptions, thrownError){
          console.log('No response from show enquiry form section');
    });
});
$(document).on('change', '.get_sub_category', function(){ 
    $(".opt_field").hide();
    var short_code = $(this).find(':selected').data('short-code');
    if(short_code != ''){ $("."+short_code).show(); }
    
	var con = "#"+$(this).closest("form").attr('id')+" ";
	var url = $("#base_url").val();
	var parent_category_id = $(this).val();
        var query_type = $(con+'.get_query_cat').val();
	 //var form = $(this).parent('form').get(0);

   // alert(form); 
	$.ajax({
		url: url+"/get_sub_category",
		type: "POST",
		data: { 
			"query_type":query_type,
			"parent_category_id":parent_category_id
		},
		dataType: "json",
	}).done(function(data){
		if (data != 0) { 		
			$(con+'.sub_cat_id').empty();
			$(con+'.sub_cat_id').append("<option value=''>Select Sub Category</option>");
			$.each(data, function(i, d) { 
				var opt = $('<option />');
					opt = "<option value='" + d.id + "'>" + d.category_name + " </option>";
				$(con+'.sub_cat_id').append(opt);
			});
		} else {
			$(con+'.sub_cat_id').empty();
			$(con+'.sub_cat_id').append("<option value=''>Select Sub Category</option>");
		}
	}).fail(function(jqXHR, ajaxOptions, thrownError){
		  console.log('No response from get_sub_category section');
	});
});
$(document).on('change', '.get_query_status', function(){
	var con = "#"+$(this).closest("form").attr('id')+" ";
	var url = $("#base_url").val();
	var query_type = $(this).val();

	$.ajax({
		url: url+"/get_query_status",
		type: "POST",
		data: { 
			"query_type":query_type
		},
		dataType: "json",
	}).done(function(data){
		if (data != 0) { 		
			$(con+'.query_status').empty();
			$(con+'.query_status').append("<option value=''>Select Status</option>");
			$.each(data, function(i, d) { 
				var opt = $('<option />');
						opt = "<option value='" + d.id + "'>" + d.name + " </option>";
				$(con+'.query_status').append(opt);
			});
		} else {
			$(con+'.query_status').empty();
			$(con+'.query_status').append("<option value=''>Select Status</option>");
		}
	}).fail(function(jqXHR, ajaxOptions, thrownError){
		  console.log('No response from show enquiry form section');
	});
});

$(document).on('change', '.get_users', function(){
	var con = "#"+$(this).closest("form").attr('id')+" ";
	var url = $("#base_url").val();
	var role_type = $(this).val();
	$.ajax({
		url: url+"/get_users_by_role",
		type: "POST",
		data: { 
			"role_type":role_type
		},
		dataType: "json",
	}).done(function(data){
		if (data != 0) { 		
			$(con+'.escalate_to').empty();
			$(con+'.escalate_to').append("<option value=''>Select User</option>");
			$.each(data, function(i, d) { 
				var opt = $('<option />');
					opt = "<option value='" + d.id + "'>" + d.name + " </option>";
				$(con+'.escalate_to').append(opt);
			});
		} else {
			$(con+'.escalate_to').empty();
			$(con+'.escalate_to').append("<option value=''>Select User</option>");
		}
	}).fail(function(jqXHR, ajaxOptions, thrownError){
		  console.log('No response from show users by role section');
	});
});
function refresh()
{
    $('.listing').submit();
}


function showNotifications() { 
    //var x = document.getElementById("show_notifications");
    //x.className = "show";
   // setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}

function listNotifications()
{
	var url = $("#base_url").val();
	$.ajax({
		url: url+"/get_notifications",
		type: "POST",
		data: { 
		
		},
	}).done(function(data){
		var obj = JSON.parse(data);
		//alert(obj.length);
		$('#notification_list').empty();
		for(var i=0;i<obj.length;i++)
		{
			var title = obj[i].title;
			var comment = obj[i].comment;
			var links = obj[i].link;
			var download_flag = obj[i].download_flag;
			if(links!=null)
			{
				if(download_flag==1)
				{
					$('#notification_list').append("<li class='nav-item'><a class='dropdown-item' href="+links+" download><span class='d-block'>"+title+"</span><small>"+comment+"</small></a></li>");
				}
				else
				{
					$('#notification_list').append("<li class='nav-item'><a class='dropdown-item' href="+links+" ><span class='d-block'>"+title+"</span><small>"+comment+"</small></a></li>");
				}
				
			}
			else
			{
				$('#notification_list').append("<li class='nav-item'><span class='dropdown-item'><span class='d-block'>"+title+"</span><small>"+comment+"</small></span></li>");
			}
			
		}
		$('#notification_list').append("<li class='nav-item'><a class='dropdown-item' href="+url+"/notifications><small>View More</small></a></li>");
	}).fail(function(jqXHR, ajaxOptions, thrownError){
		  console.log('failure');
	});
}

function updateUnreadCount()
{
	var url = $("#base_url").val();
	$.ajax({
		url: url+"/update_unreadcount",
		type: "POST",
		data: { 
		
		},
	}).done(function(data){
		//alert(data);
		if(data>0)
		{
			$('#unread_count').html(data);
			$( ".notification span").css( "display", "block" );
		}
		else
		{
			$('#unread_count').html("");
			$( ".notification span" ).css( "display", "none" );
		}
	}).fail(function(jqXHR, ajaxOptions, thrownError){
		  console.log('failure');
	});
}

function markAsRead()
{
	var url = $("#base_url").val();
	$.ajax({
		url: url+"/read_notification_status",
		type: "POST",
		data: { 
		
		},
	}).done(function(data){
		console.log("updated");
	}).fail(function(jqXHR, ajaxOptions, thrownError){
		  console.log('failure');
	});
}
function summary_count_click(type,status1,con)
{
	//var con = "#"+$(this).closest("form").attr('id')+" ";
	var con = "#"+con+" ";
	var url = $("#base_url").val();
	$.ajax({
		url: url+"/get_query_status",
		type: "POST",
		data: { 
			"query_type":type
		},
		dataType: "json",
	}).done(function(data){
		if (data != 0) { 		
			//$('.query_status').empty();
			$(con+'#query_status').empty();
			$(con+'#query_status').append("<option value=''>Select Status</option>");
			$.each(data, function(i, d) { 
				var opt = $('<option />');
					if (d.id == status1) {
                            opt = "<option value='" + d.id + "' selected>" + d.name + " </option>";
                        } else {
                            opt = "<option value='" + d.id + "'>" + d.name + " </option>";
                        }
						
				$(con+'#query_status').append(opt);
			});
		} else {
			$(con+'#query_status').empty();
			$(con+'#query_status').append("<option value=''>Select Status</option>");
		}
		$('#query_types').val(type);
		$('#esc_status').val(1);
		$('.listing').submit();

}).fail(function(jqXHR, ajaxOptions, thrownError){
		 
	});

}
$(document).on('change', '.get_dept_designation', function(){
	var con = "#"+$(this).closest("form").attr('id')+" ";
	var url = $("#base_url").val();
	var query_type = $(this).val();
	$.ajax({
		url: url+"/get_dept_designation",
		type: "POST",
		data: { 
			"query_type":query_type
		},
		dataType: "json",
	}).done(function(data){
		if (data != 0) { 		
			$(con+'.designation').empty();
			$(con+'.designation').append("<option value=''>Select Designation</option>");
			$.each(data, function(i, d) { 
				var opt = $('<option />');
						opt = "<option value='" + d.id + "'>" + d.designation + " </option>";
				$(con+'.designation').append(opt);
			});
		} else {
			$(con+'.designation').empty();
			$(con+'.designation').append("<option value=''>Select Designation</option>");
		}
	}).fail(function(jqXHR, ajaxOptions, thrownError){
		  console.log('No response from registration form section');
	});
});
$(document).ready(function(e) {
	$('.count').each(function() {
		$(this).prop('Counter', 0).animate({
			Counter: $(this).text()
		}, {
			duration: 5000,
			easing: 'swing',
			step: function(now) {
				$(this).text(Math.ceil(now));
			}
		});
	});
});