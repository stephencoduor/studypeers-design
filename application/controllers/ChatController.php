<?php

/**
 * class : ChatController
 * @category : class
 * @author : jay.pandey45@gmail.com
 * @description : controller class to handle chat module.
 */

class ChatController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('ChatModel');
    }

    /**
     * getPeers
     * @param : search
     * 
     */

    public function getPeers()
    {
        try {

            $userId =  $this->session->get_userdata()['user_data']['user_id'];
            $search = $this->input->get('search');

            if (empty($userId)) {
                throw new Exception("Error processing request", 422);
            }

            $getFriends = $this->ChatModel->getFriendsByUserId($userId, $search);

            $data = [];

            if (!empty($getFriends)) {

                foreach ($getFriends as $key => $val) {

                    $data[$key]['value'] = $val['id'];
                    $data[$key]['left'] = empty($val['image']) ? base_url() . 'uploads/user-male.png' : base_url() . 'uploads/users/' . $val['image'];
                    $data[$key]['text'] = $val['first_name'] . ' ' . $val['last_name'];
                    $data[$key]['subtitle'] = $val['username'];
                }
            }

            $response = [
                'code' => 200,
                'message' => 'OK',
                'data' => $data
            ];
        } catch (Exception $e) {

            $response = [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'data' => []
            ];
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header($response['code'])
            ->set_output(json_encode($response['data']));
    }

    /**
     * createUserGroup
     * @param : 
     */

    public function createUserGroup()
    {
        try {
            $users = $this->input->get('usergroupschats');

            if (!is_array($users)) {
                throw new Exception("Error processing request", 422);
            }

            #create new user group.
            $userId =  $this->session->get_userdata()['user_data']['user_id'];

            $chatMembersList = $this->ChatModel->getChatMembersList($users);

            array_push($users, $userId);

            $createGroup = [];
            $createGroup['user_id'] = $userId;
            $createGroup['group_name'] = implode(',', array_column($chatMembersList, 'first_name'));

            $getCreativeGroupId = $this->ChatModel->createGroup($createGroup);

            $createUsersInGroup = [];

            foreach ($users as $key => $val) {

                $createUsersInGroup[$key]['group_id'] = $getCreativeGroupId;
                $createUsersInGroup[$key]['peer_id'] = $val;
            }

            $this->ChatModel->createUserInGroup($createUsersInGroup);

            #get chat user groups.

            $sendMembersList = $this->ChatModel->getChatMembersList($users);

            $response = [
                'code' => 200,
                'message' => 'OK',
                'data' => [
                    'groupId' => $getCreativeGroupId,
                    'groupInfo' => $createGroup,
                    'users' => $sendMembersList,
                ]
            ];
        } catch (\Exception $e) {
            $response = [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'data' => []
            ];
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header($response['code'])
            ->set_output(json_encode($response));
    }

    /**
     * getUserChat
     * @param : userId
     */

    public function getUserChat()
    {
        try {

            $userId =  $this->session->get_userdata()['user_data']['user_id'];


            $result = $this->ChatModel->getUserGroups($userId);

            $data = [];

            if (!empty($result)) {

                $data = array_column($result, 'group_id');
            }

            $response = [
                'code' => 200,
                'message' => 'OK',
                'data' => $data
            ];
        } catch (Exception $e) {

            $response = [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'data' => []
            ];
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header($response['code'])
            ->set_output(json_encode($response, JSON_NUMERIC_CHECK));
    }

    /**
     *  getUserGroupNames
     */

    public function getUserGroupNames()
    {

        try {

            $userId =  $this->session->get_userdata()['user_data']['user_id'];

            $result = $this->ChatModel->getUserGroupsNames($userId);

            $response = [
                'code' => 200,
                'message' => 'OK',
                'data' => $result
            ];
        } catch (Exception $e) {

            $response = [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'data' => []
            ];
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header($response['code'])
            ->set_output(json_encode($response, JSON_NUMERIC_CHECK));
    }

    /**
     * addNewGroupMember
     * @param : getArra
     */

    public function addNewGroupMember()
    {

        try {
            $users = $this->input->get('users');
            $groupId = $this->input->get('group_id');

            if (!is_array($users)) {
                throw new Exception("Error processing request", 422);
            }

            #create new user group.

            $createUsersInGroup = [];

            foreach ($users as $key => $val) {

                $createUsersInGroup[$key]['group_id'] = $groupId;
                $createUsersInGroup[$key]['peer_id'] = $val;
            }

            $this->ChatModel->createUserInGroup($createUsersInGroup);

            #get chat user groups.

            $sendMembersList = $this->ChatModel->getChatMembersList($users);

            $response = [
                'code' => 200,
                'message' => 'OK',
                'data' => [
                    'groupId' => $groupId,
                    'users' => $sendMembersList,
                ]
            ];
        } catch (\Exception $e) {
            $response = [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'data' => []
            ];
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header($response['code'])
            ->set_output(json_encode($response));
    }
}
