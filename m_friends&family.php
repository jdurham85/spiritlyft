<?php 
session_start();
include 'config.php';
include 'include/core.inc.php';
include 'include/connections.core.inc.php';

if($_GET['profileid'] == $_SESSION['SessionMemberID'] || $_GET['profileid'] == "")
{
	header("Location: m_myprofile.php");
	exit();
}

//Check if Connected with Member
if(!in_array($_GET['profileid'], getMemberConnections($_SESSION['SessionMemberID'])))
{
	header("location: m_notconnected.php?profileid=".$_GET['profileid']);	
	exit();
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/style1_m.css"/>
<link rel="stylesheet" href="css/commentbox_style1.css" />
<!-- Include meta tag to ensure proper rendering and touch zooming -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Include jQuery Mobile stylesheets -->
<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">

<!-- Include the jQuery library -->
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Include the jQuery Mobile library -->
<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<?php include 'meta_header.php'; ?>
<title>SpiritLyft</title>
</head>
<body>
<?php include 'm_header.php'; ?>
    <style>
    	#profile_body{
			background-color:#E4E4E4;
			font-family:Arial;
			color:white;
			border-left:1px black solid;
			border-bottom:1px black solid;
			border-right:1px black solid;
			width: 99%;
		}
		
		#profile_header
		{
			background-color:#4A338E;
			width:100%;
			font-weight:bold; 
			padding:2px 2px 2px 2px;
		}
		
		#userfullname_textview{
			margin-top:25px;
			font-size:25px;
			text-align:center;
		}

		#profile_menu a
		{
			text-decoration: none;
			z-index: -1;
		}
		
		#profile_menu{
			padding:8px 8px 8px 8px;
			text-align: center;
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

		.connection_style
			{
				border:1px black solid;
				border-radius:4px;
				width:100%;
				background-color:white;
			}

.connection_style_info button
{
	font-size: 14px;
	color: white;
	background-color: #4A338E;
	font-weight: bold;
	border:none;
	line-height: 30px;
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
				$(document).ready(function() {
  					$.post("include/member_connections.php",{profileid: <?php echo $_GET['profileid'] ?>}, function(mc){
  						$("#gallery_body").html(mc);
  					});
                });
            </script>
            	
                <div style="display:none;">
                	<form action="include/profile.inc.php" id="galleryfrm" target="profile_iframe" enctype="multipart/form-data" method="post">
                    	<input type="file" id="galleryfile" name="galleryfile" />
                        <input type="submit" id="submitg_btn" />
                    </form>
                    
                    <iframe id="profile_iframe" name="profile_iframe"></iframe>
                </div>
                
                <div id="profile_header">
                	<div id="userfullname_textview"><?php echo MemberFullName($_GET['profileid']); ?></div>
                </div>
                <div id="profile_inner_body">
                		<table id="profile_menu" align="center">
	                    	<tr>
	                    		<td>
	                    			<a target="_self" href="m_profile.php?profileid=<?php echo $_GET['profileid']; ?>"><button style="cursor: pointer;">My Profile</button></a>	
	                    		</td>
	                    		<td>
									<a target="_self" href="m_gallery.php?profileid=<?php echo $_GET['profileid']; ?>"><button style="cursor: pointer;">My Gallery</button></a>
	                    		</td>
	                    		<td>
									<a target="_self" href="m_friends&family.php?profileid=<?php echo $_GET['profileid']; ?>"><button style="cursor: pointer;">My Friends & Family</button></a>
	                    		</td>
	                    	</tr>
                    	</table>
                  
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