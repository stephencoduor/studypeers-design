<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Sync extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper("file");
//        $this->canvas->setApiHost('https://canvas-lms.ga/');
//        $this->canvas->setToken('w5pvCgZFyuNYXUhraM0ELwJ4GM8byiakiPzdtJGP5b3r7vMLZlLc9mb9pFiAFvlF');
//        $this->canvas->setToken($token);

    }

    public function courses($user_id = 76,$api_host='https://canvas-lms.ga/',
                            $token='w5pvCgZFyuNYXUhraM0ELwJ4GM8byiakiPzdtJGP5b3r7vMLZlLc9mb9pFiAFvlF',$university_id=1)
    {
        error_reporting(E_ALL & ~E_NOTICE);
        $this->canvas->setApiHost($api_host);
        $this->canvas->setToken($token);
        $user = $this->canvas->users->getProfile()->getContent();
        $courses = $this->canvas->courses->listCoursesForUser($user->id)->getContent();
        if ($courses) {

            try {
                foreach ($courses as $course) {
                    print '----> Starting sync for ' . $course->id . "\n";
                    if (!@property_exists($courses, 'error') && !@property_exists($courses, 'errors')) {

                        if(!is_null($course->name) && !empty($course->name)) {
                            $data = [
                                "user_id" => $user_id,
                                "course_id" => $course->id,
                                "name" => $course->name ?: "_",
                                "course_code" => $course->course_code ?: "_",
                                "created_at" => $course->created_at ?: "_",
                                'status' => 1,
                                'university_id' => $university_id ?: "0",
                                'grading_standard_id' => $course->grading_standard_id ?: "0",
                                'start_at' => $course->start_at ?? date('Y-m-d H:i:s'),
                                'end_at' => $course->end_at ?: "_",
                                // 'locale' => $course->locale,
                                'enrollments' => json_encode($course->enrollments),
                                // 'total_students' => $course->total_students,
                                'calendar' => is_null($course->calendar) ?? $course->calendar->ics,
                                // 'syllabus_body' => $course->syllabus_body,
                                // 'course_progress' => $course->course_progress,
                                'apply_assignment_group_weights' => $course->apply_assignment_group_weights ?: "0",
                                'time_zone' => $course->time_zone ?: "_",
                                'uuid' => $course->uuid ?: "_",
                            ];

                            try {
                                $exist = $this->db->query("select * from course_master where course_id={$course->id} LIMIT 1");
                                $exist->num_rows() > 0 ? ($this->db->where("course_id", $course->id)->update('course_master', $data)) : $this->db->insert('course_master', $data);
                            } catch (Exception $e) {
                                echo 'Message: ' . $e->getMessage();
                            }
                            //sync assignments

                            
                            try {
                                print "\t" . '- Syncing assignments for ' . $course->name . "\n";
                                $this->syncAssignments($user->id, $user_id, $course->id);
                            } catch (Exception $e) {
                                echo 'Message: ' . $e->getMessage();
                            }
                            try {
                                print "\t" . '- Syncing quizzes for ' . $course->name . "\n";

                                $this->syncQuizzes($course->id, $user_id);
                            } catch (Exception $e) {
                                echo 'Message: ' . $e->getMessage();
                            }
                            try {
                                print "\t" . '- Syncing discussions for ' . $course->name . "\n";
                                $this->syncDiscussions($course->id, $user_id);
                            } catch (Exception $e) {
                                echo 'Message: ' . $e->getMessage();
                            }
                            try {


                                print "\t" . '- Syncing files for ' . $course->name . "\n";
                                $this->syncFiles($course->id, $user_id);
                            } catch (Exception $e) {
                                echo 'Message: ' . $e->getMessage();
                            }
                            print '----> Finished sync for ' . $course->name . "\n";
                        }
                    }

                }
            } catch(Exception $e) {
                    echo 'Message: ' .$e->getMessage();
                }
        }
    }

    function syncAssignments($canvasUserId, $user_id, $course_id)
    {
        $assignments = $this->canvas->assignments->listAssignmentsForUser($canvasUserId, $course_id)->getContent();
        if ($assignments) {
            foreach ($assignments as $assignment) {
                if (!@property_exists($assignment, 'error') && !@property_exists($assignment, 'errors')) {
                    if ($assignment->id && $assignment->name && $assignment->description) {
                        $data = [
                            "user_id" => $user_id,
                            "assignment_id" => $assignment->id,
                            "name" => $assignment->name,
                            "course_id" => $assignment->course_id,
                            "description" => $assignment->description,
                            "due_at" => $assignment->due_at,
                            "assignment_group_id" => $assignment->assignment_group_id,
                            "html_url" => $assignment->html_url,
                            "created_at" => $assignment->created_at ,
                            "updated_at" => $assignment->updated_at,
//                            "all_dates" => $assignment->all_dates ?: "_",
                            "submissions_download_url" => $assignment->submissions_download_url,
                            "quiz_id" => $assignment->quiz_id ?: "0",
                            "discussion_topic" => $assignment->discussion_topic,


                        ];
                        print("Trying To save assignment\n");
                        $exist = $this->db->query("select id from assignment where assignment_id={$data["assignment_id"]} LIMIT 1");
                        if($exist->num_rows() > 0){
                            print("Trying to update\n");
                          $update= $this->db->where("assignment_id", $data["assignment_id"])->update('assignment', $data);
                          if($update){

                            print("Update Success\n");
                          }else{
                            print("Update faliure\n");
                          }
                        }else{
                            print("Trying to Insert\n");
                            $insert= $this->db->insert('assignment', $data);
                          if($insert){
                            print("Insert Success\n");
                             }else{
                                print("Error Inserting\n");
                             }
                      }

                    }
                }
            }

        }
    }

    function syncQuizzes($courseId,$user_id) 	{
        $quizzes = $this->canvas->quizzes->listQuizzesInCourse($courseId)->getContent();
//        print_r($quizzes);die;
        if (!@property_exists($quizzes, 'error') && !@property_exists($quizzes, 'errors')) {
            foreach ($quizzes as $quizz) {
                if($quizz->id&&$quizz->title){
                $data = [

                    "quizz_id" => $quizz->id?:0,
                    "title" => $quizz->title?:".",
                    "course_id" => $courseId,
                    // "user_id" => $user_id,
                    "description" => $quizz->description?:".",
                    "html_url" => $quizz->html_url?:".",
                    "quiz_type" => $quizz->quiz_type?:".",
                    "preview_url" => $quizz->preview_url?:".",
                    "access_code" => $quizz->access_code?:".",
                    "due_at" => $quizz->due_at,


                ];
                $exist = $this->db->query("select id from quizz where quizz_id={$data['quizz_id']} LIMIT 1");
                $exist->num_rows() > 0 ?($this->db->where("quizz_id",$quizz->id)->update('quizz', $data)): $this->db->insert('quizz', $data);
            }}
        }

    }

    function syncDiscussions($courseId,$user_id ){
        $discussions = $this->canvas->discussions->listCourseDiscussionTopics($courseId)->getContent();
        if (!@property_exists($discussions, 'error') && !@property_exists($discussions, 'errors')) {
            if(count($discussions)){
                foreach ($discussions as $discussion) {

                    $data = [
                        "user_id" => $user_id,
                        "discussion_id" => $discussion->id,
                        "course_id" => $courseId,
                        "title" => $discussion->title,
                        "message" => $discussion->message?:".",
                        "assignment_id" => $discussion->assignment_id,
                        "html_url" => $discussion->html_url,
                        "user_name" => $discussion->user_name,
                        "podcast_url" => $discussion->podcast_url,
                        "read_state" => $discussion->read_state,

                    ];
                    $exist = $this->db->query("select id from discussion where discussion_id={$discussion->id} LIMIT 1");
                    $exist->num_rows() > 0 ?($this->db->where("discussion_id",$discussion->id)->update('discussion', $data)): $this->db->insert('discussion', $data);
                }
            }
        }
    }

    function syncFiles($courseId,$user_id){
        $files = $this->canvas->files->listFilesForCourse($courseId)->getContent();
//        print_r($files);die;
        if (!@property_exists($files, 'error') && !@property_exists($files, 'errors')) {
            if(count($files)){
                foreach ($files as $file) {

                    $data = [
                        "user_id" => $user_id,
                        "course_id" => $courseId,
                        "file_id" => $file->id,
                        "uuid" => $file->uuid,
                        "folder_id" => $file->folder_id,
                        "display_name" => $file->display_name,
//                        "content_type" => $file->content-type,
                        "filename" => $file->filename,
                        "url" => $file->url,
                        "created_at" => $file->created_at,
                        "updated_at" => $file->updated_at,
                        "thumbnail_url" => $file->thumbnail_url,

                    ];

                        $file_url = $file->url;
                        $destination_path = "./downloads/".$user_id."/course/".$courseId."/files/";
                    if (!file_exists($destination_path)) {
                        mkdir($destination_path, 0777, true);
                    }
                        $tbh_destination_path = "./downloads/".$user_id."/course/".$courseId."/thumb/";
                    if (!file_exists($tbh_destination_path)) {
                        mkdir($tbh_destination_path, 0777, true);
                    }
                    $ch = curl_init($file_url);
                    $file_name = $file->filename;
                    $save_file_loc = $destination_path . $file_name;
                    $fp = fopen($save_file_loc, 'wb');
                    curl_setopt($ch, CURLOPT_FILE, $fp);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);


                    curl_exec($ch);
                        $st_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                        curl_close($ch);
                        fclose($fp);

                        if($st_code == 200) {
                            $file_url=$data["thumbnail_url"];
                            echo "File downloaded successfully!\n";
                            $data["url"]="/".$save_file_loc;
                            $ch = curl_init($file_url);
                            $file_name = $file->filename;
                            $save_file_loc = $tbh_destination_path . $file_name;
                            $fp = fopen($save_file_loc, 'wb');
                            curl_setopt($ch, CURLOPT_FILE, $fp);
                            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);


                            curl_exec($ch);
                            $st_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                            curl_close($ch);
                            fclose($fp);
                            if($st_code == 200) {
                                echo "ThumbNail Download Success\n";
                                $data["thumbnail_url"]="/".$save_file_loc;
                            }

                        }
                        else {
                            echo "Error downloading file!\n";
                        }


                    $exist = $this->db->query("select id from files where file_id={$file->id} LIMIT 1");
                    $exist->num_rows() > 0 ?($this->db->where("file_id",$file->id)->update('files', $data)): ($this->db->insert('files', $data));

                }
            }
        }

    }

    public function sync(){
        $tokens = $this->db->query("select * from user_tokens")->result_array();
        if(count($tokens)){

            foreach ($tokens as $token){
                //here sync controller should take token  as a constructor parameter
                try {
                $university=$this->db->get_where("university",array("university_id"=>$token['university_id']))->row_array();
                $this->courses($token["user_id"],$university["canvas_url"],$token["token"],$token["university_id"]);
            }
            catch(Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
            }
        }

    }

}
//It is A wrap Syncing Done