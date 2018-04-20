<?php 
include 'post.inc.php';
include 'config.php';
like_wall_comment($_POST['WallCommentid'], $_POST['Emojli']);

echo getWallCommentTotalEmojlies($_POST['WallCommentid']);
?>