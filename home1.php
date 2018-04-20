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
	if(isset($_GET['showwall']) && $_GET['showwall'] !="" && isset($_GET['id']) && $_GET['id'] !="")
	{
		header('Location: m_home.php?showwall=' . $_GET['showwall'] . '&id=' . $_GET['id']); 
		exit();
	}
	
	header('Location: m_home.php'); 
	exit();
}

if(!isset($_SERVER['SessionMemberID']) && $_SESSION['SessionMemberID'] == "")
{
	$_SESSION['sessionAfterLoginRedirect'] = $_SERVER['REQUEST_URI'];
	header("location: index.php");
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
<script src="js/post.inc.js"></script>
<?php include 'meta_header.php'; ?>
<title>SpiritLyft</title>
<!-- player skin -->
<link rel="stylesheet" href="css/skin/skin.css">

<!-- for video tag based installs flowplayer depends on jQuery 1.7.2+ >
<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script-->

<!-- include flowplayer -->
<script src="js/flowplayer.min.js"></script>
<script src="js/core.inc.js"></script>
</head> 
<body>
<div id="mainheadersub" style="height: 60px; position: absolute;"></div>
<header id="mainheader">
    <?php include 'title.php'; ?>
</header>



<div id="back-screen" style="width:100%; height:900px; position:relative; z-index:4; display:none; background-color:#4A338E; opacity:0.9;" align="center">
    <iframe id="postview_frame" name="postview_frame" style="width:37%; border:none; display: none; border-radius:4px; z-index:8; background-color:white; position:sticky; height:700px;" align="middle">
            
    </iframe>
    <div id="videoview_panel" align="center" style="color:white; display:none; font-family:Arial Black; font-size:40px;">
    	Adding Video Please wait...
    </div>
     <div id="imageview_panel" align="center" style="font-family:Arial; display: none; font-weight:bold; font-size:45px; color:white;">
    	Adding Images....
    </div>
</div>

<style>
#newsfeed_f_scroll
{
	right: 0;
	width: 20px;
	position: absolute;
	overflow-y: scroll;
	display: none;
}

#newsfeed_f::-webkit-scrollbar
{
	background-color: green;
}

</style>
<script>
$(document).ready(function(){
	$("#wallpost_caption_backwall").height($(this).height());
	$("#newsfeed_f_scroll").css("height", $(this).height() - 60);
	//$("#newsfeed_f").height($(this).height());
	//$("#newsfeed_f").height($("#postbody").height());

	
});

function wallpost_caption_show()
{
	$("#wallpost_caption_backwall").fadeIn();
}

function wallpost_caption_close()
{
	$(".wall_post_main_option").show();
	$(".wall_option_tb").hide();
	$(".wall_caption_panel").hide();
	$("#wallpost_caption_input_txt").val('');
	$("#wallpost_caption_backwall").fadeOut();
}

function wallpost_caption_add_caption()
{
	$("#postinput").attr("value", $("#wallpost_caption_input_txt").val());
	
	if(mode == 0)
	{
		addImagePost();
	}

	if(mode == 1)
	{
		VideoPostPreview();
	}

	wallpost_caption_close();
}

function wall_post_option_yes()
{
	$(".wall_option_tb").hide();
	$(".wall_caption_panel").show();
	$("#wallpost_caption_input_txt").focus();
}

function wallpost_caption_dont_add_caption()
{
	if(mode == 0)
	{
		addImagePost();
	}

	if(mode == 1)
	{
		VideoPostPreview();
	}
	wallpost_caption_close();
	//$("#")
}

function wallpost_post()
{
	$(".wall_post_main_option").fadeOut('fast', function(){
		$(".wall_option_tb").fadeIn();
	});
}
</script>
<style>
#wallpost_caption_backwall
{
	position: fixed;
	width: 100%;
	background-color:#4A338E;
	z-index: 1;
	display:none;
}

#wallpost_caption
{
	width: 30%;
	position: fixed;
	border-radius: 10px;
	background-color: white;
	font-family: Arial;
	margin-left: 35%;
	height: 100px;
}
.wall_caption_panel
{
	display: none;
}

.wall_option_tb
{
	display: none;
}
</style>
<div id="wallpost_caption_backwall" align="center">
<table id="wallpost_caption">
	<tr class="wall_post_main_option">
		<td colspan="2" style="font-size: 18px;" align="center">
			Where would you like to add your picture?
		</td>
	</tr>

	<tr class="wall_post_main_option">
		<td align="center">
			<button style="padding:6px 6px 6px 6px; background-color: #4A338E; border: none; font-size: 18px; width: 40%; border-radius: 2px; font-weight: bold; color:white;" onclick="wallpost_post();">Post</button>
			<a href="myprofile.php">
				<button style="padding:6px 6px 6px 6px; background-color: #4A338E; border: none; font-size: 18px; width: 40%; border-radius: 2px; font-weight: bold; color:white;" onclick="">My Profile</button>
			</a>
		</td>
	</tr>

	<tr class="wall_option_tb">
		<td colspan="2" align="center" style="font-size: 18px;">
			Would you like to add a caption ?
		</td>
	</tr>
	<tr class="wall_option_tb">
		<td align="left">
			<button style="padding:6px 6px 6px 6px; background-color: green; border: none; font-size: 18px; width: 40%; border-radius: 2px; font-weight: bold; color:white;" onclick="wall_post_option_yes();">Yes</button>
		</td>
		<td align="right">
			<button style="padding:6px 6px 6px 6px; background-color: red; border: none; font-size: 18px; width: 40%; border-radius: 2px; font-weight: bold; color:white;" onclick="wallpost_caption_dont_add_caption();">No</button>
		</td>
	</tr>
	<tr class="wall_caption_panel">
		<td colspan="2" align="center">
			<input type="text" id="wallpost_caption_input_txt" placeholder="add caption here." style="line-height: 50px; width: 99%;" name="">
		</td>
	</tr>
	<tr class="wall_caption_panel">
		<td colspan="2" align="center">
			<button style="padding:6px 6px 6px 6px; background-color: green; border: none; font-size: 18px; width: 30%; border-radius: 2px; font-weight: bold; color:white;" onclick="wallpost_caption_add_caption();">Post</button>
		</td>
	</tr>
</table>
</div>
<?php
//}
?>

<div id="wallback-screen" style="width:100%; position:relative; display:none; z-index:4; background-color:#4A338E;" align="center">
    <div id="emotionview_panel" align="center" style="width:25%; font-family:Arial; background-color:white; font-size:12px;">
    	
    </div>
</div>

<script type="text/javascript">
var mode = 0;
function emotionview_panel_close()
{
	$("#wallback-screen").fadeOut('fast', function(){
		$("#emotionview_panel").fadeIn(function(){
			$(this).html('');
			$("#body").show();
			});
		});			
}

function emotionview_panel_show(wall)
{
	$("#wallback-screen").height($(document).height());
	
	$("#wallback-screen").fadeIn('fast', function(){
		$("#body").hide();
		$.post("include/getMember_WITH_Emojlis.php", {wallid: wall}, function(html){
				$("#emotionview_panel").html(html);
			});
		});	
}

function emotionview_panel_show_with_seperated_emojli(wall, id)
{
		$.post("include/getMember_WITH_Emojlis.php", {wallid: wall, e: id}, function(html){
				$("#emotionview_panel").html(html);
			});
}

var wallid = '';
function setSelectedEmojli(emojli)
{
	window.frames['newsfeed_f'].setSelectedEmojli(emojli);
	window.frames['newsfeed_f'].like_wall(wallid, emojli);
	WallbackScreen_hide();	
}


function WallbackScreen_show(wall)
{
	$("#wallback-screen").fadeIn();
	$("#body").fadeOut();
	wallid = wall;
}

function WallbackScreen_hide()
{
	$("#wallback-screen").fadeOut();
	$("#body").fadeIn();
}

setInterval(getMemberOnline, 10000);

getMemberOnline();

function getMemberOnline()
{
	$.post("include/member_online.php", {mo: 1}, function(mo){
		$("#online_panel").html(mo);
	
	});
}
</script>
<div id="member_online_scroll">
<table id="online_panel">
	
</table>
</div>

<div id="slideshowbackground" align="center">
	<table style="width:60%;">
		<tr>
			<td align="center">
				<button id="slideshow_close_btn" style="float: right; line-height: 30px;" onClick="slideshow_close();">Close</button>
			</td>
		</tr>
		<tr>
			<td align="center">
				<iframe id="slideshow" frameborder="0" id="slideshow" style="width: 100%; background-color: white;">
				</iframe>
			</td>
		</tr>
	</table>
</div>

<div id="body">
<table id="add_event_tb" cellpadding="1" cellspacing="6">
    <tr align="right">
        <td><button style="background-color:red; padding:6px 6px 6px 6px; border-width:2px; font-family:Arial Black; border-color:#A61417; border-radius:4px;" onClick="event_tb_close();">X</button></td>
    </tr>
	<caption id="add_event_caption"></caption>
    <tr align="center">
    	<td>
        	Event Title <input type="text" id="eventtitle" name="eventtitle" style="padding:6px 6px 6px 6px; width:400px; border-radius:4px;" />
        </td>
    </tr>
    <tr align="center">
    	<td>
        	Event Date: <select id="eventdate" name="eventdate" disabled style="padding:6px 6px 6px 6px; border-radius:4px;"></select>
            
            <select id="eventtimea" name="eventtimea" style="width:60px; padding:6px 6px 6px 6px; border-radius:4px;">
            	<?php 
					for($t=1; $t < 13; $t++)
					{
						if($t <= 9)
						{
							print '<option value="0'.$t.'">0'.$t.'</option>';	
						}
						else
						{
							print '<option value="'.$t.'">'.$t.'</option>';		
						}
					}
				?>
            </select>
            :
            <select id="eventtimeb"  name="eventtimeb" style="width:60px; padding:6px 6px 6px 6px; border-radius:4px;">
            	<?php 
					for($t=0; $t < 60; $t++)
					{
						if($t <=9)
						
						{
							print '<option value="0'.$t.'">0'.$t.'</option>';	
						}
						else
						{
							print '<option value="'.$t.'">'.$t.'</option>';		
						}
					}
				?>
            </select>
            <select id="eventtimec" name="eventtimec" style="padding:6px 6px 6px 6px; border-radius:4px;">
            	<option value="AM">AM</option>
                <option value="PM">PM</option>
            </select>
        </td>
    </tr>
    
    <tr>
    	<td colspan="2">
        	<button style="padding:6px 6px 6px 6px; width:100%; border-radius:6px; color:white; font-family:arial; background-color:#340AB0;" onClick="add_event_toDB();">Add Event</button>
        </td>
    </tr>
    
    <tr align="center">
    	<td>
        	<table id="listevent" width="100%">
        	</table>
        </td>
    </tr>
</table>
<style>
#calender_panel{
	right:0;
	width:15%;	
	position:fixed;
	border:none;
	margin-right:16.9%;
	float:right;
}
	
#newsfeed_f
{
	width:103.0%;
	float:left;
	border:none;
	margin-left: 200px;
	margin-top: -200px;
}
	
#slideshowbackground
{
	background-color: black;
	width: 100%;
	position: fixed;
	z-index: 20;
	display: none;
}
	
#slideshowbackground button
{
	background-color: #4A338E;
	padding:6px 6px 6px 6px;
	color:white;
	width:100px;
	font-weight: bold;
	border:none;
}
</style>
<script type="text/javascript">
var month = <?php echo date('m'); ?>;
var day = <?php echo date('d'); ?>;
var year = <?php echo date('Y'); ?>;

function slideshow_show(wallpost)
{
	$("#slideshowbackground").fadeIn('fast');
	$("#slideshow").attr("src","slideshow_frame.php?wallid="+wallpost);

	$("#slideshow_close_btn").attr("onClick", "slideshow_close("+wallpost+");");
}
	
function slideshow_close(wallid)
{
	$("#slideshowbackground").fadeOut('fast');
	$("#slideshow").attr("src","");
	document.getElementById("newsfeed_f").contentWindow.update_post(wallid);
}

function show_wall(wall, id)
{
	document.getElementById("newsfeed_f").contentWindow.wallframe_show(wall);	
	$("#notification_bar").fadeOut();
	reset_alerts(id);
}

function delete_event(id)
{
	$.post("include/deleteEvent.php", {id: id}, function(){
		$("#eventtb"+id).fadeOut().remove();	
		
		$("#calender_panel").load("calender.php?month=" + month + "&day=" + day + "&year=" + year);
	});		
}

function add_event_toDB()
{
	var et = document.getElementById("eventtitle").value;
	var ed = document.getElementById("eventdate").value;
	var eta = document.getElementById("eventtimea").value;
	var etb = document.getElementById("eventtimeb").value;
	var etp = document.getElementById("eventtimec").value;
	
	if(!et =='' || !ed =='' || !eta =='' || !etb =='' || !etp =='')
	{
		$.post("include/calendar.inc.php", {add_event: "1", eventtitle: et, eventdate: ed, eventtimea: eta, eventtimeb: etb, eventtimec: etp}, function(result){
			//currentdate();
			event_tb_close();
			$("#calender_panel").load("calender.php?month=" + month + "&day=" + day + "&year=" + year);
		});
	}
}

function event_tb_show(m, d , y)
{
	var month_names = ["January","February","March","April","May","June","July","August","September","October","November","December"];
	
	$("#eventdate").html("<option value="+m+"/"+d+"/"+y+">"+month_names[m - 1]+" " +d+", "+y+"</option>");
	$("#add_event_tb").fadeIn();
	
	$.post("include/getEvents.php", {month: m, day: d, year: y}, function(html){
			$("#listevent").html(html);
		});
}

function event_tb_close()
{
	$("#eventtitle").val('');
	$("#eventdate").html();
	$("#eventtimea").val('');
	$("#eventtimeb").val('');
	$("#add_event_tb").fadeOut();
	$("#listevent").html('');	
}

function setcurrentdate(month1, day1, year1)
{
	month = month1;
	day = day1;
	year = year1;
	
	$("#calender_panel").load("calender.php");
}


function calender_goback()
{
	month -=1;
	
	if(month == 0)
	{
		month = 12;
		year -=1;
	}
	$("#calender_panel").load("calender.php?month=" + month + "&day=" + day + "&year=" + year);
}

function calender_goforward()
{
	month++;
	
	if(month == 13)
	{
		month = 1;
		year +=1;
	}
	
	//$("#calender_panel").attr("src","calender.php?month=" + month + "&day=" + day + "&year=" + year);
	$("#calender_panel").load("calender.php?month=" + month + "&day=" + day + "&year=" + year);
}

$(document).ready(function(e) {
	
	$("#slideshowbackground").height($(this).height());
	
	$("#slideshow").height($(this).height() - 100);
	
   // $("#calender_panel").attr("src","calender.php");
   $("#calender_panel").load("calender.php?month=" + month + "&day=" + day + "&year=" + year);
	
	$("#newsfeed_f").height($(this).height() - 100 - $("#postbody").height());
	
	$("#picture_btn").click(function() {
		mode = 0;
		$("#mfile").trigger('click');
		console.log("PICTURE");
	});
	
	$("#video_btn").click(function() {
		mode = 1;
		$("#mfile").trigger('click');
		console.log("VIDEO");
	});
	
	$("#mfile").change(function() {
		if($(this).val().length > 0)
		{
			if(mode == 0)
			{
				//showImagePost();	
				if($("#postinput").val().length == 0)
				{
					wallpost_caption_show();
				}
				else
				{
					addImagePost();
				}
			}
			
			if(mode == 1)
			{
				if($("#postinput").val().length == 0)
				{
					wallpost_caption_show();
				}
				else
				{
					VideoPostPreview();
				}	
			}	
		}
	});
	
	
});


//File Upload ---
function fileBrowser_open()
{
	$("#mfile").trigger('click');
}

function video_fileBrowser()
{
	
}

function cancelImagePreview()
{
	$("#mfile").val('');
	$("#back-screen").fadeOut();
	$("#postview_frame").fadeOut();
	$("#postview_frame").attr("src", "");
}

function VideoPostPreview()
{
	$("#back-screen").fadeIn();
	$("#videoview_panel").fadeIn();
	//$("#postview_frame").fadeIn();
	
	$("#upload_post_frm").attr("action", "include/postVideo.php");
	$("#upload_post_frm").attr("target", "postview_frame");
		
	$("#post_btn").trigger('click');	
}

function addImagePost()
{
	//$("#back-screen").fadeOut();
	//$("#postview_frame").fadeOut();
	
	$("#back-screen").fadeIn('fast', function(){
		$("#upload_post_frm").attr("action", "include/insert_main_post.php");
		$("#upload_post_frm").attr("target", "uploadframe");
		$("#imageview_panel").fadeIn();
		
		$("#post_btn").trigger('click');
	});
}

function showImagePost()
{
	$("#back-screen").fadeIn();
	$("#postview_frame").fadeIn();
	
	$("#upload_post_frm").attr("action", "include/postView.php");
	$("#upload_post_frm").attr("target", "postview_frame");
	$("#post_btn").trigger('click');
}

function closeImagePost()
{
	$("#back-screen").fadeOut();
	$("#imageview_panel").fadeOut();
	//$("#postview_frame").fadeOut();
	//$("#postview_frame").attr("src", "");	
}

function closeVideoPost()
{
	$("#back-screen").fadeOut();
	//$("#postview_frame").fadeOut();
	$("#videoview_panel").fadeOut();
	$("#postview_frame").attr("src", "");	
	window.frames["newsfeed_f"].loadNewMPost();	
	clear_fileinput();
}

function clear_fileinput()
{
	$("#mfile").val('');
	$("#postinput").val('');
	$("#post_btn").html("Post");
	$("#post_btn").prop("disabled", false);
}

function loadNewMPost()
{
	window.frames["newsfeed_f"].loadNewMPost();	
}

function postview_hide()
{
	
}

$(document).ready(function(e) {
setTimeout(function(){
	<?php
		if(isset($_GET['showwall']) && $_GET['showwall'] !="" && isset($_GET['id']) && $_GET['id'] !="")
		{
			?>
				slideshow_show("<?php echo base64_decode($_GET['showwall']); ?>").click();
			<?php
		}
	?>
} ,2000);
});

</script>                                        
<div id="calender_panel">

</div>

<?php include 'menu_btn.php';  ?>
<style type="text/css">
/* CSS Document */
#upload_post_frm{
}

#postbody{
	background-color:white;
	width:53%;
	float: left;
	border-bottom: 2px black solid;
	margin-left: 10px;
	padding-bottom:5px;
}

#post_insert_box{
	font-size: 12px;
	background-color: white;
}

#post_insert_box input{
	padding:4px 4px 4px 4px;
	height:40px;
	width:98%;
	border-radius:4px;
	border:1px solid black;
	font-size:12px;
	margin:auto;
}
	
#post_insert_box input[placeholder]
{
	font-weight: bold;	
}

#post_insert_box select
{
	float:right;
	margin-top: 7.8px;
	margin-right: 5px;
	padding:4px 4px 4px 4px;
}
	
#post_insert_box button{
background-color:#795FC5;
color:white;
border:none;
border-radius:2px;	
font-weight:bold;
padding:6px 6px 6px 6px;
}
</style>
<div id="postbody" align="center">
   	  <form id="upload_post_frm" action="include/insert_main_post.php" target="uploadframe" enctype="multipart/form-data" method="post">
      <iframe id="uploadframe" name="uploadframe" width="100%" style="display:none;">
                	
      </iframe>
            <div id="post_insert_box">
                    <input type="text" id="postinput" name="postinput" placeholder="Positive Thoughts" autocomplete="off"/>
                    <input type="file" name="mfile[]" id="mfile" style="display:none;" multiple/>
                    <div style="width:100%;" style="background-color:white;" align="center">
                        <button id="picture_btn" style="float:left; margin-top:8px;" formtarget="uploadframe">Add Picture</button>
                        <button id="video_btn" type="submit" name="" style="float:left; margin-left:5px; margin-top:8px;" onClick="">Add Video</button>
                        <button id="post_btn" type="button" name=""  onClick="submitdata();" style="float:right; margin-top:8px;">Post</button>
                        <input type="submit" id="submit1" name="submit1" style="display: none;">
                        <select id="level" name="level">
                        	<option value="0">
                        		Public
                        	</option>
                        	<option  value="1">
                        		Private
                        	</option>
                        </select>
                    </div>
            </div>
      </form>
</div>
	<iframe id="newsfeed_f" name="newsfeed_f" src="newsfeed.php" scrolling="yes">
		
	</iframe>
</div>

<div id="newsfeed_f_scroll"></div>
</body>
</html>