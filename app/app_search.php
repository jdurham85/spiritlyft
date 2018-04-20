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
<link rel="stylesheet" href="css/style1_m.css"/>
<link rel="stylesheet" href="css/commentbox_style1.css" />
<!-- Include meta tag to ensure proper rendering and touch zooming -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Include jQuery Mobile stylesheets -->
<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">

<!-- Include the jQuery library -->
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Include the jQuery Mobile library -->
<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<script type="text/javascript" src="js/countries.js"></script>
<?php include 'meta_header.php'; ?>
<title>SpiritLyft</title>

</head>
<body>
	<header>
    	<div id="header_sub">
            <?php include 'app_header.php'; ?>
        </div>
    </header>
    <style>
    	#profile_body{
			background-color:#E4E4E4;
			width:99%;
			font-family:Arial;
			color:white;
			float:left;
			border-left:1px black solid;
			border-bottom:1px black solid;
			border-right:1px black solid;
		}
		
		#search_header
		{
			background-color:#4A338E;
			width:100%;
			height:25px;
			font-weight:bold; 
			padding:2px 2px 2px 2px;
		}
		
		#userfullname_textview{
			font-size:22px;
			text-align:center;
			font-weight: normal;
			font-family: Arial;
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
			border: 1px white solid;
			font-size:14px;
			font-weight:bold;
			font-family: Arial;
			color:white;
			background-color:#795FC5;
			border-radius:2px;	
			width: 50%;
			float:left;
		}
    </style>
<script type="text/javascript">

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
				document.getElementById("searchinquery").value = "<?php echo $_GET['searchInquery'];?>";
				//search_inquery();
			<?php
		}
	?>
});

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
	$.post("include/searchquery3.php", {searchinquery: $("#searchinquery").val(), page: page_number}, function(html){
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
	
#search_inner_body
{
	z-index: -1;
	}

#searchinquery_box input
{
	width:99%;
	line-height:10px;	
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
</style>
<div id="body">
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
            	<table id="searchinquery_box" width="99%">
                	<tr>
                    	<td>
                        	<input type="text" placeholder="Search for Family and Friends" name="searchinquery" id="searchinquery" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                        	<button onClick="search_inquery_btn_click();">Search</button>
                        </td>
                    </tr>
                </table>
            </div>
            <script type="text/javascript">
            $(document).ready(function(e) {
                
            });
            </script>
            <div id="search_body">

            </div>
        </div>
        <div id="search_footer" align="center">
        	<button onClick="goback();">Back</button><button onClick="goforward();">Next</button>
        </div>
    </div>
    <?php include 'm_footer.php'; ?>
</div>
</body>
</html>