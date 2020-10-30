<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('upload_model');
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
			$all_posts_array[$res['id']]['post_details'] = $post_query;
			$all_posts_array[$res['id']]['post_images'] = $post_images_query;
			$all_posts_array[$res['id']]['post_videos'] = $post_videos_query;
			$all_posts_array[$res['id']]['post_poll_options'] = $post_options_query;
			$all_posts_array[$res['id']]['post_documents'] = $post_documents_query;
		}

		$peers = $this->db->query('SELECT * from peer_master As a INNER JOIN user As b ON a.peer_id = b.id WHERE a.user_id = '.$user_id.' AND (a.status = 1 OR a.status = 2)')->result_array();
		$data['peers'] = $peers;
		$data['all_posts'] = $all_posts_array;
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
		$this->load->view('user/profile/layouts/header', $data);
		$this->load->view('user/profile/friends-timeline');
		$this->load->view('user/profile/layouts/footer');
	}

}
