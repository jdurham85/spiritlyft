<?php 
session_start();
include 'config.php';
include 'core.inc.php';
include 'mail.inc.php';

sendFeedback_mail($_SESSION['SessionMemberID'], $_POST['msg']);
?>