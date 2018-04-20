<?php 
session_start();
include 'config.php';

$password = md5(trim($_POST['oldpassword']));

$sql = mysqli_query($db_con, "select * from member where Memberid = '".$_SESSION['SessionMemberID']."' && Password = '$password'");

if(mysqli_num_rows($sql) > 0)
{
	echo 1;	
}
else
{
	echo 0;	
}

?>