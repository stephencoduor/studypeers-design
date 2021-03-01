<?php

namespace StudyPeersApi;

defined('BASEPATH') or exit('No direct script access allowed');

use Studypeers\CanvasApi\Adapters\Guzzle;
use Studypeers\CanvasApi\CanvasApi;




class StudyPeers extends CanvasApi
{

	private static $instance = null;
	private function __construct()
	{

		$this->setConfig(new CanvasConfig);
		$this->setAdapter(new Guzzle);
	}

	static function getInstance()
	{

		if (!self::$instance instanceof self) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	function __get($name)
	{
		$name = "\\Studypeers\\CanvasApi\\Clients\\" . ucwords($name);
		$this->setClient(new $name);
		return $this;
	}
}
