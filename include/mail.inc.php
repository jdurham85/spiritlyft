<?php 
function send_message_to_all($toMember, $Message)
{
	$headers = "From: Spiritlyft <admin@spiritlyft.com> \r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
	
	$htmlbody = "
	<html>
	<head>
		<title>SpiritLyft</title>
		<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1'>
	</head>
	<body>
		<div id='body'>
			<header>
				<div id='header_sub' style='background-color:#795FC5; line-height:60px;'>
					<div id='title1'><a href='https://www.spiritlyft.com'><img src='https://www.spiritlyft.com/image/sl_logo2.png' /></a></div>
				</div>
			</header>
			<style type='text/css'>
			
			.userinfo button
			{
				
			}
			</style>
			<div style='padding-top:50px; font-family: arial; font-size: 14px; font-weight: bold;margin: auto; width:100%;'>
				<strong>From Spiritlyft</strong><br><br>
				".$Message."
			</div>
	<body>
	</html>";
	
	$MemberEmail = MemberEmail($toMember);
	
	@mail($MemberEmail, "SpiritLyft", $htmlbody, $headers);
}

function send_text_message($toMember, $Message)
{
	$SMSgateway = get_mobile_SMSgateway(get_member_mobile_provider($toMember));
	
	//if(!$SMSgateway == "")
	//{
		$MemberPhoneNumber = str_replace("-", "", MemberPhoneNumber($toMember));

		//@mail("$MemberPhoneNumber"."@"."$SMSgateway", "",$Message,"SpiritLyft \r\n ");
		@mail("$MemberPhoneNumber"."@"."$SMSgateway", "",$Message, "From: SpiritLyft" . "\r\n" . "Content-Type: text/plain; charset=utf-8",
        "-fadmin@spiritlyft.com");
	//}
}

function send_connection_request_email($toMember, $fromMember)
{
	$headers = "From: Spiritlyft <admin@spiritlyft.com> \r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	$htmlbody = "<!DOCTYPE html>
	<html>
	<head>
		<title>SpiritLyft</title>
	</head>
	<body style='margin:auto;'>
		<div id='body' style='width:100%; margin:auto;' align='center'>
			<header>
				<div id='header_sub' style='line-height:40px; background-color:#795FC5;'>
					<div id='title1'><a href='https://www.spiritlyft.com'><img src='https://www.spiritlyft.com/image/sl_logo2.png' /></a></div>
				</div>
			</header>
			
			<div style='padding-top:50px; font-family: arial; font-size: 25px; font-weight: bold;margin: auto; width:100%;'>
				".MemberFullName($fromMember)."	has sent you a connection. <br>
				<a href='https://www.spiritlyft.com/community.php?mode=1'>Click here to view My Friends & Family Page</a>
			</div>
		</div>
	<body>
	</html>";
	
	$MemberEmail = MemberEmail($toMember);
	
	@mail($MemberEmail, "Connection Request", $htmlbody, $headers);
}

function send_Calender_AlertEmail($toMember, $title, $title2, $title3)
{
	$headers = "From: Spiritlyft <admin@spiritlyft.com> \r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
	$htmlbody = "<!DOCTYPE html>
	<html>
	<head>
		<title>SpiritLyft</title>
	</head>
	<body style='margin:auto;'>
		<div id='body' style='width:100%; margin:auto;' align='center'>
			<header>
				<div id='header_sub' style='background-color:#795FC5; line-height:60px;'>
					<div id='title1'><a href='https://www.spiritlyft.com'><img src='https://www.spiritlyft.com/image/sl_logo2.png' /></a></div>
				</div>
			</header>
			
			<div style='padding-top:50px; font-family: arial; font-size: 25px; font-weight: bold;margin: auto; width:100%;'>
				".$title." <br>
				".$title2."<br><br>
				".$title3." <br><br>
			</div>
		</div>
	<body>
	</html>";
	
	$MemberEmail = MemberEmail($toMember);
	
	@mail($MemberEmail, $title, $htmlbody, $headers);
}

function send_security_mail($toMember)
{
	$headers = "From: Spiritlyft <admin@spiritlyft.com> \r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
	
	$htmlbody = "
	<html>
	<head>
		<title>SpiritLyft</title>
		<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1'>
	</head>
	<body>
		<div id='body'>
			<header>
				<div id='header_sub' style='background-color:#795FC5; line-height:30px;'>
					<div id='title1'><a href='https://www.spiritlyft.com'><img src='https://www.spiritlyft.com/image/sl_logo2.png' /></a></div>
				</div>
			</header>
			<style type='text/css'>
			
			.userinfo button
			{
				
			}
			</style>
			<div style='padding-top:25px; font-family: arial; font-size: 14px; font-weight: bold;margin: auto; width:100%;'>
				After 3 Hour of Inactivity Spiritlyft will automatically log you out, for your Safety and Security, Thank You
			</div>
		</div>
	<body>
	</html>";
	
	$MemberEmail = MemberEmail($toMember);
	
	@mail($MemberEmail, "SpiritLyft", $htmlbody, $headers);
}

function send_welcome_letter($toMember)
{
	$headers = "From: Spiritlyft <admin@spiritlyft.com> \r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
	
	$htmlbody = "
	<html>
	<head>
		<title>SpiritLyft</title>
		<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1'>
	</head>
	<body>
		<div id='body'>
			<header>
				<div id='header_sub' style='background-color:#795FC5; line-height:30px;'>
					<div id='title1'><a href='https://www.spiritlyft.com'><img src='https://www.spiritlyft.com/image/sl_logo2.png' /></a></div>
				</div>
			</header>
			<style type='text/css'>
			
			.userinfo button
			{
				
			}
			</style>
			<div style='padding-top:50px; font-family: arial; font-size: 14px; font-weight: bold;margin: auto; width:100%;'>
				Thank you and welcome to the SpiritLyft family where <strong>“All Social--No Media”</strong> is our motto. Enjoy your time here connecting with family and friends and help us to make your experience with SpiritLyft a fun and exciting time.
			</div>
		</div>
	<body>
	</html>";
	
	$MemberEmail = MemberEmail($toMember);
	
	@mail($MemberEmail, "SpiritLyft", $htmlbody, $headers);
}

function sendPasswordResetLink($toMember, $passwordlink)
{	
	$headers = "From: Spiritlyft <admin@spiritlyft.com> \r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
	
	$htmlbody = "
	<html>
	<head>
		<title>SpiritLyft</title>
		<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1'>
	</head>
	<body>
		<div id='body'>
			<header>
				<div id='header_sub' style='background-color:#795FC5; line-height:60px;'>
					<div id='title1'><a href='https://www.spiritlyft.com'><img src='https://www.spiritlyft.com/image/sl_logo2.png' /></a></div>
				</div>
			</header>
			<style type='text/css'>
			
			.userinfo button
			{
				
			}
			</style>
			<div style='padding-top:50px; font-family: arial; font-size: 14px; font-weight: bold;margin: auto; width:100%;'>
				Hey ".MemberFirstName($toMember).", <br><br>
				You requested to reset your password for your SpiritLyft account, Click the button below to reset it.
				<br><br><div style=''><a href='$passwordlink'><button style='padding:12px 12px 12px 12px; font-size:14px; font-weight:bold; font-family: Arial; color:white; background-color:#795FC5; border-radius:6px;	 cursor:pointer;'>Password Reset</button></a></div><br><br>
				if you did not request a password reset, please ignore this email.
			</div>
		</div>
	<body>
	</html>";
	
	$MemberEmail = MemberEmail($toMember);
	
	@mail($MemberEmail, "SpiritLyft", $htmlbody, $headers);
}

function sendPost_mail($toMember, $fromMember, $wallid, $id)
{
	$headers = "From: Spiritlyft <admin@spiritlyft.com> \r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
	
	$htmlbody = "
	<html>
	<head>
		<title>SpiritLyft</title>
		<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1'>
	</head>
	<body>
		<div id='body'>
			<header>
				<div id='header_sub' style='background-color:#795FC5; width:100%; line-height:60px;'>
					<div id='title1'><a href='https://www.spiritlyft.com'><img src='https://www.spiritlyft.com/image/sl_logo2.png' /></a></div>
				</div>
			</header>
			<style type='text/css'>
			
			.userinfo button
			{
				
			}
			</style>
			<div style='margin-top:-50px; padding:8px 8px 8px 8px; border:2px black solid; border-radius:6px; font-family: arial; font-size: 14px; font-weight: bold; margin: auto; width:98.5%;' align='center'>
				
				<table width='100%' align='center'>
					<tr>
						<td align='center'>
							<strong>".MemberFullName($fromMember)."</strong> has replied to your post.
						</td>
					</tr>
				</table>
				<a href='https://www.spiritlyft.com/home.php?showwall=".base64_encode($wallid)."&id=".base64_encode($id)."'><button style='padding:12px 12px 12px 12px; font-size:14px; width:100%; font-family:Arial Black; border:none; border-radius-6px; background-color:#795FC5; color:white;'>Connect to SpiritLyft</button></a>
			</div>
		</div>
	<body>
	</html>";
	
	//echo $htmlbody;
	
	$MemberEmail = MemberEmail($toMember);
	
	@mail($MemberEmail, "SpiritLyft", $htmlbody, $headers);
}

function sendFeedback_mail($fromMember, $Message)
{
	$headers = "From: ".MemberFullName($fromMember)." (Feedback) <".MemberIDByEmail($fromMember)."> \r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
	
	$htmlbody = "
	<html>
	<head>
		<title>SpiritLyft</title>
		<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1'>
	</head>
	<body>
		<div id='body'>
			<header>
				<div id='header_sub' style='background-color:#795FC5; width:100% line-height:60px;'>
					<div id='title1'><a href='https://www.spiritlyft.com'><img src='https://www.spiritlyft.com/image/sl_logo2.png' /></a></div>
				</div>
			</header>
			<style type='text/css'>
			
			.userinfo button
			{
				
			}
			</style>
			<div style='padding-top:50px; font-family: arial; font-size: 14px; font-weight: bold;margin: auto; width:100%'>
				From: ".MemberFullName($fromMember)."<br><br>
				".$Message."
			</div>
		</div>
	<body>
	</html>";
	
	@mail("admin@spiritlyft.com", "Feedback", $htmlbody, $headers);
	
	//echo $htmlbody;
}
?>