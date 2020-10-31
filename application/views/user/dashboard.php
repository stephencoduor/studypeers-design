<?php $user_id = $this->session->get_userdata()['user_data']['user_id'];  ?>
				<section class="mainContent">
					<div class="main-home-wrapper">
						<div class="tabularLiist">
							<ul class="nav nav-tabs">
							    <li class="active"><a data-toggle="tab" href="#myfeed">My Feeds</a></li>
							    <li><a data-toggle="tab" href="#schoolfeed">School Feeds</a></li>
							</ul>
							<div class="tab-content">
								<div id="myfeed" class="tab-pane fade in active">
									<div class="box-card">
										<div class="createBox story">
											<div class="storyWrapper">
												<h5>Stories</h5>
												<div class="slider storyRoom">
													<div class="userStoryList createStory">
														<div class="user-wrapper">
															<figure>
																<img src="<?php echo base_url(); ?>assets_d/images/add-story.svg" alt="Add Story">
															</figure>
															<div class="userstory-img">
																<img src="<?php echo base_url(); ?>assets_d/images/ct_user.jpg" alt="Create story User">
															</div>
														</div>
														<h3>Your Story</h3>
													</div>
													<div class="userStoryList storySnaps">
														<div class="user-wrapper">
															<figure>
																<img src="<?php echo base_url(); ?>assets_d/images/detail1.jpg" alt="User Story">
															</figure>
															<div class="userstory-img">
																<img src="<?php echo base_url(); ?>assets_d/images/ct_user.jpg" alt="story Image">
															</div>
														</div>
														<h3>Loreum Ipsum</h3>
													</div>
													<div class="userStoryList storySnaps">
														<div class="user-wrapper">
															<figure>
																<img src="<?php echo base_url(); ?>assets_d/images/detail1.jpg" alt="User Story">
															</figure>
															<div class="userstory-img">
																<img src="<?php echo base_url(); ?>assets_d/images/ct_user.jpg" alt="story Image">
															</div>
														</div>
														<h3>Loreum Ipsum</h3>
													</div>
													<div class="userStoryList storySnaps">
														<div class="user-wrapper">
															<figure>
																<img src="<?php echo base_url(); ?>assets_d/images/detail1.jpg" alt="User Story">
															</figure>
															<div class="userstory-img">
																<img src="<?php echo base_url(); ?>assets_d/images/ct_user.jpg" alt="story Image">
															</div>
														</div>
														<h3>Loreum Ipsum</h3>
													</div>
													<div class="userStoryList storySnaps">
														<div class="user-wrapper">
															<figure>
																<img src="<?php echo base_url(); ?>assets_d/images/detail1.jpg" alt="User Story">
															</figure>
															<div class="userstory-img">
																<img src="<?php echo base_url(); ?>assets_d/images/ct_user.jpg" alt="story Image">
															</div>
														</div>
														<h3>Loreum Ipsum</h3>
													</div>
													<div class="userStoryList storySnaps">
														<div class="user-wrapper">
															<figure>
																<img src="<?php echo base_url(); ?>assets_d/images/detail1.jpg" alt="User Story">
															</figure>
															<div class="userstory-img">
																<img src="<?php echo base_url(); ?>assets_d/images/ct_user.jpg" alt="story Image">
															</div>
														</div>
														<h3>Loreum Ipsum</h3>
													</div>
													<div class="userStoryList storySnaps">
														<div class="user-wrapper">
															<figure>
																<img src="<?php echo base_url(); ?>assets_d/images/detail1.jpg" alt="User Story">
															</figure>
															<div class="userstory-img">
																<img src="<?php echo base_url(); ?>assets_d/images/ct_user.jpg" alt="story Image">
															</div>
														</div>
														<h3>Loreum Ipsum</h3>
													</div>
													<div class="userStoryList storySnaps">
														<div class="user-wrapper">
															<figure>
																<img src="<?php echo base_url(); ?>assets_d/images/detail1.jpg" alt="User Story">
															</figure>
															<div class="userstory-img">
																<img src="<?php echo base_url(); ?>assets_d/images/ct_user.jpg" alt="story Image">
															</div>
														</div>
														<h3>Loreum Ipsum</h3>
													</div>
													<div class="userStoryList storySnaps">
														<div class="user-wrapper">
															<figure>
																<img src="<?php echo base_url(); ?>assets_d/images/detail1.jpg" alt="User Story">
															</figure>
															<div class="userstory-img">
																<img src="<?php echo base_url(); ?>assets_d/images/ct_user.jpg" alt="story Image">
															</div>
														</div>
														<h3>Loreum Ipsum</h3>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="box-card">
										<div class="createBox">
											<div class="postWrapper">
												<h5>New Post</h5>
												<div class="post-notification">
													<img src="<?php echo base_url(); ?>assets_d/images/alert.svg" alt="Ring">
												</div>
												<div class="writePostWrapper">
													<figure>
														<img src="<?php echo base_url(); ?>assets_d/images/detail1.jpg" alt="Post User Image">
													</figure>
													<div class="postMessageWrapper"  data-toggle="modal" data-target="#createPost">
														<div class="defaultMessage">What's on your mind ?</div>
													</div>
												</div>
												<div class="addOnPostMessage">
													<div class="imageSection">
														<img src="<?php echo base_url(); ?>assets_d/images/image.svg" alt="image/video">
														<span>Image/Video</span>
													</div>
													<div class="pollSection">
														<img src="<?php echo base_url(); ?>assets_d/images/poll.svg" alt="image/video">
														<span>Poll</span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<?php if(!empty($peer_suggestion)) { ?>
										<div class="box-card" id="peer_suggestion_box">
											<div class="createBox">
												<div class="suggestionWrapper">
													<h5>Peer Suggestions</h5>
													<div class="slider peerSuggestionList">
														<?php foreach ($peer_suggestion as $key => $value) { 
															$user_id = $this->session->get_userdata()['user_data']['user_id']; 
															$chk_if_sent = $this->db->get_where('peer_master', array('peer_id' => $value['id'], 'user_id' => $user_id, 'status' => 1))->row_array();
														?>
															<div class="peerList" id="peerList<?= $value['id']; ?>">
																<a href="<?php echo base_url().'Profile/friends?profile_id='.$value['id'] ?>">

																<figure>
																	<img src="<?php echo userImage($value['id']); ?>" alt="Peers">
																	<div class="removePeer">
																		<img src="<?php echo base_url(); ?>assets_d/images/close-peer.svg" alt="Close Peer Suggestions">
																	</div>
																</figure>
																<h4><?php echo $value['nickname']; ?></h4>
																</a>

																<p>0 mutual peers</p>
																<button type="button" class="follow_peer">Follow</button>
																<?php if(!empty($chk_if_sent)) { ?>
																	<button type="button" class="add_peer" onclick="cancelRequest('<?= $value['id']; ?>')" id="add_peer_<?= $value['id']; ?>">Cancel Request</button>
																<?php } else { ?>
																	<button type="button" class="add_peer" onclick="sendRequest('<?= $value['id']; ?>')" id="add_peer_<?= $value['id']; ?>">Add Peer</button>
																<?php } ?>

																</div>

														<?php } ?>
														
														
													</div>
												</div>
											</div>
										</div>
									<?php } ?>
									<div id="dashboard-feeds">
										<div class="box-card message">
											<div class="createBox">
												<p class="text-center" style="padding-bottom: 20px;">Loading Feeds..</p>
											</div>
										</div>
									</div>
									<!-- Alert Notification -->
									<!-- <div class="box-card message">
										<div class="alertMessage">
											<img src="<?php echo base_url(); ?>assets_d/images/alert.svg" alt="Ring">
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
															<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
														</figure>
														<div class="right">
															<figcaption>Loreum Ipsum</figcaption>
															<div class="badgeList">
																<ul>
																	<li class="badge badge1">
																		<a href="">
																			<img src="<?php echo base_url(); ?>assets_d/images/institution.svg" alt="InStitute"> University name
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
													<div class="timeline">10 mins ago</div>
												</div>
												<p class="feedPostMessages">
													Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
												</p>
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
									</div> -->
									<!-- End -->
									<!-- <div class="box-card">
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
															<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
														</figure>
														<div class="right">
															<figcaption>Loreum Ipsum</figcaption>
															<div class="badgeList">
																<ul>
																	<li class="badge badge1">
																		<a href="">
																			<img src="<?php echo base_url(); ?>assets_d/images/institution.svg" alt="InStitute"> University name
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
													<div class="timeline">10 mins ago</div>
												</div>
												<div class="imgWrapper type1">
													<figure>
														<img src="<?php echo base_url(); ?>assets_d/images/detail1.jpg" alt="Post Image">
													</figure>
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
									<div class="box-card">
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
															<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
														</figure>
														<div class="right">
															<figcaption>Loreum Ipsum</figcaption>
															<div class="badgeList">
																<ul>
																	<li class="badge badge1">
																		<a href="">
																			<img src="<?php echo base_url(); ?>assets_d/images/institution.svg" alt="InStitute"> University name
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
													<div class="timeline">10 mins ago</div>
												</div>
												<p class="feedPostMessages">
													Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
													<a class="more">More</a>
												</p>
												<p class="fullMessage">
													when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
													<a class="less">Less</a>
												</p>
												<div class="imgWrapper type1">
													<figure>
														<img src="<?php echo base_url(); ?>assets_d/images/detail1.jpg" alt="Post Image">
													</figure>
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
									<div class="box-card">
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
															<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
														</figure>
														<div class="right">
															<figcaption>Loreum Ipsum</figcaption>
															<div class="badgeList">
																<ul>
																	<li class="badge badge1">
																		<a href="">
																			<img src="<?php echo base_url(); ?>assets_d/images/institution.svg" alt="InStitute"> University name
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
													<div class="timeline">10 mins ago</div>
												</div>
												<div class="imgWrapper type2">
													<figure>
														<img src="<?php echo base_url(); ?>assets_d/images/detail1.jpg" alt="Post Image">
													</figure>
													<figure>
														<img src="<?php echo base_url(); ?>assets_d/images/detail1.jpg" alt="Post Image">
													</figure>
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
									<div class="box-card">
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
															<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
														</figure>
														<div class="right">
															<figcaption>Loreum Ipsum</figcaption>
															<div class="badgeList">
																<ul>
																	<li class="badge badge1">
																		<a href="">
																			<img src="<?php echo base_url(); ?>assets_d/images/institution.svg" alt="InStitute"> University name
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
													<div class="timeline">10 mins ago</div>
												</div>
												<p class="feedPostMessages">
													Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
												</p>
												<div class="imgWrapper type2">
													<figure>
														<img src="<?php echo base_url(); ?>assets_d/images/detail1.jpg" alt="Post Image">
													</figure>
													<figure>
														<img src="<?php echo base_url(); ?>assets_d/images/detail1.jpg" alt="Post Image">
													</figure>
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
									<div class="box-card">
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
															<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
														</figure>
														<div class="right">
															<figcaption>Loreum Ipsum</figcaption>
															<div class="badgeList">
																<ul>
																	<li class="badge badge1">
																		<a href="">
																			<img src="<?php echo base_url(); ?>assets_d/images/institution.svg" alt="InStitute"> University name
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
													<div class="timeline">10 mins ago</div>
												</div>
												<div class="imgWrapper type3">
													<figure>
														<img src="<?php echo base_url(); ?>assets_d/images/detail1.jpg" alt="Post Image">
													</figure>
													<figure>
														<img src="<?php echo base_url(); ?>assets_d/images/detail1.jpg" alt="Post Image">
													</figure>
													<figure>
														<img src="<?php echo base_url(); ?>assets_d/images/detail1.jpg" alt="Post Image">
													</figure>
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
									<div class="box-card">
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
															<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
														</figure>
														<div class="right">
															<figcaption>Loreum Ipsum</figcaption>
															<div class="badgeList">
																<ul>
																	<li class="badge badge1">
																		<a href="">
																			<img src="<?php echo base_url(); ?>assets_d/images/institution.svg" alt="InStitute"> University name
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
													<div class="timeline">10 mins ago</div>
												</div>
												<div class="imgWrapper type4">
													<figure>
														<img src="<?php echo base_url(); ?>assets_d/images/detail1.jpg" alt="Post Image">
													</figure>
													<figure>
														<img src="<?php echo base_url(); ?>assets_d/images/detail1.jpg" alt="Post Image">
													</figure>
													<figure>
														<img src="<?php echo base_url(); ?>assets_d/images/detail1.jpg" alt="Post Image">
													</figure>
													<figure>
														<img src="<?php echo base_url(); ?>assets_d/images/detail1.jpg" alt="Post Image">
													</figure>
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
									<div class="box-card">
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
															<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
														</figure>
														<div class="right">
															<figcaption>Loreum Ipsum</figcaption>
															<div class="badgeList">
																<ul>
																	<li class="badge badge1">
																		<a href="">
																			<img src="<?php echo base_url(); ?>assets_d/images/institution.svg" alt="InStitute"> University name
																		</a>
																	</li>
																	<li class="badge badge4">
																		<a href="">
																			Student
																		</a>
																	</li>
																</ul>
															</div>
														</div>												
													</div>
													<div class="timeline">10 mins ago</div>
												</div>
												<div class="imgWrapper type1">
													<div class="overlay-button">
														<img src="<?php echo base_url(); ?>assets_d/images/play_72dp.png" class="video-click">
													</div>
													<video id="myVideo" width="320" height="240" poster="<?php echo base_url(); ?>assets_d/images/w3schoolscomlogo.png">
													  <source src="<?php echo base_url(); ?>assets_d/images/movie.mp4" type="video/mp4">
													  <source src="<?php echo base_url(); ?>assets_d/images/movie.ogg" type="video/ogg">
													  Your browser does not support the video tag.
													</video>
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
									<div class="box-card">
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
															<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
														</figure>
														<div class="right">
															<figcaption>Loreum Ipsum <span>posted in course</span> <img src="<?php echo base_url(); ?>assets_d/images/course-name.svg"> course name</figcaption>
															<div class="badgeList">
																<ul>
																	<li class="badge badge1">
																		<a href="">
																			<img src="<?php echo base_url(); ?>assets_d/images/institution.svg" alt="InStitute"> University name
																		</a>
																	</li>
																	<li class="badge badge2">
																		<a href="">
																			Staff
																		</a>
																	</li>
																</ul>
															</div>
														</div>												
													</div>
													<div class="timeline">10 mins ago</div>
												</div>
												<p class="feedPostMessages">
													Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
												</p>
												<div class="imgWrapper type1">
													<div class="overlay-button">
														<img src="<?php echo base_url(); ?>assets_d/images/play_72dp.png" class="video-click">
													</div>
													<video id="myVideo" width="320" height="240" poster="<?php echo base_url(); ?>assets_d/images/w3schoolscomlogo.png">
													  <source src="<?php echo base_url(); ?>assets_d/images/movie.mp4" type="video/mp4">
													  <source src="<?php echo base_url(); ?>assets_d/images/movie.ogg" type="video/ogg">
													  Your browser does not support the video tag.
													</video>
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
									<div class="box-card">
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
															<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
														</figure>
														<div class="right">
															<figcaption>Loreum Ipsum <span>posted in group</span> <img src="<?php echo base_url(); ?>assets_d/images/group.svg"> Group name</figcaption>
															<div class="badgeList">
																<ul>
																	<li class="badge badge1">
																		<a href="">
																			<img src="<?php echo base_url(); ?>assets_d/images/institution.svg" alt="InStitute"> University name
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
													<div class="timeline">10 mins ago</div>
												</div>
												<div class="imgWrapper type1">
													<div class="overlay-button">
														<img src="<?php echo base_url(); ?>assets_d/images/play_72dp.png" class="video-click">
													</div>
													<video id="myVideo" width="320" height="240" poster="<?php echo base_url(); ?>assets_d/images/w3schoolscomlogo.png">
													  <source src="<?php echo base_url(); ?>assets_d/images/movie.mp4" type="video/mp4">
													  <source src="<?php echo base_url(); ?>assets_d/images/movie.ogg" type="video/ogg">
													  Your browser does not support the video tag.
													</video>
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
									</div> -->
									<!-- Event -->
									<?php foreach ($events as $key => $value) { ?>
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
																<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
															</figure>
															<div class="right">
																<?php $user = $this->db->get_where('user', array('id' => $value['created_by']))->row_array();
																$user_info = $this->db->get_where('user_info', array('userID' => $value['created_by']))->row_array();
																$university = $this->db->get_where('university', array('university_id' => $user_info['intitutionID']))->row_array();
																 if($value['created_by'] == $user_id) { ?>
																	<figcaption>You 
																<?php } else { 
																	
																?>
																	<figcaption><?php echo $user['first_name'].' '.$user['last_name']; ?> 
																<?php } ?>
																<span>posted in university</span> <img src="<?php echo base_url(); ?>assets_d/images/university.svg"> <?php echo $university['SchoolName']; ?></figcaption>
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
														<div class="timeline">10 mins ago</div>
													</div>
													<h4><?php echo $value['event_name'] ?></h4>
													<div class="event-description">
														<div class="left">
															<img src="<?php echo base_url(); ?>assets_d/images/location.svg" alt="Location"> <?php echo $value['location_txt'] ?>
														</div>
														<div class="right">
															<figure>
																<img src="<?php echo base_url(); ?>assets_d/images/calendar1.svg" alt="Event Time">
															</figure>
															<figcaption><?php echo date('d M, Y', strtotime($value['start_date'])); ?></figcaption>
															<a>Add to Calendar</a>
														</div>
													</div>
													<p class="feedPostMessages">
														<?php echo $value['description']; ?> 
													</p>
													<?php if($value['featured_image'] != '') { ?>
														<div class="imgWrapper type1">
															<figure>
																<img src="<?php echo base_url(); ?>uploads/users/<?php echo $value['featured_image']; ?>" alt="Post Image">
															</figure>
														</div>
													<?php } ?>
													<div class="eventActionWrap">
														<ul>
															<li>
																<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
															</li>
															<li>
																<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
															</li>
															<li>
																<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
															</li>
															<li>
																<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
															</li>
															<li>
																<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
															</li>
															<li class="more">
																+5
															</li>
														</ul>
														<button type="button" class="event_action"> Attend Event</button>
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
									<?php } ?>
									
									<!-- Study Set -->
									<?php foreach ($studysets as $key => $value) { ?>
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
															<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
														</figure>
														<?php $user = $this->db->get_where('user', array('id' => $value['user_id']))->row_array();
															$user_info = $this->db->get_where('user_info', array('userID' => $value['user_id']))->row_array();
															$university = $this->db->get_where('university', array('university_id' => $user_info['intitutionID']))->row_array(); ?>
														<div class="right">
															<figcaption><?php echo $user['first_name'].' '.$user['last_name']; ?> </figcaption>
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
													<div class="timeline">10 mins ago</div>
												</div>
												<h4><?php echo $value['name']; ?></h4>
												
												<div class="imgWrapper type1">
													<figure>
														<?php if($value['image']) { ?>
															<img src="<?php echo base_url();?>uploads/studyset/<?php echo $value['image'];?>" alt="Post Image">
														<?php } else { ?>
															<img src="<?php echo base_url();?>assets_d/images/detail1.jpg" alt="Post Image">
														<?php } ?>
													</figure>
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
																	<div class="my-rating-4" data-rating="1.5">
																	</div>																		
																	<span>1200</span>
																</a>
															</li>
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
									<?php } ?>
									<!-- <div class="box-card message">
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
															<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
														</figure>
														<div class="right">
															<figcaption>Loreum Ipsum </figcaption>
															<div class="badgeList">
																<ul>
																	<li class="badge badge1">
																		<a href="">
																			<img src="<?php echo base_url(); ?>assets_d/images/institution.svg" alt="InStitute"> University name
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
													<div class="timeline">10 mins ago</div>
												</div>
												<h4>Lorem Ipsum is simply dummy text of the printing and</h4>
												<div class="imgWrapper type1">
													<figure>
														<img src="<?php echo base_url(); ?>assets_d/images/detail1.jpg" alt="Post Image">
													</figure>
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
																	<div class="my-rating-4" data-rating="1.5">
																	</div>																		
																	<span>1200</span>
																</a>
															</li>
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
															<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
														</figure>
														<div class="right">
															<figcaption>Loreum Ipsum </figcaption>
															<div class="badgeList">
																<ul>
																	<li class="badge badge1">
																		<a href="">
																			<img src="<?php echo base_url(); ?>assets_d/images/institution.svg" alt="InStitute"> University name
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
													<div class="timeline">10 mins ago</div>
												</div>
												<h4>Lorem Ipsum is simply dummy text of the printing and</h4>
												<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
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
																	<div class="my-rating-4" data-rating="1.5">
																	</div>																		
																	<span>1200</span>
																</a>
															</li>
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
									</div> -->
									<!-- Textbook -->
									<!-- <div class="box-card message">
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
															<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
														</figure>
														<div class="right">
															<figcaption>Loreum Ipsum </figcaption>
															<div class="badgeList">
																<ul>
																	<li class="badge badge1">
																		<a href="">
																			<img src="<?php echo base_url(); ?>assets_d/images/institution.svg" alt="InStitute"> University name
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
													<div class="timeline">10 mins ago</div>
												</div>
												<h4>Lorem Ipsum is simply dummy text of the printing and</h4>
												<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
												<div class="documentName">
													<img src="<?php echo base_url(); ?>assets_d/images/pdf.svg" alt="pdf"> document name.ext
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
																	<div class="my-rating-4" data-rating="1.5">
																	</div>																		
																	<span>1200</span>
																</a>
															</li>
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
									<div class="box-card message">
										<div class="eventMessage">
											<img src="<?php echo base_url(); ?>assets_d/images/Textbook.svg" alt="Textbook"> Textbook
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
															<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
														</figure>
														<div class="right">
															<figcaption>Loreum Ipsum </figcaption>
															<div class="badgeList">
																<ul>
																	<li class="badge badge1">
																		<a href="">
																			<img src="<?php echo base_url(); ?>assets_d/images/institution.svg" alt="InStitute"> University name
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
													<div class="timeline">10 mins ago</div>
												</div>
												<h4>Lorem Ipsum is simply dummy text of the printing and</h4>
												<p class="feedPostMessages">
													Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
												</p>
												<div class="imgWrapper type1">
													<figure>
														<img src="<?php echo base_url(); ?>assets_d/images/detail1.jpg" alt="Post Image">
													</figure>
												</div>
												<div class="eventActionWrap author">
													<p>Author name</p>
													<div>Edition</div>
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
									<div class="box-card message">
										<div class="eventMessage">
											<img src="<?php echo base_url(); ?>assets_d/images/Textbook.svg" alt="Textbook"> Textbook
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
															<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
														</figure>
														<div class="right">
															<figcaption>Loreum Ipsum </figcaption>
															<div class="badgeList">
																<ul>
																	<li class="badge badge1">
																		<a href="">
																			<img src="<?php echo base_url(); ?>assets_d/images/institution.svg" alt="InStitute"> University name
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
													<div class="timeline">10 mins ago</div>
												</div>
												<h4>Lorem Ipsum is simply dummy text of the printing and</h4>
												<p class="feedPostMessages">
													Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
												</p>
												<div class="eventActionWrap author">
													<p>Author name</p>
													<div>Edition</div>
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
									</div> -->
									<!-- Article -->
									<!-- <div class="box-card message">
										<div class="eventMessage">
											<img src="<?php echo base_url(); ?>assets_d/images/Article.svg" alt="Article"> Article
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
															<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
														</figure>
														<div class="right">
															<figcaption>Loreum Ipsum </figcaption>
															<div class="badgeList">
																<ul>
																	<li class="badge badge1">
																		<a href="">
																			<img src="<?php echo base_url(); ?>assets_d/images/institution.svg" alt="InStitute"> University name
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
													<div class="timeline">10 mins ago</div>
												</div>
												<h4>Lorem Ipsum is simply dummy text of the printing and</h4>
												<p class="feedPostMessages">
													Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
												</p>
												<div class="imgWrapper type1">
													<figure>
														<img src="<?php echo base_url(); ?>assets_d/images/detail1.jpg" alt="Post Image">
													</figure>
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
									<div class="box-card message">
										<div class="eventMessage">
											<img src="<?php echo base_url(); ?>assets_d/images/Article.svg" alt="Article"> Article
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
															<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
														</figure>
														<div class="right">
															<figcaption>Loreum Ipsum </figcaption>
															<div class="badgeList">
																<ul>
																	<li class="badge badge1">
																		<a href="">
																			<img src="<?php echo base_url(); ?>assets_d/images/institution.svg" alt="InStitute"> University name
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
													<div class="timeline">10 mins ago</div>
												</div>
												<h4>Lorem Ipsum is simply dummy text of the printing and</h4></h4>
												<p class="feedPostMessages">
													Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
												</p>
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
									<div class="box-card message">
										<div class="eventMessage">
											<img src="<?php echo base_url(); ?>assets_d/images/Q_A.svg" alt="Q&A"> Q&A
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
															<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
														</figure>
														<div class="right">
															<figcaption>Loreum Ipsum </figcaption>
															<div class="badgeList">
																<ul>
																	<li class="badge badge1">
																		<a href="">
																			<img src="<?php echo base_url(); ?>assets_d/images/institution.svg" alt="InStitute"> University name
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
													<div class="timeline">10 mins ago</div>
												</div>
												<h4>Lorem Ipsum is simply dummy text of the printing and</h4>
												<div class="imgWrapper type1">
													<figure>
														<img src="<?php echo base_url(); ?>assets_d/images/detail1.jpg" alt="Post Image">
													</figure>
												</div>
												<div class="socialStatus">
													<div class="leftStatus vote">
														<a>
															<img src="<?php echo base_url(); ?>assets_d/images/up-arrow-dashboard.svg" alt="Up Arrow">
															<span>24</span>
														</a>
														<a>
															<img src="<?php echo base_url(); ?>assets_d/images/down-arrow-dashboard.svg" alt="Up Arrow">
															<span>02</span>
														</a>
													</div>
													<div class="rightStatus">
														<ul>
															<li>
																<a>
																	<img src="<?php echo base_url(); ?>assets_d/images/views-grey.svg" alt="Views">
																	<span>12 views</span>
																</a>
															</li>
															<li>
																<a>
																	<img src="<?php echo base_url(); ?>assets_d/images/answers-grey.svg" alt="Answer">
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
														<li class="helpful">
															<a>
																<img src="<?php echo base_url(); ?>assets_d/images/up-arrow-grey.svg" class="helpful" alt="up Arrow">
																<span>Helpful</span>
															</a>
														</li>
														<li class="not-helpful">
															<a>
																<img src="<?php echo base_url(); ?>assets_d/images/down-arrow-grey.svg" class="not-helpful" alt="Down Arrow">
																<span>Not Helpful</span>
															</a>
														</li>
														<li>
															<a>
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
											</div>
										</div>
									</div>
									<div class="box-card message">
										<div class="eventMessage">
											<img src="<?php echo base_url(); ?>assets_d/images/Q_A.svg" alt="Article"> Q&A
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
															<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
														</figure>
														<div class="right">
															<figcaption>Loreum Ipsum </figcaption>
															<div class="badgeList">
																<ul>
																	<li class="badge badge1">
																		<a href="">
																			<img src="<?php echo base_url(); ?>assets_d/images/institution.svg" alt="InStitute"> University name
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
													<div class="timeline">10 mins ago</div>
												</div>
												<h4>Lorem Ipsum is simply dummy text of the printing and</h4></h4>
												<div class="socialStatus">
													<div class="leftStatus vote">
														<a>
															<img src="<?php echo base_url(); ?>assets_d/images/up-arrow-dashboard.svg" alt="Up Arrow">
															<span>24</span>
														</a>
														<a>
															<img src="<?php echo base_url(); ?>assets_d/images/down-arrow-dashboard.svg" alt="Up Arrow">
															<span>02</span>
														</a>
													</div>
													<div class="rightStatus">
														<ul>
															<li>
																<a>
																	<img src="<?php echo base_url(); ?>assets_d/images/views-grey.svg" alt="Views">
																	<span>12 views</span>
																</a>
															</li>
															<li>
																<a>
																	<img src="<?php echo base_url(); ?>assets_d/images/answers-grey.svg" alt="Answer">
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
														<li class="helpful">
															<a>
																<img src="<?php echo base_url(); ?>assets_d/images/up-arrow-grey.svg" class="helpful" alt="up Arrow">
																<span>Helpful</span>
															</a>
														</li>
														<li class="not-helpful">
															<a>
																<img src="<?php echo base_url(); ?>assets_d/images/down-arrow-grey.svg" class="not-helpful" alt="Down Arrow">
																<span>Not Helpful</span>
															</a>
														</li>
														<li>
															<a>
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
									    						<p class="selectAns">Lorem Ipsum is simply dummy text of the printing and
									    							<span class="best-answer">
									    								<img src="<?php echo base_url(); ?>assets_d/images/like-answer.svg" alt="Like Answer"> Best answer
									    							</span>
									    						</p>
									    						<div class="leftStatus">
																	<a>
																		<img src="<?php echo base_url(); ?>assets_d/images/up-arrow-grey1.svg" alt="Up Arrow">
																		<span>24</span>
																	</a>
																	<a>
																		<img src="<?php echo base_url(); ?>assets_d/images/down-arrow-grey1.svg" alt="Up Arrow">
																		<span>02</span>
																	</a>
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
																		<img src="<?php echo base_url(); ?>assets_d/images/up-arrow-dashboard.svg" alt="Up Arrow">
																		<span>24</span>
																	</a>
																	<a>
																		<img src="<?php echo base_url(); ?>assets_d/images/down-arrow-grey1.svg" alt="Up Arrow">
																		<span>02</span>
																	</a>
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
																					<a>
																						<img src="<?php echo base_url(); ?>assets_d/images/up-arrow-dashboard.svg" alt="Up Arrow">
																						<span>24</span>
																					</a>
																					<a>
																						<img src="<?php echo base_url(); ?>assets_d/images/down-arrow-grey1.svg" alt="Up Arrow">
																						<span>02</span>
																					</a>
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
																					<a>
																						<img src="<?php echo base_url(); ?>assets_d/images/up-arrow-dashboard.svg" alt="Up Arrow">
																						<span>24</span>
																					</a>
																					<a>
																						<img src="<?php echo base_url(); ?>assets_d/images/down-arrow-grey1.svg" alt="Up Arrow">
																						<span>02</span>
																					</a>
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
																		<img src="<?php echo base_url(); ?>assets_d/images/up-arrow-grey1.svg" alt="Up Arrow">
																		<span>24</span>
																	</a>
																	<a>
																		<img src="<?php echo base_url(); ?>assets_d/images/down-arrow-dashboard.svg" alt="Up Arrow">
																		<span>02</span>
																	</a>
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
									<div class="box-card">
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
															<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
														</figure>
														<div class="right">
															<figcaption>Loreum Ipsum </figcaption>
															<div class="badgeList">
																<ul>
																	<li class="badge badge1">
																		<a href="">
																			<img src="<?php echo base_url(); ?>assets_d/images/institution.svg" alt="InStitute"> University name
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
													<div class="timeline">10 mins ago</div>
												</div>
												<h4>Lorem Ipsum is simply dummy text of the printing and</h4>
												<div class="selectedPollOptions">
													<label class="dashRadioWrap">
														<div class="progressBar">
															<div class="progress">
																<div class="progressValues">
																	<div class="leftValue">
																		Option 1
																	</div>
																	<div class="rightValues">
																		<p>70%</p>
																		<div class="eventActionWrap">
																			<ul>
																				<li>
																					<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
																				</li>
																				<li>
																					<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
																				</li>
																				<li>
																					<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
																				</li>
																				<li>
																					<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
																				</li>
																				<li>
																					<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
																				</li>
																				<li class="more">
																					+5
																				</li>
																			</ul>
																		</div>
																	</div>
																</div>
															    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%"></div>
															</div>
														</div>
													  <input type="radio" checked="checked" name="radio">
													  <span class="checkmark"></span>
													</label>
													<label class="dashRadioWrap">
														<div class="progressBar">
															<div class="progress">
																<div class="progressValues">
																	<div class="leftValue">
																		Option 2
																	</div>
																	<div class="rightValues">
																		<p>50%</p>
																		<div class="eventActionWrap">
																			<ul>
																				<li>
																					<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
																				</li>
																				<li>
																					<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
																				</li>
																				<li>
																					<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
																				</li>
																				<li>
																					<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
																				</li>
																				<li>
																					<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
																				</li>
																				<li class="more">
																					+5
																				</li>
																			</ul>
																		</div>
																	</div>
																</div>
															    <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%"></div>
															</div>
														</div>
													  <input type="radio" name="radio">
													  <span class="checkmark"></span>
													</label>
													<label class="dashRadioWrap">
														<div class="progressBar">
															<div class="progress">
																<div class="progressValues">
																	<div class="leftValue">
																		Option 1
																	</div>
																	<div class="rightValues">
																		<p>20%</p>
																		<div class="eventActionWrap">
																			<ul>
																				<li>
																					<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
																				</li>
																				<li>
																					<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
																				</li>
																				<li>
																					<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
																				</li>
																				<li>
																					<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
																				</li>
																				<li>
																					<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
																				</li>
																				<li class="more">
																					+5
																				</li>
																			</ul>
																		</div>
																	</div>
																</div>
															    <div class="progress-bar" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:20%"></div>
															</div>
														</div>
													  <input type="radio" name="radio">
													  <span class="checkmark"></span>
													</label>
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
									</div> -->
								</div>
								<div id="schoolfeed" class="tab-pane fade">Tab2</div>
							</div>
						</div>
					</div>
				</section>

<div class="modal fade" id="confirmationModalAttend" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-body peers">
                   <h4>Confirmation</h4>
                   <div class="row">
                     <h6 class="modalText" id="confirmationModalAttendHead">Are you sure to attend this Event !</h6>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group button">
                                <input type="hidden" name="attend_event_id" id="attend_event_id">
                                <button data-dismiss="modal" class="transparentBtn highlight">No</button>
                                <button type="button" class="filterBtn" onclick="attendEvent()">Yes</button>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="addEventModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <div class="modal-body peers">
	          	   <h4>Confirmation</h4>
		           <div class="row">
		           	 <h6 class="modalText">Are you sure to add this Event to Calendar</h6>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group button">
								<form method="post" action="<?php echo base_url(); ?>account/addEventToCalender">
									<input type="hidden" id="calender_event_id" name="calender_event_id" value="">
									<input type="hidden" id="" name="dashboard" value="1">
									<button type="button" data-dismiss="modal" class="transparentBtn highlight">No</button>
									<button type="submit" class="filterBtn">Yes</button>
								</form>
							</div>
						</div>
					</div>
	        </div>
        </div>
    </div>
</div>	


<div class="modal fade" id="removeFromScheduleModal" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<div class="modal-body peers">
				<h4>Confirmation</h4>
				<div class="row">
					<h6 class="modalText">Are you sure you want to remove this event <br> from your schedule?</h6>
				</div>
				<div class="row">
					<div class="col-md-12">
						<form method="post" action="<?php echo base_url(); ?>account/removeEvent">
							<div class="form-group button">
								<input type="hidden" id="remove_event_id" name="remove_event_id">
								<input type="hidden" id="" name="dashboard" value="1">
								<button type="button" data-dismiss="modal" class="transparentBtn highlight">No</button>
								<button type="submit" class="filterBtn">Yes</button>
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
				

<script type="text/javascript">
	
	$(document).ready(function(){
		$.ajax({
			url : '<?php echo base_url();?>account/getDashboardFeeds',
			type : 'post',
			data : {"count" : 0},
			success:function(result) {

				$('#dashboard-feeds').html(result);
				$('.commentBoxWrap').hide();
			}
		});
	});

	$(document).on('click','.attendEvent',function(){
        var event_id = $(this).data('id');
        var txt = $('#attend_text_'+event_id).html(); 
        $("#attend_event_id").val(event_id);
        if(txt == 'Attend'){
            $('#confirmationModalAttendHead').html('Do you want to attend this Event !');
        } else {
            $('#confirmationModalAttendHead').html("Are you sure you don't want to attend this Event !");
        }

    });

    $(document).on("click", ".addEvents", function () {
	     var event_id = $(this).data('id');
	     $(".modal-body #calender_event_id").val(event_id);
	     
	});

	$(document).on("click", ".removeEvent", function () {
	     var event_id = $(this).data('id');
	     $(".modal-body #remove_event_id").val(event_id);
	     
	});

    function attendEvent(){
        var id = $("#attend_event_id").val();
        var txt = $('#attend_text_'+id).html();
        if(id != ''){
            $.ajax({
                url : '<?php echo base_url();?>account/attendSharedEvent',
                type : 'post',
                data : {"id" : id, "type" : txt},
                success:function(result) {
                    $("#confirmationModalAttend").modal('hide');
                    $("#attend_text_"+id).html(result);
                    $("#attend_event_id").val('');
                }   
            })
        }
    }


	function loadDashboardFeeds(count){ 
		$.ajax({
			url : '<?php echo base_url();?>account/getDashboardFeeds',
			type : 'post',
			data : {"count" : count},
			success:function(result) {
				$('#loadmore_'+count).hide(1000);
				$('#dashboard-feeds').append(result);
				$('.commentBoxWrap').hide();
			}
		});
	}

</script>