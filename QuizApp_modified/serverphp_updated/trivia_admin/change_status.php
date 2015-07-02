<?php
	include ("../include/connect.php");
	
	$tablename = $_REQUEST['tablename'];
	$fieldname = $_REQUEST['fieldname'];
	$value = $_REQUEST['value'];
	$divid = $_REQUEST['divid'];
	
	$arr['status'] = abs(get_single_value($tablename,"status",$fieldname."='".$value."'") - 1);
	
	upd_rec($tablename,$arr,$fieldname."='".$value."'");
	
	$val = single_row($tablename,"*",$fieldname."='".$value."'");
	
?>
<a href="#123" onclick="status_call_ajax('change_status.php','tablename=<?=$tablename?>&fieldname=<?=$fieldname?>&value=<?=$val[$fieldname]?>&divid=<?=$divid?>','<?=$divid?>')"><?=$val['status']=="1"?"Active":"Inactive"?></a>