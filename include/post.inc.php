<?php 
session_start();
include 'core.inc.php';
include 'connections.core.inc.php';

class WideImage_Operation_ExifOrient
{
  /**
   * Rotates and mirrors and image properly based on current orientation value
   *
   * @param WideImage_Image $img
   * @param int $orientation
   * @return WideImage_Image
   */
  function execute($img, $orientation)
  {
    switch ($orientation) {
      case 2:
        return $img->mirror();
        break;

      case 3:
        return $img->rotate(180);
        break;

      case 4:
        return $img->rotate(180)->mirror();
        break;

      case 5:
        return $img->rotate(90)->mirror();
        break;

      case 6:
        return $img->rotate(90);
        break;

      case 7:
        return $img->rotate(-90)->mirror();
        break;

      case 8:
        return $img->rotate(-90);
        break;

      default: return $img->copy();
    }
  }
}

function getWallCommentTotal($Wallid)
{
	include 'config.php';
	$sql = mysqli_query($db_con, "select * from wall_comment where Wallid = '$Wallid'");
	
	return "Comment " . mysqli_num_rows($sql);
}

function getNewestPost($oldWall = array())
{
	include 'config.php';

	$MainMember  = $_SESSION['SessionMemberID'];
	
	//$sql = mysqli_query($db_con, "select * from wall order by Wallid desc Limit 5");
	$sql = mysqli_query($db_con, "select * from wall order by Wallid desc Limit 20");
	
	while($w = mysqli_fetch_array($sql))
	{
		$memberid = $w['Memberid'];
		$wallid = $w['Wallid'];
		$parentid = $w['Parentid'];
		$description = $w['Description'];
		$filetype = $w['Filetype'];
		$filename = $w['Filename'];
		$postedon = $w['PostedOn'];
		$mode = $w['Mode'];
		
		if(hidden_wall_exist($parentid, $_SESSION['SessionMemberID'], $wallid) == 0 && in_array($memberid, getMemberConnections($MainMember)) || $parentid == $MainMember || $memberid == $MainMember && !in_array($wallid, $oldWall))
		{
		?>
        <table class="post_panel" id="post_panel<?php echo $wallid; ?>">
			<?php 
				echo getWallHeader($memberid, $wallid, $parentid, $postedon); 
				echo getWallBody($memberid, $wallid, $description, $parentid, $filetype, $filename); 
				echo getWallFooter($parentid, $memberid, $wallid, $mode); 
			?>
		</table>
        <?php
		}//end if
	}
}

//START WALLBODY FUNCTION
function getWallHeader($memberid, $wallid, $parentid, $postedon)
{
	?>
	<tr id="post_header<?php echo $wallid; ?>">
		<?php
			if($parentid == $_SESSION['SessionMemberID'])
			{
				?>
				<td class="ph1" align="center" width="10%">
					<a href="myprofile.php"  target="_parent"><img src="<?php echo MemberMainProfilePic($parentid); ?>" style="width: 40px;" /></a>
				</td>
				<td class="ph2"  width="90%">
					<a href="myprofile.php"  target="_parent" style="text-decoration: none; color:black; font-weight: bold; float: left;  margin-top: 1px;">
						<?php echo MemberFullName($parentid);?><div style="font-size: 11px; color: gray;"><?php echo $postedon; ?></div>
					</a>
					
					<button style="float: right;"  id="delete_btn'.$wallid.'" onClick="deleteWall('<?php echo $wallid; ?>');">Delete</button> 
				</td>
				<?php
			}
			else
			{
				?>
					<td class="ph1" align="center" width="10%"><div class="upper_header"><?php //echo MemberFullName($memberid) . " is sharing " . MemberFullName($parentid) . " post."; ?></div>
						<a href="profile.php?profileid=<?php echo $parentid; ?>"  target="_parent">
							<img src="<?php echo MemberMainProfilePic($parentid); ?>" style="width: 40px;" />
						</a>
					</td>
					<td class="ph2" width="90%">
						<a style="text-decoration: none; color:black; font-weight: bold; float: left; margin-top: 1px;" href="profile.php?profileid=<?php echo $parentid; ?>"  target="_parent">
							<?php echo MemberFullName($parentid);?><div style="font-size: 11px; color: gray;"><?php echo $postedon; ?></div>
						</a>
						
						<button style="float: right;" onClick="hideWall(<?php echo $parentid; ?>, <?php echo $wallid; ?>);">Hide</button>
					</td>
				<?php
			}
		?>
	</tr>
	<?php
}

function getWallBody($memberid, $wallid, $description, $parentid, $filetype, $filename)
{
	?>
	<tr id="post_body<?php echo $wallid; ?>">
		<td colspan="2">
			<?php 
				include 'config.php';
				$Post_Image = array();
				$image_count = getPostImage_count($wallid);
				if($filetype == 'Image')
				{
					//echo '<img src="profile/images/'.$parentid.'/'.$filename.'" width="100%" height="auto%" style="text-align:center;" />';
					
					if($image_count > 0)
					{
						$Post_Image = getPostImage($wallid);
												
						echo '<img id="wall_img'.$wallid.'" src="profile/images/'.$parentid.'/'.$Post_Image[0].'" style="text-align:center; width: 100%;" />';
					}
				}

				if($filetype == 'Video')
				{
					?>
					  <div class="flowplayer" data-swf="profile/videos/flowplayerhls.swf" data-ratio="0.4167" style="">
						  <video controls width="100%">
							 <source type="video/mp4" src="profile/videos/<?php echo $parentid . "/" . $filename; ?>">
						  </video>
						  <a href="javascript:void(0);" class="post_fullscreenbtn" id="post_fullscreenbtn<?php echo $wallid; ?>" style="left: 0; margin-left: 4px; font-weight: bold; text-decoration: none; position: absolute; color:black; font-size: 12px;" onClick="slideshow_show(<?php echo $wallid; ?>);">View FullScreen</a>
					  </div>
					  <!--video width="100%" controls>
						  <source src="profile/videos/<?php //echo $parentid . "/" . $filename; ?>" type="video/mp4">
						Your browser does not support the video tag.
					  </video-->
					<?php	
				}
			?>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center">
			<?php 
				//$Post_Image = getPostImage($wallid);
				$image_total = 0;
				if($image_count > 0)
					{										
						?>
						<a href="javascript:void(0);" class="post_fullscreenbtn" id="post_fullscreenbtn<?php echo $wallid; ?>" style="left: 0; margin-left: 4px; font-weight: bold; text-decoration: none; position: absolute; color:black; font-size: 12px;" onClick="slideshow_show(<?php echo $wallid; ?>);">View FullScreen</a>
						<script type="text/javascript">
							var walltrack<?php echo $wallid; ?> = 0;
							var wall_image<?php echo $wallid; ?> = [<?php for($i=0;$i<$image_count;$i++)
							{
								if($i < $image_count - 1)
								{
									echo "'$Post_Image[$i]'" . ',';
								}
								else
								{
									echo "'$Post_Image[$i]'";
								}
								
								//echo $i . "<br>";
							}
							?>];
							
							walltrack<?php echo $wallid; ?> = 0;
							
							function goback<?php echo $wallid; ?>()
							{
								walltrack<?php echo $wallid; ?>--;
								if(walltrack<?php echo $wallid; ?> < 0)
								{
									walltrack<?php echo $wallid; ?> = wall_image<?php echo $wallid; ?>.length - 1;
								}
								
								$("#wall_img<?php echo $wallid; ?>").attr("src", "profile/images/<?php echo $parentid ?>/"+wall_image<?php echo $wallid; ?>[walltrack<?php echo $wallid; ?>]);

							}
							
							function goforward<?php echo $wallid; ?>()
							{
								walltrack<?php echo $wallid; ?>++;
								if(walltrack<?php echo $wallid; ?> > wall_image<?php echo $wallid; ?>.length - 1)
								{
									walltrack<?php echo $wallid; ?> = 0;
									
									$("#wall_img<?php echo $wallid; ?>").attr("src", "profile/images/<?php echo $parentid ?>/"+wall_image<?php echo $wallid; ?>[walltrack<?php echo $wallid; ?>]);
								}
								else
								{
									$("#wall_img<?php echo $wallid; ?>").attr("src", "profile/images/<?php echo $parentid ?>/"+wall_image<?php echo $wallid; ?>[walltrack<?php echo $wallid; ?>]);
								}
							}
						</script>
						<?php
					}
					
					if($image_count >= 2)
					{
						?>
						<button onClick="goback<?php echo $wallid; ?>();"  style="padding:6px 6px 6px 6px; border-radius: 2px;  border:none; background-color: #795FC5; font-weight: bold; color:white;">Back</button>
						<button onClick="goforward<?php echo $wallid; ?>();" style="padding:6px 6px 6px 6px; border-radius: 2px; border:none; background-color: #795FC5; font-weight: bold; color:white;">Next</button>
						<?php
					}
			?>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<div id="post_textview"><?php echo $description; ?></div>
		</td>
	</tr>
	<?php
}

function getWallFooter($parentid, $memberid, $wallid, $level)
{
	?>
	<tr id="post_footer<?php echo $wallid; ?>" onmouseleave="wall_btn_mouseleave(<?php echo $wallid; ?>);">
		<td colspan="2" class="upper_footer" id="upper_footer<?php echo $wallid; ?>">
			<div class="emojli_container" id="emojli_container<?php echo $wallid; ?>" align="center">
            	<table align="center" onMouseOut="" cellpadding="3" cellspacing="5" style="width:100%;" onmouseleave="wall_btn_mouseleave(<?php echo $wallid; ?>);">
                    <tr>
                        <td align="center" onClick="like_wall(<?php echo $wallid; ?>, 0);">
                            <img src="image/coolemoji.png" style="width:30px;" /><br>
                            Cool
                        </td>
                        <td align="center" onClick="like_wall(<?php echo $wallid; ?>, 1);">
                            <img src="image/heartbeat_emoji.png" style="width:30px;" /><br>
                            Love
                        </td>
                        <td align="center" onClick="like_wall(<?php echo $wallid; ?>, 2);">
                            <img src="image/laughing_emojli.png" style="width:30px;" /><br>
                            Laughing
                        </td>
                        <td align="center" onClick="like_wall(<?php echo $wallid; ?>, 3);">
                            <img src="image/sademojli.png" style="width:30px;" /><br>
                            Sad
                        </td>
                        <td align="center" onClick="like_wall(<?php echo $wallid; ?>, 4);">
                            <img src="image/confusedemojli.png" style="width:30px;" /><br>
                            Confused
                        </td>
                        <td align="center" onClick="emojli_container_hide(<?php echo $wallid; ?>);">
                            <img src="image/button-cancel-800px.png" style="width:30px;" /><br>
                            Exit
                        </td>
                    </tr>
                </table>
			</div>
           </td>
	</tr>
            <tr id="post_footer<?php echo $wallid; ?>" class="upper_footer">
				<td colspan="2">
					<?php 
					if(getLikeWall($wallid) > 0)
					{
						echo '<button class="like_btn" id="like_btn'.$wallid.'" onClick="unlike_wall('.$wallid.');">'.getSelectedEmojlis($wallid).'</button>';		
					}
					else
					{
						echo '<button class="like_btn" id="like_btn'.$wallid.'" onClick="emojli_container_show('.$wallid.');">React</button>';		
					}
					?>
					<button style="margin-left:10px;" onClick="WallComment_txt_focus(<?php echo $wallid; ?>)">Comment</button>
					<?php 
						  if(getWall_Level($wallid, $memberid) > 0) //Public = 0, Private = 1
						  {
							  if(!checkShared_Wall($parentid, $memberid) == 0)
							  {
								  echo '<button style="float:right;" id="share_btn'.$wallid.'" onclick="share_wall_show('.$wallid.');">Share</button>';
							  }
							  else
							  {
								  echo '<button style="float:right:" id="share_btn'.$wallid.'" onclick="unshare_wall('.$wallid.');">Shared</button>';
							  }
						  }
					  ?>

					  <div class="share_wall_panel" id="share_wall_panel<?php echo $wallid; ?>">
						  <div class="share_wall_panel_btn" onClick="share_wall(<?php echo $wallid; ?>, 0);">Share (Public)</div>
						  <div class="share_wall_panel_btn" onClick="share_wall(<?php echo $wallid; ?>, 1);">Share (Private)</div>
					  </div>
				</td>
         	</tr>
		<tr class="middle_footer" id="middle_footer<?php echo $wallid; ?>">
			<td id="wall_total_likes<?php echo $wallid; ?>" colspan="2" style="border-bottom: 1px black solid;">
				<?php echo getTotalEmojlies($wallid); ?>
				<!--a id="wall_comment_total<?php //echo $wallid; ?>" href="javascript:void(0);"><?php //echo getWallCommentTotal($wallid); ?></a-->
			</td>
		</tr>
		<tr class="lower_footer" id="lower_footer<?php echo $wallid; ?>">
			<td id="lower_footer_td<?php echo $wallid; ?>" colspan="2">
				<?php echo getWallComment($wallid); ?>
			</td>
		</tr>
	<?php
}

//END WALL BODY FUNCTION

function auto_update_post($Wallid, $Mode, $WallElements)
{
	/*
		Mode 1 = WallComment
		Mode 2 = WallComment_SUB
	*/
	include 'config.php';
	
	switch($Mode)
	{
		case 1:
		{
              $sql = mysqli_query($db_con, "SELECT * FROM `wall_comment` WHERE Wallid = '$Wallid'");
			   while($wc = mysqli_fetch_array($sql)) 
			   {
				   	$wallcomment_id = $wc['id'];
				   	$WALLID = $wc['Wallid'];
					$Memberid = $wc['Memberid'];
					$Description = $wc['Description'];
				   if(!in_array($wallcomment_id, $WallElements))
				   {
					?>
                    	<table class="wallcomment_header" id="wallcomment<?php echo $wallcomment_id; ?>" style="background-color:white; width: 100%;">
                        	<tr>
                        		<td width="8%" align="center" style="al">
                        			<a target="_parent" href="profile.php?profileid=<?php echo $Memberid; ?>" style="">
                                    	<img src="<?php echo MemberMainProfilePic($Memberid); ?>" style="width: 32px;" />
									</a>
                        		</td>
                        		<td width="92%" colspan="2">
                        			
										<div style="float: left; width: 100%;">
                    						<a target="_parent" href="profile.php?profileid=<?php echo $Memberid; ?>" style="text-decoration: none; color:black; font-size: 12px;">
                    							<?php echo "<strong>" . MemberFullName($Memberid) . "</strong>";?>
                    						</a>
                     						<span style="margin-left: 6px;"><?php echo $Description; ?></span>
                     					</div>
                      				<div style="width:100%;">
                      					<div>
                      						<a style="text-decoration: none; float: left; font-weight:bold; color:#795FC5; font-size: 12px;" href="javascript:void(0);" onClick="wallcomment_sub_inputbox_show(<?php echo $wallcomment_id; ?>);">Respond</a>
                      					</div>
                      					<div>
                      						<?php
												if($MainMember == $Memberid)
												{
													echo "<a href='javascript:void(0);' style='text-decoration: none; color:black; padding:4px 4px 4px 4px; font-weight:bold; font-size: 12px;' onClick='WallComment_Delete(".$wallcomment_id.",".$WALLID.");'>Delete</a>";	   
												}
											?>
                      					</div>
                      				</div>
                        		</td>
                        	</tr>
							<tr>
								<td>

								</td>
								<td class="Wallcomment_sub" id="wallcomment_subtb<?php echo $Wallid; ?>">
									<?php //echo getWallcomment_sub($wallcomment_id); ?>
								</td>
							</tr>
                       		<tr>
                       			<td></td>
                       			<td colspan="">
                       				<table cellpadding="1" cellspacing="0"  class="wallcomment_sub_inputbox" id="wallcomment_sub_inputbox<?php echo $wallcomment_id; ?>" style="width:100%; float:right; font-size:13px;" align="center">
                                    <tr>
                                        <td align="center">
                                            <img src="<?php echo MemberMainProfilePic($_SESSION['SessionMemberID']); ?>" style="width: 40px;" />
                                        </td>
                                        <td>
                                          <input class="wallcomment_sub_txt" type="text" placeholder="" id="wallcomment_sub_txt<?php echo $wallcomment_id; ?>" name="wallcomment_sub_txt<?php echo $wallcomment_id; ?>" onKeyUp="return WallComment_sub_Insert(<?php echo $WALLID; ?>, event, <?php echo $wallcomment_id; ?>);" style="width:100%;" />
                                        </td>
                                    </tr>
                        			</table> 
                       			</td>
                       		</tr>
                        </table>
                    <?php
				   }
			   }
			break;
		}
		
		case 2:
		{
			$sql = mysqli_query($db_con, "SELECT * FROM `wall_comment_sub` WHERE Wallid = '$Wallid'");
				
			//die(var_dump($WallElements));
		
			while($wc = mysqli_fetch_array($sql)) 
			{
				$id = $wc['id'];
				$WALLID = $wc['Wallid'];
				$wallcomment_id = $wc['WallCommentid'];
				$Memberid = $wc['Memberid'];
				$Description = $wc['Description'];
				if(!in_array($wallcomment_id, $WallElements))
				{
				?>
				<table cellspacing="0" cellpadding="0" style="width:100%; border-left: 1px black solid; float:right; padding-top: 10px; font-size:12px;"  id="Wallcomment_sub<?php echo $id; ?>">
					<tr>
						<td width="10%">
							<a target="_parent" href="profile.php?profileid=<?php echo $Memberid; ?>"><img src="<?php echo MemberMainProfilePic($Memberid); ?>" style="width: 25px;" /></a>
						</td>
						<td width="90%">
							<a target="_parent" href="profile.php?profileid=<?php echo $Memberid; ?>" style="text-decoration: none; color:black; font-size: 12px;"><?php 
								echo "<strong>" . MemberFullName($Memberid) . "</strong>";?></a><?php
								if($_SESSION['SessionMemberID'] == $Memberid)
								{
									//echo "<a style='text-decoration: none; font-weight: bold; color:black; font-size: 12px; float:right;' href='javascript:void(0);'  onClick='WallComment_sub_Delete(".$id.");'>Delete</a>";	   
								}
								?>
							<span style="margin-left: 6px;"><?php echo $Description; ?></span>

						</td>
				   </tr>
				   <tr>
						<td></td>
						<td>
							<table id="" cellpadding="0" cellspacing="0" style="width:100%;">
								<tr>
									<td>
										<div>
											<a style="text-decoration: none; font-weight: bold; float: left; color:#795FC5; font-size: 12px;" href="javascript:void(0);" onClick="wallcomment_sub_inputbox_show(<?php echo $wallcomment_id; ?>);">Respond</a>
										</div>
										<div>
										<?php 
										if($_SESSION['SessionMemberID'] == $Memberid)
										{
											echo "<a style='text-decoration: none; font-weight: bold; float:left; color:black; margin-left:5px; font-size: 12px;' href='javascript:void(0);'  onClick='WallComment_sub_Delete(".$id.");'>Delete</a>";	   
										}
										?></div>
									</td>
								</tr>
							</table>
					  </td>
					</tr> 
				</table>
				<?php
				}
			}
			break;
		}
	}
}

function getPostImage_count($Wallid)
{
	include 'config.php';
	$sql = mysqli_query($db_con, "select * from wall_image where Wallid = '$Wallid'");
	
	$count = 0;
	
	while($c = mysqli_fetch_array($sql))
	{
		$count++;
	}
	
	return $count;
}

function getPostImage($Wallid)
{
	$image_array = array();
	
	include 'config.php';
	
	$sql = mysqli_query($db_con, "select * from wall_image where Wallid = '$Wallid'");
	if(mysqli_num_rows($sql) > 0)
	{
		while($i = mysqli_fetch_array($sql))
		{
			$image_array[] = $i['Filename'];
		}
	}
	//die(count($image_array));
	return $image_array;
}

function UpdatePost($Wallid)
{
	include 'config.php';
	$MainMember  = $_SESSION['SessionMemberID'];
	
	//$sql = mysqli_query($db_con, "select * from wall order by Wallid desc Limit 5");
	$sql = mysqli_query($db_con, "select * from wall where Wallid = '$Wallid'");
	
	while($w = mysqli_fetch_array($sql))
	{
		$memberid = $w['Memberid'];
		$wallid = $w['Wallid'];
		$parentid = $w['Parentid'];
		$description = $w['Description'];
		$filetype = $w['Filetype'];
		$filename = $w['Filename'];
		$postedon = $w['PostedOn'];
		$mode = $w['Mode'];
		
		?>
        <table class="post_panel" id="post_panel<?php echo $wallid; ?>">
			<?php 
				echo getWallHeader($memberid, $wallid, $parentid, $postedon); 
				echo getWallBody($memberid, $wallid, $description, $parentid, $filetype, $filename); 
				echo getWallFooter($parentid, $memberid, $wallid, $mode); 
			?>
		</table>
        <?php
	}
}

function getHeaderDescription($Wallid)
{
	include 'config.php';
	$MainMember  = $_SESSION['SessionMemberID'];
	
	$sql = mysqli_query($db_con, "select * from wall where Wallid = '$Wallid'");
	
	while($w = mysqli_fetch_array($sql))
	{
		$memberid = $w['Memberid'];
		$wallid = $w['Wallid'];
		$parentid = $w['Parentid'];
		$description = $w['Description'];
		$filetype = $w['Filetype'];
		$filename = $w['Filename'];
		$postedon = $w['PostedOn'];
		$level = $w['Level'];
		
		//if($memberid == getMemberConnections($MainMember) || $parentid == $MainMember)
		//{
		?>
        <table class="post_panel" id="post_panel<?php echo $wallid; ?>">
            <tr id="post_header">
                <td align="left">
                	<strong><?php echo MemberFullName($memberid);?></strong>
                	<button onClick="thisclose();" style="background-color:#930205; font-weight:bold; float:right; font-family:Arial Black; font-size:14px; padding:8px 8px 8px 8px;">Close</button>
                </td>
            </tr>
            <?php 
				echo getWallBody($memberid, $wallid, $description, $parentid,$filetype, $filename);
				echo getWallFooter($parentid, $memberid, $wallid, $level);
			?>
        </table>
        <?php
		//}end if
	}	
}

function WallComment_Delete($WallCommentID)
{
	include 'config.php';
	$sql = mysqli_query($db_con, "delete from wall_comment where id = '$WallCommentID'");
	$sql = mysqli_query($db_con, "delete from wall_comment_sub where WallCommentid = '$WallCommentID'");
	return 0;	
}

function WallCommentsub_Delete($WallCommentsubID)
{
	include 'config.php';
	$sql = mysqli_query($db_con, "delete from wall_comment_sub where id = '$WallCommentsubID'");	
	return 0;
}

function getMWallComment($Wallid)
{
	include 'config.php';
	$MainMember = $_SESSION['SessionMemberID'];
	?>
    	<!--div class="" style="background-color:#F7F5FB;" id="post_panel<?php //echo $Wallid; ?>" style="background-color:white; width: 100%;"-->
			<?php
              $sql = mysqli_query($db_con, "SELECT * FROM `wall_comment` WHERE Wallid = '$Wallid' order by id desc Limit 1");
			   while($wc = mysqli_fetch_array($sql)) 
			   {
				    $wallcomment_id = $wc['id'];
					$WALLID = $wc['Wallid'];
					$Memberid = $wc['Memberid'];
					$Description = $wc['Description'];
					?> 
                    	<table class="wallcomment_header" id="wallcomment<?php echo $wallcomment_id; ?>" style="background-color:white; width: 100%;">
                        	<tr>
                        		<td colspan="2">
                        		<div class="wallcomment_emojli_container" onmouseleave="wallcomment_emojli_container_hide(<?php echo $wallcomment_id; ?>);" id="wallcomment_emojli_container<?php echo $wallcomment_id; ?>" align="center">
					            	<table align="center" cellpadding="3" cellspacing="5" style="width:100%;" onmouseleave="wall_btn_mouseleave(<?php echo $wallid; ?>);">
					                    <tr>
					                        <td align="center" onClick="wallcomment_like(<?php echo $wallcomment_id; ?>, 0);">
					                            <img src="image/coolemoji.png" style="width:20px;" /><br>
					                            Cool
					                        </td>
					                        <td align="center" onClick="wallcomment_like(<?php echo $wallcomment_id; ?>, 1);">
					                            <img src="image/heartbeat_emoji.png" style="width:20px;" /><br>
					                            Love
					                        </td>
					                        <td align="center" onClick="wallcomment_like(<?php echo $wallcomment_id; ?>, 2);">
					                            <img src="image/laughing_emojli.png" style="width:20px;" /><br>
					                            Laughing
					                        </td>
					                        <td align="center" onClick="wallcomment_like(<?php echo $wallcomment_id; ?>, 3);">
					                            <img src="image/sademojli.png" style="width:20px;" /><br>
					                            Sad
					                        </td>
					                        <td align="center" onClick="wallcomment_like(<?php echo $wallcomment_id; ?>, 4);">
					                            <img src="image/confusedemojli.png" style="width:20px;" /><br>
					                            Confused
					                        </td>
					                        <td align="center" onClick="wallcomment_emojli_container_hide(<?php echo $wallcomment_id; ?>);">
					                            <img src="image/button-cancel-800px.png" style="width:20px;" /><br>
					                            Exit
					                        </td>
					                    </tr>
					                </table>
								</div>
                        		</td>
                        	</tr>
                        	<tr>
                        		<td width="8%" align="center" style="al">
                        			<a target="_parent" href="profile.php?profileid=<?php echo $Memberid; ?>" style="">
                                    	<img src="<?php echo MemberMainProfilePic($Memberid); ?>" style="width: 32px;" />
									</a>
                        		</td>
                        		<td width="92%" colspan="2">
                        				
										<div style="float: left; width: 100%;">
                    						<a target="_parent" href="profile.php?profileid=<?php echo $Memberid; ?>" style="text-decoration: none; color:black; font-size: 12px;">
                    							<?php echo "<strong>" . MemberFullName($Memberid) . "</strong>";?>
                    						</a>
                     						<span style="margin-left: 6px;"><?php echo $Description; ?></span>
                     					</div>
                      				<div style="width:100%;">
                      					<div>
                      						<a style="text-decoration: none; float: left; font-weight:bold; color:#795FC5; font-size: 12px;" href="javascript:void(0);" onClick="wallcomment_sub_inputbox_show(<?php echo $wallcomment_id; ?>);">Respond</a>
                      					</div>
                      					<div>
                      						<?php
												if($MainMember == $Memberid)
												{
													echo "<a href='javascript:void(0);' style='text-decoration: none; color:black; padding:4px 4px 4px 4px; font-weight:bold; font-size: 12px;' onClick='WallComment_Delete(".$wallcomment_id.",".$WALLID.");'>Delete</a>";	   
												}
												?>
													
												<?php

												if(getLikeWall_Comment($wallcomment_id) > 0)
												{
													//getWall_Comment_SelectedEmojlis
													?>
														<a id="wallcomment_like_wall_btn<?php echo $wallcomment_id; ?>" onClick="wallcomment_unlike(<?php echo $wallcomment_id; ?>);"; href="javascript:void(0);" style="text-decoration: none; float: left; font-weight:bold; color:#795FC5; font-size: 12px; margin-left: 5px;"><?php echo getWall_Comment_SelectedEmojlis($wallcomment_id); ?></a>
													<?php
												}
												else
												{
													?>
													<a id="wallcomment_like_wall_btn<?php echo $wallcomment_id; ?>" onClick="wallcomment_like_wall(<?php echo $wallcomment_id; ?>);"; href="javascript:void(0);" style="text-decoration: none; float: left; font-weight:bold; color:#795FC5; font-size: 12px; margin-left: 5px;">React</a>
													<?php
												}
											?>
                      					</div>
                      					<div id="wall_comment_total_likes<?php echo $wallcomment_id; ?>">
                      						<?php echo getWallCommentTotalEmojlies($wallcomment_id); ?>
                      					</div>
                      				</div>
                        		</td>
                        	</tr>
							<tr>
								<td>

								</td>
								<td>
									<?php echo getWallcomment_sub($wallcomment_id); ?>
								</td>
							</tr>
                       		<tr>
                       			<td></td>
                       			<td colspan="">
                       				<table cellpadding="1" cellspacing="0"  class="wallcomment_sub_inputbox" id="wallcomment_sub_inputbox<?php echo $wallcomment_id; ?>" style="width:100%; float:right; font-size:13px;" align="center">
                                    <tr>
                                        <td align="center">
                                            <img src="<?php echo MemberMainProfilePic($_SESSION['SessionMemberID']); ?>" style="width: 40px;" />
                                        </td>
                                        <td>
                                          <input class="wallcomment_sub_txt" type="text" placeholder="" id="wallcomment_sub_txt<?php echo $wallcomment_id; ?>" name="wallcomment_sub_txt<?php echo $wallcomment_id; ?>" onKeyUp="return WallComment_sub_Insert(<?php echo $WALLID; ?>, event, <?php echo $wallcomment_id; ?>);" style="width:100%;" />
                                        </td>
                                    </tr>
                        			</table> 
                       			</td>
                       		</tr>
                        </table>
                        <!--/div-->
                    <?php
			   }
			   ?>
               <?php
}

function getWallComment($Wallid)
{
	include 'config.php';
	$MainMember = $_SESSION['SessionMemberID'];
	?>
    	<!--div class="" id="post_panel<?php //echo $Wallid; ?>" style="background-color:white; padding-top:5px; width: 100%;"-->
			<?php
               $sql = mysqli_query($db_con, "SELECT * FROM `wall_comment` WHERE Wallid = '$Wallid'");
			   while($wc = mysqli_fetch_array($sql)) 
			   {
				   	$wallcomment_id = $wc['id'];
				   	$WALLID = $wc['Wallid'];
					$Memberid = $wc['Memberid'];
					$Description = $wc['Description'];
					?>
                    	<table class="wallcomment_header" id="wallcomment<?php echo $wallcomment_id; ?>" style="background-color:white; width: 100%;">
                        	<tr>
                        		<td colspan="2">
                        		<div class="wallcomment_emojli_container" onmouseleave="wallcomment_emojli_container_hide(<?php echo $wallcomment_id; ?>);" id="wallcomment_emojli_container<?php echo $wallcomment_id; ?>" align="center">
					            	<table align="center" cellpadding="3" cellspacing="5" style="width:100%;" onmouseleave="wall_btn_mouseleave(<?php echo $wallid; ?>);">
					                    <tr>
					                        <td align="center" onClick="wallcomment_like(<?php echo $wallcomment_id; ?>, 0);">
					                            <img src="image/coolemoji.png" style="width:20px;" /><br>
					                            Cool
					                        </td>
					                        <td align="center" onClick="wallcomment_like(<?php echo $wallcomment_id; ?>, 1);">
					                            <img src="image/heartbeat_emoji.png" style="width:20px;" /><br>
					                            Love
					                        </td>
					                        <td align="center" onClick="wallcomment_like(<?php echo $wallcomment_id; ?>, 2);">
					                            <img src="image/laughing_emojli.png" style="width:20px;" /><br>
					                            Laughing
					                        </td>
					                        <td align="center" onClick="wallcomment_like(<?php echo $wallcomment_id; ?>, 3);">
					                            <img src="image/sademojli.png" style="width:20px;" /><br>
					                            Sad
					                        </td>
					                        <td align="center" onClick="wallcomment_like(<?php echo $wallcomment_id; ?>, 4);">
					                            <img src="image/confusedemojli.png" style="width:20px;" /><br>
					                            Confused
					                        </td>
					                        <td align="center" onClick="wallcomment_emojli_container_hide(<?php echo $wallcomment_id; ?>);">
					                            <img src="image/button-cancel-800px.png" style="width:20px;" /><br>
					                            Exit
					                        </td>
					                    </tr>
					                </table>
								</div>
                        		</td>
                        	</tr>
                        	<tr>
                        		<td width="8%" align="center" style="al">
                        			<a target="_parent" href="profile.php?profileid=<?php echo $Memberid; ?>" style="">
                                    	<img src="<?php echo MemberMainProfilePic($Memberid); ?>" style="width: 32px;" />
									</a>
                        		</td>
                        		<td width="92%" colspan="2">
                        				
										<div style="float: left; width: 100%;">
                    						<a target="_parent" href="profile.php?profileid=<?php echo $Memberid; ?>" style="text-decoration: none; color:black; font-size: 12px;">
                    							<?php echo "<strong>" . MemberFullName($Memberid) . "</strong>";?>
                    						</a>
                     						<span style="margin-left: 6px;"><?php echo $Description; ?></span>
                     					</div>
                      				<div style="width:100%;">
                      					<div>
                      						<a style="text-decoration: none; float: left; font-weight:bold; color:#795FC5; font-size: 12px;" href="javascript:void(0);" onClick="wallcomment_sub_inputbox_show(<?php echo $wallcomment_id; ?>);">Respond</a>
                      					</div>
                      					<div>
                      						<?php
												if($MainMember == $Memberid)
												{
													echo "<a href='javascript:void(0);' style='text-decoration: none; color:black; padding:4px 4px 4px 4px; font-weight:bold; font-size: 12px;' onClick='WallComment_Delete(".$wallcomment_id.",".$WALLID.");'>Delete</a>";	   
												}
												?>
													
												<?php

												if(getLikeWall_Comment($wallcomment_id) > 0)
												{
													//getWall_Comment_SelectedEmojlis
													?>
														<a id="wallcomment_like_wall_btn<?php echo $wallcomment_id; ?>" onClick="wallcomment_unlike(<?php echo $wallcomment_id; ?>);"; href="javascript:void(0);" style="text-decoration: none; float: left; font-weight:bold; color:#795FC5; font-size: 12px; margin-left: 5px;"><?php echo getWall_Comment_SelectedEmojlis($wallcomment_id); ?></a>
													<?php
												}
												else
												{
													?>
													<a id="wallcomment_like_wall_btn<?php echo $wallcomment_id; ?>" onClick="wallcomment_like_wall(<?php echo $wallcomment_id; ?>);"; href="javascript:void(0);" style="text-decoration: none; float: left; font-weight:bold; color:#795FC5; font-size: 12px; margin-left: 5px;">React</a>
													<?php
												}
											?>
                      					</div>
                      					<div id="wall_comment_total_likes<?php echo $wallcomment_id; ?>">
                      						<?php echo getWallCommentTotalEmojlies($wallcomment_id); ?>
                      					</div>
                      				</div>
                        		</td>
                        	</tr>
							<tr>
								<td>

								</td>
								<td>
									<?php echo getWallcomment_sub($wallcomment_id); ?>
								</td>
							</tr>
                       		<tr>
                       			<td></td>
                       			<td colspan="">
                       				<table cellpadding="1" cellspacing="0"  class="wallcomment_sub_inputbox" id="wallcomment_sub_inputbox<?php echo $wallcomment_id; ?>" style="width:100%; float:right; font-size:13px;" align="center">
                                    <tr>
                                        <td align="center">
                                            <img src="<?php echo MemberMainProfilePic($_SESSION['SessionMemberID']); ?>" style="width: 40px;" />
                                        </td>
                                        <td>
                                          <input class="wallcomment_sub_txt" type="text" placeholder="" id="wallcomment_sub_txt<?php echo $wallcomment_id; ?>" name="wallcomment_sub_txt<?php echo $wallcomment_id; ?>" onKeyUp="return WallComment_sub_Insert(<?php echo $WALLID; ?>, event, <?php echo $wallcomment_id; ?>);" style="width:100%;" />
                                        </td>
                                    </tr>
                        			</table> 
                       			</td>
                       		</tr>
                        </table>
                    <?php
			   }
            ?>
            <table class="wallcomment_inputbox" id="wallcomment_inputbox<?php echo $Wallid; ?>">
            	<tr>
                	<td width="10%">
                    	<img src="<?php echo MemberMainProfilePic($MainMember); ?>" style="width: 32px; float:left;" />
                    </td>
                    <td width="90%">
                    	<input type="text" placeholder="Type comment here..." id="wallcomment_txt<?php echo $Wallid; ?>" name="wallcomment_txt<?php echo $Wallid; ?>" onKeyPress="return WallComment_Insert(event, <?php echo $Wallid; ?>);" />
                    </td>
                </tr>
            </table>
    	<!--/div-->
    <?php
}

function InsertWallComment_sub($Wallid, $WallCommentid, $Description)
{
	include 'config.php';
	
	$PostedOn = date("M, d Y");
	
	$MainMember = $_SESSION['SessionMemberID'];
	
	$sql = mysqli_query($db_con, "INSERT INTO `wall_comment_sub`(`id`, `Wallid`, `WallCommentid`, `Memberid`, `Description`, `Filetype`, `Filename`, `PostedOn`) VALUES (NULL, '$Wallid', '$WallCommentid', '$MainMember', '$Description', NULL, NULL, '$PostedOn')") or die(mysqli_error($db_con));
}

function getWallcomment_sub($WallCommentid)
{
	include 'config.php';
	$sql = mysqli_query($db_con, "SELECT * FROM `wall_comment_sub` WHERE WallCommentid = '$WallCommentid'");
	while($wc = mysqli_fetch_array($sql)) 
	{
		$id = $wc['id'];
		$WALLID = $wc['Wallid'];
		$wallcomment_id= $wc['WallCommentid'];
		$Memberid = $wc['Memberid'];
		$Description = $wc['Description'];
		?>
        <table cellspacing="0" cellpadding="0" style="width:100%; border-left: 1px black solid; float:right; padding-top: 10px; font-size:12px;" id="Wallcomment_sub<?php echo $id; ?>">
            <tr>
                <td width="10%">
					<a target="_parent" href="profile.php?profileid=<?php echo $Memberid; ?>"><img src="<?php echo MemberMainProfilePic($Memberid); ?>" style="width: 25px;" /></a>
                </td>
                <td width="90%">
                	<a target="_parent" href="profile.php?profileid=<?php echo $Memberid; ?>" style="text-decoration: none; color:black; font-size: 12px;"><?php 
						echo "<strong>" . MemberFullName($Memberid) . "</strong>";?></a><?php
						if($_SESSION['SessionMemberID'] == $Memberid)
						{
							//echo "<a style='text-decoration: none; font-weight: bold; color:black; font-size: 12px; float:right;' href='javascript:void(0);'  onClick='WallComment_sub_Delete(".$id.");'>Delete</a>";	   
						}
						?>
              		<span style="margin-left: 6px;"><?php echo $Description; ?></span>
               		
                </td>
           </tr>
           <tr>
                <td></td>
                <td>
                    <table class="Wallcomment_sub" id="wallcomment_sub_tb<?php echo $wallcomment_id; ?>" cellpadding="0" cellspacing="0" style="width:100%;">
                        <tr>
                            <td>
                                <div>
                                	<a style="text-decoration: none; font-weight: bold; float: left; color:#795FC5; font-size: 12px;" href="javascript:void(0);" onClick="wallcomment_sub_inputbox_show(<?php echo $wallcomment_id; ?>);">Respond</a>
                                </div>
                                <div>
                                <?php 
								if($_SESSION['SessionMemberID'] == $Memberid)
								{
									echo "<a style='text-decoration: none; font-weight: bold; float:left; color:black; margin-left:5px; font-size: 12px;' href='javascript:void(0);'  onClick='WallComment_sub_Delete(".$id.");'>Delete</a>";	   
								}
								?></div>
                            </td>
                        </tr>
                    </table>
              </td>
            </tr> 
        </table>
        <?php
	}
}

function getMWallcomment_sub($WallCommentid)
{
	include 'config.php';
	$sql = mysqli_query($db_con, "SELECT * FROM `wall_comment_sub` WHERE WallCommentid = '$WallCommentid' order by id desc limit 1");
	while($wc = mysqli_fetch_array($sql)) 
	{
		$id = $wc['id'];
		$WALLID = $wc['Wallid'];
		$wallcomment_id= $wc['WallCommentid'];
		$Memberid = $wc['Memberid'];
		$Description = $wc['Description'];
		?>
        <table cellspacing="0" cellpadding="0" style="width:100%; float:right; border-left: 1px black solid; padding-top: 10px; font-size:12px;" id="Wallcomment_sub<?php echo $id; ?>">
            <tr>
                <td width="10%">
					<a target="_parent" href="profile.php?profileid=<?php echo $Memberid; ?>"><img src="<?php echo MemberMainProfilePic($Memberid); ?>" style="width: 25px;" /></a>
                </td>
                <td width="90%">
                	<a target="_parent" href="profile.php?profileid=<?php echo $Memberid; ?>" style="text-decoration: none; color:black; font-size: 12px;"><?php 
						echo "<strong>" . MemberFullName($Memberid) . "</strong>";?></a><?php
						if($_SESSION['SessionMemberID'] == $Memberid)
						{
							//echo "<a style='text-decoration: none; font-weight: bold; color:black; font-size: 12px; float:right;' href='javascript:void(0);'  onClick='WallComment_sub_Delete(".$id.");'>Delete</a>";	   
						}
						?>
              		<span style="margin-left: 6px;"><?php echo $Description; ?></span>
               		
                </td>
           </tr>
           <tr>
                <td></td>
                <td>
                    <table class="Wallcomment_sub" id="wallcomment_sub_tb<?php echo $wallcomment_id; ?>" cellpadding="0" cellspacing="0" style="width:100%;">
                        <tr>
                            <td>
                                <div>
                                	<a style="text-decoration: none; font-weight: bold; float: left; color:#795FC5; font-size: 12px;" href="javascript:void(0);" onClick="wallcomment_sub_inputbox_show(<?php echo $wallcomment_id; ?>);">Respond</a>
                                </div>
                                <div>
                                <?php 
								if($_SESSION['SessionMemberID'] == $Memberid)
								{
									echo "<a style='text-decoration: none; font-weight: bold; float:left; color:black; margin-left:5px; font-size: 12px;' href='javascript:void(0);'  onClick='WallComment_sub_Delete(".$id.");'>Delete</a>";	   
								}
								?></div>
                            </td>
                        </tr>
                    </table>
              </td>
            </tr> 
        </table>
        <?php
	}
}

function check_wall_exist($Wallid)
{
	include 'config.php';
	$mainmember = $_SESSION['SessionMemberID'];
	
	$sql = mysqli_query($db_con, "select * from wall where Wallid = '$Wallid'");
	
	echo mysqli_num_rows($sql);
}

function getParentID($wallid)
{
	include 'config.php';
	$mainmember = $_SESSION['SessionMemberID'];
	
	$sql = mysqli_query($db_con, "select * from wall where Wallid = '$wallid'");
	
	while($w = mysqli_fetch_array($sql))
	{
		return $w['Parentid'];	
	}	
}

function getPostID($wallid)
{
	include 'config.php';
	$sql = mysqli_query($db_con, "select * from wall where Wallid = '$wallid'");
	
	while($w = mysqli_fetch_array($sql))
	{
		return array_sum($w['id']);	
	}	
}

function getWallComment_ParentID($wallcommentid)
{
	include 'config.php';
	$sql = mysqli_query($db_con, "select * from wall_comment where id = '$wallcommentid'");
	
	while($w = mysqli_fetch_array($sql))
	{
		return $w['Parentid'];	
	}
}

function getWallCommentsub_getMemberID($wallcommentid)
{
	include 'config.php';
	$sql = mysqli_query($db_con, "select * from wall_comment_sub where WallCommentid = '$wallcommentid'");
	$memid = array();
	
	while($w = mysqli_fetch_array($sql))
	{
		$memid[] = $w['Memberid'];	
	}

	return array_unique($memid);
}

function insert_wallComment($Wallid, $Description)
{
	include 'config.php';
	
	$PostedOn = date("M, d Y");
	
	$MainMember = $_SESSION['SessionMemberID'];
	
	$sql = mysqli_query($db_con, "INSERT INTO `wall_comment`(`id`, `Wallid`, `Parentid`, `Memberid`, `Description`, `Filetype`, `Filename`, `PostedOn`) VALUES (NULL, '$Wallid','$MainMember', '$MainMember', '$Description', NULL, NULL, '$PostedOn')") or die(mysqli_error($db_con));
	
	return 0;
}

function like_wall($Wallid, $emojli)
{
	include 'config.php';
	
	$MainMember = $_SESSION['SessionMemberID'];
	
	$sql = mysqli_query($db_con, "select * from wall_like where Wallid = '$Wallid' && Memberid = '$MainMember'");
	
	if(mysqli_num_rows($sql) > 0)
	{
		mysqli_query($db_con, "update wall_like set emojli = '$emojli' where Wallid = '$Wallid' && Memberid = '$MainMember'");
	}
	else
	{
		$sql = mysqli_query($db_con, "INSERT INTO `wall_like`(`id`, `Wallid`, `Memberid`, `emojli`) VALUES (NULL, '$Wallid', '$MainMember', '$emojli')");
	}
}

function like_wall_comment($wallcommentid, $emojli)
{
	include 'config.php';
	$sql = mysqli_query($db_con, "select * from wall_comment_like where WallCommentid = '$wallcommentid' && emojli = '$emojli'");

	if(mysqli_num_rows($sql) > 0)
	{
		mysqli_query($db_con, "update wall_comment_like set emojli = '$emojli' where Memberid = '".$_SESSION['SessionMemberID']."'");
	}
	else
	{
		mysqli_query($db_con, "INSERT INTO `wall_comment_like`(`id`, `WallCommentid`, `Memberid`, `emojli`) VALUES (NULL, '$wallcommentid', '".$_SESSION['SessionMemberID']."', '$emojli')");
	}
}

function unlike_wall_comment($wallcommentid)
{
	include 'config.php';

	mysqli_query($db_con, "delete from wall_comment_like where WallCommentid = '$wallcommentid' && Memberid = '".$_SESSION['SessionMemberID']."'");
}

function unlike_wall($Wallid)
{
	include 'config.php';
	
	$MainMember = $_SESSION['SessionMemberID'];
	
	mysqli_query($db_con, "delete from wall_like where Wallid = '$Wallid' && Memberid = '$MainMember'");	
}

function getLikeWall($Wallid)
{
	include 'config.php';
	
	$MainMember = $_SESSION['SessionMemberID'];
	
	$sql = mysqli_query($db_con, "SELECT * FROM `wall_like` WHERE Wallid = '$Wallid' && Memberid = '$MainMember'");
	
	return mysqli_num_rows($sql);
} 

function getLikeWall_Comment($wallcommentid)
{
	include 'config.php';

	$sql = mysqli_query($db_con, "select * from wall_comment_like where WallCommentid = '$wallcommentid' && Memberid = '".$_SESSION['SessionMemberID']."'");

	return mysqli_num_rows($sql);
}

function getTotalLikes($Wallid)
{
	include 'config.php';
	
	$sql = mysqli_query($db_con, "SELECT * FROM `wall_like` WHERE Wallid = '$Wallid'");
	
	return "React " . mysqli_num_rows($sql);
} 

/*function getTotalEmojlies($Wallid)
{
	include 'config.php';
	//$emojli_total = array('0', '1', '2', '3', '4', '5', '6');
	$emojli_img = '';
	
	$COOL = '';
	$LOVE = '';
	$LAUGHING = '';
	$SAD = '';
	$CONFUSED = '';
	
	$sql = mysqli_query($db_con, "SELECT * FROM `wall_like` WHERE Wallid = '$Wallid'");
	
	if(mysqli_num_rows($sql) > 0)
	{
		while($e = mysqli_fetch_array($sql))
		{
			if($e['emojli'] == 0) //COOL
			{
				$COOL++;
			}
			
			if($e['emojli'] == 1) //LOVE
			{
				$LOVE++;	
			}
			
			if($e['emojli'] == 2) //LAUGHING
			{
				$LAUGHING++;	
			}
			
			if($e['emojli'] == 3) //SHOCKED
			{
				$SAD++;
			}
			
			if($e['emojli'] == 4) //CONFUSED
			{
				$CONFUSED++;
			}
		}	
	}
	
	//Emojli IMAGES
	if($COOL > 0)//COOL 0
	{
		?>
        <img src="image/coolemoji.png" width="25" style="float:left; margin-top:5px;" />
        <?php
	}
	
	if($LOVE > 0)//LOVE 1
	{
		?>
        <img src="image/heartbeat_emoji.png" width="25" style="float:left; margin-top:5px;" />
        <?php
	}
	
	if($LAUGHING > 0)//LAUGHING 2
	{
		?>
        <img src="image/laughing_emojli.png" width="25" style="float:left; margin-top:5px;" />
        <?php
	}
	
	if($SAD > 0)//SAD 3
	{
		?>
        <img src="image/sademojli.png" width="25" style="float:left; margin-top:5px;" />
        <?php
	}
	
	if($CONFUSED > 0)//CONFUSED 4
	{
		?>
        <img src="image/confusedemojli.png" width="25" style="float:left; margin-top:5px;" />
        <?php
	}
	
	$total = ($COOL + $LOVE + $LAUGHING + $SAD + $CONFUSED);
	
	if($total != 0)
	{
		?>
        <div style="font-size:16px; font-weight:bold;"><?php echo $total; ?></div>
        <?php
	}
}*/

function checkdir()
{
	if(!is_dir("../profile/images/". $_SESSION['SessionMemberID']))
	{
		mkdir("../profile/images/". $_SESSION['SessionMemberID']);			
	}
	
	if(!is_dir("../profile/videos/". $_SESSION['SessionMemberID']))
	{
		mkdir("../profile/videos/". $_SESSION['SessionMemberID']);		
	}	
	
	if(!is_dir("../profile/mygallery/". $_SESSION['SessionMemberID']))
	{
		mkdir("../profile/mygallery/". $_SESSION['SessionMemberID']);			
	}	
	
	if(!is_dir("../profile/myvideo/". $_SESSION['SessionMemberID']))
	{
		mkdir("../profile/myvideo/". $_SESSION['SessionMemberID']);			
	}	
}

function load_setWall($Wallid)
{	
	include 'config.php';

	$MainMember  = $_SESSION['SessionMemberID'];
	
	$sql = mysqli_query($db_con, "select * from wall where Wallid = '$Wallid'");
	
	while($w = mysqli_fetch_array($sql))
	{
		$memberid = $w['Memberid'];
		$wallid = $w['Wallid'];
		$parentid = $w['Parentid'];
		$description = $w['Description'];
		$filetype = $w['Filetype'];
		$filename = $w['Filename'];
		$postedon = $w['PostedOn'];
		$level = $w['Level'];
		?>
     <table class="post_panel" id="post_panel<?php echo $wallid; ?>">
            	<tr id="post_header">
                	<?php
						if($memberid == $_SESSION['SessionMemberID'])
						{
							?>
							<td align="center" width="10%">
								<a href="myprofile.php"  target="_parent"><img src="<?php echo MemberMainProfilePic($memberid); ?>" style="width: 32px; float: left;" /></a> 
							</td>
							<td width="90%">
								<div style="margin-top: 10px; float: left;"><?php echo MemberFullName($memberid);?></div>
							</td>
								
                				
							<?php
						}
						else
						{
							?>
							<td align="center" width="10%">
								<a href="profile.php?profileid=<?php echo $memberid; ?>"  target="_parent"><img src="<?php echo MemberMainProfilePic($memberid); ?>" style="width: 32px; float: left;" /></a> 
							</td>
							<td width="90%">
								<div style="margin-top: 10px; float: left;"><?php echo MemberFullName($memberid);?></div>
							</td>
							<?php
						}
					?>
                	
                	<button id="wall_frame_btn" onClick="wallframe_close();">Close</button>
                </tr>
                <?php 
					echo getWallBody($memberid, $wallid, $description, $parentid,$filetype, $filename);
					echo getWallFooter($parentid, $memberid, $wallid, $level);
				?>
            </table>
        <?php
	}
}

function wall_share($wallid, $level)
{
	include 'config.php';
	$MainMember  = $_SESSION['SessionMemberID'];
	//$PID = getParentID($wallid);
	
	//$sql = mysqli_query($db_con, "select * from wall order by Wallid desc Limit 5");
	$sql = mysqli_query($db_con, "select * from wall where Wallid = '$wallid'");
	
	while($w = mysqli_fetch_array($sql))
	{
		$memberid = $_SESSION['SessionMemberID'];
		//$wallid = $w['Wallid'];
		$parentid = $w['Parentid'];
		$description = $w['Description'];
		$filetype = $w['Filetype'];
		$filename = $w['Filename'];
		$postedon = $w['PostedOn']; 
		
		
		$sql = mysqli_query($db_con, "insert into wall(`Wallid`, `Parentid`, `Memberid`, `Description`, `Filetype`, `Filename`, `PostedOn`, `Level`) values(NULL, '$parentid', '$memberid', '$description', '$filetype', '".$filename."', '$postedon', '$level')") or die(mysqli_error($db_con));
		
		break;
	}
}

function wall_unshare($wallid)
{
	include 'config.php';
	
	if(checkShared_Wall($wallid) > 1)
	{
		mysqli_query("delete from wall where Memberid = '".$_SESSION['SessionMemberID']."' && Wallid = '$wallid' ORDER BY `Wallid` DESC limit 1");
	}
}

function loadPost($page)
{	
	include 'config.php';

	$MainMember  = $_SESSION['SessionMemberID'];

/*
	$limit = 5;
	$offset = $page * $limit;
	
	//$sql = mysqli_query($db_con, "select * from wall order by Wallid desc Limit 5");
	$sql = mysqli_query($db_con, "select * from wall order by Wallid DESC");

	?>
		<div id="post_panelsub1"></div>
	<?php
	while($x = mysqli_fetch_array($sql))
	{
		$memberid = $x['Memberid'];
		$wallid = $x['Wallid'];
		$parentid = $x['Parentid'];
		$description = $x['Description'];
		$filetype = $x['Filetype'];
		$filename = $x['Filename'];
		$postedon = $x['PostedOn'];
		$level = $x['Level'];
		
	if(hidden_wall_exist($parentid, $_SESSION['SessionMemberID'], $wallid) == 0 && in_array($memberid, getMemberConnections($MainMember)) || $parentid == $MainMember || $memberid == $MainMember)
	{
		
	}
	else
	{
		$offset = $offset * 1;
	}

	}
*/
	$sql = mysqli_query($db_con, "select * from wall order by Wallid DESC");
//////////////////////////////////////////////////////////////

	while($w = mysqli_fetch_array($sql))
	{
		$memberid = $w['Memberid'];
		$wallid = $w['Wallid'];
		$parentid = $w['Parentid'];
		$description = $w['Description'];
		$filetype = $w['Filetype'];
		$filename = $w['Filename'];
		$postedon = $w['PostedOn'];
		$level = $w['Level'];
		
		//if(hidden_wall_exist($parentid, $_SESSION['SessionMemberID'], $wallid) == 0 && !in_array($oldpost, $wallid) && in_array($memberid, getMemberConnections($MainMember)) || $parentid == $MainMember || $memberid == $MainMember)

	if(hidden_wall_exist($parentid, $_SESSION['SessionMemberID'], $wallid) == 0 && in_array($memberid, getMemberConnections($MainMember)) || $parentid == $MainMember || $memberid == $MainMember)
	{
	?>
       <table class="post_panel" id="post_panel<?php echo $wallid; ?>">
        <?php 
			echo getWallHeader($memberid, $wallid, $parentid, $postedon); 
			echo getWallBody($memberid, $wallid, $description, $parentid, $filetype, $filename); 
			echo getWallFooter($parentid, $memberid, $wallid, $level); 
		?>
        </table>
        <?php
		}//end if
	}
}

function loadmyPost($page)
{	
	include 'config.php';

	$MainMember  = $_SESSION['SessionMemberID'];

/*
	$limit = 5;
	$offset = $page * $limit;
	
	//$sql = mysqli_query($db_con, "select * from wall order by Wallid desc Limit 5");
	$sql = mysqli_query($db_con, "select * from wall order by Wallid DESC");

	?>
		<div id="post_panelsub1"></div>
	<?php
	while($x = mysqli_fetch_array($sql))
	{
		$memberid = $x['Memberid'];
		$wallid = $x['Wallid'];
		$parentid = $x['Parentid'];
		$description = $x['Description'];
		$filetype = $x['Filetype'];
		$filename = $x['Filename'];
		$postedon = $x['PostedOn'];
		$level = $x['Level'];
		
	if(hidden_wall_exist($parentid, $_SESSION['SessionMemberID'], $wallid) == 0 && in_array($memberid, getMemberConnections($MainMember)) || $parentid == $MainMember || $memberid == $MainMember)
	{
		
	}
	else
	{
		$offset = $offset * 1;
	}

	}
*/
	$sql = mysqli_query($db_con, "select * from wall where Parentid = '$MainMember' order by Wallid DESC");
//////////////////////////////////////////////////////////////

	while($w = mysqli_fetch_array($sql))
	{
		$memberid = $w['Memberid'];
		$wallid = $w['Wallid'];
		$parentid = $w['Parentid'];
		$description = $w['Description'];
		$filetype = $w['Filetype'];
		$filename = $w['Filename'];
		$postedon = $w['PostedOn'];
		$level = $w['Level'];
		
		//if(hidden_wall_exist($parentid, $_SESSION['SessionMemberID'], $wallid) == 0 && !in_array($oldpost, $wallid) && in_array($memberid, getMemberConnections($MainMember)) || $parentid == $MainMember || $memberid == $MainMember)

	//if(hidden_wall_exist($parentid, $_SESSION['SessionMemberID'], $wallid) == 0 && in_array($memberid, getMemberConnections($MainMember)) || $parentid == $MainMember || $memberid == $MainMember)
	//{
	?>
       <table class="post_panel" id="post_panel<?php echo $wallid; ?>">
        <?php 
			echo getWallHeader($memberid, $wallid, $parentid, $postedon); 
			echo getWallBody($memberid, $wallid, $description, $parentid, $filetype, $filename); 
			echo getWallFooter($parentid, $memberid, $wallid, $level); 
		?>
        </table>
        <?php
		//}//end if
	}
}

function loadmemberPost($profileid)
{	
	include 'config.php';

	//$MainMember  = $_SESSION['SessionMemberID'];

/*
	$limit = 5;
	$offset = $page * $limit;
	
	//$sql = mysqli_query($db_con, "select * from wall order by Wallid desc Limit 5");
	$sql = mysqli_query($db_con, "select * from wall order by Wallid DESC");

	?>
		<div id="post_panelsub1"></div>
	<?php
	while($x = mysqli_fetch_array($sql))
	{
		$memberid = $x['Memberid'];
		$wallid = $x['Wallid'];
		$parentid = $x['Parentid'];
		$description = $x['Description'];
		$filetype = $x['Filetype'];
		$filename = $x['Filename'];
		$postedon = $x['PostedOn'];
		$level = $x['Level'];
		
	if(hidden_wall_exist($parentid, $_SESSION['SessionMemberID'], $wallid) == 0 && in_array($memberid, getMemberConnections($MainMember)) || $parentid == $MainMember || $memberid == $MainMember)
	{
		
	}
	else
	{
		$offset = $offset * 1;
	}

	}
*/
	$sql = mysqli_query($db_con, "select * from wall where Parentid = '$profileid' order by Wallid DESC");
//////////////////////////////////////////////////////////////

	while($w = mysqli_fetch_array($sql))
	{
		$memberid = $w['Memberid'];
		$wallid = $w['Wallid'];
		$parentid = $w['Parentid'];
		$description = $w['Description'];
		$filetype = $w['Filetype'];
		$filename = $w['Filename'];
		$postedon = $w['PostedOn'];
		$level = $w['Level'];
		
		//if(hidden_wall_exist($parentid, $_SESSION['SessionMemberID'], $wallid) == 0 && !in_array($oldpost, $wallid) && in_array($memberid, getMemberConnections($MainMember)) || $parentid == $MainMember || $memberid == $MainMember)

	//if(hidden_wall_exist($parentid, $_SESSION['SessionMemberID'], $wallid) == 0 && in_array($memberid, getMemberConnections($MainMember)) || $parentid == $MainMember || $memberid == $MainMember)
	//{
	?>
       <table class="post_panel" id="post_panel<?php echo $wallid; ?>">
        <?php 
			echo getWallHeader($memberid, $wallid, $parentid, $postedon); 
			echo getWallBody($memberid, $wallid, $description, $parentid, $filetype, $filename); 
			echo getWallFooter($parentid, $memberid, $wallid, $level); 
		?>
        </table>
        <?php
		//}//end if
	}
}

function loadNewMPost()
{
	include 'config.php';
	$MainMember  = $_SESSION['SessionMemberID'];
	
	$sql = mysqli_query($db_con, "select * from wall where Parentid = '$MainMember' order by Wallid desc Limit 1");
	
	while($w = mysqli_fetch_array($sql))
	{
		$memberid = $w['Memberid'];
		$wallid = $w['Wallid'];
		$parentid = $w['Parentid'];
		$description = $w['Description'];
		$filetype = $w['Filetype'];
		$filename = $w['Filename'];
		$postedon = $w['PostedOn'];
		$level = $w['Level'];
		?>
        <table class="post_panel" id="post_panel<?php echo $wallid; ?>">
           <?php 
				echo getWallHeader($memberid, $wallid, $parentid, $postedon); 
				echo getWallBody($memberid, $wallid, $description, $parentid, $filetype, $filename); 
				echo getWallFooter($parentid, $memberid, $wallid, $level); 
			?> 	
        </table>
        <?php
	}
}

function getWall_Level($wallid, $memberid)
{
	include 'config.php';
	$sql = mysqli_query($db_con, "select * from wall where Wallid = '$wallid' && Memberid = '$memberid' && Level = 0");
	
	if(mysqli_num_rows($sql) > 0)
	{
		return 1;
	}
	else
	{
		return 0;
	}
}

function checkShared_Wall($parentid, $Memberid)
{
	include 'config.php';
	$sql = mysqli_query($db_con, "select * from wall where Parentid = '$parentid'  order by Wallid  desc");
	
	while($w = mysqli_fetch_array($sql))
	{
		if($w['Memberid'] == $Memberid)
		{
			return 1;
		}
		else
		{
			return 0;
		}
		break;
	}
	
	return 0;
}

function getMemberLastPostID($memberid)
{
	include 'config.php';
	$sql = mysqli_query($db_con, "select * from wall where Parentid = '$memberid'  order by Wallid  desc");
	
	while($w = mysqli_fetch_array($sql))
	{
		return $w['Wallid'];
	}
	
}

function insert_main_post($Description, $Level)
{
	include 'config.php';
	$MainMember = $_SESSION['SessionMemberID'];	
	$PostedOn = date("M, d Y");
	
	$sql = mysqli_query($db_con, "insert into wall(`Wallid`, `Parentid`, `Memberid`, `Description`, `Filetype`, `Filename`, `PostedOn`, `Level`) values(NULL, '$MainMember', '$MainMember', '$Description', NULL, NULL, '$PostedOn', '$Level')") or die(mysqli_error($db_con));
	
	$Wallid = getMemberLastPostID($MainMember);
	
	foreach(getMemberConnections($MainMember) as $c)
	{
		$sql1 = mysqli_query($db_con, "INSERT INTO `member_notification`(`id`, `Wallid`, `toMember`, `fromMember`, `Mode`, `vStatus`) VALUES (NULL, '$Wallid', '$c', '".$_SESSION['SessionMemberID']."',0,1)");
	}
	
	return 0;
}

function hidden_wall_exist($parentid, $memberid, $wallid)
{
	include 'config.php';
	$sql = mysqli_query($db_con, "select * from `wall_hide` where Parentid = '$parentid' && Memberid = '$memberid' && Wallid = '$wallid'");
	
	if(mysqli_num_rows($sql) > 0)
	{
		return 1;	
	}
	else
	{
		return 0;	
	}		
}

function wall_hide($ParentID, $MemberID, $WallID)
{
	include 'config.php';
	$sql = mysqli_query($db_con, "INSERT INTO `wall_hide`(`id`, `Parentid`, `Memberid`, `Wallid`) VALUES (NULL,'$ParentID','$MemberID','$WallID')") or die(mysqli_error());	
}

function wall_unhide()
{
	
}

function insert_main_post1($Description, $FILE = array(), $Level)
{
	include 'config.php';
	$MainMember = $_SESSION['SessionMemberID'];	
	$PostedOn = date("M, d Y");
	
	/*foreach($FILE['name'] as $name => $index)
	{
		if(!$_SESSION['file_dir'] =='' && !$_SESSION['file_name'] == '')
		{
			$target_dir = "../profile/images/". $_SESSION['SessionMemberID'];
			$target_file = $target_dir ."/". $_SESSION['file_name'];

			// Check if image file is a actual image or fake image
			$check = getimagesize($FILE["tmp_name"][$index]);
			if($check == false) {
				//echo "File is not an image.";
				return 1;
			}

			$sql = mysqli_query($db_con, "insert into wall(`Wallid`, `Parentid`, `Memberid`, `Description`, `Filetype`, `Filename`, `PostedOn`, `Level`) values(NULL, '$MainMember', '$MainMember', '$Description', 'Image', 'NULL', '$PostedOn', '$Level')") or die(mysqli_error($db_con));
			
			mysqli_close($sql);

			if (copy($_SESSION['file_dir'] , $target_file)) {


					$nWallid = mysqli_insert_id($sql);

					$sql1 = mysqli_query($db_con, "INSERT INTO `wall_image`(`id`, `Wallid`, `ParentId`, `Filename`) VALUES (NULL, '$nWallid', '$MainMember' ,'".$_SESSION['file_name']."')");

					compress1($target_file, $target_file, 60);

					unset($_SESSION['file_dir']);
					unset($_SESSION['file_name']);

					return 0;
				} 	
		}
	}
	else
	{
	
	}*/
	
	$t = 0;
	$Wallid = '';
	
	foreach($FILE["name"] as $name => $index)
	{
		$target_dir = "../profile/images/". $_SESSION['SessionMemberID'];
		$target_file = $target_dir ."/". basename($FILE["name"][$name]);
		$target_file_name = $FILE["name"][$name];
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
			$check = getimagesize($FILE["tmp_name"][$name]);
			if($check == false) {
				//echo "File is not an image.";
				return 1;
			}
		
			$path = $FILE['name'][$name];
			$ext = pathinfo($path, PATHINFO_EXTENSION);
			//$ext_array = explode(".", $path);
		
			//$ext = $ext_array[count($ext_array)];
				
			$random_filename = gen_random_code(12).time().$MainMember;

			$target_file_name = $random_filename.".".$ext;

			$target_file = $target_dir ."/". $target_file_name;
		
			$exif = exif_read_data($FILE["tmp_name"][$name]);

					  if (!empty($exif['Orientation'])) {

						$image = imagecreatefromjpeg($FILE["tmp_name"][$name]);

						switch ($exif['Orientation']) {
						  case 3:
							$image = imagerotate($image, 180, 0);
							break;

						  case 6:
							$image = imagerotate($image, -90, 0);
							break;

						  case 8:
							$image = imagerotate($image, 90, 0);
							break;
						}

						imagejpeg($image, $FILE["tmp_name"][$name], 50);

					  }

			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			}

			if ($uploadOk == 0) {
				echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {		
				if (move_uploaded_file($FILE["tmp_name"][$name], $target_file)) {

					
					
					$t++;
					if($t == 1)
					{
						$sql = mysqli_query($db_con, "insert into wall(`Wallid`, `Parentid`, `Memberid`, `Description`, `Filetype`, `Filename`, `PostedOn`) values(NULL, '$MainMember', '$MainMember', '$Description', 'Image', 'NULL', '$PostedOn')") or die(mysqli_error($db_con));
						
						$Wallid = mysqli_insert_id($db_con);
					}
					
					
			
					$sql1 = mysqli_query($db_con, "INSERT INTO `wall_image`(`id`, `Wallid`, `ParentId`, `Filename`) VALUES (NULL, '$Wallid', '$MainMember' ,'$target_file_name')");

					foreach(getMemberConnections($MainMember) as $c)
					{
						$sql = mysqli_query($db_con, "INSERT INTO `member_notification`(`id`, `Wallid`, `toMember`, `fromMember`, `Mode`, `vStatus`) VALUES (NULL, '$Wallid', '$c', '".$_SESSION['SessionMemberID']."',0,1)");
					}
					
					?>
					<script>
						window.parent.closeImagePost();
					</script>
					<?php

				} else {
					echo "Sorry, there was an error uploading your file.";
				}
			}	
		}
}


function emojlies($e)
{
	$em = array("COOL", "LOVE", "LAUGHING", "SAD" , "CONFUSED");
	return $em[$e];
}

function emojlies_IMG_ONLY($e)
{
	$em = array("COOL", "LOVE", "LAUGHING", "SAD" , "CONFUSED");
	
	if($e == 0)//COOL
	{
		return '<img alt="COOL" src="image/coolemoji.png" width="25" style="float:left; margin-top:5px;" />';	
	}
	
	if($e == 1)//LOVE
	{
		return '<img src="image/heartbeat_emoji.png" width="25" style="float:left; margin-top:5px;" />';	
	}
	
	if($e == 2)//LAUGHING
	{
		return '<img src="image/laughing_emojli.png" width="25" style="float:left; margin-top:5px;" />';	
	}
	
	if($e == 3)//SAD
	{
		return '<img src="image/sademojli.png" width="25" style="float:left; margin-top:5px;" />';	
	}
	
	if($e == 5)//CONFUSED
	{
		return '<img src="image/confusedemojli.png" width="25" style="float:left; margin-top:5px;" />';	
	}
}


function getSelectedEmojlis($Wallid)
{
	include 'config.php';
	
	$sql = mysqli_query($db_con, "SELECT * FROM `wall_like` WHERE Wallid = '$Wallid'");
	
	if(mysqli_num_rows($sql) > 0)
	{
		while($e = mysqli_fetch_array($sql))
		{
			return emojlies($e['emojli']);	
		}	
	}
	else
	{
		return "Like";	
	}
}

function getWall_Comment_SelectedEmojlis($wallcommentid)
{
	include 'config.php';
	
	$sql = mysqli_query($db_con, "SELECT * FROM `wall_comment_like` WHERE WallCommentid = '$wallcommentid'");
	
	if(mysqli_num_rows($sql) > 0)
	{
		while($e = mysqli_fetch_array($sql))
		{
			return emojlies($e['emojli']);	
		}	
	}
	else
	{
		return "React";	
	}
}


function getTotalEmojlies($Wallid)
{
	include 'config.php';
	//$emojli_total = array('0', '1', '2', '3', '4', '5', '6');
	$emojli_img = '';
	
	$COOL = '';
	$LOVE = '';
	$LAUGHING = '';
	$SAD = '';
	$CONFUSED = '';
	
	$sql = mysqli_query($db_con, "SELECT * FROM `wall_like` WHERE Wallid = '$Wallid'");
	
	if(mysqli_num_rows($sql) > 0)
	{
		while($e = mysqli_fetch_array($sql))
		{
			if($e['emojli'] == 0) //COOL
			{
				$COOL++;
			}
			
			if($e['emojli'] == 1) //LOVE
			{
				$LOVE++;	
			}
			
			if($e['emojli'] == 2) //LAUGHING
			{
				$LAUGHING++;	
			}
			
			if($e['emojli'] == 3) //SHOCKED
			{
				$SAD++;
			}
			
			if($e['emojli'] == 4) //CONFUSED
			{
				$CONFUSED++;
			}
		}	
	}
	
	?>
    	<a style="font-size:16px; font-weight:bold; text-decoration:none; color: black; cursor:pointer;" href="javascript:void(0);" onClick="emotionview_panel_show(<?php echo $Wallid; ?>);">
    <?php
	//Emojli IMAGES
	if($COOL > 0)//COOL 0
	{
		?>
        <img src="image/coolemoji.png" width="25" style="float:left; margin-top:5px;" />
        <?php
	}
	
	if($LOVE > 0)//LOVE 1
	{
		?>
        <img src="image/heartbeat_emoji.png" width="25" style="float:left; margin-top:5px;" />
        <?php
	}
	
	if($LAUGHING > 0)//LAUGHING 2
	{
		?>
        <img src="image/laughing_emojli.png" width="25" style="float:left; margin-top:5px;" />
        <?php
	}
	
	if($SAD > 0)//SAD 3
	{
		?>
        <img src="image/sademojli.png" width="25" style="float:left; margin-top:5px;" />
        <?php
	}
	
	if($CONFUSED > 0)//CONFUSED 4
	{
		?>
        <img src="image/confusedemojli.png" width="25" style="float:left; margin-top:5px;" />
        <?php
	}
	
	$total += (int)$COOL + (int)$LOVE + (int)$LAUGHING + (int)$SAD + (int)$CONFUSED;
	
	if($total != 0)
	{
		?>
        <div style="float:left; margin-top: 10px; padding-left: 5px;"><?php echo $total; ?></div></a>
        <?php
	}
}

function getWallCommentTotalEmojlies($wallcommentid)
{
	include 'config.php';
	//$emojli_total = array('0', '1', '2', '3', '4', '5', '6');
	$emojli_img = '';
	
	$COOL = '';
	$LOVE = '';
	$LAUGHING = '';
	$SAD = '';
	$CONFUSED = '';
	
	$sql = mysqli_query($db_con, "SELECT * FROM `wall_comment_like` WHERE WallCommentid = '$wallcommentid'");
	
	if(mysqli_num_rows($sql) > 0)
	{
		while($e = mysqli_fetch_array($sql))
		{
			if($e['emojli'] == 0) //COOL
			{
				$COOL++;
			}
			
			if($e['emojli'] == 1) //LOVE
			{
				$LOVE++;	
			}
			
			if($e['emojli'] == 2) //LAUGHING
			{
				$LAUGHING++;	
			}
			
			if($e['emojli'] == 3) //SHOCKED
			{
				$SAD++;
			}
			
			if($e['emojli'] == 4) //CONFUSED
			{
				$CONFUSED++;
			}
		}	
	}
	
	?>
    	<a style="font-size:16px; font-weight:bold; text-decoration:none; color: black; cursor:pointer;" href="javascript:void(0);" onClick="">
    <?php
	//Emojli IMAGES
	if($COOL > 0)//COOL 0
	{
		?>
        <img src="image/coolemoji.png" width="14" style="float:left; margin-left: 4px; margin-top:2px;" />
        <?php
	}
	
	if($LOVE > 0)//LOVE 1
	{
		?>
        <img src="image/heartbeat_emoji.png" width="14" style="float:left; margin-left: 4px; margin-top:2px;" />
        <?php
	}
	
	if($LAUGHING > 0)//LAUGHING 2
	{
		?>
        <img src="image/laughing_emojli.png" width="14" style="float:left; margin-left: 4px; margin-top:2px;" />
        <?php
	}
	
	if($SAD > 0)//SAD 3
	{
		?>
        <img src="image/sademojli.png" width="14" style="float:left; margin-left: 4px; margin-top:2px;" />
        <?php
	}
	
	if($CONFUSED > 0)//CONFUSED 4
	{
		?>
        <img src="image/confusedemojli.png" width="14" style="float:left; margin-left: 4px; margin-top:2px;" />
        <?php
	}
	
	$total += (int)$COOL + (int)$LOVE + (int)$LAUGHING + (int)$SAD + (int)$CONFUSED;
	
	if($total != 0)
	{
		?>
        <div style="float:left; margin-top: 2px; padding-left: 2px; font-size: 10px;"><?php //echo $total; ?></div></a>
        <?php
	}
}

function getSelectedEmojli_Header($Wallid)
{
	include 'config.php';
	$totalSelected_Emojils = '';
	$COOL = '';
	$LOVE = '';
	$LAUGHING = '';
	$SAD = '';
	$CONFUSED = '';
	
	//STEP 1
	//Selected Emojli with total
	$sql = mysqli_query($db_con, "select * from wall_like where Wallid = '$Wallid'");
	
	if(mysqli_num_rows($sql) > 0)
	{
		while($e = mysqli_fetch_array($sql))
		{
			if($e['emojli'] == 0)
			{
				$COOL++;	
			}
			
			if($e['emojli'] == 1)
			{
				$LOVE++;	
			}
			
			if($e['emojli'] == 2)
			{
				$LAUGHING++;	
			}
			
			if($e['emojli'] == 3)
			{
				$SAD++;	
			}	
			
			if($e['emojli'] == 4)
			{
				$CONFUSED++;	
			}				
		}
		
		$totalSelected_Emojils = ($COOL + $LOVE + $LAUGHING + $SAD + $CONFUSED);	
	}
	
	//STEP 2
	?>
    <style>
    #emojli_tb{
		font-family:Arial;
		float:left;
	}
	
	#emojli_tb button{
		padding:8px 8px 8px 8px;
		border:none;
		margin-right:10px;
		font-size:14px;
		font-weight:bold;
		font-family: Arial;
		color:white;
		background-color:#795FC5;
		border-radius:6px;	
		width:100%;
	}
	
	#emojli_tb td{
		font-family:Arial;
		cursor:pointer;
	}
	
	#emojli_tb td:hover{
		font-family:Arial;
		background-color:#B8ABE0;
	}
	
	#member_emojli_panel
	{
		width:50%;
		line-height:100px;
		background-color:grey;
	}
	
	.emojli_member_tb
	{
		border-top:1px black solid;	
	}
	
	.emojli_member_tb td
	{
		height:50px;	
	}
	
	.emojli_member_tb button{
		padding:4px 4px 4px 4px;
		border:none;
		font-size:12px;
		font-weight:bold;
		font-family: Arial;
		color:white;
		background-color:#795FC5;
		border-radius:6px;	
		float: right;
	}
	
	.emojli_close_btn{
		padding:4px 4px 4px 4px;
		border:none;
		font-size:12px;
		font-weight:bold;
		font-family: Arial;
		color:white;
		background-color:#795FC5;
		border-radius:6px;	
		float: right;
	}
    </style>
    <div style="float: left; width: 100%;"><button class="emojli_close_btn" style="" onClick="emotionview_panel_close();">Close</button></div>
    <table id="emojli_tb" cellspacing="" cellpadding="">
       	<tr>
        	<td onClick="emotionview_panel_show(<?php echo $Wallid; ?>);">All</td><td><?php echo $totalSelected_Emojils; ?></td>
            
            <?php 
				$colspan = 0;
				if($COOL > 0)
				{
					$colspan ++;
					echo "<td><a href='javascript:void();' onClick='emotionview_panel_show_with_seperated_emojli(".$Wallid.", 0);'>".emojlies_IMG_ONLY(0)."</a></td><td>". $COOL."</td>";	
				}
				
				if($LOVE > 0)
				{
					$colspan ++;
					echo "<td><a href='javascript:void();' onClick='emotionview_panel_show_with_seperated_emojli(".$Wallid.", 1);'>".emojlies_IMG_ONLY(1)."</a></td><td>".$LOVE."</td>";	
				}
				
				if($LAUGHING > 0)
				{
					$colspan ++;
					echo "<td><a href='javascript:void();' onClick='emotionview_panel_show_with_seperated_emojli(".$Wallid.", 2);'>".emojlies_IMG_ONLY(2)."</a></td><td>".$LAUGHING."</td>";	
				}
				
				if($SAD > 0)
				{
					$colspan ++;
					echo "<td><a href='javascript:void();' onClick='emotionview_panel_show_with_seperated_emojli(".$Wallid.", 3);'>".emojlies_IMG_ONLY(3)."</a></td><td>".$SAD."</td>";	
				}
				
				if($CONFUSED > 0)
				{
					$colspan ++;
					echo "<td><a href='javascript:void();' onClick='emotionview_panel_show_with_seperated_emojli(".$Wallid.", 4);'>".emojlies_IMG_ONLY(4)."</a></td><td>".$CONFUSED."</td>";	
				}
			?>
        </tr>
    </table>
    <?php
	
	//STEP 3
}

function getMember_WITH_SELECTED_Emojlis($Wallid, $e)
{
	include 'config.php';
	
	$sql = mysqli_query($db_con, "select * from wall_like where Wallid = '$Wallid' && emojli = '$e'");
	
	if(mysqli_num_rows($sql) > 0)
	{
		while($m = mysqli_fetch_array($sql))
		{
			?>
            <table class="emojli_member_tb" width="100%">
            	<?php
                	echo "<td width='20%' align='center'>" . '<img src="'.MemberMainProfilePic($m['Memberid']).'" style="width: 64px;" />' . "</td>";
					echo "<td width='50%' align='center'><strong>" . MemberFullName($m['Memberid']) . "</strong></td>";
					echo "<td width='35%'  align='center'>"; 
					 
						if($m['Memberid'] != $_SESSION['SessionMemberID'])
						{
							if(check_connection_request_status($m['Memberid'], $_SESSION['SessionMemberID']) == 1)
							{
								?><button id="connection_btn<?php echo $m['Memberid']; ?>" onClick="">Connection Pending</button><?php
							}
							
							if(check_connection_request_status($m['Memberid'], $_SESSION['SessionMemberID']) == 2)
							{
								echo "<a href='profile.php?profileid=".$m['Memberid']."'><button>View Profile</button></a>";
							}
	 
							
							if(check_connection_request_status($m['Memberid'], $_SESSION['SessionMemberID']) == 0)
							{
								?><a href="#">Not Connected</a>&nbsp;&nbsp;<button id="connection_btn<?php echo $m['Memberid']; ?>" onClick="send_connection_request(<?php echo $m['Memberid']; ?>)">Add Connection</button><?php
							}	
						}
					echo "</td>";
				?>
            </table>
            <?php	
		}	
	}
		
}

function getMember_WITH_Emojlis($Wallid)
{
	include 'config.php';
	
	$sql = mysqli_query($db_con, "select * from wall_like where Wallid = '$Wallid'");
	
	if(mysqli_num_rows($sql) > 0)
	{
		while($m = mysqli_fetch_array($sql))
		{
			?>
            <table class="emojli_member_tb" width="100%">
            	<?php
                	echo "<td width='20%' align='center'>" . '<img src="'.MemberMainProfilePic($m['Memberid']).'" style="width: 64px;" />' . "</td>";
					echo "<td width='50%' align='center'><strong>" . MemberFullName($m['Memberid']) . "</strong></td>";
					echo "<td width='35%' align='center'>"; 
					 
					if($m['Memberid'] != $_SESSION['SessionMemberID'])
					{
						if(check_connection_request_status($m['Memberid'], $_SESSION['SessionMemberID']) == 1)
						{
							?><button id="connection_btn<?php echo $m['Memberid']; ?>" onClick="">Connection Pending</button><?php
						}
						
						if(check_connection_request_status($m['Memberid'], $_SESSION['SessionMemberID']) == 2)
						{
							echo "<a href='profile.php?profileid=".$m['Memberid']."'><button>View Profile</button></a>";
						}
 
						
						if(check_connection_request_status($m['Memberid'], $_SESSION['SessionMemberID']) == 0)
						{
							?><a href="#">Not Connected</a>&nbsp;&nbsp;<button id="connection_btn<?php echo $m['Memberid']; ?>" onClick="send_connection_request(<?php echo $m['Memberid']; ?>)">Add Connection</button><?php
						}	
					}
						
					echo "</td>";
				?>
            </table>
            <?php	
		}	
	}
		
}

function deletePost($Wallid)
{
	include 'config.php';
	$MainMember  = $_SESSION['SessionMemberID'];
	$sql = mysqli_query($db_con, "select * from wall_image where Wallid='$Wallid'");
	
	while($w = mysqli_fetch_array($sql))
	{
		//$memberid = $w['Memberid'];
		//$wallid = $w['Wallid'];
		//$parentid = $w['Parentid'];
		//$description = $w['Description'];
		$filetype = $w['Filetype'];
		$filename = $w['Filename'];
		//$postedon = $w['PostedOn'];
		
		if(!$filename == '')
		{
			@unlink("../profile/images/".$MainMember."/".$filename);		
		}
		
		if(!$filename == '' && $filetype == 'Video')
		{
			@unlink("../profile/videos/".$MainMember."/".$filename);		
		}
		
		
	}
	
	mysqli_query($db_con, "delete from wall_image where Wallid = '$Wallid'");
	//$sql = mysqli_query($db_con, "select * from wall where Wallid='$Wallid'");
	
	while($w = mysqli_fetch_array($sql))
	{
		//$memberid = $w['Memberid'];
		//$wallid = $w['Wallid'];
		//$parentid = $w['Parentid'];
		//$description = $w['Description'];
		$filetype = $w['Filetype'];
		$filename = $w['Filename'];
		//$postedon = $w['PostedOn'];
		
		if(!$filename == '' && $filetype == 'Video')
		{
			@unlink("../profile/videos/".$MainMember."/".$filename);		
		}
	}
	
	mysqli_query($db_con, "delete from wall where Wallid = '$Wallid'");

	//Delete Notification 

	mysqli_query($db_con, "delete from member_notification where Wallid = '$Wallid' && fromMember = '".$_SESSION['SessionMemberID']."'");

	return 0;
}

function videoPost($Description, $File = array())
{
	include 'config.php';
	$MainMember  = $_SESSION['SessionMemberID'];
	
	$PostedOn = date("M, d Y");
	$allowVideoType = array('flv','avi','wmv','mpg','mpeg','mp4','video/avi','video/x-ms-wmv','video/mpeg','video/mpg','video/mp4');
	//$allowVideoType = array('mp4');

	$ext = pathinfo($File['name'][0], PATHINFO_EXTENSION);

	//die($File['name'][0]);

	$target_dir = "../profile/videos/". $MainMember;
	
	if(in_array($ext, $allowVideoType))
	{
		
		$newfilename = gen_random_code(12).time().$MainMember.".mp4";
		
		$target_path = $target_dir . "/" . $newfilename;
		
		//$tp = $target_dir . "/" . $newfilename;
		
		if(move_uploaded_file($File['tmp_name'][0], $target_path))
		{
			shell_exec("ffmpeg -i $target_path -ar 22050 -ab 32 -f mp4 -s 520x440 $target_path");
			
			$sql = mysqli_query($db_con, "insert into wall(`Wallid`, `Parentid`, `Memberid`, `Description`, `Filetype`, `Filename`, `PostedOn`) values(NULL, '$MainMember', '$MainMember', '$Description', 'Video', '$newfilename', '$PostedOn')") or die(mysqli_error($db_con));
			
			foreach(getMemberConnections($MainMember) as $c)
			{
				$sql1 = mysqli_query($db_con, "INSERT INTO `member_notification`(`id`, `Wallid`, `toMember`, `fromMember`, `Mode`, `vStatus`) VALUES (NULL, '$Wallid', '$c', '".$_SESSION['SessionMemberID']."',0,1)");
			}
		}
	}
	echo 0;	
}

function compress1($source, $destination, $quality) {

	$info = getimagesize($source);

	if ($info['mime'] == 'image/jpeg') 
		$image = imagecreatefromjpeg($source);

	elseif ($info['mime'] == 'image/gif') 
		$image = imagecreatefromgif($source);

	elseif ($info['mime'] == 'image/png') 
		$image = imagecreatefrompng($source);

	imagejpeg($image, $destination, $quality);

	return $destination;
}
?>