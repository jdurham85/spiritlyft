<?php 
session_start();
include 'core.inc.php';
include 'chat_core.inc.php';
include 'connections.core.inc.php';

$fromMember = $_POST['id'];

$member_message_alert = getMessageAlerts_from_Member($_SESSION['SessionMemberID'], $fromMember);

if(!$member_message_alert == 0)
{
	echo $member_message_alert;
}
?>