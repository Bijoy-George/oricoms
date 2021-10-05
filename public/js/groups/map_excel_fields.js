$(document).ready(function() {
	fetchCustomerFields();

    $("select.headings").change(function()
    {

        $("select.headings option").attr("disabled",false); //enable everything
     
        //collect the values from selected;
        var selectedFields = $.map
        (
            $("select.headings option:selected"), function(n)
            {
                if (n.value == '')
                {
                    return null;
                }
                return n.value;
            }
        );
    

        $("select.headings option").filter(function()
        {    
            return $.inArray($(this).val(),selectedFields)>-1;
        }).attr("disabled","disabled");

        $("select.headings").find(":selected").attr("disabled",false); //enable everything

    });
});

function fetchCustomerFields()
{
	var url = $("#base_url").val();
	$.ajax({
        type: "POST",
        url:  url + "/fetch_customer_fields",
                
              
        success: function(data) {
        	var field_list = JSON.parse(data);
        	jQuery.each(field_list, function(key, value) {
        		$('select.headings').append('<option value="' + key + '">' + value + '</option>');
        	});
        	return;
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