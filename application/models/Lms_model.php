<?php
class Lms_model extends CI_Model {

function __construct()
{
parent::__construct();

}


function  get_lms_records($limit,$start){
$this->db->limit($limit, $start);
$query = $this->db->select('id,name,lms_end_points,lms_logo')->get("lms");
return $query->result();
}
}