<?php
	include 'post.inc.php';
	include 'config.php';
	like_wall($_POST['Wallid'], $_POST['emojli']);
	
	//echo getTotalLikes($_POST['Wallid']);
	print getTotalEmojlies($_POST['Wallid']);
	
	$ParentID = getParentID($_POST['Wallid']);
	
	if($_SESSION['SessionMemberID'] != $ParentID)
	{
		//checking to see if member is offine.
		if(!check_if_member_active($memberid) == 1)
		{
			
			//include 'mail.inc.php';
			
			//sendPost_mail($ParentID, $_SESSION['SessionMemberID'], $_POST['Wallid'], $ParentID);
		}
			$sql = mysqli_query($db_con, "INSERT INTO `member_notification`(`id`, `Wallid`, `toMember`, `fromMember`, `Mode`, `vStatus`) VALUES (NULL, '".$_POST['Wallid']."', '$ParentID', '".$_SESSION['SessionMemberID']."',6,1)");
	}

?>