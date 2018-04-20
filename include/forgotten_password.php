<?php 
include 'config.php';
include 'core.inc.php';
include 'mail.inc.php';

$email = trim($_POST['email']);

$hashcode = md5(date('m-d-Y') . time());

$sql = mysqli_query($db_con, "select * from member where Email = '$email'");

if(mysqli_num_rows($sql) > 0)
{
	$MemberID = MemberIDByEmail($email);
	
	mysqli_query($db_con, "INSERT INTO `member_password_reset`(`id`, `Memberid`, `hashcode`) VALUES (NULL, '$MemberID', '$hashcode')") or die(mysqli_error($db_con));
	$PasswordResetLink = "https://www.spiritlyft.com/password-reset.php?m=".base64_encode($MemberID)."&hc=$hashcode";
	
	sendPasswordResetLink($MemberID, $PasswordResetLink);
			
	echo "0";	
}
else
{
	echo "1";	
}

?>