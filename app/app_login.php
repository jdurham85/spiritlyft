<?php include 'config.php'; 
/*
if(!isset($_SESSION['SessionMemberID']) && $_SESSION['SessionMemberID'] !='')
{
	header("location: home.php");	
}*/

?>
<!doctype html>
<html>
<head>
<!-- Include meta tag to ensure proper rendering and touch zooming -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Include jQuery Mobile stylesheets -->
<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">

<!-- Include the jQuery library -->
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Include the jQuery Mobile library -->
<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

<link rel="stylesheet" href="css/style1_m.css"/>
<title>SpiritLyft</title>
</head>
<body>
<script type="text/javascript" src="js/countries.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<header>
    	<div id="header_sub">
            <div id="title1"><img src="image/sl_logo2.png" /></div>
        </div>
    </header>
    <script type="text/javascript">
	$(document).ready(function(){
		
	$("#loginfrm").submit(function(e) {
        e.preventDefault();
		
		if(document.getElementById("email1").value !='')
		{
			if(document.getElementById("password1").value !='')
			{
				$.ajax({
				  type: "POST",
				  url: "include/loginmember.php",
				  data: $("#loginfrm").serialize(),
				  success: function(m){
					 	if(m == 1)
						{
							document.location = "m_home.php";	
						}
                        else
                        {
                            alert("Either your Email Address or Password is invaild, please try again.");   
                        }
					}
				});
			}				
		}
		
    });
});
    </script>
	<div id="body" style="width:60%;" align="center">
		<form id="loginfrm" method="post" style="margin:auto; width:100%; text-align:center;">
            	  <table align="center" style="width:100%; margin:auto;">
                   	<caption style="font-size:18px; font-weight:bold; font-family:Arial;">Login</caption>
                        <tr>
                            <td>
                                <input type="text" id="email1" name="email1" required/>
                            </td>
                        </tr>
                        <tr>
                        	<td><input type="password" id="password1" name="password1" /></td>
                        </tr>
                            
                        <tr>
                        	<td>
                                <button id="loginbtn">Login</button>
                            </td>
                        </tr>
                    </table>
                </form>
    </div>
</body>
</html>