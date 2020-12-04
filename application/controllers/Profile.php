<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('upload_model');
	}

	public function getMyFeeds(){
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $offset     = $this->input->post('count'); 
        $count      = $offset*10; 
        


        $this->db->select('reference_master.*,');
        $this->db->from('reference_master');
        $this->db->where("reference_master.status",1);
        $this->db->where("reference_master.user_id",$user_id);
        
        $total_feeds = $this->db->get()->num_rows();

        $this->db->select('reference_master.*,');
        $this->db->from('reference_master');
        $this->db->where("reference_master.status",1);
        $this->db->where("reference_master.user_id",$user_id);
        
        $this->db->limit(10, $count);
        $this->db->order_by('reference_master.id', 'desc');
        $data['feeds'] = $this->db->get()->result_array(); 
        // echo $this->db->last_query();die;
        if($count+10 < $total_feeds){
            $data['loadMore'] = 1;
        } else {
            $data['loadMore'] = 0;
        }
        $data['nextOffset'] = $offset+1;
        $data['ifTabs'] =0;
        $html = $this->load->view('user/profile/timeline-feeds', $data, true);
        echo $html;
    }

    public function getMyPosts(){
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $offset     = $this->input->post('count'); 
        $count      = $offset*10; 
        


        $this->db->select('reference_master.*,');
        $this->db->from('reference_master');
        $this->db->where("reference_master.status",1);
        $this->db->where("reference_master.reference",'Post');
        $this->db->where("reference_master.user_id",$user_id);
        
        $total_feeds = $this->db->get()->num_rows();

        $this->db->select('reference_master.*,');
        $this->db->from('reference_master');
        $this->db->where("reference_master.status",1);
        $this->db->where("reference_master.reference",'Post');
        $this->db->where("reference_master.user_id",$user_id);
        
        $this->db->limit(10, $count);
        $this->db->order_by('reference_master.id', 'desc');
        $data['feeds'] = $this->db->get()->result_array(); 
        // echo $this->db->last_query();die;
        if($count+10 < $total_feeds){
            $data['loadMore'] = 1;
        } else {
            $data['loadMore'] = 0;
        }
        $data['nextOffset'] = $offset+1;
        $data['ifTabs'] =1;
        $html = $this->load->view('user/profile/timeline-feeds', $data, true);
        echo $html;
    }

    public function getMyQuestions(){
    	$user_id = $this->session->get_userdata()['user_data']['user_id'];
        $offset     = $this->input->post('count'); 
        $count      = $offset*10; 
        

        $this->db->select('reference_master.*,');
        $this->db->from('reference_master');
        $this->db->where("reference_master.status",1);
        $this->db->where("reference_master.reference",'question');
        $this->db->where("reference_master.user_id",$user_id);
        
        $total_feeds = $this->db->get()->num_rows();

        $this->db->select('reference_master.*,');
        $this->db->from('reference_master');
        $this->db->where("reference_master.status",1);
        $this->db->where("reference_master.reference",'question');
        $this->db->where("reference_master.user_id",$user_id);
        
        $this->db->limit(10, $count);
        $this->db->order_by('reference_master.id', 'desc');
        $data['feeds'] = $this->db->get()->result_array(); 
        // echo $this->db->last_query();die;
        if($count+10 < $total_feeds){
            $data['loadMore'] = 1;
        } else {
            $data['loadMore'] = 0;
        }
        $data['nextOffset'] = $offset+1;
        $data['ifTabs'] =2;
        $html = $this->load->view('user/profile/timeline-feeds', $data, true);
        echo $html;
    }


    public function getMyDocuments(){
    	$user_id = $this->session->get_userdata()['user_data']['user_id'];
        $offset     = $this->input->post('count'); 
        $count      = $offset*10; 
        


        $this->db->select('reference_master.*,');
        $this->db->from('reference_master');
        $this->db->where("reference_master.status",1);
        $this->db->where("reference_master.reference",'document');
        $this->db->where("reference_master.user_id",$user_id);
        
        $total_feeds = $this->db->get()->num_rows();

        $this->db->select('reference_master.*,');
        $this->db->from('reference_master');
        $this->db->where("reference_master.status",1);
        $this->db->where("reference_master.reference",'document');
        $this->db->where("reference_master.user_id",$user_id);
        
        $this->db->limit(10, $count);
        $this->db->order_by('reference_master.id', 'desc');
        $data['feeds'] = $this->db->get()->result_array(); 
        // echo $this->db->last_query();die;
        if($count+10 < $total_feeds){
            $data['loadMore'] = 1;
        } else {
            $data['loadMore'] = 0;
        }
        $data['nextOffset'] = $offset+1;
        $data['ifTabs'] =3;
        $html = $this->load->view('user/profile/timeline-feeds', $data, true);
        echo $html;
    }


    public function getMyStudyset(){

    	$user_id = $this->session->get_userdata()['user_data']['user_id'];
        $offset     = $this->input->post('count'); 
        $count      = $offset*10; 
        


        $this->db->select('reference_master.*,');
        $this->db->from('reference_master');
        $this->db->where("reference_master.status",1);
        $this->db->where("reference_master.reference",'studyset');
        $this->db->where("reference_master.user_id",$user_id);
        
        $total_feeds = $this->db->get()->num_rows();

        $this->db->select('reference_master.*,');
        $this->db->from('reference_master');
        $this->db->where("reference_master.status",1);
        $this->db->where("reference_master.reference",'studyset');
        $this->db->where("reference_master.user_id",$user_id);
        
        $this->db->limit(10, $count);
        $this->db->order_by('reference_master.id', 'desc');
        $data['feeds'] = $this->db->get()->result_array(); 
        // echo $this->db->last_query();die;
        if($count+10 < $total_feeds){
            $data['loadMore'] = 1;
        } else {
            $data['loadMore'] = 0;
        }
        $data['nextOffset'] = $offset+1;
        $data['ifTabs'] =4;
        $html = $this->load->view('user/profile/timeline-feeds', $data, true);
        echo $html;
    }

    public function getMyEvents(){


        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $offset     = $this->input->post('count'); 
        $count      = $offset*10; 
        


        $this->db->select('reference_master.*,');
        $this->db->from('reference_master');
        $this->db->where("reference_master.status",1);
        $this->db->where("reference_master.reference",'event');
        $this->db->where("reference_master.user_id",$user_id);
        
        $total_feeds = $this->db->get()->num_rows();

        $this->db->select('reference_master.*,');
        $this->db->from('reference_master');
        $this->db->where("reference_master.status",1);
        $this->db->where("reference_master.reference",'event');
        $this->db->where("reference_master.user_id",$user_id);
        
        $this->db->limit(10, $count);
        $this->db->order_by('reference_master.id', 'desc');
        $data['feeds'] = $this->db->get()->result_array(); 
        // echo $this->db->last_query();die;
        if($count+10 < $total_feeds){
            $data['loadMore'] = 1;
        } else {
            $data['loadMore'] = 0;
        }
        $data['nextOffset'] = $offset+1;
        $data['ifTabs'] =5;
        $html = $this->load->view('user/profile/timeline-feeds', $data, true);
        echo $html;
    }

    public function getFriendFeeds(){
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $friend_id = $this->input->post('friend_id'); 
        $offset     = $this->input->post('count'); 
        $count      = $offset*10; 

        $chk_if_friend = $this->db->get_where($this->db->dbprefix('friends'), array('user_id'=>$user_id, 'peer_id' => $friend_id))->row_array(); 

        $chk_if_follow = $this->db->get_where($this->db->dbprefix('follow_master'), array('user_id'=>$user_id, 'peer_id' => $friend_id))->row_array();

        $data['friend_id']  	= $friend_id;
        $data['chk_if_friend']  = $chk_if_friend;
		$data['chk_if_follow']  = $chk_if_follow; 
        
        $this->db->select('reference_master.*,');
        $this->db->from('reference_master');
        $this->db->where("reference_master.status",1);
        $this->db->where("reference_master.user_id",$friend_id);
        
        $total_feeds = $this->db->get()->num_rows();

        $this->db->select('reference_master.*,');
        $this->db->from('reference_master');
        $this->db->where("reference_master.status",1);
        $this->db->where("reference_master.user_id",$friend_id);
        
        $this->db->limit(10, $count);
        $this->db->order_by('reference_master.id', 'desc');
        $data['feeds'] = $this->db->get()->result_array(); 
        // echo $this->db->last_query();die;
        if($count+10 < $total_feeds){
            $data['loadMore'] = 1;
        } else {
            $data['loadMore'] = 0;
        }
        $data['nextOffset'] = $offset+1;
        $data['ifTabs'] =0; 
        $html = $this->load->view('user/profile/friend-feeds', $data, true);
        echo $html;
    }


    public function getUserPosts(){
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $friend_id = $this->input->post('friend_id'); 
        $offset     = $this->input->post('count'); 
        $count      = $offset*10; 

        $chk_if_friend = $this->db->get_where($this->db->dbprefix('friends'), array('user_id'=>$user_id, 'peer_id' => $friend_id))->row_array(); 

        $chk_if_follow = $this->db->get_where($this->db->dbprefix('follow_master'), array('user_id'=>$user_id, 'peer_id' => $friend_id))->row_array();

        $data['friend_id']      = $friend_id;
        $data['chk_if_friend']  = $chk_if_friend;
        $data['chk_if_follow']  = $chk_if_follow; 
        
        $this->db->select('reference_master.*,');
        $this->db->from('reference_master');
        $this->db->where("reference_master.status",1);
        $this->db->where("reference_master.reference",'Post');
        $this->db->where("reference_master.user_id",$friend_id);
        
        $total_feeds = $this->db->get()->num_rows();

        $this->db->select('reference_master.*,');
        $this->db->from('reference_master');
        $this->db->where("reference_master.status",1);
        $this->db->where("reference_master.reference",'Post');
        $this->db->where("reference_master.user_id",$friend_id);
        
        $this->db->limit(10, $count);
        $this->db->order_by('reference_master.id', 'desc');
        $data['feeds'] = $this->db->get()->result_array(); 
        // echo $this->db->last_query();die;
        if($count+10 < $total_feeds){
            $data['loadMore'] = 1;
        } else {
            $data['loadMore'] = 0;
        }
        $data['nextOffset'] = $offset+1;
        $data['ifTabs'] =1; 
        $html = $this->load->view('user/profile/friend-feeds', $data, true);
        echo $html;
    }


    public function getUserQuestions(){
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $friend_id = $this->input->post('friend_id'); 
        $offset     = $this->input->post('count'); 
        $count      = $offset*10; 

        $chk_if_friend = $this->db->get_where($this->db->dbprefix('friends'), array('user_id'=>$user_id, 'peer_id' => $friend_id))->row_array(); 

        $chk_if_follow = $this->db->get_where($this->db->dbprefix('follow_master'), array('user_id'=>$user_id, 'peer_id' => $friend_id))->row_array();

        $data['friend_id']      = $friend_id;
        $data['chk_if_friend']  = $chk_if_friend;
        $data['chk_if_follow']  = $chk_if_follow; 
        
        $this->db->select('reference_master.*,');
        $this->db->from('reference_master');
        $this->db->where("reference_master.status",1);
        $this->db->where("reference_master.reference",'question');
        $this->db->where("reference_master.user_id",$friend_id);
        
        $total_feeds = $this->db->get()->num_rows();

        $this->db->select('reference_master.*,');
        $this->db->from('reference_master');
        $this->db->where("reference_master.status",1);
        $this->db->where("reference_master.reference",'question');
        $this->db->where("reference_master.user_id",$friend_id);
        
        $this->db->limit(10, $count);
        $this->db->order_by('reference_master.id', 'desc');
        $data['feeds'] = $this->db->get()->result_array(); 
        // echo $this->db->last_query();die;
        if($count+10 < $total_feeds){
            $data['loadMore'] = 1;
        } else {
            $data['loadMore'] = 0;
        }
        $data['nextOffset'] = $offset+1;
        $data['ifTabs'] =2;
        $html = $this->load->view('user/profile/friend-feeds', $data, true);
        echo $html;
    }

    public function getUserDocuments(){

        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $friend_id = $this->input->post('friend_id'); 
        $offset     = $this->input->post('count'); 
        $count      = $offset*10; 

        $chk_if_friend = $this->db->get_where($this->db->dbprefix('friends'), array('user_id'=>$user_id, 'peer_id' => $friend_id))->row_array(); 

        $chk_if_follow = $this->db->get_where($this->db->dbprefix('follow_master'), array('user_id'=>$user_id, 'peer_id' => $friend_id))->row_array();

        $data['friend_id']      = $friend_id;
        $data['chk_if_friend']  = $chk_if_friend;
        $data['chk_if_follow']  = $chk_if_follow; 
        
        $this->db->select('reference_master.*,');
        $this->db->from('reference_master');
        $this->db->where("reference_master.status",1);
        $this->db->where("reference_master.reference",'document');
        $this->db->where("reference_master.user_id",$friend_id);
        
        $total_feeds = $this->db->get()->num_rows();

        $this->db->select('reference_master.*,');
        $this->db->from('reference_master');
        $this->db->where("reference_master.status",1);
        $this->db->where("reference_master.reference",'document');
        $this->db->where("reference_master.user_id",$friend_id);
        
        $this->db->limit(10, $count);
        $this->db->order_by('reference_master.id', 'desc');
        $data['feeds'] = $this->db->get()->result_array(); 
        // echo $this->db->last_query();die;
        if($count+10 < $total_feeds){
            $data['loadMore'] = 1;
        } else {
            $data['loadMore'] = 0;
        }
        $data['nextOffset'] = $offset+1;
        $data['ifTabs'] =3;
        $html = $this->load->view('user/profile/friend-feeds', $data, true);
        echo $html;
    }

    public function getUserStudyset(){
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $friend_id = $this->input->post('friend_id'); 
        $offset     = $this->input->post('count'); 
        $count      = $offset*10; 

        $chk_if_friend = $this->db->get_where($this->db->dbprefix('friends'), array('user_id'=>$user_id, 'peer_id' => $friend_id))->row_array(); 

        $chk_if_follow = $this->db->get_where($this->db->dbprefix('follow_master'), array('user_id'=>$user_id, 'peer_id' => $friend_id))->row_array();

        $data['friend_id']      = $friend_id;
        $data['chk_if_friend']  = $chk_if_friend;
        $data['chk_if_follow']  = $chk_if_follow; 
        
        $this->db->select('reference_master.*,');
        $this->db->from('reference_master');
        $this->db->where("reference_master.status",1);
        $this->db->where("reference_master.reference",'studyset');
        $this->db->where("reference_master.user_id",$friend_id);
        
        $total_feeds = $this->db->get()->num_rows();

        $this->db->select('reference_master.*,');
        $this->db->from('reference_master');
        $this->db->where("reference_master.status",1);
        $this->db->where("reference_master.reference",'studyset');
        $this->db->where("reference_master.user_id",$friend_id);
        
        $this->db->limit(10, $count);
        $this->db->order_by('reference_master.id', 'desc');
        $data['feeds'] = $this->db->get()->result_array(); 
        // echo $this->db->last_query();die;
        if($count+10 < $total_feeds){
            $data['loadMore'] = 1;
        } else {
            $data['loadMore'] = 0;
        }
        $data['nextOffset'] = $offset+1;
        $data['ifTabs'] =4;
        $html = $this->load->view('user/profile/friend-feeds', $data, true);
        echo $html;
    }

    public function getUserEvents(){
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $friend_id = $this->input->post('friend_id'); 
        $offset     = $this->input->post('count'); 
        $count      = $offset*10; 

        $chk_if_friend = $this->db->get_where($this->db->dbprefix('friends'), array('user_id'=>$user_id, 'peer_id' => $friend_id))->row_array(); 

        $chk_if_follow = $this->db->get_where($this->db->dbprefix('follow_master'), array('user_id'=>$user_id, 'peer_id' => $friend_id))->row_array();

        $data['friend_id']      = $friend_id;
        $data['chk_if_friend']  = $chk_if_friend;
        $data['chk_if_follow']  = $chk_if_follow; 
        
        $this->db->select('reference_master.*,');
        $this->db->from('reference_master');
        $this->db->where("reference_master.status",1);
        $this->db->where("reference_master.reference",'event');
        $this->db->where("reference_master.user_id",$friend_id);
        
        $total_feeds = $this->db->get()->num_rows();

        $this->db->select('reference_master.*,');
        $this->db->from('reference_master');
        $this->db->where("reference_master.status",1);
        $this->db->where("reference_master.reference",'event');
        $this->db->where("reference_master.user_id",$friend_id);
        
        $this->db->limit(10, $count);
        $this->db->order_by('reference_master.id', 'desc');
        $data['feeds'] = $this->db->get()->result_array(); 
        // echo $this->db->last_query();die;
        if($count+10 < $total_feeds){
            $data['loadMore'] = 1;
        } else {
            $data['loadMore'] = 0;
        }
        $data['nextOffset'] = $offset+1;
        $data['ifTabs'] =5;
        $html = $this->load->view('user/profile/friend-feeds', $data, true);
        echo $html;
    }

	public function timeline()
	{
		is_valid_logged_in();
		$user_id = $this->session->get_userdata()['user_data']['user_id'];
		$query = $this->db->query('SELECT * from reference_master WHERE user_id = '.$user_id.' ORDER BY id DESC');
		$result = $query->result_array();
		$all_posts_array = [];
		foreach($result as $res){
			$post_query = $this->db->query('SELECT * from posts where id = '.$res['reference_id'])->row();
			$post_images_query = $this->db->query('SELECT * from post_images where post_id = '.$res['reference_id'])->result_array();
			$post_videos_query = $this->db->query('SELECT * from post_videos where post_id = '.$res['reference_id'])->result_array();
			$post_options_query = $this->db->query('SELECT * from post_poll_options where post_id = '.$res['reference_id'])->result_array();
			$post_documents_query = $this->db->query('SELECT * from post_documents where post_id = '.$res['reference_id'])->result_array();
			$post_comments_query = $this->db->query('SELECT * from comment_master As a INNER JOIN user As b ON a.user_id = b.id where a.reference_id = '.$res['reference_id'])->result_array();
			$all_posts_array[$res['id']]['post_details'] = $post_query;
			$all_posts_array[$res['id']]['post_images'] = $post_images_query;
			$all_posts_array[$res['id']]['post_videos'] = $post_videos_query;
			$all_posts_array[$res['id']]['post_poll_options'] = $post_options_query;
			$all_posts_array[$res['id']]['post_documents'] = $post_documents_query;
			$all_posts_array[$res['id']]['post_comments'] = $post_comments_query;
		}
		//all followers
		$followers = $this->db->query('SELECT COUNT(*) As total from follow_master where peer_id = '.$user_id)->row_array();
		//all followings
		$followings = $this->db->query('SELECT COUNT(*) As total from follow_master where user_id = '.$user_id)->row_array();

		/*$friends_to = $this->db->query('SELECT *, a.id As peer_master_id from peer_master As a INNER JOIN user As b ON a.peer_id = b.id WHERE a.user_id = '.$user_id.' AND (a.status = 2) ORDER BY a.id DESC')->result_array();
		$friends_from = $this->db->query('SELECT *, a.id As peer_master_id  from peer_master As a INNER JOIN user As b ON a.user_id = b.id WHERE a.peer_id = '.$user_id.' AND (a.status = 2) ORDER BY a.id DESC')->result_array();
		$peer_to = array_merge($friends_to, $friends_from);*/
		$peer_to = $this->db->query('SELECT *, a.id As friends_id from friends As a INNER JOIN user As b ON a.peer_id = b.id WHERE a.user_id ='.$user_id)->result_array();
		$peer_from = $this->db->query('SELECT *, c.id As notify_id, a.id As action_id from peer_master As a INNER JOIN user As b ON a.user_id = b.id INNER JOIN notification_master As c ON a.id = c.action_id WHERE a.peer_id = '.$user_id.' AND (a.status = 1) ORDER BY a.id DESC')->result_array();

		$blocked_users = $this->db->query('SELECT * from blocked_peers As a INNER JOIN user As b ON a.peer_id = b.id WHERE a.user_id = '.$user_id)->result_array();
		$data['blocked_users'] = $blocked_users;
		$data['all_connections'] = $peer_to;
		$data['all_requests'] = $peer_from;
		$data['all_posts'] = $all_posts_array;
		$data['connections'] = count($peer_to);
		$data['requests'] = count($peer_from);
		$data['followers'] = $followers['total'];
		$data['followings'] = $followings['total'];
		$data['index_menu']  = 'timeline';
		$data['title']  = 'Timeline | Studypeers';
		$this->load->view('user/profile/layouts/header', $data);
		$this->load->view('user/profile/timeline');
		$this->load->view('user/profile/add-post');
		$this->load->view('user/profile/post-privacy');
		$this->load->view('user/profile/add-profile-picture-modal');
		$this->load->view('user/profile/add-cover-picture-modal');
		$this->load->view('user/profile/layouts/footer');
	}

	public function savePost()
	{
		$all_posts = $this->input->post();
		$this->load->helper(array('form', 'url'));
		is_valid_logged_in();
		$config['upload_path'] = './uploads/posts/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|mp4|3gp|avi|mov|pdf|xlsx|xls|doc|docx|txt|ppt|pptx';
		$config['encrypt_name'] = TRUE;
		$config['remove_spaces']=TRUE;  //it will remove all spaces
		$user_id = $this->session->get_userdata()['user_data']['user_id'];
		$html_content = $this->input->post('html_content');
		$privacy = $this->input->post('privacy');
		$allow_comment = $this->input->post('allow_comment');
		$is_comment_on = 0;

		if($allow_comment == 'on'){
			$is_comment_on = 1;
		}
		$insertArr = array(
			'post_content_html' 	=> $html_content,
			'privacy_id'   			=> $privacy,
			'is_comment_on'    		=> $is_comment_on,
			'created_by'        	=> $user_id,
			'created_at'    		=> date('Y-m-d H:i:s'),
			'updated_at'    		=> date('Y-m-d H:i:s')
		);
		$insert_result = $this->db->insert('posts', $insertArr);
		$inserted_post_id = $this->db->insert_id();
		$this->load->library('upload', $config);

		$this->upload->initialize($config);
		$F = array();
		$count_uploaded_files = count( $_FILES['file']['name'] );
		$files = $_FILES;
		$image_extensions_arr = array('jpg', 'image/jpg', 'image/jpeg', 'image/png' , 'jpeg' , 'png' );
		$video_extensions_arr = array("mp4","avi","3gp","mov","mpeg","video/mp4", "video/mov", "video/avi", "video/3gp", "video/mpeg");
		$document_extension_arr = array('pdf', 'xls', 'xlsx', 'doc', 'docx', 'ppt', 'pptx', 'txt');
		$maxsize = 5242880; // 5MB
		for( $i = 0; $i < $count_uploaded_files; $i++ )
		{
			$file_type = $files['file']['type'][$i];
			if($files['file']['size'][$i] > $maxsize){
				echo 'file size is too large';
				die;
			}
			// Check extension
				$_FILES['userfile'] = [
						'name'     => $files['file']['name'][$i],
						'type'     => $files['file']['type'][$i],
						'tmp_name' => $files['file']['tmp_name'][$i],
						'error'    => $files['file']['error'][$i],
						'size'     => $files['file']['size'][$i]
				];
				$original_name = $files['file']['name'][$i];
				if($this->upload->do_upload('userfile'))
				{
					$data = $this->upload->data();
					$F[] = $data["file_name"];
					if(in_array($file_type, $image_extensions_arr)){
						$this->upload_model->save_image($inserted_post_id, '/uploads/posts/'.$data["file_name"], $file_type);
					}elseif(in_array($file_type, $video_extensions_arr)){
						$this->upload_model->save_video($inserted_post_id, '/uploads/posts/'.$data["file_name"], $file_type);
					}else{
						$this->upload_model->save_document($inserted_post_id, '/uploads/posts/'.$data["file_name"], $file_type, $original_name);
					}
				}
		}

		//save poll data
		$poll_data = $_POST['option'];
		if(count($poll_data) > 0){
			foreach($poll_data as $value) {
				if(!empty($value)){
					$qtyOut = $value;
					//insert in polls table
					$insert_polls = array(
						'post_id' => $inserted_post_id,
						'options' => $value,
						'status' => 1,
						'created_at' => date('Y-m-d H:i:s'),
						'updated_at' => date('Y-m-d H:i:s')
					);
					$insert_reference = $this->db->insert('post_poll_options', $insert_polls);
				}

			}
		}

		//insert in reference_master table
		$insert_reference = array(
				'reference' => 'Post',
				'reference_id' => $inserted_post_id,
				'user_id' => $user_id,
				'status' => 1,
				'addDate' => date('Y-m-d H:i:s'),
				'modifyDate' => date('Y-m-d H:i:s')
		);
		$insert_reference = $this->db->insert('reference_master', $insert_reference);
		echo $insert_reference;
	}

	public function redirect_page(){
		if($this->input->get('result') == 1){
			$message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Posts Added Successfully.<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
			$this->session->set_flashdata('flash_message', $message);
			redirect(site_url('Profile/timeline'), 'refresh');
		}else{
			$message = '<div class="alert alert-danger" role="alert"><strong>Error!</strong> Error in adding posts.<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
			$this->session->set_flashdata('flash_message', $message);
			redirect(site_url('Profile/timeline'), 'refresh');
		}
	}


	public function uploadProfilePicture()
	{
		$userdata = $this->session->userdata('user_data');
		$base_64_image = $_POST['image'];
		$image_array_1 = explode(";", $base_64_image);
		$image_array_2 = explode(",", $image_array_1[1]);
		$data = base64_decode($image_array_2[1]);
		$imageName = time() . '.png';
		file_put_contents('uploads/users/'.$imageName, $data);
		$upload_result = $this->upload_model->save_profile_picture($userdata['user_id'], $imageName);
		echo $upload_result;
	}

	public function uploadCoverPicture()
	{
		$userdata = $this->session->userdata('user_data');
		$base_64_image = $_POST['image'];
		$image_array_1 = explode(";", $base_64_image);
		$image_array_2 = explode(",", $image_array_1[1]);
		$data = base64_decode($image_array_2[1]);
		$imageName = time() . '.png';
		file_put_contents('uploads/users/cover/'.$imageName, $data);
		$upload_result = $this->upload_model->save_cover_picture($userdata['user_id'], $imageName);
		echo $upload_result;
	}


	public function friends()
	{
		is_valid_logged_in();
		$user_id = $_REQUEST['profile_id'];
		$login_user_id = $this->session->get_userdata()['user_data']['user_id'];

		//check if user is reported by same user
		$chk_if_reprted = $this->db->get_where($this->db->dbprefix('user_report_master'), array('user_id'=>$login_user_id, 'report_user_id' => $user_id, 'status' => 1))->row_array(); 


		//check if user is friend of same user
		$chk_if_friend = $this->db->get_where($this->db->dbprefix('friends'), array('user_id'=>$login_user_id, 'peer_id' => $user_id))->row_array(); 

		//check if user is friend of same user
		$chk_if_follow = $this->db->get_where($this->db->dbprefix('follow_master'), array('user_id'=>$login_user_id, 'peer_id' => $user_id))->row_array(); 


		//check if user is blocked by same user
		$check_query = $this->db->query('SELECT * from blocked_peers WHERE user_id = '.$login_user_id.' AND peer_id = '.$user_id)->row_array();
		if(isset($check_query) && !empty($check_query)){
			redirect(site_url('Profile/timeline'), 'refresh');
		}

		//all followers
		$followers = $this->db->query('SELECT COUNT(*) As total from follow_master where peer_id = '.$user_id)->row_array();
		//all followings
		$followings = $this->db->query('SELECT COUNT(*) As total from follow_master where user_id = '.$user_id)->row_array();

		$query = $this->db->query('SELECT * from reference_master WHERE user_id = '.$user_id.' ORDER BY id DESC');
		$user_details = $this->db->query('SELECT * from user As a INNER JOIN user_info As b ON a.id = b.userID WHERE a.id = '.$user_id.'');
		$result = $query->result_array();
		$all_posts_array = [];
		foreach($result as $res){
			$post_query = $this->db->query('SELECT * from posts where id = '.$res['reference_id'])->row();
			$post_images_query = $this->db->query('SELECT * from post_images where post_id = '.$res['reference_id'])->result_array();
			$post_videos_query = $this->db->query('SELECT * from post_videos where post_id = '.$res['reference_id'])->result_array();
			$post_options_query = $this->db->query('SELECT * from post_poll_options where post_id = '.$res['reference_id'])->result_array();
			$post_documents_query = $this->db->query('SELECT * from post_documents where post_id = '.$res['reference_id'])->result_array();
			$all_posts_array[$res['id']]['post_details'] = $post_query;
			$all_posts_array[$res['id']]['post_images'] = $post_images_query;
			$all_posts_array[$res['id']]['post_videos'] = $post_videos_query;
			$all_posts_array[$res['id']]['post_poll_options'] = $post_options_query;
			$all_posts_array[$res['id']]['post_documents'] = $post_documents_query;
		}
		$login_user_id = $this->session->get_userdata()['user_data']['user_id'];
		$request_query = $this->db->query('SELECT * from peer_master WHERE user_id = '.$login_user_id.' AND peer_id = '.$user_id.' AND status = 1')->row_array();
		$is_request_sent = true;
		if(empty($request_query)){
			$is_request_sent = false;
		}
		$data['all_posts'] = $all_posts_array;
		$data['index_menu']  = 'timeline';
		$data['title']  = 'Timeline | Studypeers';
		$data['user'] = $user_details->row_array();
		$data['user_id'] = $user_id;
		$data['is_request_sent'] = $is_request_sent;
		$data['chk_if_reported']  = $chk_if_reprted;
		$data['chk_if_friend']  = $chk_if_friend;
		$data['chk_if_follow']  = $chk_if_follow;
		$data['followers'] = $followers['total'];
		$data['followings'] = $followings['total'];
		$this->load->view('user/profile/layouts/header', $data);
		$this->load->view('user/profile/friends-timeline');
		$this->load->view('user/profile/layouts/footer');
	}

	public function updateGeneralInfo(){
		try {
			$userdata = $this->session->userdata('user_data');
			$location_txt   = $this->input->post('location');
			$url = "https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($location_txt)."&key=AIzaSyBNNCJ7_zDBYPIly-R1MJcs9zLUBNEM6eU";
                        
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
            $responseJson = curl_exec($ch);
            curl_close($ch);

            $response = json_decode($responseJson); 
            
            if ($response->status == 'OK') {
                $latitude = $response->results[0]->geometry->location->lat;
                $longitude = $response->results[0]->geometry->location->lng;
            } else {
                $latitude = 0;
                $longitude = 0;
            }
			$users_array = [
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name')
				];
			$user_info_array = [
				'gender' => $this->input->post('gender'),
				'dob' => $this->input->post('dob'),
				'user_location' => $location_txt,
				'user_latitude' => $latitude,
				'user_longitude' => $longitude,
				'field_interest' => $this->input->post('field_of_interest')
			];

			$this->db->where(array('id' => $userdata['user_id']));
			$this->db->update('user',$users_array);
			$this->db->where(array('userID' => $userdata['user_id']));
			$this->db->update('user_info',$user_info_array);
			redirect(site_url('Profile/timeline'));

		} catch (\Exception $e) {
			var_dump($e->getMessage());
		}
	}


	public function updateAboutInfo(){
		$userdata = $this->session->userdata['user_data'];
		$this->db->where(array('id' => $userdata['user_id']));
		$this->db->update('user',array('about' => $this->input->post('about_me')));
		$this->db->where(array('userID' => $userdata['user_id']));
		$this->db->update('user_info',array('high_school' => $this->input->post('high_school') , 'high_school_course_name' => $this->input->post('course_name'), 'high_school_course_year' => $this->input->post('course_year')));
		redirect(site_url('Profile/timeline'));
	}


	public function updateSocialInfo(){
		$userdata = $this->session->userdata['user_data'];
		$this->db->where(array('userID' => $userdata['user_id']));
		$this->db->update('user_info',array(
			'fb_link' => $this->input->post('facebook_link') ,
			'twitter_link' => $this->input->post('twitter_link'),
			'linkedIn_link' => $this->input->post('linkedin_link'),
			'youtube_link' => $this->input->post('youtube_link')
		));
		redirect(site_url('Profile/timeline'));

	}

	public function searchFriends()
	{
		$userdata = $this->session->userdata('user_data');
		$search_term = $this->input->get('keyword');
		$is_friend = $this->input->get('is_friend');
		$status = 2;
		if($is_friend){
			$status = 2;
			$query = $this->db->query('SELECT *, b.id As friend_id from friends As a INNER JOIN user As b ON a.peer_id = b.id WHERE a.user_id = '.$userdata['user_id'].' AND (b.first_name like "%'.$search_term.'%" OR b.username like "%'.$search_term.'%" ) ORDER BY a.id DESC');
			$result = $query->result_array();
		}else{
			$status = 1;
			$query = $this->db->query('SELECT *, b.id As friend_id from peer_master As a INNER JOIN user As b ON a.user_id = b.id WHERE a.peer_id = '.$userdata['user_id'].' AND a.status = '.$status.' AND (b.first_name like "%'.$search_term.'%" OR b.username like "%'.$search_term.'%" ) ORDER BY a.id DESC');
			$result = $query->result_array();
		}
		//

		echo json_encode($result);
	}

	public function follow()
	{
		if($this->input->post()){
			$peer_id    = $this->input->post('peer_id');
			$user_id = $this->session->get_userdata()['user_data']['user_id'];
			$insert_data = array(
				'user_id'       => $user_id,
				'peer_id'       => $peer_id
			);
			$this->db->insert('follow_master', $insert_data);

			echo true;
		}
	}

	public function unfollow()
	{
		if($this->input->post()){
			$peer_id    = $this->input->post('peer_id');
			$user_id = $this->session->get_userdata()['user_data']['user_id'];
			$check = array(
				'user_id'       => $user_id,
				'peer_id'       => $peer_id
			);
			$this->db->where($check);
			$this->db->delete('follow_master');
			echo true;
		}
	}

	public function unfriend()
	{
		if($this->input->post()){
			$friends_id    = $this->input->post('friends_id');
			$friend_detail = $this->db->query('SELECT * from friends WHERE id = '.$friends_id)->row_array();
			//delete from friends table
			$this->db->where(array('user_id' => $friend_detail['user_id'], 'peer_id' => $friend_detail['peer_id']));
			$this->db->delete('friends');
			$this->db->where(array('user_id' => $friend_detail['peer_id'], 'peer_id' => $friend_detail['user_id']));
			$this->db->delete('friends');
			$this->db->where(array('user_id'=> $friend_detail['user_id'], 'peer_id' => $friend_detail['peer_id']))->delete('peer_master');
			$this->db->where(array('peer_id'=> $friend_detail['user_id'], 'user_id' => $friend_detail['peer_id']))->delete('peer_master');
			redirect(site_url('Profile/timeline?tab=peers'));
		}
	}

	public function saveLikes()
	{
		if($this->input->post()){
			$reference_id = $this->input->post('reference_id');
			$like_option_id = $this->input->post('like_option_id');
			$user_id = $this->session->get_userdata()['user_data']['user_id'];

			//get post id from reference_master table
			$reference_master = $this->db->query('SELECT * from reference_master WHERE id = '.$reference_id);
			$result = $reference_master->row_array();

			$post_detail = $this->db->query('SELECT * from posts WHERE id = '.$result['reference_id']);
			$post_result = $post_detail->row_array();

			//check is same user already liked the post
			$check_row_exists = $this->db->where(array('reference_id' => $reference_id, 'user_id' => $user_id))->row_array();
			if(!isset($check_row_exists)){
				$like_count_increment = $post_result['likes_count'] + 1;
				$this->db->where(array('id' => $result['reference_id']));
				$this->db->update('posts',array('likes_count' => $like_count_increment));
			}
			$like_count_increment = $post_result['likes_count'];

			//delete old reaction from like master table if exists
			$this->db->where(array('reference_id' => $reference_id, 'like_option_id' => $like_option_id, 'user_id' => $user_id));
			$this->db->delete('like_master');
			//insert new entry of like
			$insert_array = [
				'reference' => 'Post',
				'reference_id' => $result['reference_id'],
				'like_option_id' => $like_option_id,
				'user_id' => $user_id,
				'status' => 1,
				'created_at' => date('Y-m-d H:i:s')
			];
			$insert_like = $this->db->insert('like_master', $insert_array);
			echo $like_count_increment;
		}
	}

	public function saveComment(){
		if($this->input->post()) {
			$reference_id = $this->input->post('reference_id');
			$comment = $this->input->post('comment');
			$parent_id = $this->input->post('parent_id');
			$user_id = $this->session->get_userdata()['user_data']['user_id'];

			//get post id from reference_master table
			$reference_master = $this->db->query('SELECT * from reference_master WHERE id = '.$reference_id);
			$result = $reference_master->row_array();

			$insert_array = [
				'comment_parent_id' => $parent_id,
				'reference' => 'Post',
				'reference_id' => $result['reference_id'],
				'user_id' => $user_id,
				'type' => 0,
				'comment' => $comment,
				'status' => 1,
				'created_at' => date('Y-m-d H:i:s')
			];
			$insert_comment = $this->db->insert('comment_master', $insert_array);
			$insert_id = $this->db->insert_id();
			//get comment detail
			$comment_detail = $this->db->query('SELECT * from comment_master As a INNER JOIN user As b ON a.user_id = b.id WHERE a.id = '.$insert_id)->row_array();


			$post_detail = $this->db->query('SELECT * from posts WHERE id = '.$result['reference_id']);
			$post_result = $post_detail->row_array();
			$comment_count_increment = $post_result['comments_count'] + 1;
			$this->db->where(array('id' => $result['reference_id']));
			$this->db->update('posts',array('comments_count' => $comment_count_increment));
			//echo $comment_count_increment;
			$comment_detail['counter'] = $comment_count_increment;
			echo json_encode($comment_detail);
		}
	}


	public function getUsersImageViaAjax()
	{
		if($this->input->post()) {
			$user_id = $this->input->post('user_id');
			$response['image'] = userImage($user_id);
			$response['id'] = $user_id;
			echo json_encode($response);
		}
	}

	public function blockPeer(){
		if($this->input->post()){
			$peer_id    = $this->input->post('friend_id');
			$reason    = '';
			$user_id = $this->session->get_userdata()['user_data']['user_id'];
			$insert_array = array(
				'user_id'       => $user_id,
				'peer_id'       => $peer_id,
				'reason'		=> trim($reason)
			);
			$insert_comment = $this->db->insert('blocked_peers', $insert_array);

			$check = array(
				'user_id'       => $user_id,
				'peer_id'       => $peer_id
			);
			$this->db->where($check);
			$this->db->delete('friends');

			$this->db->where($check);
			$this->db->delete('follow_master');

			$check2 = array(
				'user_id'       => $peer_id,
				'peer_id'       => $user_id
			);
			$this->db->where($check2);
			$this->db->delete('friends');

			$this->db->where($check2);
			$this->db->delete('follow_master');


			redirect(site_url('Profile/friends?profile_id='.$peer_id), 'refresh');
		}
	}

	public function unblockPeer(){
		if($this->input->post()){
			$peer_id    = $this->input->post('peer_id');
			$user_id = $this->session->get_userdata()['user_data']['user_id'];
			$check = array(
				'user_id'       => $user_id,
				'peer_id'       => $peer_id
			);
			$this->db->where($check);
			$this->db->delete('blocked_peers');
			echo true;
		}
	}

	public function reportUser(){
		if($this->input->post()){
			$report_user_id    = $this->input->post('report_user_id');
			$user_id = $this->session->get_userdata()['user_data']['user_id'];
			$report_reason = $this->input->post('report_reason');
			$report_description = $this->input->post('report_description');

			$insert_array = array(
				'user_id'       => $user_id,
				'report_user_id'       => $report_user_id,
				'report_reason'		=> trim($report_reason),
				'report_description'		=> trim($report_description),
				'status' => 1,
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			);
			$this->db->insert('user_report_master', $insert_array);

			redirect(site_url('Profile/friends?profile_id='.$report_user_id), 'refresh');
		}
	}

	public function cancelUserReport(){
		if($this->input->post()){
			$report_id    = $this->input->post('report_id');
			$user_id = $this->session->get_userdata()['user_data']['user_id'];
			$report_user_id = $this->input->post('report_user_id');
			
			$update_arr = array(
				'status'       => 3,
				'updated_at' => date('Y-m-d H:i:s')
			);
			$this->db->where(array('id' => $report_id));
			$this->db->update('user_report_master',$update_arr);
			
			redirect(site_url('Profile/friends?profile_id='.$report_user_id), 'refresh');
		}
	}

}
