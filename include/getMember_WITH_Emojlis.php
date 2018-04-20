<?php 
include 'post.inc.php';

if(isset($_POST['wallid']) && $_POST['wallid'] != '' && isset($_POST['e']) && $_POST['e'] !='')
{
	getSelectedEmojli_Header($_POST['wallid']);	
	getMember_WITH_SELECTED_Emojlis($_POST['wallid'], $_POST['e']);		
}
else
{
	getSelectedEmojli_Header($_POST['wallid']);	
	getMember_WITH_Emojlis($_POST['wallid']);
}
?>