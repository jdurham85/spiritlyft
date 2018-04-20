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
header('Location: m_myprofile.php'); 
exit();
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/style1.css"/>
<link rel="stylesheet" href="css/commentbox_style1.css" />
<script src="js/post.inc.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php include 'meta_header.php'; ?>
<title>SpiritLyft</title>

</head>
<body>
<header>
    <?php include 'title.php'; ?>
</header>
    
<script type="text/javascript">
setInterval(getMemberOnline, 10000);

getMemberOnline();

function getMemberOnline()
{
	$.post("include/member_online.php", {mo: 1}, function(mo){
		$("#online_panel").html(mo);
	
	});
}
	
function setMainProfilePicture(picid)
{
	if(confirm("Are you sure ?"))
	{
		$.post("include/setMainProfilePicture.php", {picid: picid}, function(){
			window.location = window.location;
		});
	}
}

function delete_gallery(imgid)
{
	if(confirm("Are you sure you want to delete your photo?"))
	{
		$.post("include/delete_gallery.php", {imgid: imgid}, function(){
			window.location = window.location;
		});
	}
}
</script>
<script>
$(document).ready(function(){
	$("#wallpost_caption_backwall").height($(this).height());
	$("#newsfeed_f").height($(this).height() - 100);
	//$("#newsfeed_f").height($("#postbody").height());

	
});

<?php 
if($_SESSION['SessionMemberID'] == 1)
{
?>
$(document).ready(function(){
	var mode = 0;
	
	$("#slideshowbackground").height($(this).height());
	
	$("#slideshow").height($(this).height() - 100);
	
	$("#newsfeed_f").height($(this).height() - 100 - $("#postbody").height());
	
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
				 VideoPostPreview();	
			}	
		}
	});	
});

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
	
<?php
}
?>

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
	addImagePost();
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
	addImagePost();
	wallpost_caption_close();
	//$("#")
}

function wallpost_post()
{
	$(".wall_post_main_option").fadeOut('fast', function(){
		$(".wall_option_tb").fadeIn();
	});
}

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
<div id="wallback-screen" style="width:100%; position:relative; display:none; z-index:4; background-color:#4A338E;" align="center">
    <div id="emotionview_panel" align="center" style="width:25%; font-family:Arial; background-color:white; font-size:12px;">
    	
    </div>
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
        <?php include 'menu_btn.php';  ?>
            <div id="profile_body">
<style>
#upload_post_frm{
	text-align: center;
	display: none;
}

#postbody{
	background-color:white;
	width:74%;
	border-bottom: 2px black solid;
	padding-bottom:5px;
	text-align: center;
}

#post_insert_box{
	font-size: 12px;
	background-color: white;
}

#post_insert_box input{
	padding:4px 4px 4px 4px;
	height:60px;
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

#newsfeed_f
{
	width:82%;
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
$(document).ready(function(){
	$("#newsfeed_f").height($(this).height() - 400)
});

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

</script>
            	
                <div>
                	<form action="include/profile.inc.php" id="galleryfrm" target="profile_iframe" enctype="multipart/form-data" method="post">
                    	<input style="display:none;" type="file" id="galleryfile" name="galleryfile" />
                        <input style="display:none;" type="submit" id="submitg_btn" />
                    </form>
                    
                    <iframe style="display:none;" id="profile_iframe" name="profile_iframe"></iframe>
                </div>
                
                <div id="profile_header">
                	<table align="center" style="margin-top: 12px; width: 85%;">
                		<tr>
                			<td align="center" width="20%">
                				<img src="<?php echo MemberMainProfilePic($_SESSION['SessionMemberID']); ?>" width="80%" style="text-align: center;" />
                			</td>
                			<td align="left" width="80%" id="userfullname_textview">
                				<?php echo MemberFullName($_SESSION['SessionMemberID']); ?>
                			</td>
                		</tr>
                	</table>
                </div>
                <div id="profile_inner_body">
                	<div id="profile_menu">
                            <a target="_self" href="myprofile.php">My Profile</a>
                            <a target="_self" href="mygallery.php">My Gallery</a>
                            <a target="_self" href="myfriends&family.php">My Friends & Family</a>
                        </div>
                    
                    <div id="gallery_body" align="center">
                    	<div id="postbody" align="center">
					   	  <form id="upload_post_frm" action="include/insert_main_post.php" target="uploadframe" enctype="multipart/form-data" method="post">
					      <iframe id="uploadframe" name="uploadframe" width="100%" style="display:none;">
					                	
					      </iframe>
					            <div id="post_insert_box">
					                    <input type="text" id="postinput" name="postinput" placeholder="Positive Thoughts" autocomplete="off"/>
					                    <input type="file" name="mfile[]" id="mfile" style="display:none;" multiple/>
					                    <div style="width:100%;" style="background-color:white;" align="center">
					                        <button id="picture_btn" style="float:left; margin-top:8px;" formtarget="uploadframe">Add Picture</button>
					                        <button id="video_btn" type="submit" name="" style="float:left; margin-left:5px; margin-top:8px;" onClick="">Add Video (MP4 Format Only)</button>
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
	<iframe id="newsfeed_f" name="newsfeed_f" frameborder="0" src="mynewsfeed.php" scrolling="yes">
		
	</iframe>
                    </div>
                </div>
                <div id="profile_footer">
                
                	
                </div>
            </div>
        </div>
</body>
</html>