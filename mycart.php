<?php
session_start();
include 'config.php';
include 'include/core.inc.php';

if(isset($_SESSION['APP_MODE']) && $_SESSION['APP_MODE'] == 1)
{
	header("Location: app_".str_replace("/", "", $_SERVER['PHP_SELF']));
	exit();
}

$useragent=$_SERVER['HTTP_USER_AGENT'];

if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
{
header('Location: m_mycart.php'); 
exit();
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/style1.css"/>
<link rel="stylesheet" href="css/commentbox_style1.css" />
<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
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
    	#giftshop_body{
			width:75%;
			float:left;
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
			width:75%;
			color:white;
			float:left;
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
	window.location = "giftshop.php";	
}

function go_to_reviewOrder()
{
	window.location = "revieworder.php";	
}

show_mycart();
</script>
        <div id="body">
            <?php include 'menu_btn.php';  ?>
            <div id="giftshop_title">MyCart</div>
            <table id="giftshop_body" cellpadding="4" cellspacing="4">
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