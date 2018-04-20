<?php 
session_start();
include 'config.php';
include 'include/core.inc.php';
include 'include/connections.core.inc.php';

connection_suggestions_fetch();

if(!isset($_SERVER['SessionMemberID']) && $_SESSION['SessionMemberID'] == "")
{
	$_SESSION['sessionAfterLoginRedirect'] = $_SERVER['REQUEST_URI'];
	header("location: m_index.php");
	exit();
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/style1_m.css"/>
<link rel="stylesheet" href="css/commentbox_style1.css" />
<link rel="stylesheet" href="css/calender_homepage_style1.css" />
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
    <?php include 'm_header.php'; ?>
</header>
<div id="body">
        <script type="text/javascript">
        	function connections()
			{
				$("#connection_body").load("include/connections.php");
			}
			
			function connection_requests()
			{
				$("#connection_body").load("include/connections_request.php");
			}
			
			function myconnection()
			{
				$("#connection_body").load("include/myconnections.php");
			}

			function connection_suggestions()
            {
            	$("#connection_body").load("include/connections-suggestions.php");
            } 
			
			$(document).ready(function(e) {
                   <?php 
                	if(isset($_GET['mode']) && $_GET['mode'] != "")
                	{
                		?>
                			connection_requests();
                		<?php
                	}
                	else
                	{
                		?>
                			myconnection();
                		<?php
                	}
                 	?>

                 	setInterval(function(){
                	getConnectionRequestCount();
                }, 2000);
            });

            function getConnectionRequestCount()
            {
            	

            	$.post("include/getConnectionsRequestCount.php", function(crc){
            		if(crc != 0)
            		{
            			$("#connections_request_count").html(crc);
            			$("#connections_request_count").addClass("alert_lb");
            		}
            		else
            		{
            			$("#connections_request_count").html("");
            			$("#connections_request_count").removeClass("alert_lb");
            		}
            	});
            }
        </script>
        
        <style type="text/css">
			#menu_tab_c{
				background-color:white;
				width:100%;
			}
		
        	#menu_tab_c button{
				list-style:none;
				font-family:Arial;
				font-weight:bold;
				font-size:12px;
				text-decoration:none;
				color:black;
				padding:10px 10px 10px 10px;
				width:33.3%;
				float:left;
				text-align:center;
				background-color:white;
			}
			
			#connection_body{
				width:92%;
			}
			
			#connection_body button{
				padding:4px 2px 4px 2px;
				border:none;
				margin-right:10px;
				font-size:14px;
				font-weight:bold;
				font-family: Arial;
				color:white;
				background-color:#795FC5;
				border-radius:6px;	
			}
			
			.connection_box
			{
				width: 99%;
				margin: auto;
			}
			
			.connection_style
			{
				border:1px black solid;
				border-radius:4px;
				width:100%;
				margin-left:18px;
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

			.alert_lb{
			border-radius:20%;	
			padding:2px 4px 2px 4px;
			background-color:red;
			color:white;
			float:right;
			font-family:Arial;
			font-weight:bold;
}
        </style>

    <div id="menu_tab_c" align="center">
    	<button onClick="myconnection();">My Connections (<?php echo count(getMemberConnections($_SESSION['SessionMemberID'])); ?>)</button>
        <button onClick="connection_requests();">Connection Request <div id="connections_request_count"></div></button>
        <button onClick="connection_suggestions();">Connection Suggestions</button>
    </div>
    <div id="connection_body">
    	
    </div>
    
       
</div>
<?php include 'm_footer.php'; ?>
</body>
</html>