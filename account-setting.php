<?php 
session_start();
include 'config.php';
include 'include/core.inc.php';
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/style1.css"/>
<link rel="stylesheet" href="css/commentbox_style1.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<title>SpiritLyft</title>

</head>
<body>
<header>
    <?php include 'title.php'; ?>
</header>
<style>
#profile_body{
	margin-top:5px;
	background-color:#E4E4E4;
	width:75%;
	font-family:Arial;
	color:white;
	float:left;
	margin-left:10px;
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
	margin-top:40px;
	font-size:30px;
	text-align:center;
}

#profile_menu{
	padding:12px 8px 8px 8px;
}

#profile_menu a
{
	border:1px black solid;
	padding:8px 8px 8px 8px;
	text-decoration:none;
	color:black;
	font-weight:bold;
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

#profile_inner_body
{
	border-top: 1px black solid;
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

#cancel_Account_background
{
	background-color:#F7F5FB;
	position:fixed;
	z-index:5;
	width:100%;
}
</style>
    
<script type="text/javascript">
setInterval(getMemberOnline, 10000);

getMemberOnline();

function getMemberOnline()
{
	$.post("include/member_online.php", {mo: 1}, function(mo){
		$("#online_panel").html(mo);
	
	});
}
</script>
</div>
        <div id="body">
        <?php include 'menu_btn.php';  ?>
            <div id="profile_body">
            
<script type="text/javascript">
	function general_page()
	{
			
	}

	$(document).ready(function() {
	 	$("#gallery_body").load("include/general.php");
	});
</script>
            	
                <div style="display:none;">
                </div>
                
                <div id="profile_header">
                	<div id="userfullname_textview">Account Settings</div>
                </div>
                <div id="profile_inner_body">
                	<div id="profile_menu">
                    	<a href="javascript:void();" onClick="general();">General</a>
                    </div>
                    
                    
                    
                    <div id="gallery_body">
                    	
                    </div>
                </div>
                <div id="profile_footer">
                
                	
                </div>
            </div>
        </div>
</body>
</html>