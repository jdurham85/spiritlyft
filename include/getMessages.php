<?php
session_start();
include 'config.php';
include 'core.inc.php';
include 'chat_core.inc.php';

$fromMember = $_POST['mem1'];

echo getMessages($fromMember);
?>