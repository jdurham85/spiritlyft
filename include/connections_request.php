<?php 
session_start();
include 'config.php';
include 'core.inc.php';
?>
<script type="text/javascript">
	function accept_connection_request(mem1){
		$.post("include/accept_connection_request.php", {mem1: mem1}, function(result){

					document.getElementById("connection_btn"+mem1).innerHTML = "Connected";	
					document.getElementById("connection_btn"+mem1).setAttribute("OnClick", "");
					
					document.getElementById("cancel_connection_btn"+mem1).hidden = true;
			});	

		setTimeout(function(){
						window.location = window.location;
					}, 3000);
	}
	
	function cancel_connection_request(mem1)
	{
		$.post("include/cancel_connection_request.php", {mem1: mem1}, function(result){

					document.getElementById("connection_btn"+mem1).innerHTML = "Connection Request Cancel";	
					//document.getElementById("connection_btn"+mem1).setAttribute("OnClick", "");
					
					document.getElementById("cancel_connection_btn"+mem1).hidden = true;

		});	

		setTimeout(function(){
						window.location = window.location;
					}, 1000);
	
	}

</script>
<div class="connection_box">
<?php
		
		$members = mysqli_query($db_con, "select * from member_connection where ToMemberid = '".$_SESSION['SessionMemberID']."' && isConfirm = 1") or die(mysqli_error($db_con));
		
		if(mysqli_num_rows($members) > 0)
		{
			while($m = mysqli_fetch_array($members))
			{
				$TOMemberid = $m['ToMemberid'];
				$FromMemberid = $m['FromMemberid'];
				$isConfirm = $m['isConfirm'];
				
				//if($TOMemberid == $_SESSION['SessionMemberID'] && $isConfirm == "1")
				//{
				?>
	           <table class="connection_style">
	            <tr>
	            	<td class="connection_style_img">
	                	<img width="128" src="<?php echo MemberMainProfilePic($FromMemberid); ?>" style="border-radius:10%; width:80px;" />
	                </td>
	                <td class="connection_style_info" style="font-family:Arial;">
	                	<?php echo MemberFullName($FromMemberid); ?><br>
	                    
	                </td>
	                <td>
						<button id="connection_btn<?php echo $FromMemberid;?>" onClick="accept_connection_request(<?php echo $FromMemberid; ?>);">Accept</button>
	                </td>
	                <td>
	                	<button id="cancel_connection_btn<?php echo $FromMemberid; ?>" onClick="cancel_connection_request(<?php echo $FromMemberid; ?>);">Cancel</button>
	                </td>
	            </tr>
	            </table><br />
	            <?php
				//} //end if
			}//end while
		}
		else
		{
			?>
				<table style="width: 100%; text-align: center; font-family: Arial; font-size: 12px;" class="">
		            <tr>
		            	<td class="">
		                	Their are no Connection Request available.
		                </td>
		            </tr>
	            </table>
			<?php
		}
?>
</div>