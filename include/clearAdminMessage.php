<?php
include 'config.php';

mysqli_query($db_con, "delete from admin_message where id = '".$_POST['messageid']."'");
?>