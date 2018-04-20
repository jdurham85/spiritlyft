<?php 
session_start();
include 'config.php';
include 'core.inc.php';
?>
<script type="text/javascript">
function delete_connection(memid, memfullname)
{
	if(confirm("Are you sure you want remove connection with "+memfullname+" ?"))
	{
		$.post("include/delete_connection.php",{memid: memid}, function(status){
			if(status == 0)
			{
				$("#connection"+memid).fadeOut('fast', function(){$(this).remove()});
			}
		});
	}
}
</script>

<div class="connection_box">
<?php
		
		$members = mysqli_query($db_con, "select * from member_connection");
		
		while($m = mysqli_fetch_array($members))
		{
			$TOMemberid = $m['ToMemberid'];
			$FromMemberid = $m['FromMemberid'];
			$isConfirm = $m['isConfirm'];
			
			if($TOMemberid == $_POST['profileid'] && $isConfirm == "2")
			{
			?>
          
           	<table id="connection<?php echo $FromMemberid; ?>" class="connection_style">
            <tr style="">
            	<td style="width:20%;" class="connection_style_img">
                	<img width="128" src="<?php echo MemberMainProfilePic($FromMemberid); ?>" style="border-radius:10%; width:80px; height: 80px;" />
                </td>
                <td class="connection_style_info" style="font-family:Arial; text-align:center; font-size:20px; font-weight:bold; float:left; color:black;">
                	<div id="connection<?php echo $FromMemberid; ?>" style="">
                		<?php echo MemberFullName($FromMemberid); ?>
                	</div>
               		<table align="center">
               			<tr>
               				<td><a target="_parent" data-ajax="false" href="profile.php?profileid=<?php echo $FromMemberid; ?>"><button>View Profile</button></a></td>
               			</tr>
               			<tr>
               				<td></td>
               			</tr>
               		</table>
                </td>
            </tr>
            </table>
            <?php
			} //end if
		}//end while
?>
</div>