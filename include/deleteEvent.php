<?php
	session_start();
	include 'config.php';
	
	$mainmember = $_SESSION['SessionMemberID'];
	$id = $_POST['id'];
	
	$sql = mysqli_query($db_con, "delete from member_calendar where id = '$id'");
?>