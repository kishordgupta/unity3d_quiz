<?php
include ("../include/connect.php");
is_admin_login();
$action=mysql_real_escape_string($_POST['action']);
$updateRecordsArray=$_POST['recordsArray'];

if($action == "updateRecordsListings")
{
	$listingCounter = 1;
	foreach ($updateRecordsArray as $recordIDValue) 
	{
		$query = "UPDATE category_iphone SET position = " . $listingCounter . " WHERE id = " . $recordIDValue;
		mysql_query($query) or die('Failed to update order');
		$listingCounter = $listingCounter + 1;
	}
	echo "category order updated successfully.";	
}
?>