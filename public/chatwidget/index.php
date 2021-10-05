<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="customfont.css">
	<link rel="stylesheet" href="bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="tel/intlTelInput.css">
	<link rel="stylesheet" href="liv_live_chat.css">

	<script type="text/javascript" src="jquery_3-2-1.min.js"></script>
	<script type="text/javascript" src="liv_live_chat.js" ></script>
	<script type="text/javascript" src="tel/intlTelInput.js"></script>
</head>
<body>
	<div class="text-center"><img src="img/orichat.svg" width="300" style="margin-top:30vh;"></div>
</body>
<div id="chat_widget"></div>
<script>
    livXmppConnection.initialize({
		bosh_service_url: 'https://chat.oricoms.com:5280/http-bind',
		auth_credential_get_url: 'https://support.orisys.in/api/chat_api',
		host:'localhost',
		emoticons:true,
		auto_login:false,
		external_msg_store:true,
		external_msg_store_url:'https://support.orisys.in/api/save_chat_logs'
    });
</script>
</html>
