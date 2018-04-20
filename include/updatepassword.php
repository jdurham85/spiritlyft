<?php 
session_start();

include 'config.php';

$newpassword = md5(trim($_POST['newpassword']));

$sql = mysqli_query($db_con, "update member set password = '$newpassword' where Memberid = '".$_SESSION['SessionMemberID']."'");

echo 1;
?>