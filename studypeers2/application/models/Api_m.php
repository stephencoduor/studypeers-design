<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
| -----------------------------------------------------
| PRODUCT NAME: 	
| -----------------------------------------------------
| AUTHOR:			SUNIL THAKUR (http://sunilthakur.in)
| -----------------------------------------------------
| EMAIL:			
| -----------------------------------------------------
| COPYRIGHT:		RESERVED BY 
| -----------------------------------------------------
| WEBSITE:			http://
| -----------------------------------------------------
*/

class Api_m extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function update_device($userID,$ip_address,$deviceID,$deviceToken,$deviceType)
	{
	    $created_on = date('Y-m-d H:i:s');
	    $query = $this->db->get_where('user_login',array('deviceID'=>$deviceID));
	    if(!empty($query->row()))
	    {
	        $this->db->where(array('deviceID'=>$deviceID));
	        $this->db->update('user_login',array("userID"=>$userID, "ip_address"=>$ip_address, "deviceID"=>$deviceID, "deviceToken"=>$deviceToken, "deviceType"=>$deviceType, "login_on"=>$created_on));
	    } else {
	        $this->db->insert('user_login',array("userID"=>$userID, "ip_address"=>$ip_address, "deviceID"=>$deviceID, "deviceToken"=>$deviceToken, "deviceType"=>$deviceType, "login_on"=>$created_on));
	    }
	    return TRUE;
	}


	public function logout($array)
	{
		$this->db-> where($array);
	  	$this->db-> delete('user_login');
	  	return TRUE;
	}


	public function table_insert($table,$array)
	{
		$query = $this->db->insert($table,$array);
		return $this->db->insert_id();
	}

	public function get_single_table($table,$array,$select='*')
	{
	    $this->db->select($select);
		$query = $this->db->get_where($table,$array);
		return $query->row();
	}

	public function table_update($table,$array,$where)
	{
		$query = $this->db->where($where);
		$this->db->update($table,$array);
		return TRUE;
	}

	public function get_all_data($table,$order_by = NULL,$order="ASC")
	{
		if($order_by != NULL)
		{
			$this->db->order_by($order_by, $order);
		}
		
		$query = $this->db->get($table);
		return $query->result();
	}

	public function get_all_data_where($table,$where,$order_by = NULL,$order="ASC")
	{
		if($order_by != NULL)
		{
			$this->db->order_by($order_by, $order);
		}
		$query = $this->db->get_where($table,$where);
		return $query->result();
	}

	public function get_single_table_query($query)
	{
		$query = $this->db->query($query);
		return $query->row();
	}

	public function get_all_table_query($query)
	{
		$query = $this->db->query($query);
		return $query->result();
	}

	public function get_listings($listing_id = 0,$user_id = 0) {
	  if (strtolower($this->session->userdata('role')) != 'admin') {
	    $this->db->where('user_id', $user_id);
	  }
	  if ($listing_id > 0) {
	    $this->db->where('id', $listing_id);
	  }else {
	    $this->db->order_by('date_added' , 'desc');
	  }
	  return $this->db->get('listing');
	}

	public function toggle_wishlist($listing_id = "", $user_id) {
        $existing_wishlist = array();
        $status = "";
        $user_details = $this->db->get_where('user', array('id' => $user_id))->row_array();
        if ($user_details['wishlists'] != "") {
            $existing_wishlist = json_decode($user_details['wishlists']);
            //return $existing_wishlist;
            if (in_array($listing_id, $existing_wishlist)) {
                if (($key = array_search($listing_id, $existing_wishlist)) !== false) {
                    unset($existing_wishlist[$key]);
                }
                $status = 'removed';
            }else {
                array_push($existing_wishlist, $listing_id);
                //return $existing_wishlist;
                $status = 'added';
            }
        }else {
            array_push($existing_wishlist, $listing_id);
            $status = 'added';
        }
        $updater = array(
            'wishlists' => json_encode(array_values($existing_wishlist))
        );
        $this->db->where('id', $user_id);
        $this->db->update('user', $updater);
        return $status;
    }

    public function is_wishlisted($listing_id,$user_id){
    	$user_details = $this->db->get_where('user', array('id' => $user_id))->row_array();
	    if ($user_details['wishlists'] != "") {
	      $wishlists = json_decode($user_details['wishlists']);
	      if (in_array($listing_id, $wishlists)) {
	        return 1;
	      }else {
	        return 0;
	      }
	    }else {
	      return 1;
	    }
    }

    public function is_amentity_selected($listing_id,$id){
    	$listing = $this->db->get_where('listing', array('id' => $listing_id))->row_array();
	    if ($listing['amenities'] != "") {
	      $amenities = json_decode($listing['amenities']);
	      if (in_array($id, $amenities)) {
	        return 1;
	      }else {
	        return 0;
	      }
	    }else {
	      return 1;
	    }
    }

    public function get_all_listings() {
        $this->db->where('status', 'active');
        return $this->db->get('listing');
    }

    function get_listing_wise_rating($listing_id = "") {
        $this->db->select_avg('review_rating');
        $rating = $this->db->get_where('review', array('listing_id' => $listing_id))->row()->review_rating;
        return number_format((float)$rating, 1, '.', '');
    }

    function get_top_ten_listings() {
        $listing_ids = array();
        $listing_id_with_rating = array();
        $listings = $this->get_all_listings()->result_array();
        foreach ($listings as $listing) {
          
          $listing_id_with_rating[$listing['id']] = $this->get_listing_wise_rating($listing['id']);
        }
        arsort($listing_id_with_rating);
        foreach ($listing_id_with_rating as $key => $value) {
            if (count($listing_ids) <= 10) {
                array_push($listing_ids, $key);
            }
        }
        if (count($listing_ids) > 0) {
            $this->db->where_in('id', $listing_ids);
            $this->db->where('status', 'active');
            return  $this->db->get('listing')->result();
        }else {
            return array();
        }
    }

    function get_listing_wise_review($listing_id = "") {
        return $this->db->get_where('review', array('listing_id' => $listing_id))->result();
    }

    
}