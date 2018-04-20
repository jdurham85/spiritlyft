<?php 
session_start();
if($_POST['captcha'] == $_SESSION["code"])
{
	echo 1;	
}
else
{
	echo 0;	
}
?>