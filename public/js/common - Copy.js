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
        window.location = redirect_url;
    }
    submit_btn.removeAttr("disabled");
};

$(document).ready(function () {
    /*
     * Just add the .form-common class on the form you want to submit
     * define the method and action
     * optionally you can define a custom callback function 
     * for response handling
     */
    $(document).on('submit', '.form-common', function (e) {
        e.preventDefault();
        var form = this;
		if($(form).hasClass('tinymce')){
			tinyMCE.triggerSave();
		}
        var method = $(form).attr('method');
        var action = $(form).attr('action');
        var name = $(form).attr('name');
        var callback = $(form).find("input.callback");
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
						$( form ).find("#totalcount").html('('+totalcount+')');
					}
					if (typeof response.html2 !== 'undefined' )
					{
						$('#list2').html(response.html2);
						//totalcount = $("#list_count").val();
						//$( form ).find("#totalcount").html('('+totalcount+')');
					}
					if (typeof response.message !== 'undefined' )
					{
						$(".message").addClass("alert");
						$(".message").addClass("alert-success");
						$('.message').html(response.message);

                        setTimeout(function() {
                            $(".message").empty();
                            $(".message").removeClass("alert-success");
                            $(".message").removeClass("alert");
                            $('#deleteRecord').modal('hide');
                        }, 3000);
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
						$(".message").addClass("alert");
						$(".message").addClass("alert-danger");
						$('.message').html(response.message);

                        setTimeout(function() {
                            $(".message").empty();
                            $(".message").removeClass("alert-danger");
                            $(".message").removeClass("alert");
                        }, 3000);
					}
                    if (response.refresh == true)
                    {
                        $('.listing').submit();
                    }
					
				}
				else
				{
					alertFormCommon("Result Error");
				}

                submit_btn.removeAttr("disabled");
                reset_btn.removeAttr("disabled");
                submit_btn.html('Submit');
                $(form).removeAttr('page-reset');
				 if (callback) {
                    window[callback](response, form, submit_btn);
                } 
            },
            error: function (data) {
				$.each(data.responseJSON.errors, function (i) {
                    $.each(data.responseJSON.errors, function (key, val) {
                       $("#"+key).addClass("red_border");
                       $("#"+key).addClass("text-danger");
                       $("#"+key+'_err').html(val);
                       
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
	
	
	$(document).on('submit', '.form-upload', function (e) {
        e.preventDefault();

        var form = this;
        var method = $(form).attr('method');
        var action = $(form).attr('action');
        var callback = $(form).find("input.callback");
        var datastring = new FormData(this);
        var submit_btn = $(form).find('button[type=submit]');
        var page_reset = $(form).attr('page-reset');

        if (callback.length > 0) {
            callback = callback.val();
        } else {
            callback = false;
        }

        hideAlertFormCommon(form);
        submit_btn.attr('disabled', 'disabled');
		submit_btn.html('Please wait..');
        $.ajax({
            type: method,
            url: action,
            data: datastring,
			cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                var response = parse_JSON(data);
				console.log(data
				);
                        console.log(response);
                if (callback) {
                    window[callback](response, form, submit_btn);
                } else {
					//console.log(response.message);
					if (response.status === "error") {
                        alertFormCommon(response.message, form);
                    } else if (response.status === "success") {
						$(form)[0].reset();
                        alertFormCommon(response.message, form);
                    }
                    submit_btn.removeAttr("disabled");
                }
				submit_btn.html('Submit');
            },
            error: function () {
                alertFormCommon("Oops! it looks like there is an issue. We are looking to fix it", form);
                submit_btn.removeAttr("disabled");
            }
        });

        return false;
    });
	
	$(document).on('click', '.popup-modal-dismiss', function (e) {
		//$.magnificPopup.close();
	});
	
  $('body').on('click', '.pagination a', function(e) {
                e.preventDefault();


                var pagination = $(this).attr('href');
				var fields = pagination.split('?page=');

				var url = fields[0];
				var page = fields[1];
				$("#pageno").val(page);
				$('.listing').submit();
            });
  
	$('.listing').submit();
    
    //If you need to reset pageno of a listing page on an element click (for eg. find button), add a class "reset-pageno" to the element
    $('.reset-pageno').on('click', function() {
        $('.listing').attr('page-reset', 'true');
    });

	
});
function ressetListForm()
{
    document.forms["form-common"].reset();
	
}

//common function for showing popup for deletion
function deletePop(actionUrl, id = null)
{	
    $("#deleteRecord form").attr('action', actionUrl);
	$("#deleteRecord #id").val(id);
	$('#deleteRecord').modal({backdrop: false, keyboard: false});
}

$(document).on('change', '.get_query_cat', function(){
	var url = $("#base_url").val();
	var query_type = $(this).val();
	$.ajax({
		url: url+"/get_category",
		type: "POST",
		data: { 
			"query_type":query_type
		},
		dataType: "json",
	}).done(function(data){
		if (data != 0) { 		
			$('.faq_cat_id').empty();
			$('.faq_cat_id').append("<option value='0'>Select Category</option>");
			$.each(data, function(i, d) { 
				var opt = $('<option />');
					opt = "<option value='" + d.id + "'>" + d.category_name + " </option>";
				$('.faq_cat_id').append(opt);
			});
		} else {
			$('.faq_cat_id').empty();
			$('.faq_cat_id').append("<option value='0'>Select Category</option>");
		}
	}).fail(function(jqXHR, ajaxOptions, thrownError){
		  alert('No response from show enquiry form section');
	});
});
$(document).on('change', '.get_query_status', function(){
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
			$('#query_status').empty();
			$('#query_status').append("<option value='0'>Select Status</option>");
			$.each(data, function(i, d) { 
				var opt = $('<option />');
					opt = "<option value='" + d.id + "'>" + d.name + " </option>";
				$('#query_status').append(opt);
			});
		} else {
			$('#query_status').empty();
			$('#query_status').append("<option value='0'>Select Status</option>");
		}
	}).fail(function(jqXHR, ajaxOptions, thrownError){
		  alert('No response from show enquiry form section');
	});
});