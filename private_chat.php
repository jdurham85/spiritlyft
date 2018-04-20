<?php 
session_start();
include 'config.php';
include 'include/core.inc.php';
include 'include/connections.core.inc.php';
include 'include/chat_core.inc.php';

/*$useragent=$_SERVER['HTTP_USER_AGENT'];

if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
{
header('Location: m_private_chat.php'); 
exit();
}*/
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
<body  style="background-color: white;">
<style>
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
<script type="text/javascript">
$(document).ready(function(e) {
<?php 
	if(isset($_GET['id']) && !$_GET['id'] == "")
	{
		?>
			$("#mb<?php echo $_GET['id']; ?>").click();
		<?php
	}
	else
	{
		$mc = array();
		$mc = getMemberConnections($_SESSION['SessionMemberID']);
		echo '$("#mb'.$mc[0].'").click();';
	}
?>

//$("#private_chat_panel").height($(this).height() - 200);
//$("#chat_frame").height(600);
//$("#myconnections_panel").css("max-height", $(600);

//$("#chatbox_panel").height($(this).height());

//$("#private_chat_panel").height($(this).height());
});

//setInterval(getMemberOnline, 10000);

//getMemberOnline();

var selected_member = 0;

function getMemberOnline()
{
	$.post("include/member_online.php", {mo: 1}, function(mo){
		$("#online_panel").html(mo);
	
	});
}

//setInterval(function(){member_message_alert();}, 2000);
//setTimeout(function(){member_message_alert();}, 2000);
function member_message_alert(mid)
{
	//var mid = '';
	//$(".member_message_alert").each(function(){
		//mid = $(this).attr("id").substr(20);

		$.post("include/getMessageAlerts_from_Member.php", {id: mid}, function(alerts){
			if(alerts > 0)
			{
				$("#member_message_alert"+mid).html(alerts);
				$("#member_message_alert"+mid).addClass("alert_lb");
			}
			else
			{
				$("#member_message_alert"+mid).html("");
				$("#member_message_alert"+mid).removeClass("alert_lb");
			}
		});

		//alert_lb
	//});
}
</script>
<table id="online_panel">
	
</table>
	<?php //include 'menu_btn.php';  ?>
        <style type="text/css">
			#myconnections_panel
			{
				width: 20%;
				float: left;
				overflow-y: auto;
				max-height: 600px;
			}
			
			#myconnections_panel button
			{
				width:100%;
			}
			
			#chatbox_panel
			{
				width:80%;
				float: left;
			}
                        
                        .member_btn{
                            cursor: pointer;
                            font-family: arial;
                            font-size: 14px;
                            border: 1px black solid;
                            margin-top: .8px;
                        }
                        
                        .member_btn:hover{
                            background-color: #D6CEED;
                            font-weight: bold;
                        }
        </style>
        
        <script type="text/javascript">
        	function select_member(mem1)
			{
				$("#chat_frame").attr("src", "include/chatpanel_frame.php?mid="+mem1);
			}
        </script>
        <audio id="imalert_sound">
        	<source src="sound/imring.wav" type="audio/wav">
        </audio>
        
        <script type="text/javascript">
        </script>
        
        <div id="private_chat_panel" style="width: 100%;">
        	<div id="myconnections_panel">
            <?php echo set_myconnectionpanel(); ?>
       		</div>
	        <div id="chatbox_panel">
	            <iframe id="chat_frame" frameborder="0" height="" style="border:1px black solid; height: 600px; margin-left: 20%; width: 60%;" src="include/chatpanel_frame.php"></iframe>
	        </div>
        </div>
</body>
</html>