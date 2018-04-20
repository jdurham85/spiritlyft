<?php 
session_start();
include 'include/core.inc.php';
date_default_timezone_set(getMemberTimezone($_SESSION['SessionMemberID']));

include 'include/calendar.inc.php';


function check_exist_event($date)
{
	include 'config.php';
	$mainmember = $_SESSION['SessionMemberID'];
	$sql = mysqli_query($db_con, "select * from member_calendar where Memberid = '$mainmember' && EventDate = '$date'");
	
	if(mysqli_num_rows($sql) > 0)
	{
		return 1;
	}
	else{
		return 0;
	}
}
?>
<style>
#calender_tb{
	font-family:Arial;
	background-color:#EFECF7;
        border: 2px black solid;
        border-radius: 10px;
}

#month_title{
    text-align: center;
    font-family: Arial;
    font-size: 18px;
    font-weight: bold;
}

#calender_tb button{
}

#calender_tb caption{
	font-size:22px;
	font-weight:bold;
	background-color:#EFECF7;
}

.daysoftheweek{
width:20%;	
}

.calender_day_style td{
	text-align:center;
	font-weight:bold;
}

.day_num_style
{
	float:left;
	font-weight:bold;
}

.cbutton{
	width:38px;
	height:38px;
	background-color:white;
	border-width:1px;
}

.cbutton2
{
	
}

.event{
	
}

.noevent{
	
}

#calander_btn button
{
	width:33.3%;
	background-color:#4A338E;
	padding:6px 4px 6px 4px;
	color:white;
	font-weight:bolder;
	font-size:14px;
	border-radius:3px;
}

#calender_information
{
	display:none;
	font-family:Cambria, "Hoefler Text", "Liberation Serif", Times, "Times New Roman", serif;
	text-align:left;
}
	
#tp_style a
{
	text-decoration: none;
	font-size: 12px;
	color:gray;
	padding:2px 2px 2px 6px;
	font-weight: bold;
}
</style>
<?php 
$date = time();
$day = date('d', $date);
$month = date('m', $date);
$year = date('Y', $date);

if(isset($_GET['month']) && isset($_GET['day']) && isset($_GET['year']))
{
	$month = $_GET['month'];
	$day = $_GET['day'];
	$year = $_GET['year'];	
}

$month_names = array("January","February","March","April","May","June","July","August","September","October","November","December");

if($month != 10)
{
	$selected_month = str_replace("0", "", $month) - 1;
}
else
{
	$selected_month = 9;
}
?>

<script type="text/javascript">
function go_back()
{
	calender_goback();	
}

function go_forward()
{
	calender_goforward();	
}

function currentdate()
{
	setcurrentdate(<?php echo date('m', $date) . ", " . date('d', $date) . ", " . date('Y', $date);  ?>);
}

function calendar_info_toggle()
{
	$("#calender_information").slideToggle();	
}
</script>

        <table id="calender_tb">
            <tr id="month_title">
                <td colspan="7"><?php echo $month_names[$selected_month] . "  " . date("d") . ",  ". $year; ?></td>
            </tr>
           <tr align="center">
           		<td colspan="7">
                	<div style="width:50%;" align="center">
                    	<a href="javascript:void();" onClick="calendar_info_toggle();"><img src="image/question-mark-in-a-circle-outline_318-53407.png" style="width:32px; float:left;" /><div style="font-family:arial; float:left; padding-left:7px; font-size:12px; margin-top:7px;">About the calendar.</a></div>
                    </div>
                </td>
           </tr>
           <tr id="calander_btn">
           		<td colspan="7">
                	<button onClick="go_back();" style=""><</button><button onClick="currentdate();" style="">Current Date</button><button onClick="go_forward();" style="">></button>
                </td>
           </tr>
           <tr id="calender_information">
           		<td  colspan="7">
                	The SpiritLyft calendar is designed to give you a 5-day, 2-day and same-day alert or reminder via text and email. <br><br>
                    Create reminders for birthdays, doctor appointments, meetings or just get togethers.
                </td>
           </tr>
            <tr align="center"  class="daysoftheweek">
            	<td>
                	S
                </td>
                <td>
                	M
                </td>
                <td>
                	T
                </td>
                <td>
                	W
                </td>
                <td>
                	T
                </td>
                <td>
                	F
                </td>
                <td>
                	S
                </td>
            </tr>
            
            <?php
				
				$first_day = mktime(0,0,0, $month, 1, $year);
				
				$day_of_week = date('D', $first_day);
				
				switch($day_of_week)
				{
					case "Sun": $blank = 0; break;
					case "Mon": $blank = 1; break;
					case "Tue": $blank = 2; break;
					case "Wed": $blank = 3; break;
					case "Thu": $blank = 4; break;
					case "Fri": $blank = 5; break;
					case "Sat": $blank = 6; break;	
				}
				
				$day_in_month = cal_days_in_month(0, $month, $year);
				
				echo "<tr>";
				
				$day_count = 1;
				while($blank > 0)
				{
					echo "<td height='' style='background-color:#4A338E; border: 1px solid black;'></td>";
					$blank = $blank - 1;
					$day_count++;
				}
			
				$day_num = 1;
				
				while($day_num <= $day_in_month)
				{
					if(check_exist_event($month . "/" . $day_num . "/" . $year) > 0)
					{
						echo "<td height='' width='' style='border: 1px solid black;'><button class='cbutton' onclick='event_tb_show(".convert_twodights($month).", ".$day_num." , ".$year.");' style='background-color:yellow;'><span class='day_num_style'>$day_num</span></button></td>";
					}
					else
					{
						if($month == date("n") && $day_num == date("d") && $year == date('Y'))
						{
							echo "<td height='' width='' style='border: 1px solid black;'><button class='cbutton' onclick='event_tb_show(".convert_twodights($month).", ".$day_num." , ".$year.");' style='background-color:#E9E5F5;'><span class='day_num_style'>$day_num</span></button></td>";
						}
						else
						{
							echo "<td height='' width='' style='border: 1px solid black;'><button class='cbutton' onclick='event_tb_show(".convert_twodights($month).", ".$day_num." , ".$year.");'><span class='day_num_style'>$day_num</span></button></td>";
						}
					}
					
					$day_num++;
					$day_count++;
					
					if($day_count > 7)
					{
						echo "</td></tr>";
						$day_count = 1;
					}
				}
				
function convert_twodights($num)
{
	if($num == 1)
	{
		return "01";	
	}
	
	if($num == 2)
	{
		return "02";	
	}
	
	if($num == 3)
	{
		return "03";	
	}
	
	if($num == 4)
	{
		return "04";	
	}
	
	if($num == 5)
	{
		return "05";	
	}
	
	if($num == 6)
	{
		return "06";	
	}
	
	if($num == 7)
	{
		return "07";	
	}
	
	if($num == 8)
	{
		return "08";	
	}
	
	if($num == 9)
	{
		return "09";	
	}

	if($num == 10)
	{
		return "10";	
	}

	if($num == 11)
	{
		return "11";	
	}

	if($num == 12)
	{
		return "12";	
	}
}
			?>
		<tr align="center">
			<td colspan="7" id="tp_style">
				<a href="terms-conditions.php">Terms Of Use</a>
				<a href="privacy_poilcy.php">Privacy Policy</a>
			</td>
		</tr>
       <tr>
       	<td colspan="7" align="center" style="font-size: 11px;  color: gray;">
			SpiritLyft &copy; 2017
		</td>
       </tr>
        </table>