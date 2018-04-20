<?php
session_start();
include 'config.php';
include 'include/core.inc.php';
include 'include/connections.core.inc.php';
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/style1.css"/>
<link rel="stylesheet" href="css/commentbox_style1.css" />
<!-- Include meta tag to ensure proper rendering and touch zooming -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Include jQuery Mobile stylesheets -->
<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">

<!-- Include the jQuery library -->
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Include the jQuery Mobile library -->
<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

<link rel="stylesheet" href="css/style1_m.css"/>
<?php include 'meta_header.php'; ?>
<title>SpiritLyft</title>
</head>
<body>
	<header>
         <?php include 'm_header.php'; ?>
    </header>
<style type="text/css">
	#mygift_bodytb{
		width:99%;
		border-left:1px black solid;
		border-bottom:1px black solid;
		border-right:1px black solid;
		text-align:center;
	}
	
	#mygift_bodytb img
	{
		border: 1px black solid;
	}
	
	#mygift_bodytb button{
		background-color:#4F3891;
		line-height:30px;
		width:100px;
		color:white;
		font-family:Helvetica;
		font-weight:bold;
		border-radius:6px;
	}
	
	#mygift_bodytb select{
		
	}
	
	#mygift_title{
		text-align:center;
		font-family:helvetica;
		font-size:20px;
		font-weight:bold;
		background-color:#BDB1E3;	
		width:99%;
		color:white;
		line-height:95px;
	}
	
	.mygift_data
	{
		font-family:helvetica;
	}
</style>

<script type="text/javascript">
$(document).ready(function(e) {
    mygift_show();
});

function mygift_show()
{
	$.post("include/gifts.inc.php", {mygift_show: 1}, function(html){
			$("#mygift_bodytb").html(html);
		});	
}

</script>
        <div id="body">
            <div id="mygift_title"><img src="image/vgift_icon.png" style="width: 80px; float:left; margin-top:5px; position:relative;" />My Gift</div>
            <table id="mygift_bodytb" cellpadding="4" cellspacing="0">
            	
            </table>
            
            <input type="hidden" id="giftid" value="" />
        </div>
        <?php include 'm_footer.php'; ?>
</body>
</html>