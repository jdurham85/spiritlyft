<?php 
include 'post.inc.php';
include 'config.php';
echo InsertWallComment_sub($_POST['Wallid'], $_POST['WallCommentid'],  addslashes($_POST['Description']));

$ParentID = getWallComment_ParentID($_POST['WallCommentid']);
	
if($ParentID != $_SESSION['SessionMemberID'])
{
	$sql = mysqli_query($db_con, "INSERT INTO `member_notification`(`id`, `Wallid`, `toMember`, `fromMember`, `Mode`, `vStatus`) VALUES (NULL, '".$_POST['Wallid']."', '$ParentID', '".$_SESSION['SessionMemberID']."',2,1)");

	foreach (getWallCommentsub_getMemberID($_POST['WallCommentid']) as $key => $value) {
		if($value != $_SESSION['SessionMemberID'] && $value != $ParentID)
		{
			$sql = mysqli_query($db_con, "INSERT INTO `member_notification`(`id`, `Wallid`, `toMember`, `fromMember`, `Mode`, `vStatus`) VALUES (NULL, '".$_POST['Wallid']."', '$value', '".$_SESSION['SessionMemberID']."',2,1)");
		}
	}
}
else
{
	foreach (getWallCommentsub_getMemberID($_POST['WallCommentid']) as $key => $value) {
		if($value != $ParentID)
		{
			$sql = mysqli_query($db_con, "INSERT INTO `member_notification`(`id`, `Wallid`, `toMember`, `fromMember`, `Mode`, `vStatus`) VALUES (NULL, '".$_POST['Wallid']."', '$value', '$ParentID', 2,1)");
		}
	}
}
echo getMWallcomment_sub($_POST['WallCommentid']);
?>