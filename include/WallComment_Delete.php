<?php 
	include 'post.inc.php';
	$wallcomment_id = $_POST['id'];
	echo WallComment_Delete($wallcomment_id);
?>