<?php
$userdata = $this->session->userdata('user_data');
$user_detail = $this->db->query("SELECT * from user As a INNER JOIN user_info As b ON a.id = b.userID INNER JOIN major_master As c ON b.major = c.id INNER JOIN university As d ON b.intitutionID = d.university_id WHERE a.id = " . $userdata['user_id'])->row_array();
$full_name = $user_detail['first_name'] . ' ' . $user_detail['last_name'];

/*echo '<pre/>';
print_r($user_detail);
die;*/

?>
    <input type="hidden" id="base" value="<?php echo base_url(); ?>">

    <section class="mainContent profile">
        <div class="mainProfileWrapper">
            <div class="profileHeaderWrapper">
                <div class="profileBanner">
                    <figure>
                        <?php if (empty($user_detail['cover_image'])) {
                            ?>
                            <img id="currentCoverPicture" src="<?php echo base_url(); ?>assets_d/images/detail1.jpg"
                                 alt="Profile Banner">
                        <?php } else {
                            ?>
                            <img id="currentCoverPicture"
                                 src="<?php echo base_url() . "uploads/users/cover/" . @$user_detail['cover_image']; ?>"
                                 alt="Profile Banner">
                            <?php
                        } ?>
                    </figure>
                    <div class="changeProfileBanner">
                        <img id="currentCoverPicture" src="<?php echo base_url(); ?>assets_d/images/camera_profile.svg"
                             alt="change Profile Banner">
                        <input type="file" name="upload_cover_image" id="upload_cover_image">
                    </div>
                </div>
                <div class="profileInfoWrapper">
                    <div class="infoWrapper">
                        <div class="profileLogo">
                            <figure>
                                <?php if (empty($user_detail['image'])) {

                                    if (strcasecmp($user_detail['gender'], 'male') == 0) {
                                        ?>
                                        <img id="currentProfilePicture"
                                             src="<?php echo base_url(); ?>uploads/user-male.png" alt="User">
                                    <?php } else {
                                        ?>
                                        <img id="currentProfilePicture"
                                             src="<?php echo base_url(); ?>uploads/user-female.png" alt="User">
                                        <?php
                                    }

                                } else {
                                    ?>
                                    <img id="currentProfilePicture"
                                         src="<?php echo base_url(); ?>uploads/users/<?php echo $user_detail['image']; ?>"
                                         alt="change profile banner"/>
                                    <?php
                                }
                                ?>
                                <!---->
                            </figure>
                            <form id="profile_picture_form">
                                <div class="changeProfile">
                                    <img src="<?php echo base_url(); ?>assets_d/images/camera-circle.svg"
                                         alt="change Profile Banner">
                                    <input type="file" name="upload_image" id="upload_image"/>
                                </div>
                            </form>

                        </div>
                        <div class="profileDtl">
                            <div class="profileInformation">
                                <h4 class="name"><?php echo @$full_name; ?></h4>
                                <h6 class="username"><?php echo @$user_detail['username']; ?>
                                    <span>Joined on <?php echo date("F jS, Y", strtotime($user_detail['added_on'])); ?></span>
                                </h6>
                                <ul class="socialstatus">
                                    <li><span><?php echo $followers; ?></span> Followers</li>
                                    <li><span><?php echo $followings; ?></span> Following</li>
                                    <li>
                                        <a href="<?php echo @$user_detail['fb_link']; ?>">
                                            <img src="<?php echo base_url(); ?>assets_d/images/facebook.svg"
                                                 alt="facebook">
                                        </a>

                                        <a href="<?php echo @$user_detail['twitter_link']; ?>">
                                            <img src="<?php echo base_url(); ?>assets_d/images/twitter.svg"
                                                 alt="twitter">
                                        </a>

                                        <a href="<?php echo @$user_detail['linkedIn_link']; ?>">
                                            <img src="<?php echo base_url(); ?>assets_d/images/linkedin.svg"
                                                 alt="linkedin">
                                        </a>

                                        <a href="<?php echo $user_detail['youtube_link']; ?>">
                                            <img src="<?php echo base_url(); ?>assets_d/images/youtube.svg"
                                                 alt="youtube">
                                        </a>
                                    </li>
                                </ul>
                                <div class="location">
                                    <img src="<?php echo base_url(); ?>assets_d/images/pin.svg" alt="location"> location
                                    name
                                </div>
                            </div>
                            <div class="shareProfile" id="copyShareLink">
                                <input type="hidden" id="sharelink"
                                       value="<?php echo base_url() . 'Profile/shareLink/' . @$userdata['username']; ?>"/>
                                <img src="<?php echo base_url(); ?>assets_d/images/share-profile1.svg"
                                     alt="share profile"> Share Profile
                            </div>
                            <!--    <div class="shareMenu shareOption">
                                        <ul>
                                            <li><a>Add Peer</a></li>
                                            <li><a>Follow</a></li>
                                            <li>
                                                <img src="<?php /*echo base_url(); */ ?>assets_d/images/messagebox.svg" alt="Message">
                                            </li>
                                            <li class="dropdown">
                                                <img src="<?php /*echo base_url(); */ ?>assets_d/images/more.svg" alt="More Option">
                                                <ul>
                                                    <li>
                                                        <a role="menuitem" href="javascript:void(0);">
                                                            <img src="<?php /*echo base_url(); */ ?>assets_d/images/report1.svg" > Report
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a role="menuitem" href="javascript:void(0);">
                                                            <img src="<?php /*echo base_url(); */ ?>assets_d/images/block.svg" > Block
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>-->
                        </div>
                    </div>
                    <div class="tabularLiist">
                        <ul class="nav nav-tabs">
                            <li class="<?php if (!isset($_GET['tab'])) {
                                echo "active";
                            } ?>"><a data-toggle="tab" href="#feed">Feeds</a></li>
                            <li><a data-toggle="tab" href="#profile">Profile</a></li>
                            <li class="<?php if (isset($_GET['tab']) && ($_GET['tab'] == 'peers')) {
                                echo "active";
                            } ?>"><a data-toggle="tab" href="#peers">Peers</a></li>
                            <li><a data-toggle="tab" href="#institution">Institutions</a></li>
                            <li><a data-toggle="tab" href="#courses">Courses</a></li>
                            <li><a data-toggle="tab" href="#professor">Professor</a></li>
                            <li><a data-toggle="tab" href="#market">Market</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-content">
                <div id="feed" class="tab-pane fade in <?php if (!isset($_GET['tab'])) {
                    echo "active";
                } ?>">
                    <div class="innerFeedTabs">
                        <div class="tabularLiist">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#all">All</a></li>
                                <li><a data-toggle="tab" href="#posts">Posts</a></li>
                                <li><a data-toggle="tab" href="#questions">Questions</a></li>
                                <li><a data-toggle="tab" href="#documents">Documents</a></li>
                                <li><a data-toggle="tab" href="#articles">Articles</a></li>
                                <li><a data-toggle="tab" href="#studySets">Study Sets</a></li>
                                <li><a data-toggle="tab" href="#events">Events</a></li>
                                <li><a data-toggle="tab" href="#studySessions">Study Sessions</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="all" class="tab-pane fade in active">
                                    <div class="tabPaneWrapper">
                                        <div class="left">
                                            <div class="box-card">
                                                <div class="createBox">
                                                    <div class="postWrapper">
                                                        <h5>New Post</h5>
                                                        <div class="post-notification">
                                                            <img
                                                                src="<?php echo base_url(); ?>assets_d/images/alert.svg"
                                                                alt="Ring">
                                                        </div>
                                                        <div class="writePostWrapper">
                                                            <figure>
                                                                <?php if (empty($user_detail['image'])) {
                                                                    if ($user_detail['gender'] == 'male') {
                                                                        echo '<img src="' . base_url() . 'uploads/user-male.png" alt="user">';
                                                                    } else {
                                                                        echo '<img src="' . base_url() . 'uploads/user-female.png" alt="user">';
                                                                    }

                                                                } else {
                                                                    ?>
                                                                    <img
                                                                        src="<?php echo base_url() . "uploads/users/" . $user_detail['image']; ?>"
                                                                        alt="user">
                                                                    <?php
                                                                } ?>
                                                            </figure>
                                                            <div class="postMessageWrapper" data-toggle="modal"
                                                                 data-target="#createPost">
                                                                <div class="defaultMessage">What's on your mind ?</div>
                                                            </div>
                                                        </div>
                                                        <div class="addOnPostMessage">
                                                            <div class="imageSection image_upload_button">
                                                                <img
                                                                    src="<?php echo base_url(); ?>assets_d/images/image.svg"
                                                                    alt="image/video">
                                                                <span>Image/Video</span>
                                                            </div>
                                                            <div class="pollSection">
                                                                <img
                                                                    src="<?php echo base_url(); ?>assets_d/images/poll.svg"
                                                                    alt="image/video">
                                                                <span>Poll</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if (isset($all_posts)) {
                                                foreach ($all_posts as $key => $posts) {
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
                                                                        class="timeline"><?php echo time_elapsed_string(@$posts['post_details']->created_at); ?></div>
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
                                                                        <div class="chatMsgBox">
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
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <?php
                                                }
                                            }
                                            ?>


                                            <div class="blankFeed">
                                                <div class="noFeedWrapper">
                                                    <figure>
                                                        <img
                                                            src="<?php echo base_url(); ?>assets_d/images/blank-feeds.png"
                                                            alt="No Feed">
                                                    </figure>
                                                    <h4>Nothing to display</h4>
                                                    <p>Add [username] as your peer to view her latest updates</p>
                                                    <button type="button" class="event_action">Add Peer</button>
                                                </div>
                                            </div>
                                        </div>
                                        <?php include_once 'right-side-content.php' ?>
                                    </div>
                                </div>
                                <div id="posts" class="tab-pane fade in">Posts</div>
                                <div id="questions" class="tab-pane fade in">Questions</div>
                                <div id="documents" class="tab-pane fade in">Documents</div>
                                <div id="articles" class="tab-pane fade in">Articles</div>
                                <div id="studySets" class="tab-pane fade in">Study Sets</div>
                                <div id="events" class="tab-pane fade in">Events</div>
                                <div id="studySessions" class="tab-pane fade in">Study Sessions</div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include_once 'profile-section.php' ?>
                <?php include_once 'peer-section.php' ?>
                <?php include_once 'institution-section.php' ?>
                <?php include_once 'course-section.php' ?>
                <?php include_once 'professor-section.php' ?>
                <?php include_once 'master-section.php' ?>


            </div>
        </div>
    </section>
    <section class="rightsidemsgbar">
        <section class="view message">
            Close <i class="fa fa-arrow-right" aria-hidden="true"></i>
        </section>

        <section class="listBar">
            <section class="listHeader">
                <h6>Blocked Peers</h6>
            </section>
            <section class="listChatBox">
                <?php
                    foreach(@$blocked_users as $users){
                ?>
                        <section class="list">
                            <section class="left">
                                <figure>
                                    <img src="<?php echo userImage($users['id']);?>" alt="user">
                                </figure>
                                <figcaption><?php echo $users['first_name'].' '.$users['last_name']; ?></figcaption>
                            </section>
                            <section class="action">
                                <div class="dropdown">
                                    <i class="fa fa-ellipsis-v dropdown-toggle" data-toggle="dropdown"></i>
                                    <ul class="dropdown-menu" style="right: 0;left: auto;top: 0px;">
                                        <li class="removePeerSugg">
                                            <a href="javascript:void(0)" class="unblock_peer" id="<?php echo $users['id']; ?>">Unblock Peer</a>
                                        </li>
                                    </ul>
                                </div>
                            </section>
                        </section>
                <?php
                    }
                ?>

            </section>
        </section>



        <section class="listBar">
            <section class="listHeader">
                <h6>Peers</h6>
            </section>
            <section class="listChatBox">
            <?php
            foreach(@$all_connections as $users) {
                ?>
                <section class="list">
                    <section class="left">
                        <figure>
                            <img src="<?php echo userImage($users['id']);?>" alt="user">
                        </figure>
                        <figcaption><?php echo $users['first_name'].' '.$users['last_name']; ?></figcaption>
                    </section>
                    <section class="action">

                        <div class="dropdown">

                            <i class="fa fa-ellipsis-v dropdown-toggle" data-toggle="dropdown"></i>
                            <ul class="dropdown-menu" style="right: 0;left: auto;top: 0px;">
                                <li class="removePeerSugg" data-id="<?php echo $users['id'];?>"><a href="javascript:void(0)"  data-toggle="modal" data-target="#removePeerSugg">Remove Peer</a></li>

                            </ul>
                        </div>
                    </section>
                </section>
                <?php
            }
                ?>

            </section>
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


    <div class="modal fade" id="userConnections" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                <div class="modal-body">
                    <div class="createHeader">
                        <div class="closePost" data-dismiss="modal">
                            <img src="images/close-grey.svg" alt="close">
                        </div>
                    </div>
                    <h4>Are you sure you want to unfollow Username?</h4>
                    <div class="profileSection">
                        <div class="profileViewToggleWrapper">
                            <figure>
                                <img
                                    src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
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
                            <img src="images/close-grey.svg" alt="close">
                        </div>
                    </div>
                    <h4>Select Reason to report username</h4>
                    <div class="reportSection">
                        <ul>
                            <li class="active">
                                <a>Reason</a>
                            </li>
                            <li>
                                <a>Reason lorem ipsum</a>
                            </li>
                            <li class="active">
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
                                <a href="javascript:void(0)">Cancel</a>
                            </li>
                            <li class="block">
                                <a href="javascript:void(0)">Report</a>
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
                            <img src="images/close-grey.svg" alt="close">
                        </div>
                    </div>
                    <h4>Are you sure you want to block Username?</h4>
                    <div class="profileSection">
                        <div class="profileViewToggleWrapper">
                            <figure>
                                <img
                                    src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
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
                                    <a href="javascript:void(0)">Block</a>
                                </li>
                            </ul>
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
