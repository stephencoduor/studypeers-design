<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Studyset_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        
    }

    function getUserData($user_id)
    {
        $this->db->select('ui.intitutionID,uv.SchoolName');
        $this->db->from('user as u');
        $this->db->join('user_info as ui','u.id = ui.userID','inner');
        $this->db->join('university as uv','uv.university_id = ui.intitutionID','inner');
        $this->db->where('u.id',$user_id);
        $userdata = $this->db->get()->row_array();    
        return $userdata;
    }

    function getStudySets($user_id)
    {   
        $peer_list = $this->peerList($user_id); 
        $List = implode(', ', $peer_list); 
        
        $page = (isset($_POST['page']) && $_POST['page'] > 0) ? $_POST['page'] : 0;
        $this->db->select('s.*,u.first_name,u.last_name,u.image as user_image,cm.name as course_name,pm.name as professor_name,uv.SchoolName as institution_name,');
        $this->db->from('study_sets as s');
        $this->db->join('user as u','u.id = s.user_id','inner');
        $this->db->join('course_master as cm','cm.id = s.course','inner');
        $this->db->join('professor_master as pm','pm.id = s.professor','inner');
        $this->db->join('university as uv','uv.university_id = s.institution','inner');
        if(isset($_GET['study_search']) && $_GET['study_search'] != ''){
            $txt = $_GET['study_search'];
            $this->db->where("(s.name like '%$txt%' OR uv.SchoolName like '%$txt%' OR cm.name like '%$txt%' OR pm.name like '%$txt%')");
        }

        if(isset($_GET['institution']) && $_GET['institution'] != '') {
            $this->db->where("s.institution",$_GET['institution']);
        }

        if(isset($_GET['course']) && $_GET['course'] != '') {
            $this->db->where("s.course",$_GET['course']);
        }

        if(isset($_GET['professor']) && $_GET['professor'] != '') {
            $this->db->where("s.professor",$_GET['professor']);
        }

        if(isset($_GET['order_by']) && $_GET['order_by'] != '') {
            $this->db->order_by('s.'.$_GET['order_by'],'desc');
        } else {
            $this->db->order_by('s.study_set_id', 'desc');
        }
    
        $this->db->where('s.user_id',$user_id);
        if(!empty($peer_list)) { 
            $this->db->or_group_start(); 
            $this->db->where_in('s.user_id', $List);
            $this->db->where('s.privacy',1);
            $this->db->group_end();   
        }
        $this->db->or_group_start();
        $this->db->where("s.`study_set_id` IN (SELECT `reference_id` FROM `share_master` where `reference` = 'studyset' and status = 1 and peer_id = ".$user_id.")", NULL, FALSE);
        $this->db->group_end();
        $this->db->where('s.status',1);
        $this->db->limit(PER_PAGE, $page * PER_PAGE);
        $study_sets = $this->db->get()->result_array(); 
        // echo $this->db->last_query();die;   
        $final_study_set = array();
        foreach ($study_sets as $key => $value) {
            $value['time_ago'] = $this->to_time_ago(strtotime($value['created_on']));
            $value['isLikedByUser'] = $this->isLikedByUser($user_id,$value['study_set_id']); 
            array_push($final_study_set, $value);
        }
    
        return $final_study_set;
    }


    function peerList($user_id){
        $peer_list = $this->db->query("SELECT * FROM `peer_master` WHERE (`user_id` = '".$user_id ."' OR `peer_id` = '".$user_id ."') AND `status` = 2")->result_array();
        $peer = array();
        foreach ($peer_list as $key => $value) {
            if($value['user_id'] == $user_id){
                $peer[$key] = $value['peer_id']; 
            } else {
                $peer[$key] = $value['user_id']; 
            }
        }
        return $peer;
    }

    function getTotalStudySets($user_id)
    {
        $this->db->select('s.study_set_id');
        $this->db->from('study_sets as s');
        $this->db->join('user as u','u.id = s.user_id','inner');
        $this->db->join('course_master as cm','cm.id = s.course','inner');
        $this->db->join('professor_master as pm','pm.id = s.professor','inner');
        $this->db->join('university as uv','uv.university_id = s.institution','inner');
        if(isset($_GET['study_search']) && $_GET['study_search'] != ''){
            $txt = $_GET['study_search'];
            $this->db->where("(s.name like '%$txt%' OR uv.SchoolName like '%$txt%' OR cm.name like '%$txt%' OR pm.name like '%$txt%')");
        }

        if(isset($_GET['institution']) && $_GET['institution'] != '') {
            $this->db->where("s.institution",$_GET['institution']);
        }

        if(isset($_GET['course']) && $_GET['course'] != '') {
            $this->db->where("s.course",$_GET['course']);
        }

        if(isset($_GET['professor']) && $_GET['professor'] != '') {
            $this->db->where("s.professor",$_GET['professor']);
        }

        if(isset($_GET['order_by']) && $_GET['order_by'] != '') {
            $this->db->order_by('s.'.$_GET['order_by'],'desc');
        }
        
        $this->db->where('s.user_id',$user_id);
        $this->db->where('s.status',1);
        $study_sets = $this->db->get(); 
    
        return $study_sets->num_rows();
    }


    public function getStudySetDetails($study_set_id,$user_id)
    {
        $this->db->select('s.*,u.first_name,u.last_name,u.image as user_image,cm.name as course_name,pm.name as professor_name,uv.SchoolName as institution_name,');
        $this->db->from('study_sets as s');
        $this->db->join('user as u','u.id = s.user_id','inner');
        $this->db->join('course_master as cm','cm.id = s.course','inner');
        $this->db->join('professor_master as pm','pm.id = s.professor','inner');
        $this->db->join('university as uv','uv.university_id = s.institution','inner');
        $this->db->where('s.study_set_id',$study_set_id);        
        $this->db->where('s.status',1);
        $study_set = $this->db->get()->row_array(); 
        //echo $this->db->last_query();die;   
        
        $study_set['time_ago'] = $this->to_time_ago(strtotime($study_set['created_on']));
        $study_set['isLikedByUser'] = $this->isLikedByUser($user_id,$study_set['study_set_id']); 
            
        return $study_set;
    }

    function to_time_ago( $time ) 
    { 
        $diff = time() - $time; 
          
        if( $diff < 1 ) {  
            return 'less than 1 second ago';  
        } 
          
        $time_rules = array (  
                    12 * 30 * 24 * 60 * 60 => 'year', 
                    30 * 24 * 60 * 60       => 'month', 
                    24 * 60 * 60           => 'day', 
                    60 * 60                   => 'hour', 
                    60                       => 'minute', 
                    1                       => 'second'
        ); 
      
        foreach( $time_rules as $secs => $str ) { 
              
            $div = $diff / $secs; 
      
            if( $div >= 1 ) { 
                  
                $t = round( $div ); 
                  
                return $t . ' ' . $str .  
                    ( $t > 1 ? 's' : '' ) . ' ago'; 
            } 
        } 
    }

    function getStudySetData($study_set_id)
    {
        $this->db->select('s.*');
        $this->db->from('study_sets as s');
        $this->db->where('study_set_id',$study_set_id);
        $study_set_data = $this->db->get()->row_array();    
        
        $term_data = $this->getStudySetTermData($study_set_data['study_set_id']);

        $study_set_data['term_data'] = $term_data;
        return $study_set_data;
    }

    function getStudySetTermData($study_set_id) {
        $this->db->select('t.*');
        $this->db->from('study_set_terms as t');
        $this->db->where('t.study_set_id',$study_set_id);
        return $this->db->get()->result_array();
    }

    function getCourseData($user_id)
    {
        $this->db->select('c.*');
        $this->db->from('course_master as c');
        $this->db->where('c.user_id',$user_id);
        $course_data = $this->db->get()->result_array();    
        
        return $course_data;
    }

    function manageStudySet($data)
    {
        if(isset($data['study_set_id']) && $data['study_set_id'] > 0) {
            $data['updated_on'] = date("Y-m-d H:i:s");
            $this->db->where('study_set_id', $data['study_set_id']);
            $this->db->update('study_sets',$data);
            $study_set_id = $data['study_set_id'];
        } else {
            $data['created_on'] = date("Y-m-d H:i:s");
            $data['updated_on'] = date("Y-m-d H:i:s");
            $data['status'] = 1;
            $data['likes_count'] = 0;
            $data['share_count'] = 0;
            $data['rating_count'] = 0;
            unset($data['study_set_id']);
            $result = $this->db->insert('study_sets',$data);
            $study_set_id = $this->db->insert_id();
        }

        return $study_set_id;
    }

    function manageStudySetTerms($terms)
    {
        foreach ($terms as $key => $term) {
            if(isset($term['study_set_term_id']) && $term['study_set_term_id'] > 0) {
                $term['updated_on'] = date("Y-m-d H:i:s");
                $this->db->where('study_set_term_id', $term['study_set_term_id']);
                $result = $this->db->update('study_set_terms',$term);
            } else {
                $term['created_on'] = date("Y-m-d H:i:s");
                $term['updated_on'] = date("Y-m-d H:i:s");
                $term['status'] = 1;
                unset($term['study_set_term_id']);
                $result = $this->db->insert('study_set_terms',$term);
            }
        }
        
        return $result;
    }
        

    function deleteStudySet($study_set_id)
    {
        $this->db->where('study_set_id', $study_set_id);
        $result = $this->db->update('study_sets',array('status' => 2));
        return $result;
    }

    function removeStudySet($study_set_id)
    {   
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $this->db->where(array('reference_id' => $study_set_id, 'reference' => 'studyset', 'peer_id' => $user_id));
        $result = $this->db->update('share_master',array('status' => 3));

        return $result;
    }

    function getProfessors($course_id)
    {
        $this->db->select('*');
        $this->db->from('professor_master');
        $this->db->where('course_id',$course_id);
        $data = $this->db->get()->result_array();    
        return json_encode($data);
    }

    function manageLikes($user_id) {
        $study_set_id = $this->input->post('study_set_id'); 
        $isLike = $this->isLikedByUser($user_id,$study_set_id); 
        $flag = 0;

        if($isLike) {
            $this->db->where('user_id',$user_id);
            $this->db->where('study_set_id',$study_set_id);
            $result = $this->db->delete('likes');

            $this->db->where('study_set_id',$study_set_id);
            $this->db->set('likes_count', 'likes_count-1', FALSE);
            $update_like = $this->db->update('study_sets');
            return 2;
        } else {
            $like_array = array(
                                    "study_set_id" => $study_set_id,
                                    "user_id" => $user_id,
                                    "liked_on" => date("Y-m-d H:i:s"),
                                    "status" => 1
                                );
            $result = $this->db->insert('likes',$like_array);

            $this->db->where('study_set_id',$study_set_id);
            $this->db->set('likes_count', 'likes_count+1', FALSE);
            $update_like = $this->db->update('study_sets');
            return 1;
            
        }
    }

    function updateShareCount($study_set_id){
        $this->db->where('study_set_id',$study_set_id);
        $this->db->set('share_count', 'share_count+1', FALSE);
        $update_like = $this->db->update('study_sets');
        return 1;
    }

     function isLikedByUser($user_id,$study_set_id) {

        $this->db->select('like_id');
        $this->db->from('likes');
        $this->db->where('user_id',$user_id);
        $this->db->where('study_set_id',$study_set_id);
        $isLike = $this->db->get()->num_rows();
        return $isLike;
    }

    function reportStudySet($study_set_id,$user_id,$report_data)
    {
        $insert = $this->db->insert('reported',$report_data);
        if($insert) {
            $this->db->where('study_set_id', $study_set_id);
            $result = $this->db->update('study_sets',array('status' => 3));
        }
        
        return $result;
    }
}
