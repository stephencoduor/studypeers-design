<?php

use StudyPeersApi\StudyPeers;

defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	/**
	 * CanvasApi Object
	 *
	 * @var Studypeers\CanvasApi\CanvasApi $canvas
	 */
	protected $canvas;
	
	public function __construct() {
		parent::__construct();
		$this->canvas = StudyPeers::getInstance();
		
		$this->load->library('session');
		$this->load->database();
		$this->oauth = new StudyPeersApi\OAuth();
	}
}