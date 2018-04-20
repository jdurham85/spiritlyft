<?php
//session_start();
include 'include/gifts.inc.php';
include 'config.php';
include 'include/core.inc.php';

?>
<!doctype html>
<html><head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/style1.css"/>
<link rel="stylesheet" href="css/commentbox_style1.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php include 'meta_header.php'; ?>
<title>SpiritLyft</title>
</head> 
<body>
	<header>
    	<div id="header_sub">
            <?php include 'title.php'; ?>
        </div>
    </header>
    <style type="text/css">
    	#giftshop_body{
			width:75%;
			float:left;
			border-left:1px black solid;
			border-bottom:1px black solid;
			border-right:1px black solid;
		}
		
		#giftshop_body img
		{
			border: 1px black solid;
		}
		
		#giftshop_body button{
			padding:8px 8px 8px 8px;
			background-color:#795FC5;
			float:left;
			color:white;
			border-radius:8px;
			font-size:14px;
			font-weight:bold;
			width:100%;
		}
		
		#giftshop_body select{
			padding:8px 8px 8px 8px;	
			background-color:#795FC5;
			color:white;
			border-radius:8px;
			font-size:18px;
			font-weight:bold;
			width:40%;
		}
		
		#giftshop_title{
			text-align:center;
			font-family:helvetica;
			font-size:28px;
			font-weight:bold;
			background-color:#4A338E;	
			float:left;
			width:75%;
			color:white;
		}
    </style>
    
    <script type="text/javascript">
		$(document).ready(function(e) {
        	$("#back-screen").height($(this).height());  
        });
		
		function startprocess()
		{
			$("#back-screen").fadeIn();	
		}
		
		function show_reviewOrder()
		{
			$.post("include/gifts.inc.php", {revieworder: 1}, function(html){
					$("#giftshop_body").append(html);
				});	
		}
		
		function go_to_mycart()
		{
			window.location = "mycart.php";	
		}
		
		show_reviewOrder();
    </script>
        <div id="body">
            <?php include 'menu_btn.php';  ?>
            <div id="giftshop_title">Review Order</div>
            <table>
            <tr>
				<?php 
                    if(isset($_POST['status']) && $_POST['status'] == 0)
                    {
                        ?>
                        <td>
                            <img src="image/2000px-Yes_Check_Circle.svg.png" width="200" />
                        </td>
                        <td>
                        	Order has been succesfully processed. <a>Click here to access your Tresurely</a>
                        </td>
                        <?php	
                    }
					
					if(isset($_POST['status']) && $_POST['status'] == 1)  //order has been cancel
					{
						?>
                        <td>
                            <img src="image/2000px-Yes_Check_Circle.svg.png" width="200" />
                        </td>
                        <td>
                        	Order has been succesfully processed. <a>Click here to access your Tresurely</a>
                        </td>
                        <?php		
					}
					
					if(isset($_POST['status']) && $_POST['status'] == 2)
					{
						?>
                        <td>
                            <img src="image/button-cancel-800px.png" width="200" />
                        </td>
                        <td>
                        	Order has not been succesfully processed. Please try again later.
                        </td>
                        <?php		
					}
                ?>
            </tr>
            </table>
            
        </div>
</body>
</html>