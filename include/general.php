<?php 
session_start();
include 'config.php';
include 'core.inc.php';
?>
<style>
.general_tab
{
	width:100%;
	border-top: 1px black solid;
}

.general_header
{
	font-family:Arial Black;
	color:black;
	padding:12px 0px 12px 12px;
	background-color:#E4E4E4;
	width:98%;
}

.general_body
{
	color:black;
	font-family:Arial;
	font-size:12px;
	font-weight:bold;
}

.general_body button
{
	color:white;
	font-family:Arial;
	font-size:12px;
	font-weight:bold;
	background-color:#4A338E;
	border-radius:4px;
	padding:4px 4px 4px 4px;
}

.general_password_input{
	display:none;
}

.general_password_input input{
	padding:12px 12px 12px 12px;
	width:100%;
}

#password_error_message
{
	color:red;
	font-weight:bold;
	font-size:12px;
	font-family:Arial;
}

.general_phonenumber_input
{
 display:none;
}

#general_phonenumber_message
{
	font-weight:bold;
	font-size:12px;
	font-family:Arial;
	color:green;
}

.general_phonenumber_input input
{
	padding:12px 12px 12px 12px;
	width:100%
}
</style>
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

function general_password_input_show()
{
	$(".general_password_input").fadeIn();
	$("#general_password_input_btn").html("Close");
	$("#general_password_input_btn").attr("onclick", "general_password_input_hide();");
	$("#password_error_message").html("");
}

function general_password_input_hide()
{
	$(".general_password_input").fadeOut();
	$("#general_password_input_btn").html("Edit");
	$("#general_password_input_btn").attr("onclick", "general_password_input_show();");
}

function checkpassword()
{
	
  if($("#oldpassword").val() !="" || !document.getElementById("newpassword").value == "" || !document.getElementById("retypepassword").value == "")
  {
		$.post("include/checkpassword.php", {oldpassword: $("#oldpassword").val()}, function(result){
				  
				  if(result)
				  {
					  $("#password_error_message").html("That is not your old password, please try again");	
					  return false;	
				  }
				  else
				  {
					  $("#password_error_message").html("");	
				  }
			  });
		
		if(!document.getElementById("newpassword").value == document.getElementById("retypepassword").value)
		{
			alert('NewPassword and Retype Password do not match');
			$("#password_error_message").html("NewPassword and Retype Password do not match");	
			return false;
		}  
  }
	
	return true;
}

function savepassword()
{
	if(checkpassword())
	{
		$.post("include/updatepassword.php", {newpassword: $("#newpassword").val()}, function(a){
			if(a == 1)
			{
				$("#password_error_message").html("Password has been successfully changed.");
				$("#password_error_message").css("color", "green");	
			}
			else
			{
				$("#password_error_message").html("Password has not been successfully changed, please try again later.");		
			}
		  });
	}	
}

function general_phonenumber_input_show()
{
	$(".general_phonenumber_input").fadeIn();
	$("#general_phonenumber_btn").attr("onclick", "general_phonenumber_input_hide();");
	$("#general_phonenumber_btn").html("Close");
}

function general_phonenumber_input_hide()
{
	$(".general_phonenumber_input").fadeOut();
	$("#general_phonenumber_btn").attr("onclick", "general_phonenumber_input_show();");
	$("#general_phonenumber_btn").html("Edit");
	$("#general_phonenumber_message").html("");	
	$("#newphonenumber").val("")
}

function updatephonenumber()
{
	if($("#newphonenumber").val().length = 10)
	{
		$("#newphonenumber").val(phoneNumber($("#newphonenumber").val()));
		
		//general_phonenumber_message
		
		$.post("include/updatephonenumber.php", {newphonenumber: $("#newphonenumber").val()}, function(result){
				if(result == 1)
				{
					$("#member_phonenumber").html($("#newphonenumber").val());
					$("#general_phonenumber_message").html("Phone Number is been successfully updated.");	
				}
			});
	}
}

function cancel_account()
{
	window.location = "account_cancel.php";	
}
	
$(document).ready(function(){
	$("#mytimezone").val("<?php echo getMemberTimezone($_SESSION['SessionMemberID']); ?>"); 
});
	
function changeMemberTimezone()
{
	var newtimezone = document.getElementById("mytimezone")[document.getElementById("mytimezone").selectedIndex].value;
	
	if(confirm("Are you sure you want to change your timezone?"))
	{
		$.post("include/setTimezone.php",{Timezone: newtimezone}, function(timezone){
			$("#mytimezone").val(timezone);
		});
	}
}
</script>


<div class="general_tab">
	<div class="general_header">
    	Account Information
    </div>
    <div class="general_body">
    	<table align="center" width="400" cellspacing="2" cellpadding="2">
        	<tr>
            	<td>
                	Name:
                </td>
                <td>
                	<?php echo MemberFullName($_SESSION['SessionMemberID']); ?>
                </td>
            </tr>
            
            <tr>
            	<td>
                	Email:
                </td>
                <td>
                	<?php echo MemberEmail($_SESSION['SessionMemberID']); ?>
                </td>
            </tr>
            
            <tr>
            	<td>
                	Password:
                </td>
                <td id="fakepword">
                	*************
                </td>
                <td>
                	<button id="general_password_input_btn" onClick="general_password_input_show();">Edit</button>
                </td>
            </tr>
            
             <tr class="general_password_input">
            	<td colspan="2" id="password_error_message" align="center">
                	Error Message 
                </td>
            </tr>
            
            <tr class="general_password_input">
            	<td>
                	Old Password: 
                </td>
                <td>
                	<input type="password" id="oldpassword" name="oldpassword" />
                </td>
            </tr>
            
             <tr class="general_password_input">
            	<td>
                	New Password: 
                </td>
                <td>
                	<input type="password" id="newpassword" name="newpassword" />
                </td>
            </tr>
            
             <tr class="general_password_input">
            	<td>
                	ReType Password: 
                </td>
                <td>
                	<input type="password" id="retypepassword" name="retypepassword" />
                </td>
            </tr>
            
            <tr class="general_password_input">
            	<td>
                	
                </td>
                <td>
                	<button onClick="savepassword();">Save</button>
                </td>
            </tr>
            
            <tr>
            	<td>
                	Phone Number:
                </td>
                <td id="member_phonenumber">
                	<?php echo MemberPhoneNumber($_SESSION['SessionMemberID']); ?>
                </td>
                <td>
                	<button id="general_phonenumber_btn" onClick="general_phonenumber_input_show();">Edit</button>
                </td>
            </tr>
            
            <tr class="general_phonenumber_input">
                <td>
	
                </td>
                <td id="general_phonenumber_message">
                
                </td>
            </tr>
            
            <tr class="general_phonenumber_input">
            	<td>
                	Phone Number:
                </td>
                <td>
                	<input type="text" id="newphonenumber" name="newphonenumber" />
                </td>
            </tr>
            
            <tr class="general_phonenumber_input">
                <td id="general_phonenumber_message">
                </td>
                <td>
                	<button id="general_phonenumber_savebtn" onClick="updatephonenumber();">Save</button>
                </td>
            </tr>
            
            
        </table>
    </div>
    <div class="general_header">
    	Cancel Account
    </div>
    <div class="general_body">
    	<table align="center">
        	<tr>
            	<td>
                	<button onClick="cancel_account();">Cancel Account</button>
                </td>
            </tr>
        </table>
    </div>
    
    <div class="general_header">
    	My Timezone
    </div>
    <div class="general_body">
    	<table align="center">
        	<tr>
            	<td align="center">
                	<select id="mytimezone" style="padding:12px 12px 12px 12px; font-size: 12px;">
                		<option value="Pacific/Midway">(GMT-11:00) Midway Island, Samoa</option>
						<option value="America/Adak">(GMT-10:00) Hawaii-Aleutian</option>
						<option value="Etc/GMT+10">(GMT-10:00) Hawaii</option>
						<option value="Pacific/Marquesas">(GMT-09:30) Marquesas Islands</option>
						<option value="Pacific/Gambier">(GMT-09:00) Gambier Islands</option>
						<option value="America/Anchorage">(GMT-09:00) Alaska</option>
						<option value="America/Ensenada">(GMT-08:00) Tijuana, Baja California</option>
						<option value="Etc/GMT+8">(GMT-08:00) Pitcairn Islands</option>
						<option value="America/Los_Angeles">(GMT-08:00) Pacific Time (US & Canada)</option>
						<option value="America/Denver">(GMT-07:00) Mountain Time (US & Canada)</option>
						<option value="America/Chihuahua">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
						<option value="America/Dawson_Creek">(GMT-07:00) Arizona</option>
						<option value="America/Belize">(GMT-06:00) Saskatchewan, Central America</option>
						<option value="America/Cancun">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
						<option value="Chile/EasterIsland">(GMT-06:00) Easter Island</option>
						<option value="America/Chicago">(GMT-06:00) Central Time (US & Canada)</option>
						<option value="America/New_York">(GMT-05:00) Eastern Time (US & Canada)</option>
						<option value="America/Havana">(GMT-05:00) Cuba</option>
						<option value="America/Bogota">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
						<option value="America/Caracas">(GMT-04:30) Caracas</option>
						<option value="America/Santiago">(GMT-04:00) Santiago</option>
						<option value="America/La_Paz">(GMT-04:00) La Paz</option>
						<option value="Atlantic/Stanley">(GMT-04:00) Faukland Islands</option>
						<option value="America/Campo_Grande">(GMT-04:00) Brazil</option>
						<option value="America/Goose_Bay">(GMT-04:00) Atlantic Time (Goose Bay)</option>
						<option value="America/Glace_Bay">(GMT-04:00) Atlantic Time (Canada)</option>
						<option value="America/St_Johns">(GMT-03:30) Newfoundland</option>
						<option value="America/Araguaina">(GMT-03:00) UTC-3</option>
						<option value="America/Montevideo">(GMT-03:00) Montevideo</option>
						<option value="America/Miquelon">(GMT-03:00) Miquelon, St. Pierre</option>
						<option value="America/Godthab">(GMT-03:00) Greenland</option>
						<option value="America/Argentina/Buenos_Aires">(GMT-03:00) Buenos Aires</option>
						<option value="America/Sao_Paulo">(GMT-03:00) Brasilia</option>
						<option value="America/Noronha">(GMT-02:00) Mid-Atlantic</option>
						<option value="Atlantic/Cape_Verde">(GMT-01:00) Cape Verde Is.</option>
						<option value="Atlantic/Azores">(GMT-01:00) Azores</option>
						<option value="Europe/Belfast">(GMT) Greenwich Mean Time : Belfast</option>
						<option value="Europe/Dublin">(GMT) Greenwich Mean Time : Dublin</option>
						<option value="Europe/Lisbon">(GMT) Greenwich Mean Time : Lisbon</option>
						<option value="Europe/London">(GMT) Greenwich Mean Time : London</option>
						<option value="Africa/Abidjan">(GMT) Monrovia, Reykjavik</option>
						<option value="Europe/Amsterdam">(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
						<option value="Europe/Belgrade">(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option>
						<option value="Europe/Brussels">(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option>
						<option value="Africa/Algiers">(GMT+01:00) West Central Africa</option>
						<option value="Africa/Windhoek">(GMT+01:00) Windhoek</option>
						<option value="Asia/Beirut">(GMT+02:00) Beirut</option>
						<option value="Africa/Cairo">(GMT+02:00) Cairo</option>
						<option value="Asia/Gaza">(GMT+02:00) Gaza</option>
						<option value="Africa/Blantyre">(GMT+02:00) Harare, Pretoria</option>
						<option value="Asia/Jerusalem">(GMT+02:00) Jerusalem</option>
						<option value="Europe/Minsk">(GMT+02:00) Minsk</option>
						<option value="Asia/Damascus">(GMT+02:00) Syria</option>
						<option value="Europe/Moscow">(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
						<option value="Africa/Addis_Ababa">(GMT+03:00) Nairobi</option>
						<option value="Asia/Tehran">(GMT+03:30) Tehran</option>
						<option value="Asia/Dubai">(GMT+04:00) Abu Dhabi, Muscat</option>
						<option value="Asia/Yerevan">(GMT+04:00) Yerevan</option>
						<option value="Asia/Kabul">(GMT+04:30) Kabul</option>
						<option value="Asia/Yekaterinburg">(GMT+05:00) Ekaterinburg</option>
						<option value="Asia/Tashkent">(GMT+05:00) Tashkent</option>
						<option value="Asia/Kolkata">(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
						<option value="Asia/Katmandu">(GMT+05:45) Kathmandu</option>
						<option value="Asia/Dhaka">(GMT+06:00) Astana, Dhaka</option>
						<option value="Asia/Novosibirsk">(GMT+06:00) Novosibirsk</option>
						<option value="Asia/Rangoon">(GMT+06:30) Yangon (Rangoon)</option>
						<option value="Asia/Bangkok">(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
						<option value="Asia/Krasnoyarsk">(GMT+07:00) Krasnoyarsk</option>
						<option value="Asia/Hong_Kong">(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
						<option value="Asia/Irkutsk">(GMT+08:00) Irkutsk, Ulaan Bataar</option>
						<option value="Australia/Perth">(GMT+08:00) Perth</option>
						<option value="Australia/Eucla">(GMT+08:45) Eucla</option>
						<option value="Asia/Tokyo">(GMT+09:00) Osaka, Sapporo, Tokyo</option>
						<option value="Asia/Seoul">(GMT+09:00) Seoul</option>
						<option value="Asia/Yakutsk">(GMT+09:00) Yakutsk</option>
						<option value="Australia/Adelaide">(GMT+09:30) Adelaide</option>
						<option value="Australia/Darwin">(GMT+09:30) Darwin</option>
						<option value="Australia/Brisbane">(GMT+10:00) Brisbane</option>
						<option value="Australia/Hobart">(GMT+10:00) Hobart</option>
						<option value="Asia/Vladivostok">(GMT+10:00) Vladivostok</option>
						<option value="Australia/Lord_Howe">(GMT+10:30) Lord Howe Island</option>
						<option value="Etc/GMT-11">(GMT+11:00) Solomon Is., New Caledonia</option>
						<option value="Asia/Magadan">(GMT+11:00) Magadan</option>
						<option value="Pacific/Norfolk">(GMT+11:30) Norfolk Island</option>
						<option value="Asia/Anadyr">(GMT+12:00) Anadyr, Kamchatka</option>
						<option value="Pacific/Auckland">(GMT+12:00) Auckland, Wellington</option>
						<option value="Etc/GMT-12">(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
						<option value="Pacific/Chatham">(GMT+12:45) Chatham Islands</option>
						<option value="Pacific/Tongatapu">(GMT+13:00) Nuku'alofa</option>
						<option value="Pacific/Kiritimati">(GMT+14:00) Kiritimati</option>
                	</select>
                </td>
            </tr>
            <tr>
            	<td align="center">
            		<button onClick="changeMemberTimezone();">Save Timezone</button>
            	</td>
            </tr>
        </table>
    </div>
</div>