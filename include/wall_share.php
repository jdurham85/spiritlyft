<?php 
include 'post.inc.php';

$wallid = $_POST['wallid'];
$level = $_POST['level'];
wall_share($wallid, $level);
?>