<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
        
        parent::__construct();
        $this->load->model('user_model');
        
    }
	public function index()
	{
        
		$this->data['page_name'] = 'main';
		$this->load->view('index',$this->data);

	}
    public function login()
    {
        $this->data['page_name'] = 'login';
        $this->load->view('index',$this->data);
    }
    public function register()
    { 
        $this->data['page_name'] = 'register';
        $this->load->view('index',$this->data);

    }
    public function sign_up() {
        $this->data['page_name'] = 'register_form2';
        $this->load->view('index',$this->data);
    }
    public function about(){
        $this->data['page_name'] = 'about';
        $this->load->view('index',$this->data);
        
    }
    public function privacy(){
        $this->data['page_name'] = 'privacy';
        $this->load->view('index',$this->data);
        
    }
    public function term(){
        $this->data['page_name'] = 'terms';
        $this->load->view('index',$this->data);
        
    }
    public function contact(){
        if($_POST){
            $insert = $_POST;
            $this->user_model->insert_data('contact',$insert);
            redirect(base_url("home/contact"));
        }else{
            $this->data['page_name'] = 'contact';
            $this->load->view('index',$this->data);
        }

    }
	
}
