<?php

namespace StudyPeersApi;
class OAuth
{

	private static $clientId;

	private static $clientSecret;

	private static $authorizeEndpoint;

	private static $tokenEndpoint;

	private static $redirectUri;

	private $scope;
	private $grant_type = "authorization_code";

	function __construct(array $config = [])
	{
		$this->app =& get_instance();
		if($config) {
			foreach ($config as $key => $item) {
				$this->{$key} = $item;
			}
		}
		
	}

	static function setConfig(array $config) {
		foreach ($config as $key => $item) {
			self::${$key} = $item;
		}
	}

	function getAuthorizationUrl()
	{
		return $this->builtAuthorizationUrl();
	}


	function builtAuthorizationUrl()
	{
		return sprintf(
			"%s?client_id=%s&response_type=code&redirect_uri=%s",
			$this->app->session->userdata('canvas')->authorizeEndpoint,
			$this->app->session->userdata('canvas')->clientId,
			$this->app->session->userdata('canvas')->redirectUri
		);
	}

	function authorize()
	{
		header("Location: " . $this->builtAuthorizationUrl());
	}

	function getAccessToken()
	{
		$ci = &get_instance();
		
		
		if ($ci->session->has_userdata("token_expiry")) {
			if (time() < $ci->session->userdata("token_expiry")) {
				return $ci->session->userdata("access_token");
			} 
			
		}
		
		$response = $this->token();
		// dnd($response);
		if (!property_exists($response,'errors') && !property_exists($response,'error')) {
			$ci->session->set_userdata("access_token",$response->access_token);
			$ci->session->set_userdata("refresh_token",$response->refresh_token);
			$ci->session->set_userdata("token_expiry",time() + $response->expires_in);
			$ci->session->set_userdata("canvas_user_id",$response->user->id);
		} else {
			dnd($response);
			
		}


		
		
		
		
		return $response;
	}

	function token()
	{
		$params = [
			'grant_type' => 'authorization_code',
			'client_id' => $this->app->session->userdata('canvas')->clientId,
			'client_secret' => $this->app->session->userdata('canvas')->clientSecret,
			'code' => $_GET['code']

		];
		// dnd($params);
		$handle = curl_init($this->app->session->userdata('canvas')->tokenEndpoint);
		curl_setopt($handle, CURLOPT_POST, true);
		curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($handle, CURLOPT_POSTFIELDS, $params);
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($handle);


		curl_close($handle);
		return json_decode($response);
	}
}
