<?php
session_start();
include 'search.inc.php';
include 'core.inc.php';
include 'connections.core.inc.php';
echo searchinquery3($_POST['searchinquery'], $_POST['page']);
?>