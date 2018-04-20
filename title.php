<?php
if($_SESSION['SessionMemberID'] == "")
{
	header("location: index.php");	
}

date_default_timezone_set(getMemberTimezone($_SESSION['SessionMemberID']));

$date = time();
?>
<style type="text/css">
#title1
{
	float:left;
	padding:6px 6px 6px 0px;
	font-weight:bold;
	margin-top:0px;
	left: 0;
	position: absolute;
	width: 10%;
}

#title1 img
{
	text-align: center;
	width: 100%;
	margin-top: 10px;
        margin-left: 80px;
}

#usearch{
	padding:5px 5px 5px 5px;
	margin-top:24px;
	float:left;
	width:66%;
	border:none;
	border-radius: 4px;
}

#usearch_box{
	padding:2px 2px 2px 2px;
	margin-top:-10px;
        margin-left: 10px;
}

#alert_bar{
	padding:2px 2px 2px 2px;
	width:10px;
	float:left;
	margin-top:21px;
	font-family:Arial;
	font-weight:bold;
	margin-left:20px;
}

#Account_lb{
	padding:2px 2px 2px 2px;
	width:10px;
	float:left;
	margin-top:21px;
	font-family:Arial;
	font-weight:bold;
	margin-left:65px;
}

#usearch_box a{
	text-decoration:none;
	color:white;
}

#header_sub
{
	width:900px;	
}

#time_panel{
	color:white;
	font-family:Arial Black;
	font-size:16px;
	float:left;
	margin-top:24px;
	margin-left:8px;
}

#event_remindertb{
	position:fixed;
	z-index:10;
	width:50%;
	background-color:#CFD3DF;
	font-family:Arial;
	color:black;
	display:none;
}

#event_remindertb caption
{
	font-size:50px;
	font-family:Arial Black;
	background-color:#CFD3DF;
	margin-top:60px;
}

#event_remindertb button
{
	padding:6px 6px 6px 6px;
	border-radius:5px;
	width:100%;
	font-family:Arial Black;
	background-color:#E7E7E7;
}

#eventtitle1, #eventdate1
{
	font-size:40px;
	text-align:center;
	font-weight:bold;
}

#notification_bar
{
        margin-top:50px;
	background-color:white;
	color:black;
	margin-left:42%;
	z-index:6;
	border:6px #4A338E solid;
	display:none;
	width:500px;
	font-size:12px;
}

#notification_bar button
{
	background-color:#795FC5;
	color:white;
	border:none;
	border-radius:4px;	
	font-weight:bold;
	padding:6px 6px 6px 6px;
}

#notification_bar_alert
{
	margin-top:24px;
}
	
.member_notification
{
	width:100%;	
}

#session_box
{
	background-color:#4A338E;
	position:fixed;
	width:100%;
	z-index:10;
}

#searchbox_inquery
{
	width:492px;
	color:black;
	margin-left:190px;
	margin-top:50px;
	position:fixed;
	z-index:5;
	background-color:white;
	line-height:50px;
	border:2px black solid;
	padding:4px 4px 4px 4px;
	display:none;
	max-height:500px;
	font-family:Arial;
	overflow-y: auto;
}

.searchquerybox_sub
{
	background-color:white;
	color:black;
}

.searchquerybox_sub:hover
{
	background-color:#4A338E;
	color:white;
	font-weight:bolder;
	cursor:pointer;
	width:100%;
}
	
#admin_messagebox
{
	width:30%;
	color:black;
	margin-left:140px;
	margin-top:60px;
	position:fixed;
	z-index:6;
	background-color:white;
	line-height:50px;
	border:8px black solid;
	padding:8px 8px 8px 8px;
	max-height:500px;
	font-size: 12px;
	font-family:Arial;	
}

#notification_popup_tag
{
	position: relative;
	color: white;
	background-color: black;
	padding:2px 2px 2px 2px;
	font-family: Arial;
	font-weight: bold;
	width: 100px;
	float: right;
	margin-right: 50px;
	text-align: center;
	display: none;
	z-index: 6;
}
</style>
<script type="text/javascript">
setInterval(checkMember_session, 1000);

function checkMember_session()
{
  $.post("include/checkMember_session.php", function(s){
		  if(s == 1)
		  {
			window.location = "index.php";  
		  }
	  });	
}

setInterval(watch_timer, 1000);

function watch_timer()
{
	$("#time_panel").html(formatAMPM());	
}
////////////star notification_popup_tag/////////////////
function notification_popup_tag_show()
{
	$("#notification_popup_tag").fadeIn();
}

function notification_popup_tag_hide()
{
	$("#notification_popup_tag").fadeOut();
}
////////////end notification_popup_tag//////////////////
var check_event_timerID = '';
check_event_timerID = setInterval(function(){
		check_event(<?php echo date('m', $date) . ", " . date('d', $date) . ", " . date('Y', $date);  ?>);
	}, 2000);
	
function formatAMPM() {
  var date = new Date();
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var ampm = hours >= 12 ? 'PM' : 'AM';
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'
  minutes = minutes < 10 ? '0'+minutes : minutes;
  var strTime = hours + ':' + minutes + ' ' + ampm;
  return strTime;
}

function event_reminder_close()
{
	$("#event_remindertb").fadeOut(function(){$("#event_remindertb").html('');});	
	check_event_timerID = setInterval(function(){
		check_event(<?php echo date('m', $date) . ", " . date('d', $date) . ", " . date('Y', $date);  ?>);
	}, 2000);
}
	
function check_event(m, d, y)
{
	
	$.post("include/checkAlert.php", {date: m + "/" + d + "/" + y, time: formatAMPM()}, function(html){
			$("#event_remindertb").html(html);
			
			if($("#event_remindertb").html().length > 0)
			{
				$("#event_remindertb").show();
				clearInterval(check_event_timerID);
			}
		});
}
	
function check_usearch_input_length()
{
	var usearch_txt = document.getElementById("usearch").value;
	
	if(usearch_txt != "")
	{
		$("#searchbox_inquery").show();
		
		$.post("include/searchquery1.php", {SearchInQuery: usearch_txt}, function(result){
				$("#searchbox_inquery").html(result);
			});	
	}
	else
	{
		$("#searchbox_inquery").html('');
		$("#searchbox_inquery").hide();	
	}
}
	
function update_header_notification()
{
	$.post("include/update_header_notification.php");
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
		$("#admin_messagebox").fadeOut();
		am = setTimeout(function(){checkadmin_message();}, 5000);
	}
}
	
function private_chat_show()
{
	$("#private_chat_wall").fadeIn();
	$("#private_chat_iframe").attr("src","private_chat.php");
}
	
function private_chat_show_with_link(link)
{
	$("#private_chat_wall").fadeIn();
	$("#private_chat_iframe").attr("src","private_chat.php?id="+link);
}

function private_chat_close()
{
	$("#private_chat_wall").fadeOut();
	$("#private_chat_iframe").attr("src","");
}
	
$(document).ready(function(){
	$("#private_chat_wall").height($(this).height());
	$("#private_chat_iframe").height($("#private_chat_wall").height());

	$("#member_online_scroll").height($(this).height() - 60);
});
</script>
<div id="header_sub">
    <a href="home.php" target="_self"><div id="title1" align="center"><img src="image/sl_logo2.png" /></div></a>
     <div id="usearch_box">
         	<input type="search" id="usearch" name="usearch" placeholder="search here for family and friends by using first name or last name to connect." onKeyUp="check_usearch_input_length();" /><div id="time_panel" style="font-size: 26px; font-weight: bold; font-family: Arial;"></div>
            <div id="notification_icon" onClick="update_header_notification();">
	            <img src="image/notification_icon.png" onmouseover="notification_popup_tag_show();" onmouseleave="notification_popup_tag_hide();" style="width:26px;  margin-top:24px; padding-left:15px; float:left;" />
	            <span id="notification_bar_alert" class="" style="float:left;"></span>
	            <div id="notification_popup_tag">Notification</div>
            </div>
            
            <div id="searchbox_inquery">
            </div>
         
         <div id="notification_bar"  style="position:fixed; max-height: 300px; overflow-y: auto;">
         	
         </div>
         
         <div id="admin_messagebox" style="display: none;"></div>
    </div>
<table id="event_remindertb" align="center"></table> 
</div>
<div id="private_chat_wall" style="width: 100%; display: none; background-color: #4A338E; position: fixed; z-index: 55;" align="center">
	<table style="width: 100%;">
		<tr>
			<td align="right">
				<button style="padding:8px 8px 8px 8px; font-weight: bold; margin-right: 16%; background-color: red; color:white; border:none; font-family: Arial; font-weight: bold;" onClick="private_chat_close();">Close</button>
			</td>
		</tr>
		<tr>
			<td align="center" width="100%;">
				<iframe frameborder="0" id="private_chat_iframe" src="" width="100%"></iframe>
			</td>
		</tr>
	</table>
</div>