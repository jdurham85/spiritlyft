<?php 
session_start();
include 'config.php';
include 'include/core.inc.php';

$date = time();
$day = date('d', $date);
$month = date('m', $date);
$year = date('Y', $date);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/style1_m.css"/>
<link rel="stylesheet" href="css/calender_homepage_style1.css" />
<!-- Include meta tag to ensure proper rendering and touch zooming -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Include jQuery Mobile stylesheets -->
<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">

<!-- Include the jQuery library -->
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Include the jQuery Mobile library -->
<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<title>SpiritLyft</title>
</head>
<?php include 'm_header.php';?>
<body onLoad="">
<script type="text/javascript">
var month = <?php echo date('m'); ?>;
var day = <?php echo date('d'); ?>;
var year = <?php echo date('Y'); ?>;

$(document).ready(function() {
    $("#calender_panel").css("height", $(this).height() - 60);
	$("#calender_panel").load("include/m_calender_iframe.php");
});

function delete_event(id)
{
	$.post("include/deleteEvent.php", {id: id}, function(){
		$("#eventtb"+id).fadeOut().remove();	
		
		$("#calender_panel").load("calender.php?month=" + month + "&day=" + day + "&year=" + year);
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
			currentdate();
			event_tb_close();
			$("#calender_panel").load("include/m_calender_iframe.php?month=" + month + "&day=" + day + "&year=" + year);
		});
	}
}

function event_tb_show(m, d , y)
{
	//var month_names = ["January","February","March","April","May","June","July","August","September","October","November","December"];
	
	//$("#eventdate").html("<option value="+m+"/"+d+"/"+y+">"+month_names[m - 1]+" " +d+", "+y+"</option>");
	//$("#add_event_tb").fadeIn();
	
	//$.post("include/getEvents.php", {month: m, day: d, year: y}, function(html){
			//$("#listevent").html(html);
		//});
}

function setcurrentdate(month1, day1, year1)
{
	month = month1;
	day = day1;
	year = year1;
	
	$("#calender_panel").load("include/m_calender_iframe.php");
}

function go_back()
{
	month -=1;
	
	if(month == 0)
	{
		month = 12;
		year -=1;
	}
	$("#calender_panel").load("include/m_calender_iframe.php?month=" + month + "&day=" + day + "&year=" + year);
}

function go_forward()
{
	month +=1;
							
	if(month == 13)
	{
		month = 1;
		year +=1;
	}
	
	//$("#calender_panel").attr("src","calender.php?month=" + month + "&day=" + day + "&year=" + year);
	$("#calender_panel").load("include/m_calender_iframe.php?month=" + month + "&day=" + day + "&year=" + year);	
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
</script>
<style>
#calendar_iframe
{
	width:100%;	
}
</style>

<div id="calender_panel"></div>
</div>
<?php include 'm_footer.php'; ?>
</body>
</html>