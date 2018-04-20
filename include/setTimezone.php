<?php 
session_start();
include 'core.inc.php';

changeMemberTimezone($_SESSION['SessionMemberID'], $_POST['Timezone']);
echo getMemberTimezone($_SESSION['SessionMemberID']);
?>