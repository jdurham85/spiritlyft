<?php
function checkMember_session()
{
	include 'config.php';
	if(isset($_SESSION['SessionMemberID']) && $_SESSION['SessionMemberID'] !='')
	{
		date_default_timezone_set(getMemberTimezone($_SESSION['SessionMemberID']));
		$sql = mysqli_query($db_con, "select * from member_online where MemberId = '".$_SESSION['SessionMemberID']."'") or die(mysqli_error($db_con));
		
		if(mysqli_num_rows($sql) == 0)
		{
			$member_online = mysqli_query($db_con, "INSERT INTO `member_online`(`MemberId`, `LoggedOn`, `ActiveTill`, `Idle`, `Visible`) VALUES ('".$_SESSION['SessionMemberID']."','0','".time()."','0','Y')");
		}
		else
		{
			$member_online = mysqli_query($db_con, "update member_online set ActiveTill = '".time()."' where MemberId = '".$_SESSION['SessionMemberID']."'");
		}
		echo 0;	
	}
	elseif(isset($_COOKIE['MemberID']) && isset($_COOKIE['MemberPassword']))
	{
		$_SESSION['SessionMemberID'] = $_COOKIE['MemberID'];
		$_SESSION['SessionMemberPassword'] = $_COOKIE['MemberPassword'];
		
		date_default_timezone_set(getMemberTimezone($_SESSION['SessionMemberID']));
		$sql = mysqli_query($db_con, "select * from member_online where MemberId = '".$_SESSION['SessionMemberID']."'") or die(mysqli_error($db_con));
		
		if(mysqli_num_rows($sql) == 0)
		{
			$member_online = mysqli_query($db_con, "INSERT INTO `member_online`(`MemberId`, `LoggedOn`, `ActiveTill`, `Idle`, `Visible`) VALUES ('".$_SESSION['SessionMemberID']."','0','".time()."','0','Y')");
		}
		else
		{
			$member_online = mysqli_query($db_con, "update member_online set ActiveTill = '".time()."' where MemberId = '".$_SESSION['SessionMemberID']."'");
		}
		
		echo 0;	
	}
	else
	{
		echo 1;	
	}	
}

function get_member_mobile_provider($memberid)
{
	include 'config.php';
	$sql = mysqli_query($db_con, "select * from member_mobile_provider where Memberid = '$memberid'");
	
	while($mmp = mysqli_fetch_array($sql))
	{
		return $mmp['Provider'];
	}
}

function get_mobile_SMSgateway($id)
{
	include 'config.php';
	$sql = mysqli_query($db_con, "select * from cyber_gateways where id = '$id'");
	
	while($mp = mysqli_fetch_array($sql))
	{
		return $mp['vSMSgateway'];
	}
}

function getCountrybyShortname($country)
{
	include 'config.php';
	
	$country = strtoupper($country);
	
	$sql = mysqli_query($db_con, "select * from country where Name = '$country'");
	
	while($c = mysqli_fetch_array($sql))
	{
		return $c['ShortName'];
	}
}

function getStatebyShortname($state)
{
	include 'config.php';
	
	$state = strtoupper($state);
	
	$sql = mysqli_query($db_con, "select * from state where Name like '%$state%'");
	
	while($s = mysqli_fetch_array($sql))
	{
		return $s['ShortName'];
	}
}

function getStatebyFullname($state)
{
	include 'config.php';
	
	$state = strtoupper($state);
	
	$sql = mysqli_query($db_con, "select * from state where ShortName like '%$state%'");
	
	while($s = mysqli_fetch_array($sql))
	{
		return $s['Name'];
	}
}

function getAllConnections()
{
	include 'config.php';
	$sql = mysqli_query($db_con, "select * from member");
	
	$connections = array();
	
	while($m = mysqli_fetch_array($sql))
	{
		$connections[] = $m['Memberid']; 
	}
	
	return $connections;
}

function getMemberTimezone($memberid)
{
	include 'config.php';
	$sql = mysqli_query($db_con, "select * from member_timezone where Memberid = '$memberid'");
	
	while($tz = mysqli_fetch_array($sql))
	{
		return $tz['Timezone'];
	}
}

function changeMemberTimezone($memberid, $timezone)
{
	include 'config.php';
	$sql = mysqli_query($db_con, "update member_timezone set Timezone = '$timezone' where Memberid = '$memberid'");
}

function MemberCountry($id)
{
	include 'config.php';
	$MemberCountry = '';
	
	$sql = mysqli_query($db_con, "select * from member where Memberid = '$id'");
	
	while($d = mysqli_fetch_array($sql))
	{
		$MemberCountry = $d['Country'];
	}	
	
	return $MemberCountry;		
}

function MemberBirthday($id)
{
	include 'config.php';
	//$MemberBirthday = '';

	$sql = mysqli_query($db_con, "select * from member where Memberid = '$id'");

	while($mb = mysqli_fetch_array($sql))
	{
		return str_replace(" ", "", $mb['Birthdate']);
	}
}

function MemberEmail($id)
{
	include 'config.php';
	$MemberEmail = '';
	
	$sql = mysqli_query($db_con, "select * from member where Memberid = '$id'");
	
	while($d = mysqli_fetch_array($sql))
	{
		$MemberEmail = $d['Email'];
	}	
	
	return $MemberEmail;	
}

function MemberIDByEmail($email)
{
	include 'config.php';
	$MemberID = '';
	
	$sql = mysqli_query($db_con, "select * from member where Email = '$email'") or die(mysqli_error($db_con));
	
	while($d = mysqli_fetch_array($sql))
	{
		$MemberID = $d['Memberid'];
	}	
	
	return $MemberID;	
}

function MemberPhoneNumber_Exist($id)
{
	include 'config.php';
	
	$sql = mysqli_query($db_con, "select * from member where Memberid = '$id'");
	
	
	return mysqli_num_rows($sql);	
}

function MemberPhoneNumber($id)
{
	$MemberPhoneNumber = '';
	
	include 'config.php';
	
	$sql = mysqli_query($db_con, "select * from member where Memberid = '$id'");
	
	while($r = mysqli_fetch_array($sql))
	{
		$MemberPhoneNumber = $r['PhoneNumber'];
	}
	
	return $MemberPhoneNumber;	
}

function MemberFullName($id)
{
	include 'config.php';
	$firstname = '';
	$lastname = '';
	
	$sql = mysqli_query($db_con, "select * from member where Memberid = '$id'");
	
	while($r = mysqli_fetch_array($sql))
	{
		$firstname = $r['First'];
		$lastname = $r['Last'];
	}
	
	return $firstname . "  " . $lastname;	
}

function MemberFirstName($id)
{
	include 'config.php';
	$firstname = '';
	
	$sql = mysqli_query($db_con, "select * from member where Memberid = '$id'");
	
	while($r = mysqli_fetch_array($sql))
	{
		$firstname = $r['First'];
	}
	
	return $firstname;	
}

function MemberLastName($id)
{
	include 'config.php';
	$lastname = '';
	
	$sql = mysqli_query($db_con, "select * from member where Memberid = '$id'");
	
	while($r = mysqli_fetch_array($sql))
	{
		$lastname = $r['Last'];
	}
	
	return $lastname;	
}

function MemberGender($id)
{
	include 'config.php';
	$Gender = '';
	$sql = mysqli_query($db_con, "select * from member where Memberid = '$id'");
	
	while($d = mysqli_fetch_array($sql))
	{
		$Gender = $d['Gender'];	
	}
	
	return $Gender;
}

function MemberMainProfilePic($id)
{
	include 'config.php';
	$sql = mysqli_query($db_con, "select * from member_profile where Memberid = '$id'");	
	
	$result = mysqli_num_rows($sql);
	
	$mgender = MemberGender($id);
	
	if($result > 0)
	{
		while($pp = mysqli_fetch_array($sql))
		{
			return "profile/profile_photo/". $pp['Memberid']."/".$pp['filename'];
		}
	}
	else
	{
		if($mgender == 'Female')
		{
			return "image/no-profile-picture-female.jpg";	
		}
		
		if($mgender == 'Male')
		{
			return "image/no-profile-picture-male.jpg";	
		}	
	}
}

function getMemberOnline()
{
	include 'config.php';
	include 'connections.core.inc.php';
	$sql = mysqli_query($db_con, "select * from member_online") or die(mysqli_error($db_con));
	date_default_timezone_set(getMemberTimezone($_SESSION['SessionMemberID']));
	
	while($mo = mysqli_fetch_array($sql))
	{
		if(in_array($mo['MemberId'], getMemberConnections($_SESSION['SessionMemberID'])))
		{
			?>
				<tr style="padding:6px 6px 6px 6px; cursor:pointer; font-size: 11px;" onClick="private_chat_show_with_link(<?php echo $mo['MemberId']; ?>);">
					<td>
						<img src="<?php echo MemberMainProfilePic($mo['MemberId']); ?>" style="width: 32px; height: 32px;" />
					</td>
					<td>
						<div id="online-panel-title" style="font-family:Arial; font-weight: bold; width:100%;"><?php echo MemberFullName($mo['MemberId']); ?></div>
					</td>
					<td style="font-size: 12px;">
					<?php 
						$MemberActiveTime_Min = $mo['ActiveTill'];
						$CurrentTime_Min = date("i");
						$CurrentDateTime = time();
						$MemberActiveDateTime = $mo['ActiveTill'];

						if(date("h:iA n/j/Y", $MemberActiveDateTime) == date("h:iA n/j/Y", $CurrentDateTime))
						{
							echo "<span style='color:green; font-family:Arial; font-weight:bold;'>Online</span>";
						}
						elseif(date("n/j/Y",$MemberActiveDateTime) == date("n/j/Y", $CurrentDateTime) && date("A",$CurrentDateTime) == date("A",$MemberActiveDateTime) && 
							date("i", $CurrentDateTime) > date("i", $MemberActiveDateTime) && date("i", $CurrentDateTime) + date("i", $MemberActiveDateTime) <= 59)
						{
							echo str_replace("-", "", date("i", $CurrentDateTime) + date("i", $MemberActiveDateTime)) . " m";
						}
						else
						{
							echo "<span style='color:red; font-family:Arial; font-weight:bold;'>Offline</span>";
						}
					?>
					</td>
				</tr>
			<?php
		}
	}
}

function check_if_member_active($memberid)
{
	include 'config.php';
	$sql = mysqli_query($db_con, "select * from member_online where Memberid = '$memberid'") or die(mysqli_error($db_con));
	return mysqli_num_rows($sql);
}

function gen_random_code($length) {
  $characters = "abcdefghijklmnopqrstuvwxyzABCDERFGHIJKLMNOPQRSTUVWXYZ0123456789";  
  $randomString = ""; 
	for ($i = 0; $i < $length; $i++) {
   	 	$randomString .= $characters[mt_rand(0, strlen($characters)-1)];
	}
  return $randomString;
}

function convertVideowall($file_name='',$source_directory='',$destination_directory='')
{

	$return_array = array();
	$value_return = "";

	$file_name_split = explode('.',$file_name);
	$source = "./".$source_directory."/".$file_name;
	$destination = $destination_directory."/flv/".$file_name_split[0].".flv";
	
	$ffmpeg = "../ffmpeg/bin/ffmpeg";

	shell_exec("$ffmpeg -i $source -ar 22050 -ab 32 -f flv -s 520x440 $destination");
	//exec("$ffmpeg -i $destination -an -ss 00:00:03 -an -r 1 -vframes 1 -y -s 300x275 -f mjpeg $destination_directory/thumb/$file_name_split[0].jpg",$return_array,$value_return);

	@unlink($source);

return $value_return;
}


function resizeImg($imgPath, $maxWidth, $maxHeight, $directOutput = true, $quality = 90, $verbose,$imageType,$ptype='')
{
   // get image size infos (0 width and 1 height,
   //     2 is (1 = GIF, 2 = JPG, 3 = PNG)
  
     $size = @getimagesize($imgPath);

   // break and return false if failed to read image infos
     if(!$size){
       if($verbose && !$directOutput)echo "<br />Not able to read image infos.<br />";
       return false;
     }

   // relation: width/height
     $relation = $size[0]/$size[1];
   // maximal size (if parameter == false, no resizing will be made)
     $maxSize = array($maxWidth?$maxWidth:$size[0],$maxHeight?$maxHeight:$size[1]);
   // declaring array for new size (initial value = original size)
     $newSize = $size;
   // width/height relation
     $relation = array($size[1]/$size[0], $size[0]/$size[1]);


	if(($newSize[0] > $maxWidth))
	{
		$newSize[0]=$maxSize[0];
		$newSize[1]=$newSize[0]*$relation[0];
	}
	
	

	/*
	if(($newSize[1] > $maxHeight))
	{
		$newSize[1]=$maxSize[1];
		$newSize[0]=$newSize[1]*$relation[1];
	}
	*/
	
     // create image

       switch($size[2])
       {
         case 1:
           if(@function_exists("imagecreatefromgif"))
           {
             $originalImage = @imagecreatefromgif($imgPath);
           }else{
             if($verbose && !$directOutput)echo "<br />No GIF support in this php installation, sorry.<br />";
             return false;
           }
           break;
         case 2: $originalImage = @imagecreatefromjpeg($imgPath); break;
         case 3: $originalImage = @imagecreatefrompng($imgPath); break;
         default:
           if($verbose && !$directOutput)echo "<br />No valid image type.<br />";
           return false;
       }


     // create new image

       $resizedImage = @imagecreatetruecolor($newSize[0], $newSize[1]); 

       @imagecopyresampled($resizedImage, $originalImage,0, 0, 0, 0,$newSize[0], $newSize[1], $size[0], $size[1]);

	$rz=$imgPath;
        
        if($ptype!=''){
            $ptyp =  explode('/',$ptype);
            $ptype =$ptyp[1];
        }else {
            $ptype = 'jpg';
        }
       //echo $ptype;exit;
       if($ptype=='jpeg'){
           $ptype = 'jpg';
       }
     // output or save
       if($directOutput)
		{
         @imagejpeg($resizedImage);
		 }
		 else
		{
			
			 $rz=preg_replace("/\.([a-zA-Z]{3,4})$/","".$imageType.".$ptype",$imgPath);
         @imagejpeg($resizedImage, $rz, $quality);
         }
     // return true if successfull
       return $rz;
}
?>