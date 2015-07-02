<?php
	include ("../include/connect.php");
	is_admin_login();
	
	$tablename = ADMIN;
	$pagetitle = "Change Settings";
	$pagename = "Change Settings";

	
	$listfile = "change-settings.php";	
	
	$mainmenu = 4;
	$submenu = 3;
	
	
	if (isset ($_REQUEST['id']))
		$id = $_REQUEST['id'];
		
	if (isset ($_POST['submit']))
	{
		$arr['twitter_username'] = $_POST['twitter_username'];
		$arr['twitter_passwd'] = $_POST['twitter_passwd'];
		$arr['twitter_acc'] = $_POST['twitter_acc'];
		$arr['facebook_acc'] = $_POST['facebook_acc'];
		$arr['iphone_store'] = $_POST['iphone_store'];
		$arr['ad_days']=$_POST['ad_days'];				
		$arr['ad_status']=$_POST['ad_status'];
		$id = $_POST['id'];
		upd_rec($tablename,$arr,"id=$id",false);			
		$msg="&msg=edit";
		
//		print_r($_POST);
		//exit;
		header ("location: ".$listfile.'?'.$query_string.$msg);
	}
	
	if (isset ($_SESSION['Adm_UserId']) && is_numeric($_SESSION['Adm_UserId']))
	{   
		$id= $_SESSION['Adm_UserId'];
		$where = " where id=".$id;
		$val_ad = single_row($tablename,"*","id=".$id);
		$feed_acc = $val_ad[feed_acc];
		$twitter_username = $val_ad['twitter_username'];
		$twitter_passwd = $val_ad['twitter_passwd'];
		$twitter_acc = $val_ad['twitter_acc'];
		$facebook_acc = $val_ad['facebook_acc'];		
		$iphone_url =$val_ad['iphone_store'];
		$ad_days=$val_ad['ad_days'];
		$ad_status=$val_ad[ad_status];
		
		if($ad_status>0)
		{
			$active='checked="checked"';	
		}
		else
			$inactive='checked="checked"';	
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
								
	
								
																
								<!--23may11 <p>
									<label> RSS Account * </label>
									<input class="text-input medium-input datepicker" type="text" id="feed_acc" name="feed_acc" value="<?=$feed_acc?>" />
								</p>-->
								<p>
									<label> Twitter Account * </label>
									<input class="text-input medium-input datepicker" type="text" id="twitter_acc" name="twitter_acc" value="<?=$twitter_acc?>" />
								</p>
                                 <p> <a href="#" onclick="$('#more_twitter').slideToggle()">Click here to change twitter usermame password</a>
                                      <div id="more_twitter" style="display:none">
                                        <table style="width:490px">
                                          <tr>
                                            <td>Username</td>
                                            <td><input class="text-input medium-input datepicker"  type="text" name="twitter_username" value="<?=$twitter_username?>" 
                                                        id="twitter_username" /></td>
                                          </tr>
                                          <tr>
                                            <td>Password</td>
                                            <td><input class="text-input medium-input datepicker"  type="password" name="twitter_passwd" value="<?=$twitter_passwd?>" 
                                                        id="twitter_passwd" /></td>
                                          </tr>
                                        </table>
                                      </div>
                                      </p>
								<p>
									<label> Facebook Account * </label>
									<input class="text-input medium-input datepicker" type="text" id="facebook_acc" name="facebook_acc" value="<?=$facebook_acc?>" />
								</p>
                               <!-- <p>
									<label>Flicker Account * </label>
									<input class="text-input medium-input datepicker" type="text" id="flicker_acc" name="flicker_acc" value="<?=$flicker_acc?>" />
								</p>-->
                                <p>
									<label>Iphone Store URL* </label>
									<input class="text-input medium-input datepicker" type="text" id="iphone_store" name="iphone_store" value="<?=$iphone_url?>" />
								</p>
                                
                                <p>
									<label>Ad Days *</label>
									<input class="text-input medium-input datepicker" type="textbox" id="ad_days" name="ad_days" value="<?=$ad_days?>" />
								</p>
                                <!--<p>
									<label title="Private seller can posts # ads">Private seller posts *</label>
									<input class="text-input medium-input datepicker" type="textbox" id="ad_post" name="ad_post" value="<?=$ad_posts?>" />
								</p>-->

                               <!-- <p>
									<label title="Dealer can upload # images">Dealer image uploads *</label>
									<input class="text-input medium-input datepicker" type="textbox" id="dealer_img" name="dealer_img" value="<?=$dealer_img?>" />
								</p>-->
                                <p style="height:15px">
									<label title="Default ad status when ad posts">Default ad status *</label>
									<p style="width:200px;height:8px;margin-top:0px" title="No need of admin approval">Active<input class="text-input medium-input datepicker" type="radio" id="ad_status" name="ad_status" value="1" <?=$active?> /></p>
                                    <p style="width:166px;height:8px" title="Needs admin approval">Inactive<input class="text-input medium-input datepicker" type="radio" id="ad_status" name="ad_status" value="0" <?=$inactive?>/></p>
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
