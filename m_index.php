<?php include 'config.php'; 
/*if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off")
{
	header("location: https://www.spiritlyft.com");
	exit();
}*/


if(isset($_SESSION['SessionMemberID']) && $_SESSION['SessionMemberID'] !='')
{
	header("location: m_home.php");	
}
elseif(isset($_COOKIE['MemberID']) && isset($_COOKIE['MemberPassword']))
{
	$_SESSION['SessionMemberID'] = $_COOKIE['MemberID'];
	$_SESSION['SessionMemberPassword'] = $_COOKIE['MemberPassword'];
	header("location: m_home.php");	
}

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
            <div id="title1"><img src="image/sl_logo2.png" style="margin-top: 10px;"/></div>
        </div>
    </header>
    <style>
    .site_info
	{
		font-family:Helvetica;
		font-size:14px;
		width:100%;
		border-radius:14px;
		padding:8px 8px 8px 8px;
	}
    </style>
	<div id="body" style="width:80%;">
        <button class="button_style1" onClick="createaccountpage();" >Create Account</button>
        <button class="button_style1" onClick="loginpage();">Login</button>
        <div align="center"><a id="forgot-password" href="m_forgot-password.php">Forgot Password</a></div><br>
        <div style="width: 99%; text-align: center; margin-top: 5%; float: left; font-weight: bold; font-size: 22px; font-family: Arial;">ALL SOCIAL &nbsp; - &nbsp; NO MEDIA</div><br><br><br>
        <div class="site_info">
        	Welcome to our site. We want you to enjoy and have a great time connecting with family and friends, in a positive and enjoyable way. <br><br>
            SpiritLyft does not allow any politics, nudity, bullying, threats or aggressive language.<br><br>
            We hope you enjoy the site and ask that you respect others.<br><br>
            Violation of terms of use or disrespecting others will result in your account being deleted. Thank you.
            <br><br>
            Phone Number is optional, However, you will not be able to receive text alerts for Calendar Events. Also your phone number is secure and will not be sold.
        </div>
    </div>
</body>
</html>