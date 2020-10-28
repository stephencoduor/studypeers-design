<?php $user_id = $this->session->get_userdata()['user_data']['user_id'];
		foreach ($feeds as $key => $value) {
			if($value['reference'] == 'event') { 

				$event_detail = $this->db->get_where('event_master', array('id' => $value['reference_id']))->row_array();
				
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
									<a>Add to Calendar</a>
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
		<?php } else if($value['reference'] == 'studyset') {  
			$studyset_detail = $this->db->get_where('study_sets', array('study_set_id' => $value['reference_id']))->row_array();
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
						<div class="timeline"><?php echo time_ago_in_php($studyset_detail['created_on']); ?></div>
					</div>
					<h4><?php echo $studyset_detail['name']; ?></h4>
					
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

		<?php } else if($value['reference'] == 'document') { 
			$document_detail = $this->db->get_where('document_master', array('id' => $value['reference_id']))->row_array();
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
							<div class="timeline"><?php echo time_ago_in_php($document_detail['created_at']); ?></div>
						</div>
						<h4><?php echo $document_detail['document_name']; ?></h4>
						<p><?php echo $document_detail['description']; ?> </p>
						<div class="documentName">
							<img src="<?php echo base_url(); ?>assets_d/images/pdf.svg" alt="pdf"> <?php echo $document_detail['featured_image']; ?>
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
		<?php } else if($value['reference'] == 'question') { 
			$question_detail = $this->db->get_where('question_master', array('id' => $value['reference_id']))->row_array();
		?>

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
															<img src="<?php echo userImage($question_detail['created_by']); ?>" alt="user">
														</figure>
														<?php $user = $this->db->get_where('user', array('id' => $question_detail['created_by']))->row_array();
					$user_info = $this->db->get_where('user_info', array('userID' => $question_detail['created_by']))->row_array();
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
													<div class="timeline"><?php echo time_ago_in_php($question_detail['created_at']); ?></div>
						</div>
						<h4><?php echo $question_detail['question_title']; ?></h4></h4>
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
		<?php } else if($value['reference'] == 'Post') { 
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
                                    
                                    <img src="<?php echo userImage($post_query->created_by); ?>" alt="user">
                                </figure>
                                <div class="right">
                                    <figcaption><?php echo $user['first_name'].' '.$user['last_name']; ?></figcaption>
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
                            <div class="timeline"><?php echo time_ago_in_php($posts['post_details']->created_at); ?></div>
                        </div>
                        <p class="feedPostMessages">
                            <?php echo $posts['post_details']->post_content_html; ?>
                        </p>
                        <?php if(count($posts['post_images']) > 0){
                            ?>
                            <div class="imgWrapper type2">
                                <?php
                                foreach($posts['post_images'] as $image){
                                    if(!empty($image)){
                                    ?>
                                    <figure>
                                        <img src="<?php echo base_url().$image['image_path'] ?>" alt="Post Image">
                                    </figure>
                                    <?php
                                    }
                                }
                                ?>
                            </div>
                        <?php
                        }?>
                        <?php if(count($posts['post_videos']) > 0){
                            ?>
                            <div class="imgWrapper type2">
                                <?php
                                foreach($posts['post_videos'] as $videos){
                                    if(!empty($videos)){
                                        ?>
                                        <video id="myVideo" width="320" height="240" controls>
                                            <source src="<?php echo base_url().$videos['video_path']?>" alt="Video">
                                        </video>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                            <?php
                        }
                        if(count($posts['post_documents']) > 0){
                            foreach($posts['post_documents'] as $document){
                            ?>
                            <p class="feedPostMessages">
                                <a href="<?php echo base_url().$document['document_path']; ?>">Click here to download the attachment</a>
                            </p>
                        <?php
                            }
                        }
                        ?>
                        <?php if(count($posts['post_poll_options']) > 0){
                            foreach($posts['post_poll_options'] as $options){
                            ?>
                            <div class="selectedPollOptions">
                                <label class="dashRadioWrap">
                                    <div class="progressBar">
                                        <div class="progress">
                                            <div class="progressValues">
                                                <div class="leftValue">
                                                    <?php echo $options['options'] ; ?>
                                                </div>
                                                <div class="rightValues">
                                                    <p>75%</p>
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
                                            <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:70%"></div>
                                        </div>
                                    </div>
                                    <input type="radio" checked="checked" name="radio">
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
                                    <img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Like">
                                    <img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" alt="Like">
                                    <span><?php echo $posts['post_details']->likes_count; ?></span>
                                </a>
                            </div>
                            <div class="rightStatus">
                                <ul>
                                    <li>
                                        <a>
                                            <img src="<?php echo base_url(); ?>assets_d/images/comment-grey.svg" alt="comment">
                                            <span><?php echo $posts['post_details']->comments_count; ?></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <img src="<?php echo base_url(); ?>assets_d/images/share-grey.svg" alt="Share">
                                            <span><?php echo $posts['post_details']->share_count; ?></span>
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

		<?php }
	?>
							
<?php
	}
?>