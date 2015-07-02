<?php
	include ("../include/connect.php");
	is_admin_login();
	
	$tablename = CATEGORY;
	$pagetitle = "Manage Category";
	$pagename = "Category";

	$addfile = "add-category.php";
	$listfile = "manage-category.php";	
	
	if (isset($_REQUEST['id']))
		$id=$_REQUEST['id'];
	
	if (isset($_REQUEST['start']) && $_REQUEST['start']!="")
	{
		$start = $_REQUEST['start'];
		$query_string.="&start=$start";
	}
	
	if (isset ($_REQUEST['search']) && $_REQUEST['search'] != "")
	{
		$search = $_REQUEST['search'];
		$query_string.="&search=$search";
		$pg_query_string.="&search=$search";
	}
	elseif (isset($_REQUEST['ord']) && strtolower($_REQUEST['ord']) != "all")
	{
		$ord=$_REQUEST['ord'];
		$query_string.="&ord=".$ord;
		$pg_query_string.="&ord=".$ord;
	}
	if (isset ($_REQUEST['perpage']))
	{
		$perpage = $_REQUEST['perpage'];
		$query_string.="&perpage=$perpage";
		$pg_query_string.="&perpage=$perpage";
	}
		
	$mode="add";
	if (isset($_REQUEST['mode']))
		$mode=$_REQUEST['mode'];
	
	if(isset($_POST['submit']))
	{	
		$arr['name']=$_POST['name'];
		$arr['description']=$_POST['description'];
		$arr['correct_ans_score']=$_POST['correct_ans_score'];
		$arr['wrong_ans_score']=$_POST['wrong_ans_score'];
		$arr['time']=$_POST['time'];
		$arr['limits']=$_POST['limits'];
		$arr['status']=1;
		
		switch ($mode)
		{
			case "add" :
                                $id=ins_rec($tablename,$arr);

                                $msg="&msg=add";
                                break;
					
			case "edit" :	
                                $id = $_POST['id'];
                                upd_rec($tablename,$arr,"id=".$id,false);
                                $msg="&msg=edit";
                                break;	
		}
	    header ("location: ".$listfile.'?'.$query_string.$msg);
		exit;
	}
	
	if(isset($_REQUEST['id']) && is_numeric($_REQUEST['id']))
	{		
		$id=$_REQUEST['id'];
		$where=" where id=".$id;
		$val_ad=single_row($tablename,"*","id=".$id,'1','desc','',false);
		$name=$val_ad['name'];
		$description=$val_ad['description'];
		$correct_ans_score=$val_ad['correct_ans_score'];
		$wrong_ans_score=$val_ad['wrong_ans_score'];
		$limits=$val_ad['limits'];
		$time=$val_ad['time'];
		
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=$pagetitle.$ADMIN_TITLE?></title>
<?php
	include ("common.php");
?>


</head>
	<body><div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
		
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
					
					<h3><?=$mode." ".$pagename?></h3>
					
					<div class="clear"></div>
					
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content">
					<div class="tab-content default-tab" id="tab2">					
						<form action="#" id="characteristics_frm" name="characteristics_frm" enctype="multipart/form-data" method="post" >							 
							<fieldset class="column-left">  
                                 <p>
									<label>Name</label>
                                    <input class="text-input medium-input" type="text" id="name" name="name" value="<?=$name?>" size="60" />
								</p>                                
	                     
	                            <p>
									<label>Description</label>
                                    <textarea class="text-input medium-input" rows="10" id="description" name="description"><?=$description?></textarea>
								</p>
                                
                                <p>
									<label>Correct Answer Score</label>
                                    <input class="text-input medium-input" type="text" id="correct_ans_score" name="correct_ans_score" value="<?=$correct_ans_score?>" size="60" />
								</p> 
                                
                                <p>
									<label>Wrong Answer Score</label>
                                    <input class="text-input medium-input" type="text" id="wrong_ans_score" name="wrong_ans_score" value="<?=$wrong_ans_score?>" size="60" />
								</p>
                                
                                
                                
                                 <p>
									<label>Time</label>
                                    <input class="text-input medium-input" type="text" id="time" name="time" value="<?=$time?>" size="60" />Seconds</label>
								</p>
                                <p>
									<label>Limit</label>
                                    <input class="text-input medium-input" type="text" id="limits" name="limits" value="<?=$limits?>" size="60" />
								</p>  
                                 
                                <br>
                               <p>                                	
									<input class="button" type="submit" name="submit" id="submit" value="Submit" <?php if($mode =='add'){?>onclick="return addclient();" <?php }?> />
                                     &nbsp;&nbsp;
								<input type="button" name="back" id="back" class="button" value="Back" onclick="window.location.href='<?=$listfile."?".$query_string?>'" />		
								</p>
								
							</fieldset>
                            
							
						<div class="clear"></div><!-- End .clear -->
						<input type="hidden" name="start" value="<?=$start?>" />	
                        <input type="hidden" name="perpage" value="<?=$perpage?>" />	
                        <input type="hidden" name="ord" value="<?=$ord?>" />	
                        <input type="hidden" name="search" value="<?=$search?>" />	
                        <input type="hidden" name="mode" id="mode" value="<?=$mode?>" />
                        <input type="hidden" name="id" value="<?=$id?>" />
						</form>
						
					</div> <!-- End #tab2 -->        
					
				</div> <!-- End .content-box-content -->
				
			</div> <!-- End .content-box -->
			
			<?php include ("footer.php");?>
			
		</div> <!-- End #main-content -->
	</div>
    <script language="javascript" src="js/product.js"></script>
    </body>
</html>