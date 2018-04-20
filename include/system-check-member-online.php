<?php 
include 'config.php';
include 'core.inc.php';

foreach(getAllConnections() as $c)
{
	date_default_timezone_set(getMemberTimezone($c));
	//$member_online = mysqli_query($db_con, "select * from member_online where MemberId = '$c'");
	
	//while($mo = mysqli_fetch_array($member_online))
	//{
		//if(date("h:iA") > $mo['ActiveTill'])
		//{
			//mysqli_query($db_con, "delete from member_online where MemberId = '$c'");
		//}
	//}
}
?>