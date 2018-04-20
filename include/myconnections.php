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
			
			if($TOMemberid == $_SESSION['SessionMemberID'] && $isConfirm == "2" && $FromMemberid != $_SESSION['SessionMemberID'])
			{
			?>
          
           	<table id="connection<?php echo $FromMemberid; ?>" class="connection_style">
            <tr style="">
            	<td style="width:10%;" class="connection_style_img">
                	<img width="128" src="<?php echo MemberMainProfilePic($FromMemberid); ?>" style="border-radius:10%; width:80px; height: 80px;" />
                </td>
                <td class="connection_style_info" style="font-family:Arial; text-align:center; font-size:20px; font-weight:bold; float:left; color:black;">
                	<div id="connection<?php echo $FromMemberid; ?>" style="">
                		<?php echo MemberFullName($FromMemberid); ?>
                	</div>
               		<table align="center">
               			<tr>
               				<td><button onClick="private_chat_show_with_link('<?php echo $FromMemberid; ?>');">Private Chat</button></td>
               			</tr>
               			<tr>
               				<td><a target="_parent" data-ajax="false" href="profile.php?profileid=<?php echo $FromMemberid; ?>"><button>View Profile</button></a></td>
               			</tr>
               			<tr>
               				<td><a href="javascript:void(0);"><button onClick="delete_connection(<?php echo $FromMemberid . ", '" . MemberFullName($FromMemberid)."'"; ?>);">Delete Connection</button></a></td>
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