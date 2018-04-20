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
<link rel="stylesheet" href="css/commentbox_style1.css" />
<!-- Include meta tag to ensure proper rendering and touch zooming -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Include jQuery Mobile stylesheets -->
<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">

<!-- Include the jQuery library -->
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Include the jQuery Mobile library -->
<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

</head>
<body>
<div id="wallback-screen" style="width:100%; position:relative; display:none; z-index:4; background-color:#4A338E;" align="center">
    <div id="emotionview_panel" align="center" style="width:100%; font-family:Arial; background-color:white; font-size:12px;">
    	
    </div>
</div>

<div id="loading_screen" style="width:100%; display:none; position:absolute; z-index:1; background-color:#4A338E; opacity:0.9;" style="">
	<div align="center">
    	<img src="image/loading_img.gif" width="15%" />
    </div>
    <div align="center" style="font-family:Arial; font-weight:bold; font-size:45px; color:white;">
    	Adding Picture....
    </div>
</div>
<header>
	<?php include 'm_header.php'; ?>
</header>
<style>
#profile_body{
background-color:#E4E4E4;
font-family:Arial;
color:white;
float:left;
border-left:1px black solid;
border-bottom:1px black solid;
border-right:1px black solid;
width: 100%;
}

#profile_header
{
background-color:#4A338E;
width:100%;
font-weight:bold; 
padding:2px 2px 2px 2px;
}

#userfullname_textview{
font-size:25px;
text-align:center;
}

#profile_menu a{
text-decoration: none;
z-index: -1;
}

#profile_menu{
padding:8px 8px 8px 8px;
text-align: center;
}

#profile_menu button{
padding:8px 8px 8px 8px;
text-decoration:none;
font-weight:bold;
color:white;
margin:auto;
background-color:#4A338E;
border:none;
}

.profile_title{
color:black;
font-family:arial;
font-weight:bold;	
padding:8px 8px 8px 8px;
}

#gallery_body{
width:100%;	
}

#picstatus button{
padding:6px 6px 6px 6px;
font-weight:bold;
border-radius:6px;	
border:none;
}

#newsfeed_f
{
	width: 99%;
}
</style>
<div id="body">
<div id="profile_body">

<script type="text/javascript">
$(document).ready(function(){
	$("#newsfeed_f").height($(this).height() - 100);
});

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
</script>
                
                <div id="profile_header">
                	<div id="userfullname_textview"><?php echo MemberFullName($_SESSION['SessionMemberID']); ?></div>
                </div>
                <div id="profile_inner_body">
                	<table id="profile_menu" align="center">
                    	<tr>
                    		<td>
                    			<a target="_self" href="m_myprofile.php"><button style="cursor: pointer;">My Profile</button></a>	
                    		</td>
                    		<td>
								<a target="_self" href="m_mygallery.php"><button style="cursor: pointer;">My Gallery</button></a>
                    		</td>
                            <td>
                                <a target="_self" href="m_myfriends&family.php"><button style="cursor: pointer;">My Family & Friends</button></a>
                            </td>
                    	</tr>
                    </table>
                </div>
                <div id="profile_footer">
                	<iframe id="newsfeed_f" name="newsfeed_f" frameborder="0" src="m_mynewsfeed.php"></iframe>
                </div>
            </div>
        </div>
<?php include 'm_footer.php'; ?>
</body>
</html>