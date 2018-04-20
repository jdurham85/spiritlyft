<?php 
function add_event($title, $date, $time, $period)
{
	session_start();
	include 'config.php';
	/*include 'core.inc.php';

	date_default_timezone_set(getMemberTimezone($_SESSION['SessionMemberID']));

	$date_explode = explode("/", $date);
	$time_explode = explode(":", $time);

	$m = $date_explode[0];
	$d = $date_explode[1];
	$y = $date_explode[2];

	$h = $time_explode[0];
	$min = $time_explode[1];

	$mktime = mktime(0, 0, 0, $m, $d, $y);*/

	
	$mainmember = $_SESSION['SessionMemberID'];
	$sql = mysqli_query($db_con, "INSERT INTO member_calendar (`id`, `Memberid`, `EventTitle`, `EventDate`, `Time`, `Period`, `Status`) VALUES (NULL, '$mainmember', '$title','$date','$time','$period','3')") or die(mysqli_error($db_con));
}

if(isset($_POST['add_event']))
{
	$time = $_POST['eventtimea'] . ":" . $_POST['eventtimeb'];
	$date = addslashes($_POST['eventdate']);
	$title = addslashes($_POST['eventtitle']);
	add_event($title, $date, $time, $_POST['eventtimec']);
}

function loadEvents()
{
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
		//$myJON = json_encode($mydates, JSON_FORCE_OBJECT);
	}
	echo json_encode($mydates, JSON_FORCE_OBJECT);	
}

?>