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
			$all_posts_array[$res['id']]['post_details'] = $post_query;
			$all_posts_array[$res['id']]['post_images'] = $post_images_query;
			$all_posts_array[$res['id']]['post_videos'] = $post_videos_query;
			$all_posts_array[$res['id']]['post_poll_options'] = $post_options_query;
		}

		$data['all_posts'] = $all_posts_array;
		$data['index_menu']  = 'timeline';
		$data['title']  = 'Timeline | Studypeers';
		$this->load->view('user/profile/layouts/header', $data);
		$this->load->view('user/profile/timeline');
		$this->load->view('user/profile/add-post');
		$this->load->view('user/profile/post-privacy');
		$this->load->view('user/profile/layouts/footer');
	}

	public function savePost()
	{
		$all_posts = $this->input->post();
		$this->load->helper(array('form', 'url'));
		is_valid_logged_in();
		$config['upload_path'] = './uploads/posts/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|mp4|3gp|avi';
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
		$video_extensions_arr = array("mp4","avi","3gp","mov","mpeg");
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
				if($this->upload->do_upload('userfile'))
				{
					$data = $this->upload->data();
					$F[] = $data["file_name"];
					if(in_array($file_type, $image_extensions_arr)){
						$this->upload_model->save_image($inserted_post_id, '/uploads/posts/'.$data["file_name"]);
					}else{
						$this->upload_model->save_video($inserted_post_id, '/uploads/posts/'.$data["file_name"]);
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


}
