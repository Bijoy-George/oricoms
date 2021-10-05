$(document).ready(function() {
	fetchBatchGroups();
	fetchBatchChannels();
	fetchCommunicationStatus();
});

$('#batch').on('change', function() {
	fetchBatchGroups();
	fetchBatchChannels();
	fetchCommunicationStatus();
})

function fetchBatchGroups()
{
	var url = $("#base_url").val();
	var batchId = $('#batch').val();
	var campaignId = $('#campaign').val();
   	$.ajax({
		type:'post',
		url:  url + "/batch_groups",
        data:{
        	'batch_id' : batchId,
        	'campaign_id': campaignId
        },
		success:function(groups)
		{
			$('#group').empty();
			$('#group').html('<option value="">Select Group</option>');
			groups = JSON.parse(groups);
     		$.each(groups, function(key, name) {
     			var opt="<option value='"+key+"'>"+name+" </option>";
     			$('#group').append(opt);
     		})
		}
	});
}

function fetchBatchChannels()
{
	var url = $("#base_url").val();
	var batchId = $('#batch').val();
	var campaignId = $('#campaign').val();
	$.ajax({
		type:'post',
		url:  url + "/batch_channels",
        data:{
        	'batch_id' : batchId,
        	'campaign_id': campaignId
        },
		success:function(channels)
		{
			$('#campaign_channel').empty();
			$('#campaign_channel').html('<option value="">Select Campaign Channel</option>');
			channels = JSON.parse(channels);
     		$.each(channels, function(key, name) {
     			var opt="<option value='"+key+"'>"+name+" </option>";
     			$('#campaign_channel').append(opt);
     		})
		}
	});
}

function resetBatchGroupChannel()
{
	fetchBatchGroups();
	fetchBatchChannels();
	fetchCommunicationStatus();
}

function fetchCommunicationStatus()
{
	var url = $("#base_url").val();
	var channel = $("#campaign_channel").val();
	$.ajax({
		type:'post',
		url:  url + "/channel_communication_status",
        data:{
        	'channel_type' : channel
        },
		success:function(communicationStatus)
		{
			$('#communication_status').empty();
			$('#communication_status').html('<option value="">Select Communication Status</option>');
			communicationStatus = JSON.parse(communicationStatus);
     		$.each(communicationStatus, function(key, name) {
     			var opt="<option value='"+key+"'>"+name+" </option>";
     			$('#communication_status').append(opt);
     		})
		}
	});
}

function selectAllCustomers()
{
	var selectAll = $('#select-all').prop('checked');
	$('.contact-select').prop('checked', selectAll);
	$('#selectedAll').val(selectAll);
	$('#selectedContacts').val('');
	$('#excludedContacts').val('');
}

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

$('.reset-contacts').on('click', function() {
	$('#selectedAll').val('');
	$('#selectedContacts').val('');
	$('#excludedContacts').val('');
});

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

function showReassignContactForm()
{
	var form = $('#reassignGroupForm')[0];
	var selectedAll	= $('#selectedAll').val();
	var selectedContacts = $('#selectedContacts').val();
	var excludedContacts = $('#excludedContacts').val();
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
	else
	{
		$( form ).find("input").removeClass("red_border");
        $( form ).find("input").removeClass("text-danger");
        $(form).find("span.error").html('');
		$('#reassignGroup').modal({backdrop: false, keyboard: false});
	}
}

function reassignContacts()
{
	var form 					= $('#reassignGroupForm')[0];
	var url 					= $("#base_url").val();
	var group_name 				= $("#name").val();
	var batch_id				= $("#batch").val();
	var group_id				= $("#group").val();
	// var stage					= $("#customer_stage").val();
	var campaign_channel 		= $("#campaign_channel").val();
	var communication_status 	= $("#communication_status").val();
	var search_keywords			= $("#search_keywords").val();
	var process_type			= $("#process_type").val();
	var included_contacts		= $("#selectedContacts").val();
	var excluded_contacts		= $("#excludedContacts").val();
	var campaign_id				= $("#campaign").val();

	$.ajax({
		type:'post',
		url:  url + "/groups",
        data:{
        	'name' : group_name
        },
		success:function(data)
		{
			data = JSON.parse(data);
			var new_group_id = data.data.group_id;

			$.ajax({
				type:'post',
				url:  url + "/batch_process",
		        data:{
		        	'campaign_id': campaign_id,
		        	'group_id': new_group_id,
		        	'type': process_type,
		        	'batch_id': batch_id,
		        	'old_group_id': group_id,
		        	// 'customer_stage': stage,
		        	'campaign_channel': campaign_channel,
		        	'communication_status': communication_status,
		        	'search_keywords': search_keywords,
		        	'included_contacts': included_contacts,
		        	'excluded_contacts': excluded_contacts
		        },
				success:function(data)
				{
					$('#reassignGroup').modal('hide');
					var response = data;
					if(response.success==true)
					{
						$("#selectedContacts").val('');
						$("#excludedContacts").val('');
						$('#selectedAll').val(false);
						$('#select-all').prop('checked', false);
						$('.contact-select').prop('checked', false);
						$("#name").val('');
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
				}
			});
		},
		error:function(data)
		{
			$("#msg").fadeIn('fast');
            $("#msg").addClass('alert-danger').removeClass('alert-success');
            $("#msg").html('Validation Error.');
            $('#msg').delay(1000).fadeOut(2500);

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
		}
	});

}

function abortReassign()
{
	$("#name").val('');
}