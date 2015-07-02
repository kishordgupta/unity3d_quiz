<?php
include ("../include/connect.php");
is_admin_login();
$user_info = mysql_query('SELECT username FROM ' . USER . ' WHERE id=' . $_REQUEST['id']);
if (mysql_num_rows($user_info) > 0) {
    $row = mysql_fetch_assoc($user_info);
}
?>
<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        <h3>Details Score of <?php echo $row['username']; ?></h3>
    </div>
    <div class="content-box-content">
        <table class="user-details">
            <thead>
                <tr><th>Category</th><th>Score</th></tr>
            </thead>
            <tbody>
                <?php
                $query = 'SELECT name,score '
                        . 'FROM user_category_score '
                        . 'LEFT JOIN category ON category.id=user_category_score.category_id '
                        . 'WHERE user_category_score.user_id=' . $_REQUEST['id']
                        . ' ORDER BY name';
                $user_scores = mysql_query($query);
                if (mysql_num_rows($user_scores) > 0) {
                    while ($user_score = mysql_fetch_assoc($user_scores)) {
                        echo '<tr><td>' . $user_score['name'] . '</td>';
                        echo '<td>' . $user_score['score'] . '</td></tr>';
                    }
                } else {
                    echo '<tr><td colspan="2">NO RECORD FOUND</td></tr>';
                }
                ?>
            </tbody>
        </table>
        <style>
            .user-details{width: 100%}
            .user-details tbody{border-top: 1px solid #ccc;}
            .user-details tbody tr:nth-child(2n+1){background-color: #f3f3f3;}
            .user-details th,.user-details td{line-height: 1.3em;padding: 6px !important;text-align: left;}
        </style>
    </div>
</div>