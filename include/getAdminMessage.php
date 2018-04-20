<?php
session_start();
include 'config.php';

$sql = mysqli_query($db_con, "select * from admin_message where Memberid = '".$_SESSION['SessionMemberID']."' && vShow = 1 limit 1");

while($am = mysqli_fetch_array($sql))
{
	?>
		<table id="admin_messagetb<?php echo $am['id'] ?>">
			<td align="center" width="100%">
				SpiritLyft,<br>
				<strong><?php echo $am['Message'] ?></strong>
			</td>
			<td align="center">
				<button style="padding:6px 6px 6px 6px; color:white; border:none; background-color: #4A338E; font-weight: bold; border-radius: 6px;" onClick="close_admin_box(<?php echo $am['id']; ?>);">Close</button>
			</td>
		</table>
	<?php
}
?>