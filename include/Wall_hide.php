<?php 
include 'post.inc.php';
echo wall_hide($_POST['parentid'], $_SESSION['SessionMemberID'], $_POST['wallid']);
?>