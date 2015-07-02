<?php

$setting_arr = array(
    array("Manage AppSetting", "add-appsetting.php?mode=edit&id=1"),
    array("Change Profile", "change-profile.php", "change-profile.php"),
    array("Change Password", "change-password.php", "change-password.php")
);
$catapp_arr = array(
    array("Category List", "manage-category.php", "add-category.php"),
    array("Manage Quiz", "manage-quiz.php", "add-quiz.php")
);
$userapp_arr = array(
    array("User List", "manage-user.php", "add-user.php")
);
$main_menu = array(
    array("Manage Category", "manage-category.php", $catapp_arr, "images/header/images_manage.png"),
    array("Manage User", "manage-user.php", $userapp_arr, "images/header/users_manage.png"),
    array("Settings", "change-profile.php", $setting_arr, "images/header/settings.png")
);
//..................find main menu id & its sub menu....................

$cur_page = "";