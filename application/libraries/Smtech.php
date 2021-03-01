<?php
defined('BASEPATH') or exit('No direct script access allowed');



use smtech\OAuth2\Client\Provider\CanvasLMS;

//session_start();

/* anti-fat-finger constant definitions */

define('CODE', 'code');
define('STATE', 'state');
define('STATE_LOCAL', 'oauth2-state');

class Smtech
{



	public function __construct()
	{
		//parent::__construct();
		// Your own constructor code
		// $this->load->database();
		// $this->load->library('session');
		$this->provider = new CanvasLMS([
			'clientId' => '10000000000004',
			'clientSecret' => 'xr59z3BvShv7LE8AVtBk7g7iyDslUv3eSjxBk7k78XJs09mxBzIRdbyd7Lpi0mxO',
			'purpose' => 'Study Peers',
			'scope' => '/auth/userinfo',
			'redirectUri' => 'http://' . $_SERVER['SERVER_NAME'].'/token_success',
			'canvasInstanceUrl' => 'https://canvas-lms.ga'
		]);


	}
 
	function login_url() {
		return $this->provider->getAuthorizationUrl();
	}
	
	public function login()
	{
		
		// If we don't have an authorization code then get one
		if (!isset($_GET['code'])) {

			// Fetch the authorization URL from the provider; this returns the
			// urlAuthorize option and generates and applies any necessary parameters
			// (e.g. state).
			$authorizationUrl = $this->provider->getAuthorizationUrl();

			// Get the state generated for you and store it to the session.
			$_SESSION['oauth2state'] = $this->provider->getState();

			// Redirect the user to the authorization URL.
			header('Location: ' . $authorizationUrl);
			exit;

			// Check given state against previously stored one to mitigate CSRF attack
		} elseif (empty($_GET['state']) || (isset($_SESSION['oauth2state']) && $_GET['state'] !== $_SESSION['oauth2state'])) {

			if (isset($_SESSION['oauth2state'])) {
				unset($_SESSION['oauth2state']);
			}

			exit('Invalid state');
		} else {

			try {

				// Try to get an access token using the authorization code grant.
				$accessToken = $this->provider->getAccessToken('authorization_code', [
					'code' => $_GET['code']
				]);

				// We have an access token, which we may use in authenticated
				// requests against the service provider's API.
				echo 'Access Token: ' . $accessToken->getToken() . "<br>";
				echo 'Refresh Token: ' . $accessToken->getRefreshToken() . "<br>";
				echo 'Expired in: ' . $accessToken->getExpires() . "<br>";
				echo 'Already expired? ' . ($accessToken->hasExpired() ? 'expired' : 'not expired') . "<br>";

				// Using the access token, we may look up details about the
				// resource owner.
				$resourceOwner = $this->provider->getResourceOwner($accessToken);

				var_export($resourceOwner->toArray());

				// The provider provides a way to get an authenticated API request for
				// the service, using the access token; it returns an object conforming
				// to Psr\Http\Message\RequestInterface.
				$request = $this->provider->getAuthenticatedRequest(
					'GET',
					'http://brentertainment.com/oauth2/lockdin/resource',
					$accessToken
				);
			} catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {

				// Failed to get the access token or user details.
				exit($e->getMessage());
			}
		}
	}


	public function logout()
	{
		$this->session->unset_userdata('access_token');

		$this->session->unset_userdata('user_data');

		redirect('google_login/login');
	}
}
