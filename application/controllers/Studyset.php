<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

// Studyset Controller
class Studyset extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct() {
        
        parent::__construct();
        $this->load->model('studyset_model');
        $this->load->library('upload');
        is_valid_logged_in(); 
        $this->data = array("index_menu" => 'study-sets', "title" => 'Study-sets | Studypeers');
        
    }
	public function index()
	{ 
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['userdata'] = $this->studyset_model->getUserData($user_id);
        
        $data['courses'] = $this->studyset_model->getCourseData($user_id);
        $data['studysets'] = $this->studyset_model->getStudySets($user_id);
        $data['total_study_sets'] = $this->studyset_model->getTotalStudySets($user_id);
        //print_r($data['studysets']);die;
        $this->load->view('user/include/header', $this->data);
        $this->load->view('studyset/study-sets',$data);
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/footer');
	}

    public function manage($study_set_id = 0)
    {
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['userdata'] = $this->studyset_model->getUserData($user_id);
        $data['courses'] = $this->studyset_model->getCourseData($user_id);
        $data['study_set_id'] = $study_set_id;
        if($study_set_id > 0){
            $data['studyset_data'] = $this->studyset_model->getStudySetData($study_set_id);
        }

        $this->load->view('user/include/header', $this->data);
        $this->load->view('studyset/manage-study-set',$data);
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/footer');
    }

    public function loadStudySetData(){
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['studysets'] = $this->studyset_model->getStudySets($user_id);
        $html = $this->load->view('studyset/study-set-listing', $data, true);
        echo $html;
    }

    public function details($study_set_id)
    {
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['studyset'] = $this->studyset_model->getStudySetDetails($study_set_id,$user_id);
        $data['term_data'] = $this->studyset_model->getStudySetTermData($study_set_id);
        $this->load->view('user/include/header', $this->data);
        $this->load->view('studyset/study-set-detail',$data);
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/footer');
    }

    public function deleteStudySet()
    {
        $study_set_id = $this->input->post('study_set_id');
        return $this->studyset_model->deleteStudySet($study_set_id);
    }

    public function reportStudySet()
    {
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $study_set_id = $this->input->post('study_set_id');
        $report_data = array(
                                "study_set_id" => $study_set_id,
                                "user_id" => $user_id,
                                "report_reason" => $this->input->post('report_reason'),
                                "report_description" => $this->input->post('report_description'),
                                "created_at" => date("Y-m-d H:i:s"),
                                "updated_at" => date("Y-m-d H:i:s"),
                                "status" => 1
                            );
        
        echo $this->studyset_model->reportStudySet($study_set_id,$user_id,$report_data);
    }

    public function manageStudySet($study_set_id = 0)
    {
        //echo "<pre>";
        // print_r($_POST);
        // print_r($_FILES);die;
        $study_set_id = $this->input->post('study_set_id');
        $name = $this->input->post('name');
        $course = $this->input->post('course');
        $institution = $this->input->post('institution');
        $professor = $this->input->post('professor');
        $subject = $this->input->post('subject');
        $unit = $this->input->post('unit');
        $chapter = $this->input->post('chapter');
        $user_id = $this->session->get_userdata()['user_data']['user_id'];

        $study_set_arr = array  (
                                    "study_set_id" => $study_set_id,
                                    "user_id" => $user_id,
                                    "name" => $name,
                                    "course" => $course,
                                    "institution" => $institution,
                                    "professor" => $professor,
                                    "subject" => $subject,
                                    "unit" => $unit,
                                    "chapter" => $chapter
                                );
        
        if (isset($_FILES['featured_image']) && !empty($_FILES['featured_image']['name'])) {
            $study_set_arr['image'] = $this->uploadImg('featured_image','studyset');
        }
        
        //print_r($study_set_arr);
        $study_set_id = $this->studyset_model->manageStudySet($study_set_arr);

        $files = array();
        if(($_FILES['term_image']['name'][0]))
        {
            $files = $this->upload_files($_FILES['term_image'],'studyset');
        }

        $term_array = array();
        $study_set_term_id = $this->input->post('study_set_term_id');
        $term_name = $this->input->post('term_name');
        $term_description = $this->input->post('term_description');
        foreach ($term_name as $key => $value) {
            $term = array(
                            "study_set_term_id" =>  $study_set_term_id[$key],
                            "study_set_id" => $study_set_id,
                            "term_name" => $value,
                            "term_description" => $term_description[$key]
                        );
            if(isset($files[$key]) && $files[$key] != '') {
                $term['term_image'] = $files[$key];
            }

            array_push($term_array,$term);
        }

        //print_r($term_array);die;
        $result = $this->studyset_model->manageStudySetTerms($term_array);

        redirect("/studyset");

    }

    function getProfessors() {
        $course_id = $this->input->post('course_id');
        echo $this->studyset_model->getProfessors($course_id);
    }

    public function uploadImg($filename,$foldername) 
    {
        $imagename  = time();
        $config['upload_path']      = 'uploads/'.$foldername.'/';
        $config['allowed_types']    = 'jpg|png|jpeg|gif';
        $config['max_size'] = '20000';
        $config['remove_spaces'] = true;
        $config['overwrite'] = false;
        $config['encrypt_name'] = true;
        $config['max_width']  = '';
        $config['max_height']  = '';
        $this->upload->initialize($config);

        // $this->load->library('upload', $config);

        if ($this->upload->do_upload($filename)) {
            $image_data = $this->upload->data();             
            $image_name = $image_data['file_name'];
        }

        if (!empty($image_name)) {
            $img = $image_name;
        } else {
            $img = 'default.png';
        }
        return $img;
    }

    public function upload_files($files,$foldername)
    {
        $config['upload_path'] = 'uploads/'.$foldername.'/';
        $config['allowed_types'] = 'jpg|png|jpeg|gif';
        $config['max_size'] = '20000';
        $config['remove_spaces'] = true;
        $config['overwrite'] = false;
        $config['encrypt_name'] = true;
        $config['max_width']  = '';
        $config['max_height']  = '';
        $this->load->library('upload', $config);


        $images = array();
        
        foreach ($files['name'] as $key => $image) {
            $_FILES['images[]']['name']= $files['name'][$key];
            $_FILES['images[]']['type']= $files['type'][$key];
            $_FILES['images[]']['tmp_name']= $files['tmp_name'][$key];
            $_FILES['images[]']['error']= $files['error'][$key];
            $_FILES['images[]']['size']= $files['size'][$key];

            $fileName = time() .'_'.$key.'_'. $image;

            $config['file_name'] = $fileName;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('images[]')) {
                $image_data = $this->upload->data();             
                $images[] = $image_data['file_name'];
            } else {
                $images[] = '';
            }
        }

        return $images;
    }

    public function manageLikes(){
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $result = $this->studyset_model->manageLikes($user_id);
        echo $result;
    }

    public function flashcards($study_set_id)
    {
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['studyset'] = $this->studyset_model->getStudySetDetails($study_set_id,$user_id);
        $data['term_data'] = $this->studyset_model->getStudySetTermData($study_set_id);
        $this->load->view('user/include/header', $this->data);
        $this->load->view('studyset/flashcards',$data);
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/footer');
    }

    public function learn($study_set_id)
    {
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['studyset'] = $this->studyset_model->getStudySetDetails($study_set_id,$user_id);
        $data['term_data'] = $this->studyset_model->getStudySetTermData($study_set_id);
        $this->load->view('user/include/header', $this->data);
        $this->load->view('studyset/learn',$data);
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/footer');
    }

    public function match($study_set_id)
    {
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['studyset'] = $this->studyset_model->getStudySetDetails($study_set_id,$user_id);
        $data['term_data'] = $this->studyset_model->getStudySetTermData($study_set_id);
        $this->load->view('user/include/header', $this->data);
        $this->load->view('studyset/match',$data);
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/footer');
    }

    public function write($study_set_id)
    {
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['studyset'] = $this->studyset_model->getStudySetDetails($study_set_id,$user_id);
        $data['term_data'] = $this->studyset_model->getStudySetTermData($study_set_id);
        $this->load->view('user/include/header', $this->data);
        $this->load->view('studyset/write',$data);
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/footer');
    }

    public function test($study_set_id)
    {
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['studyset'] = $this->studyset_model->getStudySetDetails($study_set_id,$user_id);
        $data['term_data'] = $this->studyset_model->getStudySetTermData($study_set_id);
        $this->load->view('user/include/header', $this->data);
        $this->load->view('studyset/test',$data);
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/footer');
    }
}
