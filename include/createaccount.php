<?php
session_start();
include "config.php";
include 'mail.inc.php';
include 'core.inc.php';
require 'timezone.php';

$firstname =  trim(ucfirst($_POST['firstname']));
$lastname = trim(ucfirst($_POST['lastname']));
$email = trim(strtolower($_POST['email']));
$password = md5(trim($_POST['password']));
$bMonth = $_POST['dobMonth'];
$bDay = $_POST['dobDay'];
$bYear = $_POST['dobYear'];

$gender = '';

if(isset($_POST['genderf']))
{
	$gender = 'Female';	
}
else
{
	$gender = 'Male';	
}

$country = $_POST['country'];
$state = $_POST['state'];
$city = trim($_POST['city']);
$PhoneNumber = trim($_POST['phonenumber']);

$birthday = $bMonth . " / " . $bDay . " / " . $bYear;

$mdate = date("M, d Y");

$mobile_provider = $_POST['mobile_provider'];

$createaccount = mysqli_query($db_con, "INSERT INTO member (`Memberid`, `First`,`Last`,`Email`,`Password`,`Birthdate`, `Gender`, `Country`, `State`, `City`, `PhoneNumber` , `Mdate`) VALUES (NULL, '".$firstname."', '".$lastname."', '".$email."', '".$password."', '".$birthday."', '".$gender."', '".$country."', '".$state."', '".$city."', '".$PhoneNumber."', '".$mdate."' )");

$new_memberid = mysqli_insert_id($db_con);

$member_timezone = get_time_zone(getCountrybyShortname($country), getStatebyShortname($state));

$member_timezone_sql = mysqli_query($db_con, "INSERT INTO `member_timezone`(`id`, `Memberid`, `Timezone`) VALUES (NULL,'$new_memberid', '$member_timezone')");

$_SESSION['SessionMemberID'] = $new_memberid;
$_SESSION['SessionMemberPassword'] = $password;

setcookie("MemberID", $_SESSION['SessionMemberID'], time() + (86400 * 365), "/");
setcookie("MemberPassword", $_SESSION['SessionMemberPassword'], time() + (86400 * 365), "/");


$member_online = mysqli_query($db_con, "INSERT INTO `member_online`(`MemberId`, `LoggedOn`, `ActiveTill`, `Idle`, `Visible`) VALUES ('".$_SESSION['SessionMemberID']."','0','0','0','Y')");

$member_provider = mysqli_query($db_con, "INSERT INTO `member_mobile_provider`(`id`, `Memberid`, `Provider`) VALUES (NULL,'$new_memberid', '$mobile_provider')");

//Zack Notifiction New Connections
$sql = mysqli_query($db_con, "INSERT INTO `member_notification`(`id`, `Wallid`, `toMember`, `fromMember`, `Mode`, `vStatus`) VALUES (NULL, '0', '6', '$new_memberid', '8', '1')");

send_welcome_letter($_SESSION['SessionMemberID']);
send_security_mail($_SESSION['SessionMemberID']);
echo 1;
?>