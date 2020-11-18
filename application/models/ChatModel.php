<?php

class ChatModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getFriendsByUserId($id, $search)
    {
        $query = $this->db->select('*')

            ->from('friends')

            ->join('user', 'user.id = friends.peer_id')

            ->where('friends.user_id', $id);

        if (!empty($search)) {

            $this->db->group_start();
            $this->db->like('user.first_name', $search, 'both');
            $this->db->or_like('user.email', $search, 'both');
            $this->db->group_end();
        }



        $query = $query->get();

        return $query->result_array();
    }
}
