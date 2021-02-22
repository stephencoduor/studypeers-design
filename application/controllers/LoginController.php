<?php

/**
 * @className  : LoginController
 * @class : Controller
 * @author : Jatin pandey45
 * @description : controller class to handle onboarding actions
 * 
 */

class LoginController extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $data = $this->session->get_userdata();

        if (!empty($data['user_data'])) {
            # redirect user to dashboard page.
            redirect('account/dashboard');
        }
    }

    public function index()
    {
        $this->data['page_name'] = 'login';
        $this->load->view('index', $this->data);
    }

    public function signUp()
    {
        $this->data['page_name'] = 'register';
        $this->data['active'] = 'register';
        $this->load->view('index', $this->data);
    }

    public function submitLoginForm()
    {
        try {

            $post = $this->input->post();

            if (empty($post)) {
                throw new Exception("Error processing request", 422);
            }

            if (empty($post['email']) && empty($post['password'])) {
                throw new Exception("Invalid attempt to login", 422);
            }

            if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Invalid email address", 422);
            }

            $validateUserLogin = $this->user_model->validateUserLogin($post['email'], sanitizer($post['password']));


            if (empty($validateUserLogin)) {
                throw new Exception("Invalid user login attempt", 422);
            }

            $sessionData['is_logged_in'] = 1;
            $sessionData['user_id']    = $validateUserLogin['id'];
            $sessionData['role_id']    = $validateUserLogin['role_id'];
            $sessionData['role']       = get_user_role('user_role', $validateUserLogin['id']);
            $sessionData['first_name']   = $validateUserLogin['first_name'];
            $sessionData['profileImage'] = empty($validateUserLogin['image']) ? base_url() . 'uploads/user-male.png' : base_url() . '/uploads/users/' . $validateUserLogin['image'];
            $sessionData['user_login']   = 1;
            $sessionData['form_step'] = $validateUserLogin['form_step'];

            # check if form is complete or not.

            if (!$validateUserLogin['form_completed']) {
                $this->session->set_userdata('user_data', $sessionData);
                return redirect('complete-step');
            }

            $sessionData['is_logged_in'] = 2;
            $this->session->set_userdata('user_data', $sessionData);
            return redirect('account/dashboard');
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->session->set_flashdata('error', $e->getMessage());
            redirect('login');
        }
    }


    public function submitSignUpForm()
    {
        try {

            $post = $this->input->post();

            if (empty($post)) {
                throw new Exception("Error processing request", 422);
            }

            $this->validationRules($post);

            #check for existing usersname.

            $userName = $post['username'];

            $validate_usernme = $this->user_model->check_duplication_username('on_create', $userName);

            if (!$validate_usernme) {
                throw new Exception("Duplicate username", 422);
            }

            # check for existing email address.

            $emailAddress = $post['email'];

            $validity = $this->user_model->check_duplication('on_create', $emailAddress);

            if (!$validity) {
                throw new Exception("Duplicate email", 422);
            }

            #create new user and send verification code.

            $otpHidden = $this->user_model->otp($emailAddress);

            $createNewUser = [];
            $createNewUser['username'] = $post['username'];
            $createNewUser['email'] = $post['email'];
            $createNewUser['password'] = sha1($post['password']);
            $createNewUser['address'] = 'address';
            $createNewUser['phone'] = '';
            $createNewUser['about'] = '';
            $createNewUser['role_id'] = 2;
            $createNewUser['wishlists'] = '[]';
            $createNewUser['job_wishlist'] = '[]';
            $createNewUser['rental_wishlist'] = '[]';
            $createNewUser['verification_code'] = $otpHidden;

            # send otp at email address.


            $dataPage['message'] = 'Verification code has been send on your mail.';
            $dataPage['otp'] = $otpHidden;
            $dataPage['page_name'] = 'valid_email_otp';
            $dataPage['userData'] = base64_encode(serialize($createNewUser));
            $this->load->view('index', $dataPage);
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->session->set_flashdata('error', $e->getMessage());
            redirect('signup');
        }
    }

    /**
     * verifyOTP
     * @param : postArr
     */

    public function verifyOTP()
    {

        try {
            $post  = $this->input->post();

            if (empty($post)) {
                throw new Exception("Error processing request", 422);
            }

            $this->validateUserVerification($post);


            # validate user otp.

            $otp = $post['otp'];

            if (!@unserialize(base64_decode($post['userData']))) {
                throw new Exception("Error processing request", 422);
            }

            $userData = unserialize(base64_decode($post['userData']));


            if ($otp != $userData['verification_code']) {
                throw new Exception("OTP verification code failed", 422);
            }

            # create new user

            $userId = $this->user_model->insert_data('user', $userData);


            #setSessionVariable.
            $userSession['is_logged_in'] = 1;
            $userSession['user_id']    = $userId;
            $userSession['role_id']    = $userData['role_id'];
            $userSession['role']       = get_user_role('user_role', $userData['role_id']);
            $userSession['username']   = $userData['username'];
            $userSession['profileImage'] = base_url() . 'uploads/user-male.png';
            $userSession['user_login']   = 1;

            $this->session->set_userdata('user_data', $userSession);
            redirect('home/step-register');
        } catch (Exception $e) {

            error_log($e->getMessage());
            redirect('login/resend-otp-page?params=' . $post['userData']);
        }
    }

    /**
     * resendOTPPage
     * @param : userData
     */

    public function resendOTPPage()
    {
        $userInfo = $this->input->get('params');

        if (empty($userInfo)) {
            redirect('signup');
        }

        $userData = unserialize(base64_decode($userInfo));

        $otpHidden = $this->user_model->otp($userData['email']);

        $createNewUser = $userData;
        $createNewUser['verification_code'] = $otpHidden;

        # send otp at email address.


        $dataPage['message'] = 'Verification code has been re-send on your mail.';
        $dataPage['otp'] = $otpHidden;
        $dataPage['page_name'] = 'valid_email_otp';
        $dataPage['userData'] = base64_encode(serialize($createNewUser));
        $this->load->view('index', $dataPage);
    }


    /**
     * validateUserVerification
     * @param : postArr
     */

    public function validateUserVerification($dataArr)
    {
        if (empty($dataArr['userData'])) {
            throw new Exception("UserData missing", 422);
        }

        if (empty($dataArr['otp'])) {
            throw new Exception("OTP field is required", 422);
        }
    }

    /**
     * $validationRules
     * 
     */

    public function validationRules($dataArr)
    {
        if (empty($dataArr['email'])) {
            throw new Exception("Email address field is required", 422);
        }

        if (!filter_var($dataArr['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Email address field is invalid", 422);
        }

        if (empty($dataArr['username'])) {
            throw new Exception("Username field is required", 422);
        }

        if (empty($dataArr['password'])) {
            throw new Exception("Password field is required", 422);
        }
    }
}
