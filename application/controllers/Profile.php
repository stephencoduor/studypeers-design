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


		$query = $this->db->query('SELECT *, a.id AS postId FROM posts As a LEFT JOIN post_images As b On a.id = b.post_id WHERE a.created_by = '.$user_id);
		$result_array = $query->result_array();
		$users_post = array();
		foreach($result_array as $result){
			if(array_key_exists($result['postId'], $users_post)){
				$users_post[$result['postId']]['images'][] = $result['image_path'];
			}else{
				$users_post[$result['postId']] = $result;
				$users_post[$result['postId']]['images'][] = $result['image_path'];
			}
		}
		rsort($users_post);

		//$users_posts = $this->db->get_where('posts', array('posts.created_by' => $user_id))->result_array();
		$data['all_posts'] = $users_post;
		$data['index_menu']  = 'timeline';
		$data['title']  = 'Timeline | Studypeers';

		$this->load->view('user/include/header', $data);
		$this->load->view('user/profile/timeline');
		$this->load->view('user/profile/add-post');
		$this->load->view('user/profile/post-privacy');
		$this->load->view('user/profile/layouts/footer');

		/*$this->load->view('user/include/footer');*/
	}

	public function savePost()
	{
		$this->load->helper(array('form', 'url'));
		is_valid_logged_in();
			$config['upload_path'] = './uploads/posts/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
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
		for( $i = 0; $i < $count_uploaded_files; $i++ )
		{
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
				$this->upload_model->save_upload($inserted_post_id, '/uploads/posts/'.$data["file_name"]);
			}
		}
		echo $insert_result;
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
