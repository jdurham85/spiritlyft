<?php 
include 'config.php';
$sql = mysqli_query($db_con, "select * from member where Email = '".$_POST['email']."'");
echo mysqli_num_rows($sql);
?>