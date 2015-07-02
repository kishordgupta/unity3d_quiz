<?php
include ("../include/connect.php");
is_admin_login();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Dashboard <?php echo $ADMIN_TITLE ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <?php include ("common.php"); ?>
    </head>
    <body><a name="top"></a>
        <div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
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
                <h2>Welcome <?php echo $Adm_Fname; ?>&nbsp;<?php echo $Adm_Lname; ?></h2>
                <p id="page-intro">What would you like to do?</p>
                <?php include('shortcut.php'); ?>
                <div class="clear"></div> <!-- End .clear -->
                <!-- End .content-box -->

                <div class="content-box column-left"  style="width:500px">
                    <div class="content-box-header">
                        <h3>General Statistic</h3>
                    </div> <!-- End .content-box-header -->
                    <div class="content-box-content">
                        <div style="float: right; margin-bottom: 10px;">Categories<select name="category_list" id="category_list">
                                <option value="all">All</option>
                                <?php
                                $category_list = mysql_query('SELECT id,name FROM category WHERE `status`=1');
                                if (mysql_num_rows($category_list) > 0) {
                                    while ($category = mysql_fetch_assoc($category_list)) {
                                        echo '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div id="score_baord">
                            <div class="loader"></div>
                            <table>
                                <tr><th>Category</th><th>Name</th><th>Score</th></tr>
                                <?php
                                $query = 'SELECT username,name,score '
                                        . 'FROM user_category_score '
                                        . 'LEFT JOIN user_info ON user_info.id=user_category_score.user_id '
                                        . 'LEFT JOIN category ON category.id=user_category_score.category_id '
                                        . 'ORDER BY score DESC '
                                        . 'LIMIT 0,10';
                                $top_ten = mysql_query($query);
                                if (mysql_num_rows($top_ten) > 0) {
                                    while ($top = mysql_fetch_assoc($top_ten)) {
                                        echo '<tr><td>' . $top['name'] . '</td>';
                                        echo '<td>' . $top['username'] . '</td>';
                                        echo '<td>' . $top['score'] . '</td></tr>';
                                    }
                                }
                                ?>
                            </table>
                        </div>
                        <script type="text/javascript">
                            $('#category_list').change(function() {
                                $('.loader').show();
                                $('#score_baord').load('score.php', {'cat': $(this).val()});
                            });
                        </script>
                    </div> <!-- End .content-box-content -->
                </div> <!-- End .content-box -->			
                <!-- End .content-box -->
                <div class="clear"></div>
                <!-- End Notifications -->
                <?php include ("footer.php"); ?>
            </div> <!-- End #main-content -->
        </div>
    </body>
</html>