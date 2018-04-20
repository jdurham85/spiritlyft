<?php 
session_start();
include 'config.php';
include 'include/core.inc.php';
include 'include/connections.core.inc.php';
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/style1.css"/>
<link rel="stylesheet" href="css/commentbox_style1.css" />
<link rel="stylesheet" href="css/calender_homepage_style1.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<title>SpiritLyft</title>
</head>
<body>
<header>
    <?php include 'title.php'; ?>
</header>

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
<table id="online_panel">
	
</table>

        
<div id="body">
	<?php include 'menu_btn.php';  ?>
        <script type="text/javascript">
			$(document).ready(function(e) {
                $("#connection_body").load("include/connections.php").fadeIn();
            });
        </script>
        
        <style type="text/css">
			#menu_tab_c{
				background-color:white;
				width:78%;
				float:right;
			}
		
        	#menu_tab_c button{
				list-style:none;
				font-family:Arial;
				font-weight:bold;
				font-size:18px;
				text-decoration:none;
				color:black;
				padding:12px 12px 12px 12px;
				width:50%;
				float:left;
				text-align:center;
				background-color:white;
			}
			
			#connection_body{
				width:75%;
				float:left;
			}
			
			#connection_body button{
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
        </style>

    <div id="menu_tab_c" align="center">
		Connection Request
        <!--button onClick="connection_requests();">Connection Request (<?php //echo getConnectionsRequestCount($_SESSION['SessionMemberID']); ?>)</button-->
    </div>
    <div id="connection_body">
    	
    </div>
    
       
</div>
</body>
</html><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
</body>
</html>