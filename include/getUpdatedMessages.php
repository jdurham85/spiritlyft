<?php 
session_start();
include 'core.inc.php';
include 'chat_core.inc.php';
include 'connections.core.inc.php';

$fromMember = $_POST['mem1'];

echo getUpdatedMessages($fromMember);
?>