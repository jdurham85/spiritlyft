<?php 
//session_start();
/*
	0 - Message was succesfully sent
	1 - Message was not seccesully sent
	2 - MYSQL ERROR
*/

function getMessages($fromMember)
{
	include 'config.php';
	
	$TOMember = $_SESSION['SessionMemberID'];
	
	$sql = mysqli_query($db_con, "select * from chat_tbl order by id asc ");	
	if(mysqli_num_rows($sql) > 0)
	{
		while($d = mysqli_fetch_array($sql))
		{
			$MEM1 = $d['toMemberid'];
			$MEM2 = $d['fromMemberid'];
			$Mess = $d['Message'];
			
			if($MEM1 == $_SESSION['SessionMemberID']  && $MEM2 == $fromMember)
			{
				?>
				<div id="chatbubble2">
					 <strong><?php echo MemberFullName($MEM2); ?></strong><br>
					 <?php echo $Mess; ?>
				</div>
				<?php		
			}
			elseif($MEM2 == $_SESSION['SessionMemberID'] && $MEM1 == $fromMember)
			{
				?>
				<div id="chatbubble1">
					 <strong><?php echo MemberFullName($MEM2); ?></strong><br>
					 <?php echo $Mess; ?>
				</div>
				<?php		
			}
		}
	}
}

function getUpdatedMessages($fromMember)
{
	include 'config.php';
	$TOMember = $_SESSION['SessionMemberID'];
	$id = '';
	
	$sql = mysqli_query($db_con, "select * from chat_tbl where toMemberid = '$TOMember' && fromMemberid = '$fromMember' && vShow = '1' order by id asc");
	
	if(mysqli_num_rows($sql) > 0)
	{
		while($d = mysqli_fetch_array($sql))
		{
			$id = $d['id'];
			$MEM1 = $d['toMemberid'];
			$MEM2 = $d['fromMemberid'];
			$Mess = $d['Message'];
			
			
			
			if($MEM1 == $_SESSION['SessionMemberID']  && $MEM2 == $fromMember)
			{
				?>
				<div id="chatbubble2">
					 <strong><?php echo MemberFullName($MEM2); ?></strong><br>
					 <?php echo $Mess; ?>
				</div>
				<?php
                $sql_update = mysqli_query($db_con, "update chat_tbl set vShow = '0' where id = '$id'");
				break;	
			}	
		}
	}	
}

function set_myconnectionpanel()
{	 
	foreach(getMemberConnections($_SESSION['SessionMemberID']) as $MyConnections)
	{
	?>
	<script>
		setInterval(function(){member_message_alert(<?php echo $MyConnections; ?>);}, 1000);
	</script>
    <input type="hidden" id="memFullName<?php echo $MyConnections; ?>" value="<?php echo MemberFullName($MyConnections); ?>"/>
	<div id="mb<?php echo $MyConnections; ?>" style="height: 50px; font-size: 12px;" class="member_btn" onClick="select_member(<?php echo $MyConnections; ?>);" style="width:100%; font-weight:bold; text-align:center;">
                <table>
                	<tr>
                		<td align="center" width="10%">
                			<img width="32" src="<?php echo MemberMainProfilePic($MyConnections); ?>" style="border-radius:50%; width: 32px; height: 32px;" />
                		</td>
                		<td align="center" width="80%">
                			<?php echo MemberFullName($MyConnections); ?>
                		</td>
                		<td align="center" width="10%">
                			<div class="member_message_alert" id="member_message_alert<?php echo $MyConnections; ?>" style="float: left;"></div>
                		</td>
                	</tr>
                </table>
        </div>
	<?php	
	}
}

function set_sidepanel_mobile()
{
	?>
	<tr>
		<td>
			Select a Member:
		</td>
	</tr>
	<?php
	
	foreach(getMemberConnections($_SESSION['SessionMemberID']) as $MyConnections)
	{
	?>
   <tr>
   	<td>
   	<script>
		setInterval(function(){member_message_alert(<?php echo $MyConnections; ?>);}, 1000);
	</script>
		<button id="mb<?php echo $MyConnections; ?>" class="member_btn" onClick="select_member(<?php echo $MyConnections; ?>);" style="width:100%; font-weight:bold; text-align:center;">
					<table>
                	<tr>
                		<td align="center" width="10%">
                			<img width="32" src="<?php echo MemberMainProfilePic($MyConnections); ?>" style="border-radius:50%;" />
                		</td>
                		<td align="center" width="80%">
                			<?php echo MemberFullName($MyConnections); ?>
                		</td>
                		<td align="center" width="10%">
                			<div class="member_message_alert" id="member_message_alert<?php echo $MyConnections; ?>" style="float: left;"></div>
                		</td>
                	</tr>
                </table>
		</button>
   	</td>
   </tr>
    
	<?php	
	}
}

function set_chatpanel($id)
{
	?>
   			 <div id="chat_header">
            	<div id="member_fullname_lb"><?php echo MemberFullName($id); ?></div>
                <input type="hidden" id="mem1" name="mem1" value="<?php echo $id; ?>" />
            </div>
            <div id="chat_body">
            	<?php 
					echo getMessages($id);
				?>
            </div>
            <div id="chat_footer">
            	<textarea id="chatbox_txt_input" name="chatbox_txt_input" onKeyPress="keypress(event);" style="width:80%; font-family:Arial; float:left; padding:8px 8px 8px 8px;"></textarea>
                <button id="chatbox_enter_btn" onClick="sendMessage();">Enter</button>
            </div>
    <?php	
}


function set_chatpanel_mobile($id)
{
	//session_start();
	
	?>
   			 <div id="chat_header">
                <table width="100%">
                	<tr>
                		<td>
                			<div id="member_fullname_lb"><?php echo MemberFullName($id); ?></div>
                			<input type="hidden" id="mem1" name="mem1" value="<?php echo $id; ?>" />
                		</td>
                		<td>
                			<button onClick="close_panel();" style="float:right;">Close</button>
                		</td>
                	</tr>
                </table>
            </div>
            <div id="chat_body" style="overflow-y: auto;">
            	<?php 
					echo getMessages($id);
				?>
            </div>
            <div id="chat_footer">
            	<input type="text" id="chatbox_txt_input" name="chatbox_txt_input" style="width:80%; font-family:Arial; border:1px black solid; float:left; padding:8px 8px 8px 8px;"/>
                <button id="chatbox_enter_btn" onClick="sendMessage();">Enter</button>
            </div>
    <?php	
}

function getMessageAlerts_from_Member($toMember, $fromMember)
{
	include 'config.php';
	
	$sql = mysqli_query($db_con,  "select * from chat_tbl where toMemberid = '$toMember' && fromMemberid = '$fromMember' && vShow = '1'");
	
	return mysqli_num_rows($sql);		
}

function getMessageAlerts($Memberid)
{
	include 'config.php';
	
	$sql = mysqli_query($db_con,  "select * from chat_tbl where toMemberid = '$Memberid' && vShow = '1'");
	
	return mysqli_num_rows($sql);	
}

function resetMessageAlerts($OtherMemberID)
{
	include 'config.php';	
	$sql = mysqli_query($db_con, "update chat_tbl set vShow = '0' where toMemberid = '".$_SESSION['SessionMemberID']."' && fromMemberid = '$OtherMemberID'");	
}

function pauseAlert1($id)
{
		
}

function setMessageSeen($id)
{
		
}

function sendMessage($TOMember, $FromMember, $Message)
{
	include 'config.php';
	include 'core.inc.php';
	
	//$Message = addcslashes($Message);
	
	$sql = mysqli_query($db_con, "insert into chat_tbl (`id`, `toMemberid`, `fromMemberid`, `Message`, `vStatus`, `vShow`) values (NULL, '$TOMember', '$FromMember', '$Message', '1', '1')");
	
	//if($sql)
	//{
		?>
        <div id="chatbubble1">
        	 <strong><?php echo MemberFullName($FromMember); ?></strong><br>
             <?php echo $Message; ?>
       	</div>
        <?php	
	//}
}

?>