<div align="center">
Uploading Video Please wait....
</div>
<?php
include 'post.inc.php';

checkdir();

$FileName = $_FILES["mfile"]["name"][0];

if(isset($_POST['submit1']) && $FileName !='')
{
	videoPost($_POST['postinput'], $_FILES['mfile']);
	{
	?>
		<script type="text/javascript">
			window.parent.closeVideoPost();
		</script>
	<?php	
	}
}
?>
