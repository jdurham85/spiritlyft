<?php 
session_start();
include 'core.inc.php';
include 'mail.inc.php';
date_default_timezone_set(getMemberTimezone($_SESSION['SessionMemberID']));

function five_day_alert()
{
	$mainmember = $_SESSION['SessionMemberID'];
	include '../config.php';
	$sql = mysqli_query($db_con, "select * from member_calendar where Memberid = '$mainmember' && Status = 3");
	
	if(mysqli_num_rows($sql) > 0)
	{
		while($a = mysqli_fetch_array($sql))
		{
			//$sql_explode = explode("/", $a['EventDate']);
			//$explode2 = explode("/", $date);
			
			//$sql_date = $a['EventDate'];
			//$sql_time = $a['Time'].$a['Period'];
			
			//if($sql_date == date("n/d/Y", strtotime("+5 days")) && $sql_time == date("h:iA"))
			//{ 
			$sql_date = $a['EventDate'];
			$sql_time = $a['Time'].$a['Period'];
			$sql_date_explode = explode("/", $sql_date);
			
			if($sql_date == date("n/j/Y", strtotime("+5 days")) && $sql_time == date("h:iA"))
			{
				$message = "Five Day Reminder \r\n".$a['EventTitle'] . "\r\n" . $a['EventDate'] . "\r\n" . $a['Time'] . $a['Period'];
				//send_text_message($mainmember, $message);
				//send_Calender_AlertEmail($mainmember, "Five Day Alert", $sql_date . "  " .$sql_time, $a['EventTitle']);
				?>
                <table>
                	<caption>5 Day Reminder</caption>
					<tr id="eventtitle1">
						<td>
							<?php echo $a['EventTitle']; ?><br><br>
						</td>
					</tr>

					<tr id="eventdate1">
						<td>
							<?php echo $a['EventDate'] . "  " . $a['Time'] . $a['Period']; ?>
						</td>
					</tr>
					<tr>
						<td>
							<button onClick="event_reminder_close();">Confirm</button>
						</td>
					</tr>
                </table>
                <?php	
				
				mysqli_query($db_con, "update member_calendar set Status = 2 where Memberid = '$mainmember'");
			}
			if($sql_date_explode[0] == date("n") && ($sql_date_explode[0]) < (date("j", strtotime("+5 days"))) && $sql_date_explode[0] == date("Y"))
			{
				mysqli_query($db_con, "update member_calendar set Status = 2 where Memberid = '$mainmember'");
			}
		}	
	}
}

function two_day_alert()
{
	$mainmember = $_SESSION['SessionMemberID'];
	include '../config.php';
	$sql = mysqli_query($db_con, "select * from member_calendar where Memberid = '$mainmember' && Status = 2");
	
	if(mysqli_num_rows($sql) > 0)
	{
		while($a = mysqli_fetch_array($sql))
		{
			//$sql_explode = explode("/", $a['EventDate']);
			//$explode2 = explode("/", $date);
			
			//$sql_date = $a['EventDate'];
			//$sql_time = $a['Time'].$a['Period'];
			
			//if($sql_date == date("n/d/Y", strtotime("+2 days")) && $sql_time == date("h:iA"))
			//{
				$sql_date = $a['EventDate'];
				$sql_time = $a['Time'].$a['Period'];
				$sql_date_explode = explode("/", $sql_date);

				if($sql_date == date("n/j/Y", strtotime("+2 days")) && $sql_time == date("h:iA"))
				{
					$message = "Two Day Reminder \r\n".$a['EventTitle'] . "\r\n" . $a['EventDate'] . "\r\n" . $a['Time'] . $a['Period'];
					send_text_message($mainmember, $message);
					send_Calender_AlertEmail($mainmember, "Two Day Alert", $sql_date . "  " .$sql_time, $a['EventTitle']);
					?>
					<table>
						<caption>2 Day Reminder</caption>
						<tr id="eventtitle1">
							<td>
								<?php echo $a['EventTitle']; ?><br><br>
							</td>
						</tr>

						<tr id="eventdate1">
							<td>
								<?php echo $a['EventDate'] . "  " . $a['Time'] . $a['Period']; ?>
							</td>
						</tr>
						<tr>
							<td>
								<button onClick="event_reminder_close();">Confirm</button>
							</td>
						</tr>
					</table>
					<?php	

					mysqli_query($db_con, "update member_calendar set Status = 1 where Memberid = '$mainmember'");
				}
				if($sql_date_explode[0] == date("n") && ($sql_date_explode[0]) < (date("j", strtotime("+2 days"))) && $sql_date_explode[0] == date("Y"))
				{
					mysqli_query($db_con, "update member_calendar set Status = 1 where Memberid = '$mainmember'");
				}
		}
		
			
	}
}

function today_alert()
{
	$mainmember = $_SESSION['SessionMemberID'];
	include '../config.php';
	$sql = mysqli_query($db_con, "select * from member_calendar where Memberid = '$mainmember' && Status = 1");
	
	if(mysqli_num_rows($sql) > 0)
	{
		while($a = mysqli_fetch_array($sql))
		{
			$sql_date = $a['EventDate'];
			$sql_eventtitle = $a['EventTitle'];
			$sql_time = $a['Time'].$a['Period'];
			$sql_date_explode = explode("/", $sql_date);
			
			if($sql_date == date("n/j/Y") && $sql_time == date("h:iA"))
			{
				$message = "Today Reminder \r\n".$a['EventTitle'] . "\r\n" . $a['EventDate'] . "\r\n" . $a['Time'] . $a['Period'];
				send_text_message($mainmember, $message);
				send_Calender_AlertEmail($mainmember, "Today Alert <br>", $sql_date . " <br> " .$sql_time, $a['EventTitle']);
				?>
                 <table>
                	<caption>Today Reminder</caption>
					<tr id="eventtitle1">
						<td>
							<?php echo $a['EventTitle']; ?><br><br>
						</td>
					</tr>
					<tr id="eventdate1">
						<td>
							<?php echo $a['EventDate'] . "  " . $a['Time'] . $a['Period']; ?>
						</td>
					</tr>
					<tr>
						<td>
							<button onClick="event_reminder_close();">Confirm</button>
						</td>
					</tr>
                </table>
                <?php	
				mysqli_query($db_con, "update member_calendar set Status = 0 where Memberid = '$mainmember'");	
			} //elseif($sql_explode[1] < $explode2[1]){ mysqli_query($db_con, "update member_calendar set Status = 1 where Memberid = '$mainmember'");}
		}
		
	}	
}

function check_member_notification()
{
	include '../config.php';
	$sql = mysqli_query($db_con, "select * from member_notification where toMember = '".$_SESSION['SessionMemberID']."' order by id desc");
	
	?>
    <!--div id="notification_bar" class="dropdown"-->
    <?php
	
	if(mysqli_num_rows($sql) > 0)
	{
		while($n = mysqli_fetch_array($sql))
		{
			//Member Post
			if($n['Mode'] == 0)
			{
				?>
                	<table class="member_notification" id="member_notification<?php echo $n['id']; ?>"  style="">
                   	 	<tr>
                   	 		<td>
                   	 			<img src="<?php echo MemberMainProfilePic($n['fromMember']); ?>" style="width:64px; float:left;" />
                   	 		</td>
                   	 		<td align="center">
                   	 			<div style="font-family:Arial;"><strong><?php echo MemberFullName($n['fromMember']); ?></strong>
                     				has added a new post.
                    	 		</div>
                   	 		</td>
                   	 		<td align="center">
								<a target="_parent" href="home.php?showwall=<?php echo base64_encode($n['Wallid']) . "&id=" . base64_encode($n['id']); ?>">
									<button>View Post</button>
								</a>
                  	 			<button onClick="Notification_Delete(<?php echo $n['id']; ?>);">Delete</button>
                   	 		</td>
                   	 	</tr>
                    </table>
                    
            	<?php	
			}

			//Member Wall Comment
			if($n['Mode'] == 1)
			{
				?>
                	<table class="member_notification" id="member_notification<?php echo $n['id']; ?>"  style="">
                   	 	<tr>
                   	 		<td>
                   	 			<img src="<?php echo MemberMainProfilePic($n['fromMember']); ?>" style="width:64px; float:left;" />
                   	 		</td>
                   	 		<td align="center">
                   	 			<div style="font-family:Arial;"><strong><?php echo MemberFullName($n['fromMember']); ?></strong>
                     				has replied to your post. 
                    	 		</div>
                   	 		</td>
                   	 		<td align="center">
								<a target="_parent" href="home.php?showwall=<?php echo base64_encode($n['Wallid']) . "&id=" . base64_encode($n['id']); ?>">
									<button>View Post</button>
								</a>
                  	 			<button onClick="Notification_Delete(<?php echo $n['id']; ?>);">Delete</button>
                   	 		</td>
                   	 	</tr>
                    </table>
                    
            	<?php	
			}

			//Member Wall Comment Sub
			if($n['Mode'] == 2)
			{
				?>
                	<table class="member_notification" id="member_notification<?php echo $n['id']; ?>"  style="">
                   	 	<tr>
                   	 		<td>
                   	 			<img src="<?php echo MemberMainProfilePic($n['fromMember']); ?>" style="width:64px; float:left;" />
                   	 		</td>
                   	 		<td align="center">
                   	 			<div style="font-family:Arial;"><strong><?php echo MemberFullName($n['fromMember']); ?></strong>
                     				has replied back. 
                    	 		</div>
                   	 		</td>
                   	 		<td align="center">
								<a target="_parent" href="home.php?showwall=<?php echo base64_encode($n['Wallid']) . "&id=" . base64_encode($n['id']); ?>">
									<button>View Post</button>
								</a>
                  	 			<button onClick="Notification_Delete(<?php echo $n['id']; ?>);">Delete</button>
                   	 		</td>
                   	 	</tr>
                    </table>
                    
            	<?php	
			}
			
			//Recived Gift
			if($n['Mode'] == 3)
			{
				?>
                	<table class="member_notification" id="member_notification<?php echo $n['id']; ?>"  style="">
                   	 <tr>
                   	 	<td>
                   	 		<img src="<?php echo MemberMainProfilePic($n['fromMember']); ?>" style="width:64px;" />
                   	 	</td>
                   	 	<td align="center">
                   	 		<div style=" font-family:Arial;"><strong><?php echo MemberFullName($n['fromMember']); ?></strong>
                     			has sent you a gift. 
                    	 	</div>
                   	 	</td>
                   	 	<td>
                   	 		<a target="_parent" href="mygift.php">
								<button>View My Gift</button>
							</a>
                   	 		<button onClick="Notification_Delete(<?php echo $n['id']; ?>);">Delete</button>
                   	 	</td>
                   	 </tr>
					</table>
                    
            	<?php	
			}
			
			//Member New Post
			if($n['Mode'] == 4)
			{
				?>
                	<table class="member_notification" id="member_notification<?php echo $n['id']; ?>"  style="">
                    	<tr>
                    		<td>
                    			<img src="<?php echo MemberMainProfilePic($n['fromMember']); ?>" style="width:64px; float:left;" />
                    		</td>
                    		<td align="center">
                    			<div style="font-family:Arial;"><strong><?php echo MemberFullName($n['fromMember']); ?></strong>
                     				has added a new post. 
                    	 		</div>
                    		</td>
                    		<td>
                    			<a target="_parent" href="home.php?showwall=<?php echo base64_encode($n['Wallid']) . "&id=" . base64_encode($n['id']); ?>">
									<button>View Post</button>
                   				</a>
                    			<button onClick="Notification_Delete(<?php echo $n['id']; ?>);">Delete</button>
                    		</td>
                    	</tr>
						<!--button onClick="show_wall(<?php //echo $n['Wallid'] .",". $n['id']; ?>);">View Post</button-->
                    </table>
                    
            	<?php	
			}
			
			//Member New Picture
			if($n['Mode'] == 5)
			{
				?>
                	<table class="member_notification" id="member_notification<?php echo $n['id']; ?>"  style="">
                   		<tr>
                   			<td>
                   				<img src="<?php echo MemberMainProfilePic($n['fromMember']); ?>" style="width:64px; float:left;" />
                   			</td>
                   			<td align="center">
                   				 <div style=" font-family:Arial;"><strong><?php echo MemberFullName($n['fromMember']); ?></strong>
                     				has uploaded a new photo.
                    	 		 </div>
                   			</td>
                   			<td>
                   				<a target="_parent" href="gallery.php?profileid=<?php echo $n['fromMember']; ?>">
									<button>View Photo</button>
								</a>
                   				<button onClick="Notification_Delete(<?php echo $n['id']; ?>);">Delete</button>
                   			</td>
                   		</tr>
                    </table>
            	<?php	
			}
			
			//Member Reacted to post.
			if($n['Mode'] == 6)
			{
				?>
                	<table class="member_notification" id="member_notification<?php echo $n['id']; ?>"  style="">
                   		<tr>
                   			<td>
                   				<img src="<?php echo MemberMainProfilePic($n['fromMember']); ?>" style="width:64px; float:left;" />
                   			</td>
                   			<td align="center">
                   				 <div style=" font-family:Arial;"><strong><?php echo MemberFullName($n['fromMember']); ?></strong>
                     				has reacted to your post.
                    	 		 </div>
                   			</td>
                   			<td>
                   				<a target="_parent" href="home.php?showwall=<?php echo base64_encode($n['Wallid']) . "&id=" . base64_encode($n['id']); ?>">
									<button>View Post</button>
                   				</a>
                   				<button onClick="Notification_Delete(<?php echo $n['id']; ?>);">Delete</button>
                   			</td>
                   		</tr>
                    </table>
            	<?php	
			}

			//Member Connection Alert
			if($n['Mode'] == 7)
			{
				?>
                	<table class="member_notification" id="member_notification<?php echo $n['id']; ?>"  style="">
                   		<tr>
                   			<td>
                   				<img src="<?php echo MemberMainProfilePic($n['fromMember']); ?>" style="width:64px; float:left;" />
                   			</td>
                   			<td align="center">
                   				 <div style=" font-family:Arial;"><strong><?php echo MemberFullName($n['fromMember']); ?></strong>
                     				has sent you a Connection Request.
                    	 		 </div>
                   			</td>
                   			<td>
                   				<a target="_parent" href="community.php?mode=1">
									<button>My Friends & Family</button>
                   				</a>
                   				<button onClick="Notification_Delete(<?php echo $n['id']; ?>);">Delete</button>
                   			</td>
                   		</tr>
                    </table>
            	<?php	
			}

			//Zack (only) Connection Alert
			if($n['Mode'] == 8)
			{
				?>
                	<table class="member_notification" id="member_notification<?php echo $n['id']; ?>"  style="">
                   		<tr>
                   			<td>
                   				<img src="<?php echo MemberMainProfilePic($n['fromMember']); ?>" style="width:64px; float:left;" />
                   			</td>
                   			<td align="center">
                   				 <div style=" font-family:Arial;"><strong><?php echo MemberFullName($n['fromMember']); ?></strong>
                     				has signed up.
                    	 		 </div>
                   			</td>
                   			<td>
                   				<a target="_parent" href="profile.php?profileid=<?php echo $n['fromMember']; ?>">
									<button>View Profile</button>
								</a>
                   				<button onClick="Notification_Delete(<?php echo $n['id']; ?>);">Delete</button>
                   			</td>
                   		</tr>
                    </table>
            	<?php	
			}

			//Member Birthday
			if($n['Mode'] == 9)
			{
				?>
                	<table class="member_notification" id="member_notification<?php echo $n['id']; ?>"  style="">
                   		<tr>
                   			<td>
                   				<img src="<?php echo MemberMainProfilePic($n['fromMember']); ?>" style="width:64px; float:left;" />
                   			</td>
                   			<td align="center">
                   				 <div style=" font-family:Arial;">
                   				 	Today is <strong><?php echo " " . MemberFirstName($n['fromMember']) . " "; ?></strong> Birthday.
                    	 		 </div>
                   			</td>
                   			<td>
                   				<a target="_parent" href="profile.php?profileid=<?php echo $n['fromMember']; ?>">
									<button>View Profile</button>
								</a>
                   			</td>
                   			<td>
                   				<button onClick="Notification_Delete(<?php echo $n['id']; ?>);">Delete</button>
                   			</td>
                   			<td><img src="image/birthday_balloons.png" width="60" /></td>
                   		</tr>
                    </table>
            	<?php	
			}

			//Member Birthday Alert(Actual Member)
			if($n['Mode'] == 10)
			{
				?>
                	<table class="member_notification" id="member_notification<?php echo $n['id']; ?>"  style="">
                   		<tr>
                   			<td colspan="4" align="center"><img src="image/birthday-present.png" width="400" /></td>
                   		</tr>
                   		<tr>
                   			<td>
                   				<img src="<?php echo MemberMainProfilePic($n['fromMember']); ?>" style="width:64px; float:left;" />
                   			</td>
                   			<td align="center">
                   				 <div style=" font-family:Arial;">
                   				 	Happy Birthday <strong><?php echo " " . MemberFirstName($n['fromMember']) . " "; ?></strong> 
                    	 		 </div>
                   			</td>
                   			<td>
                   				<a target="_parent" href="profile.php?profileid=<?php echo $n['fromMember']; ?>">
									<button>View Profile</button>
								</a>
                   			</td>
                   			<td>
                   				<button onClick="Notification_Delete(<?php echo $n['id']; ?>);">Delete</button>
                   			</td>
                   		</tr>
                    </table>
            	<?php	
			}
		}
	}
	else
	{
		echo "<div align='center' style='font-size: 21px; font-family:Arial;'><strong>Nothing Available Here.</strong></div>";	
	}	
	
	?>
    <!--/div-->
    <?php
}

function get_notification_alerts()
{
	include '../config.php';
	$sql = mysqli_query($db_con, "select * from member_notification where toMember = '".$_SESSION['SessionMemberID']."' && vStatus = 1");
	return mysqli_num_rows($sql);
}

function reset_notification_alerts()
{
	include '../config.php';
	$sql = mysqli_query($db_con, "update member_notification set vStatus = 0 where toMember = '".$_SESSION['SessionMemberID']."'");
	return 0;
}

function Notification_Delete($id)
{
	include '../config.php';
	$sql = mysqli_query($db_con, "delete from member_notification where id = '$id'");
	return 0;
}
?>