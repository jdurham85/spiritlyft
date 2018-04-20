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
<link rel="stylesheet" href="css/commentbox_style1.css" />
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
            <?php include 'm_header.php'; ?>
        </div>
    </header>
    <style type="text/css">
    	#giftshop_body{
			width:100%;
			border-left:1px black solid;
			border-bottom:1px black solid;
			border-right:1px black solid;
			font-family:arial;
		}
		
		#giftshop_body img
		{
			border: 1px black solid;
		}
	
		#giftshop_title{
			text-align:center;
			font-family:helvetica;
			font-size:28px;
			font-weight:bold;
			background-color:#4A338E;	
			width:100%;
			color:white;
		}
		
		.style_button1{
			padding:12px 12px 12px 12px;	
			background-color:#795FC5;
			float:left;
			color:white;
			border-radius:8px;
			font-size:14px;
			font-weight:bold;
		}
		
		.mycart_style button
		{
			padding:6px 6px 6px 6px;	
			background-color:#795FC5;
			color:white;
			border-radius:4px;
			font-size:12px;
			font-family: Arial;
			font-weight:bold;
		}
		
		.mycart_style input
		{
			width:20px;
			padding:6px 6px 6px 6px;
		}
    </style>
    
<script type="text/javascript">
function check_qty_input(event)
{
	event = (event) ? event : window.event;
    var charCode = (event.which) ? event.which : event.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

function update_cart_qty(id)
{
	var qty = document.getElementById("myorderqty"+id).value;
	
	if(qty == 0)
	{
		qty = 1;	
	}
	
	$.post("include/gifts.inc.php", {mycartqty: 1, cartid: id, cartqty: qty}, function(){
			show_mycart();
		});
}

function remove_product(id)
{
	$.post("include/gifts.inc.php", {mycartremove: 1, cartid: id}, function(){
			show_mycart();
		});	
}
	
function show_mycart()
{
	$.post("include/gifts.inc.php", {mycart: 1}, function(html){
			$("#giftshop_body").html(html);
		});	
}

function add_to_mycart(giftid, point)
{
	$.post("include/gifts.inc.php", {giftid: giftid, point: point}, function(html){
			$("#gift_btn"+giftid).html("Added to cart");
			$("#gift_btn"+giftid).attr("onclick", "");
		});		
}

function go_to_giftshop()
{
	window.location = "m_giftshop.php";	
}

function go_to_reviewOrder()
{
	window.location = "m_revieworder.php";	
}

show_mycart();
    </script>
  <div id="giftshop_title">MyCart</div>
            <table id="giftshop_body" cellpadding="4" cellspacing="4" align="center">
            	<tr id="gb">
                   <td></td>
                    <td colspan="1" align="center">
                    	<button style="" onClick="go_to_giftshop();">Giftshop<span id="mycart_alert"></span></button>
                    </td>
        		</tr>
                </table>
 </div>
</body>
</html>