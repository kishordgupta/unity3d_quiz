<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/invalid.css" type="text/css" media="screen" />	
<script src="js/jquery-1.7.min.js"></script>
<!--<script type="text/javascript" src="scripts/jquery-1.3.2.min.js"></script>-->
<script type="text/javascript" src="scripts/simpla.jquery.configuration.js"></script>
<script type="text/javascript" src="scripts/facebox.js"></script>

<script type="text/javascript" src="js/validation.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript" src="scripts/sexyalertbox.v1.2.jquery.js"></script>

<script type="text/javascript" src="scripts/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="scripts/browser.js"></script>
<script type="text/javascript" src="js/smoothscroll.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="css/sexyalertbox.css"/>

<script src="css/font/cufon-yui.js" type="text/javascript"></script>
<script src="css/font/Arial_400.font.js" type="text/javascript"></script>
<script type="text/javascript" src="css/font/fonts.js"></script>

<link type="text/css" href="css/jquery-ui-1.8.11.custom.css" rel="stylesheet" />	
<!--<script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>-->
<script type="text/javascript" src="js/jquery-ui-1.8.11.custom.min.js"></script>

<style>
    .ui-timepicker-div .ui-widget-header{ margin-bottom: 8px; }
    .ui-timepicker-div dl{ text-align: left; }
    .ui-timepicker-div dl dt{ height: 25px; }
    .ui-timepicker-div dl dd{ margin: -25px 0 10px 65px; }
    .ui-timepicker-div td { font-size: 90%; }
</style>

<script type="text/javascript">
    $(function() {
        $('#start_date').datepicker({dateFormat: 'yy-mm-dd', timeFormat: 'HH:mm:ss'});
        $('#end_date').datepicker({dateFormat: 'yy-mm-dd', timeFormat: 'HH:mm:ss'});
    });
</script><?php
$Adm_UserId = $_SESSION['Adm_UserId'];
$Adm_Email = $_SESSION['Adm_Email'];
$Adm_UserNm = $_SESSION['Adm_UserNm'];
$Adm_Fname = $_SESSION['Adm_Fname'];
$Adm_Lname = $_SESSION['Adm_Lname'];

$msg_disp = "";
if (isset($_GET['msg']) && $_GET['msg'] != "") {
    $msg = strtolower($_GET['msg']);

    switch ($msg) {
        case "add" :
            $msg_class = "success";
            $msg_disp = $pagename . " " . $msg_arr[$msg];
            break;
        case "edit" :
            $msg_class = "success";
            $msg_disp = $pagename . " " . $msg_arr[$msg];
            break;
        case "active" :
            $msg_class = "success";
            $msg_disp = $pagename . " " . $msg_arr[$msg];
            break;
        case "inactive" :
            $msg_class = "success";
            $msg_disp = $pagename . " " . $msg_arr[$msg];
            break;
        case "delete" :
            $msg_class = "error";
            $msg_disp = $pagename . " " . $msg_arr[$msg];
            break;
        case "dup" :
            $msg_class = "error";
            $msg_disp = $pagename . " " . $msg_arr[$msg];
            break;
        case "send" :
            $msg_class = "success";
            $msg_disp = $pagename . " " . $msg_arr[$msg];
            break;
        case "send_nws" :
            $msg_class = "success";
            $msg_disp = $msg_arr[$msg];
            break;
        case "invalid_login" :
            $msg_disp = $msg_arr[$msg];
            break;
        case "comment_approved":
            $msg_class = "success";
            $msg_disp = $msg_arr[$msg];
            break;
        case "email_exist":
            $msg_class = "error";
            $msg_disp = $msg_arr[$msg];
            break;
        case "max_size":
            $msg_class = "error";
            $msg_disp = $msg_arr[$msg];
            break;
        case "pop_exists":
            $msg_class = "error";
            $msg_disp = $msg_arr[$msg];
            break;
        case "dup_game":
            $msg_class = "error";
            $msg_disp = $msg_arr[$msg];
            break;
    }
}
