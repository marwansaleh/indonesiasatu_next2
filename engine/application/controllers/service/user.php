<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of User
 *
 * @author marwansaleh
 */
class User extends REST_Api {
    private $users;
    function __construct($config='rest') {
        parent::__construct($config);
        //Load User Library
        $this->users = Userlib::getInstance();
    }
    
    function socmed_post(){
        $result = array('status' => FALSE);
        //Load data model
        $this->load->model(array('users/user_m','users/user_socmed_m', 'users/usergroup_m'));
        
        $client_app = $this->post('app');
        $client_id = $this->post('id');
        $name = $this->post('name');
        $email = $this->post('email');
        $picture = $this->post('picture');
        
        //check user scomed exists
        $user_filter_condition = array('client_app' => $client_app, 'client_id' => $client_id);
        if (!$this->user_socmed_m->get_count($user_filter_condition)){
            
            //create new user internall database
            $user_id = $this->user_m->save(array(
                'username'  => $client_app .'_'. $client_id,
                'password'  => $this->users->hash($client_id),
                'full_name' => $name,
                'group_id'  => $this->usergroup_m->get_value('group_id',array('group_name' => 'Socmed')),
                'type'      => USERTYPE_EXTERNAL,
                'email'     => $email,
                'avatar'    => $picture,
                'last_ip'   => $this->input->ip_address(),
                'created_on'=> time(),
                'is_active' => 1
            ));
            if ($user_id){
                $this->user_socmed_m->save(array(
                    'user_id'       => $user_id,
                    'client_app'    => $client_app,
                    'client_id'     => $client_id,
                    'client_name'   => $name,
                    'client_email'  => $email
                ));
                $new_user = new stdClass();
                $new_user->id = $user_id;
                
                $result['status'] = TRUE;
                $result['user'] = $new_user;
            }else{
                $result['message'] = 'Faile creating new user';
            }
        }else{
            $result['status'] = TRUE;
            $user = $this->user_socmed_m->get_select_where('user_id as id',$user_filter_condition, TRUE);
            $result['user'] = $user;
        }
        
        $this->response($result);
    }
    
    function posts_get(){
        $month = $this->get('month');
        $year = $this->get('year');
        
        if ($month && $year){
            //get all users
            $users = $this->users->get_user_internal();
            $articles = $this->_get_stat_articles($month, $year);
            $published = $this->_get_stat_published($month, $year);

            $result = array();
            foreach ($users as $user){
                $statistic = new stdClass();
                $statistic->userid = $user->id;
                $statistic->username = $user->username;
                $statistic->name = $user->full_name;
                $statistic->articles = isset($articles[$user->id]) ? $articles[$user->id] : 0;
                $statistic->published = isset($published[$user->id]) ? $published[$user->id] : 0;
                $result[] = $statistic;
            }
            $this->response($result);
        }else{
            show_404();
        }
    }
    
    private function _get_stat_articles($month, $year){
        if (!isset($this->article_m)){
            $this->load->model('article/article_m');
        }
        
        $sql = 'SELECT created_by,count(*) AS articles FROM nsc_articles WHERE MONTH(FROM_UNIXTIME(created))=? AND YEAR(FROM_UNIXTIME(created))=? GROUP BY created_by';
        $query = $this->db->query($sql, array($month,$year));
        
        $result = array();
        foreach ($query->result() as $row){
            $result[$row->created_by] = $row->articles;
        }
        
        return $result;
    }
    
    private function _get_stat_published($month, $year){
        if (!isset($this->article_m)){
            $this->load->model('article/article_m');
        }
        
        $sql = 'SELECT created_by,count(*) AS articles FROM nsc_articles WHERE published=1 AND MONTH(FROM_UNIXTIME(created))=? AND YEAR(FROM_UNIXTIME(created))=? GROUP BY created_by';
        $query = $this->db->query($sql, array($month,$year));
        
        $result = array();
        foreach ($query->result() as $row){
            $result[$row->created_by] = $row->articles;
        }
        
        return $result;
    }
    
    function postdetail_get(){
        $this->load->model(array('article/article_m','article/category_m'));
        
        $userid = $this->get('user');
        $month = $this->get('month');
        $year = $this->get('year');
        
        if ($userid && $month && $year){
            $result = array();

            //get userinfo
            $user = $this->user_m->get($userid);

            $userinfo = new stdClass();
            $userinfo->userid = $userid;
            $userinfo->username = $user->username;
            $userinfo->name = $user->full_name;
            

            //get article for this user
            $sql = 'SELECT created,title,published,category_id,url_short as url FROM nsc_articles WHERE created_by=? AND MONTH(FROM_UNIXTIME(created))=? AND YEAR(FROM_UNIXTIME(created))=?';
            $articles = $this->db->query($sql, array($userid,$month,$year));
            foreach ($articles->result() as $article){
                $article->date = date('Y-m-d H:i', $article->created);
                $article->category = $this->category_m->get_value('name', array('id'=>$article->category_id));
                $article->published = $article->published==1?'Yes':'No';
                $result['articles'] [] = $article;
            }
            $userinfo->articles = count($result['articles']);
            
            $result['user'] = $userinfo;


            $this->response($result);
        }else{
            show_404();
        }
    }
    
    function resetpasswordrequest_post(){
        $this->load->model('users/forgot_passwd_m');
        $result = array('status'=> FALSE);
        
        $email = $this->post('email');
        //check the email if registered in the system
        if (!isset($this->user_m)){
            $this->load->model('users/user_m');
        }
        //get the user by his email address
        $user_record = $this->user_m->get_by(array('email'=>$email), TRUE);
        if (!$user_record){
            $result['message'] = 'Sorry. your email has not registered in the system. Please type your registered email address.';
        }else{
            //ok this user has registered email address, generate reset link
            $valid_time = strtotime('+1 day');
            $reset_code = md5($valid_time. $email);
            $encoded_time = urlencode($reset_code);
            $reset_link = site_url('auth/reset_password/'. $encoded_time);
            
            //create email for this user
            $subject = 'IndonesiaSatu.co - Link to Reset Password';
            $recipient = $user_record->full_name .' <'. $email.'>';
            $content = '<p>Dear '. $user_record->full_name.',</p><br>';
            $content.= '<p>You are receiving this email as a response to your request to reset account password in IndonesiaSatu.co website. Please click this link <a href="'.  $reset_link.'">'.$reset_link.'</a> to reset and create your new password.</p>';
            $content.= '<br><p>Please note that the link will be valid for 24 hours or before '. date('l, d F Y H:i:s', $valid_time).'. </p>';
            $content.= '<br><br><p>Regards<br>IndonesiaSatu.co Administrator</p>';
            if (strlen($content) > 70){
                $content = wordwrap($content, 70, "\r\n");
            }
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From: IndonesiaSatu.co Administrator <no-reply@indonesiasatu.co>' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
            $send_email = mail($recipient, $subject, $content, $headers);
            if ($send_email){
                //save to database that email reset password has been sent
                $this->forgot_passwd_m->save(array(
                    'email'         => $email,
                    'link_reset'    => $reset_code,
                    'valid_time'    => $valid_time,
                    'used'          => 0
                ));
                
                $result['status'] = TRUE;
                $result['message'] = 'Your link to reset password has been sent to your email address '.$email.'. Please check your email and follow the link. <br><br>Please be sure that the link will be valid for 24 hours.<br><br><a href="'.  site_url().'">Back to home page</a>';
            }else{
                $result['message'] = 'Sorry. We are failed to send you email to reset password. Please contact your administrator.';
            }
        }
        
        $this->response($result);
    }
    function resetpassword_post(){
        $result = array('status'=> FALSE);
        
        $email = $this->post('email');
        $new_password = $this->post('new_password');
        $confirm_password = $this->post('confirm_password');
        
        //check if both password are match
        if ($new_password != $confirm_password){
            $result['message'] = 'Password did not match. Please make sure you type both password correctly.';
        }else{
            if (!isset($this->user_m)){
                $this->load->model('users/user_m');
            }
            //get the user by his email address
            $user_record = $this->user_m->get_by(array('email'=>$email), TRUE);
            if (!$user_record){
                //fatal error
                $result['message'] = 'Fatal error. Your email address did not registered in our system. Please contact your administrator.';
            }else{
                //update new password for the user
                $password = $this->users->hash($new_password);
                $this->user_m->save(array('password'=>$password), $user_record->id);
                $result['status'] = TRUE;
                
                //create email to notify update user password
                $subject = 'IndonesiaSatu.co: Update on User Account & Password';
                $recipient = $user_record->full_name .' <'. $email.'>';
                $content = '<p>Dear '. $user_record->full_name.',</p><br>';
                $content.= '<p>This is a notification that you have changed user account and password recently. Please use this detail to log in to IndonesiaSatu.co admin page.</p>';
                $content.= '<br>Username: '. $user_record->username;
                $content.= '<br>Password: '. $new_password;
                $content.= '<br><br><p>Regards<br>IndonesiaSatu.co Administrator</p>';
                if (strlen($content) > 70){
                    $content = wordwrap($content, 70, "\r\n");
                }
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $headers .= 'From: IndonesiaSatu.co Administrator <no-reply@indonesiasatu.co>' . "\r\n" .
                            'X-Mailer: PHP/' . phpversion();
                $send_email = mail($recipient, $subject, $content, $headers);
            }
            
        }
        
        $this->response($result);
    }
}

/*
 * file location: engine/application/controllers/service/user.php
 */
