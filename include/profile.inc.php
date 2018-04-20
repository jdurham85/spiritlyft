<?php 
session_start();
include 'core.inc.php';

function checkdir1()
{
	//if(!is_dir("../profile/mygallery/_thumb". $_SESSION['SessionMemberID']) && !is_dir("../profile/myvideo/_thumb". $_SESSION['SessionMemberID']))
	//{
		//mkdir("../profile/mygallery/_thumb". $_SESSION['SessionMemberID']);	
		//mkdir("../profile/myvideo/_thumb". $_SESSION['SessionMemberID']);			
	//}	
}

function compress($source, $destination, $quality) {

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

function check_exist_profile_picture($picid)
{
	include 'config.php';
	$sql = mysqli_query($db_con, "select * from member_profile where id='$picid'");
	
	return mysqli_num_row($sql);
}

function Profile_Gallery_FileName($id)
{
	include 'config.php';
	$sql = mysqli_query($db_con, "select * from member_gallery where id = '$id'");
	
	while($g = mysqli_fetch_array($sql))
	{
		return $g['filename'];
	}
}

function setMainProfilePicture($pictureid)
{
	if(!is_dir("../profile/profile_photo/". $_SESSION['SessionMemberID']))
	{
		mkdir("../profile/profile_photo/". $_SESSION['SessionMemberID']);				
	}
	
	$filelocation = "../profile/profile_photo/". $_SESSION['SessionMemberID'];
	$file_gallery_location = "../profile/mygallery/". $_SESSION['SessionMemberID'] . "/";
	
	
	include 'config.php';
	
	$sql = mysqli_query($db_con, "select * from member_profile where Memberid = '".$_SESSION['SessionMemberID']."'");
	
	if(mysqli_num_rows($sql) > 0)
	{
		while($p = mysqli_fetch_array($sql))
		{
			unlink($filelocation . "/" . $p['filename']);
			mysqli_query($db_con, "delete from member_profile where id = '".$p['id']."'");
		}
	}
	
	$newfilename = Profile_Gallery_FileName($pictureid);
	$file_from_Member_Gallery = $file_gallery_location . $newfilename;
	
	if(copy($file_from_Member_Gallery, $filelocation."/".$newfilename))
	{
		$sql = mysqli_query($db_con, "INSERT INTO `member_profile`(`id`, `Memberid`, `filename`) VALUES (NULL,'".$_SESSION['SessionMemberID']."','".$newfilename."')");
	}
}

function delete_gallery($imgid)
{
	include 'config.php';
	
	unlink("../profile/mygallery/". $_SESSION['SessionMemberID'] . "/" . Profile_Gallery_FileName($imgid));
		
	$sql = mysqli_query($db_con, "delete from member_gallery where Memberid = '".$_SESSION['SessionMemberID']."' && id = '$imgid'");
}

function show_gallery()
{
	include 'config.php';
	$mainmember = $_SESSION['SessionMemberID'];
	
	$sql = mysqli_query($db_con, "select * from member_gallery where Memberid = '$mainmember'");
	
	if(mysqli_num_rows($sql) > 0)
	{
		while($g = mysqli_fetch_array($sql))
		{
			$picid = $g['id'];
			$filename = $g['filename'];
			?>
            <div style="margin-left:20px; background-color: white;">
               <div style="width:30%; margin:6px 6px 6px 6px; float:left;">
               		<img src="profile/mygallery/<?php echo "/". $mainmember . "/" . $filename; ?>" style="width:100%;" />
                    <div align="center" id="picstatus" style="font-weight:bold; font-size:14px; color:black;">
						<a style="text-decoration: none; font-size: 12px; color:black;" href="javascript:void(0);" onClick="setMainProfilePicture(<?php echo $picid; ?>);">Set as Main Profile Picture</a>&nbsp;&nbsp;
                       <a href="javascript:void(0);" onClick="delete_gallery(<?php echo $picid; ?>);" style="text-decoration: none; padding-top: 15px; font-size: 12px; font color: black;">Delete Photo</a>
                        <!--button href="#"><img src="image/comment_logo.png" width="15%"> Comments (324,546)</button-->
                    </div>
               </div>
            </div>
            <?php	
		}	
	}	
}

function show_gallery_mobile()
{
	include 'config.php';
	$mainmember = $_SESSION['SessionMemberID'];
	
	$sql = mysqli_query($db_con, "select * from member_gallery where Memberid = '$mainmember'");
	
	if(mysqli_num_rows($sql) > 0)
	{
		while($g = mysqli_fetch_array($sql))
		{
			$picid = $g['id'];
			$filename = $g['filename'];
			?>
            <div style="width: 60%; margin:auto;" >
               <div style="width:100%;">
               		<img class="uimg" id="img<?php echo $picid; ?>" src="profile/mygallery/<?php echo "/". $mainmember . "/" . $filename; ?>" style="text-align: center; max-width: 100%;" /><br>
                    <div align="center" id="picstatus" style="font-weight:bold; font-size:14px; color:black;">
                    	<a style="width: 100%; text-decoration: none; color:black; float: left;" href="javascript:void(0);" data-role="button" onClick="setMainProfilePicture(<?php echo $picid; ?>);">Set as Main Photo</button>
                    	<a style="width: 100%; text-decoration: none; padding-top: 15px; padding-bottom: 15px; color:black; float: left;" href="javascript:void(0);" data-role="button" onClick="delete_gallery(<?php echo $picid; ?>);">Delete Photo</a>
                    </div>
               </div>
            </div><br><br>
            <?php	
		}	
	}
}

function show_other_member_gallery($mem)
{
	include 'config.php';
	
	$sql = mysqli_query($db_con, "select * from member_gallery where Memberid = '$mem'");
	
	if(mysqli_num_rows($sql) > 0)
	{
		while($g = mysqli_fetch_array($sql))
		{
			$filename = $g['filename'];
			
			?>
            <div style="margin-left:20px;">
               <div style="width:30%; margin:6px 6px 6px 6px; float:left;">
               		<img src="profile/mygallery/<?php echo "/". $mem . "/" . $filename; ?>" style="width:100%;" />
                    <div align="center" id="picstatus" style="font-weight:bold; font-size:14px; color:black;">
                    	<!--button href="#"><img src="image/like_logo.png" width="15%"> Likes (12,112)</button><br>
                        <button href="#"><img src="image/comment_logo.png" width="15%"> Comments (324,546)</button-->
                    </div>
               </div>  
            </div>
            <?php	
		}	
	}
}

function show_other_member_gallery_mobile($mem)
{
	include 'config.php';
	
	$sql = mysqli_query($db_con, "select * from member_gallery where Memberid = '$mem'");
	
	if(mysqli_num_rows($sql) > 0)
	{
		while($g = mysqli_fetch_array($sql))
		{
			$id = $g['id'];
			$filename = $g['filename'];
			?>
            <div style="margin-left:20px;">
               <div style="width:30%; margin:6px 6px 6px 6px; float:left;">
               		<img src="profile/mygallery/<?php echo "/". $mem . "/" . $filename; ?>" style="width:100%;" />
                    <!--div align="center" id="picstatus" style="font-weight:bold; font-size:14px; color:black;">
                    	<a href="javascript:void(0);" data-role="button">Set as Main Photo</a>
                    </div-->
               </div>  
            </div>
            <?php	
		}	
	}
}
	
function upload_gallery_image($FILE = array())
{
	include 'config.php';
	
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
	
	
	$filename = $FILE['name'];
	$filetmp = $FILE['tmp_name'];
	$filesize = $FILE['size'];
	$filetype = $FILE['type'];
	
	$MainMember = $_SESSION['SessionMemberID'];
	
	$targetdir = "../profile/mygallery/". $_SESSION['SessionMemberID'];
	
	$path = $FILE['name'];
	$ext = pathinfo($path, PATHINFO_EXTENSION);
	$random_filename = gen_random_code(12);
			
	$target_file_name = $random_filename.".".$ext;
	$targetfile = $targetdir ."/". $target_file_name;
	
	
	
	if (move_uploaded_file($FILE["tmp_name"], $targetfile)) {
		$sql = mysqli_query($db_con, "INSERT INTO `member_gallery`(`id`, `Memberid`, `filename`) VALUES (NULL, '$MainMember', '$target_file_name')") or die(mysqli_error($db_con));
		
		 $exif = exif_read_data($targetfile);

		  if (!empty($exif['Orientation'])) {

			$image = imagecreatefromjpeg($targetfile);

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

			imagejpeg($image, $targetfile, 50);

		  }
		
		//resizeImg($targetfile, 1280, 800, false, 90, 0,"");
	
		include 'connections.core.inc.php';
		
		foreach(getMemberConnections($MainMember) as $c)
		{
			$sql = mysqli_query($db_con, "INSERT INTO `member_notification`(`id`, `Wallid`, `toMember`, `fromMember`, `Mode`, `vStatus`) VALUES (NULL, '0', '$c', '".$_SESSION['SessionMemberID']."',5,1)");
		}
	} else {
		//echo "Sorry, there was an error uploading your file.";
	}
	?>
    <script type="text/javascript">
    	window.parent.cleanup();
		window.parent.load_profile_images();
    </script>
    <?php
}

if(isset($_FILES['galleryfile']['name']))
{
	upload_gallery_image($_FILES['galleryfile']);	
}

if(isset($_POST['mode']))
{
	if($_POST['mode'] == 0)
	{
		echo show_gallery();	
	}
	
	if($_POST['mode'] == 1)
	{
		echo show_other_member_gallery($_POST['mem']);	
	}
	
	if($_POST['mode'] == 2)
	{
		echo show_gallery_mobile();	
	}
	
	if($_POST['mode'] == 3)
	{
		echo show_other_member_gallery_mobile($_POST['mem']);	
	}	
}
?>