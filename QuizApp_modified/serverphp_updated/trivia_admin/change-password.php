<?php
	include ("../include/connect.php");
	is_admin_login();
	
	$tablename = ADMIN;
	$pagetitle = "Change Password";
	$pagename = "Change Password";
	$listfile = "change-password.php";	
	
	$mainmenu = 4;
	$submenu = 2;
	
		
if (isset ($_POST['submit']))
{
	$old_password = sha1(SALT_VAR.$_POST['old_password']);
	$password = sha1(SALT_VAR.$_POST['password']);
	
	$arr[password]=$password;
	$re_password = sha1($_POST['re_password']);
	
	$id = $_SESSION['Adm_UserId'];
	$sel_qur = "select * from ".ADMIN." where password ='$old_password' and id =".$id;
	$res_qur = mysql_query($sel_qur);
	
	if(!$res_qur)
		echo mysql_error();
	
	if(mysql_num_rows($res_qur) > 0)
	{
		upd_rec($tablename,$arr,"id=$id");			
		$msg="&msg=edit";
			
		header ("location: ".$listfile.'?'.$query_string.$msg);
		exit;
	}
	else	
	{
		header('location:change-password.php?ps=notmatch');	
	}
		
}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Dashboard <?=$ADMIN_TITLE?></title>
<?php
	include ("common.php");
?>
</head>
		<body <?=$msg_disp!=""?'onload="show_msg();"':''?>>
    <div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
		
		<?php include ("sidebar.php");?> <!-- End #sidebar -->
		
		<div id="main-content"> <!-- Main Content Section with everything -->
			
			<noscript> <!-- Show a notification if the user has disabled javascript -->
				<div class="notification error png_bg">
					<div>
						Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.
					</div>
				</div>
			</noscript>
			
			<!-- Page Head -->
			<h2>Welcome <?php echo $Adm_Fname; ?>&nbsp;<?php echo $Adm_Lname; ?></h2>
			<p id="page-intro">What would you like to do?</p>
			
			<?php include ("shortcut.php"); ?><!-- End .shortcut-buttons-set -->
			
			<div class="clear"></div> <!-- End .clear -->
			
			<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
					
					<h3><?=$pagetitle?></h3>
					
					
					
				</div> <!-- End .content-box-header -->
               
				<div class="content-box-content">
                	 <div class="clear"></div>
					<div id="msg_disp" class="notification <?=$msg_class?> png_bg">
                            <a href="#" class="close"><img src="images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                            <div>
                                <?=$msg_disp?>
                            </div>
                        </div>
					
					<div class="tab-content default-tab" id="tab2">
				
						<form action="#" id="pass_form" name="pass_form" method="post" >
                       						 
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								
	
								
																
								  <p>
									<label> Old Password * </label>
									<input class="text-input medium-input datepicker" type="password" id="old_password" name="old_password" value="<?=$old_password?>" />
								</p>
								<p>
										<label> New password * </label>
									<input class="text-input medium-input datepicker" type="password" id="password" name="password" value="<?=$password?>" />
								</p>
								<p>
									<label> Confirm * </label>
									<input class="text-input medium-input datepicker" type="password" id="re_password" name="re_password" value="<?=$re_password?>" />								
								
								
								<p>
									<input class="button" type="submit" name="submit" id="submit" value="Submit" />
								</p>
								
							</fieldset>
							
							<div class="clear"></div><!-- End .clear -->
						<input type="hidden" name="start" value="<?=$start?>" />	
                        <input type="hidden" name="perpage" value="<?=$perpage?>" />	
                        <input type="hidden" name="ord" value="<?=$ord?>" />	
                        <input type="hidden" name="search" value="<?=$search?>" />	
                        <input type="hidden" name="mode" value="<?=$mode?>" />
                        <input type="hidden" name="id" value="<?=$id?>" />
						</form>
						
					</div> <!-- End #tab2 -->        
					
				</div> <!-- End .content-box-content -->
				
			</div> <!-- End .content-box -->
			
			<?php include ("footer.php");?>
			
		</div> <!-- End #main-content -->
	</div></body>
</html>
<script language="javascript" src="js/change_password.js"></script>
