<?php
$headers = apache_request_headers();
$is_ajax = (isset($headers['X-Requested-With']) && $headers['X-Requested-With'] == 'XMLHttpRequest');
if ($is_ajax) {
    include '../include/connect.php';
    is_admin_login();
    ?>
<div class="loader"></div>
    <table>
        <tr><th>Category</th><th>Name</th><th>Score</th></tr>
        <?php
        $cat_id = (isset($_REQUEST['cat']) && $_REQUEST['cat'] != 'all') ? $_REQUEST['cat'] : ''; 
        if(intval($cat_id)){
            $where = 'WHERE category_id=' . $cat_id . ' ';
        }
        $query = 'SELECT username,name,score '
                . 'FROM user_category_score '
                . 'LEFT JOIN user_info ON user_info.id=user_category_score.user_id '
                . 'LEFT JOIN category ON category.id=user_category_score.category_id '
                . $where
                . 'ORDER BY score DESC '
                . 'LIMIT 0,10';
        $top_ten = mysql_query($query);
        if (mysql_num_rows($top_ten) > 0) {
            while ($top = mysql_fetch_assoc($top_ten)) {
                echo '<tr><td>' . $top['name'] . '</td>';
                echo '<td>' . $top['username'] . '</td>';
                echo '<td>' . $top['score'] . '</td></tr>';
            }
        } else {
            echo '<tr><td colspan="3">No record found</td></tr>';
        }
        ?>
    </table>
    <?php
}