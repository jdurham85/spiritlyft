<!--div id="menu_btns">
   <a href="#">Home</a>
   <a href="#">My Profile</a>
   <a href="#">My Friends & Family</a>
   <a href="#">Gifts</a>
   <a href="#">Private Chat</a>
   <a href="#">My Profile</a>
   <a href="#">Logout</a>
</div-->
<style>
#welcome_title{
	font-family:Arial;
	text-align:center;
	color: white; 
	background-color: #4A338E; 
	width: 100%; 
	font-weight: bold; 
	font-size: 18px;
}

#sidemenu img
{
	width:30px;
	float:left;	
}

.button_lb{
	line-height:30px;
}

.alert_lb{
	border-radius:20%;	
	padding:2px 4px 2px 4px;
	background-color:red;
	color:white;
	float:right;
	font-family:Arial;
	font-weight:bold;
}
	
#sidemenu{
	float:left;
	list-style:none;
	font-family:Arial;
	font-size:12px;
	width:20%;
	padding:4px 4px 4px 4px;
	border-right: 2px black solid
}

#sidemenu div{
	margin:3px 0px 0px 0px;	
	border-radius: 1px;
	line-height: 25px;
}

#sidemenu button{
	font-size:12px;
	text-decoration:none;
	font-weight:none;
	border: none;
	width:100%;
	font-weight:bold;
	background-color:transparent;
	border-radius:2px;
	cursor:pointer;
	line-height: 30px;
}

#sidemenu button:hover
{
	background-color:#B5A7DF;
	color:white;
}
	
#feedback_tb
{
	right: 37.3%;
	padding: 30px 30px 30px 30px;
	width: 500px;
	background-color: #4A338E;
	display:none;
	z-index: 10;
	position: fixed;
}
	
#feedback_tb_title
{
	font-family: Arial;
	font-weight: bold;
	font-size: 28px;
	text-align: center;
	color: white;
}
	
#feedback_tb textarea
{
	width: 99%;
	height: 200px;
	font-size: 12px;
	font-family: Arial;
}
	
#feedback_tb button
{
	width: 100%;
	padding:8px 8px 8px 8px;
	font-family: Arial;
	font-weight: bold;
	border-radius: 6px;
	background-color: #E9E5F5;
	font-size: 16px;
	}
</style>
<script type="text/javascript">
var idleTime = 0;
$(document).ready(function() {
    $("#notification_icon").click(function() {
        $("#notification_bar").slideToggle();
    });
	
	//setSideMenu();
	check_alerts();
	
	setInterval(check_alerts, 1000);
	
	//Increment the idle time counter every minute.
    var idleInterval = setInterval(function(){timerIncrement();}, 60000); // 1 minute

    //Zero the idle timer on mouse movement.
    $(this).mousemove(function (e) {
        idleTime = 0;
    });
    $(this).keypress(function (e) {
        idleTime = 0;
    });
	
});

function setMemberidle()
{

}

function unsetMemberidle()
{

}
	
function timerIncrement() {
    idleTime = idleTime + 1;
    if (idleTime > 180) { // 20 minutes
        window.location = "logout.php";
    }
}

function goto_PrivateChat(id)
{
	window.location = "private_chat.php?id="+id;	
}

function check_alerts()
{
	$.post("include/getNotificationAlerts.php", function(result){
				if(result > 0)
				{
					$("#notification_bar_alert").addClass("alert_lb");
					$("#notification_bar_alert").html(result);
					$("#notification_bar_alert").fadeIn();
				}
				else
				{
					$("#notification_bar_alert").removeClass("alert_lb");
					$("#notification_bar_alert").html(result);	
					$("#notification_bar_alert").fadeOut();		
				}
		});	
		
		
		check_notifications();
		getMessageAlerts();
		getConnectionsRequestCount();
}

function setSideMenu()
{
	$("#sidemenu").load("include/setSideMenu.php");	
}
	
function check_notifications()
{
	$("#notification_bar").load("include/checkNotification.php");	
}

function reset_alerts(id)
{
	$.post("include/reset_notificationAlerts.php", {id: id}, function(){
			check_alerts();
		});		
}

function Notification_Delete(id)
{
	$.post("include/delete_notification.php", {id: id}, function(){
		$("#member_notification"+id).fadeOut().remove();
	});
}

function getMessageAlerts()
{
	$.post("include/getMessageAlerts.php", function(html){
		if(html > 0)
		{
			$("#message_alert_lb").addClass("alert_lb");
			$("#message_alert_lb").html(html);	
		}
		else
		{
			$("#message_alert_lb").removeClass("alert_lb");
			$("#message_alert_lb").html('');	
		}
	});	
}

function getConnectionsRequestCount()
{
	//getConnectionsRequestCount
	$.post("include/getConnectionsRequestCount.php", function(html){
		if(html > 0)
		{
			$("#connection_alert_lb").addClass("alert_lb");
			$("#connection_alert_lb").html(html);	
		}	
	});		
}
///////////////////////////////////////////
function feedback_tb_show()
{
	$("#feedback_tb").fadeIn('fast');
}
	
function feedback_tb_send_msg()
{
	if($("#feedback_tb_textarea").val().length > 0)
	{
		$.post("include/sendFeedback.php", {msg: $("#feedback_tb_textarea").val()}, function(){
			$("#feedback_tb_message").html("Thank you for your feedback");
				$("#feedback_tb_message").html('').delay(5000);
				feedback_tb_close();
		});
	}
}
	
function feedback_tb_close()
{
	$("#feedback_tb_textarea").val('');
	$("#feedback_tb").fadeOut('fast');
}
</script>
<audio id="imalert_sound">
	<source src="sound/imring.wav" type="audio/wav">
</audio>

<div id="sidemenu">
    <div id="welcome_title" style="line-height: 40px;">Welcome, <?php echo MemberFirstName($_SESSION['SessionMemberID']); ?></div>
    <div><a href="home.php"><button><img src="image/home-512.png" /><span class="button_lb">Home</span><span class="button_lb" id="home_alert_lb"></span></button></a></div>
    <div><a href="myprofile.php"><button><img src="<?php echo MemberMainProfilePic($_SESSION['SessionMemberID']); ?>" /><span class="button_lb">My Profile</span><span class="button_lb" id="myprofile_alert_lb"></span></button></a></div>
    
    <div><a href="community.php"><button><img src="image/friend_request_icon.png" /><span class="button_lb">My Friends & Family</span><span class="button_lb" id="connection_alert_lb"></span></button></a></div>
    
    <div><a href="giftshop.php"><button><img src="image/vgift_icon.png" /><span class="button_lb">GiftShop</span><span class="button_lb" id="gift_alert_lb"></span></button></a></div>
    <!--div><a href="search.php"><button><img src="image/search-icon-png-9985.png" /><span class="button_lb">Search</span></button></a></div-->
    <div><a href="account-setting.php"><button><img src="image/account-setting-ico.png" /><span class="button_lb">Account Settings</span></button></a></div>
    <div><a href="javascript:void(0);" onClick="private_chat_show();"><button><img src="image/chat_icon.png" /><span class="button_lb">Private Chat</span><span class="button_lb" id="message_alert_lb"></span></button></a></div>
    <div style=""><button onClick="feedback_tb_show();" style="line-height: 30px;"><img style="float: left;" src="image/comment_logo.png" /><span style="text-align: center;">Feedback</span></button></div>
    <div><a href="logout.php"><button><img src="image/logout-img.png" /><span class="button_lb">Logout</span></button></a></div>
	<div style="margin-top: 6px;" align="center">
		<div style="float: left; line-height: 40px; color: white; background-color: #4A338E; width: 100%; font-weight: bold; font-size: 18px;">Quick Chat</div>
		<div id="member_online_scroll">
			<table id="online_panel">

			</table>
		</div>
	</div>
</div>
<table id="feedback_tb">
	<tr>
		<td colspan="2" id="feedback_tb_title">Feedback</td>
	</tr>
	<tr>
		<td colspan="2" id="feedback_tb_message">
			
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<textarea id="feedback_tb_textarea"></textarea>
		</td>
	</tr>
	<tr>
		<td width="50%"><button onClick="feedback_tb_close();">CANCEL</button></td>
		<td width="50%"><button onClick="feedback_tb_send_msg();">SEND</button></td>
	</tr>
</table>

    
  