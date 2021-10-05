$(document).ready(function() {
	fetchGroupDropdown();
	var lead_source_type = $('#lead_source_type').val();
	if (lead_source_type != '')
	{
		var selectedLeadSource = $('#selected_lead_source').val();
		leadSourceDropDownList(lead_source_type, selectedLeadSource);
	}
});

function fetchGroupDropdown()
{
	var url = $("#base_url").val();
	$('#groupDropdown').html('');
	var campaignId = $('#campaign_id').val();
   	$.ajax({
		type:'post',
		url:  url + "/groups/dropdown",
        data:{
        	'campaign_id' : campaignId
        },
		success:function(msg)
		{
     		$('#groupDropdown').html(msg);
		}
	});
}

function leadSourceDropDownList(leadSourceType, selectedLeadSource = null)
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

            	var selectedAttribute = '';
            	if (leadSourceVal == selectedLeadSource)
            	{
            		selectedAttribute = ' selected';
            	}
           		
                var opt="<option value='"+leadSourceVal+"' "+ selectedAttribute +">"+leadSourceName+" </option>";

                $('#lead_source').append(opt);
            });
                
      	}
  	});
}

function addCampaign()
{
	var url = $("#base_url").val();
	var form = $('#campaign-form')[0];
	var campaignId 		= $('#campaign_id').val();
	var name 			= $('#name').val();
	var goalStage		= $('#goal_stage').val();
	var groups			= $('#groups').val();
	var type 			= $("input[name='campaign_type']:checked").val();
	var leadSourceType 	= $('select[name="lead_source_type"]').find(":selected").val();
	var leadSource 		= $('select[name="lead_source"]').find(":selected").val();

	$("span.error").html('');

	if ((name == '') || (groups == '') || (typeof type == 'undefined') || (leadSourceType == '') || (leadSource == ''))
	{
		if (name == '')
		{
			$('#name_err').html('Campaign Name is required');
		}
		if (groups == '')
		{
			$('#groups_err').html('Please select atleast one group.');
		}
    if (typeof type == 'undefined')
    {
      $('#type_err').html('Campaign Type is required');
    }

		if (leadSourceType == '')
		{
			$('#lead_source_type_err').html('Lead Source Type is required');
		}

		if (leadSource == '')
		{
			$('#lead_source_err').html('Lead Source is required');
		}

		return;
	}

	$.ajax({
  		type: "POST",
      	dataType:"json",//return type expected as json
      	url:  url + "/campaigns",        
      	data: {
      		"id": campaignId,
          	"name": name,
          	"goal_stage": goalStage,
          	"groups": groups,
          	"type": type
        },        
      	success: function(response)
      	{  
        	if (response.success == false)
        	{
        		if (typeof response.message !== 'undefined' )
    				{
    					$( form ).find(".message").addClass("alert");
    					$( form ).find(".message").addClass("alert-danger");
    					$( form ).find('.message').html(response.message);

                        setTimeout(function() {
                            $( form ).find(".message").empty();
                            $( form ).find(".message").removeClass("alert-danger");
                            $( form ).find(".message").removeClass("alert");
                        }, 3000);
    				}
    				return;
        	}

        	var campaignId 		= response.data.campaign_id;
        	var leadSourceType 	= $('select[name="lead_source_type"]').find(":selected").val();
			var leadSource 		= $('select[name="lead_source"]').find(":selected").val();
			var budget			= $('#budget').val();
			var field1			= $('#field_1_title').val();
			var field1Content	= $('#field_1_content').val();
			var field2			= $('#field_2_title').val();
			var field2Content	= $('#field_2_content').val();
			var field3			= $('#field_3_title').val();
			var field3Content	= $('#field_3_content').val();

			$.ajax({
		  		type: "POST",
		      	dataType:"json",//return type expected as json
		      	url:  url + "/campaign_meta",        
		      	data: {
		          	"campaign_id": campaignId,
		          	"lead_source_type": leadSourceType,
		          	"lead_source": leadSource,
		          	"budget": budget,
		          	"field1": field1,
		          	"field1_content": field1Content,
		          	"field2": field2,
		          	"field2_content": field2Content,
		          	"field3": field3,
		          	"field3_content": field3Content
		        },        
		      	success: function(response)
		      	{  
		      		if (response.success == true)
		      		{
		      			if (typeof response.message !== 'undefined' )
    						{
    							$( form ).find(".message").addClass("alert");
    							$( form ).find(".message").addClass("alert-success");
    							$( form ).find('.message').html(response.message);

    	                        setTimeout(function() {
    	                            $( form ).find(".message").empty();
    	                            $( form ).find(".message").removeClass("alert-success");
    	                            $( form ).find(".message").removeClass("alert");
    	                        }, 3000);
    						}

                window.location = url + "/campaigns/" + campaignId + "/edit";
		      		}
		        	else if (response.success == false)
		        	{
		        		if (typeof response.message !== 'undefined' )
						{
							$( form ).find(".message").addClass("alert");
							$( form ).find(".message").addClass("alert-danger");
							$( form ).find('.message').html(response.message);

	                        setTimeout(function() {
	                            $( form ).find(".message").empty();
	                            $( form ).find(".message").removeClass("alert-danger");
	                            $( form ).find(".message").removeClass("alert");
	                        }, 3000);
						}
		        	}
		                
		      	}
		  	});

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

}
$('input[type=radio][name=camp_or_survey]').change(function() {
	
    if (this.value == 2) {
		$('#survey_div').show();
		$('#with_survey_auto').show();
    $('#without_survey_auto').hide();
    $('#with_survey_man').show();
    $('#without_survey_man').hide();
		//$('#followup').hide(); 
		$('#push_messages').hide(); 
		
		
    }
    else {
    	$('#survey_id').val('');
        $('#survey_div').hide();
        $('#with_survey_auto').hide();
        $('#without_survey_auto').show();
        $('#with_survey_man').hide();
        $('#without_survey_man').show();
        //$('#call').show();
        //$('#followup').show(); 
        $('#push_messages').show(); 
       
    }
});

function resetCampaign()
{
  var form = $('#campaign-form')[0];
  form.reset();
  $(".dropdown-mul-1").data('dropdown').reset();
}


function campaignEmailDetails(batchId)
{
	var url = $("#base_url").val();
    $.ajax({
        type: "POST",
        dataType: "html",
        url:  url + "/email_send_status_count",
        data: {
                  "batch_id": batchId
        },
        success: function(msg) {
            $("#status_graph").empty().html(msg);
        }
    });
}

function efficiencyReport(campaignId, batchId)
{
	var url = $("#base_url").val();
	var token = '{{csrf_token()}}';

  	$.ajax({
        type: "POST",
        dataType: "html",
        url:  url + "/show_batch_efficiency_stats",
        data: {
                  "campaign_id": campaignId,
                  "batch_id": batchId
            },
                
              
        success: function(msg) {
            $("#status_graph").empty().html(msg);
        }
    });
}

function exportEmailBatchReport(batchId,type)
{
	var url = $("#base_url").val();
	$.ajax({
        type: "POST",
        url:  url + "/email_batch_report",
        data: {
                  "batch_id": batchId,
                  "file_type": type
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

function campaignSmsDetails(batchId)
{
	var url = $("#base_url").val();
    $.ajax({
        type: "POST",
        dataType: "html",
        url:  url + "/sms_send_status_count",
        data: {
                  "batch_id": batchId
        },
        success: function(msg) {
            $("#status_graph").empty().html(msg);
        }
    });
}

function exportSmsBatchReport(batchId,type)
{
	var url = $("#base_url").val();
	$.ajax({
        type: "POST",
        url:  url + "/sms_batch_report",
        data: {
                  "batch_id": batchId,
                  "file_type": type
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

function campaignAutodialDetails(batchId)
{
  var url = $("#base_url").val();
    $.ajax({
        type: "POST",
        dataType: "html",
        url:  url + "/autodial_called_status_count",
        data: {
                  "batch_id": batchId
        },
        success: function(msg) {
            $("#status_graph").empty().html(msg);
        }
    });
}

function exportAutodialBatchReport(batchId,type)
{
  var url = $("#base_url").val();
  $.ajax({
        type: "POST",
        url:  url + "/autodial_batch_report",
        data: {
                  "batch_id": batchId,
                  "file_type": type
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

function campaignManualCallDetails(batchId)
{
  var url = $("#base_url").val();
  $.ajax({
      type: "POST",
      dataType: "html",
      url:  url + "/manualcall_status_count",
      data: {
                "batch_id": batchId
      },
      success: function(msg) {
          $("#status_graph").empty().html(msg);
      }
  });
}

function campaignPushDetails(batchId)
{
  var url = $("#base_url").val();
  $.ajax({
      type: "POST",
      dataType: "html",
      url:  url + "/push_send_status_count",
      data: {
                "batch_id": batchId
      },
      success: function(msg) {
          $("#status_graph").empty().html(msg);
      }
  });
}

function exportPushBatchReport(batchId,type)
{
  var url = $("#base_url").val();
  $.ajax({
        type: "POST",
        url:  url + "/push_batch_report",
        data: {
                  "batch_id": batchId,
                  "file_type": type
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

function exportManualCallBatchReport(batchId,type)
{
  var url = $("#base_url").val();
  $.ajax({
        type: "POST",
        url:  url + "/manualcall_batch_report",
        data: {
                  "batch_id": batchId,
                  "file_type": type
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

function confirmPauseBatch(batchId, batchType)
{
  $('#batchActionModal .modal-body').empty().html('Are you sure you want to pause the campaign batch?');
  $('#batchActionModalTitle').empty().html('Pause Campaign Batch');
  $('#pauseBtn').show();
  $('#resumeBtn').hide();
  $('#pauseBtn').attr('data-batch',batchId);
  $('#pauseBtn').attr('data-type', batchType);
  $('#batchActionModal').modal('show');
}

$('#pauseBtn').on('click', function() {
  var url = $("#base_url").val();
  var batchId = $(this).data('batch');
  $.ajax({
        type: "POST",
        url:  url + "/pauseBatch",
        data: {
                  "batch_id": batchId
            }, 
        success: function(msg) {
          msg = JSON.parse(msg);
          console.log(msg);
          $('#batchActionModal').modal('hide');
            $(".message").addClass("alert");
      $(".message").addClass("alert-success");
      $('.message').html(msg.message);

            setTimeout(function() {
                $(".message").empty();
                $(".message").removeClass("alert-success");
                $(".message").removeClass("alert");
                location.reload();
            }, 3000);
        }
    });
});

function confirmResumeBatch(batchId, batchType)
{
  $('#batchActionModal .modal-body').empty().html('Are you sure you want to resume the campaign batch?');
  $('#batchActionModalTitle').empty().html('Resume Campaign Batch');
  $('#pauseBtn').hide();
  $('#resumeBtn').show();
  $('#resumeBtn').attr('data-batch',batchId);
  $('#resumeBtn').attr('data-type', batchType);
  $('#batchActionModal').modal('show');
}

function get_greeting(tag)
{
  if(tag == 'first_name')
  {
   var title='[[ First Name ]] ';
   
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

$('#resumeBtn').on('click', function() {
  var url = $("#base_url").val();
  var batchId = $(this).data('batch');
  $.ajax({
        type: "POST",
        url:  url + "/resumeBatch",
        data: {
                  "batch_id": batchId
            }, 
        success: function(msg) {
          msg = JSON.parse(msg);
          $('#batchActionModal').modal('hide');
            $(".message").addClass("alert");
      $(".message").addClass("alert-success");
      $('.message').html(msg.message);

            setTimeout(function() {
                $(".message").empty();
                $(".message").removeClass("alert-success");
                $(".message").removeClass("alert");
                location.reload();
            }, 3000);
        }
    });
});
