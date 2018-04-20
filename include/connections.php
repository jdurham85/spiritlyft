<?php
session_start();
include "../config.php";
include "core.inc.php";
include 'connections.core.inc.php';
$mode = 0;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
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
	
	function cancel_connection_request(mem1)
	{
		
	}
	
	function cancel_connection(mem1)
	{
			
	}
</script>
<?php
switch($mode)
{
	case 0:
		$members = mysqli_query($db_con, "select * from member");
		
		$MemberID = '';
		$Firstname = '';
		$Lastname = '';
		$Gender = '';
		$Email = '';
		
		while($m = mysqli_fetch_array($members))
		{
			$MemberID = $m['Memberid'];
			$Firstname = $m['First'];
			$Lastname = $m['Last'];
			$Gender = $m['Gender'];
			
			if($_SESSION['SessionMemberID'] != $MemberID)
			{
			?>
           <table class="connection_style">
            <tr>
            	<td style="width:10;" class="connection_style_img">
                	<img src="<?php echo MemberMainProfilePic($MemberID); ?>" style="border-radius:5%; width:80px;" />
                </td>
                <td class="connection_style_info" style="font-family:Arial; text-align:center; font-size:20px; font-weight:bold; float:left; color:black; margin-top:25px; padding-left:15px;">
                	<?php echo MemberFullName($MemberID); ?><br>
                    <?php  
						if(check_connection_request_status($MemberID, $_SESSION['SessionMemberID']) == 1)
						{
							?><button id="connection_btn<?php echo $MemberID; ?>" onClick="">Connection Pending</button><?php
						}
						
						if(check_connection_request_status($MemberID, $_SESSION['SessionMemberID']) == 2)
						{
							?><a href="#">Connected</a><?php
						}
 
						
						if(check_connection_request_status($MemberID, $_SESSION['SessionMemberID']) == 0)
						{
							?><a href="#">Not Connected</a>&nbsp;&nbsp;<button id="connection_btn<?php echo $MemberID; ?>" onClick="send_connection_request(<?php echo $MemberID; ?>)">Add Connection</button><?php
						}
					?>
                </td>
            </tr>
            </table><br />
            <?php
			} //end if
		}//end while
	break;
	
	case 1:
	
	break;	
}
?>