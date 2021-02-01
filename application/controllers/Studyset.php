<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
        // print_r($data['studysets']);die;
        $this->load->view('user/include/header', $this->data);
        $this->load->view('studyset/study-sets',$data);
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/firebase-include');
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
        $this->load->view('user/include/firebase-include');
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

        $this->db->order_by('learn_round_master.id', 'desc');
        $this->db->limit(5);
        $data['user_attempt_learn'] = $this->db->get_where('learn_round_master', array('userId' => $user_id, ' study_set_id' => $study_set_id))->result_array();

        $this->db->order_by('match_round_master.id', 'desc');
        $this->db->limit(5);
        $data['user_attempt_match'] = $this->db->get_where('match_round_master', array('userId' => $user_id, ' study_set_id' => $study_set_id))->result_array();

        $this->db->order_by('write_round_master.id', 'desc');
        $this->db->limit(5);
        $data['user_attempt_write'] = $this->db->get_where('write_round_master', array('userId' => $user_id, ' study_set_id' => $study_set_id))->result_array();

        $this->db->order_by('flashcard_round_master.id', 'desc');
        $this->db->limit(5);
        $data['user_attempt_flashcard'] = $this->db->get_where('flashcard_round_master', array('userId' => $user_id, ' study_set_id' => $study_set_id))->result_array();


        $this->db->select('learn_round_master.*, user_info.nickname');
        $this->db->join('user_info','user_info.userID=learn_round_master.userId');
        $this->db->order_by('learn_round_master.correct', 'desc');
        $this->db->limit(5);
        $data['top_rank_learn'] = $this->db->get_where('learn_round_master', array('learn_round_master.study_set_id' => $study_set_id))->result_array();

        $this->db->select('match_round_master.*, user_info.nickname');
        $this->db->join('user_info','user_info.userID=match_round_master.userId');
        $this->db->order_by('match_round_master.correct', 'desc');
        $this->db->limit(5);
        $data['top_rank_match'] = $this->db->get_where('match_round_master', array('match_round_master.study_set_id' => $study_set_id))->result_array();

        $this->db->select('write_round_master.*, user_info.nickname');
        $this->db->join('user_info','user_info.userID=write_round_master.userId');
        $this->db->order_by('write_round_master.correct', 'desc');
        $this->db->limit(5);
        $data['top_rank_write'] = $this->db->get_where('write_round_master', array('write_round_master.study_set_id' => $study_set_id))->result_array();

        $this->db->select('flashcard_round_master.*, user_info.nickname');
        $this->db->join('user_info','user_info.userID=flashcard_round_master.userId');
        $this->db->order_by('flashcard_round_master.correct', 'desc');
        $this->db->limit(5);
        $data['top_rank_flashcard'] = $this->db->get_where('flashcard_round_master', array('flashcard_round_master.study_set_id' => $study_set_id))->result_array();

        $this->db->select('studyset_rating_master.*, user_info.nickname');
        $this->db->join('user_info','user_info.userID=studyset_rating_master.user_id');
        $this->db->order_by('studyset_rating_master.created_at', 'desc');
        $this->db->limit(5);
        $data['rating_list'] = $this->db->get_where('studyset_rating_master', array('studyset_rating_master.study_set_id' => $study_set_id, 'studyset_rating_master.user_id !=' => $user_id))->result_array();


        $data['user_rating'] = $this->db->get_where('studyset_rating_master', array('studyset_rating_master.study_set_id' => $study_set_id, 'user_id' => $user_id))->row_array();

        $data['comment'] = $this->db->get_where('comment_master', array('reference' => 'studyset', 'reference_id' => $study_set_id, 'comment_parent_id' => 0))->result_array();

        $this->load->view('user/include/header', $this->data);
        $this->load->view('studyset/study-set-detail',$data);
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/firebase-include');
        $this->load->view('user/include/footer');
    }

    public function likeComment(){
        if($this->input->post()){
            $comment_id = $this->input->post('comment_id');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $chk_if_liked = $this->db->get_where('comment_like_master', array('comment_id' => $comment_id, 'user_id' => $user_id, 'status' => 1))->row_array();

            if(!empty($chk_if_liked)){

                $this->db->where(array('id' => $chk_if_liked['id']));
                $this->db->update('comment_like_master',array('status' => 3));

            } else {

                $insertArr = array( 'comment_id' => $comment_id,

                    'user_id' => $user_id,

                    'status' => '1',
                    'created_at' => date('Y-m-d H:i:s')

                );

                $this->db->insert('comment_like_master', $insertArr);
            }
            $count = $this->db->get_where('comment_like_master', array('comment_id' => $comment_id, 'status' => 1))->num_rows();
            echo $count;
        }
    }

    public function addComment(){
        if($this->input->post()){
            $comment = $this->input->post('comment');
            $studyset_id = $this->input->post('studyset_id');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $insertArr = array( 'reference' => 'studyset',
                'reference_id' => $studyset_id,
                'user_id' => $user_id,
                'comment' => $comment,
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s')

            );

            $this->db->insert('comment_master', $insertArr);
            $comment_id = $this->db->insert_id();

            $user_info = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();

            $html = '<div class="chatMsg" id="comment_id_'.$comment_id.'">
                        <figure>
                            <img src="'.base_url().'assets_d/images/ct_user.jpg" alt="User">
                        </figure>
                        <figcaption>
                            <span class="name"> '.$user_info['nickname'].'</span>
                            '.$comment.'
                            <div class="actionmsgMenu">
                                <ul>
                                    <li class="likeuser" id="likeComment'.$comment_id.'" onclick="likeComment('.$comment_id.')">Like</li>
                                    <li class="replyuser" onclick="showReplyUser('.$comment_id.')">Reply</li>
                                </ul>
                            </div>
                            <div class="reactmessage" id="reactmessage_'.$comment_id.'" style="display:none;">
                                <div class="react">
                                    <img src="'.base_url().'assets_d/images/like.png" alt="Like">
                                </div>
                                <p id="like_count_'.$comment_id.'"></p>
                            </div>
                        </figcaption>
                        <div class="dotsBullet dropdown">
                                        <img
                                            src="'.base_url().'assets_d/images/more.svg"
                                            alt="more"
                                            data-toggle="dropdown">
                                        <ul class="dropdown-menu"
                                            role="menu"
                                            aria-labelledby="menu1">
                                            <li role="presentation">
                                                <a role="menuitem"
                                                   tabindex="-1"
                                                   href="javascript:void(0);">
                                                    <div
                                                        class="left">
                                                        <img
                                                            src="'.base_url().'assets_d/images/restricted.svg"
                                                            alt="Save">
                                                    </div>
                                                    <div
                                                        class="right">
                                                        <span>Hide/block</span>
                                                    </div>
                                                </a>
                                            </li>
                                            
                                            <li role="presentation">
                                                <a role="menuitem"
                                                   tabindex="-1"
                                                   href="javascript:void(0);" onclick="deleteComment('.$comment_id.', '.$studyset_id.', \'studyset\')">
                                                    <div
                                                        class="left">
                                                        <img
                                                            src="'.base_url().'assets_d/images/trash.svg"
                                                            alt="Link">
                                                    </div>
                                                    <div
                                                        class="right">
                                                        <span>Delete</span>
                                                    </div>
                                                </a>
                                            </li>
                                           
                                        </ul>
                        </div>
                        <div class="reply" id="reply_'.$comment_id.'">

                        </div>
                        <div class="replyBox" id="replyBox_'.$comment_id.'">
                            <figure>
                                <img src="'.base_url().'assets_d/images/ct_user.jpg" alt="User">
                            </figure>
                            <div class="replyuser">
                                <input type="text" id="input_reply_'.$comment_id.'" placeholder="Write a Reply..." onkeypress="postReply(event,'.$comment_id.', this.value)">
                            </div>
                        </div>
                    </div>';
            echo $html;die;
        }
    }

    public function postReply(){
        if($this->input->post()){
            $comment = $this->input->post('comment');
            $studyset_id = $this->input->post('studyset_id');
            $comment_id = $this->input->post('comment_id');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $comment_parent_id = $comment_id;

            $insertArr = array( 'reference' => 'studyset',
                'reference_id' => $studyset_id,
                'comment_parent_id' => $comment_id,
                'user_id' => $user_id,
                'comment' => $comment,
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s')

            );

            $this->db->insert('comment_master', $insertArr);
            $comment_id = $this->db->insert_id();

            $user_info = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();

            $html = '<div class="userReplyBox" id="comment_reply_id_'.$comment_id.'"><figure>
                        <img src="'.base_url().'assets_d/images/ct_user.jpg" alt="User">
                    </figure>
                    <figcaption>
                        <span class="name">'.$user_info['nickname'].'</span>
                        '.$comment.'
                        <div class="actionmsgMenu">
                            <ul>
                                <li class="likeuser" id="likeComment'.$comment_id.'" onclick="likeComment('.$comment_id.')">Like</li>
                                
                            </ul>
                        </div>
                        
                        <div class="reactmessage" id="reactmessage_'.$comment_id.'" style="display: none;">
                            <div class="react">
                                <img src="'.base_url().'assets_d/images/like.png" alt="Like">
                            </div>
                            <p id="like_count_'.$comment_id.'">0</p>
                        </div>
                    </figcaption>
                    <div class="dotsBullet dropdown">
                        <img
                            src="'.base_url().'assets_d/images/more.svg"
                            alt="more"
                            data-toggle="dropdown">
                        <ul class="dropdown-menu"
                            role="menu"
                            aria-labelledby="menu1">
                            <li role="presentation">
                                <a role="menuitem"
                                   tabindex="-1"
                                   href="javascript:void(0);">
                                    <div
                                        class="left">
                                        <img
                                            src="'.base_url().'assets_d/images/restricted.svg"
                                            alt="Save">
                                    </div>
                                    <div
                                        class="right">
                                        <span>Hide/block</span>
                                    </div>
                                </a>
                            </li>
                            
                                <li role="presentation">
                                    <a role="menuitem"
                                       tabindex="-1"
                                       href="javascript:void(0);" onclick="deleteCommentReply('.$comment_id.', '.$comment_parent_id.')">
                                        <div
                                            class="left">
                                            <img
                                                src="'.base_url().'assets_d/images/trash.svg"
                                                alt="Link">
                                        </div>
                                        <div
                                            class="right">
                                            <span>Delete</span>
                                        </div>
                                    </a>
                                </li>
                            
                        </ul>
                    </div>
                </div>';
            echo $html;die;

        }
    }

    public function postImgReply(){

        if($this->input->post()){

            $studyset_id = $this->input->post('studyset_id');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];
            $c_image = $this->uploadCommentImg('file', $_FILES['file']['name']);

            $insertArr = array( 'reference' => 'studyset',
                'reference_id' => $studyset_id,
                'user_id' => $user_id,
                'comment' => $c_image,
                'type'   => 1,
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s')

            );

            $this->db->insert('comment_master', $insertArr);
            $comment_id = $this->db->insert_id();

            $user_info = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();

            $html = '<div class="chatMsg" id="comment_id_'.$comment_id.'">
                        <figure>
                            <img src="'.base_url().'assets_d/images/ct_user.jpg" alt="User">
                        </figure>
                        <figcaption>
                            <span class="name"> '.$user_info['nickname'].'</span>
                            <img src="'.base_url().'uploads/comments/'.$c_image.'" alt="comment" style="height: 70px;">
                            <div class="actionmsgMenu">
                                <ul>
                                    <li class="likeuser" onclick="likeComment('.$comment_id.')">Like</li>
                                    <li class="replyuser" onclick="showReplyUser('.$comment_id.')">Reply</li>
                                </ul>
                            </div>
                            <div class="reactmessage" id="reactmessage_'.$comment_id.'" style="display:none;">
                                <div class="react">
                                    <img src="'.base_url().'assets_d/images/like.png" alt="Like">
                                </div>
                                <p id="like_count_'.$comment_id.'"></p>
                            </div>
                        </figcaption>
                        <div class="dotsBullet dropdown">
                                        <img
                                            src="'.base_url().'assets_d/images/more.svg"
                                            alt="more"
                                            data-toggle="dropdown">
                                        <ul class="dropdown-menu"
                                            role="menu"
                                            aria-labelledby="menu1">
                                            <li role="presentation">
                                                <a role="menuitem"
                                                   tabindex="-1"
                                                   href="javascript:void(0);">
                                                    <div
                                                        class="left">
                                                        <img
                                                            src="'.base_url().'assets_d/images/restricted.svg"
                                                            alt="Save">
                                                    </div>
                                                    <div
                                                        class="right">
                                                        <span>Hide/block</span>
                                                    </div>
                                                </a>
                                            </li>
                                            
                                            <li role="presentation">
                                                <a role="menuitem"
                                                   tabindex="-1"
                                                   href="javascript:void(0);" onclick="deleteComment('.$comment_id.', '.$studyset_id.', \'studyset\')">
                                                    <div
                                                        class="left">
                                                        <img
                                                            src="'.base_url().'assets_d/images/trash.svg"
                                                            alt="Link">
                                                    </div>
                                                    <div
                                                        class="right">
                                                        <span>Delete</span>
                                                    </div>
                                                </a>
                                            </li>
                                           
                                        </ul>
                        </div>
                        <div class="reply" id="reply_'.$comment_id.'">

                        </div>
                        <div class="replyBox" id="replyBox_'.$comment_id.'">
                            <figure>
                                <img src="'.base_url().'assets_d/images/ct_user.jpg" alt="User">
                            </figure>
                            <div class="replyuser">
                                <input type="text" id="input_reply_'.$comment_id.'" placeholder="Write a Reply..." onkeypress="postReply(event,'.$comment_id.', this.value)">
                            </div>
                        </div>
                    </div>';
            echo $html;die;
        }

    }

    public function uploadCommentImg($f_n, $name) {
        $fileTypes = array('jpg', 'jpeg', 'gif', 'png', 'zip', 'xlsx', 'cad', 'pdf', 'doc', 'docx', 'ppt', 'pptx', 'pps', 'ppsx', 'odt', 'xls', 'xlsx', '.mp3', 'm4a', 'ogg', 'wav', 'mp4', 'm4v', 'mov', 'wmv' ); // Allowed file extensions

        $imagename  = time();
        $config['upload_path']      = 'uploads/comments/';
        $config['allowed_types']    = $fileTypes;
        $config['max_size']         = '0';
        $logo_file_name             = '';
        $config['file_name']        =   $imagename;
        $this->upload->initialize($config);

        // $this->load->library('upload', $config);

        if ($this->upload->do_upload($f_n)) {
            $logo_data = $this->upload->data();
            $logo_file_name = $logo_data['file_name'];
        }

        if (!empty($logo_file_name)) {
            $img = $logo_file_name;
        } else {
            $img = 'default.png';
        }
        return $img;
    }

    public function deleteStudySet()
    {
        $study_set_id = $this->input->post('study_set_id');
        return $this->studyset_model->deleteStudySet($study_set_id);
    }

    public function removeStudySet()
    {
        $study_set_id = $this->input->post('study_set_id');
        return $this->studyset_model->removeStudySet($study_set_id);
    }

    public function shareToPeer(){
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $study_set_id = $this->input->post('study_set_id');
        $peer_id = $this->input->post('peer_id');

        $insertArr = array('reference' => 'studyset',
            'reference_id' => $study_set_id,
            'user_id' => $user_id,
            'peer_id' => $peer_id,
            'status' => '1',
            'created_at' => date("Y-m-d H:i:s")

        );
        $this->db->insert('share_master', $insertArr);

        $action_id = $this->db->insert_id();

        $userdata = $this->session->userdata('user_data');
        $user_detail    = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $full_name      = $user_detail['first_name'].' '.$user_detail['last_name'];
        $notification = "<b>".$full_name."</b> has shared a studyset with you.";

        $insertArr = array(
            'user_id'       => $peer_id,
            'notification'  => $notification,
            'action_type'   => 3, // for share
            'action_id'     => $action_id,
            'img_user_id'   => $user_id,
            'status'        => 1,
            'created_at'    => date('Y-m-d H:i:s')

        );

        $this->db->insert('notification_master', $insertArr);

        $this->studyset_model->updateShareCount($study_set_id);

        $det = $this->db->get_where($this->db->dbprefix('study_sets'), array('study_set_id'=>$study_set_id))->row_array();

        $get_active_token = $this->db->get_where($this->db->dbprefix('user_token'), array('user_id'=>$peer_id, 'status' => 1))->result_array();

        foreach ($get_active_token  as $key => $value) {
            $this->sendTestNotification($value['token'], 'Studyset Shared', 'A studyset has been shared with you', $action_id);
        }
        echo $det['share_count'];die;
    }


    public function unshareToPeer(){
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $study_set_id = $this->input->post('study_set_id');
        $peer_id = $this->input->post('peer_id');

        $this->db->order_by('share_master.id', 'desc');
        $action_detail    = $this->db->get_where('share_master', array('reference' => 'studyset', 'reference_id' => $study_set_id, 'user_id' => $user_id, 'peer_id' => $peer_id))->row_array();

        $this->db->where(array('id' => $action_detail['id']));
        $this->db->delete('share_master');


        $this->db->where(array('action_id' => $action_detail['id']));
        $this->db->delete('notification_master');

        $this->studyset_model->updateShareCountDec($study_set_id);

        $det = $this->db->get_where($this->db->dbprefix('study_sets'), array('study_set_id'=>$study_set_id))->row_array();

        echo $det['share_count'];die;
    }

    public function getPeerToShare(){
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $study_set_id = $this->input->post('study_set_id');
        $peer_id = $this->input->post('peer_id');

        $peer_list = $this->db->query("SELECT * FROM `friends` WHERE (`user_id` = '".$user_id ."')")->result_array();

        $html = '';

        foreach ($peer_list as $key => $value) {
            if($value['user_id'] == $user_id){
                $peer = $this->db->get_where($this->db->dbprefix('user_info'), array('userID'=>$value['peer_id']))->row_array();
            } else {
                $peer = $this->db->get_where($this->db->dbprefix('user_info'), array('userID'=>$value['user_id']))->row_array();
            }
            $chk_if_shared = $this->db->get_where($this->db->dbprefix('share_master'), array('peer_id'=>$peer['userID'], 'reference' => 'studyset', 'reference_id' => $study_set_id, 'status' => 1))->row_array();
            
            $html.= '<section class="list"><section class="left">
                        <figure>
                            <img src="'.userImage($peer['userID']).'" alt="user">
                        </figure>
                        <figcaption>'.$peer['nickname'].'</figcaption>
                    </section>
                    <section class="action" id="action_'.$peer['userID'].'">';
                    if(empty($chk_if_shared)){
                        $html.= '<button type="button" class="like" onclick="shareToPeer('.$peer['userID'].')">share</button>';
                    } else {
                        $html.= '<button type="button" class="like" onclick="unshareToPeer('.$peer['userID'].')">shared</button>';
                    }
                    $html.= '</section>
                </section>';
            
        }
        echo $html;die;
    }

    public function sendTestNotification($token, $title, $body, $info){
        $message['title'] = $title;
        $message['body'] = $body;
        sendFCM($message, $token, $info );
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
        $privacy = $this->input->post('privacy');
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
            "chapter" => $chapter,
            "privacy" => $privacy
        );

        if (isset($_FILES['featured_image']) && !empty($_FILES['featured_image']['name'])) {
            $study_set_arr['image'] = $this->uploadImg('featured_image','studyset');
        }

        //print_r($study_set_arr);
        $study_set_id = $this->studyset_model->manageStudySet($study_set_arr);

        $files = array();


        $term_array = array();
        $study_set_term_id = $this->input->post('study_set_term_id');
        $term_name = $this->input->post('term_name');
        $term_description = $this->input->post('term_description');
        $config = array(
            'upload_path'   => 'uploads/studyset/',
            'allowed_types' => 'jpg|png|jpeg|gif',
            'overwrite'     => 1,
        );

        $this->load->library('upload', $config);
        $images = array();

        foreach ($term_name as $key => $value) {
            $term = array(
                "study_set_term_id" =>  $study_set_term_id[$key],
                "study_set_id" => $study_set_id,
                "term_name" => $value,
                "term_description" => $term_description[$key]
            );
            if(!empty($_FILES['term_image']['name'][$key]))
            {


                $image = $_FILES['term_image']['name'][$key];
                $_FILES['images[]']['name']     = $_FILES['term_image']['name'][$key];
                $_FILES['images[]']['type']     = $_FILES['term_image']['type'][$key];
                $_FILES['images[]']['tmp_name'] = $_FILES['term_image']['tmp_name'][$key];
                $_FILES['images[]']['error']    = $_FILES['term_image']['error'][$key];
                $_FILES['images[]']['size']     = $_FILES['term_image']['size'][$key];

                $fileName = time() .'_'.$key.'_'.$image;

                $images[] = $fileName;

                $config['file_name'] = $fileName;

                $this->upload->initialize($config);

                if ($this->upload->do_upload('images[]')) {
                    $image_data = $this->upload->data();
                    $term['term_image'] = $image_data['file_name'];
                }

            }


            array_push($term_array,$term);
        }


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
        $data['flashcard_round'] = $this->db->get_where('flashcard_round_master', array('study_set_id' => $study_set_id, 'userId' => $user_id))->num_rows();
        $this->load->view('user/include/header', $this->data);
        $this->load->view('studyset/flashcards-new',$data);
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/firebase-include');
        $this->load->view('user/include/footer');
    }

    public function learn($study_set_id)
    {
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['studyset'] = $this->studyset_model->getStudySetDetails($study_set_id,$user_id);
        $data['term_data'] = $this->studyset_model->getStudySetTermData($study_set_id);
        $data['learn_round'] = $this->db->get_where('learn_round_master', array('study_set_id' => $study_set_id, 'userId' => $user_id))->num_rows();
        $this->load->view('user/include/header', $this->data);
        $this->load->view('studyset/learn',$data);
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/firebase-include');
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
        $this->load->view('user/include/firebase-include');
        $this->load->view('studyset/match-footer');
    }

    public function write($study_set_id)
    {
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['studyset'] = $this->studyset_model->getStudySetDetails($study_set_id,$user_id);
        $data['term_data'] = $this->studyset_model->getStudySetTermData($study_set_id);
        $data['learn_round'] = $this->db->get_where('write_round_master', array('study_set_id' => $study_set_id, 'userId' => $user_id))->num_rows();
        $this->load->view('user/include/header', $this->data);
        $this->load->view('studyset/write',$data);
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/firebase-include');
        $this->load->view('user/include/footer');
    }

    public function test($study_set_id)
    {
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['studyset'] = $this->studyset_model->getStudySetDetails($study_set_id,$user_id);
        $data['term_data'] = $this->studyset_model->getStudySetTermData($study_set_id);
        $data['letters'] = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
        $this->load->view('user/include/header', $this->data);
        $this->load->view('studyset/test',$data);
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/firebase-include');
        $this->load->view('studyset/test-footer');
    }


    public function incrementFlashcard(){
        if($this->input->post()){
            $studyset_id    = $this->input->post('studyset_id');
            $user_id        = $this->session->get_userdata()['user_data']['user_id'];
            $correctTerms   = $this->input->post('correctTerms');
            $matchtime      = $this->input->post('matchtime');
            $incorrectCount     = $this->input->post('incorrectCount');
            $notSureCount       = $this->input->post('notSureCount');

            $total = $this->db->get_where('study_set_terms', array('study_set_id' => $studyset_id, 'status' => 1))->num_rows();

            if(!empty($correctTerms)) {
                $str_arr = explode (",", $correctTerms);
                $count = count($str_arr);
            } else {
                $count = 0;
                $str_arr = array();
            }

            $missed_count = $total - $count;

            $insertArr = array( 'userId'        => $user_id,
                'study_set_id'  => $studyset_id,
                'time_span'     => $matchtime,
                'total'         => $total,
                'correct'       => $count,
                'missed'        => $missed_count,
                'created_at'    => date('Y-m-d H:i:s')
            );
            $this->db->insert('flashcard_round_master', $insertArr);

            $round_id = $this->db->insert_id();

            $all_terms = $this->db->get_where('study_set_terms', array('study_set_id' => $studyset_id, 'status' => 1))->result_array();

            if($missed_count != 0){
                $html = '<div class="flashcard_correct">
                            <h4>You can do better!</h4>
                            <img src="'.base_url().'assets_d/images/better-emoji.svg">
                            <div class="message">
                                You had <a>'.$count.'</a> cards correct. <br>
                                Study again and be perfectly prepared for your exam.
                            </div>
                            <a href="'.base_url().'studyset/flashcards/'.$studyset_id.'"><button type="button" class="study_action"> Study Again</button>  </a>
                        </div>';
                $html.= '<div class="report_card">
                            <h5>Here is your report</h5>
                            <div class="report_card_count">
                                <div class="card total">
                                    <h6>'.$total.'</h6>
                                    <p>Total</p>
                                </div>
                                <div class="card correct">
                                    <h6>'.$count.'</h6>
                                    <p>Correct</p>
                                </div>
                                <div class="card Incorrect">
                                    <h6>'.$incorrectCount.'</h6>
                                    <p>Incorrect</p>
                                </div>
                                <div class="card not-sure">
                                    <h6>'.$notSureCount.'</h6>
                                    <p>Not Sure</p>
                                </div>
                            </div>
                            <h5>You need to study these terms</h5>
                        </div>';
                foreach ($all_terms as $key => $value) {
                    if(in_array($value['study_set_term_id'] ,$str_arr)) {

                    } else {
                        $insertArr = array( 'round_id'      => $round_id,
                            'term_id'       => $value['study_set_term_id'],

                            'created_at'    => date('Y-m-d H:i:s')
                        );
                        $this->db->insert('flashcard_round_details', $insertArr);

                        $html.= '<div class="descp_card">
                                    <div class="left">
                                        <h6>Terms</h6>
                                        <p>'.$value['term_name'].'</p>
                                    </div>
                                    <div class="right">
                                        <h6>Description</h6>';
                        if(!empty($value['term_image'])){
                            $html.= '<div class="flashImg">
                                                <img src="'.base_url().'uploads/studyset/'.$value['term_image'].'">
                                            </div>';
                        }

                        $html.= '<p>'.$value['term_description'].'</p>
                                    </div>
                                </div>';
                    }
                }
            } else {
                $html = '<div class="flashcard_correct">
                            <h4>You are a genius!</h4>
                            <img src="'.base_url().'assets_d/images/genius-emoji.svg">
                            <div class="message">
                                You had every single cards correct.
                            </div>
                            <a href="'.base_url().'studyset/flashcards/'.$studyset_id.'"><button type="button" class="study_action"> Study Again</button>  </a>  
                        </div>';
            }


            echo $html;die;
        }
    }


    public function incrementLearnRound(){
        if($this->input->post()){
            $studyset_id    = $this->input->post('studyset_id');
            $user_id        = $this->session->get_userdata()['user_data']['user_id'];

            $total_term     = $this->input->post('total_term');
            $correct_count  = $this->input->post('correct_count');
            $missed_count   = $this->input->post('missed_count');
            $missed_terms   = $this->input->post('missed_terms');
            $time_span      = $this->input->post('time_span');

            $insertArr = array( 'userId'        => $user_id,
                'study_set_id'  => $studyset_id,
                'time_span'     => $time_span,
                'total'         => $total_term,
                'correct'       => $correct_count,
                'missed'        => $missed_count,
                'created_at'    => date('Y-m-d H:i:s')
            );
            $this->db->insert('learn_round_master', $insertArr);

            $round_id = $this->db->insert_id();



            $html = '<div class="result col-sm-12"><h3 class="text-center">Here is your report</h3><div class="col-sm-4 CheckpointView total"><div class="CheckpointView-content"><span class="bucketCount total">'.$total_term.'</span><span class="bucketName"><span>Total</span></span></div></div><div class="col-sm-4 CheckpointView correct"><div class="CheckpointView-content"><span class="bucketCount correct">'.$correct_count.'</span><span class="bucketName"><span>Correct</span></span></div></div><div class="col-sm-4 CheckpointView missed"><div class="CheckpointView-content"><span class="bucketCount missed">'.$missed_count.'</span><span class="bucketName"><span>Missed</span></span></div></div></div>';

            if(!empty($missed_terms)) {
                $str_arr = explode (",", $missed_terms);
                $html .= '<div class="col-sm-12" style="margin-top:10px;"><h3 class="mb-2 text-center">You need to study these terms..</h3><table class="table table-borderless sp-table" style="border-top: 3px solid #185aeb;">
                                                <thead>
                                                        <tr>
                                                            <th><b>S.No.</b></th>
                                                            <th><b>Term</b></th>
                                                            <th><b>Description</b></th>
                                                        </tr>
                                                </thead><tbody></div>';

                foreach ($str_arr as $key => $value) {
                    $insertArr = array( 'round_id'        => $round_id,
                        'term_id'  => $value,
                        'created_at'    => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('learn_round_details', $insertArr);

                    $term_detail = $this->db->get_where('study_set_terms', array(' study_set_term_id' => $value))->row_array();

                    if(!empty($term_detail['term_image'])){
                        $img = '<img src="'.base_url().'uploads/studyset/'.$term_detail['term_image'].'" alt="Study Set" style="height: 100px; border-radius:5px;">';
                    } else {
                        $img = '';
                    }
                    $count = $key+1;
                    $html.= '<tr>
                                <td data-th="S.No."><span class="bt-content">'.$count.'</span></td>
                                <td data-th="Term"><span class="bt-content">'.$term_detail['term_name'].'</span></td>
                                <td data-th="Description"><span class="bt-content"><p class="text-capitalise">'.$term_detail['term_description'].'</p>'.$img.'</span></td>
                            </tr>';
                }

                $html.= '<tbody></table></div>';
            }
            echo $html;die;
        }
    }


    public function incrementMatchRound(){
        if($this->input->post()){
            $studyset_id    = $this->input->post('studyset_id');
            $user_id        = $this->session->get_userdata()['user_data']['user_id'];

            $total_term     = $this->input->post('total_term');
            $correct_count  = $this->input->post('correct_count');
            $missed_count   = $this->input->post('missed_count');
            $missed_terms   = $this->input->post('missed_terms');
            $time_span      = $this->input->post('time_span');

            $insertArr = array( 'userId'        => $user_id,
                'study_set_id'  => $studyset_id,
                'time_span'     => $time_span,
                'total'         => $total_term,
                'correct'       => $correct_count,
                'missed'        => $missed_count,
                'created_at'    => date('Y-m-d H:i:s')
            );
            $this->db->insert('match_round_master', $insertArr);

            $round_id = $this->db->insert_id();



            $html = '<div class="result col-sm-12"><h3 class="text-center">Here is your report</h3><div class="col-sm-4 CheckpointView total"><div class="CheckpointView-content"><span class="bucketCount total">'.$total_term.'</span><span class="bucketName"><span>Total</span></span></div></div><div class="col-sm-4 CheckpointView correct"><div class="CheckpointView-content"><span class="bucketCount correct">'.$correct_count.'</span><span class="bucketName"><span>Correct</span></span></div></div><div class="col-sm-4 CheckpointView missed"><div class="CheckpointView-content"><span class="bucketCount missed">'.$missed_count.'</span><span class="bucketName"><span>Missed</span></span></div></div></div>';

            if(!empty($missed_terms)){
                $str_arr = explode (",", $missed_terms);
                $html .= '<div class="col-sm-12" style="margin-top:10px;"><h3 class="mb-2 text-center">You need to study these terms..</h3><table class="table table-borderless sp-table" style="border-top: 3px solid #185aeb;">
                                                <thead>
                                                        <tr>
                                                            <th><b>S.No.</b></th>
                                                            <th><b>Term</b></th>
                                                            <th><b>Description</b></th>
                                                        </tr>
                                                </thead><tbody></div>';

                foreach ($str_arr as $key => $value) {
                    $insertArr = array( 'round_id'        => $round_id,
                        'term_id'  => $value,
                        'created_at'    => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('match_round_details', $insertArr);

                    $term_detail = $this->db->get_where('study_set_terms', array(' study_set_term_id' => $value))->row_array();

                    if(!empty($term_detail['term_image'])){
                        $img = '<img src="'.base_url().'uploads/studyset/'.$term_detail['term_image'].'" alt="Study Set" style="height: 100px; border-radius:5px;">';
                    } else {
                        $img = '';
                    }
                    $count = $key+1;
                    $html.= '<tr>
                                <td data-th="S.No."><span class="bt-content">'.$count.'</span></td>
                                <td data-th="Term"><span class="bt-content">'.$term_detail['term_name'].'</span></td>
                                <td data-th="Description"><span class="bt-content"><p class="text-capitalise">'.$term_detail['term_description'].'</p>'.$img.'</span></td>
                            </tr>';
                }

                $html.= '<tbody></table></div>';
            }

            echo $html;die;
        }
    }


    public function incrementWriteRound(){

        if($this->input->post()){
            $studyset_id    = $this->input->post('studyset_id');
            $user_id        = $this->session->get_userdata()['user_data']['user_id'];

            $total_term     = $this->input->post('total_term');
            $correct_count  = $this->input->post('correct_count');
            $missed_count   = $this->input->post('missed_count');
            $missed_terms   = $this->input->post('missed_terms');
            $time_span      = $this->input->post('time_span');

            $insertArr = array( 'userId'        => $user_id,
                'study_set_id'  => $studyset_id,
                'time_span'     => $time_span,
                'total'         => $total_term,
                'correct'       => $correct_count,
                'missed'        => $missed_count,
                'created_at'    => date('Y-m-d H:i:s')
            );
            $this->db->insert('write_round_master', $insertArr);

            $round_id = $this->db->insert_id();



            $html = '<div class="result col-sm-12"><h3 class="text-center">Here is your report</h3><div class="col-sm-4 CheckpointView total"><div class="CheckpointView-content"><span class="bucketCount total">'.$total_term.'</span><span class="bucketName"><span>Total</span></span></div></div><div class="col-sm-4 CheckpointView correct"><div class="CheckpointView-content"><span class="bucketCount correct">'.$correct_count.'</span><span class="bucketName"><span>Correct</span></span></div></div><div class="col-sm-4 CheckpointView missed"><div class="CheckpointView-content"><span class="bucketCount missed">'.$missed_count.'</span><span class="bucketName"><span>Missed</span></span></div></div></div>';

            if(!empty($missed_terms)) {
                $str_arr = explode (",", $missed_terms);
                $html .= '<div class="col-sm-12" style="margin-top:10px;"><h3 class="mb-2 text-center">You need to study these terms..</h3><table class="table table-borderless sp-table" style="border-top: 3px solid #185aeb;">
                                                <thead>
                                                        <tr>
                                                            <th><b>S.No.</b></th>
                                                            <th><b>Term</b></th>
                                                            <th><b>Description</b></th>
                                                        </tr>
                                                </thead><tbody></div>';

                foreach ($str_arr as $key => $value) {
                    $insertArr = array( 'round_id'        => $round_id,
                        'term_id'  => $value,
                        'created_at'    => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('write_round_details', $insertArr);

                    $term_detail = $this->db->get_where('study_set_terms', array(' study_set_term_id' => $value))->row_array();

                    if(!empty($term_detail['term_image'])){
                        $img = '<img src="'.base_url().'uploads/studyset/'.$term_detail['term_image'].'" alt="Study Set" style="height: 100px;border-radius:5px;">';
                    } else {
                        $img = '';
                    }
                    $count = $key+1;
                    $html.= '<tr>
                                <td data-th="S.No."><span class="bt-content">'.$count.'</span></td>
                                <td data-th="Term"><span class="bt-content">'.$term_detail['term_name'].'</span></td>
                                <td data-th="Description"><span class="bt-content"><p class="text-capitalise">'.$term_detail['term_description'].'</p>'.$img.'</span></td>
                            </tr>';
                }

                $html.= '<tbody></table></div>';
            }
            echo $html;die;
        }
    }


    public function checkLearnAns(){
        if($this->input->post()){
            $studyset_term_id    = $this->input->post('studyset_term_id');
            $select              = $this->input->post('select');
            $if_checked          = $this->input->post('if_checked');
            $user_id        = $this->session->get_userdata()['user_data']['user_id'];
            $data = $this->db->get_where('study_set_terms', array('study_set_term_id' => $studyset_term_id))->row_array();
            $select_data = $this->db->get_where('study_set_terms', array('study_set_term_id' => $select))->row_array();
            $html = "";
            if(!empty($data['term_image'])){
                $image = '<img src="'.base_url()."uploads/studyset/".$data['term_image'].'" alt="Study Set" style="height: 100px; border-radius:5px;">';
            } else {
                $image = "";
            }
            if(($studyset_term_id == $select) && ($if_checked == 0)){
                $html.= '<h3><svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                          <path d="m497.6,244.7c-63.9-96.7-149.7-150-241.6-150-91.9,1.42109e-14-177.7,53.3-241.6,150-4.5,6.8-4.5,15.7 0,22.5 63.9,96.7 149.7,150 241.6,150 91.9,0 177.7-53.3 241.6-150 4.5-6.8 4.5-15.6 0-22.5zm-241.6,131.7c-74.2,0-144.8-42.6-199.9-120.4 55-77.8 125.6-120.4 199.9-120.4 74.2,0 144.8,42.6 199.9,120.4-55.1,77.8-125.6,120.4-199.9,120.4z"></path>
                                          <path d="m256,148.5c-59.3,0-107.5,48.2-107.5,107.5 0,59.3 48.2,107.5 107.5,107.5s107.5-48.2 107.5-107.5c0-59.3-48.2-107.5-107.5-107.5zm0,175.5c-36.8,0-66.8-30.5-66.8-68 0-37.5 30-68 66.8-68 36.8,0 66.8,30.5 66.8,68 0,37.5-30,68-66.8,68z"></path>
                                        </svg> Correct! nicely done.
                                    </h3>
                                    <h6>Definition</h6>
                                    <div class="answer-result__card-desc"><p class="text-capitalise">'.$data['term_description'].'</p>'.$image.'</div>  
                                    <h6><svg class="sp-icon correct-dark mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path d="M440.8,11H71.3C38,11,11,38,11,71.2v369.5C11,474,38,501,71.3,501h369.5c33.2,0,60.2-27,60.2-60.2V71.2
                                            C501,38,474,11,440.8,11z M460.2,440.8c0,10.7-8.7,19.4-19.4,19.4H71.3c-10.7,0-19.4-8.7-19.4-19.4V71.2c0-10.7,8.7-19.4,19.4-19.4
                                            h369.5c10.7,0,19.4,8.7,19.4,19.4L460.2,440.8L460.2,440.8z"></path>
                                        <path d="M232.6,357.4c-5.4,0-10.7-2-14.8-6.2l-87.6-87.6c-8.2-8.2-8.2-21.5,0-29.7c8.2-8.2,21.5-8.2,29.7,0l72.7,72.7l151.7-151.7
                                            c8.2-8.2,21.5-8.2,29.7,0c8.2,8.2,8.2,21.5,0,29.7L247.4,351.3C243.3,355.4,237.9,357.4,232.6,357.4z"></path>
                                        </svg>
                                         Correct answer
                                    </h6>   
                                    <p class="correct-dark-color">'.
                    $data['term_name']
                    .'</p>
                                    <div class="learnBtnWrapper justifycenter">
                                        <button type="button" class="createBtn nextLearnAns" onclick="nextLearnAns()">Next
                                            <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
                                                <path d="M244.1,53.7c-14.8,16.4-13.9,41.5,2,56.8l101.5,94.4l-308.4,0.7C17,206.2-0.5,224.6,0,246.7
                                                    c0.5,21.4,17.7,38.6,39.1,39.1l308.6-0.7l-101.5,94.4c-16.2,15.1-17.1,40.6-2,56.8c15.1,16.2,40.6,17.1,56.8,2l176.2-164
                                                    c8.1-7.6,12.7-18.2,12.8-29.3c0-11.1-4.6-21.7-12.8-29.3L301,51.8c-16.2-15.2-41.6-14.4-56.8,1.7c-0.1,0.1-0.2,0.2-0.2,0.2
                                                    L244.1,53.7z"></path>
                                            </svg>
                                        </button>
                                    </div>';
                $result['type'] = 1;
            } else {
                $html.= '
                                    <h3><svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="fill: #ea2e7e;">
                                          <path d="m497.6,244.7c-63.9-96.7-149.7-150-241.6-150-91.9,1.42109e-14-177.7,53.3-241.6,150-4.5,6.8-4.5,15.7 0,22.5 63.9,96.7 149.7,150 241.6,150 91.9,0 177.7-53.3 241.6-150 4.5-6.8 4.5-15.6 0-22.5zm-241.6,131.7c-74.2,0-144.8-42.6-199.9-120.4 55-77.8 125.6-120.4 199.9-120.4 74.2,0 144.8,42.6 199.9,120.4-55.1,77.8-125.6,120.4-199.9,120.4z"></path>
                                          <path d="m256,148.5c-59.3,0-107.5,48.2-107.5,107.5 0,59.3 48.2,107.5 107.5,107.5s107.5-48.2 107.5-107.5c0-59.3-48.2-107.5-107.5-107.5zm0,175.5c-36.8,0-66.8-30.5-66.8-68 0-37.5 30-68 66.8-68 36.8,0 66.8,30.5 66.8,68 0,37.5-30,68-66.8,68z"></path>
                                        </svg> Study this one!
                                    </h3>
                                    <h6>Definition</h6>
                                    <div class="answer-result__card-desc"><p class="text-capitalise">'.$data['term_description'].'</p>'.$image.'</div>    
                                    <h6>Your Answer</h6>
                                    <div class="wrong-dark-color answer-result__card-desc">'.
                    $select_data['term_name']
                    .'</div>
                                    <h6><svg class="sp-icon correct-dark mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path d="M440.8,11H71.3C38,11,11,38,11,71.2v369.5C11,474,38,501,71.3,501h369.5c33.2,0,60.2-27,60.2-60.2V71.2
                                            C501,38,474,11,440.8,11z M460.2,440.8c0,10.7-8.7,19.4-19.4,19.4H71.3c-10.7,0-19.4-8.7-19.4-19.4V71.2c0-10.7,8.7-19.4,19.4-19.4
                                            h369.5c10.7,0,19.4,8.7,19.4,19.4L460.2,440.8L460.2,440.8z"></path>
                                        <path d="M232.6,357.4c-5.4,0-10.7-2-14.8-6.2l-87.6-87.6c-8.2-8.2-8.2-21.5,0-29.7c8.2-8.2,21.5-8.2,29.7,0l72.7,72.7l151.7-151.7
                                            c8.2-8.2,21.5-8.2,29.7,0c8.2,8.2,8.2,21.5,0,29.7L247.4,351.3C243.3,355.4,237.9,357.4,232.6,357.4z"></path>
                                        </svg>
                                         Correct answer
                                    </h6>   
                                    <p class="correct-dark-color">'.
                    $data['term_name']
                    .'</p>
                                    <div class="learnBtnWrapper justifycenter">
                                        <button type="button" class="createBtn nextLearnAns" onclick="nextLearnAns()">Next
                                            <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
                                                <path d="M244.1,53.7c-14.8,16.4-13.9,41.5,2,56.8l101.5,94.4l-308.4,0.7C17,206.2-0.5,224.6,0,246.7
                                                    c0.5,21.4,17.7,38.6,39.1,39.1l308.6-0.7l-101.5,94.4c-16.2,15.1-17.1,40.6-2,56.8c15.1,16.2,40.6,17.1,56.8,2l176.2-164
                                                    c8.1-7.6,12.7-18.2,12.8-29.3c0-11.1-4.6-21.7-12.8-29.3L301,51.8c-16.2-15.2-41.6-14.4-56.8,1.7c-0.1,0.1-0.2,0.2-0.2,0.2
                                                    L244.1,53.7z"></path>
                                            </svg>
                                        </button>
                                    </div>';
                $result['type'] = 2;
            }
            $result['html'] = $html;
            print_r(json_encode($result));die;
        }
    }


    public function checkLearnAnsText(){
        if($this->input->post()){
            $studyset_term_id    = $this->input->post('studyset_term_id');
            $select              = $this->input->post('select');

            $user_id        = $this->session->get_userdata()['user_data']['user_id'];
            $data = $this->db->get_where('study_set_terms', array('study_set_term_id' => $studyset_term_id))->row_array();
            $html = "";
            if(!empty($data['term_image'])){
                $image = '<img src="'.base_url()."uploads/studyset/".$data['term_image'].'" alt="Study Set" style="height: 100px; border-radius:5px;">';
            } else {
                $image = "";
            }

            if(!empty($select)){
                $answer = $select;
            } else {
                $answer = "No answer given";
            }

            if($data['term_name'] == $select){
                $html.= '<h3><svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                          <path d="m497.6,244.7c-63.9-96.7-149.7-150-241.6-150-91.9,1.42109e-14-177.7,53.3-241.6,150-4.5,6.8-4.5,15.7 0,22.5 63.9,96.7 149.7,150 241.6,150 91.9,0 177.7-53.3 241.6-150 4.5-6.8 4.5-15.6 0-22.5zm-241.6,131.7c-74.2,0-144.8-42.6-199.9-120.4 55-77.8 125.6-120.4 199.9-120.4 74.2,0 144.8,42.6 199.9,120.4-55.1,77.8-125.6,120.4-199.9,120.4z"></path>
                                          <path d="m256,148.5c-59.3,0-107.5,48.2-107.5,107.5 0,59.3 48.2,107.5 107.5,107.5s107.5-48.2 107.5-107.5c0-59.3-48.2-107.5-107.5-107.5zm0,175.5c-36.8,0-66.8-30.5-66.8-68 0-37.5 30-68 66.8-68 36.8,0 66.8,30.5 66.8,68 0,37.5-30,68-66.8,68z"></path>
                                        </svg> Correct! nicely done.
                                    </h3>
                                    <h6>Definition</h6>
                                    <div class="answer-result__card-desc"><p class="text-capitalise">'.$data['term_description'].'</p>'.$image.'</div>  
                                    <h6><svg class="sp-icon correct-dark mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path d="M440.8,11H71.3C38,11,11,38,11,71.2v369.5C11,474,38,501,71.3,501h369.5c33.2,0,60.2-27,60.2-60.2V71.2
                                            C501,38,474,11,440.8,11z M460.2,440.8c0,10.7-8.7,19.4-19.4,19.4H71.3c-10.7,0-19.4-8.7-19.4-19.4V71.2c0-10.7,8.7-19.4,19.4-19.4
                                            h369.5c10.7,0,19.4,8.7,19.4,19.4L460.2,440.8L460.2,440.8z"></path>
                                        <path d="M232.6,357.4c-5.4,0-10.7-2-14.8-6.2l-87.6-87.6c-8.2-8.2-8.2-21.5,0-29.7c8.2-8.2,21.5-8.2,29.7,0l72.7,72.7l151.7-151.7
                                            c8.2-8.2,21.5-8.2,29.7,0c8.2,8.2,8.2,21.5,0,29.7L247.4,351.3C243.3,355.4,237.9,357.4,232.6,357.4z"></path>
                                        </svg>
                                         Correct answer
                                    </h6>   
                                    <p class="correct-dark-color">'.
                    $data['term_name']
                    .'</p>
                                    <div class="learnBtnWrapper justifycenter">
                                        <button type="button" class="createBtn nextLearnAns" onclick="nextLearnAns()">Next
                                            <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
                                                <path d="M244.1,53.7c-14.8,16.4-13.9,41.5,2,56.8l101.5,94.4l-308.4,0.7C17,206.2-0.5,224.6,0,246.7
                                                    c0.5,21.4,17.7,38.6,39.1,39.1l308.6-0.7l-101.5,94.4c-16.2,15.1-17.1,40.6-2,56.8c15.1,16.2,40.6,17.1,56.8,2l176.2-164
                                                    c8.1-7.6,12.7-18.2,12.8-29.3c0-11.1-4.6-21.7-12.8-29.3L301,51.8c-16.2-15.2-41.6-14.4-56.8,1.7c-0.1,0.1-0.2,0.2-0.2,0.2
                                                    L244.1,53.7z"></path>
                                            </svg>
                                        </button>
                                    </div>';
                $result['type'] = 1;
            } else {
                $html.= '
                                    <h3><svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="fill: #ea2e7e;">
                                          <path d="m497.6,244.7c-63.9-96.7-149.7-150-241.6-150-91.9,1.42109e-14-177.7,53.3-241.6,150-4.5,6.8-4.5,15.7 0,22.5 63.9,96.7 149.7,150 241.6,150 91.9,0 177.7-53.3 241.6-150 4.5-6.8 4.5-15.6 0-22.5zm-241.6,131.7c-74.2,0-144.8-42.6-199.9-120.4 55-77.8 125.6-120.4 199.9-120.4 74.2,0 144.8,42.6 199.9,120.4-55.1,77.8-125.6,120.4-199.9,120.4z"></path>
                                          <path d="m256,148.5c-59.3,0-107.5,48.2-107.5,107.5 0,59.3 48.2,107.5 107.5,107.5s107.5-48.2 107.5-107.5c0-59.3-48.2-107.5-107.5-107.5zm0,175.5c-36.8,0-66.8-30.5-66.8-68 0-37.5 30-68 66.8-68 36.8,0 66.8,30.5 66.8,68 0,37.5-30,68-66.8,68z"></path>
                                        </svg> Study this one!
                                    </h3>
                                    <h6>Definition</h6>
                                    <div class="answer-result__card-desc"><p class="text-capitalise">'.$data['term_description'].'</p>'.$image.'</div>   
                                    <h6>Your Answer</h6>
                                    <div class="wrong-dark-color answer-result__card-desc">'.
                    $answer
                    .'</div>
                                    <h6><svg class="sp-icon correct-dark mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path d="M440.8,11H71.3C38,11,11,38,11,71.2v369.5C11,474,38,501,71.3,501h369.5c33.2,0,60.2-27,60.2-60.2V71.2
                                            C501,38,474,11,440.8,11z M460.2,440.8c0,10.7-8.7,19.4-19.4,19.4H71.3c-10.7,0-19.4-8.7-19.4-19.4V71.2c0-10.7,8.7-19.4,19.4-19.4
                                            h369.5c10.7,0,19.4,8.7,19.4,19.4L460.2,440.8L460.2,440.8z"></path>
                                        <path d="M232.6,357.4c-5.4,0-10.7-2-14.8-6.2l-87.6-87.6c-8.2-8.2-8.2-21.5,0-29.7c8.2-8.2,21.5-8.2,29.7,0l72.7,72.7l151.7-151.7
                                            c8.2-8.2,21.5-8.2,29.7,0c8.2,8.2,8.2,21.5,0,29.7L247.4,351.3C243.3,355.4,237.9,357.4,232.6,357.4z"></path>
                                        </svg>
                                         Correct answer
                                    </h6>   
                                    <p class="correct-dark-color">'.
                    $data['term_name']
                    .'</p>
                                    <div class="learnBtnWrapper justifycenter">
                                        <button type="button" class="createBtn nextLearnAns" onclick="nextLearnAns()">Next
                                            <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
                                                <path d="M244.1,53.7c-14.8,16.4-13.9,41.5,2,56.8l101.5,94.4l-308.4,0.7C17,206.2-0.5,224.6,0,246.7
                                                    c0.5,21.4,17.7,38.6,39.1,39.1l308.6-0.7l-101.5,94.4c-16.2,15.1-17.1,40.6-2,56.8c15.1,16.2,40.6,17.1,56.8,2l176.2-164
                                                    c8.1-7.6,12.7-18.2,12.8-29.3c0-11.1-4.6-21.7-12.8-29.3L301,51.8c-16.2-15.2-41.6-14.4-56.8,1.7c-0.1,0.1-0.2,0.2-0.2,0.2
                                                    L244.1,53.7z"></path>
                                            </svg>
                                        </button>
                                    </div>';
                $result['type'] = 2;
            }
            $result['html'] = $html;
            print_r(json_encode($result));die;
        }
    }

    public function checkWriteAns(){

        if($this->input->post()){
            $studyset_term_id    = $this->input->post('studyset_term_id');
            $select              = trim($this->input->post('select'));

            $user_id        = $this->session->get_userdata()['user_data']['user_id'];
            $data = $this->db->get_where('study_set_terms', array('study_set_term_id' => $studyset_term_id))->row_array();
            $html = "";
            if(!empty($data['term_image'])){
                $image = '<img src="'.base_url()."uploads/studyset/".$data['term_image'].'" alt="Study Set" style="height: 100px; border-radius:5px;">';
            } else {
                $image = "";
            }

            if(!empty($select)){
                $answer = $select;
            } else {
                $answer = "No answer given";
            }

            if($data['term_name'] == $select){
                $html.= '<h3 style="color: #129e84;"><svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="fill: #129e84;">
                                          <path d="m497.6,244.7c-63.9-96.7-149.7-150-241.6-150-91.9,1.42109e-14-177.7,53.3-241.6,150-4.5,6.8-4.5,15.7 0,22.5 63.9,96.7 149.7,150 241.6,150 91.9,0 177.7-53.3 241.6-150 4.5-6.8 4.5-15.6 0-22.5zm-241.6,131.7c-74.2,0-144.8-42.6-199.9-120.4 55-77.8 125.6-120.4 199.9-120.4 74.2,0 144.8,42.6 199.9,120.4-55.1,77.8-125.6,120.4-199.9,120.4z"></path>
                                          <path d="m256,148.5c-59.3,0-107.5,48.2-107.5,107.5 0,59.3 48.2,107.5 107.5,107.5s107.5-48.2 107.5-107.5c0-59.3-48.2-107.5-107.5-107.5zm0,175.5c-36.8,0-66.8-30.5-66.8-68 0-37.5 30-68 66.8-68 36.8,0 66.8,30.5 66.8,68 0,37.5-30,68-66.8,68z"></path>
                                        </svg> Correct! nicely done.
                                    </h3>
                                    <h6>Definition</h6>
                                    <div class="answer-result__card-desc"><p class="text-capitalise">'.$data['term_description'].'</p>'.$image.'</div>  
                                    <h6><svg class="sp-icon correct-dark mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path d="M440.8,11H71.3C38,11,11,38,11,71.2v369.5C11,474,38,501,71.3,501h369.5c33.2,0,60.2-27,60.2-60.2V71.2
                                            C501,38,474,11,440.8,11z M460.2,440.8c0,10.7-8.7,19.4-19.4,19.4H71.3c-10.7,0-19.4-8.7-19.4-19.4V71.2c0-10.7,8.7-19.4,19.4-19.4
                                            h369.5c10.7,0,19.4,8.7,19.4,19.4L460.2,440.8L460.2,440.8z"></path>
                                        <path d="M232.6,357.4c-5.4,0-10.7-2-14.8-6.2l-87.6-87.6c-8.2-8.2-8.2-21.5,0-29.7c8.2-8.2,21.5-8.2,29.7,0l72.7,72.7l151.7-151.7
                                            c8.2-8.2,21.5-8.2,29.7,0c8.2,8.2,8.2,21.5,0,29.7L247.4,351.3C243.3,355.4,237.9,357.4,232.6,357.4z"></path>
                                        </svg>
                                         Correct answer
                                    </h6>   
                                    <p class="correct-dark-color">'.
                    $data['term_name']
                    .'</p>
                                    <div class="learnBtnWrapper justifycenter">
                                        <button type="button" class="createBtn nextWriteAns" onclick="nextWriteAns()">Next
                                            <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
                                                <path d="M244.1,53.7c-14.8,16.4-13.9,41.5,2,56.8l101.5,94.4l-308.4,0.7C17,206.2-0.5,224.6,0,246.7
                                                    c0.5,21.4,17.7,38.6,39.1,39.1l308.6-0.7l-101.5,94.4c-16.2,15.1-17.1,40.6-2,56.8c15.1,16.2,40.6,17.1,56.8,2l176.2-164
                                                    c8.1-7.6,12.7-18.2,12.8-29.3c0-11.1-4.6-21.7-12.8-29.3L301,51.8c-16.2-15.2-41.6-14.4-56.8,1.7c-0.1,0.1-0.2,0.2-0.2,0.2
                                                    L244.1,53.7z"></path>
                                            </svg>
                                        </button>
                                    </div>';
                $result['type'] = 1;
            } else {
                $html.= '
                                    <h3 style="color:#ea2e7e;"><svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="fill: #ea2e7e;">
                                          <path d="m497.6,244.7c-63.9-96.7-149.7-150-241.6-150-91.9,1.42109e-14-177.7,53.3-241.6,150-4.5,6.8-4.5,15.7 0,22.5 63.9,96.7 149.7,150 241.6,150 91.9,0 177.7-53.3 241.6-150 4.5-6.8 4.5-15.6 0-22.5zm-241.6,131.7c-74.2,0-144.8-42.6-199.9-120.4 55-77.8 125.6-120.4 199.9-120.4 74.2,0 144.8,42.6 199.9,120.4-55.1,77.8-125.6,120.4-199.9,120.4z"></path>
                                          <path d="m256,148.5c-59.3,0-107.5,48.2-107.5,107.5 0,59.3 48.2,107.5 107.5,107.5s107.5-48.2 107.5-107.5c0-59.3-48.2-107.5-107.5-107.5zm0,175.5c-36.8,0-66.8-30.5-66.8-68 0-37.5 30-68 66.8-68 36.8,0 66.8,30.5 66.8,68 0,37.5-30,68-66.8,68z"></path>
                                        </svg> Study this one!
                                    </h3>
                                    <h6>Definition</h6>
                                    <div class="answer-result__card-desc"><p class="text-capitalise">'.$data['term_description'].'</p>'.$image.'</div>  
                                    <h6>Your Answer</h6>
                                    <div class="wrong-dark-color answer-result__card-desc">'.
                    $answer
                    .'</div>
                                    <h6><svg class="sp-icon correct-dark mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path d="M440.8,11H71.3C38,11,11,38,11,71.2v369.5C11,474,38,501,71.3,501h369.5c33.2,0,60.2-27,60.2-60.2V71.2
                                            C501,38,474,11,440.8,11z M460.2,440.8c0,10.7-8.7,19.4-19.4,19.4H71.3c-10.7,0-19.4-8.7-19.4-19.4V71.2c0-10.7,8.7-19.4,19.4-19.4
                                            h369.5c10.7,0,19.4,8.7,19.4,19.4L460.2,440.8L460.2,440.8z"></path>
                                        <path d="M232.6,357.4c-5.4,0-10.7-2-14.8-6.2l-87.6-87.6c-8.2-8.2-8.2-21.5,0-29.7c8.2-8.2,21.5-8.2,29.7,0l72.7,72.7l151.7-151.7
                                            c8.2-8.2,21.5-8.2,29.7,0c8.2,8.2,8.2,21.5,0,29.7L247.4,351.3C243.3,355.4,237.9,357.4,232.6,357.4z"></path>
                                        </svg>
                                         Correct answer
                                    </h6>   
                                    <p class="correct-dark-color">'.
                    $data['term_name']
                    .'</p>
                                    <div class="learnBtnWrapper justifycenter">
                                        <button type="button" class="createBtn nextWriteAns" onclick="nextWriteAns()">Next
                                            <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
                                                <path d="M244.1,53.7c-14.8,16.4-13.9,41.5,2,56.8l101.5,94.4l-308.4,0.7C17,206.2-0.5,224.6,0,246.7
                                                    c0.5,21.4,17.7,38.6,39.1,39.1l308.6-0.7l-101.5,94.4c-16.2,15.1-17.1,40.6-2,56.8c15.1,16.2,40.6,17.1,56.8,2l176.2-164
                                                    c8.1-7.6,12.7-18.2,12.8-29.3c0-11.1-4.6-21.7-12.8-29.3L301,51.8c-16.2-15.2-41.6-14.4-56.8,1.7c-0.1,0.1-0.2,0.2-0.2,0.2
                                                    L244.1,53.7z"></path>
                                            </svg>
                                        </button>
                                    </div>';
                $result['type'] = 2;
            }
            $result['html'] = $html;
            print_r(json_encode($result));die;
        }
    }


    function submitTest(){
        // print_r($this->input->post());die;
        $studyset_id    = $this->input->post('studyset_id');
        $total_time     = $this->input->post('total_time');

        $written_applicable     = $this->input->post('written_applicable');
        $match_applicable       = $this->input->post('match_applicable');
        $multiple_applicable    = $this->input->post('multiple_applicable');
        $truefalse_applicable   = $this->input->post('truefalse_applicable');

        $user_id        = $this->session->get_userdata()['user_data']['user_id'];

        $insertArr = array(     'userId'        => $user_id,
            'study_set_id'  => $studyset_id,
            'time_span'     => $total_time,
            'written_applicable'        => $written_applicable,
            'match_applicable'          => $match_applicable,
            'multiple_applicable'       => $multiple_applicable,
            'truefalse_applicable'      => $truefalse_applicable,
            'created_at'    => date('Y-m-d H:i:s')
        );
        $this->db->insert('test_round_master', $insertArr);

        $round_id = $this->db->insert_id();
        $total = 0; $score = 0;

        if($written_applicable == 1) {
            $written_answer = $this->input->post('written_answer');
            $written_term_id = $this->input->post('written_term_id');

            foreach ($written_term_id as $key => $value) {
                $get_term_details = $this->db->get_where('study_set_terms', array('study_set_term_id' => $value))->row_array();
                if($get_term_details['term_name'] != trim($written_answer[$key])){
                    $insertArr = array( 'round_id'      => $round_id,
                        'term_id'       => $value,
                        'type'          => 'written',
                        'user_answer'   => $written_answer[$key],
                        'created_at'    => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('test_round_details', $insertArr);
                }
                $total++;
            }
        }


        if($match_applicable == 1) {
            $matching_answer    = $this->input->post('matching_answer');
            $matching_term_id   = $this->input->post('matching_term_id');
            $letter_answer      = $this->input->post('letter_answer');

            foreach ($matching_term_id as $key => $value) {
                foreach ($letter_answer as $key2 => $value2) {
                    $letter = explode(" ",$value2);
                    if($letter[1] == $value){
                        if($matching_answer[$key] != $letter[0]){
                            $searchword = $matching_answer[$key];
                            foreach($letter_answer as $index => $string) {
                                if (strpos($string, $searchword) !== FALSE){
                                    $user_answer = explode(" ",$string);
                                    $get_term_details = $this->db->get_where('study_set_terms', array('study_set_term_id' => $user_answer[1]))->row_array();
                                    $insertArr = array( 'round_id'      => $round_id,
                                        'term_id'       => $value,
                                        'type'          => 'matching',
                                        'user_answer'   => $get_term_details['term_name'],
                                        'created_at'    => date('Y-m-d H:i:s')
                                    );
                                    $this->db->insert('test_round_details', $insertArr);
                                }
                            }

                        }
                    }
                }
                $total++;
            }
        }


        if($multiple_applicable == 1) {
            $multiple_term_id   = $this->input->post('multiple_term_id');
            foreach ($multiple_term_id as $key => $value) {
                $multiple_answer = $this->input->post('multiple_answer_'.$value);
                if($value != $multiple_answer){
                    $get_term_details = $this->db->get_where('study_set_terms', array('study_set_term_id' => $multiple_answer))->row_array();
                    $insertArr = array( 'round_id'      => $round_id,
                        'term_id'       => $value,
                        'type'          => 'multiple',
                        'user_answer'   => $get_term_details['term_name'],
                        'created_at'    => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('test_round_details', $insertArr);
                }
                $total++;
            }
        }


        if($truefalse_applicable == 1) {
            $truefalse_term_id  = $this->input->post('truefalse_term_id');
            $truefalse_term     = $this->input->post('truefalse_term');

            foreach ($truefalse_term_id as $key => $value) {
                $truefalse_answer = $this->input->post('truefalse_answer_'.$value);
                if($value == $truefalse_term[$key]){
                    if($truefalse_answer != 'true'){

                        $insertArr = array( 'round_id'      => $round_id,
                            'term_id'       => $value,
                            'type'          => 'truefalse',
                            'user_answer'   => $truefalse_answer,
                            'created_at'    => date('Y-m-d H:i:s')
                        );
                        $this->db->insert('test_round_details', $insertArr);
                    }
                } else {
                    if($truefalse_answer != 'false'){

                        $insertArr = array( 'round_id'      => $round_id,
                            'term_id'       => $value,
                            'type'          => 'truefalse',
                            'user_answer'   => $truefalse_answer,
                            'created_at'    => date('Y-m-d H:i:s')
                        );
                        $this->db->insert('test_round_details', $insertArr);
                    }
                }
                $total++;
            }
        }


        $wrong = $this->db->get_where('test_round_details', array('round_id' => $round_id))->num_rows();
        $score = $total - $wrong;
        $this->db->where(array('id' => $round_id));
        $this->db->update('test_round_master', array('total' => $total, 'score' => $score));
        redirect(site_url('studyset/testResult/'.$studyset_id.'/'.$round_id), 'refresh');
    }


    function testResult(){
        $studyset_id = $this->uri->segment('3');
        $round_id = $this->uri->segment('4');

        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['studyset'] = $this->studyset_model->getStudySetDetails($studyset_id,$user_id);
        $data['term_data'] = $this->studyset_model->getStudySetTermData($studyset_id);

        $data['round_id'] = $round_id;

        $data['round_data'] = $this->db->get_where('test_round_master', array('id' => $round_id))->row_array();



        $this->load->view('user/include/header', $this->data);
        $this->load->view('studyset/test-result',$data);
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/firebase-include');
        $this->load->view('user/include/footer');
    }


    function rateStudyset(){
        if($this->input->post()){
            // print_r($this->input->post());die;
            $user_rating        = $this->input->post('user_rating');
            $rate_description   = $this->input->post('rate_description');
            $if_anonymous       = $this->input->post('if_anonymous');
            $rate_studyset      = $this->input->post('rate_studyset');

            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $chk_if_rated = $this->db->get_where('studyset_rating_master', array('study_set_id' => $rate_studyset, 'user_id' => $user_id))->row_array();

            if(!empty($chk_if_rated)) {
                $this->db->where(array('id' => $chk_if_rated['id']));
                $this->db->update('studyset_rating_master', array('rating' => $user_rating, 'description' => $rate_description, 'created_at' => date('Y-m-d H:i:s')));
            } else {

                $insertArr = array( 'study_set_id'      => $rate_studyset,
                    'user_id'           => $user_id,
                    'rating'            => $user_rating,
                    'description'       => $rate_description,
                    'if_anonymous'      => $if_anonymous,
                    'created_at'        => date('Y-m-d H:i:s')
                );
                $this->db->insert('studyset_rating_master', $insertArr);
            }

            redirect(site_url('studyset/details/'.$rate_studyset), 'refresh');
        }
    }
}
