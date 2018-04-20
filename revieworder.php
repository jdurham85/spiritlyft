<?php
session_start();
include 'include/gifts.inc.php';
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
header('Location: m_revieworder.php'); 
exit();
}

?>
<!doctype html>
<html><head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/style1.css"/>
<link rel="stylesheet" href="css/commentbox_style1.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php include 'meta_header.php'; ?>
<title>SpiritLyft</title>
</head>
<div id="back-screen" style="width:100%; height:900px; display:none; position:fixed; z-index:4; background-color:#4A338E; opacity:1;" align="center">
    <iframe id="paypal_f" name="paypal_f" style="width:37%; margin-top:2%; border:none; z-index:8; background-color:white; position:sticky; height:700px;" align="middle">           
    </iframe>
</div>  
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
			width:75%;
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
			$("#back-screen").fadeIn('fast', function(){
					$("#form1").submit();
				});
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
            <?php include 'menu_btn.php';  ?>
            <div id="giftshop_title">Review Order</div>
            <!--form id="form1" name="form1" onSubmit="startprocess();" method="post" target="paypal_f" action="http://www.sandbox.paypal.com/cgi-bin/webscr">
            	<input type="hidden" name="cmd" value="_xclick">
                <input type="hidden" name="business" value="tyres1997@gmail.com">
                <input type="hidden" name="item_name" value="Gift Shop">
                <input type="hidden" name="item_number" value="<?php //echo rand(1000,9999);?>">
                <input type="hidden" name="amount" value="<?php //echo getOrderTotal();?>">
                <input type="hidden" name="no_shipping" value="1">
                <input type="hidden" name="custom" value="<?php //echo MemberFullName($_SESSION['SessionMemberID']);?>">
                <input type="hidden" name="return" value="http://www.spiritlyft.com/include/ppsuccess.php">
                <input type="hidden" name="cancel_return" value="http://www.spiritlyft.com/include/ppcancel.php">
                <input type="hidden" name="no_note" value="1">
                <input type="hidden" name="currency_code" value="USD">
            	<table id="giftshop_body" cellpadding="4" cellspacing="4">
                    <tr id="gb">
                       <td></td>
                        <td colspan="1" align="center">
                            <button style="" onClick="go_to_mycart();">My Cart<span id="mycart_alert"></span></button>
                        </td>
                    </tr>
                    </table>
            </form-->
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