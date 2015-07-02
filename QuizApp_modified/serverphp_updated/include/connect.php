<?php

@session_start();
ob_start();
include("config.inc.php");
include("db_function.php");
include("function.php");
include("sendmail.php");
include("tablename.php");
include("message.php");
include_once('imageTransform.php');
include_once('class_connect.php');
//................Paging file..............
include("newpaging.php");
$prs_pageing = new get_pageing_new();

include("newpaging_front.php");
$prs_pageing1 = new get_pageing_new1();

include("cmspaging.php");
$cms_pageing = new get_pageing_cms();

include("ajaxpaging.php");
$ajax_pageing = new get_pageing_ajax();

$session_id = session_id();
$adminsetting = array();
$adminmail = get_single_value(ADMIN, 'email', '1=1');
$cur_page_arr = split("/", $_SERVER['PHP_SELF']);
$cur_page = $cur_page_arr[count($cur_page_arr) - 1];
if ($cur_page == "login.php" || $cur_page == "signup.php") {
    
} else {
    $_SESSION["page"] = $cur_page;
}
?>