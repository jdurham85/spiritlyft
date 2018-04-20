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
	font-weight:bold;
	font-size:14px;
	color:black;
	text-align:center;
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
	list-style:none;
	font-family:Arial;
	font-size:12px;
	width:180px;
	padding:4px 4px 4px 4px;
	border-radius:4px;
	border:2px black solid;
}

#sidemenu div{
	margin:3px 0px 0px 0px;	
}

#sidemenu button{
	font-size:12px;
	text-decoration:none;
	font-weight:none;
	border: none;
	width:100%;
	font-weight:bold;
	background-color:white;
	border-radius:2px;
	cursor:pointer;
}

#sidemenu button:hover
{
	background-color:#B5A7DF;
	color:white;
}
</style>
<script type="text/javascript">
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
</script>
<div data-role="page" id="sidemenu">
		<div id="welcome_title">Welcome, <?php echo MemberFirstName($_SESSION['SessionMemberID']); ?></div>
    	<div><a href="m_home.php"><button><img src="image/home-512.png" /><span class="button_lb">Home</span><span class="button_lb" id="home_alert_lb"></span></button></a></div>
        
        <div><a href="app_myprofile.php"><button><img src="<?php echo MemberMainProfilePic($_SESSION['SessionMemberID']); ?>" /><span class="button_lb">My Profile</span><span class="button_lb" id="myprofile_alert_lb"></span></button></a></div>
        
        <div><a href="m_community.php"><button><img src="image/friend_request_icon.png" /><span class="button_lb">My Friends & Family</span><span class="button_lb" id="connection_alert_lb"></span></button></a></div>
        
        <!--div><a href="giftshop.php"><button><img src="image/vgift_icon.png" /><span class="button_lb">GiftShop</span><span class="button_lb" id="gift_alert_lb"></span></button></a></div-->
        <!--div><a href="m_account-setting.php"><button><img src="image/account-setting-ico.png" /><span class="button_lb">Account Setting</span></button></a></div-->
        <div><a href="private_chat.php"><button><img src="image/chat_icon.png" /><span class="button_lb">Private Chat</span><span class="button_lb" id="message_alert_lb"></span></button></a></div>
        
        <div><a href="logout.php"><button><img src="image/logout-img.png" /></button></a></div>
    </div>
    
  