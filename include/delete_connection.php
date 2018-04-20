<?php 
session_start();
include 'connections.core.inc.php';

delete_connection($_POST['memid'], $_SESSION['SessionMemberID']);
?>