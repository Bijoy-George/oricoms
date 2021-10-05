function selectAllCustomers()
{
	var selectAll = $('#select-all').prop('checked');
	$('.contact-select').prop('checked', selectAll);
	$('#selectedAll').val(selectAll);
	$('#selectedContacts').val('');
	$('#excludedContacts').val('');
}

function toggleContact(checkbox)
{
	var selectAll = $('#select-all').prop('checked');
	var selectedContacts	= $('#selectedContacts').val();
	var excludedContacts	= $('#excludedContacts').val();
	if (excludedContacts == "")
	{
		excludedContacts = [];
	}
	else
	{
		excludedContacts		= excludedContacts.split(',');
	}

	if (selectedContacts == "")
	{
		selectedContacts = [];
	}
	else
	{
		selectedContacts		= selectedContacts.split(',');
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

$('.reset-contacts').on('click', function() {
	$('#selectedAll').val('');
	$('#selectedContacts').val('');
	$('#excludedContacts').val('');
});

$('#addToGroup').on('click', function() {
	var url = $("#base_url").val();
	var selectedAll	= $('#selectedAll').val();
	var selectedContacts = $('#selectedContacts').val();
	var excludedContacts = $('#excludedContacts').val();
	var groupId			 = $('#groupId').val();
	if (selectedAll === 'true')
	{
		selectedAll = true;
	}
	else
	{
		selectedAll = false;
	}

	//If no contact is selected
	if (selectedAll === false && selectedContacts == '')
	{
		$('.message').addClass("alert");
		$('.message').addClass("alert-danger");
		$('.message').html('Please select atleast one contact.');

		setTimeout(function() {
			$('.message').empty();
			$('.message').removeClass("alert-danger");
			$('.message').removeClass("alert");
		}, 3000);
	}
	else if (selectedAll === false)
	{
		$.ajax({
            type: 'POST',
            url: url + '/groups/' + groupId + '/add_leads',
            data: {
            	"contact_list": selectedContacts
            },			
			dataType: "json",
            success: function (data) {
				
				var response = data;
				if(response.success==true)
				{
					if (typeof response.message !== 'undefined' )
					{
						$(".message").addClass("alert");
						$(".message").addClass("alert-success");
						$('.message').html(response.message);

                        setTimeout(function() {
                            $(".message").empty();
                            $(".message").removeClass("alert-success");
                            $(".message").removeClass("alert");
                        }, 3000);
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
					
				}
				else
				{
					alertFormCommon("Result Error");
				}

                submit_btn.removeAttr("disabled");
                reset_btn.removeAttr("disabled");
                submit_btn.html('Submit');
                $(form).removeAttr('page-reset');
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
            }
        });
	}
	else if (selectedAll === true)
	{
		var url = $("#base_url").val();
		var searchKeywords 	= $('#search_keywords').val();
		var startDate		= $('#startdate').val();
		var endDate			= $('#enddate').val();
		var processType		= $('#addToGroup').attr('process-type');
		$.ajax({
            type: 'POST',
            url: url + '/batch_process',
            data: {
            	"search_keywords": searchKeywords,
            	"startdate": startDate,
            	"enddate": endDate,
            	"excluded_contacts": excludedContacts,
            	"group_id": groupId,
            	"type": processType
            },			
			dataType: "json",
            success: function (data) {
				
				var response = data;
				if(response.success==true)
				{
					if (typeof response.message !== 'undefined' )
					{
						$(".message").addClass("alert");
						$(".message").addClass("alert-success");
						$('.message').html(response.message);

                        setTimeout(function() {
                            $(".message").empty();
                            $(".message").removeClass("alert-success");
                            $(".message").removeClass("alert");
                        }, 3000);
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
					
				}
				else
				{
					alertFormCommon("Result Error");
				}

                submit_btn.removeAttr("disabled");
                reset_btn.removeAttr("disabled");
                submit_btn.html('Submit');
                $(form).removeAttr('page-reset');
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
            }
        });
	}


});

function updateContactSelections(response, form, submit_btn)
{
	var selectedAll	= $('#selectedAll').val();
	var selectedContacts = $('#selectedContacts').val();
	var excludedContacts = $('#excludedContacts').val();
	if (selectedAll === 'true')
	{
		$('#select-all').prop('checked', true);
		$('input[type=checkbox].contact-select').prop('checked', true);
	}
	else
	{
		$('#select-all').prop('checked', false);
		$('input[type=checkbox].contact-select').prop('checked', false);
	}

	if (excludedContacts == "")
	{
		excludedContacts = [];
	}
	else
	{
		excludedContacts		= excludedContacts.split(',');
	}

	if (selectedContacts == "")
	{
		selectedContacts = [];
	}
	else
	{
		selectedContacts		= selectedContacts.split(',');
	}

	$('input[type=checkbox].contact-select').each(function(index, checkbox) {

		if ($.inArray($(checkbox).val(), selectedContacts) !== -1)
		{
			$(checkbox).prop('checked', true);
		}
		else if($.inArray($(checkbox).val(), excludedContacts) !== -1)
		{
			$(checkbox).prop('checked', false);
		}
	})
}

function leadSourceDropDownList(leadSourceType)
{
	var url = $("#base_url").val();
	$.ajax({
  		type: "POST",
      	dataType:"json",//return type expected as json
      	url:  url + "/lead_source_dropdown_list",        
      	data: {
          	"source_type": leadSourceType,
        },        
      	success: function(lead_sources)
      	{  
        	$('#lead_source').empty();
        	$('#lead_source').html('<option value="">Select Lead Source</option>');
            $.each(lead_sources,function(leadSourceVal,leadSourceName){
           		
                var opt="<option value='"+leadSourceVal+"'>"+leadSourceName+" </option>";

                $('#lead_source').append(opt);
            });
                
      	}
  	});
}