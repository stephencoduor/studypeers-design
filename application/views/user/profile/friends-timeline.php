<?php
$full_name      = $user['first_name'] . ' ' . $user['last_name'];
$user_detail = $this->db->query("SELECT * from user As a INNER JOIN user_info As b ON a.id = b.userID INNER JOIN major_master As c ON b.major = c.id INNER JOIN university As d ON b.intitutionID = d.university_id WHERE a.id = " . $user_id)->row_array();

$login_user_id = $this->session->get_userdata()['user_data']['user_id'];
?>
<input type="hidden" id="base" value="<?php echo base_url(); ?>">

<input type="hidden" id="user_full_name" value="<?php echo $full_name; ?>">

<section class="mainContent profile">
    <div class="mainProfileWrapper">
        <div class="profileHeaderWrapper">
            <div class="profileBanner">
                <figure>
                    <?php if (empty($user['cover_image'])) {
                    ?>
                        <img id="currentCoverPicture" src="<?php echo base_url(); ?>assets_d/images/detail1.jpg" alt="Profile Banner">
                    <?php } else {
                    ?>
                        <img id="currentCoverPicture" src="<?php echo base_url() . "uploads/users/cover/" . $user['cover_image']; ?>" alt="Profile Banner">
                    <?php
                    } ?>
                </figure>
                <!-- <div class="changeProfileBanner">
                                    <img id="currentCoverPicture" src="<?php /*echo base_url(); */ ?>assets_d/images/camera_profile.svg" alt="change Profile Banner">
                                    <input type="file" name="upload_cover_image" id="upload_cover_image">
                                </div>-->
            </div>
            <div class="profileInfoWrapper">
                <div class="infoWrapper">
                    <div class="profileLogo">
                        <figure>
                            <?php if (empty($user['image'])) {
                                if (strcasecmp($user['gender'], 'male') == 0) {
                            ?>
                                    <img id="currentProfilePicture" src="<?php echo base_url(); ?>uploads/user-male.png" alt="User">
                                <?php } else {
                                ?>
                                    <img id="currentProfilePicture" src="<?php echo base_url(); ?>uploads/user-female.png" alt="User">
                                <?php
                                }
                            } else {
                                ?>
                                <img id="currentProfilePicture" src="<?php echo base_url(); ?>uploads/users/<?php echo $user['image']; ?>" alt="change profile banner" />
                            <?php
                            }
                            ?>

                        </figure>

                    </div>
                    <div class="profileDtl">
                        <div class="profileInformation">
                            <div class="info-profile">
                                <h4 class="name"><?php echo $full_name; ?></h4>
                                <input type="hidden" id="sharelink" value="<?php echo base_url() . 'sp/' . @$user['username']; ?>" />
                                <div class="tooltip" style="opacity: inherit;">
                                    <div class="shareProfile" id="copyShareLink" onmouseout="outFunc()">
                                        <span class="tooltiptext" id="myTooltip">Copy to clipboard</span>

                                        <img src="<?php echo base_url(); ?>assets_d/images/share-profile1.svg" alt="share profile"> Copy Profile Link
                                    </div>
                                </div>
                            </div>
                            <h6 class="username"><?php echo $user['username']; ?> <span>Joined on <?php echo date("F jS, Y", strtotime($user['added_on'])); ?></span></h6>
                            <ul class="socialstatus">
                                <li data-toggle="modal" data-target="#followerList" style="cursor: pointer;" class="followerListModal"> <span><?php echo $followers; ?></span> Followers</li>
                                <li data-toggle="modal" data-target="#followingList" style="cursor: pointer;" class="followingListModal"> <span><?php echo $followings; ?></span> Following</li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <img src="<?php echo base_url(); ?>assets_d/images/facebook.svg" alt="facebook">
                                    </a>

                                    <a href="javascript:void(0)">
                                        <img src="<?php echo base_url(); ?>assets_d/images/twitter.svg" alt="twitter">
                                    </a>

                                    <a href="javascript:void(0)">
                                        <img src="<?php echo base_url(); ?>assets_d/images/linkedin.svg" alt="linkedin">
                                    </a>

                                    <a href="javascript:void(0)">
                                        <img src="<?php echo base_url(); ?>assets_d/images/youtube.svg" alt="youtube">
                                    </a>
                                </li>
                            </ul>
                            <?php if (!empty($user_detail['user_location'])) { ?>
                                <div class="location">
                                    <img src="<?php echo base_url(); ?>assets_d/images/pin.svg" alt="location"> <?php echo $user['user_location']; ?>

                                </div>
                            <?php } ?>
                        </div>
                        <?php if($login_user_id != $user_id) { ?>
                            <div class="shareMenu shareOption">
                            <ul>
                                <?php if ($is_request_sent == 1) {
                                ?>
                                    <li><a href="javascript:void(0);" onclick="cancelRequest(<?= $user_id ?>)" id="add_peer">Cancel Request</a></li>

                                    <?php } else {
                                    if (!empty($chk_if_friend)) { ?>
                                        <li><a href="javascript:void(0);" id="add_peer">Peer</a></li>
                                    <?php } else { ?>
                                        <li><a href="javascript:void(0);" onclick="sendRequest(<?= $user_id ?>)" id="add_peer">Add Peer</a></li>
                                    <?php }
                                    ?>

                                <?php
                                } ?>
                                <?php if (!empty($chk_if_follow)) { ?>
                                    <li><a href="javascript:void(0)" class="follow_now follow_<?php echo $user_id; ?>" data-id="<?php echo $user_id; ?>" id="0">UnFollow</a></li>
                                <?php } else { ?>
                                    <li><a href="javascript:void(0)" class="follow_now follow_<?php echo $user_id; ?>" data-id="<?php echo $user_id; ?>" id="1">Follow</a></li>
                                <?php } ?>

                                <li>
                                    <img data-name="<?php echo $user['first_name'] . ' ' . $user['last_name']; ?>" data-groupId="0" data-id="<?php echo $user_id; ?>" src="<?php echo base_url(); ?>assets_d/images/messagebox.svg" class="open-single-chat-window" alt="Message">
                                </li>
                                <li class="dropdown">
                                    <img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="More Option">
                                    <ul>
                                        <li>
                                            <?php if (!empty($chk_if_reported)) { ?>
                                                <a role="menuitem" href="javascript:;" data-toggle="modal" data-target="#cancelReportModalUser">
                                                    <img src="<?php echo base_url(); ?>assets_d/images/report1.svg"> Report
                                                </a>
                                            <?php } else { ?>
                                                <a role="menuitem" href="javascript:;" data-toggle="modal" data-target="#reportModalUser">
                                                    <img src="<?php echo base_url(); ?>assets_d/images/report1.svg"> Report
                                                </a>
                                            <?php } ?>

                                        </li>
                                        <li>
                                            <a role="menuitem" href="javascript:void(0);" class="block_user" id="<?php echo $user['userID']; ?>">
                                                <img src="<?php echo base_url(); ?>assets_d/images/block.svg"> Block
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <?php } ?>
                        
                    </div>
                </div>
                <div class="tabularLiist">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#feed">Feeds</a></li>
                        <li><a data-toggle="tab" href="#profile">Profile</a></li>
                        <li><a data-toggle="tab" href="#peers">Peers </a></li>
                        <li><a data-toggle="tab" href="#institution">Institutions</a></li>
                        <li><a data-toggle="tab" href="#courses">Courses</a></li>
                        <li><a data-toggle="tab" href="#professor">Professor</a></li>
                        <li><a data-toggle="tab" href="#market">Market</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-content">
            <div id="feed" class="tab-pane fade in active">
                <div class="innerFeedTabs">
                    <div class="tabularLiist">
                        <ul class="nav nav-tabs">
                            <li class="active"><a class="loadAll" data-toggle="tab" href="#all">All</a></li>
                            <li><a class="loadPosts" data-toggle="tab" href="#posts">Posts</a></li>
                            <li><a class="loadQuestions" data-toggle="tab" href="#questions">Questions</a></li>
                            <li><a data-toggle="tab" class="loadDocuments" href="#documents">Documents</a></li>
                            <li><a data-toggle="tab" class="loadstudySets" href="#studySets">Study Sets</a></li>
                            <li><a data-toggle="tab" class="loadEvents" href="#events">Events</a></li>
                            <li><a data-toggle="tab" href="#articles">Articles</a></li>
                            <li><a data-toggle="tab" href="#studySessions">Study Sessions</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="all" class="tab-pane fade in active">
                                <div class="tabPaneWrapper">
                                    <div class="left">

                                        <div id="timeline-feeds">
                                            <div class="box-card message">
                                                <div class="createBox">
                                                    <p class="text-center" style="padding-bottom: 20px;">Loading Feeds..</p>
                                                </div>
                                            </div>
                                        </div>



                                    </div>

                                </div>
                            </div>
                            <div id="posts" class="tab-pane fade in">
                                <div id="timeline-post-feeds">
                                    <div class="box-card message">
                                        <div class="createBox">
                                            <p class="text-center" style="padding-bottom: 20px;">Loading Posts..</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="questions" class="tab-pane fade in">
                                <div id="timeline-questions-feeds">
                                    <div class="box-card message">
                                        <div class="createBox">
                                            <p class="text-center" style="padding-bottom: 20px;">Loading Questions..</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="documents" class="tab-pane fade in">
                                <div id="timeline-documents-feeds">
                                    <div class="box-card message">
                                        <div class="createBox">
                                            <p class="text-center" style="padding-bottom: 20px;">Loading Documents..</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="articles" class="tab-pane fade in">
                                <div class="coming-soon">
                                    <figure><img src="<?php echo base_url(); ?>assets_d/images/Final_file_First_GIF.gif" alt="Image"/>
                                </div>
                            </div>
                            <div id="studySets" class="tab-pane fade in">
                                <div id="timeline-studyset-feeds">
                                    <div class="box-card message">
                                        <div class="createBox">
                                            <p class="text-center" style="padding-bottom: 20px;">Loading Study Sets..</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="events" class="tab-pane fade in">
                                <div id="timeline-events-feeds">
                                    <div class="box-card message">
                                        <div class="createBox">
                                            <p class="text-center" style="padding-bottom: 20px;">Loading Events..</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="studySessions" class="tab-pane fade in">
                                <div class="coming-soon">
                                    <figure><img src="<?php echo base_url(); ?>assets_d/images/Final_file_First_GIF.gif" alt="Image"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="profile" class="tab-pane fade in">
                <div class="tabPaneWrapper">
                    <div class="left">
                        <div class="box-card">
                            <div class="createBox">
                                <div class="postWrapper">
                                    <h5>General Information</h5>

                                </div>
                                <div class="infoWrapper">
                                    <div class="list">
                                        <div class="heading">Profile Link</div>
                                        <div class="value"><a href="<?php echo base_url() . 'sp/' . $user_detail['username']; ?>"><?php echo base_url() . 'sp/' . $user_detail['username']; ?></a></div>
                                    </div>
                                    <div class="list">
                                        <div class="heading">First Name</div>
                                        <div class="value"><?php echo $user_detail['first_name']; ?></div>
                                    </div>
                                    <div class="list">
                                        <div class="heading">Last Name</div>
                                        <div class="value"><?php echo $user_detail['last_name']; ?></div>
                                    </div>
                                    <div class="list">
                                        <div class="heading">Gender</div>
                                        <div class="value"><?php echo $user_detail['gender']; ?></div>
                                    </div>
                                    <div class="list">
                                        <div class="heading">Date of Birth</div>
                                        <div class="value"><?php echo date('d-m-Y', strtotime($user_detail['dob'])); ?></div>
                                    </div>
                                    <div class="list">
                                        <div class="heading">Location</div>
                                        <div class="value"><?php echo $user_detail['user_location']; ?></div>
                                    </div>
                                    <div class="list">
                                        <div class="heading">Field of interest</div>
                                        <div class="value"><?php echo $user_detail['field_interest']; ?></div>
                                    </div>
                                </div>
                                <div class="useraboutWrapper">
                                    <h5>About Me</h5>
                                    <p><?php echo $user_detail['about']; ?></p>
                                </div>
                                <div class="infoWrapper">
                                    <div class="list">
                                        <div class="heading">High School </div>
                                        <div class="value">
                                            <span><?php echo @$user_detail['high_School']; ?></span>
                                            <br>
                                            <?php echo @$user_detail['high_school_course_name']; ?> <?php echo (@$user_detail['high_school_course_year']); ?>
                                        </div>
                                    </div>
                                    <div class="list">
                                        <div class="heading">Graduation</div>
                                        <div class="value">
                                            <span><?php echo @$user_detail['SchoolName'] ?></span>
                                            <br>
                                            <?php echo @$user_detail['name'] ?> <?php echo @$user_detail['session'] ?>
                                        </div>
                                    </div>
                                    <!-- <div class="list">
                                        <div class="heading">Other</div>
                                        <div class="value">
                                            <span>Institute name</span>
                                            <br>
                                            Course (yyyy-yyyy)
                                        </div>
                                    </div> -->
                                </div>
                                <div class="useraboutWrapper social">
                                    <h5>Follow</h5>
                                    <ul>
                                        <li>
                                            <a href="<?php echo @$user_detail['fb_link']; ?>" target="_blank">
                                                <img src="<?php echo base_url(); ?>assets_d/images/facebook.svg" alt="facebook">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo @$user_detail['twitter_link']; ?>" target="_blank">
                                                <img src="<?php echo base_url(); ?>assets_d/images/twitter.svg" alt="twitter">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo @$user_detail['linkedIn_link']; ?>" target="_blank">
                                                <img src="<?php echo base_url(); ?>assets_d/images/linkedin.svg" alt="linkedin">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo @$user_detail['youtube_link']; ?>" target="_blank">
                                                <img src="<?php echo base_url(); ?>assets_d/images/youtube.svg" alt="youtube">
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="right">
                        <div class="boxwrap completeProfile">
                            <h6>Complete your profile</h6>
                            <p>Current status of your profile</p>
                            <div class="profileProgressBar">
                                <div class="progress mx-auto" data-value="40">
                                    <span class="progress-left">
                                        <span class="progress-bar border-primary"></span>
                                    </span>
                                    <span class="progress-right">
                                        <span class="progress-bar border-primary" style="transform: rotate(144deg);"></span>
                                    </span>
                                    <div class="profileUser">
                                        <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                                    </div>
                                </div>
                                <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                    <div class="h2 font-weight-bold">40<sup class="small">%</sup></div>
                                    <div class="complete">Complete</div>
                                </div>
                            </div>
                            <div class="completeNow">
                                <button type="button" class="event_action">Complete Now</button>
                            </div>
                        </div>
                        <div class="boxwrap">
                            <h6>Latest Updates</h6>
                            <p>Peers</p>
                            <div class="listBox">
                                <div class="listWrap">
                                    <div class="left">
                                        <figure>
                                            <img src="images/user.jpg" alt="user">
                                        </figure>
                                    </div>
                                    <div class="right">
                                        <h6>Jane Doe</h6>
                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>
                                    </div>
                                </div>
                                <div class="listWrap">
                                    <div class="left">
                                        <figure>
                                            <img src="images/user.jpg" alt="user">
                                        </figure>
                                    </div>
                                    <div class="right">
                                        <h6>Jane Doe</h6>
                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>
                                    </div>
                                </div>
                                <div class="listWrap">
                                    <div class="left">
                                        <figure>
                                            <img src="images/user.jpg" alt="user">
                                        </figure>
                                    </div>
                                    <div class="right">
                                        <h6>Jane Doe</h6>
                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>
                                    </div>
                                </div>
                            </div>
                            <p>Institutions</p>
                            <div class="listBox last">
                                <div class="listWrap">
                                    <div class="left">
                                        <figure>
                                            <img src="images/user.jpg" alt="user">
                                        </figure>
                                    </div>
                                    <div class="right">
                                        <h6>Jane Doe</h6>
                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>
                                    </div>
                                </div>
                                <div class="listWrap">
                                    <div class="left">
                                        <figure>
                                            <img src="images/user.jpg" alt="user">
                                        </figure>
                                    </div>
                                    <div class="right">
                                        <h6>Jane Doe</h6>
                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>
                                    </div>
                                </div>
                                <div class="listWrap">
                                    <div class="left">
                                        <figure>
                                            <img src="images/user.jpg" alt="user">
                                        </figure>
                                    </div>
                                    <div class="right">
                                        <h6>Jane Doe</h6>
                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
            <div id="peers" class="tab-pane fade in">
                <div class="innerFeedTabs">
                    <div class="tabularLiist">
                        <div class="TabsAndSortWrapper">
                            <!-- <ul class="nav nav-tabs">
                                <li class="active selection_type" data-id="1"><a data-toggle="tab" href="#myconnections">My Connections (<?php echo $connections; ?>)</a></li>
                                <li class="selection_type" data-id="0"><a data-toggle="tab" href="#requests">Requests (<?php echo $requests; ?>)</a></li>
                            </ul> -->
                            <div class="search">
                                <div class="searchIcon">
                                    <img src="<?php echo base_url() ?>/assets_d/images/search.png" alt="search">
                                </div>
                                <input type="text" name="search_friend" id="user_search_friend">
                                <input type="hidden" name="profile_user_id" id="profile_user_id" value="<?= $user_id; ?>">
                            </div>
                            <div class="sortWrapper">
                                <ul>
                                    <li>
                                        <div class="selectOrder">
                                            <select name="sort" id="sort">
                                                <option value="volvo">Alphabetical</option>
                                            </select>
                                        </div>
                                    </li>
                                    <li class="grid active">
                                        <img src="<?php echo base_url() ?>/assets_d/images/grid-box-blue.svg" alt="Grid">
                                    </li>
                                    <li class="list">
                                        <img src="<?php echo base_url() ?>/assets_d/images/list-box-grey.svg" alt="List">
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div id="myconnections" class="tab-pane fade in active">
                                <div class="tabPaneWrapper">
                                    <div class="left">
                                        <div class="userBoxWrapper gridview" id="friend_container">
                                <?php if(isset($all_connections)){ foreach($all_connections as $peer){ 
                                    $followersC = $this->db->query('SELECT COUNT(*) As total from follow_master where peer_id = '.$peer['userID'])->row_array();
                                ?>
                                <div class="card" id="remove_friend_<?php echo $peer['userID']; ?>">
                                    <div class="profileSection">
                                        <div class="profileViewToggleWrapper">
                                            <figure>
                                                <img src="<?php echo userImage($peer['userID']); ?>">
                                            </figure>
                                            <div class="changeView">
                                                <h5><a href="<?php echo base_url(); ?>sp/<?php echo $peer['username'] ?>"><?php echo $peer['first_name'].' '.$peer['last_name']; ?></a></h5>
                                                <p><?php echo $peer['user_location']; ?></p>
                                                <div class="followers">
                                                    <span><?php echo $followersC['total']; ?> </span> Followers
                                                </div>
                                            </div>
                                        </div>
                                        <?php if($peer['userID'] != $this->session->get_userdata()['user_data']['user_id']) { ?>
                                            <div class="followOptionsWrapper">
                                                <ul>
                                                    <li>
                                                        <?php $follow_status = checkFollowStatus($this->session->get_userdata()['user_data']['user_id'] , $peer['userID']);
                                                            if($follow_status){
                                                                ?>
                                                                <a href="javascript:void(0)" class="follow_now follow_<?php echo $peer['userID']; ?>" data-id="<?php echo $peer['userID']; ?>" id="0">UnFollow</a>
                                                                <?php
                                                            }else{
                                                                ?>
                                                                <a href="javascript:void(0)" class="follow_now follow_<?php echo $peer['userID']; ?>" data-id="<?php echo $peer['userID']; ?>" id="1">Follow</a>
                                                                <?php
                                                            }
                                                        ?>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0)" class="unfriend_peer" data-toggle="modal" data-target="#unfriend_peer" id="<?php echo $peer['userID']; ?>">Unfriend</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php  } }?>
                            </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div id="requests" class="tab-pane fade in">
                                <div class="tabPaneWrapper">
                                    <div class="left">
                            <div class="userBoxWrapper gridview" id="request_container">
                                <?php if(isset($all_requests)){ foreach($all_requests as $peer){ ?>
                                    <div class="card" id="action_<?php echo $peer['action_id']; ?>">
                                        <div class="profileSection">
                                            <div class="profileViewToggleWrapper">
                                                <figure>
                                                    <img src="<?php echo userImage($peer['id']); ?>">
                                                </figure>
                                                <div class="changeView">
                                                    <h5><?php echo $peer['first_name'].' '.$peer['last_name']; ?></h5>
                                                    <p>location name</p>
                                                    <div class="followers">
                                                        <span>25 </span> Followers
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="followOptionsWrapper">
                                                <ul>
                                                    <li class="follower">
                                                        <a href="javascript:void(0)">
                                                            Accept
                                                        </a>
                                                    </li>
                                                    <li class="follower">
                                                        <a href="javascript:void(0)">Reject</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <?php } } ?>
                            </div>
                        </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="institution" class="tab-pane fade in">
                <!-- <div class="TabsAndSortWrapper institute">
                    <div class="sortWrapper">
                        <ul>
                            <li>
                                <div class="selectOrder">
                                    <select name="sort" id="sort">
                                        <option value="volvo">Alphabetical</option>
                                    </select>
                                </div>
                            </li>
                            <li class="grid active">
                                <img src="<?php echo base_url(); ?>assets_d//grid-box-blue.svg" alt="Grid">
                            </li>
                            <li class="list">
                                <img src="<?php echo base_url(); ?>assets_d//list-box-grey.svg" alt="List">
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tabPaneWrapper">
                    <div class="left">
                        <div class="userBoxWrapper gridview">
                            <div class="card">
                                <div class="messagePeerBox">
                                    <img src="<?php echo base_url(); ?>assets_d//messagebox.svg" alt="Message">
                                </div>
                                <div class="profileSection">
                                    <div class="profileViewToggleWrapper">
                                        <figure>
                                            <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                                        </figure>
                                        <div class="changeView">
                                            <h5>Institution Name</h5>
                                            <p>location name</p>
                                            <div class="followers">
                                                <span>25 </span> Followers
                                            </div>
                                        </div>
                                    </div>
                                    <div class="followOptionsWrapper">
                                        <ul>
                                            <li class="follower">
                                                <a href="javascript:void(0)">Follow</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">Attendening</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="messagePeerBox">
                                    <img src="<?php echo base_url(); ?>assets_d//messagebox.svg" alt="Message">
                                </div>
                                <div class="profileSection">
                                    <div class="profileViewToggleWrapper">
                                        <figure>
                                            <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                                        </figure>
                                        <div class="changeView">
                                            <h5>Institution Name</h5>
                                            <p>location name</p>
                                            <div class="followers">
                                                <span>25 </span> Followers
                                            </div>
                                        </div>
                                    </div>
                                    <div class="followOptionsWrapper">
                                        <ul>
                                            <li>
                                                <a href="javascript:void(0)">Following</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">Attendening</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="messagePeerBox">
                                    <img src="<?php echo base_url(); ?>assets_d//messagebox.svg" alt="Message">
                                </div>
                                <div class="profileSection">
                                    <div class="profileViewToggleWrapper">
                                        <figure>
                                            <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                                        </figure>
                                        <div class="changeView">
                                            <h5>Institution Name</h5>
                                            <p>location name</p>
                                            <div class="followers">
                                                <span>25 </span> Followers
                                            </div>
                                        </div>
                                    </div>
                                    <div class="followOptionsWrapper">
                                        <ul>
                                            <li>
                                                <a href="javascript:void(0)">Following</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">Attendening</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="messagePeerBox">
                                    <img src="<?php echo base_url(); ?>assets_d//messagebox.svg" alt="Message">
                                </div>
                                <div class="profileSection">
                                    <div class="profileViewToggleWrapper">
                                        <figure>
                                            <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                                        </figure>
                                        <div class="changeView">
                                            <h5>Institution Name</h5>
                                            <p>location name</p>
                                            <div class="followers">
                                                <span>25 </span> Followers
                                            </div>
                                        </div>
                                    </div>
                                    <div class="followOptionsWrapper">
                                        <ul>
                                            <li>
                                                <a href="javascript:void(0)">Following</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">Attendening</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="messagePeerBox">
                                    <img src="<?php echo base_url(); ?>assets_d//messagebox.svg" alt="Message">
                                </div>
                                <div class="profileSection">
                                    <div class="profileViewToggleWrapper">
                                        <figure>
                                            <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                                        </figure>
                                        <div class="changeView">
                                            <h5>Institution Name</h5>
                                            <p>location name</p>
                                            <div class="followers">
                                                <span>25 </span> Followers
                                            </div>
                                        </div>
                                    </div>
                                    <div class="followOptionsWrapper">
                                        <ul>
                                            <li>
                                                <a href="javascript:void(0)">Following</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">Attendening</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="messagePeerBox">
                                    <img src="<?php echo base_url(); ?>assets_d//messagebox.svg" alt="Message">
                                </div>
                                <div class="profileSection">
                                    <div class="profileViewToggleWrapper">
                                        <figure>
                                            <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                                        </figure>
                                        <div class="changeView">
                                            <h5>Institution Name</h5>
                                            <p>location name</p>
                                            <div class="followers">
                                                <span>25 </span> Followers
                                            </div>
                                        </div>
                                    </div>
                                    <div class="followOptionsWrapper">
                                        <ul>
                                            <li>
                                                <a href="javascript:void(0)">Following</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">Attendening</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="right">
                        <div class="boxwrap completeProfile">
                            <h6>Complete your profile</h6>
                            <p>Current status of your profile</p>
                            <div class="profileProgressBar">
                                <div class="progress mx-auto" data-value="40">
                                    <span class="progress-left">
                                        <span class="progress-bar border-primary"></span>
                                    </span>
                                    <span class="progress-right">
                                        <span class="progress-bar border-primary" style="transform: rotate(144deg);"></span>
                                    </span>
                                    <div class="profileUser">
                                        <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                                    </div>
                                </div>
                                <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                    <div class="h2 font-weight-bold">40<sup class="small">%</sup></div>
                                    <div class="complete">Complete</div>
                                </div>
                            </div>
                            <div class="completeNow">
                                <button type="button" class="event_action">Complete Now</button>
                            </div>
                        </div>
                        <div class="boxwrap">
                            <h6>Latest Updates</h6>
                            <p>Peers</p>
                            <div class="listBox">
                                <div class="listWrap">
                                    <div class="left">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets_d//user.jpg" alt="user">
                                        </figure>
                                    </div>
                                    <div class="right">
                                        <h6>Jane Doe</h6>
                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>
                                    </div>
                                </div>
                                <div class="listWrap">
                                    <div class="left">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets_d//user.jpg" alt="user">
                                        </figure>
                                    </div>
                                    <div class="right">
                                        <h6>Jane Doe</h6>
                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>
                                    </div>
                                </div>
                                <div class="listWrap">
                                    <div class="left">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets_d//user.jpg" alt="user">
                                        </figure>
                                    </div>
                                    <div class="right">
                                        <h6>Jane Doe</h6>
                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>
                                    </div>
                                </div>
                            </div>
                            <p>Institutions</p>
                            <div class="listBox last">
                                <div class="listWrap">
                                    <div class="left">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets_d//user.jpg" alt="user">
                                        </figure>
                                    </div>
                                    <div class="right">
                                        <h6>Jane Doe</h6>
                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>
                                    </div>
                                </div>
                                <div class="listWrap">
                                    <div class="left">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets_d//user.jpg" alt="user">
                                        </figure>
                                    </div>
                                    <div class="right">
                                        <h6>Jane Doe</h6>
                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>
                                    </div>
                                </div>
                                <div class="listWrap">
                                    <div class="left">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets_d//user.jpg" alt="user">
                                        </figure>
                                    </div>
                                    <div class="right">
                                        <h6>Jane Doe</h6>
                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="coming-soon">
                    <figure><img src="<?php echo base_url(); ?>assets_d/images/Final_file_First_GIF.gif" alt="Image"/>
                </div>
            </div>
            <div id="courses" class="tab-pane fade in">
                <!-- <div class="TabsAndSortWrapper courses">
                    <div class="sortWrapper">
                        <ul>
                            <li>
                                <div class="selectOrder">
                                    <select name="sort" id="sort">
                                        <option value="volvo">Alphabetical</option>
                                    </select>
                                </div>
                            </li>
                            <li class="grid active">
                                <img src="<?php echo base_url(); ?>assets_d//grid-box-blue.svg" alt="Grid">
                            </li>
                            <li class="list">
                                <img src="<?php echo base_url(); ?>assets_d//list-box-grey.svg" alt="List">
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tabPaneWrapper courseView">
                    <div class="left">
                        <div class="userBoxWrapper gridview">
                            <div class="card">
                                <div class="profileSection">
                                    <div class="profileViewToggleWrapper">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets_d//detail1.jpg">
                                        </figure>
                                        <div class="changeView">
                                            <h5>Course Name</h5>
                                            <div class="courseStructure">
                                                <p>10 lessons</p>
                                                <div class="statusourse progress">
                                                    66% complete
                                                </div>
                                            </div>
                                            <div class="professorInfo">
                                                <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                                                Professor name
                                            </div>
                                        </div>
                                    </div>
                                    <div class="courseStatusBox">
                                        <div class="statusCheck progress">In Progress</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="profileSection">
                                    <div class="profileViewToggleWrapper">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets_d//detail1.jpg">
                                        </figure>
                                        <div class="changeView">
                                            <h5>Course Name</h5>
                                            <div class="courseStructure">
                                                <p>10 lessons</p>
                                                <div class="statusourse complete">
                                                    100% complete
                                                </div>
                                            </div>
                                            <div class="professorInfo">
                                                <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                                                Professor name
                                            </div>
                                        </div>
                                    </div>
                                    <div class="courseStatusBox">
                                        <div class="statusCheck complete">In Progress</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="profileSection">
                                    <div class="profileViewToggleWrapper">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets_d//detail1.jpg">
                                        </figure>
                                        <div class="changeView">
                                            <h5>Course Name</h5>
                                            <div class="courseStructure">
                                                <p>10 lessons</p>
                                                <div class="statusourse enrolled">
                                                    0% complete
                                                </div>
                                            </div>
                                            <div class="professorInfo">
                                                <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                                                Professor name
                                            </div>
                                        </div>
                                    </div>
                                    <div class="courseStatusBox">
                                        <div class="statusCheck enrolled">Enrolled</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="profileSection">
                                    <div class="profileViewToggleWrapper">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets_d//detail1.jpg">
                                        </figure>
                                        <div class="changeView">
                                            <h5>Course Name</h5>
                                            <div class="courseStructure">
                                                <p>10 lessons</p>
                                                <div class="statusourse complete">
                                                    100% complete
                                                </div>
                                            </div>
                                            <div class="professorInfo">
                                                <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                                                Professor name
                                            </div>
                                        </div>
                                    </div>
                                    <div class="courseStatusBox">
                                        <div class="statusCheck complete">In Progress</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="profileSection">
                                    <div class="profileViewToggleWrapper">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets_d//detail1.jpg">
                                        </figure>
                                        <div class="changeView">
                                            <h5>Course Name</h5>
                                            <div class="courseStructure">
                                                <p>10 lessons</p>
                                                <div class="statusourse complete">
                                                    100% complete
                                                </div>
                                            </div>
                                            <div class="professorInfo">
                                                <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                                                Professor name
                                            </div>
                                        </div>
                                    </div>
                                    <div class="courseStatusBox">
                                        <div class="statusCheck complete">In Progress</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="profileSection">
                                    <div class="profileViewToggleWrapper">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets_d//detail1.jpg">
                                        </figure>
                                        <div class="changeView">
                                            <h5>Course Name</h5>
                                            <div class="courseStructure">
                                                <p>10 lessons</p>
                                                <div class="statusourse complete">
                                                    100% complete
                                                </div>
                                            </div>
                                            <div class="professorInfo">
                                                <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                                                Professor name
                                            </div>
                                        </div>
                                    </div>
                                    <div class="courseStatusBox">
                                        <div class="statusCheck complete">In Progress</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="right">
                        <div class="boxwrap completeProfile">
                            <h6>Complete your profile</h6>
                            <p>Current status of your profile</p>
                            <div class="profileProgressBar">
                                <div class="progress mx-auto" data-value="40">
                                    <span class="progress-left">
                                        <span class="progress-bar border-primary"></span>
                                    </span>
                                    <span class="progress-right">
                                        <span class="progress-bar border-primary" style="transform: rotate(144deg);"></span>
                                    </span>
                                    <div class="profileUser">
                                        <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                                    </div>
                                </div>
                                <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                    <div class="h2 font-weight-bold">40<sup class="small">%</sup></div>
                                    <div class="complete">Complete</div>
                                </div>
                            </div>
                            <div class="completeNow">
                                <button type="button" class="event_action">Complete Now</button>
                            </div>
                        </div>
                        <div class="boxwrap">
                            <h6>Latest Updates</h6>
                            <p>Peers</p>
                            <div class="listBox">
                                <div class="listWrap">
                                    <div class="left">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets_d//user.jpg" alt="user">
                                        </figure>
                                    </div>
                                    <div class="right">
                                        <h6>Jane Doe</h6>
                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>
                                    </div>
                                </div>
                                <div class="listWrap">
                                    <div class="left">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets_d//user.jpg" alt="user">
                                        </figure>
                                    </div>
                                    <div class="right">
                                        <h6>Jane Doe</h6>
                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>
                                    </div>
                                </div>
                                <div class="listWrap">
                                    <div class="left">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets_d//user.jpg" alt="user">
                                        </figure>
                                    </div>
                                    <div class="right">
                                        <h6>Jane Doe</h6>
                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>
                                    </div>
                                </div>
                            </div>
                            <p>Institutions</p>
                            <div class="listBox last">
                                <div class="listWrap">
                                    <div class="left">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets_d//user.jpg" alt="user">
                                        </figure>
                                    </div>
                                    <div class="right">
                                        <h6>Jane Doe</h6>
                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>
                                    </div>
                                </div>
                                <div class="listWrap">
                                    <div class="left">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets_d//user.jpg" alt="user">
                                        </figure>
                                    </div>
                                    <div class="right">
                                        <h6>Jane Doe</h6>
                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>
                                    </div>
                                </div>
                                <div class="listWrap">
                                    <div class="left">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets_d//user.jpg" alt="user">
                                        </figure>
                                    </div>
                                    <div class="right">
                                        <h6>Jane Doe</h6>
                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="coming-soon">
                    <figure><img src="<?php echo base_url(); ?>assets_d/images/Final_file_First_GIF.gif" alt="Image"/>
                </div>
            </div>
            <div id="professor" class="tab-pane fade in">
                <!-- <div class="TabsAndSortWrapper institute">
                    <div class="sortWrapper">
                        <ul>
                            <li>
                                <div class="selectOrder">
                                    <select name="sort" id="sort">
                                        <option value="volvo">Alphabetical</option>
                                    </select>
                                </div>
                            </li>
                            <li class="grid active">
                                <img src="<?php echo base_url(); ?>assets_d//grid-box-blue.svg" alt="Grid">
                            </li>
                            <li class="list">
                                <img src="<?php echo base_url(); ?>assets_d//list-box-grey.svg" alt="List">
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tabPaneWrapper">
                    <div class="left">
                        <div class="userBoxWrapper gridview">
                            <div class="card">
                                <div class="messagePeerBox">
                                    <img src="<?php echo base_url(); ?>assets_d//messagebox.svg" alt="Message">
                                </div>
                                <div class="profileSection">
                                    <div class="profileViewToggleWrapper">
                                        <figure>
                                            <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                                        </figure>
                                        <div class="changeView">
                                            <h5>Institution Name</h5>
                                            <p>location name</p>
                                            <div class="followers">
                                                <span>25 </span> Followers
                                            </div>
                                        </div>
                                    </div>
                                    <div class="followOptionsWrapper">
                                        <ul>
                                            <li class="follower">
                                                <a href="javascript:void(0)">Follow</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="messagePeerBox">
                                    <img src="<?php echo base_url(); ?>assets_d//messagebox.svg" alt="Message">
                                </div>
                                <div class="profileSection">
                                    <div class="profileViewToggleWrapper">
                                        <figure>
                                            <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                                        </figure>
                                        <div class="changeView">
                                            <h5>Institution Name</h5>
                                            <p>location name</p>
                                            <div class="followers">
                                                <span>25 </span> Followers
                                            </div>
                                        </div>
                                    </div>
                                    <div class="followOptionsWrapper">
                                        <ul>
                                            <li>
                                                <a href="javascript:void(0)">Following</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="messagePeerBox">
                                    <img src="<?php echo base_url(); ?>assets_d//messagebox.svg" alt="Message">
                                </div>
                                <div class="profileSection">
                                    <div class="profileViewToggleWrapper">
                                        <figure>
                                            <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                                        </figure>
                                        <div class="changeView">
                                            <h5>Institution Name</h5>
                                            <p>location name</p>
                                            <div class="followers">
                                                <span>25 </span> Followers
                                            </div>
                                        </div>
                                    </div>
                                    <div class="followOptionsWrapper">
                                        <ul>
                                            <li>
                                                <a href="javascript:void(0)">Following</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="messagePeerBox">
                                    <img src="<?php echo base_url(); ?>assets_d//messagebox.svg" alt="Message">
                                </div>
                                <div class="profileSection">
                                    <div class="profileViewToggleWrapper">
                                        <figure>
                                            <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                                        </figure>
                                        <div class="changeView">
                                            <h5>Institution Name</h5>
                                            <p>location name</p>
                                            <div class="followers">
                                                <span>25 </span> Followers
                                            </div>
                                        </div>
                                    </div>
                                    <div class="followOptionsWrapper">
                                        <ul>
                                            <li>
                                                <a href="javascript:void(0)">Follow</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="messagePeerBox">
                                    <img src="<?php echo base_url(); ?>assets_d//messagebox.svg" alt="Message">
                                </div>
                                <div class="profileSection">
                                    <div class="profileViewToggleWrapper">
                                        <figure>
                                            <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                                        </figure>
                                        <div class="changeView">
                                            <h5>Institution Name</h5>
                                            <p>location name</p>
                                            <div class="followers">
                                                <span>25 </span> Followers
                                            </div>
                                        </div>
                                    </div>
                                    <div class="followOptionsWrapper">
                                        <ul>
                                            <li>
                                                <a href="javascript:void(0)">Following</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="messagePeerBox">
                                    <img src="<?php echo base_url(); ?>assets_d//messagebox.svg" alt="Message">
                                </div>
                                <div class="profileSection">
                                    <div class="profileViewToggleWrapper">
                                        <figure>
                                            <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                                        </figure>
                                        <div class="changeView">
                                            <h5>Institution Name</h5>
                                            <p>location name</p>
                                            <div class="followers">
                                                <span>25 </span> Followers
                                            </div>
                                        </div>
                                    </div>
                                    <div class="followOptionsWrapper">
                                        <ul>
                                            <li>
                                                <a href="javascript:void(0)">Following</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="right">
                        <div class="boxwrap completeProfile">
                            <h6>Complete your profile</h6>
                            <p>Current status of your profile</p>
                            <div class="profileProgressBar">
                                <div class="progress mx-auto" data-value="40">
                                    <span class="progress-left">
                                        <span class="progress-bar border-primary"></span>
                                    </span>
                                    <span class="progress-right">
                                        <span class="progress-bar border-primary" style="transform: rotate(144deg);"></span>
                                    </span>
                                    <div class="profileUser">
                                        <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                                    </div>
                                </div>
                                <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                    <div class="h2 font-weight-bold">40<sup class="small">%</sup></div>
                                    <div class="complete">Complete</div>
                                </div>
                            </div>
                            <div class="completeNow">
                                <button type="button" class="event_action">Complete Now</button>
                            </div>
                        </div>
                        <div class="boxwrap">
                            <h6>Latest Updates</h6>
                            <p>Peers</p>
                            <div class="listBox">
                                <div class="listWrap">
                                    <div class="left">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets_d//user.jpg" alt="user">
                                        </figure>
                                    </div>
                                    <div class="right">
                                        <h6>Jane Doe</h6>
                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>
                                    </div>
                                </div>
                                <div class="listWrap">
                                    <div class="left">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets_d//user.jpg" alt="user">
                                        </figure>
                                    </div>
                                    <div class="right">
                                        <h6>Jane Doe</h6>
                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>
                                    </div>
                                </div>
                                <div class="listWrap">
                                    <div class="left">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets_d//user.jpg" alt="user">
                                        </figure>
                                    </div>
                                    <div class="right">
                                        <h6>Jane Doe</h6>
                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>
                                    </div>
                                </div>
                            </div>
                            <p>Institutions</p>
                            <div class="listBox last">
                                <div class="listWrap">
                                    <div class="left">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets_d//user.jpg" alt="user">
                                        </figure>
                                    </div>
                                    <div class="right">
                                        <h6>Jane Doe</h6>
                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>
                                    </div>
                                </div>
                                <div class="listWrap">
                                    <div class="left">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets_d//user.jpg" alt="user">
                                        </figure>
                                    </div>
                                    <div class="right">
                                        <h6>Jane Doe</h6>
                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>
                                    </div>
                                </div>
                                <div class="listWrap">
                                    <div class="left">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets_d//user.jpg" alt="user">
                                        </figure>
                                    </div>
                                    <div class="right">
                                        <h6>Jane Doe</h6>
                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="coming-soon">
                    <figure><img src="<?php echo base_url(); ?>assets_d/images/Final_file_First_GIF.gif" alt="Image"/>
                </div>
            </div>
            <div id="market" class="tab-pane fade in">
                <!-- <div class="innerFeedTabs">
                    <div class="tabularLiist">
                        <div class="TabsAndSortWrapper">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#buying">Buying</a></li>
                                <li><a data-toggle="tab" href="#selling">Selling</a></li>
                            </ul>
                            <div class="search">
                                <div class="searchIcon">
                                    <img src="<?php echo base_url(); ?>assets_d//search.png" alt="search">
                                </div>
                                <input type="text" name="">
                            </div>
                            <div class="sortWrapper">
                                <ul>
                                    <li>
                                        <div class="selectOrder">
                                            <select name="sort" id="sort">
                                                <option value="volvo">Alphabetical</option>
                                            </select>
                                        </div>
                                    </li>
                                    <li class="grid active">
                                        <img src="<?php echo base_url(); ?>assets_d//grid-box-blue.svg" alt="Grid">
                                    </li>
                                    <li class="list">
                                        <img src="<?php echo base_url(); ?>assets_d//list-box-grey.svg" alt="List">
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div id="buying" class="tab-pane fade in active">
                                <div class="tabPaneWrapper market">
                                    <div class="left">
                                        <div class="userBoxWrapper gridview">
                                            <div class="card">
                                                <div class="profileSection">
                                                    <div class="profileViewToggleWrapper">
                                                        <figure>
                                                            <img src="<?php echo base_url(); ?>assets_d//detail1.jpg">
                                                        </figure>
                                                        <div class="changeView">
                                                            <h5>Book Name</h5>
                                                            <div class="courseStructure">
                                                                <p>Author name</p>
                                                                <div class="statusourse price">
                                                                    ??? 600.00
                                                                </div>
                                                            </div>
                                                            <div class="my-rating-4" data-rating="3.5">
                                                                <span>1200</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="profileSection">
                                                    <div class="profileViewToggleWrapper">
                                                        <figure>
                                                            <img src="<?php echo base_url(); ?>assets_d//detail1.jpg">
                                                        </figure>
                                                        <div class="changeView">
                                                            <h5>Book Name</h5>
                                                            <div class="courseStructure">
                                                                <p>Author name</p>
                                                                <div class="statusourse price">
                                                                    ??? 600.00
                                                                </div>
                                                            </div>
                                                            <div class="my-rating-4" data-rating="3.5">
                                                                <span>1200</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="right">
                                        <div class="boxwrap completeProfile">
                                            <h6>Complete your profile</h6>
                                            <p>Current status of your profile</p>
                                            <div class="profileProgressBar">
                                                <div class="progress mx-auto" data-value="40">
                                                    <span class="progress-left">
                                                        <span class="progress-bar border-primary"></span>
                                                    </span>
                                                    <span class="progress-right">
                                                        <span class="progress-bar border-primary" style="transform: rotate(144deg);"></span>
                                                    </span>
                                                    <div class="profileUser">
                                                        <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                                                    </div>
                                                </div>
                                                <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                                    <div class="h2 font-weight-bold">40<sup class="small">%</sup></div>
                                                    <div class="complete">Complete</div>
                                                </div>
                                            </div>
                                            <div class="completeNow">
                                                <button type="button" class="event_action">Complete Now</button>
                                            </div>
                                        </div>
                                        <div class="boxwrap">
                                            <h6>Latest Updates</h6>
                                            <p>Peers</p>
                                            <div class="listBox">
                                                <div class="listWrap">
                                                    <div class="left">
                                                        <figure>
                                                            <img src="<?php echo base_url(); ?>assets_d//user.jpg" alt="user">
                                                        </figure>
                                                    </div>
                                                    <div class="right">
                                                        <h6>Jane Doe</h6>
                                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>
                                                    </div>
                                                </div>
                                                <div class="listWrap">
                                                    <div class="left">
                                                        <figure>
                                                            <img src="<?php echo base_url(); ?>assets_d//user.jpg" alt="user">
                                                        </figure>
                                                    </div>
                                                    <div class="right">
                                                        <h6>Jane Doe</h6>
                                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>
                                                    </div>
                                                </div>
                                                <div class="listWrap">
                                                    <div class="left">
                                                        <figure>
                                                            <img src="<?php echo base_url(); ?>assets_d//user.jpg" alt="user">
                                                        </figure>
                                                    </div>
                                                    <div class="right">
                                                        <h6>Jane Doe</h6>
                                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <p>Institutions</p>
                                            <div class="listBox last">
                                                <div class="listWrap">
                                                    <div class="left">
                                                        <figure>
                                                            <img src="<?php echo base_url(); ?>assets_d//user.jpg" alt="user">
                                                        </figure>
                                                    </div>
                                                    <div class="right">
                                                        <h6>Jane Doe</h6>
                                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>
                                                    </div>
                                                </div>
                                                <div class="listWrap">
                                                    <div class="left">
                                                        <figure>
                                                            <img src="<?php echo base_url(); ?>assets_d//user.jpg" alt="user">
                                                        </figure>
                                                    </div>
                                                    <div class="right">
                                                        <h6>Jane Doe</h6>
                                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>
                                                    </div>
                                                </div>
                                                <div class="listWrap">
                                                    <div class="left">
                                                        <figure>
                                                            <img src="<?php echo base_url(); ?>assets_d//user.jpg" alt="user">
                                                        </figure>
                                                    </div>
                                                    <div class="right">
                                                        <h6>Jane Doe</h6>
                                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="selling" class="tab-pane fade in">
                                <div class="tabPaneWrapper market">
                                    <div class="left">
                                        <div class="userBoxWrapper gridview">
                                            <div class="card">
                                                <div class="profileSection">
                                                    <div class="profileViewToggleWrapper">
                                                        <figure>
                                                            <img src="<?php echo base_url(); ?>assets_d//detail1.jpg">
                                                        </figure>
                                                        <div class="changeView">
                                                            <h5>Book Name</h5>
                                                            <div class="courseStructure">
                                                                <p>Author name</p>
                                                                <div class="statusourse price">
                                                                    ??? 600.00
                                                                </div>
                                                            </div>
                                                            <div class="my-rating-4" data-rating="3.5">
                                                                <span>1200</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="profileSection">
                                                    <div class="profileViewToggleWrapper">
                                                        <figure>
                                                            <img src="<?php echo base_url(); ?>assets_d/images/detail1.jpg">
                                                        </figure>
                                                        <div class="changeView">
                                                            <h5>Book Name</h5>
                                                            <div class="courseStructure">
                                                                <p>Author name</p>
                                                                <div class="statusourse price">
                                                                    ??? 600.00
                                                                </div>
                                                            </div>
                                                            <div class="my-rating-4" data-rating="3.5">
                                                                <span>1200</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="right">
                                        <div class="boxwrap completeProfile">
                                            <h6>Complete your profile</h6>
                                            <p>Current status of your profile</p>
                                            <div class="profileProgressBar">
                                                <div class="progress mx-auto" data-value="40">
                                                    <span class="progress-left">
                                                        <span class="progress-bar border-primary"></span>
                                                    </span>
                                                    <span class="progress-right">
                                                        <span class="progress-bar border-primary" style="transform: rotate(144deg);"></span>
                                                    </span>
                                                    <div class="profileUser">
                                                        <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                                                    </div>
                                                </div>
                                                <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                                    <div class="h2 font-weight-bold">40<sup class="small">%</sup></div>
                                                    <div class="complete">Complete</div>
                                                </div>
                                            </div>
                                            <div class="completeNow">
                                                <button type="button" class="event_action">Complete Now</button>
                                            </div>
                                        </div>
                                        <div class="boxwrap">
                                            <h6>Latest Updates</h6>
                                            <p>Peers</p>
                                            <div class="listBox">
                                                <div class="listWrap">
                                                    <div class="left">
                                                        <figure>
                                                            <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
                                                        </figure>
                                                    </div>
                                                    <div class="right">
                                                        <h6>Jane Doe</h6>
                                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>
                                                    </div>
                                                </div>
                                                <div class="listWrap">
                                                    <div class="left">
                                                        <figure>
                                                            <img src="<?php echo base_url(); ?>assets_d//user.jpg" alt="user">
                                                        </figure>
                                                    </div>
                                                    <div class="right">
                                                        <h6>Jane Doe</h6>
                                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>
                                                    </div>
                                                </div>
                                                <div class="listWrap">
                                                    <div class="left">
                                                        <figure>
                                                            <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
                                                        </figure>
                                                    </div>
                                                    <div class="right">
                                                        <h6>Jane Doe</h6>
                                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <p>Institutions</p>
                                            <div class="listBox last">
                                                <div class="listWrap">
                                                    <div class="left">
                                                        <figure>
                                                            <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
                                                        </figure>
                                                    </div>
                                                    <div class="right">
                                                        <h6>Jane Doe</h6>
                                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>
                                                    </div>
                                                </div>
                                                <div class="listWrap">
                                                    <div class="left">
                                                        <figure>
                                                            <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
                                                        </figure>
                                                    </div>
                                                    <div class="right">
                                                        <h6>Jane Doe</h6>
                                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>
                                                    </div>
                                                </div>
                                                <div class="listWrap">
                                                    <div class="left">
                                                        <figure>
                                                            <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
                                                        </figure>
                                                    </div>
                                                    <div class="right">
                                                        <h6>Jane Doe</h6>
                                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="coming-soon">
                    <figure><img src="<?php echo base_url(); ?>assets_d/images/Final_file_First_GIF.gif" alt="Image"/>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->load->view('user/include/right-sidebar'); ?>
</section>
</section>
</section>


<div class="modal fade" id="userConnections" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            <div class="modal-body">
                <div class="createHeader">
                    <div class="closePost" data-dismiss="modal">
                        <img src="<?php echo base_url() ?>/assets_d/images/close-grey.svg" alt="close">
                    </div>
                </div>
                <h4>Are you sure you want to unfollow Username?</h4>
                <div class="profileSection">
                    <div class="profileViewToggleWrapper">
                        <figure>
                            <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                        </figure>
                        <div class="changeView">
                            <h5>Full Name</h5>
                            <p>location name</p>
                            <div class="followers">
                                <span>25 </span> Followers
                            </div>
                        </div>
                    </div>
                    <div class="followOptionsWrapper">
                        <ul>
                            <li>
                                <a href="javascript:void(0)">Cancel</a>
                            </li>
                            <li class="unfollow">
                                <a href="javascript:void(0)">Unfollow</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="reportuser" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            <div class="modal-body">
                <div class="createHeader">
                    <div class="closePost" data-dismiss="modal">
                        <img src="<?php echo base_url(); ?>assets_d/images/close-grey.svg" alt="close">
                    </div>
                </div>

                <input type="hidden" name="friend_id" id="block_friend_id" />
                <input type="hidden" name="reason" id="block_reason" />
                <h4>Select Reason to report <?php echo $user['username']; ?></h4>
                <div class="reportSection">
                    <ul class="reasons">
                        <li>
                            <a>Reason</a>
                        </li>
                        <li>
                            <a>Reason lorem ipsum</a>
                        </li>
                        <li>
                            <a>Reason lorem ipsum</a>
                        </li>
                        <li>
                            <a>lorem ipsum</a>
                        </li>
                        <li>
                            <a>Reason</a>
                        </li>
                        <li>
                            <a>Reason</a>
                        </li>
                        <li>
                            <a>Reason</a>
                        </li>
                    </ul>
                </div>
                <div class="followOptionsWrapper">
                    <ul>
                        <li>
                            <a href="javascript:void(0)" data-dismiss="modal">Cancel</a>
                        </li>
                        <li class="block">
                            <button type="submit" href="javascript:void(0)" class="report_this_user" style="background: transparent;border: none;color: #f24881;font-size: 18px;">Block</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="blockUser" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            <div class="modal-body">
                <div class="createHeader">
                    <div class="closePost" data-dismiss="modal">
                        <img src="<?php echo base_url(); ?>assets_d/images/close-grey.svg" alt="close">
                    </div>
                </div>
                <h4>Are you sure you want to block this user?</h4>
                <div class="profileSection">

                    <div class="profileViewToggleWrapper">
                        <figure>
                            <img src="<?php echo userImage($user_id); ?>">
                        </figure>
                        <div class="changeView">
                            <h5><?php echo $full_name; ?></h5>
                            <div class="followers">
                                <span><?php echo $followers; ?> </span> Followers
                            </div>
                        </div>
                    </div>
                    <div class="followOptionsWrapper">


                        <ul>
                            <li>
                                <a href="javascript:void(0);" data-dismiss="modal">Cancel</a>
                            </li>
                            <li class="block">
                                <form method="post" action="<?php echo base_url(); ?>Profile/blockPeer">
                                    <input type="hidden" name="friend_id" id="block_friend_id" value="<?php echo $user_id; ?>" />
                                    <button type="submit" href="javascript:void(0)" class="" style="background: transparent;border: none;color: #f24881;font-size: 18px;">Block</button>
                                </form>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteUser" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            <div class="modal-body">
                <div class="createHeader">
                    <div class="closePost" data-dismiss="modal">
                        <img src="<?php echo base_url() ?>/assets_d/images/close-grey.svg" alt="close">
                    </div>
                </div>
                <h4>Remove Username from your peers list?</h4>
                <div class="profileSection">
                    <div class="profileViewToggleWrapper">
                        <figure>
                            <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                        </figure>
                        <div class="changeView">
                            <h5>Full Name</h5>
                            <p>location name</p>
                            <div class="followers">
                                <span>25 </span> Followers
                            </div>
                        </div>
                    </div>
                    <div class="followOptionsWrapper">
                        <ul>
                            <li>
                                <a href="javascript:void(0)">Cancel</a>
                            </li>
                            <li class="block" data-dismiss="modal" data-toggle="modal" href="#reportuser">
                                <a href="javascript:void(0)">Remove</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="reportModalUser" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-body peers">
                <form method="post" action="<?php echo base_url(); ?>Profile/reportUser">
                    <h4>Reason</h4>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Reason for Report</label>
                                <div class="reason">
                                    <input type="hidden" name="report_user_id" value="<?= $user_id; ?>">
                                    <select class="form-control selectpicker" id="report_reason" name="report_reason" required >
                                        <option value="">Select Reason</option>
                                        <option value="Inappropriate Content">Inappropriate Content</option>
                                        <option value="Spam">Spam</option>
                                        <option value="Promotional">Promotional</option>
                                        <option value="Uncivil">Uncivil</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <span class="custom_err" id="err_report_reason"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Reason</label>
                                <div class="reason droparea">
                                    <textarea id="report_description" name="report_description"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="filterBtn reportBtn">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="cancelReportModalUser" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-body peers">
                <h4>Confirmation</h4>
                <div class="row">
                    <h6 class="modalText">Are you sure to cancel report of this user !</h6>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" action="<?php echo base_url(); ?>Profile/cancelUserReport">
                            <div class="form-group button">
                                <input type="hidden" name="report_id" value="<?= $chk_if_reported['id']; ?>">
                                <input type="hidden" name="report_user_id" value="<?= $user_id; ?>">
                                <button type="button" class="transparentBtn highlight" data-dismiss="modal">No</button>
                                <button type="submit" class="filterBtn">Yes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

 <!-- Modal -->
    <div class="modal fade" id="followerList" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="modal-body peers">
                    <h4>Follower List</h4>
                    <div class="searchPeer">
                        <div class="filterSearch">
                            <input type="text" placeholder="Search Peers" name="">
                            <button type="submit" class="searchBtn">
                                <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 489.713 489.713">
                                    <path d="M483.4,454.444l-121.3-121.4c28.7-35.2,46-80,46-128.9c0-112.5-91.5-204.1-204.1-204.1S0,91.644,0,204.144
                            s91.5,204,204.1,204c48.8,0,93.7-17.3,128.9-46l121.3,121.3c8.3,8.3,20.9,8.3,29.2,0S491.8,462.744,483.4,454.444z M40.7,204.144
                            c0-90.1,73.2-163.3,163.3-163.3s163.4,73.3,163.4,163.4s-73.3,163.4-163.4,163.4S40.7,294.244,40.7,204.144z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="peersList">
                        <div class="listHeader">
                            <h6>Peers</h6>
                            <!-- <a class="transAction">Share All</a> -->
                        </div>
                        
                        <div class="listUserWrap" id="followerListDiv">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="followingList" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="modal-body peers">
                    <h4>Following List</h4>
                    <div class="searchPeer">
                        <div class="filterSearch">
                            <input type="text" placeholder="Search Peers" name="">
                            <button type="submit" class="searchBtn">
                                <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 489.713 489.713">
                                    <path d="M483.4,454.444l-121.3-121.4c28.7-35.2,46-80,46-128.9c0-112.5-91.5-204.1-204.1-204.1S0,91.644,0,204.144
                            s91.5,204,204.1,204c48.8,0,93.7-17.3,128.9-46l121.3,121.3c8.3,8.3,20.9,8.3,29.2,0S491.8,462.744,483.4,454.444z M40.7,204.144
                            c0-90.1,73.2-163.3,163.3-163.3s163.4,73.3,163.4,163.4s-73.3,163.4-163.4,163.4S40.7,294.244,40.7,204.144z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="peersList">
                        <div class="listHeader">
                            <h6>Peers</h6>
                            <!-- <a class="transAction">Share All</a> -->
                        </div>
                        
                        <div class="listUserWrap" id="followingListDiv">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php
function time_elapsed_string($datetime, $full = false)
{
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



?>


<script type="text/javascript">
    function validateReport() {
		alert();
		
        var report_reason = $('#report_reason').val();
        if (report_reason == '') {
			
			alert(1);
			
            $('#err_report_reason').html("This field is required").show();
            return false;
        } else {
			alert(2);
			
            $('#err_report_reason').html("").hide();
        }
    }
</script>