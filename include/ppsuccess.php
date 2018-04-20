<?php 
include 'gifts.inc.php';

$txtPaypalEmail = "tyres1997@gmail.com";
$txtPaypalAuthtoken = "ghNVuOboAWtnTDNmisqkWamXHmXOA1Wyuevw6_kgmVFfpnnZZTacJSly9VO";

$paypalurl = "www.sandbox.paypal.com";

$flag_to_continue=false;

//Data check for PDT and proceeded further
// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-synch';

//$tx_token = $_GET['tx'];
$auth_token=$txtPaypalAuthtoken;
//$req .= "&tx=$tx_token&at=$auth_token";
$req .= "&at=$auth_token";

// post back to PayPal system to validate
$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
//$fp = fsockopen ($paypalurl, 80, $errno, $errstr, 30);
	$fp = fsockopen ('ssl://'.$paypalurl, 443, $errno, $errstr, 30);

if (!$fp) 
{
		// HTTP ERROR
}//end if
else 
{
		fputs ($fp, $header . $req);
		// read the body data
		$res = '';
		$headerdone = false;
		while (!feof($fp)) 
		{
			$line = fgets ($fp, 1024);
			if (strcmp($line, "\r\n") == 0) 
			{
					// read the header
					$headerdone = true;
			}//end if
			else if ($headerdone)
			{
					// header has been read. now read the contents
					$res .= $line;
			}//end else if
		}//end while

		// parse the data
		$lines = explode("\n", $res);
		$keyarray = array();
		//echo($lines[0] . " here");
		if (strcmp ($lines[0], "SUCCESS") == 0) 
		{
			for ($i=1; $i<count($lines);$i++)
			{
					list($key,$val) = explode("=", $lines[$i]);
					//echo "$key::$val <br>";
					$keyarray[urldecode($key)] = urldecode($val);
			}//end for loop
			
			// check the payment_status is Completed
			// check that txn_id has not been previously processed
			// check that receiver_email is your Primary PayPal email
			// check that payment_amount/payment_currency are correct
			// process payment
			$flag_to_continue=true;
			
		}//end if
			
		else if (strcmp ($lines[0], "FAIL") == 0) 
		{
				// log for manual investigation
				//		echo("Fail in result");
				$flag_to_continue=false;
		}//end else if

	}//end else

	//echo "<br>-------------subscribersid==".$keyarray["subscr_id"];
	//echo "<br>-------------transactionID==".$keyarray["txn_id"];
			if($txtPaypalSandbox == "Y"){
				$flag_to_continue=true;
			}
	fclose ($fp);
	if($flag_to_continue == true)
	{
		$totaltopay=$cart->getTotalAmount();

		$qry1="select max(Id)+1 as ordid from member_gifts";
		$excqry1=mysql_query($qry1);
		$row1=mysql_fetch_array($excqry1);
		$Inv_id=$row1['ordid'];

		foreach($cart->cart as $key => $item_object)
		{
			$qty            = $item_object->quantity;
			$GiftId			= $item_object->giftId;
			$price           =  adjustAfterDecimal($item_object->price);

			$sqlIns = " INSERT INTO member_gifts ( GiftId, GiftBoxId, Message, Private,SenderShow, MemberIdBy, MemberIdTo,	Posted_Date, Quantity, Price, Status ) 
				VALUES (
				'$GiftId', 
				'".$_SESSION['sess_GiftBoxId']."',
				'".$_SESSION['sess_Message']."',
				'".$_SESSION['sess_Type']."',
				'".$_SESSION['sess_SenderShow']."',
				'".$_SESSION['sessionMemberId']."',
				'".$MemberIdTo2."',
				now(),
				'$qty',
				'$price',
				'Pending'
				)";
		mysql_query($sqlIns) or die(mysql_error());

	}
	//sending mail to the receipent
	$email=$profileId;
	$subject='Gift from '.$_SESSION['sessionScreenName'];
	$mailBody='You got gift from your friend '.$_SESSION['sessionScreenName'];
	$from_email=$_SESSION['sessionMemberEmail'];
	$from_name=$_SESSION['sessionScreenName'];
	send_mail($email,$subject,$mailBody,$from_email,$from_name,$html=FALSE);

	$_SESSION['sessionMessage'] = " Your gift sent successfully ! ";
	unset($_SESSION['cart']);
	unset($_SESSION['sess_GiftBoxId']);
	unset($_SESSION['sess_Message']);
	unset($_SESSION['sess_Type']);
	unset($_SESSION['sess_SenderShow']);
	unset($_SESSION['sess_profileId']);
	header("location: ../vgift_conf.php?MemberIdTo=$MemberIdTo2");
	exit();
}//end payemnt if
if($flag_to_continue!=true)
{
		$_SESSION['sessionMessage']='There was an error in your payment process.Please contact <a href="mailto:'.$config['adminMail'].'">'.$config['adminMail'].'</a> for details.';
		header('location:../vgift_review_payment.php?paymentMethodSel='.$_GET['paymentMethodSel']);
		exit();
}//end else


?>