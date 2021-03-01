<?php


defined('BASEPATH') OR exit('No direct script access allowed');



class Facebook extends CI_Controller {


 public function __construct()
 {

       //parent::__construct();
        parent::__construct(); 

         
        // Load google oauth library 
      //   $this->load->library('facebook'); 
      //   $this->load->library('fb_auth'); 
         
        // Load user model 
        // $this->load->model('google_login_model'); 

 }


 function login()
 {
  $token = $this->fb_auth->getToken();
  dnd($token);
  
   
 }





 
}
?>
