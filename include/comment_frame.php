<?php
	include 'config.php';
	include 'post.inc.php';
	
	echo getHeaderDescription($_GET['Wallid']);
	echo getWallComment($_GET['Wallid']);
?>
<script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
	function thisclose()
	{
		window.parent.iframe_close();	
	}
	
	function insert_wallComment(wall)
	{
		var user_comment_txt = document.getElementById("user_comment_input").value;
		
		if(user_comment_txt != '')
		{
			$.post("insert_wallComment.php", {Wallid: wall, Description: user_comment_txt}, function(result){
				document.getElementById("user_comment_input").value = '';
					$("#post_panel"+wall).after(result);
					window.parent.setWallCommentTotal(wall);
				});	
		}
	}
</script>
<style type="text/css">
			.post_panel{
				background-color:white;
				width:98%;
				margin:0 0 0 0;
				padding:4px 4px 4px 4px;
				display:table;
				font-family:arial;
				border-radius:0px;
				font-family:Helvetica;
			}
			
			.border{
				border:1px solid black;
				margin-bottom:1px;
			}
			
			#post_panelsub{
				width:55%;
				margin:25px 0 0 255px;
			}
			
			#post_header{
				text-align:left;
				padding:8px 8px 8px 8px;		
			}
			
			#post_header button{
				background-color:#4A338E;
				color:white;
				border:none;
				border-radius:4px;
				padding:4px 4px 4px 4px;	
				font-weight:bold;
				margin-left:10px;
				float:right;
			}
			
			#post_body{
				text-align:center;
				padding:4px 4px 4px 4px;
			}
			
			#post_textview{
				margin-top:10px;
				font-family:Helvetica;
			}
			
			#post_footer{
				padding:4px 4px 4px 4px;
			}
			
			#post_footer input{
				padding:8px 4px 8px 4px;
				width:90%;
			}
			
			#post_footer a{
				padding:6px 6px 6px 6px;
				text-decoration:none;
				color:black;
				font-weight:bold;
				float:left;
			}
			
			#post_footer button{
				background-color:#4A338E;
				color:white;
				border:none;
				border-radius:4px;
				padding:6px 6px 6px 6px;	
				font-weight:bold;
			}
      </style>