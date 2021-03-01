<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		
	}

	function get_school_records($limit,$start) {
		$this->db->limit($limit, $start);
		
		$query = $this->db->select('name,website,canvas_url,emailDomain,country,university_id')->get("university");
		return $query->result();
		
	}

	
	
}
