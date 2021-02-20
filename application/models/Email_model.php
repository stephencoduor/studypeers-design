<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	function password_reset_email($new_password = '' , $email = '')
	{
		$query = $this->db->get_where('user' , array('email' => $email));
		if($query->num_rows() > 0)
		{

			$email_msg	=	"Your password has been changed.";
			$email_msg	.=	"Your new password is : ".$new_password."<br />";

			$email_sub	=	"Password reset request";
			$email_to	=	$email;

			$this->send_smtp_mail($email_msg , $email_sub , $email_to);
			return true;
		}
		else
		{
			return false;
		}
	}

	public function send_email_verification_mail($to = "", $verification_code = "") {
		// $redirect_url = site_url('login/verify_email_address/'.$verification_code);
		$subject 		= "Verify Email Address";
		$email_msg	=	"<b>Hello,</b>";
		$email_msg	.=	"<p>Your autentication code is</p>";
		$email_msg	.=	'<span style="border: 1px solid black;padding:10px;background-color:#dfdfdf">'.$verification_code.'</span>';
		$this->send_smtp_mail($email_msg, $subject, $to);
	}

	public function restaurant_booking_mail($data = "") {
		$total_people = $data['adult_guests_for_booking'] + $data['child_guests_for_booking'];
		$date = date('D, d-M-Y', strtotime($data['date']));
		$subject 		= "Table Booking Request on $date";
		$email_msg	=	"<b>Hello,</b>";
		$email_msg	.=	"<p>I would like to book a table for ". $total_people ." people. Adults in number is ".$data['adult_guests_for_booking']." and Child in number is ".$data['child_guests_for_booking'].".</p>";
		$email_msg	.=	"<p>I would like to book this on ".$date.". Please let me know from your side.</p>";

		$user_details = $this->user_model->get_all_users($this->session->userdata('user_id'))->row_array();

		$this->send_smtp_mail($email_msg, $subject, $data['to'], $user_details['email']);
	}

	public function hotel_booking_mail($data = "") {
		$total_people = $data['adult_guests_for_booking'] + $data['child_guests_for_booking'];
		$book_from = $data['book_from'];
		$book_to = $data['book_to'];
		$subject 		= "Hotel Room Booking Request from $book_from to $book_to";
		$email_msg	=	"<b>Hello,</b>";
		$email_msg	.=	"<p>I would like to book a ".$data['room_type']." room for ". $total_people ." people. Adults in number is ".$data['adult_guests_for_booking']." and Child in number is ".$data['child_guests_for_booking'].".</p>";
		$email_msg	.=	"<p>I would like to book this from ".$book_from." to ".$book_to.". Please let me know from your side.</p>";

		$user_details = $this->user_model->get_all_users($this->session->userdata('user_id'))->row_array();
		$this->send_smtp_mail($email_msg, $subject, $data['to'], $user_details['email']);
	}

	public function contact_us_mail($data = "") {
		$subject 		= "Contact us";
		$email_msg	=	"Hello, This is <b>".$data['name']."</b>";
		$email_msg	.=	"<p>".$data['message']."</p>";

		$user_details = $this->user_model->get_all_users($this->session->userdata('user_id'))->row_array();
		$this->send_smtp_mail($email_msg, $subject, $data['to'], $user_details['email']);
	}

	// more stable function
	public function send_smtp_mail($msg=NULL, $sub=NULL, $to=NULL, $from=NULL) {

		if($from == NULL){
			$from =	get_settings('system_email');
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


	public function send_manual_verification($to = "", $university = "", $requested_by = "", $email = "", $url = "") {
		// $redirect_url = site_url('login/verify_email_address/'.$verification_code);
		$subject 		= "A user has requested manual verification of their enrollment to a university";
		$email_msg	=	"Hello Admin,";
		$email_msg	.=	"<p>A user has requested manual verification of their enrollment to a university. Please review the below information:</p>";
		$email_msg	.=	'<p>University: '.$university.'</p>';
		$email_msg	.=	'<p>Requested By: '.$requested_by.'</p>';
		$email_msg	.=	'<p>E-mail: '.$email.'</p>';
		$email_msg	.=	'<p>Verify here: '.$url.'</p>';
		$this->send_smtp_mail($email_msg, $subject, $to);

	}


	public function send_contact_email($to, $subject, $message){
		$this->send_smtp_mail($message, $subject, $to);
	}


	public function send_new_university_email($to = "", $university = "", $requested_by = "", $url = ""){
		$subject 		= "A new university has been added which requires approval";
		$email_msg	=	"Hello Admin,";
		$email_msg	.=	"<p>A new university has been added which requires your approval. Please review the below information:</p>";
		$email_msg	.=	'<p>Institution Name: '.$university.'</p>';
		$email_msg	.=	'<p>Added  By: '.$requested_by.'</p>';
		$email_msg	.=	'<p>Verify here: '.$url.'</p>';
		$email_msg	.=	"<p>Once the university is approved, you should also review the user who submitted it and manually verify their enrollment.</p>";
		$this->send_smtp_mail($email_msg, $subject, $to);
	}

	public function send_new_major_email($to = "", $requested_by = "", $major = "", $url = ""){
		$subject 		= "A new Major has been added which requires approval";
		$email_msg	=	"Hello Admin,";
		$email_msg	.=	"<p>A new major has been added which requires your approval. Please review the below information:</p>";
		$email_msg	.=	'<p>Major Name: '.$major.'</p>';
		$email_msg	.=	'<p>Added  By: '.$requested_by.'</p>';
		$email_msg	.=	'<p>Verify here: '.$url.'</p>';
		$email_msg	.=	"<p>Once the major is approved, you should also review the user who submitted it and manually verify their enrollment.</p>";
		$this->send_smtp_mail($email_msg, $subject, $to);
	}

	public function send_new_course_email($to = "", $requested_by = "", $major = "", $course = "", $url = ""){
		$subject 		= "A new Field Of Study & Major has been added which requires approval";
		$email_msg	=	"Hello Admin,";
		$email_msg	.=	"<p>A new field of study & major has been added which requires your approval. Please review the below information:</p>";
		$email_msg	.=	'<p>Field Of Study Name: '.$course.'</p>';
		$email_msg	.=	'<p>Major Name: '.$major.'</p>';
		$email_msg	.=	'<p>Added  By: '.$requested_by.'</p>';
		$email_msg	.=	'<p>Verify here: '.$url.'</p>';
		$email_msg	.=	"<p>Once the field of study is approved, you should also review the user who submitted it and manually verify their enrollment.</p>";
		$this->send_smtp_mail($email_msg, $subject, $to);
	}


	public function send_new_user_email($to = "", $user_name, $email){
		$subject 		= "[Study Peers] New User Registration";
		$email_msg	=	"Hello Admin,";
		$email_msg	.=	"<p>New user registration on your site Study Peers:</p>";
		$email_msg	.=	'<p>Username: '.$user_name.'</p>';
		$email_msg	.=	'<p>Email '.$email.'</p>';
		
		$this->send_smtp_mail($email_msg, $subject, $to);
	}


	public function send_manual_verification_student($to = ""){
		$subject 		= "Registration under review";
		$email_msg	=	"Hello,";
		$email_msg	.=	"<p>Your registration is under review. We will notify you within 24 hours.</p>";
		$email_msg	.=	'<p>StudyPeers Team</p>';
		
		
		$this->send_smtp_mail($email_msg, $subject, $to);
	}


	public function send_verification_by_student($to = ""){
		$subject 		= "Complete your registration";
		$email_msg	=	"Hello,";
		$email_msg	.=	"<p>Please verify your institution to complete the registration process.</p>";
		$email_msg	.=	'<p>StudyPeers Team</p>';
		
		
		$this->send_smtp_mail($email_msg, $subject, $to);
	}


	public function send_uni_verification_by_student($to = "", $university, $url){
		$subject 		= "Verfiy your e-mail address to confirm your University";
		$email_msg	=	"Hello,";
		$email_msg	.=	"<p>Verify your e-mail to add ".$university." to your profile</p>";
		$email_msg	.=	"<p>Click the link below to complete verification:</p>";
		$email_msg	.=	$url;
		$email_msg	.=	"<p>Clicking the above link will confirm your enrollment to Studypeers. If you have not initiated this verification, please contact us at support@studypeers.com.</p>";
		
		
		$this->send_smtp_mail($email_msg, $subject, $to);
	}


	public function send_welcome_email($to = ""){
		$subject 		= "Profile successfully verified";
		$email_msg	=	"Hello,";
		$email_msg	.=	"<p>Welcome to StudyPeers. Your profile has been successfully verified. </p>";
		$email_msg	.=	"<p>You can now start studying with your peers.</p>";
		$email_msg	.=	"<p>StudyPeers Team</p>";
		
		
		$this->send_smtp_mail($email_msg, $subject, $to);
	}
}
