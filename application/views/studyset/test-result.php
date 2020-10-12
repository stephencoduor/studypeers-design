
				<section class="mainContent noPadding">
					<div class="main_subheader">
						<div class="main_subheaderLeft">
							<a href="<?php echo base_url();?>studyset/details/<?php echo $studyset['study_set_id'];?>">
								<svg class="sp-icon" version="1.1" id="Layer_1" 
								    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 490 490" style="enable-background:new 0 0 490 490;" xml:space="preserve">
									<path d="M245.9,436.3c14.8-16.4,13.9-41.5-2-56.8l-101.5-94.4l308.4-0.7c22.2-0.6,39.7-19,39.2-41.1c-0.5-21.4-17.7-38.6-39.1-39.1
										l-308.6,0.7l101.5-94.4c16.2-15.1,17.1-40.6,2-56.8c-15.1-16.2-40.6-17.1-56.8-2l-176.2,164C4.7,223.3,0.1,233.9,0,245
										c0,11.1,4.6,21.7,12.8,29.3L189,438.2c16.2,15.2,41.6,14.4,56.8-1.7c0.1-0.1,0.2-0.2,0.2-0.2H245.9z"></path>
								</svg>
								Back
							</a>
							<h4>
								<span class="studySets  test">
									<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
									  <path d="m327,433.5h-141.9c-11.3,0-20.4-9.1-20.4-20.4v-11c0-42-14.1-82.2-39.7-113.3-30-36.3-43.2-82.3-37.4-129.5 9.5-76.7 72.1-138.5 149-147.1 6.5-0.7 13-1.1 19.5-1.1 93.6,0 169.8,76.2 169.8,169.8 0,38.4-12.5,74.5-36.1,104.7-27.7,35.4-42.4,75.7-42.4,116.6v11c-5.68434e-14,11.1-9.2,20.3-20.4,20.3zm-121.7-40.9h101.4c2.1-46.8 19.5-92.4 50.9-132.4 17.9-22.9 27.4-50.3 27.4-79.5 0-71.1-57.9-129-129-129-4.9,0-10,0.3-15,0.8-58.3,6.5-105.8,53.4-113,111.6-4.4,35.9 5.6,70.9 28.4,98.5 29.8,36.2 46.9,82 48.9,130z"></path>
									  <path d="m313.6,501h-115.2c-11.3,0-20.4-9.1-20.4-20.4 0-11.3 9.1-20.4 20.4-20.4h115.2c11.3,0 20.4,9.1 20.4,20.4 0.1,11.3-9.1,20.4-20.4,20.4z"></path>
									</svg>
								</span>Test Result
							</h4>
						</div>
						
					</div>
					<div class="mainCardWrapper">
						
						<div class="study-set-results-box">
							<h4>It took you <strong><?php if(date("H", strtotime($round_data['time_span'])) != 0) { echo date("H", strtotime($round_data['time_span']))." Hours"; }   ?> <?php if(date("i", strtotime($round_data['time_span'])) != 0) { echo date("i", strtotime($round_data['time_span']))." Minutes"; }   ?> <?php if(date("s", strtotime($round_data['time_span'])) != 0) { echo date("s", strtotime($round_data['time_span']))." Seconds"; }   ?></strong> to complete the test</h4>
							<h4>You got <strong><?php echo $round_data['score']; ?> of <?php echo $round_data['total']; ?></strong> correct</h4>
							
							<h4 class="heading">You can review the result of the test below.</h4>
							
						</div>
						<form>
							<?php if($round_data['written_applicable'] == 1) { ?>
								<div class="commoncard study-set-test-form">
									<h3><?php echo count($term_data); ?> Written Questions</h3>
									<?php $count = 1; foreach ($term_data as $key => $value) { ?>
										<div class="test-item">
											<div class="test-item-index"><?php echo $count; ?></div>
											<div class="d-flex test-desc">
												<div class="flex-fill">
													<p class="text-item-desc mb-20 text-capitalise"> <?php echo $value['term_description']; ?></p>
													<?php if(!empty($value['term_image'])) { ?>
														<img src="<?php echo base_url(); ?>uploads/studyset/<?php echo $value['term_image']; ?>" alt="Study Set" style="height: 90px;margin-right: 5px;border-radius: 5px;">
													<?php } ?> 
												</div>										
											</div>
											<?php $chk_result = $this->db->get_where('test_round_details', array('round_id' => $round_id, 'type' => 'written', 'term_id' => $value['study_set_term_id']))->row_array(); ?>
											<div class="result pl-55">
												<?php if(!empty($chk_result)) { ?>
													<h6 style="color: #ea2e7e;">Incorrect Answer</h6><p class="text-dark"><?php echo $chk_result['user_answer']; ?></p>
												<?php } ?>
													
												<h6 class="correct-dark-color"><svg class="sp-icon correct-dark mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
													<path d="M440.8,11H71.3C38,11,11,38,11,71.2v369.5C11,474,38,501,71.3,501h369.5c33.2,0,60.2-27,60.2-60.2V71.2
														C501,38,474,11,440.8,11z M460.2,440.8c0,10.7-8.7,19.4-19.4,19.4H71.3c-10.7,0-19.4-8.7-19.4-19.4V71.2c0-10.7,8.7-19.4,19.4-19.4
														h369.5c10.7,0,19.4,8.7,19.4,19.4L460.2,440.8L460.2,440.8z"></path>
													<path d="M232.6,357.4c-5.4,0-10.7-2-14.8-6.2l-87.6-87.6c-8.2-8.2-8.2-21.5,0-29.7c8.2-8.2,21.5-8.2,29.7,0l72.7,72.7l151.7-151.7
														c8.2-8.2,21.5-8.2,29.7,0c8.2,8.2,8.2,21.5,0,29.7L247.4,351.3C243.3,355.4,237.9,357.4,232.6,357.4z"></path>
													</svg>
													 Correct Answer
												</h6>	<p class="text-dark">
												<?php echo $value['term_name']; ?></p>
											</div>
										</div>
									<?php $count++; } ?>
									
								</div>
							<?php } ?>
							<?php if($round_data['match_applicable'] == 1) { ?>
								<div class="commoncard study-set-test-form">
									<h3 class="mb-5"><?php echo count($term_data); ?> Matching Questions</h3>
									<?php $count = 1; foreach ($term_data as $key => $value) { ?>
										<div class="test test-item">
											<div class="row">
												<div class="col-md-8 matching-item">
													
													<div class="text-item-desc mb-5">
														<p class="text-capitalise"><?php echo $value['term_description']; ?>	</p>
														<?php if(!empty($value['term_image'])) { ?>
															<img src="<?php echo base_url(); ?>uploads/studyset/<?php echo $value['term_image']; ?>" alt="Study Set" style="height: 90px;margin-right: 5px;border-radius: 5px;margin-left: 10px;">
														<?php } ?>
													</div>	
													<?php $chk_result = $this->db->get_where('test_round_details', array('round_id' => $round_id, 'type' => 'matching', 'term_id' => $value['study_set_term_id']))->row_array(); ?>					
													<div class="result">
														<?php if(!empty($chk_result)) { ?>
															<h6 style="color: #ea2e7e;">Incorrect Answer</h6>
															<p class="text-dark"><?php echo $chk_result['user_answer']; ?></p>
														<?php } else { ?>
															<h6 class="correct-dark-color"><svg class="sp-icon correct-dark mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
																<path d="M440.8,11H71.3C38,11,11,38,11,71.2v369.5C11,474,38,501,71.3,501h369.5c33.2,0,60.2-27,60.2-60.2V71.2
																	C501,38,474,11,440.8,11z M460.2,440.8c0,10.7-8.7,19.4-19.4,19.4H71.3c-10.7,0-19.4-8.7-19.4-19.4V71.2c0-10.7,8.7-19.4,19.4-19.4
																	h369.5c10.7,0,19.4,8.7,19.4,19.4L460.2,440.8L460.2,440.8z"></path>
																<path d="M232.6,357.4c-5.4,0-10.7-2-14.8-6.2l-87.6-87.6c-8.2-8.2-8.2-21.5,0-29.7c8.2-8.2,21.5-8.2,29.7,0l72.7,72.7l151.7-151.7
																	c8.2-8.2,21.5-8.2,29.7,0c8.2,8.2,8.2,21.5,0,29.7L247.4,351.3C243.3,355.4,237.9,357.4,232.6,357.4z"></path>
																</svg>
																 Correct Answer
															</h6>
															<p class="text-dark"><?php echo $value['term_name']; ?></p>
														<?php } ?>
															
													</div>
												</div>
												<div class="col-md-4">
													<div class="match-card-desc mb-3 pull-right">
														<div class="card-image--sm question-card-desc">
															<?php echo $value['term_name']; ?>
														</div>
																									
													</div>
												</div>
											</div>	
										</div>
									<?php $count++; } ?>
								</div>
							<?php } ?>
							<?php if($round_data['multiple_applicable'] == 1) { ?>
								<div class="commoncard study-set-test-form">
									<div class="test test-item">
										<h3><?php echo count($term_data); ?> Multiple Choice Questions</h3>
										<?php $count = 1; foreach ($term_data as $key => $value) { ?>
											<div class="test-item">
												<div class="test-item-index"><?php echo $count; ?></div>
												<div class="d-flex">
													<div class="flex-fill">
														<p class="text-item-desc mb-20 text-capitalise"><?php echo $value['term_description']; ?></p>
														<?php if(!empty($value['term_image'])) { ?>
															<img src="<?php echo base_url(); ?>uploads/studyset/<?php echo $value['term_image']; ?>" alt="Study Set" style="height: 90px;margin-right: 5px;border-radius: 5px;">
														<?php } ?>
														<?php $chk_result = $this->db->get_where('test_round_details', array('round_id' => $round_id, 'type' => 'multiple', 'term_id' => $value['study_set_term_id']))->row_array(); ?>
														<div class="result">
															<?php  $class = "correct"; if(!empty($chk_result)) { $class = ""; ?>
																<h6 style="color: #ea2e7e;">Incorrect Answer</h6><p class="text-dark"><?php echo $chk_result['user_answer']; ?></p>
															<?php } ?>
															<h6 class="correct-dark-color"><svg class="sp-icon correct-dark mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
																<path d="M440.8,11H71.3C38,11,11,38,11,71.2v369.5C11,474,38,501,71.3,501h369.5c33.2,0,60.2-27,60.2-60.2V71.2
																	C501,38,474,11,440.8,11z M460.2,440.8c0,10.7-8.7,19.4-19.4,19.4H71.3c-10.7,0-19.4-8.7-19.4-19.4V71.2c0-10.7,8.7-19.4,19.4-19.4
																	h369.5c10.7,0,19.4,8.7,19.4,19.4L460.2,440.8L460.2,440.8z"></path>
																<path d="M232.6,357.4c-5.4,0-10.7-2-14.8-6.2l-87.6-87.6c-8.2-8.2-8.2-21.5,0-29.7c8.2-8.2,21.5-8.2,29.7,0l72.7,72.7l151.7-151.7
																	c8.2-8.2,21.5-8.2,29.7,0c8.2,8.2,8.2,21.5,0,29.7L247.4,351.3C243.3,355.4,237.9,357.4,232.6,357.4z"></path>
																</svg>
																 Correct Answer
															</h6>
															<p class="text-dark"><?php echo $value['term_name']; ?></p>
														</div>
														
													</div>

																		
												</div>
											</div>
										<?php $count++; } ?>
									</div>
								</div>
							<?php } ?>
							<div class="commoncard study-set-test-form">
							<?php if($round_data['truefalse_applicable'] == 1) { ?>
								<div class="test test-item">
									<h3><?php echo count($term_data); ?> True/False questions</h3>
									<?php $count = 1; foreach ($term_data as $key => $value) { ?>
										<div class="test-item">
											<div class="test-item-index"><?php echo $count; ?></div>
											<div class="d-flex">
												<div class="flex-fill">

													<p class="text-capitalise"><strong><?php echo $value['term_description']; ?></strong></p>
													<?php if(!empty($value['term_image'])) { ?>
															<img src="<?php echo base_url(); ?>uploads/studyset/<?php echo $value['term_image']; ?>" alt="Study Set" style="height: 90px;margin-right: 5px;border-radius: 5px;">
														<?php } ?><br>
													<p class="text-capitalise"><?php echo $value['term_name']; ?></p>

													
												</div>
												

											</div>
											<?php $chk_result = $this->db->get_where('test_round_details', array('round_id' => $round_id, 'type' => 'truefalse', 'term_id' => $value['study_set_term_id']))->row_array(); ?>
											<div class="result pl-55">
												<?php  $class = "correct"; if(!empty($chk_result)) { $class = ""; ?>
													<h6 style="color: #ea2e7e;">Incorrect Answer</h6><p class="text-dark">Your answer is incorrect</p>
												<?php } else { ?>
													<h6 class="correct-dark-color"><svg class="sp-icon correct-dark mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
																<path d="M440.8,11H71.3C38,11,11,38,11,71.2v369.5C11,474,38,501,71.3,501h369.5c33.2,0,60.2-27,60.2-60.2V71.2
																	C501,38,474,11,440.8,11z M460.2,440.8c0,10.7-8.7,19.4-19.4,19.4H71.3c-10.7,0-19.4-8.7-19.4-19.4V71.2c0-10.7,8.7-19.4,19.4-19.4
																	h369.5c10.7,0,19.4,8.7,19.4,19.4L460.2,440.8L460.2,440.8z"></path>
																<path d="M232.6,357.4c-5.4,0-10.7-2-14.8-6.2l-87.6-87.6c-8.2-8.2-8.2-21.5,0-29.7c8.2-8.2,21.5-8.2,29.7,0l72.7,72.7l151.7-151.7
																	c8.2-8.2,21.5-8.2,29.7,0c8.2,8.2,8.2,21.5,0,29.7L247.4,351.3C243.3,355.4,237.9,357.4,232.6,357.4z"></path>
																</svg>
																 Correct Answer
															</h6>
													<p class="text-dark">Your answer is correct</p>
												<?php } ?>
												
											</div>

										</div>
									<?php $count++; } ?>
								</div>
							<?php } ?>
						</div>
						</form>
					</div>
				</section>
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
                			<section class="list">
	                			<section class="left">
	                				<figure>
	                					<img src="images/user2.jpg" alt="user">
	                				</figure>
	                				<figcaption>Scholasticus Ipsum</figcaption>
	                			</section>
	                			<section class="action">
	                				<i class="fa fa-ellipsis-v"></i>
	                			</section>
                			</section>
                			<section class="list">
	                			<section class="left">
	                				<figure>
	                					<img src="images/user2.jpg" alt="user">
	                					<span class="messagecount">12</span>
	                				</figure>
	                				<figcaption>Scholasticus Ipsum</figcaption>
	                			</section>
	                			<section class="action">
	                				<i class="fa fa-ellipsis-v"></i>
	                			</section>
                			</section>
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
	                					<img src="images/user2.jpg" alt="user">
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
	                					<img src="images/user2.jpg" alt="user">
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
	                					<img src="images/user2.jpg" alt="user">
	                					<span class="circle online"></span>
	                				</figure>
	                				<figcaption>Angelina</figcaption>
	                			</section>
                			</section>
                			<section class="list">
	                			<section class="left">
	                				<figure>
	                					<img src="images/user2.jpg" alt="user">
	                					<span class="circle offline"></span>
	                				</figure>
	                				<figcaption>Angelina</figcaption>
	                			</section>
                			</section>
                			<section class="list">
	                			<section class="left">
	                				<figure>
	                					<img src="images/user2.jpg" alt="user">
	                					<span class="circle online"></span>
	                				</figure>
	                				<figcaption>Angelina</figcaption>
	                			</section>
                			</section>
                			<section class="list">
	                			<section class="left">
	                				<figure>
	                					<img src="images/user2.jpg" alt="user">
	                					<span class="circle offline"></span>
	                				</figure>
	                				<figcaption>Angelina</figcaption>
	                			</section>
                			</section>
                			<section class="list">
	                			<section class="left">
	                				<figure>
	                					<img src="images/user2.jpg" alt="user">
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
          <div class="peersList">
          	<div class="listHeader">
          		<h6>Peers</h6>
          	</div>
          	<div class="listUserWrap">
          		<section class="list">
        			<section class="left">
        				<figure>
        					<img src="images/user2.jpg" alt="user">
        				</figure>
        				<figcaption>John Phelips</figcaption>
        			</section>
        			<section class="action">
        				<button type="button" class="like">message</button>
        			</section>
    			</section>
    			<section class="list">
        			<section class="left">
        				<figure>
        					<img src="images/user2.jpg" alt="user">
        				</figure>
        				<figcaption>John Phelips</figcaption>
        			</section>
        			<section class="action">
        				<button type="button" class="like">message</button>
        			</section>
    			</section>
    			<section class="list">
        			<section class="left">
        				<figure>
        					<img src="images/user2.jpg" alt="user">
        				</figure>
        				<figcaption>John Phelips</figcaption>
        			</section>
        			<section class="action">
        				<button type="button" class="like">message</button>
        			</section>
    			</section>
    			<section class="list">
        			<section class="left">
        				<figure>
        					<img src="images/user2.jpg" alt="user">
        				</figure>
        				<figcaption>John Phelips</figcaption>
        			</section>
        			<section class="action">
        				<button type="button" class="like">message</button>
        			</section>
    			</section>
    			<section class="list">
        			<section class="left">
        				<figure>
        					<img src="images/user2.jpg" alt="user">
        				</figure>
        				<figcaption>John Phelips</figcaption>
        			</section>
        			<section class="action">
        				<button type="button" class="like">message</button>
        			</section>
    			</section>
    			<section class="list">
        			<section class="left">
        				<figure>
        					<img src="images/user2.jpg" alt="user">
        				</figure>
        				<figcaption>John Phelips</figcaption>
        			</section>
        			<section class="action">
        				<button type="button" class="like">message</button>
        			</section>
    			</section>
    			<section class="list">
        			<section class="left">
        				<figure>
        					<img src="images/user2.jpg" alt="user">
        				</figure>
        				<figcaption>John Phelips</figcaption>
        			</section>
        			<section class="action">
        				<button type="button" class="like">message</button>
        			</section>
    			</section>
    			<section class="list">
        			<section class="left">
        				<figure>
        					<img src="images/user2.jpg" alt="user">
        				</figure>
        				<figcaption>John Phelips</figcaption>
        			</section>
        			<section class="action">
        				<button type="button" class="like">message</button>
        			</section>
    			</section>
    			<section class="list">
        			<section class="left">
        				<figure>
        					<img src="images/user2.jpg" alt="user">
        				</figure>
        				<figcaption>John Phelips</figcaption>
        			</section>
        			<section class="action">
        				<button type="button" class="like">message</button>
        			</section>
    			</section>
    			<section class="list">
        			<section class="left">
        				<figure>
        					<img src="images/user2.jpg" alt="user">
        				</figure>
        				<figcaption>John Phelips</figcaption>
        			</section>
        			<section class="action">
        				<button type="button" class="like">message</button>
        			</section>
    			</section>
          	</div>
          </div>
        </div>
      </div>
    </div>
</div>

<script>

</script>