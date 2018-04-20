<?php
//date_default_timezone_set('America/New_York');

include 'core.inc.php';
include 'mail.inc.php';

foreach(getAllConnections() as $c)
{
	//if(check_if_member_active($c) == 0)
	//{
		five_day_alert($c);
		two_day_alert($c);
		today_alert($c);
	//}
}

function five_day_alert($mem)
{
	include 'config.php';
	date_default_timezone_set(getMemberTimezone($mem));
	
	$sql = mysqli_query($db_con, "select * from member_calendar where Memberid = '$mem' && Status = 3");
	
	if(mysqli_num_rows($sql) > 0)
	{
		while($a = mysqli_fetch_array($sql))
		{
			$sql_date = $a['EventDate'];
			$sql_time = $a['Time'].$a['Period'];

			$sql_date_explode = explode("/", $sql_date);
			
			if($sql_date == date("n/j/Y", strtotime("+5 days")) && $sql_time == date("h:iA"))
			{
				mysqli_query($db_con, "update member_calendar set Status = 2 where Memberid = '$mem'");
				send_Calender_AlertEmail($mem, "Five Day Alert", $sql_date . "  " .$sql_time, $a['EventTitle']);
				
				$message = "Five Day Reminder \r\n".$a['EventTitle'] . "\r\n" . $a['EventDate'] . "\r\n" . $a['Time'] . $a['Period'];
				send_text_message($mem, $message);
			}
			if($sql_date_explode[0] == date("n") && ($sql_date_explode[0]) < (date("j", strtotime("+5 days"))) && $sql_date_explode[0] == date("Y"))
			{
				mysqli_query($db_con, "update member_calendar set Status = 2 where Memberid = '$mem'");
			}
		}	
	}
}

function two_day_alert($mem)
{
	include 'config.php';
	date_default_timezone_set(getMemberTimezone($mem));
	
	$sql = mysqli_query($db_con, "select * from member_calendar where Memberid = '$mem' && Status = 2");
	
	if(mysqli_num_rows($sql) > 0)
	{
		while($a = mysqli_fetch_array($sql))
		{
			$sql_date = $a['EventDate'];
			$sql_time = $a['Time'].$a['Period'];
			$sql_date_explode = explode("/", $sql_date);
			
			if($sql_date == date("n/j/Y", strtotime("+2 days")) && $sql_time == date("h:iA"))
			{
				mysqli_query($db_con, "update member_calendar set Status = 1 where Memberid = '$mem'");
				send_Calender_AlertEmail($mem, "Two Day Alert", $sql_date . "  " .$sql_time, $a['EventTitle']);
				
				$message = "Two Day Reminder \r\n".$a['EventTitle'] . "\r\n" . $a['EventDate'] . "\n" . $a['Time'] . $a['Period'];
				send_text_message($mem, $message);
			}if($sql_date_explode[0] == date("n") && ($sql_date_explode[0]) < (date("j", strtotime("+2 days"))) && $sql_date_explode[0] == date("Y"))
			{
				mysqli_query($db_con, "update member_calendar set Status = 1 where Memberid = '$mem'");
			}
		}	
	}
}

function today_alert($mem)
{
	include 'config.php';
	date_default_timezone_set(getMemberTimezone($mem));
	
	$sql = mysqli_query($db_con, "select * from member_calendar where Memberid = '$mem' && Status = 1");
	
	if(mysqli_num_rows($sql) > 0)
	{
		while($a = mysqli_fetch_array($sql))
		{
			$sql_date = $a['EventDate'];
			$sql_eventtitle = $a['EventTitle'];
			$sql_time = $a['Time'].$a['Period'];
			$sql_date_explode = explode("/", $sql_date);
			
			if($sql_date == date("n/j/Y") && $sql_time == date("h:iA"))
			{
				mysqli_query($db_con, "update member_calendar set Status = 0 where Memberid = '$mem'");
				send_Calender_AlertEmail($mem, "Today Alert", $sql_date . "  " .$sql_time, $a['EventTitle']);
				
				$message = "Today Reminder \r\n".$a['EventTitle'] . "\r\n" . $a['EventDate'] . "\r\n" . $a['Time'] . $a['Period'];
				send_text_message($mem, $message);
			}
		}
		
	}	
}
?>