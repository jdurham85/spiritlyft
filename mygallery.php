<?php 
session_start();

include 'config.php';
include 'include/core.inc.php';

if(isset($_SESSION['APP_MODE']) && $_SESSION['APP_MODE'] == 1)
{
	header("Location: app_".str_replace("/", "", $_SERVER['PHP_SELF']));
	exit();
}

$useragent=$_SERVER['HTTP_USER_AGENT'];

if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
{
header('Location: m_myprofile.php'); 
exit();
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/style1.css"/>
<link rel="stylesheet" href="css/commentbox_style1.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php include 'meta_header.php'; ?>
<title>SpiritLyft</title>

</head>
<body>
<header>
    <?php include 'title.php'; ?>
</header>
    
<script type="text/javascript">
setInterval(getMemberOnline, 10000);

getMemberOnline();

function getMemberOnline()
{
	$.post("include/member_online.php", {mo: 1}, function(mo){
		$("#online_panel").html(mo);
	
	});
}
	
function setMainProfilePicture(picid)
{
	if(confirm("Are you sure ?"))
	{
		$.post("include/setMainProfilePicture.php", {picid: picid}, function(){
			window.location = window.location;
		});
	}
}

function delete_gallery(imgid)
{
	if(confirm("Are you sure you want to delete your photo?"))
	{
		$.post("include/delete_gallery.php", {imgid: imgid}, function(){
			window.location = window.location;
		});
	}
}
</script>
        <div id="body">
        <?php include 'menu_btn.php';  ?>
            <div id="profile_body">
            
            <script type="text/javascript">
            	function gallery_file_browser()
				{
					$("#galleryfile").trigger('click');
				}
				
				function load_profile_images()
				{
					$.post("include/profile.inc.php", {mode: 0}, function(html){
						$("#gallery_body").html(html);	
					});
				}
				
				
				
				function cleanup()
				{
					if($("#galleryfile").val().length > 0)
					{
						$("#galleryfile").val('');	
					}	
				}
				
				$(document).ready(function() {
                    $("#galleryfile").change(function() {
						if($(this).val().length > 0)
						{
							$("#galleryfrm").submit();	
						}
                	});
					
					load_profile_images();
                });
            </script>
            	
                <div>
                	<form action="include/profile.inc.php" id="galleryfrm" target="profile_iframe" enctype="multipart/form-data" method="post">
                    	<input style="display:none;" type="file" id="galleryfile" name="galleryfile" />
                        <input style="display:none;" type="submit" id="submitg_btn" />
                    </form>
                    
                    <iframe style="display:none;" id="profile_iframe" name="profile_iframe"></iframe>
                </div>
                
                <div id="profile_header">
                	<table align="center" style="margin-top: 12px; width: 85%;">
                		<tr>
                			<td align="center" width="20%">
                				<img src="<?php echo MemberMainProfilePic($_SESSION['SessionMemberID']); ?>" width="80%" style="text-align: center;" />
                			</td>
                			<td align="left" width="80%" id="userfullname_textview">
                				<?php echo MemberFullName($_SESSION['SessionMemberID']); ?>
                			</td>
                		</tr>
                	</table>
                </div>
                <div id="profile_inner_body">
                	<div id="profile_menu">
                            <a target="_self" href="myprofile.php">My Profile</a>
                            <a target="_self" href="mygallery.php">My Gallery</a>
                            <a target="_self" href="myfriends&family.php">My Friends & Family</a>
                    </div>
                    
                    <div class="profile_title" align="center">My Gallery &nbsp;<button onClick="gallery_file_browser();" style="line-height: 30px; border: none; color: white; font-weight: bold; font-family: Arial; border-radius: 4px; background-color: #4A338E;">Add Picture</button></div>
                    <div id="gallery_body">
                    	
                    </div>
                </div>
                <div id="profile_footer">
                
                	
                </div>
            </div>
        </div>
</body>
</html>