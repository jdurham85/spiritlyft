<?php 
session_start();
include 'config.php';
include 'core.inc.php';

date_default_timezone_set(getMemberTimezone($_SESSION['SessionMemberID']));

include 'calendar.inc.php';

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
	background-color:#F7F5FB;
	width:100%;
}

#calender_tb button{
}

#calender_tb caption{
	font-size:22px;
	font-weight:bold;
	background-color:#F7F5FB;
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
	width:100%;
	height:50px;
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
	width:100%;
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
	
#add_event_tb{
	width:100%;
	background-color:#AA99DA;
	font-family:Helvetica;
	display: none;
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

$selected_month = str_replace("0", "", $month) - 1;

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
function formatAMPM() {
  var date = new Date();
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var ampm = hours >= 12 ? 'PM' : 'AM';
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'
  minutes = minutes < 10 ? '0'+minutes : minutes;
  var strTime = hours + ':' + minutes + ' ' + ampm;
  return strTime;
}

//check_event(<?php //echo date('m', $date) . ", " . date('d', $date) . ", " . date('Y', $date);  ?>);
function check_event(m, d, y)
{
	
	$.post("checkAlert.php", {date: m + "/" + d + "/" + y, time: formatAMPM()}, function(html){
			$("#event_remindertb").html(html);
			
			if($("#event_remindertb").html().length > 0)
			{
				$("#event_remindertb").show();	
			}
		});
}

function event_reminder_close()
{
	$("#event_remindertb").fadeOut(function(){$("#event_remindertb").html('');});		
}

function calendar_info_toggle()
{
	$("#calender_information").slideToggle();	
}
	
function delete_event(id)
{
	$.post("include/deleteEvent.php", {id: id}, function(){
		$("#eventtb"+id).fadeOut().remove();	
		
		$("#calender_panel").load("m_calender.php?month=" + month + "&day=" + day + "&year=" + year);
	});		
}

function add_event_toDB()
{
	var et = document.getElementById("eventtitle").value;
	var ed = document.getElementById("eventdate").value;
	var eta = document.getElementById("eventtimea").value;
	var etb = document.getElementById("eventtimeb").value;
	var etp = document.getElementById("eventtimec").value;
	
	if(!et =='' || !ed =='' || !eta =='' || !etb =='' || !etp =='')
	{
		$.post("include/calendar.inc.php", {add_event: "1", eventtitle: et, eventdate: ed, eventtimea: eta, eventtimeb: etb, eventtimec: etp}, function(result){
			event_tb_close();
			$("#calender_panel").load("m_calender.php?month=" + month + "&day=" + day + "&year=" + year);
		});
	}
}

function event_tb_show(m, d , y)
{
	var month_names = ["January","February","March","April","May","June","July","August","September","October","November","December"];
	
	$("#eventdate").html("<option value="+m+"/"+d+"/"+y+">"+month_names[m - 1]+" " +d+", "+y+"</option>");
	$("#add_event_tb").fadeIn();
	
	$.post("include/getEvents.php", {month: m, day: d, year: y}, function(html){
			$("#listevent").html(html);
		});
}

function event_tb_close()
{
	$("#eventtitle").val('');
	$("#eventdate").html();
	$("#eventtimea").val('');
	$("#eventtimeb").val('');
	$("#add_event_tb").fadeOut();
	$("#listevent").html('');	
}
</script>

<table id="add_event_tb" cellpadding="1" cellspacing="6">
    <tr align="center">
        <td><button style="background-color:red; padding:6px 6px 6px 6px; border-width:2px; width:50%; color:white; font-family:Arial; border-radius:4px;" onClick="event_tb_close();" formtarget="_parent">Close</button></td>
    </tr>
	<caption id="add_event_caption"></caption>
    <tr align="center">
    	<td>
        	<strong>Event Title</strong> <input type="text" id="eventtitle" data-role="none" name="eventtitle" style="line-height: 40px; width:100%; border-radius:4px;" />
        </td>
    </tr>
    <tr align="center">
    	<td>
    		<strong>Event Date</strong>
    	</td>
    </tr>
    <tr align="center">
    	<td>
        	<select id="eventdate" data-role="none" name="eventdate" disabled style="padding:12px 0px 10px 0px; border-radius:4px;"></select>
            
            <select id="eventtimea" name="eventtimea" data-role="none" style="width:60px; padding:12px 0px 10px 0px; border-radius:4px;">
            	<option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option>            
            </select>
            :
            <select id="eventtimeb" name="eventtimeb" data-role="none" style="width:60px; padding:12px 0px 10px 0px; border-radius:4px;">
            	<option value="00">00</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option><option value="59">59</option>            
            </select>
            <select id="eventtimec" name="eventtimec" data-role="none" style="padding:12px 0px 10px 0px; border-radius:4px;">
            	<option value="AM">AM</option>
                <option value="PM">PM</option>
            </select>
        </td>
    </tr>
    
    <tr>
    	<td colspan="2">
        	<button style="padding:6px 6px 6px 6px; width:100%; border-radius:6px; color:white; font-family:arial; background-color:#340AB0;" formtarget="_parent" onClick="add_event_toDB();">Add Event</button>
        </td>
    </tr>
    
    <tr align="center">
    	<td>
        	<table id="listevent" width="100%">
        	</table>
        </td>
    </tr>
</table>

<table id="calender_tb">
	<caption id="month_title"><?php echo $month_names[$selected_month] . "  " . $year; ?><a data-role="button" onClick="calendar_info_toggle();"><img src="image/question-mark-in-a-circle-outline_318-53407.png" style="width:32px;  margin-left:7px; margin-top:7px;" /></a></caption>
   <tr id="calander_btn">
		<td colspan="2">
			<button onClick="go_back();" style=""><</button>
		</td>
		<td colspan="3">
			<button onClick="currentdate();" style="">Current Date</button>
		</td>
		<td colspan="4">
			<button onClick="go_forward();" style="">></button>
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
			Sun
		</td>
		<td>
			Mon
		</td>
		<td>
			Tue
		</td>
		<td>
			Wed
		</td>
		<td>
			Thu
		</td>
		<td>
			Fri
		</td>
		<td>
			Sat
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
			echo "<td height='50' style='background-color:#4A338E; border: 1px solid black;'></td>";
			$blank = $blank - 1;
			$day_count++;
		}

		$day_num = 1;

		while($day_num <= $day_in_month)
		{
			if(check_exist_event($month . "/" . $day_num . "/" . $year) > 0)
			{
				echo "<td weight='50' width='50' style='border: 1px solid black;'><div class='cbutton' onclick='event_tb_show(".$month.", ".$day_num." , ".$year.");' style='background-color:yellow;'><span class='day_num_style'>$day_num</span></div></td>";
			}
			else
			{
				//echo "<td weight='50' width='50' style='border: 1px solid black;'><div class='cbutton' onclick='event_tb_show(".$month.", ".$day_num." , ".$year.");'><span class='day_num_style'>$day_num</span></div></td>";

				if($month == date("n") && $day_num == date("d") && $year == date('Y'))
				{
					echo "<td height='50' width='50' style='border: 1px solid black;'><div class='cbutton' onclick='event_tb_show(".$month.", ".$day_num." , ".$year.");' style='background-color:#E9E5F5;'><span class='day_num_style'>$day_num</span></div></td>";
				}
				else
				{
					echo "<td height='50' width='50' style='border: 1px solid black;'><div class='cbutton' onclick='event_tb_show(".$month.", ".$day_num." , ".$year.");'><span class='day_num_style'>$day_num</span></div></td>";
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
        </table>