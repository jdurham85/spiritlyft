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
<link rel="stylesheet" href="css/calender_homepage_style1.css" />
<!-- Include meta tag to ensure proper rendering and touch zooming -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Include jQuery Mobile stylesheets -->
<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">

<!-- Include the jQuery library -->
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Include the jQuery Mobile library -->
<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<title>SpiritLyft</title>
</head> 
<div id="back-screen" style="width:100%; height:900px; position:relative; z-index:4; display:none; background-color:#4A338E; opacity:0.9;" align="center">
    <iframe id="postview_frame" name="postview_frame" style="width:98%; border:none; border-radius:4px; z-index:8; display:none; background-color:white; position:sticky; height:700px;" align="middle">
            
    </iframe>
    <div id="videoview_panel" align="center" style="color:white; display:none; font-family:Arial Black; font-size:40px;">
    	Adding Video Please wait...
    </div>
</div>

<div id="wallback-screen" style="width:100%; position:relative; display:none; z-index:4; background-color:#4A338E;" align="center">
    <div id="emotionview_panel" align="center" style="width:100%; font-family:Arial; background-color:white; font-size:12px;">
    	
    </div>
</div>
<script src="js/post.inc.js" type="text/javascript"></script>
<body onLoad="">
<?php include 'app_header.php';?>
<style>
#calender_panel{
	float:right;
	width:25%;	
	position:absolute;
	right: 0;
	height:400px;
	border:none;
}
	
#newsfeed_f
{
	width:100%;
	border:none;
}
	
#sidemenu{
	float:left;
	list-style:none;
	font-family:Arial;
	width:200px;
	border:1px black solid;
	padding:4px 4px 4px 4px;
	border-radius:4px;
}

#sidemenu div{
	margin:3px 0px 0px 0px;	
}

#sidemenu button{
	font-size:12px;
	text-decoration:none;
	font-weight:none;
	border:1px black soild;
	border-radius:4px;
	border-width:1px;
	width:100%;
	background-color:white;
}
</style>
<script type="text/javascript">
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

var month = <?php echo date('m'); ?>;
var day = <?php echo date('d'); ?>;
var year = <?php echo date('Y'); ?>;

function show_wall(wall, id)
{
	window.frames["newsfeed_f"].wallframe_show(wall);	
	$("#notification_bar").slideToggle();
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
			currentdate();
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
	month +=1;
	
	if(month == 13)
	{
		month = 1;
		year +=1;
	}
	
	//$("#calender_panel").attr("src","calender.php?month=" + month + "&day=" + day + "&year=" + year);
	$("#calender_panel").load("calender.php?month=" + month + "&day=" + day + "&year=" + year);
}

$(document).ready(function(e) {
	var mode = 0;
	
   // $("#calender_panel").attr("src","calender.php");
   //$("#calender_panel").load("calender.php?month=" + month + "&day=" + day + "&year=" + year);
	
	$("#newsfeed_f").height($(window).height() - 80 - $("#postbody").height());
	
	$("#picture_btn").click(function() {
		mode = 0;
		$("#mfile").trigger('click');
	});
	
	$("#video_btn").click(function() {
		mode = 1;
		$("#mfile").trigger('click');
	});
	
	$("#mfile").change(function() {
		if($(this).val().length > 0)
		{
			if(mode == 0)
			{
				showImagePost();	
			}
			
			if(mode == 1)
			{
				 VideoPostPreview();	
			}	
		}
	});
	
	
});


//File Upload ---
function fileBrowser_open()
{
	$("#mfile").trigger('click');
	//alert('Lord Jesus');
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
	$("#body").show();
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
	$("#back-screen").fadeOut();
	$("#postview_frame").fadeOut();
	
	$("#upload_post_frm").attr("action", "include/insert_main_post.php");
	$("#upload_post_frm").attr("target", "uploadframe");
	
	$("#post_btn").trigger('click');	
}

function showImagePost()
{
	$("#back-screen").fadeIn();
	
	$("#body").hide();
	
	$("#postview_frame").fadeIn();
	
	$("#upload_post_frm").attr("action", "include/postView.php");
	$("#upload_post_frm").attr("target", "postview_frame");
	$("#post_btn").trigger('click');
}

function closeImagePost()
{
	$("#back-screen").fadeIn();
	$("#back-screen").fadeOut();
	$("#postview_frame").fadeOut();
	$("#postview_frame").attr("src", "");	
}

function closeVideoPost()
{
	$("#back-screen").fadeOut();
	//$("#postview_frame").fadeOut();
	$("#videoview_panel").fadeOut();
	$("#postview_frame").attr("src", "");	
	window.frames["newsfeed_f"].loadNewMPost();	
}

function clear_fileinput()
{
	$("#mfile").val('');
	$("#postinput").val('');
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
				$("#showwall<?php echo base64_decode($_GET['showwall']); ?>").click();
			<?php
		}
	?>
} ,2000);
});

</script>                
<?php 
	if(isset($_GET['showwall']) && $_GET['showwall'] !="" && isset($_GET['id']) && $_GET['id'] !="")
	{
		?>
		<input type="hidden" id="showwall<?php echo base64_decode($_GET['showwall']); ?>" onClick="<?php echo "show_wall(".base64_decode($_GET['showwall']).", ".base64_decode($_GET['id']).");" ?>" />
		<?php
	}
?>   
<style type="text/css">
/* CSS Document */
#upload_post_frm{
}

#postbody{
	background-color:white;
	width:100%;
}

#post_insert_box{
	font-size: 12px;
	background-color: white;
	padding-top:25px;
}

#post_insert_box input{
	padding:4px 4px 4px 4px;
	height:20px;
	width:100%;
	border-radius:4px;
	border:1px solid black;
	font-size:12px;
	margin:auto;
}

#post_insert_box button{
background-color:#795FC5;
color:white;
border:none;
border-radius:6px;	
font-weight:bold;
padding:4px 4px 4px 4px;
}
</style>
<iframe id="newsfeed_f" name="newsfeed_f" src="m_newsfeed.php"></iframe>
</div>
<?php include 'm_footer.php'; ?>
</body>
</html>