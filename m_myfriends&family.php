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

.connection_style
{
	border:1px black solid;
	border-radius:4px;
	width:99%;
	background-color:white;
}

.connection_style_info
{
	width:80%;	
}

.connection_style_info button
{
	font-size: 14px;
	color: white;
	background-color: #4A338E;
	font-weight: bold;
	border:none;
	line-height: 30px;
}


</style>
<div id="body">
<div id="profile_body">

<script type="text/javascript">
$(document).ready(function() {
	
	$("#loading_screen").height($(this).height());
	$.post("include/member_myconnections.php", function(mc){
		$("#gallery_body").html(mc);
	});
});

            </script>
            	
                <div style="display:none;">
                	<form action="include/profile.inc.php" id="galleryfrm" target="profile_iframe" enctype="multipart/form-data" method="post">
                    	<input type="file" id="galleryfile" name="galleryfile" />
                        <input type="submit" id="submitg_btn" />
                    </form>
                    
                    <iframe id="profile_iframe" name="profile_iframe" style="width: 100%;"></iframe>
                </div>
                
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
                    
                    <div id="gallery_body">
                    	
                    </div>
                </div>
                <div id="profile_footer">
                
                	
                </div>
            </div>
        </div>
<?php include 'm_footer.php'; ?>
</body>
</html>