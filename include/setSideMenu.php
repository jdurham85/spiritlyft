<?php 
session_start();
include 'core.inc.php';
?>
<div id="welcome_title">Welcome, <?php echo MemberFirstName($_SESSION['SessionMemberID']); ?></div>
<div><a href="home.php"><button><img src="image/home-512.png" /><span class="button_lb">Home</span><span class="button_lb" id="home_alert_lb"></span></button></a></div>
<div><a href="myprofile.php"><button><img src="<?php echo MemberMainProfilePic($_SESSION['SessionMemberID']); ?>" /><span class="button_lb">My Profile</span><span class="button_lb" id="myprofile_alert_lb"></span></button></a></div>

<div><a href="community.php"><button><img src="image/friend_request_icon.png" /><span class="button_lb">My Friends & Family</span><span class="button_lb" id="connection_alert_lb"></span></button></a></div>

<div><a href="giftshop.php"><button><img src="image/vgift_icon.png" /><span class="button_lb">GiftShop</span><span class="button_lb" id="gift_alert_lb"></span></button></a></div>
<div><a href="search.php"><button><img src="image/search-icon-png-9985.png" /><span class="button_lb">Search</span></button></a></div>
<div><a href="account-setting.php"><button><img src="image/account-setting-ico.png" /><span class="button_lb">Account Setting</span></button></a></div>
<div><a href="private_chat.php"><button><img src="image/chat_icon.png" /><span class="button_lb">Private Chat</span><span class="button_lb" id="message_alert_lb"></span></button></a></div>

<div><a href="logout.php"><button><img src="image/logout-img.png" /><span class="button_lb">Logout</span></button></a></div>