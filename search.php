<?php 
session_start();
include 'config.php';
include 'include/core.inc.php';
include 'include/connections.core.inc.php';
include 'include/search.inc.php';
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/style1.css"/>
<link rel="stylesheet" href="css/commentbox_style1.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="js/countries.js"></script>
<?php include 'meta_header.php'; ?>
<title>SpiritLyft</title>

</head>
<body>
	<header>
       <?php include 'title.php'; ?>
    </header>
    <style>
    	#profile_body{
			margin-top:5px;
			background-color:#E4E4E4;
			width:75%;
			font-family:Arial;
			color:white;
			float:left;
			margin-left:10px;
			border-left:1px black solid;
			border-bottom:1px black solid;
			border-right:1px black solid;
		}
		
		#search_header
		{
			background-color:#4A338E;
			width:100%;
			height:100px;
			font-weight:bold; 
			padding:2px 2px 2px 2px;
		}
		
		#userfullname_textview{
			margin-top:25px;
			font-size:50px;
			text-align:center;
		}
		
		#search_menu{
			border-left:1px black solid;
			border-bottom:1px black solid;
			border-right:1px black solid;
			padding:8px 8px 8px 8px;
			display:none;
		}
		
		#search_menu button{
			padding:8px 8px 8px 8px;
			text-decoration:none;
			font-weight:bold;
			color:white;
			margin:auto;
			background-color:#4A338E;
			border:none;
		}
		
		.search_title{
			color:black;
			font-family:arial;
			font-weight:bold;	
			padding:8px 8px 8px 8px;
		}
		
		#search_body{
			width:100%;	
		}
		
		#picstatus button{
			padding:6px 6px 6px 6px;
			font-weight:bold;
			border-radius:6px;	
			border:none;
		}
		
		#search_footer
		{
			padding:6px 0px 6px 6px;
		}
		
		#search_footer button
		{
			padding:12px 12px 12px 12px;
			border:none;
			margin-right:10px;
			font-size:14px;
			font-weight:bold;
			font-family: Arial;
			color:white;
			background-color:#795FC5;
			border-radius:2px;	
		}
    </style>
<script type="text/javascript">
setInterval(getMemberOnline, 10000);

getMemberOnline();

function getMemberOnline()
{
	$.post("include/member_online.php", {mo: 1}, function(mo){
		$("#online_panel").html(mo);
	
	});
}

/*
	respone 0 -  no connection request exist
	respone 1 -  connection has already been sent
	respone 2 -  a member send you a request + I sent a request = connected
	respone 3 -  no connection request exist or it has expired
*/

function send_connection_request(mem1)
{		
	$.post("include/send_connection_request.php", {mem1: mem1}, function(result){
		
			if(result == 0)
			{
				document.getElementById("connection_btn"+mem1).innerHTML = "Connection Request Sent";	
				document.getElementById("connection_btn"+mem1).setAttribute("OnClick", "");
			}
			
			if(result == 1)
			{
				document.getElementById("connection_btn"+mem1).innerHTML = "Connection Pending";	
				document.getElementById("connection_btn"+mem1).setAttribute("OnClick", "");
			}
		});
}
var page_number = 0;

$(document).ready(function(e) {
    <?php 
		if(isset($_GET['searchInquery']) && $_GET['searchInquery'] !="")
		{
			?>
				//document.getElementById("searchinquery").value = "<?php //echo $_GET['searchInquery'];?>";
				
			//setTimeout(function(){
				$("#usearch").val(<?php echo $_GET['searchInquery'];?>);
				search_inquery();
			//}, 2000);
			<?php
		}
	?>
});

page_number = 0;	
function gotoProfile(id)
{
	window.location = "profile.php?profileid="+id;	
}

function search_inquery_btn_click()
{
	page_number = 0;
	search_inquery();
}

function search_inquery()
{		
	//var name_txt = document.getElementById("searchinquery").value;
	/*var country_txt = document.getElementById("country")[document.getElementById("country").selectedIndex].value;
	var state_txt = document.getElementById("state")[document.getElementById("state").selectedIndex].value;
	var city_txt = document.getElementById("city").value;
	
	if(country_txt == "-1")
	{
		country_txt = "";	
	}

	if(city_txt != "")
	{
		name_txt +=" "+city_txt;
	}

	if(state_txt != "")
	{
		name_txt += " "+state_txt;
	}

	if(country_txt != "")
	{
		name_txt +=" "+country_txt;
	}

	console.log(name_txt);*/
	
	$.post("include/searchquery3.php", {searchinquery: <?php echo $_GET['searchInquery'];?>, page: page_number}, function(html){
			$("#search_body").html(html);
		});
}


function goback()
{
	page_number--;
	
	if(page_number < 0)
	{
		page_number = 0;	
	}
	
	search_inquery();
}

function goforward()
{
	page_number++;
	
	if(page_number < 0)
	{
		page_number = 0;	
	}
	
	search_inquery();
}
</script>
<style type="text/css">
.connection_style button{
	padding:8px 8px 8px 8px;
	border:none;
	margin-right:10px;
	font-size:14px;
	font-weight:bold;
	font-family: Arial;
	color:white;
	background-color:#795FC5;
	border-radius:6px;	
}

.connection_style
{
	border:1px black solid;
	border-radius:4px;
	width:100%;
	background-color:white;
}

.connection_style_img
{
	width:20%;
}

.connection_style_info
{
	width:80%;	
}
	
#searchinquery_box
{
	display: none;
}

#searchinquery_box input
{
	width:99%;
	line-height:30px;	
}

#searchinquery_box select
{
	width:100%;
	padding:8px 0px 8px 0px;	
}

#searchinquery_box button
{
	padding:10px 10px 10px 10px;
	color:white;
	background-color:#4A338E;
	border-radius:2px;	
}

.search_title
{
}
</style>
<div id="body">
<?php include 'menu_btn.php';  ?>
    <div id="profile_body">
    
    <script type="text/javascript">

    </script>
        
        <div id="search_header">
            <div id="userfullname_textview">Search Connection</div>
        </div>
        <div id="search_inner_body">
            <div id="search_menu">
            </div>
            
            <div class="search_title" align="center">
            	<table id="searchinquery_box">
                	<tr>
                    	<td>
                        	Name:
                    	</td>
                    	<td>
                        	<input type="text" name="searchinquery" id="searchinquery" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Country:
                        </td>
                        <td>
                        	<select id="country" name="country" style="width:100%;"></select>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	State:
                        </td>
                        <td>
                        	<select name="state" id="state" style="width:100%;"></select>
							<script language="javascript">
                                populateCountries("country", "state");
                            </script>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	City:
                        </td>
                        <td>
                        	<input type="text" id="city" name="city" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                        
                        </td>
                        <td align="right">
                        	<button onClick="search_inquery_btn_click();">Search</button>
                        </td>
                    </tr>
                </table>
            </div>
            <script type="text/javascript">
            $(document).ready(function(e) {
                
            });
            </script>
            <div id="search_body" style="color: black;">
                <?php
                	if(isset($_GET['searchInquery']) && $_GET['searchInquery'] !="")
					{
						//echo searchinquery2($_GET['searchInquery'], 0);
					}
                ?>
            </div>
        </div>
        <div id="search_footer" align="center">
        	<button onClick="goback();">Back</button><button onClick="goforward();">Next</button>
        </div>
    </div>
</div>
</body>
</html>