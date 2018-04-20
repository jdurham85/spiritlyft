<?php
session_start();
include 'config.php';
include 'include/core.inc.php';
include 'include/connections.core.inc.php';

if(isset($_SESSION['APP_MODE']) && $_SESSION['APP_MODE'] == 1)
{
	header("Location: app_".str_replace("/", "", $_SERVER['PHP_SELF']));
	exit();
}

$useragent=$_SERVER['HTTP_USER_AGENT'];

if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
{
header('Location: m_mytreasure.php'); 
exit();
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/style1.css"/>
<link rel="stylesheet" href="css/commentbox_style1.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php include 'meta_header.php'; ?>
<title>SpiritLyft</title>
</head>
<body>
	<header>
    	<div id="header_sub">
            <?php include 'title.php'; ?>
        </div>
    </header>
<style type="text/css">
	#mytreasure_bodytb{
		width:60%;
		border-left:1px black solid;
		border-bottom:1px black solid;
		border-right:1px black solid;
		text-align:center;
		float:left;
		margin-left:10px;
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
		font-size:42px;
		font-weight:bold;
		background-color:#BDB1E3;	
		width:60%;
		color:white;
		float:left;
		margin-left:10px;
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
		float:left;
		margin-left:10px;
		width:60%;
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
		width: 60%;
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
            <?php include 'menu_btn.php'; ?>
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
                    	<textarea type="text" id="giftmessage_input" maxlength="256" placeholder="Type something..." onKeyPress="char_limit();" style="width:99%; text-wrap:unrestricted; font-family:Arial; font-size:12px; height:200px;"></textarea><br>
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
</body>
</html>