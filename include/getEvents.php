<?php 
session_start();
include 'config.php';
$MainMember = $_SESSION['SessionMemberID'];

$month = '';
$day = '';
$year = '';

//if(isset($_POST['month']) && isset($_POST['day']) && isset($_POST['year']))
//{
	$month = $_POST['month'];
	$day = $_POST['day'];
	$year = $_POST['year'];	
//}

$selected_date = $month . "/" . $day . "/" . $year;

$sql = mysqli_query($db_con, "select * from member_calendar where Memberid = '$MainMember' && EventDate = '$selected_date'") or die(mysqli_query($db_con));

?>
<tr style="font-weight:bold;" align="center">
    <td>
        Event Title
    </td>
    <td>
        Event Date
    </td>
</tr>
<?php


if(mysqli_num_rows($sql) > 0)
{
	while($e = mysqli_fetch_array($sql))
	{
		$my = explode("/", $e['EventDate']);
		
		//if($my[0] == $month && $my[2] == $year)
		//{
			echo "<tr id='eventtb".$e['id']."'><td>".$e['EventTitle']."</td><td>".$e['EventDate']. "  ". $e['Time'] . $e['Period'] ."</td><td><button onclick='delete_event(".$e['id'].");'>Delete</button></td></tr>";		
		//}
	}	
}
else
{
	echo "<tr align='center'><td colspan = '2'>No Event Schedule</td></tr>";	
}

?>