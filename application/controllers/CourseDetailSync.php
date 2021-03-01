<?php
//defined('BASEPATH') or exit('No direct script access allowed');
class CourseDetailSync
{
    public function sync(){
        $tokens = $this->db->query("select * from user_tokens")->result_array();
        if(count($tokens)){

            foreach ($tokens as $token){
                //here sync controller should take token  as a constructor parameter
                $sync = new Sync($token);
                $sync->courses();
            }
        }

    }



}