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

    public function getUserGroups($id)
    {
        $query =   $this->db->select('*')

            ->from('user_chat_group_users')

            ->where('peer_id', $id);

        $query = $query->get();

        return $query->result_array();
    }

    public function getChatMembersList($users = [])
    {
        $query = $this->db->select('*')

            ->from('user')

            ->where_in('id', $users)

            ->get();

        return $query->result_array();
    }

    public function createGroup($insert)
    {
        $this->db->insert('user_chat_groups', $insert);
        return $this->db->insert_id();
    }

    public function createUserInGroup($insert)
    {
        $this->db->insert_batch('user_chat_group_users', $insert);
    }

    public function getUserGroupsNames($userId)
    {

        $query =  $this->db->select('user_chat_groups.*')

            ->from('user_chat_group_users')

            ->join('user_chat_groups', 'user_chat_groups.group_id = user_chat_groups.id', 'INNER')

            ->where('user_chat_group_users.peer_id', $userId)

            ->get();

        return $query->result_array();
    }



    public function getMyGroupMembers($groupId)
    {

        $query =  $this->db->select('*')

            ->from('user_chat_group_users')

            ->where('user_chat_group_users.group_id', $groupId)

            ->get();

        return $query->result_array();
    }
}
