<?php 
	session_start();
	include 'config.php';
	
	//Delete Chat
	$sql = mysqli_query($db_con, "delete from chat_tbl where toMemberid = '".$_SESSION['SessionMemberID']."'");
	$sql = mysqli_query($db_con, "delete from chat_tbl where fromMemberid = '".$_SESSION['SessionMemberID']."'");
	
	//Wall, Wall Comment, Wall Like, Wall Hide, Post Following
	$sql = mysqli_query($db_con, "delete from wall where Parentid = '".$_SESSION['SessionMemberID']."'");
	$sql = mysqli_query($db_con, "delete from wall_comment where Memberid = '".$_SESSION['SessionMemberID']."'");
	$sql = mysqli_query($db_con, "delete from wall_like where Memberid = '".$_SESSION['SessionMemberID']."'");
	$sql = mysqli_query($db_con, "delete from wall_hide where Memberid = '".$_SESSION['SessionMemberID']."'");
	$sql = mysqli_query($db_con, "delete from member_post_following where toMember = '".$_SESSION['SessionMemberID']."'");
	$sql = mysqli_query($db_con, "delete from member_post_following where fromMember = '".$_SESSION['SessionMemberID']."'");
	
	
	//Gallery
	$sql = mysqli_query($db_con, "delete from member_gallery where Memberid = '".$_SESSION['SessionMemberID']."'");
	
	//Files
	unlink("profile/videos/".$_SESSION['SessionMemberID']);
	unlink("profile/tmp/".$_SESSION['SessionMemberID']);
	unlink("profile/mygallery/".$_SESSION['SessionMemberID']);
	unlink("profile/images/".$_SESSION['SessionMemberID']);
	
	//Member
	$sql = mysqli_query($db_con, "delete from member where Memberid = '".$_SESSION['SessionMemberID']."'");
	
	//Notification
	$sql = mysqli_query($db_con, "delete from member_notification where toMember = '".$_SESSION['SessionMemberID']."'");
	
	//Member Online
	$sql = mysqli_query($db_con, "delete from member_online where Memberid = '".$_SESSION['SessionMemberID']."'");
	
	//Member Profile
	$sql = mysqli_query($db_con, "delete from member_profile where Memberid = '".$_SESSION['SessionMemberID']."'");
	
	//Connection
	$sql = mysqli_query($db_con, "delete from member_connection where toMemberid = '".$_SESSION['SessionMemberID']."'");
	$sql = mysqli_query($db_con, "delete from member_connection where fromMemberid = '".$_SESSION['SessionMemberID']."'");
	
	//Calender
	$sql = mysqli_query($db_con, "delete from member_calendar where Memberid = '".$_SESSION['SessionMemberID']."'");
	
	//Credit
	$sql = mysqli_query($db_con, "delete from member_credit where Memberid = '".$_SESSION['SessionMemberID']."'");
	
	//Mycart
	$sql = mysqli_query($db_con, "delete from mycart where memberid = '".$_SESSION['SessionMemberID']."'");
	
	echo "Please Wait while deleting your account....";
?>
<script>
	window.location = "logout.php";
</script>