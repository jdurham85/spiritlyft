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
<header>
        <div id="title1" align="center"><img src="image/sl_logo2.png" /></div>
</header>
<style>
#passwordreset_panel
{
	width:98%;
	border:2px black solid;
	border-radius:4px;
}

#passwordreset_panel tr
{
	text-align:center;
}

#passwordreset_panel caption
{
	font-family:Arial;
	font-weight:bold;
	font-size:24px;	
}

#passwordreset_panel input
{
	padding:6px 6px 6px 6px;
	width:96%;
}

#passwordreset_panel button
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
<?php //echo base64_decode($_GET['m']); ?>
function checkpassword()
{
	var p = document.getElementById("userpassword").value;
	var cp = document.getElementById("userconfirmpassword").value;
	
	if(p == cp)
	{
		if(p.length < 5)
		{
			document.getElementById("message_alert").innerHTML = "Password must be at least 5 char long.";		
		}
		else
		{
			document.getElementById("password_btn").innerHTML = "Loggin Please ...";
			
			$.post("include/setNewPassword.php", {m: document.getElementById("m").value, hc: document.getElementById("hc").value, userpassword: p}, function(d){
				if(d == 1)
				{
					nav_to_home();	
				}
				});	
		}
	}	
	else
	{
		document.getElementById("message_alert").innerHTML = "Password and Confirm Password dosen't match";	
	}
}

function nav_to_home()
{
	window.location = "home.php";	
} 
</script>
	<div id="body">
    	<input type="hidden" id="m" value="<?php echo $_GET['m']; ?>" />
    	<input type="hidden" id="hc" value="<?php echo $_GET['hc']; ?>" />
        <table id="passwordreset_panel" align="center" cellpadding="4" cellspacing="5">
        	<caption>Password Reset</caption>
			<tr>
            	<td id="message_alert">
                	
                </td>
            </tr>
            <tr>
            	<td>
                	<input placeholder="New Password" type="password" id="userpassword" name="userpassword" />
                </td>
            </tr>
            <tr>
            	<td>
                	<input placeholder="Confirm New Password" type="password" id="userconfirmpassword" name="userconfirmpassword" />
                </td>
            </tr>
            <tr>
            	<td>
                	<button onClick="checkpassword();" id="password_btn">Change Password</button>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>