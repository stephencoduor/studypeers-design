<?php $user_id = $this->session->get_userdata()['user_data']['user_id']; ?>
<section class="mainContent noPadding">
					<div class="main_subheader">
						<div class="subheader_top">
							<div class="main_subheaderLeft">
								<a href="<?php echo base_url(); ?>account/documents">
									<svg class="sp-icon" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 490 490" style="enable-background:new 0 0 490 490;" xml:space="preserve">
										<path d="M245.9,436.3c14.8-16.4,13.9-41.5-2-56.8l-101.5-94.4l308.4-0.7c22.2-0.6,39.7-19,39.2-41.1c-0.5-21.4-17.7-38.6-39.1-39.1
											l-308.6,0.7l101.5-94.4c16.2-15.1,17.1-40.6,2-56.8c-15.1-16.2-40.6-17.1-56.8-2l-176.2,164C4.7,223.3,0.1,233.9,0,245
											c0,11.1,4.6,21.7,12.8,29.3L189,438.2c16.2,15.2,41.6,14.4,56.8-1.7c0.1-0.1,0.2-0.2,0.2-0.2H245.9z"></path>
									</svg>
									Back
								</a>
								<h4><?= $result['document_name'] ?></h4>
							</div>
							<div class="main_subheaderRight">
								<a class="document_dtl">
									<i class="fa fa-chevron-down"></i> Details
								</a>
								<a type="button" class="filterBtn download" href="<?php echo base_url(); ?>uploads/users/<?php echo $result['featured_image']; ?>" download> 
									<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
										<path d="M480.6,364.5c-11.3,0-20.4,9.1-20.4,20.4v75.2H51.8V385c0-11.3-9.1-20.4-20.4-20.4c-11.3,0-20.4,9.1-20.4,20.4v95.6    c0,11.3,9.1,20.4,20.4,20.4h449.2c11.3,0,20.4-9.1,20.4-20.4V385C501,373.7,491.9,364.5,480.6,364.5L480.6,364.5z"></path>
										<path d="m197.2,235v-183h109.7v182.2h67.6l-118.9,118.9-118.1-118.1h59.7zm46.4,164.1c6.7,6.7 17.4,6.7 24.1,0l176.8-176.8c10.7-10.7 3.1-29.1-12.1-29.1h-84.4v-165.2c0-9.4-7.6-17-17-17h-157.8c-9.4,0-17,7.6-17,17v166h-76.6c-15.2,0-22.8,18.4-12.1,29.1l176.1,176z"></path>
									</svg>
									Download
								</a>
							</div>
						</div>
						<div class="mainCardWrapper">
							<div class="subheader_doc_dtl">
								<div class="badgeList">
									<ul>
										<li class="badge badge1">
											<?php echo $result['SchoolName']; ?>
										</li>
										<li class="badge badge2">
											<?php echo $result['professor']; ?>
										</li>
										<li class="badge badge3">
											<?php echo $result['course']; ?>
										</li>
									</ul>
								</div>
								<p><?php echo $result['description']; ?></p>
								<div class="userWrap">
									<div class="user-name">
										<figure>
											<img src="<?php echo userImage($result['created_by']); ?>" alt="user">
										</figure>
										<?php  $user_name = $this->db->get_where('user', array('id' => $result['created_by']))->row_array(); ?>
										<a href="<?php echo base_url().'sp/'.$user_name['username'] ?>"><figcaption><?php echo $result['nickname']; ?></figcaption></a>
									</div>
								</div>
							</div>
						</div>
						<div class="documentDetail" style="text-align: center;">
							<?php 
								$userfile_name = $result['featured_image'];
								$extn = substr($userfile_name, strrpos($userfile_name, '.')+1); 
								if($extn == 'docx' || $extn == 'doc') { ?>
									
									<iframe src='https://view.officeapps.live.com/op/embed.aspx?src=<?php echo base_url(); ?>uploads/users/<?php echo $result['featured_image']; ?>' width='100%' height='830px' frameborder='0'> </iframe>
									
								<?php } else if($extn == 'pdf') {  ?>
									<!-- <embed src="<?php echo base_url(); ?>uploads/users/<?php echo $result['featured_image']; ?>" width="100%" height="830" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html"> -->
									<div id="example1" width="100%" height="830"></div>
								<?php } else if($extn == 'ppt' || $extn == 'pptx') { ?>
									<iframe src='https://view.officeapps.live.com/op/embed.aspx?src=<?php echo base_url(); ?>uploads/users/<?php echo $result['featured_image']; ?>' width='100%' height='830px' frameborder='0'> </iframe>
								<?php } else if($extn == 'xls' || $extn == 'xlsx') { ?>
									<iframe src='https://view.officeapps.live.com/op/embed.aspx?src=<?php echo base_url(); ?>uploads/users/<?php echo $result['featured_image']; ?>' width='100%' height='830px' frameborder='0'> </iframe>
									
								<?php } else {  ?>
									<img src="<?php echo base_url(); ?>uploads/users/<?php echo $result['featured_image']; ?>" alt="image" style="margin: 20px 0;">
									
								<?php }
							?>
							 
						</div>
						<div class="comment-title">
							<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M448 0H64C28.7 0 0 28.7 0 64v288c0 35.3 28.7 64 64 64h96v84c0 7.1 5.8 12 12 12 2.4 0 4.9-.7 7.1-2.4L304 416h144c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64zm16 352c0 8.8-7.2 16-16 16H288l-12.8 9.6L208 428v-60H64c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16h384c8.8 0 16 7.2 16 16v288zm-96-216H144c-8.8 0-16 7.2-16 16v16c0 8.8 7.2 16 16 16h224c8.8 0 16-7.2 16-16v-16c0-8.8-7.2-16-16-16zm-96 96H144c-8.8 0-16 7.2-16 16v16c0 8.8 7.2 16 16 16h128c8.8 0 16-7.2 16-16v-16c0-8.8-7.2-16-16-16z"></path></svg>
							Comments <span id="commentCount"><?php if(!empty($comment)) { ?>(<?php echo count($comment); ?>) <?php } ?></span>
						</div>
						<div class="chatCommentWrapper">
							<div class="listChatWrap">
								<div id="document_comment">
									<?php foreach ($comment as $key => $value) {
										$user_info = $this->db->get_where('user_info', array('userID' => $value['user_id']))->row_array();
										$reply = $this->db->get_where('comment_master', array('comment_parent_id' => $value['id']))->result_array();
										$count_like = $this->db->get_where('comment_like_master', array('comment_id' => $value['id'], 'status' => 1))->num_rows();
										$user_name = $this->db->get_where('user', array('id' => $value['user_id']))->row_array();
										$if_user_liked = $this->db->get_where('comment_like_master', array('comment_id' => $value['id'], 'status' => 1, 'user_id' => $user_id))->num_rows();
										?>
										<div class="chatMsg" id="comment_id_<?= $value['id']; ?>">
											<figure>
												<img src="<?php echo userImage($value['user_id']); ?>" alt="User">
											</figure>
											<figcaption>
												<a href="<?php echo base_url().'sp/'.$user_name['username'] ?>"><span class="name"> <?php echo $user_info['nickname'] ?></span></a>
												<?php if($value['type'] == 1) { ?>
													<img src="<?php echo base_url(); ?>uploads/comments/<?= $value['comment']; ?>" alt="comment" style="height: 70px;">
												<?php } else { echo $value['comment']; } ?>

												<div class="actionmsgMenu">
													<ul>
														<li class="likeuser" id="likeComment<?php echo $value['id'] ?>" onclick="likeComment('<?php echo $value['id'] ?>')"><?php if($if_user_liked == 1) { echo 'Liked'; } else { echo 'Like'; } ?></li>
														<li class="replyuser" onclick="showReplyBox('<?php echo $value['id'] ?>')">Reply</li>
													</ul>
												</div>
												<?php if($count_like == 0){
													$css = 'display: none;';
												} else {
													$css = '';
												} ?>
												<div class="reactmessage" id="reactmessage_<?php echo $value['id'] ?>" style="<?= $css; ?>">
													<div class="react">
														<img src="<?php echo base_url(); ?>assets_d/images/like.png" alt="Like">
													</div>
													<p id="like_count_<?php echo $value['id'] ?>"><?= $count_like; ?></p>
												</div>
											</figcaption>
											<div class="dotsBullet dropdown">
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
			                                            <?php if(($user_id == $result['created_by']) || $user_id == $value['user_id']) { ?>
			                                                <li role="presentation">
			                                                    <a role="menuitem"
			                                                       tabindex="-1"
			                                                       href="javascript:void(0);" onclick="deleteComment('<?= $value['id']; ?>', '<?php echo $result['id']; ?>', 'document')">
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

											<div class="reply" id="reply_<?php echo $value['id'] ?>">
												<?php foreach ($reply as $key2 => $value2) {
													$user_info2 = $this->db->get_where('user_info', array('userID' => $value2['user_id']))->row_array();
													$user_name2 = $this->db->get_where('user', array('id' => $value2['user_id']))->row_array();
													$if_user_liked2 = $this->db->get_where('comment_like_master', array('comment_id' => $value2['id'], 'status' => 1, 'user_id' => $user_id))->num_rows();
													$count_like2 = $this->db->get_where('comment_like_master', array('comment_id' => $value2['id'], 'status' => 1))->num_rows();
												?>
													<div class="userReplyBox" id="comment_reply_id_<?= $value2['id']; ?>">
														<figure>
															<img src="<?php echo userImage($value2['user_id']); ?>" alt="User">
														</figure>
														<figcaption>
															<a href="<?php echo base_url().'sp/'.$user_name2['username'] ?>"><span class="name"><?= $user_info2['nickname'] ?></span></a>
															<?php echo $value2['comment'] ?>
															<div class="actionmsgMenu">
																<ul>
																	<li class="likeuser" id="likeComment<?php echo $value2['id'] ?>" onclick="likeComment('<?php echo $value2['id'] ?>')"><?php if($if_user_liked2 == 1) { echo 'Liked'; } else { echo 'Like'; } ?></li>
																	
																</ul>
															</div>
															<?php if($count_like2 == 0){
																$css2 = 'display: none;';
															} else {
																$css2 = '';
															} ?>
															<div class="reactmessage" id="reactmessage_<?php echo $value2['id'] ?>" style="<?= $css2; ?>">
																<div class="react">
																	<img src="<?php echo base_url(); ?>assets_d/images/like.png" alt="Like">
																</div>
																<p id="like_count_<?php echo $value2['id'] ?>"><?= $count_like2; ?></p>
															</div>

														</figcaption>
														<div class="dotsBullet dropdown">
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
			                                                        <?php if(($user_id == $result['created_by']) || $user_id == $value2['user_id']) { ?>
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
												<?php } ?>
											</div>

											<div class="replyBox" id="replyBox<?php echo $value['id'] ?>">
												<figure>
													<img src="<?php echo userImage($user_id); ?>" alt="User">
												</figure>
												<div class="replyuser">
													<input type="text" id="input_reply_<?php echo $value['id'] ?>" placeholder="Write a Reply..." onkeypress="postReply(event,'<?php echo $value['id'] ?>', this.value)">
												</div>
											</div>
										</div>
									<?php } ?>
								</div>
								<div class="chatreplyBox">
									<input type="hidden" id="comment_document_id" value="<?= $result['id']; ?>">
									<input type="text" name="" placeholder="Comment.." id="input-emoji" data-emojiable="true"
										   data-emoji-input="unicode">
									<div class="mediaAction">
										<button type="button">
											<img src="<?php echo base_url(); ?>assets_d/images/camera.svg" alt="Add Files">
											<input type="file" id="imgComment">
										</button>
									</div>
								</div>
							</div>

						</div>
					</div>
				</section>



