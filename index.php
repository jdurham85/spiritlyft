<?php 
session_start();
include 'config.php';

if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off")
{
	//header("location: https://www.spiritlyft.com");
	//exit();
}

$useragent=$_SERVER['HTTP_USER_AGENT'];

if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
{
header('Location: m_index.php'); 
exit();
}

if(isset($_SESSION['SessionMemberID']) && $_SESSION['SessionMemberID'] !='')
{
	header("location: home.php");
	exit();
}
elseif(isset($_COOKIE['MemberID']) && isset($_COOKIE['MemberPassword']))
{
	$_SESSION['SessionMemberID'] = $_COOKIE['MemberID'];
	$_SESSION['SessionMemberPassword'] = $_COOKIE['MemberPassword'];
	header("location: home.php");	
	exit();
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/style1.css"/>
<?php include 'meta_header.php'; ?>
<title>SpiritLyft</title>
</head>
<body>
<script type="text/javascript" src="js/countries.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<header>
    	<div id="header_sub">
            <div id="title1"><img src="image/sl_logo2.png" style="margin-top: 10px;"/></div>
            <form id="loginfrm" method="post">
                <table>
                    <tr>
                        <td>
                            Email:
                        </td>
                        <td>
                            <input type="text" id="email1" name="email1" required/>
                        </td>
                        <td>Password: </td>
                        <td><input type="password" id="password1" name="password1" /></td>
                        <td>
                            <button id="loginbtn">Login</button>
                        </td>
                        <td>
                        	<a class="forgot-password" href="forgot-password.php" style="color:white;">Forgot Password</a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </header>
    <script type="text/javascript">
	function phoneNumber(tel) {
	var toString = String(tel),
		phoneNumber = toString.replace(/[^0-9]/g, ""),
		countArrayStr = phoneNumber.split(""),
		numberVar = countArrayStr.length,
		closeStr = countArrayStr.join("");
	if (numberVar == 10) {
		var phone = closeStr.replace(/(\d{3})(\d{3})(\d{4})/, "$1-$2-$3"); // Change number symbols here for numbers 10 digits in length. Just change the periods to what ever is needed.
	} else if (numberVar > 10) {
		var howMany = closeStr.length,
			subtract = (10 - howMany),
			phoneBeginning = closeStr.slice(0, subtract),
			phoneExtention = closeStr.slice(subtract),
			disX = "x", // Change the extension symbol here
			phoneBeginningReplace = phoneBeginning.replace(/(\d{3})(\d{3})(\d{4})/, "$1-$2-$3"), // Change number symbols here for numbers greater than 10 digits in length. Just change the periods and to what ever is needed. 
			array = [phoneBeginningReplace, disX, phoneExtention],
			afterarray = array.splice(1, 0, " "),
			phone = array.join("");
	
	} else {
		var phone = false;
	}
	return phone;
	}
	
	var checkExistEmail_Status = '';
	var checkCaptcha_Status = '';
	
	$(document).ready(function(){
		
	$("#loginfrm").submit(function(e) {
        e.preventDefault();
		
		if(document.getElementById("email1").value !='')
		{
			if(document.getElementById("password1").value !='')
			{
				$.ajax({
				  type: "POST",
				  url: "include/loginmember.php",
				  data: $("#loginfrm").serialize(),
				  success: function(m){
					  if(m == 1)
						{
							<?php 
								if(isset($_SESSION['sessionAfterLoginRedirect']) && !$_SESSION['sessionAfterLoginRedirect'] == "")
								{
									echo "document.location = '" . "https://" . $_SERVER['HTTP_HOST'].$_SESSION['sessionAfterLoginRedirect'] . "'"; 
									unset($_SESSION['sessionAfterLoginRedirect']);
								}
							else
							{
								?>
									document.location = "home.php";	
								<?php
							}
							?>
							
							
						}
						else
						{
							alert("Either your Email Address or Password is invaild, please try again.");	
						}
					}
				});
			}				
		}
		
    });
	
	$("#phonenumber").change(function(e) {
        if($(this).val().length = 10)
		{
			$(this).val(phoneNumber($(this).val()));
		}
    });
	
	$("#email").change(function() {
        if($(this).val().length >= 3)
		{
			$.post("include/checkExistEmail.php", {email: $("#email").val()}, function(m){
				checkExistEmail_Status = m;
			});	
		}
    });
	
	$("#captcha").change(function() {
        if($(this).val().length >= 4)
		{
			$.post("include/checkCaptcha.php", {captcha: $("#captcha").val()}, function(m){
				checkCaptcha_Status = m;
			});	
		}
    });
	
    function check_user_info(){
		
		var first = document.getElementById("firstname").value;
		var last = document.getElementById("lastname").value;
		var email = document.getElementById("email").value;
		var pword = document.getElementById("password").value;
		
		var bMonth = document.getElementById("dobMonth").value;
		var bMonth_index = document.getElementById("dobMonth").selectedIndex;
		
		var bDay = document.getElementById("dobDay").value;
		var bDay_index = document.getElementById("dobDay").selectedIndex;
		
		var bYear = document.getElementById("dobYear").value;
		var bYear_index = document.getElementById("dobYear").selectedIndex;
		
		var uCountry = document.getElementById("country").value;
		var uCountry_index = document.getElementById("country").selectedIndex;
		
		var uState = document.getElementById("state").value;
		var uState_index = document.getElementById("state").selectedIndex;
		
		var uCity = document.getElementById("city").value;
		
		var uPhoneNumber = document.getElementById("phonenumber").value;
		
		//var uCaptcha = document.getElementById("captcha").value;
		
		if(first == ''){document.getElementById("errorMessage").innerHTML = "Enter your First name"; return false;}
		if(last == ''){document.getElementById("errorMessage").innerHTML = "Enter your Last name"; return false;}
		
		if(email == '')
		{
			document.getElementById("errorMessage").innerHTML = "Enter your Email"; 
			return false;
		}
		else
		{
			$.post("include/checkExistEmail.php", {email: $("#email").val()}, function(m){
				checkExistEmail_Status = m;
				if(m == 1)
				{
					document.getElementById("errorMessage").innerHTML = "Email address already registered"; 
					return false;
				}
			});		
		}
			
		if(checkExistEmail_Status == 1)
		{
			document.getElementById("errorMessage").innerHTML = "Email address already registered"; 
			return false;	
		}
		
		if(pword == ''){document.getElementById("errorMessage").innerHTML = "Put in a New Password"; return false;}
		
		if(bMonth_index == 0){document.getElementById("errorMessage").innerHTML = "Select your birth month."; return false; }
		if(bDay_index == 0){document.getElementById("errorMessage").innerHTML = "Select your birth day."; return false; }
		if(bYear_index == 0){document.getElementById("errorMessage").innerHTML = "Select your birth year."; return false; }
		
		if(document.getElementById("genderf").checked == false )
		{
			if(document.getElementById("genderm").checked == false){document.getElementById("errorMessage").innerHTML = "Select your Gender."; return false;}
		}
		
		
		if(uCountry_index == 0)
		{
			document.getElementById("errorMessage").innerHTML = "Select your Country.";
			return false;
		}
		
		if(uState_index == 0)
		{
			document.getElementById("errorMessage").innerHTML = "Select your State.";
			return false;
		}
		
		if(uCity == '')
		{
			document.getElementById("errorMessage").innerHTML = "Enter your City";
			return false;	
		}
		
		/*if(uPhoneNumber == '')
		{
			document.getElementById("errorMessage").innerHTML = "Enter your Cell Phone Number.";
			return false;
		}
		
		if(document.getElementById("mobile_provider").selectedIndex == 0)
		{
			document.getElementById("errorMessage").innerHTML = "Select your mobile provider";
			return false;
		}*/
		
		if(document.getElementById("checkbox").checked == false)
		{
			alert('You must Agree to Terms and Condtions');
			return false;
		}
		
		/*if(uCaptcha == '')
		{
			document.getElementById("errorMessage").innerHTML = "Enter Captcha from below";
			return false;
		}
			
		if(checkCaptcha_Status == 0)
		{
			document.getElementById("errorMessage").innerHTML = "Re-Enter Captcha from below";
			return false;
		}*/
			
		document.getElementById("errorMessage").innerHTML = "";
		
		$("#create_account_btn").attr("disabled","disabled");
		$("#create_account_btn").html("Creating Account.....");
		
		return true;	
		
	}
	
	$("#signupfrm").submit(function(e) {
        e.preventDefault();
		
		if(check_user_info())
		{
			$.ajax({
			  type: "POST",
			  url: "include/createaccount.php",
			  data: $("#signupfrm").serialize(),
			  success: function(m){
				  	if(m == 1)
					{
						document.location = "home.php";
					}
				}
			});
		}
    });
	
	
});
    </script>
    <style>
    .site_info
	{
		font-family:Arial;
		font-size:18px;
		margin-top:10%;
		margin-left:30px;
		width:30%;
		position:fixed;
	}

	.site_info1
	{
		font-family:Arial;
		font-size:18px;
		right: 0;
		width:30%;
		top: 0;
		margin-right: 60px;
		margin-top: 20%;
		position:fixed;
	}
    </style>
    <div style="width: 30%; text-align: center; margin-top: 5%; float: left; font-weight: bold; font-size: 22px; font-family: Arial;">ALL SOCIAL &nbsp; - &nbsp; NO MEDIA</div>
    <div class="site_info">
        	Welcome to our site. We want you to enjoy and have a great time connecting with family and friends, in a positive and enjoyable way. <br><br>
            SpiritLyft does not allow any politics, nudity, bullying, threats or aggressive language.<br><br>
            We hope you enjoy the site and ask that you respect others.<br><br>
            Violation of terms of use or disrespecting others will result in your account being deleted. Thank you.
    </div>
	<div id="body" style="width:30%;">
    
        <table align="center">
        	<tr>
            	<td>
                	<form id="signupfrm" name="signupfrm" method="post"  action="" onSubmit="">
        	<table id="signup_tb" cellspacing="1" cellpadding="4">
            	<caption>Create Account</caption>
                    <tr>
                       <td id="errorMessage" colspan="2">
                          
                       </td>
                    </tr>
                    <tr>
                	<td colspan="1">
                    	<input type="text" id="firstname" name="firstname" placeholder="First Name" style="width:88%;" />
                    </td>
                    <td colspan="2">
                    	<input type="text" id="lastname" name="lastname" placeholder="Last Name" style="width:88%;" />
                   	</td>
                </tr>
                <tr>
                	<td colspan="3">
                    	<input type="email" id="email" name="email" placeholder="Email" style="width:94%;" />
                     </td>
                </tr>
                <tr>
                	<td colspan="3">
                    	<input type="password" id="password" name="password" placeholder="Create Password" style="width:94%;"  />
                    </td>
                </tr>
                <tr>
                	<td colspan="3" align="center">
                        <select id="dobMonth" name="dobMonth">
                                    <option value="">Month</option>
                                    <option value="1">Jan</option>
                                                                            <option value="2">Feb</option>
                                                                            <option value="3">Mar</option>
                                                                            <option value="4">Apr</option>
                                                                            <option value="5">May</option>
                                                                            <option value="6">Jun</option>
                                                                            <option value="7">Jul</option>
                                                                            <option value="8">Aug</option>
                                                                            <option value="9">Sep</option>
                                                                            <option value="10">Oct</option>
                                                                            <option value="11">Nov</option>
                                                                            <option value="12">Dec</option>
                                                                        </select>
                    	<select id="dobDay" name="dobDay">
                                     <option value="Day">Day</option>
                                    <option value="1">1</option>
                                                                            <option value="2">2</option>
                                                                            <option value="3">3</option>
                                                                            <option value="4">4</option>
                                                                            <option value="5">5</option>
                                                                            <option value="6">6</option>
                                                                            <option value="7">7</option>
                                                                            <option value="8">8</option>
                                                                            <option value="9">9</option>
                                                                            <option value="10">10</option>
                                                                            <option value="11">11</option>
                                                                            <option value="12">12</option>
                                                                            <option value="13">13</option>
                                                                            <option value="14">14</option>
                                                                            <option value="15">15</option>
                                                                            <option value="16">16</option>
                                                                            <option value="17">17</option>
                                                                            <option value="18">18</option>
                                                                            <option value="19">19</option>
                                                                            <option value="20">20</option>
                                                                            <option value="21">21</option>
                                                                            <option value="22">22</option>
                                                                            <option value="23">23</option>
                                                                            <option value="24">24</option>
                                                                            <option value="25">25</option>
                                                                            <option value="26">26</option>
                                                                            <option value="27">27</option>
                                                                            <option value="28">28</option>
                                                                            <option value="29">29</option>
                                                                            <option value="30">30</option>
                                                                            <option value="31">31</option>
                                                                        </select>
                    	<select id="dobYear" name="dobYear">
                        	<?php
								echo "<option value='Year'>Year</option>";
							
								$current_year = date("Y");
								$age_limit = $current_year - 18;
								
								$result = $age_limit;
								
								for($a=0;$a<=60;$a++)
								{
									echo "<option value='$result'>$result</option>";
									$result --;
								}
							?>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td colspan="2">
                    	Female: <input type="radio" id="genderf" name="genderf" onClick="checkradio_button();"  />
                    	<span style="float:right;" >Male: <input type="radio" id="genderm" name="genderm" onClick="checkradio_button2();" /></span>
                        <script type="application/javascript">
                        	function checkradio_button()
							{
								if(document.getElementById("genderm").checked == true)
								{
									document.getElementById("genderm").checked = false;	
								}
							}
							
							function checkradio_button2()
							{
								if(document.getElementById("genderf").checked == true)
								{
									document.getElementById("genderf").checked = false;	
								}
							}
                        </script>
                    </td>
                </tr>
                <tr>
                	<td colspan="3">
                    	<select id="country" name="country" style="width:100%;"></select>
                    </td>
                </tr>
                <tr>
                	<td colspan="3">
                    	<select name="state" id="state" style="width:100%;"></select>
                        <script language="javascript">
							populateCountries("country", "state");
						</script>
                    </td>
                </tr>
                <tr>
                	<td colspan="2">
                    	<input type="text" id="city" name="city" placeholder="City" style="width:96%;" />
                    </td>
                </tr>
                <tr>
                	<td colspan="2">
                    	<input type="text" id="phonenumber" name="phonenumber" placeholder="Cell Number (Optional)" maxlength="12" style="width:96%;"/>
                    </td>
                </tr>
                <tr>
                	<td colspan="3">
                		<select id="mobile_provider" name="mobile_provider" style="width: 100%;">
                			<option>Select your mobile provider (Optional)</option>
                			<?php 
								$sql = mysqli_query($db_con, "select * from cyber_gateways");
							
								while($mp = mysqli_fetch_array($sql))
								{
									echo '<option value="'.$mp['id'].'">'.$mp['provider'].'</option>';
								}
							?>
                		</select>
                	</td>
                </tr>
                <tr>
                	<td align="center" colspan="3">
                		<input type="checkbox" id="checkbox" /> I agree to <a href="terms-conditions.php">Terms of Use</a>
                	</td>
                </tr>
                <tr>
                	<td colspan="3">
                    	<button id="create_account_btn" style="width:100%; padding:6px 6px 6px 6px; border-radius:2px; font-family:Arial; font-size:16px; font-weight:bold; color:white; background-color:#4A338E;">Create Account</button>
                    </td>
                </tr>
            </table>
            
           <iframe id="signupfrm_frame" name="signupfrm_frame" style="display:none;"></iframe>
        </form>
                </td>
            	<!--td>
               	  <table width="100%" style="font-family:Arial; display:none; margin-right:80px; color:white; height:400px;">
                        <tr>
                            <td height="118" align="center" style="font-size:22px; font-weight:bold;">
                                Positive and Uplifting Friend & Family Site
                            </td>
                        </tr>
                        <tr>
                        	<td height="94"  colspan="2" align="center">Your privacy is important to us.</td>
                        </tr>
                        <tr>
                        	<td height="89"  colspan="2" align="center">Check out Little Blue Your Personal Secretary to never miss a important event.</td>
                        </tr>
                        <tr>
                        	<td height="75"  colspan="2" align="center">Stay Happy with Friends &amp; Family</td>
                        </tr>
                    </table> 
              </td-->
          </tr>
        </table>
    </div>
    <div class="site_info1">
        	Phone Number is optional, However, you will not be able to receive text alerts for Calendar Events. Also your phone number is secure and will not be sold.
    </div>
</body>
</html>