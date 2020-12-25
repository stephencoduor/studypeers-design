<?php

/**
 * @className : HomeController
 * @category : controller 
 * @description : controller class to handle step wise registration
 * @author : Jatin Pandey
 */

require APPPATH . 'controllers/BaseController.php';

class HomeController extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('RegistrationModel');
    }

    /**
     * stepRegisterPage
     * @param : dataArr
     */

    public function stepRegisterPage()
    {
        $data = [];

        $data['userData'] = $this->user_model->getUserById($this->user_id);

        $data['existinData'] = $this->user_model->getUserInfo($this->user_id);

        $this->includeTemplate('user/registration/register-step-first', $data);
    }


    /**
     * stepThreePage
     * @param : null
     * @return : application/html
     */


    public function stepThreePage()
    {
        $data = [];
        $data['session'] = $this->getSessionDataTillYear();

        $this->includeTemplate('user/registration/register-step-three', $data);
    }

    /**
     * stepFourPage
     * @param : nullabl
     * @return : application/html
     */

    public function stepFourPage()
    {
        $data = [];

        $this->includeTemplate('user/registration/register-step-four', $data);
    }


    /**
     * submitStepWiseData
     * @param : data
     * @param : step
     */

    public function submitStepWiseData()
    {

        try {

            if (!$this->input->is_ajax_request()) {
                throw new Exception("Invalid request", 422);
            }

            $step = $this->input->get('step');

            $dataArr = $this->input->get();

            switch ($step) {

                case 'one':

                    $response = $this->createOrUpdateBasicInformation($dataArr);
                    break;

                case 'two':

                    $response = $this->createWhereYouStudy($dataArr);
                    break;

                case 'three':

                    $response = $this->createWhatAreYouStudy($dataArr);
                    break;


                case 'four':

                    $response = $this->storePrivacy($dataArr);
                    break;


                default:

                    break;
            }
        } catch (Exception $e) {
            $response = [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header($response['code'])
            ->set_output(json_encode($response));
    }

    /**
     * storePrivacy
     * @param : null
     * @return : application/json
     */

    public function storePrivacy($data)
    {
        $this->validatePrivacy($data);

        return $this->finalSubmissionPrivacy($data);
    }

    /**
     * validatePrivacy
     * @data
     * 
     */

    public function validatePrivacy($data)
    {

        if (empty($data['privacy'])) {
            throw new Exception("Privacy field is required", 422);
        }

        if ($data['privacy'] == 'nick_name') {

            if (empty($data['nickname_text'])) {
                throw new Exception("Nick name is required", 422);
            }
        }
    }

    /**
     * createWhatAreYouStudy
     * @param : dataArr
     * @return : application/json
     */

    public function createWhatAreYouStudy($data)
    {

        $this->validateWhatAreYouStudy($data);

        // store new data into the database for the update.

        $updateUserInfo = [];
        $updateUserInfo['degree'] = $data['degree'];
        $updateUserInfo['field_interest'] = $data['field_of_interest'];
        $updateUserInfo['course'] = empty($data['manual_field']) ? 0 : $data['field'];
        $updateUserInfo['major'] = empty($data['manual_major']) ? 0 :  $data['major'];
        $updateUserInfo['session'] = $data['session'];
        $updateUserInfo['field_type'] = empty($data['manual_field']) ? 1 : 2; //2 for manual for entry
        $updateUserInfo['major_type'] = empty($data['manual_major'])  ? 1 : 2; // 2 for manual entry
        $updateUserInfo['add_major'] = empty($data['manual_major']) ? "" :  $data['manual_major'];; // manual major name
        $updateUserInfo['add_course'] = empty($data['manual_field']) ? "" : $data['manual_field'];; // manual field name
        $updateUserInfo['manual_verification'] = 0; //1 for manual case

        $this->user_model->update_data('user_info', [
            'userID' => $this->user_id
        ], $updateUserInfo);

        $updateStep = [];
        $updateStep['form_step'] = 3;
        $this->user_model->update_data('user', [
            'id' => $this->user_id
        ], $updateStep);

        $response = [
            'code' => 200,
            'message' => 'OK',
            'url' => base_url('home/step-four-page')
        ];

        return $response;
    }


    /**
     * validateWhatAreYouStudy
     * @param : array
     * @return : null
     * 
     */

    public function validateWhatAreYouStudy($data)
    {
        if ($data['manual_field']) {

            if (empty($data['field'])) {
                throw new Exception("Field of study field is required", 422);
            }
        }

        if ($data['manual_major']) {

            if (empty($data['major'])) {
                throw new Exception("Major field is required", 422);
            }
        }


        if (empty($data['degree'])) {
            throw new Exception("Degree field is required", 422);
        }

        if (empty($data['session'])) {
            throw new Exception("Session field is required", 422);
        }

        if (empty($data['field_of_interest'])) {
            throw new Exception("Field of interest is required", 422);
        }
    }


    /**
     * createWhereYouStudy
     * @param : dataArr
     */

    public function createWhereYouStudy($data)
    {
        $this->validateWhereYouStudy($data);

        $UniverData  = [];

        if (!empty($data['university'])) {
            $UniverData = $this->RegistrationModel->getUniversityById($data['university']);
        }

        $updateUniversityInformation = [];
        $updateUniversityInformation['intitutionID'] = empty($UniverData['university_id']) ? 0 : $UniverData['university_id'];
        $updateUniversityInformation['institute_type'] = 1; // currently existing one.
        $updateUniversityInformation['intitution_email'] = $data['email'];
        $updateUniversityInformation['manual_verification'] = empty($data['manual_verification']) ? 0 : 1;
        $updateUniversityInformation['intitution_idcard'] = $data['file_name'];
        $updateUniversityInformation['add_institute'] = empty($data['manual_university']) ? "" : $data['manual_university']; // new university name if added by user

        $this->user_model->update_data('user_info', [
            'userID' => $this->user_id
        ], $updateUniversityInformation);

        $updateStep = [];
        $updateStep['form_step'] = 2;
        $this->user_model->update_data('user', [
            'id' => $this->user_id
        ], $updateStep);

        $response = [
            'code' => 200,
            'message' => 'OK',
            'url' => base_url('home/step-three-page')
        ];

        return $response;
    }


    /**
     * validateWhereYouStudy
     * @param : $data
     */

    public function validateWhereYouStudy($data)
    {

        if (empty($data['manual_university'])) {

            if (empty($data['university'])) {
                throw new Exception("University is field is required", 422);
            }
        }


        if (!isset($data['dont_have_email'])) {

            if (empty($data['email'])) {
                throw new Exception("Email is field is required", 422);
            }

            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Email field is not valid", 422);
            }

            if (!empty($data['email'])) {

                if (!isset($data['manual_verification'])) {

                    #verify if its from same university
                    $explode = explode("@", $data['email']);
                    $domain = $explode[1];

                    $UniverData = $this->RegistrationModel->getUniversityById($data['university']);

                    if (empty($UniverData)) {
                        throw new Exception("Error processing request", 422);
                    }

                    if ($UniverData['EmailDomain'] != $domain) {
                        throw new Exception("University domain not verified. Try submitting form with manual email verification", 422);
                    }
                }
            }
        }

        if (isset($data['dont_have_email'])) {
            # file upload is mandatory
            if (empty($data['file_name'])) {
                throw new Exception("University identity document is required", 422);
            }
        }
    }


    /**
     * createOrUpdateBasicInformation
     * @param  : dataArr
     */

    public function createOrUpdateBasicInformation($data)
    {

        $this->validationStepOne($data);


        $updateNewUserInfo = [];
        $updateNewUserInfo['first_name'] = $data['first_name'];
        $updateNewUserInfo['last_name'] = $data['last_name'];
        $updateNewUserInfo['phone'] = $data['mobile_no'];
        $updateNewUserInfo['country_code'] = empty($data['country_code']) ? null : $data['country_code'];
        $updateNewUserInfo['form_step'] = 1;

        $this->user_model->update_data('user', [
            'id' => $this->user_id,
        ], $updateNewUserInfo);

        $createAdditionInfo['userID'] = $this->user_id;
        $createAdditionInfo['dob']    = $data['dob'];
        $createAdditionInfo['gender'] = $data['gender'];

        $this->user_model->insert_data('user_info', $createAdditionInfo);

        $response = [
            'code' => 200,
            'message' => 'OK',
            'url' => base_url('home/step-two-page')
        ];

        return $response;
    }

    /**
     * stepTwoPage
     * @param : null
     */

    public function stepTwoPage()
    {
        $data = [];

        $this->includeTemplate('user/registration/register-step-second', $data);
    }

    /**
     * getMyUniversityList
     */

    public function getMyUniversityList()
    {
        $search = $this->input->get('q');
        $data = [];

        $data =  $this->RegistrationModel->getUniversity($search);

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(['results' => $data]));
    }

    /**
     * getFieldList
     * @return : application/json
     */


    public function getFieldList()
    {
        $search = $this->input->get('q');
        $data = [];

        $data =  $this->RegistrationModel->getFieldList($search);

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(['results' => $data]));
    }

    /**
     * getMajorList
     * @param : null
     * @return  : application/json
     * 
     */

    public function getMajorList()
    {
        $search = $this->input->get('q');

        $id = $this->input->get('id');
        $data = [];

        $data =  $this->RegistrationModel->getMajorList($id, $search);

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(['results' => $data]));
    }





    /**
     * validationStepOne
     */

    private function validationStepOne($data)
    {

        if (empty($data['first_name'])) {
            throw new Exception("First name field is required", 422);
        }


        if (empty($data['last_name'])) {
            throw new Exception("Last name field is required", 422);
        }


        if (empty($data['mobile_no'])) {
            throw new Exception("Mobile Number field is required", 422);
        }


        if (empty($data['dob'])) {
            throw new Exception("DOB field is required", 422);
        }


        if (empty($data['gender'])) {
            throw new Exception("Gender field is required", 422);
        }
    }

    /**
     * uploadDocument
     */

    public function uploadDocument()
    {
        $url = "";
        $fileTypes = [
            'jpg', 'jpeg', 'gif', 'png', 'zip', 'xlsx', 'cad',
            'pdf', 'doc', 'docx', 'ppt', 'pptx', 'pps', 'ppsx',
            'odt', 'xls', 'xlsx', '.mp3', 'm4a', 'ogg', 'wav',
            'mp4', 'm4v', 'mov', 'wmv'
        ];

        $config['upload_path']      = 'uploads/user_identification/';
        $config['allowed_types']    = $fileTypes;
        $config['max_size']         = '0';
        $config['encrypt_name'] = TRUE;
        $config['remove_spaces'] = TRUE;  //it will remove all spaces

        $this->load->library('upload', $config);

        try {

            if (!$this->upload->do_upload('file')) {
                $this->success  = false;
                $this->response = $this->upload->display_errors();
            } else {
                $this->success  = true;
                $this->response = $this->upload->data();
                $url = base_url() . 'uploads/user_identification/' . $this->response['file_name'];
            }

            $response = [
                'code' => 200,
                'status' => $this->success,
                'data' => $this->response,
                'url' => $url
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
            ->set_output(json_encode($response));
    }


    public function getSessionDataTillYear()
    {
        $currentYear = date('Y');
        $currentMonth =  date('m');
        $endYear = 2010;
        $data = [];

        if ($currentMonth == 12) {
            $currentYear++;
        }

        for ($i = ($currentYear - 1); $i >= $endYear; $i--) {
            $Summerdata = [
                'value' => $i . '-' . ($i + 1),
                'text' => 'Summer (' . $i . '-' . ($i + 1) . ' )'
            ];

            array_push($data, $Summerdata);

            $Winterdata = [
                'value' => $i . '-' . ($i + 1),
                'text' => 'Winter (' . $i . '-' . ($i + 1) . ' )'
            ];

            array_push($data, $Winterdata);
        }


        return $data;
    }

    /**
     * finalSubmissionPrivacy
     * @param : null
     * @return : application/json
     */

    public function finalSubmissionPrivacy($dataArr)
    {
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $get_user = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $get_user_info = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();
        $first_name = $get_user['first_name'];
        $last_name  = $get_user['last_name'];

        $institute_id   = $get_user_info['intitutionID'];
        $institute_type = $get_user_info['institute_type'];
        $add_institute  = $get_user_info['add_institute'];

        $intitution_email   = $get_user_info['intitution_email'];

        $field_type     = $get_user_info['field_type'];
        $add_course     = $get_user_info['add_course'];

        $major_type     = $get_user_info['major_type'];
        $add_major      = $get_user_info['add_major'];


        $full_name = $first_name . ' ' . $last_name;
        if ($institute_type == 1) {
            $get_university = $this->db->get_where('university', array('university_id' => $institute_id))->row_array();
            $university = $get_university['SchoolName'];
        } else {
            $university =  $add_institute;
            $this->email_model->send_new_university_email('admin@studypeers.com', $university, $full_name, base_url());
        }

        if ($field_type == 1 && $major_type == 2) {
            $this->email_model->send_new_major_email('admin@studypeers.com', $full_name, $add_major, base_url());
        } else if ($field_type == 2 && $major_type == 2) {
            $this->email_model->send_new_course_email('admin@studypeers.com', $full_name, $add_major, $add_course, base_url());
        }

        if ($get_user_info['manual_verification'] == 1 || $field_type == 1 || $major_type == 1) {
            if ($get_user_info['manual_verification'] == 1) {
                $this->email_model->send_manual_verification('admin@studypeers.com', $university, $full_name, $intitution_email, base_url());
            }
            $this->email_model->send_manual_verification_student($get_user['email']);
        } else {
            $this->email_model->send_verification_by_student($get_user['email']);
        }

        if (!empty($intitution_email) && !$this->input->post('manual_verification_check')) {
            $this->email_model->send_new_user_email('admin@studypeers.com', $full_name, $intitution_email);
        }


        if ($institute_type == 1 && $get_user_info['manual_verification'] == 0 && !empty($intitution_email)) {
            $this->email_model->send_uni_verification_by_student($intitution_email, $university, base_url() . 'User/verify_university_email/' . $user_id);
        }

        $data['profile_setting'] = empty($dataArr['profile_setting']) ? 0 : 1;
        $data['privacy'] = $dataArr['privacy'];
        $data['nickname'] =  $dataArr['nickname_text'];

        $this->db->where(array('userID' => $user_id));
        $this->db->update('user_info', $data);

        $update_arr = array(
            'form_step' => 4,
            'form_completed' => 1,
            'is_detailed' => 1
        );

        $this->db->where(array('id' => $user_id));
        $this->db->update('user', $update_arr);

        $user = $this->session->get_userdata()['user_data'];
        $user['is_logged_in'] = 2;
        $this->session->set_userdata('user_data', $user);

        $response = [
            'code' => 200,
            'message' => 'OK',
            'url' => base_url('account/dashboard')
        ];

        return $response;
    }

    public function logoutUser()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
