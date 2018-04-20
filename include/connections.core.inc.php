<?php
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED); 	
/*
	respone 0 -  connection request has been sent
	respone 1 -  connection has already been sent
	respone 2 -  a member send you a request + I sent a request = connected
	respone 3 -  no connection request exist or it has expired
	
	$MEM1 = To Member
	$MEM2 = From Member
	*/

	function connection_suggestions_fetch()
	{
		include 'config.php';
		//include 'core.inc.php';

		$MyConnection = array();
		$OtherConnection = array();

		$MyConnection = getMemberConnections($_SESSION['SessionMemberID']);

		foreach ($MyConnection as $myfriends) {
			foreach (getMemberConnections($myfriends) as $OC) {
				$OtherConnection[] = $OC;
			}
		}

		//array_unique($MyConnection);

		$OtherConnection = array_unique($OtherConnection);


		//print count($OtherConnection);

		for($i = 1; $i < count($OtherConnection); $i++)
		{
                      if(!check_connection_request_status($_SESSION['SessionMemberID'], $OtherConnection[$i]) == 1 && $OtherConnection[$i] != $_SESSION['SessionMemberID'] && $OtherConnection[$i] != "" && Check_Connection_Suggestions_Exist($OtherConnection[$i]) == 0)
                      {
			 connection_suggestion_insert($OtherConnection[$i]);
		      }
		}
		
	}

	function connection_suggestion_hide($OtherMemberId)
	{
		include 'config.php';
		$sql = mysqli_query($db_con, "update member_connection_suggestion set vStatus = 0 where ToMemberid = '".$_SESSION['SessionMemberID']."' && FromMemberid = '$OtherMemberId'");
	}

	function connection_suggestion_insert($OtherMemberId)
	{
		include 'config.php';
		$sql = mysqli_query($db_con, "INSERT INTO `member_connection_suggestion` (`id`, `ToMemberid`, `FromMemberid`, `vStatus`) VALUES (NULL,'".$_SESSION['SessionMemberID']."','$OtherMemberId','1')");
	}

	function Check_Connection_Suggestions_Exist($OtherMemberId)
	{
		include 'config.php';
		$sql = mysqli_query($db_con, "select * from member_connection_suggestion where ToMemberid = '".$_SESSION['SessionMemberID']."' && FromMemberid = '$OtherMemberId'");

		return mysqli_num_rows($sql);
	}

	function getConnectionSuggestions()
	{
		include 'config.php';
		$sql = mysqli_query($db_con, "select * from member_connection_suggestion where ToMemberid = '".$_SESSION['SessionMemberID']."' && vStatus = '1'");

		while($c = mysqli_fetch_array($sql))
		{
			$OC = $c['FromMemberid'];
			?>
			<table id="connection<?php echo $OC; ?>" class="connection_style">
		            <tr style="">
		            	<td style="width:10%;" class="connection_style_img">
		                	<img width="128" src="<?php echo MemberMainProfilePic($OC); ?>" style="border-radius:10%; width:80px; height: 80px;" />
		                </td>
		                <td class="connection_style_info" style="font-family:Arial; text-align:center; font-size:20px; font-weight:bold; float:left; color:black;">
		                	<div id="connection<?php echo $OC; ?>" style="font-size: 14px;">
		                		<?php echo MemberFullName($OC); ?>
		                	</div>
		               		<div align="center" style="font-size: 14px; margin-top: 10px;">
		               			<?php 
		               				if(check_connection_request_status($OC, $_SESSION['SessionMemberID']) == 1)
									{
										?><button id="connection_btn<?php echo $OC; ?>" onClick="">Connection Pending</button><?php
									}

		               				if(check_connection_request_status($OC, $_SESSION['SessionMemberID']) == 0)
									{
										?><a href="#">Not Connected</a>&nbsp;&nbsp;<button id="connection_btn<?php echo $OC; ?>" onClick="send_connection_request(<?php echo $OC; ?>);">Add Connection</button><?php
									}
		               			?>
		               		</div>
		                </td>
		                <td>
		                	<button onclick="connection_suggestion_hide_box(<?php echo $OC; ?>);"" style="background-color: red; font-size: 13px; width: 25px; height: 25px;">
		                		x
		                	</button>
		                </td>
		            </tr>
		            </table>
			<?php
		}
	}

	function delete_connection($MEM1, $MEM2)
	{
		include "config.php";
		mysqli_query($db_con, "delete from member_connection where ToMemberid = '$MEM1' && FromMemberid = '$MEM2'");
		
		mysqli_query($db_con, "delete from member_connection where ToMemberid = '$MEM2' && FromMemberid = '$MEM1'");
		
		echo 0;
	}
	
	function getRequestid($MEM1, $MEM2)
	{
		include "config.php";
		//include "core.inc.php";
		
		$sql = mysqli_query($db_con, "select * from member_connection where ToMemberid = '$MEM1' && FromMemberid = '$MEM2'");
		
		if(mysqli_num_rows($sql) > 0)
		{
			while($r = mysql_fetch_array($sql))
			{
				return $r['id'];	
			}	
		}	
	}
	
	function check_connection_request_status($MEM1, $MEM2)
	{
		include "config.php";
		
		$sql = mysqli_query($db_con, "select * from member_connection where ToMemberid = '$MEM1' && FromMemberid = '$MEM2'");
		
		if(mysqli_num_rows($sql) > 0)
		{
			$sql1 = mysqli_query($db_con, "select * from member_connection where ToMemberid = '$MEM2' && FromMemberid = '$MEM1'");
			if(mysqli_num_rows($sql1) > 0)
			{
				return 2;
			}
			else
			{
				return 1;	
			}
			
		}
		else
		{
			return 0;	
		}
	}
	
	function add_connection($MEM1, $MEM2)
	{
		include "config.php";
		if(check_connection_request_status($MEM1, $MEM2) == 0)
		{
			$sql = mysqli_query($db_con, "insert into member_connection (`id`, `ToMemberid`, `FromMemberid`, `isConfirm`, `Status`) values(NULL, '$MEM1', '$MEM2', '1', '0')");	
			return 1;	
		}
	}
	
	function block_connection($MEM1, $MEM2)
	{
		include "config.php";
		include "core.inc.php";
	}
	
	function accept_connection_request($MEM1, $MEM2)
	{
		include "config.php";
		//include "core.inc.php";
		
		//$GetRequestedID = getRequestid($MEM2, $MEM1);
		
		$sql = mysqli_query($db_con, "update member_connection set isConfirm = '2' where ToMemberid = '$MEM2' && FromMemberid = '$MEM1'");
		$sql2 = mysqli_query($db_con, "insert into member_connection (`id`, `ToMemberid`, `FromMemberid`, `isConfirm`, `Status`) values(NULL, '$MEM1', '$MEM2', '2', '0')");
		
		return 2;	
		
	}
	
	function cancel_connection_request($MEM1, $MEM2)
	{
		include "config.php";
		//include "core.inc.php";	
		
		mysqli_query($db_con, "delete from member_connection where ToMemberid = '$MEM1' && FromMemberid = '$MEM2'");
		
		sleep(1);
		
		mysqli_query($db_con, "delete from member_connection where ToMemberid = '$MEM2' && FromMemberid = '$MEM1'");
	}
	
	function getConnectionsRequestCount()
	{
		include 'config.php';
		
		$sql = mysqli_query($db_con, "select * from member_connection where toMemberid = '".$_SESSION['SessionMemberID']."' && isConfirm = '1'");
		return mysqli_num_rows($sql);	
	}
	
	function getMemberConnections($id)
	{
		include 'config.php';
		$connections = array();
		
		$sql = mysqli_query($db_con, "select * from member_connection where FromMemberid = '$id' && isConfirm = '2'");
		
		if(mysqli_num_rows($sql) > 0)
		{
			while($d = mysqli_fetch_array($sql))
			{
				$ToMemberid = $d['ToMemberid'];
				
				if($ToMemberid != $id)
				{
					$connections[] = $ToMemberid;					
				}	
			}
		}
		
		return $connections;
	}
?>