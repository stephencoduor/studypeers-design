<?php

/**
 * @className : BaseController
 * @category : controller 
 * @description : controller class to handle step wise registration
 * @author : Jatin Pandey
 */

class BaseController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (empty($this->session->get_userdata()['user_data'])) {
            redirect('login');
        }

        $this->user_id = $this->session->get_userdata()['user_data']['user_id'];
    }

    public function index()
    {
        $this->redirectAccordingPage($this->session->get_userdata()['user_data']);
    }


    public function includeTemplate($templeName, $data)
    {
        $this->load->view('user/registration/header', $data);
        $this->load->view($templeName, $data);
        $this->load->view('user/registration/footer', $data);
    }

    public function redirectAccordingPage($data)
    {

        $step = $data['form_step'];

        switch ($step) {

            case 1:

                return redirect('home/step-two-page');
                break;

            case 2:

                return redirect('home/step-three-page');
                break;

            case 3:
                return redirect('home/step-four-page');
                break;

            default:
                return redirect('home/step-register');
                break;
        }
    }
}
