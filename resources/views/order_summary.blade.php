@extends('layouts.login')
@section('title')
{{config('constant.site_title')}} - Company Registration
@endsection
@section('content')
	<nav class="navbar navbar-expand-lg navbar-light fixed-top py-0"> <a class="navbar-brand" href="/"> <img width="125px" src="{{url('/')}}/img/logo-white.png" alt=""/> </a>
</nav>
<div class="registration_form">
<div class="container">
		<div class="row mt-5 justify-content-md-center">
			<div class="col-md-9 mt-5">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>{{__('Billing Details')}}</h3></div>
                <div class="panel-body">
				<p class="response"></p>
				<form action="http://beta.oricoms.com/ccavRequestHandler" name="customerData" class="form-common-data" name="form-common-data" id ="enquiry_form">
				<input type="hidden" name="_token"  value="{{ csrf_token() }}">
				@foreach ($res as $compny)
				@php $order_id	=	rand(100000000,999999999); @endphp
				{{ Form::hidden('order_id',$order_id, array('class' => 'form-control' )) }}
				{{ Form::hidden('months',$mnths, array('class' => 'form-control' )) }}
				<input type="hidden" name="plan" value="{{$compny->ori_cmp_org_plan}}">
				{{ Form::hidden('company_id',$cmp_id, array('class' => 'form-control' )) }}
				{{ Form::hidden('merchant_id', '79668', array('class' => 'form-control' )) }}
				{{ Form::hidden('currency', 'INR', array('class' => 'form-control' )) }}
				{{ Form::hidden('amount', $amt, array('class' => 'form-control' )) }}
				
				{{ Form::hidden('off',$off, array('class' => 'form-control' )) }}
				{{ Form::hidden('off_amt', $off_amt, array('class' => 'form-control' )) }}
				{{ Form::hidden('c_amt',$c_amt, array('class' => 'form-control' )) }}
				{{ Form::hidden('coupon', $coupon, array('class' => 'form-control' )) }}
				
				
				{{ Form::hidden('redirect_url', 'http://beta.oricoms.com/Payment/ccavResponseHandler.php', array('class' => 'form-control' )) }}
				{{ Form::hidden('cancel_url', 'http://beta.oricoms.com/Payment/ccavResponseHandler.php', array('class' => 'form-control' )) }}
				{{ Form::hidden('language', 'EN', array('class' => 'form-control' )) }}
				<div class="row col-md-12">
				
				<div class="col-md-4 col-md-offset-4 form-group">
					<label for="name" class="col-md-6 control-label">{{__('Company Name')}}</label>
					<input type="text" value="{{$compny->ori_cmp_org_name}}" name="billing_name" id= "billing_name" class="form-control">
					<span class="error" id="name_err"></span>
				</div>
				<div class="col-md-4 col-md-offset-4 form-group">
					<label for="name" class="col-md-6 control-label">{{__('City')}}</label>
					<input type="text" value="{{$compny->ori_cmp_org_city}}" name="billing_city" id= "billing_city" class="form-control">
					<span class="error" id="name_err"></span>
				</div>
				
				<div class="col-md-4 form-group">
					<label for="name" class="col-md-6 control-label">{{__('Email')}}</label>
					<input type="text" value="{{$compny->ori_cmp_org_email}}" name="billing_email" id= "billing_email" class="form-control">
					<span class="error" id="name_err"></span>
				</div>
				
				<div class="col-md-8 form-group">
					<label for="name" class="col-md-6 control-label">{{__('Address')}}</label>
					<textarea name="billing_address" id= "billing_address" rows="3" class="form-control">{{$compny->ori_cmp_org_address}}</textarea><span class="error" id="name_err"></span>
				</div>
				
				
				
				<div class="col-md-4 form-group">
					<label for="name" class="col-md-6 control-label">{{__('State')}}</label>
					<input type="text" value="{{$compny->ori_cmp_org_state}}" name="billing_state" id= "billing_state" class="form-control"><span class="error" id="name_err"></span>
				</div>
				
				<input type="hidden" name="billing_zip" value="{{$compny->ori_cmp_org_pincode}}" id="billing_zip">
				
				
				<div class="col-md-4 form-group">
					<label for="name" class="col-md-6 control-label">{{__('Country')}}</label>
					<input type="text" value="{{$compny->ori_cmp_org_country}}" name="delivery_country" id= "delivery_country" class="form-control"><span class="error" id="name_err" ></span>
				</div>
				
				<div class="col-md-4 form-group">
					<label for="name" class="col-md-6 control-label">{{__('Office No')}}</label>
					<input type="text" value="{{$compny->ori_cmp_org_phone}}" name="billing_tel" id= "billing_tel" class="form-control">
					<span class="error" id="name_err"></span>
				</div>
				<div class="col-md-4 form-group">
					<label for="name" class="col-md-6 control-label">{{__('Amount')}}</label>
					<input type="text" value="{{$amt}}  Rs" name="amont" id="amont" readonly="true" class="form-control">					
					<span class="error" id="name_err"></span>
				</div>
				
				</div>
				
				
				
				<div class="row">
				<div class="col-md-4 form-group">
					{{ Form::hidden('tid', '', array('class' => 'form-control','id' => 'tid', 'readonly' => 'readonly')) }}	
					<span class="error" id="name_err"></span>
				</div>
				
				</div>
				@endforeach
				
				
				<div class="form-group">
                    <div class="col-md-6 col-md-offset-6">
						<button type="submit" class="btn btn-primary" id="register">{{__('CheckOut')}}</button>
					</div>
				</div>
				
			</form>
			</div>
		</div>
	</div>
	 </div>
</div>
@endsection
<script language="javascript" type="text/javascript" src="js/json.js"></script>
<script src="js/jquery-1.7.2.min.js"></script>
<script>
	window.onload = function() {
		var d = new Date().getTime();
		document.getElementById("tid").value = d;
	};
</script>
<script type="text/javascript">
  $(function(){
  
	 /* json object contains
	 	1) payOptType - Will contain payment options allocated to the merchant. Options may include Credit Card, Net Banking, Debit Card, Cash Cards or Mobile Payments.
	 	2) cardType - Will contain card type allocated to the merchant. Options may include Credit Card, Net Banking, Debit Card, Cash Cards or Mobile Payments.
	 	3) cardName - Will contain name of card. E.g. Visa, MasterCard, American Express or and bank name in case of Net banking. 
	 	4) status - Will help in identifying the status of the payment mode. Options may include Active or Down.
	 	5) dataAcceptedAt - It tell data accept at CCAvenue or Service provider
	 	6)error -  This parameter will enable you to troubleshoot any configuration related issues. It will provide error description.
	 */	  
  	  var jsonData;
  	  var access_code="" // shared by CCAVENUE 
	  var amount="6000.00";
  	  var currency="INR";
  	  
      $.ajax({
           url:'https://secure.ccavenue.com/transaction/transaction.do?command=getJsonData&access_code='+access_code+'&currency='+currency+'&amount='+amount,
           dataType: 'jsonp',
           jsonp: false,
           jsonpCallback: 'processData',
           success: function (data) { 
                 jsonData = data;
                 // processData method for reference
                 processData(data); 
		 // get Promotion details
                 $.each(jsonData, function(index,value) {
			if(value.Promotions != undefined  && value.Promotions !=null){  
				var promotionsArray = $.parseJSON(value.Promotions);
		               	$.each(promotionsArray, function() {
					console.log(this['promoId'] +" "+this['promoCardName']);	
					var	promotions=	"<option value="+this['promoId']+">"
					+this['promoName']+" - "+this['promoPayOptTypeDesc']+"-"+this['promoCardName']+" - "+currency+" "+this['discountValue']+"  "+this['promoType']+"</option>";
					$("#promo_code").find("option:last").after(promotions);
				});
			}
		});
           },
           error: function(xhr, textStatus, errorThrown) {
               alert('An error occurred! ' + ( errorThrown ? errorThrown :xhr.status ));
               //console.log("Error occured");
           }
   		});
   		
   		$(".payOption").click(function(){
   			var paymentOption="";
   			var cardArray="";
   			var payThrough,emiPlanTr;
		    var emiBanksArray,emiPlansArray;
   			
           	paymentOption = $(this).val();
           	$("#card_type").val(paymentOption.replace("OPT",""));
           	$("#card_name").children().remove(); // remove old card names from old one
            $("#card_name").append("<option value=''>Select</option>");
           	$("#emi_div").hide();
           	
           	//console.log(jsonData);
           	$.each(jsonData, function(index,value) {
           		//console.log(value);
            	  if(paymentOption !="OPTEMI"){
	            	 if(value.payOpt==paymentOption){
	            		cardArray = $.parseJSON(value[paymentOption]);
	                	$.each(cardArray, function() {
	    	            	$("#card_name").find("option:last").after("<option class='"+this['dataAcceptedAt']+" "+this['status']+"'  value='"+this['cardName']+"'>"+this['cardName']+"</option>");
	                	});
	                 }
	              }
	              
	              if(paymentOption =="OPTEMI"){
		              if(value.payOpt=="OPTEMI"){
		              	$("#emi_div").show();
		              	$("#card_type").val("CRDC");
		              	$("#data_accept").val("Y");
		              	$("#emi_plan_id").val("");
						$("#emi_tenure_id").val("");
						$("span.emi_fees").hide();
		              	$("#emi_banks").children().remove();
		              	$("#emi_banks").append("<option value=''>Select your Bank</option>");
		              	$("#emi_tbl").children().remove();
		              	
	                    emiBanksArray = $.parseJSON(value.EmiBanks);
	                    emiPlansArray = $.parseJSON(value.EmiPlans);
	                	$.each(emiBanksArray, function() {
	    	            	payThrough = "<option value='"+this['planId']+"' class='"+this['BINs']+"' id='"+this['subventionPaidBy']+"' label='"+this['midProcesses']+"'>"+this['gtwName']+"</option>";
	    	            	$("#emi_banks").append(payThrough);
	                	});
	                	
	                	emiPlanTr="<tr><td>&nbsp;</td><td>EMI Plan</td><td>Monthly Installments</td><td>Total Cost</td></tr>";
							
	                	$.each(emiPlansArray, function() {
		                	emiPlanTr=emiPlanTr+
							"<tr class='tenuremonth "+this['planId']+"' id='"+this['tenureId']+"' style='display: none'>"+
								"<td> <input type='radio' name='emi_plan_radio' id='"+this['tenureMonths']+"' value='"+this['tenureId']+"' class='emi_plan_radio' > </td>"+
								"<td>"+this['tenureMonths']+ "EMIs. <label class='merchant_subvention'>@ <label class='emi_processing_fee_percent'>"+this['processingFeePercent']+"</label>&nbsp;%p.a</label>"+
								"</td>"+
								"<td>"+this['currency']+"&nbsp;"+this['emiAmount'].toFixed(2)+
								"</td>"+
								"<td><label class='currency'>"+this['currency']+"</label>&nbsp;"+ 
									"<label class='emiTotal'>"+this['total'].toFixed(2)+"</label>"+
									"<label class='emi_processing_fee_plan' style='display: none;'>"+this['emiProcessingFee'].toFixed(2)+"</label>"+
									"<label class='planId' style='display: none;'>"+this['planId']+"</label>"+
								"</td>"+
							"</tr>";
						});
						$("#emi_tbl").append(emiPlanTr);
	                 } 
                  }
           	});
           	
         });
   
	  
      $("#card_name").click(function(){
      	if($(this).find(":selected").hasClass("DOWN")){
      		alert("Selected option is currently unavailable. Select another payment option or try again later.");
      	}
      	if($(this).find(":selected").hasClass("CCAvenue")){
      		$("#data_accept").val("Y");
      	}else{
      		$("#data_accept").val("N");
      	}
      });
          
     // Emi section start      
          $("#emi_banks").live("change",function(){
	           if($(this).val() != ""){
	           		var cardsProcess="";
	           		$("#emi_tbl").show();
	           		cardsProcess=$("#emi_banks option:selected").attr("label").split("|");
					$("#card_name").children().remove();
					$("#card_name").append("<option value=''>Select</option>");
				    $.each(cardsProcess,function(index,card){
				        $("#card_name").find("option:last").after("<option class=CCAvenue value='"+card+"' >"+card+"</option>");
				    });
					$("#emi_plan_id").val($(this).val());
					$(".tenuremonth").hide();
					$("."+$(this).val()+"").show();
					$("."+$(this).val()).find("input:radio[name=emi_plan_radio]").first().attr("checked",true);
					$("."+$(this).val()).find("input:radio[name=emi_plan_radio]").first().trigger("click");
					 
					 if($("#emi_banks option:selected").attr("id")=="Customer"){
						$("#processing_fee").show();
					 }else{
						$("#processing_fee").hide();
					 }
					 
				}else{
					$("#emi_plan_id").val("");
					$("#emi_tenure_id").val("");
					$("#emi_tbl").hide();
				}
				
				
				
				$("label.emi_processing_fee_percent").each(function(){
					if($(this).text()==0){
						$(this).closest("tr").find("label.merchant_subvention").hide();
					}
				});
				
		 });
		 
		 $(".emi_plan_radio").live("click",function(){
			var processingFee="";
			$("#emi_tenure_id").val($(this).val());
			processingFee=
					"<span class='emi_fees' >"+
			 			"Processing Fee:"+$(this).closest('tr').find('label.currency').text()+"&nbsp;"+
			 			"<label id='processingFee'>"+$(this).closest('tr').find('label.emi_processing_fee_plan').text()+
			 			"</label><br/>"+
                			"Processing fee will be charged only on the first EMI."+
                	"</span>";
             $("#processing_fee").children().remove();
             $("#processing_fee").append(processingFee);
             
             // If processing fee is 0 then hiding emi_fee span
             if($("#processingFee").text()==0){
             	$(".emi_fees").hide();
             }
			  
		});
		
		
		$("#card_number").focusout(function(){
			/*
			 emi_banks(select box) option class attribute contains two fields either allcards or bin no supported by that emi 
			*/ 
			if($('input[name="payment_option"]:checked').val() == "OPTEMI"){
				if(!($("#emi_banks option:selected").hasClass("allcards"))){
				  if(!$('#emi_banks option:selected').hasClass($(this).val().substring(0,6))){
					  alert("Selected EMI is not available for entered credit card.");
				  }
			   }
		   }
		  
		});
			
			
	// Emi section end 		
   
   
   // below code for reference 
 
   function processData(data){
         var paymentOptions = [];
         var creditCards = [];
         var debitCards = [];
         var netBanks = [];
         var cashCards = [];
         var mobilePayments=[];
         $.each(data, function() {
         	 // this.error shows if any error   	
             console.log(this.error);
              paymentOptions.push(this.payOpt);
              switch(this.payOpt){
                case 'OPTCRDC':
                	var jsonData = this.OPTCRDC;
                 	var obj = $.parseJSON(jsonData);
                 	$.each(obj, function() {
                 		creditCards.push(this['cardName']);
                	});
                break;
                case 'OPTDBCRD':
                	var jsonData = this.OPTDBCRD;
                 	var obj = $.parseJSON(jsonData);
                 	$.each(obj, function() {
                 		debitCards.push(this['cardName']);
                	});
                break;
              	case 'OPTNBK':
	              	var jsonData = this.OPTNBK;
	                var obj = $.parseJSON(jsonData);
	                $.each(obj, function() {
	                 	netBanks.push(this['cardName']);
	                });
                break;
                
                case 'OPTCASHC':
                  var jsonData = this.OPTCASHC;
                  var obj =  $.parseJSON(jsonData);
                  $.each(obj, function() {
                  	cashCards.push(this['cardName']);
                  });
                 break;
                   
                  case 'OPTMOBP':
                  var jsonData = this.OPTMOBP;
                  var obj =  $.parseJSON(jsonData);
                  $.each(obj, function() {
                  	mobilePayments.push(this['cardName']);
                  });
              }
              
            });
           
           //console.log(creditCards);
          // console.log(debitCards);
          // console.log(netBanks);
          // console.log(cashCards);
         //  console.log(mobilePayments);
            
      }
  });
</script>
</html>
