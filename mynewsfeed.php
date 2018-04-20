<?php 
session_start();
include 'config.php';
include 'include/core.inc.php';

?>
<meta charset="utf-8">
<link rel="stylesheet" href="css/style1.css"/>
<link rel="stylesheet" href="css/commentbox_style1.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/post.inc.js"></script>
<script>
loadmyPost(0, 0);

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

<style type="text/css">
body{
	width: 480px;
	float: left;
}
</style>
<div id="loading_screen" style="width:100%; display:none; position:absolute; z-index:1; background-color:#4A338E; opacity:0.9;" style="">
	<div align="center">
    	<img src="image/loading_img.gif" width="15%" />
    </div>
    <div align="center" style="font-family:Arial; font-weight:bold; font-size:45px; color:white;">
    	Updating Post
    </div>
</div>

<div id="comment_bg">
	<div id="wall_frame">
    
    </div>
</div>
<iframe id="uploadframe" name="uploadframe" width="100%" style="display: none;">

</iframe>

<div id="post_panelsub">

</div>
