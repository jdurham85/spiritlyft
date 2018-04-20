<?php
include 'post.inc.php';

$postinput = $_POST['postinput'];
$FileName = $_FILES["mfile"]["name"][0];
$Level = $_POST['level'];

/*
	0 - Success
	1 - Not Vaild Image
	2 - File was not uploaded
	3 - Error uploading file
*/

if(isset($_POST['submit1']))
{
	//check to see if folder exist if not it will make its own folder
	checkdir();
	
	if(!empty($FileName))
	{
		switch(insert_main_post1($postinput, $_FILES['mfile'], $Level))
		{
			case 0: 
				?>
                	<script type="text/javascript">
                    	window.parent.loadNewMPost();
						parent.clear_fileinput();
                    </script>
                <?php
			break;
			
			case 1: 
				?>
                	<script type="text/javascript">
                    	window.parent.errorMessage("Image file not vaild.");
                    </script>
                <?php
			break;
			
			case 2: 
				?>
                	<script type="text/javascript">
                    	window.parent.errorMessage("File was not uploaded.");
                    </script>
                <?php
			break;
			
			case 3: 
				?>
                	<script type="text/javascript">
                    	window.parent.errorMessage("Error uploading file, please try again");
                    </script>
                <?php
			break;				
		}
	}
	else
	{
		if(insert_main_post($postinput, $Level) == 0)
		{
			?>
            <script type="text/javascript">
				window.parent.loadNewMPost();
				window.parent.clear_fileinput();
            </script>
            <?php	
		}
	}		
}
?>