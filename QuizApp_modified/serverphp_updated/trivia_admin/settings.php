<?php
	include ("../include/connect.php");
	is_admin_login();
	
	$tablename = SETTINGS;
	$pagetitle = "Settings";
	$pagename = "Settings";

	
	$listfile = "settings.php";	
	
	$mainmenu = 5;
	$submenu = 1;
	
	
	
		
	if (isset ($_POST['submit']))
	{
		
		
		$recent_vid = $_POST[recent_vid];
		$popular_vid = $_POST[popular_vid];
		mysql_query("update $tablename set recent_vid ='$recent_vid', popular_vid ='$popular_vid'");  
 		
		//upd_rec($tablename,$arr);			
		$msg="&msg=edit";
		
		
		header ("location: ".$listfile.'?'.$query_string.$msg);
		exit;
	}
	
	
		$val_ad = single_row($tablename,"*");
		$recent_vid = $val_ad[recent_vid];
		$popular_vid = $val_ad[popular_vid];
		
		
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
			<h2>Welcome <?php echo $Adm_Fname; ?></h2>
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
				
						<form action="#" id="profile_form" name="profile_form" method="post" >
                       						 
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->						
								<p>
									<label> Number Of Popular Video * </label>
									<input class="text-input small-input datepicker" type="text" id="popular_vid" name="popular_vid" value="<?=$popular_vid?>" />
								</p>
                                <p>
									<label> Number Of Recent Video * </label>
									<input class="text-input small-input datepicker" type="text" id="recent_vid" name="recent_vid" value="<?=$recent_vid?>" />
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
