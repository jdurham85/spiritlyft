<?php 
session_start();
include 'core.inc.php';
include 'chat_core.inc.php';
include 'connections.core.inc.php';

echo getMessageAlerts($_SESSION['SessionMemberID']);
?>