<?php 
session_start();

include 'config.php';

$newphonenumber = trim($_POST['newphonenumber']);

$sql = mysqli_query($db_con, "update member set PhoneNumber = '$newphonenumber' where Memberid = '".$_SESSION['SessionMemberID']."'");

echo 1;
?>