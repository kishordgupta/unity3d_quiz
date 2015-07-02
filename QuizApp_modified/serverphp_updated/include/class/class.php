<?php

class taste {

    public function check_user($dataArr) {
        $email = urldecode($dataArr['email']);
        $password = md5($dataArr['password']);
        return $this->login_email($email, $password);
    }

    public function register_email($dataArr) {
        $request_data = array_decode($dataArr);
        if ($dataArr['email'] != '' and is_dup_add(USER, "email", $dataArr['email']) == true) {
            $suc_arr = "DUBLICATE EMAIL"; //duplicate email
        } else {
            $fields['email'] = $request_data['email'];
            $fields['username'] = isset($request_data['username']) ? $request_data['username'] : '';
            $fields['password'] = md5($request_data['password']);
            $fields['datecreated'] = date("Y-m-d H:i:s");
            $fields['dateupdated'] = date("Y-m-d H:i:s");
            $fields['random_number'] = generate_randomnumber(10);
            $fields['status']= 1;
            $uid = ins_rec(USER, $fields, false);
            $fields['user_id'] = intval($uid);
            if ($uid > 0) {
                $to = $fields['email'];
                $subject = "Welcome to " . SITE_NAME;
                $from1 = FROM;
                $mailcontent = $this->sendmail($fields['email'], $dataArr['password']);
                SendHTMLMail($to, $subject, $mailcontent, $from1, $cc = "");
                $suc_arr = "OK";
            } else
                $suc_arr = "FAILED TO REGISTER"; //failed to register			
        }
        unset($fields['password']);
        unset($fields['dateupdated']);
        unset($fields['random_number']);
        return '{"data":' . json_encode(array_encode($fields)) . ',"success":' . json_encode($suc_arr) . '}';
    }

    public function login_email($email, $password) {
        $check_login = single_row(USER, "id,email,username", "(email='$email') AND password='$password' AND status=1");
        if ($check_login != false) {
            $arr['user_id'] = $check_login['id'];
            $arr['username'] = $check_login['username'];
            $arr['email'] = $check_login['email'];
            $suc_arr = "OK";
        } else {
            $suc_arr = "INVALID LOGIN CREDENTAILS"; //invalid login credentails
        }
        return '{"data":' . json_encode(array_encode($arr)) . ',"success":' . json_encode($suc_arr) . '}';
    }

    public function register_facebook($dataArr) {
        $request_data = array_decode($dataArr);
        $fields['username'] = $request_data['username'];
        $fields['email'] = $request_data['email'];
        $fields['facebook_id'] = $request_data['facebook_id'];
        $fields['datecreated'] = date("Y-m-d H:i:s");
        $fields['dateupdated'] = date("Y-m-d H:i:s");
        $fields['random_number'] = generate_randomnumber(10);
        $uid = ins_rec(USER, $fields, false);
        $twi_id = $request_data;
        $fields['uid'] = intval($uid);
        if ($uid > 0) {
            $suc_arr = "OK";
        } else {
            $suc_arr = "FAILED"; //failed
        }
        return '{"data":' . json_encode($fields) . ',"success":' . json_encode($suc_arr) . '}';
    }

    public function login_facebook($email, $facebook_id) {
        if ($facebook_id > 0) {
            $check_login = single_row(USER, "*", "email='$email'", "1", "desc", "", false);
            $userid = $check_login['id'];
            $fields['username'] = urlencode($check_login['username']);
            $fields['email'] = urlencode($check_login['email']);
            $fields['facebook_id'] = $facebook_id;
            $fields['uid'] = intval($check_login['id']);
            $uid = $check_login['id'];
            $upd_fb['dateupdated'] = date("Y-m-d H:i:s");
            $upd_fb['facebook_id'] = $fields['facebook_id'];
            upd_rec(USER, $upd_fb, "id=$uid", false);
            $suc_arr = "OK";
            return '{"data":' . json_encode($fields) . ',"success":' . json_encode($suc_arr) . '}';
        }
    }

    public function check_fb_user($dataArr) {
        $email = urldecode($dataArr['email']);
        $facebook_id = urldecode($dataArr['facebook_id']);
        if (is_dup_add(USER, "email", $email) == false) { //not exists - register	
            return $this->register_facebook($dataArr);
        } else {
            return $this->login_facebook($email, $facebook_id);
        }
    }

    public function sendmail($email, $password) {
        $content = '<table style="background-color:#0a3640;border:1px solid #CFCFCF;padding:10px;font-family:Verdana;font-size:12px;" width="100%">
		<tr><td><img src="' . SITE_URL . 'logo.png" /></td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>
		<table style="padding:10px;font-size:12px;background-color:#fff;border:1px solid #CFCFCF;" cellpadding="5">	
		<tr><td colspan="4">&nbsp;</td></tr>	
		<tr><td colspan="4" style="font-family:Verdana, Geneva, sans-serif;font-size:12px;text-align:left;">
		Welcome to the ' . SITE_NAME . '.&nbsp;!</td></tr>
		<tr><td colspan="4" style="font-family:Verdana, Geneva, sans-serif;font-size:12px;">
			Login credentils are as below<b></td></tr>
		<tr>
		<td colspan="4">
			<table height="30" style="font-family:Verdana, Geneva, sans-serif;font-size:12px;width:600px;border-collapse:collapse;">
				<tr>					
					<th style="border: 1px solid #808080 !important;font-size:1.1em;text-align:left;padding-top:5px;padding-left:10px;padding-bottom:5px;
					background-color:#cdcdcd !important;color:#000000 !important;" width="20%">Email</th>
					<th style="border: 1px solid #808080 !important;font-size:1.1em;text-align:left;padding-top:5px;padding-left:10px;padding-bottom:5px;
					background-color:#cdcdcd !important;color:#000000 !important;" width="35%">' . $email . '</th></tr>
				<tr><th style="border: 1px solid #808080 !important;font-size:1.1em;text-align:left;padding-top:5px;padding-left:10px;padding-bottom:5px;
					background-color:#cdcdcd !important;color:#000000 !important;" width="16%">Password</th>
					<th style="border: 1px solid #808080 !important;font-size:1.1em;text-align:left;padding-top:5px;padding-left:10px;padding-bottom:5px;
					background-color:#cdcdcd !important;color:#000000 !important;" width="35%">' . $password . '</th></tr>
				</table></td></tr>				
				<tr><td style="font-family:Verdana, Geneva, sans-serif;font-size:12px;text-align:left;" colspan="4">Keep it in a safe place! You can change your account information from Account screen!</td></tr>
				<tr><td style="font-family:Verdana, Geneva, sans-serif;font-size:12px;text-align:left;" colspan="4">Thank You,</td></tr>
				<tr><td style="font-family:Verdana, Geneva, sans-serif;font-size:12px;text-align:left;" colspan="4">
				' . SITE_NAME . ' Team</td></tr>';
        $content.='</table>
		</td>
	</tr>
	</table>';
        return $content;
    }

    public function post_forgot_password($dataArr) {
        $request_data = array_decode($dataArr);
        $email = $request_data['email'];
        $newpass = generate_password(6);
        $arr['password'] = md5($newpass);
        $updt = upd_rec(USER, $arr, "email='$email'");
        if ($updt != false) {
            $this->forgot_password_mail($email, $newpass);
            $suc_arr = "OK";
        } else
            $suc_arr = "FAIL";
        return '{"success":' . json_encode($suc_arr) . '}';
    }

    public function forgot_password_mail($email, $password) {
        $content = '<table style="background-color:#0a3640;border:1px solid #CFCFCF;padding:10px;font-family:Verdana;font-size:12px;" width="100%">
                        <tr><td><img src="' . SITE_URL . 'logo.png" /></td></tr>
                        <tr><td>&nbsp;</td></tr>
                        <tr><td>
                    <table style="padding:10px;font-size:12px;background-color:#fff;border:1px solid #CFCFCF;" cellpadding="5" width="100%">	
                        <tr><td colspan="4">&nbsp;</td></tr>	
                        <tr><td colspan="4" style="font-family:Verdana, Geneva, sans-serif; font-size:12px;text-align:left;">
                            <b>Hi,</b><br \>We received a request that you forgot your password.</td></tr>
                        <tr style="border:1px solid #808080!important;font-size:1.1em;text-align:left;padding-top:5px;
                        padding-left:10px;padding-bottom:5px;background-color:#cdcdcd;color:#000000!important">
                            <td width="35%">Your new password is :</td><td>' . $password . '</td></tr>
                        <tr style="border:1px solid #808080!important;font-size:1.1em;text-align:left;padding-top:5px;padding-left:10px;padding-bottom:5px;background-color:#cdcdcd!important;color:#000000!important">
                            <td>Your login email is </td>
                            <td>' . $email . '</td></tr>
                        <tr><td style="font-family:Verdana,Geneva,sans-serif;font-size:12px;text-align:left;" colspan="4">
                            ' . SITE_NAME . ' Team</td></tr></td></tr></table>';
        return $content;
    }

    public function get_events($dataArr) {
        $request_data = array_decode($dataArr);
        $cat_id = $request_data['cat_id'];
        if ($cat_id > 0) {
            $where = " AND e.cat_id=$cat_id AND e.cat_id=c.id";
        }
        $get_event = sel_rec(EVENT . " e," . CAT . " c", "e.*,c.cat_name", "e.status=1 $where", "id", "desc");
        if ($get_event != false) {
            $i = 0;
            while ($fetch_event = mysql_fetch_array($get_event)) {
                $arr[$i]['id'] = $fetch_event['id'];
                $id = $fetch_event['id'];
                $arr[$i]['bookmark_flag'] = get_single_value(BOOKMARK, "bookmark_flag", "facebook_id={$fetch_event['id']} and status=1");
                $arr[$i]['title'] = $fetch_event['title'];
                $arr[$i]['cat_id'] = $fetch_event['cat_id'];
                $arr[$i]['cat_name'] = $fetch_event['cat_name'];
                $arr[$i]['start_date'] = $fetch_event['start_date'];
                $arr[$i]['end_date'] = $fetch_event['end_date'];
                $arr[$i]['location'] = $fetch_event['location'];
                $arr[$i]['contact_person'] = $fetch_event['contact_person'];
                $arr[$i]['organizer'] = $fetch_event['organizer'];
                $i++;
            }
            $suc_arr = "OK";
        } else
            $suc_arr = "FAIL";
        return '{"data":' . json_encode(array_encode($arr)) . ',"success":' . json_encode($suc_arr) . '}';
    }

    public function get_quiz($dataArr) {
        global $SITE_URL;
        $quiz_id = $_REQUEST['cat_id'];
        $rs = sel_rec(QUESTION, "*", "cat_id=$quiz_id", "rand()", "ASC", false);
        if ($rs > 0) {
            $suc_arr = "1";
            $i = 0;
            while ($row = mysql_fetch_array($rs)) {
                $fields[$i]['quiz_id'] =  utf8_encode($row['id']);
                $fields[$i]['flag'] =  utf8_encode($row['flag']);
                $image_path = '';
                if ($row['image'] != '' and file_exists(FILM_IMAGE_DIR . $row['image'])) {
                    $image_path = $row['image'];
                    $image_name = $row['image'];
                    $image_path = $SITE_URL . FILM_IMAGE_DIR . $row['image'];
                    $fields[$i]['image'] =  utf8_encode($image_path);
                } else {
                    $fields[$i]['image'] = "";
                }
                $recipe_id = $row['id'];
                $fields[$i]['category'] =  utf8_encode(get_single_value(CATEGORY, "name", "id=$quiz_id"));
                $fields[$i]['question'] =  utf8_encode($row['question']);
                $id =  utf8_encode($row['id']);
                $fields[$i]['total_answer'] =  utf8_encode(get_single_value(ANSWER, "count(question_id)", "question_id=$id"));
                $fields[$i]['answer'] = $this->get_answer($recipe_id);
                $fields[$i]['video_url'] =  utf8_encode($row['url']);
                $i++;
            }
        } else {
            $suc_arr = "-1";
        }
//        return '{"data":' . json_encode(array_encode($fields)) . $new_off . ',"success":' . json_encode($suc_arr) . '}';
        return '{"data":' . json_encode($fields) . $new_off . ',"success":' . json_encode($suc_arr) . '}';
    }

    public function get_appsetting($dataArr) {
        global $SITE_URL;
        $rs = sel_rec(APPSETTING, "*", "status=1", "id", "ASC");
        if ($rs > 0) {
            $suc_arr = "1";
            $i = 0;
            while ($row = mysql_fetch_array($rs)) {
                $fields[$i]['id'] = $row['id'];
                $fields[$i]['highlight_answer'] = $row['flag'];
                $fields[$i]['correct_answer_message'] = $row['correct_message'];
                $fields[$i]['wrong_answer_message'] = $row['wrong_message'];
                $fields[$i]['completion_message'] = $row['message'];
                $i++;
            }
        } else {
            $suc_arr = "-1";
        }
        return '{"data":' . json_encode(array_encode($fields)) . $new_off . ',"success":' . json_encode($suc_arr) . '}';
    }

    public function get_answer($recipe_id) {
        $get_ingred = sel_rec(ANSWER, "*", "question_id=$recipe_id");
        $arr_ingred = array();
        if ($get_ingred != false) {
            $j = 1;
            $i = 0;
            while ($fetch_ingred = mysql_fetch_assoc($get_ingred)) {
                $arr_ingred[$i][$i] =  utf8_encode($fetch_ingred['answer']);
                $arr_ingred[$i]['correct_ans'] =  utf8_encode($fetch_ingred['true_ans']);
                $i++;
                $J++;
            }
            return $arr_ingred;
        }
    }

    public function get_category($cat_id) {
        $rs = sel_rec(CATEGORY, "*", "status=1", "id", "ASC");
        $i = "";
        if ($rs > 0) {
            $suc_arr = "1";
            $i = 0;
            while ($row = mysql_fetch_assoc($rs)) {
                $fields[$i]['id'] = $row['id'];
                $fields[$i]['name'] = $row['name'];
                $fields[$i]['description'] = $row['description'];
                $fields[$i]['correct_ans_score'] = $row['correct_ans_score'];
                $fields[$i]['wrong_ans_score'] = $row['wrong_ans_score'];
                $fields[$i]['time'] = $row['time'];
                $fields[$i]['status'] = $row['status'];
                $i++;
            }
        } else {
            $suc_arr = "-1";
        }
        return '{"data":' . json_encode(array_encode($fields)) . ',"success":' . json_encode($suc_arr) . '}';
    }

    public function update_score($dataArr) {
        $score = array_decode($dataArr);
        $fields = array('user_id' => $score['user_id'], 'category_id' => $score['cat_id'], 'score' => $score['score']);
        $where = "user_id={$score['user_id']} AND category_id={$score['cat_id']}";
        if (single_row(SCORE, 'score', $where)) {
            upd_rec(SCORE, array('score' => $score['score']), $where);
        } else {
            ins_rec(SCORE, $fields);
        }
        return '{"data":' . json_encode(array_encode($fields)) . ',"success":' . json_encode('1') . '}';
    }

    public function get_user_score() {
        $result = sel_rec(SCORE, '*', "user_id={$_REQUEST['user_id']}");
        if ($result) {
            $fields = array('user_id' => $_REQUEST['user_id']);
            while ($row = mysql_fetch_assoc($result)) {
                $fields[] = array(
                    'category_id' => $row['category_id'],
                    'score' => $row['score']
                );
            }
            $suc_arr = "1";
        } else {
            $fields = array();
            $suc_arr = "-1";
        }
        return '{"data":' . json_encode($fields) . ',"success":' . json_encode($suc_arr) . '}';
    }

    public function get_top_score() {
        $query = 'SELECT username,category_id, MAX(score) AS score '
                . 'FROM user_category_score '
                . 'LEFT JOIN user_info ON user_info.id=user_category_score.user_id '
                . 'GROUP BY category_id';
        $result = mysql_query($query);
        $fields = array();
        if (mysql_num_rows($result) > 0) {
            while ($row = mysql_fetch_assoc($result)) {
                $fields[] = $row;
            }
            $suc_arr = '1';
        } else {
            $suc_arr = '-1';
        }
        return '{"data":' . json_encode($fields) . ',"success":' . json_encode($suc_arr) . '}';
    }

    public function get_top_scorer() {
        $query = 'SELECT username,category_id, score '
                . 'FROM user_category_score '
                . 'LEFT JOIN user_info ON user_info.id=user_category_score.user_id '
                . 'WHERE category_id=' . $_REQUEST['cat_id']
                . ' ORDER BY score DESC LIMIT 0,10';
        $result = mysql_query($query);
        if (mysql_num_rows($result) > 0) {
            $fields = array('category_id' => $_REQUEST['cat_id']);
            while ($row = mysql_fetch_assoc($result)) {
                $fields[] = array('username' => $row['username'], 'score' => $row['score']);
            }
            $suc_arr = '1';
        } else {
            $fields = array();
            $suc_arr = '-1';
        }
        return '{"data":' . json_encode($fields) . ',"success":' . json_encode($suc_arr) . '}';
    }

}
