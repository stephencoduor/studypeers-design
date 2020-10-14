<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'/vendor/facebook/graph-sdk/src/Facebook/autoload.php';
require_once APPPATH.'/vendor/oauth/http.php';
require_once APPPATH.'/vendor/oauth/oauth_client.php';
use Facebook\FacebookRequest;
use Facebook\Helpers\FacebookRedirectLoginHelper;

class SocialLogin extends CI_Controller {

	public function __construct() {

		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		/*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->config->load('google', TRUE);
		$this->load->model('user_model');
	}
	/**
	 * Function to initiate google login
	 */
	public function google()
	{
		$this->session->set_userdata('social_signup', 'register');
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
		$this->session->set_userdata('social_signup', 'register');

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
		$app_id = $this->config->item('facebook_app_id');
		$app_secret = $this->config->item('facebook_app_secret');
		$fb = new Facebook\Facebook([
			'app_id' => $this->config->item('facebook_app_id'),
			'app_secret' => $this->config->item('facebook_app_secret'),
			'default_graph_version' => $this->config->item('facebook_graph_version'),
			'persistent_data_handler'=>'session'
			//'default_access_token' => $app_id.'|'.$app_secret
		]);

		$helper = $fb->getRedirectLoginHelper();
		if (isset($_GET['state'])) {
			$helper->getPersistentDataHandler()->set('state', $_GET['state']);
		}
		$accessToken = $helper->getAccessToken();
		$exchange_url = 'https://graph.facebook.com/2.0/oauth/access_token?grant_type=fb_exchange_token&client_id='.$app_id.'&
    					client_secret='.$app_secret.'&
    					fb_exchange_token='.$accessToken;

		$long_live_token_details = $this->curl_file_get_contents($exchange_url);
		echo '<pre/>';
		print_r($long_live_token_details);
		die;
		$long_live_token_details = json_decode($long_live_token_details, true);
		$response = $fb->get('/me?fields=id,name,email', $long_live_token_details['access_token']);


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
		error_reporting(E_ALL ^ E_NOTICE);

		try {
			$singup_type = $this->session->get_userdata()['social_signup'];
			$is_register = 0;
			/*check user's social login id is already exists or not in users table
			if yes then login or register as a new user*/
			$res = $this->user_model->check_email_with_registration_type($data['email'],$data['registration_type']);
			if(count($res) > 0) {
				$user_details = $res[0];
				$is_register = 1;
			}
			/**
			 * Check email exists or not
			 */
			$result = $this->user_model->check_email_duplicacy($data['email']);
			if(count($result) > 0){
				//update social login id
				if ($data['registration_type'] == 2) {
					$this->user_model->update_data('user','id = '.$result[0]->id.'',['google_id' => $data['social_login_id']]);
				}
				if ($data['registration_type'] == 3) {
					$this->user_model->update_data('user','id = '.$result[0]->id.'',['fb_id' => $data['social_login_id']]);
				}
				if ($data['registration_type'] == 4) {
					$this->user_model->update_data('user','id = '.$result[0]->id.'',['linkedin_id' => $data['social_login_id']]);
				}
				if ($data['registration_type'] == 5) {
					$this->user_model->update_data('user','id = '.$result[0]->id.'',['microsoft_id' => $data['social_login_id']]);
				}
				$user_details = $result[0];
				$is_register = 1;
			}
			if($is_register == 1){
				$user['first_name'] = $user_details->first_name;
				$user['last_name'] = $user_details->last_name;
				$user['email'] = $user_details->email;
				$user['registration_type'] = $data['registration_type'];
				$user['image'] = $user_details->image;
				$user['user_id'] = $user_details->id;
				$user['username'] = $user_details->username;
				$user['is_logged_in'] = 2;
				$this->session->set_userdata('user_data', $user);
				$this->session->unset_userdata('social_signup');
				//redirect to user's dashboard
				redirect(base_url() . 'account/dashboard');
			}
			else{
				$name = $data['name'];
				$split_name = $this->split_name($name);
				$insert['first_name'] = $split_name[0];
				$insert['last_name'] = $split_name[1];
				$insert['email'] = $data['email'];
				if($data['registration_type'] == 2){
					$insert['google_id'] = $data['social_login_id'];
				}
				if($data['registration_type'] == 3){
					$insert['fb_id'] = $data['social_login_id'];
				}
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
				$insert['is_logged_in'] = 1;
				$this->session->set_userdata('user_data', $insert);
				$users = $this->session->get_userdata()['user_data'];
				$this->session->unset_userdata('social_signup');
				redirect(base_url().'home/sign_up');
			}
		} catch (\Exception $e) {
			echo '<pre/>';
			print_r($e->getMessage());
		}
	}

	// uses regex that accepts any word character or hyphen in last name
	protected function split_name($name) {
		$name = trim($name);
		$last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
		$first_name = trim( preg_replace('#'.$last_name.'#', '', $name ) );
		return array($first_name, $last_name);
	}


	public function googleLogin()
	{
		$this->session->set_userdata('social_signup', 'login');
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

	public function facebookLogin(){

		$fb = new \Facebook\Facebook([
			'app_id' => $this->config->item('facebook_app_id'),
			'app_secret' => $this->config->item('facebook_app_secret'),
			'default_graph_version' => $this->config->item('facebook_graph_version'),
			'persistent_data_handler'=>'session'
		]);
		$this->session->set_userdata('social_signup', 'login');

		$helper = $fb->getRedirectLoginHelper();

		$permissions = ['public_profile','email'];
		// For more permissions like user location etc you need to send your application for review
		$loginUrl = $helper->getLoginUrl(base_url().'/socialLogin/facebookCallback', $permissions);
		header("location: ".$loginUrl);
	}

	public function linkedinCallback()
	{
		$client = new oauth_client_class();
		$client->debug = true;
		$client->debug_http = true;
		$client->redirect_uri = $this->config->item('linkedin_redirect_uri');
		$client->server = "LinkedIn";
		$client->client_id = $this->config->item('linkedin_app_id');
		$client->client_secret = $this->config->item('linkedin_app_secret');
		$client->scope = $this->config->item('linkedin_scope');
        
        if (strlen($client->client_id) == 0 || strlen($client->client_secret) == 0)
			die('Please go to LinkedIn Apps page');
        
        try{
            if (($success = $client->Initialize())) {
    			if (($success = $client->Process())) {
    			 	if (strlen($client->authorization_error)) {
    				    echo $client->authorization_error;
    					$client->error = $client->authorization_error;
    					$success = false;
    				} elseif (strlen($client->access_token)) {
                        $profile_data = json_decode($this->getProfileDetails($client->access_token));
					    $email_data = json_decode($this->getEmailAddress($client->access_token));        
					    $first_name = $profile_data->localizedFirstName;
    			        $last_name = $profile_data->localizedLastName;
    			        $email = $email_data->elements[0]->{"handle~"}->emailAddress;
    			        $insert['name'] = $first_name.' '.$last_name;
				        $insert['email'] = $email;
				        $insert['social_login_id'] = $profile_data->id;
				        $insert['registration_type'] = 4;
				        $insert['image'] = '';
				        $this->save_user_info($insert);
    				}
    			}
    		}else{
    		    redirect(base_url());
    		}
        }
        catch(\Exception $e){
            redirect(base_url());
        }
		
	}

    public function getProfileDetails($access_token){
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.linkedin.com/v2/me/",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"authorization: Bearer ".$access_token,
				"cache-control: no-cache"
			),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			return $response;
		}
	}

	public function getEmailAddress($access_token){
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.linkedin.com/v2/emailAddress?q=members&projection=(elements*(handle~))",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,    
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"authorization: Bearer ".$access_token,
				"cache-control: no-cache"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			return $response;
		}
	}


    public function microsoftLogin()
	{
			$client_id = $this->config->item('ms_client_id');
			$redirect_uri = $this->config->item('ms_redirect_url');
			//$redirect_uri = "http://localhost/studypeers/socialLogin/microsoftCallback"; //you can also use localhost url for testing but first add url into microsoft app redirect url then you can use localhost url
			$urls = 'https://login.live.com/oauth20_authorize.srf?client_id='.$client_id.'&scope=wl.signin%20wl.basic%20wl.emails%20wl.contacts_emails&response_type=code&redirect_uri='.$redirect_uri;
			header("Location: " .$urls);
	}

	public function microsoftCallback()
	{
		if(isset($_GET['code']) && $_GET['code'] != "")
		{
			$auth_code = $_GET["code"];
			$client_id = $this->config->item('ms_client_id');
			$client_secret = $this->config->item('ms_client_secret');
			$redirect_uri = $this->config->item('ms_redirect_url');

			$fields = array(
				'code'=>  urlencode($auth_code),
				'client_id'=>  urlencode($client_id),
				'client_secret'=>  urlencode($client_secret),
				'redirect_uri'=>  urlencode($redirect_uri),
				'grant_type'=>  urlencode('authorization_code')
			);

			$post = '';
			foreach($fields as $key=>$value)
			{
				$post .= $key.'='.$value.'&';
			}
			$post = rtrim($post,'&');
			$curl = curl_init();
			curl_setopt($curl,CURLOPT_URL,'https://login.live.com/oauth20_token.srf');
			curl_setopt($curl,CURLOPT_POST,5);
			curl_setopt($curl,CURLOPT_POSTFIELDS,$post);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER,TRUE);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
			$result = curl_exec($curl);
			curl_close($curl);
			$response =  json_decode($result);
			$accesstoken = $response->access_token;
			$get_profile_url='https://apis.live.net/v5.0/me?access_token='.$accesstoken;
			$xmlprofile_res=$this->curl_file_get_contents($get_profile_url);
			$profile_res = json_decode($xmlprofile_res, true);

			if($profile_res) {
				$insert['name'] = $profile_res['name'];
				$insert['email'] = $profile_res['emails']['account'];
				$insert['social_login_id'] = $profile_res['id'];
				$insert['registration_type'] = 5;
				$insert['image'] = '';
				$this->save_user_info($insert);
			}
		}
	}

	function curl_file_get_contents($url) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_AUTOREFERER, TRUE);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
		$data = curl_exec($curl);
		curl_close($curl);
		return $data;
	}


}

?>
