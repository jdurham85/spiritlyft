<?php
session_start();
include 'include/gifts.inc.php';
include 'config.php';
include 'include/core.inc.php';

?>
<!doctype html>
<html><head>
<meta charset="utf-8">
<!-- Include meta tag to ensure proper rendering and touch zooming -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Include jQuery Mobile stylesheets -->
<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">

<!-- Include the jQuery library -->
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Include the jQuery Mobile library -->
<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

<link rel="stylesheet" href="css/style1_m.css"/>
<title>SpiritLyft</title>
</head>
<body>
	<header>
    	<div id="header_sub">
            <?php include 'app_header.php'; ?>
        </div>
    </header>
    <style type="text/css">
    	#giftshop_body{
			width:75%;
			float:left;
			border-left:1px black solid;
			border-bottom:1px black solid;
			border-right:1px black solid;
		}
		
		#giftshop_body img
		{
			border: 1px black solid;
		}
		
		#giftshop_body button{
			padding:8px 8px 8px 8px;
			background-color:#795FC5;
			float:left;
			color:white;
			border-radius:8px;
			font-size:14px;
			font-weight:bold;
			width:100%;
		}
		
		#giftshop_body select{
			padding:8px 8px 8px 8px;	
			background-color:#795FC5;
			color:white;
			border-radius:8px;
			font-size:18px;
			font-weight:bold;
			width:40%;
		}
		
		#giftshop_title{
			text-align:center;
			font-family:helvetica;
			font-size:28px;
			font-weight:bold;
			background-color:#4A338E;	
			float:left;
			width:100%;
			color:white;
		}
		
		#paypal_btn
		{
			cursor:pointer;
		}
    </style>
    
    <script type="text/javascript">
		$(document).ready(function(e) {
        	$("#back-screen").height($(this).height());  
        });
		
		function startprocess()
		{
			$("#form1").submit();
		}
		
		function show_reviewOrder()
		{
			$.post("include/gifts.inc.php", {revieworder: 1}, function(html){
					$("#giftshop_body").append(html);
				});	
		}
		
		function go_to_mycart()
		{
			window.location = "mycart.php";	
		}
		
		show_reviewOrder();
		
		function go_next_page(status)
		{
			window.location = "pporder_status.php?pps="+status;		
		}
    </script>
        <div id="body">
            <div id="giftshop_title">Review Order</div>
            <table id="giftshop_body" cellpadding="4" cellspacing="4">
                    <tr id="gb">
                       <td></td>
                        <td colspan="1" align="center">
                            <button style="" onClick="go_to_mycart();">My Cart<span id="mycart_alert"></span></button>
                        </td>
                    </tr>
             </table>
        </div>
</body>
</html>