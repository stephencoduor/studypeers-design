<link rel="stylesheet" href="<?php echo base_url(); ?>assets_d/css/profile.css">
<section class="mainContent">
    <div class="main-home-wrapper">
		<?php
			if(!empty($tabType)){
				$redirectLink = "window.location.href='".base_url('account/searchResult/'.$tabType)."'";
			} else {
				$redirectLink = "window.history.back();";
			}
		?>
		<a class="backBtn" href="javascript:;" onclick="<?php echo $redirectLink; ?>">
			<svg class="sp-icon" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 490 490" style="enable-background:new 0 0 490 490;" xml:space="preserve">
				<path d="M245.9,436.3c14.8-16.4,13.9-41.5-2-56.8l-101.5-94.4l308.4-0.7c22.2-0.6,39.7-19,39.2-41.1c-0.5-21.4-17.7-38.6-39.1-39.1l-308.6,0.7l101.5-94.4c16.2-15.1,17.1-40.6,2-56.8c-15.1-16.2-40.6-17.1-56.8-2l-176.2,164C4.7,223.3,0.1,233.9,0,245c0,11.1,4.6,21.7,12.8,29.3L189,438.2c16.2,15.2,41.6,14.4,56.8-1.7c0.1-0.1,0.2-0.2,0.2-0.2H245.9z"></path>
			</svg>
			Back 
		</a>
		<?php
		if($detailType == 'posts'){
		?>	
        <div class="post-section">
            <div class="content-card seprate-border">
                <div class="post-row-wrap">
                    <div class="user-top">
                        <div class="user-top-left">
                            <div class="user-img">
                                <figure>
                                    <img src="<?php echo $profile_picture; ?>" alt="Image"/>
                                </figure>
                            </div>
                            <div class="user-name-wrap">
                                <h3><?php echo $fullname; ?></h3>
                                <div class="badgeList">
                                    <ul>
                                        <li class="badge badge1">
                                            <a href=""><?php echo $UniversityName; ?></a>
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
                                <span class="timeline"><?php echo $posted_date; ?></span>
                                <!--a href=""><img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/></a-->
								&nbsp;&nbsp;&nbsp;
								<div class="dropdown">
									<i class="dropdown-toggle" data-toggle="dropdown">
										<img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/>
									</i>
									<ul class="dropdown-menu" style="right: 0;left: auto;top: 0px;">
										<li class="removePeerSugg">
											<a href="javascript:;" class="reportThings" data-reportType="POSTS" data-currentPage="searchViewAll" data-primaryId="<?php echo $post_id; ?>">Report</a>
										</li>
									</ul>
								</div>
                            </div>
                        </div>
                    </div>  
                    <div class="content-info-area">
                        <p><?php echo $post_content_html; ?></p>
						
						<?php
						if($post_image != ''){
						?>
							<div class="big-image">
								<img src="<?php echo $post_image; ?>" alt="Image"/>
							</div>
						<?php
						} else if($post_video != ''){
						?>
							<div class="big-image">
								<video width="320" height="240" controls>
									<source src="<?php echo $post_video; ?>" type="video/mp4">
								</video>
							</div>
						<?php	
						}
						?>
						
                    </div>
                    <div class="like-comment-wrap">
                        <div class="like-wrap">
                            <ul>
							<?php
								if(!empty($reactions_ids)){
									foreach($reactions_ids as $reactions_id){
										if($reactions_id == 1) {
								?>
								<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Like"></a></li>
								<?php			
										} else if($reactions_id == 2) {
								?>
								<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" alt="Icon"/></a></li>
								<?php			
										} else if($reactions_id == 3) {
								?>
								<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/celebrate-dashboard.svg" alt="Icon"></a></li>
								<?php			
										} else if($reactions_id == 4) {
								?>
								<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/curious-dashboard.svg" alt="Icon"></a></li>
								<?php			
										} else if($reactions_id == 5) {
								?>
								<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/insight-dashboard.svg" alt="Icon"></a></li>
								<?php			
										} else if($reactions_id == 6) {
								?>
								<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/love-dashboard.svg" alt="Icon"></a></li>
								<?php			
										}
									}
								}
								?>
								<li><a href="javascript:;"><?php echo $total_reactions; ?></a></li>
                            </ul>
                        </div>
                        <div class="comment-wrap">
                            <ul>
                                <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/comment-grey.svg" alt="Icon"/></a></li>
								<li><a href=""><?php echo $total_comments; ?></a></li>
                                <!--li><a href="">24</a></li-->
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="socialAction">
                    <ul>
                        <li class="likeMenu">
                            <a class="Post_likeMenu_<?php echo $reference_id; ?>" onclick="deleteReaction('Post', '<?php echo $reference_id; ?>')">
								<?php if(empty($getCurrentUserReaction)) { ?>
									<img src="<?php echo base_url(); ?>assets_d/images/like-grey.svg" class="likepost" alt="Like">
									<span>Like</span>
								<?php } else if($getCurrentUserReaction['reaction_id'] == 1) { ?>
									<img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" class="likepost" alt="Like"> 
									<span style="color: #185aeb;">Like</span>
								<?php } else if($getCurrentUserReaction['reaction_id'] == 2) { ?>
									<img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" class="likepost" alt="Like">
									<span style="color: #185aeb;">Support</span>
								<?php } else if($getCurrentUserReaction['reaction_id'] == 3) { ?>
									<img src="<?php echo base_url(); ?>assets_d/images/celebrate-dashboard.svg" class="likepost" alt="Like"> 
									<span style="color: #185aeb;">Celebrate</span>
								<?php } else if($getCurrentUserReaction['reaction_id'] == 4) { ?>
									<img src="<?php echo base_url(); ?>assets_d/images/curious-dashboard.svg" class="likepost" alt="Like">
									<span style="color: #185aeb;">Insightful</span>
								<?php } else if($getCurrentUserReaction['reaction_id'] == 5) { ?>
									<img src="<?php echo base_url(); ?>assets_d/images/insight-dashboard.svg" class="likepost" alt="Like">
									<span style="color: #185aeb;">Curious</span>
								<?php } else if($getCurrentUserReaction['reaction_id'] == 6) { ?>
									<img src="<?php echo base_url(); ?>assets_d/images/love-dashboard.svg" class="likepost" alt="Like"> 
									<span style="color: #185aeb;">Love</span>
								<?php } ?>
                            </a>
                            <div class="hoverMenu">
                                <ul>
                                    <li onclick="saveReaction('1','<?php echo $reference_id; ?>','Post')" class="likeOption like_option_type" id="1" data-id="<?php echo $post_id; ?>">
                                        <img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="like">
                                    </li>
                                    <li onclick="saveReaction('2','<?php echo $reference_id; ?>','Post')" title="Support" class="supportMenu like_option_type" id="2" data-id="<?php echo $post_id; ?>">
                                        <img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" alt="like">
                                    </li>																	
                                    <li onclick="saveReaction('3','<?php echo $reference_id; ?>','Post')" title="Celebrate" class="celebrateMenu like_option_type" id="3" data-id="<?php echo $post_id; ?>">
                                        <img src="<?php echo base_url(); ?>assets_d/images/celebrate-dashboard.svg" alt="like">
                                    </li>																
                                    <li onclick="saveReaction('4','<?php echo $reference_id; ?>','Post')" title="Insightful" class="curiousMenu like_option_type" id="4" data-id="<?php echo $post_id; ?>">
                                        <img src="<?php echo base_url(); ?>assets_d/images/curious-dashboard.svg" alt="like">
                                    </li>																
                                    <li onclick="saveReaction('5','<?php echo $reference_id; ?>','Post')" title="Curious" class="insightMenu like_option_type" id="5" data-id="<?php echo $post_id; ?>">
                                        <img src="<?php echo base_url(); ?>assets_d/images/insight-dashboard.svg" alt="like">
                                    </li>																
                                    <li onclick="saveReaction('6','<?php echo $reference_id; ?>','Post')" title="Love" class="loveMenu like_option_type" id="6" data-id="<?php echo $post_id; ?>">
                                        <img src="<?php echo base_url(); ?>assets_d/images/love-dashboard.svg" alt="like">
                                    </li>
                                </ul>
                            </div>
                        </li>
						
                        <li class="autoClick" <?php if (@$is_comment_on != 1) { ?>  class="tooltip" style="opacity: 0.7;cursor: not-allowed;" <?php } else { ?> onclick="showCommentBoxWrap('Post', '<?php echo $reference_id; ?>')" <?php } ?>>
                            <?php 
								if (@$is_comment_on != 1) { 
							?>
							<span class="tooltiptext">Comment is disabled</span>
							<?php 
								} 
							?>
							<a <?php if (@$is_comment_on != 1) { ?> style="cursor: not-allowed;" <?php } ?>>
								<img src="<?php echo base_url(); ?>assets_d/images/comment-grey.svg" alt="comment">
								<span>Comment</span>
							</a>
                        </li>
						
                        <!--li>
                            <a>
                                <img src="<?php echo base_url(); ?>assets_d/images/share-grey.svg" alt="comment">
                                <span>Share</span>
                            </a>
                        </li-->
                    </ul>
                </div>
                <div class="commentBoxWrap" id="Post_comment_<?php echo $reference_id; ?>">
					<div class="comment-popularity">
						<div class="relevant">
							<div class="value">Most Relevant</div>
							<div class="caretIcon">
								<img src="<?php echo base_url(); ?>assets_d/images/down-arrow1.svg" alt="down arrow">
							</div>
						</div>
						<div class="commentmsg">
							<a onclick="hideCommentBoxWrap('Post', '<?php echo $reference_id; ?>')">Hide Comments</a>
						</div>
					</div>
					
					<div id="Post_commentappend_<?php echo $reference_id; ?>">
					<?php 
						foreach ($getCommentList as $key => $value) { 
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
						<div class="chatMsgBox" id="comment_id_<?= $value['id']; ?>">
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
										
										<a onclick="showReplyBox('<?php echo $value['id']; ?>')">Reply <span style="<?= $reply_css; ?>" id="comment_reply_count_<?php echo $value['id']; ?>">(<?php echo count($comment_replies); ?>)</span> </a>
										
										<div id="show_reply_box_<?php echo $value['id']; ?>" style="display: none;">
											<div id="commentreply_box_<?php echo $value['id']; ?>">
											<?php 
												foreach ($comment_replies as $key2 => $value2) { 
													$user_info = $this->db->get_where('user_info', array('userID' => $value2['user_id']))->row_array();
													$count_like2 = $this->db->get_where('comment_like_master', array('comment_id' => $value2['id'], 'status' => 1))->num_rows();

													if($count_like2 == 0){
														$css2 = 'display: none;';
													} else {
														$css2 = '';
													} 

													$if_user_liked2 = $this->db->get_where('comment_like_master', array('comment_id' => $value2['id'], 'status' => 1, 'user_id' => $user_id))->num_rows();
												?>
												<div class="innerReplyBox" id="comment_reply_id_<?= $value2['id']; ?>">
													<figure>
														<img src="<?php echo userImage($value2['user_id']); ?>" alt="User">
                                                    </figure>
                                                    <div class="right">
                                                        <div class="userWrapText">
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
                                                        <div class="dotsBullet dropdown">
                                                            <img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="more" data-toggle="dropdown">
                                                            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                                                <li role="presentation">
                                                                    <a role="menuitem" tabindex="-1" href="javascript:void(0);">
                                                                        <div class="left">
                                                                            <img src="<?php echo base_url(); ?>assets_d/images/restricted.svg" alt="Save">
                                                                        </div>
                                                                        <div class="right"><span>Hide/block</span></div>
                                                                    </a>
                                                                </li>
                                                                <?php if(($user_id == $created_by) || $user_id == $value2['user_id']) { ?>
	                                                                <li role="presentation">
	                                                                    <a role="menuitem"
	                                                                       tabindex="-1"
	                                                                       href="javascript:void(0);" onclick="deleteCommentReply('<?= $value2['id']; ?>', '<?php echo $value['id']; ?>')">
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
	                                                            <?php } ?>
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
                                            <?php if(($user_id == $created_by) || $user_id == $value['user_id']) { ?>
											<li role="presentation">
												<a role="menuitem" tabindex="-1" href="javascript:void(0);" onclick="deleteComment('<?= $value['id']; ?>', '<?php echo $value['reference_id']; ?>', 'Post')">
													<div class="left">
														<img src="<?php echo base_url(); ?>assets_d/images/trash.svg" alt="Link">
													</div>
													<div class="right">
														<span>Delete</span>
													</div>
												</a> 
											</li>
	                                         <?php } ?>
                                        </ul>
                                    </div>
                                </div>
							</div>
						<?php } ?>
					</div>
					<div class="chatMsgBox">
						<div class="commentWrapBox">
							<figure> <img src="<?php echo userImage($user_id);  ?>" alt="User"> </figure>
							<input type="text" name="" placeholder="Comment" id="comment_input_Post_<?php echo $reference_id; ?>" data-id="Post" class="commentReference" onkeypress="postCommentByReference(event, 'Post', '<?php echo $reference_id; ?>', this.value)">
							<div class="mediaAction"> 
								<button type="button">
									<img src="<?php echo base_url(); ?>assets_d/images/image.svg" alt="Add Files">
									<input type="file" id="comment_image_Post_<?php echo $reference_id; ?>" onchange="postImageComment('Post', '<?php echo $reference_id; ?>')"> 
								</button>
							</div>
						</div>  
					</div>
				</div>
            </div>
        </div>
		<?php
		}
		?>
    </div>
</div>

<div class="modal fade" id="reportModal" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<div class="modal-body peers">
				<h4>Reason</h4>
				<form method="POST" action="<?php echo base_url('account/reportThings'); ?>">
					
					<input type="hidden" name="primary_id" id="primary_id">
					<input type="hidden" name="report_post_type" id="report_post_type">
					<input type="hidden" name="current_page" id="current_page">
				
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Reason for Report</label>
								<div class="reason">
									<select class="form-control" name="report_reason" id="report_reason" required>
										<option value="">Select Reason</option>
										<option value="Inappropriate Content">Inappropriate Content</option>
										<option value="Spam">Spam</option>
										<option value="Promotional">Promotional</option>
										<option value="Uncivil">Uncivil</option>
										<option value="Other">Other</option>
									</select>
									<span class="error" id="report_reason_err"></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Reason</label>
								<div class="reason droparea">
									<textarea id="report_description" name="report_description" required ></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<button type="submit" class="filterBtn">Submit</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php
	if(!empty($openComment)){
?>
<script>
	$("document").ready(function() {
		$(".autoClick").trigger('click');
	});
</script>
<?php		
	}
?>