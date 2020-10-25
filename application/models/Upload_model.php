<?php
class Upload_model extends CI_Model{

    function save_image($post_id,$image){
        $data = array(
            'post_id'     => $post_id,
            'image_path' => $image,
            'created_at' => date('d-m-Y H:i:s'),
            'updated_at' => date('d-m-Y H:i:s')
        );
        $result= $this->db->insert('post_images',$data);
        return $result;
    }

    function save_video($post_id, $video){
        $data = array(
            'post_id'     => $post_id,
            'video_path' => $video,
            'created_at' => date('d-m-Y H:i:s'),
            'updated_at' => date('d-m-Y H:i:s')
        );
        $result= $this->db->insert('post_videos',$data);
        return $result;
    }


}