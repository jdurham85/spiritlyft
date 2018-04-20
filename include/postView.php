<?php
session_start();
include 'config.php';
include 'core.inc.php';

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php

function viewPost($File, $memberid, $filetype, $description)
{
	if(!is_dir("../profile/tmp/" . $memberid))
	{
		mkdir("../profile/tmp/" . $memberid);			
	}
	
	$AllowedImageType = array('jpg','jpeg','bmp','gif','png','gif');
	$validImage = 0;

	?>
<style type="text/css">
     #post_panel{
				background-color: white;
				width:99%;
				display:table;
				font-family:arial;
				border-radius:6px;
				border:1px solid black;	
				font-family:Helvetica;
			}
			
			.post_panel{
				background-color: white;
				width:95%;
				display:table;
				font-family:arial;
				margin-bottom:30px;
				border-radius:6px;
				border:1px solid black;	
				font-family:Helvetica;
			}
			
			#post_panelsub{
				width:100%;
			}
			
			#post_header{
				text-align:left;
				font-weight:bold;
				padding:8px 8px 8px 8px;	
			}
			
			#post_header button{
				background-color:#4A338E;
				color:white;
				border:none;
				border-radius:4px;
				font-weight:bold;
				float:right;
				padding:8px 8px 8px 8px;	
			}
			
			#post_body{
				text-align:center;
				width:99%;
				padding:8px 8px 8px 8px;
				text-align: center;
				margin-top:40px;
				margin-bottom: 20px;
			}
			
			#post_textview{
				margin-top:10px;
				font-family:Helvetica;
			}
			
			#post_footer{
				padding:8px 8px 8px 8px;	
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
				font-weight:bold;
				margin-left:10px;
				padding:8px 8px 8px 8px;	
			}
    </style>
	  <div class="post_panel" id="post_panel0" align="center">
      			<div align="center">
                	Post Preview
                </div>
            	<div id="post_header">
          			<a href="javascript:void();" target="_parent"><img src="<?php echo "../" . MemberMainProfilePic($memberid); ?>" style="width: 32px; float: left;" />
                	<div style="margin-top: 10px; float: left;"><?php echo MemberFullName($memberid);?></div></a>
                </div>
                <div id="post_body">
                	<?php 
						
						if(in_array($Imagetype, $AllowedImageType))
						{
							foreach($File as $name => $index)
							{
								$Imagetype = pathinfo($File['name'][$index], PATHINFO_EXTENSION);
								$newFilename = gen_random_code(12) . "." . $Imagetype;
								$targetdir = "../profile/tmp/" . $memberid . "/" . $newFilename;

								$_SESSION['file_dir'] = $targetdir;
								$_SESSION['file_name'] = $newFilename;

								if(move_uploaded_file($File['tmp_name'][$index], $targetdir))
								{
									echo "<img src='$targetdir' width='85%' />";
								}
								else
								{
									echo 'Error 101';	
								}
							}
						}
						else
						{
							echo '<span style="color:red; font-weight:bold;">The Image file was not upload because either is not a vaild image or maybe the right file format.</span>';	
						}	
					?>
                    <div id="post_textview"><?php echo $description; ?></div>
                </div>
                <div id="post_footer" align="center">
                	<button onClick="addpost();">Post</button>
                    <button onClick="deletepost();">Cancel</button>
                </div>
            </div>
            <script type="text/javascript">
            	function addpost()
				{
					window.parent.addImagePost();	
				}
				
				function deletepost()
				{
					window.parent.closeImagePost();		
				}
            </script>
        <?php
}

if(isset($_REQUEST['submit1']))
{
	$postinput = $_POST['postinput'];
	echo viewPost($_FILES["mfile"], $_SESSION['SessionMemberID'], 'Image', $postinput);	
}
?>