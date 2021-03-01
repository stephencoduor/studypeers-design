<?php
defined('BASEPATH') or exit('No direct script access allowed');

use smtech\OAuth2\Client\Provider\CanvasLMS;

class Canvas extends MY_Controller
{


	public function __construct()
	{
		parent::__construct();


		
		
		$this->load->library('smtech');
		$this->load->model('user');
		
		// $params = [
			
			
		// ];

		// $this->load->library('OAuth', $params, 'oauth');
		$this->load->library('fb_auth');
	}

	function test()
	{

		dnd($_SERVER['HTTP_HOST'],$_SERVER['SERVER_NAME'],$this->input->server('SERVER_NAME'));
		
		$resp = $this->canvas->using('users')->showUserDetails();

		dnd($resp->getLastCall()['request']);
	}

	function fblogin()
	{
		$resp = $this->fb_auth->getToken();



		$user = $this->fb_auth->getCurrentUser($resp->access_token);

		dnd($resp, $user);
	}
	function login()
	{
		// dnd($_SERVER['SERVER_NAME']);
		// dnd($_SERVER["HTTP_USER_AGENT"]);
		if ($this->input->method() == "post") {
			$canvas_url = $this->input->post('school');
			// dnd($canvas_url);
			if (!isset($canvas_url) OR !$canvas_url) {
				$this->session->set_flashdata("error_message","No school selected.Select a school to proceed");
				return redirect('/home/login','refresh');
			}
			$res = $this->user->get_single_row_where('university',compact('canvas_url'),'client_id,client_secret,auth_endpoint,token_endpoint');
			if (empty($res->client_id) || empty($res->client_secret) ) {
				$this->session->set_flashdata("error_message","Client credential(s) for school not found");
				return redirect('/home/login','refresh');
			} else if (empty($res->token_endpoint) || empty($res->auth_endpoint) ) {
				$this->session->set_flashdata("error_message","authorization or token endpoints not set");
				return redirect('/home/login','refresh');
			}
			$canvas_url = rtrim($canvas_url,'/')."/";
			$this->session->set_userdata("canvas",(object) [
				'tokenEndpoint' => $canvas_url.ltrim($res->token_endpoint,'/'),
				'authorizeEndpoint' => $canvas_url.ltrim($res->auth_endpoint,'/'),
				'clientId' => $res->client_id,
				'clientSecret' => $res->client_secret,
				'redirectUri' => canvas_url()."/token_success",
				'canvasUrl' => $canvas_url
			]);

			
			
			// dnd($this->oauth);
			
			
			

		}
		if (!isset($_GET['code'])) {
			return $this->oauth->authorize();
		}

		 $this->oauth->getAccessToken();
		
		$this->canvas->setApiHost($this->session->userdata('canvas')->canvasUrl);
		$this->canvas->setToken($this->session->userdata('access_token'));
		// redirect(site_url('account/dashboard'), 'refresh');
		$details = $this->canvas->users->getUserProfile($this->session->userdata('canvas_user_id'))->getContent();
		// dnd($details);
		
		$user = $this->user->get_single_row_where('user',['email'=>$details->login_id],'email,username,role_id,is_detailed,id');
		
		if (is_null($user)) {

			$user = $this->registerCanvasUser($details);
		}

		// dnd($details,$user);

		if (!is_null($user)) {
			$data['is_logged_in'] = 2;
			$data['user_id']    = $user->id;
			$data['role_id']    = $user->role_id;
			$data['role']       = get_user_role('user_role', $user->id);
			$data['username']   = $user->username;
			$data['user_login']   = 1;
			if ($user->role_id == 2) {
				if ($user->is_detailed == 0) {
					$data['is_logged_in']   = 1;
					$this->session->set_userdata('user_data', $data);
					redirect(site_url('home/sign_up'), 'refresh');
				} else {
					$data['is_logged_in']   = 2;
					$this->session->set_userdata('user_data', $data);
					redirect(site_url('account/dashboard'), 'refresh');
				}
			}
		}
		// dnd($details,$user);
		
		
	}
	
	function registerCanvasUser($data) {
		list($first_name,$last_name) = explode(' ',trim($data->name));
		$savable = [
			"email" => $data->login_id,
			"username" => $data->login_id,
			"role_id" => 2,
			"is_detailed" => 1,
			'first_name' => $first_name,
			'last_name' => $last_name,
		];
		$savable['password'] = '';
		$savable['address'] = 'address';
		$savable['phone'] = '';
		$savable['about'] = '';
		$savable['wishlists'] = '[]';
		$savable['job_wishlist'] = '[]';
		$savable['rental_wishlist'] = '[]';
		$this->db->insert('user',$savable);
		return $this->user->get_single_row_where('user',['email'=>$data->login_id],'email,username,role_id,is_detailed,id');
		// return $this->db->select('email,username,role_id,is_detailed,user_id')->where(['email'=>$data->login_id])->get('user')->result();

	}


	public function logout()
	{
		$this->session->unset_userdata('access_token');

		$this->session->unset_userdata('user_data');

		redirect('google_login/login');
	}
}
