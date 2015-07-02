<?php
include ("../include/connect.php");
is_admin_login();

$tablename = QUESTION;
$tablename1 = ANSWER;
$tablename2 = QUIZ_ANSWER;
$pagetitle = "Manage Question";
$pagename = "Quiz";

$addfile = "add-quiz.php";
$listfile = "manage-quiz.php";

$dir = FILM_IMAGE_DIR;

if (isset($_REQUEST['id']))
    $id = $_REQUEST['id'];
$mode = "add";
if (isset($_REQUEST['mode']))
    $mode = $_REQUEST['mode'];


if (isset($_POST['submit'])) {
    $arr['question'] = $_POST['question'];
    $arr['cat_id'] = $_POST['cat_id'];
    $arr['url'] = $_POST['url'];
    $arr['flag'] = $_POST['flag'];
    $arr['datecreated'] = date("Y-m-d H:i:s");
    $arr['dateupdated'] = date("Y-m-d H:i:s");

    switch ($mode) {
        case "add" :
            $file['name'] = $_FILES['image']['name'];
            $file['tmp_name'] = $_FILES['image']['tmp_name'];
            $image_name = upload_image($file, "../images/", '', rand());
            if ($image_name != '') {
                $arr['image'] = $image_name;
            }

            $id = ins_rec($tablename, $arr);
            $msg = "&msg=add";
            break;

        case "edit" :
            $file['name'] = $_FILES['image']['name'];
            $file['tmp_name'] = $_FILES['image']['tmp_name'];
            $image_name = upload_image($file, "../images/", '', rand());
            $id = $_REQUEST['id'];
            if ($image_name != '') {
                $img['image'] = $image_name;
                $img['id'] = $_REQUEST['id'];
                $id = upd_rec($tablename, $img, "id=" . $id, false);
            }
            $mid = $_REQUEST['mid'];
            $upt = "update answer set true_ans=0 where id=$mid";
            $mres = mysql_query($upt);

            $id = $_POST['id'];

            upd_rec($tablename, $arr, "id=" . $id, false);
            $msg = "&msg=edit";
            del_rec($tablename1, "question_id=$id");
            break;
    }
    for ($i = 0; $i < count($_POST['answer']); $i++) {   //insert video_url
        //echo $_POST['answer'][$i];
        if ($_POST['answer'][$i] != '') {
            $true_ans = 0;
            $video['question_id'] = $id;
            $video['answer'] = $_POST['answer'][$i];
            if (isset($_POST["true_ans$i"])) {
                $true_ans = 1;
            }
            $video['true_ans'] = $true_ans;
            $ingred_id = ins_rec($tablename1, $video, false);
        }
    }

    header("location: " . $listfile . '?' . $query_string . $msg);
    exit;
}

if (isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $where = " where id=" . $id;
    $val_ad = single_row($tablename, "*", "id=" . $id, '1', 'desc', '', false);
    $question = $val_ad['question'];
    $url = $val_ad['url'];
    $image = $val_ad['image'];
    $flag = $val_ad['flag'];
    $true_ans = $val_ad['true_ans'];
    $datecreated = $val_ad['datecreated'];
    $dateupdated = $val_ad['dateupdated'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title><?php echo $pagetitle . $ADMIN_TITLE ?></title>
        <?php
        include ("common.php");
        ?>
    </head>
    <body><div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
            <?php include ("sidebar.php"); ?> <!-- End #sidebar -->
            <div id="main-content"> <!-- Main Content Section with everything -->
                <noscript> 
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
                        <h3><?php echo $mode . " " . $pagename ?></h3>
                        <div class="clear"></div>
                    </div> <!-- End .content-box-header -->
                    <div class="content-box-content">

                        <div class="tab-content default-tab" id="tab2">					
                            <form action="#" id="characteristics_frm" name="characteristics_frm" enctype="multipart/form-data" method="post" >	
                                <?php
                                $isChecked = 0; // change it to 0 and then run
                                ?>
                                <script language="javascript">
                                    function Toggle(id, chk) {
                                        document.getElementById(id).style.display = (chk) ? "none" : "block";
                                    }
                                </script>

                                <fieldset class="column-left">
                                    <p>
                                        <?php
                                        $selectQry2 = "select * from category";
                                        $result2 = mysql_query($selectQry2);
                                        ?>
                                        <label>Category Name</label>
                                        <select class="text-input medium-input datepicker" name="cat_id">
                                            <?php while ($row = mysql_fetch_array($result2)) { ?>
                                                <option <?php if ($row['id'] == $_REQUEST['cat_id']) { ?> selected="selected" <?php } ?> value="<?php echo $row['id']; ?>" ><?php echo $row['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </p>
                                    <p>
                                        <label>Question</label>
                                        <textarea name="question" id="question"><?php echo $question ?></textarea>
                                    </p>                                
                                    <p>
                                        <label>Answer</label>
                                        <?php
                                        $k = 0;
                                        $get_ingre = sel_rec(ANSWER, "*", "question_id='$id'", "id", "asc", "", false);
                                        if ($get_ingre != false) {
                                            while ($fetch_ingred = mysql_fetch_array($get_ingre)) {
                                                $replacement_arr = array();
                                                $csv_replacemnt = '';
                                                $ingred_id = $fetch_ingred['id'];
                                                $answer = $fetch_ingred['answer'];
                                                $true_ans = $fetch_ingred['true_ans'];
                                                ?>     
                                                <?php
                                                $data = get_single_value(QUESTION, flag, "id=$id", "id", "desc", "", false);
                                                ?>                              
                                                <div>
                                                    <input class="text-input medium-input datepicker" type="text" name="answer[]" id="answer[]" value="<?php echo $answer ?>" />
                                                    <input class="radio" type="checkbox" name="true_ans<?= $k ?>" <?php if ($true_ans == 1) { ?> checked="checked" <?php } ?> id="true_ans" value="<?= $k ?>" />
                                                </div>
                                                <div class="clear"></div>
                                                <?php
                                                $k = $k + 1;
                                            }
                                        } else {
                                            ?>
                                            <div>
                                                <input class="text-input medium-input datepicker" type="text" name="answer[]" id="answer[]" />
                                                <input class="radio" type="checkbox" name="true_ans<?= $k ?>" id="true_ans" value="<?= $k ?>"/>
                                            </div>
                                            <div class="clear"></div>
                                            <?php
                                            $k = $k + 1;
                                        }
                                        ?>
                                        <div id="more_imageupload" style="display:inline;"></div>
                                        <div class="clear"></div><br/>
                                        <div><a href="javascript:image_fileInput();" style="color:#900 !important">More</a></div>
                                    </p>
                                    <p>
                                        <label>Youtube Video Id<input type="checkbox"  name="flag" value="1" <?php if ($data == 1) { ?> checked="checked" <?php } ?> <?= ($isChecked == 1) ? ('checked') : (''); ?> onclick="Toggle('test01', this.checked)" /></label>
                                        <div>http://www.youtube.com/watch?v=</div> <div id="test02" style="display:<?= ($isChecked == 1) ? ('none') : ('block'); ?>;margin-top:-22px; margin-left:200px;">
                                            <input type="text" class="text-input medium-input datepicker" name="url" id="url" value="<?php echo $url ?>">
                                        </div>
                                    </p>
                                    <p>
                                        <label>Image<input type="checkbox" name="flag" value="0" <?php if ($data == 0) { ?> checked="checked" <?php } ?> <?= ($isChecked == 1) ? ('checked') : (''); ?> onclick="Toggle('test02', this.checked)" /></label>
                                        <div id="test01" style="display:<?= ($isChecked == 1) ? ('none') : ('block'); ?>;">
                                            <img width="20%" src="../images/<?= $image ?>" />
                                            <input class="text-input medium-input" type="file" id="image" name="image" size="60" />
                                        </div>
                                    </p>               
                                    <br/>
                                    <p>                                	
                                        <input class="button" type="submit" name="submit" id="submit" value="Submit" <?php if ($mode == 'add') { ?>onclick="return addclient();" <?php } ?> />
                                        &nbsp;&nbsp;
                                        <input type="button" name="back" id="back" class="button" value="Back" onclick="window.location.href = '<?php echo $listfile . "?" . $query_string ?>'" />		
                                    </p>
                                </fieldset>
                                <div class="clear"></div><!-- End .clear -->
                                <input type="hidden" name="start" value="<?php echo $start ?>" />	
                                <input type="hidden" name="more_box" id="more_box" value="<?= $k ?>" />
                                <input type="hidden" name="perpage" value="<?php echo $perpage ?>" />	
                                <input type="hidden" name="ord" value="<?php echo $ord ?>" />
                                <input type="hidden" name="mid" value="<?php echo $rw['id']; ?>" />	
                                <input type="hidden" name="search" value="<?php echo$search ?>" />	
                                <input type="hidden" name="mode" id="mode" value="<?php echo $mode ?>" />
                                <input type="hidden" name="id" value="<?php echo $id ?>" />
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