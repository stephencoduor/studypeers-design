<?php
/**
 * @param type $resCode
 * @param type $res_code
 * @param type $message
 * Thsi Function is responsible for all type of messages
 */
function getSingleRow($select, $matchWith, $matchingId, $table)
{
    $tableRecord = & get_instance();
    $tableRecord
        ->load
        ->database();
    $tableRecord
        ->db
        ->select($select);
    $query = $tableRecord
        ->db
        ->get_where($table, array(
        $matchWith => $matchingId,
        'status' => 1
    ))->row_array();
    return $query[$select];
}

function totalTime($times)
{
    $minutes = 0;
    foreach ($times as $time)
    {
        list($hour, $minute) = explode(':', $time);
        $minutes += $hour * 60;
        $minutes += $minute;
    }

    $hours = floor($minutes / 60);
    $minutes -= $hours * 60;

    // returns the time already formatted
    return sprintf('%02d:%02d', $hours, $minutes);
}

function getSingleRowFromTable($select, $matchWith, $matchingId, $table)
{
    $tableRecord = & get_instance();
    $tableRecord
        ->load
        ->database();
    $tableRecord
        ->db
        ->select($select);
    $query = $tableRecord
        ->db
        ->get_where($table, array(
        $matchWith => $matchingId
    ))->row_array();
    return $query[$select];
}

function getAllDataWithStatus($table, $matchWith, $matchingId)
{
    $tableRecord = & get_instance();
    $tableRecord
        ->load
        ->database();
    $tableRecord
        ->db
        ->order_by('id', 'DESC');
    return $tableRecord
        ->db
        ->get_where($table, array(
        $matchWith => $matchingId,
        'status' => 1
    ))->result_array();
}

function getAllRecord($table, $matchWith, $matchingId, $OrderBy)
{
    $tableRecord = & get_instance();
    $tableRecord
        ->load
        ->database();
    $tableRecord
        ->db
        ->order_by($OrderBy, 'DESC');
    return $tableRecord
        ->db
        ->get_where($table, array(
        $matchWith => $matchingId,
        'status' => 1
    ))->result_array();
}

function checkUniqueValue($table, $matchWith, $matchingId, $matchingCol = '', $loungeId = '')
{
    $tableRecord = & get_instance();
    $tableRecord
        ->load
        ->database();
    if ($matchingCol != "")
    {
        return $tableRecord
            ->db
            ->get_where($table, array(
            $matchWith => $matchingId,
            $matchingCol => $loungeId
        ))->num_rows();
    }
    else
    {
        return $tableRecord
            ->db
            ->get_where($table, array(
            $matchWith => $matchingId
        ))->num_rows();
    }

}

function getStaffLoungeId($matchingId)
{
    $tableRecord = & get_instance();
    $tableRecord
        ->load
        ->database();
    return $tableRecord
        ->db
        ->query("SELECT lm.`loungeId` from loungeMaster as lm inner join facilitylist as fl on fl.`facilityId`=lm.`facilityId` inner join staffMaster as sm on sm.`facilityId`=fl.`facilityId` where sm.`staffId`=" . $matchingId . "")->row_array();
}

//Check token where lounge or staff wise
function tokenVerification($type, $matchingId)
{
    $tableRecord = & get_instance();
    $tableRecord
        ->load
        ->database();
    if ($type == '0')
    {
        return $tableRecord
            ->db
            ->get_where('loungeMaster', array(
            'loungeId' => $matchingId,
            'status' => '1'
        ));
    }
    else
    {
        $tableRecord
            ->db
            ->order_by('id', 'desc');
        return $tableRecord
            ->db
            ->get_where('loginMaster', array(
            'loungeMasterId' => $matchingId,
            'status' => '1',
            'type' => '3'
        ));
    }
}

function getLastEnteredData($select, $matchWith, $matchingId, $table)
{
    $tableRecord = & get_instance();
    $tableRecord
        ->load
        ->database();
    $tableRecord
        ->db
        ->select($select);
    $tableRecord
        ->db
        ->order_by('id', 'DESC');
    $tableRecord
        ->db
        ->limit(1);
    $query = $tableRecord
        ->db
        ->get_where($table, array(
        $matchWith => $matchingId
    ))->row_array();
    return $query[$select];
}

function getAllData($table, $matchWith, $matchingId)
{
    $tableRecord = & get_instance();
    $tableRecord
        ->load
        ->database();
    $tableRecord
        ->db
        ->order_by('id', 'DESC');
    return $tableRecord
        ->db
        ->get_where($table, array(
        $matchWith => $matchingId
    ))->row_array();
}

function getAllDataWithStatus1($table)
{
    $tableRecord = & get_instance();
    $tableRecord
        ->load
        ->database();
    $tableRecord
        ->db
        ->order_by('id', 'DESC');
    return $tableRecord
        ->db
        ->get($table)->row_array();
}

function getHighestValue($select, $table, $field)
{
    $tableRecord = & get_instance();
    $tableRecord
        ->load
        ->database();
    $tableRecord
        ->db
        ->order_by($field, 'DESC');
    $query = $tableRecord
        ->db
        ->get($table)->row_array();
    
    return $query[$select];
}

function getCount($table, $type)
{
    $tableRecord = & get_instance();
    $tableRecord
        ->load
        ->database();
    return $tableRecord
        ->db
        ->get_where($table, array(
        'userType' => $type,
        'status' => 1
    ))->num_rows();
}

function singleRowData($table, $matchWith, $matchingId)
{
    $tableRecord = & get_instance();
    $tableRecord
        ->load
        ->database();
    return $tableRecord
        ->db
        ->get_where($table, array(
        $matchWith => $matchingId,
        'status' => 1
    ))->row_array();
}

function generateUniqueCode()
{
    return 'usr_' . substr(str_shuffle("1234567890") , '0', '9');
}

function generateGeneralUniqueCode()
{
    return substr(str_shuffle("1234567890") , '0', '5');
}

function saveImage($base64, $directory, $ImageName = '')
{
    $img = imagecreatefromstring(base64_decode($base64));
    if ($img != false)
    {
        $imageName = ($ImageName != '') ? $ImageName . '.png' : 'sign' . generateGeneralUniqueCode() . time() . '.png';
        $path = $directory . $imageName;
        if (imagejpeg($img, $path)) return $imageName;
        else return '';
    }
}

function saveDynamicImage($base64, $folderName)
{
    $img = imagecreatefromstring(base64_decode($base64));
    if ($img != false)
    {
        $imageName = time() . '.jpg';
        $getpath = $_SERVER['DOCUMENT_ROOT'];
        $path = $folderName . '/' . $imageName;
        if (imagejpeg($img, $path)) return $imageName;
        else return '';
    }
}

function generateServerResponse($resCode, $resMsg, $data = '', $dynamicValue = '')
{

    $getDateTime = getDateAndIp();
    $array[APP_NAME] = array();
    $resultMsg = messages($resMsg);
    $array[APP_NAME]["resCode"] = $resCode;
    $array[APP_NAME]["resMsg"] = $resultMsg;
    if ($dynamicValue != '')
    {
        //echo "aaa";exit;
        $array[APP_NAME]["syncTime"] = $dynamicValue;
    }
    else
    {

        $array[APP_NAME]["syncTime"] = $getDateTime['date'];
    }

    if (!empty($data))
    {
        foreach ($data as $key => $val)
        {
            $array[APP_NAME][$key] = $val;
        }
    }
    $str = json_encode($array, true);
    echo str_replace("null", '""', $str);
    exit;
}

function generateServerResponseWithoutFilter($resCode, $resMsg, $data = '', $dynamicValue = '')
{
    
    $getDateTime = getDateAndIp();
    $array[APP_NAME] = array();
    $resultMsg = messages($resMsg);
    $array[APP_NAME]["resCode"] = $resCode;
    $array[APP_NAME]["resMsg"] = $resultMsg;
    if ($dynamicValue != '')
    {
        //echo "aaa";exit;
        $array[APP_NAME]["syncTime"] = $dynamicValue;
    }
    else
    {

        $array[APP_NAME]["syncTime"] = $getDateTime['date'];
    }

    if (!empty($data))
    {
        foreach ($data as $key => $val)
        {
            $array[APP_NAME][$key] = $val;
        }
    }
    $str = json_encode($array, true);
    echo $str;
    exit;
}

function getDateAndIp()
{
    $result = array();
    $result['ip'] = $_SERVER['REMOTE_ADDR'];
    $result['date'] = time();
    $result['datetime'] = date('Y-m-d h:i:s');
    return $result;
}

function validateJson($requestJson, $checkRequestKeys)
{
    if ($requestJson)
    {
        $validate_keys = array();

        foreach ($requestJson[APP_NAME] as $key => $val)
        {
            $validate_keys[] = $key;
        }

        $result1 = array_diff($checkRequestKeys, $validate_keys); 
        $result2 = array_diff($validate_keys, $checkRequestKeys); 

        if(($result1) || ($result2))
        {
            return "0";
        }
        else
        {
            return "1";
        }
    }
    else
    {
        return "0";
    }
}

function validateJsonMd5($requestJson, $checkRequestKeys)
{
    if ($requestJson)
    {
        $validate_keys = array();

        foreach ($requestJson as $key => $val)
        {
            $validate_keys[] = $key;
        }

        $result = array_diff($checkRequestKeys, $validate_keys);

        if ($result)
        {
            return "0";
        }
        else
        {
            return "1";
        }
    }
    else
    {
        return "0";
    }
}

function validateEmail($email, $msgCode, $msgtype)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {

        generateServerResponse($msgCode, $msgtype);
    }
}

function getTimeDiff($StartTime, $EndTime)
{
    $Hours = floor((strtotime($EndTime) - strtotime($StartTime)) / 60);
    $d = floor($Hours / 1440);
    $h = floor(($Hours - $d * 1440) / 60);
    $m = $Hours - ($d * 1440) - ($h * 60);
    return sprintf('%02d:%02d', $h, $m);
    //return  $h.':'.$m ;
    
}

function isBlankOrNull($RequestArray)
{

    foreach ($RequestArray as $key => $value)
    {
        if (is_null($value) || $value == '')
        {
            unset($RequestArray[$key]);
        }
    }
    return $RequestArray;
}

function messages($resMsg = '', $dynamicValue = '')
{
    $codes = Array(
        '101' => 'Invalid Json',
        '102' => 'No data available',
        '103' => 'Lounge List',
        '104' => 'This email is not registered with us.',
        '105' => 'Invalid User',
        '106' => 'OTP verified successfully',
        '107' => 'Invalid OTP',
        '108' => 'Password updated successfully',
        '109' => 'Mother MCTS number field is blank',
        '110' => 'Hospital reg no. & Mother MCTS no. cannot be same',
        '111' => 'Mother Aadhar no. field is blank',
        '112' => 'Aadhar no. will be only 12 digits ',
        '113' => 'Mother DOB field is blank',
        '114' => 'Please Select Caste',
        '115' => 'Father Name field is blank ',
        '116' => 'Mother phone number field is blank',
        '117' => 'Father phone number field is blank',
        '118' => 'Please Select Family Ration Card',
        '119' => 'Please Select Present Address type ',
        '120' => 'Present Address field is Blank',
        '121' => 'Street field is blank',
        '122' => 'City field is blank',
        '123' => 'Block name field is blank',
        '124' => 'District name field is blank',
        '125' => 'Please Select Permanent Address type ',
        '126' => 'Permanent Address is field is Blank',
        '127' => 'Registration Date & Time is require',
        '128' => 'Mother Successfully Registered',
        '129' => 'Baby Successfully Registered',
        '130' => 'Baby List',
        '131' => 'Successfully',
        '132' => 'All Facilities.',
        '133' => 'Mother List',
        '134' => 'Already Discharge ',
        '135' => 'Search List',
        '136' => 'Please Enter Unique Hospital Registration Number',
        '137' => 'Baby File id Already Exist',
        '138' => 'Please enter user name',
        '139' => 'Please enter phone number',
        '140' => 'Please enter pin code',
        '141' => 'Please enter locality',
        '142' => 'Mother Detail Update Successfully',
        '143' => 'Please enter district city town',
        '144' => 'Please enter state master id',
        '145' => 'Please enter address type',
        '146' => 'Address added successfully',
        '147' => 'Please enter address master id',
        '148' => 'Please enter discount type',
        '149' => 'Please enter final price',
        '150' => 'Please enter quantity',
        '151' => 'Mother Detail Updated Successfully',
        '152' => 'Baby details updated successfully',
        '153' => 'Address update successfully',
        '154' => 'Address deleted successfully',
        '155' => 'Product quantity available',
        '156' => 'Please enter quantity',
        '157' => 'Product quantity update successfully',
        '158' => 'No address available',
        '159' => 'Address available',
        '160' => 'Please enter payment type',
        '161' => 'Coupon not applicable',
        '162' => 'Wishlist update successfully',
        '163' => 'Your account has been blocked. Please contact customer care soon',
        '164' => 'Order history available',
        '165' => 'Please enter order id',
        '166' => 'Invalid user credentials',
        '167' => 'No product available',
        '168' => 'Product Canceled',
        '169' => 'Order Already Cancel',
        '170' => 'Setting Details',
        '171' => 'User Profile Updated Successfully',
        '172' => 'Email-id cannot be empty',
        '173' => 'Mobile number cannot be empty',
        '174' => 'Invalid Email-id',
        '175' => 'Phone number already exist',
        '176' => 'Mobile/DTH number cannot be empty',
        '177' => 'Please enter recharge amount',
        '178' => 'Please select recharge type',
        '179' => 'Transaction Detail',
        '180' => 'Transaction history',
        '181' => 'Please select Prepaid or Postpaid type',
        '182' => 'Transaction status',
        '183' => 'Transaction id does not exist',
        '184' => 'Phone number Must be 10 digit only',
        '185' => 'Please Enter Number Only.',
        '186' => 'Recharge amount must between 10 to 1000.',
        '187' => 'Invalid Transaction id',
        '189' => 'Wallet cannot be empty',
        '190' => 'Payment-status successfully changed',
        '191' => 'Please Enter Insurance Amount',
        '192' => 'Please Enter Insurance Policy Number',
        '193' => 'Please Enter Your Date Of Birth',
        '194' => 'School cannot be empty',
        '195' => 'School branch cannot be empty',
        '196' => 'Student name cannot be empty',
        '197' => 'Student roll no. cannot be empty',
        '198' => 'Student batch cannot be empty',
        '199' => 'Fee start date cannot be empty',
        '200' => 'Fee end date cannot be empty',
        '201' => 'Student class cannot be empty',
        '202' => 'Fees cannot be empty',
        '203' => 'School Detail',
        '204' => 'Referel Paid',
        '205' => 'Referel Already Paid',
        '206' => 'Normal Registration',
        '207' => 'Fcm Update',
        '208' => 'School & Branch',
        '209' => 'Payment Failed ',
        '210' => 'Package is Invalid',
        '211' => 'Lounge id not registered',
        '212' => 'Incomplete Data',
        '213' => 'Data Already Exist',
        '214' => 'Logout Successfully Done',
        '215' => 'Invalid IMEI Number',
        '216' => 'No device active',
        '217' => 'Invalid Mobile Number',
        '218' => 'User type Undefined',
        '219' => 'Revenue Data',
        '220' => 'Mother Already Admitted',
        '221' => 'Wrong Old Password',
        '222' => 'Event Deleted Successfully',
        '223' => 'Event Added To Calendar Successfully',
        '224' => 'Comment Added Successfully',
        '225' => 'Comment Reply Added Successfully',
        'E' => 'Data Not Found',
        'W' => 'Something Went Wrong',
        'S' => 'Success',
        'F' => 'Fail',
        'L' => 'Invalid Lounge',
        'P' => 'Invalid Password',
        'R' => 'Refund',
        'U' => 'Username already exists',
        'A' => 'Email already exists',
        'M' => 'Mobile number already exists',
        'I' => 'Institute email already exists',
        'N' => 'User not authorized'
    );

    return (isset($codes[$resMsg])) ? $codes[$resMsg] : '';
}

function getDateDifference($Date1, $Date2 = '')
{
    $now = time(); // or your date as well
    $data = ($Date2 != '') ? $now : $Date2;

    $datediff = $data - $Date1;
    return round($datediff / (60 * 60 * 24));
}

function getDateDifferenceWithCurrent($Date)
{
    $now = time();
    $datediff = $now - $Date;
    return round($datediff / (60 * 60 * 24));
}

function calculateDays($deliveryDate)
{
    $birthDate = date_create($deliveryDate);
    $curentdate = date_create(date("Y-m-d"));
    $diff = date_diff($birthDate, $curentdate);
    return substr($diff->format("%R%a") , 1);
}

function getLmpDeliveryDifference($deliveryDate, $lmpDate)
{

    $datediff = $deliveryDate - $lmpDate;
    return round(($datediff / (60 * 60 * 24)) / 7);
}

function totalduration($times)
{
    $minutes = 0; //declare minutes either it gives Notice: Undefined variable
    // loop throught all the times
    foreach ($times as $time)
    {
        list($hour, $minute) = explode(':', $time);
        $minutes += $hour * 60;
        $minutes += $minute;
    }
    $hours = floor($minutes / 60);
    $minutes -= $hours * 60;

    // returns the time already formatted
    return sprintf('%02d:%02d', $hours, $minutes);
}

function sendMobileMessage($mobile, $message)
{
    $tableRecord = & get_instance();
    $tableRecord
        ->load
        ->database();
    $getSetting = $tableRecord
        ->db
        ->get_where('settings', array(
        'id' => 1
    ))
        ->row_array();
    // if you are using transaction sms api then keep gwid = 2 or if promotional then remove this parameter
    $gwid = "2";
    //step1
    $cSession = curl_init();
    //step2
    curl_setopt($cSession, CURLOPT_URL, "http://cloud.smsindiahub.in/vendorsms/pushsms.aspx?user=" . $getSetting['userName'] . "&password=" . $getSetting['password'] . "&msisdn=" . $mobile . "&sid=" . $getSetting['senderId'] . "&msg=" . urlencode($message) . "&fl=0&gwid=2");
    curl_setopt($cSession, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($cSession, CURLOPT_HEADER, false);
    //step3
    $result = curl_exec($cSession);
    //step4
    curl_close($cSession);
    //step5
    return $result;
}

/* change json to string and create md5 Data.*/
function createMd5OfString($arrayData)
{
    $stringData = json_encode($arrayData, JSON_UNESCAPED_UNICODE);
    $md5Data = md5($stringData);
    return $md5Data;
}

function time_ago_in_php($timestamp){
  
    // date_default_timezone_set("Asia/Kolkata");         
    $time_ago        = strtotime($timestamp);
    $current_time    = time();
    $time_difference = $current_time - $time_ago;
    $seconds         = $time_difference;
    
    $minutes = round($seconds / 60); // value 60 is seconds  
    $hours   = round($seconds / 3600); //value 3600 is 60 minutes * 60 sec  
    $days    = round($seconds / 86400); //86400 = 24 * 60 * 60;  
    $weeks   = round($seconds / 604800); // 7*24*60*60;  
    $months  = round($seconds / 2629440); //((365+365+365+365+366)/5/12)*24*60*60  
    $years   = round($seconds / 31553280); //(365+365+365+365+366)/5 * 24 * 60 * 60

    $dateF   = date("M d ",strtotime($timestamp)).'at '.date("h:i A",strtotime($timestamp)); 
                  
    if ($seconds <= 60){

      return "Just Now";

    } else if ($minutes <= 60){

      if ($minutes == 1){

        return "one min ago";

      } else {

        return "$minutes mins ago";

      }

    } else if ($hours <= 24){

      if ($hours == 1){

        return "an hour ago";

      } else {

        return "$hours hrs ago";

      }

    } else if ($days <= 7){

      if ($days == 1){

        return "yesterday";

      } else {

        return "$days days ago";

      }

    } else if ($weeks == 1){

      return "a week ago";
        
    } else {

      return $dateF;
      
    }
}


function userImage($user_id){
    $tableRecord = & get_instance();
    $tableRecord
        ->load
        ->database();
        
    $user_detail = $tableRecord->db->get_where('user', array('id' => $user_id))->row_array();
    $user_info = $tableRecord->db->get_where('user_info', array('userID' => $user_id))->row_array();

    if(!empty($user_detail['image']) && ($user_detail['image'] != 'user.png')) {
        return base_url().'uploads/users/'.$user_detail['image'];
    } else {
        if($user_info['gender'] == 'male'){
            return base_url().'uploads/user-male.png';
        } else {
            return base_url().'uploads/user-female.png';
        }
    }
}

 function getReactionByReference($reference_id, $reference){
    $tableRecord = & get_instance();
    $tableRecord
        ->load
        ->database();

        $chk_if_like = $tableRecord->db->get_where($tableRecord->db->dbprefix('reaction_master'), array('reference_id' => $reference_id, 'reference' => $reference, 'reaction_id' => '1'))->row_array();
        $chk_if_support = $tableRecord->db->get_where($tableRecord->db->dbprefix('reaction_master'), array('reference_id' => $reference_id, 'reference' => $reference, 'reaction_id' => '2'))->row_array();
        $chk_if_celebrate = $tableRecord->db->get_where($tableRecord->db->dbprefix('reaction_master'), array('reference_id' => $reference_id, 'reference' => $reference, 'reaction_id' => '3'))->row_array();
        $chk_if_insightful = $tableRecord->db->get_where($tableRecord->db->dbprefix('reaction_master'), array('reference_id' => $reference_id, 'reference' => $reference, 'reaction_id' => '4'))->row_array();
        $chk_if_curious = $tableRecord->db->get_where($tableRecord->db->dbprefix('reaction_master'), array('reference_id' => $reference_id, 'reference' => $reference, 'reaction_id' => '5'))->row_array();
        $chk_if_love = $tableRecord->db->get_where($tableRecord->db->dbprefix('reaction_master'), array('reference_id' => $reference_id, 'reference' => $reference, 'reaction_id' => '6'))->row_array();
        $like_count_increment = $tableRecord->db->get_where($tableRecord->db->dbprefix('reaction_master'), array('reference_id' => $reference_id, 'reference' => $reference))->num_rows();
        if($like_count_increment == 0){
            $like_count_increment = '';
        }

            $html = '';

            if(!empty($chk_if_like)){
                $html.='<img src="'.base_url().'assets_d/images/like-dashboard.svg"
                                            alt="Like">';
            }

            if(!empty($chk_if_support)){
                $html.='<img src="'.base_url().'assets_d/images/support-dashboard.svg"
                                            alt="Like">';
            }

            if(!empty($chk_if_celebrate)){
                $html.='<img src="'.base_url().'assets_d/images/celebrate-dashboard.svg"
                                            alt="Like">';
            }

            if(!empty($chk_if_insightful)){
                $html.='<img src="'.base_url().'assets_d/images/curious-dashboard.svg"
                                            alt="Like">';
            }

            if(!empty($chk_if_curious)){
                $html.='<img src="'.base_url().'assets_d/images/insight-dashboard.svg"
                                            alt="Like">';
            }

            if(!empty($chk_if_love)){
                $html.='<img src="'.base_url().'assets_d/images/love-dashboard.svg"
                                            alt="Like">';
            }

            $html.='<span>'.$like_count_increment.'</span>';

            return $html;
    }

function checkFollowStatus($user_id , $peer_id){
        $tableRecord = & get_instance();
        $tableRecord
            ->load
            ->database();
        $check_follow_status = $tableRecord->db->get_where('follow_master', array('user_id' => $user_id, 'peer_id' => $peer_id))->row_array();
        if(isset($check_follow_status) && !empty($check_follow_status)){
            return true;
        }else{
            return false;
        }
}

