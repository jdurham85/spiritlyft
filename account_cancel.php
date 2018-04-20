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
    	<div id="header_sub">
            <div id="header_sub">
                 <div id="title1" align="center"><img src="image/sl_logo2.png" /></div>
            </div>
        </div>
    </header>
<style>
#profile_body{
	background-color:#E4E4E4;
	width:100%;
	font-family:Arial;
	color:white;
	text-align:center;
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
	padding:12px 12px 12px 12px;
	text-decoration:none;
	font-weight:bold;
	color:white;
	margin:auto;
	background-color:#4A338E;
	border:none;
}

#profile_footer
{
	width:100%;	
}

#profile_footer button
{
	padding:12px 12px 12px 12px;
	text-decoration:none;
	font-weight:bold;
	color:white;
	margin:auto;
	background-color:#4A338E;
	border:none;	
	font-size:18px;
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
	color:black;
	padding:6px 6px 6px 6px;
}

#picstatus button{
	padding:6px 6px 6px 6px;
	font-weight:bold;
	border-radius:6px;	
	border:none;
}
</style>
<table id="online_panel">
	
</table>
        <div id="body" align="center">
        <?php //include 'menu_btn.php';  ?>
            <div id="profile_body">
            
<script type="text/javascript">
	function general_page()
	{
			
	}

	$(document).ready(function() {
	 	
	});
</script>
                
                <div id="profile_header">
                	<div id="userfullname_textview">Cancel Account</div>
                </div>
                <div id="profile_inner_body">
                	<div id="profile_menu">
                    	
                    </div>
                    <div id="gallery_body">
                    	By Accepting Yes, All of your information will be delete.
                    </div>
                </div>
                <div id="profile_footer">
                	<a href="cancel_account.php"><button style="background-color:red;">Yes</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="home.php"><button style="background-color:green;">No</button></a>
                </div>
            </div>
        </div>
</body>
</html>