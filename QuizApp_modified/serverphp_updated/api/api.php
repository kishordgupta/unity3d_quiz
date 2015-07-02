<?php

include_once('../include/connect.php');

$sign = $_REQUEST['sign'];
$salt = $_REQUEST['salt'];
$a = verify_iphone_sign($sign, $salt);
if($a){
    $api = $_REQUEST['api'];
    $filter = new taste;
} else {
    $api = '';
}
switch ($api) {
    case 'register_email':
        $arrDataContent = $filter->register_email($_REQUEST);
        break;
    case 'login_email':
        $arrDataContent = $filter->check_user($_REQUEST);
        break;
    case 'register_or_login_facebook':
        $arrDataContent = $filter->check_fb_user($_REQUEST);
        break;
    case 'update_score':
        $arrDataContent = $filter->update_score($_REQUEST);
        break;
    case 'get_user_score':
        $arrDataContent = $filter->get_user_score();
        break;
    case 'get_top_score':
        $arrDataContent = $filter->get_top_score();
        break;
    case 'get_top_scorer':
        $arrDataContent = $filter->get_top_scorer();
        break;
    case 'get_category':
        $arrDataContent = $filter->get_category($_REQUEST);
        break;
    case 'get_app_settings':
        $arrDataContent = $filter->get_appsetting($_REQUEST);
        break;
    case 'get_quiz':
        $arrDataContent = $filter->get_quiz($_REQUEST);
        break;
    default:
        $arrDataContent = json_encode(array('data'=>'Invalid Request.', 'success' => '-1'));
        break;
}
header('Content-type: application/json');
echo $arrDataContent;
