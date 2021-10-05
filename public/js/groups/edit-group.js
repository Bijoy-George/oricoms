$(document).ready(function() {
	var initialGroupName = $("#name").val();
	localStorage.setItem('initialGroupName', initialGroupName);
});

function updateGroupName(input)
{
	var initialGroupName 	= localStorage.getItem('initialGroupName');
	var newGroupName 		= $("#name").val();
	var groupId				= $("#id").val();
	localStorage.setItem('initialGroupName',newGroupName);

	if (newGroupName != initialGroupName)
	{
		$('.editGroupForm').submit();
	}
}

function showImportedExcelList(groupId)
{
	var url = $("#base_url").val();
	var token = '{{csrf_token()}}';

  	$.ajax({
        type: "POST",
        dataType: "html",
        url:  url + "/show_imported_excel_list",
        data: {
                  "group_id": groupId
            },
                
              
        success: function(msg) {
            $("#imported-excel-list").empty().html(msg);
        }
    });
}

function downloadFailedImportReport(button)
{
	var url = $("#base_url").val();
	var batchId	= $(button).attr('data-batch');

	$.ajax({
        type: "POST",
        dataType: "html",
        url:  url + "/contacts_import_failed_report",
        data: {
                  "batch_process_id": batchId
            },
                
              
        success: function() {
        	$(".message").addClass("alert");
			$(".message").addClass("alert-success");
            $(".message").empty().html('Report Generation Initiated');
            setTimeout(function() {
                $(".message").empty();
                $(".message").removeClass("alert-danger");
                $(".message").removeClass("alert");
            }, 3000);
        }
    });
}