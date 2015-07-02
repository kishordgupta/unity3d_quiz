<?php
	include ("../include/connect.php");
	is_admin_login();
	
	$tablename = ADMIN;
	$pagetitle = "Change Profile";
	$pagename = "Change profile";

	
	$listfile = "change-profile.php";	
	
	$mainmenu = 4;
	$submenu = 1;
	
	
	if (isset ($_REQUEST['id']))
		$id = $_REQUEST['id'];
		
	if (isset ($_POST['submit']))
	{
		$arr['fname'] = $_POST['fname'];
		$arr['lname'] = $_POST['lname'];
		$arr['email'] = $_POST['email'];
		$id = $_POST['id'];
		upd_rec($tablename,$arr,"id=$id",false);			
		$msg="&msg=edit";
		
		header ("location: ".$listfile.'?'.$query_string.$msg);
		exit;
	}
	
	if (isset ($_SESSION['Adm_UserId']) && is_numeric($_SESSION['Adm_UserId']))
	{   
		$id=$_SESSION['Adm_UserId'];
		$where=" where id=".$id;
		$val_ad=single_row($tablename,"*","id=".$id);
		$username=$val_ad['username'];
		$fname=$val_ad['fname'];
		$lname=$val_ad['lname'];
		$email=$val_ad['email'];	
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
					
					<div class="clear"></div>
					
					
				</div> <!-- End .content-box-header -->
					
                        
                        <div class="content-box-content">
                        <div id="msg_disp" class="notification <?=$msg_class?> png_bg">
                            <a href="#" class="close"><img src="images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                            <div>
                                <?=$msg_disp?>
                            </div>
                        </div>
					
					<div class="tab-content default-tab" id="tab2">
				
						<form action="#" onsubmit="return profile_frm(this)" id="profile_form" name="profile_form" method="post" >
                       						 
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								<p>
									<label> First Name * </label>
									<input class="text-input medium-input datepicker" type="text" id="fname" name="fname" value="<?=$fname?>" />
								</p>
								<p>
									<label> Last Name * </label>
									<input class="text-input medium-input datepicker" type="text" id="lname" name="lname" value="<?=$lname?>" />
								</p>                               
                                <p>
									<label> Email * </label>
									<input class="text-input medium-input datepicker" type="text" id="email" name="email" value="<?=$email?>" />
								</p> 
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
<script language="javascript" src="js/change_profile.js"></script>
