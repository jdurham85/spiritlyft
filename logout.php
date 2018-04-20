<?php 
session_start();
include "config.php";


//mysqli_query($db_con, "delete from member_online where MemberId = '".$_SESSION['SessionMemberID']."'");


//$_SESSION['SessionMemberID'] = mysqli_insert_id($db_con);
//$_SESSION['SessionMemberPassword'] = $password;

setcookie("MemberID", $_SESSION['SessionMemberID'], time() - (86400 * 365), "/");
setcookie("MemberPassword", $_SESSION['SessionMemberPassword'], time() - (86400 * 365), "/");

session_unset(); 
session_destroy();
?>

<script>
document.location = "index.php";
</script>