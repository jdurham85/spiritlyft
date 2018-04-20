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
<!-- Include meta tag to ensure proper rendering and touch zooming -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Include jQuery Mobile stylesheets -->
<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">

<!-- Include the jQuery library -->
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Include the jQuery Mobile library -->
<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

<link rel="stylesheet" href="css/style1_m.css"/>
<?php include 'meta_header.php'; ?>
<title>SpiritLyft</title>
</head>
<body>
	<header>
		<?php include 'app_header.php'; ?>
    </header>
<style type="text/css">
	#mytreasure_bodytb{
		width:99%;
		border-left:1px black solid;
		border-bottom:1px black solid;
		border-right:1px black solid;
		text-align:center;
	}
	
	#mytreasure_bodytb img
	{
		border: 1px black solid;
	}
	
	#mytreasure_bodytb button{
		background-color:#4F3891;
		line-height:30px;
		width:100px;
		color:white;
		font-family:Helvetica;
		font-weight:bold;
		border-radius:6px;
	}
	
	#mytreasure_bodytb select{
		
	}
	
	#mytreasure_title{
		text-align:center;
		font-family:helvetica;
		font-size:20px;
		font-weight:bold;
		background-color:#BDB1E3;	
		width:99%;
		color:white;
		line-height:95px;
	}
	
	.treasure_title
	{
		font-family:helvetica;
		font-size:20px;
		text-align:center;
		font-weight:bolder;
	}
	
	.treasure_title td
	{
		border-bottom:2px black solid;
	}
	
	.treasure_row td
	{
		border-bottom:1px black solid;
	}
	
	#send_giftbox_tb
	{
		width:99%;
		display:none;
	}
	
	#send_giftbox_tb select
	{
		height:50px;
		font-family:Arial;
	}
	
	#send_giftbox_tb button
	{
		font-family:Arial Black;
		background-color:#4B338E;
		border-radius:8px;
		color:white;
	}

	#who_did_I_send_gift_tb
	{
		display: none;
		width: 99%;
	}

	#who_did_I_send_gift_tb td
	{
		border-bottom: 2px black soild;
	}
</style>

<script type="text/javascript">
$(document).ready(function(e) {
    mytreasure_show();
});

function who_did_I_send_gift_tb_show()
{
	$("#who_did_I_send_gift_tb").html("Loading...");
	$.post("include/who_did_I_send_gift_to.php", function(who_did_I_send_gift){
		$("#who_did_I_send_gift_tb").html(who_did_I_send_gift);
	});

	$("#who_did_I_send_gift_tb").fadeIn('fast', function(){
		$("#mytreasure_bodytb").fadeOut('fast');
	});
}

function who_did_I_send_gift_tb_hide()
{
	$("#mytreasure_bodytb").fadeIn('fast', function(){
		$("#who_did_I_send_gift_tb").fadeOut('fast');
	});
}

function mytreasure_show()
{
	$.post("include/gifts.inc.php", {mytreasure: 1}, function(html){
			$("#mytreasure_bodytb").html(html);
		});
}

function send_giftbox_show(id)
{
	document.getElementById("giftid").value = id;
	$("#mytreasure_bodytb").fadeOut('fast', function(){$("#send_giftbox_tb").fadeIn();});
	
	document.getElementById("send_giftbox_img").setAttribute("src", document.getElementById("giftimg"+id).getAttribute("src"));
}

function send_giftbox_close()
{
	$("#send_giftbox_tb").fadeOut('fast', function(){$("#mytreasure_bodytb").fadeIn();});
	document.getElementById("send_giftbox_message").innerHTML = "";	
	document.getElementById("giftmessage_input").value = "";
}

function char_limit()
{
	document.getElementById("char_count").value = 256 - document.getElementById("giftmessage_input").value.length;	
}

function selected_connections()
{
	if(document.getElementById("selected_connection").value != "")
	{
		document.getElementById("send_giftbox_btn").innerHTML = "Send Gift to " + document.getElementById("selected_connection").value;	
	}	
	else
	{
		document.getElementById("send_giftbox_btn").innerHTML = "Send Gift";	
	}
}

function send_gift_to_connection()
{
	var memid = document.getElementById("selected_connection").value;
	if(memid != "")
	{
		var giftid = document.getElementById("giftid").value;
		
		
	
		$.post("include/gifts.inc.php", {giftid: giftid, toMember: memid, message: document.getElementById("giftmessage_input").value, send_gift_to_connection: 1}, function(result){
				if(result == 0)
				{
					mytreasure_show();
					document.getElementById("giftmessage_input").value = "";
					document.getElementById("send_giftbox_message").innerHTML = "Your gift has been sent";
					
					document.getElementById("giftqty"+giftid).innerHTML = document.getElementById("giftqty"+giftid).innerHTML - 1;
				}
				else
				{
					document.getElementById("send_giftbox_message").innerHTML = "Your gift has bot been sent, Please try again";	
				}
			});	
	}
	else
	{
		alert("Select a Connection");	
	}
}
</script>
        <div id="body">
            <table id="mytreasure_title" cellspacing="0" cellpadding="0">
            	<tr>
            		<td><img src="image/chest.png" style="width: 80px; float:left; margin-top:5px; position:relative;" /></td>
            		<td>My Treasure Box</td>
            	</tr>
            	<tr>
            		<td colspan="2" align="center"><button onclick="who_did_I_send_gift_tb_show();" style="padding:4px 4px 4px 4px; background-color: #4A338E; color:white; border-radius: 6px; font-weight: bold;">Who did I send my gift to?</button></td>
            	</tr>
            </table>
            <table id="mytreasure_bodytb" cellpadding="4" cellspacing="0">
            	
            </table>
            
            <input type="hidden" id="giftid" value="" />
            <table id="who_did_I_send_gift_tb">

            </table>
            <table id="send_giftbox_tb">
            	<tr>
                	<td>
                    	<button style="float:right; font-family:Arial Black; background-color:#4F3891; color:white; font-size:18px;" onClick="send_giftbox_close();">X</button>
                    </td>
                </tr>
                <tr align="center">
                	<td id="send_giftbox_message">
                    	
                    </td>
                </tr>
                <tr>
                	<td align="center">
                    	<img id="send_giftbox_img" src="" width="300" />
                    </td>
                </tr>
                <tr>
                	<td>
                    	<textarea type="text" id="giftmessage_input" maxlength="256" onKeyPress="char_limit();" placeholder="Type something..." style="width:99%; text-wrap:unrestricted; font-family:Arial; font-size:12px; height:200px;"></textarea><br>
                        <span style="float:right;">Char Length: <input type="text" id="char_count" value="256" style="text-align:center; width:30px;" readonly /></span> 
                    </td>
                </tr>
                <tr>
                	<td align="center">
                    	Who are you sending to? <select id="selected_connection">
                        	<option value="">Select a Connection</option>
                            <?php 
								foreach(getMemberConnections($_SESSION['SessionMemberID']) as $value)
								{
									echo "<option value='".$value."'>".MemberFullName($value)."</option>";	
								}
							?>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td align="center">
                    	<button id="send_giftbox_btn" onClick="send_gift_to_connection();">Send Gift</button>
                    </td>
                </tr>
            </table>
        </div>
        <?php include 'm_footer.php'; ?>
</body>
</html>