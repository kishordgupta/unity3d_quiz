<?php
if(is_file('include/connect.php'))
		include_once('include/connect.php');
if (is_file('../include/connect.php'))
		include_once('../include/connect.php');
		
is_admin_login();
$imgid=$_GET['imgid'];
//$tablename1=APP_IMAGES;
$tablename1=$_GET[t];
$image=get_single_value($tablename1,"image","id=$imgid");
if(file_exists("../".FILM_IMAGE_DIR.$image))
{
	unlink("../".FILM_IMAGE_DIR.$image);
}
del_rec($tablename1,"id=$imgid");
?>