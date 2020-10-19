<?php
class Upload_model extends CI_Model{

    function save_upload($post_id,$image){
        $data = array(
            'post_id'     => $post_id,
            'image_path' => $image,
            'created_at' => date('d-m-Y H:i:s'),
            'updated_at' => date('d-m-Y H:i:s')
        );
        $result= $this->db->insert('post_images',$data);
        return $result;
    }


}