<?php 
session_start();
include 'config.php';
include 'include/core.inc.php';
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
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
<div id="back-screen" style="width:100%; height:900px; position:relative; z-index:4; display:none; background-color:#4A338E; opacity:0.9;" align="center">
    <iframe id="postview_frame" name="postview_frame" style="width:98%; border:none; border-radius:4px; z-index:8; display:none; background-color:white; position:sticky; height:700px;" align="middle">
            
    </iframe>
    <div id="videoview_panel" align="center" style="color:white; display:none; font-family:Arial Black; font-size:40px;">
    	Adding Video Please wait...
    </div>
</div>
<script type="text/javascript">
//setInterval(checkMember_session, 1000);

function checkMember_session()
{
  $.post("include/checkMember_session.php", function(s){
		  if(s == 1)
		  {
				window.location = "m_index.php";  
		  }
	  });	
}
</script>
<body onLoad="">
<?php //include 'm_header.php';?>
<style>
#calender_panel{
	float:right;
	width:25%;	
	position:absolute;
	right: 0;
	height:400px;
	border:none;
}
	
#newsfeed_f
{
	width:100%;
	border:none;
}
	
#sidemenu{
	float:left;
	list-style:none;
	font-family:Arial;
	width:200px;
	border:1px black solid;
	padding:4px 4px 4px 4px;
	border-radius:4px;
}

#sidemenu div{
	margin:3px 0px 0px 0px;	
}

#sidemenu button{
	font-size:12px;
	text-decoration:none;
	font-weight:none;
	border:1px black soild;
	border-radius:4px;
	border-width:1px;
	width:100%;
	background-color:white;
}

.member_notification
{
	width:99%;
}
	
.member_notification button
{
	background-color:#4A338E;
	border-radius: 2px;
	color:white;
	font-weight: bold;
	font-size: 12px;
	border:none;
	padding:8px 8px 8px 8px;
	margin-bottom: 5px;
	width: 100%;
}
	
#notification_bar
{
	overflow-y: auto;	
}
</style>
<script type="text/javascript">
$(document).ready(function(){
	$("#notification_bar").load("include/checkNotification.php");
	$("#notification_bar").css("max-height",$(this).height());

	$("#notification_bar").css("max-height", $(this).height());
});

function notification_popup_box_hide()
{
	window.parent.notification_popup_box_hide();
}

function Notification_Delete(id)
{
	$.post("include/delete_notification.php", {id: id}, function(){
		$("#member_notification"+id).fadeOut().remove();
	});
}
</script>
<button onclick="notification_popup_box_hide();">Close</button>
<div id="notification_bar" class="" style="width: 99%;"></div>              

</div>
<?php //include 'm_footer.php'; ?>
</body>
</html>