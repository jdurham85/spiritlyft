<?php 
session_start();
include 'config.php';
include 'include/core.inc.php';
include 'include/connections.core.inc.php';

if($_GET['profileid'] == $_SESSION['SessionMemberID'])
{
	header("Location: myprofile.php");
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/style1_m.css"/>
<link rel="stylesheet" href="css/commentbox_style1.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php include 'meta_header.php'; ?>
<title>SpiritLyft</title>
<!-- Include meta tag to ensure proper rendering and touch zooming -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Include jQuery Mobile stylesheets -->
<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">

<!-- Include the jQuery library -->
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Include the jQuery Mobile library -->
<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>
<body>
	<header>
    	<div id="header_sub">
            <?php include 'app_header.php'; ?>
        </div>
    </header>
    <style>
    	#profile_body{
			margin-top:5px;
			background-color:#E4E4E4;
			width:99%;
			font-family:Arial;
			color:white;
			border-left:1px black solid;
			border-bottom:1px black solid;
			border-right:1px black solid;
		}
		
		#profile_header
		{
			background-color:#4A338E;
			width:100%;
			height:100px;
			font-weight:bold; 
			padding:2px 2px 2px 2px;
		}
		
		#userfullname_textview{
			margin-top:25px;
			font-size:50px;
			text-align:center;
		}
		
		#profile_menu{
			border-left:1px black solid;
			border-bottom:1px black solid;
			border-right:1px black solid;
			padding:8px 8px 8px 8px;
			display:none;
		}
		
		#profile_menu button{
			padding:8px 8px 8px 8px;
			text-decoration:none;
			font-weight:bold;
			color:white;
			margin:auto;
			background-color:#4A338E;
			border:none;
		}
		
		.profile_title{
			color:black;
			font-family:arial;
			font-weight:bold;	
			padding:8px 8px 8px 8px;
		}
		
		#gallery_body{
			width:100%;	
		}
		
		#picstatus button{
			padding:6px 6px 6px 6px;
			font-weight:bold;
			border-radius:6px;	
			border:none;
		}
    </style>
<script type="text/javascript">

/*
	respone 0 -  no connection request exist
	respone 1 -  connection has already been sent
	respone 2 -  a member send you a request + I sent a request = connected
	respone 3 -  no connection request exist or it has expired
*/

function send_connection_request(mem1)
{		
	$.post("include/send_connection_request.php", {mem1: mem1}, function(result){
		
			if(result == 0)
			{
				document.getElementById("connection_btn"+mem1).innerHTML = "Connection Request Sent";	
				document.getElementById("connection_btn"+mem1).setAttribute("OnClick", "");
			}
			
			if(result == 1)
			{
				document.getElementById("connection_btn"+mem1).innerHTML = "Connection Pending";	
				document.getElementById("connection_btn"+mem1).setAttribute("OnClick", "");
			}
		});
}
</script>
<style type="text/css">
.connection_style button{
	padding:8px 8px 8px 8px;
	border:none;
	margin-right:10px;
	font-size:14px;
	font-weight:bold;
	font-family: Arial;
	color:white;
	background-color:#795FC5;
	border-radius:6px;	
}

.connection_style
{
	border:1px black solid;
	border-radius:4px;
	width:100%;
	background-color:white;
}

.connection_style_img
{
	width:20%;
}

.connection_style_info
{
	width:80%;	
}
</style>
        <div id="body">
            <div id="profile_body">
            
            <script type="text/javascript">

            </script>
                
                <div id="profile_header">
                	<div id="userfullname_textview"><?php echo MemberFullName($_GET['profileid']); ?></div>
                </div>
                <div id="profile_inner_body">
                	<div id="profile_menu">
                    </div>
                    
                    <div class="profile_title" align="center">
                    <div style=""><?php echo MemberFullName($_GET['profileid']) . "  profile is private because you are not connected.";  ?></div>
                    <table class="connection_style">
            <tr>
            	<td style="width:10;" class="connection_style_img">
                	<img src="<?php echo MemberMainProfilePic($_GET['profileid']); ?>" style="border-radius:5%; width:80px;" />
                </td>
                <td class="connection_style_info" style="font-family:Arial; text-align:center; font-size:20px; font-weight:bold; float:left; color:black; margin-top:25px; padding-left:15px;">
                    <?php  
						if(check_connection_request_status($_GET['profileid'], $_SESSION['SessionMemberID']) == 1)
						{
							?><button id="connection_btn<?php echo $_GET['profileid']; ?>" onClick="">Connection Pending</button><?php
						}
						
						if(check_connection_request_status($_GET['profileid'], $_SESSION['SessionMemberID']) == 2)
						{
							?><a href="#">Connected</a><?php
						}
 
						
						if(check_connection_request_status($_GET['profileid'], $_SESSION['SessionMemberID']) == 0)
						{
							?><a href="#">Not Connected</a>&nbsp;&nbsp;<button id="connection_btn<?php echo $_GET['profileid']; ?>" onClick="send_connection_request(<?php echo $_GET['profileid']; ?>)">Add Connection</button><?php
						}
					?>
                </td>
            </tr>
            </table>
                    </div>
                    <div id="gallery_body">
                    	
                    </div>
                </div>
                <div id="profile_footer">
                
                	
                </div>
            </div>
        </div>
        <?php include 'm_footer.php'; ?>
</body>
</html>