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


            $reaction_html = getReactionByReference($value['reference_id'], 'Post');

            $chk_user_reaction = $this->db->get_where('reaction_master', array('user_id'=>$user_id, 'reference_id' => $value['reference_id'], 'reference' => 'Post'))->row_array();

            $get_comments = $this->db->get_where('comment_master', array('reference_id' => $value['reference_id'], 'reference' => 'Post', 'comment_parent_id' => 0, 'status' => 1))->result_array();

?>
                <div class="box-card message">
                    <?php if($posts['post_details']->is_announcement == 1) { ?>
                        <div class="eventMessage">
                            <img src="<?php echo base_url(); ?>assets_d/images/alert.svg" alt="Ring"> 
                        </div>
                    <?php } ?>
                    
                    <div class="dropdown dropdownToggleMenu">
                        <img
                            src="<?php echo base_url(); ?>assets_d/images/more.svg"
                            alt="toggle" data-toggle="dropdown">
                        <ul class="dropdown-menu" role="menu"
                            aria-labelledby="menu1">
                            <li role="presentation" class="deleteReferenceById" data-toggle="modal" data-target="#confirmationModalDeletePost" data-id="<?= $value['reference_id']; ?>">
                                <a role="menuitem" tabindex="-1"
                                   href="javascript:void(0);">
                                    <div class="left">
                                        <img
                                            src="<?php echo base_url(); ?>assets_d/images/hide.svg"
                                            alt="Hide Post">
                                    </div>
                                    <div class="right">
                                        <span>Delete this post</span>
                                        <p>I don't want to keep this post in my
                                            feed</p>
                                    </div>
                                </a>
                            </li>
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
                                $total = $this->db->get_where('user_poll_data', array('post_id' => $value['reference_id']))->num_rows();
                                $user_chk_option = $this->db->get_where('user_poll_data', array('post_id' => $value['reference_id'], 'user_id' => $user_id))->row_array();
                                $option_id = '';
                                if(!empty($user_chk_option)){
                                    $option_id = $user_chk_option['poll_option_id'];
                                }
                            ?>
                                <div id="poll_div_<?= $value['reference_id']; ?>">
                                    <?php foreach ($posts['post_poll_options'] as $options) {
                                        $chk = '';
                                        if(@$options['id'] == $option_id) {
                                            $chk = 'checked="checked"';
                                        }

                                        $count = $this->db->get_where('user_poll_data', array('post_id' => $value['reference_id'], 'poll_option_id' => @$options['id']))->num_rows();
                                        if($count != 0) {
                                            $per = ($count / $total)*100;
                                        } else {
                                            $per = 0;
                                        }
                                        $this->db->select('user_poll_data.*,user.username,user.first_name, user.last_name');
                                        $this->db->join('user','user.id=user_poll_data.user_id');
                                        
                                        $user_list = $this->db->get_where($this->db->dbprefix('user_poll_data'), array('user_poll_data.post_id'=>$value['reference_id'], 'poll_option_id' => @$options['id']))->result_array(); 
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
                                                                <p><?= $per; ?>%</p>
                                                                <?php if(!empty($user_list)) { ?>
                                                                <div class="eventActionWrap userPollList" data-toggle="modal" data-id="<?= @$options['id']; ?>" data-target="#userPollList">
                                                                    <ul>
                                                                        <?php if(!empty($user_list[0])) { ?>
                                                                        <li>
                                                                            <img
                                                                                src="<?= userImage($user_list[0]['user_id']); ?>"
                                                                                alt="user">
                                                                        </li>
                                                                        <?php } ?>
                                                                        <?php if(!empty($user_list[1])) { ?>
                                                                        <li>
                                                                            <img
                                                                                src="<?= userImage($user_list[1]['user_id']); ?>"
                                                                                alt="user">
                                                                        </li>
                                                                        <?php } ?>
                                                                        <?php if(!empty($user_list[2])) { ?>
                                                                        <li>
                                                                            <img
                                                                                src="<?= userImage($user_list[2]['user_id']); ?>"
                                                                                alt="user">
                                                                        </li>
                                                                        <?php } ?>
                                                                        <?php if(!empty($user_list[3])) { ?>
                                                                        <li>
                                                                            <img
                                                                                src="<?= userImage($user_list[3]['user_id']); ?>"
                                                                                alt="user">
                                                                        </li>
                                                                        <?php } ?>
                                                                        <?php if(!empty($user_list[4])) { ?>
                                                                        <li>
                                                                            <img
                                                                                src="<?= userImage($user_list[4]['user_id']); ?>"
                                                                                alt="user">
                                                                        </li>
                                                                        <?php } $left_count = count($user_list) - 5; ?>
                                                                        <?php if($left_count > 0) { ?>
                                                                            <li class="more">
                                                                                +<?= $left_count; ?>
                                                                            </li>
                                                                        <?php } ?>
                                                                    </ul>
                                                                </div>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                        <div class="progress-bar"
                                                             role="progressbar"
                                                             aria-valuenow="<?= $per; ?>"
                                                             aria-valuemin="0"
                                                             aria-valuemax="100"
                                                             style="width:<?= $per; ?>%"></div>
                                                    </div>
                                                </div>
                                                <input type="radio" <?= $chk; ?> name="radio" >
                                                <span class="checkmark" onclick="savePollOption('<?= $value['reference_id']; ?>', '<?php echo @$options['id']; ?>')"></span>
                                            </label>
                                        </div>
                                        <?php
                                    } ?>
                                </div>
                            <?php }
                            ?>

                            <div class="socialStatus">
                                <div class="leftStatus">
                                    <a class="Post_total_likes_<?php echo $value['reference_id']; ?>" onclick="getAllReactionData('<?php echo $value['reference_id']; ?>', 'Post')">
                                        <?php echo $reaction_html; ?>
                                    </a>
                                </div>
                                <div class="rightStatus">
                                    <ul>
                                        <li>
                                            <a>
                                                <img
                                                    src="<?php echo base_url(); ?>assets_d/images/comment-grey.svg"
                                                    alt="comment">
                                                <span id="Post_comment_count_<?php echo $value['reference_id']; ?>"><?php echo count($get_comments); ?></span>
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
                                        <a class="Post_likeMenu_<?php echo $value['reference_id']; ?>">
                                            <?php if(empty($chk_user_reaction)) { ?>
                                                <img
                                                    src="<?php echo base_url(); ?>assets_d/images/like-grey.svg"
                                                    class="likepost" alt="Like">
                                                <span>Like</span>
                                            <?php } else if($chk_user_reaction['reaction_id'] == 1) { ?>
                                                <img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" class="likepost" alt="Like"> 
                                                <span style="color: #185aeb;">Like</span>
                                            <?php } else if($chk_user_reaction['reaction_id'] == 2) { ?>
                                                <img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" class="likepost" alt="Like"><span style="color: #185aeb;">Support</span>
                                            <?php } else if($chk_user_reaction['reaction_id'] == 3) { ?>
                                                <img src="<?php echo base_url(); ?>assets_d/images/celebrate-dashboard.svg" class="likepost" alt="Like"> <span style="color: #185aeb;">Celebrate</span>
                                            <?php } else if($chk_user_reaction['reaction_id'] == 4) { ?>
                                                <img src="<?php echo base_url(); ?>assets_d/images/curious-dashboard.svg" class="likepost" alt="Like"><span style="color: #185aeb;">Insightful</span>
                                            <?php } else if($chk_user_reaction['reaction_id'] == 5) { ?>
                                                <img src="<?php echo base_url(); ?>assets_d/images/insight-dashboard.svg" class="likepost" alt="Like"><span style="color: #185aeb;">Curious</span>
                                            <?php } else if($chk_user_reaction['reaction_id'] == 6) { ?>
                                                <img src="<?php echo base_url(); ?>assets_d/images/love-dashboard.svg" class="likepost" alt="Like"> 
                                                <span style="color: #185aeb;">Love</span>
                                            <?php } ?>
                                                
                                        </a>
                                        <div class="hoverMenu">
                                            <ul>
                                                
                                                <li data-toggle="tooltip" title="Like" onclick="saveReaction('1', '<?php echo $value['reference_id']; ?>', 'Post')" class="likeOption like_option_type"
                                                    id="1"
                                                    data-id="<?php echo $key; ?>">
                                                    <img
                                                        src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg"
                                                        alt="like">
                                                </li>
                                                <li data-toggle="tooltip" onclick="saveReaction('2', '<?php echo $value['reference_id']; ?>', 'Post')" title="Support" class="supportMenu like_option_type"
                                                    id="2"
                                                    data-id="<?php echo $key; ?>">
                                                    <img
                                                        src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg"
                                                        alt="like">
                                                </li>
                                                <li data-toggle="tooltip" onclick="saveReaction('3', '<?php echo $value['reference_id']; ?>', 'Post')" title="Celebrate" class="celebrateMenu like_option_type"
                                                    id="3"
                                                    data-id="<?php echo $key; ?>">
                                                    <img
                                                        src="<?php echo base_url(); ?>assets_d/images/celebrate-dashboard.svg"
                                                        alt="like">
                                                </li>
                                                <li data-toggle="tooltip" onclick="saveReaction('4', '<?php echo $value['reference_id']; ?>', 'Post')" title="Insightful" class="curiousMenu like_option_type"
                                                    id="4"
                                                    data-id="<?php echo $key; ?>">
                                                    <img
                                                        src="<?php echo base_url(); ?>assets_d/images/curious-dashboard.svg"
                                                        alt="like">
                                                </li>
                                                <li data-toggle="tooltip" onclick="saveReaction('5', '<?php echo $value['reference_id']; ?>', 'Post')" title="Curious" class="insightMenu like_option_type"
                                                    id="5"
                                                    data-id="<?php echo $key; ?>">
                                                    <img
                                                        src="<?php echo base_url(); ?>assets_d/images/insight-dashboard.svg"
                                                        alt="like">
                                                </li>
                                                <li data-toggle="tooltip" onclick="saveReaction('6', '<?php echo $value['reference_id']; ?>', 'Post')" title="Love" class="loveMenu like_option_type"
                                                    id="6"
                                                    data-id="<?php echo $key; ?>">
                                                    <img
                                                        src="<?php echo base_url(); ?>assets_d/images/love-dashboard.svg"
                                                        alt="like">
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    
                                    <li  <?php if (@$posts['post_details']->is_comment_on != 1) { ?>  class="tooltip" style="opacity: 0.7;cursor: not-allowed;" <?php } else { ?> onclick="showCommentBoxWrap('Post', '<?php echo $value['reference_id']; ?>')" <?php } ?>>
                                        <?php if (@$posts['post_details']->is_comment_on != 1) { ?><span class="tooltiptext">Comment is disabled</span><?php } ?>
                                        <a <?php if (@$posts['post_details']->is_comment_on != 1) { ?> style="cursor: not-allowed;" <?php } ?>>
                                            
                                            <img
                                                src="<?php echo base_url(); ?>assets_d/images/comment-grey.svg"
                                                alt="comment">
                                            <span>Comment</span>
                                        </a>
                                    </li>
                                    
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
                            <div class="commentBoxWrap" id="Post_comment_<?php echo $value['reference_id']; ?>">
                                    <div class="comment-popularity">
                                        <div class="relevant">
                                            <div class="value">Most Relevant</div>
                                            <div class="caretIcon">
                                                <img src="<?php echo base_url(); ?>assets_d/images/down-arrow1.svg" alt="down arrow">
                                            </div>
                                        </div>
                                        <div class="commentmsg">
                                            <a onclick="hideCommentBoxWrap('Post', '<?php echo $value['reference_id']; ?>')">Hide Comments</a>
                                        </div>
                                    </div>
                                    
                                    <div id="Post_commentappend_<?php echo $value['reference_id']; ?>">
                                        <?php foreach ($get_comments as $key => $value) { 
                                            $comment_user = $this->db->get_where('user_info', array('userID' => $value['user_id']))->row_array();
                                            $count_like = $this->db->get_where('comment_like_master', array('comment_id' => $value['id'], 'status' => 1))->num_rows();

                                            if($count_like == 0){
                                                $css = 'display: none;';
                                            } else {
                                                $css = '';
                                            } 

                                            $if_user_liked = $this->db->get_where('comment_like_master', array('comment_id' => $value['id'], 'status' => 1, 'user_id' => $user_id))->num_rows();

                                            $comment_replies = $this->db->get_where('comment_master', array('comment_parent_id' => $value['id'], 'status' => 1))->result_array();
                                        ?>
                                            <div class="chatMsgBox">
                                        <figure>
                                            <img src="<?php echo userImage($value['user_id']); ?>" alt="User">
                                        </figure>
                                        <div class="right">
                                            <div class="userWrapText">
                                                <h4><?php echo $comment_user['nickname']; ?></h4>
                                                <?php if($value['type'] == 1) { ?>
                                                    <img src="<?php echo base_url(); ?>uploads/comments/<?= $value['comment']; ?>" alt="comment" style="height: 70px;">
                                                <?php } else { ?>
                                                    <p><?php echo $value['comment']; ?></p>
                                                <?php } ?>
                                                <div class="leftStatus">
                                                    <a id="reactcomment_<?php echo $value['id']; ?>" style="<?= $css; ?>">
                                                        <img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Like">
                                                        <span id="comment_like_count_<?php echo $value['id']; ?>"><?php echo $count_like; ?></span>
                                                    </a>
                                                    <a onclick="likeCommentByReference('<?php echo $value['id']; ?>')" id="like_text_<?php echo $value['id']; ?>"><?php if($if_user_liked == 1) { echo 'Liked'; } else { echo 'Like'; } ?></a>
                                                    <?php if(!empty($comment_replies)) { $reply_css= ""; } else { $reply_css= "display:none;"; } ?>
                                                    <a onclick="showReplyBox('<?php echo $value['id']; ?>')">Reply <span style="<?= $reply_css; ?>" id="comment_reply_count_<?php echo $value['id']; ?>">(<?php echo count($comment_replies); ?>)</span>  </a>
                                                    <div id="show_reply_box_<?php echo $value['id']; ?>" style="display: none;">
                                                        <div id="commentreply_box_<?php echo $value['id']; ?>">
                                                            <?php foreach ($comment_replies as $key2 => $value2) { 
                                                                $user_info = $this->db->get_where('user_info', array('userID' => $value2['user_id']))->row_array();
                                                                $count_like2 = $this->db->get_where('comment_like_master', array('comment_id' => $value2['id'], 'status' => 1))->num_rows();

                                                                if($count_like2 == 0){
                                                                    $css2 = 'display: none;';
                                                                } else {
                                                                    $css2 = '';
                                                                } 

                                                                $if_user_liked2 = $this->db->get_where('comment_like_master', array('comment_id' => $value2['id'], 'status' => 1, 'user_id' => $user_id))->num_rows();
                                                            ?>
                                                                <div class="innerReplyBox" >
                                                            <figure>
                                                                <img src="<?php echo userImage($value2['user_id']); ?>"
                                                                    alt="User">
                                                            </figure>
                                                            <div
                                                                class="right">
                                                                <div
                                                                    class="userWrapText">
                                                                    <h4><?php echo $user_info['nickname']; ?></h4>
                                                                    <p><?php echo $value2['comment']; ?></p>
                                                                    
                                                                    <div class="leftStatus">
                                                                        <a id="reactcomment_<?php echo $value2['id']; ?>" style="<?= $css2; ?>">
                                                                            <img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Like">
                                                                            <span id="comment_like_count_<?php echo $value2['id']; ?>"><?php echo $count_like2; ?></span>
                                                                        </a>
                                                                        <a onclick="likeCommentByReference('<?php echo $value2['id']; ?>')" id="like_text_<?php echo $value2['id']; ?>"><?php if($if_user_liked2 == 1) { echo 'Liked'; } else { echo 'Like'; } ?></a>
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
                                                            <?php } ?>
                                                            
                                                        </div>
                                                        <div class="commentWrapBox">
                                                            <figure>
                                                                <img src="<?php echo userImage($user_id); ?>" alt="User">
                                                            </figure>
                                                            <input type="text" name="" placeholder="Reply" id="comment_reply_<?php echo $value['id'] ?>" onkeypress="postCommentReply(event,'<?php echo $value['id'] ?>', this.value)">
                                                            
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
                                        <?php } ?>
                                    </div>
                                    <div class="chatMsgBox">
                                        <div class="commentWrapBox">
                                            <figure>
                                                <img src="<?php echo userImage($user_id);  ?>" alt="User">
                                            </figure>
                                            <input type="text" name="" placeholder="Comment" id="comment_input_Post_<?php echo $value['reference_id']; ?>" data-id="Post" class="commentReference" onkeypress="postCommentByReference(event, 'Post', '<?php echo $value['reference_id']; ?>', this.value)">
                                            <div class="mediaAction">
                                                <button type="button">
                                                    <img src="<?php echo base_url(); ?>assets_d/images/image.svg" alt="Add Files">
                                                    <input type="file" id="comment_image_Post_<?php echo $value['reference_id']; ?>" onchange="postImageComment('Post', '<?php echo $value['reference_id']; ?>')">
                                                </button>
                                            </div>
                                        </div>  
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
<?php
            } if($value['reference'] == 'event') { 
                
                $event_detail = $this->db->get_where('event_master', array('id' => $value['reference_id']))->row_array();
                
                $chk_view = 1;
                $txt = "added a new event";

                $reaction_html = getReactionByReference($value['reference_id'], 'event');

                $chk_user_reaction = $this->db->get_where('reaction_master', array('user_id'=>$user_id, 'reference_id' => $value['reference_id'], 'reference' => 'event'))->row_array();

                $get_comments = $this->db->get_where('comment_master', array('reference_id' => $value['reference_id'], 'reference' => 'event', 'comment_parent_id' => 0, 'status' => 1))->result_array();
                
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
                                        <a class="event_total_likes_<?php echo $value['reference_id']; ?>" onclick="getAllReactionData('<?php echo $value['reference_id']; ?>', 'event')">
                                            <?php echo $reaction_html; ?>
                                        </a>
                                    </div>
                                    <div class="rightStatus">
                                        <ul>
                                            <li>
                                                <a>
                                                    <img src="<?php echo base_url(); ?>assets_d/images/comment-grey.svg" alt="comment">
                                                    <span id="event_comment_count_<?php echo $value['reference_id']; ?>"><?php echo count($get_comments); ?></span>
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
                                            <a class="event_likeMenu_<?php echo $value['reference_id']; ?>">
                                                <?php if(empty($chk_user_reaction)) { ?>
                                                    <img
                                                        src="<?php echo base_url(); ?>assets_d/images/like-grey.svg"
                                                        class="likepost" alt="Like">
                                                    <span>Like</span>
                                                <?php } else if($chk_user_reaction['reaction_id'] == 1) { ?>
                                                    <img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" class="likepost" alt="Like"> 
                                                    <span style="color: #185aeb;">Like</span>
                                                <?php } else if($chk_user_reaction['reaction_id'] == 2) { ?>
                                                    <img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" class="likepost" alt="Like"><span style="color: #185aeb;">Support</span>
                                                <?php } else if($chk_user_reaction['reaction_id'] == 3) { ?>
                                                    <img src="<?php echo base_url(); ?>assets_d/images/celebrate-dashboard.svg" class="likepost" alt="Like"> <span style="color: #185aeb;">Celebrate</span>
                                                <?php } else if($chk_user_reaction['reaction_id'] == 4) { ?>
                                                    <img src="<?php echo base_url(); ?>assets_d/images/curious-dashboard.svg" class="likepost" alt="Like"><span style="color: #185aeb;">Insightful</span>
                                                <?php } else if($chk_user_reaction['reaction_id'] == 5) { ?>
                                                    <img src="<?php echo base_url(); ?>assets_d/images/insight-dashboard.svg" class="likepost" alt="Like"><span style="color: #185aeb;">Curious</span>
                                                <?php } else if($chk_user_reaction['reaction_id'] == 6) { ?>
                                                    <img src="<?php echo base_url(); ?>assets_d/images/love-dashboard.svg" class="likepost" alt="Like"> 
                                                    <span style="color: #185aeb;">Love</span>
                                                <?php } ?>
                                                    
                                            </a>
                                            <div class="hoverMenu">
                                                <ul>
                                                    
                                                    <li data-toggle="tooltip" title="Like" onclick="saveReaction('1', '<?php echo $value['reference_id']; ?>', 'event')" class="likeOption like_option_type"
                                                        id="1"
                                                        data-id="<?php echo $key; ?>">
                                                        <img
                                                            src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg"
                                                            alt="like">
                                                    </li>
                                                    <li data-toggle="tooltip" onclick="saveReaction('2', '<?php echo $value['reference_id']; ?>', 'event')" title="Support" class="supportMenu like_option_type"
                                                        id="2"
                                                        data-id="<?php echo $key; ?>">
                                                        <img
                                                            src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg"
                                                            alt="like">
                                                    </li>
                                                    <li data-toggle="tooltip" onclick="saveReaction('3', '<?php echo $value['reference_id']; ?>', 'event')" title="Celebrate" class="celebrateMenu like_option_type"
                                                        id="3"
                                                        data-id="<?php echo $key; ?>">
                                                        <img
                                                            src="<?php echo base_url(); ?>assets_d/images/celebrate-dashboard.svg"
                                                            alt="like">
                                                    </li>
                                                    <li data-toggle="tooltip" onclick="saveReaction('4', '<?php echo $value['reference_id']; ?>', 'event')" title="Insightful" class="curiousMenu like_option_type"
                                                        id="4"
                                                        data-id="<?php echo $key; ?>">
                                                        <img
                                                            src="<?php echo base_url(); ?>assets_d/images/curious-dashboard.svg"
                                                            alt="like">
                                                    </li>
                                                    <li data-toggle="tooltip" onclick="saveReaction('5', '<?php echo $value['reference_id']; ?>', 'event')" title="Curious" class="insightMenu like_option_type"
                                                        id="5"
                                                        data-id="<?php echo $key; ?>">
                                                        <img
                                                            src="<?php echo base_url(); ?>assets_d/images/insight-dashboard.svg"
                                                            alt="like">
                                                    </li>
                                                    <li data-toggle="tooltip" onclick="saveReaction('6', '<?php echo $value['reference_id']; ?>', 'event')" title="Love" class="loveMenu like_option_type"
                                                        id="6"
                                                        data-id="<?php echo $key; ?>">
                                                        <img
                                                            src="<?php echo base_url(); ?>assets_d/images/love-dashboard.svg"
                                                            alt="like">
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li onclick="showCommentBoxWrap('event', '<?php echo $value['reference_id']; ?>')">
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
                                <div class="commentBoxWrap" id="event_comment_<?php echo $value['reference_id']; ?>">
                                    <div class="comment-popularity">
                                        <div class="relevant">
                                            <div class="value">Most Relevant</div>
                                            <div class="caretIcon">
                                                <img src="<?php echo base_url(); ?>assets_d/images/down-arrow1.svg" alt="down arrow">
                                            </div>
                                        </div>
                                        <div class="commentmsg">
                                            <a onclick="hideCommentBoxWrap('event', '<?php echo $value['reference_id']; ?>')">Hide Comments</a>
                                        </div>
                                    </div>
                                    
                                    <div id="event_commentappend_<?php echo $value['reference_id']; ?>">
                                        <?php foreach ($get_comments as $key => $value) { 
                                            $comment_user = $this->db->get_where('user_info', array('userID' => $value['user_id']))->row_array();
                                            $count_like = $this->db->get_where('comment_like_master', array('comment_id' => $value['id'], 'status' => 1))->num_rows();

                                            if($count_like == 0){
                                                $css = 'display: none;';
                                            } else {
                                                $css = '';
                                            } 

                                            $if_user_liked = $this->db->get_where('comment_like_master', array('comment_id' => $value['id'], 'status' => 1, 'user_id' => $user_id))->num_rows();

                                            $comment_replies = $this->db->get_where('comment_master', array('comment_parent_id' => $value['id'], 'status' => 1))->result_array();
                                        ?>
                                            <div class="chatMsgBox">
                                        <figure>
                                            <img src="<?php echo userImage($value['user_id']); ?>" alt="User">
                                        </figure>
                                        <div class="right">
                                            <div class="userWrapText">
                                                <h4><?php echo $comment_user['nickname']; ?></h4>
                                                <?php if($value['type'] == 1) { ?>
                                                    <img src="<?php echo base_url(); ?>uploads/comments/<?= $value['comment']; ?>" alt="comment" style="height: 70px;">
                                                <?php } else { ?>
                                                    <p><?php echo $value['comment']; ?></p>
                                                <?php } ?>
                                                <div class="leftStatus">
                                                    <a id="reactcomment_<?php echo $value['id']; ?>" style="<?= $css; ?>">
                                                        <img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Like">
                                                        <span id="comment_like_count_<?php echo $value['id']; ?>"><?php echo $count_like; ?></span>
                                                    </a>
                                                    <a onclick="likeCommentByReference('<?php echo $value['id']; ?>')" id="like_text_<?php echo $value['id']; ?>"><?php if($if_user_liked == 1) { echo 'Liked'; } else { echo 'Like'; } ?></a>
                                                    <?php if(!empty($comment_replies)) { $reply_css= ""; } else { $reply_css= "display:none;"; } ?>
                                                    <a onclick="showReplyBox('<?php echo $value['id']; ?>')">Reply <span style="<?= $reply_css; ?>" id="comment_reply_count_<?php echo $value['id']; ?>">(<?php echo count($comment_replies); ?>)</span>  </a>
                                                    <div id="show_reply_box_<?php echo $value['id']; ?>" style="display: none;">
                                                        <div id="commentreply_box_<?php echo $value['id']; ?>">
                                                            <?php foreach ($comment_replies as $key2 => $value2) { 
                                                                $user_info = $this->db->get_where('user_info', array('userID' => $value2['user_id']))->row_array();
                                                                $count_like2 = $this->db->get_where('comment_like_master', array('comment_id' => $value2['id'], 'status' => 1))->num_rows();

                                                                if($count_like2 == 0){
                                                                    $css2 = 'display: none;';
                                                                } else {
                                                                    $css2 = '';
                                                                } 

                                                                $if_user_liked2 = $this->db->get_where('comment_like_master', array('comment_id' => $value2['id'], 'status' => 1, 'user_id' => $user_id))->num_rows();
                                                            ?>
                                                                <div class="innerReplyBox" >
                                                            <figure>
                                                                <img src="<?php echo userImage($value2['user_id']); ?>"
                                                                    alt="User">
                                                            </figure>
                                                            <div
                                                                class="right">
                                                                <div
                                                                    class="userWrapText">
                                                                    <h4><?php echo $user_info['nickname']; ?></h4>
                                                                    <p><?php echo $value2['comment']; ?></p>
                                                                    
                                                                    <div class="leftStatus">
                                                                        <a id="reactcomment_<?php echo $value2['id']; ?>" style="<?= $css2; ?>">
                                                                            <img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Like">
                                                                            <span id="comment_like_count_<?php echo $value2['id']; ?>"><?php echo $count_like2; ?></span>
                                                                        </a>
                                                                        <a onclick="likeCommentByReference('<?php echo $value2['id']; ?>')" id="like_text_<?php echo $value2['id']; ?>"><?php if($if_user_liked2 == 1) { echo 'Liked'; } else { echo 'Like'; } ?></a>
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
                                                            <?php } ?>
                                                            
                                                        </div>
                                                        <div class="commentWrapBox">
                                                            <figure>
                                                                <img src="<?php echo userImage($user_id); ?>" alt="User">
                                                            </figure>
                                                            <input type="text" name="" placeholder="Reply" id="comment_reply_<?php echo $value['id'] ?>" onkeypress="postCommentReply(event,'<?php echo $value['id'] ?>', this.value)">
                                                            
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
                                        <?php } ?>
                                    </div>
                                    <div class="chatMsgBox">
                                        <div class="commentWrapBox">
                                            <figure>
                                                <img src="<?php echo userImage($user_id);  ?>" alt="User">
                                            </figure>
                                            <input type="text" name="" placeholder="Comment" id="comment_input_event_<?php echo $value['reference_id']; ?>" data-id="event" class="commentReference" onkeypress="postCommentByReference(event, 'event', '<?php echo $value['reference_id']; ?>', this.value)">
                                            <div class="mediaAction">
                                                <button type="button">
                                                    <img src="<?php echo base_url(); ?>assets_d/images/image.svg" alt="Add Files">
                                                    <input type="file" id="comment_image_event_<?php echo $value['reference_id']; ?>" onchange="postImageComment('event', '<?php echo $value['reference_id']; ?>')">
                                                </button>
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        <?php  } else if($value['reference'] == 'studyset') {  
            
            $studyset_detail = $this->db->get_where('study_sets', array('study_set_id' => $value['reference_id']))->row_array();
            
            $chk_view = 1;

            $reaction_html = getReactionByReference($value['reference_id'], 'studyset');

            $chk_user_reaction = $this->db->get_where('reaction_master', array('user_id'=>$user_id, 'reference_id' => $value['reference_id'], 'reference' => 'studyset'))->row_array();

            $get_comments = $this->db->get_where('comment_master', array('reference_id' => $value['reference_id'], 'reference' => 'studyset', 'comment_parent_id' => 0, 'status' => 1))->result_array();
            
            
        ?>

            <div class="box-card message">
                <div class="eventMessage">
                    <img src="<?php echo base_url(); ?>assets_d/images/Study Sets.svg" alt="Ring"> Study Set
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
                                    <img src="<?php echo userImage($studyset_detail['user_id']); ?>" alt="user">
                                </figure>
                                <?php $user = $this->db->get_where('user', array('id' => $studyset_detail['user_id']))->row_array();
                                    $user_info = $this->db->get_where('user_info', array('userID' => $studyset_detail['user_id']))->row_array();
                                    $university = $this->db->get_where('university', array('university_id' => $user_info['intitutionID']))->row_array(); ?>
                                <div class="right">
                                    <figcaption><a href="<?php echo base_url().'Profile/friends?profile_id='.$user['id'] ?>"><?php echo $user['first_name'].' '.$user['last_name']; ?></a> <span>added a new studyset</span></figcaption>
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
                            <div class="timeline"><?php echo time_ago_in_php($studyset_detail['created_on']); ?></div>
                        </div>
                        <h4><a href="<?php echo base_url(); ?>studyset/details/<?php echo $studyset_detail['study_set_id']; ?>"><?php echo $studyset_detail['name']; ?></a></h4>
                        
                        <div class="imgWrapper type1">
                            <figure>
                                <?php if($studyset_detail['image']) { ?>
                                    <img src="<?php echo base_url();?>uploads/studyset/<?php echo $studyset_detail['image'];?>" alt="Post Image">
                                <?php } else { ?>
                                    <img src="<?php echo base_url();?>assets_d/images/detail1.jpg" alt="Post Image">
                                <?php } ?>
                            </figure>
                        </div>
                        
                        <div class="socialStatus">
                            <div class="leftStatus">
                                <a class="studyset_total_likes_<?php echo $value['reference_id']; ?>" onclick="getAllReactionData('<?php echo $value['reference_id']; ?>', 'studyset')">
                                    <?php echo $reaction_html; ?>
                                </a>
                            </div>
                            <div class="rightStatus">
                                <ul>
                                    <li>
                                        <a>
                                            <div class="my-rating-4" data-rating="1.5">
                                            </div>                                                                      
                                            <span>1200</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <img src="<?php echo base_url(); ?>assets_d/images/comment-grey.svg" alt="comment">
                                            <span id="studyset_comment_count_<?php echo $value['reference_id']; ?>"><?php echo count($get_comments); ?></span>
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
                                    <a class="studyset_likeMenu_<?php echo $value['reference_id']; ?>">
                                        <?php if(empty($chk_user_reaction)) { ?>
                                            <img
                                                src="<?php echo base_url(); ?>assets_d/images/like-grey.svg"
                                                class="likepost" alt="Like">
                                            <span>Like</span>
                                        <?php } else if($chk_user_reaction['reaction_id'] == 1) { ?>
                                            <img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" class="likepost" alt="Like"> 
                                            <span style="color: #185aeb;">Like</span>
                                        <?php } else if($chk_user_reaction['reaction_id'] == 2) { ?>
                                            <img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" class="likepost" alt="Like"><span style="color: #185aeb;">Support</span>
                                        <?php } else if($chk_user_reaction['reaction_id'] == 3) { ?>
                                            <img src="<?php echo base_url(); ?>assets_d/images/celebrate-dashboard.svg" class="likepost" alt="Like"> <span style="color: #185aeb;">Celebrate</span>
                                        <?php } else if($chk_user_reaction['reaction_id'] == 4) { ?>
                                            <img src="<?php echo base_url(); ?>assets_d/images/curious-dashboard.svg" class="likepost" alt="Like"><span style="color: #185aeb;">Insightful</span>
                                        <?php } else if($chk_user_reaction['reaction_id'] == 5) { ?>
                                            <img src="<?php echo base_url(); ?>assets_d/images/insight-dashboard.svg" class="likepost" alt="Like"><span style="color: #185aeb;">Curious</span>
                                        <?php } else if($chk_user_reaction['reaction_id'] == 6) { ?>
                                            <img src="<?php echo base_url(); ?>assets_d/images/love-dashboard.svg" class="likepost" alt="Like"> 
                                            <span style="color: #185aeb;">Love</span>
                                        <?php } ?>
                                            
                                    </a>
                                    <div class="hoverMenu">
                                        <ul>
                                            
                                            <li data-toggle="tooltip" title="Like" onclick="saveReaction('1', '<?php echo $value['reference_id']; ?>', 'studyset')" class="likeOption like_option_type"
                                                id="1"
                                                data-id="<?php echo $key; ?>">
                                                <img
                                                    src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg"
                                                    alt="like">
                                            </li>
                                            <li data-toggle="tooltip" onclick="saveReaction('2', '<?php echo $value['reference_id']; ?>', 'studyset')" title="Support" class="supportMenu like_option_type"
                                                id="2"
                                                data-id="<?php echo $key; ?>">
                                                <img
                                                    src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg"
                                                    alt="like">
                                            </li>
                                            <li data-toggle="tooltip" onclick="saveReaction('3', '<?php echo $value['reference_id']; ?>', 'studyset')" title="Celebrate" class="celebrateMenu like_option_type"
                                                id="3"
                                                data-id="<?php echo $key; ?>">
                                                <img
                                                    src="<?php echo base_url(); ?>assets_d/images/celebrate-dashboard.svg"
                                                    alt="like">
                                            </li>
                                            <li data-toggle="tooltip" onclick="saveReaction('4', '<?php echo $value['reference_id']; ?>', 'studyset')" title="Insightful" class="curiousMenu like_option_type"
                                                id="4"
                                                data-id="<?php echo $key; ?>">
                                                <img
                                                    src="<?php echo base_url(); ?>assets_d/images/curious-dashboard.svg"
                                                    alt="like">
                                            </li>
                                            <li data-toggle="tooltip" onclick="saveReaction('5', '<?php echo $value['reference_id']; ?>', 'studyset')" title="Curious" class="insightMenu like_option_type"
                                                id="5"
                                                data-id="<?php echo $key; ?>">
                                                <img
                                                    src="<?php echo base_url(); ?>assets_d/images/insight-dashboard.svg"
                                                    alt="like">
                                            </li>
                                            <li data-toggle="tooltip" onclick="saveReaction('6', '<?php echo $value['reference_id']; ?>', 'studyset')" title="Love" class="loveMenu like_option_type"
                                                id="6"
                                                data-id="<?php echo $key; ?>">
                                                <img
                                                    src="<?php echo base_url(); ?>assets_d/images/love-dashboard.svg"
                                                    alt="like">
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li onclick="showCommentBoxWrap('studyset', '<?php echo $value['reference_id']; ?>')">
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
                        <div class="commentBoxWrap" id="studyset_comment_<?php echo $value['reference_id']; ?>">
                                    <div class="comment-popularity">
                                        <div class="relevant">
                                            <div class="value">Most Relevant</div>
                                            <div class="caretIcon">
                                                <img src="<?php echo base_url(); ?>assets_d/images/down-arrow1.svg" alt="down arrow">
                                            </div>
                                        </div>
                                        <div class="commentmsg">
                                            <a onclick="hideCommentBoxWrap('studyset', '<?php echo $value['reference_id']; ?>')">Hide Comments</a>
                                        </div>
                                    </div>
                                    
                                    <div id="studyset_commentappend_<?php echo $value['reference_id']; ?>">
                                        <?php foreach ($get_comments as $key => $value) { 
                                            $comment_user = $this->db->get_where('user_info', array('userID' => $value['user_id']))->row_array();
                                            $count_like = $this->db->get_where('comment_like_master', array('comment_id' => $value['id'], 'status' => 1))->num_rows();

                                            if($count_like == 0){
                                                $css = 'display: none;';
                                            } else {
                                                $css = '';
                                            } 

                                            $if_user_liked = $this->db->get_where('comment_like_master', array('comment_id' => $value['id'], 'status' => 1, 'user_id' => $user_id))->num_rows();

                                            $comment_replies = $this->db->get_where('comment_master', array('comment_parent_id' => $value['id'], 'status' => 1))->result_array();
                                        ?>
                                            <div class="chatMsgBox">
                                        <figure>
                                            <img src="<?php echo userImage($value['user_id']); ?>" alt="User">
                                        </figure>
                                        <div class="right">
                                            <div class="userWrapText">
                                                <h4><?php echo $comment_user['nickname']; ?></h4>
                                                <?php if($value['type'] == 1) { ?>
                                                    <img src="<?php echo base_url(); ?>uploads/comments/<?= $value['comment']; ?>" alt="comment" style="height: 70px;">
                                                <?php } else { ?>
                                                    <p><?php echo $value['comment']; ?></p>
                                                <?php } ?>
                                                <div class="leftStatus">
                                                    <a id="reactcomment_<?php echo $value['id']; ?>" style="<?= $css; ?>">
                                                        <img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Like">
                                                        <span id="comment_like_count_<?php echo $value['id']; ?>"><?php echo $count_like; ?></span>
                                                    </a>
                                                    <a onclick="likeCommentByReference('<?php echo $value['id']; ?>')" id="like_text_<?php echo $value['id']; ?>"><?php if($if_user_liked == 1) { echo 'Liked'; } else { echo 'Like'; } ?></a>
                                                    <?php if(!empty($comment_replies)) { $reply_css= ""; } else { $reply_css= "display:none;"; } ?>
                                                    <a onclick="showReplyBox('<?php echo $value['id']; ?>')">Reply <span style="<?= $reply_css; ?>" id="comment_reply_count_<?php echo $value['id']; ?>">(<?php echo count($comment_replies); ?>)</span>  </a>
                                                    <div id="show_reply_box_<?php echo $value['id']; ?>" style="display: none;">
                                                        <div id="commentreply_box_<?php echo $value['id']; ?>" >
                                                            <?php foreach ($comment_replies as $key2 => $value2) { 
                                                                $user_info = $this->db->get_where('user_info', array('userID' => $value2['user_id']))->row_array();
                                                                $count_like2 = $this->db->get_where('comment_like_master', array('comment_id' => $value2['id'], 'status' => 1))->num_rows();

                                                                if($count_like2 == 0){
                                                                    $css2 = 'display: none;';
                                                                } else {
                                                                    $css2 = '';
                                                                } 

                                                                $if_user_liked2 = $this->db->get_where('comment_like_master', array('comment_id' => $value2['id'], 'status' => 1, 'user_id' => $user_id))->num_rows();
                                                            ?>
                                                                <div class="innerReplyBox" >
                                                            <figure>
                                                                <img src="<?php echo userImage($value2['user_id']); ?>"
                                                                    alt="User">
                                                            </figure>
                                                            <div
                                                                class="right">
                                                                <div
                                                                    class="userWrapText">
                                                                    <h4><?php echo $user_info['nickname']; ?></h4>
                                                                    <p><?php echo $value2['comment']; ?></p>
                                                                    
                                                                    <div class="leftStatus">
                                                                        <a id="reactcomment_<?php echo $value2['id']; ?>" style="<?= $css2; ?>">
                                                                            <img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Like">
                                                                            <span id="comment_like_count_<?php echo $value2['id']; ?>"><?php echo $count_like2; ?></span>
                                                                        </a>
                                                                        <a onclick="likeCommentByReference('<?php echo $value2['id']; ?>')" id="like_text_<?php echo $value2['id']; ?>"><?php if($if_user_liked2 == 1) { echo 'Liked'; } else { echo 'Like'; } ?></a>
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
                                                            <?php } ?>
                                                            
                                                        </div>
                                                        <div class="commentWrapBox">
                                                            <figure>
                                                                <img src="<?php echo userImage($user_id); ?>" alt="User">
                                                            </figure>
                                                            <input type="text" name="" placeholder="Reply" id="comment_reply_<?php echo $value['id'] ?>" onkeypress="postCommentReply(event,'<?php echo $value['id'] ?>', this.value)">
                                                            
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
                                        <?php } ?>
                                    </div>
                                    <div class="chatMsgBox">
                                        <div class="commentWrapBox">
                                            <figure>
                                                <img src="<?php echo userImage($user_id);  ?>" alt="User">
                                            </figure>
                                            <input type="text" name="" placeholder="Comment" id="comment_input_studyset_<?php echo $value['reference_id']; ?>" data-id="studyset" class="commentReference" onkeypress="postCommentByReference(event, 'studyset', '<?php echo $value['reference_id']; ?>', this.value)">
                                            <div class="mediaAction">
                                                <button type="button">
                                                    <img src="<?php echo base_url(); ?>assets_d/images/image.svg" alt="Add Files">
                                                    <input type="file" id="comment_image_studyset_<?php echo $value['reference_id']; ?>" onchange="postImageComment('studyset', '<?php echo $value['reference_id']; ?>')">
                                                </button>
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                    </div>
                </div>
            </div>

        <?php } else if($value['reference'] == 'document') { 
            
            $document_detail = $this->db->get_where('document_master', array('id' => $value['reference_id']))->row_array();
            $chk_view = 1;
            
            $reaction_html = getReactionByReference($value['reference_id'], 'document');

            $chk_user_reaction = $this->db->get_where('reaction_master', array('user_id'=>$user_id, 'reference_id' => $value['reference_id'], 'reference' => 'document'))->row_array();

            $get_comments = $this->db->get_where('comment_master', array('reference_id' => $value['reference_id'], 'reference' => 'document', 'comment_parent_id' => 0, 'status' => 1))->result_array();
            
        ?> 
            <div class="box-card message">
                <div class="eventMessage">
                    <img src="<?php echo base_url(); ?>assets_d/images/document.svg" alt="document"> Document
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
                                    <img src="<?php echo userImage($document_detail['created_by']); ?>" alt="user">
                                </figure>
                                <?php $user = $this->db->get_where('user', array('id' => $document_detail['created_by']))->row_array();
                    $user_info = $this->db->get_where('user_info', array('userID' => $document_detail['created_by']))->row_array();
                    $university = $this->db->get_where('university', array('university_id' => $user_info['intitutionID']))->row_array(); ?>
                                <div class="right">
                                    <figcaption><a href="<?php echo base_url().'Profile/friends?profile_id='.$user['id'] ?>"><?php echo $user['first_name'].' '.$user['last_name']; ?></a> <span>added a new document</span></figcaption>
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
                            <div class="timeline"><?php echo time_ago_in_php($document_detail['created_at']); ?></div>
                        </div>
                        <h4><?php echo $document_detail['document_name']; ?></h4>
                        <p><?php echo $document_detail['description']; ?> </p>
                        <div class="documentName">
                            <img src="<?php echo base_url(); ?>assets_d/images/pdf.svg" alt="pdf"> <a href="<?php echo base_url(); ?>account/documentDetail/<?php echo base64_encode($document_detail['id']); ?>"><?php echo $document_detail['featured_image']; ?></a>
                        </div>
                        <div class="socialStatus">
                            <div class="leftStatus">
                                <a class="document_total_likes_<?php echo $value['reference_id']; ?>" onclick="getAllReactionData('<?php echo $value['reference_id']; ?>', 'document')">
                                    <?php echo $reaction_html; ?>
                                </a>
                            </div>
                            <div class="rightStatus">
                                <ul>
                                    <li>
                                        <a>
                                            <div class="my-rating-4" data-rating="1.5">
                                            </div>                                                                      
                                            <span>1200</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <img src="<?php echo base_url(); ?>assets_d/images/comment-grey.svg" alt="comment">
                                            <span id="document_comment_count_<?php echo $value['reference_id']; ?>"><?php echo count($get_comments); ?></span>
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
                                    <a class="document_likeMenu_<?php echo $value['reference_id']; ?>">
                                        <?php if(empty($chk_user_reaction)) { ?>
                                            <img
                                                src="<?php echo base_url(); ?>assets_d/images/like-grey.svg"
                                                class="likepost" alt="Like">
                                            <span>Like</span>
                                        <?php } else if($chk_user_reaction['reaction_id'] == 1) { ?>
                                            <img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" class="likepost" alt="Like"> 
                                            <span style="color: #185aeb;">Like</span>
                                        <?php } else if($chk_user_reaction['reaction_id'] == 2) { ?>
                                            <img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" class="likepost" alt="Like"><span style="color: #185aeb;">Support</span>
                                        <?php } else if($chk_user_reaction['reaction_id'] == 3) { ?>
                                            <img src="<?php echo base_url(); ?>assets_d/images/celebrate-dashboard.svg" class="likepost" alt="Like"> <span style="color: #185aeb;">Celebrate</span>
                                        <?php } else if($chk_user_reaction['reaction_id'] == 4) { ?>
                                            <img src="<?php echo base_url(); ?>assets_d/images/curious-dashboard.svg" class="likepost" alt="Like"><span style="color: #185aeb;">Insightful</span>
                                        <?php } else if($chk_user_reaction['reaction_id'] == 5) { ?>
                                            <img src="<?php echo base_url(); ?>assets_d/images/insight-dashboard.svg" class="likepost" alt="Like"><span style="color: #185aeb;">Curious</span>
                                        <?php } else if($chk_user_reaction['reaction_id'] == 6) { ?>
                                            <img src="<?php echo base_url(); ?>assets_d/images/love-dashboard.svg" class="likepost" alt="Like"> 
                                            <span style="color: #185aeb;">Love</span>
                                        <?php } ?>
                                            
                                    </a>
                                    <div class="hoverMenu">
                                        <ul>
                                            
                                            <li data-toggle="tooltip" title="Like" onclick="saveReaction('1', '<?php echo $value['reference_id']; ?>', 'document')" class="likeOption like_option_type"
                                                id="1"
                                                data-id="<?php echo $key; ?>">
                                                <img
                                                    src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg"
                                                    alt="like">
                                            </li>
                                            <li data-toggle="tooltip" onclick="saveReaction('2', '<?php echo $value['reference_id']; ?>', 'document')" title="Support" class="supportMenu like_option_type"
                                                id="2"
                                                data-id="<?php echo $key; ?>">
                                                <img
                                                    src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg"
                                                    alt="like">
                                            </li>
                                            <li data-toggle="tooltip" onclick="saveReaction('3', '<?php echo $value['reference_id']; ?>', 'document')" title="Celebrate" class="celebrateMenu like_option_type"
                                                id="3"
                                                data-id="<?php echo $key; ?>">
                                                <img
                                                    src="<?php echo base_url(); ?>assets_d/images/celebrate-dashboard.svg"
                                                    alt="like">
                                            </li>
                                            <li data-toggle="tooltip" onclick="saveReaction('4', '<?php echo $value['reference_id']; ?>', 'document')" title="Insightful" class="curiousMenu like_option_type"
                                                id="4"
                                                data-id="<?php echo $key; ?>">
                                                <img
                                                    src="<?php echo base_url(); ?>assets_d/images/curious-dashboard.svg"
                                                    alt="like">
                                            </li>
                                            <li data-toggle="tooltip" onclick="saveReaction('5', '<?php echo $value['reference_id']; ?>', 'document')" title="Curious" class="insightMenu like_option_type"
                                                id="5"
                                                data-id="<?php echo $key; ?>">
                                                <img
                                                    src="<?php echo base_url(); ?>assets_d/images/insight-dashboard.svg"
                                                    alt="like">
                                            </li>
                                            <li data-toggle="tooltip" onclick="saveReaction('6', '<?php echo $value['reference_id']; ?>', 'document')" title="Love" class="loveMenu like_option_type"
                                                id="6"
                                                data-id="<?php echo $key; ?>">
                                                <img
                                                    src="<?php echo base_url(); ?>assets_d/images/love-dashboard.svg"
                                                    alt="like">
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li onclick="showCommentBoxWrap('document', '<?php echo $value['reference_id']; ?>')">
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
                        <div class="commentBoxWrap" id="document_comment_<?php echo $value['reference_id']; ?>">
                                    <div class="comment-popularity">
                                        <div class="relevant">
                                            <div class="value">Most Relevant</div>
                                            <div class="caretIcon">
                                                <img src="<?php echo base_url(); ?>assets_d/images/down-arrow1.svg" alt="down arrow">
                                            </div>
                                        </div>
                                        <div class="commentmsg">
                                            <a onclick="hideCommentBoxWrap('document', '<?php echo $value['reference_id']; ?>')">Hide Comments</a>
                                        </div>
                                    </div>
                                    
                                    <div id="document_commentappend_<?php echo $value['reference_id']; ?>">
                                        <?php foreach ($get_comments as $key => $value) { 
                                            $comment_user = $this->db->get_where('user_info', array('userID' => $value['user_id']))->row_array();
                                            $count_like = $this->db->get_where('comment_like_master', array('comment_id' => $value['id'], 'status' => 1))->num_rows();

                                            if($count_like == 0){
                                                $css = 'display: none;';
                                            } else {
                                                $css = '';
                                            } 

                                            $if_user_liked = $this->db->get_where('comment_like_master', array('comment_id' => $value['id'], 'status' => 1, 'user_id' => $user_id))->num_rows();

                                            $comment_replies = $this->db->get_where('comment_master', array('comment_parent_id' => $value['id'], 'status' => 1))->result_array();
                                        ?>
                                            <div class="chatMsgBox">
                                        <figure>
                                            <img src="<?php echo userImage($value['user_id']); ?>" alt="User">
                                        </figure>
                                        <div class="right">
                                            <div class="userWrapText">
                                                <h4><?php echo $comment_user['nickname']; ?></h4>
                                                <?php if($value['type'] == 1) { ?>
                                                    <img src="<?php echo base_url(); ?>uploads/comments/<?= $value['comment']; ?>" alt="comment" style="height: 70px;">
                                                <?php } else { ?>
                                                    <p><?php echo $value['comment']; ?></p>
                                                <?php } ?>
                                                <div class="leftStatus">
                                                    <a id="reactcomment_<?php echo $value['id']; ?>" style="<?= $css; ?>">
                                                        <img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Like">
                                                        <span id="comment_like_count_<?php echo $value['id']; ?>"><?php echo $count_like; ?></span>
                                                    </a>
                                                    <a onclick="likeCommentByReference('<?php echo $value['id']; ?>')" id="like_text_<?php echo $value['id']; ?>"><?php if($if_user_liked == 1) { echo 'Liked'; } else { echo 'Like'; } ?></a>
                                                    <?php if(!empty($comment_replies)) { $reply_css= ""; } else { $reply_css= "display:none;"; } ?>
                                                    <a onclick="showReplyBox('<?php echo $value['id']; ?>')">Reply <span style="<?= $reply_css; ?>" id="comment_reply_count_<?php echo $value['id']; ?>">(<?php echo count($comment_replies); ?>)</span>  </a>
                                                    <div id="show_reply_box_<?php echo $value['id']; ?>" style="display: none;">
                                                        <div id="commentreply_box_<?php echo $value['id']; ?>">
                                                            <?php foreach ($comment_replies as $key2 => $value2) { 
                                                                $user_info = $this->db->get_where('user_info', array('userID' => $value2['user_id']))->row_array();
                                                                $count_like2 = $this->db->get_where('comment_like_master', array('comment_id' => $value2['id'], 'status' => 1))->num_rows();

                                                                if($count_like2 == 0){
                                                                    $css2 = 'display: none;';
                                                                } else {
                                                                    $css2 = '';
                                                                } 

                                                                $if_user_liked2 = $this->db->get_where('comment_like_master', array('comment_id' => $value2['id'], 'status' => 1, 'user_id' => $user_id))->num_rows();
                                                            ?>
                                                                <div class="innerReplyBox" >
                                                            <figure>
                                                                <img src="<?php echo userImage($value2['user_id']); ?>"
                                                                    alt="User">
                                                            </figure>
                                                            <div
                                                                class="right">
                                                                <div
                                                                    class="userWrapText">
                                                                    <h4><?php echo $user_info['nickname']; ?></h4>
                                                                    <p><?php echo $value2['comment']; ?></p>
                                                                    
                                                                    <div class="leftStatus">
                                                                        <a id="reactcomment_<?php echo $value2['id']; ?>" style="<?= $css2; ?>">
                                                                            <img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Like">
                                                                            <span id="comment_like_count_<?php echo $value2['id']; ?>"><?php echo $count_like2; ?></span>
                                                                        </a>
                                                                        <a onclick="likeCommentByReference('<?php echo $value2['id']; ?>')" id="like_text_<?php echo $value2['id']; ?>"><?php if($if_user_liked2 == 1) { echo 'Liked'; } else { echo 'Like'; } ?></a>
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
                                                            <?php } ?>
                                                            
                                                        </div>
                                                        <div class="commentWrapBox">
                                                            <figure>
                                                                <img src="<?php echo userImage($user_id); ?>" alt="User">
                                                            </figure>
                                                            <input type="text" name="" placeholder="Reply" id="comment_reply_<?php echo $value['id'] ?>" onkeypress="postCommentReply(event,'<?php echo $value['id'] ?>', this.value)">
                                                            
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
                                        <?php } ?>
                                    </div>
                                    <div class="chatMsgBox">
                                        <div class="commentWrapBox">
                                            <figure>
                                                <img src="<?php echo userImage($user_id);  ?>" alt="User">
                                            </figure>
                                            <input type="text" name="" placeholder="Comment" id="comment_input_document_<?php echo $value['reference_id']; ?>" data-id="document" class="commentReference" onkeypress="postCommentByReference(event, 'document', '<?php echo $value['reference_id']; ?>', this.value)">
                                            <div class="mediaAction">
                                                <button type="button">
                                                    <img src="<?php echo base_url(); ?>assets_d/images/image.svg" alt="Add Files">
                                                    <input type="file" id="comment_image_document_<?php echo $value['reference_id']; ?>" onchange="postImageComment('document', '<?php echo $value['reference_id']; ?>')">
                                                </button>
                                            </div>
                                        </div>  
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else if($value['reference'] == 'question') { 
            $question_detail = $this->db->get_where('question_master', array('id' => $value['reference_id']))->row_array();



            $this->db->select('question_answer_master.*, user_info.nickname');
            $this->db->join('user_info','user_info.userID=question_answer_master.answered_by');
            $this->db->order_by('question_answer_master.vote_count', 'desc');   
            $this->db->limit('2');
            $answer_list = $this->db->get_where($this->db->dbprefix('question_answer_master'), array('question_answer_master.question_id'=>$value['reference_id'], 'question_answer_master.status' => 1, 'question_answer_master.parent_id' => 0))->result_array(); 
             $user_id = $this->session->get_userdata()['user_data']['user_id'];
                         $chk_user_upvote = $this->db->get_where($this->db->dbprefix('vote_master'), array('reference'=> 'question', 'reference_id'=> $question_detail['id'], 'user_id' => $user_id))->row_array();
                            if(!empty($chk_user_upvote)){
                                if($chk_user_upvote['type'] == 1){
                                    $up_normal_q = 'display:none;';
                                    $up_active_q = 'display:block;';
                                    $down_normal_q = '';
                                    $down_active_q = '';
                                } else {
                                    $up_normal_q = '';
                                    $up_active_q = '';
                                    $down_normal_q = 'display:none;';
                                    $down_active_q = 'display:block;';
                                }
                            } else {
                                $up_normal_q = '';
                                $up_active_q = '';
                                $down_normal_q = '';
                                $down_active_q = '';
                            }
                        ?>

            <div class="box-card message">
                                        <div class="eventMessage">
                                            <img src="<?php echo base_url(); ?>assets_d/images/Q_A.svg" alt="Article"> Q&A
                                        </div>
                                        <div class="voteHeaderWrapper">
                            <div class="voteCount" style="position: absolute;left: -60px;top: 100px;">
                                <div class="uparrow" id="q_uparrow_<?= $question_detail['id']; ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg"  class="normalState" width="18.363" height="20" viewBox="0 0 18.363 20" onclick="voteQuestion('upvote', '<?php echo $question_detail['id']; ?>')" style="<?php echo $up_normal_q; ?>">
                                        <g id="prefix__up-arrow" transform="translate(-31.008 -10.925)">
                                            <path id="prefix__Path_1209" d="M37.272 29.256h5.6v-9.1a.83.83 0 0 1 .828-.833h2.828l-6.358-6.387-6.35 6.383h2.62a.83.83 0 0 1 .828.833v9.1zm6.428 1.669h-7.26a.83.83 0 0 1-.828-.833v-9.1H31.82a.844.844 0 0 1-.588-1.424l8.358-8.4a.845.845 0 0 1 1.171 0l8.354 8.4a.823.823 0 0 1-.588 1.424h-4v9.1a.825.825 0 0 1-.827.833z" data-name="Path 1209" />
                                        </g>
                                    </svg>                                      
                                    <svg xmlns="http://www.w3.org/2000/svg"  class="activeState" width="18.363" height="20" viewBox="0 0 18.363 20" style="<?php echo $up_active_q; ?>" onclick="removeVoteQuestion('upvote', '<?php echo $question_detail['id']; ?>')">
                                        <g id="prefix__Layer_1" transform="translate(-31.008 -10.925)">
                                            <g id="prefix__Group_1371" data-name="Group 1371" transform="translate(31.008 10.925)">
                                                <path id="prefix__Path_1213" d="M43.7 30.925h-7.26a.83.83 0 0 1-.828-.833v-9.1H31.82a.844.844 0 0 1-.588-1.424l8.358-8.4a.845.845 0 0 1 1.171 0l8.354 8.4a.823.823 0 0 1-.588 1.424h-4v9.1a.825.825 0 0 1-.828.833z" data-name="Path 1213" transform="translate(-31.008 -10.925)" style="fill:#1ae1bd"/>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <div class="countt" id="q_count_<?= $question_detail['id']; ?>">
                                    <?php if($question_detail['vote_count'] < 0) {
                                        echo "0";
                                    } else {
                                        echo $question_detail['vote_count'];
                                    } ?>
                                        
                                </div>
                                <div class="downarrow" id="q_downarrow_<?= $question_detail['id']; ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18.363" height="20" class="normalState" viewBox="0 0 18.363 20" onclick="voteQuestion('downvote', '<?php echo $question_detail['id']; ?>')" style="<?php echo $down_normal_q; ?>">
                                        <g id="prefix__up-arrow" transform="rotate(180 24.686 15.463)">
                                            <path id="prefix__Path_1209" d="M37.272 29.256h5.6v-9.1a.83.83 0 0 1 .828-.833h2.828l-6.358-6.387-6.35 6.383h2.62a.83.83 0 0 1 .828.833v9.1zm6.428 1.669h-7.26a.83.83 0 0 1-.828-.833v-9.1H31.82a.844.844 0 0 1-.588-1.424l8.358-8.4a.845.845 0 0 1 1.171 0l8.354 8.4a.823.823 0 0 1-.588 1.424h-4v9.1a.825.825 0 0 1-.827.833z" data-name="Path 1209" />
                                        </g>
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg"  class="activeState" width="18.363" height="20" viewBox="0 0 18.363 20" style="<?php echo $down_active_q; ?>" onclick="removeVoteQuestion('downvote', '<?php echo $question_detail['id']; ?>')">
                                        <g id="prefix__Layer_1" transform="rotate(180 24.686 15.463)">
                                            <g id="prefix__Group_1371" data-name="Group 1371" transform="translate(31.008 10.925)">
                                                <path id="prefix__Path_1213" d="M43.7 30.925h-7.26a.83.83 0 0 1-.828-.833v-9.1H31.82a.844.844 0 0 1-.588-1.424l8.358-8.4a.845.845 0 0 1 1.171 0l8.354 8.4a.823.823 0 0 1-.588 1.424h-4v9.1a.825.825 0 0 1-.828.833z" data-name="Path 1213" transform="translate(-31.008 -10.925)" />
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                                
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
                                                            <img src="<?php echo userImage($question_detail['created_by']); ?>" alt="user">
                                                        </figure>
                                                        <?php $user = $this->db->get_where('user', array('id' => $question_detail['created_by']))->row_array();
                    $user_info = $this->db->get_where('user_info', array('userID' => $question_detail['created_by']))->row_array();
                    $university = $this->db->get_where('university', array('university_id' => $user_info['intitutionID']))->row_array(); ?>
                                                        <div class="right">
                                                            <figcaption><a href="<?php echo base_url().'Profile/friends?profile_id='.$user['id'] ?>"><?php echo $user['first_name'].' '.$user['last_name']; ?></a> <span>has posted a question</span></figcaption>
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
                                                    <div class="timeline"><?php echo time_ago_in_php($question_detail['created_at']); ?></div>
                        </div>

                        <h4><?php echo $question_detail['question_title']; ?></h4>
                        <div class="row">
                            <p><?php echo $question_detail['textarea']; ?></p>
                        </div>
                        <div class="socialStatus">
                            <div class="leftStatus vote">
                                <!-- <a>
                                    <img src="<?php echo base_url(); ?>assets_d/images/up-arrow-dashboard.svg" alt="Up Arrow">
                                    <span>24</span>
                                </a>
                                <a>
                                    <img src="<?php echo base_url(); ?>assets_d/images/down-arrow-dashboard.svg" alt="Up Arrow">
                                    <span>02</span>
                                </a> -->
                            </div>
                            <div class="rightStatus">
                                <ul>
                                    <li>
                                        <a>
                                            <img src="<?php echo base_url(); ?>assets_d/images/views-grey.svg" alt="Views">
                                            <span><?php echo $question_detail['view_count']; ?> views</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <img src="<?php echo base_url(); ?>assets_d/images/answers-grey.svg" alt="Answer">
                                            <span><?php echo count($answer_list); ?></span>
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
                                <li class="helpful">

                                </li>
                                <li class="not-helpful">
                                    <!-- <a>
                                        <img src="<?php echo base_url(); ?>assets_d/images/down-arrow-grey.svg" class="not-helpful" alt="Down Arrow">
                                        <span>Not Helpful</span>
                                    </a> -->
                                </li>
                                <li>
                                    <a onclick="showQAnsBox('<?php echo $question_detail['id']; ?>')">
                                        <img src="<?php echo base_url(); ?>assets_d/images/answers-grey.svg" alt="Down Arrow">
                                        <span>Answer</span>
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
                        <div class="dashboard-qa-answer" id="dashboard-qa-answer-<?php echo $question_detail['id']; ?>" style="display: none;">
                            <div class="comment-title">
                                    <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M448 0H64C28.7 0 0 28.7 0 64v288c0 35.3 28.7 64 64 64h96v84c0 7.1 5.8 12 12 12 2.4 0 4.9-.7 7.1-2.4L304 416h144c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64zm16 352c0 8.8-7.2 16-16 16H288l-12.8 9.6L208 428v-60H64c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16h384c8.8 0 16 7.2 16 16v288zm-96-216H144c-8.8 0-16 7.2-16 16v16c0 8.8 7.2 16 16 16h224c8.8 0 16-7.2 16-16v-16c0-8.8-7.2-16-16-16zm-96 96H144c-8.8 0-16 7.2-16 16v16c0 8.8 7.2 16 16 16h128c8.8 0 16-7.2 16-16v-16c0-8.8-7.2-16-16-16z"></path></svg>
                                    Answer  
                            </div>
                            <div class="commentAnswer">
                                <form method="post" class="submitQuestionAnswer" id="<?= $question_detail['id']; ?>" action="<?php echo base_url(); ?>account/submitQuestionAnswer" onsubmit="return validateQuestionAnswer('<?= $question_detail['id']; ?>')">
                                    <div class="form-group comment">
                                        <input type="hidden" name="question_id" value="<?php echo $question_detail['id']; ?>">
                                        <textarea name="answer" id="definition_<?= $question_detail['id']; ?>" cols="30" rows="6"></textarea>
                                        <span class="custom_err" id="err_definition_<?= $question_detail['id']; ?>"></span>
                                    </div>
                                    <button type="submit" class="filterBtn"> 
                                        Submit
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="dashboard-qa" style="margin-top: 10px;" id="replyAnswerBox<?= $question_detail['id']; ?>">
                            <?php foreach ($answer_list as $key => $value) { 
                            $user_id = $this->session->get_userdata()['user_data']['user_id']; 
                            $this->db->select('question_answer_master.*, user_info.nickname');
                            $this->db->join('user_info','user_info.userID=question_answer_master.answered_by');
                            $get_reply = $this->db->get_where($this->db->dbprefix('question_answer_master'), array('question_answer_master.question_id'=>$question_detail['id'], 'question_answer_master.status' => 1, 'question_answer_master.parent_id' => $value['id']))->result_array(); 
                            $chk_user_upvote = $this->db->get_where($this->db->dbprefix('vote_master'), array('reference'=> 'answer', 'reference_id'=> $value['id'], 'user_id' => $user_id))->row_array();
                            if(!empty($chk_user_upvote)){
                                if($chk_user_upvote['type'] == 1){
                                    $up_normal_s = 'display:none;';
                                    $up_active_s = 'display:block;';
                                    $down_normal_s = '';
                                    $down_active_s = '';
                                } else {
                                    $up_normal_s = '';
                                    $up_active_s = '';
                                    $down_normal_s = 'display:none;';
                                    $down_active_s = 'display:block;';
                                }
                            } else {
                                $up_normal_s = '';
                                $up_active_s = '';
                                $down_normal_s = '';
                                $down_active_s = '';
                            }
                        ?>
                            <div class="replyAnswerBox" id="replyAnswerBox<?php echo $value['id']; ?>">     
                                <?php if($value['best_answer'] == 1) {      
                                    $display = "";
                                } else {
                                    $display = "display: none;";
                                } ?>            
                                    <div class="answerQuote" id="answerQuote<?php echo $value['id']; ?>" style="<?= $display; ?>">
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
                                        <div class="uparrow" id="uparrow_<?php echo $value['id']; ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg"  class="normalState" width="18.363" height="20" viewBox="0 0 18.363 20" onclick="voteAnswer('upvote', '<?php echo $value['id']; ?>')" style="<?= $up_normal_s; ?>">
                                                <g id="prefix__up-arrow" transform="translate(-31.008 -10.925)">
                                                    <path id="prefix__Path_1209" d="M37.272 29.256h5.6v-9.1a.83.83 0 0 1 .828-.833h2.828l-6.358-6.387-6.35 6.383h2.62a.83.83 0 0 1 .828.833v9.1zm6.428 1.669h-7.26a.83.83 0 0 1-.828-.833v-9.1H31.82a.844.844 0 0 1-.588-1.424l8.358-8.4a.845.845 0 0 1 1.171 0l8.354 8.4a.823.823 0 0 1-.588 1.424h-4v9.1a.825.825 0 0 1-.827.833z" data-name="Path 1209" />
                                                </g>
                                            </svg>                                      
                                            <svg xmlns="http://www.w3.org/2000/svg"  class="activeState" width="18.363" height="20" viewBox="0 0 18.363 20" style="<?= $up_active_s; ?>" onclick="removeVoteAnswer('upvote', '<?php echo $value['id']; ?>')">
                                                <g id="prefix__Layer_1" transform="translate(-31.008 -10.925)">
                                                    <g id="prefix__Group_1371" data-name="Group 1371" transform="translate(31.008 10.925)">
                                                        <path id="prefix__Path_1213" d="M43.7 30.925h-7.26a.83.83 0 0 1-.828-.833v-9.1H31.82a.844.844 0 0 1-.588-1.424l8.358-8.4a.845.845 0 0 1 1.171 0l8.354 8.4a.823.823 0 0 1-.588 1.424h-4v9.1a.825.825 0 0 1-.828.833z" data-name="Path 1213" transform="translate(-31.008 -10.925)" style="fill:#1ae1bd"/>
                                                    </g>
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="countt" id="count_<?php echo $value['id']; ?>">
                                            <?php if($value['vote_count'] < 0){
                                                echo "0";
                                            } else {
                                             echo $value['vote_count']; 
                                            }
                                            ?>
                                        </div>
                                        <div class="downarrow" id="downarrow_<?php echo $value['id']; ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18.363" height="20" class="normalState" viewBox="0 0 18.363 20" onclick="voteAnswer('downvote', '<?php echo $value['id']; ?>')" style="<?= $down_normal_s; ?>">
                                                <g id="prefix__up-arrow" transform="rotate(180 24.686 15.463)">
                                                    <path id="prefix__Path_1209" d="M37.272 29.256h5.6v-9.1a.83.83 0 0 1 .828-.833h2.828l-6.358-6.387-6.35 6.383h2.62a.83.83 0 0 1 .828.833v9.1zm6.428 1.669h-7.26a.83.83 0 0 1-.828-.833v-9.1H31.82a.844.844 0 0 1-.588-1.424l8.358-8.4a.845.845 0 0 1 1.171 0l8.354 8.4a.823.823 0 0 1-.588 1.424h-4v9.1a.825.825 0 0 1-.827.833z" data-name="Path 1209" />
                                                </g>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg"  class="activeState" width="18.363" height="20" viewBox="0 0 18.363 20" style="<?= $down_active_s; ?>" onclick="removeVoteAnswer('downvote', '<?php echo $value['id']; ?>')">
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
                                                <p><?php echo $value['answer']; ?></p>
                                            </div>
                                            <div class="feed_card_footer">
                                                <div class="userWrap study-sets">
                                                    <div class="user-name">
                                                        <figure>
                                                            <img src="<?php echo userImage($value['answered_by']); ?>" alt="user">
                                                        </figure>
                                                        <a href="<?php echo base_url().'Profile/friends?profile_id='.$value['id'] ?>"><figcaption><?php echo $value['nickname']; ?></figcaption></a>
                                                    </div>
                                                    <p class="date"><?php echo date('d/m/Y', strtotime($value['created_at'])); ?></p>
                                                </div>
                                                <div class="action">
                                                    <ul>
                                                        <li>
                                                            <a href="<?php echo base_url(); ?>account/questionDetail/<?php echo base64_encode($question_detail['id']); ?>" target="_blank">
                                                                <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M14.062 257.94L190.06 433.88c30.21 30.21 81.94 8.7 81.94-33.94v-78.28c146.59 8.54 158.53 50.199 134.18 127.879-13.65 43.56 35.07 78.89 72.19 54.46C537.98 464.768 576 403.8 576 330.05c0-170.37-166.04-197.15-304-201.3V48.047c0-42.72-51.79-64.09-81.94-33.94L14.062 190.06c-18.75 18.74-18.75 49.14 0 67.88zM48 224L224 48v128.03c143.181.63 304 11.778 304 154.02 0 66.96-40 109.95-76.02 133.65C501.44 305.911 388.521 273.88 224 272.09V400L48 224z"></path></svg>
                                                                Reply
                                                            </a>
                                                        </li>
                                                        <?php if($value['best_answer'] == 0) { 
                                                            $modalDisplay = "";
                                                        } else {
                                                            $modalDisplay = "display:none;";
                                                        } ?>    
                                                            <li id="bestAnswerModal<?= $value['id']; ?>" class="bestAnswerli" style="<?= $modalDisplay; ?>">
                                                                <a data-toggle="modal" data-target="#confirmationModalBestAnswer" data-id="<?= $value['id']; ?>" data-value="<?= $question_detail['id']; ?>" class="select_best_answer_dashboard">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14.625" viewBox="0 0 16 14.625">
                                                                        <path id="prefix__star" d="M7.432 21.6a.889.889 0 0 1 1.219-.287.864.864 0 0 1 .287.287L11 24.943a.878.878 0 0 0 .575.4l3.91.8a.884.884 0 0 1 .689 1.045.911.911 0 0 1-.222.431l-2.613 2.767a.884.884 0 0 0-.235.7l.4 3.737a.885.885 0 0 1-.787.974.9.9 0 0 1-.434-.062l-3.75-1.565a.876.876 0 0 0-.68 0L4.1 35.743a.883.883 0 0 1-1.219-.911l.4-3.737a.9.9 0 0 0-.235-.7l-2.615-2.77a.884.884 0 0 1 .036-1.251.869.869 0 0 1 .433-.223l3.91-.8a.89.89 0 0 0 .575-.4z" transform="translate(-.189 -21.185)" style="fill:#185aeb"/>
                                                                    </svg>
                                                                    Select best answer
                                                                </a>
                                                            </li>
                                                        
                                                        <li class="report">
                                                            <a href="#" class="transAction reportQuestionAnswerDashboard" data-toggle="modal" data-target="#reportModal" data-value="<?= $question_detail['id']; ?>" data-id="<?php echo $value['id']; ?>">                                                         
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
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } }
?>

<?php if($loadMore == 1) { ?>
    <?php if($ifTabs == 0) { ?>
        <div class="loadMoreWrapper loadmore" id="loadmore_<?= $nextOffset; ?>">
            <button type="button" onclick="loadMoreFeeds(<?= $nextOffset; ?>);"> Load More</button>
    <?php } else if($ifTabs == 1) { ?>
        <div class="loadMoreWrapper loadmore" id="loadmorepost_<?= $nextOffset; ?>">
            <button type="button" onclick="loadMorePosts(<?= $nextOffset; ?>);"> Load More</button>
    <?php } else if($ifTabs == 2) { ?>
        <div class="loadMoreWrapper loadmore" id="loadmorequestion_<?= $nextOffset; ?>">
            <button type="button" onclick="loadMoreQuestions(<?= $nextOffset; ?>);"> Load More</button>
    <?php } else if($ifTabs == 3) { ?>
        <div class="loadMoreWrapper loadmore" id="loadmoredocument_<?= $nextOffset; ?>">
            <button type="button" onclick="loadMoreDocuments(<?= $nextOffset; ?>);"> Load More</button>
    <?php } else if($ifTabs == 4) { ?>
        <div class="loadMoreWrapper loadmore" id="loadmorestudyset_<?= $nextOffset; ?>">
            <button type="button" onclick="loadMoreStudyset(<?= $nextOffset; ?>);"> Load More</button>
    <?php } else if($ifTabs == 5) { ?>
        <div class="loadMoreWrapper loadmore" id="loadmorevent_<?= $nextOffset; ?>">
            <button type="button" onclick="loadMoreEvent(<?= $nextOffset; ?>);"> Load More</button>
    <?php } ?>
        
    </div>
<?php } else { ?>
    <div class="loadMoreWrapper reached">
        <button type="button"> You've reached the end!</button>
    </div>
<?php } ?>