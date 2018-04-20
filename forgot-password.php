<?php 
session_start();
include 'config.php'; 

if(isset($_SESSION['SessionMemberID']) && $_SESSION['SessionMemberID'] !='')
{
	header("location: home.php");	
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/style1.css"/>
<title>SpiritLyft</title>
</head>
<body>
<script type="text/javascript" src="js/countries.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<header>
        <div id="title1" align="center"><img src="image/sl_logo2.png" /></div>
</header>
<style>
#forgotpassword_panel
{
	width:50%;
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
	<div id="body">
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