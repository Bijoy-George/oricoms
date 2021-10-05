function choose_agent()
{

  $('#assigned_lead').modal({backdrop: 'static', keyboard: false})
  $('#pop_msg').html('');
  $('#selected_agent').val('');
}
 var global_select_all_id=0;
 var global_include_arr=[];
 var global_exclude_arr=[];
 
 function check_all_checkbox() 
	{
	  if($("#selectall").is(':checked')){
		   global_select_all_id=1; 
		   $('input:checkbox').each(function() { 
								this.checked = true;                
		   });
			 global_include_arr=[];
			 global_exclude_arr=[]; 
		console.log(global_exclude_arr)
	  }else
	  {
		 global_select_all_id=0; 
		 $('input:checkbox').each(function() { 
					  this.checked = false;                      
		  });
		  global_include_arr=[];
		  global_exclude_arr=[]; 
	  }
	}
 function clearvalue(keyval)
    {
        if($("#selectall").is(':checked')){
          global_include_arr=[];
          
          if(global_exclude_arr.indexOf(keyval) != -1 )
           { 
             customer =jQuery.grep(global_exclude_arr, function(value) { return value != keyval; });
             global_exclude_arr=customer;
           }else{
              global_exclude_arr.push(keyval);
           }
          
         console.log(global_exclude_arr)
		}else
		{
			if(global_include_arr.indexOf(keyval) != -1 )
			  { 
				  customer =jQuery.grep(global_include_arr, function(value) { return value != keyval; });
				  global_include_arr=customer;
			  }else{
				//  console.log(global_include_arr)
				global_include_arr.push(keyval);
				
			  }
			
			global_exclude_arr=[];

		}  
       /* var customer = new Array();
            var ag = $('#agents').val();
            if(ag != undefined) {
                ag = ag.split(",");
                customer =jQuery.grep(ag, function(value) { return value != keyid; });
                $('#agents').val(customer);
        }*/
    }
function assigned_agent()
{
  $('#pop_msg').html('');
  
  var selected_agent       =   $('#selected_agent').val();
  var set_unattended_call_source       =   $('#set_unattended_call_source').val();
  var set_abandoned_category       =   $('#set_abandoned_category').val();
  var set_after_hour_category       =   $('#set_after_hour_category').val();
  var set_holiday_category       =   $('#set_holiday_category').val();
  var open_status       =   $('#open_status').val();
  var search_keywords      =   $("#search_keywords").val();
  var type_list            =   $("#type_list").val();
  var start_date           =   $("#start_date").val();
  var end_date             =   $("#end_date").val();
  var call_status          =   $("#call_status").val();
  var agent_id             =   $("#agent_id").val();
  var processType		   =   $('#AssignAgent').attr('process-type');
  var procees_count        =   $("#procees_count_hid").val();

	if(selected_agent == "")
	  {
		$('#pop_msg').html('<span style="color:red;">Please Select Agent</span>');
		return false;
 	  }
	if(set_unattended_call_source == "")
	  {
		$('#pop_msg').html('<span style="color:red;">Please Add Source</span>');
		return false;
 	  }
	if(set_abandoned_category == "")
	  {
		$('#pop_msg').html('<span style="color:red;">Please Add Abandoned Call Query Category</span>');
		return false;
 	  }
	if(set_after_hour_category == "")
	  {
		$('#pop_msg').html('<span style="color:red;">Please Add After Hour Call Query Category</span>');
		return false;
 	  }
	if(set_holiday_category == "")
	  {
		$('#pop_msg').html('<span style="color:red;">Please Add Holiday Call Query Category</span>');
		return false;
 	  }
	if(open_status == "")
	  {
		$('#pop_msg').html('<span style="color:red;">Please Add Open Status</span>');
		return false;
 	  }
    if(global_include_arr.length == 0 && global_exclude_arr.length == 0 && global_select_all_id ==0)
	   { 
        $('#pop_msg').html('<span style="color:red;">Please Select Customer</span>');
        return false;
       }

    if(procees_count > 0)
      {
        $('#pop_msg').html('<span style="color:red;">Please Wait...Processing Previous Batch..</span>');
        return false;
      }
	var included_contacts = global_include_arr.join(',');
	var excluded_contacts = global_exclude_arr.join(',');
	var url = $("#base_url").val();
  $.ajax({
            type: "POST",
            url: url + '/batch_process',
            data: {
                  "included_contacts":included_contacts,
                  "excluded_contacts":excluded_contacts,
                  "selected_agent":selected_agent,
                  "type_list":type_list,
                  "start_date":start_date,
                  "end_date":end_date,
                  "search_keywords":search_keywords,
                  "call_status":call_status,
                  "agent_id":agent_id,
                  "global_select_all_id":global_select_all_id,
                  "type":processType,
                  
                 },
            success: function (msg)
                {
                $('#pop_msg').html('');
					$('input:checkbox').each(function() { 
					this.checked = false;                
                });
                $('.case').each(function() { 
                    this.checked = false; 
                });
                    $("#assigned_lead").modal('hide');
                    $("#msg").show();  
                    $("#msg").html('<span style="color:red">Please Wait...Processing call list...</span>');
                    $('#msg').delay(1500).fadeOut(1500); 
					var global_select_all_id=0;
					var global_include_arr=[];
					var global_exclude_arr=[];	
                }
          });
}
