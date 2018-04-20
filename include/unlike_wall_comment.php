<?php 
include 'post.inc.php';
include 'config.php';
unlike_wall_comment($_POST['WallCommentid']);

echo getWallCommentTotalEmojlies($_POST['WallCommentid']);
?>