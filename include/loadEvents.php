<?php 
session_start();
include 'config.php';
$mainmember = $_SESSION['SessionMemberID'];

$date = time();
				
$day = date('d', $date);
$month = date('m', $date);
$year = date('Y', $date);

$selected_date = $month . "/" . $day . "/" . $year;

$track = 0;

$mydates=array();
$myJON = '';

$sql = mysqli_query($db_con, "select * from member_calendar where Memberid = '$mainmember'") or die(mysqli_query($db_con));

if(mysqli_num_rows($sql) > 0)
{
	while($e = mysqli_fetch_array($sql))
	{
		$my = explode("/", $e['EventDate']);
		
		if($my[0] == $month && $my[2] == $year && $e['Status'] != 0)
		{
			$mydates[] = $e['EventTitle'];
			$mydates[] = $e['EventDate'];
			$mydates[] = $e['Time'] . "  " . $e['Period'];
		}
	}	
	$myJON = json_encode($mydates, JSON_FORCE_OBJECT);
}
echo $myJON;
?>