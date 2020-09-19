<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiModel extends CI_Model {

    function __construct()
    {
        parent::__construct();
        
    }
        
    public function userLogin($request)
    {
        $email = $request['email'];
        $password = $request['password'];
        $userData = $this
            ->db
            ->query("SELECT * FROM `user` WHERE (username = '".$email."' OR email = '".$email."') AND password = sha1('".$password."')");
            
        

        if ($userData->num_rows() != 0)
        {   
            $details = $userData->row_array();
            $loginMasterData = array();
            $loginMasterData['userId'] = $details['id'];
            $loginMasterData['deviceId'] = $request['deviceId'];
            $loginMasterData['deviceType'] = $request['deviceType'];
            $loginMasterData['fcmId'] = $request['fcmId'];
            $loginMasterData['loginTime'] = date('Y-m-d H:i:s');

            $this
                ->db
                ->insert('user_login_master', $loginMasterData);
            $loginId = $this
                ->db
                ->insert_id();

            $access_token = md5($loginId.$details['id']);

            $data['access_token']   = $access_token;

            $this->db->where(array('id' => $loginId));
            $this->db->update('user_login_master', $data);
            
            $array['loginId']   = $loginId;
            $array['userId']    = $details['id'];
            $array['username']  = $details['username'];
            $array['first_name']    = $details['first_name'];
            $array['last_name']     = $details['last_name'];
            $array['email']         = $details['email'];
            $array['access_token']         = $access_token;

            return $array;
        }
        else
        { 
            return 0;
        }
    }

    public function sendOtp($user_id, $user_email)
    {   
        // $otp = mt_rand(100000, 999999);
        $otp = '123456';
        $this->db->where('id' , $user_id);
        $this->db->update('user' , array('otp' => $otp));
        $subject        = "Verify Email Address";
        $email_msg  =   "<b>Hello,</b>";
        $email_msg  .=  "<p>Your autentication code is</p>";
        $email_msg  .=  '<span style="border: 1px solid black;padding:10px;background-color:#dfdfdf">'.$otp.'</span>';
        $this->send_smtp_mail($email_msg, $subject, $user_email);
    }


    public function verifyOtp($user_id, $otp)
    {
        $chk = $this->db->get_where('user', array('id' => $user_id, 'otp'=>$otp))->num_rows();
        return $chk;
    }

    public function validateOtp($user_id, $otp)
    {
        $chk = $this->db->get_where('user', array('id' => $user_id, 'otp'=>$otp))->num_rows();
        if($chk != 0){
            $this->db->where('id' , $user_id);
            $res = $this->db->update('user' , array('is_email_verified' => 1));
        }
        return $chk;
    }

    public function updatePassword($user_id, $password)
    {   
        $new_password = sha1($password);
        $this->db->where('id' , $user_id);
        $res = $this->db->update('user' , array('password' => $new_password));
        
        return $res;
    }


    public function userRegister($request)
    {   
        $username   = $request['username'];
        $email      = $request['email'];
        $password   = $request['password'];

        $chkUser = $this->db->get_where('user', array('username' => $username))->num_rows();

        if($chkUser != 0){
            generateServerResponse('0','U');
        }


        $chkEmail = $this->db->get_where('user', array('email' => $email))->num_rows();

        if($chkEmail != 0){
            generateServerResponse('0','A');
        }

        $insertArr = array( 'username'  => $username,
                            'email'     => $email,
                            'password'  => sha1($password),
                            'is_email_verified' => 0,
                            'added_on'  => date('Y-m-d H:i:s')

                         );

         $this->db->insert('user', $insertArr);
         $user_id = $this->db->insert_id();
         $this->sendOtpToEmail($user_id, $email);
         return $user_id;
    }

    public function checkUniqueUsername($request)
    {   
        $type = $request['type'];
        if($type == 'username'){
            $username   = $request['username'];
            $chk = $this->db->get_where('user', array('username' => $username))->num_rows();
        } else if($type == 'email'){
            $email   = $request['email'];
            $chk = $this->db->get_where('user', array('email' => $email))->num_rows();
        }
        
        return $chk;
    }

    public function sendOtpToEmail($user_id, $user_email)
    {   
        // $otp = mt_rand(100000, 999999);
        $otp = '123456';
        $this->db->where('id' , $user_id);
        $this->db->update('user' , array('otp' => $otp));
        $subject        = "Verify Email Address";
        $email_msg  =   "<b>Hello,</b>";
        $email_msg  .=  "<p>Your autentication code is</p>";
        $email_msg  .=  '<span style="border: 1px solid black;padding:10px;background-color:#dfdfdf">'.$otp.'</span>';
        $this->send_smtp_mail($email_msg, $subject, $user_email);
    }


    public function send_smtp_mail($msg=NULL, $sub=NULL, $to=NULL, $from=NULL) {

        if($from == NULL){
            $from = get_settings('system_email');
        }

        $htmlContent = $msg;
        $this->load->library('phpmailer_lib');
        $mail = $this->phpmailer_lib->load();
        
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host     = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = get_settings('smtp_user');
        $mail->Password = get_settings('smtp_pass');
        $mail->SMTPSecure = 'tls';
        $mail->Port     = 587;
        
        $mail->setFrom($from, get_settings('website_title'));
        $mail->addReplyTo($from, get_settings('website_title'));
        
        // Add a recipient
        $mail->addAddress($to);
        
        // Add cc or bcc 
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');
        
        // Email subject
        $mail->Subject = $sub;
        
        // Set email format to HTML
        $mail->isHTML(true);
        
        // Email body content
        $mailContent = $htmlContent;
        $mail->Body = $mailContent;
        
        // Send email
        if(!$mail->send()){
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }else{
            return;
        }
        
    }


    public function getUniversity($request){
        
        $offset     = $request['offset'];
        $keyword    = $request['keyword'];

        $count = $offset*20;

        if(!empty($keyword)){
            $result['count'] = $this->db->query("SELECT * FROM `university` WHERE `SchoolName` LIKE '".$keyword."%' ESCAPE '!'")->num_rows();
            $result['res'] = $this->db->query("SELECT * FROM `university` WHERE `SchoolName` LIKE '".$keyword."%' ESCAPE '!' ORDER BY SchoolName asc LIMIT 20 OFFSET ".$count."")->result_array();
            
        } else {
            $result['count'] = $this->db->query("SELECT * FROM `university`")->num_rows();
            $result['res'] = $this->db->query("SELECT * FROM `university` ORDER BY SchoolName asc LIMIT 20 OFFSET ".$count."")->result_array();
            
        }
        return $result;
    }


    public function getEvents($request){
        $offset     = $request['offset'];
        $count      = $offset*20;

        if(!empty($request['startdate'])) {
            $timestamp1 = strtotime($request['startdate']);
            $start_date = date('Y-m-d 00:00:00', $timestamp1); 
            $qr = " and start_date >= '".$start_date."' ";
        } else {
            $qr = " ";
        }

        $course     = $request['course'];
        $keyword    = $request['search_keyword'];

        if(!empty($course) && !empty($keyword)){
            $result['res'] = $this->db->query("select event_master.*,course_master.name as course_name,professor_master.name professor_name,university.SchoolName as institute_name, user_info.nickname as user_name from event_master inner join course_master on course_master.id = event_master.course inner join professor_master on professor_master.id = event_master.professor inner join university on university.university_id = event_master.university inner join user_info on user_info.userID = event_master.created_by where event_master.status = 1 and event_master.course = ".$course." and event_master.event_name like '%{$keyword}%'".$qr."ORDER BY course_master.id DESC LIMIT 20 OFFSET ".$count."")->result_array();
            $result['count'] = count($result['res']);
        } else if(!empty($course) && empty($keyword)){
            $result['res'] = $this->db->query("select event_master.*,course_master.name as course_name,professor_master.name professor_name,university.SchoolName as institute_name, user_info.nickname as user_name from event_master inner join course_master on course_master.id = event_master.course inner join professor_master on professor_master.id = event_master.professor inner join university on university.university_id = event_master.university inner join user_info on user_info.userID = event_master.created_by where event_master.status = 1 and event_master.course = ".$course."".$qr." ORDER BY course_master.id DESC LIMIT 20 OFFSET ".$count."")->result_array();
            $result['count'] = count($result['res']);
        } else if(empty($course) && !empty($keyword)){
            $result['res'] = $this->db->query("select event_master.*,course_master.name as course_name,professor_master.name professor_name,university.SchoolName as institute_name, user_info.nickname as user_name from event_master inner join course_master on course_master.id = event_master.course inner join professor_master on professor_master.id = event_master.professor inner join university on university.university_id = event_master.university inner join user_info on user_info.userID = event_master.created_by where event_master.status = 1".$qr." ORDER BY course_master.id DESC LIMIT 20 OFFSET ".$count."")->result_array();
            $result['count'] = count($result['res']);
        } else {
            $result['res'] = $this->db->query("select event_master.*,course_master.name as course_name,professor_master.name professor_name,university.SchoolName as institute_name, user_info.nickname as user_name from event_master inner join course_master on course_master.id = event_master.course inner join professor_master on professor_master.id = event_master.professor inner join university on university.university_id = event_master.university inner join user_info on user_info.userID = event_master.created_by where event_master.status = 1 ORDER BY course_master.id DESC LIMIT 20 OFFSET ".$count."")->result_array();

            $result['count'] = $this->db->query("SELECT * FROM `event_master` Where status = 1")->num_rows();

        }

        
        
        return $result;
    }


    public function getComments($request){
        $offset     = $request['offset'];
        $count      = $offset*20;

        $reference          = $request['reference'];
        $reference_id       = $request['reference_id'];

        $result['res'] = $this->db->query("select * from comment_master where reference = '".$reference."' AND reference_id = ".$reference_id." AND comment_parent_id = 0 LIMIT 20 OFFSET ".$count."")->result_array();
        $result['count'] = $this->db->query("select * from comment_master where reference = '".$reference."' AND reference_id = ".$reference_id." AND comment_parent_id = 0")->num_rows();
        return $result;

    }

    public function getCommentReply($request){
        $offset     = $request['offset'];
        $count      = $offset*20;
        $comment_id       = $request['comment_id'];

        $result['res'] = $this->db->query("select * from comment_master where comment_parent_id = ".$comment_id." LIMIT 20 OFFSET ".$count."")->result_array();
        $result['count'] = $this->db->query("select * from comment_master where  comment_parent_id = ".$comment_id."")->num_rows();
        return $result;
    }


    public function likeUnlikeComment($request){
        $comment_id       = $request['comment_id'];
        $userId           = $request['userId'];
        $type             = $request['type'];
        if($type == 'like') {
            $insertArr =    array( 'comment_id' => $comment_id,
                                
                                    'user_id' => $userId,
                                
                                    'status' => '1',
                                    'created_at' => date('Y-m-d H:i:s')

                            );

            $this->db->insert('comment_like_master', $insertArr);
        } else {
            $insertArr =    array( 
                                    'status' => '3',
                                    'created_at' => date('Y-m-d H:i:s')

                            );

            $this->db->where(array('comment_id' => $comment_id, 'user_id' => $userId));
            $this->db->update('comment_like_master',$insertArr);
        }
        return 1;
    }


    public function likeUnlikeReference($request){
        $reference_id       = $request['reference_id'];
        $reference          = $request['reference'];
        $userId           = $request['userId'];
        $type             = $request['type'];
        if($type == 'like') {
            $insertArr =    array(  'reference_id'  => $reference_id,
                                    'reference'     => $reference,
                                    'user_id'       => $userId,
                                
                                    'status'        => '1',
                                    'created_at'    => date('Y-m-d H:i:s')

                            );

            $this->db->insert('like_master', $insertArr);
        } else {
            $insertArr =    array( 
                                    'status' => '3',
                                    'created_at' => date('Y-m-d H:i:s')

                            );

            $this->db->where(array('reference_id' => $reference_id, 'reference' => $reference, 'user_id' => $userId));
            $this->db->update('like_master',$insertArr);
        }
        return 1;
    }


    public function addEvent($request){
        $arr['event_name']          = $request['event_name'];
        $arr['location_txt']        = $request['location'];
        $arr['latitude']            = $request['latitude'];
        $arr['longitude']           = $request['longitude'];
        $arr['start_date']          = $request['start_date'];
        $arr['start_time']          = $request['start_time'];
        $arr['end_date']            = $request['end_date'];
        $arr['end_time']            = $request['end_time'];
        $arr['description']         = $request['description'];
        $arr['university']          = $request['university_id'];
        $arr['course']              = $request['course_id'];
        $arr['professor']           = $request['professor_id'];
        $arr['created_by']          = $request['userId'];
        $arr['status']              = 1;
        $arr['created_at']          = date('Y-m-d H:i:s');

        if (!empty($request['image'])) {
            $http = explode(":",$request['image']);
            // print_r($http[0]);die;
            if ($http[0] == 'http') {
                $arr['featured_image'] = $request['image']; 
            } else {
                $arr['featured_image']   = $this->saveImageWithPath($request['image'], 'uploads/users/');
            }
        }

        $this->db->insert('event_master', $arr);
        $event_id = $this->db->insert_id();
        return  $this->db->query("select event_master.*,course_master.name as course_name,professor_master.name professor_name,university.SchoolName as institute_name, user_info.nickname as user_name from event_master inner join course_master on course_master.id = event_master.course inner join professor_master on professor_master.id = event_master.professor inner join university on university.university_id = event_master.university inner join user_info on user_info.userID = event_master.created_by where event_master.id = ".$event_id." ")->row_array();
    }


    public function addEventToCalender($request){
        
        $event_id   = $request['event_id'];
        $event      = $this->db->query("select * from event_master where id = ".$event_id."")->row_array();
        $startdate  = $event['start_date'].' '.$event['start_time'];
        $enddate    = $event['end_date'].' '.$event['end_time'];
        $schedule   = array('schedule'      => 'event',
                            'schedule_name' => $event['event_name'],
                            'description'   => $event['description'],
                            'university'    => $event['university'],
                            'course'        => $event['course'],
                            'professor'     => $event['professor'],
                            'start_date'    => $startdate,
                            'end_date'      => $enddate,
                            'location'      => $event['location_txt'],
                            'latitude'      => $event['latitude'],
                            'longitude'     => $event['longitude'],
                            'featured_image'    => $event['featured_image'],
                            'event_master_id'=> $event['id'],
                            'status'        => 1,
                            'created_at'    => date('Y-m-d H:i:s'),
                            'created_by'    => $event['created_by'],
                         );

        $this->db->insert('schedule_master', $schedule);
        $schedule_id = $this->db->insert_id();

        $this->db->where(array('id' => $event_id));
        $this->db->update('event_master',array('addedToCalender' => 1, 'schedule_master_id' => $schedule_id));

        return 1;
        
    }

    public function updateEvent($request){
        $arr['event_name']          = $request['event_name'];
        $arr['location_txt']        = $request['location'];
        $arr['latitude']            = $request['latitude'];
        $arr['longitude']           = $request['longitude'];
        $arr['start_date']          = $request['start_date'];
        $arr['start_time']          = $request['start_time'];
        $arr['end_date']            = $request['end_date'];
        $arr['end_time']            = $request['end_time'];
        $arr['description']         = $request['description'];
        $arr['university']          = $request['university_id'];
        $arr['course']              = $request['course_id'];
        $arr['professor']           = $request['professor_id'];
       

        if (!empty($request['image'])) {
            $http = explode(":",$request['image']);
            // print_r($http[0]);die;
            if ($http[0] == 'http') {
                $arr['featured_image'] = $featured_image = $request['image']; 
            } else {
                $arr['featured_image'] = $featured_image   = $this->saveImageWithPath($request['image'], 'uploads/users/');
            }
        }

        $this->db->where(array('id' => $request['event_id']));
        $this->db->update('event_master', $arr);

        $event_id = $request['event_id'];

        $get_event = $this->db->query("select * from event_master where id = ".$event_id." and status = 1")->row_array();
        if($get_event['addedToCalender'] == 1){
            $startdate  = $get_event['start_date'].' '.$get_event['start_time'];
            $enddate    = $get_event['end_date'].' '.$get_event['end_time'];
            $sArr = array(  'schedule_name'  => $request['event_name'],
                            'location'      => $request['location'],
                            'description'   => $request['description'],
                            'university'    => $request['university_id'],
                            'course'        => $request['course_id'],
                            'professor'     => $request['professor_id'],
                            'start_date'    => $startdate,
                            'end_date'      => $enddate,
                            'latitude'      => $request['latitude'],
                            'longitude'     => $request['longitude'],
                            'featured_image'    => $featured_image,
                            'schedule'      => 'event'

                        );

            $this->db->where(array('event_master_id' => $event_id));
            $this->db->update('schedule_master', $sArr);
        }
        
        
        return  $this->db->query("select event_master.*,course_master.name as course_name,professor_master.name professor_name,university.SchoolName as institute_name, user_info.nickname as user_name from event_master inner join course_master on course_master.id = event_master.course inner join professor_master on professor_master.id = event_master.professor inner join university on university.university_id = event_master.university inner join user_info on user_info.userID = event_master.created_by where event_master.id = ".$event_id." ")->row_array();
    }

    public function deleteEvent($request){
        $chkEvent = $this->db->get_where('event_master', array('id' => $request['event_id'], 'created_by' => $request['userId']))->num_rows();
        if($chkEvent != 0){
            $this->db->where(array('id' => $request['event_id']));
            $this->db->update('event_master',array('status' => 3));

            $event_details = $this->db->query("select * from event_master where id = ".$request['event_id']."")->row_array();
            if($event_details['addedToCalender'] == 1){
                $this->db->where(array('event_master_id' => $request['event_id']));
                $this->db->update('schedule_master',array('status' => 3));
            }

            return 1;
        } else {
            return 0;
        }
    }

    public function getEventDetail($request){
        return  $this->db->query("select event_master.*,course_master.name as course_name,professor_master.name professor_name,university.SchoolName as institute_name, user_info.nickname as user_name from event_master inner join course_master on course_master.id = event_master.course inner join professor_master on professor_master.id = event_master.professor inner join university on university.university_id = event_master.university inner join user_info on user_info.userID = event_master.created_by where event_master.id = ".$request['event_id']." ")->row_array();
    
    }

    public function saveRegistrationStepWise($request){
        $step       = $request['step'];
        $user_id    = $request['user_id'];

        if($step == 1) {
            $first_name         = $request['first_name'];
            $last_name          = $request['last_name'];

            $mobile_no          = $request['mobile_no'];
            $dob                = $request['dob'];

            $gender             = $request['gender'];
            $country_code       = $request['country_code'];

            $chkPhone = $this->db->get_where('user', array('phone' => $mobile_no))->num_rows();

            if($chkPhone != 0){
                generateServerResponse('0','M');
            }

            $update_arr = array('first_name' => $first_name,
                                'last_name' => $last_name,
                                'phone'     => $mobile_no,
                                'country_code' => $country_code,
                                'form_step' => 1
                             );

            $this->db->where(array('id' => $user_id));
            $this->db->update('user', $update_arr);

            $chk = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();

            if(!empty($chk)) {
                $data['userID'] = $user_id;
                $data['dob']    = $dob;
                $data['gender'] = $gender;  
                $this->db->where(array('userID' => $user_id));
                $this->db->update('user_info', $data);
            } else {
                $data['userID'] = $user_id;
                $data['dob']    = $dob;
                $data['gender'] = $gender;  
                $this->db->insert('user_info', $data);
            }

            
        } else if($step == 2) {
            $institute_type         = $request['institute_type'];
            $institute_id           = $request['institute_id'];

            $add_institute          = $request['add_institute'];
            $intitution_email       = $request['intitution_email'];

            $intitution_idcard      = $request['intitution_idcard'];
            $manual_verification    = $request['manual_verification'];



            $data['institute_type'] = $institute_type;
        
            if($institute_type == 1){
                $data['intitutionID'] = $institute_id;
            } else {
                $data['add_institute'] = $add_institute;
            }

            if (!empty($intitution_idcard)) {
                $http = explode(":",$intitution_idcard);
                // print_r($http[0]);die;
                if ($http[0] == 'http') {
                    $data['intitution_idcard'] = $intitution_idcard; 
                } else {
                    $data['intitution_idcard']   = $this->saveImage($intitution_idcard);
                }
            } else {
                $chkEmail = $this->db->get_where('user_info', array('intitution_email' => $intitution_email))->num_rows();

                if($chkEmail != 0){
                    generateServerResponse('0','I');
                }
                $data['intitution_email'] = $intitution_email;
            }
            
            $data['manual_verification'] = $manual_verification;

            $this->db->where(array('userID' => $user_id));
            $this->db->update('user_info', $data);

            $update_arr = array(
                                'form_step' => 2
                             );

            $this->db->where(array('id' => $user_id));
            $this->db->update('user', $update_arr);
        } else if($step == 3) {
            $field_type         = $request['field_type'];
            $field              = $request['field'];

            $major_type         = $request['major_type'];
            $major              = $request['major'];

            $degree             = $request['degree'];
            $session            = $request['session'];
            $field_interest     = $request['field_interest'];

            $data['degree']     = $degree;
            $data['field_type'] = $field_type;
            $data['major_type'] = $major_type;
            $data['field_interest'] = $field_interest;

            if($field_type == 2){
                $data['add_major'] = $major;
                $data['add_course'] = $field;
                $data['manual_verification'] = 1;
            } else {
                $data['course'] = $field;
                if($major_type == 2){
                    $data['add_major'] = $major;
                    $data['manual_verification'] = 1;
                } else {
                    $data['major'] = $major;
                }
            }

            $this->db->where(array('userID' => $user_id));
            $this->db->update('user_info', $data);
            $update_arr = array(
                                'form_step' => 3
                             );

            $this->db->where(array('id' => $user_id));
            $this->db->update('user', $update_arr);
        } else if($step == 4) {
            $profile_setting        = $request['profile_setting'];
            $privacy                = $request['privacy'];
            $nickname_text          = $request['nickname_text'];

            $get_user = $this->db->get_where('user', array('id' => $user_id))->row_array();
            $get_user_info = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();

            $first_name = $get_user['first_name']; 
            $last_name  = $get_user['last_name'];
            $mobile_no  = $get_user['phone'];
            $dob        = $get_user_info['dob'];
            $gender     = $get_user_info['gender'];

            $institute_id   = $get_user_info['intitutionID'];
            $institute_type = $get_user_info['institute_type'];
            $add_institute  = $get_user_info['add_institute'];

            $intitution_email   = $get_user_info['intitution_email'];
            $intitution_idcard  = $get_user_info['intitution_idcard'];
            $course             = $get_user_info['course'];
            $class              = $get_user_info['major'];
            $degree             = $get_user_info['degree'];
            $session            = $get_user_info['session'];
            $field_interest     = $get_user_info['field_interest'];

            $field_type     = $get_user_info['field_type'];
            $add_course     = $get_user_info['add_course'];

            $major_type     = $get_user_info['major_type'];
            $add_major      = $get_user_info['add_major'];

            $data['profile_setting']        = $profile_setting;
            $data['privacy']                = $privacy;
            $data['nickname']          = $nickname_text;

            $this->db->where(array('userID' => $user_id));
            $this->db->update('user_info', $data);

            $update_arr = array(
                                'form_step' => 4,
                                'form_completed' => 1,
                                'is_detailed' => 1
                             );

            $this->db->where(array('id' => $user_id));
            $this->db->update('user', $update_arr);

            $full_name = $first_name.' '.$last_name;
            if($institute_type == 1){
                $get_university = $this->db->get_where('university', array('university_id' => $institute_id))->row_array();
                $university = $get_university['SchoolName'];
            } else {
                $university =  $add_institute;
                $this->email_model->send_new_university_email('admin@studypeers.com', $university, $full_name, base_url());
            }

            if($field_type == 1 && $major_type == 2){
                $this->email_model->send_new_major_email('admin@studypeers.com', $full_name, $add_major, base_url());
            } else if($field_type == 2 && $major_type == 2){
                $this->email_model->send_new_course_email('admin@studypeers.com', $full_name, $add_major, $add_course, base_url());
            }

            if($get_user_info['manual_verification'] == 1 || $field_type == 1 || $major_type == 1){
                if($get_user_info['manual_verification'] == 1) {
                    $this->email_model->send_manual_verification('admin@studypeers.com', $university, $full_name, $intitution_email, base_url());
                }
                $this->email_model->send_manual_verification_student($get_user['email']);
            } else {
                $this->email_model->send_verification_by_student($get_user['email']);
            }

            if(!empty($intitution_email) && !$this->input->post('manual_verification_check')){
                $this->email_model->send_new_user_email('admin@studypeers.com', $full_name, $intitution_email);
            }


            if($institute_type == 1 && $get_user_info['manual_verification'] == 0 && !empty($intitution_email)){ 
                $this->email_model->send_uni_verification_by_student($intitution_email, $university, base_url().'User/verify_university_email/'.$user_id);
            }

        }

        return 1;
    }

    public function saveImage($base64){
           
        $image_parts = explode(";base64,",$base64 );
        $image_type_aux = explode("uploads/user_identification/", $image_parts[0]);
        $image_type = $image_type_aux[0];
        // print_r($image_type);die;
        $image_base64 = base64_decode($image_parts[0]);
        $filename = 'id_'.uniqid(). '.png';
        $file = $_SERVER['DOCUMENT_ROOT'].'/uploads/user_identification/'.$filename;
        file_put_contents($file, $image_base64);
        return $filename;
    }

    public function saveImageWithPath($base64, $path){
           
        $image_parts = explode(";base64,",$base64 );
        $image_type_aux = explode($path, $image_parts[0]);
        $image_type = $image_type_aux[0];
        // print_r($image_type);die;
        $image_base64 = base64_decode($image_parts[0]);
        $filename = 'id_'.uniqid(). '.png';
        $file = $_SERVER['DOCUMENT_ROOT'].'/'.$path.$filename;
        file_put_contents($file, $image_base64);
        return $filename;
    }

    public function courseDetail($user_id){
        $this->db->select('course_master.*,professor_master.name as professor_name,professor_master.first_name as professor_first_name, professor_master.last_name as professor_last_name');
        $this->db->join('professor_master','professor_master.course_id=course_master.id');
        
        return $this->db->get_where($this->db->dbprefix('course_master'), array('course_master.user_id'=>$user_id, 'course_master.status' => 1))->result_array(); 
    }


    public function addComment($request){
        $comment        = $request['comment'];
        $reference_id   = $request['reference_id'];
        $reference      = $request['reference'];
        $userId         = $request['userId'];

        $insertArr = array( 'reference' => $reference,
                            'reference_id' => $reference_id,
                            'user_id' => $userId,
                            'comment' => $comment,
                            'status' => '1',
                            'created_at' => date('Y-m-d H:i:s')

                        );

        $this->db->insert('comment_master', $insertArr);
        return $this->db->insert_id();
    }

    public function addCommentImage($request){
        $reference_id   = $request['reference_id'];
        $reference      = $request['reference'];
        $userId         = $request['userId'];

        $image = $this->saveImageWithPath($request['image'], 'uploads/comments/');

        $insertArr = array(     'reference'     => $reference,
                                'reference_id'  => $reference_id,
                                'user_id'       => $userId,
                                'comment'       => $image,
                                'type'          => 1,
                                'status'        => '1',
                                'created_at'    => date('Y-m-d H:i:s')

                            );

        $this->db->insert('comment_master', $insertArr);
        return $this->db->insert_id();
       
    }

    public function addReplyToComment($request){
        $comment_id     = $request['comment_id'];
        $reply          = $request['reply'];
        $userId         = $request['userId'];

        $comment_data = $this->db->get_where($this->db->dbprefix('comment_master'), array('id'=>$comment_id))->row_array(); 

        $insertArr = array(     'reference' => $comment_data['reference'],
                                'reference_id' => $comment_data['reference_id'],
                                'comment_parent_id' => $comment_id,
                                'user_id' => $userId,
                                'comment' => $reply,
                                'status' => '1',
                                'created_at' => date('Y-m-d H:i:s')

                        );

        $this->db->insert('comment_master', $insertArr);
        return $this->db->insert_id();
    }

    public function addReplyImage($request){
        $comment_id     = $request['comment_id'];
        
        $userId         = $request['userId'];

        $comment_data = $this->db->get_where($this->db->dbprefix('comment_master'), array('id'=>$comment_id))->row_array(); 

        $reply = $this->saveImageWithPath($request['image'], 'uploads/comments/');

        $insertArr = array(     'reference' => $comment_data['reference'],
                                'reference_id' => $comment_data['reference_id'],
                                'comment_parent_id' => $comment_id,
                                'type'      => 1,
                                'user_id'   => $userId,
                                'comment'   => $reply,
                                'status'    => '1',
                                'created_at' => date('Y-m-d H:i:s')

                        );

        $this->db->insert('comment_master', $insertArr);
        return $this->db->insert_id();
    }
}



