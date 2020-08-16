<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SocialLogin extends CI_Controller {

	public function __construct() {

		parent::__construct();
		$this->config->load('google', TRUE);
		//$this->config->load('facebook', TRUE);
		$this->load->model('user_model');
	}
	/**
	 * Function to initiate google login
	 */
	public function google()
	{
		$google_config = $this->config->item('google');
		//Create Client Request to access Google API
		$client = new Google_Client();
		$client->setApplicationName($google_config['google']['application_name']);
		$client->setClientId($google_config['google']['client_id']);
		$client->setClientSecret($google_config['google']['client_secret']);
		$client->setRedirectUri( base_url($google_config['google']['redirect_uri']));
		$client->addScope("email");
		$client->addScope("profile");
		//Send Client Request
		$objOAuthService = new Google_Service_Oauth2($client);

		$authUrl = $client->createAuthUrl();

		header('Location: '.$authUrl);
	}


	/**
	 * Function to handle callback from google login
	 */
	public function googleCallback()
	{
		$google_config = $this->config->item('google');
		// Fill CLIENT ID, CLIENT SECRET ID, REDIRECT URI from Google Developer Console
		$client_id = $google_config['google']['client_id'];
		$client_secret = $google_config['google']['client_secret'];
		$redirect_uri = base_url($google_config['google']['redirect_uri']);

		//Create Client Request to access Google API
		$client = new Google_Client();
		$client->setApplicationName($google_config['google']['application_name']);
		$client->setClientId($client_id);
		$client->setClientSecret($client_secret);
		$client->setRedirectUri($redirect_uri);
		$client->addScope("email");
		$client->addScope("profile");

		//Send Client Request
		$service = new Google_Service_Oauth2($client);

		$client->authenticate($_GET['code']);
		$_SESSION['access_token'] = $client->getAccessToken();

		// User information retrieval starts..............................

		$user = $service->userinfo->get(); //get user info

		$insert['name'] = $user->name;
		$insert['email'] = $user->email;
		$insert['social_login_id'] = $user->id;
		$insert['registration_type'] = 2;
		$insert['image'] = $user->picture;
		$this->save_user_info($insert);

	}

	/**
	 * Function to initiate facebook login
	 */
	public function facebook(){

		$fb = new \Facebook\Facebook([
			'app_id' => $this->config->item('facebook_app_id'),
			'app_secret' => $this->config->item('facebook_app_secret'),
			'default_graph_version' => $this->config->item('facebook_graph_version'),
			'persistent_data_handler'=>'session'
		]);

		$helper = $fb->getRedirectLoginHelper();

		$permissions = ['public_profile','email'];
		// For more permissions like user location etc you need to send your application for review
		$loginUrl = $helper->getLoginUrl(base_url().'/socialLogin/facebookCallback', $permissions);
		header("location: ".$loginUrl);
	}

	/**
	 * Function to get handle callback from facebook
	 */
	public function facebookCallback()
	{
		error_reporting(E_ALL ^ E_NOTICE);
		$fb = new \Facebook\Facebook([
			'app_id' => $this->config->item('facebook_app_id'),
			'app_secret' => $this->config->item('facebook_app_secret'),
			'default_graph_version' => $this->config->item('facebook_graph_version'),
			'persistent_data_handler'=>'session'
		]);
		$helper = $fb->getRedirectLoginHelper();
		if (isset($_GET['state'])) {
			$helper->getPersistentDataHandler()->set('state', $_GET['state']);
		}
		$accessToken = $helper->getAccessToken();
		$response = $fb->get('/me?fields=id,name,email', $accessToken);
		// User Information Retrival begins................................................
		$me = $response->getGraphUser();

		$insert['name'] = $me->getProperty('name');
		$insert['email'] = $me->getProperty('email');
		$insert['social_login_id'] = $me->getProperty('id');
		$insert['registration_type'] = 3;
		$insert['image'] = 'https://graph.facebook.com/'.$me->getProperty('id').'/picture?type=large';
		$this->save_user_info($insert);
	}

	/**
	 * Function to save social login data in users table
	 * @param $data
	 */
	public function save_user_info($data){
		/*check user's social login id is already exists or not in users table
		if yes then login or register as a new user*/
		$res = $this->user_model->check_email_with_registration_type($data['email'],$data['registration_type']);
		if(count($res) > 0){
			$user_details = $res[0];
			$user['first_name'] = $user_details->first_name;
			$user['last_name'] = $user_details->last_name;
			$user['email'] = $user_details->email;
			$user['social_login_id'] = $user_details->social_login_id;
			$user['registration_type'] = 2;
			$user['image'] = $user_details->image;
			$user['user_id'] = $user_details->id;
			$user['is_logged_in'] = 2;
			$this->session->set_userdata('user_data', $user);
			//redirect to user's dashboard
			redirect(base_url().'account/dashboard');
		}

		/**
		 * Check email exists or not
		 */
		$res = $this->user_model->check_email_duplicacy($data['email']);
		if(count($res) > 0){
			$this->session->set_flashdata('error_message', 'Email ID already exists');
			redirect(base_url().'home/register', 'refresh');
		}

		$name = $data['name'];
		$split_name = $this->split_name($name);
		$insert['first_name'] = $split_name[0];
		$insert['last_name'] = $split_name[1];
		$insert['email'] = $data['email'];
		$insert['social_login_id'] = $data['social_login_id'];
		$insert['registration_type'] = $data['registration_type'];

		$file_name = 'user_image_'.time().'.jpg';
		$local_file = 'uploads/users/'.$file_name;
		$remote_file = $data['image'];

		$ch = curl_init();
		$fp = fopen ($local_file, 'w+');
		$ch = curl_init($remote_file);
		curl_setopt($ch, CURLOPT_TIMEOUT, 50);
		curl_setopt($ch, CURLOPT_FILE, $fp);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_ENCODING, "");
		curl_exec($ch);
		curl_close($ch);
		fclose($fp);
		$insert['image'] = $file_name;

		$user = $this->user_model->insert_data('user', $insert);
		$insert['user_id'] = $user;
		$insert['username'] = 'user'.$user; //generate user_id
		$this->user_model->update_data('user','id = '.$user.'',['username' => 'user'.$user]);
		$insert['is_logged_in'] = 2;
		$this->session->set_userdata('user_data', $insert);
		$users = $this->session->get_userdata()['user_data'];
		redirect(base_url().'account/dashboard', 'refresh');
	}

	// uses regex that accepts any word character or hyphen in last name
	protected function split_name($name) {
		$name = trim($name);
		$last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
		$first_name = trim( preg_replace('#'.$last_name.'#', '', $name ) );
		return array($first_name, $last_name);
	}

}
