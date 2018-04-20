<?php include 'meta_header.php'; ?>
<?php
if(isset($_SESSION['SessionMemberID']) && $_SESSION['SessionMemberID'] !='')
{
	//header("location: m_home.php");	
}
elseif(isset($_COOKIE['MemberID']) && isset($_COOKIE['MemberPassword']))
{
	$_SESSION['SessionMemberID'] = $_COOKIE['MemberID'];
	$_SESSION['SessionMemberPassword'] = $_COOKIE['MemberPassword'];
	//header("location: m_home.php");	
}
else
{
	header("location: m_index.php");
	exit();
}
?>
<div data-role="header" align="center" style="background-color:#4A338E; height: 50px; width: 100%; z-index: 3;">
   	<a href="javascript:void(0);" onClick="toggle_mainmenu();">Menu<span id="menu_alert" style="margin-left: 5px; margin-top: -1px;"></span></a>
    <div id="title1"><img src="image/sl_logo2.png" style="margin-top: 2px; width:150px;" /></div>
    	<a href="javascript:void(0);" onclick="notification_popup_box_show();" data-role="none">
    		<img src="image/notification_icon.png" height="40" width="40" style="" />
    		<span id="notification_bar_alert"></span>
    	</a>
</div>
<div id="notification_popup_box">
	<iframe id="notification_popup_iframe" frameborder="0" width="100%" style="overflow-y: auto;">
	</iframe>
</div>
<script type="text/javascript">
var idleTime = 0;
$(document).ready(function(){
	//Increment the idle time counter every minute.
    var idleInterval = setInterval(function(){timerIncrement();}, 60000); // 1 minute

    //Zero the idle timer on mouse movement.
    $(this).mousemove(function (e) {
        idleTime = 0;
    });
    $(this).keypress(function (e) {
        idleTime = 0;
    });
	
$("#mainmenu").height($(this).height());
$("#notification_popup_iframe").height($(this).height());
});
	
function timerIncrement() {
    idleTime = idleTime + 1;
    if (idleTime > 180) { // 60 minutes
        window.location = "m_logout.php";
    }
}

function update_header_notification()
{
	$.post("include/update_header_notification.php");
}

function notification_popup_box_hide()
{
	$("#notification_popup_box").fadeOut(function(){
		$("#notification_popup_iframe").attr("src", "");
	});
}

function notification_popup_box_show()
{
	update_header_notification();

	if($("#mainmenu").is(":visible"))
	{
		toggle_mainmenu();
	}


	$("#notification_popup_box").fadeIn(function(){
		$("#notification_popup_iframe").attr("src", "m_notification.php");
	});
}
	
function toggle_mainmenu()
{
	$("#mainmenu").slideToggle();
	$("#body").slideToggle();
	$("#newsfeed_f").slideToggle();
}
</script>
<style>
.alert_lb{
	border-radius:20%;	
	padding:2px 4px 2px 4px;
	background-color:red;
	color:white;
	float:right;
	font-family:Arial;
	font-weight:bold;
}

#notification_popup_box
{
	display: none;
	width: 100%;
	position: fixed;
	z-index: 1;
}

#mainmenu
{
	position: sticky;
	display: none;
	width: 100%;
	background-color: #9A86D3;
	z-index: 5;
	overflow-y: auto;
}
#mainmenu img
{
	width: 40px;
	height: 40px;
	float: left;
	}
	
#mainmenu a
{
	background-color: #DBD4EF;
	color:black;
	text-decoration: none;
}
</style>
<div id="mainmenu">
	<div style="background-color: white; color:black; font-size: 18px; line-height: 25px; font-weight: bold; font-family: Arial; text-align: center;">Welcome, <?php echo MemberFullName($_SESSION['SessionMemberID']); ?></div>
	<div><a target="_parent" href="m_home.php" data-role="button" data-transition="fade" data-ajax="false"><img src="image/home-512.png" style="" />Home</a></div>
	<div><a target="_parent" href="m_myprofile.php" data-role="button"  data-ajax="false"><img src="<?php echo MemberMainProfilePic($_SESSION['SessionMemberID']); ?>" style="" />My Profile</a></div>
	<div><a target="_parent" href="m_giftshop.php" data-role="button"><img src="image/vgift_icon.png" /><span class="button_lb">GiftShop</span><span class="button_lb" id="gift_alert_lb"></span></a></div>
	<div><a target="_parent" href="m_calender.php" data-role="button"  data-ajax="false"><img src="image/calendar_icon.png" style="" />Calendar</a></div>
	<div><a target="_parent" href="m_community.php" data-role="button"  data-ajax="false"><img src="image/friend_request_icon.png" style="" /><span class="" id="connection_alert_lb"></span>My Friends & Family</a></div>
	<div><a target="_parent" href="m_search.php" data-role="button"  data-ajax="false"><img src="image/search-icon-png-9985.png" style="" /><div style=""></div>Search</a></div>
	<div><a target="_parent" href="m_private_chat.php" data-role="button"  data-ajax="false"><img src="image/chat_icon.png" style="" /><span id="message_alert_lb"></span>Private Chat</a></div>
	<div style=""><button onClick="feedback_tb_show();" style="line-height: 30px;"><img style="float: left;" src="image/comment_logo.png" /><span style="text-align: center;">Feedback</span></button></div>
	<div><a target="_parent" alt="Logout" href="m_logout.php" data-role="button"  data-transition="fade" data-ajax="false">
    <span style="">Logout</span></a></div>
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
<style type="text/css">
.alert_lb{
	border-radius:20%;	
	padding:2px 4px 2px 4px;
	background-color:red;
	color:white;
	float:right;
	font-family:Arial;
	font-weight:bold;
}
	
#feedback_tb
{
	padding: 30px 30px 30px 30px;
	width: 100%;
	background-color: #4A338E;
	display:none;
	z-index: 11;
	margin: auto;
	position: absolute;
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
	font-size: 16px;
}
	
#admin_messagebox
{
	width:100%;
	color:black;
	position:fixed;
	z-index:6;
	background-color:white;
	line-height:50px;
	border:8px black solid;
	font-family:Arial;	
}
</style>
<script type="text/javascript">
setInterval(checkMember_session, 1000);

function checkMember_session()
{
  $.post("include/checkMember_session.php", function(s){
		  if(s == 1)
		  {
				window.location = "m_index.php";  
		  }
	  });	
}

var menu_alert_count = 0;

$(document).ready(function() {
	check_alerts();
	
	setInterval(check_alerts, 2000);
	
});

///////////////////////////////////////////
function feedback_tb_show()
{
	$("#feedback_tb").fadeIn('fast');
	$("#mainmenu").fadeOut('fast');
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
//////////////////////////////////////////	

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

function check_alerts()
{
	$.post("include/getNotificationAlerts.php", function(result){
				if(result > 0)
				{
					menu_alert_count=+1;

					$("#notification_bar_alert").addClass("alert_lb");
					$("#notification_bar_alert").html(result);
					$("#notification_bar_alert").fadeIn();
				}
				else
				{
					$("#notification_bar_alert").removeClass("alert_lb");
					$("#notification_bar_alert").html(result);	
					$("#notification_bar_alert").fadeOut();	
					menu_alert_count=-1;

					if(menu_alert_count < 0)
					{
						menu_alert_count = 0;
					}	
				}
		});	
		getMessageAlerts();
		getConnectionsRequestCount();

		$("#menu_alert").html(menu_alert_count);


		if(menu_alert_count > 0)
		{
			$("#menu_alert").html(menu_alert_count);
			$("#menu_alert").addClass("alert_lb");
		}
		else
		{
			$("#menu_alert").html('');
			$("#menu_alert").remove("alert_lb");
		}
}
	

function getMessageAlerts()
{
	$.post("include/getMessageAlerts.php", function(html){
		if(html > 0)
		{
			menu_alert_count=+1;
			$("#message_alert_lb").addClass("alert_lb");
			$("#message_alert_lb").html(html);	
		}
		else
		{
			$("#message_alert_lb").removeClass("alert_lb");
			$("#message_alert_lb").html('');
			menu_alert_count=-1;

			if(menu_alert_count < 0)
			{
						menu_alert_count = 0;
			}	
		}
	});	
}

function getConnectionsRequestCount()
{
	//getConnectionsRequestCount
	$.post("include/getConnectionsRequestCount.php", function(html){
		if(html > 0)
		{
			menu_alert_count=+1;
			$("#connection_alert_lb").addClass("alert_lb");
			$("#connection_alert_lb").html(html);	
		}
		else
		{
			menu_alert_count=-1;
			$("#connection_alert_lb").removeClass("alert_lb");
			$("#connection_alert_lb").html('');	

			if(menu_alert_count < 0)
			{
				menu_alert_count = 0;
			}
		}	
	});		
}
	
////////////////////////ADMIN MESSAGE POPUP BOX///////////////////////
var am = '';
$(document).ready(function(){
	am = setTimeout(function(){checkadmin_message();}, 5000);
});

function close_admin_box(messageid)
{
	$.post("include/clearAdminMessage.php", {messageid: messageid}, function(){
		$("#admin_messagetb"+messageid).fadeOut('fast', function(){$(this).remove()});
		$("#admin_messagebox").fadeOut();
		$("#admin_messagebox").empty();
		am = setTimeout(function(){checkadmin_message();}, 5000);
	});
}
	
function checkadmin_message()
{
	$("#admin_messagebox").load("include/getAdminMessage.php");
	
	if($("#admin_messagebox").is(":empty") == false)
	{
		$("#admin_messagebox").fadeIn();
		clearTimeout(am);
	}
	else
	{
		$("#admin_messagebox").empty();
		$("#admin_messagebox").fadeOut();
		am = setTimeout(function(){checkadmin_message();}, 5000);
	}
}
	
function private_chat_show_with_link(link)
{
	window.location = "m_private_chat.php?id="+link;
}
</script>
<div id="admin_messagebox" style="display: none;"></div>