<?php 
session_start();
include 'config.php';
include 'include/core.inc.php';
include 'include/connections.core.inc.php';
include 'include/chat_core.inc.php';
?>
<!doctype html>
<html>
<head>
<link rel="stylesheet" href="css/style1_m.css"/>
<link rel="stylesheet" href="css/calender_homepage_style1.css" />
<!-- Include meta tag to ensure proper rendering and touch zooming -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Include jQuery Mobile stylesheets -->
<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">

<!-- Include the jQuery library -->
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Include the jQuery Mobile library -->
<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<title>SpiritLyft</title>
</head>
<body onLoad="">
<?php 
	include 'app_header.php';
?>



<div id="body">
<table id='connections_tb' style="width: 100%; background-color: white; z-index: 3; overflow-y: auto;">
	<?php echo set_sidepanel_mobile(); ?>
</table>       
<style type="text/css">
	#chat_panel{
		background-color:white;
		width:100%;
		font-family:Arial;
		padding:2px 2px 2px 2px;
		display:none;
	}
	#chatbox{

	}

	#chat_header{
		width:100%;
		text-align:center;
		background-color:#917CD0;
		height: 65px;
	}

	#member_fullname_lb{
		padding-top:10px;
		font-family:Arial;
		font-weight:bold;
	}

	#chat_body{
		overflow-y:scroll;
		height: 428px;
	}

	#chatbubble1{
		border-radius:8px;
		background-color:#D6CEED;
		width:55%;
		padding:12px 12px 12px 12px;
		margin-top:15px;
		float:left;
	}

	#chatbubble2{
		border-radius:8px;
		background-color:#D6CEED;
		width:55%;
		padding:12px 12px 12px 12px;
		margin-top:30px;
		float:right;
	}

	#chat_footer{
		bottom:0;
		position:relative;	
	}

	#chatbox_enter_btn{
		color:white;
		font-size:12px;
		text-decoration:none;
		font-weight:bold;
		background-color:#795FC5;
		border:none;
		border-radius:4px;
		padding:8px 8px 8px 8px;
		width:15%;
		margin-top:7px;
	}
</style>
<script type="text/javascript">
$(document).ready(function(e) {
<?php 
	if(isset($_GET['mid']) && !$_GET['mid'] == "")
	{
		?>
			$("#mb<?php echo $_GET['mid']; ?>").click();
		<?php
	}
?>

$("#chat_frame").height($(this).height() - 90);
});

function select_member(mem1)
{
	$("#connections_tb").fadeOut();
	$("#chat_frame").attr("src", "include/m_chatpanel_frame.php?mid="+mem1);
	$("#chat_frame").fadeIn();
}

function chat_frame_close()
{
	$("#connections_tb").fadeIn();
	$("#chat_frame").attr("src", "");
	$("#chat_frame").fadeOut();
}

//setInterval(function(){member_message_alert();}, 2000);
//setTimeout(function(){member_message_alert();}, 2000);
function member_message_alert(mid)
{
	//var mid = '';
	//$(".member_message_alert").each(function(){
		//mid = $(this).attr("id").substr(20);

		$.post("include/getMessageAlerts_from_Member.php", {id: mid}, function(alerts){
			if(alerts > 0)
			{
				$("#member_message_alert"+mid).html(alerts);
				$("#member_message_alert"+mid).addClass("alert_lb");
			}
			else
			{
				$("#member_message_alert"+mid).html("");
				$("#member_message_alert"+mid).removeClass("alert_lb");
			}
		});

		//alert_lb
	//});
}

function member_message_alert(mid)
{
	//var mid = '';
	//$(".member_message_alert").each(function(){
		//mid = $(this).attr("id").substr(20);

		$.post("include/getMessageAlerts_from_Member.php", {id: mid}, function(alerts){
			if(alerts > 0)
			{
				$("#member_message_alert"+mid).html(alerts);
				$("#member_message_alert"+mid).addClass("alert_lb");
			}
			else
			{
				$("#member_message_alert"+mid).html("");
				$("#member_message_alert"+mid).addRemove("alert_lb");
			}
		});

		//alert_lb
	//});
}


</script>
</script>
    <iframe id="chat_frame" src="" style="width: 100%; display: none;" frameborder="0">
			
    </iframe>  
</div>
</body>
</html>