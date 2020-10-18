<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function timeline()
	{
		is_valid_logged_in();
		$user_id = $this->session->get_userdata()['user_data']['user_id'];
		$users_posts = $this->db->get_where('posts', array('created_by' => $user_id))->result_array();
		$data['all_posts'] = $users_posts;
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
		is_valid_logged_in();
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
		$status = $insert_result;
		echo $status;
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
