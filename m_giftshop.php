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
<div id="giftshopborder" align="center">
	<table id="giftshop_help_tb" style="width: 100%; margin-top: 50px; background-color: #EFECF7;">
		<tr>
			<td align="right">
				<button onClick="giftshopborder_toggle();">Close</button>
			</td>
		</tr>
		<tr>
			<td style="font-family: Arial; font-size: 16px; font-weight: bold; line-height: 20px;" align="center">
				Choose one or more virtual gifts. Add to cart, view cart after choosing your gifts. Once gifts are purchased they are placed in your treasure box. They will be available for you to write a personal note, then send to one of your connections.
			</td>
		</tr>
	</table>
</div>
<body>
	<header>
    	<div id="header_sub">
            <?php include 'm_header.php'; ?>
        </div>
    </header>
<style type="text/css">
	#giftshopborder
	{
		width: 100%;
		position: fixed;
		z-index: 5;
		display: none;
		background-color: #4A338E;
	}

	#giftshop_body{
		width:100%;
		border-left:1px black solid;
		border-bottom:1px black solid;
		border-right:1px black solid;
	}

	#giftshop_body img
	{
		border: 1px black solid;
	}

	#giftshop_body button{
		padding:12px 12px 12px 12px;	
		background-color:#795FC5;
		float:left;
		color:white;
		border-radius:8px;
		font-size:12px;
		font-weight:bold;
	}

	#giftshop_body select{
		padding:6px 6px 6px 6px;	
		background-color:#795FC5;
		color:white;
		border-radius:8px;
		font-size:12px;
		font-weight:bold;
		width:100%;
		height: 50px;
	}

	#giftshop_title{
		text-align:center;
		font-family:helvetica;
		font-size:42px;
		font-weight:bold;
		background-color:#4A338E;	
		width:100%;
		color:white;
	}
</style>

<script type="text/javascript">
$(document).ready(function(){
	$("#giftshopborder").height($(this).height());
});	
	
function giftshopborder_toggle()
{
	$("#giftshopborder").slideToggle();
}
	
function show_gifts()
{
	$.post("include/gifts.inc.php", {show_gifts: 1, category: 0, page: 0}, function(html){
			$("#giftshop_body").html(html);
		});	
}

function add_to_mycart(giftid, filename, point)
{
	$.post("include/gifts.inc.php", {giftid: giftid, filename: filename, point: point}, function(){
			$("#gift_btn"+giftid).html("Added to cart");
			$("#gift_btn"+giftid).attr("onclick", "");
		});		
}

function go_to_mycart()
{
	window.location = "mycart.php";	
}
		
function show_gifts_by_category()
{
	//show_gifts_by_category()
	var old_selected = document.getElementById("gcategory")[document.getElementById("gcategory").selectedIndex].value;
	if(old_selected == 0)
	{
		show_gifts();
	}
	else
	{
		$("#giftshop_body").html("Loading...");
		$.post("include/gifts.inc.php", {show_gifts_by_category:1, categoryid: old_selected , page: 0}, function(html){
			$("#giftshop_body").html(html);
		});	
	}
}

show_gifts();
    </script>
        <div id="body">
            <div id="giftshop_title">GiftShop</div>
            <div id="giftshop_body"></div>
        </div>
</body>
<?php include 'm_footer.php'; ?>
</html>