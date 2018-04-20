<?php 
include 'include/post.inc.php';
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/style1.css"/>
<link rel="stylesheet" href="css/commentbox_style1.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<title>SpiritLyft</title>
</head> 
<body style="background-color: black;">
<script src="js/post.inc.js"></script>
<script>
$(document).ready(function(){
	$("#slideshow_border").height($(this).height());

	$("#post_fullscreenbtn<?php echo $_GET['wallid']; ?>").remove();
});
</script>
<div id="slideshowbackground" align="center">
	<div id="slideshow" style="width: 58%; background-color: white; float: left;">
<?php 
		include 'config.php';	
		$sql = mysqli_query($db_con, "select * from wall where Wallid = '".$_GET['wallid']."'") or die(mysqli_error($db_con));
		while($w = mysqli_fetch_array($sql))
		{
			$memberid = $w['Memberid'];
			$wallid = $w['Wallid'];
			$parentid = $w['Parentid'];
			$description = $w['Description'];
			$filetype = $w['Filetype'];
			$filename = $w['Filename'];
			$postedon = $w['PostedOn'];
			$mode = $w['Mode'];

			?>
			<table class="post_panel" id="post_panel<?php echo $wallid; ?>">
				<?php 
					echo getWallHeader($memberid, $wallid, $parentid, $postedon); 
					echo getWallBody($memberid, $wallid, $description, $parentid, $filetype, $filename); 
					//echo getWallFooter($parentid, $memberid, $wallid, $mode); 
				?>
			</table>
			<?php
		}
?>
	</div>
	<div id="slideshow_border" style="float: left; background-color: black; width: 2%; height: 500px;"></div>
	<div id="slideshowpost" style="width: 40%; float:left;">
<?php 
	$sql = mysqli_query($db_con, "select * from wall where Wallid = '".$_GET['wallid']."'") or die(mysqli_error($db_con));
		while($w = mysqli_fetch_array($sql))
		{
			$memberid = $w['Memberid'];
			$wallid = $w['Wallid'];
			$parentid = $w['Parentid'];
			$description = $w['Description'];
			$filetype = $w['Filetype'];
			$filename = $w['Filename'];
			$postedon = $w['PostedOn'];
			$mode = $w['Mode'];

			?>
			<table class="post_panel" id="post_panel<?php echo $wallid; ?>">
				<?php 
					//echo getWallHeader($memberid, $wallid, $parentid, $postedon); 
					//echo getWallBody($memberid, $wallid, $description, $parentid, $filetype, $filename); 
					echo getWallFooter($parentid, $memberid, $wallid, $mode); 
				?>
			</table>
			<?php
		}	
?>
	</div>
</div>
</body>
</html>