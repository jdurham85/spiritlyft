<?php 
session_start();
include 'config.php';

$useragent=$_SERVER['HTTP_USER_AGENT'];

if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
{
	header("location: m_privacy_policy.php");	
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
		<div id="title1"><img src="image/sl_logo2.png" /></div>
	</div>
</header>
<script type="text/javascript">
</script>
<style>
.site_info
{
	font-family:Arial;
	font-size:18px;
	width:100%;
}
</style>

<div id="body" style="width:80%;">
	<div class="site_info">
	<div class=WordSection1>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;mso-outline-level:
1'><span style='font-size:10.5pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#55307C;mso-font-kerning:18.0pt'>Cre8-Adate, LLC
Privacy Policy<o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><b><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>Last Updated: June 16, 2017<o:p></o:p></span></b></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
class=SpellE><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
mso-fareast-font-family:"Times New Roman";color:#4F4857'>SpiritLyft</span></span><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>, owned and operated by Cre8-Adate, LLC,
respects the privacy of its users and has developed this Privacy Policy to
demonstrate its commitment to protecting your privacy. This Privacy Policy
describes the information we collect, how that information may be used, and
with whom it may be shared about such uses and disclosures. We encourage you to
read this Privacy Policy carefully whenever using our website or services or
transacting business with us. By using our website, application or other online
services, you are accepting the practices described in this Privacy Policy.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>If you have any questions about our privacy
practices, please refer to the end of this Privacy Policy for information on
how to contact us.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><b><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>Information we collect about you</span></b><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'><o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><u><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>In <span class=GramE>General</span></span></u><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>. We may collect Personal Information, including
Sensitive Data, and other information. &quot;Personal Information&quot; means
individually identifiable information that would allow us to determine the
actual identity of, and contact, a specific living person. Sensitive Data
includes information, comments or content (e.g. photographs, video, profile)
that you optionally provide that may reveal your ethnic origin, nationality, or
religion. By providing Sensitive Data to us, you consent to the collection, use
and disclosure of Sensitive Data as permitted by applicable privacy laws. We
may also collect your geolocation information with your consent. We may collect
this information through a website, mobile application or other online service.
When you provide personal information, the information may be sent to servers
located in the United States and other countries around the world.<o:p></o:p></span></p>

<ul type=disc>
 <li class=MsoNormal style='color:#4F4857;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;mso-list:l5 level1 lfo1;tab-stops:list .5in'><b><span
     style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
     "Times New Roman"'>Information you provide</span></b><span
     style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
     "Times New Roman"'>. We may collect and store any personal information you
     enter on our website or on a mobile application, or provide to us in some
     other manner. This includes identifying information, such as your name,
     address, email address and telephone number, and, if you transact business
     with us, financial information such as your payment method (valid credit
     card number, type, expiration date or other financial information). You
     may also provide us information about your interests and activities, your
     gender and age, and other demographic information such as your hometown or
     your username.<o:p></o:p></span></li>
 <li class=MsoNormal style='color:#4F4857;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;mso-list:l5 level1 lfo1;tab-stops:list .5in'><b><span
     style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
     "Times New Roman"'>Information about others</span></b><span
     style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
     "Times New Roman"'>. We may collect and store personal information about
     other people that you provide to us, such as their name, address and email
     address. If you use our website or application to send others (friends,
     relatives, colleagues, etc.) a product as a gift, we may store your
     personal information, and the personal information of each such recipient
     in order to process those requests or facilitate future activities.<o:p></o:p></span></li>
</ul>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><u><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>Use of cookies and other technologies to
collect information</span></u><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
mso-fareast-font-family:"Times New Roman";color:#4F4857'>. We use various
technologies to collect information from your device and about your activities
on our site or application.<o:p></o:p></span></p>

<ul type=disc>
 <li class=MsoNormal style='color:#4F4857;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;mso-list:l0 level1 lfo2;tab-stops:list .5in'><b><span
     style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
     "Times New Roman"'>Information collected automatically</span></b><span
     style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
     "Times New Roman"'>. We automatically collect information from your
     browser or device when you visit our website or application. This
     information could include your IP address, device ID, your browser type
     and language, access times, the content of any undeleted cookies that your
     browser previously accepted from us (see &quot;</span><span
     style='color:windowtext'>
     <span
     style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
     "Times New Roman";color:#009FDB;text-decoration:none;text-underline:none'>Cookies</span></span><span
     style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
     "Times New Roman"'>&quot; below), and the referring website address.<o:p></o:p></span></li>
 <li class=MsoNormal style='color:#4F4857;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;mso-list:l0 level1 lfo2;tab-stops:list .5in'><b><span
     style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
     "Times New Roman"'>Cookies and use of cookie and similar data</span></b><span
     style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
     "Times New Roman"'>. When you visit our website or application, we may
     assign your device one or more cookies, to facilitate access to our site
     and to personalize your online experience. Through the use of a cookie, we
     also may automatically collect information about your online activity on
     our site, such as the pages you visit, the time and date of your visits,
     the links you click, and the searches you conduct on our site. Most
     browsers automatically accept cookies, but you can usually modify your
     browser setting to decline cookies. If you choose to decline cookies,
     please note that you may not be able to sign in or use some of the
     interactive features offered on our site.<o:p></o:p></span></li>
 <li class=MsoNormal style='color:#4F4857;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;mso-list:l0 level1 lfo2;tab-stops:list .5in'><b><span
     style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
     "Times New Roman"'>Other Technologies</span></b><span style='font-size:
     10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:"Times New Roman"'>.
     We may use standard Internet technology, such as web beacons, pixel tags,
     local storage and other technologies that facilitate personalization to
     track your use of our site. We also may include web beacons in
     advertisements or email messages to determine whether messages have been
     opened and acted upon. The information we obtain in this manner enables us
     to customize the services we offer our website or application visitors to
     deliver targeted advertisements and to measure the overall effectiveness
     of our online advertising, content, programming or other activities.<o:p></o:p></span></li>
 <li class=MsoNormal style='color:#4F4857;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;mso-list:l0 level1 lfo2;tab-stops:list .5in'><b><span
     style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
     "Times New Roman"'>Information collected by third-parties</span></b><span
     style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
     "Times New Roman"'>. We may allow service providers, advertising companies
     and ad networks, and other third parties to display advertisements on our
     site. These companies may use tracking technologies, such as cookies, to
     collect information about users who view or interact with their
     advertisements. We do not provide any non-anonymized personal information
     to these third parties. Some of these third-party advertising companies
     may be advertising networks that are members of the Network Advertising
     Initiative, which offers a single location to opt out of ad targeting from
     member companies (</span><span style='color:windowtext'><a
     href="http://www.networkadvertising.org/" target="_blank"><span
     style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
     "Times New Roman";color:#009FDB;text-decoration:none;text-underline:none'>www.networkadvertising.org</span></a></span><span
     style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
     "Times New Roman"'>).<o:p></o:p></span></li>
</ul>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><b><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>How we use the information we collect</span></b><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'><o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><u><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>In <span class=GramE>General</span></span></u><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>. We may use information that we collect about
you to:<o:p></o:p></span></p>

<ul type=disc>
 <li class=MsoNormal style='color:#4F4857;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;mso-list:l2 level1 lfo3;tab-stops:list .5in'><span style='font-size:
     10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:"Times New Roman"'>deliver
     our products and services, and manage our business;<o:p></o:p></span></li>
 <li class=MsoNormal style='color:#4F4857;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;mso-list:l2 level1 lfo3;tab-stops:list .5in'><span style='font-size:
     10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:"Times New Roman"'>manage
     your account and provide you with customer support;<o:p></o:p></span></li>
 <li class=MsoNormal style='color:#4F4857;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;mso-list:l2 level1 lfo3;tab-stops:list .5in'><span style='font-size:
     10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:"Times New Roman"'>perform
     research and analysis;<o:p></o:p></span></li>
 <li class=MsoNormal style='color:#4F4857;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;mso-list:l2 level1 lfo3;tab-stops:list .5in'><span style='font-size:
     10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:"Times New Roman"'>communicate
     with you about products or services that may be of interest to you either
     from us or other third parties;<o:p></o:p></span></li>
 <li class=MsoNormal style='color:#4F4857;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;mso-list:l2 level1 lfo3;tab-stops:list .5in'><span style='font-size:
     10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:"Times New Roman"'>develop
     and display content and advertising tailored to your interests on our site
     and other sites, including providing our advertisements to you when you
     visit other sites;<o:p></o:p></span></li>
 <li class=MsoNormal style='color:#4F4857;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;mso-list:l2 level1 lfo3;tab-stops:list .5in'><span style='font-size:
     10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:"Times New Roman"'>perform
     ad tracking and website or mobile application analytics;<o:p></o:p></span></li>
 <li class=MsoNormal style='color:#4F4857;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;mso-list:l2 level1 lfo3;tab-stops:list .5in'><span style='font-size:
     10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:"Times New Roman"'>verify
     your eligibility and deliver prizes in connection with contests and
     sweepstakes;<o:p></o:p></span></li>
 <li class=MsoNormal style='color:#4F4857;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;mso-list:l2 level1 lfo3;tab-stops:list .5in'><span style='font-size:
     10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:"Times New Roman"'>enforce
     or exercise any rights in our Terms of Use; and<o:p></o:p></span></li>
 <li class=MsoNormal style='color:#4F4857;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;mso-list:l2 level1 lfo3;tab-stops:list .5in'><span style='font-size:
     10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:"Times New Roman"'>perform
     functions as otherwise described to you at the time of collection.<o:p></o:p></span></li>
 <li class=MsoNormal style='color:#4F4857;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;mso-list:l2 level1 lfo3;tab-stops:list .5in'><span style='font-size:
     10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:"Times New Roman"'>personal
     information may be sold to second and third parties at our discretion.<o:p></o:p></span></li>
</ul>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><u><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>Financial information</span></u><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>. We may use financial information or payment
method to (<span class=SpellE>i</span>) process payment for any purchases, (ii)
enroll you in discount, rebate, and other programs in which you elect to
participate, (iii) to protect against or identify possible fraudulent
transactions, and (iv) otherwise as needed to manage our business.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><b><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>With whom we share your information</span></b><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'><o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><u><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>Personal information</span></u><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>. We may share your personal information with
other third-party participants. We may share personal information with:<o:p></o:p></span></p>

<ul type=disc>
 <li class=MsoNormal style='color:#4F4857;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;mso-list:l3 level1 lfo4;tab-stops:list .5in'><b><span
     style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
     "Times New Roman"'>Service providers</span></b><span style='font-size:
     10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:"Times New Roman"'>:
     We may share information, including personal information, with third
     parties that perform certain services on our behalf. These services may
     include fulfilling orders, providing customer service and marketing
     assistance, performing business and sales analysis, ad tracking and
     analytics, member screenings, supporting our website or application
     functionality, and supporting contests, sweepstakes, surveys and other
     features offered through our site. We may also share your name, contact
     information and credit card information with our service providers who
     process credit card payments. These service providers may have access to
     personal information needed to perform their functions but are not
     permitted to share or use such information for any other purposes.<o:p></o:p></span></li>
 <li class=MsoNormal style='color:#4F4857;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;mso-list:l3 level1 lfo4;tab-stops:list .5in'><b><span
     style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
     "Times New Roman"'>Business partners</span></b><span style='font-size:
     10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:"Times New Roman"'>:
     When you register or make purchases on our website or click-through our
     advertisements offered on third party websites or applications, we may
     share personal information with the businesses with which we partner to
     offer you the applicable products, services or any advertisements. When
     you elect to engage in a particular merchant's offer or program, you
     authorize us to provide your email address and other information to that
     merchant. To opt-out of cookies that may be set by third party data or
     advertising partners, please go to&nbsp;</span><span style='color:windowtext'><a
     href="http://www.aboutads.info/choices/" target="_blank"><span
     style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
     "Times New Roman";color:#009FDB;text-decoration:none;text-underline:none'>http://www.aboutads.info/choices/</span></a></span><span
     style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
     "Times New Roman"'>.<o:p></o:p></span></li>
 <li class=MsoNormal style='color:#4F4857;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;mso-list:l3 level1 lfo4;tab-stops:list .5in'><b><span
     style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
     "Times New Roman"'>Other Situations</span></b><span style='font-size:10.0pt;
     font-family:"Arial",sans-serif;mso-fareast-font-family:"Times New Roman"'>.
     We also may disclose your information, including personal information:<o:p></o:p></span></li>
 <ul type=circle>
  <li class=MsoNormal style='color:#4F4857;mso-margin-top-alt:auto;mso-margin-bottom-alt:
      auto;mso-list:l3 level2 lfo4;tab-stops:list 1.0in'><span
      style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
      "Times New Roman"'>In response to a subpoena or similar investigative
      demand, a court order, or a request for cooperation from a law
      enforcement or other government agency; to establish or exercise our
      legal rights; to defend against legal claims; or as otherwise required by
      law. In such cases, we may raise or waive any legal objection or right
      available to us.<o:p></o:p></span></li>
  <li class=MsoNormal style='color:#4F4857;mso-margin-top-alt:auto;mso-margin-bottom-alt:
      auto;mso-list:l3 level2 lfo4;tab-stops:list 1.0in'><span
      style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
      "Times New Roman"'>When we believe disclosure is appropriate in
      connection with efforts to investigate, prevent, or take other action
      regarding illegal activity, suspected fraud or other wrongdoing; to
      protect and defend the rights, property or safety of our company, our
      users, our employees, or others; to comply with applicable law or
      cooperate with law enforcement; or to enforce our Terms of Use or
      other agreements or policies.<o:p></o:p></span></li>
  <li class=MsoNormal style='color:#4F4857;mso-margin-top-alt:auto;mso-margin-bottom-alt:
      auto;mso-list:l3 level2 lfo4;tab-stops:list 1.0in'><span
      style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
      "Times New Roman"'>In connection with a substantial corporate
      transaction, such as the sale of our business, a divestiture, merger,
      consolidation, or asset sale, or in the unlikely event of bankruptcy.<o:p></o:p></span></li>
  <li class=MsoNormal style='color:#4F4857;mso-margin-top-alt:auto;mso-margin-bottom-alt:
      auto;mso-list:l3 level2 lfo4;tab-stops:list 1.0in'><span
      style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
      "Times New Roman"'>We will give out personal information to local, state,
      and federal law enforcement at our discretion if we believe that a member
      of this site has posted a threat against someone with the intent of
      causing bodily harm.<o:p></o:p></span></li>
 </ul>
</ul>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><u><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>Aggregated and/or non-personal information.</span></u><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>&nbsp;We may share non-personal information we
collect under any of the above circumstances. We may also share it with third
parties to develop and deliver targeted advertising on our site and on websites
or applications of third parties, and to analyze and report on advertising you
see. We may combine non-personal information we collect with additional
non-personal information collected from other sources. We also may share
aggregated, non-personal information, or personal information in hashed, non-human
readable form, with third parties, including advisors, advertisers and
investors, for the purpose of conducting general business analysis,
advertising, marketing, or other business purposes. For example, we may engage
a data provider who may collect web log data from you (including IP address and
information about your browser or operating system), or place or recognize a
unique cookie on your browser to enable you to receive customized ads or
content. The cookies may reflect de-identified demographic or other data linked
to data you voluntarily have submitted to us (such as your email address), that
we may share with a data provider solely in hashed, non-human readable form. We
may also share your geolocation information in de-identified form with third
parties for the above purposes.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><b><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>Do Not Track Disclosure</span></b><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'><o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>Do Not Track (&quot;DNT&quot;) is a privacy
preference that users can set in their web browsers. DNT is a way for users to
inform websites and services that they do not want certain information about
their webpage visits collected over time and across websites or online
services. We are committed to providing you with meaningful choices about the
information we collect and that is why we provide the opt-out links in the
Privacy Policy. However, we do not recognize or respond to any DNT signals as
the Internet industry works toward defining exactly what DNT means, what it
means to comply with DNT, and a common approach to responding to DNT.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><b><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>Third-party websites</span></b><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'><o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>There are a number of places on our website or
application where you may click on a link to access other websites that do not
operate under this Privacy Policy. For example, if you click on an
advertisement on our website, you may be taken to a website that we do not
control. These third-party websites may independently solicit and collect
information, including personal information, from you and, in some instances,
provide us with information about your activities on those websites. We
recommend that you consult the privacy statements of all third-party websites
you visit by clicking on the &quot;privacy&quot; link typically located at the
bottom of the webpage you are visiting.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><b><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>How you can access and correct your
information</span></b><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
mso-fareast-font-family:"Times New Roman";color:#4F4857'><o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>If you have an online account with us, you
have the ability to review and update your personal information online by
logging into your account and clicking on your account settings. Applicable
privacy laws may allow any individual the right to access and/or request the
correction of errors or omissions in his or her personal information that is in
our custody or under our control. Our Privacy Officer will assist the
individual with the access request. This includes:<o:p></o:p></span></p>

<ol start=1 type=1>
 <li class=MsoNormal style='color:#4F4857;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;mso-list:l4 level1 lfo5;tab-stops:list .5in'><span style='font-size:
     10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:"Times New Roman"'>identification
     of personal information under our custody or control; and<o:p></o:p></span></li>
 <li class=MsoNormal style='color:#4F4857;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;mso-list:l4 level1 lfo5;tab-stops:list .5in'><span style='font-size:
     10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:"Times New Roman"'>information
     about how personal information under our control may be or has been used
     by us.<o:p></o:p></span></li>
</ol>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>We will respond to requests within the time
allowed by all applicable privacy laws and will make every effort to respond as
accurately and completely as possible. Any corrections made to personal
information will be promptly sent to any organization it was disclosed to. In
certain exceptional circumstances, we may not be able to provide access to
certain personal information it holds about an individual. For security
purposes, not all personal information is accessible and amendable by the
Privacy Officer. If access or corrections cannot be provided, we will notify
the individual making the request within 30 days, in writing, of the reasons
for the refusal.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><b><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>Data retention</span></b><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'><o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>If you have an online account with us, you may
close your account at any time by visiting your account settings. If you close
your account, we may still retain certain information associated with your
account for analytical purposes and recordkeeping integrity, as well as to
prevent fraud, collect any fees owed, enforce our Terms of Use, take
actions we deem necessary to protect the integrity of our online services or
our users, or take other actions otherwise permitted by law. In addition, if
certain information has already been provided to third parties as described in
this Privacy Policy, retention of that information will be subject to those
third parties' policies.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><b><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>Your choices about collection and use of your
information</span></b><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
mso-fareast-font-family:"Times New Roman";color:#4F4857'><o:p></o:p></span></p>

<ul type=disc>
 <li class=MsoNormal style='color:#4F4857;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;mso-list:l1 level1 lfo6;tab-stops:list .5in'><span style='font-size:
     10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:"Times New Roman"'>You
     can choose not to provide us with certain information, but that may result
     in you being unable to use certain features of our site because such
     information may be required in order for you to register as a member;
     purchase products or services; participate in a contest, promotion,
     survey, or sweepstakes; ask a question; or initiate other transactions.<o:p></o:p></span></li>
 <li class=MsoNormal style='color:#4F4857;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;mso-list:l1 level1 lfo6;tab-stops:list .5in'><span style='font-size:
     10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:"Times New Roman"'>When
     you register on our site, you consent to receive email messages from us.
     We will not send commercial or promotional emails.<o:p></o:p></span></li>
 <li class=MsoNormal style='color:#4F4857;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;mso-list:l1 level1 lfo6;tab-stops:list .5in'><span style='font-size:
     10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:"Times New Roman"'>You
     can also control information collected by cookies. See &quot;Cookies&quot;
     below for information about declining or deleting cookies.<o:p></o:p></span></li>
</ul>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><b><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>How we protect your personal information</span></b><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'><o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>We take appropriate security measures
(including physical, electronic and procedural measures) to help safeguard your
personal information from unauthorized access and disclosure. However, no
system can be completely secure. Therefore, although we take steps to secure
your information, we do not promise, and you should not expect, that your
personal information, searches, or other communications will always remain
secure. Users should also take care with how they handle and disclose their
personal information and should avoid sending personal information through
insecure email. Please refer to the Federal Trade Commission's website at&nbsp;</span><a
href="http://www.consumer.ftc.gov/topics/identity-theft" target="_blank"><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#009FDB;text-decoration:none;text-underline:none'>http://www.consumer.ftc.gov/topics/identity-theft</span></a><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>&nbsp;for information about how to protect
yourself against identity theft.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>You agree that we may communicate with you
electronically regarding security, privacy, and administrative issues, such as
security breaches. We may post a notice on our Service if a security breach
occurs. We may also send an email to you at the email address you have provided
to us. You may have a legal right to receive this notice in writing. To receive
free written notice of a security breach (or to withdraw your consent from
receiving electronic notice), please notify us at the contact information
listed below.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><b><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>Information you provide about yourself while
using our service</span></b><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
mso-fareast-font-family:"Times New Roman";color:#4F4857'><o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>We provide areas on our site where you can
post information about yourself and others and communicate with others or
upload content such as photographs. Such postings are governed by our&nbsp;</span><a
href="terms-conditions.php"><span style='font-size:
10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:"Times New Roman";
color:#009FDB;text-decoration:none;text-underline:none'>Terms of Use</span></a><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>. In addition, such postings may appear on
other websites or when searches are executed on the subject of your posting.
Also, whenever you voluntarily disclose personal information on
publicly-viewable web pages, that information will be publicly available and
can be collected and used by others. For example, if you post your email
address, you may receive unsolicited messages. We cannot control who reads your
posting or what other users may do with the information you voluntarily post,
so we encourage you to exercise discretion and caution with respect to your
personal information.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><b><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>Children's privacy</span></b><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'><o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>Although our website and application is a
general audience site, we restrict the use of our services to individuals age
18 and above. We do not knowingly collect personal information from children
under the age of 13.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><b><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>Onward transfer and consent to international
processing</span></b><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
mso-fareast-font-family:"Times New Roman";color:#4F4857'><o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>We are a growing corporation with growing
numbers of users and operations in multiple countries, including the European
Union. We have developed data practices designed to assure information is
appropriately protected but we cannot always know where personal information
may be accessed or processed. While our primary data centers are in the United
States, we may transfer personal information or other information to our current
and future offices outside of the United States. In addition, we may employ
other companies and individuals to perform functions on our behalf. If we
disclose personal information to a third party or to our employees outside of
the United States, we will seek assurances that any information we may provide
to them is safeguarded adequately and in accordance with this Privacy Policy
and the requirements of applicable privacy laws.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><b><u><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>If you are visiting from the European Union or
other regions with laws governing data collection and use</span></u></b><b><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>, please note that you are agreeing to the
transfer of your personal data, including sensitive data, by <span
class=SpellE>SpiritLyft</span> from your region to countries which do not have
data protection laws that provide the same level of protection that exists in
countries in the European Economic Area, including the United States. By
providing your personal information, you consent to any transfer and processing
in accordance with this Policy.<o:p></o:p></span></b></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><b><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>No rights of third parties</span></b><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'><o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>This Privacy Policy does not create rights
enforceable by third parties or require disclosure of any personal information
relating to users of the website or application.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><b><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>Changes to this Privacy Policy</span></b><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'><o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>We will occasionally update this Privacy
Policy. When we post changes to this Privacy Policy, we will revise the
&quot;last updated&quot; date at the top of this Privacy Policy. We recommend
that you check our site from time to time to inform yourself of any changes in
this Privacy Policy or any of our other policies.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><b><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>How to contact us</span></b><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'><o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>If you have any questions about this Privacy
Policy, please contact us as follows:<o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>Privacy Officer<br>
<span class=SpellE>SpiritLyft</span><br>
5448 Apex <span class=SpellE>Peakway</span> #315<br>
Apex, NC 27502<o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><b><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>Linked information:</span></b><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'><o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><u><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>Cookies</span></u><a name=Cookies></a><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>A cookie is a small text file that is stored
on a user's device for record keeping purposes. Cookies can be either session
cookies or persistent cookies. A session cookie expires when you close your
browser and is used to make it easier for you to navigate our site. A
persistent cookie remains on your device for an extended period of time.
Cookies on our site do not link to or store your personal information.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>For example, when you sign in to our website,
we will record your user or member ID and the name associated with your user or
member ID in the cookie file on your computer. We also may record your password
in this cookie file, if you indicated that you would like your password saved
for automatic sign-in. For security purposes, we encrypt account-related data
that we store in such cookies. We may allow our service providers to serve
cookies from our website or application to allow them to assist us in various
activities, such as doing analysis and research on the effectiveness of our
site, content and advertising.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>You may delete or decline cookies by changing
your browser settings. (Click &quot;Help&quot; in the toolbar of most browsers
for instructions.) If you do so, some of the features and services of our
website may not function properly.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>We may allow third-parties, including
advertising companies, analytics companies, and ad networks, to display
advertisements on our site. These companies may use tracking technologies, such
as cookies, to collect information about users who view or interact with their
advertisements or our website or mobile applications. We do not provide any
non-masked or non-obscured personal information to these third parties, but
they may collect information about where you, or others who are using your
device, saw and/or clicked on the advertisements they deliver (such as click
stream information, browser type, time and date, subject of advertisements
clicked or scrolled over, etc.), and possibly associate this information with
your subsequent visits to the advertised websites or other data they have
collected. They also may combine this information with personal information
they collect from you to provide advertisements about goods and services likely
to be of greater interest to you. The collection and use of that information is
subject to the third-party's privacy policy. Some of these third-party
advertising companies may be advertising networks that are members of the
Network Advertising Initiative, which offers a single location to opt out of ad
targeting from member companies and provides information about this behavioral
advertising practice (</span><a href="http://www.networkadvertising.org/"
target="_blank"><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
mso-fareast-font-family:"Times New Roman";color:#009FDB;text-decoration:none;
text-underline:none'>www.networkadvertising.org</span></a><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>). This policy covers the use of cookies by us
and does not cover the use of cookies by any advertisers.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><u><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>Web Beacons</span></u><a name=WebBeacons></a><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>Web beacons (also known as clear gifs, pixel
tags or web bugs) are tiny graphics with a unique identifier, similar in
function to cookies, and are used to track the online movements of web users or
to access cookies. Unlike cookies which are stored on the user's device, web
beacons are embedded invisibly on the web pages (or in email) and are about the
size of the period at the end of this sentence.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
"Times New Roman";color:#4F4857'>Web beacons may be used to deliver or
communicate with cookies, to count users who have visited certain pages and to
understand usage patterns. We also may receive an anonymous identification
number if you come to our site from an online advertisement displayed on a
third-party website. Third parties may use anonymous information about your
visits to our site and other websites in order to improve its products and
services and provide advertisements about goods and services of interest to
you.<o:p></o:p></span></p>

<p class=MsoNormal align=center style='margin-bottom:6.75pt;text-align:center;
mso-outline-level:1'><span style='font-size:16.5pt;font-family:"Arial",sans-serif;
mso-fareast-font-family:"Times New Roman";color:white;mso-font-kerning:18.0pt'>Meet
Single 50plus Women<o:p></o:p></span></p>
	</div>
</div>
</body>
</html>