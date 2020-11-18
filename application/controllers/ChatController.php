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

                    $data[$key]['id'] = $val['id'];
                    $data[$key]['left'] = base_url() . 'uploads/users/' . $val['image'];
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
}
