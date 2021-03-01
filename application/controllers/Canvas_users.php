<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Canvas_users extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('canvas/Users_model','user');
		$this->canvas->setApiHost($this->session->userdata('canvas')->canvasUrl);
		
		$this->canvas->setToken($this->session->userdata('access_token'));
	}
	
	function showUserDetails() {
		// dnd($this->canvas->users);
		$details = $this->canvas->users->showUserDetails()->getContent();
		dnd($details);

	}

	function listUsersInAccount($id) {
		
		$users = $this->canvas->users->listUsersInAccount($id)->getContent();

		dnd($users);
	}
	
	function listActivityStream() {
		$stream = $this->canvas->users->listActivityStream()->getContent();

		dnd($stream);
	}

	function createUser($id) {
		$p = [
			"user" => [
				"name"=> "Test Owino",
				"short_name"=>"Owino"
			],
			"pseudonym" => [
				"unique_id"=>"amolo@nerd.com",
				"password"=>"Test0013#$[]1.<.?><&6vd=06"
				
			],
			"communication_channel" => [
				"skip_confirmation" => true
			]
			];
		$user = $this->canvas->users->addParameters($p)->createUser($id);
		dnd($user);
	}

}