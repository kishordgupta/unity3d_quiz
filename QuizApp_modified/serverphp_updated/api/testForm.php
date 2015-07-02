<html>
    <head><title>API Test Forms</title></head>
    <body>
        <div class="container">
            <h1>API Test Forms</h1>
            <br />
            <h3>API register_email</h3>
            <form method="POST" action="api.php">
                <table border="0" cellpadding="3" cellspacing="1">
                    <tr>
                        <td>api</td>
                        <td>register_email<input type="hidden" name="api" value="register_email" /></td>
                    </tr>
                    <tr>
                        <td>sign</td>
                        <td><input type="text" value="" name="sign" /></td>
                    </tr>
                    <tr>
                        <td>salt</td>
                        <td><input type="text" value="" name="salt" /></td>
                    </tr>
                    <tr>
                        <td>username</td>
                        <td><input name="username" type="text" value="" /> User full name.</td>
                    </tr>
                    <tr>
                        <td>email</td>
                        <td><input name="email" type="text" value="" /></td>
                    </tr>
                    <tr>
                        <td>password</td>
                        <td><input name="password" type="text" value="" /></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="Submit" size="" /></td>
                    </tr>
                </table>
            </form>
            <hr />
            <h3>API login_email</h3>
            <form method="POST" action="api.php">
                <table border="0" cellpadding="3" cellspacing="1">
                    <tr>
                        <td>api</td>
                        <td>login_email<input type="hidden" name="api" value="login_email" /></td>
                    </tr>
                    <tr>
                        <td>sign</td>
                        <td><input type="text" value="" name="sign" /></td>
                    </tr>
                    <tr>
                        <td>salt</td>
                        <td><input type="text" value="" name="salt" /></td>
                    </tr>
                    <tr>
                        <td>email</td>
                        <td><input name="email" type="text" value="" /></td>
                    </tr>
                    <tr>
                        <td>password</td>
                        <td><input name="password" type="text" value="" /></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="Submit" size="" /></td>
                    </tr>
                </table>
            </form>
            <hr />
            <h3>API register_or_login_facebook</h3>
            <form method="POST" action="api.php">
                <table border="0" cellpadding="3" cellspacing="1">
                    <tr>
                        <td>api</td>
                        <td>register_or_login_facebook<input type="hidden" name="api" value="register_or_login_facebook" /></td>
                    </tr>
                    <tr>
                        <td>sign</td>
                        <td><input type="text" value="" name="sign" /></td>
                    </tr>
                    <tr>
                        <td>salt</td>
                        <td><input type="text" value="" name="salt" /></td>
                    </tr>
                    <tr>
                        <td>email</td>
                        <td><input name="email" type="text" value="" /></td>
                    </tr>
                    <tr>
                        <td>username</td>
                        <td><input name="username" type="text" value="" /> Facebook Name</td>
                    </tr>
                    <tr>
                        <td>facebook_id</td>
                        <td><input name="facebook_id" type="text" value="" /></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="Submit" size="" /></td>
                    </tr>
                </table>
            </form>
            <hr />
            <h3>API update_score</h3>
            <form method="POST" action="api.php">
                <table border="0" cellpadding="3" cellspacing="1">
                    <tr>
                        <td>api</td>
                        <td>update_score<input type="hidden" name="api" value="update_score" /></td>
                    </tr>
                    <tr>
                        <td>sign</td>
                        <td><input type="text" value="" name="sign" /></td>
                    </tr>
                    <tr>
                        <td>salt</td>
                        <td><input type="text" value="" name="salt" /></td>
                    </tr>
                    <tr>
                        <td>cat_id</td>
                        <td><input type="text" value="" name="cat_id" /> required field</td>
                    </tr>
                    <tr>
                        <td>user_id</td>
                        <td><input type="text" value="" name="user_id" /> required field</td>
                    </tr>
                    <tr>
                        <td>score</td>
                        <td><input type="text" value="" name="score" /> required field</td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="Submit" size="" /></td>
                    </tr>
                </table>
            </form>
            <hr />
            <h3>API get_user_score</h3>
            <form method="POST" action="api.php">
                <table border="0" cellpadding="3" cellspacing="1">
                    <tr>
                        <td>api</td>
                        <td>get_user_score<input type="hidden" name="api" value="get_user_score" /></td>
                    </tr>
                    <tr>
                        <td>sign</td>
                        <td><input type="text" value="" name="sign" /></td>
                    </tr>
                    <tr>
                        <td>salt</td>
                        <td><input type="text" value="" name="salt" /></td>
                    </tr>
                    <tr>
                        <td>user_id</td>
                        <td><input type="text" value="" name="user_id" /> required field</td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="Submit" size="" /></td>
                    </tr>
                </table>
            </form>
            <hr />
            <h3>API get_top_score</h3>
            <form method="POST" action="api.php">
                <table border="0" cellpadding="3" cellspacing="1">
                    <tr>
                        <td>api</td>
                        <td>get_top_score<input type="hidden" name="api" value="get_top_score" /></td>
                    </tr>
                    <tr>
                        <td>sign</td>
                        <td><input type="text" value="" name="sign" /></td>
                    </tr>
                    <tr>
                        <td>salt</td>
                        <td><input type="text" value="" name="salt" /></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="Submit" size="" /></td>
                    </tr>
                </table>
            </form>
            <hr />
            <h3>API get_top_scorer</h3>
            <form method="POST" action="api.php">
                <table border="0" cellpadding="3" cellspacing="1">
                    <tr>
                        <td>api</td>
                        <td>get_top_scorer<input type="hidden" name="api" value="get_top_scorer" /></td>
                    </tr>
                    <tr>
                        <td>sign</td>
                        <td><input type="text" value="" name="sign" /></td>
                    </tr>
                    <tr>
                        <td>salt</td>
                        <td><input type="text" value="" name="salt" /></td>
                    </tr>
                    <tr>
                        <td>cat_id</td>
                        <td><input type="text" value="" name="cat_id" /> required field</td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="Submit" size="" /></td>
                    </tr>
                </table>
            </form>
            <hr />
            <h3>API get_category</h3>
            <form method="POST" action="api.php">
                <table border="0" cellpadding="3" cellspacing="1">
                    <tr>
                        <td>api</td>
                        <td>get_category<input type="hidden" name="api" value="get_category" /></td>
                    </tr>
                    <tr>
                        <td>sign</td>
                        <td><input type="text" value="" name="sign" /></td>
                    </tr>
                    <tr>
                        <td>salt</td>
                        <td><input type="text" value="" name="salt" /></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="Submit" size="" /></td>
                    </tr>
                </table>
            </form>
            <hr />
            <h3>API get_app_settings</h3>
            <form method="POST" action="api.php">
                <table border="0" cellpadding="3" cellspacing="1">
                    <tr>
                        <td>api</td>
                        <td>get_app_settings<input type="hidden" name="api" value="get_app_settings" /></td>
                    </tr>
                    <tr>
                        <td>sign</td>
                        <td><input type="text" value="" name="sign" /></td>
                    </tr>
                    <tr>
                        <td>salt</td>
                        <td><input type="text" value="" name="salt" /></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="Submit" size="" /></td>
                    </tr>
                </table>
            </form>
            <hr />
            <h3>API get_quiz</h3>
            <form method="POST" action="api.php">
                <table border="0" cellpadding="3" cellspacing="1">
                    <tr>
                        <td>api</td>
                        <td>get_quiz<input type="hidden" name="api" value="get_quiz" /></td>
                    </tr>
                    <tr>
                        <td>sign</td>
                        <td><input type="text" value="" name="sign" /></td>
                    </tr>
                    <tr>
                        <td>salt</td>
                        <td><input type="text" value="" name="salt" /></td>
                    </tr>
                    <tr>
                        <td>cat_id</td>
                        <td><input type="text" value="" name="cat_id" /> required field</td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="Submit" size="" /></td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>