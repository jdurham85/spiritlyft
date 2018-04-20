<?php 
session_start();
include 'config.php';
include 'include/core.inc.php';
?>
<meta charset="utf-8">
<link rel="stylesheet" href="css/style1.css"/>
<link rel="stylesheet" href="css/commentbox_style1.css" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Include jQuery Mobile stylesheets -->
<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">

<!-- Include the jQuery library -->
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Include the jQuery Mobile library -->
<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

<script src="js/post.inc.js"></script>

<div id="wallback-screen" style="width:100%; position:relative; display:none; z-index:4; background-color:#4A338E;" align="center">
    <div id="emotionview_panel" align="center" style="width:100%; font-family:Arial; background-color:white; font-size:12px;">
    	
    </div>
</div>

<div id="loading_screen" style="width:100%; display:none; position:absolute; z-index:1; background-color:#4A338E; opacity:0.9;" style="">
	<div align="center">
    	<img src="image/loading_img.gif" width="15%" />
    </div>
    <div align="center" style="font-family:Arial; font-weight:bold; font-size:45px; color:white;">
    	Adding Post....
    </div>
</div>

<script>
$(document).ready(function(){
	$("#wallpost_caption_backwall").height($(this).height());
});

//////////////////////////////////////////
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
//////////////////////////////////////////

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
	width: 99%;
	position: fixed;
	border-radius: 10px;
	background-color: white;
	font-family: Arial;
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

<div id="comment_bg">
	<div id="wall_frame">
    
    </div>
</div>
<style type="text/css">
/* #E9E5F5; */
.post_panel{
/*background-color: #E9E5F5;*/
background-color:white;
width:100%;
display:table;
font-family:arial;
margin-bottom:20px;
font-family:Helvetica;
border-radius: 6px;
}

#post_panelsub{
width:100%;
}

#post_header .ph1{
padding:6px 8px 8px 8px;
}
	
#post_header .ph2{
padding:6px 8px 0px 0px;
}

.ph2 button
{
background-color: #795FC5;
color:white;
border:none;
border-radius:2px;	
font-weight:bold;
padding:6px 6px 6px 6px;	
float:right;
}
	
.upper_header
{	
	width:100%;
	padding: 6px 0px 6px 0px;
	font-size: 10px;
	text-align: center;
	background-color:white;
}

.post_header td button{
background-color: #795FC5;
color:white;
border:none;
border-radius:2px;	
font-weight:bold;
padding:6px 6px 6px 6px;	
float:right;
}

#post_body{
text-align:center;
width:100%;
margin-top:40px;
margin-bottom: 20px;
background-color:white;
}

#post_textview{
margin-top:10px;
font-family:Helvetica;
text-align: center;
}

#post_footer{
	text-align:left;
}

.upper_footer
{
	border-bottom:1px black solid;
	padding:5px 0px 5px 0px;
}

.upper_footer button
{
	background-color: #795FC5;
	color:white;
	border:none;
	border-radius:2px;	
	font-weight:bold;
	padding:6px 6px 6px 6px;
}
	

.middle_footer td
{
	
	padding:5px 0px 5px 0px;
	/*background-color: #E0DAF0;*/
	background-color:white;
}
.middle_footer button
{
	background-color: #795FC5;
	color:white;
	border:none;
	border-radius:2px;	
	font-weight:bold;
	padding:6px 6px 6px 6px;
}

.lower_footer td
{
	/*background-color: #E9E5F5;*/
	background-color:white;
}

.post_footer a{
	text-decoration:none;
	font-family: Arial;
	font-size:10px;
	font-weight:bold;
}

.post_footer button{
	background-color:#795FC5;
	color:white;
	border:none;
	border-radius:2px;	
	font-weight:bold;
	padding:6px 6px 6px 6px;
	text-align:left;	
}
.share_wall_panel
{
	background-color: #E9E5F5;	
	width: 100px;
	position: absolute;
	z-index: 5;
	right: 0;
	border-radius: 4px;
	margin-right: 27px;
	display: none;
}
	
.share_wall_panel_btn
{
	font-family: arial;
	font-size: 12px;
	font-weight: bold;
	padding:15px 0px 15px 10px;
	width: 100%;
	background-color: white;
	cursor: pointer;
}
	
.share_wall_panel_btn:hover
{
	font-family: arial;
	font-size: 12px;
	font-weight: bold;
	padding:15px 0px 15px 10px;
	width: 100%;
	background-color: #4A338E;
	cursor: pointer;
	color:white;
}
	

.wallcomment_header
{
	/*background-color: #E9E5F5;*/
	background-color:white;
	font-size:12px;
	padding:6px 0px 12px 0px;
}
	
.wallcomment_header button
{
	background-color:#795FC5;
	color:white;
	border:none;
	border-radius:2px;	
	font-weight:bold;
	padding:6px 6px 6px 6px;	
}

.wallcomment_inputbox
{
	padding:6px 0px 6px 0px;
	width:100%;
	/*background-color: #E9E5F5;*/
	background-color:white;
}

.wallcomment_inputbox input
{
	padding:6px 0px 6px 0px;
	width:92%;
	float:right;
}

.wallcomment_inner_element
{
	margin-left:10px; 
	padding:0px 0px 12px 0px; 
	float:right; 
	width:100%;
}
	
wallcomment_sub button
{
	padding: 2px 2px 2px 2px;	
}
	
.post_middle_footer
{
	line-height:40px;
	/*background-color:white;*/
	background-color:white;
}

.wallcomment_sub_inputbox
{
	display:none;
	background-color:white;
}
	
.emojli_container
{
	background-color:white;
	border-radius:8px;
	font-family:Arial;
	font-weight:bold;
	font-size:10px;
	position:relative;
	width:100%;
	display:none;
}

.emojli_container td:hover
{
	background-color:#4A338E;
	color:white;
	border-radius:8px;
	font-family:Arial Black;
	font-weight:bold;
	font-size:10px;
	cursor:pointer;
}

.post_fullscreenbtn
{
	display: none;
}

.wallcomment_emojli_container
{
	border-radius: 8px;
	border: 1px black solid;
	display: none;
}


.wallcomment_emojli_container td:hover
{
	background-color:#4A338E;
	color:white;
	border-radius:8px;
	font-family:Arial Black;
	font-weight:bold;
	font-size:10px;
	cursor:pointer;
}
</style>
<script src="js/post.inc.js" type="text/javascript"></script>
<script type="text/javascript">
	
function wallframe_close()
{
	$("#comment_bg").fadeOut();
	$("#wall_frame").html("");
	$(".post_panel").show();
}

function test(){alert('Thank you Lord Jesus GOD');}

function wallframe_show(wall)
{
	$("#wall_frame").load("include/WallView.php?wallid="+wall);
	//$("#wall_frame").fadeIn();
	$("#comment_bg").show();
	$(".post_panel").hide();
}


function fileBrowser_open()
{
	$("#mfile").trigger('click');
}

function clear_fileinput()
{
	window.parent.clear_fileinput()
	loading_scr_hide();	
	$("#postinput").val('');
	$("#mfile").val('');
	$("#post_btn").html("Post");
	$("#post_btn").prop("disabled", false);
}

function errorMessage(message)
{
	alert(message);
	loading_scr_hide();	
}

function loading_scr_show()
{
	$("#loading_screen").show();	
}

function loading_scr_hide()
{
	$("#loading_screen").hide();	
}

	
function frmSubmit()
{
	$("#upload_post_frm").submit();
}

function addImagePost()
{
	//$("#back-screen").fadeOut();
	//$("#postview_frame").fadeOut();
	
	$("#loading_screen").fadeIn('fast', function(){
		$("#upload_post_frm").attr("action", "include/insert_main_post.php");
		$("#upload_post_frm").attr("target", "uploadframe");
		//$("#imageview_panel").fadeIn();
		
		$("#post_btn").trigger('click');
	});
}

function closeImagePost()
{
	$("#loading_screen").fadeOut();
	//$("#imageview_panel").fadeOut();
	//$("#postview_frame").fadeOut();
	//$("#postview_frame").attr("src", "");	
}
	
var t;
var mode = 0;	
function picture_btn_click()
{
	mode = 0;
	$("#mfile").click();
}
	


$("#comment_bg").height($(window).height());
$("#loading_screen").height($(window).height());
	
$(document).ready(function(){

loadmyPost(0, 0);
	
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

var t;
var page_track = 0;
var wall_old_post = [];

$(document).ready(function(){

	$(this).scroll(function() {
		if($(this).scrollTop() == 0)
		{
			//loadPost(0, 0);
			//t = setTimeout(function(){
				//page_track++;
				//$(".post_panel").each(function(index){
					//wall_old_post.push($(this).attr('id').substr(10));
					//console.log($(this).attr('id').substr(10));
				//});

				/*$.post("include/loadPost.php",{page: page_track} ,function(post){
					if(!post == "")
					{
						$("#post_panelsub1").before(post);
						
					}
					else
					{
						p*age_track--;
					}
				});

				wall_old_post = [];

				console.log(page_track);*/



				//loadNewestPost();
			//}, 2000);
		}
		else
		{
			//clearTimeout(t);
		}
	});
});
</script>
<iframe id="uploadframe" name="uploadframe" width="100%" style="display: none;">

</iframe>
<div id="postbody" align="center">
	  <form id="upload_post_frm" action="include/insert_main_post.php" target="uploadframe" enctype="multipart/form-data" method="post" style="display: none;">
			<div id="post_insert_box">
					<input type="text" id="postinput" name="postinput" style="line-height: 50px;" placeholder="Positive Thoughts"  autocomplete="off"/>
					<input type="file" name="mfile[]" id="mfile" style="display: none;" accept="image/*"  multiple/>
					<table style="width:100%;">
						<tr>
							<td>
								<button id="picture_btn" onClick="picture_btn_click();">Add Picture</button>
							</td>

							<td>
								<select id="level" name="level">
									<option value="0">
										Public
									</option>
									<option  value="1">
										Private
									</option>
								</select>
							</td>

							<td>
								<button id="post_btn" type="button" name=""  onClick="submitdata();">Post</button>
								<button type="submit" id="submit1" name="submit1" style="display: none;" ></button>
							</td>
						</tr>
					</table>
			</div>
	  </form>
</div>

<div id="post_panelsub">

</div>

<style type="text/css">
#comment_bg{
	width:100%;
	height:600px;
	text-align:center;
	background-color:#4A338E;
	position:relative;
	z-index:4;
	display:none;
}

#wall_frame
{
	width:100%;
	background-color:#E9E5F5;
	border-radius:8px;
	color:black;
}
#wall_frame_btn
{
	width:100%;
	background-color:#4A338E;
	border-radius:8px;
	color:white;
	float: right;
	font-weight: bold;
}
</style>