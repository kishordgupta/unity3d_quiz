<?php
include ("../include/connect.php");
is_admin_login();

$tablename = APPSETTING;
$pagetitle = "Manage Appsetting";
$pagename = "Appsetting";

$addfile = "add-appsetting.php";
$listfile = "add-appsetting.php?mode=edit&id=1";

if (isset($_REQUEST['id']))
    $id = $_REQUEST['id'];

if (isset($_REQUEST['start']) && $_REQUEST['start'] != "") {
    $start = $_REQUEST['start'];
    $query_string.="&start=$start";
}

if (isset($_REQUEST['search']) && $_REQUEST['search'] != "") {
    $search = $_REQUEST['search'];
    $query_string.="&search=$search";
    $pg_query_string.="&search=$search";
} elseif (isset($_REQUEST['ord']) && strtolower($_REQUEST['ord']) != "all") {
    $ord = $_REQUEST['ord'];
    $query_string.="&ord=" . $ord;
    $pg_query_string.="&ord=" . $ord;
}
if (isset($_REQUEST['perpage'])) {
    $perpage = $_REQUEST['perpage'];
    $query_string.="&perpage=$perpage";
    $pg_query_string.="&perpage=$perpage";
}

$mode = "add";
if (isset($_REQUEST['mode']))
    $mode = $_REQUEST['mode'];

if (isset($_POST['submit'])) {
    $arr['flag'] = $_POST['flag'];
    $arr['correct_message'] = $_POST['correct_message'];
    $arr['wrong_message'] = $_POST['wrong_message'];
    $arr['message'] = $_POST['message'];

    switch ($mode) {
        case "add" :
            $id = ins_rec($tablename, $arr);
            $msg = "&msg=add";
            break;

        case "edit" :
            $id = $_POST['id'];
            upd_rec($tablename, $arr, "id=" . $id, false);
            $msg = "&msg=edit";
            break;
    }
    header("location: " . $listfile);
    exit;
}

if (isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $where = " where id=" . $id;
    $val_ad = single_row($tablename, "*", "id=" . $id, '1', 'desc', '', false);
    $flag = $val_ad['flag'];
    $correct_message = $val_ad['correct_message'];
    $wrong_message = $val_ad['wrong_message'];
    $message = $val_ad['message'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title><?= $pagetitle . $ADMIN_TITLE ?></title>
        <?php
        include ("common.php");
        ?>
    </head>
    <body><div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
            <?php include ("sidebar.php"); ?> <!-- End #sidebar -->
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
                        <h3><?= $mode . " " . $pagename ?></h3>
                        <div class="clear"></div>
                    </div> <!-- End .content-box-header -->
                    <div class="content-box-content">
                        <div class="tab-content default-tab" id="tab2">					
                            <form action="#" id="characteristics_frm" name="characteristics_frm" enctype="multipart/form-data" method="post" >							 
                                <fieldset class="column-left">
                                    <br/><br/>  
                                    <p>
                                        <?php
                                        $data = get_single_value(APPSETTING, flag, "status=1", "id", "desc", "", false);
                                        ?>
                                        <label>HighLight Correct Answer ON   <input type="radio" <?php if ($data == 1) { ?> checked="checked" <?php } ?>name="flag" value="1" /></label>
                                        <label>HighLight Wrong Answer OFF<input  type="radio" <?php if ($data == 0) { ?> checked="checked" <?php } ?>  name="flag" value="0"/>	</label>
                                        <label>Enter Your Correct Answer Message Here</label>
                                        <textarea class="text-input medium-input" style="margin-left:50px;" rows="5" cols="10" id="correct_message" name="correct_message"><?= $correct_message ?></textarea>
                                        <label>Enter Your Wrong Answer Message Here</label>
                                        <textarea class="text-input medium-input" style="margin-left:50px;" rows="5" id="wrong_message" name="wrong_message"><?= $wrong_message ?></textarea>
                                    </p>  
                                    <br/>
                                    <p>
                                        <label>Game Completion Message</label>
                                        <input class="text-input medium-input" type="text" id="message" name="message" value="<?= $message ?>" size="60" />
                                    </p>
                                    <p>                                	
                                        <input class="button" type="submit" name="submit" id="submit" value="Submit" onclick="window.location.href = '<?= $listfile ?>'" />
                                    </p>
                                </fieldset>
                                <div class="clear"></div><!-- End .clear -->
                                <input type="hidden" name="start" value="<?= $start ?>" />	
                                <input type="hidden" name="perpage" value="<?= $perpage ?>" />	
                                <input type="hidden" name="ord" value="<?= $ord ?>" />	
                                <input type="hidden" name="search" value="<?= $search ?>" />	
                                <input type="hidden" name="mode" id="mode" value="<?= $mode ?>" />
                                <input type="hidden" name="id" value="<?= $id ?>" />
                            </form>

                        </div> <!-- End #tab2 -->        
                    </div> <!-- End .content-box-content -->
                </div> <!-- End .content-box -->
                <?php include ("footer.php"); ?>
            </div> <!-- End #main-content -->
        </div>
        <script language="javascript" src="js/product.js"></script>
    </body>
</html>