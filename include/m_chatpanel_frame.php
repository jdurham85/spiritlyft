<?php 
session_start();
include 'config.php';
include 'core.inc.php';
include 'connections.core.inc.php';
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="../css/style1.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<title>Spiritlyft</title>
</head>
<body style="margin: auto;">
<style type="text/css">
#chatbubble1{
	border-radius:8px;
	background-color:#D6CEED;
	width:50%;
	padding:12px 12px 12px 12px;
	margin-top:15px;
	float:left;
}

#chatbubble2{
	border-radius:8px;
	background-color:#D4D2D4;
	width:50%;
	padding:12px 12px 12px 12px;
	margin-top:30px;
	float:right;
}

#MemberName
{
	background-color:#4A338E;
	color:white;
	font-family:Arial;
	font-weight:bold;
	font-size:18px;
	width:100%;
	margin: auto;
	position: fixed;
	top: 0;
}

#MemberName_sub
{
	height:50px;
}

#messageinput
{
	line-height:30px;
	width:78%;
}

#send_message_btn
{
	font-weight:bold;
	border-radius:4px;
	line-height:20px;
	width:18%;
}

#messagebox
{
	overflow-y: auto;
}
</style>
<audio id="imalert_sound">
    <source src="../sound/imring.wav" type="audio/wav">
</audio>
<script type="text/javascript">
$(document).ready(function(){
	//$("#chatbody").css("height", $(this).height() - 200);
});

getmessages(<?php echo $_GET['mid']; 
		if(!isset($_GET['mid']) && $_GET['mid'] == "")
		{
			$con = getMemberConnections($_SESSION['SessionMemberID']);
			
			$_GET['mid'] = $con[0];
		}
	?>);

function getmessages(mid)
{
	$.post("getMessages.php", {mem1: mid}, function(msg){
			$("#messagebox").html(msg);
			$(document).scrollTop($(document).height());
		});	
}

setInterval(getNewMessages, 2000);

resetMessageAlerts();

function getNewMessages()
{
	$.post("getUpdatedMessages.php", {mem1: <?php echo $_GET['mid']; ?>}, function(msg){
			if(msg != "")
			{
				$("#messagebox").append(msg);
				$(document).scrollTop($(document).height());
				$("#imalert_sound").trigger('play');	
			}
		});		
}

function resetMessageAlerts()
{
	$.post("resetMessageAlerts.php",{id: <?php echo $_GET['mid']; ?>});
}

function messageinput_enter_key(event)
{
	if(event.keyCode == 13)
	{
		sendMessage();
	}		
}

function sendMessage()
{
	document.getElementById("send_message_btn").value = "Sending...";
	if(document.getElementById("messageinput").value != "")
	{
		$.post("sendMessage.php", {ToMember:<?php echo $_GET['mid']; ?>, Message: document.getElementById("messageinput").value}, function(msg){
				$("#messagebox").append(msg);
				$(document).scrollTop($(document).height());
				document.getElementById("send_message_btn").value = "Send";
				document.getElementById("messageinput").value = "";
			});
	}
}

function chat_frame_close()
{
	window.parent.chat_frame_close();
}
</script>
<table id="chatbody" width="100%" cellspacing="0" style="font-family:Arial;">
<tr>
	<td style="height: 20px;"></td>
</tr>
<tr>
	<td align="center" id="MemberName">
    	<?php echo MemberFullName($_GET['mid']); ?> <button onclick="chat_frame_close();" style="margin-left: 2%; background-color: red; color:white; border:none; font-family: Arial; font-weight: bold; padding:6px 6px 6px 6px;">Close</button>
    </td>
</tr>
<tr>
	<td colspan="1" id="messagebox">
    
    </td>
</tr>
<tr>
	<td style="height: 60px;"></td>
</tr>
<tr>
	<td colspan="1" style="position: fixed; bottom: 0; width: 100%;">
    	<input type="text" id="messageinput" name="messageinput" onclick="resetMessageAlerts();" onKeyPress="messageinput_enter_key(event);" /> <button onClick="sendMessage();" id="send_message_btn">Send</button>
    </td>
</tr>
</table>
</body>
</html>