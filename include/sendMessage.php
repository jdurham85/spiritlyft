<?php
session_start(); 
include 'chat_core.inc.php';


$TOMember = $_POST['ToMember'];
$Message = addslashes(trim($_POST['Message']));

echo sendMessage($TOMember, $_SESSION['SessionMemberID'], $Message);
?>