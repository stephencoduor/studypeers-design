<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Account extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->library('session');
        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');

        // Set the timezone
        date_default_timezone_set(get_settings('timezone'));
        $this->load->library('upload');
		$this->load->helper('url');
        $this->load->library('mypagination');
        $this->load->model('studyset_model');
    }

    public function index()
    {

        if ($this->session->userdata('user_login') == true) {
            $this->dashboard();
        } else {
            redirect(site_url('login'), 'refresh');
        }
    }

    function peerListString($user_id)
    {
        $peer_list = $this->db->query("SELECT * FROM `friends` WHERE (`user_id` = '" . $user_id . "')")->result_array();
        $peer = array();
        foreach ($peer_list as $key => $value) {
            if ($value['user_id'] == $user_id) {
                // $peer[$key] = $value['peer_id']; 
                array_push($peer, $value['peer_id']);
            } else {
                // $peer[$key] = $value['user_id']; 
                array_push($peer, $value['user_id']);
            }
        }
        return $peer;
    }


    function peerListStringDashboard($user_id)
    {
        $peer_list = $this->db->query("SELECT * FROM `friends` WHERE (`user_id` = '" . $user_id . "')")->result_array();
        $peer = array();
        foreach ($peer_list as $key => $value) {

            $chk_if_follow =  $this->db->query("SELECT * FROM `follow_master` WHERE (`user_id` = '" . $user_id . "' AND `peer_id` = '" . $value['peer_id'] . "')")->row_array();
            if (!empty($chk_if_follow)) {
                array_push($peer, $value['peer_id']);
            }
        }
        $follow_list = $this->db->query("SELECT * FROM `follow_master` WHERE (`user_id` = '" . $user_id . "')")->result_array();
        foreach ($follow_list as $key => $value) {

            $chk_if_follow =  $this->db->query("SELECT * FROM `follow_master` WHERE (`user_id` = '" . $user_id . "' AND `peer_id` = '" . $value['peer_id'] . "')")->row_array();
            if (in_array($value['peer_id'], $peer)) {
            } else {
                array_push($peer, $value['peer_id']);
            }
        }
        return $peer;
    }
	
	public function timestring($datetime, $full = false) {
		$now = new DateTime;
		$ago = new DateTime($datetime);
		$diff = $now->diff($ago);

		$diff->w = floor($diff->d / 7);
		$diff->d -= $diff->w * 7;

		$string = array(
			'y' => 'year',
			'm' => 'month',
			'w' => 'week',
			'd' => 'day',
			'h' => 'hour',
			'i' => 'minute',
			's' => 'second',
		);
		foreach ($string as $k => &$v) {
			if ($diff->$k) {
				$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
			} else {
				unset($string[$k]);
			}
		}

		if (!$full) $string = array_slice($string, 0, 1);
		return $string ? implode(', ', $string) . ' ago' : 'just now';
	}
	
    public function searchResult($tabType = null){
        $data['index_menu'] = 'search';
        $data['title']      = 'Search Result | Studypeers';
		$data['tabType']    = $tabType;
		
		$SearchText = ($this->session->userdata('SearchText')) ? $this->session->userdata('SearchText') : '';
		$data['SearchText']  = $SearchText;
		//$this->session->unset_userdata('SearchText');
		
		$CurrentUserID = ($this->session->userdata['user_data']['user_id']) ? $this->session->userdata['user_data']['user_id'] : 0;
			
		$GetUserInfo   = $this->db->query("SELECT intitutionID FROM user_info WHERE userID='".$CurrentUserID."'")->row();
		$intitutionID  = (!empty($GetUserInfo)) ? $GetUserInfo->intitutionID : '';
		
		$AllPeers = array();
		$AllPosts = array();
		$AllQuestions = array();
		$AllDocuments = array();
		$AllStudySets = array();
		$AllEvents = array();
		
		if($SearchText != '')
		{
			$LimitResult     = 5;
			$FoundResult     = 0;
			$FoundResult2    = 0;
			$RemainingResult = 0;
			
			$SearchUserid = array();
			$ExistingUsers = array();
			
			// get reported users
			$reportedUsers = array();
			$reportedUsersString = '';
			
			$getReportedUsers = "SELECT report_user_id FROM user_report_master WHERE user_id='".$CurrentUserID."' AND status='1'";
			$ReportedUserResult = $this->db->query($getReportedUsers)->result_array();
			if(!empty($ReportedUserResult)){
				foreach($ReportedUserResult as $ReportedUserResultData){
					$reportedUsers[] = $ReportedUserResultData['report_user_id'];
				}
			}
			
			$getBlockedUsers = "SELECT peer_id FROM blocked_peers WHERE user_id='".$CurrentUserID."'";
			$BlockedUserResult = $this->db->query($getBlockedUsers)->result_array();
			if(!empty($BlockedUserResult)){
				foreach($BlockedUserResult as $BlockedUserResultData){
					$reportedUsers[] = $BlockedUserResultData['peer_id'];
				}
			}
			
			if(!empty($reportedUsers)){
				$reportedUsersString = implode(",",$reportedUsers);
			}
			
			// search for my friends / peers
			$SearchPeers = "SELECT peer_master.peer_id,user.id,user.username,user.first_name,user.last_name,user.image,user_info.gender FROM peer_master LEFT JOIN user ON (user.id = peer_master.peer_id) LEFT JOIN user_info ON (user_info.userID = user.id) WHERE peer_master.user_id='".$CurrentUserID."' AND peer_master.status='2' AND (user.first_name LIKE '%$SearchText%' OR user.last_name LIKE '%$SearchText%' OR user.username LIKE '%$SearchText%' OR user.about LIKE '%$SearchText%' OR user.email LIKE '%$SearchText%') ";
			
			if($reportedUsersString != ''){
				$SearchPeers .= " AND user.id NOT IN (".$reportedUsersString.")";
			}
			
			$SearchPeers .= " ORDER BY user.id DESC LIMIT 5";
			
			$SearchPeersResult = $this->db->query($SearchPeers)->result_array();
			$FoundResult = count($SearchPeersResult);
			
			if(!empty($SearchPeersResult))
			{
				foreach($SearchPeersResult as $SearchPeersResultData)
				{
					$SearchUserid[]  = $SearchPeersResultData['id'];
					if(!in_array($SearchPeersResultData['id'],$ExistingUsers)){
						$ExistingUsers[]  = $SearchPeersResultData['id'];
						
						if($SearchPeersResultData['gender'] == 'female'){
							$UserProfile = base_url('uploads/user-female.png');
						} else if($SearchPeersResultData['gender'] == 'male') {
							$UserProfile = base_url('uploads/user-male.png');
						} else if($SearchPeersResultData['gender'] == 'other') {
								$UserProfile = base_url('uploads/user-anonymous.png');
						} else {
							$UserProfile = base_url().'assets_d/images/user.jpg';
						}
						
						if($SearchPeersResultData['image'] != '' && file_exists('uploads/users/'.$SearchPeersResultData['image'])){
							$UserProfile = base_url('uploads/users/'.$SearchPeersResultData['image']);
						}
							
						$getUniversityName = "SELECT user_info.intitutionID,university.SchoolName,user_info.user_location FROM user_info LEFT JOIN university ON (university.university_id = user_info.intitutionID) WHERE 1=1 AND user_info.userID = '".$SearchPeersResultData['id']."'";
						$UniversityResult = $this->db->query($getUniversityName)->result_array();
						
						$UniversityName = 'N/A';
						$LocationName = 'N/A';
						if(!empty($UniversityResult)){
							$UniversityName = ($UniversityResult[0]['SchoolName']) ? $UniversityResult[0]['SchoolName'] : 'N/A';
							$LocationName = ($UniversityResult[0]['user_location']) ? $UniversityResult[0]['user_location'] : 'N/A';
						}
		
						$getFollowerCounter = "SELECT id FROM follow_master WHERE peer_id='".$SearchPeersResultData['id']."'";
						$FollowerResult = $this->db->query($getFollowerCounter)->result_array();
						$TotalFollower = 0;
						if(!empty($FollowerResult)){
							$TotalFollower = count($FollowerResult);
						}
						
						$checkFollowingStatus = "SELECT * FROM follow_master WHERE user_id='".$CurrentUserID."' AND peer_id='".$SearchPeersResultData['id']."'";
						$FollowStatusResult = $this->db->query($checkFollowingStatus)->result_array();
						
						if(!empty($FollowStatusResult)){
							$isFollowing = 1;
						} else {
							$isFollowing = 0;
						}
						
						$tempPeers['id']             = $SearchPeersResultData['id']; 	
						$tempPeers['username']       = $SearchPeersResultData['username']; 
						$tempPeers['UserProfile']    = $UserProfile; 
						$tempPeers['full_name']      = $SearchPeersResultData['first_name'].' '.$SearchPeersResultData['last_name']; 
						$tempPeers['UniversityName'] = $UniversityName; 
						$tempPeers['LocationName']   = $LocationName; 
						$tempPeers['totalFollower']  = $TotalFollower;
						$tempPeers['isFollowing']    = $isFollowing;		
						array_push($AllPeers,$tempPeers);
					}
				}
			}
			
			$RemainingResult = $LimitResult - $FoundResult;
			
			$SearchUseridString = '';
			if(count($SearchUserid) > 0){
				$SearchUseridString = implode(",",$SearchUserid);
			}
			
			// get mutal friends from search result
			if(!empty($SearchPeersResult))
			{
				foreach($SearchPeersResult as $SearchPeersResultData)
				{
					$MutalQuery = "SELECT u.id,u.username,u.first_name,u.last_name,u.image,user_info.gender FROM friends f1 INNER JOIN friends f2 ON (f2.peer_id = f1.peer_id) INNER JOIN user u ON (u.id = f2.peer_id) LEFT JOIN user_info ON (user_info.userID = u.id) WHERE f1.user_id = '".$CurrentUserID."' AND f2.user_id = '".$SearchPeersResultData['id']."'";
					
					if($SearchUseridString != ''){
						$MutalQuery .= " AND u.id NOT IN (".$SearchUseridString.")";
					}
					
					if($reportedUsersString != ''){
						$MutalQuery .= " AND u.id NOT IN (".$reportedUsersString.")";
					}
					
					$SearchMutalFriends = $this->db->query($MutalQuery)->result_array();
					
					if(!empty($SearchMutalFriends)){
						foreach($SearchMutalFriends as $SearchMutalFriend){
							
							if(!in_array($SearchMutalFriend['id'],$ExistingUsers)){
								$ExistingUsers[]  = $SearchMutalFriend['id'];
							
								$RemainingResult--;
								if($RemainingResult == 0){
									break;
								}
								
								if($SearchMutalFriend['gender'] == 'female'){
									$UserProfile = base_url('uploads/user-female.png');
								} else if($SearchMutalFriend['gender'] == 'male') {
									$UserProfile = base_url('uploads/user-male.png');
								} else if($SearchMutalFriend['gender'] == 'other') {
									$UserProfile = base_url('uploads/user-anonymous.png');
								} else {
									$UserProfile = base_url().'assets_d/images/user.jpg';
								}
								
								if($SearchMutalFriend['image'] != '' && file_exists('uploads/users/'.$SearchMutalFriend['image'])){
									$UserProfile = base_url('uploads/users/'.$SearchMutalFriend['image']);
								}
								
								$getUniversityName = "SELECT user_info.intitutionID,university.SchoolName,user_info.user_location FROM user_info LEFT JOIN university ON (university.university_id = user_info.intitutionID) WHERE 1=1 AND user_info.userID = '".$SearchMutalFriend['id']."'";
								$UniversityResult = $this->db->query($getUniversityName)->result_array();
								
								$UniversityName = 'N/A';
								$LocationName = 'N/A';
								if(!empty($UniversityResult)){
									$UniversityName = ($UniversityResult[0]['SchoolName']) ? $UniversityResult[0]['SchoolName'] : 'N/A';
									$LocationName = ($UniversityResult[0]['user_location']) ? $UniversityResult[0]['user_location'] : 'N/A';
								}
								
								$getFollowerCounter = "SELECT id FROM follow_master WHERE peer_id='".$SearchMutalFriend['id']."'";
								$FollowerResult = $this->db->query($getFollowerCounter)->result_array();
								$TotalFollower = 0;
								if(!empty($FollowerResult)){
									$TotalFollower = count($FollowerResult);
								}
								
								$checkFollowingStatus = "SELECT * FROM follow_master WHERE user_id='".$CurrentUserID."' AND peer_id='".$SearchMutalFriend['id']."'";
								$FollowStatusResult = $this->db->query($checkFollowingStatus)->result_array();
								
								if(!empty($FollowStatusResult)){
									$isFollowing = 1;
								} else {
									$isFollowing = 0;
								}
								
								$SearchUserid[]  = $SearchMutalFriend['id'];
								
								$tempPeers['id']             = $SearchMutalFriend['id']; 	
								$tempPeers['username']       = $SearchMutalFriend['username']; 
								$tempPeers['UserProfile']    = $UserProfile; 
								$tempPeers['full_name']      = $SearchMutalFriend['first_name'].' '.$SearchMutalFriend['last_name']; 
								$tempPeers['UniversityName'] = $UniversityName;
								$tempPeers['LocationName']   = $LocationName;
								$tempPeers['totalFollower']  = $TotalFollower; 
								$tempPeers['isFollowing']    = $isFollowing;		
								array_push($AllPeers,$tempPeers);
							}
						}
					}
				}
			}
			
			// search peers based on university
			if($intitutionID != '' && $RemainingResult != 0)
			{
				$SearchByUniversity = "SELECT user_info.userID,user.id,user.username,user.first_name,user.last_name,user.image,user_info.user_location,user_info.gender FROM user_info LEFT JOIN user ON (user.id = user_info.userID) WHERE user_info.userID != '".$CurrentUserID."' AND user_info.intitutionID='".$intitutionID."'";	
				
				if($SearchUseridString != ''){
					$SearchByUniversity .= " AND user.id NOT IN (".$SearchUseridString.")";
				}
				
				if($reportedUsersString != ''){
					$SearchByUniversity .= " AND user.id NOT IN (".$reportedUsersString.")";
				}
				
				$SearchByUniversity .= " AND (user.first_name LIKE '%$SearchText%' OR user.last_name LIKE '%$SearchText%' OR user.username LIKE '%$SearchText%' OR user.about LIKE '%$SearchText%' OR user.email LIKE '%$SearchText%')";
				
				$SearchByUniversity .= " ORDER BY user.id DESC LIMIT ".$RemainingResult;
				
				
				
				$SearchUniversityResult = $this->db->query($SearchByUniversity)->result_array();
				$FoundResult2 = count($SearchUniversityResult);
				
				if(!empty($SearchUniversityResult))
				{
					foreach($SearchUniversityResult as $SearchUniversityResultData)
					{
						$SearchUserid[]  = $SearchUniversityResultData['id'];
						
						if(!in_array($SearchUniversityResultData['id'],$ExistingUsers)){	
							$ExistingUsers[] = $SearchUniversityResultData['id'];
						
							if($SearchUniversityResultData['gender'] == 'female'){
								$UserProfile = base_url('uploads/user-female.png');
							} else if($SearchUniversityResultData['gender'] == 'male') {
								$UserProfile = base_url('uploads/user-male.png');
							} else if($SearchUniversityResultData['gender'] == 'other') {
								$UserProfile = base_url('uploads/user-anonymous.png');
							} else {
								$UserProfile = base_url().'assets_d/images/user.jpg';
							}
							
							if($SearchUniversityResultData['image'] != '' && file_exists('uploads/users/'.$SearchUniversityResultData['image'])){
								$UserProfile = base_url('uploads/users/'.$SearchUniversityResultData['image']);
							}
								
							$getUniversityName = "SELECT user_info.intitutionID,university.SchoolName FROM user_info LEFT JOIN university ON (university.university_id = user_info.intitutionID) WHERE 1=1 AND user_info.userID = '".$SearchUniversityResultData['id']."'";
							$UniversityResult = $this->db->query($getUniversityName)->result_array();
							
							$UniversityName = 'N/A';
							if(!empty($UniversityResult)){
								$UniversityName = ($UniversityResult[0]['SchoolName']) ? $UniversityResult[0]['SchoolName'] : 'N/A';
							}	
								
							$getFollowerCounter = "SELECT id FROM follow_master WHERE peer_id='".$SearchUniversityResultData['id']."'";
							$FollowerResult = $this->db->query($getFollowerCounter)->result_array();
							$TotalFollower = 0;
							if(!empty($FollowerResult)){
								$TotalFollower = count($FollowerResult);
							}	
								
							$checkFollowingStatus = "SELECT * FROM follow_master WHERE user_id='".$CurrentUserID."' AND peer_id='".$SearchUniversityResultData['id']."'";
							$FollowStatusResult = $this->db->query($checkFollowingStatus)->result_array();
							
							if(!empty($FollowStatusResult)){
								$isFollowing = 1;
							} else {
								$isFollowing = 0;
							}	
								
							$tempPeers['id']             = $SearchUniversityResultData['id']; 	
							$tempPeers['username']       = $SearchUniversityResultData['username']; 
							$tempPeers['UserProfile']    = $UserProfile; 
							$tempPeers['full_name']      = $SearchUniversityResultData['first_name'].' '.$SearchUniversityResultData['last_name']; 
							$tempPeers['UniversityName'] = $UniversityName; 	
							$tempPeers['LocationName']   = ($SearchUniversityResultData['user_location']) ? $SearchUniversityResultData['user_location'] : 'N/A';		
							$tempPeers['totalFollower']  = $TotalFollower; 
							$tempPeers['isFollowing']    = $isFollowing;	
							array_push($AllPeers,$tempPeers);	
						}
					}
				}
			}
			
			//get result from posts
			// get reported posts
			$reportedPosts = array();
			$reportedPostsString = '';
			
			$getReportedPosts = "SELECT post_id FROM report_post WHERE user_id='".$CurrentUserID."'";
			$ReportedPostsResult = $this->db->query($getReportedPosts)->result_array();
			if(!empty($ReportedPostsResult)){
				foreach($ReportedPostsResult as $ReportedPostsResultData){
					$reportedPosts[] = $ReportedPostsResultData['post_id'];
				}
			}
			
			if(!empty($reportedPosts)){
				$reportedPostsString = implode(",",$reportedPosts);
			}
			
			//get particular user assigned posts ids
			$getAssignedPostsIDS = "SELECT post_id FROM post_share_with_peers WHERE peer_id='".$CurrentUserID."'";
			$AssignedPostIds = $this->db->query($getAssignedPostsIDS)->result_array();
			$FoundAssignedPost = count($AssignedPostIds);
			
			$AssignedPostIdString = '';
			$AssignedPostIdArray  = array();
			if(!empty($AssignedPostIds)) {
				foreach($AssignedPostIds as $AssignedPostIdsData){
					$AssignedPostIdArray[] = $AssignedPostIdsData['post_id'];
				}
			}
			$AssignedPostIdString = implode(",",$AssignedPostIdArray);
			
			$SearchPosts = "SELECT reference_master.reference,reference_master.addDate,posts.id,posts.post_content_html,post_documents.original_name,post_poll_options.options,post_images.image_path,post_videos.video_path,user.id as user_id,user.username,user.first_name,user.last_name,user.image,user_info.gender FROM reference_master LEFT JOIN posts ON (posts.id = reference_master.reference_id) LEFT JOIN post_images ON (posts.id = post_images.post_id AND post_images.post_id = reference_master.reference_id) LEFT JOIN post_videos ON (posts.id = post_videos.post_id AND post_videos.post_id = reference_master.reference_id) LEFT JOIN post_documents ON (posts.id = post_documents.post_id AND post_documents.post_id = reference_master.reference_id) LEFT JOIN post_poll_options ON (posts.id = post_poll_options.post_id AND post_poll_options.post_id = reference_master.reference_id) LEFT JOIN user ON (user.id = reference_master.user_id) LEFT JOIN user_info ON (user_info.userID = user.id) WHERE 1=1 AND reference_master.status = '1' AND posts.status='1' AND reference_master.reference='Post' AND (posts.post_content_html LIKE '%$SearchText%' OR post_documents.original_name LIKE '%$SearchText%' OR post_poll_options.options LIKE '%$SearchText%')";
			
			if($AssignedPostIdString != ''){
				$SearchPosts .= " AND (reference_master.reference_id IN (".$AssignedPostIdString.") OR posts.privacy_id IN (1,2) OR reference_master.user_id = '".$CurrentUserID."')"; 
			} else {
				$SearchPosts .= " AND (posts.privacy_id IN (1,2) OR reference_master.user_id = '".$CurrentUserID."')"; 
			}
			
			if($reportedPostsString != ''){
				$SearchPosts .= " AND posts.id NOT IN (".$reportedPostsString.")"; 
			}
			
			$SearchPosts .= " GROUP BY posts.id ORDER BY reference_master.addDate DESC LIMIT ".$LimitResult;
			
			$SearchPostResult = $this->db->query($SearchPosts)->result_array();
			$FoundPostResult = count($SearchPostResult);
			
			if(!empty($SearchPostResult)) {
				foreach($SearchPostResult as $SearchPostResultDat){
					$addDate = ($SearchPostResultDat['addDate']) ? date("Y-m-d H:i:s",strtotime($SearchPostResultDat['addDate'])) : '';
					$timeAgo = $this->timestring($addDate);
					$post_id = ($SearchPostResultDat['id']) ? $SearchPostResultDat['id'] : 0;
					
					if($SearchPostResultDat['gender'] == 'female'){
						$UserProfile = base_url('uploads/user-female.png');
					} else if($SearchPostResultDat['gender'] == 'male') {
						$UserProfile = base_url('uploads/user-male.png');
					} else if($SearchPostResultDat['gender'] == 'other') {
						$UserProfile = base_url('uploads/user-anonymous.png');
					} else {
						$UserProfile = base_url().'assets_d/images/user.jpg';
					}
					
					if($SearchPostResultDat['image'] != '' && file_exists('uploads/users/'.$SearchPostResultDat['image'])){
						$UserProfile = base_url('uploads/users/'.$SearchPostResultDat['image']);
					}
					
					$PostImage = '';
					if($SearchPostResultDat['image_path'] != ''){
						$PostImage = base_url($SearchPostResultDat['image_path']);
					}
					
					$PostVideo = '';
					if($SearchPostResultDat['video_path'] != '' && file_exists($SearchPostResultDat['video_path'])){
						$PostVideo = base_url($SearchPostResultDat['video_path']);
					}
					
					// get university name
					$getUniversityName = "SELECT user_info.intitutionID,university.SchoolName FROM user_info LEFT JOIN university ON (university.university_id = user_info.intitutionID) WHERE 1=1 AND user_info.userID = '".$SearchPostResultDat['user_id']."'";
					$UniversityResult = $this->db->query($getUniversityName)->result_array();
					
					$UniversityName = 'N/A';
					if(!empty($UniversityResult)){
						$UniversityName = ($UniversityResult[0]['SchoolName']) ? $UniversityResult[0]['SchoolName'] : 'N/A';
					}
					
					// get total number of reactions and unique reaction id
					$getReactionMaster = "SELECT reaction_id FROM reaction_master WHERE reference_id='".$post_id."' AND reference='Post'";
					$ReactionResult    = $this->db->query($getReactionMaster)->result_array();
					
					$getUniqueReactionsID = "SELECT reaction_id FROM reaction_master WHERE reference_id='".$post_id."' AND reference='Post' GROUP BY reaction_id";
					$UniqueReactionResult = $this->db->query($getUniqueReactionsID)->result_array();
					
					$ReactionIds = array();
					if(!empty($UniqueReactionResult)){
						foreach($UniqueReactionResult as $UniqueReactionResultData){
							$ReactionIds[] = $UniqueReactionResultData['reaction_id'];
						}
					}
					
					// get total active comments counter in posts
					$getPostCommentCounter = "SELECT id FROM comment_master WHERE reference_id='".$post_id."' AND reference='Post' AND status='1'";
					$postCommentCounter    = $this->db->query($getPostCommentCounter)->result_array();
					
					$tempPostResult['post_id']                = $post_id;
					$tempPostResult['post_content_html']      = ($SearchPostResultDat['post_content_html']) ? $SearchPostResultDat['post_content_html'] : '';
					$tempPostResult['post_image']             = ($PostImage) ? $PostImage : '';
					$tempPostResult['post_video']             = ($PostVideo) ? $PostVideo : '';
					$tempPostResult['document_original_name'] = ($SearchPostResultDat['original_name']) ? $SearchPostResultDat['original_name'] : '';
					$tempPostResult['poll_options']           = ($SearchPostResultDat['options']) ? $SearchPostResultDat['options'] : '';
					$tempPostResult['user_id']                = ($SearchPostResultDat['user_id']) ? $SearchPostResultDat['user_id'] : 0;
					$tempPostResult['username']               = ($SearchPostResultDat['username']) ? $SearchPostResultDat['username'] : '';
					$tempPostResult['fullname']               = $SearchPostResultDat['first_name'].' '.$SearchPostResultDat['last_name'];
					$tempPostResult['profile_picture']        = $UserProfile;
					$tempPostResult['posted_date']            = $timeAgo;
					$tempPostResult['UniversityName']         = $UniversityName;
					$tempPostResult['total_reactions']        = count($ReactionResult);
					$tempPostResult['reactions_ids']          = $ReactionIds;
					$tempPostResult['total_comments']         = count($postCommentCounter);
					array_push($AllPosts,$tempPostResult);
				}
			}
			
			// get result from questions
			// get reported questions
			$reportedQuestions = array();
			$reportedQuestionString = '';
			
			$getReportedQuestion = "SELECT question_id FROM report_questions WHERE user_id='".$CurrentUserID."'";
			$ReportedQuestionResult = $this->db->query($getReportedQuestion)->result_array();
			if(!empty($ReportedQuestionResult)){
				foreach($ReportedQuestionResult as $ReportedQuestionResultData){
					$reportedQuestions[] = $ReportedQuestionResultData['question_id'];
				}
			}
			
			if(!empty($reportedQuestions)){
				$reportedQuestionString = implode(",",$reportedQuestions);
			}
			
			$SearchQuestions = "SELECT reference_master.reference_id,reference_master.reference,reference_master.addDate,question_master.id,question_master.question_title,question_master.vote_count,question_master.textarea,question_master.view_count,user.id as user_id,user.username,user.first_name,user.last_name,user.image,user_info.gender FROM reference_master LEFT JOIN question_master ON (question_master.id = reference_master.reference_id) LEFT JOIN question_answer_master ON (question_answer_master.question_id = question_master.id AND question_answer_master.question_id = reference_master.reference_id) LEFT JOIN user ON (user.id = reference_master.user_id) LEFT JOIN user_info ON (user_info.userID = user.id) WHERE 1=1 AND reference_master.status = '1' AND question_master.status='1' AND reference_master.reference='question' AND (question_master.question_title LIKE '%$SearchText%' OR question_master.textarea LIKE '%$SearchText%' OR question_answer_master.answer LIKE '%$SearchText%')";
			
			if($reportedQuestionString != ''){
				$SearchQuestions .= " AND question_master.id NOT IN (".$reportedQuestionString.")";
			}
			
			$SearchQuestions .= " GROUP BY question_master.id ORDER BY reference_master.addDate DESC LIMIT ".$LimitResult; 
			
			$SearchQuestionsResult = $this->db->query($SearchQuestions)->result_array();
			$FoundQuestionResult = count($SearchQuestionsResult);
			
			if(!empty($SearchQuestionsResult)){
				if(!empty($SearchQuestionsResult)){
					foreach($SearchQuestionsResult as $SearchQuestionsResultData){
						$addDate = ($SearchQuestionsResultData['addDate']) ? date("Y-m-d H:i:s",strtotime($SearchQuestionsResultData['addDate'])) : '';
						$timeAgo = $this->timestring($addDate);
						
						$question_id = ($SearchQuestionsResultData['id']) ? $SearchQuestionsResultData['id'] : 0;
						
						if($SearchQuestionsResultData['gender'] == 'female'){
							$UserProfile = base_url('uploads/user-female.png');
						} else if($SearchQuestionsResultData['gender'] == 'male') {
							$UserProfile = base_url('uploads/user-male.png');
						} else if($SearchQuestionsResultData['gender'] == 'other') {
							$UserProfile = base_url('uploads/user-anonymous.png');
						} else {
							$UserProfile = base_url().'assets_d/images/user.jpg';
						}
						
						if($SearchQuestionsResultData['image'] != '' && file_exists('uploads/users/'.$SearchQuestionsResultData['image'])){
							$UserProfile = base_url('uploads/users/'.$SearchQuestionsResultData['image']);
						}
						
						// get university name
						$getUniversityName = "SELECT user_info.intitutionID,university.SchoolName FROM user_info LEFT JOIN university ON (university.university_id = user_info.intitutionID) WHERE 1=1 AND user_info.userID = '".$SearchQuestionsResultData['user_id']."'";
						$UniversityResult = $this->db->query($getUniversityName)->result_array();
						
						$UniversityName = 'N/A';
						if(!empty($UniversityResult)){
							$UniversityName = ($UniversityResult[0]['SchoolName']) ? $UniversityResult[0]['SchoolName'] : 'N/A';
						}
						
						// get total answer on question counter 
						$getTotalAnswersCounter = "SELECT id FROM question_answer_master WHERE question_id='".$question_id."' AND status='1'";
						$AnswerCounterResult = $this->db->query($getTotalAnswersCounter)->result_array();
						
						$tempQuestion['reference_id']         = $SearchQuestionsResultData['reference_id'];
						$tempQuestion['question_id']          = $question_id;
						$tempQuestion['question_title']       = $SearchQuestionsResultData['question_title'];
						$tempQuestion['question_description'] = $SearchQuestionsResultData['textarea'];
						$tempQuestion['post_at']              = $timeAgo;
						$tempQuestion['user_id']              = ($SearchQuestionsResultData['user_id']) ? $SearchQuestionsResultData['user_id'] : 0;
						$tempQuestion['username']             = ($SearchQuestionsResultData['username']) ? $SearchQuestionsResultData['username'] : '';
						$tempQuestion['fullname']             = $SearchQuestionsResultData['first_name'].' '.$SearchQuestionsResultData['last_name'];
						$tempQuestion['profile_picture']      = $UserProfile;
						$tempQuestion['UniversityName']       = $UniversityName;
						$tempQuestion['view_count']           = $SearchQuestionsResultData['view_count'];
						$tempQuestion['answer_count']         = count($AnswerCounterResult);
						$tempQuestion['vote_count']           = $SearchQuestionsResultData['vote_count'];
						array_push($AllQuestions,$tempQuestion);
					}
				}
			}
			
			// get result from documents
			// get reported questions
			$reportedDocuments = array();
			$reportedDocumentString = '';
			
			$getReportedDocument = "SELECT document_id FROM report_documents WHERE user_id='".$CurrentUserID."'";
			$ReportedDocumentResult = $this->db->query($getReportedDocument)->result_array();
			if(!empty($ReportedDocumentResult)){
				foreach($ReportedDocumentResult as $ReportedDocumentResultData){
					$reportedDocuments[] = $ReportedDocumentResultData['document_id'];
				}
			}
			
			if(!empty($reportedDocuments)){
				$reportedDocumentString = implode(",",$reportedDocuments);
			}
			
			$SearchDocuments = "SELECT reference_master.reference_id,reference_master.reference,reference_master.addDate,document_master.id,document_master.document_name,document_master.description,document_master.description,document_master.featured_image,user.id as user_id,user.username,user.first_name,user.last_name,user.image,user_info.gender FROM reference_master LEFT JOIN document_master ON (document_master.id = reference_master.reference_id) LEFT JOIN user ON (user.id = reference_master.user_id) LEFT JOIN user_info ON (user_info.userID = user.id) WHERE 1=1 AND reference_master.status = '1' AND document_master.status='1' AND reference_master.reference='document' AND document_master.privacy = '1' AND (document_master.document_name LIKE '%$SearchText%' OR document_master.description LIKE '%$SearchText%') ";
			
			if($reportedDocumentString != ''){
				$SearchDocuments .= " AND document_master.id NOT IN(".$reportedDocumentString.")";
			}
			
			$SearchDocuments .= " ORDER BY reference_master.addDate DESC LIMIT ".$LimitResult;
			
			$SearchDocumentResult = $this->db->query($SearchDocuments)->result_array();
			
			$FoundDocumentResult = count($SearchDocumentResult);
			
			if(!empty($SearchDocumentResult))
			{	
				foreach($SearchDocumentResult as $SearchDocumentResultData)
				{
					$addDate = ($SearchDocumentResultData['addDate']) ? date("Y-m-d H:i:s",strtotime($SearchDocumentResultData['addDate'])) : '';
					$timeAgo = $this->timestring($addDate);
					
					$document_id = $SearchDocumentResultData['id'];
					
					// get user profile picture
					if($SearchDocumentResultData['gender'] == 'female'){
						$UserProfile = base_url('uploads/user-female.png');
					} else if($SearchDocumentResultData['gender'] == 'male') {
						$UserProfile = base_url('uploads/user-male.png');
					} else if($SearchDocumentResultData['gender'] == 'other') {
						$UserProfile = base_url('uploads/user-anonymous.png');
					} else {
						$UserProfile = base_url().'assets_d/images/user.jpg';
					}
					
					if($SearchDocumentResultData['image'] != '' && file_exists('uploads/users/'.$SearchDocumentResultData['image'])){
						$UserProfile = base_url('uploads/users/'.$SearchDocumentResultData['image']);
					}
					
					// get university name
					$getUniversityName = "SELECT user_info.intitutionID,university.SchoolName FROM user_info LEFT JOIN university ON (university.university_id = user_info.intitutionID) WHERE 1=1 AND user_info.userID = '".$SearchDocumentResultData['user_id']."'";
					$UniversityResult = $this->db->query($getUniversityName)->result_array();
					
					$UniversityName = 'N/A';
					if(!empty($UniversityResult)){
						$UniversityName = ($UniversityResult[0]['SchoolName']) ? $UniversityResult[0]['SchoolName'] : 'N/A';
					}
					
					$DocumentLink = '';
					if($SearchDocumentResultData['featured_image'] != '' && file_exists('uploads/users/'.$SearchDocumentResultData['featured_image'])){
						$DocumentLink = base_url('uploads/users/'.$SearchDocumentResultData['featured_image']);
					}
					
					// get total number of reactions and unique reaction id
					$getReactionMaster = "SELECT reaction_id FROM reaction_master WHERE reference_id='".$document_id."' AND reference='document'";
					$ReactionResult    = $this->db->query($getReactionMaster)->result_array();
					
					$getUniqueReactionsID = "SELECT reaction_id FROM reaction_master WHERE reference_id='".$document_id."' AND reference='document' GROUP BY reaction_id";
					$UniqueReactionResult = $this->db->query($getUniqueReactionsID)->result_array();
					
					$ReactionIds = array();
					if(!empty($UniqueReactionResult)){
						foreach($UniqueReactionResult as $UniqueReactionResultData){
							$ReactionIds[] = $UniqueReactionResultData['reaction_id'];
						}
					}
					
					// get total active comments counter in posts
					$getDocumentCommentCounter = "SELECT id FROM comment_master WHERE reference_id='".$document_id."' AND reference='document' AND status='1'";
					$docCommentCounter    = $this->db->query($getDocumentCommentCounter)->result_array();
					
					$getAvgRating   = "SELECT AVG(rating) as average FROM document_rating_master WHERE document_id='".$document_id."'";
					$averageRatings = $this->db->query($getAvgRating)->result_array();
					
					$avgRatings = 0;
					if(!empty($averageRatings)){
						$avgRatings = round($averageRatings[0]['average'], 1);
					}
					
					$tempDocuments['reference_id']    = $SearchDocumentResultData['reference_id'];
					$tempDocuments['document_id']     = $document_id;
					$tempDocuments['document_name']   = $SearchDocumentResultData['document_name'];
					$tempDocuments['description']     = $SearchDocumentResultData['description'];
					$tempDocuments['post_at']         = $timeAgo;
					$tempDocuments['user_id']         = ($SearchDocumentResultData['user_id']) ? $SearchDocumentResultData['user_id'] : 0;
					$tempDocuments['username']        = ($SearchDocumentResultData['username']) ? $SearchDocumentResultData['username'] : '';
					$tempDocuments['fullname']        = $SearchDocumentResultData['first_name'].' '.$SearchDocumentResultData['last_name'];
					$tempDocuments['profile_picture'] = $UserProfile;
					$tempDocuments['document_link']   = $DocumentLink;
					$tempDocuments['document_file']   = ($SearchDocumentResultData['featured_image']) ? $SearchDocumentResultData['featured_image'] : '';
					$tempDocuments['UniversityName']  = $UniversityName;
					$tempDocuments['total_reactions'] = count($ReactionResult);
					$tempDocuments['reactions_ids']   = $ReactionIds;
					$tempDocuments['total_comments']  = count($docCommentCounter);
					$tempDocuments['avgRatings']      = $avgRatings;
					array_push($AllDocuments,$tempDocuments);
				}
			}
			
			//get search result from study set
			// get reported questions
			$reportedStudyset = array();
			$reportedStudysetString = '';
			
			$getReportedStudyset = "SELECT study_set_id FROM reported WHERE user_id='".$CurrentUserID."'";
			$ReportedStudysetResult = $this->db->query($getReportedStudyset)->result_array();
			if(!empty($ReportedStudysetResult)){
				foreach($ReportedStudysetResult as $ReportedStudysetResultData){
					$reportedStudyset[] = $ReportedStudysetResultData['study_set_id'];
				}
			}
			
			if(!empty($reportedStudyset)){
				$reportedStudysetString = implode(",",$reportedStudyset);
			}
			
			$SearchStudySet = "SELECT reference_master.reference_id,reference_master.reference,reference_master.addDate,user.id as user_id,user.username,user.first_name,user.last_name,user.image as pp,study_sets.study_set_id,study_sets.name,study_sets.image,user_info.gender FROM reference_master LEFT JOIN study_sets ON (study_sets.study_set_id = reference_master.reference_id) LEFT JOIN study_set_terms ON (study_set_terms.study_set_id = study_sets.study_set_id AND study_set_terms.study_set_id = reference_master.reference_id) LEFT JOIN user ON (user.id = reference_master.user_id) LEFT JOIN user_info ON (user_info.userID = user.id) WHERE 1=1 AND reference_master.status = '1' AND study_sets.status='1' AND reference_master.reference='studyset' AND study_sets.privacy = '1' AND (study_sets.name LIKE '%$SearchText%' OR study_set_terms.term_description LIKE '%$SearchText%') ";
			
			if($reportedStudysetString != ''){
				$SearchStudySet .= " AND study_sets.study_set_id NOT IN (".$reportedStudysetString.")";
			}
			
			$SearchStudySet .= " GROUP BY study_sets.study_set_id ORDER BY reference_master.addDate DESC LIMIT ".$LimitResult;
			
			$SearchStudySetResult = $this->db->query($SearchStudySet)->result_array();
			
			$FoundStudySetResult = count($SearchStudySetResult);
			
			if(!empty($SearchStudySetResult)){
				foreach($SearchStudySetResult as $SearchStudySetData)
				{
					$addDate = ($SearchStudySetData['addDate']) ? date("Y-m-d H:i:s",strtotime($SearchStudySetData['addDate'])) : '';
					$timeAgo = $this->timestring($addDate);
					
					$study_set_id = $SearchStudySetData['study_set_id'];
					
					// get cover page link
					$CoverimageLink = '';
					if($SearchStudySetData['image'] != '' && file_exists('uploads/studyset/'.$SearchStudySetData['image'])){
						$CoverimageLink = base_url('uploads/studyset/'.$SearchStudySetData['image']);
					}
					
					// get user profile picture
					if($SearchStudySetData['gender'] == 'female'){
						$UserProfile = base_url('uploads/user-female.png');
					} else if($SearchStudySetData['gender'] == 'male') {
						$UserProfile = base_url('uploads/user-male.png');
					} else if($SearchStudySetData['gender'] == 'other') {
						$UserProfile = base_url('uploads/user-anonymous.png');
					} else {
						$UserProfile = base_url().'assets_d/images/user.jpg';
					}
					
					if($SearchStudySetData['pp'] != '' && file_exists('uploads/users/'.$SearchStudySetData['pp'])){
						$UserProfile = base_url('uploads/users/'.$SearchStudySetData['pp']);
					}
					
					// get university name
					$getUniversityName = "SELECT user_info.intitutionID,university.SchoolName FROM user_info LEFT JOIN university ON (university.university_id = user_info.intitutionID) WHERE 1=1 AND user_info.userID = '".$SearchStudySetData['user_id']."'";
					$UniversityResult = $this->db->query($getUniversityName)->result_array();
					
					$UniversityName = 'N/A';
					if(!empty($UniversityResult)){
						$UniversityName = ($UniversityResult[0]['SchoolName']) ? $UniversityResult[0]['SchoolName'] : 'N/A';
					}
					
					// get total number of reactions and unique reaction id
					$getReactionMaster = "SELECT reaction_id FROM reaction_master WHERE reference_id='".$study_set_id."' AND reference='studyset'";
					$ReactionResult    = $this->db->query($getReactionMaster)->result_array();
					
					$getUniqueReactionsID = "SELECT reaction_id FROM reaction_master WHERE reference_id='".$study_set_id."' AND reference='studyset' GROUP BY reaction_id";
					$UniqueReactionResult = $this->db->query($getUniqueReactionsID)->result_array();
					
					$ReactionIds = array();
					if(!empty($UniqueReactionResult)){
						foreach($UniqueReactionResult as $UniqueReactionResultData){
							$ReactionIds[] = $UniqueReactionResultData['reaction_id'];
						}
					}
					
					// get total active comments counter in posts
					$getStudysetCommentCounter = "SELECT id FROM comment_master WHERE reference_id='".$study_set_id."' AND reference='studyset' AND status='1'";
					$ssCommentCounter    = $this->db->query($getStudysetCommentCounter)->result_array();
					
					$getAvgRating   = "SELECT AVG(rating) as average FROM studyset_rating_master WHERE study_set_id='".$study_set_id."'";
					$averageRatings = $this->db->query($getAvgRating)->result_array();
					
					$avgRatings = 0;
					if(!empty($averageRatings)){
						$avgRatings = round($averageRatings[0]['average'], 1);
					}
					
					$tempStudySet['reference_id']    = $SearchStudySetData['reference_id'];
					$tempStudySet['studyset_name']   = $SearchStudySetData['name'];
					$tempStudySet['studyset_cover']  = $CoverimageLink;
					$tempStudySet['studyset_id']     = $SearchStudySetData['study_set_id'];
					$tempStudySet['post_at']         = $timeAgo;
					$tempStudySet['user_id']         = ($SearchStudySetData['user_id']) ? $SearchStudySetData['user_id'] : 0;
					$tempStudySet['username']        = ($SearchStudySetData['username']) ? $SearchStudySetData['username'] : '';
					$tempStudySet['fullname']        = $SearchStudySetData['first_name'].' '.$SearchStudySetData['last_name'];
					$tempStudySet['profile_picture'] = $UserProfile;
					$tempStudySet['UniversityName']  = $UniversityName;
					$tempStudySet['total_reactions'] = count($ReactionResult);
					$tempStudySet['reactions_ids']   = $ReactionIds;
					$tempStudySet['total_comments']  = count($ssCommentCounter);
					$tempStudySet['avgRatings']      = $avgRatings;
					array_push($AllStudySets,$tempStudySet);
				}
			}
			
			//get search result from events
			// get reported questions
			$reportedEvents = array();
			$reportedEventsString = '';
			
			$getReportedEvents = "SELECT event_id FROM report_event WHERE user_id='".$CurrentUserID."'";
			$ReportedEventsResult = $this->db->query($getReportedEvents)->result_array();
			if(!empty($ReportedEventsResult)){
				foreach($ReportedEventsResult as $ReportedEventsResultData){
					$reportedEvents[] = $ReportedEventsResultData['event_id'];
				}
			}
			
			if(!empty($reportedEvents)){
				$reportedEventsString = implode(",",$reportedEvents);
			}
			
			$SearchEvents = "SELECT reference_master.reference_id,reference_master.reference,reference_master.addDate,user.id as user_id,user.username,user.first_name,user.last_name,user.image as pp,event_master.id,event_master.event_name,event_master.description,event_master.location_txt,event_master.start_date,event_master.start_time,event_master.featured_image,user_info.gender FROM reference_master LEFT JOIN event_master ON (event_master.id = reference_master.reference_id) LEFT JOIN user ON (user.id = reference_master.user_id) LEFT JOIN user_info ON (user_info.userID = user.id) WHERE 1=1 AND reference_master.status = '1' AND event_master.status='1' AND reference_master.reference='event' AND event_master.privacy = '1' AND (event_master.event_name LIKE '%$SearchText%' OR event_master.location_txt LIKE '%$SearchText%' OR event_master.description LIKE '%$SearchText%') ";
			
			if($reportedEventsString != ''){
				$SearchEvents .= " AND event_master.id NOT IN (".$reportedEventsString.")";
			}
			
			$SearchEvents .= " ORDER BY reference_master.addDate DESC LIMIT ".$LimitResult;
			
			$SearchEventsResult = $this->db->query($SearchEvents)->result_array();
			
			$FoundEventsResult = count($SearchEventsResult);
			
			if(!empty($SearchEventsResult))
			{
				foreach($SearchEventsResult as $SearchEventsResultData){
					$addDate = ($SearchEventsResultData['addDate']) ? date("Y-m-d H:i:s",strtotime($SearchEventsResultData['addDate'])) : '';
					$timeAgo = $this->timestring($addDate);
					
					$event_primary_id = $SearchEventsResultData['id'];
					
					$tempEvents['event_name'] = ($SearchEventsResultData['event_name']) ? $SearchEventsResultData['event_name'] : '';
					$tempEvents['event_description'] = ($SearchEventsResultData['description']) ? $SearchEventsResultData['description'] : '';
					$tempEvents['event_location'] = ($SearchEventsResultData['location_txt']) ? $SearchEventsResultData['location_txt'] : '';
					
					$start_date = ($SearchEventsResultData['start_date']) ? date("M d,",strtotime($SearchEventsResultData['start_date'])) : '';
					$start_time = ($SearchEventsResultData['start_time']) ? date("h:i A",strtotime($SearchEventsResultData['start_time'])) : '';
					$tempEvents['event_time'] = $start_date.' '.$start_time;
					
					// get featured image
					$FeaturedImage = '';
					if($SearchEventsResultData['featured_image'] != '' && file_exists('uploads/users/'.$SearchEventsResultData['featured_image'])){
						$FeaturedImage = base_url('uploads/users/'.$SearchEventsResultData['featured_image']);
					}
					$tempEvents['featured_image'] = $FeaturedImage;
					
					// get user profile picture
					if($SearchEventsResultData['gender'] == 'female'){
						$UserProfile = base_url('uploads/user-female.png');
					} else if($SearchEventsResultData['gender'] == 'male') {
						$UserProfile = base_url('uploads/user-male.png');
					} else if($SearchEventsResultData['gender'] == 'other') {
						$UserProfile = base_url('uploads/user-anonymous.png');
					} else {
						$UserProfile = base_url().'assets_d/images/user.jpg';
					}
					
					if($SearchEventsResultData['pp'] != '' && file_exists('uploads/users/'.$SearchEventsResultData['pp'])){
						$UserProfile = base_url('uploads/users/'.$SearchEventsResultData['pp']);
					}
					
					// get university name
					$getUniversityName = "SELECT user_info.intitutionID,university.SchoolName FROM user_info LEFT JOIN university ON (university.university_id = user_info.intitutionID) WHERE 1=1 AND user_info.userID = '".$SearchEventsResultData['user_id']."'";
					$UniversityResult = $this->db->query($getUniversityName)->result_array();
					
					$UniversityName = 'N/A';
					if(!empty($UniversityResult)){
						$UniversityName = ($UniversityResult[0]['SchoolName']) ? $UniversityResult[0]['SchoolName'] : 'N/A';
					}
					
					// get total number of reactions and unique reaction id
					$getReactionMaster = "SELECT reaction_id FROM reaction_master WHERE reference_id='".$event_primary_id."' AND reference='event'";
					$ReactionResult    = $this->db->query($getReactionMaster)->result_array();
					
					$getUniqueReactionsID = "SELECT reaction_id FROM reaction_master WHERE reference_id='".$event_primary_id."' AND reference='event' GROUP BY reaction_id";
					$UniqueReactionResult = $this->db->query($getUniqueReactionsID)->result_array();
					
					$ReactionIds = array();
					if(!empty($UniqueReactionResult)){
						foreach($UniqueReactionResult as $UniqueReactionResultData){
							$ReactionIds[] = $UniqueReactionResultData['reaction_id'];
						}
					}
					
					// get total active comments counter in posts
					$getEventsCommentCounter = "SELECT id FROM comment_master WHERE reference_id='".$event_primary_id."' AND reference='event' AND status='1'";
					$EveCommentCounter    = $this->db->query($getEventsCommentCounter)->result_array();
					
					$tempEvents['reference_id']    = $SearchEventsResultData['reference_id'];
					$tempEvents['event_primary_id']= $event_primary_id;
					$tempEvents['post_at']         = $timeAgo;
					$tempEvents['user_id']         = ($SearchEventsResultData['user_id']) ? $SearchEventsResultData['user_id'] : 0;
					$tempEvents['username']        = ($SearchEventsResultData['username']) ? $SearchEventsResultData['username'] : '';
					$tempEvents['fullname']        = $SearchEventsResultData['first_name'].' '.$SearchEventsResultData['last_name'];
					$tempEvents['profile_picture'] = $UserProfile;
					$tempEvents['UniversityName']  = $UniversityName;
					$tempEvents['total_reactions'] = count($ReactionResult);
					$tempEvents['reactions_ids']   = $ReactionIds;
					$tempEvents['total_comments']  = count($EveCommentCounter);
					
					array_push($AllEvents,$tempEvents);
				}
			}
		}
		 
		$data['CurrentUserID'] = $CurrentUserID; 
		$data['AllPeers']      = $AllPeers;
		$data['AllPosts']      = $AllPosts;
		$data['AllQuestions']  = $AllQuestions;
		$data['AllDocuments']  = $AllDocuments;
		$data['AllStudySets']  = $AllStudySets;
		$data['AllEvents']     = $AllEvents;
		
        $this->load->view('user/include/header', $data);
        $this->load->view('user/search-result');
        $this->load->view('user/include/right-sidebar');

        $this->load->view('user/include/firebase-include');
        $this->load->view('user/include/footer-dashboard');
    }
	
	public function searchViewAll($searchType = null,$tabType = null){
        $data['index_menu']  = 'search';
        $data['title']  = 'Search View All | Studypeers';
		
		$data['tabType'] = $tabType;

		$SearchText = ($this->session->userdata('SearchText')) ? $this->session->userdata('SearchText') : '';
		$data['SearchText']  = $SearchText;
		
		if(empty($SearchText)){
			redirect(base_url('account/searchResult'));
		}
		
		$postTypes = array('peers','posts','questions','documents','studysets','events','qa','textbooks','articles','studynotes');
		
		if($searchType == ''){
			redirect(base_url('account/searchResult'));
		} else if($searchType != '' && !in_array(strtolower($searchType),$postTypes)){
			redirect(base_url('account/searchResult'));
		}
		 
		$data['searchType'] = strtolower($searchType);
		
		$CurrentUserID = ($this->session->userdata['user_data']['user_id']) ? $this->session->userdata['user_data']['user_id'] : 0;
			
		$GetUserInfo   = $this->db->query("SELECT intitutionID FROM user_info WHERE userID='".$CurrentUserID."'")->row();
		$intitutionID  = (!empty($GetUserInfo)) ? $GetUserInfo->intitutionID : '';

        $this->load->view('user/include/header', $data);
        $this->load->view('user/search-view-all');
        
        $this->load->view('user/include/right-sidebar');

        $this->load->view('user/include/firebase-include');
        $this->load->view('user/include/footer-dashboard');
    }
	
	public function loadData($record=0,$searchType = null) {
		$recordPerPage = 5;
		// if($record != 0){
			// $record = ($record-1) * $recordPerPage;
		// }      	
      	
		$SearchText = ($this->session->userdata('SearchText')) ? $this->session->userdata('SearchText') : '';
		
		$CurrentUserID = ($this->session->userdata['user_data']['user_id']) ? $this->session->userdata['user_data']['user_id'] : 0;
		
		$GetUserInfo   = $this->db->query("SELECT intitutionID FROM user_info WHERE userID='".$CurrentUserID."'")->row();
		$intitutionID  = (!empty($GetUserInfo)) ? $GetUserInfo->intitutionID : '';
		
		$recordCount = 0;
		$searchData  = array();
		$searchHtml = '';
		$searchThing = '';
		
		if($searchType == 'peers') {
			$searchThing = 'Peers';
			
			$AllPeers = array();
			$ExistingUsers = array();
			$SearchUserid = array();
			
			$LimitResult     = 5;
			$FoundResult     = 0;
			$FoundResult2    = 0;
			
			// get reported questions
			$reportedUsers = array();
			$reportedUsersString = '';
			
			$getReportedUsers = "SELECT report_user_id FROM user_report_master WHERE user_id='".$CurrentUserID."' AND status='1'";
			$ReportedUsersResult = $this->db->query($getReportedUsers)->result_array();
			if(!empty($ReportedUsersResult)){
				foreach($ReportedUsersResult as $ReportedUsersResultData){
					$reportedUsers[] = $ReportedUsersResultData['report_user_id'];
				}
			}
			
			$getBlockedUsers = "SELECT peer_id FROM blocked_peers WHERE user_id='".$CurrentUserID."'";
			$BlockedUserResult = $this->db->query($getBlockedUsers)->result_array();
			if(!empty($BlockedUserResult)){
				foreach($BlockedUserResult as $BlockedUserResultData){
					$reportedUsers[] = $BlockedUserResultData['peer_id'];
				}
			}
			
			if(!empty($reportedUsers)){
				$reportedUsersString = implode(",",$reportedUsers);
			}
			
			// search for my friends / peers
			$SearchPeers = "SELECT peer_master.peer_id,user.id,user.username,user.first_name,user.last_name,user.image,user_info.gender FROM peer_master LEFT JOIN user ON (user.id = peer_master.peer_id) LEFT JOIN user_info ON (user_info.userID = user.id) WHERE peer_master.user_id='".$CurrentUserID."' AND peer_master.status='2' AND (user.first_name LIKE '%$SearchText%' OR user.last_name LIKE '%$SearchText%' OR user.username LIKE '%$SearchText%' OR user.about LIKE '%$SearchText%' OR user.email LIKE '%$SearchText%')";
			
			if($reportedUsersString != ''){
				$SearchPeers .= " AND user.id NOT IN (".$reportedUsersString.")";
			}
			
			$SearchPeers .= " ORDER BY user.id DESC";
			
			$SearchPeersResult = $this->db->query($SearchPeers)->result_array();
			$FoundResult = count($SearchPeersResult);
			
			if(!empty($SearchPeersResult))
			{
				foreach($SearchPeersResult as $SearchPeersResultData)
				{
					$SearchUserid[]  = $SearchPeersResultData['id'];
					
					if(!in_array($SearchPeersResultData['id'],$ExistingUsers)){
						$ExistingUsers[] = $SearchPeersResultData['id'];
						
						if($SearchPeersResultData['gender'] == 'female'){
							$UserProfile = base_url('uploads/user-female.png');
						} else if($SearchPeersResultData['gender'] == 'male') {
							$UserProfile = base_url('uploads/user-male.png');
						} else if($SearchPeersResultData['gender'] == 'other') {
							$UserProfile = base_url('uploads/user-anonymous.png');
						} else {
							$UserProfile = base_url().'assets_d/images/user.jpg';
						}
						
						if($SearchPeersResultData['image'] != '' && file_exists('uploads/users/'.$SearchPeersResultData['image'])){
							$UserProfile = base_url('uploads/users/'.$SearchPeersResultData['image']);
						}
							
						$getUniversityName = "SELECT user_info.intitutionID,university.SchoolName,user_info.user_location FROM user_info LEFT JOIN university ON (university.university_id = user_info.intitutionID) WHERE 1=1 AND user_info.userID = '".$SearchPeersResultData['id']."'";
						$UniversityResult = $this->db->query($getUniversityName)->result_array();
						
						$UniversityName = 'N/A';
						$LocationName = 'N/A';
						if(!empty($UniversityResult)){
							$UniversityName = ($UniversityResult[0]['SchoolName']) ? $UniversityResult[0]['SchoolName'] : 'N/A';
							$LocationName = ($UniversityResult[0]['user_location']) ? $UniversityResult[0]['user_location'] : 'N/A';
						}
		
						$getFollowerCounter = "SELECT id FROM follow_master WHERE peer_id='".$SearchPeersResultData['id']."'";
						$FollowerResult = $this->db->query($getFollowerCounter)->result_array();
						$TotalFollower = 0;
						if(!empty($FollowerResult)){
							$TotalFollower = count($FollowerResult);
						}
						
						$checkFollowingStatus = "SELECT * FROM follow_master WHERE user_id='".$CurrentUserID."' AND peer_id='".$SearchPeersResultData['id']."'";
						$FollowStatusResult = $this->db->query($checkFollowingStatus)->result_array();
						
						if(!empty($FollowStatusResult)){
							$isFollowing = 1;
						} else {
							$isFollowing = 0;
						}
						
						$tempPeers = array();
						$tempPeers['id']             = $SearchPeersResultData['id']; 	
						$tempPeers['username']       = $SearchPeersResultData['username']; 
						$tempPeers['UserProfile']    = $UserProfile; 
						$tempPeers['full_name']      = $SearchPeersResultData['first_name'].' '.$SearchPeersResultData['last_name']; 
						$tempPeers['UniversityName'] = $UniversityName; 
						$tempPeers['LocationName']   = $LocationName; 
						$tempPeers['totalFollower']  = $TotalFollower;
						$tempPeers['isFollowing']    = $isFollowing;		
						array_push($AllPeers,$tempPeers);
					}
				}
			}
			
			$SearchUseridString = '';
			if(count($SearchUserid) > 0){
				$SearchUseridString = implode(",",$SearchUserid);
			}
			
			// get mutal friends from search result
			if(!empty($SearchPeersResult))
			{
				foreach($SearchPeersResult as $SearchPeersResultData)
				{
					$MutalQuery = "SELECT u.id,u.username,u.first_name,u.last_name,u.image,user_info.gender FROM friends f1 INNER JOIN friends f2 ON (f2.peer_id = f1.peer_id) INNER JOIN user u ON (u.id = f2.peer_id) LEFT JOIN user_info ON (user_info.userID = u.id) WHERE f1.user_id = '".$CurrentUserID."' AND f2.user_id = '".$SearchPeersResultData['id']."'";
					
					if($SearchUseridString != ''){
						$MutalQuery .= " AND u.id NOT IN (".$SearchUseridString.")";
					}
					
					if($reportedUsersString != ''){
						$MutalQuery .= " AND u.id NOT IN (".$reportedUsersString.")";
					}
					
					$SearchMutalFriends = $this->db->query($MutalQuery)->result_array();
					
					if(!empty($SearchMutalFriends)){
						foreach($SearchMutalFriends as $SearchMutalFriend){
							
							if(!in_array($SearchMutalFriend['id'],$ExistingUsers)){
								$ExistingUsers[] = $SearchMutalFriend['id'];
								
								if($SearchMutalFriend['gender'] == 'female'){
									$UserProfile = base_url('uploads/user-female.png');
								} else if($SearchMutalFriend['gender'] == 'male') {
									$UserProfile = base_url('uploads/user-male.png');
								} else if($SearchMutalFriend['gender'] == 'other') {
									$UserProfile = base_url('uploads/user-anonymous.png');
								} else {
									$UserProfile = base_url().'assets_d/images/user.jpg';
								}
						
								if($SearchMutalFriend['image'] != '' && file_exists('uploads/users/'.$SearchMutalFriend['image'])){
									$UserProfile = base_url('uploads/users/'.$SearchMutalFriend['image']);
								}
								
								$getUniversityName = "SELECT user_info.intitutionID,university.SchoolName,user_info.user_location FROM user_info LEFT JOIN university ON (university.university_id = user_info.intitutionID) WHERE 1=1 AND user_info.userID = '".$SearchMutalFriend['id']."'";
								$UniversityResult = $this->db->query($getUniversityName)->result_array();
								
								$UniversityName = 'N/A';
								$LocationName = 'N/A';
								if(!empty($UniversityResult)){
									$UniversityName = ($UniversityResult[0]['SchoolName']) ? $UniversityResult[0]['SchoolName'] : 'N/A';
									$LocationName = ($UniversityResult[0]['user_location']) ? $UniversityResult[0]['user_location'] : 'N/A';
								}
								
								$getFollowerCounter = "SELECT id FROM follow_master WHERE peer_id='".$SearchMutalFriend['id']."'";
								$FollowerResult = $this->db->query($getFollowerCounter)->result_array();
								$TotalFollower = 0;
								if(!empty($FollowerResult)){
									$TotalFollower = count($FollowerResult);
								}
								
								$checkFollowingStatus = "SELECT * FROM follow_master WHERE user_id='".$CurrentUserID."' AND peer_id='".$SearchMutalFriend['id']."'";
								$FollowStatusResult = $this->db->query($checkFollowingStatus)->result_array();
								
								if(!empty($FollowStatusResult)){
									$isFollowing = 1;
								} else {
									$isFollowing = 0;
								}
								
								$SearchUserid[]  = $SearchMutalFriend['id'];
								
								$tempPeers = array();
								$tempPeers['id']             = $SearchMutalFriend['id']; 	
								$tempPeers['username']       = $SearchMutalFriend['username']; 
								$tempPeers['UserProfile']    = $UserProfile; 
								$tempPeers['full_name']      = $SearchMutalFriend['first_name'].' '.$SearchMutalFriend['last_name']; 
								$tempPeers['UniversityName'] = $UniversityName;
								$tempPeers['LocationName']   = $LocationName;
								$tempPeers['totalFollower']  = $TotalFollower; 
								$tempPeers['isFollowing']    = $isFollowing;		
								array_push($AllPeers,$tempPeers);
							}
						}
					}
				}
			}
			
			// search peers based on university
			if($intitutionID != '')
			{
				$SearchByUniversity = "SELECT user_info.userID,user.id,user.username,user.first_name,user.last_name,user.image,user_info.user_location,user_info.gender FROM user_info LEFT JOIN user ON (user.id = user_info.userID) WHERE user_info.userID != '".$CurrentUserID."' AND user_info.intitutionID='".$intitutionID."'";	
				
				if($SearchUseridString != ''){
					$SearchByUniversity .= " AND user.id NOT IN (".$SearchUseridString.")";
				}
				
				if($reportedUsersString != ''){
					$SearchByUniversity .= " AND user.id NOT IN (".$reportedUsersString.")";
				}
				
				$SearchByUniversity .= " AND (user.first_name LIKE '%$SearchText%' OR user.last_name LIKE '%$SearchText%' OR user.username LIKE '%$SearchText%' OR user.about LIKE '%$SearchText%' OR user.email LIKE '%$SearchText%')";
				
				$SearchByUniversity .= " ORDER BY user.id DESC";
				
				$SearchUniversityResult = $this->db->query($SearchByUniversity)->result_array();
				$FoundResult2 = count($SearchUniversityResult);
				
				if(!empty($SearchUniversityResult))
				{
					foreach($SearchUniversityResult as $SearchUniversityResultData)
					{
						$SearchUserid[]  = $SearchUniversityResultData['id'];
						
						if(!in_array($SearchUniversityResultData['id'],$ExistingUsers))
						{	
							$ExistingUsers[] = $SearchUniversityResultData['id'];
						
							if($SearchUniversityResultData['gender'] == 'female'){
								$UserProfile = base_url('uploads/user-female.png');
							} else if($SearchUniversityResultData['gender'] == 'male') {
								$UserProfile = base_url('uploads/user-male.png');
							} else if($SearchUniversityResultData['gender'] == 'other') {
								$UserProfile = base_url('uploads/user-anonymous.png');
							} else {
								$UserProfile = base_url().'assets_d/images/user.jpg';
							}
								
							if($SearchUniversityResultData['image'] != '' && file_exists('uploads/users/'.$SearchUniversityResultData['image'])){
								$UserProfile = base_url('uploads/users/'.$SearchUniversityResultData['image']);
							}
								
							$getUniversityName = "SELECT user_info.intitutionID,university.SchoolName FROM user_info LEFT JOIN university ON (university.university_id = user_info.intitutionID) WHERE 1=1 AND user_info.userID = '".$SearchUniversityResultData['id']."'";
							$UniversityResult = $this->db->query($getUniversityName)->result_array();
							
							$UniversityName = 'N/A';
							if(!empty($UniversityResult)){
								$UniversityName = ($UniversityResult[0]['SchoolName']) ? $UniversityResult[0]['SchoolName'] : 'N/A';
							}	
								
							$getFollowerCounter = "SELECT id FROM follow_master WHERE peer_id='".$SearchUniversityResultData['id']."'";
							$FollowerResult = $this->db->query($getFollowerCounter)->result_array();
							$TotalFollower = 0;
							if(!empty($FollowerResult)){
								$TotalFollower = count($FollowerResult);
							}	
								
							$checkFollowingStatus = "SELECT * FROM follow_master WHERE user_id='".$CurrentUserID."' AND peer_id='".$SearchUniversityResultData['id']."'";
							$FollowStatusResult = $this->db->query($checkFollowingStatus)->result_array();
							
							if(!empty($FollowStatusResult)){
								$isFollowing = 1;
							} else {
								$isFollowing = 0;
							}	
							
							$tempPeers = array();		
							$tempPeers['id']             = $SearchUniversityResultData['id']; 	
							$tempPeers['username']       = $SearchUniversityResultData['username']; 
							$tempPeers['UserProfile']    = $UserProfile; 
							$tempPeers['full_name']      = $SearchUniversityResultData['first_name'].' '.$SearchUniversityResultData['last_name']; 
							$tempPeers['UniversityName'] = $UniversityName; 	
							$tempPeers['LocationName']   = ($SearchUniversityResultData['user_location']) ? $SearchUniversityResultData['user_location'] : 'N/A';		
							$tempPeers['totalFollower']  = $TotalFollower; 
							$tempPeers['isFollowing']    = $isFollowing;	
							array_push($AllPeers,$tempPeers);	
						}
					}
				}
			}
			
			$recordCount = count($AllPeers);
			
			$per_page = $recordPerPage;
			$pages = ceil($recordCount / $per_page);
					
			$page = max($record, 1); 
			$page = min($page, $pages); 
			$offset = ($page - 1) * $recordPerPage;
			if( $offset < 0 ) $offset = 0;		
			
			$paginated_orders = array();
			if (count($AllPeers)) {
				$paginated_orders = array_slice($AllPeers, $offset, $per_page, true);
			}
			
			$searchData = array();
			foreach($paginated_orders as $paginated_orders){
				array_push($searchData,$paginated_orders);
			}
			
			if(!empty($searchData)){
				$searchHtml .= '<div class="peers-listing">';	
				foreach($searchData as $searchedData){
					$searchHtml .= '
					<div class="peers-row">
						<div class="peer-left-info">
							<div class="peers-img-wrap" style="cursor:pointer;" onclick="window.location.href=\''.base_url('sp/'.$searchedData['username']).'\'">
								<img src="'.$searchedData['UserProfile'].'" alt="Image"/>
							</div>
							<div class="basic-info">
								<h3 style="cursor:pointer;" onclick="window.location.href=\''.base_url('sp/'.$searchedData['username']).'\'">'.$searchedData['full_name'].'</h3>
								<ul>
									<li>'.$searchedData['UniversityName'].'</li>
									<li>'.$searchedData['LocationName'].'</li>
									<li><a href="">'.$searchedData['totalFollower'].'</a> followers</li>
								</ul>
							</div>
						</div>
						<div class="peer-right-info">
							<ul>
								<li><a href="javascript:;"><img src="'.base_url().'assets_d/images/chat-red.svg" alt="Image" data-name="'.$searchedData['full_name'].'" data-groupId="0" data-id="'.$searchedData['id'].'" class="open-single-chat-window" /></a></li>';
								
								if($searchedData['isFollowing'] == 1){
									$searchHtml .= '<li><a href="javascript:;" class="follow_now follow_'.$searchedData['id'].'" data-id="'.$searchedData['id'].'" id="0">UnFollow</a></li>';	
								} else {
									$searchHtml .= '<li><a href="javascript:;" class="follow_now follow_'.$searchedData['id'].'" data-id="'.$searchedData['id'].'" id="1">Follow</a></li>';
								}
							$searchHtml .= '
							</ul>
						</div>
					</div>';
				}
				$searchHtml .= '</div>';
			}
			
		} else if($searchType == 'posts') {
			$searchThing = 'Posts';
			
			$AllPosts = array();
			
			//get result from posts
			// get reported posts
			$reportedPosts = array();
			$reportedPostsString = '';
			
			$getReportedPosts = "SELECT post_id FROM report_post WHERE user_id='".$CurrentUserID."'";
			$ReportedPostsResult = $this->db->query($getReportedPosts)->result_array();
			if(!empty($ReportedPostsResult)){
				foreach($ReportedPostsResult as $ReportedPostsResultData){
					$reportedPosts[] = $ReportedPostsResultData['post_id'];
				}
			}
			
			if(!empty($reportedPosts)){
				$reportedPostsString = implode(",",$reportedPosts);
			}
			
			//get particular user assigned posts ids
			$getAssignedPostsIDS = "SELECT post_id FROM post_share_with_peers WHERE peer_id='".$CurrentUserID."'";
			$AssignedPostIds = $this->db->query($getAssignedPostsIDS)->result_array();
			$FoundAssignedPost = count($AssignedPostIds);
			
			$AssignedPostIdString = '';
			$AssignedPostIdArray  = array();
			if(!empty($AssignedPostIds)) {
				foreach($AssignedPostIds as $AssignedPostIdsData){
					$AssignedPostIdArray[] = $AssignedPostIdsData['post_id'];
				}
			}
			$AssignedPostIdString = implode(",",$AssignedPostIdArray);
			
			$SearchPosts = "SELECT reference_master.reference,reference_master.addDate,posts.id,posts.post_content_html,post_documents.original_name,post_poll_options.options,post_images.image_path,post_videos.video_path,user.id as user_id,user.username,user.first_name,user.last_name,user.image,user_info.gender FROM reference_master LEFT JOIN posts ON (posts.id = reference_master.reference_id) LEFT JOIN post_images ON (posts.id = post_images.post_id AND post_images.post_id = reference_master.reference_id) LEFT JOIN post_videos ON (posts.id = post_videos.post_id AND post_videos.post_id = reference_master.reference_id) LEFT JOIN post_documents ON (posts.id = post_documents.post_id AND post_documents.post_id = reference_master.reference_id) LEFT JOIN post_poll_options ON (posts.id = post_poll_options.post_id AND post_poll_options.post_id = reference_master.reference_id) LEFT JOIN user ON (user.id = reference_master.user_id) LEFT JOIN user_info ON (user_info.userID = user.id) WHERE 1=1 AND reference_master.status = '1' AND posts.status='1' AND reference_master.reference='Post' AND (posts.post_content_html LIKE '%$SearchText%' OR post_documents.original_name LIKE '%$SearchText%' OR post_poll_options.options LIKE '%$SearchText%')";
			
			if($AssignedPostIdString != ''){
				$SearchPosts .= " AND (reference_master.reference_id IN (".$AssignedPostIdString.") OR posts.privacy_id IN (1,2) OR reference_master.user_id = '".$CurrentUserID."')"; 
			} else {
				$SearchPosts .= " AND (posts.privacy_id IN (1,2) OR reference_master.user_id = '".$CurrentUserID."')"; 
			}
			
			if($reportedPostsString != ''){
				$SearchPosts .= " AND posts.id NOT IN (".$reportedPostsString.")"; 
			}
			
			$SearchPosts .= " GROUP BY posts.id ORDER BY reference_master.addDate DESC";
			
			$SearchPostResult = $this->db->query($SearchPosts)->result_array();
			$FoundPostResult = count($SearchPostResult);
			
			if(!empty($SearchPostResult)) {
				foreach($SearchPostResult as $SearchPostResultDat){
					$addDate = ($SearchPostResultDat['addDate']) ? date("Y-m-d H:i:s",strtotime($SearchPostResultDat['addDate'])) : '';
					$timeAgo = $this->timestring($addDate);
					$post_id = ($SearchPostResultDat['id']) ? $SearchPostResultDat['id'] : 0;
					
					if($SearchPostResultDat['gender'] == 'female'){
						$UserProfile = base_url('uploads/user-female.png');
					} else if($SearchPostResultDat['gender'] == 'male') {
						$UserProfile = base_url('uploads/user-male.png');
					} else if($SearchPostResultDat['gender'] == 'other') {
						$UserProfile = base_url('uploads/user-anonymous.png');
					} else {
						$UserProfile = base_url().'assets_d/images/user.jpg';
					}
						
					if($SearchPostResultDat['image'] != '' && file_exists('uploads/users/'.$SearchPostResultDat['image'])){
						$UserProfile = base_url('uploads/users/'.$SearchPostResultDat['image']);
					}
					
					$PostImage = '';
					if($SearchPostResultDat['image_path'] != ''){
						$PostImage = base_url($SearchPostResultDat['image_path']);
					}
					
					$PostVideo = '';
					if($SearchPostResultDat['video_path'] != '' && file_exists($SearchPostResultDat['video_path'])){
						$PostVideo = base_url($SearchPostResultDat['video_path']);
					}
					
					// get university name
					$getUniversityName = "SELECT user_info.intitutionID,university.SchoolName FROM user_info LEFT JOIN university ON (university.university_id = user_info.intitutionID) WHERE 1=1 AND user_info.userID = '".$SearchPostResultDat['user_id']."'";
					$UniversityResult = $this->db->query($getUniversityName)->result_array();
					
					$UniversityName = 'N/A';
					if(!empty($UniversityResult)){
						$UniversityName = ($UniversityResult[0]['SchoolName']) ? $UniversityResult[0]['SchoolName'] : 'N/A';
					}
					
					// get total number of reactions and unique reaction id
					$getReactionMaster = "SELECT reaction_id FROM reaction_master WHERE reference_id='".$post_id."' AND reference='Post'";
					$ReactionResult    = $this->db->query($getReactionMaster)->result_array();
					
					$getUniqueReactionsID = "SELECT reaction_id FROM reaction_master WHERE reference_id='".$post_id."' AND reference='Post' GROUP BY reaction_id";
					$UniqueReactionResult = $this->db->query($getUniqueReactionsID)->result_array();
					
					$ReactionIds = array();
					if(!empty($UniqueReactionResult)){
						foreach($UniqueReactionResult as $UniqueReactionResultData){
							$ReactionIds[] = $UniqueReactionResultData['reaction_id'];
						}
					}
					
					// get total active comments counter in posts
					$getPostCommentCounter = "SELECT id FROM comment_master WHERE reference_id='".$post_id."' AND reference='Post' AND status='1'";
					$postCommentCounter    = $this->db->query($getPostCommentCounter)->result_array();
					
					$tempPostResult['post_id']                = $post_id;
					$tempPostResult['post_content_html']      = ($SearchPostResultDat['post_content_html']) ? $SearchPostResultDat['post_content_html'] : '';
					$tempPostResult['post_image']             = ($PostImage) ? $PostImage : '';
					$tempPostResult['post_video']             = ($PostVideo) ? $PostVideo : '';
					$tempPostResult['document_original_name'] = ($SearchPostResultDat['original_name']) ? $SearchPostResultDat['original_name'] : '';
					$tempPostResult['poll_options']           = ($SearchPostResultDat['options']) ? $SearchPostResultDat['options'] : '';
					$tempPostResult['user_id']                = ($SearchPostResultDat['user_id']) ? $SearchPostResultDat['user_id'] : 0;
					$tempPostResult['username']               = ($SearchPostResultDat['username']) ? $SearchPostResultDat['username'] : '';
					$tempPostResult['fullname']               = $SearchPostResultDat['first_name'].' '.$SearchPostResultDat['last_name'];
					$tempPostResult['profile_picture']        = $UserProfile;
					$tempPostResult['posted_date']            = $timeAgo;
					$tempPostResult['UniversityName']         = $UniversityName;
					$tempPostResult['total_reactions']        = count($ReactionResult);
					$tempPostResult['reactions_ids']          = $ReactionIds;
					$tempPostResult['total_comments']         = count($postCommentCounter);
					array_push($AllPosts,$tempPostResult);
				}
			}
			
			$recordCount = count($AllPosts);
			
			$per_page = $recordPerPage;
			$pages = ceil($recordCount / $per_page);
					
			$page = max($record, 1); 
			$page = min($page, $pages); 
			$offset = ($page - 1) * $recordPerPage;
			if( $offset < 0 ) $offset = 0;		
			
			$paginated_orders = array();
			if (count($AllPosts)) {
				$paginated_orders = array_slice($AllPosts, $offset, $per_page, true);
			}
			
			$searchData = array();
			foreach($paginated_orders as $paginated_orders){
				array_push($searchData,$paginated_orders);
			}
			
			if(!empty($searchData)){	
				foreach($searchData as $searchedData){
					$searchHtml .= '
					<div class="post-row-wrap">
                        <div class="user-top">
                            <div class="user-top-left">
                                <div class="user-img childDivTrigger" style="cursor:pointer;" data-userProfileUrl="'.base_url('sp/'.$searchedData['username']).'">
                                    <figure>
                                        <img src="'.$searchedData['profile_picture'].'" alt="Image"/>
                                    </figure>
                                </div>
                                <div class="user-name-wrap">
                                    <h3 style="cursor:pointer;" class="childDivTrigger" data-userProfileUrl="'.base_url('sp/'.$searchedData['username']).'">'.$searchedData['fullname'].'</h3>
                                    <div class="badgeList">
                                        <ul>
                                            <li class="badge badge1">
                                                <a href="">'.$searchedData['UniversityName'].'</a>
                                            </li>
                                            <li class="badge badge3">
                                                <a href="">
                                                    Faculty
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="user-top-right">
                                <div class="timeline-action">
                                    <span class="timeline">'.$searchedData['posted_date'].'</span>
                                    &nbsp;&nbsp;&nbsp;
									<div class="dropdown">
										<i class="dropdown-toggle" data-toggle="dropdown">
											<img src="'.base_url().'assets_d/images/more.svg" alt="Image"/>
										</i>
										<ul class="dropdown-menu" style="right: 0;left: auto;top: 0px;">
											<li class="removePeerSugg">
												<a href="javascript:;" class="reportThings" data-reportType="POSTS" data-currentPage="searchViewAll" data-primaryId="'.$searchedData['post_id'].'">Report</a>
											</li>
										</ul>
									</div>
                                </div>
                            </div>
                        </div>  
                        <div class="content-info-area">
                            <div class="content-img clearfix">';
								if($searchedData['post_image'] != ''){
									$searchHtml .= '
									<figure>
										<img src="'.$searchedData['post_image'].'" alt="Image"/>
									</figure>';
								} else if($searchedData['post_video'] != ''){
									$searchHtml .= '
									<figure>
										<video width="320" height="240" controls>
											<source src="'.$searchedData['post_video'].'" type="video/mp4">
										</video>
									</figure>';
								}
                                $searchHtml .= '
								<p>'.$searchedData['post_content_html'].'</p>
                            </div>
                        </div>
                        <div class="like-comment-wrap">
                            <div class="like-wrap">
                                <ul>';
									if(!empty($searchedData['reactions_ids'])){
										foreach($searchedData['reactions_ids'] as $reactions_id){
											if($reactions_id == 1) {
												$searchHtml .= '<li><a href="javascript:;"><img src="'.base_url().'assets_d/images/like-dashboard.svg" alt="Like"></a></li>';
											} else if($reactions_id == 2) {
												$searchHtml .= '<li><a href="javascript:;"><img src="'.base_url().'assets_d/images/support-dashboard.svg" alt="Icon"/></a></li>';
											} else if($reactions_id == 3) {
												$searchHtml .= '<li><a href="javascript:;"><img src="'.base_url().'assets_d/images/celebrate-dashboard.svg" alt="Icon"></a></li>';
											} else if($reactions_id == 4) {
												$searchHtml .= '<li><a href="javascript:;"><img src="'.base_url().'assets_d/images/curious-dashboard.svg" alt="Icon"></a></li>';
											} else if($reactions_id == 5) {
												$searchHtml .= '<li><a href="javascript:;"><img src="'.base_url().'assets_d/images/insight-dashboard.svg" alt="Icon"></a></li>';
											} else if($reactions_id == 6) {
												$searchHtml .= '<li><a href="javascript:;"><img src="'.base_url().'assets_d/images/love-dashboard.svg" alt="Icon"></a></li>';
											}
										}
									}
                                    $searchHtml .= '<li><a href="">'.$searchedData['total_reactions'].'</a></li>
                                </ul>
                            </div>
                            <div class="comment-wrap">
                                <ul>
                                    <li><a href=""><img src="'.base_url().'assets_d/images/comment-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">'.$searchedData['total_comments'].'</a></li>
									<li>&nbsp;</li>
									<li>
										<div class="action">
											<div class="action_button">
												<a href="'.base_url('account/searchDetail/posts/'.base64_encode($searchedData['post_id'])).'">
													<svg class="sp-icon sp-icon--rotate-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490"><path d="M481.3,110.1c-11.6-11.6-30.4-11.6-42.1,0L245,304.4L50.8,110.2c-11.6-11.6-30.4-11.6-42.1,0c-11.6,11.6-11.6,30.4,0,42.1l236.4,236.4l236.2-236.4C492.9,140.6,492.9,121.7,481.3,110.1z"></path>
													</svg>
												</a>
											</div>
										</div>
									</li>
                                </ul>
                            </div>
                        </div>
                    </div>';
				}
			}
			
		} else if($searchType == 'questions') {
			$searchThing = 'Questions';
			
			$AllQuestions = array();
			
			// get result from questions
			// get reported questions
			$reportedQuestions = array();
			$reportedQuestionString = '';
			
			$getReportedQuestion = "SELECT question_id FROM report_questions WHERE user_id='".$CurrentUserID."'";
			$ReportedQuestionResult = $this->db->query($getReportedQuestion)->result_array();
			if(!empty($ReportedQuestionResult)){
				foreach($ReportedQuestionResult as $ReportedQuestionResultData){
					$reportedQuestions[] = $ReportedQuestionResultData['question_id'];
				}
			}
			
			if(!empty($reportedQuestions)){
				$reportedQuestionString = implode(",",$reportedQuestions);
			}
			
			$SearchQuestions = "SELECT reference_master.reference_id,reference_master.reference,reference_master.addDate,question_master.id,question_master.question_title,question_master.vote_count,question_master.textarea,question_master.view_count,user.id as user_id,user.username,user.first_name,user.last_name,user.image,user_info.gender FROM reference_master LEFT JOIN question_master ON (question_master.id = reference_master.reference_id) LEFT JOIN question_answer_master ON (question_answer_master.question_id = question_master.id AND question_answer_master.question_id = reference_master.reference_id) LEFT JOIN user ON (user.id = reference_master.user_id) LEFT JOIN user_info ON (user_info.userID = user.id) WHERE 1=1 AND reference_master.status = '1' AND question_master.status='1' AND reference_master.reference='question' AND (question_master.question_title LIKE '%$SearchText%' OR question_master.textarea LIKE '%$SearchText%' OR question_answer_master.answer LIKE '%$SearchText%') ";
			
			if($reportedQuestionString != ''){
				$SearchQuestions .= " AND question_master.id NOT IN (".$reportedQuestionString.")";
			}
			
			$SearchQuestions .= " GROUP BY question_master.id ORDER BY reference_master.addDate DESC"; 
			
			$SearchQuestionsResult = $this->db->query($SearchQuestions)->result_array();
			$FoundQuestionResult = count($SearchQuestionsResult);
			
			if(!empty($SearchQuestionsResult)){
				if(!empty($SearchQuestionsResult)){
					foreach($SearchQuestionsResult as $SearchQuestionsResultData){
						$addDate = ($SearchQuestionsResultData['addDate']) ? date("Y-m-d H:i:s",strtotime($SearchQuestionsResultData['addDate'])) : '';
						$timeAgo = $this->timestring($addDate);
						
						$question_id = ($SearchQuestionsResultData['id']) ? $SearchQuestionsResultData['id'] : 0;
						
						if($SearchQuestionsResultData['gender'] == 'female'){
							$UserProfile = base_url('uploads/user-female.png');
						} else if($SearchQuestionsResultData['gender'] == 'male') {
							$UserProfile = base_url('uploads/user-male.png');
						} else if($SearchQuestionsResultData['gender'] == 'other') {
							$UserProfile = base_url('uploads/user-anonymous.png');
						} else {
							$UserProfile = base_url().'assets_d/images/user.jpg';
						}
					
						if($SearchQuestionsResultData['image'] != '' && file_exists('uploads/users/'.$SearchQuestionsResultData['image'])){
							$UserProfile = base_url('uploads/users/'.$SearchQuestionsResultData['image']);
						}
						
						// get university name
						$getUniversityName = "SELECT user_info.intitutionID,university.SchoolName FROM user_info LEFT JOIN university ON (university.university_id = user_info.intitutionID) WHERE 1=1 AND user_info.userID = '".$SearchQuestionsResultData['user_id']."'";
						$UniversityResult = $this->db->query($getUniversityName)->result_array();
						
						$UniversityName = 'N/A';
						if(!empty($UniversityResult)){
							$UniversityName = ($UniversityResult[0]['SchoolName']) ? $UniversityResult[0]['SchoolName'] : 'N/A';
						}
						
						// get total answer on question counter 
						$getTotalAnswersCounter = "SELECT id FROM question_answer_master WHERE question_id='".$question_id."' AND status='1'";
						$AnswerCounterResult = $this->db->query($getTotalAnswersCounter)->result_array();
						
						$tempQuestion['question_id']          = $question_id;
						$tempQuestion['reference_id']         = $SearchQuestionsResultData['reference_id'];
						$tempQuestion['question_title']       = $SearchQuestionsResultData['question_title'];
						$tempQuestion['question_description'] = $SearchQuestionsResultData['textarea'];
						$tempQuestion['post_at']              = $timeAgo;
						$tempQuestion['user_id']              = ($SearchQuestionsResultData['user_id']) ? $SearchQuestionsResultData['user_id'] : 0;
						$tempQuestion['username']             = ($SearchQuestionsResultData['username']) ? $SearchQuestionsResultData['username'] : '';
						$tempQuestion['fullname']             = $SearchQuestionsResultData['first_name'].' '.$SearchQuestionsResultData['last_name'];
						$tempQuestion['profile_picture']      = $UserProfile;
						$tempQuestion['UniversityName']       = $UniversityName;
						$tempQuestion['view_count']           = $SearchQuestionsResultData['view_count'];
						$tempQuestion['answer_count']         = count($AnswerCounterResult);
						$tempQuestion['vote_count']           = $SearchQuestionsResultData['vote_count'];
						array_push($AllQuestions,$tempQuestion);
					}
				}
			}
			
			$recordCount = count($AllQuestions);
			
			$per_page = $recordPerPage;
			$pages = ceil($recordCount / $per_page);
					
			$page = max($record, 1); 
			$page = min($page, $pages); 
			$offset = ($page - 1) * $recordPerPage;
			if( $offset < 0 ) $offset = 0;	
			
			$paginated_orders = array();
			if (count($AllQuestions)) {
				$paginated_orders = array_slice($AllQuestions, $offset, $per_page, true);
			}
			
			$searchData = array();
			foreach($paginated_orders as $paginated_orders){
				array_push($searchData,$paginated_orders);
			}
			
			if(!empty($searchData)){	
				foreach($searchData as $searchedData){
					$searchHtml .= '
					<div class="post-row-wrap">
                        <div class="user-top">
                            <div class="user-top-left">
                                <div class="user-img childDivTrigger" style="cursor:pointer;" data-userProfileUrl="'.base_url('sp/'.$searchedData['username']).'">
                                    <figure>
                                        <img src="'.$searchedData['profile_picture'].'" alt="Image"/>
                                    </figure>
                                </div>
                                <div class="user-name-wrap">
                                    <h3 style="cursor:pointer;" class="childDivTrigger" data-userProfileUrl="'.base_url('sp/'.$searchedData['username']).'">'.$searchedData['username'].'</h3>
                                    <div class="badgeList">
                                        <ul>
                                            <li class="badge badge1">
                                                <a href="">'.$searchedData['UniversityName'].'</a>
                                            </li>
                                            <li class="badge badge3">
                                                <a href="">
                                                    Faculty
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="user-top-right">
                                <div class="timeline-action">
                                    <span class="timeline">'.$searchedData['post_at'].'</span>
                                    &nbsp;&nbsp;&nbsp;
									<div class="dropdown">
										<i class="dropdown-toggle" data-toggle="dropdown">
											<img src="'.base_url().'assets_d/images/more.svg" alt="Image"/>
										</i>
										<ul class="dropdown-menu" style="right: 0;left: auto;top: 0px;">
											<li class="removePeerSugg">
												<a href="javascript:;" class="reportThings" data-reportType="QUESTIONS" data-currentPage="searchViewAll" data-primaryId="'.$searchedData['question_id'].'">Report</a>
											</li>
										</ul>
									</div>
                                </div>
                            </div>
                        </div>  
                        <div class="content-info-area">
							 <b>'.$searchedData['question_title'].'</b>
                            <p>'.$searchedData['question_description'].'</p>
                        </div>
                        <div class="like-comment-wrap">
                            <div class="like-wrap">
                                <ul>
                                    <li>
										<svg xmlns="http://www.w3.org/2000/svg"  class="activeState" width="18.363" height="20" viewBox="0 0 18.363 20">
											<g id="prefix__up-arrow" transform="translate(-31.008 -10.925)">
												<path id="prefix__Path_1209" d="M37.272 29.256h5.6v-9.1a.83.83 0 0 1 .828-.833h2.828l-6.358-6.387-6.35 6.383h2.62a.83.83 0 0 1 .828.833v9.1zm6.428 1.669h-7.26a.83.83 0 0 1-.828-.833v-9.1H31.82a.844.844 0 0 1-.588-1.424l8.358-8.4a.845.845 0 0 1 1.171 0l8.354 8.4a.823.823 0 0 1-.588 1.424h-4v9.1a.825.825 0 0 1-.827.833z" data-name="Path 1209" />
											</g>
										</svg>
									</li>
										<a href="javascript:;">'.$searchedData['vote_count'].'</a>
                                    <li>
									</li>
                                    <li>
										<svg xmlns="http://www.w3.org/2000/svg"  class="activeState" width="18.363" height="20" viewBox="0 0 18.363 20">
											<g id="prefix__Layer_1" transform="rotate(180 24.686 15.463)">
												<g id="prefix__Group_1371" data-name="Group 1371" transform="translate(31.008 10.925)">
													<path id="prefix__Path_1213" d="M43.7 30.925h-7.26a.83.83 0 0 1-.828-.833v-9.1H31.82a.844.844 0 0 1-.588-1.424l8.358-8.4a.845.845 0 0 1 1.171 0l8.354 8.4a.823.823 0 0 1-.588 1.424h-4v9.1a.825.825 0 0 1-.828.833z" data-name="Path 1213" transform="translate(-31.008 -10.925)" />
												</g>
											</g>
										</svg>
									</li>
                                </ul>
                            </div>
                            <div class="comment-wrap">
                                <ul>
                                    <li><a href=""><img src="'.base_url().'assets_d/images/views.svg" alt="Icon"/></a></li>
                                    <li><a href="">'.$searchedData['view_count'].'</a></li>
                                    <li><a href=""><img src="'.base_url().'assets_d/images/answer.svg" alt="Icon"/></a></li>
                                    <li><a href="">'.$searchedData['answer_count'].'</a></li>
									<li>&nbsp;</li>
									<li>
										<div class="action">
											<div class="action_button">
												<a href="'.base_url('account/questionDetail/'.base64_encode($searchedData['reference_id']).'/search').'">
													<svg class="sp-icon sp-icon--rotate-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490"><path d="M481.3,110.1c-11.6-11.6-30.4-11.6-42.1,0L245,304.4L50.8,110.2c-11.6-11.6-30.4-11.6-42.1,0c-11.6,11.6-11.6,30.4,0,42.1l236.4,236.4l236.2-236.4C492.9,140.6,492.9,121.7,481.3,110.1z"></path>
													</svg>
												</a>
											</div>
										</div>
									</li>
                                </ul>
                            </div>
                        </div>
                    </div>
					';
				}
			}
			
		} else if($searchType == 'documents') {
			$searchThing = 'Documents';
			
			$AllDocuments = array();
			
			// get result from documents
			// get reported questions
			$reportedDocuments = array();
			$reportedDocumentString = '';
			
			$getReportedDocument = "SELECT document_id FROM report_documents WHERE user_id='".$CurrentUserID."'";
			$ReportedDocumentResult = $this->db->query($getReportedDocument)->result_array();
			if(!empty($ReportedDocumentResult)){
				foreach($ReportedDocumentResult as $ReportedDocumentResultData){
					$reportedDocuments[] = $ReportedDocumentResultData['document_id'];
				}
			}
			
			if(!empty($reportedDocuments)){
				$reportedDocumentString = implode(",",$reportedDocuments);
			}
			
			$SearchDocuments = "SELECT reference_master.reference_id,reference_master.reference,reference_master.addDate,document_master.id,document_master.document_name,document_master.description,document_master.description,document_master.featured_image,user.id as user_id,user.username,user.first_name,user.last_name,user.image,user_info.gender FROM reference_master LEFT JOIN document_master ON (document_master.id = reference_master.reference_id) LEFT JOIN user ON (user.id = reference_master.user_id) LEFT JOIN user_info ON (user_info.userID = user.id) WHERE 1=1 AND reference_master.status = '1' AND document_master.status='1' AND reference_master.reference='document' AND document_master.privacy = '1' AND (document_master.document_name LIKE '%$SearchText%' OR document_master.description LIKE '%$SearchText%') ";
			
			if($reportedDocumentString != ''){
				$SearchDocuments .= " AND document_master.id NOT IN(".$reportedDocumentString.")";
			}
			
			$SearchDocuments .= " ORDER BY reference_master.addDate DESC";
			
			$SearchDocumentResult = $this->db->query($SearchDocuments)->result_array();
			
			$FoundDocumentResult = count($SearchDocumentResult);
			
			if(!empty($SearchDocumentResult))
			{	
				foreach($SearchDocumentResult as $SearchDocumentResultData)
				{
					$addDate = ($SearchDocumentResultData['addDate']) ? date("Y-m-d H:i:s",strtotime($SearchDocumentResultData['addDate'])) : '';
					$timeAgo = $this->timestring($addDate);
					
					$document_id = $SearchDocumentResultData['id'];
					
					// get user profile picture
					if($SearchDocumentResultData['gender'] == 'female'){
						$UserProfile = base_url('uploads/user-female.png');
					} else if($SearchDocumentResultData['gender'] == 'male') {
						$UserProfile = base_url('uploads/user-male.png');
					} else if($SearchDocumentResultData['gender'] == 'other') {
						$UserProfile = base_url('uploads/user-anonymous.png');
					} else {
						$UserProfile = base_url().'assets_d/images/user.jpg';
					}
						
					if($SearchDocumentResultData['image'] != '' && file_exists('uploads/users/'.$SearchDocumentResultData['image'])){
						$UserProfile = base_url('uploads/users/'.$SearchDocumentResultData['image']);
					}
					
					// get university name
					$getUniversityName = "SELECT user_info.intitutionID,university.SchoolName FROM user_info LEFT JOIN university ON (university.university_id = user_info.intitutionID) WHERE 1=1 AND user_info.userID = '".$SearchDocumentResultData['user_id']."'";
					$UniversityResult = $this->db->query($getUniversityName)->result_array();
					
					$UniversityName = 'N/A';
					if(!empty($UniversityResult)){
						$UniversityName = ($UniversityResult[0]['SchoolName']) ? $UniversityResult[0]['SchoolName'] : 'N/A';
					}
					
					$DocumentLink = '';
					if($SearchDocumentResultData['featured_image'] != '' && file_exists('uploads/users/'.$SearchDocumentResultData['featured_image'])){
						$DocumentLink = base_url('uploads/users/'.$SearchDocumentResultData['featured_image']);
					}
					
					// get total number of reactions and unique reaction id
					$getReactionMaster = "SELECT reaction_id FROM reaction_master WHERE reference_id='".$document_id."' AND reference='document'";
					$ReactionResult    = $this->db->query($getReactionMaster)->result_array();
					
					$getUniqueReactionsID = "SELECT reaction_id FROM reaction_master WHERE reference_id='".$document_id."' AND reference='document' GROUP BY reaction_id";
					$UniqueReactionResult = $this->db->query($getUniqueReactionsID)->result_array();
					
					$ReactionIds = array();
					if(!empty($UniqueReactionResult)){
						foreach($UniqueReactionResult as $UniqueReactionResultData){
							$ReactionIds[] = $UniqueReactionResultData['reaction_id'];
						}
					}
					
					// get total active comments counter in posts
					$getDocumentCommentCounter = "SELECT id FROM comment_master WHERE reference_id='".$document_id."' AND reference='document' AND status='1'";
					$docCommentCounter    = $this->db->query($getDocumentCommentCounter)->result_array();
					
					$getAvgRating   = "SELECT AVG(rating) as average FROM document_rating_master WHERE document_id='".$document_id."'";
					$averageRatings = $this->db->query($getAvgRating)->result_array();
					
					$avgRatings = 0;
					if(!empty($averageRatings)){
						$avgRatings = round($averageRatings[0]['average'], 1);
					}
					
					$tempDocuments['document_id']    =  $document_id;
					$tempDocuments['reference_id']    = ($SearchDocumentResultData['reference_id']) ? $SearchDocumentResultData['reference_id'] : 0;
					$tempDocuments['document_name']   = $SearchDocumentResultData['document_name'];
					$tempDocuments['description']     = $SearchDocumentResultData['description'];
					$tempDocuments['post_at']         = $timeAgo;
					$tempDocuments['user_id']         = ($SearchDocumentResultData['user_id']) ? $SearchDocumentResultData['user_id'] : 0;
					$tempDocuments['username']        = ($SearchDocumentResultData['username']) ? $SearchDocumentResultData['username'] : '';
					$tempDocuments['fullname']        = $SearchDocumentResultData['first_name'].' '.$SearchDocumentResultData['last_name'];
					$tempDocuments['profile_picture'] = $UserProfile;
					$tempDocuments['document_link']   = $DocumentLink;
					$tempDocuments['document_file']   = ($SearchDocumentResultData['featured_image']) ? $SearchDocumentResultData['featured_image'] : '';
					$tempDocuments['UniversityName']  = $UniversityName;
					$tempDocuments['total_reactions'] = count($ReactionResult);
					$tempDocuments['reactions_ids']   = $ReactionIds;
					$tempDocuments['total_comments']  = count($docCommentCounter);
					$tempDocuments['avgRatings']      = $avgRatings;
					array_push($AllDocuments,$tempDocuments);
				}
			}
			
			$recordCount = count($AllDocuments);
			
			$per_page = $recordPerPage;
			$pages = ceil($recordCount / $per_page);
					
			$page = max($record, 1); 
			$page = min($page, $pages); 
			$offset = ($page - 1) * $recordPerPage;
			if( $offset < 0 ) $offset = 0;	
			
			$paginated_orders = array();
			if (count($AllDocuments)) {
				$paginated_orders = array_slice($AllDocuments, $offset, $per_page, true);
			}
			
			$searchData = array();
			foreach($paginated_orders as $paginated_orders){
				array_push($searchData,$paginated_orders);
			}
			
			if(!empty($searchData)){	
				foreach($searchData as $searchedData){
					$searchHtml .= '
					<div class="post-row-wrap">
                        <div class="user-top">
                            <div class="user-top-left">
                                <div class="user-img childDivTrigger" style="cursor:pointer;" data-userProfileUrl="'.base_url('sp/'.$searchedData['username']).'">
                                    <figure>
                                        <img src="'.$searchedData['profile_picture'].'" alt="Image"/>
                                    </figure>
                                </div>
                                <div class="user-name-wrap">
                                    <h3 style="cursor:pointer;" class="childDivTrigger" data-userProfileUrl="'.base_url('sp/'.$searchedData['username']).'">'.$searchedData['fullname'].'</h3>
                                    <div class="badgeList">
                                        <ul>
                                            <li class="badge badge1">
                                                <a href="">'.$searchedData['UniversityName'].'</a>
                                            </li>
                                            <li class="badge badge3">
                                                <a href="">
                                                    Faculty
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="user-top-right">
                                <div class="timeline-action">
                                    <span class="timeline">'.$searchedData['post_at'].'</span>
                                    &nbsp;&nbsp;&nbsp;
									<div class="dropdown">
										<i class="dropdown-toggle" data-toggle="dropdown">
											<img src="'.base_url().'assets_d/images/more.svg" alt="Image"/>
										</i>
										<ul class="dropdown-menu" style="right: 0;left: auto;top: 0px;">
											<li class="removePeerSugg">
												<a href="javascript:;" class="reportThings" data-reportType="DOCUMENTS" data-currentPage="searchViewAll" data-primaryId="'.$searchedData['document_id'].'">Report</a>
											</li>
										</ul>
									</div>
                                </div>
                            </div>
                        </div>  
                        <div class="content-info-area">
							<b>'.$searchedData['document_name'].'</b>
                            <p>'.$searchedData['description'].'</p>
                            <div class="documentName">';
								
									if($searchedData['document_file'] != ''){
										$ExplodedFileName = explode(".",$searchedData['document_file']);
										
										if(strtolower($ExplodedFileName[1]) == 'pdf'){	
											$searchHtml .= '<img src="'.base_url().'/assets_d/images/application_pdf.svg" alt="pdf">'; 
										} else if(strtolower($ExplodedFileName[1]) == 'docx') {
											$searchHtml .= '<img src="'.base_url().'/assets_d/images/application_vnd.openxmlformats-officedocument.wordprocessingml.document.svg" style="width: 30px;" alt="doc">'; 
										} else if(strtolower($ExplodedFileName[1]) == 'doc') {
											$searchHtml .= '<img src="'.base_url().'/assets_d/images/application_vnd.openxmlformats-officedocument.wordprocessingml.document.svg" style="width: 30px;" alt="doc">'; 
										} else if(strtolower($ExplodedFileName[1]) == 'png') {									
											$searchHtml .= '<img src="'.base_url().'/assets_d/images/file.svg" alt="pdf">'; 
										} else if(strtolower($ExplodedFileName[1]) == 'xls') {
											$searchHtml .= '<img src="'.base_url().'/assets_d/images/xlsx@2x.png" style="width: 30px;" alt="text">'; 
										} else if(strtolower($ExplodedFileName[1]) == 'csv') {
											$searchHtml .= '<img src="'.base_url().'/assets_d/images/file.svg" alt="csv">'; 
										} else if(strtolower($ExplodedFileName[1]) == 'txt') {
											$searchHtml .= '<img src="'.base_url().'/assets_d/images/txt@2x.png" style="width: 30px;" alt="text">'; 
										} else if(strtolower($ExplodedFileName[1]) == 'pptx') {
											$searchHtml .= '<img src="'.base_url().'/assets_d/images/pptx@2x.png" style="width: 30px;" alt="pptx">'; 
										}
										$searchHtml .= '<a href="'.$searchedData['document_link'].'" download>'.$searchedData['document_file'].'</a>';
									}
                            $searchHtml .= '
							</div>
                        </div>
                        <div class="like-comment-wrap">
                            <div class="like-wrap">
                                <ul>';
									
									if(!empty($searchedData['reactions_ids'])){
										foreach($searchedData['reactions_ids'] as $reactions_id){
											if($reactions_id == 1) {
												$searchHtml .= '<li><a href="javascript:;"><img src="'.base_url().'assets_d/images/like-dashboard.svg" alt="Like"></a></li>';
											} else if($reactions_id == 2) {
												$searchHtml .= '<li><a href="javascript:;"><img src="'.base_url().'assets_d/images/support-dashboard.svg" alt="Icon"/></a></li>';
											} else if($reactions_id == 3) {
												$searchHtml .= '<li><a href="javascript:;"><img src="'.base_url().'assets_d/images/celebrate-dashboard.svg" alt="Icon"></a></li>';
											} else if($reactions_id == 4) {
												$searchHtml .= '<li><a href="javascript:;"><img src="'.base_url().'assets_d/images/curious-dashboard.svg" alt="Icon"></a></li>';
											} else if($reactions_id == 5) {
												$searchHtml .= '<li><a href="javascript:;"><img src="'.base_url().'assets_d/images/insight-dashboard.svg" alt="Icon"></a></li>';
											} else if($reactions_id == 6) {
												$searchHtml .= '<li><a href="javascript:;"><img src="'.base_url().'assets_d/images/love-dashboard.svg" alt="Icon"></a></li>';
											}
										}
									}
									
									if(!empty($searchedData['reactions_ids'])){
										$searchHtml .= '<li><a href="javascript:;">'.$searchedData['total_reactions'].'</a></li>';
									} else {
										$searchHtml .= '<li><a href="javascript:;">&nbsp;&nbsp;</a></li>	
														<li><a href="javascript:;">&nbsp;&nbsp;</a></li>';
									}
									
                                $searchHtml .= '
								</ul>
                            </div>
                            <div class="star-rating">
                                <ul>';
								for($i = 1;$i <= $searchedData['avgRatings'];$i++){									
									$searchHtml .= '<li>
										<a><img src="'.base_url().'assets_d/images/Star.png" alt="Image"/></a>
									</li>';
								}
                                $searchHtml .= '
								</ul>
                            </div>
                            <div class="comment-wrap">
                                <ul>
                                    <li><a href=""><img src="'.base_url().'assets_d/images/comment-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">'.$searchedData['total_comments'].'</a></li>
									<li>&nbsp;</li>
									<li>
										<div class="action">
											<div class="action_button">
												<a href="'.base_url('account/documentDetail/'.base64_encode($searchedData['reference_id']).'/search').'">
													<svg class="sp-icon sp-icon--rotate-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490"><path d="M481.3,110.1c-11.6-11.6-30.4-11.6-42.1,0L245,304.4L50.8,110.2c-11.6-11.6-30.4-11.6-42.1,0c-11.6,11.6-11.6,30.4,0,42.1l236.4,236.4l236.2-236.4C492.9,140.6,492.9,121.7,481.3,110.1z"></path>
													</svg>
												</a>
											</div>
										</div>
									</li>
                                </ul>
                            </div>
                        </div>
                    </div>';
				}
			}
			
		} else if($searchType == 'studysets') {
			$searchThing = 'Study Sets';
			
			$AllStudySets = array();
			
			//get search result from study set
			// get reported questions
			$reportedStudyset = array();
			$reportedStudysetString = '';
			
			$getReportedStudyset = "SELECT study_set_id FROM reported WHERE user_id='".$CurrentUserID."'";
			$ReportedStudysetResult = $this->db->query($getReportedStudyset)->result_array();
			if(!empty($ReportedStudysetResult)){
				foreach($ReportedStudysetResult as $ReportedStudysetResultData){
					$reportedStudyset[] = $ReportedStudysetResultData['study_set_id'];
				}
			}
			
			if(!empty($reportedStudyset)){
				$reportedStudysetString = implode(",",$reportedStudyset);
			}
			
			$SearchStudySet = "SELECT reference_master.reference_id,reference_master.reference,reference_master.addDate,user.id as user_id,user.username,user.first_name,user.last_name,user.image as pp,study_sets.study_set_id,study_sets.name,study_sets.image,user_info.gender FROM reference_master LEFT JOIN study_sets ON (study_sets.study_set_id = reference_master.reference_id) LEFT JOIN study_set_terms ON (study_set_terms.study_set_id = study_sets.study_set_id AND study_set_terms.study_set_id = reference_master.reference_id) LEFT JOIN user ON (user.id = reference_master.user_id) LEFT JOIN user_info ON (user_info.userID = user.id) WHERE 1=1 AND reference_master.status = '1' AND study_sets.status='1' AND reference_master.reference='studyset' AND study_sets.privacy = '1' AND (study_sets.name LIKE '%$SearchText%' OR study_set_terms.term_description LIKE '%$SearchText%') ";
			
			if($reportedStudysetString != ''){
				$SearchStudySet .= " AND study_sets.study_set_id NOT IN (".$reportedStudysetString.")";
			}
			
			$SearchStudySet .= " GROUP BY study_sets.study_set_id ORDER BY reference_master.addDate DESC";
			
			$SearchStudySetResult = $this->db->query($SearchStudySet)->result_array();
			
			$FoundStudySetResult = count($SearchStudySetResult);
			
			if(!empty($SearchStudySetResult)){
				foreach($SearchStudySetResult as $SearchStudySetData)
				{
					$addDate = ($SearchStudySetData['addDate']) ? date("Y-m-d H:i:s",strtotime($SearchStudySetData['addDate'])) : '';
					$timeAgo = $this->timestring($addDate);
					
					$study_set_id = $SearchStudySetData['study_set_id'];
					
					// get cover page link
					$CoverimageLink = '';
					if($SearchStudySetData['image'] != '' && file_exists('uploads/studyset/'.$SearchStudySetData['image'])){
						$CoverimageLink = base_url('uploads/studyset/'.$SearchStudySetData['image']);
					}
					
					// get user profile picture
					// get user profile picture
					if($SearchStudySetData['gender'] == 'female'){
						$UserProfile = base_url('uploads/user-female.png');
					} else if($SearchStudySetData['gender'] == 'male') {
						$UserProfile = base_url('uploads/user-male.png');
					} else if($SearchStudySetData['gender'] == 'other') {
						$UserProfile = base_url('uploads/user-anonymous.png');
					} else {
						$UserProfile = base_url().'assets_d/images/user.jpg';
					}
					
					if($SearchStudySetData['pp'] != '' && file_exists('uploads/users/'.$SearchStudySetData['pp'])){
						$UserProfile = base_url('uploads/users/'.$SearchStudySetData['pp']);
					}
					
					// get university name
					$getUniversityName = "SELECT user_info.intitutionID,university.SchoolName FROM user_info LEFT JOIN university ON (university.university_id = user_info.intitutionID) WHERE 1=1 AND user_info.userID = '".$SearchStudySetData['user_id']."'";
					$UniversityResult = $this->db->query($getUniversityName)->result_array();
					
					$UniversityName = 'N/A';
					if(!empty($UniversityResult)){
						$UniversityName = ($UniversityResult[0]['SchoolName']) ? $UniversityResult[0]['SchoolName'] : 'N/A';
					}
					
					// get total number of reactions and unique reaction id
					$getReactionMaster = "SELECT reaction_id FROM reaction_master WHERE reference_id='".$study_set_id."' AND reference='studyset'";
					$ReactionResult    = $this->db->query($getReactionMaster)->result_array();
					
					$getUniqueReactionsID = "SELECT reaction_id FROM reaction_master WHERE reference_id='".$study_set_id."' AND reference='studyset' GROUP BY reaction_id";
					$UniqueReactionResult = $this->db->query($getUniqueReactionsID)->result_array();
					
					$ReactionIds = array();
					if(!empty($UniqueReactionResult)){
						foreach($UniqueReactionResult as $UniqueReactionResultData){
							$ReactionIds[] = $UniqueReactionResultData['reaction_id'];
						}
					}
					
					// get total active comments counter in posts
					$getStudysetCommentCounter = "SELECT id FROM comment_master WHERE reference_id='".$study_set_id."' AND reference='studyset' AND status='1'";
					$ssCommentCounter    = $this->db->query($getStudysetCommentCounter)->result_array();
					
					$getAvgRating   = "SELECT AVG(rating) as average FROM studyset_rating_master WHERE study_set_id='".$study_set_id."'";
					$averageRatings = $this->db->query($getAvgRating)->result_array();
					
					$avgRatings = 0;
					if(!empty($averageRatings)){
						$avgRatings = round($averageRatings[0]['average'], 1);
					}
					
					$tempStudySet['study_set_id']    = $study_set_id;
					$tempStudySet['reference_id']    = ($SearchStudySetData['reference_id']) ? $SearchStudySetData['reference_id'] : 0;
					$tempStudySet['studyset_name']   = $SearchStudySetData['name'];
					$tempStudySet['studyset_cover']  = $CoverimageLink;
					$tempStudySet['studyset_id']     = $SearchStudySetData['study_set_id'];
					$tempStudySet['post_at']         = $timeAgo;
					$tempStudySet['user_id']         = ($SearchStudySetData['user_id']) ? $SearchStudySetData['user_id'] : 0;
					$tempStudySet['username']        = ($SearchStudySetData['username']) ? $SearchStudySetData['username'] : '';
					$tempStudySet['fullname']        = $SearchStudySetData['first_name'].' '.$SearchStudySetData['last_name'];
					$tempStudySet['profile_picture'] = $UserProfile;
					$tempStudySet['UniversityName']  = $UniversityName;
					$tempStudySet['total_reactions'] = count($ReactionResult);
					$tempStudySet['reactions_ids']   = $ReactionIds;
					$tempStudySet['total_comments']  = count($ssCommentCounter);
					$tempStudySet['avgRatings']      = $avgRatings;
					array_push($AllStudySets,$tempStudySet);
				}
			}
			
			$recordCount = count($AllStudySets);
			
			$per_page = $recordPerPage;
			$pages = ceil($recordCount / $per_page);
					
			$page = max($record, 1); 
			$page = min($page, $pages); 
			$offset = ($page - 1) * $recordPerPage;
			if( $offset < 0 ) $offset = 0;
			
			$paginated_orders = array();
			if (count($AllStudySets)) {
				$paginated_orders = array_slice($AllStudySets, $offset, $per_page, true);
			}
			
			$searchData = array();
			foreach($paginated_orders as $paginated_orders){
				array_push($searchData,$paginated_orders);
			}
			
			if(!empty($searchData)){	
				foreach($searchData as $searchedData){
					$searchHtml .= '
					<div class="post-row-wrap">
                        <div class="user-top">
                            <div class="user-top-left">
                                <div class="user-img childDivTrigger" style="cursor:pointer;" data-userProfileUrl="'.base_url('sp/'.$searchedData['username']).'">
                                    <figure>
                                        <img src="'.$searchedData['profile_picture'].'" alt="Image"/>
                                    </figure>
                                </div>
                                <div class="user-name-wrap">
                                    <h3 style="cursor:pointer;" class="childDivTrigger" data-userProfileUrl="'.base_url('sp/'.$searchedData['username']).'">'.$searchedData['fullname'].'</h3>
                                    <div class="badgeList">
                                        <ul>
                                            <li class="badge badge1">
                                                <a href="">'.$searchedData['UniversityName'].'</a>
                                            </li>
                                            <li class="badge badge3">
                                                <a href="">
                                                    Faculty
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="user-top-right">
                                <div class="timeline-action">
                                    <span class="timeline">'.$searchedData['post_at'].'</span>
                                    &nbsp;&nbsp;&nbsp;
									<div class="dropdown">
										<i class="dropdown-toggle" data-toggle="dropdown">
											<img src="'.base_url().'assets_d/images/more.svg" alt="Image"/>
										</i>
										<ul class="dropdown-menu" style="right: 0;left: auto;top: 0px;">
											<li class="removePeerSugg">
												<a href="javascript:;" class="reportThings" data-reportType="STUDYSET" data-currentPage="searchViewAll" data-primaryId="'.$searchedData['study_set_id'].'">Report</a>
											</li>
										</ul>
									</div>
                                </div>
                            </div>
                        </div>  
                        <div class="content-info-area">
                            <div class="content-img clearfix">';
								if($searchedData['studyset_cover'] != ''){
									$searchHtml .= '
									<figure>
										<img src="'.$searchedData['studyset_cover'].'" alt="Image"/>
									</figure>';
								}
                                $searchHtml .= '<p>'.$searchedData['studyset_name'].'</p>
                            </div>
                        </div>
                        <div class="like-comment-wrap">
                            <div class="like-wrap">
								<ul>';
									
									if(!empty($searchedData['reactions_ids'])){
										foreach($searchedData['reactions_ids'] as $reactions_id){
											if($reactions_id == 1) {
												$searchHtml .= '<li><a href="javascript:;"><img src="'.base_url().'assets_d/images/like-dashboard.svg" alt="Like"></a></li>';
											} else if($reactions_id == 2) {
												$searchHtml .= '<li><a href="javascript:;"><img src="'.base_url().'assets_d/images/support-dashboard.svg" alt="Icon"/></a></li>';
											} else if($reactions_id == 3) {
												$searchHtml .= '<li><a href="javascript:;"><img src="'.base_url().'assets_d/images/celebrate-dashboard.svg" alt="Icon"></a></li>';
											} else if($reactions_id == 4) {
												$searchHtml .= '<li><a href="javascript:;"><img src="'.base_url().'assets_d/images/curious-dashboard.svg" alt="Icon"></a></li>';
											} else if($reactions_id == 5) {
												$searchHtml .= '<li><a href="javascript:;"><img src="'.base_url().'assets_d/images/insight-dashboard.svg" alt="Icon"></a></li>';
											} else if($reactions_id == 6) {
												$searchHtml .= '<li><a href="javascript:;"><img src="'.base_url().'assets_d/images/love-dashboard.svg" alt="Icon"></a></li>';
											}
										}
									}
								
									if(!empty($searchedData['reactions_ids'])){
										$searchHtml .= '<li><a href="javascript:;">'.$searchedData['total_reactions'].'</a></li>';
									} else {
										$searchHtml .= '
										<li><a href="javascript:;">&nbsp;&nbsp;</a></li>	
										<li><a href="javascript:;">&nbsp;&nbsp;</a></li>';
									}
								$searchHtml .= '
								</ul>
                            </div>
                            <div class="star-rating">
                                <ul>';
									for($i = 1;$i <= $searchedData['avgRatings'];$i++){									
										$searchHtml .= '
										<li>
											<a><img src="'.base_url().'assets_d/images/Star.png" alt="Image"/></a>
										</li>';
									}									
                                $searchHtml .= '
								</ul>
                            </div>
                            <div class="comment-wrap">
                                <ul>
                                    <li><a href=""><img src="'.base_url().'assets_d/images/comment-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">'.$searchedData['total_comments'].'</a></li>
									<li>&nbsp;</li>
									<li>
										<div class="action">
											<div class="action_button">
												<a href="'.base_url('studyset/details/'.$searchedData['reference_id'].'/search').'">
													<svg class="sp-icon sp-icon--rotate-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490"><path d="M481.3,110.1c-11.6-11.6-30.4-11.6-42.1,0L245,304.4L50.8,110.2c-11.6-11.6-30.4-11.6-42.1,0c-11.6,11.6-11.6,30.4,0,42.1l236.4,236.4l236.2-236.4C492.9,140.6,492.9,121.7,481.3,110.1z"></path>
													</svg>
												</a>
											</div>
										</div>
									</li>
                                </ul>
                            </div>
                        </div>
                    </div>';
				}
			}
			
		} else if($searchType == 'events') {
			$searchThing = 'Events';
			
			$AllEvents = array();
			
			//get search result from events
			// get reported questions
			$reportedEvents = array();
			$reportedEventsString = '';
			
			$getReportedEvents = "SELECT event_id FROM report_event WHERE user_id='".$CurrentUserID."'";
			$ReportedEventsResult = $this->db->query($getReportedEvents)->result_array();
			if(!empty($ReportedEventsResult)){
				foreach($ReportedEventsResult as $ReportedEventsResultData){
					$reportedEvents[] = $ReportedEventsResultData['event_id'];
				}
			}
			
			if(!empty($reportedEvents)){
				$reportedEventsString = implode(",",$reportedEvents);
			}
			
			$SearchEvents = "SELECT reference_master.reference_id,reference_master.reference,reference_master.addDate,user.id as user_id,user.username,user.first_name,user.last_name,user.image as pp,event_master.id,event_master.event_name,event_master.description,event_master.location_txt,event_master.start_date,event_master.start_time,event_master.featured_image,user_info.gender FROM reference_master LEFT JOIN event_master ON (event_master.id = reference_master.reference_id) LEFT JOIN user ON (user.id = reference_master.user_id) LEFT JOIN user_info ON (user_info.userID = user.id) WHERE 1=1 AND reference_master.status = '1' AND event_master.status='1' AND reference_master.reference='event' AND event_master.privacy = '1' AND (event_master.event_name LIKE '%$SearchText%' OR event_master.location_txt LIKE '%$SearchText%' OR event_master.description LIKE '%$SearchText%') ";
			
			if($reportedEventsString != ''){
				$SearchEvents .= " AND event_master.id NOT IN (".$reportedEventsString.")";
			}
			
			$SearchEvents .= " ORDER BY reference_master.addDate DESC";
			
			$SearchEventsResult = $this->db->query($SearchEvents)->result_array();
			
			$FoundEventsResult = count($SearchEventsResult);
			
			if(!empty($SearchEventsResult))
			{
				foreach($SearchEventsResult as $SearchEventsResultData){
					$addDate = ($SearchEventsResultData['addDate']) ? date("Y-m-d H:i:s",strtotime($SearchEventsResultData['addDate'])) : '';
					$timeAgo = $this->timestring($addDate);
					
					$event_primary_id = $SearchEventsResultData['id'];
					
					$tempEvents['event_name'] = ($SearchEventsResultData['event_name']) ? $SearchEventsResultData['event_name'] : '';
					$tempEvents['event_description'] = ($SearchEventsResultData['description']) ? $SearchEventsResultData['description'] : '';
					$tempEvents['event_location'] = ($SearchEventsResultData['location_txt']) ? $SearchEventsResultData['location_txt'] : '';
					
					$start_date = ($SearchEventsResultData['start_date']) ? date("M d,",strtotime($SearchEventsResultData['start_date'])) : '';
					$start_time = ($SearchEventsResultData['start_time']) ? date("h:i A",strtotime($SearchEventsResultData['start_time'])) : '';
					$tempEvents['event_time'] = $start_date.' '.$start_time;
					
					// get featured image
					$FeaturedImage = '';
					if($SearchEventsResultData['featured_image'] != '' && file_exists('uploads/users/'.$SearchEventsResultData['featured_image'])){
						$FeaturedImage = base_url('uploads/users/'.$SearchEventsResultData['featured_image']);
					}
					$tempEvents['featured_image'] = $FeaturedImage;
					
					// get user profile picture
					if($SearchEventsResultData['gender'] == 'female'){
						$UserProfile = base_url('uploads/user-female.png');
					} else if($SearchEventsResultData['gender'] == 'male') {
						$UserProfile = base_url('uploads/user-male.png');
					} else if($SearchEventsResultData['gender'] == 'other') {
						$UserProfile = base_url('uploads/user-anonymous.png');
					} else {
						$UserProfile = base_url().'assets_d/images/user.jpg';
					}
					
					if($SearchEventsResultData['pp'] != '' && file_exists('uploads/users/'.$SearchEventsResultData['pp'])){
						$UserProfile = base_url('uploads/users/'.$SearchEventsResultData['pp']);
					}
					
					// get university name
					$getUniversityName = "SELECT user_info.intitutionID,university.SchoolName FROM user_info LEFT JOIN university ON (university.university_id = user_info.intitutionID) WHERE 1=1 AND user_info.userID = '".$SearchEventsResultData['user_id']."'";
					$UniversityResult = $this->db->query($getUniversityName)->result_array();
					
					$UniversityName = 'N/A';
					if(!empty($UniversityResult)){
						$UniversityName = ($UniversityResult[0]['SchoolName']) ? $UniversityResult[0]['SchoolName'] : 'N/A';
					}
					
					// get total number of reactions and unique reaction id
					$getReactionMaster = "SELECT reaction_id FROM reaction_master WHERE reference_id='".$event_primary_id."' AND reference='event'";
					$ReactionResult    = $this->db->query($getReactionMaster)->result_array();
					
					$getUniqueReactionsID = "SELECT reaction_id FROM reaction_master WHERE reference_id='".$event_primary_id."' AND reference='event' GROUP BY reaction_id";
					$UniqueReactionResult = $this->db->query($getUniqueReactionsID)->result_array();
					
					$ReactionIds = array();
					if(!empty($UniqueReactionResult)){
						foreach($UniqueReactionResult as $UniqueReactionResultData){
							$ReactionIds[] = $UniqueReactionResultData['reaction_id'];
						}
					}
					
					// get total active comments counter in posts
					$getEventsCommentCounter = "SELECT id FROM comment_master WHERE reference_id='".$event_primary_id."' AND reference='event' AND status='1'";
					$EveCommentCounter    = $this->db->query($getEventsCommentCounter)->result_array();
					
					$tempEvents['reference_id']    = ($SearchEventsResultData['reference_id']) ? $SearchEventsResultData['reference_id'] : 0;
					$tempEvents['event_primary_id']= $event_primary_id;
					$tempEvents['post_at']         = $timeAgo;
					$tempEvents['user_id']         = ($SearchEventsResultData['user_id']) ? $SearchEventsResultData['user_id'] : 0;
					$tempEvents['username']        = ($SearchEventsResultData['username']) ? $SearchEventsResultData['username'] : '';
					$tempEvents['fullname']        = $SearchEventsResultData['first_name'].' '.$SearchEventsResultData['last_name'];
					$tempEvents['profile_picture'] = $UserProfile;
					$tempEvents['UniversityName']  = $UniversityName;
					$tempEvents['total_reactions'] = count($ReactionResult);
					$tempEvents['reactions_ids']   = $ReactionIds;
					$tempEvents['total_comments']  = count($EveCommentCounter);
					
					array_push($AllEvents,$tempEvents);
				}
			}
			
			$recordCount = count($AllEvents);
			
			$per_page = $recordPerPage;
			$pages = ceil($recordCount / $per_page);
					
			$page = max($record, 1); 
			$page = min($page, $pages); 
			$offset = ($page - 1) * $recordPerPage;
			if( $offset < 0 ) $offset = 0;
			
			$paginated_orders = array();
			if (count($AllEvents)) {
				$paginated_orders = array_slice($AllEvents, $offset, $per_page, true);
			}
			
			$searchData = array();
			foreach($paginated_orders as $paginated_orders){
				array_push($searchData,$paginated_orders);
			}
			
			if(!empty($searchData)){	
				foreach($searchData as $searchedData){
					$searchHtml .= '
					<div class="post-row-wrap">
                        <div class="user-top">
                            <div class="user-top-left">
                                <div class="user-img childDivTrigger" style="cursor:pointer;" data-userProfileUrl="'.base_url('sp/'.$searchedData['username']).'">
                                    <figure>
                                        <img src="'.$searchedData['profile_picture'].'" alt="Image"/>
                                    </figure>
                                </div>
                                <div class="user-name-wrap">
                                    <h3 style="cursor:pointer;" class="childDivTrigger" data-userProfileUrl="'.base_url('sp/'.$searchedData['username']).'">'.$searchedData['fullname'].'</h3>
                                    <div class="badgeList">
                                        <ul>
                                            <li class="badge badge1">
                                                <a href="javascript:;">'.$searchedData['UniversityName'].'</a>
                                            </li>
                                            <li class="badge badge3">
                                                <a href="">
                                                    Faculty
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="user-top-right">
                                <div class="timeline-action">
                                    <span class="timeline">'.$searchedData['post_at'].'</span>
                                    &nbsp;&nbsp;&nbsp;
									<div class="dropdown">
										<i class="dropdown-toggle" data-toggle="dropdown">
											<img src="'.base_url().'assets_d/images/more.svg" alt="Image"/>
										</i>
										<ul class="dropdown-menu" style="right: 0;left: auto;top: 0px;">
											<li class="removePeerSugg">
												<a href="javascript:;" class="reportThings" data-reportType="EVENTS" data-currentPage="searchViewAll" data-primaryId="'.$searchedData['event_primary_id'].'">Report</a>
											</li>
										</ul>
									</div>
                                </div>
                            </div>
                        </div>  
                        <div class="content-info-area">
                            <div class="content-img clearfix">';
							
									if($searchedData['featured_image'] != ''){
										$searchHtml .= '
										<figure>
											<img src="'.$searchedData['featured_image'].'" alt="Image"/>
										</figure>';
									}
									
                                $searchHtml .= '
								<p>'.$searchedData['event_description'].'</p>
                                <div class="event-description">
                                    <div class="left">
                                        <img src="'.base_url().'assets_d/images/location.svg" alt="Location"> '.$searchedData['event_location'].'
                                    </div>
                                    <div class="right">
                                        <figure>
                                            <img src="'.base_url().'assets_d/images/calendar1.svg" alt="Event Time">
                                        </figure>
                                        <figcaption>'.$searchedData['event_time'].'</figcaption>';
										
											$isEventScheduled = $this->db->get_where('schedule_master', array('event_master_id' => $searchedData['event_primary_id'], 'status' => 1,'created_by' => $CurrentUserID))->row_array();
											
											if(!empty($isEventScheduled)){
												$searchHtml .= '<a href="#" class="removeEvent" data-id="'.$searchedData['event_primary_id'].'" data-toggle="modal" data-target="#removeFromScheduleModal">Remove From Calendar</a>';
											} else {
												$searchHtml .= '<a href="#" class="addEvents" data-id="'.$searchedData['event_primary_id'].'" data-toggle="modal" data-target="#addEventModal">Add to Calendar</a>';
											}
                                    $searchHtml .= '
									</div>
                                </div>
                            </div>
                        </div>
                        <div class="eventActionWrap">
                            <ul>';
								$peerAttending = $this->db->get_where('share_master', array('reference_id' => $searchedData['event_primary_id'], 'reference' => 'event', 'status' => 2))->result_array();
								
								$totalAttendingPeer = 0;
								if(!empty($peerAttending)){
									$totalAttendingPeer = count($peerAttending);
									$i = 0;
									foreach($peerAttending as $peerAttendingData){
										$i++;
										if($i <= 5){
											$searchHtml .= '<li>
												<img src="'.userImage($peerAttendingData['peer_id']).'" alt="user">
											</li>';
										}
									}
								}
								
								if($totalAttendingPeer > 5){								
									$searchHtml .= '<li class="more">+'.($totalAttendingPeer-5).'</li>';
								}
								
                            $searchHtml .= '</ul>';
							
								$this->db->order_by('share_master.id', 'desc');
								$attendEvent = $this->db->get_where('share_master', array('reference_id' => $searchedData['event_primary_id'], 'reference' => 'event', 'peer_id' => $CurrentUserID))->row_array(); 
							
								$aText = (!empty($attendEvent) && $attendEvent['status'] == 2) ? 'Unattend' : 'Attend';
							
							$searchHtml .= '
							<button type="button" class="event_action attendEvent" data-toggle="modal" data-target="#confirmationModalAttend" data-id="'.$searchedData['event_primary_id'].'"> 
								<span class="attend_text_'.$searchedData['event_primary_id'].'" id="attend_text_'.$searchedData['event_primary_id'].'">'.$aText.'</span> Event
							</button>
                        </div>
                        <div class="like-comment-wrap">
                            <div class="like-wrap">
                                <ul>';
                                    
									if(!empty($searchedData['reactions_ids'])){
										foreach($searchedData['reactions_ids'] as $reactions_id){
											if($reactions_id == 1) {
												$searchHtml .= '<li><a href="javascript:;"><img src="'.base_url().'assets_d/images/like-dashboard.svg" alt="Like"></a></li>';
											} else if($reactions_id == 2) {
												$searchHtml .= '<li><a href="javascript:;"><img src="'.base_url().'assets_d/images/support-dashboard.svg" alt="Icon"/></a></li>';
											} else if($reactions_id == 3) {
												$searchHtml .= '<li><a href="javascript:;"><img src="'.base_url().'assets_d/images/celebrate-dashboard.svg" alt="Icon"></a></li>';
											} else if($reactions_id == 4) {
												$searchHtml .= '<li><a href="javascript:;"><img src="'.base_url().'assets_d/images/curious-dashboard.svg" alt="Icon"></a></li>';
											} else if($reactions_id == 5) {
												$searchHtml .= '<li><a href="javascript:;"><img src="'.base_url().'assets_d/images/insight-dashboard.svg" alt="Icon"></a></li>';
											} else if($reactions_id == 6) {
												$searchHtml .= '<li><a href="javascript:;"><img src="'.base_url().'assets_d/images/love-dashboard.svg" alt="Icon"></a></li>';
											}
										}
									}
								
									if(!empty($searchedData['reactions_ids'])){
										$searchHtml .= '<li><a href="javascript:;">'.$searchedData['total_reactions'].'</a></li>';
									} else {
										$searchHtml .= '<li><a href="javascript:;">&nbsp;&nbsp;</a></li>	
														<li><a href="javascript:;">&nbsp;&nbsp;</a></li>';
									}
                                $searchHtml .= '
								</ul>
                            </div>
                            <div class="comment-wrap">
                                <ul>
                                    <li><a href=""><img src="'.base_url().'assets_d/images/comment-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">'.$searchedData['total_comments'].'</a></li>
									<li>&nbsp;</li>
									<li>
										<div class="action">
											<div class="action_button">
												<a href="'.base_url('account/eventDetails/'.base64_encode($searchedData['reference_id']).'/search').'">
													<svg class="sp-icon sp-icon--rotate-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490"><path d="M481.3,110.1c-11.6-11.6-30.4-11.6-42.1,0L245,304.4L50.8,110.2c-11.6-11.6-30.4-11.6-42.1,0c-11.6,11.6-11.6,30.4,0,42.1l236.4,236.4l236.2-236.4C492.9,140.6,492.9,121.7,481.3,110.1z"></path>
													</svg>
												</a>
											</div>
										</div>
									</li>
                                </ul>
                            </div>
                        </div>
                    </div>';
				}
			}
			
		} else if($searchType == 'qa') {
			
		} else if($searchType == 'textbooks') {
			
		} else if($searchType == 'articles') {
			
		} else if($searchType == 'studynotes') {
			
		}
		
		$config['base_url']         = base_url('account/loadData');
		$config['total_rows']       = $recordCount;
		$config['per_page']         = $recordPerPage;
      	$config['use_page_numbers'] = TRUE;
		$this->mypagination->initialize($config);
		
		$totalPage = ceil($recordCount/$recordPerPage);
		
		$current_page = ($record == 0) ? 1 : ($record);
		
		$prev_page = $current_page - 1;
		$next_page = $current_page + 1;
		
		$links = '';
		
		if($prev_page <= $totalPage){
		$links .= '<div class="prev-arrow">
						<a href="'.base_url('account/loadData/').$prev_page.'" data-ci-pagination-page="'.$prev_page.'"><img src="'.base_url('assets_d/images/prev.svg').'" alt="Prev Icon"/></a>
					</div>
					';
		} else {
			$links .= '<div class="prev-arrow">
						<a href="javascript:;" style="pointer-events:none;"><img src="'.base_url('assets_d/images/prev.svg').'" alt="Prev Icon"/></a>
					</div>
					';
		}
					
		$links .= '<ul class="pagination">';		
		for ($i=1; $i <= $totalPage ; $i++) { 
			if($current_page == $i){
				$links .= '<li class="active"><a href="'.base_url('account/loadData/'.$i).'" data-ci-pagination-page="'.$i.'">'.$i.'</a></li>';
			} else {
				$links .= '<li><a href="'.base_url('account/loadData/'.$i).'" data-ci-pagination-page="'.$i.'">'.$i.'</a></li>';	
			}
		}
		$links .= '</ul>';
		
		if($next_page <= $totalPage){
			$links .= '
			   <div class="next-arrow">
					<a href="'.base_url('account/loadData/').$next_page.'" data-ci-pagination-page="'.$next_page.'"><img src="'.base_url('assets_d/images/next.svg').'" alt="Next Icon"/></a>
			   </div>';	
		} else {
			$links .= '
			   <div class="next-arrow">
					<a href="javascript:;" style="pointer-events:none;"><img src="'.base_url('assets_d/images/next.svg').'" alt="Next Icon"/></a>
			   </div>';	
		}
		
		
		if($totalPage <= 1){
			$links = '';
		}
		
		$data['pagination']  = $links;
		$data['searchHtml']  = $searchHtml;
		$data['searchThing'] = $searchThing;
		echo json_encode($data);		
	}
	
    public function searchDetail($detailType = null,$detailId = null,$tabType = null,$openComment = null){
        $data['index_menu']  = 'search';
        $data['title']  = 'Search Detail | Studypeers';
		
		$data['detailType'] = $detailType;
		$data['tabType']    = $tabType;
		$data['openComment']= $openComment;
		
		if($detailType == 'posts') {
			$ID = base64_decode($detailId);
			
			// get single post query
			$SearchPosts = "SELECT reference_master.reference,reference_master.reference_id,reference_master.addDate,posts.id,posts.post_content_html,posts.is_comment_on,posts.created_by,post_documents.original_name,post_poll_options.options,post_images.image_path,post_videos.video_path,user.id as user_id,user.username,user.first_name,user.last_name,user.image,user_info.gender FROM reference_master LEFT JOIN posts ON (posts.id = reference_master.reference_id) LEFT JOIN post_images ON (posts.id = post_images.post_id AND post_images.post_id = reference_master.reference_id) LEFT JOIN post_videos ON (posts.id = post_videos.post_id AND post_videos.post_id = reference_master.reference_id) LEFT JOIN post_documents ON (posts.id = post_documents.post_id AND post_documents.post_id = reference_master.reference_id) LEFT JOIN post_poll_options ON (posts.id = post_poll_options.post_id AND post_poll_options.post_id = reference_master.reference_id) LEFT JOIN user ON (user.id = reference_master.user_id) LEFT JOIN user_info ON (user_info.userID = user.id) WHERE 1=1 AND reference_master.status = '1' AND posts.status='1' AND reference_master.reference='Post' AND posts.id='".$ID."'";
			
			$SearchPosts .= " GROUP BY posts.id ORDER BY reference_master.addDate DESC";
			
			$SearchPostResult = $this->db->query($SearchPosts)->result_array();
			
			if(!empty($SearchPostResult)) {
				$SearchPostResultDat = $SearchPostResult[0];
				
				$post_id = $SearchPostResultDat['id'];
				$addDate = ($SearchPostResultDat['addDate']) ? date("Y-m-d H:i:s",strtotime($SearchPostResultDat['addDate'])) : '';
				$timeAgo = $this->timestring($addDate);
				
				// get user profile picture
				if($SearchPostResultDat['gender'] == 'female'){
					$UserProfile = base_url('uploads/user-female.png');
				} else if($SearchPostResultDat['gender'] == 'male') {
					$UserProfile = base_url('uploads/user-male.png');
				} else if($SearchPostResultDat['gender'] == 'other') {
					$UserProfile = base_url('uploads/user-anonymous.png');
				} else {
					$UserProfile = base_url().'assets_d/images/user.jpg';
				}
				
				if($SearchPostResultDat['image'] != '' && file_exists('uploads/users/'.$SearchPostResultDat['image'])){
					$UserProfile = base_url('uploads/users/'.$SearchPostResultDat['image']);
				}
				
				$PostImage = '';
				if($SearchPostResultDat['image_path'] != ''){
					$PostImage = base_url($SearchPostResultDat['image_path']);
				}
				
				$PostVideo = '';
				if($SearchPostResultDat['video_path'] != '' && file_exists($SearchPostResultDat['video_path'])){
					$PostVideo = base_url($SearchPostResultDat['video_path']);
				}
				
				// get university name
				$getUniversityName = "SELECT user_info.intitutionID,university.SchoolName FROM user_info LEFT JOIN university ON (university.university_id = user_info.intitutionID) WHERE 1=1 AND user_info.userID = '".$SearchPostResultDat['user_id']."'";
				$UniversityResult = $this->db->query($getUniversityName)->result_array();
				
				$UniversityName = 'N/A';
				if(!empty($UniversityResult)){
					$UniversityName = ($UniversityResult[0]['SchoolName']) ? $UniversityResult[0]['SchoolName'] : 'N/A';
				}
				
				// get total number of reactions and unique reaction id
				$getReactionMaster = "SELECT reaction_id FROM reaction_master WHERE reference_id='".$post_id."' AND reference='Post'";
				$ReactionResult    = $this->db->query($getReactionMaster)->result_array();
				
				$getUniqueReactionsID = "SELECT reaction_id FROM reaction_master WHERE reference_id='".$post_id."' AND reference='Post' GROUP BY reaction_id";
				$UniqueReactionResult = $this->db->query($getUniqueReactionsID)->result_array();
				
				$ReactionIds = array();
				if(!empty($UniqueReactionResult)){
					foreach($UniqueReactionResult as $UniqueReactionResultData){
						$ReactionIds[] = $UniqueReactionResultData['reaction_id'];
					}
				}
				
				$CurrentUserID = $this->session->get_userdata()['user_data']['user_id'];
				
				$getCurrentUserReaction = $this->db->get_where('reaction_master', array('user_id' => $CurrentUserID, 'reference_id' => $SearchPostResultDat['reference_id'], 'reference' => 'Post'))->row_array();
				
				// get total active comments counter in posts
				$getPostCommentCounter = "SELECT id FROM comment_master WHERE reference_id='".$post_id."' AND reference='Post' AND status='1'";
				$postCommentCounter    = $this->db->query($getPostCommentCounter)->result_array();
				
				// get post comments
				$getCommentList = $this->db->get_where('comment_master', array('reference_id' => $SearchPostResultDat['reference_id'], 'reference' => 'Post', 'comment_parent_id' => 0, 'status' => 1))->result_array();
				
				$data['reference_id']           = ($SearchPostResultDat['reference_id']) ? $SearchPostResultDat['reference_id'] : '';;
				$data['post_id']                = $post_id;
				$data['post_content_html']      = ($SearchPostResultDat['post_content_html']) ? $SearchPostResultDat['post_content_html'] : '';
				$data['post_image']             = ($PostImage) ? $PostImage : '';
				$data['post_video']             = ($PostVideo) ? $PostVideo : '';
				$data['document_original_name'] = ($SearchPostResultDat['original_name']) ? $SearchPostResultDat['original_name'] : '';
				$data['poll_options']           = ($SearchPostResultDat['options']) ? $SearchPostResultDat['options'] : '';
				$data['user_id']                = ($SearchPostResultDat['user_id']) ? $SearchPostResultDat['user_id'] : 0;
				$data['username']               = ($SearchPostResultDat['username']) ? $SearchPostResultDat['username'] : '';
				$data['fullname']               = $SearchPostResultDat['first_name'].' '.$SearchPostResultDat['last_name'];
				$data['profile_picture']        = $UserProfile;
				$data['posted_date']            = $timeAgo;
				$data['UniversityName']         = $UniversityName;
				$data['total_reactions']        = count($ReactionResult);
				$data['reactions_ids']          = $ReactionIds;
				$data['total_comments']         = count($postCommentCounter);
				$data['getCurrentUserReaction'] = $getCurrentUserReaction;
				$data['is_comment_on']          = ($SearchPostResultDat['is_comment_on']) ? $SearchPostResultDat['is_comment_on'] : '';
				$data['getCommentList']         = $getCommentList;
				$data['created_by']             = ($SearchPostResultDat['created_by']) ? $SearchPostResultDat['created_by'] : '';
				
			} else {
				// redirect if result empty
				redirect(base_url('account/searchResult'));
			}
		} else if($detailType == 'questions') {
			
		} else if($detailType == 'documents') {
			
		} else if($detailType == 'studysets') {
			
		} else if($detailType == 'events') {
			
		} else {
			// redirect if result empty
			redirect(base_url('account/searchResult'));
		}

        $this->load->view('user/include/header', $data);
        $this->load->view('user/search-detail');
        
        $this->load->view('user/include/right-sidebar');
        
        $this->load->view('user/include/firebase-include');
        $this->load->view('user/include/footer-dashboard');
    }

    public function searchNoResult(){
        $data['index_menu']  = 'search';
        $data['title']  = 'Search No Result | Studypeers';

        $this->load->view('user/include/header', $data);
        $this->load->view('user/search-no-result');
        
        $this->load->view('user/include/right-sidebar');
        
        $this->load->view('user/include/firebase-include');
        $this->load->view('user/include/footer-dashboard');
    }

    public function dashboard()
    {
        is_valid_logged_in();

        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $user_info = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();

        $data['peer_suggestion'] = $this->db->query("SELECT `user`.*, `university`.`SchoolName`, `user_info`.`nickname` FROM `user_info` JOIN `university` ON `university`.`university_id`=`user_info`.`intitutionID` JOIN `user` ON `user`.`id`=`user_info`.`userID` WHERE `user_info`.`intitutionID` = '" . $user_info['intitutionID'] . "' AND `user`.`is_verified` = 1 AND `user`.`id` != '" . $user_id . "' AND `user`.`id` NOT IN (SELECT peer_id from friends where user_id = '" . $user_id . "') ORDER BY `user`.`id` DESC ")->result_array();

        $data['peer_requests'] = $this->db->get_where('peer_master', array('peer_id' => $user_id, 'status' => 1))->result_array();

        $peerList = $this->peerListString($user_id);
        if (count($peerList) > 0) {
            $comma_separated = implode(",", $peerList);

            $data['events'] = $this->db->query("select * from event_master where status = 1 and created_by = " . $user_id . " OR event_master.id in (SELECT reference_id from share_master where peer_id = " . $user_id . " and reference = 'event' and status != 4) OR (event_master.created_by in (" . $comma_separated . ") AND status = 1) order by start_date desc limit 5")->result_array();
        } else {
            $data['events'] = [];
        }
        $data['events'] = [];
        $data['studysets'] = [];

        $data['index_menu']  = 'dashboard';
        $data['title']  = 'Dashboard | Studypeers';

        $this->load->view('user/include/header', $data);
        $this->load->view('user/dashboard');
        $this->load->view('user/profile/add-post');
        $this->load->view('user/profile/post-privacy');
        $this->load->view('user/include/right-sidebar');

        $this->load->view('user/include/firebase-include');
        $this->load->view('user/include/footer-dashboard');
    }

    public function getDashboardFeeds()
    {
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
		$CurrentUserID = $user_id;
		
        $offset     = $this->input->post('count');
        $count      = $offset * 10;
        $peerList = $this->peerListStringDashboard($user_id);

		// get reported questions
		$reportedUsers = array();
		$reportedUsersString = '';
		
		$getReportedUsers = "SELECT report_user_id FROM user_report_master WHERE user_id='".$CurrentUserID."' AND status='1'";
		$ReportedUsersResult = $this->db->query($getReportedUsers)->result_array();
		if(!empty($ReportedUsersResult)){
			foreach($ReportedUsersResult as $ReportedUsersResultData){
				$reportedUsers[] = $ReportedUsersResultData['report_user_id'];
			}
		}
		
		$getBlockedUsers = "SELECT peer_id FROM blocked_peers WHERE user_id='".$CurrentUserID."'";
		$BlockedUserResult = $this->db->query($getBlockedUsers)->result_array();
		if(!empty($BlockedUserResult)){
			foreach($BlockedUserResult as $BlockedUserResultData){
				$reportedUsers[] = $BlockedUserResultData['peer_id'];
			}
		}
		
		if(!empty($reportedUsers)){
			$reportedUsersString = implode(",",$reportedUsers);
		}
		
		// get reported posts
		$reportedPosts = array();
		$reportedPostsString = '';
		
		$getReportedPosts = "SELECT post_id FROM report_post WHERE user_id='".$CurrentUserID."'";
		$ReportedPostsResult = $this->db->query($getReportedPosts)->result_array();
		if(!empty($ReportedPostsResult)){
			foreach($ReportedPostsResult as $ReportedPostsResultData){
				$reportedPosts[] = $ReportedPostsResultData['post_id'];
			}
		}
		
		if(!empty($reportedPosts)){
			$reportedPostsString = implode(",",$reportedPosts);
		}
		
		// get reported questions
		$reportedQuestions = array();
		$reportedQuestionString = '';
		
		$getReportedQuestion = "SELECT question_id FROM report_questions WHERE user_id='".$CurrentUserID."'";
		$ReportedQuestionResult = $this->db->query($getReportedQuestion)->result_array();
		if(!empty($ReportedQuestionResult)){
			foreach($ReportedQuestionResult as $ReportedQuestionResultData){
				$reportedQuestions[] = $ReportedQuestionResultData['question_id'];
			}
		}
		
		if(!empty($reportedQuestions)){
			$reportedQuestionString = implode(",",$reportedQuestions);
		}
		
		// get reported questions
		$reportedDocuments = array();
		$reportedDocumentString = '';
		
		$getReportedDocument = "SELECT document_id FROM report_documents WHERE user_id='".$CurrentUserID."'";
		$ReportedDocumentResult = $this->db->query($getReportedDocument)->result_array();
		if(!empty($ReportedDocumentResult)){
			foreach($ReportedDocumentResult as $ReportedDocumentResultData){
				$reportedDocuments[] = $ReportedDocumentResultData['document_id'];
			}
		}
		
		if(!empty($reportedDocuments)){
			$reportedDocumentString = implode(",",$reportedDocuments);
		}
		
		// get reported studyset
		$reportedStudyset = array();
		$reportedStudysetString = '';
		
		$getReportedStudyset = "SELECT study_set_id FROM reported WHERE user_id='".$CurrentUserID."'";
		$ReportedStudysetResult = $this->db->query($getReportedStudyset)->result_array();
		if(!empty($ReportedStudysetResult)){
			foreach($ReportedStudysetResult as $ReportedStudysetResultData){
				$reportedStudyset[] = $ReportedStudysetResultData['study_set_id'];
			}
		}
		
		if(!empty($reportedStudyset)){
			$reportedStudysetString = implode(",",$reportedStudyset);
		}
		
		// get reported events
		$reportedEvents = array();
		$reportedEventsString = '';
		
		$getReportedEvents = "SELECT event_id FROM report_event WHERE user_id='".$CurrentUserID."'";
		$ReportedEventsResult = $this->db->query($getReportedEvents)->result_array();
		if(!empty($ReportedEventsResult)){
			foreach($ReportedEventsResult as $ReportedEventsResultData){
				$reportedEvents[] = $ReportedEventsResultData['event_id'];
			}
		}
		
		if(!empty($reportedEvents)){
			$reportedEventsString = implode(",",$reportedEvents);
		}
		
        $this->db->select('reference_master.*,');
        $this->db->from('reference_master');
        $this->db->where("reference_master.status", 1);
        $this->db->where("reference_master.user_id", $user_id);
        if (!empty($peerList)) {
            $this->db->or_group_start();
            $this->db->where_in('reference_master.user_id', $peerList);
            $this->db->where('reference_master.status', 1);
            $this->db->group_end();
        }
		
        $total_feeds = $this->db->get()->num_rows();

        $this->db->select('reference_master.*,');
        $this->db->from('reference_master');
        $this->db->where("reference_master.status", 1);
        $this->db->where("reference_master.user_id", $user_id);
        if (!empty($peerList)) {
            $this->db->or_group_start();
            $this->db->where_in('reference_master.user_id', $peerList);
            $this->db->where('reference_master.status', 1);
            $this->db->group_end();
        }
		
        $this->db->limit(10, $count);
        $this->db->order_by('reference_master.id', 'desc');
        $data['feeds'] = $this->db->get()->result_array();
		
        // echo $this->db->last_query();die;
        if ($count + 10 < $total_feeds) {
            $data['loadMore'] = 1;
        } else {
            $data['loadMore'] = 0;
        }
        $data['nextOffset'] = $offset + 1;
        $html = $this->load->view('user/dashboard-feeds', $data, true);
        echo $html;
    }

    public function schedule()
    {
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['index_menu']  = 'schedule';
        $data['title']  = 'Schedule | Studypeers';

        $data['colors'] = array('constitition', 'mathlaton', 'calculus', 'dance', 'study', 'assignment');

        if ($this->input->get()) {
            // print_r($this->input->get());die;
            $startdate  = $this->input->get('start-date');
            $course     = $this->input->get('course');
            $professor  = $this->input->get('professor');
            $keyword    = $this->input->get('keyword');
            if (!empty($startdate)) {
                $timestamp1 = strtotime($startdate);
                $start_date = date('Y-m-d 23:59:59', $timestamp1);
                $end_date = date('Y-m-d 00:00:00', $timestamp1);
            } else {
                $start_date = date('Y-m-d 23:59:59');
                $end_date = date('Y-m-d 00:00:00');
            }
            if (!empty($course) && !empty($keyword)) {
                $data['schedule_list'] = $this->db->query("select * from schedule_master where status = 1 and course = " . $course . " and schedule_name like '%{$keyword}%' and created_by = " . $user_id . " and start_date <= '" . $start_date . "' and end_date >= '" . $end_date . "'")->result_array();
                $data['schedule_list_day'] = $this->db->query("select * from schedule_master where status = 1 and created_by = " . $user_id . " and start_date <= '" . $start_date . "' and end_date >= '" . $end_date . "'")->result_array();
            } else if (!empty($course) && empty($keyword)) {
                $data['schedule_list'] = $this->db->query("select * from schedule_master where status = 1 and course = " . $course . " and created_by = " . $user_id . " and start_date <= '" . $start_date . "' and end_date >= '" . $end_date . "'")->result_array();
                $data['schedule_list_day'] = $this->db->query("select * from schedule_master where status = 1 and created_by = " . $user_id . " and start_date <= '" . $start_date . "' and end_date >= '" . $end_date . "'")->result_array();
            } else if (empty($course) && !empty($keyword)) {
                $data['schedule_list'] = $this->db->query("select * from schedule_master where status = 1 and schedule_name like '%{$keyword}%' and created_by = " . $user_id . " and start_date <= '" . $start_date . "' and end_date >= '" . $end_date . "'")->result_array();
                $data['schedule_list_day'] = $this->db->query("select * from schedule_master where status = 1 and created_by = " . $user_id . " and start_date <= '" . $start_date . "' and end_date >= '" . $end_date . "'")->result_array();
            } else {
                $data['schedule_list'] = $this->db->query("select * from schedule_master where status = 1 and course = " . $course . " and schedule_name like '%{$keyword}%' and created_by = " . $user_id . " and start_date <= '" . $start_date . "' and end_date >= '" . $end_date . "'")->result_array();
                $data['schedule_list_day'] = $this->db->query("select * from schedule_master where status = 1 and created_by = " . $user_id . " and start_date <= '" . $start_date . "' and end_date >= '" . $end_date . "'")->result_array();
            }

            if (!empty($course)) {
                $data['professor']     = $this->db->get_where('professor_master', array('status' => 1, 'course_id' => $course))->result_array();
            } else {
                $data['professor']  = array();
            }
        } else {
            $date1 = date('Y-m-d 23:59:59');
            $date2 = date('Y-m-d 00:00:00');

            $y = date('Y');
            $m = date('m');

            $data['schedule_list'] = $this->db->query("select * from schedule_master where status = 1 and created_by = " . $user_id . " and YEAR(start_date) = " . $y . " AND MONTH(start_date) = " . $m . " AND YEAR(end_date) = " . $y . " AND MONTH(end_date) >= " . $m . " order by id desc")->result_array();
            // echo $this->db->last_query();die;
            $data['schedule_list_day'] = $this->db->query("select * from schedule_master where status = 1 and created_by = " . $user_id . " and start_date <= '" . $date1 . "' and end_date >= '" . $date2 . "'")->result_array();
            $data['professor']  = array();
        }
        $user_info = $this->db->get_where('schedule_master', array('created_by' => $user_id, 'status' => 1))->result_array();
        $events = array();
        $color_codes = array('#5D8CF1', '#776BA7', '#FFCD9B', '#76EDD7', '#F06DA5', '#CAC8D3');

        if (count($user_info) > 0) {
            foreach ($user_info as $info) {
                $events[] = [
                    "id" => $info['id'],
                    "title" => $info['schedule_name'],
                    "start" => $info['start_date'],
                    "end" => $info['end_date'],
                    "color" => $color_codes[array_rand($color_codes)]
                ];
            }
        }

        $data['events']     = json_encode($events, true);
        $data['course']     = $this->db->get_where('course_master', array('status' => 1, 'user_id' => $user_id))->result_array();
        $this->load->view('user/include/header', $data);
        $this->load->view('user/schedule/schedule-list');
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/schedule/fullcalendar-script');
        $this->load->view('user/include/firebase-include');
        $this->load->view('user/schedule/footer');
    }


    public function getScheduleDayWise()
    {
        if ($this->input->post()) {
            $user_id = $this->session->get_userdata()['user_data']['user_id'];
            $date       = $this->input->post('date');
            $date1 = $date . ' 23:59:59';
            $date2 = $date . ' 00:00:00';
            $colors = array('constitition', 'mathlaton', 'calculus', 'dance', 'study', 'assignment');
            $schedule_list_day = $this->db->query("select * from schedule_master where status = 1 and created_by = " . $user_id . " and start_date <= '" . $date1 . "' and end_date >= '" . $date2 . "'")->result_array();
            if (!empty($schedule_list_day)) {
                $html = '';
                $c = 0;
                foreach ($schedule_list_day as $key => $value) {
                    $html .= '<div class="' . $colors[$c] . ' event" id="' . $value['id'] . '">
                                                            <div class="time">' . date('d M, Y h:i A', strtotime($value['start_date'])) . ' <span>' . date('d M, Y h:i A', strtotime($value['end_date'])) . '</span></div>
                                                            <div class="name">' . $value['schedule_name'] . '</div>
                                                        </div>';
                    if ($c == 5) {
                        $c = 0;
                    } else {
                        $c++;
                    }
                }
            } else {
                $html = '<div class="blankFeedArea">
                                    <div class="noFeedWrapper">
                                        <figure>
                                            <img src="' . base_url() . 'assets_d/images/blank-feeds.png" alt="No Feed">
                                        </figure>
                                        <h4>Search result not found.</h4>
                                    </div>
                                </div>';
            }
            echo $html;
            die;
        }
    }

    public function addSchedule()
    {
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();
        $data['university'] = $this->db->get_where('university', array('university_id' => $data['user_info']['intitutionID']))->row_array();
        $data['course']     = $this->db->get_where('course_master', array('status' => 1, 'user_id' => $user_id))->result_array();
        $data['index_menu']  = 'schedule';
        $data['title']  = 'Add Schedule | Studypeers';

        if ($this->input->post()) {
            // print_r($this->input->post());die;
            $schedule       = $this->input->post('schedule');
            $schedule_name  = $this->input->post('schedule_name');
            $description    = $this->input->post('description');
            $university     = $this->input->post('university');
            $course         = $this->input->post('course');
            $professor      = $this->input->post('professor');
            $startdate      = $this->input->post('start-date');
            $enddate        = $this->input->post('end-date');

            $timestamp1 = strtotime($startdate);
            $start_date = date('Y-m-d H:i:s', $timestamp1);

            $timestamp2 = strtotime($enddate);
            $end_date = date('Y-m-d H:i:s', $timestamp2);

            $insertArr = array(
                'schedule'      => $schedule,
                'schedule_name' => $schedule_name,
                'description'   => $description,
                'university'    => $university,
                'course'        => $course,
                'professor'     => $professor,
                'start_date'    => $start_date,
                'end_date'      => $end_date,
                'status'        => 1,
                'created_by'    => $user_id,
                'created_at'    => date('Y-m-d H:i:s')
            );
            $this->db->insert('schedule_master', $insertArr);

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Schedule Added Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('account/schedule'), 'refresh');
        }

        $this->load->view('user/include/header', $data);
        $this->load->view('user/schedule/schedule-add');
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/firebase-include');
        $this->load->view('user/schedule/footer');
    }

    public function logout()
    {
        is_not_logged_in();

        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $this->db->where(array('user_id' => $user_id, 'status' => 1));
        $this->db->update('user_token', array('status' => 2));

        $this->session->unset_userdata('user_data');
        redirect(site_url('home/login'));
    }

    public function getProfessor()
    {
        if ($this->input->post()) {
            $course = $this->input->post('course');
            $get_professor = $this->db->get_where('professor_master', array('status' => 1, 'course_id' => $course))->result_array();
            if (!empty($get_professor)) {
                $html = '';
                foreach ($get_professor as $key => $value) {
                    $html .= '<option value="' . $value['id'] . '">' . $value['name'] . '</option>';
                }
            } else {
                $html = '<option value="">No Records Found</option>';
            }
            echo $html;
            die;
        }
    }

    public function events()
    {
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['index_menu']  = 'events';
        $data['title']  = 'Events | Studypeers';
        if ($this->input->get()) {
            // print_r($this->input->get());die;
            $startdate  = $this->input->get('start-date');
            $course     = $this->input->get('course');
            $professor  = $this->input->get('professor');
            $keyword    = $this->input->get('keyword');
            if (!empty($startdate)) {
                $timestamp1 = strtotime($startdate);
                $start_date = date('Y-m-d', $timestamp1);
                $end_date = date('Y-m-d', $timestamp1);
            } else {
                $start_date = date('Y-m-d');
                $end_date = date('Y-m-d');
            }
            if (!empty($course) && !empty($keyword)) {
                $data['event_list'] = $this->db->query("select * from event_master where status = 1 and course = " . $course . " and event_name like '%{$keyword}%' and created_by = " . $user_id . " and (start_date <= '" . $start_date . "' AND end_date >= '" . $end_date . "') order by start_date and end_date <= '" . $end_date . "' desc")->result_array();
            } else if (!empty($course) && empty($keyword)) {
                $data['event_list'] = $this->db->query("select * from event_master where status = 1 and course = " . $course . " and created_by = " . $user_id . " and (start_date <= '" . $start_date . "' AND end_date >= '" . $end_date . "')  order by start_date desc")->result_array();
            } else if (empty($course) && !empty($keyword)) {
                $data['event_list'] = $this->db->query("select * from event_master where status = 1 and event_name like '%{$keyword}%' and created_by = " . $user_id . " and (start_date <= '" . $start_date . "' AND end_date >= '" . $end_date . "')  order by start_date desc")->result_array();
            } else {
                $data['event_list'] = $this->db->query("select * from event_master where status = 1 and created_by = " . $user_id . " and (start_date <= '" . $start_date . "' AND end_date >= '" . $end_date . "')  order by start_date desc")->result_array();
            }

            if (!empty($course)) {
                $data['professor']     = $this->db->get_where('professor_master', array('status' => 1, 'course_id' => $course))->result_array();
            } else {
                $data['professor']  = array();
            }
        } else {
            $date = date('Y-m-d');

            $data['event_list'] = $this->db->query("select * from event_master where status = 1 and created_by = " . $user_id . " and (start_date <= '" . $date . "' AND end_date >= '" . $date . "') OR event_master.id in (SELECT reference_id from share_master where peer_id = " . $user_id . " and reference = 'event' and status != 4)  order by start_date desc")->result_array();
        }
        $data['course']     = $this->db->get_where('course_master', array('status' => 1, 'user_id' => $user_id))->result_array();
        $this->load->view('user/include/header', $data);
        $this->load->view('user/events/events-list');
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/firebase-include');
        $this->load->view('user/events/footer');
    }


    public function getEventsDayWise()
    {
        if ($this->input->post()) {
            $user_id = $this->session->get_userdata()['user_data']['user_id'];
            $date       = $this->input->post('date');
            $startdate  = $this->input->post('start_date');
            $course     = $this->input->post('course');
            $professor  = $this->input->post('professor');
            $keyword    = $this->input->post('keyword');

            if (!empty($course) && !empty($keyword)) {

                $event_list = $this->db->query("select * from event_master where (status = 1 and course = " . $course . " and event_name like '%{$keyword}%' and created_by = " . $user_id . " and (start_date <= '" . $date . "' AND end_date >= '" . $date . "')) OR (event_master.id in (SELECT share_master.reference_id from share_master where share_master.peer_id = " . $user_id . " and share_master.reference = 'event' and share_master.status != 4 AND (event_master.status = 1 and event_master.course = " . $course . " and event_master.event_name like '%{$keyword}%' and (event_master.start_date <= '" . $date . "' AND event_master.end_date >= '" . $date . "'))))  order by start_date desc")->result_array();
            } else if (!empty($course) && empty($keyword)) {
                $event_list = $this->db->query("select * from event_master where (status = 1 and course = " . $course . " and created_by = " . $user_id . " and (start_date <= '" . $date . "' AND end_date >= '" . $date . "')) OR (event_master.id in (SELECT share_master.reference_id from share_master where share_master.peer_id = " . $user_id . " and share_master.reference = 'event' and share_master.status != 4 AND (event_master.status = 1 and event_master.course = " . $course . " and (event_master.start_date <= '" . $date . "' AND event_master.end_date >= '" . $date . "'))))  order by start_date desc")->result_array();
            } else if (empty($course) && !empty($keyword)) {
                $event_list = $this->db->query("select * from event_master where (status = 1 and event_name like '%{$keyword}%' and created_by = " . $user_id . " and (start_date <= '" . $date . "' AND end_date >= '" . $date . "')) OR (event_master.id in (SELECT share_master.reference_id from share_master where share_master.peer_id = " . $user_id . " and share_master.reference = 'event' and share_master.status != 4 AND (event_master.status = 1 and event_master.event_name like '%{$keyword}%' and (event_master.start_date <= '" . $date . "' AND event_master.end_date >= '" . $date . "'))))  order by start_date desc")->result_array();
            } else {
                $event_list = $this->db->query("select * from event_master where (status = 1 and created_by = " . $user_id . " and (start_date <= '" . $date . "' AND end_date >= '" . $date . "')) OR (event_master.id in (SELECT share_master.reference_id from share_master where share_master.peer_id = " . $user_id . " and share_master.reference = 'event' and share_master.status != 4 AND (event_master.status = 1 and (event_master.start_date <= '" . $date . "' AND event_master.end_date >= '" . $date . "'))))  order by start_date desc")->result_array();
            }



            $html = "";

            if (!empty($event_list)) {
                foreach ($event_list as $key => $value) {
                    $university = $this->db->get_where('university', array('university_id' => $value['university']))->row_array();

                    $peer_attending = $this->db->get_where('share_master', array('reference_id' => $value['id'], 'reference' => 'event', 'status' => 2))->result_array();

                    $html .= '<div class="feed-card list" id="event_id_div_' . $value['id'] . '">';

                    if ($value['featured_image'] != '') {
                        $html .= '<div class="left">
                                    <figure>
                                        <img src="' . base_url() . 'uploads/users/' . $value['featured_image'] . '" alt="Study Set List">
                                    </figure>
                                 </div>
                                 <div class="right">
                                     <div class="feed_card_inner">
                                        <h5><a href="' . base_url() . 'account/eventDetails/' . base64_encode($value['id']) . '">' . $value['event_name'] . '</a></h5>
                                        <div class="badgeList">
                                            <ul>
                                                <li class="badge badge1">
                                                    <a href="event-place.html">
                                                        ' . $university['SchoolName'] . '
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="timeperiod">
                                                    <div class="timeDetail">
                                                        <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
                                                                    <path d="M230.3,435.3C214.5,419.5,75.7,277.6,75.7,181.9C75.7,82,151.4,0,245,0s169.3,82,169.3,181.9
                                                                        c0,94.6-138.8,236.6-154.6,253.4C255.5,439.5,242.1,447.1,230.3,435.3z M245,41c-70.5,0-128.3,63.1-128.3,142
                                                                        c0,58.9,83.1,159.8,128.3,209.2c46.3-49.4,128.3-149.3,128.3-209.2C373.3,104.1,315.5,41,245,41z"></path>
                                                                    <path d="M245,246.1c-42.1,0-76.8-34.7-76.8-76.8s34.7-76.8,76.8-76.8s76.8,34.7,76.8,76.8S287.1,246.1,245,246.1z M245,132.6
                                                                        c-20,0-36.8,16.8-36.8,36.8s16.8,36.8,36.8,36.8s36.8-16.8,36.8-36.8C281.8,148.3,265,132.6,245,132.6z"></path>
                                                                    <path d="M345.9,490H144.1c-11.6,0-20-9.5-20-20s9.5-20,20-20H347c11.6,0,20,9.5,20,20S357.5,490,345.9,490z"></path>
                                                        </svg> ' . $value['location_txt'] . '
                                                    </div>
                                                    <div class="timeDetail">
                                                        <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
                                                            <path d="M110.3,247.8h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
                                                                c-16.8,0-30.5-13.6-30.5-30.5l0,0C79.9,261.4,93.5,247.8,110.3,247.8z"></path>
                                                            <path d="M227.4,247.8h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
                                                                c-16.8,0-30.5-13.6-30.5-30.5l0,0C197,261.4,210.6,247.8,227.4,247.8z"></path>
                                                            <path d="M344.5,247.8h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
                                                                c-16.8,0-30.5-13.6-30.5-30.5l0,0C314.1,261.4,327.7,247.8,344.5,247.8z"></path>
                                                            <path d="M110.3,339.6h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
                                                                c-16.8,0-30.5-13.6-30.5-30.5l0,0C79.9,353.3,93.5,339.6,110.3,339.6z"></path>
                                                            <path d="M227.4,339.6h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
                                                                c-16.8,0-30.5-13.6-30.5-30.5l0,0C197,353.3,210.6,339.6,227.4,339.6z"></path>
                                                            <path d="M344.5,339.6h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
                                                                c-16.8,0-30.5-13.6-30.5-30.5l0,0C314.1,353.3,327.7,339.6,344.5,339.6z"></path>
                                                            <path d="M469.2,45.6h-82.1V21.7c0-11.5-9.3-20.8-20.8-20.8c-11.5,0-20.8,9.3-20.8,20.8v24H143.6v-24
                                                                c0-11.5-9.3-20.8-20.8-20.8s-20.8,9.3-20.8,20.8v24H20.8C9.3,45.7,0,54.9,0,66.4v402.5c0,11.5,9.3,20.7,20.8,20.8h447.4
                                                                c11.5-0.3,20.9-9.3,21.9-20.8V66.4C490,54.9,480.7,45.6,469.2,45.6z M448.3,449.3H40.5V197.5h407.8V449.3z M448.3,155.9H40.5V87.3
                                                                h61.4V105c-0.3,11.5,8.8,21,20.3,21.3s21-8.8,21.3-20.3l0,0V87.2h201.9v17.7c0,11.5,9.3,20.7,20.8,20.8c11-0.3,19.9-8.8,20.8-19.8
                                                                V87.2h61.3v68.6V155.9z"></path>
                                                        </svg> ' . date('d M, Y', strtotime($value['start_date'])) . '                                           
                                                    </div>
                                                        <div class="timeDetail">
                                                            <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 501.333 501.333">
                                                                        <path d="M250.667,0C112,0,0,112,0,250.667s112,250.667,250.667,250.667s250.667-112,250.667-250.667S389.333,0,250.667,0z
                                                                            M250.667,459.733c-115.2,0-209.067-93.867-209.067-209.067S135.467,41.6,250.667,41.6s209.067,93.867,209.067,209.067
                                                                            S365.867,459.733,250.667,459.733z"></path>
                                                                        <path d="M314.667,229.333H272V129.067c0-11.733-9.6-21.333-21.333-21.333c-11.733,0-21.333,9.6-21.333,21.333v121.6
                                                                            c0,11.733,9.6,21.333,21.333,21.333h64C326.4,272,336,262.4,336,250.667C336,238.933,326.4,229.333,314.667,229.333z"></path>
                                                            </svg>' . date('h:i A', strtotime($value['start_time'])) . '
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <div class="feed_card_footer">';
                        $this->db->select('user_info.nickname,user_info.userID,user.id,user.username');
                        $this->db->join('user', 'user.id=user_info.userID');
                        $user = $this->db->get_where('user_info', array('userID' => $value['created_by']))->row_array();
                        $html .= '<div class="userWrap eventBox">
                                                            <div class="user-name">
                                                                <figure>
                                                                    <img src="' . userImage($value['created_by']) . '" alt="user">
                                                                </figure>
                                                                <a href="' . base_url() . 'sp/' . $user['username'] . '"><figcaption>' . $user['nickname'] . '</figcaption></a>

                                                            </div>';
                        if ($value['created_by'] == $user_id) {
                            $html .= '<div class="edit">

                                                                <a href="' . base_url() . 'account/editEvent/' . base64_encode($value['id']) . '">
                                                                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                                                            <g>
                                                                                <g>
                                                                                    <polygon points="51.2,353.28 0,512 158.72,460.8         "></polygon>
                                                                                </g>
                                                                            </g>
                                                                            <g>
                                                                                <g>
                                                                                    
                                                                                        <rect x="89.73" y="169.097" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -95.8575 260.3719)" width="353.277" height="153.599"></rect>
                                                                                </g>
                                                                            </g>
                                                                            <g>
                                                                                <g>
                                                                                    <path d="M504.32,79.36L432.64,7.68c-10.24-10.24-25.6-10.24-35.84,0l-23.04,23.04l107.52,107.52l23.04-23.04
                                                                                        C514.56,104.96,514.56,89.6,504.32,79.36z"></path>
                                                                                </g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                    </svg> Edit
                                                                </a>
                                                            </div>          
                                                            <div class="delete">
                                                                <a data-toggle="modal" data-id="' . $value['id'] . '" data-target="#confirmationModalList" class="delete_event">                                        
                                                                    <svg height="512pt" viewBox="-57 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="m156.371094 30.90625h85.570312v14.398438h30.902344v-16.414063c.003906-15.929687-12.949219-28.890625-28.871094-28.890625h-89.632812c-15.921875 0-28.875 12.960938-28.875 28.890625v16.414063h30.90625zm0 0"></path><path d="m344.210938 167.75h-290.109376c-7.949218 0-14.207031 6.78125-13.566406 14.707031l24.253906 299.90625c1.351563 16.742188 15.316407 29.636719 32.09375 29.636719h204.542969c16.777344 0 30.742188-12.894531 32.09375-29.640625l24.253907-299.902344c.644531-7.925781-5.613282-14.707031-13.5625-14.707031zm-219.863282 312.261719c-.324218.019531-.648437.03125-.96875.03125-8.101562 0-14.902344-6.308594-15.40625-14.503907l-15.199218-246.207031c-.523438-8.519531 5.957031-15.851562 14.472656-16.375 8.488281-.515625 15.851562 5.949219 16.375 14.472657l15.195312 246.207031c.527344 8.519531-5.953125 15.847656-14.46875 16.375zm90.433594-15.421875c0 8.53125-6.917969 15.449218-15.453125 15.449218s-15.453125-6.917968-15.453125-15.449218v-246.210938c0-8.535156 6.917969-15.453125 15.453125-15.453125 8.53125 0 15.453125 6.917969 15.453125 15.453125zm90.757812-245.300782-14.511718 246.207032c-.480469 8.210937-7.292969 14.542968-15.410156 14.542968-.304688 0-.613282-.007812-.921876-.023437-8.519531-.503906-15.019531-7.816406-14.515624-16.335937l14.507812-246.210938c.5-8.519531 7.789062-15.019531 16.332031-14.515625 8.519531.5 15.019531 7.816406 14.519531 16.335937zm0 0"></path><path d="m397.648438 120.0625-10.148438-30.421875c-2.675781-8.019531-10.183594-13.429687-18.640625-13.429687h-339.410156c-8.453125 0-15.964844 5.410156-18.636719 13.429687l-10.148438 30.421875c-1.957031 5.867188.589844 11.851562 5.34375 14.835938 1.9375 1.214843 4.230469 1.945312 6.75 1.945312h372.796876c2.519531 0 4.816406-.730469 6.75-1.949219 4.753906-2.984375 7.300781-8.96875 5.34375-14.832031zm0 0"></path>
                                                                    </svg> Delete
                                                                </a>
                                                            </div>  
                                                            <div class="edit invitePeer" data-id="' . $value['id'] . '">
                                                                <a data-toggle="modal" data-target="#peersModalShare">
                                                                    <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
                                                                        <path d="M319.4,85.8c0,2.9,0.1,5.7,0.4,8.6l-140.7,76.7c-19-19.8-45.6-32.2-75.1-32.2c-57.2,0-104,46.8-104,104s46.8,104,104,104
                                                                            c30.7,0,58.5-13.5,77.6-34.9l139.2,76.8c-0.9,5-1.4,10.1-1.4,15.4c0,46.8,38.5,85.3,85.3,85.3c46.8,0,85.3-38.5,85.3-85.3
                                                                            s-38.5-85.3-85.3-85.3c-26.8,0-50.9,12.6-66.5,32.2l-135.6-74.8c3.6-10.5,5.5-21.7,5.5-33.4c0-13-2.4-25.4-6.8-36.9l132.5-73
                                                                            c15.4,22.9,41.5,38.1,70.9,38.1c46.8,0,85.3-38.5,85.3-85.3S451.5,0.5,404.7,0.5S319.4,39,319.4,85.8z M449.4,404.2
                                                                            c0,25-19.8,44.7-44.7,44.7S360,429.1,360,404.2c0-25,19.8-44.7,44.7-44.7S449.4,379.2,449.4,404.2z M104,305.3
                                                                            c-34.3,0-62.4-28.1-62.4-62.4s28.1-62.4,62.4-62.4s62.4,28.1,62.4,62.4C166.5,277.3,138.4,305.3,104,305.3z M449.4,85.8
                                                                            c0,25-19.8,44.7-44.7,44.7S360,110.7,360,85.8c0-25,19.8-44.7,44.7-44.7S449.4,60.9,449.4,85.8z"></path>
                                                                    </svg> Invite
                                                                </a>

                                                            </div>';
                        } else {
                            $this->db->order_by('share_master.id', 'desc');
                            $shared = $this->db->get_where('share_master', array('reference_id' => $value['id'], 'reference' => 'event', 'peer_id' => $user_id))->row_array();
                            $html .= '<div class="delete removeSharedEvent" data-id="' . $value['id'] . '">
                                                                <a data-toggle="modal" data-target="#confirmationModalRemove" class="delete_event">                                        
                                                                    <svg height="512pt" viewBox="-57 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="m156.371094 30.90625h85.570312v14.398438h30.902344v-16.414063c.003906-15.929687-12.949219-28.890625-28.871094-28.890625h-89.632812c-15.921875 0-28.875 12.960938-28.875 28.890625v16.414063h30.90625zm0 0"></path><path d="m344.210938 167.75h-290.109376c-7.949218 0-14.207031 6.78125-13.566406 14.707031l24.253906 299.90625c1.351563 16.742188 15.316407 29.636719 32.09375 29.636719h204.542969c16.777344 0 30.742188-12.894531 32.09375-29.640625l24.253907-299.902344c.644531-7.925781-5.613282-14.707031-13.5625-14.707031zm-219.863282 312.261719c-.324218.019531-.648437.03125-.96875.03125-8.101562 0-14.902344-6.308594-15.40625-14.503907l-15.199218-246.207031c-.523438-8.519531 5.957031-15.851562 14.472656-16.375 8.488281-.515625 15.851562 5.949219 16.375 14.472657l15.195312 246.207031c.527344 8.519531-5.953125 15.847656-14.46875 16.375zm90.433594-15.421875c0 8.53125-6.917969 15.449218-15.453125 15.449218s-15.453125-6.917968-15.453125-15.449218v-246.210938c0-8.535156 6.917969-15.453125 15.453125-15.453125 8.53125 0 15.453125 6.917969 15.453125 15.453125zm90.757812-245.300782-14.511718 246.207032c-.480469 8.210937-7.292969 14.542968-15.410156 14.542968-.304688 0-.613282-.007812-.921876-.023437-8.519531-.503906-15.019531-7.816406-14.515624-16.335937l14.507812-246.210938c.5-8.519531 7.789062-15.019531 16.332031-14.515625 8.519531.5 15.019531 7.816406 14.519531 16.335937zm0 0"></path><path d="m397.648438 120.0625-10.148438-30.421875c-2.675781-8.019531-10.183594-13.429687-18.640625-13.429687h-339.410156c-8.453125 0-15.964844 5.410156-18.636719 13.429687l-10.148438 30.421875c-1.957031 5.867188.589844 11.851562 5.34375 14.835938 1.9375 1.214843 4.230469 1.945312 6.75 1.945312h372.796876c2.519531 0 4.816406-.730469 6.75-1.949219 4.753906-2.984375 7.300781-8.96875 5.34375-14.832031zm0 0"></path>
                                                                    </svg> Hide
                                                                </a>
                                                            </div>
                                                            <div class="edit attendEvent" data-id="' . $value['id'] . '">
                                                                <a data-toggle="modal" data-target="#confirmationModalAttend">
                                                                    <svg height="512pt" viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="m452 512h-392c-33.085938 0-60-26.914062-60-60v-392c0-33.085938 26.914062-60 60-60h392c33.085938 0 60 26.914062 60 60v392c0 33.085938-26.914062 60-60 60zm-392-472c-11.027344 0-20 8.972656-20 20v392c0 11.027344 8.972656 20 20 20h392c11.027344 0 20-8.972656 20-20v-392c0-11.027344-8.972656-20-20-20zm370.898438 111.34375-29.800782-26.6875-184.964844 206.566406-107.351562-102.046875-27.558594 28.988281 137.21875 130.445313zm0 0"/>
                                                                    </svg> <span id="attend_text_' . $value['id'] . '">';
                            if ($shared['status'] == 2) {
                                $html .= 'Unattend';
                            } else {
                                $html .= 'Attend';
                            }
                            $html .= '</span>
                                                                </a>
                                                            </div>';
                        }
                        $html .= '</div>';

                        if (!empty($peer_attending)) {


                            $html .= '<div class="userIcoList peersModalAttending" data-toggle="modal" data-target="#peersModalAttending" data-id="' . $value['id'] . '">
                                                            <ul>';
                            if (!empty($peer_attending[0])) {
                                $html .= '<li>
                                                                    <img src="' . userImage($peer_attending[0]['peer_id']) . '" alt="user">
                                                                </li>';
                            }

                            if (!empty($peer_attending[1])) {
                                $html .= '<li>
                                                                    <img src="' . userImage($peer_attending[1]['peer_id']) . '" alt="user">
                                                                </li>';
                            }

                            if (!empty($peer_attending[2])) {
                                $html .= '<li>
                                                                    <img src="' . userImage($peer_attending[2]['peer_id']) . '" alt="user">
                                                                </li>';
                            }

                            $count = count($peer_attending) - 3;


                            $html .= '<li class="more">
                                                                    +';
                            if ($count > 3) {
                                $html .= $count;
                            }
                            $html .= '</li>';


                            $html .= '</ul>
                                                        </div>';
                        }

                        $html .= '<div class="action">';
                        if ($value['addedToCalender'] == 0) {
                            $html .= '<a href="#" class="addEvents" data-id="' . $value['id'] . '" data-toggle="modal" data-target="#addEventModal">
                                                                    <img src="' . base_url() . 'assets_d/images/calendar.svg" alt="Events Calendar"> 
                                                                </a>';
                        } else {
                            $html .= '<a href="#" class="removeEvent" data-id="' . $value['id'] . '" data-toggle="modal" data-target="#removeFromScheduleModal">
                                                                        <img src="' . base_url() . 'assets_d/images/calendar.png" alt="Events Calendar" style="width: 20px;height: 20px;"> 
                                                                    </a>';
                        }
                        $html .= '<a>
                                                                    <div class="action_button">
                                                                        <a href="' . base_url() . 'account/eventDetails/' . base64_encode($value['id']) . '">
                                                                            <svg class="sp-icon sp-icon--rotate-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
                                                                                <path d="M481.3,110.1c-11.6-11.6-30.4-11.6-42.1,0L245,304.4L50.8,110.2c-11.6-11.6-30.4-11.6-42.1,0c-11.6,11.6-11.6,30.4,0,42.1
                                                                                    l236.4,236.4l236.2-236.4C492.9,140.6,492.9,121.7,481.3,110.1z"></path>
                                                                            </svg>
                                                                        </a>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        
                                                    </div>
                                                 </div>';
                    } else {
                        $html .= '<div class="right">
                                                <div class="feed_card_inner">
                                                    <h5><a href="' . base_url() . 'account/eventDetails/' . base64_encode($value['id']) . '">' . $value['event_name'] . '</a></h5>
                                                    <div class="badgeList">
                                                        <ul>
                                                            <li class="badge badge1">
                                                                <a href="event-place.html">
                                                                    ' . $university['SchoolName'] . '
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="timeperiod">
                                                                <div class="timeDetail">
                                                                    <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
                                                                                <path d="M230.3,435.3C214.5,419.5,75.7,277.6,75.7,181.9C75.7,82,151.4,0,245,0s169.3,82,169.3,181.9
                                                                                    c0,94.6-138.8,236.6-154.6,253.4C255.5,439.5,242.1,447.1,230.3,435.3z M245,41c-70.5,0-128.3,63.1-128.3,142
                                                                                    c0,58.9,83.1,159.8,128.3,209.2c46.3-49.4,128.3-149.3,128.3-209.2C373.3,104.1,315.5,41,245,41z"></path>
                                                                                <path d="M245,246.1c-42.1,0-76.8-34.7-76.8-76.8s34.7-76.8,76.8-76.8s76.8,34.7,76.8,76.8S287.1,246.1,245,246.1z M245,132.6
                                                                                    c-20,0-36.8,16.8-36.8,36.8s16.8,36.8,36.8,36.8s36.8-16.8,36.8-36.8C281.8,148.3,265,132.6,245,132.6z"></path>
                                                                                <path d="M345.9,490H144.1c-11.6,0-20-9.5-20-20s9.5-20,20-20H347c11.6,0,20,9.5,20,20S357.5,490,345.9,490z"></path>
                                                                    </svg> ' . $value['location_txt'] . '
                                                                </div>
                                                                <div class="timeDetail">
                                                                    <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
                                                                        <path d="M110.3,247.8h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
                                                                            c-16.8,0-30.5-13.6-30.5-30.5l0,0C79.9,261.4,93.5,247.8,110.3,247.8z"></path>
                                                                        <path d="M227.4,247.8h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
                                                                            c-16.8,0-30.5-13.6-30.5-30.5l0,0C197,261.4,210.6,247.8,227.4,247.8z"></path>
                                                                        <path d="M344.5,247.8h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
                                                                            c-16.8,0-30.5-13.6-30.5-30.5l0,0C314.1,261.4,327.7,247.8,344.5,247.8z"></path>
                                                                        <path d="M110.3,339.6h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
                                                                            c-16.8,0-30.5-13.6-30.5-30.5l0,0C79.9,353.3,93.5,339.6,110.3,339.6z"></path>
                                                                        <path d="M227.4,339.6h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
                                                                            c-16.8,0-30.5-13.6-30.5-30.5l0,0C197,353.3,210.6,339.6,227.4,339.6z"></path>
                                                                        <path d="M344.5,339.6h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
                                                                            c-16.8,0-30.5-13.6-30.5-30.5l0,0C314.1,353.3,327.7,339.6,344.5,339.6z"></path>
                                                                        <path d="M469.2,45.6h-82.1V21.7c0-11.5-9.3-20.8-20.8-20.8c-11.5,0-20.8,9.3-20.8,20.8v24H143.6v-24
                                                                            c0-11.5-9.3-20.8-20.8-20.8s-20.8,9.3-20.8,20.8v24H20.8C9.3,45.7,0,54.9,0,66.4v402.5c0,11.5,9.3,20.7,20.8,20.8h447.4
                                                                            c11.5-0.3,20.9-9.3,21.9-20.8V66.4C490,54.9,480.7,45.6,469.2,45.6z M448.3,449.3H40.5V197.5h407.8V449.3z M448.3,155.9H40.5V87.3
                                                                            h61.4V105c-0.3,11.5,8.8,21,20.3,21.3s21-8.8,21.3-20.3l0,0V87.2h201.9v17.7c0,11.5,9.3,20.7,20.8,20.8c11-0.3,19.9-8.8,20.8-19.8
                                                                            V87.2h61.3v68.6V155.9z"></path>
                                                                    </svg> ' . date('d M, Y', strtotime($value['start_date'])) . '                                           
                                                                </div>
                                                                <div class="timeDetail">
                                                                    <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 501.333 501.333">
                                                                                <path d="M250.667,0C112,0,0,112,0,250.667s112,250.667,250.667,250.667s250.667-112,250.667-250.667S389.333,0,250.667,0z
                                                                                    M250.667,459.733c-115.2,0-209.067-93.867-209.067-209.067S135.467,41.6,250.667,41.6s209.067,93.867,209.067,209.067
                                                                                    S365.867,459.733,250.667,459.733z"></path>
                                                                                <path d="M314.667,229.333H272V129.067c0-11.733-9.6-21.333-21.333-21.333c-11.733,0-21.333,9.6-21.333,21.333v121.6
                                                                                    c0,11.733,9.6,21.333,21.333,21.333h64C326.4,272,336,262.4,336,250.667C336,238.933,326.4,229.333,314.667,229.333z"></path>
                                                                    </svg>' . date('h:i A', strtotime($value['start_time'])) . '
                                                                </div>
                                                            </div>
                                                </div>
                                                <div class="feed_card_footer">';
                        $this->db->select('user_info.nickname,user_info.userID,user.id,user.username');
                        $this->db->join('user', 'user.id=user_info.userID');
                        $user = $this->db->get_where('user_info', array('userID' => $value['created_by']))->row_array();
                        $html .= '<div class="userWrap eventBox">
                                                        <div class="user-name">
                                                            <figure>
                                                                <img src="' . userImage($value['created_by']) . '" alt="user">
                                                            </figure>
                                                            <a href="' . base_url() . 'sp/' . $user['username'] . '"><figcaption>' . $user['nickname'] . '</figcaption></a>

                                                        </div>';
                        if ($value['created_by'] == $user_id) {
                            $html .= '<div class="edit">
                                                                <a href="' . base_url() . 'account/editEvent/' . base64_encode($value['id']) . '">
                                                                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                                                            <g>
                                                                                <g>
                                                                                    <polygon points="51.2,353.28 0,512 158.72,460.8         "></polygon>
                                                                                </g>
                                                                            </g>
                                                                            <g>
                                                                                <g>
                                                                                    
                                                                                        <rect x="89.73" y="169.097" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -95.8575 260.3719)" width="353.277" height="153.599"></rect>
                                                                                </g>
                                                                            </g>
                                                                            <g>
                                                                                <g>
                                                                                    <path d="M504.32,79.36L432.64,7.68c-10.24-10.24-25.6-10.24-35.84,0l-23.04,23.04l107.52,107.52l23.04-23.04
                                                                                        C514.56,104.96,514.56,89.6,504.32,79.36z"></path>
                                                                                </g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                    </svg> Edit
                                                                </a>
                                                            </div>          
                                                            <div class="delete">
                                                                <a data-toggle="modal" data-id="' . $value['id'] . '" data-target="#confirmationModalList" class="delete_event">                                        
                                                                    <svg height="512pt" viewBox="-57 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="m156.371094 30.90625h85.570312v14.398438h30.902344v-16.414063c.003906-15.929687-12.949219-28.890625-28.871094-28.890625h-89.632812c-15.921875 0-28.875 12.960938-28.875 28.890625v16.414063h30.90625zm0 0"></path><path d="m344.210938 167.75h-290.109376c-7.949218 0-14.207031 6.78125-13.566406 14.707031l24.253906 299.90625c1.351563 16.742188 15.316407 29.636719 32.09375 29.636719h204.542969c16.777344 0 30.742188-12.894531 32.09375-29.640625l24.253907-299.902344c.644531-7.925781-5.613282-14.707031-13.5625-14.707031zm-219.863282 312.261719c-.324218.019531-.648437.03125-.96875.03125-8.101562 0-14.902344-6.308594-15.40625-14.503907l-15.199218-246.207031c-.523438-8.519531 5.957031-15.851562 14.472656-16.375 8.488281-.515625 15.851562 5.949219 16.375 14.472657l15.195312 246.207031c.527344 8.519531-5.953125 15.847656-14.46875 16.375zm90.433594-15.421875c0 8.53125-6.917969 15.449218-15.453125 15.449218s-15.453125-6.917968-15.453125-15.449218v-246.210938c0-8.535156 6.917969-15.453125 15.453125-15.453125 8.53125 0 15.453125 6.917969 15.453125 15.453125zm90.757812-245.300782-14.511718 246.207032c-.480469 8.210937-7.292969 14.542968-15.410156 14.542968-.304688 0-.613282-.007812-.921876-.023437-8.519531-.503906-15.019531-7.816406-14.515624-16.335937l14.507812-246.210938c.5-8.519531 7.789062-15.019531 16.332031-14.515625 8.519531.5 15.019531 7.816406 14.519531 16.335937zm0 0"></path><path d="m397.648438 120.0625-10.148438-30.421875c-2.675781-8.019531-10.183594-13.429687-18.640625-13.429687h-339.410156c-8.453125 0-15.964844 5.410156-18.636719 13.429687l-10.148438 30.421875c-1.957031 5.867188.589844 11.851562 5.34375 14.835938 1.9375 1.214843 4.230469 1.945312 6.75 1.945312h372.796876c2.519531 0 4.816406-.730469 6.75-1.949219 4.753906-2.984375 7.300781-8.96875 5.34375-14.832031zm0 0"></path>
                                                                    </svg> Delete
                                                                </a>
                                                            </div>  
                                                            <div class="edit invitePeer" data-id="' . $value['id'] . '">
                                                                <a data-toggle="modal" data-target="#peersModalShare">
                                                                    <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
                                                                        <path d="M319.4,85.8c0,2.9,0.1,5.7,0.4,8.6l-140.7,76.7c-19-19.8-45.6-32.2-75.1-32.2c-57.2,0-104,46.8-104,104s46.8,104,104,104
                                                                            c30.7,0,58.5-13.5,77.6-34.9l139.2,76.8c-0.9,5-1.4,10.1-1.4,15.4c0,46.8,38.5,85.3,85.3,85.3c46.8,0,85.3-38.5,85.3-85.3
                                                                            s-38.5-85.3-85.3-85.3c-26.8,0-50.9,12.6-66.5,32.2l-135.6-74.8c3.6-10.5,5.5-21.7,5.5-33.4c0-13-2.4-25.4-6.8-36.9l132.5-73
                                                                            c15.4,22.9,41.5,38.1,70.9,38.1c46.8,0,85.3-38.5,85.3-85.3S451.5,0.5,404.7,0.5S319.4,39,319.4,85.8z M449.4,404.2
                                                                            c0,25-19.8,44.7-44.7,44.7S360,429.1,360,404.2c0-25,19.8-44.7,44.7-44.7S449.4,379.2,449.4,404.2z M104,305.3
                                                                            c-34.3,0-62.4-28.1-62.4-62.4s28.1-62.4,62.4-62.4s62.4,28.1,62.4,62.4C166.5,277.3,138.4,305.3,104,305.3z M449.4,85.8
                                                                            c0,25-19.8,44.7-44.7,44.7S360,110.7,360,85.8c0-25,19.8-44.7,44.7-44.7S449.4,60.9,449.4,85.8z"></path>
                                                                    </svg> Invite
                                                                </a>
                                                            </div>';
                        } else {
                            $this->db->order_by('share_master.id', 'desc');
                            $shared = $this->db->get_where('share_master', array('reference_id' => $value['id'], 'reference' => 'event', 'peer_id' => $user_id))->row_array();
                            $html .= '<div class="delete removeSharedEvent" data-id="' . $value['id'] . '">
                                                                <a data-toggle="modal" data-target="#confirmationModalRemove" class="delete_event">                                        
                                                                    <svg height="512pt" viewBox="-57 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="m156.371094 30.90625h85.570312v14.398438h30.902344v-16.414063c.003906-15.929687-12.949219-28.890625-28.871094-28.890625h-89.632812c-15.921875 0-28.875 12.960938-28.875 28.890625v16.414063h30.90625zm0 0"></path><path d="m344.210938 167.75h-290.109376c-7.949218 0-14.207031 6.78125-13.566406 14.707031l24.253906 299.90625c1.351563 16.742188 15.316407 29.636719 32.09375 29.636719h204.542969c16.777344 0 30.742188-12.894531 32.09375-29.640625l24.253907-299.902344c.644531-7.925781-5.613282-14.707031-13.5625-14.707031zm-219.863282 312.261719c-.324218.019531-.648437.03125-.96875.03125-8.101562 0-14.902344-6.308594-15.40625-14.503907l-15.199218-246.207031c-.523438-8.519531 5.957031-15.851562 14.472656-16.375 8.488281-.515625 15.851562 5.949219 16.375 14.472657l15.195312 246.207031c.527344 8.519531-5.953125 15.847656-14.46875 16.375zm90.433594-15.421875c0 8.53125-6.917969 15.449218-15.453125 15.449218s-15.453125-6.917968-15.453125-15.449218v-246.210938c0-8.535156 6.917969-15.453125 15.453125-15.453125 8.53125 0 15.453125 6.917969 15.453125 15.453125zm90.757812-245.300782-14.511718 246.207032c-.480469 8.210937-7.292969 14.542968-15.410156 14.542968-.304688 0-.613282-.007812-.921876-.023437-8.519531-.503906-15.019531-7.816406-14.515624-16.335937l14.507812-246.210938c.5-8.519531 7.789062-15.019531 16.332031-14.515625 8.519531.5 15.019531 7.816406 14.519531 16.335937zm0 0"></path><path d="m397.648438 120.0625-10.148438-30.421875c-2.675781-8.019531-10.183594-13.429687-18.640625-13.429687h-339.410156c-8.453125 0-15.964844 5.410156-18.636719 13.429687l-10.148438 30.421875c-1.957031 5.867188.589844 11.851562 5.34375 14.835938 1.9375 1.214843 4.230469 1.945312 6.75 1.945312h372.796876c2.519531 0 4.816406-.730469 6.75-1.949219 4.753906-2.984375 7.300781-8.96875 5.34375-14.832031zm0 0"></path>
                                                                    </svg> Hide
                                                                </a>
                                                            </div>
                                                            <div class="edit attendEvent" data-id="' . $value['id'] . '">
                                                                <a data-toggle="modal" data-target="#confirmationModalAttend">
                                                                    <svg height="512pt" viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="m452 512h-392c-33.085938 0-60-26.914062-60-60v-392c0-33.085938 26.914062-60 60-60h392c33.085938 0 60 26.914062 60 60v392c0 33.085938-26.914062 60-60 60zm-392-472c-11.027344 0-20 8.972656-20 20v392c0 11.027344 8.972656 20 20 20h392c11.027344 0 20-8.972656 20-20v-392c0-11.027344-8.972656-20-20-20zm370.898438 111.34375-29.800782-26.6875-184.964844 206.566406-107.351562-102.046875-27.558594 28.988281 137.21875 130.445313zm0 0"/>
                                                                    </svg> <span id="attend_text_' . $value['id'] . '">';
                            if ($shared['status'] == 2) {
                                $html .= 'Unattend';
                            } else {
                                $html .= 'Attend';
                            }

                            $html .= '</span>
                                                                </a>
                                                            </div>';
                        }
                        $html .= '</div>';

                        if (!empty($peer_attending)) {


                            $html .= '<div class="userIcoList peersModalAttending" data-toggle="modal" data-id="' . $value['id'] . '" data-target="#peersModalAttending">
                                                            <ul>';
                            if (!empty($peer_attending[0])) {
                                $html .= '<li>
                                                                    <img src="' . userImage($peer_attending[0]['peer_id']) . '" alt="user">
                                                                </li>';
                            }

                            if (!empty($peer_attending[1])) {
                                $html .= '<li>
                                                                    <img src="' . userImage($peer_attending[1]['peer_id']) . '" alt="user">
                                                                </li>';
                            }

                            if (!empty($peer_attending[2])) {
                                $html .= '<li>
                                                                    <img src="' . userImage($peer_attending[2]['peer_id']) . '" alt="user">
                                                                </li>';
                            }

                            $count = count($peer_attending) - 3;
                            $html .= '<li class="more">
                                                                    +';
                            if ($count > 3) {
                                $html .= $count;
                            }
                            $html .= '</li>';

                            $html .= '</ul>
                                                        </div>';
                        }

                        $html .= '<div class="action">';
                        if ($value['created_by'] == $user_id) {
                            if ($value['addedToCalender'] == 0) {
                                $html .= '<a href="#" class="addEvents" data-id="' . $value['id'] . '" data-toggle="modal" data-target="#addEventModal">
                                                                    <img src="' . base_url() . 'assets_d/images/calendar.svg" alt="Events Calendar"> 
                                                                </a>';
                            } else {
                                $html .= '<a href="#" class="removeEvent" data-id="' . $value['id'] . '" data-toggle="modal" data-target="#removeFromScheduleModal">
                                                                        <img src="' . base_url() . 'assets_d/images/calendar.png" alt="Events Calendar" style="width: 20px;height: 20px;"> 
                                                                    </a>';
                            }
                        } else {
                            if ($shared['schedule_master_id'] == 0) {
                                $html .= '<a href="#" class="addEvents" data-id="' . $value['id'] . '" data-toggle="modal" data-target="#addEventModal">
                                                                    <img src="' . base_url() . 'assets_d/images/calendar.svg" alt="Events Calendar"> 
                                                                </a>';
                            } else {
                                $html .= '<a href="#" class="removeEvent" data-id="' . $value['id'] . '" data-toggle="modal" data-target="#removeFromScheduleModal">
                                                                        <img src="' . base_url() . 'assets_d/images/calendar.png" alt="Events Calendar" style="width: 20px;height: 20px;"> 
                                                                </a>';
                            }
                        }
                        $html .= '<a>
                                                                <div class="action_button">
                                                                    <a href="' . base_url() . 'account/eventDetails/' . base64_encode($value['id']) . '">
                                                                        <svg class="sp-icon sp-icon--rotate-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
                                                                            <path d="M481.3,110.1c-11.6-11.6-30.4-11.6-42.1,0L245,304.4L50.8,110.2c-11.6-11.6-30.4-11.6-42.1,0c-11.6,11.6-11.6,30.4,0,42.1
                                                                                l236.4,236.4l236.2-236.4C492.9,140.6,492.9,121.7,481.3,110.1z"></path>
                                                                        </svg>
                                                                    </a>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    
                                                </div>
                                            </div>';
                    }
                    $html .= '</div>';
                }
            } else {
                $html = '<div class="blankFeedArea">
                                    <div class="noFeedWrapper">
                                        <figure>
                                            <img src="' . base_url() . 'assets_d/images/blank-feeds.png" alt="No Feed">
                                        </figure>
                                        <h4>Search result not found.</h4>
                                    </div>
                                </div>';
            }
            echo $html;
            die;
        }
    }

    public function addEvent()
    {
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();
        $data['university'] = $this->db->get_where('university', array('university_id' => $data['user_info']['intitutionID']))->row_array();
        $data['course']     = $this->db->get_where('course_master', array('status' => 1, 'user_id' => $user_id))->result_array();
        $data['index_menu']  = 'events';
        $data['title']  = 'Add Event | Studypeers';



        if ($this->input->post()) {
            // print_r($this->input->post());die;
            $event_name     = $this->input->post('event_name');
            $location_txt   = $this->input->post('location_txt');
            $description    = $this->input->post('description');
            $university     = $this->input->post('university');
            $course         = $this->input->post('course');
            $professor      = $this->input->post('professor');
            $startdate      = $this->input->post('start-date');
            $enddate        = $this->input->post('end-date');
            $starttime      = $this->input->post('start-time');
            $endtime        = $this->input->post('end-time');

            $privacy        = $this->input->post('privacy');

            $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($location_txt) . "&key=AIzaSyBNNCJ7_zDBYPIly-R1MJcs9zLUBNEM6eU";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $responseJson = curl_exec($ch);
            curl_close($ch);

            $response = json_decode($responseJson);

            if ($response->status == 'OK') {
                $latitude = $response->results[0]->geometry->location->lat;
                $longitude = $response->results[0]->geometry->location->lng;
            } else {
                $latitude = 0;
                $longitude = 0;
            }

            $timestamp1 = strtotime($startdate);
            $start_date = date('Y-m-d', $timestamp1);

            $timestamp2 = strtotime($enddate);
            $end_date = date('Y-m-d', $timestamp2);

            $timestamp3 = strtotime($starttime);
            $start_time = date('H:i:s', $timestamp3);

            $timestamp4 = strtotime($endtime);
            $end_time = date('H:i:s', $timestamp4);

            if (!empty($_FILES['featured_image']['name'])) {
                $featured_image = $this->uploadImg('featured_image', $_FILES['featured_image']['name']);
            } else {
                $featured_image = "";
            }

            $insertArr = array(
                'event_name'    => $event_name,
                'location_txt'  => $location_txt,
                'description'   => $description,
                'university'    => $university,
                'course'        => $course,
                'professor'     => $professor,
                'start_date'    => $start_date,
                'end_date'      => $end_date,
                'start_time'    => $start_time,
                'end_time'      => $end_time,
                'privacy'       => $privacy,
                'latitude'      => $latitude,
                'longitude'     => $longitude,
                'featured_image' => $featured_image,
                'status'        => 1,
                'created_by'    => $user_id,
                'created_at'    => date('Y-m-d H:i:s')
            );
            $this->db->insert('event_master', $insertArr);

            $insert_id = $this->db->insert_id();

            $insertRef = array(
                'reference'     => 'event',
                'reference_id'  => $insert_id,
                'user_id'       => $user_id,

                'status'        => 1,

                'addDate'       => date('Y-m-d H:i:s'),
                'modifyDate'    => date('Y-m-d H:i:s')
            );
            $this->db->insert('reference_master', $insertRef);

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Event Added Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('account/events'), 'refresh');
        }

        $this->load->view('user/include/header', $data);
        $this->load->view('user/events/add-event');
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/firebase-include');
        $this->load->view('user/events/footer');
    }


    public function eventDetails()
    {
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();

        $event_id = base64_decode($this->uri->segment('3'));
		$redirectType = ($this->uri->segment('4')) ? $this->uri->segment('4') : '';
		
		$data['redirectType'] = $redirectType; 
		
		$tabType = ($this->uri->segment('5')) ? $this->uri->segment('5') : '';
		$data['tabType'] = $tabType; 
		
        $data['event'] = $this->db->query("select * from event_master where id = " . $event_id . "")->row_array();
        $data['university'] = $this->db->get_where('university', array('university_id' => $data['event']['university']))->row_array();

        $data['comment'] = $this->db->get_where('comment_master', array('reference' => 'event', 'reference_id' => $event_id, 'comment_parent_id' => 0))->result_array();

        $data['index_menu']  = 'events';
        $data['title']  = 'Event Details | Studypeers';

        $this->load->view('user/include/header', $data);
        $this->load->view('user/events/event-details');
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/firebase-include');
        $this->load->view('user/events/footer-map');
    }


    public function editEvent()
    {
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();

        $event_id = base64_decode($this->uri->segment('3'));

        $data['event'] = $this->db->query("select * from event_master where id = " . $event_id . "")->row_array();
        $data['university'] = $this->db->get_where('university', array('university_id' => $data['event']['university']))->row_array();
        $data['course']     = $this->db->get_where('course_master', array('status' => 1, 'user_id' => $user_id))->result_array();
        $data['professor']     = $this->db->get_where('professor_master', array('status' => 1, 'course_id' => $data['event']['course']))->result_array();

        $data['index_menu']  = 'events';
        $data['title']  = 'Edit Event | Studypeers';

        if ($this->input->post()) {
            // print_r($this->input->post());die;
            $event_name       = $this->input->post('event_name');
            $location_txt  = $this->input->post('location_txt');
            $description    = $this->input->post('description');
            $university     = $this->input->post('university');
            $course         = $this->input->post('course');
            $professor      = $this->input->post('professor');
            $startdate      = $this->input->post('start-date');
            $enddate        = $this->input->post('end-date');
            $starttime      = $this->input->post('start-time');
            $endtime        = $this->input->post('end-time');

            $privacy        = $this->input->post('privacy');

            $timestamp1 = strtotime($startdate);
            $start_date = date('Y-m-d', $timestamp1);

            $timestamp2 = strtotime($enddate);
            $end_date = date('Y-m-d', $timestamp2);

            $timestamp3 = strtotime($starttime);
            $start_time = date('H:i:s', $timestamp3);

            $timestamp4 = strtotime($endtime);
            $end_time = date('H:i:s', $timestamp4);

            if (!empty($_FILES['featured_image']['name'])) {
                $featured_image = $this->uploadImg('featured_image', $_FILES['featured_image']['name']);
            } else {
                $featured_image = $this->input->post('old_featured_image');
            }

            $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($location_txt) . "&key=AIzaSyBNNCJ7_zDBYPIly-R1MJcs9zLUBNEM6eU";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $responseJson = curl_exec($ch);
            curl_close($ch);

            $response = json_decode($responseJson);

            if ($response->status == 'OK') {
                $latitude = $response->results[0]->geometry->location->lat;
                $longitude = $response->results[0]->geometry->location->lng;
            } else {
                $latitude = 0;
                $longitude = 0;
            }

            $uArr = array(
                'event_name'      => $event_name,
                'location_txt' => $location_txt,
                'description'   => $description,
                'university'    => $university,
                'course'        => $course,
                'professor'     => $professor,
                'start_date'    => $start_date,
                'end_date'      => $end_date,
                'privacy'       => $privacy,
                'start_time'    => $start_time,
                'featured_image'    => $featured_image,
                'end_time'      => $end_time,
                'latitude'      => $latitude,
                'longitude'     => $longitude
            );
            $this->db->where(array('id' => $event_id));
            $this->db->update('event_master', $uArr);

            $get_event = $this->db->query("select * from event_master where id = " . $event_id . " and status = 1")->row_array();
            if ($get_event['addedToCalender'] == 1) {
                $startdate  = $get_event['start_date'] . ' ' . $get_event['start_time'];
                $enddate    = $get_event['end_date'] . ' ' . $get_event['end_time'];
                $sArr = array(
                    'schedule_name'  => $event_name,
                    'location'      => $location_txt,
                    'description'   => $description,
                    'university'    => $university,
                    'course'        => $course,
                    'professor'     => $professor,
                    'start_date'    => $startdate,
                    'end_date'      => $enddate,
                    'latitude'      => $latitude,
                    'longitude'     => $longitude,
                    'featured_image'    => $featured_image,
                    'schedule'      => 'event'

                );

                $this->db->where(array('event_master_id' => $event_id));
                $this->db->update('schedule_master', $sArr);
            }

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Event Updated Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('account/events'), 'refresh');
        }

        $this->load->view('user/include/header', $data);
        $this->load->view('user/events/edit-event');
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/firebase-include');
        $this->load->view('user/events/footer');
    }

    public function deleteEvent()
    {
        if ($this->input->post()) {
            $event_id = $this->input->post('event_id');
            $this->db->where(array('id' => $event_id));
            $this->db->update('event_master', array('status' => 3));

            $event_details = $this->db->query("select * from event_master where id = " . $event_id . "")->row_array();
            if ($event_details['addedToCalender'] == 1) {
                $this->db->where(array('event_master_id' => $event_id));
                $this->db->update('schedule_master', array('status' => 3));
            }

            $this->db->where(array('reference_id' => $event_id, 'reference' => 'event'));
            $this->db->update('reference_master', array('status' => 3));

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Event Deleted Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('account/events'), 'refresh');
        }
    }

    public function deleteDocument()
    {
        if ($this->input->post()) {
            $document_id = $this->input->post('document_id');
            $this->db->where(array('id' => $document_id));
            $this->db->update('document_master', array('status' => 3));

            $this->db->where(array('reference_id' => $document_id, 'reference' => 'document'));
            $this->db->update('reference_master', array('status' => 3));

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Document Deleted Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('account/documents'), 'refresh');
        }
    }

    public function deleteQuestion()
    {

        if ($this->input->post()) {
            $question_id = $this->input->post('question_id');
            $this->db->where(array('id' => $question_id));
            $this->db->update('question_master', array('status' => 3));

            $this->db->where(array('reference_id' => $question_id, 'reference' => 'question'));
            $this->db->update('reference_master', array('status' => 3));

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Question Deleted Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('account/questions'), 'refresh');
        }
    }

    function peerList($user_id)
    {
        $peer_list = $this->db->query("SELECT * FROM `peer_master` WHERE (`user_id` = '" . $user_id . "' OR `peer_id` = '" . $user_id . "') AND `status` = 2")->result_array();
        $peer = array();
        foreach ($peer_list as $key => $value) {
            if ($value['user_id'] == $user_id) {
                $peer[$key] = $value['peer_id'];
            } else {
                $peer[$key] = $value['user_id'];
            }
        }
        return $peer;
    }


    public function documents()
    {
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['index_menu']  = 'documents';
        $data['title']  = 'Documents | Studypeers';



        $this->db->select('document_master.*,professor_master.name as professor,course_master.name as course, university.SchoolName, user_info.nickname');
        if ($this->input->get()) {
        } else {
            $this->db->from('document_master');
        }

        $this->db->join('professor_master', 'professor_master.id=document_master.professor');
        $this->db->join('course_master', 'course_master.id=document_master.course');
        $this->db->join('university', 'university.university_id=document_master.university');
        $this->db->join('user_info', 'user_info.userID=document_master.created_by');
        if ($this->input->get('sort-by', TRUE)) {
            $sort_by = $this->input->get('sort-by', TRUE);
            if ($sort_by == 'date') {
                $this->db->order_by('document_master.created_at', 'desc');
            } else if ($sort_by == 'name') {
                $this->db->order_by('document_master.document_name', 'desc');
            }
        } else {
            $this->db->order_by('document_master.id', 'desc');
        }




        if ($this->input->get()) {
            // print_r($this->input->get());die;
            if ($this->input->get('search')) {
                $keyword     = $this->input->get('keyword_search');
                $course     = $this->input->get('course_search');
                $professor  = $this->input->get('professor_search');
                $university = $this->input->get('university_search');
            } else {
                $course     = $this->input->get('course');
                $professor  = $this->input->get('professor');
                $university = $this->input->get('university');
                $keyword     = $this->input->get('keyword');
            }
            if (!empty($keyword)) {
                $this->db->group_start();
                $this->db->like('document_master.document_name', $keyword);
                $this->db->group_end();
            }
            if (!empty($university) && !empty($course)) {
                $data['document_list'] = $this->db->get_where($this->db->dbprefix('document_master'), array('document_master.created_by' => $user_id, 'document_master.status' => 1, 'document_master.university' => $university, 'document_master.course' => $course))->result_array();
                $data['professor']     = $this->db->get_where('professor_master', array('status' => 1, 'course_id' => $course))->result_array();
            } else if (!empty($university) && empty($course)) {
                $data['document_list'] = $this->db->get_where($this->db->dbprefix('document_master'), array('document_master.created_by' => $user_id, 'document_master.status' => 1, 'document_master.university' => $university))->result_array();
                $data['professor']     = array();
            } else {
                $data['document_list'] = $this->db->get_where($this->db->dbprefix('document_master'), array('document_master.created_by' => $user_id, 'document_master.status' => 1))->result_array();
                $data['professor']     = array();
            }
        } else {
            $this->db->where(array('document_master.created_by' => $user_id, 'document_master.status' => 1));
            $this->db->or_group_start();
            $this->db->where("document_master.`id` IN (SELECT `reference_id` FROM `share_master` where `reference` = 'document' and status = 1 and peer_id = " . $user_id . ")", NULL, FALSE);
            $this->db->group_end();
            $data['document_list'] = $this->db->get()->result_array();
            $data['professor']     = array();
        }


        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();
        $data['university'] = $this->db->get_where('university', array('university_id' => $data['user_info']['intitutionID']))->row_array();
        $data['course']     = $this->db->get_where('course_master', array('status' => 1, 'user_id' => $user_id))->result_array();

        $this->load->view('user/include/header', $data);
        $this->load->view('user/documents/documents-list');
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/firebase-include');
        $this->load->view('user/include/footer');
    }

    public function removeSharedDoc()
    {
        $id = $this->input->post('id');
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $this->db->where(array('reference_id' => $id, 'reference' => 'document', 'peer_id' => $user_id));
        $result = $this->db->update('share_master', array('status' => 3));
        echo 1;
        die;
    }


    public function addDocument()
    {
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();
        $data['university'] = $this->db->get_where('university', array('university_id' => $data['user_info']['intitutionID']))->row_array();
        $data['course']     = $this->db->get_where('course_master', array('status' => 1, 'user_id' => $user_id))->result_array();
        $data['index_menu']  = 'documents';
        $data['title']  = 'Add Document | Studypeers';

        if ($this->input->post()) {
            // print_r($this->input->post());die;
            $document_name     = $this->input->post('document_name');
            $description    = $this->input->post('description');
            $university     = $this->input->post('university');
            $course         = $this->input->post('course');
            $professor      = $this->input->post('professor');
            $privacy        = $this->input->post('privacy');

            if (!empty($_FILES['featured_image']['name'])) {
                $featured_image = $this->uploadImg('featured_image', $_FILES['featured_image']['name']);
            } else {
                $featured_image = "";
            }

            $insertArr = array(
                'document_name' => $document_name,
                'description'   => $description,
                'university'    => $university,
                'course'        => $course,
                'professor'     => $professor,
                'privacy'       => $privacy,
                'featured_image' => $featured_image,
                'status'        => 1,
                'created_by'    => $user_id,
                'created_at'    => date('Y-m-d H:i:s')
            );
            $this->db->insert('document_master', $insertArr);

            $insert_id = $this->db->insert_id();

            $insertRef = array(
                'reference'     => 'document',
                'reference_id'  => $insert_id,
                'user_id'       => $user_id,

                'status'        => 1,

                'addDate'       => date('Y-m-d H:i:s'),
                'modifyDate'    => date('Y-m-d H:i:s')
            );
            $this->db->insert('reference_master', $insertRef);

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Document Added Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('account/documents'), 'refresh');
        }

        $this->load->view('user/include/header', $data);
        $this->load->view('user/documents/add-document');
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/firebase-include');
        $this->load->view('user/include/footer');
    }

    public function documentDetail()
    {
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();

        $document_id = base64_decode($this->uri->segment('3'));
		$redirectType = ($this->uri->segment('4')) ? $this->uri->segment('4') : '';
		$tabType = ($this->uri->segment('5')) ? $this->uri->segment('5') : '';
		
		$data['redirectType'] = $redirectType;
		$data['tabType']      = $tabType;

        $data['index_menu']  = 'documents';
        $data['title']  = 'Document Details | Studypeers';

        $this->db->select('document_master.*,professor_master.name as professor,course_master.name as course, university.SchoolName, user_info.nickname');
        $this->db->join('professor_master', 'professor_master.id=document_master.professor');
        $this->db->join('course_master', 'course_master.id=document_master.course');
        $this->db->join('university', 'university.university_id=document_master.university');
        $this->db->join('user_info', 'user_info.userID=document_master.created_by');
        $this->db->order_by('document_master.id', 'desc');
        $data['result'] = $this->db->get_where($this->db->dbprefix('document_master'), array('document_master.id' => $document_id, 'document_master.status' => 1))->row_array();

        $data['comment'] = $this->db->get_where('comment_master', array('reference' => 'document', 'reference_id' => $document_id, 'comment_parent_id' => 0))->result_array();

        $this->db->select('document_rating_master.*, user_info.nickname');
        $this->db->join('user_info', 'user_info.userID=document_rating_master.user_id');
        $this->db->order_by('document_rating_master.created_at', 'desc');
        $this->db->limit(5);
        $data['rating_list'] = $this->db->get_where('document_rating_master', array('document_rating_master.document_id' => $document_id, 'document_rating_master.user_id !=' => $user_id))->result_array();


        $data['user_rating'] = $this->db->get_where('document_rating_master', array('document_rating_master.document_id' => $document_id, 'user_id' => $user_id))->row_array();

        $this->load->view('user/include/header', $data);
        $this->load->view('user/documents/document-details');
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/firebase-include');
        $this->load->view('user/include/footer');
    }

    function rateDocument()
    {
        if ($this->input->post()) {
            // print_r($this->input->post());die;
            $user_rating        = $this->input->post('user_rating');
            $rate_description   = $this->input->post('rate_description');
            $if_anonymous       = $this->input->post('if_anonymous');
            $rate_document      = $this->input->post('rate_document');

            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $chk_if_rated = $this->db->get_where('document_rating_master', array('document_id' => $rate_document, 'user_id' => $user_id))->row_array();

            if (!empty($chk_if_rated)) {
                $this->db->where(array('id' => $chk_if_rated['id']));
                $this->db->update('document_rating_master', array('rating' => $user_rating, 'description' => $rate_description, 'created_at' => date('Y-m-d H:i:s')));
            } else {

                $insertArr = array(
                    'document_id'      => $rate_document,
                    'user_id'           => $user_id,
                    'rating'            => $user_rating,
                    'description'       => $rate_description,
                    'if_anonymous'      => $if_anonymous,
                    'created_at'        => date('Y-m-d H:i:s')
                );
                $this->db->insert('document_rating_master', $insertArr);
            }

            redirect(site_url('account/documentDetail/' . base64_encode($rate_document)), 'refresh');
        }
    }


    public function editDocument()
    {
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();

        $document_id = base64_decode($this->uri->segment('3'));

        $data['index_menu']  = 'documents';
        $data['title']  = 'Edit Document | Studypeers';

        $this->db->select('document_master.*');

        $data['result'] = $this->db->get_where($this->db->dbprefix('document_master'), array('document_master.id' => $document_id, 'document_master.status' => 1))->row_array();

        $data['university'] = $this->db->get_where('university', array('university_id' => $data['user_info']['intitutionID']))->row_array();
        $data['course']     = $this->db->get_where('course_master', array('status' => 1, 'user_id' => $user_id))->result_array();
        $data['professor']     = $this->db->get_where('professor_master', array('status' => 1, 'course_id' => $data['result']['course']))->result_array();

        if ($this->input->post()) {
            // print_r($this->input->post());die;
            $document_name     = $this->input->post('document_name');
            $description    = $this->input->post('description');
            $university     = $this->input->post('university');
            $course         = $this->input->post('course');
            $professor      = $this->input->post('professor');
            $privacy        = $this->input->post('privacy');


            if (!empty($_FILES['featured_image']['name'])) {
                $featured_image = $this->uploadImg('featured_image', $_FILES['featured_image']['name']);
            } else {
                $featured_image = $this->input->post('featured_image_old');
            }

            $insertArr = array(
                'document_name' => $document_name,
                'description'   => $description,
                'university'    => $university,
                'course'        => $course,
                'professor'     => $professor,
                'privacy'       => $privacy,
                'featured_image' => $featured_image
            );

            $this->db->where(array('id' => $document_id));
            $this->db->update('document_master', $insertArr);

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Document Added Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('account/documents'), 'refresh');
        }

        $this->load->view('user/include/header', $data);
        $this->load->view('user/documents/document-edit');
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/firebase-include');
        $this->load->view('user/include/footer');
    }

    public function questions()
    {
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['index_menu']  = 'questions';
        $data['title']  = 'Questions & Answers | Studypeers';

        $sort_by = '';

        $this->db->select('question_master.*,professor_master.name as professor,course_master.name as course, university.SchoolName, user_info.nickname');
        $this->db->join('professor_master', 'professor_master.id=question_master.professor');
        $this->db->join('course_master', 'course_master.id=question_master.course');
        $this->db->join('university', 'university.university_id=question_master.university');
        $this->db->join('user_info', 'user_info.userID=question_master.created_by');
        if ($this->input->get('sort-by', TRUE)) {
            $sort_by = $this->input->get('sort-by', TRUE);
            if ($sort_by == 'date') {
                $this->db->order_by('question_master.created_at', 'desc');
            } else if ($sort_by == 'name') {
                $this->db->order_by('question_master.question_title', 'desc');
            } else if ($sort_by == 'views') {
                $this->db->order_by('question_master.view_count', 'desc');
            } else if ($sort_by == 'answers') {
                $this->db->reset_query();
                $data['question_list'] = $this->db->query("SELECT `question_master`.*, `professor_master`.`name` as `professor`, `course_master`.`name` as `course`, `university`.`SchoolName`, `user_info`.`nickname`,(select count(`question_answer_master`.id) from question_answer_master where `question_answer_master`.question_id = `question_master`.id AND `question_answer_master`.parent_id = 0) as ansCount FROM `question_master` JOIN `professor_master` ON `professor_master`.`id`=`question_master`.`professor` JOIN `course_master` ON `course_master`.`id`=`question_master`.`course` JOIN `university` ON `university`.`university_id`=`question_master`.`university` JOIN `user_info` ON `user_info`.`userID`=`question_master`.`created_by` WHERE `question_master`.`created_by` = '" . $user_id . "' AND `question_master`.`status` = 1 ORDER BY ansCount DESC")->result_array();
            }
        } else {
            $this->db->order_by('question_master.id', 'desc');
        }
        if ($this->input->get('sort-by', TRUE)) {
            if ($sort_by != 'answers') {
                $data['question_list'] = $this->db->get_where($this->db->dbprefix('question_master'), array('question_master.created_by' => $user_id, 'question_master.status' => 1))->result_array();
            }
        } else if ($this->input->get()) {
            // print_r($this->input->get());die;
            if ($this->input->get('search')) {
                $keyword     = $this->input->get('keyword_search');
                $course     = $this->input->get('course_search');
                $professor  = $this->input->get('professor_search');
                $university = $this->input->get('university_search');
                $category   = $this->input->get('category_search');
            } else {
                $course     = $this->input->get('course');
                $professor  = $this->input->get('professor');
                $university = $this->input->get('university');
                $category   = $this->input->get('category');
                $keyword     = $this->input->get('keyword');
            }
            if (!empty($keyword)) {
                $this->db->group_start();
                $this->db->like('question_master.question_title', $keyword);
                $this->db->group_end();
            }
            if (!empty($university) && !empty($course)) {
                if (empty($category)) {
                    $data['question_list'] = $this->db->get_where($this->db->dbprefix('question_master'), array('question_master.created_by' => $user_id, 'question_master.status' => 1, 'question_master.university' => $university, 'question_master.course' => $course))->result_array();
                } else if ($category == 'active' || $category == 'unsolved') {
                    $data['question_list'] = $this->db->get_where($this->db->dbprefix('question_master'), array('question_master.created_by' => $user_id, 'question_master.status' => 1, 'question_master.university' => $university, 'question_master.course' => $course, 'question_master.is_solved' => 0))->result_array();
                } else if ($category == 'unanswered') {
                    $data['question_list'] = $this->db->get_where($this->db->dbprefix('question_master'), array('question_master.created_by' => $user_id, 'question_master.status' => 1, 'question_master.university' => $university, 'question_master.course' => $course, 'question_master.is_solved' => 0))->result_array();
                }
                $data['professor']     = $this->db->get_where('professor_master', array('status' => 1, 'course_id' => $course))->result_array();
            } else if (!empty($university) && empty($course)) {
                if (empty($category)) {
                    $data['question_list'] = $this->db->get_where($this->db->dbprefix('question_master'), array('question_master.created_by' => $user_id, 'question_master.status' => 1, 'question_master.university' => $university))->result_array();
                } else if ($category == 'active' || $category == 'unsolved') {
                    $data['question_list'] = $this->db->get_where($this->db->dbprefix('question_master'), array('question_master.created_by' => $user_id, 'question_master.status' => 1, 'question_master.university' => $university, 'question_master.is_solved' => 0))->result_array();
                } else if ($category == 'unanswered') {
                    $question_list = $this->db->get_where($this->db->dbprefix('question_master'), array('question_master.created_by' => $user_id, 'question_master.status' => 1, 'question_master.university' => $university))->result_array();
                    $data['question_list'] = array();
                    foreach ($question_list as $key => $value) {
                        $chk_if_ans = $this->db->get_where($this->db->dbprefix('question_answer_master'), array('question_id' => $value['id'], 'status' => 1, 'parent_id' => 0))->num_rows();
                        if ($chk_if_ans == 0) {
                            array_push($data['question_list'], $value);
                        }
                    }
                }
                $data['professor']     = array();
            } else {
                if (empty($category)) {
                    $data['question_list'] = $this->db->get_where($this->db->dbprefix('question_master'), array('question_master.created_by' => $user_id, 'question_master.status' => 1))->result_array();
                } else if ($category == 'active' || $category == 'unsolved') {
                    $data['question_list'] = $this->db->get_where($this->db->dbprefix('question_master'), array('question_master.created_by' => $user_id, 'question_master.status' => 1, 'question_master.is_solved' => 0))->result_array();
                } else if ($category == 'unanswered') {
                    $question_list = $this->db->get_where($this->db->dbprefix('question_master'), array('question_master.created_by' => $user_id, 'question_master.status' => 1))->result_array();
                    $data['question_list'] = array();
                    foreach ($question_list as $key => $value) {
                        $chk_if_ans = $this->db->get_where($this->db->dbprefix('question_answer_master'), array('question_id' => $value['id'], 'status' => '1', 'parent_id' => '0'))->num_rows();
                        if ($chk_if_ans == 0) {
                            array_push($data['question_list'], $value);
                        }
                    }
                }
                $data['professor']     = array();
            }
        } else {

            $data['question_list'] = $this->db->get_where($this->db->dbprefix('question_master'), array('question_master.created_by' => $user_id, 'question_master.status' => 1))->result_array();

            $data['professor']     = array();
        }


        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();
        $data['university'] = $this->db->get_where('university', array('university_id' => $data['user_info']['intitutionID']))->row_array();
        $data['course']     = $this->db->get_where('course_master', array('status' => 1, 'user_id' => $user_id))->result_array();

        $this->load->view('user/include/header', $data);
        $this->load->view('user/questions/questions-list');
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/firebase-include');
        $this->load->view('user/include/footer');
    }


    public function addQuestion()
    {
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();
        $data['university'] = $this->db->get_where('university', array('university_id' => $data['user_info']['intitutionID']))->row_array();
        $data['course']     = $this->db->get_where('course_master', array('status' => 1, 'user_id' => $user_id))->result_array();
        $data['index_menu']  = 'questions';
        $data['title']  = 'Add Question | Studypeers';

        if ($this->input->post()) {
            // print_r($this->input->post());die;
            $question_title     = $this->input->post('question_title');
            $university         = $this->input->post('university');
            $course             = $this->input->post('course');
            $professor          = $this->input->post('professor');
            $textarea           = $this->input->post('textarea');


            $insertArr = array(
                'question_title' => $question_title,
                'university'    => $university,
                'course'        => $course,
                'professor'     => $professor,

                'textarea'      => $textarea,
                'status'        => 1,
                'created_by'    => $user_id,
                'created_at'    => date('Y-m-d H:i:s')
            );
            $this->db->insert('question_master', $insertArr);

            $insert_id = $this->db->insert_id();

            $insertRef = array(
                'reference'     => 'question',
                'reference_id'  => $insert_id,
                'user_id'       => $user_id,

                'status'        => 1,

                'addDate'       => date('Y-m-d H:i:s'),
                'modifyDate'    => date('Y-m-d H:i:s')
            );
            $this->db->insert('reference_master', $insertRef);

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Question Added Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('account/questions'), 'refresh');
        }

        $this->load->view('user/include/header', $data);
        $this->load->view('user/questions/add-question');
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/firebase-include');
        $this->load->view('user/include/footer');
    }


    public function questionDetail()
    {
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();

        $question_id = base64_decode($this->uri->segment('3'));
		$redirectType = ($this->uri->segment('4')) ? $this->uri->segment('4') : '';
		$tabType = ($this->uri->segment('5')) ? $this->uri->segment('5') : '';
		
		$data['redirectType'] = $redirectType;
		$data['tabType']      = $tabType;

        $data['index_menu']  = 'questions';
        $data['title']  = 'Question Details | Studypeers';

        $this->db->query("UPDATE question_master SET view_count = view_count + 1 WHERE id = " . $question_id . "");

        $this->db->select('question_master.*,professor_master.name as professor,course_master.name as course, university.SchoolName, user_info.nickname');
        $this->db->join('professor_master', 'professor_master.id=question_master.professor');
        $this->db->join('course_master', 'course_master.id=question_master.course');
        $this->db->join('university', 'university.university_id=question_master.university');
        $this->db->join('user_info', 'user_info.userID=question_master.created_by');
        $this->db->order_by('question_master.id', 'desc');
        $data['result'] = $this->db->get_where($this->db->dbprefix('question_master'), array('question_master.id' => $question_id, 'question_master.status' => 1))->row_array();




        $this->db->select('question_answer_master.*, user_info.nickname');
        $this->db->join('user_info', 'user_info.userID=question_answer_master.answered_by');
        if ($this->input->get('sort-by', TRUE)) {
            $sort_by = $this->input->get('sort-by', TRUE);
            if ($sort_by == 'date') {
                $this->db->order_by('question_answer_master.created_at', 'desc');
            } else if ($sort_by == 'vote') {
                $this->db->order_by('question_answer_master.vote_count', 'desc');
            }
        } else {
            $this->db->order_by('question_answer_master.best_answer', 'desc');
        }

        $data['answer_list'] = $this->db->get_where($this->db->dbprefix('question_answer_master'), array('question_answer_master.question_id' => $question_id, 'question_answer_master.status' => 1, 'question_answer_master.parent_id' => 0))->result_array();

        $this->load->view('user/include/header', $data);
        $this->load->view('user/questions/question-details');
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/firebase-include');
        $this->load->view('user/include/footer');
    }


    public function editQuestion()
    {
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();

        $question_id = base64_decode($this->uri->segment('3'));

        $data['index_menu']  = 'questions';
        $data['title']  = 'Edit Question | Studypeers';

        $this->db->select('question_master.*');

        $data['result'] = $this->db->get_where($this->db->dbprefix('question_master'), array('question_master.id' => $question_id, 'question_master.status' => 1))->row_array();


        $data['university'] = $this->db->get_where('university', array('university_id' => $data['user_info']['intitutionID']))->row_array();
        $data['course']     = $this->db->get_where('course_master', array('status' => 1, 'user_id' => $user_id))->result_array();
        $data['professor']     = $this->db->get_where('professor_master', array('status' => 1, 'course_id' => $data['result']['course']))->result_array();

        if ($this->input->post()) {
            // print_r($this->input->post());die;
            $question_title     = $this->input->post('question_title');
            $university         = $this->input->post('university');
            $course             = $this->input->post('course');
            $professor          = $this->input->post('professor');
            $textarea           = $this->input->post('textarea');


            $insertArr = array(
                'question_title' => $question_title,
                'university'    => $university,
                'course'        => $course,
                'professor'     => $professor,

                'textarea'      => $textarea
            );

            $this->db->where(array('id' => $question_id));
            $this->db->update('question_master', $insertArr);

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Question Updated Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('account/questions'), 'refresh');
        }


        $this->load->view('user/include/header', $data);
        $this->load->view('user/questions/question-edit');
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/firebase-include');
        $this->load->view('user/include/footer');
    }

    public function voteAnswer()
    {
        if ($this->input->post()) {
            $answer_id     = $this->input->post('answer_id');
            $type       = $this->input->post('type');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $chk_if_liked = $this->db->get_where($this->db->dbprefix('vote_master'), array('reference' => 'answer', 'reference_id' => $answer_id, 'user_id' => $user_id))->row_array();

            if (!empty($chk_if_liked)) {
                $this->db->where(array('reference' => 'answer', 'reference_id' => $answer_id, 'user_id' => $user_id));
                $this->db->delete('vote_master');
                if ($type == 'upvote') {
                    $this->db->query("UPDATE question_answer_master SET vote_count = vote_count + 1 WHERE id = " . $answer_id . "");
                } else {
                    $this->db->query("UPDATE question_answer_master SET vote_count = vote_count - 1 WHERE id = " . $answer_id . "");
                }
            }


            if ($type == 'upvote') {
                $insertArr = array(
                    'reference'     => 'answer',
                    'reference_id'  => $answer_id,
                    'user_id'       => $user_id,

                    'type'          => 1, // upvote
                    'created_at'    => date('Y-m-d H:i:s')
                );
                $this->db->insert('vote_master', $insertArr);

                $this->db->query("UPDATE question_answer_master SET vote_count = vote_count + 1 WHERE id = " . $answer_id . "");
            } else {
                $insertArr = array(
                    'reference'     => 'answer',
                    'reference_id'  => $answer_id,
                    'user_id'       => $user_id,

                    'type'          => 2, // downvote
                    'created_at'    => date('Y-m-d H:i:s')
                );
                $this->db->insert('vote_master', $insertArr);

                $this->db->query("UPDATE question_answer_master SET vote_count = vote_count - 1 WHERE id = " . $answer_id . "");
            }
            $detail = $this->db->get_where($this->db->dbprefix('question_answer_master'), array('id' => $answer_id))->row_array();
            if ($detail['vote_count'] < 0) {
                echo 0;
                die;
            } else {
                echo $detail['vote_count'];
                die;
            }
        }
    }

    public function voteQuestion()
    {

        if ($this->input->post()) {
            $question_id     = $this->input->post('question_id');
            $type       = $this->input->post('type');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $chk_if_liked = $this->db->get_where($this->db->dbprefix('vote_master'), array('reference' => 'question', 'reference_id' => $question_id, 'user_id' => $user_id))->row_array();

            if (!empty($chk_if_liked)) {
                $this->db->where(array('reference' => 'question', 'reference_id' => $question_id, 'user_id' => $user_id));
                $this->db->delete('vote_master');
                if ($type == 'upvote') {
                    $this->db->query("UPDATE question_master SET vote_count = vote_count + 1 WHERE id = " . $question_id . "");
                } else {
                    $this->db->query("UPDATE question_master SET vote_count = vote_count - 1 WHERE id = " . $question_id . "");
                }
            }


            if ($type == 'upvote') {
                $insertArr = array(
                    'reference'     => 'question',
                    'reference_id'  => $question_id,
                    'user_id'       => $user_id,

                    'type'          => 1, // upvote
                    'created_at'    => date('Y-m-d H:i:s')
                );
                $this->db->insert('vote_master', $insertArr);

                $this->db->query("UPDATE question_master SET vote_count = vote_count + 1 WHERE id = " . $question_id . "");
            } else {
                $insertArr = array(
                    'reference'     => 'question',
                    'reference_id'  => $question_id,
                    'user_id'       => $user_id,

                    'type'          => 2, // downvote
                    'created_at'    => date('Y-m-d H:i:s')
                );
                $this->db->insert('vote_master', $insertArr);

                $this->db->query("UPDATE question_master SET vote_count = vote_count - 1 WHERE id = " . $question_id . "");
            }
            $detail = $this->db->get_where($this->db->dbprefix('question_master'), array('id' => $question_id))->row_array();
            if ($detail['vote_count'] < 0) {
                echo 0;
                die;
            } else {
                echo $detail['vote_count'];
                die;
            }
        }
    }

    public function removeVoteAnswer()
    {
        if ($this->input->post()) {
            $answer_id     = $this->input->post('answer_id');
            $type       = $this->input->post('type');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $this->db->where(array('reference' => 'answer', 'reference_id' => $answer_id, 'user_id' => $user_id));
            $this->db->delete('vote_master');


            if ($type == 'upvote') {
                $this->db->query("UPDATE question_answer_master SET vote_count = vote_count - 1 WHERE id = " . $answer_id . "");
            } else {
                $this->db->query("UPDATE question_answer_master SET vote_count = vote_count + 1 WHERE id = " . $answer_id . "");
            }
            $detail = $this->db->get_where($this->db->dbprefix('question_answer_master'), array('id' => $answer_id))->row_array();
            if ($detail['vote_count'] < 0) {
                echo 0;
                die;
            } else {
                echo $detail['vote_count'];
                die;
            }
        }
    }

    public function removeVoteQuestion()
    {
        if ($this->input->post()) {
            $question_id     = $this->input->post('question_id');
            $type       = $this->input->post('type');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $this->db->where(array('reference' => 'question', 'reference_id' => $question_id, 'user_id' => $user_id));
            $this->db->delete('vote_master');


            if ($type == 'upvote') {
                $this->db->query("UPDATE question_master SET vote_count = vote_count - 1 WHERE id = " . $question_id . "");
            } else {
                $this->db->query("UPDATE question_master SET vote_count = vote_count + 1 WHERE id = " . $question_id . "");
            }
            $detail = $this->db->get_where($this->db->dbprefix('question_master'), array('id' => $question_id))->row_array();
            if ($detail['vote_count'] < 0) {
                echo 0;
                die;
            } else {
                echo $detail['vote_count'];
                die;
            }
        }
    }


    public function submitAnswer()
    {
        if ($this->input->post()) {
            $question_id   = $this->input->post('question_id');
            $answer   = $this->input->post('answer');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $insertArr = array(
                'question_id'   => $question_id,
                'answer'        => $answer,
                'answered_by'   => $user_id,

                'status'        => 1,
                'created_at'    => date('Y-m-d H:i:s')
            );
            $this->db->insert('question_answer_master', $insertArr);

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Answer Added Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('account/questionDetail/' . base64_encode($question_id)), 'refresh');
        }
    }


    public function submitQuestionAnswer()
    {
        if ($this->input->post()) {
            $question_id   = $this->input->post('question_id');
            $answer   = $this->input->post('answer');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $insertArr = array(
                'question_id'   => $question_id,
                'answer'        => $answer,
                'answered_by'   => $user_id,

                'status'        => 1,
                'created_at'    => date('Y-m-d H:i:s')
            );
            $this->db->insert('question_answer_master', $insertArr);

            $this->db->select('question_answer_master.*, user_info.nickname');
            $this->db->join('user_info', 'user_info.userID=question_answer_master.answered_by');
            $this->db->order_by('question_answer_master.id', 'desc');

            $value = $this->db->get_where($this->db->dbprefix('question_answer_master'), array('question_answer_master.question_id' => $question_id, 'question_answer_master.status' => 1, 'question_answer_master.parent_id' => 0))->row_array();

            $value_user = $this->db->get_where($this->db->dbprefix('user'), array('id' => $value['answered_by']))->row_array();


            $html = '<div class="replyAnswerBox" id="replyAnswerBox' . $value['id'] . '">     

                            <div class="answerQuote" id="answerQuote' . $value['id'] . '" style="display:none;">
                                <ul>
                                    <li>
                                        <a>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14.625" viewBox="0 0 16 14.625">
                                                <path id="prefix__star" d="M7.432 21.6a.889.889 0 0 1 1.219-.287.864.864 0 0 1 .287.287L11 24.943a.878.878 0 0 0 .575.4l3.91.8a.884.884 0 0 1 .689 1.045.911.911 0 0 1-.222.431l-2.613 2.767a.884.884 0 0 0-.235.7l.4 3.737a.885.885 0 0 1-.787.974.9.9 0 0 1-.434-.062l-3.75-1.565a.876.876 0 0 0-.68 0L4.1 35.743a.883.883 0 0 1-1.219-.911l.4-3.737a.9.9 0 0 0-.235-.7l-2.615-2.77a.884.884 0 0 1 .036-1.251.869.869 0 0 1 .433-.223l3.91-.8a.89.89 0 0 0 .575-.4z" transform="translate(-.189 -21.185)" style="fill:#185aeb"/>
                                            </svg>
                                            Best answer
                                        </a>
                                    </li>
                                </ul>
                            </div>  
                                
                                <div class="feedVoteWrap">
                                    <div class="voteCount">
                                        <div class="uparrow" id="uparrow_' . $value['id'] . '">
                                            <svg xmlns="http://www.w3.org/2000/svg"  class="normalState" width="18.363" height="20" viewBox="0 0 18.363 20" onclick="voteAnswer(\'upvote\', ' . $value['id'] . ')" style="">
                                                <g id="prefix__up-arrow" transform="translate(-31.008 -10.925)">
                                                    <path id="prefix__Path_1209" d="M37.272 29.256h5.6v-9.1a.83.83 0 0 1 .828-.833h2.828l-6.358-6.387-6.35 6.383h2.62a.83.83 0 0 1 .828.833v9.1zm6.428 1.669h-7.26a.83.83 0 0 1-.828-.833v-9.1H31.82a.844.844 0 0 1-.588-1.424l8.358-8.4a.845.845 0 0 1 1.171 0l8.354 8.4a.823.823 0 0 1-.588 1.424h-4v9.1a.825.825 0 0 1-.827.833z" data-name="Path 1209" />
                                                </g>
                                            </svg>                                      
                                            <svg xmlns="http://www.w3.org/2000/svg"  class="activeState" width="18.363" height="20" viewBox="0 0 18.363 20" style="<?= $up_active_s; ?>" onclick="removeVoteAnswer(\'upvote\', ' . $value['id'] . ')">
                                                <g id="prefix__Layer_1" transform="translate(-31.008 -10.925)">
                                                    <g id="prefix__Group_1371" data-name="Group 1371" transform="translate(31.008 10.925)">
                                                        <path id="prefix__Path_1213" d="M43.7 30.925h-7.26a.83.83 0 0 1-.828-.833v-9.1H31.82a.844.844 0 0 1-.588-1.424l8.358-8.4a.845.845 0 0 1 1.171 0l8.354 8.4a.823.823 0 0 1-.588 1.424h-4v9.1a.825.825 0 0 1-.828.833z" data-name="Path 1213" transform="translate(-31.008 -10.925)" style="fill:#1ae1bd"/>
                                                    </g>
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="countt" id="count_' . $value['id'] . '">
                                            0
                                        </div>
                                        <div class="downarrow" id="downarrow_' . $value['id'] . '">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18.363" height="20" class="normalState" viewBox="0 0 18.363 20" onclick="voteAnswer(\'downvote\', ' . $value['id'] . ')" style="">
                                                <g id="prefix__up-arrow" transform="rotate(180 24.686 15.463)">
                                                    <path id="prefix__Path_1209" d="M37.272 29.256h5.6v-9.1a.83.83 0 0 1 .828-.833h2.828l-6.358-6.387-6.35 6.383h2.62a.83.83 0 0 1 .828.833v9.1zm6.428 1.669h-7.26a.83.83 0 0 1-.828-.833v-9.1H31.82a.844.844 0 0 1-.588-1.424l8.358-8.4a.845.845 0 0 1 1.171 0l8.354 8.4a.823.823 0 0 1-.588 1.424h-4v9.1a.825.825 0 0 1-.827.833z" data-name="Path 1209" />
                                                </g>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg"  class="activeState" width="18.363" height="20" viewBox="0 0 18.363 20" style="<?= $down_active_s; ?>" onclick="removeVoteAnswer(\'downvote\', ' . $value['id'] . ')">
                                                <g id="prefix__Layer_1" transform="rotate(180 24.686 15.463)">
                                                    <g id="prefix__Group_1371" data-name="Group 1371" transform="translate(31.008 10.925)">
                                                        <path id="prefix__Path_1213" d="M43.7 30.925h-7.26a.83.83 0 0 1-.828-.833v-9.1H31.82a.844.844 0 0 1-.588-1.424l8.358-8.4a.845.845 0 0 1 1.171 0l8.354 8.4a.823.823 0 0 1-.588 1.424h-4v9.1a.825.825 0 0 1-.828.833z" data-name="Path 1213" transform="translate(-31.008 -10.925)" />
                                                    </g>
                                                </g>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="feed-card list">
                                        <div class="right">
                                            <div class="feed_card_inner">
                                                <p>' . $value['answer'] . '</p>
                                            </div>
                                            <div class="feed_card_footer">
                                                <div class="userWrap study-sets">
                                                    <div class="user-name">
                                                        <figure>
                                                            <img src="' . userImage($value['answered_by']) . '" alt="user">
                                                        </figure>
                                                        <a href="' . base_url() . 'sp/' . $value_user['username'] . '"><figcaption>' . $value['nickname'] . '</figcaption></a>
                                                    </div>
                                                    <p class="date">' . date('d/m/Y', strtotime($value['created_at'])) . '</p>
                                                </div>
                                                <div class="action">
                                                    <ul>
                                                        <li>
                                                            <a href="' . base_url() . 'account/questionDetail/' . base64_encode($question_id) . '" target="_blank">
                                                                <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M14.062 257.94L190.06 433.88c30.21 30.21 81.94 8.7 81.94-33.94v-78.28c146.59 8.54 158.53 50.199 134.18 127.879-13.65 43.56 35.07 78.89 72.19 54.46C537.98 464.768 576 403.8 576 330.05c0-170.37-166.04-197.15-304-201.3V48.047c0-42.72-51.79-64.09-81.94-33.94L14.062 190.06c-18.75 18.74-18.75 49.14 0 67.88zM48 224L224 48v128.03c143.181.63 304 11.778 304 154.02 0 66.96-40 109.95-76.02 133.65C501.44 305.911 388.521 273.88 224 272.09V400L48 224z"></path></svg>
                                                                Reply
                                                            </a>
                                                        </li>
                                                         
                                                            <li id="bestAnswerModal' . $value['id'] . '" class="bestAnswerli">
                                                                <a data-toggle="modal" data-target="#confirmationModalBestAnswer" data-id="' . $value['id'] . '" data-value="' . $question_id . '" class="select_best_answer_dashboard">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14.625" viewBox="0 0 16 14.625">
                                                                        <path id="prefix__star" d="M7.432 21.6a.889.889 0 0 1 1.219-.287.864.864 0 0 1 .287.287L11 24.943a.878.878 0 0 0 .575.4l3.91.8a.884.884 0 0 1 .689 1.045.911.911 0 0 1-.222.431l-2.613 2.767a.884.884 0 0 0-.235.7l.4 3.737a.885.885 0 0 1-.787.974.9.9 0 0 1-.434-.062l-3.75-1.565a.876.876 0 0 0-.68 0L4.1 35.743a.883.883 0 0 1-1.219-.911l.4-3.737a.9.9 0 0 0-.235-.7l-2.615-2.77a.884.884 0 0 1 .036-1.251.869.869 0 0 1 .433-.223l3.91-.8a.89.89 0 0 0 .575-.4z" transform="translate(-.189 -21.185)" style="fill:#185aeb"/>
                                                                    </svg>
                                                                    Select best answer
                                                                </a>
                                                            </li>
                                                        
                                                        <li class="report">
                                                            <a href="#" class="transAction reportQuestionAnswerDashboard" data-toggle="modal" data-target="#reportModal" data-id="' . $value['id'] . '" data-value="' . $question_id . '">                                                          
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                                                    <path id="prefix__flag" d="M10.505 2.5c-1.535 0-2.916-1-5.06-1a6.936 6.936 0 0 0-2.523.474A1.5 1.5 0 1 0 .75 2.8v12.7a.5.5 0 0 0 .5.5h.5a.5.5 0 0 0 .5-.5v-2.608A8.6 8.6 0 0 1 6.245 12c1.535 0 2.916 1 5.06 1a7.26 7.26 0 0 0 4.017-1.249A1.5 1.5 0 0 0 16 10.5V3a1.5 1.5 0 0 0-2.091-1.379 8.938 8.938 0 0 1-3.404.879zm3.995 8a5.878 5.878 0 0 1-3.2 1c-1.873 0-3.188-1-5.06-1a10.719 10.719 0 0 0-3.995.75V4a5.878 5.878 0 0 1 3.2-1c1.873 0 3.188 1 5.06 1A10.685 10.685 0 0 0 14.5 3z" style="fill:#7f7b94"/>
                                                                </svg>
                                                                Report
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>';
            echo $html;
            die;
        }
    }


    public function submitAnswerReply()
    {
        if ($this->input->post()) {
            $question_id   = $this->input->post('question_id');
            $parent_id   = $this->input->post('parent_id');
            $reply   = $this->input->post('reply');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $insertArr = array(
                'question_id'   => $question_id,
                'answer'        => $reply,
                'answered_by'   => $user_id,
                'parent_id'     => $parent_id,
                'status'        => 1,
                'created_at'    => date('Y-m-d H:i:s')
            );
            $this->db->insert('question_answer_master', $insertArr);

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Reply Added Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('account/questionDetail/' . base64_encode($question_id)), 'refresh');
        }
    }


    public function reportAnswer()
    {
        if ($this->input->post()) {
            $answer_id              = $this->input->post('answer_id');
            $report_reason          = $this->input->post('report_reason');
            $report_description     = $this->input->post('report_description');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $question_id              = $this->input->post('report_question_id');

            $insertArr = array(
                'answer_id'             => $answer_id,
                'report_reason'         => $report_reason,
                'user_id'               => $user_id,
                'report_description'    => $report_description,
                'status'        => 1,
                'created_at'    => date('Y-m-d H:i:s')
            );

            $this->db->insert('report_answer', $insertArr);


            $this->db->where(array('id' => $answer_id));
            $this->db->update('question_answer_master', array('status' => 2));

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Answer Reported Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('account/questionDetail/' . base64_encode($question_id)), 'refresh');
        }
    }

    public function reportAnswerDashboard()
    {
        if ($this->input->post()) {
            $answer_id              = $this->input->post('answer_id');
            $report_reason          = $this->input->post('report_reason');
            $report_description     = $this->input->post('report_description');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $question_id              = $this->input->post('report_question_id');

            $insertArr = array(
                'answer_id'             => $answer_id,
                'report_reason'         => $report_reason,
                'user_id'               => $user_id,
                'report_description'    => $report_description,
                'status'        => 1,
                'created_at'    => date('Y-m-d H:i:s')
            );

            $this->db->insert('report_answer', $insertArr);


            $this->db->where(array('id' => $answer_id));
            $this->db->update('question_answer_master', array('status' => 2));

            echo 1;
            die;
        }
    }

    public function removePeer()
    {
        if ($this->input->post()) {
            $peer_id              = $this->input->post('remove_peer_id');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $this->db->where(array('user_id' => $user_id, 'peer_id' => $peer_id));
            $this->db->delete('peer_master');

            $this->db->where(array('user_id' => $peer_id, 'peer_id' => $user_id));
            $this->db->delete('peer_master');

            $this->db->where(array('user_id' => $peer_id, 'peer_id' => $user_id));
            $this->db->delete('friends');

            $this->db->where(array('user_id' => $user_id, 'peer_id' => $peer_id));
            $this->db->delete('friends');

            redirect(site_url('account/dashboard'), 'refresh');
        }
    }


    public function bestAnswer()
    {
        if ($this->input->post()) {
            $question_id    = $this->input->post('best_question_id');
            $answer_id      = $this->input->post('answer_id');

            $this->db->where(array('question_id' => $question_id));
            $this->db->update('question_answer_master', array('best_answer' => 0));

            $this->db->where(array('id' => $answer_id));
            $this->db->update('question_answer_master', array('best_answer' => 1));

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Best Answer Updated Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('account/questionDetail/' . base64_encode($question_id)), 'refresh');
        }
    }

    public function bestAnswerDashboard()
    {
        if ($this->input->post()) {
            $question_id    = $this->input->post('best_question_id');
            $answer_id      = $this->input->post('answer_id');

            $this->db->where(array('question_id' => $question_id));
            $this->db->update('question_answer_master', array('best_answer' => 0));

            $this->db->where(array('id' => $answer_id));
            $this->db->update('question_answer_master', array('best_answer' => 1));

            echo 1;
            die;
        }
    }

    public function markQuestion()
    {
        if ($this->input->post()) {
            $question_id        = $this->input->post('mark_question_id');

            $detail = $this->db->get_where($this->db->dbprefix('question_master'), array('question_master.id' => $question_id))->row_array();
            if ($detail['is_solved'] == 0) {
                $this->db->where(array('id' => $question_id));
                $this->db->update('question_master', array('is_solved' => 1));
                $txt = 'Marked';
            } else {
                $this->db->where(array('id' => $question_id));
                $this->db->update('question_master', array('is_solved' => 0));
                $txt = 'Unmarked';
            }

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Question ' . $txt . ' Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('account/questionDetail/' . base64_encode($question_id)), 'refresh');
        }
    }

    public function addEventToCalender()
    {
        if ($this->input->post()) {
            $user_id = $this->session->get_userdata()['user_data']['user_id'];
            $event_id   = $this->input->post('calender_event_id');
            $event      = $this->db->query("select * from event_master where id = " . $event_id . "")->row_array();


            if ($event['created_by'] == $user_id) {

                $startdate  = $event['start_date'] . ' ' . $event['start_time'];
                $enddate    = $event['end_date'] . ' ' . $event['end_time'];
                $schedule   = array(
                    'schedule'      => 'event',
                    'schedule_name' => $event['event_name'],
                    'description'   => $event['description'],
                    'university'    => $event['university'],
                    'course'        => $event['course'],
                    'professor'     => $event['professor'],
                    'start_date'    => $startdate,
                    'end_date'      => $enddate,
                    'location'      => $event['location_txt'],
                    'latitude'      => $event['latitude'],
                    'longitude'     => $event['longitude'],
                    'featured_image'    => $event['featured_image'],
                    'event_master_id' => $event['id'],
                    'status'        => 1,
                    'created_at'    => date('Y-m-d H:i:s'),
                    'created_by'    => $event['created_by'],
                );

                $this->db->insert('schedule_master', $schedule);
                $schedule_id = $this->db->insert_id();


                $this->db->where(array('id' => $event_id));
                $this->db->update('event_master', array('addedToCalender' => 1, 'schedule_master_id' => $schedule_id));
            } else {
                $startdate  = $event['start_date'] . ' ' . $event['start_time'];
                $enddate    = $event['end_date'] . ' ' . $event['end_time'];

                $schedule   = array(
                    'schedule'      => 'event',
                    'schedule_name' => $event['event_name'],
                    'description'   => $event['description'],
                    'university'    => $event['university'],
                    'course'        => $event['course'],
                    'professor'     => $event['professor'],
                    'start_date'    => $startdate,
                    'end_date'      => $enddate,
                    'location'      => $event['location_txt'],
                    'latitude'      => $event['latitude'],
                    'longitude'     => $event['longitude'],
                    'featured_image'    => $event['featured_image'],
                    'event_master_id' => $event['id'],
                    'status'        => 1,
                    'created_at'    => date('Y-m-d H:i:s'),
                    'created_by'    => $user_id,
                );

                $this->db->insert('schedule_master', $schedule);
                $schedule_id = $this->db->insert_id();



                $this->db->where(array('reference_id' => $event_id, 'reference' => 'event', 'peer_id' => $user_id, 'status' => 2));
                $this->db->update('share_master', array('schedule_master_id' => $schedule_id));
            }

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Event Added To Calender Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            if ($this->input->post('dashboard')) {
                redirect(site_url('account/dashboard'), 'refresh');
            } else if ($this->input->post('timeline')) {
                redirect(site_url('Profile/timeline'), 'refresh');
            } else if ($this->input->post('searchResult')) {
                redirect(site_url('account/searchResult'), 'refresh');
            } else if ($this->input->post('profile')) {
                $redirect_username = $this->db->get_where($this->db->dbprefix('user'), array('id' => $this->input->post('profile')))->row_array();

                redirect(site_url('sp/' . $redirect_username['username']), 'refresh');
            } else {
                redirect(site_url('account/events'), 'refresh');
            }
        }
    }


    public function getScheduleDetail()
    {
        if ($this->input->post()) {
            $id     = $this->input->post('id');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];
            $res    = $this->db->get_where('schedule_master', array('id' => $id))->row_array();
            $uni    = $this->db->get_where('university', array('university_id' => $res['university']))->row_array();
            $course    = $this->db->get_where('course_master', array('id' => $res['course']))->row_array();
            $professor    = $this->db->get_where('professor_master', array('id' => $res['professor']))->row_array();
            if ($res['schedule'] == 'event') {
                $edit_url = base_url() . 'account/editEvent/' . base64_encode($res['event_master_id']);
            } else {
                $edit_url = base_url() . 'account/editSchedule/' . base64_encode($res['id']);
            }
            $this->db->select('user_info.nickname,user_info.userID,user.id,user.username');
            $this->db->join('user', 'user.id=user_info.userID');
            $user = $this->db->get_where('user_info', array('userID' => $res['created_by']))->row_array();
            $html = "";
            if ($res['schedule'] == 'event') {
                $event    = $this->db->get_where('event_master', array('id' => $res['event_master_id']))->row_array();
                if ($event['created_by'] == $user_id) {
                    $html .= '<div class="userWrap action" style="width:auto;">                                      
                        <div class="edit">
                            <a href="' . $edit_url . '">
                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                        <g>
                                            <g>
                                                <polygon points="51.2,353.28 0,512 158.72,460.8         "></polygon>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                
                                                    <rect x="89.73" y="169.097" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -95.8575 260.3719)" width="353.277" height="153.599"></rect>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <path d="M504.32,79.36L432.64,7.68c-10.24-10.24-25.6-10.24-35.84,0l-23.04,23.04l107.52,107.52l23.04-23.04
                                                    C514.56,104.96,514.56,89.6,504.32,79.36z"></path>
                                            </g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                </svg> Edit
                            </a>
                        </div>          
                        <div class="delete">
                            <a data-toggle="modal" onclick="deleteSchedule(' . $res['id'] . ')" data-target="#confirmationModal">                                        
                                <svg height="512pt" viewBox="-57 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m156.371094 30.90625h85.570312v14.398438h30.902344v-16.414063c.003906-15.929687-12.949219-28.890625-28.871094-28.890625h-89.632812c-15.921875 0-28.875 12.960938-28.875 28.890625v16.414063h30.90625zm0 0"></path><path d="m344.210938 167.75h-290.109376c-7.949218 0-14.207031 6.78125-13.566406 14.707031l24.253906 299.90625c1.351563 16.742188 15.316407 29.636719 32.09375 29.636719h204.542969c16.777344 0 30.742188-12.894531 32.09375-29.640625l24.253907-299.902344c.644531-7.925781-5.613282-14.707031-13.5625-14.707031zm-219.863282 312.261719c-.324218.019531-.648437.03125-.96875.03125-8.101562 0-14.902344-6.308594-15.40625-14.503907l-15.199218-246.207031c-.523438-8.519531 5.957031-15.851562 14.472656-16.375 8.488281-.515625 15.851562 5.949219 16.375 14.472657l15.195312 246.207031c.527344 8.519531-5.953125 15.847656-14.46875 16.375zm90.433594-15.421875c0 8.53125-6.917969 15.449218-15.453125 15.449218s-15.453125-6.917968-15.453125-15.449218v-246.210938c0-8.535156 6.917969-15.453125 15.453125-15.453125 8.53125 0 15.453125 6.917969 15.453125 15.453125zm90.757812-245.300782-14.511718 246.207032c-.480469 8.210937-7.292969 14.542968-15.410156 14.542968-.304688 0-.613282-.007812-.921876-.023437-8.519531-.503906-15.019531-7.816406-14.515624-16.335937l14.507812-246.210938c.5-8.519531 7.789062-15.019531 16.332031-14.515625 8.519531.5 15.019531 7.816406 14.519531 16.335937zm0 0"></path><path d="m397.648438 120.0625-10.148438-30.421875c-2.675781-8.019531-10.183594-13.429687-18.640625-13.429687h-339.410156c-8.453125 0-15.964844 5.410156-18.636719 13.429687l-10.148438 30.421875c-1.957031 5.867188.589844 11.851562 5.34375 14.835938 1.9375 1.214843 4.230469 1.945312 6.75 1.945312h372.796876c2.519531 0 4.816406-.730469 6.75-1.949219 4.753906-2.984375 7.300781-8.96875 5.34375-14.832031zm0 0"></path>
                                </svg> Delete
                            </a>
                        </div>  
                    </div>';
                }
            } else {
                $html .= '<div class="userWrap action" style="width:auto;">                                      
                <div class="edit">
                    <a href="' . $edit_url . '">
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                <g>
                                    <g>
                                        <polygon points="51.2,353.28 0,512 158.72,460.8         "></polygon>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        
                                            <rect x="89.73" y="169.097" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -95.8575 260.3719)" width="353.277" height="153.599"></rect>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path d="M504.32,79.36L432.64,7.68c-10.24-10.24-25.6-10.24-35.84,0l-23.04,23.04l107.52,107.52l23.04-23.04
                                            C514.56,104.96,514.56,89.6,504.32,79.36z"></path>
                                    </g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                        </svg> Edit
                    </a>
                </div>          
                <div class="delete">
                    <a data-toggle="modal" onclick="deleteSchedule(' . $res['id'] . ')" data-target="#confirmationModal">                                        
                        <svg height="512pt" viewBox="-57 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">
                            <path d="m156.371094 30.90625h85.570312v14.398438h30.902344v-16.414063c.003906-15.929687-12.949219-28.890625-28.871094-28.890625h-89.632812c-15.921875 0-28.875 12.960938-28.875 28.890625v16.414063h30.90625zm0 0"></path><path d="m344.210938 167.75h-290.109376c-7.949218 0-14.207031 6.78125-13.566406 14.707031l24.253906 299.90625c1.351563 16.742188 15.316407 29.636719 32.09375 29.636719h204.542969c16.777344 0 30.742188-12.894531 32.09375-29.640625l24.253907-299.902344c.644531-7.925781-5.613282-14.707031-13.5625-14.707031zm-219.863282 312.261719c-.324218.019531-.648437.03125-.96875.03125-8.101562 0-14.902344-6.308594-15.40625-14.503907l-15.199218-246.207031c-.523438-8.519531 5.957031-15.851562 14.472656-16.375 8.488281-.515625 15.851562 5.949219 16.375 14.472657l15.195312 246.207031c.527344 8.519531-5.953125 15.847656-14.46875 16.375zm90.433594-15.421875c0 8.53125-6.917969 15.449218-15.453125 15.449218s-15.453125-6.917968-15.453125-15.449218v-246.210938c0-8.535156 6.917969-15.453125 15.453125-15.453125 8.53125 0 15.453125 6.917969 15.453125 15.453125zm90.757812-245.300782-14.511718 246.207032c-.480469 8.210937-7.292969 14.542968-15.410156 14.542968-.304688 0-.613282-.007812-.921876-.023437-8.519531-.503906-15.019531-7.816406-14.515624-16.335937l14.507812-246.210938c.5-8.519531 7.789062-15.019531 16.332031-14.515625 8.519531.5 15.019531 7.816406 14.519531 16.335937zm0 0"></path><path d="m397.648438 120.0625-10.148438-30.421875c-2.675781-8.019531-10.183594-13.429687-18.640625-13.429687h-339.410156c-8.453125 0-15.964844 5.410156-18.636719 13.429687l-10.148438 30.421875c-1.957031 5.867188.589844 11.851562 5.34375 14.835938 1.9375 1.214843 4.230469 1.945312 6.75 1.945312h372.796876c2.519531 0 4.816406-.730469 6.75-1.949219 4.753906-2.984375 7.300781-8.96875 5.34375-14.832031zm0 0"></path>
                        </svg> Delete
                    </a>
                </div>  
            </div>';
            }

            $html .= '<h4>' . $res['schedule_name'] . '</h4>
        <div class="badgeList">
            <ul>
                <li class="badge badge1">' . $uni['SchoolName'] . '</li>
                <li class="badge badge2">' . $course['name'] . '</li>
                <li class="badge badge3">' . $professor['name'] . '</li>
            </ul>
        </div>';

            if ($res['schedule'] == 'event') {
                $html .= '<div class="daytime"> 
                <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
                    <path d="M230.3,435.3C214.5,419.5,75.7,277.6,75.7,181.9C75.7,82,151.4,0,245,0s169.3,82,169.3,181.9
                        c0,94.6-138.8,236.6-154.6,253.4C255.5,439.5,242.1,447.1,230.3,435.3z M245,41c-70.5,0-128.3,63.1-128.3,142
                        c0,58.9,83.1,159.8,128.3,209.2c46.3-49.4,128.3-149.3,128.3-209.2C373.3,104.1,315.5,41,245,41z"></path>
                    <path d="M245,246.1c-42.1,0-76.8-34.7-76.8-76.8s34.7-76.8,76.8-76.8s76.8,34.7,76.8,76.8S287.1,246.1,245,246.1z M245,132.6
                        c-20,0-36.8,16.8-36.8,36.8s16.8,36.8,36.8,36.8s36.8-16.8,36.8-36.8C281.8,148.3,265,132.6,245,132.6z"></path>
                    <path d="M345.9,490H144.1c-11.6,0-20-9.5-20-20s9.5-20,20-20H347c11.6,0,20,9.5,20,20S357.5,490,345.9,490z"></path>
                </svg>' . $res['location'] . '</div>';
            }

            $html .= '<div class="daytime">
            <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 501.333 501.333">
                <path d="M250.667,0C112,0,0,112,0,250.667s112,250.667,250.667,250.667s250.667-112,250.667-250.667S389.333,0,250.667,0z
                    M250.667,459.733c-115.2,0-209.067-93.867-209.067-209.067S135.467,41.6,250.667,41.6s209.067,93.867,209.067,209.067
                    S365.867,459.733,250.667,459.733z"></path>
                <path d="M314.667,229.333H272V129.067c0-11.733-9.6-21.333-21.333-21.333c-11.733,0-21.333,9.6-21.333,21.333v121.6
                    c0,11.733,9.6,21.333,21.333,21.333h64C326.4,272,336,262.4,336,250.667C336,238.933,326.4,229.333,314.667,229.333z"></path>
            </svg>' . date('d M, Y h:i A', strtotime($res['start_date'])) . ' - ' . date('d M, Y h:i A', strtotime($res['end_date'])) . '</div>
        <div class="userWrap">
            <div class="user-name">
                <figure>
                    <img src="' . userImage($res['created_by']) . '" alt="user">
                </figure>
                <a href="' . base_url() . 'sp/' . $user['username'] . '"><figcaption>' . $user['nickname'] . '</figcaption></a>
            </div>  
        </div>';
            if (!empty($res['description'])) {
                $html .= '<div class="descpription">
            <h6>Description</h6>
            <p>' . $res['description'] . '</p>
            </div>';
            }
            if ($res['schedule'] == 'event') {
                $html .= '<div class="mapWrapper">
                <div id="map-container-google-1" class="z-depth-1-half map-container">
                  <div id="map" style="height: 100%;"></div>
                </div>
            </div>';
                $result['location_txt'] = $res['location'];
                $result['latitude'] = $res['latitude'];
                $result['longitude'] = $res['longitude'];
                $result['type'] = 2;
            } else {
                $result['type'] = 1;
            }
            $result['html'] = $html;
            print_r(json_encode($result));
            die;
        }
    }


    public function editSchedule()
    {
        is_valid_logged_in();
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $data['user_detail'] = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $data['user_info'] = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();

        $schedule_id = base64_decode($this->uri->segment('3'));

        $data['schedule'] = $this->db->query("select * from schedule_master where id = " . $schedule_id . "")->row_array();
        $data['university'] = $this->db->get_where('university', array('university_id' => $data['schedule']['university']))->row_array();
        $data['course']     = $this->db->get_where('course_master', array('status' => 1, 'user_id' => $user_id))->result_array();
        $data['professor']     = $this->db->get_where('professor_master', array('status' => 1, 'course_id' => $data['schedule']['course']))->result_array();

        $data['index_menu']  = 'schedule';
        $data['title']  = 'Edit Schedule | Studypeers';

        if ($this->input->post()) {
            // print_r($this->input->post());die;
            $schedule_id = base64_decode($this->uri->segment('3'));
            $schedule       = $this->input->post('schedule');
            $schedule_name  = $this->input->post('schedule_name');
            $description    = $this->input->post('description');
            $university     = $this->input->post('university');
            $course         = $this->input->post('course');
            $professor      = $this->input->post('professor');
            $startdate      = $this->input->post('start-date');
            $enddate        = $this->input->post('end-date');

            $timestamp1 = strtotime($startdate);
            $start_date = date('Y-m-d H:i:s', $timestamp1);

            $timestamp2 = strtotime($enddate);
            $end_date = date('Y-m-d H:i:s', $timestamp2);

            $insertArr = array(
                'schedule'      => $schedule,
                'schedule_name' => $schedule_name,
                'description'   => $description,
                'university'    => $university,
                'course'        => $course,
                'professor'     => $professor,
                'start_date'    => $start_date,
                'end_date'      => $end_date
            );
            //$this->db->insert('schedule_master', $insertArr);
            $this->db->where(array('id' => $schedule_id));
            $this->db->update('schedule_master', $insertArr);

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Schedule Edited Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('account/schedule'), 'refresh');
        }

        $this->load->view('user/include/header', $data);
        $this->load->view('user/schedule/edit-schedule');
        $this->load->view('user/include/right-sidebar');
        $this->load->view('user/include/firebase-include');
        $this->load->view('user/schedule/footer');
    }

    public function deleteSchedule()
    {
        if ($this->input->post()) { //print_r($this->input->post());die;
            $schedule_id = $this->input->post('delete_schedule_id');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $this->db->where(array('id' => $schedule_id));
            $this->db->update('schedule_master', array('status' => 3));

            $this->db->where(array('schedule_master_id' => $schedule_id));
            $this->db->update('event_master', array('addedToCalender' => 0));

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Schedule Deleted Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('account/schedule'), 'refresh');
        }
    }

    public function removeEvent()
    {
        if ($this->input->post()) { //print_r($this->input->post());die;
            $remove_event_id = $this->input->post('remove_event_id');
            $event      = $this->db->query("select * from event_master where id = " . $remove_event_id . "")->row_array();
            $user_id = $this->session->get_userdata()['user_data']['user_id'];
            $this->db->where(array('event_master_id' => $remove_event_id, 'created_by' => $user_id));
            $this->db->update('schedule_master', array('status' => 3));

            if ($event['created_by'] == $user_id) {
                $this->db->where(array('id' => $remove_event_id));
                $this->db->update('event_master', array('addedToCalender' => 0));
            } else {
                $this->db->where(array('reference_id' => $remove_event_id, 'reference' => 'event', 'peer_id' => $user_id, 'status' => 2));
                $this->db->update('share_master', array('schedule_master_id' => 0));
            }

            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Event Removed From Schedule Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            if ($this->input->post('dashboard')) {
                redirect(site_url('account/dashboard'), 'refresh');
            } else if ($this->input->post('searchResult')) {
                redirect(site_url('account/searchResult'), 'refresh');
            } else if ($this->input->post('timeline')) {
                redirect(site_url('Profile/timeline'), 'refresh');
            } else if ($this->input->post('profile')) {
                $redirect_username = $this->db->get_where($this->db->dbprefix('user'), array('id' => $this->input->post('profile')))->row_array();

                redirect(site_url('sp/' . $redirect_username['username']), 'refresh');
            } else {
                redirect(site_url('account/events'), 'refresh');
            }
        }
    }

    public function addComment()
    {
        if ($this->input->post()) {
            $comment = $this->input->post('comment');
            $event_id = $this->input->post('event_id');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $insertArr = array(
                'reference' => 'event',
                'reference_id' => $event_id,
                'user_id' => $user_id,
                'comment' => $comment,
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s')

            );

            $this->db->insert('comment_master', $insertArr);
            $comment_id = $this->db->insert_id();
            $this->db->select('user_info.nickname,user_info.userID,user.id,user.username');
            $this->db->join('user', 'user.id=user_info.userID');
            $user_info = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();

            $count = $this->db->get_where('comment_master', array('reference_id' => $event_id, 'reference' => 'event', 'comment_parent_id' => 0, 'status' => 1))->num_rows();

            $text = 'event';

            $html = '<div class="chatMsg" id="comment_id_' . $comment_id . '">
                        <figure>
                            <img src="' . userImage($user_id) . '" alt="User">
                        </figure>
                        <figcaption>
                            <a href="' . base_url() . 'sp/' . $user_info['username'] . '"><span class="name"> ' . $user_info['nickname'] . '</span></a>
                            ' . $comment . '                                                 
                            <div class="actionmsgMenu">
                                <ul>
                                    <li class="likeuser" id="likeComment' . $comment_id . '" onclick="likeComment(' . $comment_id . ')">Like</li>
                                    <li class="replyuser" onclick="showReplyBox(' . $comment_id . ')">Reply</li>
                                </ul>
                            </div>
                            <div class="reactmessage" id="reactmessage_' . $comment_id . '" style="display:none;">
                                <div class="react">
                                    <img src="' . base_url() . 'assets_d/images/like.png" alt="Like">
                                </div>
                                <p id="like_count_' . $comment_id . '"></p>
                            </div>
                        </figcaption>
                        <div class="dotsBullet dropdown">
                                                    <img
                                                        src="' . base_url() . 'assets_d/images/more.svg"
                                                        alt="more"
                                                        data-toggle="dropdown">
                                                    <ul class="dropdown-menu"
                                                        role="menu"
                                                        aria-labelledby="menu1">
                                                        <li role="presentation">
                                                            <a role="menuitem"
                                                               tabindex="-1"
                                                               href="javascript:void(0);">
                                                                <div
                                                                    class="left">
                                                                    <img
                                                                        src="' . base_url() . 'assets_d/images/restricted.svg"
                                                                        alt="Save">
                                                                </div>
                                                                <div
                                                                    class="right">
                                                                    <span>Hide/block</span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        
                                                            <li role="presentation">
                                                                <a role="menuitem"
                                                                   tabindex="-1"
                                                                   href="javascript:void(0);" onclick="deleteComment(' . $comment_id . ', ' . $event_id . ', \'' . $text . '\')">
                                                                    <div
                                                                        class="left">
                                                                        <img
                                                                            src="' . base_url() . 'assets_d/images/trash.svg"
                                                                            alt="Link">
                                                                    </div>
                                                                    <div
                                                                        class="right">
                                                                        <span>Delete</span>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                        
                                                    </ul>
                                            </div>

                        <div class="reply" id="reply_' . $comment_id . '">
                                                
                        </div>
                        <div class="replyBox" id="replyBox' . $comment_id . '">
                            <figure>
                                <img src="' . userImage($user_id) . '" alt="User">
                            </figure>
                            <div class="replyuser">
                                <input type="text" id="input_reply_' . $comment_id . '" placeholder="Write a Reply..." onkeypress="postReply(event,' . $comment_id . ', this.value)">
                            </div>
                        </div>                                                  
                    </div>';
            $result['html'] = $html;
            if ($count != 0) {
                $result['count'] = '(' . $count . ')';
            } else {
                $result['count'] = '';
            }
            print_r(json_encode($result));
            die;
        }
    }

    public function postReply()
    {
        if ($this->input->post()) {
            $comment = $this->input->post('comment');
            $event_id = $this->input->post('event_id');
            $comment_id = $this->input->post('comment_id');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $insertArr = array(
                'reference' => 'event',
                'reference_id' => $event_id,
                'comment_parent_id' => $comment_id,
                'user_id' => $user_id,
                'comment' => $comment,
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s')

            );

            $comment_parent_id = $comment_id;

            $this->db->insert('comment_master', $insertArr);
            $comment_id = $this->db->insert_id();
            $this->db->select('user_info.nickname,user_info.userID,user.id,user.username');
            $this->db->join('user', 'user.id=user_info.userID');
            $user_info = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();

            $html = '<div class="userReplyBox" id="comment_reply_id_' . $comment_id . '"><figure>
                        <img src="' . userImage($user_id) . '" alt="User">
                    </figure>
                    <figcaption>
                        <a href="' . base_url() . 'sp/' . $user_info['username'] . '"><span class="name">' . $user_info['nickname'] . '</span></a>
                        ' . $comment . '                                            
                        <div class="actionmsgMenu">
                            <ul>
                                <li class="likeuser" id="likeComment' . $comment_id . '" onclick="likeComment(' . $comment_id . ')">Like</li>
                                
                            </ul>
                        </div>
                        <div class="reactmessage" id="reactmessage_' . $comment_id . '" style="display:none;">
                            <div class="react">
                                <img src="' . base_url() . 'assets_d/images/like.png" alt="Like">
                            </div>
                            <p id="like_count_' . $comment_id . '">0</p>
                        </div>
                    </figcaption>
                    <div class="dotsBullet dropdown">
                                                    <img
                                                        src="' . base_url() . 'assets_d/images/more.svg"
                                                        alt="more"
                                                        data-toggle="dropdown">
                                                    <ul class="dropdown-menu"
                                                        role="menu"
                                                        aria-labelledby="menu1">
                                                        <li role="presentation">
                                                            <a role="menuitem"
                                                               tabindex="-1"
                                                               href="javascript:void(0);">
                                                                <div
                                                                    class="left">
                                                                    <img
                                                                        src="' . base_url() . 'assets_d/images/restricted.svg"
                                                                        alt="Save">
                                                                </div>
                                                                <div
                                                                    class="right">
                                                                    <span>Hide/block</span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        
                                                            <li role="presentation">
                                                                <a role="menuitem"
                                                                   tabindex="-1"
                                                                   href="javascript:void(0);" onclick="deleteCommentReply(' . $comment_id . ', ' . $comment_parent_id . ')">
                                                                    <div
                                                                        class="left">
                                                                        <img
                                                                            src="' . base_url() . 'assets_d/images/trash.svg"
                                                                            alt="Link">
                                                                    </div>
                                                                    <div
                                                                        class="right">
                                                                        <span>Delete</span>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                        
                                                    </ul>
                                            </div>
                    </div>';
            echo $html;
            die;
        }
    }

    public function postReplyDocument()
    {
        if ($this->input->post()) {
            $comment = $this->input->post('comment');
            $doc_id = $this->input->post('doc_id');
            $comment_id = $this->input->post('comment_id');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $insertArr = array(
                'reference' => 'document',
                'reference_id' => $doc_id,
                'comment_parent_id' => $comment_id,
                'user_id' => $user_id,
                'comment' => $comment,
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s')

            );

            $comment_parent_id = $comment_id;

            $this->db->insert('comment_master', $insertArr);
            $comment_id = $this->db->insert_id();
            $this->db->select('user_info.nickname,user_info.userID,user.id,user.username');
            $this->db->join('user', 'user.id=user_info.userID');
            $user_info = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();

            $html = '<div class="userReplyBox" id="comment_reply_id_' . $comment_id . '"><figure>
                        <img src="' . userImage($user_id) . '" alt="User">
                    </figure>
                    <div class="right">
                        <div class="userWrapText">
                            <figcaption>
                                <a href="' . base_url() . 'sp/' . $user_info['username'] . '"><span class="name">' . $user_info['nickname'] . '</span></a>
                                ' . $comment . '                                            
                                <div class="actionmsgMenu">
                                    <ul>
                                        <li class="likeuser" id="likeComment' . $comment_id . '" onclick="likeComment(' . $comment_id . ')">Like</li>
                                        
                                    </ul>
                                </div>
                                <div class="reactmessage" id="reactmessage_' . $comment_id . '" style="display:none;">
                                    <div class="react">
                                        <img src="' . base_url() . 'assets_d/images/like-dashboard.svg" alt="Like">
                                    </div>
                                    <p id="like_count_' . $comment_id . '">0</p>
                                </div>
                            </figcaption>
                        </div>
                        <div class="dotsBullet dropdown">
                                                    <img
                                                        src="' . base_url() . 'assets_d/images/more.svg"
                                                        alt="more"
                                                        data-toggle="dropdown">
                                                    <ul class="dropdown-menu"
                                                        role="menu"
                                                        aria-labelledby="menu1">
                                                        <li role="presentation">
                                                            <a role="menuitem"
                                                               tabindex="-1"
                                                               href="javascript:void(0);">
                                                                <div
                                                                    class="left">
                                                                    <img
                                                                        src="' . base_url() . 'assets_d/images/restricted.svg"
                                                                        alt="Save">
                                                                </div>
                                                                <div
                                                                    class="right">
                                                                    <span>Hide/block</span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        
                                                            <li role="presentation">
                                                                <a role="menuitem"
                                                                   tabindex="-1"
                                                                   href="javascript:void(0);" onclick="deleteCommentReply(' . $comment_id . ', ' . $comment_parent_id . ')">
                                                                    <div
                                                                        class="left">
                                                                        <img
                                                                            src="' . base_url() . 'assets_d/images/trash.svg"
                                                                            alt="Link">
                                                                    </div>
                                                                    <div
                                                                        class="right">
                                                                        <span>Delete</span>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                        
                                                    </ul>
                                            </div>
                    </div>
                    </div>';
            echo $html;
            die;
        }
    }



    public function likeComment()
    {
        if ($this->input->post()) {
            $comment_id = $this->input->post('comment_id');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $if_user_liked = $this->db->get_where('comment_like_master', array('comment_id' => $comment_id, 'status' => 1, 'user_id' => $user_id))->row_array();

            if (!empty($if_user_liked)) {
                $this->db->where(array('comment_id' => $comment_id, 'user_id' => $user_id));
                $this->db->delete('comment_like_master');
            } else {

                $insertArr = array(
                    'comment_id' => $comment_id,

                    'user_id' => $user_id,

                    'status' => '1',
                    'created_at' => date('Y-m-d H:i:s')

                );

                $this->db->insert('comment_like_master', $insertArr);
            }
            $count = $this->db->get_where('comment_like_master', array('comment_id' => $comment_id, 'status' => 1))->num_rows();
            echo $count;
        }
    }

    public function likeCommentDocument()
    {
        if ($this->input->post()) {
            $doc_id = $this->input->post('doc_id');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $chk_if_liked = $this->db->get_where('document_like_master', array('doc_id' => $doc_id, 'user_id' => $user_id))->num_rows();
            if ($chk_if_liked == 0) {
                $insertArr = array(
                    'doc_id' => $doc_id,
                    'user_id' => $user_id,
                    'created_at' => date('Y-m-d H:i:s')

                );

                $this->db->insert('document_like_master', $insertArr);

                $this->db->query("UPDATE document_master SET likeCount = likeCount + 1 WHERE id = " . $doc_id . "");
            } else {
                $this->db->where(array('doc_id' => $doc_id, 'user_id' => $user_id));
                $this->db->delete('document_like_master');

                $this->db->query("UPDATE document_master SET likeCount = likeCount - 1 WHERE id = " . $doc_id . "");
            }
            $count = $this->db->get_where('document_like_master', array('doc_id' => $doc_id))->num_rows();
            echo $count;
        }
    }

    public function postImgReply()
    {

        if ($this->input->post()) {

            $event_id = $this->input->post('event_id');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];
            $c_image = $this->uploadCommentImg('file', $_FILES['file']['name']);

            $insertArr = array(
                'reference' => 'event',
                'reference_id' => $event_id,
                'user_id' => $user_id,
                'comment' => $c_image,
                'type'   => 1,
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s')

            );

            $this->db->insert('comment_master', $insertArr);
            $comment_id = $this->db->insert_id();
            $this->db->select('user_info.nickname,user_info.userID,user.id,user.username');
            $this->db->join('user', 'user.id=user_info.userID');
            $user_info = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();

            $html = '<div class="chatMsg" id="comment_id_' . $comment_id . '">
                        <figure>
                            <img src="' . userImage($user_id) . '" alt="User">
                        </figure>
                        <figcaption>
                            <a href="' . base_url() . 'sp/' . $user_info['username'] . '"><span class="name"> ' . $user_info['nickname'] . '</span></a>
                            <img src="' . base_url() . 'uploads/comments/' . $c_image . '" alt="comment" style="height: 70px;">                                                 
                            <div class="actionmsgMenu">
                                <ul>
                                    <li class="likeuser" id="likeComment' . $comment_id . '" onclick="likeComment(' . $comment_id . ')">Like</li>
                                    <li class="replyuser" onclick="showReplyBox(' . $comment_id . ')">Reply</li>
                                </ul>
                            </div>
                            <div class="reactmessage" id="reactmessage_' . $comment_id . '" style="display:none;">
                                <div class="react">
                                    <img src="' . base_url() . 'assets_d/images/like.png" alt="Like">
                                </div>
                                <p id="like_count_' . $comment_id . '"></p>
                            </div>
                        </figcaption>
                        <div class="reply" id="reply_' . $comment_id . '">
                                                
                        </div>
                        <div class="replyBox" id="replyBox' . $comment_id . '">
                            <figure>
                                <img src="' . userImage($user_id) . '" alt="User">
                            </figure>
                            <div class="replyuser">
                                <input type="text" id="input_reply_' . $comment_id . '" placeholder="Write a Reply..." onkeypress="postReply(event,' . $comment_id . ', this.value)">
                            </div>
                        </div>                                                  
                    </div>';
            echo $html;
            die;
        }
    }

    public function postImgCommentDoc()
    {

        if ($this->input->post()) {

            $doc_id = $this->input->post('doc_id');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];
            $c_image = $this->uploadCommentImg('file', $_FILES['file']['name']);

            $insertArr = array(
                'reference' => 'document',
                'reference_id' => $doc_id,
                'user_id' => $user_id,
                'comment' => $c_image,
                'type'   => 1,
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s')

            );

            $this->db->insert('comment_master', $insertArr);
            $comment_id = $this->db->insert_id();
            $this->db->select('user_info.nickname,user_info.userID,user.id,user.username');
            $this->db->join('user', 'user.id=user_info.userID');
            $user_info = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();

            $html = '<div class="chatMsg" id="comment_id_' . $comment_id . '">
                        <figure>
                            <img src="' . userImage($user_id) . '" alt="User">
                        </figure>
                        <figcaption>
                            <a href="' . base_url() . 'sp/' . $user_info['username'] . '"><span class="name"> ' . $user_info['nickname'] . '</span></a>
                            <img src="' . base_url() . 'uploads/comments/' . $c_image . '" alt="comment" style="height: 70px;">                                                 
                            <div class="actionmsgMenu">
                                <ul>
                                    <li class="likeuser" id="likeComment' . $comment_id . '" onclick="likeComment(' . $comment_id . ')">Like</li>
                                    <li class="replyuser" onclick="showReplyBox(' . $comment_id . ')">Reply</li>
                                </ul>
                            </div>
                            <div class="reactmessage" id="reactmessage_' . $comment_id . '" style="display:none;">
                                <div class="react">
                                    <img src="' . base_url() . 'assets_d/images/like.png" alt="Like">
                                </div>
                                <p id="like_count_' . $comment_id . '"></p>
                            </div>
                        </figcaption>
                        <div class="reply" id="reply_' . $comment_id . '">
                                                
                        </div>
                        <div class="replyBox" id="replyBox' . $comment_id . '">
                            <figure>
                                <img src="' . userImage($user_id) . '" alt="User">
                            </figure>
                            <div class="replyuser">
                                <input type="text" id="input_reply_' . $comment_id . '" placeholder="Write a Reply..." onkeypress="postReply(event,' . $comment_id . ', this.value)">
                            </div>
                        </div>                                                  
                    </div>';
            echo $html;
            die;
        }
    }

    public function addCommentDocument()
    {
        if ($this->input->post()) {
            $comment = $this->input->post('comment');
            $doc_id = $this->input->post('doc_id');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $insertArr = array(
                'reference' => 'document',
                'reference_id' => $doc_id,
                'user_id' => $user_id,
                'comment' => $comment,
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s')

            );

            $this->db->insert('comment_master', $insertArr);
            $comment_id = $this->db->insert_id();
            $this->db->select('user_info.nickname,user_info.userID,user.id,user.username');
            $this->db->join('user', 'user.id=user_info.userID');
            $user_info = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();

            $count = $this->db->get_where('comment_master', array('reference_id' => $doc_id, 'reference' => 'document', 'comment_parent_id' => 0, 'status' => 1))->num_rows();

            $text = 'document';

            $html = '<div class="chatMsg" id="comment_id_' . $comment_id . '">
                        <div class="chatMsgBox">
                            <figure>
                                <img src="' . userImage($user_id) . '" alt="User">
                            </figure>
                            <div class="right">
                                <div class="userWrapText">
                                    <figcaption>
                                        <a href="' . base_url() . 'sp/' . $user_info['username'] . '"><span class="name"> ' . $user_info['nickname'] . '</span></a>
                                        ' . $comment . '                                                 
                                        <div class="actionmsgMenu">
                                            <ul>
                                                <li class="likeuser" id="likeComment' . $comment_id . '" onclick="likeComment(' . $comment_id . ')">Like</li>
                                                <li class="replyuser" onclick="showReplyBox(' . $comment_id . ')">Reply</li>
                                            </ul>
                                        </div>
                                        <div class="reactmessage" id="reactmessage_' . $comment_id . '" style="display:none;">
                                            <div class="react">
                                                <img src="' . base_url() . 'assets_d/images/like-dashboard.svg" alt="Like">
                                            </div>
                                            <p id="like_count_' . $comment_id . '"></p>
                                        </div>
                                    </figcaption>
                                    <div class="reply" id="reply_' . $comment_id . '">
                                                
                                    </div>
                                    <div class="replyBox" id="replyBox' . $comment_id . '">
                                        <figure>
                                            <img src="' . userImage($user_id) . '" alt="User">
                                        </figure>
                                        <div class="replyuser">
                                            <input type="text" id="input_reply_' . $comment_id . '" placeholder="Write a Reply..." onkeypress="postReply(event,' . $comment_id . ', this.value)">
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <div class="dotsBullet dropdown">
                                                    <img
                                                        src="' . base_url() . 'assets_d/images/more.svg"
                                                        alt="more"
                                                        data-toggle="dropdown">
                                                    <ul class="dropdown-menu"
                                                        role="menu"
                                                        aria-labelledby="menu1">
                                                        <li role="presentation">
                                                            <a role="menuitem"
                                                               tabindex="-1"
                                                               href="javascript:void(0);">
                                                                <div
                                                                    class="left">
                                                                    <img
                                                                        src="' . base_url() . 'assets_d/images/restricted.svg"
                                                                        alt="Save">
                                                                </div>
                                                                <div
                                                                    class="right">
                                                                    <span>Hide/block</span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        
                                                            <li role="presentation">
                                                                <a role="menuitem"
                                                                   tabindex="-1"
                                                                   href="javascript:void(0);" onclick="deleteComment(' . $comment_id . ', ' . $doc_id . ', \'' . $text . '\')">
                                                                    <div
                                                                        class="left">
                                                                        <img
                                                                            src="' . base_url() . 'assets_d/images/trash.svg"
                                                                            alt="Link">
                                                                    </div>
                                                                    <div
                                                                        class="right">
                                                                        <span>Delete</span>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                        
                                                    </ul>
                                            </div>

                        
                            </div>                                             
                    </div>';
            $result['html'] = $html;
            if ($count != 0) {
                $result['count'] = '(' . $count . ')';
            } else {
                $result['count'] = '';
            }
            print_r(json_encode($result));
            die;
        }
    }

    public function uploadImg($f_n, $name)
    {
        $fileTypes = array('jpg', 'jpeg', 'gif', 'png', 'zip', 'xlsx', 'cad', 'pdf', 'doc', 'docx', 'ppt', 'pptx', 'pps', 'ppsx', 'odt', 'xls', 'xlsx', '.mp3', 'm4a', 'ogg', 'wav', 'mp4', 'm4v', 'mov', 'wmv'); // Allowed file extensions

        $imagename  = time();
        $config['upload_path']      = 'uploads/users/';
        $config['allowed_types']    = $fileTypes;
        $config['max_size']         = '0';
        $logo_file_name             = '';
        $config['file_name']        =   $imagename;
        $this->upload->initialize($config);

        // $this->load->library('upload', $config);

        if ($this->upload->do_upload($f_n)) {
            $logo_data = $this->upload->data();
            $logo_file_name = $logo_data['file_name'];
        } else {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
            die;
        }

        if (!empty($logo_file_name)) {
            $img = $logo_file_name;
        } else {
            $img = 'default.png';
        }
        return $img;
    }

    public function uploadCommentImg($f_n, $name)
    {
        $fileTypes = array('jpg', 'jpeg', 'gif', 'png', 'zip', 'xlsx', 'cad', 'pdf', 'doc', 'docx', 'ppt', 'pptx', 'pps', 'ppsx', 'odt', 'xls', 'xlsx', '.mp3', 'm4a', 'ogg', 'wav', 'mp4', 'm4v', 'mov', 'wmv'); // Allowed file extensions

        $imagename  = time();
        $config['upload_path']      = 'uploads/comments/';
        $config['allowed_types']    = $fileTypes;
        $config['max_size']         = '0';
        $logo_file_name             = '';
        $config['file_name']        =   $imagename;
        $this->upload->initialize($config);

        // $this->load->library('upload', $config);

        if ($this->upload->do_upload($f_n)) {
            $logo_data = $this->upload->data();
            $logo_file_name = $logo_data['file_name'];
        }

        if (!empty($logo_file_name)) {
            $img = $logo_file_name;
        } else {
            $img = 'default.png';
        }
        return $img;
    }

    public function postCourse()
    {
        if ($this->input->post()) {
            $course_name    = $this->input->post('course_name');
            $course_id      = $this->input->post('course_id');
            $professor_first_name   = $this->input->post('professor_first_name');
            $professor_last_name    = $this->input->post('professor_last_name');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];
            $page    = $this->input->post('page');
            foreach ($course_name as $key => $value) {
                $insertArr = array(
                    'user_id'   => $user_id,
                    'name'      => $value,
                    'course_id' => $course_id[$key],
                    'status'    => 1,
                    'created_at' => date('Y-m-d H:i:s')

                );

                $this->db->insert('course_master', $insertArr);
                $id = $this->db->insert_id();

                $full_name = $professor_first_name[$key] . ' ' . $professor_last_name[$key];

                $insertArr2 = array(
                    'name'          => $full_name,
                    'course_id'     => $id,
                    'first_name'    => $professor_first_name[$key],
                    'last_name'     => $professor_last_name[$key],
                    'status'        => 1,
                    'created_at'    => date('Y-m-d H:i:s')

                );

                $this->db->insert('professor_master', $insertArr2);
            }

            if($page == 'dashboard'){
                $get_course = $this->db->get_where($this->db->dbprefix('course_master'), array('course_master.user_id' => $user_id, 'course_master.status' => 1))->num_rows();
                echo $get_course;die;
            } else {
                $get_course = $this->db->get_where($this->db->dbprefix('course_master'), array('course_master.user_id' => $user_id, 'course_master.status' => 1))->result_array();
                $html = '<option value="">Select Course</option>';
                foreach ($get_course as $key => $value) {
                	$sel = '';
                	if($id == $value['id']){
                		$sel = 'selected';
                	}
                    $html.= '<option value="'.$value['id'].'" '.$sel.'>'.$value['name'].'</option>';
                }
                echo $html;die;
            }


        }
        
    }

    public function showAllCourses()
    {
        $user_id    = $this->session->get_userdata()['user_data']['user_id'];

        $this->db->select('course_master.*,professor_master.first_name,professor_master.last_name ');
        $this->db->join('professor_master', 'professor_master.course_id=course_master.id');

        $get_course = $this->db->get_where($this->db->dbprefix('course_master'), array('course_master.user_id' => $user_id, 'course_master.status' => 1))->result_array();
        $html = '';
        if (!empty($get_course)) {
            foreach ($get_course as $key => $value) {
                $html .= '<div class="courseBox">
                        <div class="removeCourseBoxIcon deleteCourseById" data-toggle="modal" data-target="#confirmationModalRemoveCourse" data-id="'.$value['id'].'">
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512.001 512.001;" xml:space="preserve">
                                <g>
                                    <g>
                                        <path d="M284.286,256.002L506.143,34.144c7.811-7.811,7.811-20.475,0-28.285c-7.811-7.81-20.475-7.811-28.285,0L256,227.717
                                            L34.143,5.859c-7.811-7.811-20.475-7.811-28.285,0c-7.81,7.811-7.811,20.475,0,28.285l221.857,221.857L5.858,477.859
                                            c-7.811,7.811-7.811,20.475,0,28.285c3.905,3.905,9.024,5.857,14.143,5.857c5.119,0,10.237-1.952,14.143-5.857L256,284.287
                                            l221.857,221.857c3.905,3.905,9.024,5.857,14.143,5.857s10.237-1.952,14.143-5.857c7.811-7.811,7.811-20.475,0-28.285
                                            L284.286,256.002z" />
                                    </g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                            </svg>

                        </div>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input type="text" readonly class="form-control form-control--lg" placeholder="Course ID" value="' . $value['course_id'] . '">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input type="text" readonly class="form-control form-control--lg course_name" placeholder="Course Name" value="' . $value['name'] . '">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input type="text" readonly class="form-control form-control--lg professor_first_name" placeholder="Professor First Name" value="' . $value['first_name'] . '">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input type="text" readonly class="form-control form-control--lg professor_last_name" placeholder="Professor Last Name" value="' . $value['last_name'] . '">
                                </div>
                            </div>
                        </div>
                    </div>';
            }
        } else {
            $html = '<h5 class="text-center" style="padding-top: 25px;">No course added yet.</h5>';
        }
        $num = count($get_course);
        echo json_encode(array("html" => $html, "num" => $num));
    }

    public function deleteCourseById(){
        if ($this->input->post()) {
            $course_id    = $this->input->post('course_id');

            $this->db->where(array('course_id' => $course_id));
            $this->db->delete('professor_master');

            $this->db->where(array('id' => $course_id));
            $this->db->delete('course_master');
            echo 1;die;
        }
    }

    public function uploadUserUploads($f_n, $name)
    {
        $fileTypes = array('jpg', 'jpeg', 'gif', 'png', 'zip', 'xlsx', 'cad', 'pdf', 'doc', 'docx', 'ppt', 'pptx', 'pps', 'ppsx', 'odt', 'xls', 'xlsx', '.mp3', 'm4a', 'ogg', 'wav', 'mp4', 'm4v', 'mov', 'wmv'); // Allowed file extensions

        $imagename  = time();
        $config['upload_path']      = 'uploads/user_uploads/';
        $config['allowed_types']    = $fileTypes;
        $config['max_size']         = '0';
        $logo_file_name             = '';
        $config['file_name']        =   $imagename;
        $this->upload->initialize($config);

        // $this->load->library('upload', $config);

        if ($this->upload->do_upload($f_n)) {
            $logo_data = $this->upload->data();
            $logo_file_name = $logo_data['file_name'];
        }

        if (!empty($logo_file_name)) {
            $img = $logo_file_name;
        } else {
            $img = 'default.png';
        }
        return $img;
    }

    public function uploadEditorImg()
    {
        if (isset($_FILES['upload']['name'])) {
            $c_image = $this->uploadUserUploads('upload', $_FILES['upload']['name']);

            $function_number = $_GET['CKEditorFuncNum'];
            $url = base_url() . 'uploads/user_uploads/' . $c_image;
            $message = '';
            echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($function_number, '$url', '$message');</script>";
        }
    }

    public function saveFirebaseToken()
    {
        if ($this->input->post()) {
            $token    = $this->input->post('token');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $chk = $this->db->get_where($this->db->dbprefix('user_token'), array('user_id' => $user_id, 'token' => $token))->row_array();

            $this->db->where(array('token' => $token, 'status' => 1));
            $this->db->update('user_token', array('status' => 2));

            $insertArr2 = array(
                'user_id'       => $user_id,
                'token'         => $token,
                'status'        => 1,
                'add_date'      => date('Y-m-d H:i:s')

            );

            $this->db->insert('user_token', $insertArr2);

            echo $token;
        }
    }

    public function sendPeerRequest()
    {
        if ($this->input->post()) {
            $peer_id    = $this->input->post('peer_id');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];


            $insertArr2 = array(
                'user_id'       => $user_id,
                'peer_id'       => $peer_id,
                'status'        => 1,
                'request_date'      => date('Y-m-d H:i:s')

            );

            $this->db->insert('peer_master', $insertArr2);

            $action_id = $this->db->insert_id();

            $userdata = $this->session->userdata('user_data');

            $user_detail    = $this->db->get_where('user', array('id' => $user_id))->row_array();
            $full_name      = $user_detail['first_name'] . ' ' . $user_detail['last_name'];

            $notification = "<b>" . $full_name . "</b> sent you peer request";

            $insertArr = array(
                'user_id'       => $peer_id,
                'notification'       => $notification,
                'action_type'   => 1,
                'action_id'     => $action_id,
                'img_user_id'   => $user_id,
                'status'        => 1,
                'created_at'    => date('Y-m-d H:i:s')

            );

            $this->db->insert('notification_master', $insertArr);

            $get_active_token = $this->db->get_where($this->db->dbprefix('user_token'), array('user_id' => $peer_id, 'status' => 1))->result_array();

            foreach ($get_active_token  as $key => $value) {
                $this->sendTestNotification($value['token'], 'New Peer Request', 'You have received a new Peer Request', $action_id);
            }

            echo 1;
        }
    }

    public function addCancelPeer()
    {
        $peer_id = $this->input->post('peer_id');
        $user_id = $this->session->get_userdata()['user_data']['user_id'];

        $chk_if_request = $this->db->get_where($this->db->dbprefix('peer_master'), array('peer_id' => $peer_id, 'user_id' => $user_id, 'status' => 1))->row_array();

        if (empty($chk_if_request)) {
            $insertArr2 = array(
                'user_id'       => $user_id,
                'peer_id'       => $peer_id,
                'status'        => 1,
                'request_date'      => date('Y-m-d H:i:s')

            );

            $this->db->insert('peer_master', $insertArr2);

            $action_id = $this->db->insert_id();

            $userdata = $this->session->userdata('user_data');

            $user_detail    = $this->db->get_where('user', array('id' => $user_id))->row_array();
            $full_name      = $user_detail['first_name'] . ' ' . $user_detail['last_name'];

            $notification = "<b>" . $full_name . "</b> sent you peer request";

            $insertArr = array(
                'user_id'       => $peer_id,
                'notification'       => $notification,
                'action_type'   => 1,
                'action_id'     => $action_id,
                'img_user_id'   => $user_id,
                'status'        => 1,
                'created_at'    => date('Y-m-d H:i:s')

            );

            $this->db->insert('notification_master', $insertArr);

            $get_active_token = $this->db->get_where($this->db->dbprefix('user_token'), array('user_id' => $peer_id, 'status' => 1))->result_array();

            foreach ($get_active_token  as $key => $value) {
                $this->sendTestNotification($value['token'], 'New Peer Request', 'You have received a new Peer Request', $action_id);
            }
            echo 'Cancel Request';
            die;
        } else {

            $this->db->where(array('action_id' => $chk_if_request['id']));
            $this->db->delete('notification_master');

            if ($chk_if_request['status'] == 1) {

                $this->db->where(array('id' => $chk_if_request['id']));
                $this->db->delete('peer_master');
            }
            echo 'Add Peer';
            die;
        }
    }

    public function sendTestNotification($token, $title, $body, $info)
    {
        $message['title'] = $title;
        $message['body'] = $body;
        sendFCM($message, $token, $info);
    }

    public function acceptRequest()
    {
        if ($this->input->post()) {
            $id    = $this->input->post('id');
            $action_id    = $this->input->post('action_id');

            $this->db->where(array('id' => $id));
            $this->db->update('notification_master', array('status' => 2));


            $detail = $this->db->get_where($this->db->dbprefix('peer_master'), array('id' => $action_id))->row_array();

            if ($detail['status'] == 1) {

                $insert_into_friends = [
                    'user_id' => $detail['user_id'],
                    'peer_id' => $detail['peer_id'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                $this->db->insert('friends', $insert_into_friends);

                $insert_data = array(
                    'user_id'       => $detail['user_id'],
                    'peer_id'       => $detail['peer_id'],
                );
                $insert_data_chk = $this->db->get_where($this->db->dbprefix('follow_master'), $insert_data)->row_array();
                if (empty($insert_data_chk)) {
                    $this->db->insert('follow_master', $insert_data);
                }

                $insert_into_friends = [
                    'user_id' => $detail['peer_id'],
                    'peer_id' => $detail['user_id'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                $this->db->insert('friends', $insert_into_friends);

                $insert_data = array(
                    'user_id'       => $detail['peer_id'],
                    'peer_id'       => $detail['user_id'],
                );
                $insert_data_chk = $this->db->get_where($this->db->dbprefix('follow_master'), $insert_data)->row_array();
                if (empty($insert_data_chk)) {
                    $this->db->insert('follow_master', $insert_data);
                }


                $this->db->where(array('id' => $action_id));
                $this->db->update('peer_master', array('status' => 2));

                $userdata = $this->session->userdata('user_data');
                $user_detail    = $this->db->get_where('user', array('id' => $detail['peer_id']))->row_array();
                $full_name      = $user_detail['first_name'] . ' ' . $user_detail['last_name'];

                $notification = "<b>" . $full_name . "</b> accepted your peer request";

                $insertArr = array(
                    'user_id'       => $detail['user_id'],
                    'notification'  => $notification,
                    'action_type'   => 2,
                    'action_id'     => 0,
                    'img_user_id'   => $detail['peer_id'],
                    'status'        => 1,
                    'created_at'    => date('Y-m-d H:i:s')

                );

                $this->db->insert('notification_master', $insertArr);

                $get_active_token = $this->db->get_where($this->db->dbprefix('user_token'), array('user_id' => $detail['user_id'], 'status' => 1))->result_array();

                foreach ($get_active_token  as $key => $value) {
                    $this->sendTestNotification($value['token'], 'Peer Request Accepted', 'Your Peer Request has been accepted by ' . $full_name . '.', '0');
                }
            }

            echo 1;
            die;
        }
    }


    public function readAllNotofication()
    {
        if ($this->input->post()) {
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $this->db->where(array('user_id' => $user_id));
            $this->db->update('notification_master', array('status' => 2));

            echo 1;
            die;
        }
    }


    public function cancelRequest()
    {
        if ($this->input->post()) {
            $peer_id    = $this->input->post('peer_id');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];

            $detail = $this->db->get_where($this->db->dbprefix('peer_master'), array('user_id' => $user_id, 'peer_id' => $peer_id, 'status' => 1))->row_array();


            $this->db->where(array('action_id' => $detail['id']));
            $this->db->update('notification_master', array('status' => 2));



            if ($detail['status'] == 1) {

                $this->db->where(array('id' => $detail['id']));
                $this->db->update('peer_master', array('status' => 3));
            }

            echo 1;
            die;
        }
    }


    public function rejectRequest()
    {
        if ($this->input->post()) {
            $id    = $this->input->post('id');
            $action_id    = $this->input->post('action_id');


            $detail = $this->db->get_where($this->db->dbprefix('peer_master'), array('id' => $action_id))->row_array();


            $this->db->where(array('id' => $id));
            $this->db->update('notification_master', array('status' => 2));



            if ($detail['status'] == 1) {

                $this->db->where(array('id' => $action_id));
                $this->db->update('peer_master', array('status' => 3));
            }

            echo 1;
            die;
        }
    }

    public function redirectAction()
    { {
            $id    = $this->input->post('id');

            $notification_detail = $this->db->get_where($this->db->dbprefix('notification_master'), array('id' => $id))->row_array();

            $this->db->where(array('id' => $id));
            $this->db->update('notification_master', array('status' => 2));

            $detail = $this->db->get_where($this->db->dbprefix('share_master'), array('id' => $notification_detail['action_id']))->row_array();

            if ($detail['reference'] == 'studyset') {
                echo base_url() . 'studyset/details/' . $detail['reference_id'];
                die;
            } else if ($detail['reference'] == 'event') {
                echo base_url() . 'account/eventDetails/' . base64_encode($detail['reference_id']);
                die;
            }
        }
    }

    public function getPeerToShare()
    {
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $document_id = $this->input->post('id');
        $peer_id = $this->input->post('peer_id');

        $peer_list = $this->db->query("SELECT * FROM `friends` WHERE (`user_id` = '" . $user_id . "')")->result_array();

        $html = '';

        foreach ($peer_list as $key => $value) {
            if ($value['user_id'] == $user_id) {
                $this->db->select('user_info.nickname,user_info.userID,user.id,user.username');
                $this->db->join('user', 'user.id=user_info.userID');
                $peer = $this->db->get_where($this->db->dbprefix('user_info'), array('userID' => $value['peer_id']))->row_array();
            } else {
                $this->db->select('user_info.nickname,user_info.userID,user.id,user.username');
                $this->db->join('user', 'user.id=user_info.userID');
                $peer = $this->db->get_where($this->db->dbprefix('user_info'), array('userID' => $value['user_id']))->row_array();
            }
            $chk_if_shared = $this->db->get_where($this->db->dbprefix('share_master'), array('peer_id' => $peer['userID'], 'reference' => 'document', 'reference_id' => $document_id, 'status' => 1))->row_array();

            $html .= '<section class="list"><section class="left">
                        <figure>
                            <img src="' . userImage($peer['userID']) . '" alt="user">
                        </figure>
                        <a href="' . base_url() . 'sp/' . $peer['username'] . '"><figcaption>' . $peer['nickname'] . '</figcaption></a>
                    </section>
                    <section class="action" id="action_' . $peer['userID'] . '">';
            if (empty($chk_if_shared)) {
                $html .= '<button type="button" class="like" onclick="shareToPeer(' . $peer['userID'] . ')">share</button>';
            } else {
                $html .= '<button type="button" class="like" onclick="unshareToPeer(' . $peer['userID'] . ')">shared</button>';
            }
            $html .= '</section>
                </section>';
        }
        echo $html;
        die;
    }

    public function shareToPeerDocument()
    {
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $id = $this->input->post('id');
        $peer_id = $this->input->post('peer_id');

        $insertArr = array(
            'reference' => 'document',
            'reference_id' => $id,
            'user_id' => $user_id,
            'peer_id' => $peer_id,
            'status' => '1',
            'created_at' => date("Y-m-d H:i:s")

        );
        $this->db->insert('share_master', $insertArr);

        $action_id = $this->db->insert_id();

        $userdata = $this->session->userdata('user_data');
        $user_detail    = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $full_name      = $user_detail['first_name'] . ' ' . $user_detail['last_name'];
        $notification = "<b>" . $full_name . "</b> has shared a document with you.";

        $insertArr = array(
            'user_id'       => $peer_id,
            'notification'  => $notification,
            'action_type'   => 3, // for share
            'action_id'     => $action_id,
            'img_user_id'   => $user_id,
            'status'        => 1,
            'created_at'    => date('Y-m-d H:i:s')

        );

        $this->db->insert('notification_master', $insertArr);

        $this->updateShareCountDocument($id);

        $det = $this->db->get_where($this->db->dbprefix('document_master'), array('id' => $id))->row_array();

        $get_active_token = $this->db->get_where($this->db->dbprefix('user_token'), array('user_id' => $peer_id, 'status' => 1))->result_array();

        foreach ($get_active_token  as $key => $value) {
            $this->sendTestNotification($value['token'], 'Document Shared', 'A document has been shared with you', $action_id);
        }
        echo $det['shareCount'];
        die;
    }

    function updateShareCountDocument($id)
    {
        $this->db->where('id', $id);
        $this->db->set('shareCount', 'shareCount+1', FALSE);
        $update_like = $this->db->update('document_master');
        return 1;
    }


    public function unshareToPeerDocument()
    {
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $id = $this->input->post('id');
        $peer_id = $this->input->post('peer_id');

        $this->db->order_by('share_master.id', 'desc');
        $action_detail    = $this->db->get_where('share_master', array('reference' => 'document', 'reference_id' => $id, 'user_id' => $user_id, 'peer_id' => $peer_id))->row_array();

        $this->db->where(array('id' => $action_detail['id']));
        $this->db->delete('share_master');

        $this->db->where(array('action_id' => $action_detail['id']));
        $this->db->delete('notification_master');

        $this->updateShareCountDocumentDec($id);

        $det = $this->db->get_where($this->db->dbprefix('document_master'), array('id' => $id))->row_array();


        echo $det['shareCount'];
        die;
    }

    function updateShareCountDocumentDec($id)
    {
        $this->db->where('id', $id);
        $this->db->set('shareCount', 'shareCount-1', FALSE);
        $update_like = $this->db->update('document_master');
        return 1;
    }

    public function getPeerToInvite()
    {
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $id = $this->input->post('id');


        $peer_list = $this->db->query("SELECT * FROM `friends` WHERE (`user_id` = '" . $user_id . "')")->result_array();

        $html = '';

        foreach ($peer_list as $key => $value) {
            if ($value['user_id'] == $user_id) {
                $this->db->select('user_info.nickname,user_info.userID,user.id,user.username');
                $this->db->join('user', 'user.id=user_info.userID');
                $peer = $this->db->get_where($this->db->dbprefix('user_info'), array('userID' => $value['peer_id']))->row_array();
            } else {
                $this->db->select('user_info.nickname,user_info.userID,user.id,user.username');
                $this->db->join('user', 'user.id=user_info.userID');
                $peer = $this->db->get_where($this->db->dbprefix('user_info'), array('userID' => $value['user_id']))->row_array();
            }
            $chk_if_shared = $this->db->get_where($this->db->dbprefix('share_master'), array('peer_id' => $peer['userID'], 'reference' => 'event', 'reference_id' => $id, 'status!=' => 4))->row_array();
            if (!empty($chk_if_shared)) {
                if ($chk_if_shared['status'] != 2) {
                    $html .= '<section class="list"><section class="left">
                            <figure>
                                <img src="' . userImage($peer['userID']) . '" alt="user">
                            </figure>
                            <a href="' . base_url() . 'sp/' . $peer['username'] . '"><figcaption>' . $peer['nickname'] . '</figcaption></a>
                        </section>
                        <section class="action" id="action_' . $peer['userID'] . '">';
                    if (empty($chk_if_shared)) {
                        $html .= '<button type="button" class="like" onclick="inviteToPeer(' . $peer['userID'] . ')">invite</button>';
                    } else {
                        $html .= '<button type="button" class="like" onclick="uninviteToPeer(' . $peer['userID'] . ')">invited</button>';
                    }
                    $html .= '</section>
                    </section>';
                }
            } else {
                $html .= '<section class="list"><section class="left">
                            <figure>
                                <img src="' . userImage($peer['userID']) . '" alt="user">
                            </figure>
                            <a href="' . base_url() . 'sp/' . $peer['username'] . '"><figcaption>' . $peer['nickname'] . '</figcaption></a>
                        </section>
                        <section class="action" id="action_' . $peer['userID'] . '">';
                if (empty($chk_if_shared)) {
                    $html .= '<button type="button" class="like" onclick="inviteToPeer(' . $peer['userID'] . ')">invite</button>';
                } else {
                    $html .= '<button type="button" class="like" onclick="uninviteToPeer(' . $peer['userID'] . ')">invited</button>';
                }
                $html .= '</section>
                    </section>';
            }
        }
        echo $html;
        die;
    }


    public function getPeersEVentAttending()
    {
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $id = $this->input->post('id');


        $peer_attending = $this->db->get_where('share_master', array('reference_id' => $id, 'reference' => 'event', 'status' => 2))->result_array();
        $event_details = $this->db->get_where('event_master', array('id' => $id))->row_array();

        $html = '';

        foreach ($peer_attending as $key => $value) {
            $this->db->select('user_info.nickname,user_info.userID,user.id,user.username');
            $this->db->join('user', 'user.id=user_info.userID');
            $peer = $this->db->get_where($this->db->dbprefix('user_info'), array('userID' => $value['peer_id']))->row_array();


            $html .= '<div id="remove_peer_' . $peer['userID'] . '"><section class="list"><section class="left" >
                            <figure>
                                <img src="' . userImage($peer['userID']) . '" alt="user">
                            </figure>
                            <a href="' . base_url() . 'sp/' . $peer['username'] . '"><figcaption>' . $peer['nickname'] . '</figcaption></a>
                        </section>';
            if ($event_details['created_by'] == $user_id) {
                $html .= '<section class="action" >
                    
                            <button type="button" class="like" onclick="removePeer(' . $peer['userID'] . ')">Remove</button></section>';
            } else {
                $html .= '<section class="action" >
                    
                            <button type="button" class="like">Attending</button></section></div>';
            }
        }
        echo $html;
        die;
    }

    public function invitePeerEvent()
    {
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $id = $this->input->post('id');
        $peer_id = $this->input->post('peer_id');

        $insertArr = array(
            'reference' => 'event',
            'reference_id' => $id,
            'user_id' => $user_id,
            'peer_id' => $peer_id,
            'status' => '1',
            'created_at' => date("Y-m-d H:i:s")

        );
        $this->db->insert('share_master', $insertArr);

        $action_id = $this->db->insert_id();

        $userdata = $this->session->userdata('user_data');
        $user_detail    = $this->db->get_where('user', array('id' => $user_id))->row_array();
        $full_name      = $user_detail['first_name'] . ' ' . $user_detail['last_name'];
        $notification = "<b>" . $full_name . "</b> has invited you to an event.";

        $insertArr = array(
            'user_id'       => $peer_id,
            'notification'  => $notification,
            'action_type'   => 4, // for invite
            'action_id'     => $action_id,
            'img_user_id'   => $user_id,
            'status'        => 1,
            'created_at'    => date('Y-m-d H:i:s')

        );

        $this->db->insert('notification_master', $insertArr);



        $get_active_token = $this->db->get_where($this->db->dbprefix('user_token'), array('user_id' => $peer_id, 'status' => 1))->result_array();

        foreach ($get_active_token  as $key => $value) {
            $this->sendTestNotification($value['token'], 'Event Invitation', 'You have received an event invitation', $action_id);
        }
        echo 1;
        die;
    }

    public function uninvitePeerEvent()
    {
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $id = $this->input->post('id');
        $peer_id = $this->input->post('peer_id');

        $this->db->order_by('share_master.id', 'desc');
        $action_detail = $this->db->get_where('share_master', array('reference' =>  'event', 'reference_id' => $id, 'user_id' => $user_id, 'peer_id' => $peer_id))->row_array();

        $this->db->where(array('id' => $action_detail['id']));
        $this->db->delete('share_master');

        $this->db->where(array('action_id' => $action_detail['id']));
        $this->db->delete('notification_master');

        echo 1;
        die;
    }

    public function removePeerAttending()
    {
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $id = $this->input->post('id');
        $peer_id = $this->input->post('peer_id');

        $this->db->order_by('share_master.id', 'desc');
        $action_detail = $this->db->get_where('share_master', array('reference' =>  'event', 'reference_id' => $id, 'user_id' => $user_id, 'peer_id' => $peer_id))->row_array();

        $this->db->where(array('id' => $action_detail['id']));
        $this->db->delete('share_master');


        echo 1;
        die;
    }


    public function removeSharedEvent()
    {
        $id = $this->input->post('id');
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $this->db->where(array('reference_id' => $id, 'reference' => 'event', 'peer_id' => $user_id));
        $result = $this->db->update('share_master', array('status' => 4));
        echo 1;
        die;
    }

    public function attendSharedEvent()
    {
        $id = $this->input->post('id');
        $type = $this->input->post('type');
        $user_id = $this->session->get_userdata()['user_data']['user_id'];
        $this->db->order_by('share_master.id', 'desc');
        $get_last_shared = $this->db->get_where($this->db->dbprefix('share_master'), array('reference_id' => $id, 'reference' => 'event', 'peer_id' => $user_id))->row_array();
        if (!empty($get_last_shared)) {
            if ($type == 'Attend') {
                $this->db->where(array('id' => $get_last_shared['id']));
                $result = $this->db->update('share_master', array('status' => 2));
                echo 'Unattend';
                die;
            } else {
                $this->db->where(array('id' => $get_last_shared['id']));
                $result = $this->db->update('share_master', array('status' => 3));
                echo 'Attend';
                die;
            }
        } else {
            $event = $this->db->get_where($this->db->dbprefix('event_master'), array('id' => $id))->row_array();
            $insertArr = array(
                'reference' => 'event',
                'reference_id' => $id,
                'user_id' => $event['created_by'],
                'peer_id' => $user_id,
                'status' => '2',
                'created_at' => date("Y-m-d H:i:s")

            );
            $this->db->insert('share_master', $insertArr);
            echo 'Unattend';
            die;
        }
    }


    public function getLatestNotification()
    {
        $user_id = $this->session->get_userdata()['user_data']['user_id'];

        $notification = $this->db->get_where('notification_master', array('user_id' => $user_id, 'status' => 1))->num_rows();

        $this->db->order_by('id', 'DESC');
        $this->db->limit('10');
        $last_notification = $this->db->get_where('notification_master', array('user_id' => $user_id, 'status!=' => 3))->result_array();

        $html = "";

        foreach ($last_notification as $key => $value) {
            $time_ago = time_ago_in_php($value['created_at']);
            $cls = "";
            if ($value['status'] == '2') {
                $cls = "read";
            }
            if ($value['action_type'] == 1) {


                $html .= '<li id="notification_' . $value['id'] . '" class="' . $cls . '">
                    <a>
                        <figure>
                            <img src="' . userImage($value['img_user_id']) . '" alt="user">
                        </figure>
                        <div class="right">
                            <h6>' . $value['notification'] . '</h6>
                            <div class="sortNotifyMessage">
                                <div class="info">
                                    Follower  • <div class="time">' . $time_ago . '</div>
                                </div>
                                <div class="optPreview">';
                if ($value['status'] == 1) {
                    $html .= '<div class="viewacceptance" id="accept_' . $value['id'] . '" onclick="acceptRequest(' . $value['id'] . ', ' . $value['action_id'] . ')">Accept</div>
                                        <div class="viewprofile" id="reject_' . $value['id'] . '" onclick="rejectRequest(' . $value['id'] . ', ' . $value['action_id'] . ')">Reject</div>';
                }
                $html .= '</div>
                            </div>
                        </div>
                    </a>
                </li>';
            } else if ($value['action_type'] == 2) {
                $html .= '<li id="notification_' . $value['id'] . '" class="' . $cls . '">
                    <a>
                        <figure>
                            <img src="' . userImage($value['img_user_id']) . '" alt="user">
                        </figure>
                        <div class="right">
                            <h6>' . $value['notification'] . '</h6>
                            <div class="sortNotifyMessage">
                                <div class="info">
                                    Follower  • <div class="time">' . $time_ago . '</div>
                                </div>
                                <div class="optPreview">

                                    <div class="viewprofile">View Profile</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>';
            } else if ($value['action_type'] == 3) {
                $html .= '<li id="notification_' . $value['id'] . '" class="' . $cls . '">
                    <a>
                        <figure>
                            <img src="' . userImage($value['img_user_id']) . '" alt="user">
                        </figure>
                        <div class="right">
                            <h6>' . $value['notification'] . '</h6>
                            <div class="sortNotifyMessage">
                                <div class="info">
                                    Studyset  • <div class="time">' . $time_ago . '</div>
                                </div>
                                <div class="viewprofile" onclick="redirectAction(' . $value['id'] . ')">View Studyset</div>
                            </div>
                        </div>
                    </a>
                </li>';
            } else if ($value['action_type'] == 4) {
                $html .= '<li id="notification_' . $value['id'] . '" class="' . $cls . '">
                    <a>
                        <figure>
                            <img src="' . userImage($value['img_user_id']) . '" alt="user">
                        </figure>
                        <div class="right">
                            <h6>' . $value['notification'] . '</h6>
                            <div class="sortNotifyMessage">
                                <div class="info">
                                    Event  • <div class="time">' . $time_ago . '</div>
                                </div>
                                <div class="viewprofile" onclick="redirectAction(' . $value['id'] . ')">View Event</div>
                            </div>
                        </div>
                    </a>
                </li>';
            }
        }


        $result['notification'] = $html;
        $result['count'] = $notification;

        print_r(json_encode($result));
        die;
    }


    public function reportEvent()
    {
        if ($this->input->post()) {
            $report_event_id              = $this->input->post('report_event_id');
            $report_reason          = $this->input->post('report_reason');
            $report_description     = $this->input->post('report_description');
            $user_id = $this->session->get_userdata()['user_data']['user_id'];


            $insertArr = array(
                'event_id'             => $report_event_id,
                'report_reason'         => $report_reason,
                'user_id'               => $user_id,
                'report_description'    => $report_description,
                'status'        => 1,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            );

            $this->db->insert('report_event', $insertArr);


            $message = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Event Reported Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></div>';
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('account/eventDetails/' . base64_encode($report_event_id)), 'refresh');
        }
    }


    public function getPostDataById()
    {
        if ($this->input->post()) {
            $post_id              = $this->input->post('post_id');

            $post_query = $this->db->query('SELECT * from posts where id = ' . $post_id)->row_array();
            $post_images_query = $this->db->query('SELECT * from post_images where post_id = ' . $post_id)->result_array();
            $post_videos_query = $this->db->query('SELECT * from post_videos where post_id = ' . $post_id)->result_array();
            $post_options_query = $this->db->query('SELECT * from post_poll_options where post_id = ' . $post_id)->result_array();
            $post_documents_query = $this->db->query('SELECT * from post_documents where post_id = ' . $post_id)->result_array();

            $posts['post_details'] = $post_query;
            $posts['post_images'] = $post_images_query;
            $posts['post_videos'] = $post_videos_query;
            $posts['post_poll_options'] = $post_options_query;
            $posts['post_documents'] = $post_documents_query;

            $html = $this->load->view('user/profile/edit-post-modal', $posts, true);
            echo $html;
        }
    }

    public function getPostPrivacyDataById(){
        if ($this->input->post()) {
            $post_id              = $this->input->post('post_id');

            $post_query = $this->db->query('SELECT * from posts where id = '.$post_id)->row_array();
            
            $posts['post_details'] = $post_query;
            

            $html = $this->load->view('user/profile/edit-post-privacy', $posts, true);
            echo $html;

        }
    }


    public function deletePollOption()
    {
        $option_id              = $this->input->post('option_id');

        $this->db->where(array('poll_option_id' => $option_id));
        $this->db->delete('user_poll_data');

        $this->db->where(array('id' => $option_id));
        $this->db->delete('post_poll_options');

        echo 1;
        die;
    }

    public function notVerifiedUser(){
        $this->load->view('not-verified-user');
    }

    public function deletePostImage(){
        $image_id              = $this->input->post('image_id');

        $post_image = $this->db->query('SELECT * from post_images where id = '.$image_id)->row_array();

         unlink(FCPATH .$post_image['image_path']);

        $this->db->where(array('id' => $image_id));
        $this->db->delete('post_images');


        echo 1;die;
    }



    public function deleteDocumentPost(){
        $doc_id              = $this->input->post('doc_id');

        $post_doc = $this->db->query('SELECT * from post_documents where id = '.$doc_id)->row_array();

        unlink(FCPATH .$post_doc['document_path']);

        $this->db->where(array('id' => $doc_id));
        $this->db->delete('post_documents');


        echo 1;die;
    }

	
	public function searchAllDetails()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('search_val','Search Word','required');
		
		if($this->form_validation->run() == FALSE){
			$result['status'] = false;
			$result['message'] = 'Fields are required!';

			print_r(json_encode($result));
			die;
		} else {
			$SearchText    = $this->input->post('search_val');
			
			$searchSession = array(
				'SearchText' => $SearchText
			);
			$this->session->set_userdata($searchSession);
			
			$CurrentUserID = $this->session->get_userdata()['user_data']['user_id'];
			
			// get reported questions
			$reportedUsers = array();
			$reportedUsersString = '';
			
			$getReportedUsers = "SELECT report_user_id FROM user_report_master WHERE user_id='".$CurrentUserID."' AND status='1'";
			$ReportedUsersResult = $this->db->query($getReportedUsers)->result_array();
			if(!empty($ReportedUsersResult)){
				foreach($ReportedUsersResult as $ReportedUsersResultData){
					$reportedUsers[] = $ReportedUsersResultData['report_user_id'];
				}
			}
			
			$getBlockedUsers = "SELECT peer_id FROM blocked_peers WHERE user_id='".$CurrentUserID."'";
			$BlockedUserResult = $this->db->query($getBlockedUsers)->result_array();
			if(!empty($BlockedUserResult)){
				foreach($BlockedUserResult as $BlockedUserResultData){
					$reportedUsers[] = $BlockedUserResultData['peer_id'];
				}
			}
			
			if(!empty($reportedUsers)){
				$reportedUsersString = implode(",",$reportedUsers);
			}
			
			$GetUserInfo   = $this->db->query("SELECT intitutionID FROM user_info WHERE userID='".$CurrentUserID."'")->row();
			$intitutionID  = (!empty($GetUserInfo)) ? $GetUserInfo->intitutionID : '';
			
			$LimitResult     = 10;
			$FoundResult     = 0;
			$FoundResult2    = 0;
			$FoundResult3    = 0;
			$RemainingResult = 0;
			$SearchHTML      = '';
			
			$SearchUserid = array();
			$ExistingUsers = array();
			
			// search for my friends / peers
			$SearchPeers = "SELECT peer_master.peer_id,user.id,user.username,user.first_name,user.last_name,user.image,user_info.gender,user_info.intitutionID,user_info.course FROM peer_master LEFT JOIN user ON (user.id = peer_master.peer_id) LEFT JOIN user_info ON (user_info.userID = user.id) WHERE peer_master.user_id='".$CurrentUserID."' AND peer_master.status='2' AND (user.first_name LIKE '%$SearchText%' OR user.last_name LIKE '%$SearchText%' OR user.username LIKE '%$SearchText%' OR user.about LIKE '%$SearchText%' OR user.email LIKE '%$SearchText%') ";
			
			if($reportedUsersString != ''){
				$SearchPeers .= " AND user.id NOT IN (".$reportedUsersString.")";
			}
			
			$SearchPeers .= " ORDER BY user.id DESC LIMIT 10";
			
			$SearchPeersResult = $this->db->query($SearchPeers)->result_array();
			$FoundResult = count($SearchPeersResult);
			
			if(!empty($SearchPeersResult))
			{
				foreach($SearchPeersResult as $SearchPeersResultData)
				{
					$SearchUserid[]  = $SearchPeersResultData['id'];
					
					if(!in_array($SearchPeersResultData['id'],$ExistingUsers)){
						$ExistingUsers[] = $SearchPeersResultData['id'];
						
						if($SearchPeersResultData['gender'] == 'female'){
							$UserProfile = base_url('uploads/user-female.png');
						} else if($SearchPeersResultData['gender'] == 'male') {
							$UserProfile = base_url('uploads/user-male.png');
						} else if($SearchPeersResultData['gender'] == 'other') {
							$UserProfile = base_url('uploads/user-anonymous.png');
						} else {
							$UserProfile = base_url().'assets_d/images/user.jpg';
						}
						
						if($SearchPeersResultData['image'] != '' && file_exists('uploads/users/'.$SearchPeersResultData['image'])){
							$UserProfile = base_url('uploads/users/'.$SearchPeersResultData['image']);
						}
						
						// get university name
						$UniversityName = '';
						$getUniversityName = "SELECT SchoolName FROM university WHERE university_id='".$SearchPeersResultData['intitutionID']."'";
						$UniversityNameResult = $this->db->query($getUniversityName)->result_array();
						if(!empty($UniversityNameResult)){
							$UniversityName = $UniversityNameResult[0]['SchoolName'];
						}
						
						// get master name
						$MasterName = '';
						$getMasterName = "SELECT name as field_of_study FROM field_of_study_master WHERE id='".$SearchPeersResultData['course']."'";
						$MasterNameResult = $this->db->query($getMasterName)->result_array();
						if(!empty($MasterNameResult)){
							$MasterName = $MasterNameResult[0]['field_of_study'];
						}
						
						$SearchHTML .= '
							<li>
								<a href="'.base_url('sp/'.$SearchPeersResultData['username']).'" data-user_id="'.$SearchPeersResultData['id'].'" class="storeHistory">
									<figure> <img src="'.$UserProfile.'" alt="Image"/> </figure>
									<strong>
										'.$SearchPeersResultData['first_name'].' '.$SearchPeersResultData['last_name'].' <span>in peers</span>
										<br>
										'.$UniversityName.' || '.$MasterName.'		
									</strong>
								</a>
							</li>';
					}
				}
			}
			
			$RemainingResult = $LimitResult - $FoundResult;
			
			$SearchUseridString = '';
			if(count($SearchUserid) > 0){
				$SearchUseridString = implode(",",$SearchUserid);
			}
			
			// get mutal friends from search result
			if(!empty($SearchPeersResult))
			{
				foreach($SearchPeersResult as $SearchPeersResultData)
				{
					$MutalQuery = "SELECT u.id,u.username,u.first_name,u.last_name,u.image,user_info.gender,user_info.intitutionID,user_info.course FROM friends f1 INNER JOIN friends f2 ON (f2.peer_id = f1.peer_id) INNER JOIN user u ON (u.id = f2.peer_id) LEFT JOIN user_info ON (user_info.userID = u.id) WHERE f1.user_id = '".$CurrentUserID."' AND f2.user_id = '".$SearchPeersResultData['id']."'";
					
					if($SearchUseridString != ''){
						$MutalQuery .= " AND u.id NOT IN (".$SearchUseridString.")";
					}
					
					if($reportedUsersString != ''){
						$MutalQuery .= " AND u.id NOT IN (".$reportedUsersString.")";
					}
					
					$SearchMutalFriends = $this->db->query($MutalQuery)->result_array();
					
					if(!empty($SearchMutalFriends)){
						foreach($SearchMutalFriends as $SearchMutalFriend){
							if(!in_array($SearchMutalFriend['id'],$ExistingUsers)){
								$RemainingResult--;
								if($RemainingResult == 0){
									break;
								}
								
								if($SearchMutalFriend['gender'] == 'female'){
									$UserProfile = base_url('uploads/user-female.png');
								} else if($SearchMutalFriend['gender'] == 'male') {
									$UserProfile = base_url('uploads/user-male.png');
								} else if($SearchMutalFriend['gender'] == 'other') {
									$UserProfile = base_url('uploads/user-anonymous.png');
								} else {
									$UserProfile = base_url().'assets_d/images/user.jpg';
								}
								
								if($SearchMutalFriend['image'] != '' && file_exists('uploads/users/'.$SearchMutalFriend['image'])){
									$UserProfile = base_url('uploads/users/'.$SearchMutalFriend['image']);
								}
								
								$SearchUserid[]  = $SearchMutalFriend['id'];
								$ExistingUsers[] = $SearchMutalFriend['id'];
								
								// get university name
								$UniversityName = '';
								$getUniversityName = "SELECT SchoolName FROM university WHERE university_id='".$SearchMutalFriend['intitutionID']."'";
								$UniversityNameResult = $this->db->query($getUniversityName)->result_array();
								if(!empty($UniversityNameResult)){
									$UniversityName = $UniversityNameResult[0]['SchoolName'];
								}
								
								// get master name
								$MasterName = '';
								$getMasterName = "SELECT name as field_of_study FROM field_of_study_master WHERE id='".$SearchMutalFriend['course']."'";
								$MasterNameResult = $this->db->query($getMasterName)->result_array();
								if(!empty($MasterNameResult)){
									$MasterName = $MasterNameResult[0]['field_of_study'];
								}
								
								$SearchHTML .= '
									<li>
										<a href="'.base_url('sp/'.$SearchMutalFriend['username']).'" data-user_id="'.$SearchMutalFriend['id'].'" class="storeHistory">
											<figure> <img src="'.$UserProfile.'" alt="Image"/> </figure>
											<strong>
												'.$SearchMutalFriend['first_name'].' '.$SearchMutalFriend['last_name'].' <span>in peers</span> 
												<br>
												'.$UniversityName.' || '.$MasterName.'	
											</strong>
											
										</a>
									</li>';
							}
						}
					}
				}
			}
			
			// search peers based on university
			if($intitutionID != '' && $RemainingResult != 0)
			{
				$SearchByUniversity = "SELECT user_info.userID,user.id,user.username,user.first_name,user.last_name,user.image,user_info.gender,user_info.intitutionID,user_info.course FROM user_info LEFT JOIN user ON (user.id = user_info.userID) WHERE user_info.userID != '".$CurrentUserID."' AND user_info.intitutionID='".$intitutionID."'";	
				
				if($SearchUseridString != ''){
					$SearchByUniversity .= " AND user.id NOT IN (".$SearchUseridString.")";
				}
				
				if($reportedUsersString != ''){
					$SearchByUniversity .= " AND user.id NOT IN (".$reportedUsersString.")";
				}
				
				$SearchByUniversity .= " AND (user.first_name LIKE '%$SearchText%' OR user.last_name LIKE '%$SearchText%' OR user.username LIKE '%$SearchText%' OR user.about LIKE '%$SearchText%' OR user.email LIKE '%$SearchText%')";
				
				$SearchByUniversity .= " ORDER BY user.id DESC LIMIT ".$RemainingResult;
				
				$SearchUniversityResult = $this->db->query($SearchByUniversity)->result_array();
				$FoundResult2 = count($SearchUniversityResult);
				
				if(!empty($SearchUniversityResult))
				{
					foreach($SearchUniversityResult as $SearchUniversityResultData)
					{
						$SearchUserid[]  = $SearchUniversityResultData['id'];
						if(!in_array($SearchUniversityResultData['id'],$ExistingUsers)){
							$ExistingUsers[] = $SearchUniversityResultData['id'];
							
							if($SearchUniversityResultData['gender'] == 'female'){
								$UserProfile = base_url('uploads/user-female.png');
							} else if($SearchUniversityResultData['gender'] == 'male') {
								$UserProfile = base_url('uploads/user-male.png');
							} else if($SearchUniversityResultData['gender'] == 'other') {
								$UserProfile = base_url('uploads/user-anonymous.png');
							} else {
								$UserProfile = base_url().'assets_d/images/user.jpg';
							}
							
							if($SearchUniversityResultData['image'] != '' && file_exists('uploads/users/'.$SearchUniversityResultData['image'])){
								$UserProfile = base_url('uploads/users/'.$SearchUniversityResultData['image']);
							}
							
							// get university name
							$UniversityName = '';
							$getUniversityName = "SELECT SchoolName FROM university WHERE university_id='".$SearchUniversityResultData['intitutionID']."'";
							$UniversityNameResult = $this->db->query($getUniversityName)->result_array();
							if(!empty($UniversityNameResult)){
								$UniversityName = $UniversityNameResult[0]['SchoolName'];
							}
							
							// get master name
							$MasterName = '';
							$getMasterName = "SELECT name as field_of_study FROM field_of_study_master WHERE id='".$SearchUniversityResultData['course']."'";
							$MasterNameResult = $this->db->query($getMasterName)->result_array();
							if(!empty($MasterNameResult)){
								$MasterName = $MasterNameResult[0]['field_of_study'];
							}
							
							$SearchHTML .= '
								<li>
									<a href="'.base_url('sp/'.$SearchUniversityResultData['username']).'" data-user_id="'.$SearchUniversityResultData['id'].'" class="storeHistory">
										<figure> <img src="'.$UserProfile.'" alt="Image"/> </figure>
										<strong>
										'.$SearchUniversityResultData['first_name'].' '.$SearchUniversityResultData['last_name'].' <span>in peers</span>
										<br>
										'.$UniversityName.' || '.$MasterName.'		
										</strong>
									</a>
								</li>';
						}
					}
				}
			}
			
			$SearchUseridStringStoreResult = '';
			if(count($SearchUserid) > 0){
				$SearchUseridStringStoreResult = implode(",",$SearchUserid);
			}
			
			if($RemainingResult != 0){
				$RemainingResult = $RemainingResult - $FoundResult2;	
			}
			
			// get result from the store result
			$SearchStoreQuery = "SELECT id,search_text,search_peer_id FROM recent_search_history WHERE 1=1 AND user_id='".$CurrentUserID."'";	
			if($SearchUseridStringStoreResult != ""){
				$SearchStoreQuery .= " AND (search_text != '' OR (search_peer_id != 0 AND search_peer_id NOT IN (".$SearchUseridStringStoreResult.")))";
			} else {
				$SearchStoreQuery .= " AND (search_text != '' OR search_peer_id != 0)";
			}
			$SearchStoreQuery .= " GROUP BY search_text ORDER BY created_at DESC LIMIT ".$RemainingResult;
			
			$SearchStoreResult = $this->db->query($SearchStoreQuery)->result_array();
			$FoundResult3 = count($SearchStoreResult);
			
			if(!empty($SearchStoreResult))
			{
				foreach($SearchStoreResult as $SearchStoreResultData)
				{
					if($SearchStoreResultData['search_peer_id'] != '' && $SearchStoreResultData['search_peer_id'] != 0){
						$SearchQ = "SELECT user.id,user.username,user.first_name,user.last_name,user.image,user_info.gender,user_info.intitutionID,user_info.course FROM user LEFT JOIN user_info ON (user_info.userID = user.id) WHERE user.id='".$SearchStoreResultData['search_peer_id']."'";
						
						if($reportedUsersString != ''){
							$SearchQ .= " AND user.id NOT IN (".$reportedUsersString.")";
						}
						
						$UserDetails = $this->db->query($SearchQ)->result_array();
						
						if(!empty($UserDetails)){
							if(!in_array($UserDetails[0]['id'],$ExistingUsers)){
								$ExistingUsers[] = $UserDetails[0]['id'];
								
								if($UserDetails[0]['gender'] == 'female'){
									$UserProfile = base_url('uploads/user-female.png');
								} else if($UserDetails[0]['gender'] == 'male') {
									$UserProfile = base_url('uploads/user-male.png');
								} else if($UserDetails[0]['gender'] == 'other') {
									$UserProfile = base_url('uploads/user-anonymous.png');
								} else {
									$UserProfile = base_url().'assets_d/images/user.jpg';
								}
								
								if($UserDetails[0]['image'] != '' && file_exists('uploads/users/'.$UserDetails[0]['image'])){
									$UserProfile = base_url('uploads/users/'.$UserDetails[0]['image']);
								}
								
								// get university name
								$UniversityName = '';
								$getUniversityName = "SELECT SchoolName FROM university WHERE university_id='".$UserDetails[0]['intitutionID']."'";
								$UniversityNameResult = $this->db->query($getUniversityName)->result_array();
								if(!empty($UniversityNameResult)){
									$UniversityName = $UniversityNameResult[0]['SchoolName'];
								}
								
								// get master name
								$MasterName = '';
								$getMasterName = "SELECT name as field_of_study FROM field_of_study_master WHERE id='".$UserDetails[0]['course']."'";
								$MasterNameResult = $this->db->query($getMasterName)->result_array();
								if(!empty($MasterNameResult)){
									$MasterName = $MasterNameResult[0]['field_of_study'];
								}
								
								$SearchHTML .= '
									<li class="searchHistory_'.$SearchStoreResultData['id'].'">
										<a href="'.base_url('sp/'.$UserDetails[0]['username']).'" data-user_id="'.$UserDetails[0]['id'].'" class="storeHistory">
											<figure> <img src="'.$UserProfile.'" alt="Image"/> </figure>
											<strong>
												'.$UserDetails[0]['first_name'].' '.$UserDetails[0]['last_name'].' <span>in peers</span> 
												<br>
												'.$UniversityName.' || '.$MasterName.'	
											</strong>
										</a>
										<div class="removeBadge">
											<span class="removeBadgeIcon" data-historyId="'.$SearchStoreResultData['id'].'"><i class="fa fa-times"></i></span>
										</div>
									</li>';		
							}
						}
						
					} else {
						$SearchHTML .= '
						<li class="searchHistory_'.$SearchStoreResultData['id'].'">
							<a href="'.base_url('account/searchResult/').'">
								<figure> <img src="'.base_url('assets_d/images/search.png').'" alt="Image"/> </figure>
								<strong>'.$SearchStoreResultData['search_text'].' <span>from previous search</span> </strong>
							</a>
							<div class="removeBadge">
								<span class="removeBadgeIcon" data-historyId="'.$SearchStoreResultData['id'].'"><i class="fa fa-times"></i></span>
							</div>
						</li>';
					}
					
				}
			}
			
			$result['status']      = true;
			$result['search_html'] = $SearchHTML;

			print_r(json_encode($result));
			die;
		}
	}
	
	function searchStore()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('search_text','Search Text','required');
		
		if($this->form_validation->run() == FALSE){
			$result['status'] = false;
			print_r(json_encode($result));
			die;
		} else {
			$search_text    = $this->input->post('search_text');
			$SearchedUserID = ($this->input->post('search_user_id')) ? $this->input->post('search_user_id') : 0;
			$CurrentUserID  = $this->session->get_userdata()['user_data']['user_id'];
			
			if($search_text != ''){
				$insertData['user_id']        = $CurrentUserID;
				$insertData['search_peer_id'] = $SearchedUserID;
				$insertData['search_text']    = $search_text;
				$insertData['created_at']     = date("Y-m-d H:i:s");
				$this->db->insert('recent_search_history',$insertData);
			}
			
			$result['status']      = true;
			print_r(json_encode($result));
			die;
		}
	}

    public function updatePrivacyOfPost(){
        $post_id              = $this->input->post('post_id');
        $privacy              = $this->input->post('privacy');
        $allow_comment        = $this->input->post('allow_comment');

        $this->db->where(array('id' => $post_id));
        $result = $this->db->update('posts', array('privacy_id' => $privacy, 'is_comment_on' => $allow_comment));

        echo 1;die;
    }


    public function getShareWithPeerById(){
    	if ($this->input->post()) {
            $post_id              = $this->input->post('post_id');

            $post_query = $this->db->query('SELECT * from posts where id = '.$post_id)->row_array();
            
            

        }
    }


    public function autoSuggestCourse(){
    	if ($this->input->post()) {
    		$keyword              = $this->input->post('keyword');
    		$id              = $this->input->post('id');
    		$user_id = $this->session->get_userdata()['user_data']['user_id'];
        
        	$user_info = $this->db->get_where('user_info', array('userID' => $user_id))->row_array();

        	$this->db->select('course_master.*');
            $this->db->join('user_info', 'user_info.userID=course_master.user_id');
            $this->db->like('course_master.name', $keyword);
            $result = $this->db->get_where($this->db->dbprefix('course_master'), array('user_info.intitutionID' => $user_info['intitutionID'], 'course_master.status' => 1, 'course_master.user_id !=' => $user_id))->result_array();

            $html = '';
            if (!empty($result)) {
                foreach ($result as $key => $value) {
                    $html .= '<div id="suggestion_' . $value['id'] . '" onclick="selectCourse(' . $value['id'] . ', '.$id.')">' . $value['name'] . '</div>';
                }
            }
            echo $html;
            die;
    	}
    }

    public function selectSuggestCourse(){
    	if ($this->input->post()) {
    		$course = $this->input->post('course');
    		$result = $this->db->get_where($this->db->dbprefix('course_master'), array('id' => $course))->row_array();

    		$professor = $this->db->get_where($this->db->dbprefix('professor_master'), array('course_id' => $course))->row_array();

    		$res['course_id']      = $result['course_id'];
			$res['first_name'] = $professor['first_name'];
			$res['last_name'] = $professor['last_name'];

			print_r(json_encode($res));


    	}
    }


    public function getDocPreview(){
    	if ($this->input->post()) {
            $id              = $this->input->post('id');
            $doc_detail = $this->db->query('SELECT * from document_master where id = '.$id)->row_array();
            $result['doc_detail'] = $doc_detail;

            $html = $this->load->view('user/profile/preview-document', $result, true);
            echo $html;

        }
    }
	
	public function searchHistory(){
		$CurrentUserID = $this->session->get_userdata()['user_data']['user_id'];
		
		// get reported questions
		$reportedUsers = array();
		$reportedUsersString = '';
		
		$getReportedUsers = "SELECT report_user_id FROM user_report_master WHERE user_id='".$CurrentUserID."' AND status='1'";
		$ReportedUsersResult = $this->db->query($getReportedUsers)->result_array();
		if(!empty($ReportedUsersResult)){
			foreach($ReportedUsersResult as $ReportedUsersResultData){
				$reportedUsers[] = $ReportedUsersResultData['report_user_id'];
			}
		}
		
		$getBlockedUsers = "SELECT peer_id FROM blocked_peers WHERE user_id='".$CurrentUserID."'";
		$BlockedUserResult = $this->db->query($getBlockedUsers)->result_array();
		if(!empty($BlockedUserResult)){
			foreach($BlockedUserResult as $BlockedUserResultData){
				$reportedUsers[] = $BlockedUserResultData['peer_id'];
			}
		}
		
		if(!empty($reportedUsers)){
			$reportedUsersString = implode(",",$reportedUsers);
		}
		
		// get result from the store result
		$SearchStoreQuery = "SELECT id,search_text,search_peer_id FROM recent_search_history WHERE 1=1 AND user_id='".$CurrentUserID."'";	
		$SearchStoreQuery .= " AND (search_text != '' OR search_peer_id != 0)";
		$SearchStoreQuery .= " GROUP BY search_text ORDER BY created_at DESC LIMIT 10";
		
		$SearchStoreResult = $this->db->query($SearchStoreQuery)->result_array();
		$FoundResult3 = count($SearchStoreResult);
		
		$SearchHTML = '';
		$ExistingUsers = array();
		
		if(!empty($SearchStoreResult))
		{
			foreach($SearchStoreResult as $SearchStoreResultData)
			{
				if($SearchStoreResultData['search_peer_id'] != '' && $SearchStoreResultData['search_peer_id'] != 0){
					
					$SearchUQuery = "SELECT user.id,user.username,user.first_name,user.last_name,user.image,user_info.gender,user_info.intitutionID,user_info.course FROM user LEFT JOIN user_info ON (user_info.userID = user.id) WHERE user.id='".$SearchStoreResultData['search_peer_id']."'";
					
					if($reportedUsersString != ''){
						$SearchUQuery .= " AND user.id NOT IN (".$reportedUsersString.")";
					}
					
					$UserDetails = $this->db->query($SearchUQuery)->result_array();
					
					if(!empty($UserDetails)){
						if(!in_array($UserDetails[0]['id'],$ExistingUsers)){
							$ExistingUsers[] = $UserDetails[0]['id'];
							
							if($UserDetails[0]['gender'] == 'female'){
								$UserProfile = base_url('uploads/user-female.png');
							} else if($UserDetails[0]['gender'] == 'male') {
								$UserProfile = base_url('uploads/user-male.png');
							} else if($UserDetails[0]['gender'] == 'other') {
								$UserProfile = base_url('uploads/user-anonymous.png');
							} else {
								$UserProfile = base_url().'assets_d/images/user.jpg';
							}
							
							if($UserDetails[0]['image'] != '' && file_exists('uploads/users/'.$UserDetails[0]['image'])){
								$UserProfile = base_url('uploads/users/'.$UserDetails[0]['image']);
							}
							
							// get university name
							$UniversityName = '';
							$getUniversityName = "SELECT SchoolName FROM university WHERE university_id='".$UserDetails[0]['intitutionID']."'";
							$UniversityNameResult = $this->db->query($getUniversityName)->result_array();
							if(!empty($UniversityNameResult)){
								$UniversityName = $UniversityNameResult[0]['SchoolName'];
							}
							
							// get master name
							$MasterName = '';
							$getMasterName = "SELECT name as field_of_study FROM field_of_study_master WHERE id='".$UserDetails[0]['course']."'";
							$MasterNameResult = $this->db->query($getMasterName)->result_array();
							if(!empty($MasterNameResult)){
								$MasterName = $MasterNameResult[0]['field_of_study'];
							}
							
							$SearchHTML .= '
								<li class="searchHistory_'.$SearchStoreResultData['id'].'">
									<a href="'.base_url('sp/'.$UserDetails[0]['username']).'" data-user_id="'.$UserDetails[0]['id'].'" class="storeHistory">
										<figure> <img src="'.$UserProfile.'" alt="Image"/> </figure>
										<strong>
											'.$UserDetails[0]['first_name'].' '.$UserDetails[0]['last_name'].' <span>in peers</span> 
											<br>
											'.$UniversityName.' || '.$MasterName.'	
										</strong>
									</a>
									<div class="removeBadge">
										<span class="removeBadgeIcon" data-historyId="'.$SearchStoreResultData['id'].'"><i class="fa fa-times"></i></span>
									</div>
								</li>';		
						}
					}
					
				} else {
					$SearchHTML .= '
					<li class="searchHistory_'.$SearchStoreResultData['id'].'">
						<a href="'.base_url('account/searchResult/').'">
							<figure> <img src="'.base_url('assets_d/images/search.png').'" alt="Image"/> </figure>
							<strong>'.$SearchStoreResultData['search_text'].' <span>from previous search</span> </strong>
						</a>
						<div class="removeBadge">
							<span class="removeBadgeIcon" data-historyId="'.$SearchStoreResultData['id'].'"><i class="fa fa-times"></i></span>
						</div>
					</li>';
				}
				
			}
			
			$result['status']      = true;
		} else {
			$result['status']      = false;
		}
		
		$result['search_html'] = $SearchHTML;

		print_r(json_encode($result));
		die;
	}
	
	public function removeStoredSearch(){
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('historyId','ID','required');
		
		if($this->form_validation->run() == FALSE){
			$result['status'] = false;
			print_r(json_encode($result));
			die;
		} else {
			$historyId     = $this->input->post('historyId');
			$CurrentUserID = $this->session->get_userdata()['user_data']['user_id'];
			
			$checkIfExist = "SELECT id,search_text FROM recent_search_history WHERE id='".$historyId."' AND user_id='".$CurrentUserID."'";
			$checkResultExist = $this->db->query($checkIfExist)->result_array();
			
			if(!empty($checkResultExist)){
				$searchText = $checkResultExist[0]['search_text'];
				
				$deleteHistory = "DELETE FROM recent_search_history WHERE search_text='".$searchText."' AND user_id='".$CurrentUserID."'";
				$deleteResult  = $this->db->query($deleteHistory);
				
				$result['status'] = true;
			} else {
				$result['status'] = false;	
			}
			
			print_r(json_encode($result));
			die;
		}
	}
	
	public function reportThings(){
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('primary_id','ID','required');
		$this->form_validation->set_rules('report_post_type','Report Type','required');
		$this->form_validation->set_rules('report_reason','Report Reason','required');
		$this->form_validation->set_rules('report_description','Report Description','required');
		$this->form_validation->set_rules('current_page','Redirection','required');
		if($this->form_validation->run() == FALSE){
			$errors = $this->form_validation->error_array();
			$this->session->set_flashdata('exception',$errors);
			
			if($this->input->post('current_page') != ''){
				if($this->input->post('current_page') == 'searchResult'){
					redirect('account/searchResult');
				}
			} else {
				redirect('account/searchResult');		
			}
		} else {
			$CurrentUserID = $this->session->get_userdata()['user_data']['user_id'];
			
			$primary_id         = ($this->input->post('primary_id')) ? $this->input->post('primary_id') : 0;
			$report_post_type   = $this->input->post('report_post_type');
			$report_reason      = $this->input->post('report_reason');
			$report_description = $this->input->post('report_description');
			$current_page       = $this->input->post('current_page');
			
			if($report_post_type == 'POSTS'){
				$insertPost['post_id']            = $primary_id;
				$insertPost['user_id']            = $CurrentUserID;
				$insertPost['report_reason']      = $report_reason;
				$insertPost['created_at']         = date("Y-m-d H:i:s");
				$insertPost['report_description'] = $report_description;
				$insertPost['status']             = 1;
				if($this->db->insert('report_post',$insertPost)){
					$this->session->set_flashdata('message',"You have succesfully reported this post.");
				} else {
					$this->session->set_flashdata('exception','Something went wrong!');
				}
			} else if($report_post_type == 'QUESTIONS') {
				$insertPost['question_id']        = $primary_id;
				$insertPost['user_id']            = $CurrentUserID;
				$insertPost['report_reason']      = $report_reason;
				$insertPost['created_at']         = date("Y-m-d H:i:s");
				$insertPost['report_description'] = $report_description;
				$insertPost['status']             = 1;
				if($this->db->insert('report_questions',$insertPost)){
					$this->session->set_flashdata('message',"You have succesfully reported this question.");
				} else {
					$this->session->set_flashdata('exception','Something went wrong!');
				}
			} else if($report_post_type == 'DOCUMENTS'){
				$insertPost['document_id']        = $primary_id;
				$insertPost['user_id']            = $CurrentUserID;
				$insertPost['report_reason']      = $report_reason;
				$insertPost['created_at']         = date("Y-m-d H:i:s");
				$insertPost['report_description'] = $report_description;
				$insertPost['status']             = 1;
				if($this->db->insert('report_documents',$insertPost)){
					$this->session->set_flashdata('message',"You have succesfully reported this document.");
				} else {
					$this->session->set_flashdata('exception','Something went wrong!');
				}
			} else if($report_post_type == 'STUDYSET'){
				$insertPost['study_set_id']       = $primary_id;
				$insertPost['user_id']            = $CurrentUserID;
				$insertPost['report_reason']      = $report_reason;
				$insertPost['created_at']         = date("Y-m-d H:i:s");
				$insertPost['report_description'] = $report_description;
				$insertPost['status']             = 1;
				if($this->db->insert('reported',$insertPost)){
					$this->session->set_flashdata('message',"You have succesfully reported this study set.");
				} else {
					$this->session->set_flashdata('exception','Something went wrong!');
				}
			} else if($report_post_type == 'EVENTS'){
				$insertPost['event_id']           = $primary_id;
				$insertPost['user_id']            = $CurrentUserID;
				$insertPost['report_reason']      = $report_reason;
				$insertPost['created_at']         = date("Y-m-d H:i:s");
				$insertPost['report_description'] = $report_description;
				$insertPost['status']             = 1;
				if($this->db->insert('report_event',$insertPost)){
					$this->session->set_flashdata('message',"You have succesfully reported this event.");
				} else {
					$this->session->set_flashdata('exception','Something went wrong!');
				}
			}
			
			if($this->input->post('current_page') != ''){
				if($this->input->post('current_page') == 'searchResult'){
					redirect('account/searchResult');
				} else if($this->input->post('current_page') == 'searchViewAll'){
					if($report_post_type == 'POSTS'){
						redirect('account/searchViewAll/posts');
					} else if($report_post_type == 'QUESTIONS') {
						redirect('account/searchViewAll/questions');
					} else if($report_post_type == 'DOCUMENTS') {
						 redirect('account/searchViewAll/documents');
					} else if($report_post_type == 'STUDYSET') {
						redirect('account/searchViewAll/studysets');
					} else if($report_post_type == 'EVENTS') {
						redirect('account/searchViewAll/events');
					} else {
						redirect('account/searchResult');	
					}
				}
			} else {
				redirect('account/searchResult');		
			}
		}
	}
}