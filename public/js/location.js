/* 
 * Location js function and global variables
 */
$.ajaxSetup({ 
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function getState(defaultCountry = null, defaultState = null)
{
    var country_id = $(this).find(':selected').data('type');
    var con = "#"+$(this).closest("form").attr('id')+" ";
    var url = $("#base_url").val();
    var country_id = $(this).val();
    var is_other = $(this).find(':selected').data('other');
    if (is_other == 1)
    {
        $(con+'.other_country').show();
    }
    else
    {
        $(con+'.other_country').hide();
    }
    if (!$(this).val())
    {
        country_id = defaultCountry;
    }
    var customer_id=$('#profile_id').val();
    $.ajax({
        url: url+"/get_location",
        type: "POST",
        data: { 
            "id":country_id,
            "customer_id":customer_id,
            "form_id":con
        },
        dataType: "json",
    }).done(function(results){

        var data=results.location;
        var user_details=results.user_det;
        if (data != 0) {     
            $(con+'.state_id').empty();
            $(con+'.state_id').append("<option value=''>Select State</option>");
            $.each(data, function(i, d) { 
                var opt = $('<option />');
                if (d.id == user_details.state_id) {
                     opt = "<option value='" + d.id + "' selected='selected' data-other='"+ d.is_other +"'>" + d.name + " </option>";
                     if (d.is_other == 1)
                     {
                        $(con+'.other_state').show();
                     }
                     else
                     {
                        $(con+'.other_state').hide();
                     }
                }
                else if (d.id == defaultState)
                {
                     opt = "<option value='" + d.id + "' selected='selected' data-other='"+d.is_other+"'>" + d.name + " </option>";
                     if (d.is_other == 1)
                     {
                        $(con+'.other_state').show();
                     }
                     else
                     {
                        $(con+'.other_state').hide();
                     }
                }
                else{
                    opt = "<option value='" + d.id + "' data-other='"+d.is_other+"'>" + d.name + " </option>";
                    $(con+'.other_state').hide();
                }
                $(con+'.state_id').append(opt);
            });
            $('.state_id').trigger('change');
        } else {
            $(con+'.state_id').empty();
            $(con+'.state_id').append("<option value=''>Select State</option>");
        }
    }).fail(function(jqXHR, ajaxOptions, thrownError){
          //alert('No response from state section');
    });
}

$(document).on('change', '.country_id', function(){
    var country_id = $(this).find(':selected').data('type');
    var con = "#"+$(this).closest("form").attr('id')+" ";
    var url = $("#base_url").val();
    var country_id = $(this).val();
    var is_other = $(this).find(':selected').data('other');
    if (is_other == 1)
    {
        $(con+'.other_country').show();
    }
    else
    {
        $(con+'.other_country').hide();
    }
    var customer_id=$('#profile_id').val();
    $.ajax({
        url: url+"/get_location",
        type: "POST",
        data: { 
            "id":country_id,
            "customer_id":customer_id,
            "form_id":con
        },
        dataType: "json",
    }).done(function(results){

        var data=results.location;
        var user_details=results.user_det;
        if (data != 0) {     
            $(con+'.state_id').empty();
            $(con+'.state_id').append("<option value=''>Select State</option>");
            $.each(data, function(i, d) { 
                var opt = $('<option />');
                if (d.id == user_details.state_id) {
                     opt = "<option value='" + d.id + "' selected='selected' data-other='"+ d.is_other +"'>" + d.name + " </option>";

                     if (d.is_other == 1)
                     {
                        $(con+'.other_state').show();
                     }
                     else
                     {
                        $(con+'.other_state').hide();
                     }
                }else{
                    opt = "<option value='" + d.id + "' data-other='"+ d.is_other +"'>" + d.name + " </option>";
                    $(con+'.other_state').hide();
                }
                $(con+'.state_id').append(opt);
            });
            $('.state_id').trigger('change');
        } else {
            $(con+'.state_id').empty();
            $(con+'.state_id').append("<option value=''>Select State</option>");
        }
    }).fail(function(jqXHR, ajaxOptions, thrownError){
          //alert('No response from state section');
    });
});
function getDistrict(defaultState=null, defaultDistrict=null)
{
    var state_id=$('.state_id').val();   

    var state_id = $(this).find(':selected').data('type');
    var con = "#"+$(this).closest("form").attr('id')+" ";
    var url = $("#base_url").val();
    var state_id = $(this).val();
    if (!$(this).val())
    {
        state_id = defaultState;
    }
    var is_other = $(this).find(':selected').data('other');
    if (is_other == 1)
    {
        $(con+'.other_state').show();
    }
    else
    {
        $(con+'.other_state').hide();
    }
    var customer_id=$('#profile_id').val();
   
    $.ajax({
        url: url+"/get_location",
        type: "POST",
        data: { 
            "id":state_id,
            "customer_id":customer_id,
            "form_id":con
        },
        dataType: "json",
    }).done(function(results){
        var data=results.location;
        var user_details=results.user_det;
        if (data != 0) {      
            $(con+'.district_id').empty();
            $(con+'.district_id').append("<option value=''>Select District</option>");
            $.each(data, function(i, d) { 
                var opt = $('<option />');
                if (d.id == user_details.district_id || d.id == defaultDistrict) {
                     opt = "<option value='" + d.id + "' selected>" + d.name + " </option>";
                }else{
                    opt = "<option value='" + d.id + "'>" + d.name + " </option>";
                }
                $(con+'.district_id').append(opt);
            });
            $('.local_body_type').trigger('change');
        } else {
            $(con+'.district_id').empty();
            $(con+'.district_id').append("<option value=''>Select District</option>");
        }
    }).fail(function(jqXHR, ajaxOptions, thrownError){
         // alert('No response from district section');
    });
}
$(document).on('change', '.state_id', function(){ 
 var state_id=$('.state_id').val();   

    var state_id = $(this).find(':selected').data('type');
    var con = "#"+$(this).closest("form").attr('id')+" ";
    var url = $("#base_url").val();
    var state_id = $(this).val();
    var is_other = $(this).find(':selected').data('other');
    if (is_other == 1)
    {
        $(con+'.other_state').show();
    }
    else
    {
        $(con+'.other_state').hide();
    }
    var customer_id=$('#profile_id').val();
   
    $.ajax({
        url: url+"/get_location",
        type: "POST",
        data: { 
            "id":state_id,
            "customer_id":customer_id,
            "form_id":con
        },
        dataType: "json",
    }).done(function(results){
        var data=results.location;
        var user_details=results.user_det;
        if (data != 0) {      
            $(con+'.district_id').empty();
            $(con+'.district_id').append("<option value=''>Select District</option>");
            $.each(data, function(i, d) { 
                var opt = $('<option />');
                if (d.id == user_details.district_id) {
                     opt = "<option value='" + d.id + "' selected='selected'>" + d.name + " </option>";
                }else{
                    opt = "<option value='" + d.id + "'>" + d.name + " </option>";
                }
                $(con+'.district_id').append(opt);
            });
            $('.local_body_type').trigger('change');
        } else {
            $(con+'.district_id').empty();
            $(con+'.district_id').append("<option value=''>Select District</option>");
        }
    }).fail(function(jqXHR, ajaxOptions, thrownError){
         // alert('No response from district section');
    });
});

$(document).on('change', '.setEnquiryDistrict', function() {
    var district_id = $(this).val();
    $('#enquiry_form .district_id').val(district_id);
});


function clear_panchayath_data(con)
{
    $(con+'.district_panchayath_id').val('');
    $(con+'.block_panchayath_id').val('');
    $(con+'.grama_panchayath_id').val('');
    $(con+'.panchayath_id').val('');
    $(con+'.panchayath_type').val('');
}
function clear_panchayath_div(con)
{
    $(con+'.pan_type_div').hide(); 
    $(con+'.dis_pan_div').hide();
    $(con+'.pan_div').hide();
    $(con+'.blk_pan_div').hide();
    $(con+'.gra_pan_div').hide();
}

$(document).on('change', ".district_id, .local_body_type", function(){ 

    var country_id = $(this).find(':selected').data('type');
    var con = "#"+$(this).closest("form").attr('id')+" ";
    var url = $("#base_url").val();
    var distid = $(con+'.district_id').val();
    var localbody_type = $(con+'.local_body_type').val();
    var customer_id=$('#profile_id').val();

    if(localbody_type == 2)
        {   
            $(con+'.corporation_div').hide();
            $(con+'.corporation_id').val('');
            clear_panchayath_div(con);
            $(con+'.muncipality_div').show(); 
            var key=$(con+'.muncipality_id');
            var flag='muncipality_id';
            clear_panchayath_data(con);
    

        }else if(localbody_type == 3)
        {   $(con+'.muncipality_div').hide();
            $(con+'.muncipality_id').val('');
            clear_panchayath_div(con); 
            $(con+'.corporation_div').show(); 
            var key=$(con+'.corporation_id');
            var flag='corporation_id';
            clear_panchayath_data(con);
        }else if(localbody_type == 1)
        {   
            $(con+'.muncipality_div').hide();
            $(con+'.muncipality_id').val('');
            $(con+'.corporation_id').val('');
            $(con+'.corporation_div').hide();  
            $(con+'.pan_type_div').show(); 
            var key=$(con+'.panchayath_type');
            var flag='panchayath_type';    

        }else{

        }

        
        if(localbody_type == 1)
        {
            $.ajax({
            url: url+"/get_panchayath_details",
            type: "POST",
            data: { 
                "distid":distid,
                "customer_id":customer_id,
                "form_id":con
            },
            dataType: "json",
            }).done(function(results){
                var data=results.localbodytype_arr;
                var user_details=results.user_det;
               
                if (data != 0) {
                    
                        $(key).empty();
                        $(key).append("<option value=''>Select Panchayath Type</option>");
                        $.each(data, function(i, d) {
                            var opt = $('<option />');

                            if (d.id == user_details.panchayath_type) {

                                opt = "<option value='" + d.id + "' selected='selected'>" + d.type + " </option>";
                            } else {
                                opt = "<option value='" + d.id + "'>" + d.type + " </option>";
                            }

                            $(key).append(opt);
                        });
                        $('.panchayath_type').trigger('change');
                        
                    } else {
                        $(key).empty();
                        $(key).append("<option value=''>Select LocalBody</option>");
                    }
                    
            }).fail(function(jqXHR, ajaxOptions, thrownError){
             
            });
        }else{

 
        $.ajax({
        url: url+"/get_localbody",
        type: "POST",
        data: { 
            "distid":distid,
            "localbody_type":localbody_type,
            "customer_id":customer_id,
            "form_id":con
        },
        dataType: "json",
        }).done(function(results){
            var data=results.localbody;
            var user_details=results.user_det;
           console.log(user_details.flag)
            if (data != 0) {
               
                    $(key).empty();
                    $(key).append("<option value=''>Select LocalBody</option>");
                    $.each(data, function(i, d) {
                        var opt = $('<option />');

                        if (d.id == user_details.flag) {

                            opt = "<option value='" + d.id + "' selected='selected'>" + d.name + " </option>";
                        } else {
                            opt = "<option value='" + d.id + "'>" + d.name + " </option>";
                        }

                        $(key).append(opt);
                    });
                    $('.'+flag).trigger('change');
                } else {
                    $(key).empty();
                    $(key).append("<option value=''>Select LocalBody</option>");
                }
        }).fail(function(jqXHR, ajaxOptions, thrownError){
         
        });
    } 

    if(distid)
    {
        $.ajax({
            url: url+"/get_taluk_village",
            type: "POST",
            data: { 
                "district_id":distid,
                "type":7,
                "customer_id":customer_id,
                "form_id":con
                
            },
            dataType: "json",
        }).done(function(results){
            var arr=results.taluk_village;
            var user_details=results.user_det;
             if (arr != 0) {
                       
                        $(con+'.taluk_id').empty();
                        $(con+'.taluk_id').append("<option value=''>Select Taluk</option>");
                        $.each(arr, function(i, d) {
                            var opt = $('<option />');

                            if (d.id == user_details.taluk_id) {

                                opt = "<option value='" + d.id + "' selected='selected'>" + d.name + " </option>";
                            } else {
                                opt = "<option value='" + d.id + "'>" + d.name + " </option>";
                            }

                            $(con+'.taluk_id').append(opt);
                        });
                        
                         
                    } else {
                        $(con+'.taluk_id').empty();
                        $(con+'.taluk_id').append("<option value=''>Select Taluk</option>");
                    }
                   
        }).fail(function(jqXHR, ajaxOptions, thrownError){
             // alert('No response from district section');
        });

         $.ajax({
        url: url+"/get_taluk_village",
        type: "POST",
        data: { 
             "district_id":distid,
            "customer_id":customer_id,
            "type":8,
            "form_id":con
            
        },
        dataType: "json",
        }).done(function(results1){
            var arr=results1.taluk_village;
            var user_details=results1.user_det;
            if (arr != 0) {
                        
                        $(con+'.village_id').empty();
                        $(con+'.village_id').append("<option value=''>Select Village</option>");
                        $.each(arr, function(i, d) {
                            var opt = $('<option />');

                            if (d.id == user_details.village_id) {

                                opt = "<option value='" + d.id + "' selected='selected'>" + d.name + " </option>";
                            } else {
                                opt = "<option value='" + d.id + "'>" + d.name + " </option>";
                            }

                            $(con+'.village_id').append(opt);
                        });
                        
                         
                    } else {
                        $(con+'.village_id').empty();
                        $(con+'.village_id').append("<option value=''>Select Village</option>");
                    }
        }).fail(function(jqXHR, ajaxOptions, thrownError){
             // alert('No response from district section');
        });
        
    }
});

$(document).on('change', '.panchayath_type', function(){ 
  

    var panchayath_type = $(this).find(':selected').data('type');
    var con = "#"+$(this).closest("form").attr('id')+" ";
    var url = $("#base_url").val();
    var panchayath_type = $(this).val();
    var customer_id=$('#profile_id').val();
    var distid = $(con+'.district_id').val();

    
    if(panchayath_type == 6)
    {
        var key=$(con+'.grama_panchayath_id');
        $(con+'.dis_pan_div').hide();
        $(con+'.blk_pan_div').hide();
        $(con+'.gra_pan_div').show();
        $(con+'.pan_div').hide();  
        $(con+'.block_panchayath_id').val(''); 
        $(con+'.district_panchayath_id').val('');  
        $(con+'.panchayath_id').val(''); 
        var flag='';

    }else if(panchayath_type == 5){
        var key=$(con+'.district_panchayath_id');
        $(con+'.dis_pan_div').show();
        $(con+'.blk_pan_div').hide();
        $(con+'.gra_pan_div').hide(); 
        $(con+'.pan_div').hide();
        $(con+'.block_panchayath_id').val(''); 
        $(con+'.grama_panchayath_id').val('');  
        $(con+'.panchayath_id').val('');
         var flag='district_panchayath_id'; 
       
    }else if(panchayath_type == 4){
        var key=$(con+'.block_panchayath_id');
        $(con+'.dis_pan_div').hide();
        $(con+'.blk_pan_div').show(); 
        $(con+'.gra_pan_div').hide(); 
        $(con+'.pan_div').hide();
        $(con+'.district_panchayath_id').val('');   
        $(con+'.grama_panchayath_id').val('');  
         var flag='block_panchayath_id';      
    }

    $.ajax({
        url: url+"/get_panchayath",
        type: "POST",
        data: { 
            "panchayath_type":panchayath_type,
            "customer_id":customer_id,
            "distid":distid,
            "form_id":con
        },
        dataType: "json",
    }).done(function(results){
        var data=results.localbodytype_arr;
        var user_details=results.user_det;
         if(panchayath_type == 6)
            {
                var str=user_details.grama_panchayath_id;
            }
             if(panchayath_type == 5)
            {
                var str=user_details.district_panchayath_id;
            }
             if(panchayath_type == 4)
            {
                var str=user_details.block_panchayath_id;
            }
            
        if (data != 0) {      
                    $(key).empty();
                    $(key).append("<option value=''>Select Panchayath Type</option>");
                    $.each(data, function(i, d) {
                        var opt = $('<option />');

                        if (d.id == str) {

                            opt = "<option value='" + d.id + "' selected='selected'>" + d.name + " </option>";
                        } else {
                            opt = "<option value='" + d.id + "'>" + d.name + " </option>";
                        }

                        $(key).append(opt);
                    });

                $('.'+flag).trigger('change');    
        } else {
            $(key).empty();
            $(key).append("<option value=''>Select Panchayath Type1</option>");
        }
    }).fail(function(jqXHR, ajaxOptions, thrownError){
         // alert('No response from district section');
    });
});


$(document).on('change', ".block_panchayath_id", function(){ 
  

    var block_panchayath_id = $(this).find(':selected').data('type');
    var con = "#"+$(this).closest("form").attr('id')+" ";
    var url = $("#base_url").val();
    var block_panchayath_id = $(this).val();
    var customer_id=$('#profile_id').val();
    $.ajax({
        url: url+"/get_block_panchayath",
        type: "POST",
        data: { 
            "id":block_panchayath_id,
            "customer_id":customer_id,
            "form_id":con
            
        },
        dataType: "json",
    }).done(function(results){
        var arr=results.panchayath;
        var user_details=results.user_det;
        console.log(arr)

         if (arr != 0) {
                    $(con+'.pan_div').show(); 
                    $(con+'.panchayath_id').empty();
                    $(con+'.panchayath_id').append("<option value=''>Select Panchayath1</option>");
                    $.each(arr, function(i, d) {
                        var opt = $('<option />');

                        if (d.id == user_details.panchayath_id) {

                            opt = "<option value='" + d.id + "' selected='selected'>" + d.name + " </option>";
                        } else {
                            opt = "<option value='" + d.id + "'>" + d.name + " </option>";
                        }

                        $(con+'.panchayath_id').append(opt);
                    });
                    
                     
                } else {
                    $(con+'.panchayath_id').empty();
                    $(con+'.panchayath_id').append("<option value=''>Select Panchayath</option>");
                }
    }).fail(function(jqXHR, ajaxOptions, thrownError){
         // alert('No response from district section');
    });
});

$(document).on('change', '.officer_details', function(){ 
  

    var loc_id = $(this).find(':selected').val();
    var url = $("#base_url").val();
console.log("ece");

    $.ajax({
        url: url+"/get_officer_details",
        type: "POST",
        data: { 
            "loc_id":loc_id,
        },
        dataType: "json",
    }).done(function(results){
		$('#officer_detail').hide();
		$('#officer_div').hide();
		$('#officer_detail').find('option').not(':first').remove();$('#call_redirect').empty();
			if(results.length >0)
			{
				$('#officer_div').show();
				$('#officer_detail').show();
				for(var i=0;i<results.length;i++)
				{
					//alert(results[i]['mobile']);
					//$('#call_div').append(results[i]['mobile']);
					$('.officer_detail').append('<option value='+results[i]["mobile"]+'>'+results[i]["name"]+'-'+results[i]["mobile"]+'</option>');
					//$('#call_divTable').append("<tr><td>"+results[i]['mobile']+"</td></tr>");
				}
			}
    }).fail(function(jqXHR, ajaxOptions, thrownError){
         // alert('No response from district section');
    });
});


$(document).on('change', '.officer_detail', function(){ 
  

    var contact_no = $(this).find(':selected').val();
    var url = $("#base_url").val();
console.log(contact_no);
$('.call_redirect').empty();
$('.call_redirect').remove();
    $.ajax({
        url: url+"/get_call_url",
        type: "POST",
        data: { 
            "contact_no":contact_no,
        },
        dataType: "json",
    }).done(function(results){//alert("f");
		console.log(results);
		$('.officer_detail').parent().append('<div class="call_redirect"></div>');
		$('.call_redirect').append('<label>Call Number</label><br><a href="'+results.url+'/callmeout.php?number='+results.number+'&extension='+results.extension+'&callerid='+results.callerid+'" target="_blank"><i class="fa fa-phone" aria-hidden="true"></i>'+results.number+'</a>');
    }).fail(function(jqXHR, ajaxOptions, thrownError){
         // alert('No response from district section');
    });
});





