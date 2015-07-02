<?php


	include ("../include/connect.php");
	//echo sha1(SALT_VAR."admin");
	if(isset ($_POST['submit']))
	{
		$login_arr['username'] = $_POST['username'];
		$login_arr['password'] = $_POST['password'];
		$login_arr['roleid'] = 1;
		$retval=check_admin_login($login_arr);
		if($retval==true)
		{
			session_write_close();
			session_regenerate_id(true);
			header ("location: dashboard.php");			
			exit();
		}
		else
		{
			header ("location: login.php?msg=invalid_login");
			exit();
		}		
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sign In <?=$ADMIN_TITLE?></title>
<?php
	include ("common.php");
?>
<script type="text/javascript">
<!--
function browser_detect()
{
	var browsername = BrowserDetect.browser + ' ' + BrowserDetect.version;
	document.getElementById('browser_detect').value = browsername; 
}
// -->
</script>

</head>
	<body id="login" onload="<?=isset($msg_disp) && $msg_disp!=""?'show_msg(); ':''?> browser_detect()">
	
    	<div id="login-wrapper" class="png_bg" style="background-image:none">
			<div id="login-top">
			
				<h1><? //=$ADMIN_CAPTION?></h1>
                <img id="logo" src="images/logo.png" width="300px;" alt="<?=$SITE_NAME?>" />
			</div> <!-- End #logn-top -->
			
			<div id="login-content">
				<form action="" id="login_form" name="login_form" method="post">
					<input type="hidden" name="browser_detect" id="browser_detect" />
                    <div class="notification error png_bg" id="msg_disp">
						<div id="error_msg">
							Username or password is wrong.
						</div>
					</div>
					
                    <div class="clear"></div>
					<p>
						<label>Username</label>
						<input class="text-input" name="username" id="username" type="text" />
					</p>
					<div class="clear"></div>
					<p>
						<label>Password</label>
						<input class="text-input" name="password" id="password" type="password"  />
					</p>
					<div class="clear"></div>
					<p>
						<input class="button" type="submit" name="submit" id="submit" value="Sign In" />
					</p>
					
				</form>
			</div> <!-- End #login-content -->
			
		</div> <!-- End #login-wrapper -->
  </body>
</html>

<!--<div id="fade" class="black_overlay">
<div id="wrap"> 
<div id="content"> 
<img id="loadimg" src="images/loading-large.gif" width="200"> 
</div> 
</div>
</div>-->
<script type="text/javascript" src="js/login.js"></script>