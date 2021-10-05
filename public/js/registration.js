$.ajaxSetup({ 
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function () {
	
	$('.coupon_code').hide();
	$('.submit-promo').hide();
	
	/**** password toggling on company registration form  *****/
	
	$(".toggle-password").click(function() {
		$(this).toggleClass("fa-eye fa-eye-slash");
		if ($(".cmp_pswd").attr("type") == "password"){
			$(".cmp_pswd").attr("type", "text");
		} 
		else{
			$(".cmp_pswd").attr("type", "password");
		}
	});
	
	$(".toggle-confrm_password").click(function() {
		$(this).toggleClass("fa-eye fa-eye-slash");
		if ($(".cmp_confrm_pswd").attr("type") == "password"){
			$(".cmp_confrm_pswd").attr("type", "text");
		} 
		else{
			$(".cmp_confrm_pswd").attr("type", "password");
		}
	});
	
	
  
    var util_class=$('#util_class').val();
    $("#mobile").intlTelInput({
            separateDialCode: true,
            utilsScript: util_class
    });
	
	$('.plan_more').hide();
	
});

        /**** NEW REGISTRATION AND SUBSCRIPTION  ****/   
			   
	function sub_pop_up(amt='',planid='',plan='',coupon_code='',discount='',disc_off='',off_amt='')
	{
		$('#order_details').modal({backdrop: 'static', keyboard: false})
		var url = $("#base_url").val();
		$.ajax({
			type: "POST",
			dataType: "html",
			url: url+"/choose_subcr_period",
			data: {
				"amount": amt,
				"plan_id": planid,
				"plan": plan,
				"coupon_code": coupon_code,
				"discount": discount,
				"discount_off": disc_off,
				"disc_off_amt": off_amt
				},
			
		}).done(function(msg) {
			
			  $('.planContainer').show();
			  $('.planContainer').html(msg);
			  
		}).fail(function(jqXHR, ajaxOptions, thrownError){
			
			  alert('Order details are not available');
		}); 
		
    }

            /**** UPGRADED SUBSCRIPTION  ****/   
			   
	function new_subscription(amt='',planid='',plan='',cmp_id='',coupon_code='',discount='',disc_off='',off_amt='',first_sub_flag='')
	{
		$('#order_details').modal({backdrop: 'static', keyboard: false})
		var url = $("#base_url").val();
		$.ajax({
			type: "POST",
			dataType: "html",
			url: url+"/nxt_subscribtion",
			data: {
				"amount": amt,
				"plan_id": planid,
				"plan": plan,
				"cmp_id": cmp_id,
				"coupon_code": coupon_code,
				"discount": discount,
				"discount_off": disc_off,
				"disc_off_amt": off_amt,
				"first_sub_flag": first_sub_flag,
				},
			
		}).done(function(msg) {
			
			  $('.planContainer').show();
			  $('.planContainer').html(msg);
			  
		}).fail(function(jqXHR, ajaxOptions, thrownError){
			
			  alert('Order details are not available');
		}); 
		
    }
	
	
			/*** function for displaying currently available coupon code  ***/
	
	$(document).on('click', 'input.savemore', function (e) {
	  var a	= $(this).data('inc');
	  $('#coupon_code'+a).show();
	  $('#apply_promo').text('Apply this promo code for the best discount'); 
		
	});
	
			/*** function for checking promocode is valid or not  ***/
	
	$(document).on('click', 'input.submit-promo', function (e) {
		//var total_amount	= '';
		//var promocode	= '';
		//var coupon_code	= '';
		var disc_amt	= '';
		var promocode		= $('.promocode').val();
		var coupon_code		= $('.coupon_code').val();
		var disc_amt		= $('#disc_amt').val();
		var total_amount	= $('#tot_amt').val();
		if(promocode == coupon_code)
		{   total_amount = (total_amount - disc_amt);
			$('.valid_promo').val(1);
			$('.submit-promo').hide();
			$('.promo_success').text('You have saved  ' +disc_amt+' Rs');
			$('.promo_success').delay(1000).fadeOut();
			$('#tot_amt').html(total_amount);
		}
		
		else{$('.submit-promo').hide();
		$('.promocode_err').text('Invalid promocode');
		$('.promocode_err').delay(500).fadeOut();
		$('.valid_promo').val(0);$('#tot_amt').html(total_amount);}
		
		
	});
	
	
			/**** calculating subscription amount on choosing period *****/
	
	$(document).on('click', 'input.term_length', function (e) {
		
	  var a	= $(this).val();
	  var amt	= $('#amt').val();
	  var total_amount = a*amt;
	  $('#tot_amt').html(total_amount);
	  $('.submit-promo').show();
		
	});
	
	
	
	

	