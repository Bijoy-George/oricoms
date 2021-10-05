<?php include('Crypto.php')?>
<?php

	error_reporting(0);
	
	$workingKey='576C141736AC495D5087F4020CAD28FA';		//Working Key should be provided here.
	$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
	$rcvdString=decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
	$order_status="";
	$decryptValues=explode('&', $rcvdString);
	$dataSize=sizeof($decryptValues);
	echo "<center>";
	echo '<input type="hidden" id="txnstr" value"'.$encResponse.'">';
	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
		if($i==3)	$order_status=$information[1];
	}

	if($order_status==="Success")
	{
		echo "<br>Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";
		
	}
	else if($order_status==="Aborted")
	{
		echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
	
	}
	else if($order_status==="Failure")
	{
		echo "<br>Thank you for shopping with us.However,the transaction has been declined.";
	}
	else
	{
		echo "<br>Security Error. Illegal access detected";
	
	}

	echo "<br><br>";

	echo "<table cellspacing=4 cellpadding=4>";
	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
	    	echo '<tr><td>'.$information[0].'</td><td>'.urldecode($information[1]).'</td></tr>';
	}

	echo "</table><br>";
	echo "</center>";
	function base_url()
	{
    return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . '/';
	}
	echo $base_url=base_url();
?>
<html>
<head>
<link href="http://beta.oricoms.com/css/jquery-ui.min.css" rel="stylesheet">
<script src="http://beta.oricoms.com/js/jquery-3.3.1.min.js"></script>
<script src="http://beta.oricoms.com/js/jquery.preloader.min.js"></script> 
<script src="http://beta.oricoms.com/js/jquery-ui.min.js"></script> 
<script>

$(document).ready(function(){
	alert(123);
	var payment_details = $('#txnstr').val();
		
	jQuery.ajax({
	type: "POST",
	url: "http://beta.oricoms.com/update_payment",
	data:{payment_details: payment_details},
	success: function(res) 
	{
	console.log("success");
	}
	});
}
});
</script> 
</head>
</html>


