<?php 
session_start();
include 'config.php'; 

if(isset($_SESSION['SessionMemberID']) && $_SESSION['SessionMemberID'] !='')
{
	header("location: app_home.php");	
}

if(!isset($_SESSION['APP_MODE']) && $_SESSION['APP_MODE'] != 1)
{
	$_SESSION['APP_MODE'] = 1;
}


?>
<!doctype html>
<html>
<head>
<!-- Include meta tag to ensure proper rendering and touch zooming -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Include jQuery Mobile stylesheets -->
<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">

<!-- Include the jQuery library -->
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Include the jQuery Mobile library -->
<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

<link rel="stylesheet" href="css/style1_m.css"/>
<title>SpiritLyft</title>
</head>
<body>
<script type="text/javascript" src="js/countries.js"></script>
<header>
    	<div id="header_sub">
            <div id="title1"><img src="image/sl_logo2.png" style="margin-top: 10px;"/></div>
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
							document.location = "app_home.php";	
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
	/*
	$("#captcha").change(function() {
        if($(this).val().length >= 4)
		{
			$.post("include/checkCaptcha.php", {captcha: $("#captcha").val()}, function(m){
				checkCaptcha_Status = m;
			});	
		}
    });*/
	
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
		
		$(document).scrollTop(0);
		
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
		
		$(this).scrollTop($(this).height());
		
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
			  success: function(){
				  document.location = "m_home.php";
				}
			});
		}
    });
	
	
});
    </script>
	<div id="body">
        <table align="center" width="100%">
        	<tr>
            	<td>
            <form id="signupfrm" name="signupfrm" method="post"  action="" onSubmit="">
        	<table id="signup_tb" cellspacing="6" cellpadding="6">
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
                <!--tr>
                	<td colspan="2">
                    	<input type="text" id="captcha" name="captcha" placeholder="Enter Captcha Below" style="width:96%;"/>
                    </td>
                </tr>
                <tr>
                	<td colspan="2" align="center">
                    	<img id="captcha_img" name="captcha_img" src="include/captcha.php" width="20%" />
                    </td>
                </tr-->
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
                		<input type="checkbox" id="checkbox" /> I agree to <a href="m_terms-conditions.php">Terms of Use</a>
                	</td>
                </tr>
                <tr>
                	<td colspan="3">
                    	<button id="create_account_btn" data-ajax="false" style="width:100%; padding:12px 12px 12px 12px; border-radius:2px; font-family:Arial; font-size:18px; font-weight:bold; color:white; background-color:#4A338E;">Create Account</button>
                    </td>
                </tr>
            </table>
            
           <iframe id="signupfrm_frame" name="signupfrm_frame" style="display:none;">
           		
           </iframe>
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
</body>
</html>