<?php 
	include 'post.inc.php';
	unlike_wall($_POST['Wallid']);
	
	//echo getTotalLikes($_POST['Wallid']);
	print getTotalEmojlies($_POST['Wallid']);
?>