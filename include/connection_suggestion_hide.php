<?php 
session_start();
include 'config.php';
include 'core.inc.php';
include 'connections.core.inc.php';
connection_suggestion_hide($_POST['memid']);
?>