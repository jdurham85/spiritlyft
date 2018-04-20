<?php 
session_start();
include '../config.php';

$memid = base64_decode($_POST['m']);
$hashcode = $_POST['hc'];
$newpassword = md5(trim($_POST['userpassword']));

$sql = mysqli_query($db_con, "update member set Password = '$newpassword' where Memberid = '$memid'") or die(0);

mysqli_query($db_con , "delete from member_password_reset where Memberid = '$memid'");

$sql1 = mysqli_query($db_con, "select * from member where Memberid = '$memid'");

while($m = mysqli_fetch_array($sql1))
{
	$_SESSION['SessionMemberID'] = $m['Memberid'];	
}

echo 1;
?>