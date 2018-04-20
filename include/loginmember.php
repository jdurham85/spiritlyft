<?php
session_start();
include "../config.php";

$email = trim($_POST['email1']);
$password = md5(trim($_POST['password1']));
//checking to see if user exist
$check_user = mysqli_query($db_con, "select * from member where Email = '$email' && Password = '$password'") or die(mysqli_error($db_con));
$result = mysqli_num_rows($check_user);
while($d = mysqli_fetch_array($check_user))
{
	$_SESSION['SessionMemberID'] = $d['Memberid'];
	$_SESSION['SessionMemberPassword'] = $password;	
}

if($result == 1)
{
	$member_online = mysqli_query($db_con, "INSERT INTO `member_online`(`MemberId`, `LoggedOn`, `ActiveTill`, `Idle`, `Visible`) VALUES ('".$_SESSION['SessionMemberID']."','0','0','0','Y')");
	
	
	setcookie("MemberID", $_SESSION['SessionMemberID'], time() + (86400 * 365), "/");
	setcookie("MemberPassword", $_SESSION['SessionMemberPassword'], time() + (86400 * 365), "/");
}

echo $result;
?>