<?php 
include 'post.inc.php';

$wallid = $_POST['wallid'];
wall_unshare($wallid);
?>