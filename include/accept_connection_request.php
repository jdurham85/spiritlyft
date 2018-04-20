<?php
session_start();
include 'config.php';
include 'connections.core.inc.php';

$MEM1 = $_POST['mem1'];
$MEM2 = $_SESSION['SessionMemberID'];

/*
	respone 0 -  no connection request exist
	respone 1 -  connection has already been sent
	respone 2 -  connection request has been sent
	respone 3 -  no connection request exist or it has expired
	
	$MEM1 = To Member
	$MEM2 = From Member
*/

echo accept_connection_request($MEM1, $MEM2);
?>