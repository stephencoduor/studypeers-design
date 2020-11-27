<?php $user_id = $this->session->get_userdata()['user_data']['user_id'];
$user_detail = $this->db->query("SELECT * from user As a INNER JOIN user_info As b ON a.id = b.userID INNER JOIN major_master As c ON b.major = c.id INNER JOIN university As d ON b.intitutionID = d.university_id WHERE a.id = " . $user_id)->row_array(); 
$full_name = $user_detail['first_name'] . ' ' . $user_detail['last_name'];
        foreach ($feeds as $key => $value) {
           if($value['reference'] == 'Post') {        
            $post_query = $this->db->query('SELECT * from posts where id = '.$value['reference_id'])->row();
            $post_images_query = $this->db->query('SELECT * from post_images where post_id = '.$value['reference_id'])->result_array();
            $post_videos_query = $this->db->query('SELECT * from post_videos where post_id = '.$value['reference_id'])->result_array();
            $post_options_query = $this->db->query('SELECT * from post_poll_options where post_id = '.$value['reference_id'])->result_array();
            $post_documents_query = $this->db->query('SELECT * from post_documents where post_id = '.$value['reference_id'])->result_array();

            $posts['post_details'] = $post_query;
            $posts['post_images'] = $post_images_query;
            $posts['post_videos'] = $post_videos_query;
            $posts['post_poll_options'] = $post_options_query;
            $posts['post_documents'] = $post_documents_query;

            $user = $this->db->get_where('user', array('id' => $post_query->created_by))->row_array();
            $user_info = $this->db->get_where('user_info', array('userID' => $post_query->created_by))->row_array();
            $university = $this->db->get_where('university', array('university_id' => $user_info['intitutionID']))->row_array();                         
?>
                <div class="box-card">
                    <div class="dropdown dropdownToggleMenu">
                        <img
                            src="<?php echo base_url(); ?>assets_d/images/more.svg"
                            alt="toggle" data-toggle="dropdown">
                        <ul class="dropdown-menu" role="menu"
                            aria-labelledby="menu1">
                            <li role="presentation">
                                <a role="menuitem" tabindex="-1"
                                   href="javascript:void(0);">
                                    <div class="left">
                                        <img
                                            src="<?php echo base_url(); ?>assets_d/images/save.svg"
                                            alt="Save">
                                    </div>
                                    <div class="right">
                                        <span>Save</span>
                                        <p>Save for later</p>
                                    </div>
                                </a>
                            </li>
                            <li role="presentation">
                                <a role="menuitem" tabindex="-1"
                                   href="javascript:void(0);">
                                    <div class="left">
                                        <img
                                            src="<?php echo base_url(); ?>assets_d/images/copy-link.svg"
                                            alt="Link">
                                    </div>
                                    <div class="right">
                                        <span>Copy link to post</span>
                                    </div>
                                </a>
                            </li>
                            <li role="presentation">
                                <a role="menuitem" tabindex="-1"
                                   href="javascript:void(0);">
                                    <div class="left">
                                        <img
                                            src="<?php echo base_url(); ?>assets_d/images/embed.svg"
                                            alt="Embed">
                                    </div>
                                    <div class="right">
                                        <span>Embed this post</span>
                                        <p>copy and paste this post to your
                                            site</p>
                                    </div>
                                </a>
                            </li>
                            <li role="presentation">
                                <a role="menuitem" tabindex="-1"
                                   href="javascript:void(0);">
                                    <div class="left">
                                        <img
                                            src="<?php echo base_url(); ?>assets_d/images/hide.svg"
                                            alt="Hide Post">
                                    </div>
                                    <div class="right">
                                        <span>Hide this post</span>
                                        <p>I don't want to see this post in my
                                            feed</p>
                                    </div>
                                </a>
                            </li>
                            <li role="presentation">
                                <a role="menuitem" tabindex="-1"
                                   href="javascript:void(0);">
                                    <div class="left">
                                        <img
                                            src="<?php echo base_url(); ?>assets_d/images/unfollow.svg"
                                            alt="Unfollow">
                                    </div>
                                    <div class="right">
                                        <span>Unfollow Loreum Ipsum</span>
                                        <p>Stop seeing post from Loreum
                                            Ipsum</p>
                                    </div>
                                </a>
                            </li>
                            <li role="presentation">
                                <a role="menuitem" tabindex="-1"
                                   href="javascript:void(0);">
                                    <div class="left">
                                        <img
                                            src="<?php echo base_url(); ?>assets_d/images/report.svg"
                                            alt="Report">
                                    </div>
                                    <div class="right">
                                        <span>Report this post</span>
                                        <p>This post is offensive or account is
                                            hacked</p>
                                    </div>
                                </a>
                            </li>
                            <li role="presentation">
                                <a role="menuitem" tabindex="-1"
                                   href="javascript:void(0);">
                                    <div class="left">
                                        <img
                                            src="<?php echo base_url(); ?>assets_d/images/improve-feed.svg"
                                            alt="Improve Feed">
                                    </div>
                                    <div class="right">
                                        <span>Improve my feed</span>
                                        <p>Get recommended sources to follow</p>
                                    </div>
                                </a>
                            </li>
                            <li role="presentation">
                                <a role="menuitem" tabindex="-1"
                                   href="javascript:void(0);">
                                    <div class="left">
                                        <img
                                            src="<?php echo base_url(); ?>assets_d/images/who-can-see.svg"
                                            alt="Visible">
                                    </div>
                                    <div class="right">
                                        <span>Who can see this post?</span>
                                        <p>Visible to public</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="createBox">
                        <div class="feeduserwrap">
                            <div class="user-details">
                                <div class="user-name">
                                    <figure>
                                        <?php if (empty($user_detail['image'])) {
                                            if (strcasecmp($user_detail['gender'], 'male') == 0) {
                                                ?>
                                                <img
                                                    src="<?php echo base_url(); ?>uploads/user-male.png"
                                                    alt="User">
                                            <?php } else {
                                                ?>
                                                <img
                                                    src="<?php echo base_url(); ?>uploads/user-female.png"
                                                    alt="User">
                                                <?php
                                            }

                                        } else {
                                            ?>
                                            <img
                                                src="<?php echo base_url() . "uploads/users/" . $user_detail['image']; ?>"
                                                alt="user">
                                            <?php
                                        } ?>

                                    </figure>
                                    <div class="right">
                                        <figcaption><?php echo @$full_name; ?></figcaption>
                                        <div class="badgeList">
                                            <ul>
                                                <li class="badge badge1">
                                                    <a href="">
                                                        <img
                                                            src="<?php echo base_url(); ?>assets_d/images/institution.svg"
                                                            alt="InStitute">
                                                        University name
                                                    </a>
                                                </li>
                                                <li class="badge badge3">
                                                    <a href="">
                                                        <img
                                                            src="<?php echo base_url(); ?>assets_d/images/professor.svg"
                                                            alt="Professor">
                                                        Faculty
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="timeline"><?php echo time_ago_in_php(@$posts['post_details']->created_at); ?></div>
                            </div>
                            <p class="feedPostMessages">
                                <?php echo @$posts['post_details']->post_content_html; ?>
                            </p>
                            <?php if (count(@$posts['post_images']) > 0) {
                                ?>
                                <div class="imgWrapper type2">
                                    <?php
                                    foreach (@$posts['post_images'] as $image) {
                                        if (!empty($image)) {
                                            ?>
                                            <figure>
                                                <img
                                                    src="<?php echo base_url() . $image['image_path'] ?>"
                                                    alt="Post Image">
                                            </figure>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <?php
                            } ?>
                            <?php if (count($posts['post_videos']) > 0) {
                                ?>
                                <div class="imgWrapper type2">
                                    <?php
                                    foreach (@$posts['post_videos'] as $videos) {
                                        if (!empty(@$videos)) {
                                            ?>
                                            <video id="myVideo" width="320"
                                                   height="240" controls>
                                                <source
                                                    src="<?php echo base_url() . @$videos['video_path'] ?>"
                                                    alt="Video">
                                            </video>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <?php
                            }
                            if (count($posts['post_documents']) > 0) {
                                foreach ($posts['post_documents'] as $document) {
                                    ?>
                                    <p class="feedPostMessages">
                                        <a href="<?php echo base_url() . @$document['document_path']; ?>"><?php echo $document['original_name'] ?></a>
                                    </p>
                                    <?php
                                }
                            }
                            ?>
                            <?php if (count($posts['post_poll_options']) > 0) {
                                foreach ($posts['post_poll_options'] as $options) {
                                    ?>
                                    <div class="selectedPollOptions">
                                        <label class="dashRadioWrap">
                                            <div class="progressBar">
                                                <div class="progress">
                                                    <div class="progressValues">
                                                        <div class="leftValue">
                                                            <?php echo @$options['options']; ?>
                                                        </div>
                                                        <div
                                                            class="rightValues">
                                                            <p>75%</p>
                                                            <div
                                                                class="eventActionWrap">
                                                                <ul>
                                                                    <li>
                                                                        <img
                                                                            src="<?php echo base_url(); ?>assets_d/images/user.jpg"
                                                                            alt="user">
                                                                    </li>
                                                                    <li>
                                                                        <img
                                                                            src="<?php echo base_url(); ?>assets_d/images/user.jpg"
                                                                            alt="user">
                                                                    </li>
                                                                    <li>
                                                                        <img
                                                                            src="<?php echo base_url(); ?>assets_d/images/user.jpg"
                                                                            alt="user">
                                                                    </li>
                                                                    <li>
                                                                        <img
                                                                            src="<?php echo base_url(); ?>assets_d/images/user.jpg"
                                                                            alt="user">
                                                                    </li>
                                                                    <li>
                                                                        <img
                                                                            src="<?php echo base_url(); ?>assets_d/images/user.jpg"
                                                                            alt="user">
                                                                    </li>
                                                                    <li class="more">
                                                                        +5
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="progress-bar"
                                                         role="progressbar"
                                                         aria-valuenow="75"
                                                         aria-valuemin="0"
                                                         aria-valuemax="100"
                                                         style="width:70%"></div>
                                                </div>
                                            </div>
                                            <input type="radio"
                                                   checked="checked"
                                                   name="radio">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <?php
                                }
                            }
                            ?>

                            <div class="socialStatus">
                                <div class="leftStatus">
                                    <a>
                                        <img
                                            src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg"
                                            alt="Like">
                                        <img
                                            src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg"
                                            alt="Like">
                                        <span
                                            id="total_likes_<?php echo @$key; ?>"><?php echo @$posts['post_details']->likes_count; ?></span>
                                    </a>
                                </div>
                                <div class="rightStatus">
                                    <ul>
                                        <li>
                                            <a>
                                                <img
                                                    src="<?php echo base_url(); ?>assets_d/images/comment-grey.svg"
                                                    alt="comment">
                                                <span><?php echo @$posts['post_details']->comments_count; ?></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a>
                                                <img
                                                    src="<?php echo base_url(); ?>assets_d/images/share-grey.svg"
                                                    alt="Share">
                                                <span><?php echo @$posts['post_details']->share_count; ?></span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="socialAction">
                                <ul>
                                    <li class="likeMenu">
                                        <a>
                                            <img
                                                src="<?php echo base_url(); ?>assets_d/images/like-grey.svg"
                                                class="likepost" alt="Like">
                                            <span>Like</span>
                                        </a>
                                        <div class="hoverMenu">
                                            <ul>
                                                
                                                <li data-toggle="tooltip" title="Like" class="likeOption like_option_type"
                                                    id="1"
                                                    data-id="<?php echo $key; ?>">
                                                    <img
                                                        src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg"
                                                        alt="like">
                                                </li>
                                                <li data-toggle="tooltip" title="Support" class="supportMenu like_option_type"
                                                    id="2"
                                                    data-id="<?php echo $key; ?>">
                                                    <img
                                                        src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg"
                                                        alt="like">
                                                </li>
                                                <li data-toggle="tooltip" title="Celebrate" class="celebrateMenu like_option_type"
                                                    id="3"
                                                    data-id="<?php echo $key; ?>">
                                                    <img
                                                        src="<?php echo base_url(); ?>assets_d/images/celebrate-dashboard.svg"
                                                        alt="like">
                                                </li>
                                                <li data-toggle="tooltip" title="Insightful" class="curiousMenu like_option_type"
                                                    id="4"
                                                    data-id="<?php echo $key; ?>">
                                                    <img
                                                        src="<?php echo base_url(); ?>assets_d/images/curious-dashboard.svg"
                                                        alt="like">
                                                </li>
                                                <li data-toggle="tooltip" title="Curious" class="insightMenu like_option_type"
                                                    id="5"
                                                    data-id="<?php echo $key; ?>">
                                                    <img
                                                        src="<?php echo base_url(); ?>assets_d/images/insight-dashboard.svg"
                                                        alt="like">
                                                </li>
                                                <li data-toggle="tooltip" title="Love" class="loveMenu like_option_type"
                                                    id="6"
                                                    data-id="<?php echo $key; ?>">
                                                    <img
                                                        src="<?php echo base_url(); ?>assets_d/images/love-dashboard.svg"
                                                        alt="like">
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <?php if (@$posts['post_details']->is_comment_on == 1) { ?>
                                        <li>
                                            <a>
                                                <img
                                                    src="<?php echo base_url(); ?>assets_d/images/comment-grey.svg"
                                                    alt="comment">
                                                <span>Comment</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <li>
                                        <a>
                                            <img
                                                src="<?php echo base_url(); ?>assets_d/images/share-grey.svg"
                                                alt="comment">
                                            <span>Share</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="commentBoxWrap"
                                 id="all_comments_section_<?php echo $key; ?>">
                                <div class="comment-popularity">
                                    <div class="relevant">
                                        <!-- <div class="caretIcon">
                                                <img
                                                    src="<?php /*echo base_url(); */ ?>assets_d/images/down-arrow1.svg"
                                                    alt="down arrow">
                                            </div>-->
                                    </div>
                                    <div class="commentmsg"
                                         id="<?php echo $key; ?>">
                                        <a>Hide Comments</a>
                                    </div>
                                </div>
                                <div class="all_comments_<?php echo $key; ?>">
                                    <?php
                                    if (@$posts['post_details']->is_comment_on == 1) {
                                        foreach (@$posts['post_comments'] as $comments) {
                                            ?>
                                            <div class="chatMsgBox">
                                                <figure>
                                                    <img
                                                        src="<?php echo userImage($comments['user_id']); ?>"/>
                                                </figure>
                                                <div class="right">
                                                    <div class="userWrapText">
                                                        <h4><?php echo $comments['first_name']; ?> <?php echo $comments['last_name']; ?></h4>
                                                        <p><?php echo $comments['comment'] ?></p>
                                                        <div class="leftStatus">
                                                            <a>
                                                                <img
                                                                    src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg"
                                                                    alt="Like">
                                                                <span>0</span>
                                                            </a>
                                                            <a>Like</a>
                                                            <a class="show_replies"
                                                               id="<?php echo $comments['id'] ?>">Reply</a>
                                                            <div class="innerReplyBox"
                                                                 id="reply_box_<?php echo $comments['id'] ?>">
                                                                <figure>
                                                                    <img
                                                                        src="<?php echo base_url(); ?>assets_d/images/ct_user.jpg"
                                                                        alt="User">
                                                                </figure>
                                                                <div
                                                                    class="right">
                                                                    <div
                                                                        class="userWrapText">
                                                                        <h4>User
                                                                            Name</h4>
                                                                        <p>Lorem
                                                                            Ipsum
                                                                            is
                                                                            simply
                                                                            dummy
                                                                            text
                                                                            of
                                                                            the
                                                                            printing
                                                                            and</p>
                                                                        <div
                                                                            class="leftStatus">
                                                                            <a>Like</a>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="dotsBullet dropdown">
                                                                        <img
                                                                            src="<?php echo base_url(); ?>assets_d/images/more.svg"
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
                                                                                            src="<?php echo base_url(); ?>assets_d/images/restricted.svg"
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
                                                                                   href="javascript:void(0);">
                                                                                    <div
                                                                                        class="left">
                                                                                        <img
                                                                                            src="<?php echo base_url(); ?>assets_d/images/trash.svg"
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
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="dotsBullet dropdown">
                                                        <img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="more" data-toggle="dropdown">
                                                        <ul class="dropdown-menu" role="menu"
                                                            aria-labelledby="menu1">
                                                            <li role="presentation">
                                                                <a role="menuitem"
                                                                   tabindex="-1"
                                                                   href="javascript:void(0);">
                                                                    <div
                                                                        class="left">
                                                                        <img
                                                                            src="<?php echo base_url(); ?>assets_d/images/restricted.svg"
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
                                                                   href="javascript:void(0);">
                                                                    <div
                                                                        class="left">
                                                                        <img
                                                                            src="<?php echo base_url(); ?>assets_d/images/trash.svg"
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
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>

                                <form>
                                    <div class="chatMsgBox mb-0">
                                        <div class="commentWrapBox">
                                            <figure>
                                                <?php if (empty($user_detail['image'])) {

                                                    if (strcasecmp($user_detail['gender'], 'male') == 0) {
                                                        ?>
                                                        <img
                                                             src="<?php echo base_url(); ?>uploads/user-male.png" alt="User">
                                                    <?php } else {
                                                        ?>
                                                        <img
                                                             src="<?php echo base_url(); ?>uploads/user-female.png" alt="User">
                                                        <?php
                                                    }

                                                } else {
                                                    ?>
                                                    <img
                                                         src="<?php echo base_url(); ?>uploads/users/<?php echo $user_detail['image']; ?>"
                                                         alt="change profile banner"/>
                                                    <?php
                                                }
                                                ?>

                                            </figure>
                                            <input type="text" name="comment"
                                                   class="new_comment"
                                                   data-parent-id="0"
                                                   data-id="<?php echo $key; ?>"
                                                   placeholder="Comment" id="em_1">
                                            <div class="mediaAction">
                                                <button type="button">
                                                    <img
                                                        src="<?php echo base_url(); ?>assets_d/images/image.svg"
                                                        alt="Add Files">
                                                    <input type="file">
                                                </button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="img-wrap-flex">
                                        <div class="image-item">
                                        <div class="close"><img src="https://studypeers.dev/assets_d/images/close-pink.svg" class="remove_image" id="remove_image_1" alt="close"></div>
                                            <figure>
                                                <img src="https://studypeers.dev/uploads/users/cover/1604851468.png" alt="Image"/>
                                            </figure>
                                        </div>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
<?php
            } if($value['reference'] == 'event') { 
                $chk_view = 0;
                $event_detail = $this->db->get_where('event_master', array('id' => $value['reference_id']))->row_array();
                
                    $chk_view = 1;
                    $txt = "added a new event";
                
                
?>
                    <!-- Event -->
                    <div class="box-card message">
                        <div class="eventMessage">
                            <img src="<?php echo base_url(); ?>assets_d/images/Event.svg" alt="Ring"> Event
                        </div>
                        <div class="dropdown dropdownToggleMenu">
                            <img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="toggle" data-toggle="dropdown" > 
                            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                <li role="presentation">
                                        <a role="menuitem" tabindex="-1" href="javascript:void(0);">
                                            <div class="left">
                                                <img src="<?php echo base_url(); ?>assets_d/images/save.svg" alt="Save">
                                            </div>
                                            <div class="right">
                                                <span>Save</span>  
                                                <p>Save for later</p>
                                            </div>
                                        </a>
                                </li>
                                <li role="presentation">
                                    <a role="menuitem" tabindex="-1" href="javascript:void(0);">
                                        <div class="left">
                                            <img src="<?php echo base_url(); ?>assets_d/images/copy-link.svg" alt="Link">
                                        </div>
                                        <div class="right">
                                            <span>Copy link to post</span>
                                        </div>
                                    </a> 
                                </li>
                                <li role="presentation">
                                    <a role="menuitem" tabindex="-1" href="javascript:void(0);">
                                        <div class="left">
                                            <img src="<?php echo base_url(); ?>assets_d/images/embed.svg" alt="Embed">
                                        </div>
                                        <div class="right">
                                            <span>Embed this post</span>
                                            <p>copy and paste this post to your site</p>
                                        </div>
                                    </a> 
                                </li>  
                                <li role="presentation">
                                    <a role="menuitem" tabindex="-1" href="javascript:void(0);">
                                        <div class="left">
                                            <img src="<?php echo base_url(); ?>assets_d/images/hide.svg" alt="Hide Post">
                                        </div>
                                        <div class="right">
                                            <span>Hide this post</span>
                                            <p>I don't want to see this post in my feed</p>
                                        </div>
                                    </a> 
                                </li>  
                                <li role="presentation">
                                    <a role="menuitem" tabindex="-1" href="javascript:void(0);">
                                        <div class="left">
                                            <img src="<?php echo base_url(); ?>assets_d/images/unfollow.svg" alt="Unfollow">
                                        </div>
                                        <div class="right">
                                            <span>Unfollow Loreum Ipsum</span>
                                            <p>Stop seeing post from Loreum Ipsum</p>
                                        </div>
                                    </a> 
                                </li>  
                                <li role="presentation">
                                    <a role="menuitem" tabindex="-1" href="javascript:void(0);">
                                        <div class="left">
                                            <img src="<?php echo base_url(); ?>assets_d/images/report.svg" alt="Report">
                                        </div>
                                        <div class="right">
                                            <span>Report this post</span>
                                            <p>This post is offensive or account is hacked</p>
                                        </div>
                                    </a> 
                                </li> 
                                <li role="presentation">
                                    <a role="menuitem" tabindex="-1" href="javascript:void(0);">
                                        <div class="left">
                                            <img src="<?php echo base_url(); ?>assets_d/images/improve-feed.svg" alt="Improve Feed">
                                        </div>
                                        <div class="right">
                                            <span>Improve my feed</span>
                                            <p>Get recommended sources to follow</p>
                                        </div>
                                    </a> 
                                </li> 
                                <li role="presentation">
                                    <a role="menuitem" tabindex="-1" href="javascript:void(0);">
                                        <div class="left">
                                            <img src="<?php echo base_url(); ?>assets_d/images/who-can-see.svg" alt="Visible">
                                        </div>
                                        <div class="right">
                                            <span>Who can see this post?</span>
                                            <p>Visible to public</p>
                                        </div>
                                    </a> 
                                </li> 
                            </ul>
                        </div>
                        <div class="createBox">
                            <div class="feeduserwrap">
                                <div class="user-details">
                                    <div class="user-name">
                                        <figure>
                                            <img src="<?php echo userImage($event_detail['created_by']); ?>" alt="user">
                                        </figure>
                                        <div class="right">
                                            <?php $user = $this->db->get_where('user', array('id' => $event_detail['created_by']))->row_array();
                                            $user_info = $this->db->get_where('user_info', array('userID' => $event_detail['created_by']))->row_array();
                                            $university = $this->db->get_where('university', array('university_id' => $user_info['intitutionID']))->row_array();
                                             if($event_detail['created_by'] == $user_id) { ?>
                                                <figcaption>You 
                                            <?php } else { 
                                                
                                            ?>
                                                <figcaption><a href="<?php echo base_url().'Profile/friends?profile_id='.$user['id'] ?>"><?php echo $user['first_name'].' '.$user['last_name']; ?></a>
                                            <?php } ?>
                                            <span><?php echo $txt; ?></span> </figcaption>
                                            <div class="badgeList">
                                                <ul>
                                                    <li class="badge badge1">
                                                        <a href="">
                                                            <img src="<?php echo base_url(); ?>assets_d/images/institution.svg" alt="InStitute"> <?php echo $university['SchoolName']; ?>
                                                        </a>
                                                    </li>
                                                    <li class="badge badge3">
                                                        <a href="">
                                                            <img src="<?php echo base_url(); ?>assets_d/images/professor.svg" alt="Professor"> Faculty
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>                                              
                                    </div>
                                    <div class="timeline"><?php echo time_ago_in_php($event_detail['created_at']); ?></div>
                                </div>
                                <h4><?php echo $event_detail['event_name'] ?></h4>
                                <div class="event-description">
                                    <div class="left">
                                        <img src="<?php echo base_url(); ?>assets_d/images/location.svg" alt="Location"> <?php echo $event_detail['location_txt'] ?>
                                    </div>
                                    <div class="right">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets_d/images/calendar1.svg" alt="Event Time">
                                        </figure>
                                        <figcaption><?php echo date('d M, Y', strtotime($event_detail['start_date'])); ?></figcaption>
                                        <?php if($event_detail['created_by'] == $user_id) {
                                                if($event_detail['addedToCalender'] == 0) { 
                                        ?>
                                                <a href="#" class="addEvents" data-id="<?= $event_detail['id']; ?>" data-toggle="modal" data-target="#addEventModal">Add to Calendar</a>
                                        <?php } else { ?>
                                                <a href="#" class="removeEvent" data-id="<?= $event_detail['id']; ?>" data-toggle="modal" data-target="#removeFromScheduleModal">Remove From Calendar</a>
                                        <?php } } else { 
                                                    $this->db->order_by('share_master.id', 'desc');
                                                    $shared = $this->db->get_where('share_master', array('reference_id' => $event_detail['id'], 'reference' => 'event', 'peer_id' => $user_id))->row_array();
                                                if($shared['schedule_master_id'] == 0) { ?>
                                                    <a href="#" class="addEvents" data-id="<?= $event_detail['id']; ?>" data-toggle="modal" data-target="#addEventModal">Add to Calendar</a>

                                                <?php } else { ?>
                                                    <a href="#" class="removeEvent" data-id="<?= $event_detail['id']; ?>" data-toggle="modal" data-target="#removeFromScheduleModal">Remove From Calendar</a>
                                                <?php }

                                        }?>
                                    </div>
                                </div>
                                <p class="feedPostMessages">
                                    <?php echo $event_detail['description']; ?> 
                                </p>
                                <?php if($event_detail['featured_image'] != '') { ?>
                                    <div class="imgWrapper type1">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>uploads/users/<?php echo $event_detail['featured_image']; ?>" alt="Post Image">
                                        </figure>
                                    </div>
                                <?php } ?>
                                
                                <div class="eventActionWrap">
                                    <?php $peer_attending = $this->db->get_where('share_master', array('reference_id' => $event_detail['id'], 'reference' => 'event', 'status' => 2))->result_array(); ?>
                                    <?php  if(!empty($peer_attending)) {  ?>
                                        <div class="userIcoList peersModalAttending" data-id="<?= $event_detail['id'] ?>" data-toggle="modal" data-target="#peersModalAttending" style="margin-right: 15%;">
                                            <ul>
                                                <?php if(!empty($peer_attending[0])) { ?>
                                                    <li>
                                                        <img src="<?php echo userImage($peer_attending[0]['peer_id']); ?>" alt="user">
                                                    </li>
                                                <?php } ?>
                                                <?php if(!empty($peer_attending[1])) { ?>
                                                    <li>
                                                        <img src="<?php echo userImage($peer_attending[1]['peer_id']); ?>" alt="user">
                                                    </li>
                                                <?php } ?>
                                                <?php if(!empty($peer_attending[2])) { ?>
                                                    <li>
                                                        <img src="<?php echo userImage($peer_attending[2]['peer_id']); ?>" alt="user">
                                                    </li>
                                                <?php } ?>
                                                <?php if(!empty($peer_attending[3])) { ?>
                                                    <li>
                                                        <img src="<?php echo userImage($peer_attending[3]['peer_id']); ?>" alt="user">
                                                    </li>
                                                <?php } ?>
                                                <?php if(!empty($peer_attending[4])) { ?>
                                                    <li>
                                                        <img src="<?php echo userImage($peer_attending[4]['peer_id']); ?>" alt="user">
                                                    </li>
                                                <?php } $count = count($peer_attending);  ?>
                                                <?php if($count > 5) { ?>
                                                    <li class="more">
                                                        +<?= $count - 5; ?>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>

                                    <?php } ?>
                                    <?php if($event_detail['created_by'] != $user_id) { 
                                        $this->db->order_by('share_master.id', 'desc');
                                        $shared = $this->db->get_where('share_master', array('reference_id' => $event_detail['id'], 'reference' => 'event', 'peer_id' => $user_id))->row_array(); 
                                    ?>
                                        <button type="button" class="event_action attendEvent" data-toggle="modal" data-target="#confirmationModalAttend" data-id="<?= $event_detail['id']; ?>"> <span id="attend_text_<?= $event_detail['id']; ?>"><?php if($shared['status'] == 2){
                                               echo 'Unattend';
                                            } else {
                                                echo 'Attend';
                                            } ?></span> Event
                                        </button>
                                    <?php } ?>
                                </div>
                                <div class="socialStatus">
                                    <div class="leftStatus">
                                        <a>
                                            <img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Like">
                                            <img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" alt="Like">
                                            <span>24</span>
                                        </a>
                                    </div>
                                    <div class="rightStatus">
                                        <ul>
                                            <li>
                                                <a>
                                                    <img src="<?php echo base_url(); ?>assets_d/images/comment-grey.svg" alt="comment">
                                                    <span>05</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a>
                                                    <img src="<?php echo base_url(); ?>assets_d/images/share-grey.svg" alt="Share">
                                                    <span>01</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="socialAction">
                                    <ul>
                                        <li class="likeMenu">
                                            <a>
                                                <img src="<?php echo base_url(); ?>assets_d/images/like-grey.svg" class="likepost" alt="Like">
                                                <span>Like</span>
                                            </a>
                                            <div class="hoverMenu">
                                                <ul>
                                                    <li class="likeOption">
                                                        <img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="like">
                                                    </li>
                                                    <li class="supportMenu">
                                                        <img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" alt="like">
                                                    </li>                                                                   
                                                    <li class="celebrateMenu">
                                                        <img src="<?php echo base_url(); ?>assets_d/images/celebrate-dashboard.svg" alt="like">
                                                    </li>                                                               
                                                    <li class="curiousMenu">
                                                        <img src="<?php echo base_url(); ?>assets_d/images/curious-dashboard.svg" alt="like">
                                                    </li>                                                               
                                                    <li class="insightMenu">
                                                        <img src="<?php echo base_url(); ?>assets_d/images/insight-dashboard.svg" alt="like">
                                                    </li>                                                               
                                                    <li class="loveMenu">
                                                        <img src="<?php echo base_url(); ?>assets_d/images/love-dashboard.svg" alt="like">
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <a>
                                                <img src="<?php echo base_url(); ?>assets_d/images/comment-grey.svg" alt="comment">
                                                <span>Comment</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a>
                                                <img src="<?php echo base_url(); ?>assets_d/images/share-grey.svg" alt="comment">
                                                <span>Share</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="commentBoxWrap">
                                    <div class="comment-popularity">
                                        <div class="relevant">
                                            <div class="value">Most Relevant</div>
                                            <div class="caretIcon">
                                                <img src="<?php echo base_url(); ?>assets_d/images/down-arrow1.svg" alt="down arrow">
                                            </div>
                                        </div>
                                        <div class="commentmsg">
                                            <a>Hide Comments</a>
                                        </div>
                                    </div>
                                    <div class="chatMsgBox">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets_d/images/ct_user.jpg" alt="User">
                                        </figure>
                                        <div class="right">
                                            <div class="userWrapText">
                                                <h4>User Name</h4>
                                                <p>Lorem Ipsum is simply dummy text of the printing and</p>
                                                <div class="leftStatus">
                                                    <a>
                                                        <img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Like">
                                                        <span>24</span>
                                                    </a>
                                                    <a>Like</a>
                                                    <a>Reply</a>
                                                </div>
                                            </div>
                                            <div class="dotsBullet dropdown">
                                                <img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="more" data-toggle="dropdown">
                                                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                                    <li role="presentation">
                                                        <a role="menuitem" tabindex="-1" href="javascript:void(0);">
                                                            <div class="left">
                                                                <img src="<?php echo base_url(); ?>assets_d/images/restricted.svg" alt="Save">
                                                            </div>
                                                            <div class="right">
                                                                <span>Hide/block</span>  
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li role="presentation">
                                                        <a role="menuitem" tabindex="-1" href="javascript:void(0);">
                                                            <div class="left">
                                                                <img src="<?php echo base_url(); ?>assets_d/images/trash.svg" alt="Link">
                                                            </div>
                                                            <div class="right">
                                                                <span>Delete</span>
                                                            </div>
                                                        </a> 
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="chatMsgBox">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets_d/images/ct_user.jpg" alt="User">
                                        </figure>
                                        <div class="right">
                                            <div class="userWrapText">
                                                <h4>User Name</h4>
                                                <p>Lorem Ipsum is simply dummy text of the printing and</p>
                                                <div class="leftStatus">
                                                    <a>
                                                        <img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Like">
                                                        <span>24</span>
                                                    </a>
                                                    <a>Like</a>
                                                    <a class="reply">Reply(2)</a>
                                                    <div class="innerReplyBox">
                                                        <figure>
                                                            <img src="<?php echo base_url(); ?>assets_d/images/ct_user.jpg" alt="User">
                                                        </figure>
                                                        <div class="right">
                                                            <div class="userWrapText">
                                                                <h4>User Name</h4>
                                                                <p>Lorem Ipsum is simply dummy text of the printing and</p>
                                                                <div class="leftStatus">
                                                                    <a>Like</a>
                                                                </div>
                                                            </div>
                                                            <div class="dotsBullet dropdown">
                                                                <img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="more" data-toggle="dropdown">
                                                                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                                                    <li role="presentation">
                                                                        <a role="menuitem" tabindex="-1" href="javascript:void(0);">
                                                                            <div class="left">
                                                                                <img src="<?php echo base_url(); ?>assets_d/images/restricted.svg" alt="Save">
                                                                            </div>
                                                                            <div class="right">
                                                                                <span>Hide/block</span>  
                                                                            </div>
                                                                        </a>
                                                                    </li>
                                                                    <li role="presentation">
                                                                        <a role="menuitem" tabindex="-1" href="javascript:void(0);">
                                                                            <div class="left">
                                                                                <img src="<?php echo base_url(); ?>assets_d/images/trash.svg" alt="Link">
                                                                            </div>
                                                                            <div class="right">
                                                                                <span>Delete</span>
                                                                            </div>
                                                                        </a> 
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="innerReplyBox">
                                                        <figure>
                                                            <img src="<?php echo base_url(); ?>assets_d/images/ct_user.jpg" alt="User">
                                                        </figure>
                                                        <div class="right">
                                                            <div class="userWrapText">
                                                                <h4>User Name</h4>
                                                                <p>Lorem Ipsum is simply dummy text of the printing and</p>
                                                                <div class="leftStatus">
                                                                    <a>Like</a>
                                                                </div>
                                                            </div>
                                                            <div class="dotsBullet dropdown">
                                                                <img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="more" data-toggle="dropdown">
                                                                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                                                    <li role="presentation">
                                                                        <a role="menuitem" tabindex="-1" href="javascript:void(0);">
                                                                            <div class="left">
                                                                                <img src="<?php echo base_url(); ?>assets_d/images/restricted.svg" alt="Save">
                                                                            </div>
                                                                            <div class="right">
                                                                                <span>Hide/block</span>  
                                                                            </div>
                                                                        </a>
                                                                    </li>
                                                                    <li role="presentation">
                                                                        <a role="menuitem" tabindex="-1" href="javascript:void(0);">
                                                                            <div class="left">
                                                                                <img src="<?php echo base_url(); ?>assets_d/images/trash.svg" alt="Link">
                                                                            </div>
                                                                            <div class="right">
                                                                                <span>Delete</span>
                                                                            </div>
                                                                        </a> 
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="commentWrapBox">
                                                        <figure>
                                                            <img src="<?php echo base_url(); ?>assets_d/images/ct_user.jpg" alt="User">
                                                        </figure>
                                                        <input type="text" name="" placeholder="Comment" id="em_0">
                                                        <div class="mediaAction">
                                                            <button type="button">
                                                                <img src="<?php echo base_url(); ?>assets_d/images/image.svg" alt="Add Files">
                                                                <input type="file">
                                                            </button>
                                                        </div>
                                                    </div>  
                                                </div>
                                            </div>
                                            <div class="dotsBullet dropdown">
                                                <img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="more" data-toggle="dropdown">
                                                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                                    <li role="presentation">
                                                        <a role="menuitem" tabindex="-1" href="javascript:void(0);">
                                                            <div class="left">
                                                                <img src="<?php echo base_url(); ?>assets_d/images/restricted.svg" alt="Save">
                                                            </div>
                                                            <div class="right">
                                                                <span>Hide/block</span>  
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li role="presentation">
                                                        <a role="menuitem" tabindex="-1" href="javascript:void(0);">
                                                            <div class="left">
                                                                <img src="<?php echo base_url(); ?>assets_d/images/trash.svg" alt="Link">
                                                            </div>
                                                            <div class="right">
                                                                <span>Delete</span>
                                                            </div>
                                                        </a> 
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="chatMsgBox">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets_d/images/ct_user.jpg" alt="User">
                                        </figure>
                                        <div class="right">
                                            <div class="userWrapText">
                                                <h4>User Name</h4>
                                                <p>Lorem Ipsum is simply dummy text of the printing and</p>
                                                <div class="leftStatus">
                                                    <a>
                                                        <img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Like">
                                                        <span>24</span>
                                                    </a>
                                                    <a>Like</a>
                                                    <a>Reply</a>
                                                </div>
                                            </div>
                                            <div class="dotsBullet dropdown">
                                                <img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="more" data-toggle="dropdown">
                                                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                                    <li role="presentation">
                                                        <a role="menuitem" tabindex="-1" href="javascript:void(0);">
                                                            <div class="left">
                                                                <img src="<?php echo base_url(); ?>assets_d/images/restricted.svg" alt="Save">
                                                            </div>
                                                            <div class="right">
                                                                <span>Hide/block</span>  
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li role="presentation">
                                                        <a role="menuitem" tabindex="-1" href="javascript:void(0);">
                                                            <div class="left">
                                                                <img src="<?php echo base_url(); ?>assets_d/images/trash.svg" alt="Link">
                                                            </div>
                                                            <div class="right">
                                                                <span>Delete</span>
                                                            </div>
                                                        </a> 
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="chatMsgBox">
                                        <div class="commentWrapBox">
                                            <figure>
                                                <img src="<?php echo base_url(); ?>assets_d/images/ct_user.jpg" alt="User">
                                            </figure>
                                            <input type="text" name="" placeholder="Comment" id="em_1">
                                            <div class="mediaAction">
                                                <button type="button">
                                                    <img src="<?php echo base_url(); ?>assets_d/images/image.svg" alt="Add Files">
                                                    <input type="file">
                                                </button>
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        <?php  } } 
?>

<?php if($loadMore == 1) { ?>
    <div class="loadMoreWrapper loadmore" id="loadmore_<?= $nextOffset; ?>">
        <button type="button" onclick="loadMoreFeeds(<?= $nextOffset; ?>);"> Load More</button>
    </div>
<?php } else { ?>
    <div class="loadMoreWrapper reached">
        <button type="button"> You've reached the end!</button>
    </div>
<?php } ?>