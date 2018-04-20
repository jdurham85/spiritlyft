<?php 
include 'config.php';
include 'core.inc.php';
include 'include/connections.core.inc.php';

foreach (getAllConnections() as $key => $value) {
	date_default_timezone_set(getMemberTimezone($value));

	$member_birthday = explode("/", MemberBirthday($value));

	if(date("h:iA") == "8:00AM" && date("n/j") == $member_birthday[0] . "/" . $member_birthday[1])
	{
		foreach(getMemberConnections($value) as $c)
		{
			$sql1 = mysqli_query($db_con, "INSERT INTO `member_notification`(`id`, `Wallid`, `toMember`, `fromMember`, `Mode`, `vStatus`) VALUES (NULL, '0', '$c', '$value', 9,1)");
		}

		$sql1 = mysqli_query($db_con, "INSERT INTO `member_notification`(`id`, `Wallid`, `toMember`, `fromMember`, `Mode`, `vStatus`) VALUES (NULL, '0', '0', '$value', 10,1)");
	}
}
?>