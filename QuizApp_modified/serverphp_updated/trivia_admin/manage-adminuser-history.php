<?php
	include ("../include/connect.php");
	is_admin_login();
	
	$tablename = ADMIN_LOGIN;
	$pagetitle = " Login History";
	$pagename = " Login History";

	//$addfile = "add-adminuser.php";
	$listfile = "manage-adminuser-history.php";	
	$listfile1 = "manage-adminuser.php";	
	
	$mainmenu = 3;
	$submenu = 2;
	
	if (isset ($_REQUEST['adminid']))
	{   
		$adminid = $_REQUEST['adminid'];
		$query_string.="&adminid=$adminid";
		$pg_query_string.="&adminid=$adminid";
	}
		
	
	if (isset ($_REQUEST['start']) && $_REQUEST['start'] != "")
	{
		$start = $_REQUEST['start'];
		$query_string.="&start=$start";
	}
	
	if (isset ($_REQUEST['search']) && $_REQUEST['search'] != "")
	{
		$search = $_REQUEST['search'];
		//$where = "fname like '%".$search."%'";
		$where = "ip_address  like '%".$search."%'";
	
		$query_string.="&search=$search";
		$pg_query_string.="&search=$search";
	}
	elseif (isset($_REQUEST['ord']) && strtolower($_REQUEST['ord']) != "all")
	{
		$ord=$_REQUEST['ord'];
		$where = "ip_address like '$ord%' ";
		$query_string.="&ord=".$ord;
		$pg_query_string.="&ord=".$ord;
	}
	
	$perpage = "10";
	if (isset ($_REQUEST['perpage']))
	{
		$perpage = $_REQUEST['perpage'];
		$query_string.="&perpage=$perpage";
		$pg_query_string.="&perpage=$perpage";
	}
	
		
	if ($_POST['list_action'])
	{
		//exit;
		$list_action = strtolower($_POST['list_action']);
		
		switch ($list_action)
		{
			case "active" :
						if (isset ($_POST['ids']) && count($_POST['ids']) > 0)
						{ 
							$id = "'".implode ("','",$_POST['ids'])."'";
							$arr['status']="1";
							upd_rec($tablename,$arr,"logid in ($id)");
									$msg="&msg=active";break;
						}
		   case "inactive" :
						if (isset ($_POST['ids']) && count($_POST['ids']) > 0)
						{
							$id = "'".implode ("','",$_POST['ids'])."'";
							$arr['status']="0";
							upd_rec($tablename,$arr,"logid in ($id)");
							$msg="&msg=inactive";break;
						}
			case "delete" :
						if (isset ($_POST['ids']) && count($_POST['ids']) > 0)
						{
							$id = "'".implode ("','",$_POST['ids'])."'";
							del_rec($tablename,"logid in ($id)");
							$msg="&msg=delete";
							break;	
						}
		}
			header ("location: ".$listfile."?".$query_string.$msg);
			exit;	

	}
	
	
	//..............delete record start............
	if (isset ($_REQUEST['mode']) && $_REQUEST['mode']=="delete")
	{
		$logid = $_REQUEST['logid'];
		del_rec($tablename,"logid=$logid");			
		
		$msg="&msg=delete";
		header ("location: ".$listfile."?".$query_string.$msg);
	}
	//..............delete record end...............................
	
	if ($where != "")
		$where = " where adminid = '$adminid' and ".$where;
	else
		$where = " where adminid = ".$adminid;	
	
   $sel = "select * from $tablename ".$where;
	$result=$cms_pageing->number_pageing($sel,$perpage,5,'N','Y',"",$cur_page,$pg_query_string);
	
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
					
                    <div style="float:left; width:60%">
					<h3><?=$pagetitle?> [<?=get_single_value(ADMIN,'fname'," 1=1 and id = '".$adminid."'")?>
					<?=get_single_value(ADMIN,'lname'," 1=1 and id = '".$adminid."'")?>]</h3>
                    </div>
                    
                    <div style="float:right; text-align:right; width:40%">
					
                    </div>
					
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content">
					
					<div class="tab-content default-tab" id="tab1">
                    <div id="msg_disp" class="notification <?=$msg_class?> png_bg">
                            <a href="#" class="close"><img src="images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                            <div>
                                <?=$msg_disp?>
                            </div>
                        </div>
						
						<table>
							
                            
                            
                            <form action="" method="post">
                            <fieldset>
                            <thead>
								<tr>
								   	<td colspan="6">
                                        <strong>Search By : </strong>
                                        <input class="search_input" type="text" name="search" id="search" value="<?=$search?>" /> 
                                        <strong>Per Page : </strong>
                                        <select name="perpage" id="perpage" class="search_input">
                                        	<option <?=$perpage=="10"?'selected="selected"':''?> value="10">10</option>
                                            <option <?=$perpage=="20"?'selected="selected"':''?> value="20">20</option>
                                            <option <?=$perpage=="50"?'selected="selected"':''?> value="50">50</option>
                                            <option <?=$perpage=="100"?'selected="selected"':''?> value="100">100</option>
                                            
                                        </select>
                                        <input type="hidden" name="ord" value="<?=$ord?>" />
                                        <input type="submit" name="search_go" id="search_go" class="button" value="Go" />
                                    </td>
								</tr>
								
							</thead>
                            </fieldset>
                            </form>
                            
                            
                            <?php
								if (mysql_num_rows($result[0]) > 0)
								{
							?>
                            <form action="" method="post" name="data_list" id="data_list">
                             <input type="hidden" id="adminid" name="adminid" value="<?=$adminid?>" />                           
                            	<thead style="border-top:#CCC 1px solid">
                                    <tr>
                                       <th width="7%"><input class="check-all" type="checkbox" /></th>
                                       <th width="29%">Ip Address</th>
                                       <th width="31%">Date & Time</th>
                                       <th width="20%">Browser Name</th>
                                       <th width="13%">Actions</th>
                                    </tr>
                                    
                                </thead>
						 	
                                <tbody>
                                
                                	<?php
										$cnt=1;
										while ($val = mysql_fetch_array($result[0]))
										{
											$val = strip_slashes($val);
									?>
                                    <tr> 
                                        <td><input type="checkbox" name="ids[]" id="ids" value="<?=$val['logid']?>" /></td>
                                        <td><?=$val['ip_address']?></td>
                                         <td><?=stripslashes(date("M-d-Y h:i:s A",strtotime($val['date_time'])));?></td>
                                          <td><?=$val['browser_name']?></td>
                                         
                                        
                                        <td>
                                            <!-- Icons -->
                                        
                                             <a style="cursor:pointer" onclick="del_confirm ('<?=$pagename?>?','<?=$listfile?>?mode=delete&logid=<?=$val['logid']?>&adminid=<?=$val['adminid']?><?=$query_string?>')" title="Delete <?=$pagename?>"><img src="images/icons/cross.png" alt="Delete <?=$pagename?>" /></a> 
                                             
                                        </td>
                                    </tr>
                                    <?php	
											$cnt++;
										}
                                    ?>
                                
                                    
                                    
                                </tbody>
                                <tfoot>
								<tr>
									<td colspan="6">
										<div class="bulk-actions align-left">
										
                                        	<select name="list_action" id="list_action">
												<option value="">Choose an action...</option>
												<option value="delete">Delete</option>
											</select>
                                            <input class="button" type="button" name="submit_action" id="submit_action" value="Apply to selected" />
										</div>
                                         <div class="bulk-actions align-center" style="padding-top:18px;">
                                        <input type="button" name="back" id="back" class="button" value="Back" onclick="window.location.href='<?=$listfile1."?".$query_string?>'" />		
										</div>

										
										<?=$result[1]?> <!-- End .pagination -->
										<div class="clear"></div>
									</td>
								</tr>
							</tfoot>
                            </form>
                            <?php
								}
								else
								{
							?>
                            		<thead style="border-top:#CCC 1px solid;">
                                        <tr>
                                           <th class="no_datalist" >No <?=$pagename?> to display!</th>
                                        </tr>
                                    </thead>
                            <?php
								}
                            ?>
							
							
						</table>
						
					</div> <!-- End #tab1 -->
					
					 <!-- End #tab2 -->        
					
				</div> <!-- End .content-box-content -->
				
			</div> <!-- End .content-box -->
			
			<div class="clear"></div>
			
			<?php include ("footer.php");?>
			
		</div> <!-- End #main-content -->
	</div></body>
</html>
