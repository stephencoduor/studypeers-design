<?php
$userdata = $this->session->userdata('user_data');
$user_detail    = $this->db->query("SELECT * from user As a INNER JOIN user_info As b ON a.id = b.userID WHERE a.id = ".$userdata['user_id'])->row_array();
$full_name      = $user_detail['first_name'].' '.$user_detail['last_name'];
?>
<div class="modal fade" id="createPost" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <form method="post" id="addPostForm" action="<?php echo base_url(); ?>Profile/savePost" enctype="multipart/form-data">
                <input type="hidden" name="shareWithPeersId" id="shareWithPeersId">
                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                <div class="modal-body">
                    <div class="createHeader">
                        <h4>New Post</h4>
                        <div class="closePost" data-dismiss="modal">
                            <img src="<?php echo base_url(); ?>assets_d/images/close-grey.svg" alt="close">
                        </div>
                    </div>
                    <div class="postwrapper">
                        <div class="postHeaderWrapper">
                            <div class="username">
                                <figure>
                                    <?php if(empty($user_detail['image'])) {

                                        if(strcasecmp($user_detail['gender'] , 'male') == 0){
                                            ?>
                                            <img src="<?php echo base_url(); ?>uploads/user-male.png" alt="User Post">
                                        <?php } else {
                                            ?>
                                            <img src="<?php echo base_url(); ?>uploads/user-female.png" alt="User Post">
                                            <?php
                                        }
                                    }
                                    else{
                                        ?>
                                        <img id="currentProfilePicture" src="<?php echo base_url(); ?>uploads/users/<?php echo $user_detail['image']; ?>" alt="User Post" />
                                        <?php
                                    }
                                    ?>
                                </figure>
                                <div class="right">
                                    <span><?php echo ucwords($full_name); ?></span>
                                    <div class="visibility">Visible to everyone</div>
                                </div>
                            </div>
                            <div class="settingWrapper">
                                <div class="postSetting" data-dismiss="modal" data-toggle="modal" href="#privacyPost">
                                    <img src="<?php echo base_url(); ?>assets_d/images/post-setting.svg" alt="Post Setting">
                                </div>
                                <div class="notification">
                                    <img src="<?php echo base_url(); ?>assets_d/images/alert-grey.svg" alt="notification" class="notification-disabled" id="bell-announcement">
                                </div>
                            </div>
                        </div>
                        <div class="postMessage">
                            <textarea id="messagepostarea" name="messagepostarea" placeholder="What's on your mind?"></textarea>
                        </div>
                        <div class="pollsWrapper">
                            <div class="pollsform">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="option[1]" placeholder="Option 1">
                                    
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="option[2]" placeholder="Option 2">
                                    
                                </div>
                                <div class="form-group" id="option_div_3">
                                    <input type="text" class="form-control" name="option[3]" placeholder="Option 3">
                                    <a href="javascript:void(0)" onclick="removeOptionDiv('3')" class="cross-icon"><img src="<?php echo base_url(); ?>assets_d/images/clear-search-icon.svg" alt="Cross Icon"></a>
                                </div>
                            </div>
                            <div class="addmore">
                                + Add Option
                            </div>
                            <div class="pollEndTimmings">
                                <h6>When does poll ends?</h6>
                                <div class="polltimeform">
                                    <div class="filtercalendar">
                                        <div class="input-group date" id="datetimepickerstart">
                                            <span class="input-group-addon" for="start-date"></span>
                                            <input type="text" class="form-control" name="poll-end-date" placeholder="dd/mm/yy" id="start-date">
                                        </div>
                                        <div class="input-group--overlap" id="selectTime1">
                                            <input type="text" class="form-control form-control--lg" placeholder="hh:mm" name="poll-end-time">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="shareDocs">
                            <h4>Share a Document</h4>
                            <div class="uploadedDocs">
                                <div id="all_documents">

                                </div>
                            </div>
                            <div class="shareOptionBox">
                                <ul>
                                    <li>
                                        <a href="javascript:void(0)">
                                            <button type="button" class="choose_btn shareBtn">
                                                <img src="<?php echo base_url(); ?>assets_d/images/choose-file.svg" alt="Choose File"> Choose File
                                                <input type="file" name="file[]" id="document" multiple="multiple"/>
                                            </button>
                                        </a>
                                    </li>
                                    <!--<li>
                                        <a href="javascript:void(0)">
                                            <button type="button" class="choose_btn dropbox">
                                                <img src="<?php /*echo base_url(); */?>assets_d/images/dropbox.svg" alt="Choose File"> Dropbox
                                            </button>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">
                                            <button type="button" class="choose_btn gdrive">
                                                <img src="<?php /*echo base_url(); */?>assets_d/images/google-drive.svg" alt="Choose File"> Google Drive
                                            </button>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">
                                            <button type="button" class="choose_btn oneDrive">
                                                <img src="<?php /*echo base_url(); */?>assets_d/images/onedrive.svg" alt="Choose File"> oneDrive
                                            </button>
                                        </a>
                                    </li>-->
                                </ul>
                            </div>
                        </div>
                        <div class="row" id="image_row">
                            <!----Show image preview here--->
                        </div>
                        <div class="hashTagWrap">
                            <button type="button" class="hashTag" onclick="applyHashTag()">#hashtag</button>
                            <p>help the right people see your post</p>
                        </div>
                    </div>
                    <div class="shareBoxWrapper">
                        <div class="shareBox">
                            <div class="imageSection" id="upload_image_section">
                                <img src="<?php echo base_url(); ?>assets_d/images/image.svg" alt="image/video">
                                <span>Image/Video</span>
                                <input type="file" class="image_upload_button" id="imgInp1" name="file[]" multiple="multiple">
                            </div>
                            <div class="pollSection">
                                <img src="<?php echo base_url(); ?>assets_d/images/poll.svg" alt="image/video">
                                <span>Poll</span>
                            </div>
                            <div class="fileSection">
                                <img src="<?php echo base_url(); ?>assets_d/images/file.svg" alt="image/video">
                                <span>File</span>
                            </div>
                            <!-- <div class="moreSection">
                                <span>More</span>
                                <img class="more" src="<?php echo base_url(); ?>assets_d/images/more-popup.svg" alt="more">
                            </div> -->
                        </div>
                        <div class="studybuttonGroup post ">
                            <button type="button" class="event_action" id="save_post_from_ajax" >
                                Post
                            </button>
                        </div>
                    </div>
                    <div class="shareMoreContentWrapper">
                        <button type="button" class="shareOptionList celebrate">
                            <img src="<?php echo base_url(); ?>/assets_d/images/celebrate_occassion.svg"> Celebrate an occasion
                        </button>
                        <button type="button" class="shareOptionList doubt">
                            <img src="<?php echo base_url(); ?>/assets_d/images/doubt.svg">  Ask your doubt
                        </button>
                        <button type="button" class="shareOptionList tutor">
                            <img src="<?php echo base_url(); ?>/assets_d/images/find-tutor.svg">  Find a Tutor
                        </button>
                        <button type="button" class="shareOptionList share-profile">
                            <img src="<?php echo base_url(); ?>/assets_d/images/share-profile.svg">  Share Profile
                        </button>
                        <button type="button" class="shareOptionList offer-help">
                            <img src="<?php echo base_url(); ?>/assets_d/images/offer-help.svg">  Offer Help
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>




<div class="modal fade" id="editPost" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content" id="editPostContent">
            

        </div>
    </div>
</div>


<div class="modal fade" id="privacyPostEdit" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content" id="privacyPostEditContent">
            <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            
        </div>
    </div>
</div>