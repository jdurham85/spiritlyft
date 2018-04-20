<?php
session_start();
include 'config.php';
include 'connections.core.inc.php';
include 'core.inc.php';
include 'mail.inc.php';

$MEM1 = $_POST['mem1'];
$MEM2 = $_SESSION['SessionMemberID'];

/*
	respone 0 -  no connection request exist
	respone 1 -  connection has already been sent
	respone 2 -  connection request has been sent
	respone 3 -  no connection request exist or it has expired
	
	$MEM1 = To Member
	$MEM2 = From Member
*/

/*
if(check_connection_request_status($MEM1, $MEM2) == 3)
{
	$sql = mysqli_query($db_con, "insert into member_connection (`id`, `ToMemberid`, `FromMemberid`, `isConfirm`, `Status`) values(NULL, '$MEM1', '$MEM2', '1', '0')");
	return 2;	
}

if(check_connection_request_status($MEM1, $MEM2) == 1)
{
	return 1;	
}


if(check_connection_request_status($MEM1, $MEM2) == 0)
{
	$GetRequestID = getRequestid($MEM2, $MEM1);
	$sql = mysqli_query($db_con, "update member_connection set isConfirm = '1' where ToMemberid = '$MEM2' && FromMemberid = '$MEM1'");
	return 0;	
}
//if(check_if_member_active($MEM1) == 0) //Checking if member not online
//{
	if(MemberPhoneNumber_Exist($MEM1) > 0)
	{
		$Message = MemberFullName($MEM2)." \r\n has sent you a connection request \r\n https://www.spiritlyft.com/community.php?mode=1";
		send_text_message($MEM1, $Message);
	}*/

	send_connection_request_email($MEM1, $MEM2);
//}

$sql = mysqli_query($db_con, "INSERT INTO `member_notification`(`id`, `Wallid`, `toMember`, `fromMember`, `Mode`, `vStatus`) VALUES (NULL, NULL, '$MEM1', '".$_SESSION['SessionMemberID']."',6,1)");

echo add_connection($MEM1, $MEM2);
?>