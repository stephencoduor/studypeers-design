<?php
$user_id = $this->session->get_userdata()['user_data']['user_id'];

$peer_list = $this->db->query("SELECT * FROM `peer_master` WHERE (`user_id` = '" . $user_id . "' OR `peer_id` = '" . $user_id . "') AND `status` = 2")
    ->result_array();



?>

<section class="rightsidemsgbar">
    <section class="view message">
        Close <i class="fa fa-arrow-right" aria-hidden="true"></i>
    </section>
    <section class="listBar">
        <section class="listHeader">
            <h6>Peers</h6>
            <a data-toggle="modal" data-target="#peersMessageModal">See More</a>
        </section>
        <section class="listChatBox">
            <?php foreach ($peer_list as $key => $value) {
                if ($key <= 2) {
                    if ($value['user_id'] == $user_id) {
                        $peer = $this->db->get_where($this->db->dbprefix('user_info'), array('userID' => $value['peer_id']))->row_array();
                    } else {
                        $peer = $this->db->get_where($this->db->dbprefix('user_info'), array('userID' => $value['user_id']))->row_array();
                    }
            ?>
                    <section class="list">
                        <section class="left">
                            <figure>
                                <img src="<?php echo userImage($peer['userID']); ?>" alt="user">
                            </figure>
                            <figcaption><a href="<?php echo base_url(); ?>Profile/friends?profile_id=<?= $peer['userID']; ?>" style="font-size: 12px; font-weight: 400;"><?php echo $peer['nickname']; ?></a></figcaption>
                        </section>
                        <section class="action">

                            <div class="dropdown">

                                <i class="fa fa-ellipsis-v dropdown-toggle" data-toggle="dropdown"></i>
                                <ul class="dropdown-menu" style="right: 0;left: auto;top: 0px;">
                                    <li class="removePeerSugg" data-id="<?php echo $peer['userID']; ?>"><a href="javascript:void(0)" data-toggle="modal" data-target="#removePeerSugg">Remove Peer</a></li>

                                </ul>
                            </div>
                        </section>
                    </section>
                <?php }
            } ?>


                    
        </section>
        <section class="listBar">
            <section class="listHeader">
                <h6>Groups</h6>
                <a><i class="fa fa-plus"></i></a>
            </section>
            <section class="listChatBox">
                <section class="list">
                    <section class="left">
                        <figure>
                            <img src="<?php echo base_url(); ?>assets_d/images/user2.jpg" alt="user">
                        </figure>
                        <figcaption>The in group</figcaption>
                    </section>
                    <section class="action">
                        <i class="fa fa-ellipsis-v"></i>
                    </section>
                </section>
                <section class="list">
                    <section class="left">
                        <figure>
                            <img src="<?php echo base_url(); ?>assets_d/images/user2.jpg" alt="user">
                            <span class="messagecount">12</span>
                        </figure>
                        <figcaption>The in group</figcaption>
                    </section>
                    <section class="action">
                        <i class="fa fa-ellipsis-v"></i>
                    </section>
                </section>
            </section>
        </section>
        <section class="listBar">
            <section class="listHeader">
                <h6>Contacts</h6>
            </section>
            <section class="listChatBox">
                <section class="list">
                    <section class="left">
                        <figure>
                            <img src="<?php echo base_url(); ?>assets_d/images/user2.jpg" alt="user">
                            <span class="circle online"></span>
                        </figure>
                        <figcaption>Angelina</figcaption>
                    </section>
                </section>
                <section class="list">
                    <section class="left">
                        <figure>
                            <img src="<?php echo base_url(); ?>assets_d/images/user2.jpg" alt="user">
                            <span class="circle offline"></span>
                        </figure>
                        <figcaption>Angelina</figcaption>
                    </section>
                </section>
                <section class="list">
                    <section class="left">
                        <figure>
                            <img src="<?php echo base_url(); ?>assets_d/images/user2.jpg" alt="user">
                            <span class="circle online"></span>
                        </figure>
                        <figcaption>Angelina</figcaption>
                    </section>
                </section>
                <section class="list">
                    <section class="left">
                        <figure>
                            <img src="<?php echo base_url(); ?>assets_d/images/user2.jpg" alt="user">
                            <span class="circle offline"></span>
                        </figure>
                        <figcaption>Angelina</figcaption>
                    </section>
                </section>
                <section class="list">
                    <section class="left">
                        <figure>
                            <img src="<?php echo base_url(); ?>assets_d/images/user2.jpg" alt="user">
                            <span class="circle online"></span>
                        </figure>
                        <figcaption>Charles</figcaption>
                    </section>
                </section>
            </section>
        </section>
    </section>
</section>
</section>
</section>
<div class="modal fade" id="peersMessageModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-body peers">
                <h4>Peers List</h4>
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
                <div class="listUserWrap">

                    <?php foreach ($peer_list as $key => $value) {
                        if ($value['user_id'] == $user_id) {
                            $peer = $this->db->get_where($this->db->dbprefix('user_info'), array('userId' => $value['peer_id']))->row_array();
                        } else {
                            $peer = $this->db->get_where($this->db->dbprefix('user_info'), array('userId' => $value['user_id']))->row_array();
                        }
                    ?>
                        <section class="list">
                            <section class="left">
                                <figure>
                                    <img src="<?php echo userImage($peer['userID']); ?>" alt="user">
                                </figure>
                                <figcaption><a href="<?php echo base_url(); ?>Profile/friends?profile_id=<?= $peer['userID']; ?>" style="font-size: 16px; font-weight: 400;"><?php echo $peer['nickname']; ?></a></figcaption>
                            </section>
                            <section class="action">
                                <button type="button" class="like">message</button>
                            </section>

                        <?php } ?>



                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="courseModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            <div class="modal-body">
                <div class="courseHeader">
                    <h4>Course</h4>
                    <div class="add_course">
                        <svg height="512pt" viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">
                            <path d="m256 0c-141.164062 0-256 114.835938-256 256s114.835938 256 256 256 256-114.835938 256-256-114.835938-256-256-256zm0 0" fill="#2196f3" />
                            <path d="m368 277.332031h-90.667969v90.667969c0 11.777344-9.554687 21.332031-21.332031 21.332031s-21.332031-9.554687-21.332031-21.332031v-90.667969h-90.667969c-11.777344 0-21.332031-9.554687-21.332031-21.332031s9.554687-21.332031 21.332031-21.332031h90.667969v-90.667969c0-11.777344 9.554687-21.332031 21.332031-21.332031s21.332031 9.554687 21.332031 21.332031v90.667969h90.667969c11.777344 0 21.332031 9.554687 21.332031 21.332031s-9.554687 21.332031-21.332031 21.332031zm0 0" fill="#fafafa" />
                        </svg>
                        Add a course
                    </div>
                </div>
                <form method="post" action="<?php echo base_url(); ?>account/postCourse" id="course_form">
                    <div class="courseBox">
                        <div class="removeCourseBox" style="display: none;">
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
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="course_id[]" class="form-control form-control--lg" placeholder="Course ID">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="course_name[]" class="form-control form-control--lg course_name" placeholder="Course Name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="professor_first_name[]" class="form-control form-control--lg professor_first_name" placeholder="Professor First Name">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="professor_last_name[]" class="form-control form-control--lg professor_last_name" placeholder="Professor Last Name">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="studybuttonGroup">
                        <button type="button" class="transparentBtn" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="filterBtn">
                            Add
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="courseModalAll" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            <div class="modal-body">
                <div class="courseHeader">
                    <h4>All Courses</h4>

                </div>
                <div id="courseModalAllBody"></div>

                <div class="studybuttonGroup">
                    <button type="button" class="transparentBtn" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="removePeerSugg" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-body peers">
                <h4>Confirmation</h4>
                <div class="row">
                    <h6 class="modalText">Are you sure to remove this peer !</h6>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" action="<?php echo base_url(); ?>account/removePeer">
                            <div class="form-group button">
                                <input type="hidden" name="remove_peer_id" id="remove_peer_id">
                                <button data-dismiss="modal" class="transparentBtn highlight">No</button>
                                <button type="submit" class="filterBtn">Yes</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="chat-wrapper hide-chat">
    <div class="chat-left">
        <div class="chat-body-wrap">
            <div class="chat-dropdown-header">
                <div class="left-area">
                    <div class="for-mobile">
                        <figure>
                            <img src="<?php echo base_url(); ?>assets_d/chat-assets/images/student-img.png" alt="Image">
                        </figure>
                        <strong>John Smith</strong>
                    </div>
                    <div class="hide-on-small">
                        Messages <span class="total-message">(03)</span>
                    </div>
                </div>
                <div class="right-area">
                    <a href="javascript:void(0)" class="minimize"><img src="<?php echo base_url(); ?>assets_d/chat-assets/images/minimize.svg" class="change-icon" alt="Maximize Icon" /></a>
                    <a href="javascript:void(0)" class="open-big-start"><img src="<?php echo base_url(); ?>assets_d/chat-assets/images/new_message.svg" alt="New Message Icon" /></a>
                </div>
            </div>
            <div class="search-list">
                <button type="submit" class="searchBtn">
                    <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 489.713 489.713">
                        <path d="M483.4,454.444l-121.3-121.4c28.7-35.2,46-80,46-128.9c0-112.5-91.5-204.1-204.1-204.1S0,91.644,0,204.144
			s91.5,204,204.1,204c48.8,0,93.7-17.3,128.9-46l121.3,121.3c8.3,8.3,20.9,8.3,29.2,0S491.8,462.744,483.4,454.444z M40.7,204.144
			c0-90.1,73.2-163.3,163.3-163.3s163.4,73.3,163.4,163.4s-73.3,163.4-163.4,163.4S40.7,294.244,40.7,204.144z"></path>
                    </svg>
                </button>
                <input type="text" id="myUsers" onkeyup="searchUser()" placeholder="Find conversations" class="form-control">
            </div>
            <div class="chat-user-list">
                <ul id="userList">
                    <li>
                        <a href="">
                            <figure>
                                <img src="<?php echo base_url(); ?>assets_d/chat-assets/images/student-img.png" alt="">
                            </figure>
                            <div class="time">40 mins</div>
                            <div class="info-wrap">
                                User Name
                                <p>message Lorem ipsum dolor sit amet, consetetur sadipscing...</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <figure>
                                <img src="<?php echo base_url(); ?>assets_d/chat-assets/images/student-img.png" alt="">
                            </figure>
                            <div class="info-wrap">
                                Group Name
                                <p>message Lorem ipsum dolor sit amet, consetetur sadipscing...</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <figure>
                                <img src="<?php echo base_url(); ?>assets_d/chat-assets/images/student-img.png" alt="">
                            </figure>
                            <div class="info-wrap">
                                Group Name
                                <p>message Lorem ipsum dolor sit amet, consetetur sadipscing...</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <figure>
                                <img src="<?php echo base_url(); ?>assets_d/chat-assets/images/student-img.png" alt="">
                            </figure>
                            <div class="info-wrap">
                                Group Name
                                <p>message Lorem ipsum dolor sit amet, consetetur sadipscing...</p>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="chat-right">
        <div class="chat-header">
            <div class="chat-header-left">
                <div class="basic-user-info">
                    <figure>
                        <i class="fa fa-users" aria-hidden="true"></i>
                    </figure>
                    <strong id="group_name_id">Group</strong>
                </div>
                <h3>Start Conversation</h3>
            </div>
            <div class="chat-header-right">
                <div class="hide-on-big">
                    <a href="javascript:void(0)" class="maximize"><img src="<?php echo base_url(); ?>assets_d/chat-assets/images/maximize.svg" class="change-icon" alt="Maximize Icon" /></a>
                </div>
                <a href="javascript:void(0)" class="video-icon"><img src="<?php echo base_url(); ?>assets_d/chat-assets/images/video-camera.svg" alt="Video Icon" /></a>
                <a href="javascript:void(0)" class="hide-on-small"><img src="<?php echo base_url(); ?>assets_d/chat-assets/images/more.svg" alt="More Icon" /></a>
                <a href="javascript:void(0)" class="add-user"><img src="<?php echo base_url(); ?>assets_d/chat-assets/images/Add.svg" alt="Icon" /></a>
                <div class="hide-on-big close-icon-wrap">
                    <a href="javascript:void(0)" class="chat-close"><img src="<?php echo base_url(); ?>assets_d/chat-assets/images/close.svg" alt="New Message Icon" /></a>
                </div>
            </div>
        </div>
        <div class="start-conversation">
            <button type="submit" class="searchBtn">
                <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 489.713 489.713">
                    <path d="M483.4,454.444l-121.3-121.4c28.7-35.2,46-80,46-128.9c0-112.5-91.5-204.1-204.1-204.1S0,91.644,0,204.144
		s91.5,204,204.1,204c48.8,0,93.7-17.3,128.9-46l121.3,121.3c8.3,8.3,20.9,8.3,29.2,0S491.8,462.744,483.4,454.444z M40.7,204.144
		c0-90.1,73.2-163.3,163.3-163.3s163.4,73.3,163.4,163.4s-73.3,163.4-163.4,163.4S40.7,294.244,40.7,204.144z"></path>
                </svg>
            </button>
            <form action="javascript:void(0);" id="chat_submit_group_form">
                <select id="multiple" name="usergroupschats[]" multiple></select>
                <a href="javascript:void(0)" class="done-link">Done</a>
            </form>
        </div>
        <div class="chat-content" id="chat_window_content">
            <div class="chat-body" id="append_chat_records">

            </div>
            <input type="hidden" id="current_group_id">
            <input type="hidden" id="curren_group_members">
        </div>
        <div class="chat-footer">
            <div class="input-wrap">
                <div class="img-preview">
                    <ul class="custom-image clearfix">
                        <li>
                            <ul class="custom-upload clearfix">
                                <li>
                                    <div class="choose-imagefile-wrap">
                                        <div class="result">
                                            <div id="gal">
                                                <ul class="gallery">
                                                    <li class="uploadBtn uploadBtnRestImage add">
                                                        <img class="img" src="" />
                                                        <input type="file" name="rest_image[]" class="rest_img" accept="image/*">
                                                        <a href="javascript:void(0);" class="removePic removePicRestImage"><i class="fa fa-times"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="chat-input-wrap">
                    <input type="text" placeholder="Type your message here" id="send_message_input" class="form-control">

                    <div class="chat-action">
                        <i class="fa fa-paper-plane" id="send_button_chat" aria-hidden="true"></i>
                        <a href="javascript:void(0)" class="imoji">
                            <img src="<?php echo base_url(); ?>assets_d/chat-assets/images/emoji.svg" alt="Imozi Icon" />
                        </a>
                        <label class="file-upload"></label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    $(document).on('click', '.removePeerSugg', function() {
        var peer_id = $(this).data('id');
        $("#remove_peer_id").val(peer_id);

    });
</script>