<?php include 'config.php'; 
/*
if(!isset($_SESSION['SessionMemberID']) && $_SESSION['SessionMemberID'] !='')
{
	header("location: home.php");	
}*/

?>
<!doctype html>
<html>
<head>
<!-- Include meta tag to ensure proper rendering and touch zooming -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Include jQuery Mobile stylesheets -->
<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">

<!-- Include the jQuery library -->
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Include the jQuery Mobile library -->
<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

<link rel="stylesheet" href="css/style1_m.css"/>
<title>SpiritLyft</title>
</head>
<body>
<script type="text/javascript" src="js/countries.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
	function loginpage()
	{
		window.location = "m_login.php";
	}
	
	function createaccountpage()
	{
		window.location = "m_createaccount.php";	
	}
</script>
<header>
    	<div id="header_sub">
            <div id="title1"><img src="image/sl_logo2.png" /></div>
        </div>
    </header>
<style>
#forgotpassword_panel
{
	width:98%;
	border:2px black solid;
	border-radius:4px;
}

#forgotpassword_panel tr
{
	text-align:center;
}

#forgotpassword_panel caption
{
	font-family:Arial;
	font-weight:bold;
	font-size:24px;	
}

#forgotpassword_panel input
{
	padding:6px 6px 6px 6px;
	width:96%;
}

#forgotpassword_panel button
{
	padding:6px 6px 6px 6px;
	width:100%;
	background-color:#4A338E;
	border:none;
	color:white;
	font-family:Arial Black;
}

.notification_em
{
	font-size:14px;
	font-family:Arial;
	font-weight:bold;
}

.message_alert
{
	font-size:14px;
	font-family:Arial;
	font-weight:bold;
}
</style>
<script type="text/javascript">
	function sendlink()
	{
		$.post("include/forgotten_password.php", {email: document.getElementById("email").value}, function(result){
			if(result == 0)
			{
				$(".message_alert").html('Your link has been sent to your email. Note: in case of you dont see your email please check the spam and junk folder.');
				$(".message_alert").css("color","green");	
			}
			else
			{
				$(".message_alert").html('Your link has not been sent to your email, because that email is not in the system.');
				$(".message_alert").css("color","red");	
			}
		});	
	}
</script>
	<div id="body" style="">
    	<table id="forgotpassword_panel" align="center" cellpadding="4" cellspacing="5">
        	<caption>Forgot Password</caption>
        	<tr class="notification_em">
            	<td>
                	if account is associated with the email address you will receive the link.
                </td>
            </tr>
            <tr>
            	<td>
                	<input type="email" id="email" name="email" />
                </td>
            </tr>
            <tr>
            	<td class="message_alert">
                	
                </td>
            </tr>
            <tr>
            	<td>
                	<button onClick="sendlink();">Submit</button>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>