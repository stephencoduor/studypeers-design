<?php  
	if($this->input->get('sort-by', TRUE)){
        $sort_by = $this->input->get('sort-by', TRUE);
    } else {
    	$sort_by = '';
    }
?>
<section class="mainContent">
	<?php 	if($this->session->flashdata('flash_message')) { 
            	echo $this->session->flashdata('flash_message');
            }
    ?>
					<div class="studySetWrapper list qa-detail">
						<div class="main_subheaderLeft">
								<a href="<?php echo base_url(); ?>account/questions" style="margin: 0;">
									<svg class="sp-icon" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 490 490" style="enable-background:new 0 0 490 490;" xml:space="preserve">
										<path d="M245.9,436.3c14.8-16.4,13.9-41.5-2-56.8l-101.5-94.4l308.4-0.7c22.2-0.6,39.7-19,39.2-41.1c-0.5-21.4-17.7-38.6-39.1-39.1
											l-308.6,0.7l101.5-94.4c16.2-15.1,17.1-40.6,2-56.8c-15.1-16.2-40.6-17.1-56.8-2l-176.2,164C4.7,223.3,0.1,233.9,0,245
											c0,11.1,4.6,21.7,12.8,29.3L189,438.2c16.2,15.2,41.6,14.4,56.8-1.7c0.1-0.1,0.2-0.2,0.2-0.2H245.9z"></path>
									</svg>
									Back
								</a>
								
							</div>
						<div class="header">
							<div class="timeperiod">
								<ul>
									<li>
										<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M448 0H64C28.7 0 0 28.7 0 64v288c0 35.3 28.7 64 64 64h96v84c0 7.1 5.8 12 12 12 2.4 0 4.9-.7 7.1-2.4L304 416h144c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64zm16 352c0 8.8-7.2 16-16 16H288l-12.8 9.6L208 428v-60H64c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16h384c8.8 0 16 7.2 16 16v288zm-96-216H144c-8.8 0-16 7.2-16 16v16c0 8.8 7.2 16 16 16h224c8.8 0 16-7.2 16-16v-16c0-8.8-7.2-16-16-16zm-96 96H144c-8.8 0-16 7.2-16 16v16c0 8.8 7.2 16 16 16h128c8.8 0 16-7.2 16-16v-16c0-8.8-7.2-16-16-16z"></path></svg> <?php echo count($answer_list); ?> Answers
									</li>
									<li>
										<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
										  <path d="m497.6,244.7c-63.9-96.7-149.7-150-241.6-150-91.9,1.42109e-14-177.7,53.3-241.6,150-4.5,6.8-4.5,15.7 0,22.5 63.9,96.7 149.7,150 241.6,150 91.9,0 177.7-53.3 241.6-150 4.5-6.8 4.5-15.6 0-22.5zm-241.6,131.7c-74.2,0-144.8-42.6-199.9-120.4 55-77.8 125.6-120.4 199.9-120.4 74.2,0 144.8,42.6 199.9,120.4-55.1,77.8-125.6,120.4-199.9,120.4z"></path>
										  <path d="m256,148.5c-59.3,0-107.5,48.2-107.5,107.5 0,59.3 48.2,107.5 107.5,107.5s107.5-48.2 107.5-107.5c0-59.3-48.2-107.5-107.5-107.5zm0,175.5c-36.8,0-66.8-30.5-66.8-68 0-37.5 30-68 66.8-68 36.8,0 66.8,30.5 66.8,68 0,37.5-30,68-66.8,68z"></path>
										</svg> <?php echo $result['view_count']; ?> Views
									</li>
									<li>
										<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 501.333 501.333">
											<path d="M250.667,0C112,0,0,112,0,250.667s112,250.667,250.667,250.667s250.667-112,250.667-250.667S389.333,0,250.667,0z
											M250.667,459.733c-115.2,0-209.067-93.867-209.067-209.067S135.467,41.6,250.667,41.6s209.067,93.867,209.067,209.067
											S365.867,459.733,250.667,459.733z"></path>
											<path d="M314.667,229.333H272V129.067c0-11.733-9.6-21.333-21.333-21.333c-11.733,0-21.333,9.6-21.333,21.333v121.6
											c0,11.733,9.6,21.333,21.333,21.333h64C326.4,272,336,262.4,336,250.667C336,238.933,326.4,229.333,314.667,229.333z"></path>
										</svg>  <?php echo date('M d, Y', strtotime($result['created_at'])); ?>
									</li>
								</ul>
							</div>
							<div class="studybuttonGroup">
								<form method="post" action="<?php echo base_url(); ?>account/markQuestion">
									<input type="hidden" name="mark_question_id" value="<?php echo $result['id']; ?>">
									<button type="submit" class="filterBtn">
										<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" 
											xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												 viewBox="0 0 477.867 477.867" style="enable-background:new 0 0 477.867 477.867;" xml:space="preserve">
											<g>
												<g>
													<path d="M238.933,0C106.974,0,0,106.974,0,238.933s106.974,238.933,238.933,238.933s238.933-106.974,238.933-238.933
														C477.726,107.033,370.834,0.141,238.933,0z M238.933,443.733c-113.108,0-204.8-91.692-204.8-204.8s91.692-204.8,204.8-204.8
														s204.8,91.692,204.8,204.8C443.611,351.991,351.991,443.611,238.933,443.733z"/>
												</g>
											</g>
											<g>
												<g>
													<path d="M370.046,141.534c-6.614-6.388-17.099-6.388-23.712,0v0L187.733,300.134l-56.201-56.201
														c-6.548-6.78-17.353-6.967-24.132-0.419c-6.78,6.548-6.967,17.353-0.419,24.132c0.137,0.142,0.277,0.282,0.419,0.419
														l68.267,68.267c6.664,6.663,17.468,6.663,24.132,0l170.667-170.667C377.014,158.886,376.826,148.082,370.046,141.534z"/>
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
										<?php if($result['is_solved'] == 1) {
											echo "Mark as unsolved";
										} else {
											echo "Mark as solved";
										} ?>
										
									</button>
								</form>
								<button type="button" class="transparentBtn" onclick="location.href='<?php echo base_url(); ?>account/editQuestion/<?php echo base64_encode($result['id']); ?>';">
									<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" 
										xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
										<g>
											<g>
												<polygon points="51.2,353.28 0,512 158.72,460.8 		"></polygon>
											</g>
										</g>
										<g>
											<g>
												
													<rect x="89.73" y="169.097" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -95.8575 260.3719)" width="353.277" height="153.599"></rect>
											</g>
										</g>
										<g>
											<g>
												<path d="M504.32,79.36L432.64,7.68c-10.24-10.24-25.6-10.24-35.84,0l-23.04,23.04l107.52,107.52l23.04-23.04
													C514.56,104.96,514.56,89.6,504.32,79.36z"></path>
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
									Edit
								</button>
							</div>
						</div>
						<?php $user_id = $this->session->get_userdata()['user_data']['user_id'];
						 $chk_user_upvote = $this->db->get_where($this->db->dbprefix('vote_master'), array('reference'=> 'question', 'reference_id'=> $result['id'], 'user_id' => $user_id))->row_array();
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
						<div class="voteHeaderWrapper">
							<div class="voteCount">
								<div class="uparrow" id="q_uparrow_<?= $result['id']; ?>">
									<svg xmlns="http://www.w3.org/2000/svg"  class="normalState" width="18.363" height="20" viewBox="0 0 18.363 20" onclick="voteQuestion('upvote', '<?php echo $result['id']; ?>')" style="<?php echo $up_normal_q; ?>">
									    <g id="prefix__up-arrow" transform="translate(-31.008 -10.925)">
									        <path id="prefix__Path_1209" d="M37.272 29.256h5.6v-9.1a.83.83 0 0 1 .828-.833h2.828l-6.358-6.387-6.35 6.383h2.62a.83.83 0 0 1 .828.833v9.1zm6.428 1.669h-7.26a.83.83 0 0 1-.828-.833v-9.1H31.82a.844.844 0 0 1-.588-1.424l8.358-8.4a.845.845 0 0 1 1.171 0l8.354 8.4a.823.823 0 0 1-.588 1.424h-4v9.1a.825.825 0 0 1-.827.833z" data-name="Path 1209" />
									    </g>
									</svg>										
									<svg xmlns="http://www.w3.org/2000/svg"  class="activeState" width="18.363" height="20" viewBox="0 0 18.363 20" style="<?php echo $up_active_q; ?>" onclick="removeVoteQuestion('upvote', '<?php echo $result['id']; ?>')">
									    <g id="prefix__Layer_1" transform="translate(-31.008 -10.925)">
									        <g id="prefix__Group_1371" data-name="Group 1371" transform="translate(31.008 10.925)">
									            <path id="prefix__Path_1213" d="M43.7 30.925h-7.26a.83.83 0 0 1-.828-.833v-9.1H31.82a.844.844 0 0 1-.588-1.424l8.358-8.4a.845.845 0 0 1 1.171 0l8.354 8.4a.823.823 0 0 1-.588 1.424h-4v9.1a.825.825 0 0 1-.828.833z" data-name="Path 1213" transform="translate(-31.008 -10.925)" style="fill:#1ae1bd"/>
									        </g>
									    </g>
									</svg>
								</div>
								<div class="count" id="q_count_<?= $result['id']; ?>">
									<?php if($result['vote_count'] < 0) {
										echo "0";
									} else {
										echo $result['vote_count'];
									} ?>
										
								</div>
								<div class="downarrow" id="q_downarrow_<?= $result['id']; ?>">
									<svg xmlns="http://www.w3.org/2000/svg" width="18.363" height="20" class="normalState" viewBox="0 0 18.363 20" onclick="voteQuestion('downvote', '<?php echo $result['id']; ?>')" style="<?php echo $down_normal_q; ?>">
									    <g id="prefix__up-arrow" transform="rotate(180 24.686 15.463)">
									        <path id="prefix__Path_1209" d="M37.272 29.256h5.6v-9.1a.83.83 0 0 1 .828-.833h2.828l-6.358-6.387-6.35 6.383h2.62a.83.83 0 0 1 .828.833v9.1zm6.428 1.669h-7.26a.83.83 0 0 1-.828-.833v-9.1H31.82a.844.844 0 0 1-.588-1.424l8.358-8.4a.845.845 0 0 1 1.171 0l8.354 8.4a.823.823 0 0 1-.588 1.424h-4v9.1a.825.825 0 0 1-.827.833z" data-name="Path 1209" />
									    </g>
									</svg>
									<svg xmlns="http://www.w3.org/2000/svg"  class="activeState" width="18.363" height="20" viewBox="0 0 18.363 20" style="<?php echo $down_active_q; ?>" onclick="removeVoteQuestion('downvote', '<?php echo $result['id']; ?>')">
									    <g id="prefix__Layer_1" transform="rotate(180 24.686 15.463)">
									        <g id="prefix__Group_1371" data-name="Group 1371" transform="translate(31.008 10.925)">
									            <path id="prefix__Path_1213" d="M43.7 30.925h-7.26a.83.83 0 0 1-.828-.833v-9.1H31.82a.844.844 0 0 1-.588-1.424l8.358-8.4a.845.845 0 0 1 1.171 0l8.354 8.4a.823.823 0 0 1-.588 1.424h-4v9.1a.825.825 0 0 1-.828.833z" data-name="Path 1213" transform="translate(-31.008 -10.925)" />
									        </g>
									    </g>
									</svg>
								</div>
							</div>
							<div class="rightHdrWrapper">
								<h4><?php echo $result['question_title']; ?></h4>
								<div class="badgeList">
									<ul>
										<li class="badge badge1">
											<?php echo $result['SchoolName']; ?>
										</li>
										<li class="badge badge2">
											<?php echo $result['course']; ?>
										</li>
										<li class="badge badge3">
											<?php echo $result['professor']; ?>
										</li>
									</ul>
								</div>
								<div class="user-name">
									<figure>
										<img src="<?php echo userImage($result['created_by']); ?>" alt="user">
									</figure>
									<a href="<?php echo base_url().'Profile/friends?profile_id='.$result['created_by'] ?>"><figcaption><?php echo $result['nickname']; ?></figcaption></a>
								</div>
							</div>	
						</div>
						<div class="detailDescription" id="detailDescription">
							<?php echo $result['textarea']; ?>
						</div>
						<?php if($result['is_solved'] == 0) { ?>
							<div class="comment-title">
								<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M448 0H64C28.7 0 0 28.7 0 64v288c0 35.3 28.7 64 64 64h96v84c0 7.1 5.8 12 12 12 2.4 0 4.9-.7 7.1-2.4L304 416h144c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64zm16 352c0 8.8-7.2 16-16 16H288l-12.8 9.6L208 428v-60H64c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16h384c8.8 0 16 7.2 16 16v288zm-96-216H144c-8.8 0-16 7.2-16 16v16c0 8.8 7.2 16 16 16h224c8.8 0 16-7.2 16-16v-16c0-8.8-7.2-16-16-16zm-96 96H144c-8.8 0-16 7.2-16 16v16c0 8.8 7.2 16 16 16h128c8.8 0 16-7.2 16-16v-16c0-8.8-7.2-16-16-16z"></path></svg>
								Answer	
							</div>
							<div class="commentAnswer">
								<form method="post" action="<?php echo base_url(); ?>account/submitAnswer" onsubmit="return validateAnswer()">
									<div class="form-group comment">
										<input type="hidden" name="question_id" value="<?php echo $result['id']; ?>">
										<textarea name="answer" id="definition0" cols="30" rows="10"></textarea>
										<span class="custom_err" id="err_definition0"></span>
									</div>
									<button type="submit" class="filterBtn"> 
										Submit
									</button>
								</form>
							</div>
						<?php } ?>
						<div class="commentfilterWrapper">
							Sort by: 
							<div class="filterSelect">
								<select class="form-control" placeholder="Votes" onchange="applySort(this.value)">
									<option value="" >Sort By</option>
								  	<option value="vote" <?php if($sort_by == 'vote') { echo 'selected'; } ?>>Votes</option>
								  	<option value="date" <?php if($sort_by == 'date') { echo 'selected'; } ?>>Date</option>
								</select>
							</div>
						</div>
						<?php foreach ($answer_list as $key => $value) { 
							$user_id = $this->session->get_userdata()['user_data']['user_id']; 
							$this->db->select('question_answer_master.*, user_info.nickname');
        					$this->db->join('user_info','user_info.userID=question_answer_master.answered_by');
							$get_reply = $this->db->get_where($this->db->dbprefix('question_answer_master'), array('question_answer_master.question_id'=>$result['id'], 'question_answer_master.status' => 1, 'question_answer_master.parent_id' => $value['id']))->result_array(); 
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
							<div class="replyAnswerBox">		
								<?php if($value['best_answer'] == 1) { ?>					
									<div class="answerQuote">
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
								<?php } ?>
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
										<div class="count" id="count_<?php echo $value['id']; ?>">
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
														<figcaption><?php echo $value['nickname']; ?></figcaption>
													</div>
													<p class="date"><?php echo date('d/m/Y', strtotime($value['created_at'])); ?></p>
												</div>
												<div class="action">
													<ul>
														<li>
															<a onclick="showReplyBox('<?php echo $value['id']; ?>')">
																<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M14.062 257.94L190.06 433.88c30.21 30.21 81.94 8.7 81.94-33.94v-78.28c146.59 8.54 158.53 50.199 134.18 127.879-13.65 43.56 35.07 78.89 72.19 54.46C537.98 464.768 576 403.8 576 330.05c0-170.37-166.04-197.15-304-201.3V48.047c0-42.72-51.79-64.09-81.94-33.94L14.062 190.06c-18.75 18.74-18.75 49.14 0 67.88zM48 224L224 48v128.03c143.181.63 304 11.778 304 154.02 0 66.96-40 109.95-76.02 133.65C501.44 305.911 388.521 273.88 224 272.09V400L48 224z"></path></svg>
																Reply
															</a>
														</li>
														<?php if($value['best_answer'] == 0) { ?>	
															<li>
																<a data-toggle="modal" data-target="#confirmationModalBestAnswer" data-id="<?= $value['id']; ?>" class="select_best_answer">
																	<svg xmlns="http://www.w3.org/2000/svg" width="16" height="14.625" viewBox="0 0 16 14.625">
																	    <path id="prefix__star" d="M7.432 21.6a.889.889 0 0 1 1.219-.287.864.864 0 0 1 .287.287L11 24.943a.878.878 0 0 0 .575.4l3.91.8a.884.884 0 0 1 .689 1.045.911.911 0 0 1-.222.431l-2.613 2.767a.884.884 0 0 0-.235.7l.4 3.737a.885.885 0 0 1-.787.974.9.9 0 0 1-.434-.062l-3.75-1.565a.876.876 0 0 0-.68 0L4.1 35.743a.883.883 0 0 1-1.219-.911l.4-3.737a.9.9 0 0 0-.235-.7l-2.615-2.77a.884.884 0 0 1 .036-1.251.869.869 0 0 1 .433-.223l3.91-.8a.89.89 0 0 0 .575-.4z" transform="translate(-.189 -21.185)" style="fill:#185aeb"/>
																	</svg>
																	Select best answer
																</a>
															</li>
														<?php } ?>
														<li class="report">
															<a href="#" class="transAction reportQuestionAnswer" data-toggle="modal" data-target="#reportModal" data-id="<?php echo $value['id']; ?>">															
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
							<div class="innerreplyAndComment" id="reply_box_<?php echo $value['id']; ?>" style="display: none;">

								<div class="replyAnswerBox reply">
									<div class="commentAnswer">
										<form method="post" action="<?php echo base_url(); ?>account/submitAnswerReply" onsubmit="return validateReply('<?php echo $value['id']; ?>')">
											<div class="form-group comment" style="margin-bottom: 15px;">
												<input type="hidden" name="question_id" value="<?php echo $result['id']; ?>">
												<input type="hidden" name="parent_id" value="<?php echo $value['id']; ?>">
												<textarea name="reply" id="reply_<?php echo $value['id']; ?>" cols="30" rows="5"></textarea>
												<span class="custom_err" id="err_reply_<?php echo $value['id']; ?>"></span>
											</div>
											<button type="submit" class="filterBtn"> 
												<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M14.062 257.94L190.06 433.88c30.21 30.21 81.94 8.7 81.94-33.94v-78.28c146.59 8.54 158.53 50.199 134.18 127.879-13.65 43.56 35.07 78.89 72.19 54.46C537.98 464.768 576 403.8 576 330.05c0-170.37-166.04-197.15-304-201.3V48.047c0-42.72-51.79-64.09-81.94-33.94L14.062 190.06c-18.75 18.74-18.75 49.14 0 67.88zM48 224L224 48v128.03c143.181.63 304 11.778 304 154.02 0 66.96-40 109.95-76.02 133.65C501.44 305.911 388.521 273.88 224 272.09V400L48 224z"></path></svg>
												Reply
											</button>
										</form>
									</div>	
									<?php foreach ($get_reply as $key2 => $value2) { ?>
										<div class="feedVoteWrap">
											<div class="feed-card list">
												<div class="right">
													<div class="feed_card_inner">
														<p><?php echo $value2['answer']; ?></p>
													</div>
													<div class="feed_card_footer">
														<div class="userWrap study-sets">
															<div class="user-name">
																<figure>
																	<img src="<?php echo userImage($value2['created_by']); ?>" alt="user">
																</figure>
																<figcaption><?php echo $value2['nickname']; ?></figcaption>
															</div>
															<p class="date"><?php echo date('d/m/Y', strtotime($value2['created_at'])); ?></p>
														</div>
														<div class="action">
															<ul>
																
																<li>
																<li class="report">
																	<a href="#" class="reportQuestionAnswer" data-toggle="modal" data-target="#reportModal" data-id="<?php echo $value2['id']; ?>">															
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
									<?php } ?>
									
								</div>
							</div>
						<?php } ?>
						
					</div>
				</section>

				<div class="modal fade" id="reportModal" role="dialog">
				    <div class="modal-dialog">
				        <!-- Modal content-->
				        <div class="modal-content">
				          <button type="button" class="close" data-dismiss="modal">&times;</button>
					        <div class="modal-body peers">
					        	<form method="post" action="<?php echo base_url(); ?>account/reportAnswer" onsubmit="return validateReport()">
					          	   <h4>Reason</h4>
						           <div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Reason for Report</label>
												<div class="reason">
													<input type="hidden" name="answer_id" id="answer_id">
													<input type="hidden" name="report_question_id" value="<?= $result['id']; ?>">
													<select class="form-control" id="report_reason" name="report_reason">
														<option value="">Select Reason</option>
														<option value="Inappropriate Content">Inappropriate Content</option>
														<option value="Spam">Spam</option>
														<option value="Promotional">Promotional</option>
														<option value="Uncivil">Uncivil</option>
														<option value="Other">Other</option>
													</select>
													<span class="custom_err" id="err_report_reason"></span>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Reason</label>
												<div class="reason droparea">
													<textarea id="report_description" name="report_description"></textarea>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<button type="submit" class="filterBtn reportBtn">Submit</button>
											</div>
										</div>
									</div>
								</form>
					        </div>
				        </div>
				    </div>
				</div>


				<div class="modal fade" id="confirmationModalBestAnswer" role="dialog">
				    <div class="modal-dialog">
				        <!-- Modal content-->
				        <div class="modal-content">
				          <button type="button" class="close" data-dismiss="modal">&times;</button>
					        <div class="modal-body peers">
					          	   <h4>Confirmation</h4>
						           <div class="row">
						           	 <h6 class="modalText">Are you sure to select this as Best Answer !</h6>
									</div>
									<div class="row">
										<div class="col-md-12">
											<form method="post" action="<?php echo base_url(); ?>account/bestAnswer">
												<div class="form-group button">
													<input type="hidden" name="best_question_id" id="best_question_id" value="<?= $result['id']; ?>">
													<input type="hidden" name="answer_id" id="answer_id">
													<button type="button" class="transparentBtn highlight" data-dismiss="modal">No</button>
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
		function validateAnswer(){
			var answer = $('#definition0').val();
		    if(answer == ''){
		        $('#err_definition0').html("This field is required").show();
		        return false;
		    } else {
		        $('#err_definition0').html("").hide();
		    }
		}

		function validateReply(id){
			var reply = $('#reply_'+id).val();
		    if(reply == ''){
		        $('#err_reply_'+id).html("This field is required").show();
		        return false;
		    } else {
		        $('#err_reply_'+id).html("").hide();
		    }
		}

		function showReplyBox(id){
			$('#reply_box_'+id).show();
		}

		function validateReport(){
			var report_reason = $('#report_reason').val();
		    if(report_reason == ''){
		        $('#err_report_reason').html("This field is required").show();
		        return false;
		    } else {
		        $('#err_report_reason').html("").hide();
		    }
		}

		function voteAnswer(type, answer_id){
			var url = '<?php echo base_url('account/voteAnswer') ?>';
			$.ajax({
		        url: url,
		        type: 'POST',
		        data: {'type': type, 'answer_id': answer_id},
		        success: function(result) {
		            if(type == 'upvote'){
		            	$('#uparrow_'+answer_id+' .normalState').hide();
		            	$('#uparrow_'+answer_id+' .activeState').show();
		            	$('#downarrow_'+answer_id+' .normalState').show();
		            	$('#downarrow_'+answer_id+' .activeState').hide();
		            } else {
		            	$('#downarrow_'+answer_id+' .normalState').hide();
		            	$('#downarrow_'+answer_id+' .activeState').show();
		            	$('#uparrow_'+answer_id+' .normalState').show();
		            	$('#uparrow_'+answer_id+' .activeState').hide();
		            }
		            $('#count_'+answer_id).html(result);
		        }
	      	});
		}

		function voteQuestion(type, question_id){
			var url = '<?php echo base_url('account/voteQuestion') ?>';
			$.ajax({
		        url: url,
		        type: 'POST',
		        data: {'type': type, 'question_id': question_id},
		        success: function(result) {
		            if(type == 'upvote'){
		            	$('#q_uparrow_'+question_id+' .normalState').hide();
		            	$('#q_uparrow_'+question_id+' .activeState').show();
		            	$('#q_downarrow_'+question_id+' .normalState').show();
		            	$('#q_downarrow_'+question_id+' .activeState').hide();
		            } else {
		            	$('#q_downarrow_'+question_id+' .normalState').hide();
		            	$('#q_downarrow_'+question_id+' .activeState').show();
		            	$('#q_uparrow_'+question_id+' .normalState').show();
		            	$('#q_uparrow_'+question_id+' .activeState').hide();
		            }
		            $('#q_count_'+question_id).html(result);
		        }
	      	});
		}

		function removeVoteAnswer(type, answer_id){
			var url = '<?php echo base_url('account/removeVoteAnswer') ?>';
			$.ajax({
		        url: url,
		        type: 'POST',
		        data: {'type': type, 'answer_id': answer_id},
		        success: function(result) {
		            if(type == 'upvote'){
		            	$('#uparrow_'+answer_id+' .normalState').show();
		            	$('#uparrow_'+answer_id+' .activeState').hide();
		            	
		            } else {
		            	$('#downarrow_'+answer_id+' .normalState').show();
		            	$('#downarrow_'+answer_id+' .activeState').hide();
		            	
		            }
		            $('#count_'+answer_id).html(result);
		        }
	      	});
		}

		function removeVoteQuestion(type, question_id){
			var url = '<?php echo base_url('account/removeVoteQuestion') ?>';
			$.ajax({
		        url: url,
		        type: 'POST',
		        data: {'type': type, 'question_id': question_id},
		        success: function(result) {
		            if(type == 'upvote'){
		            	$('#q_uparrow_'+question_id+' .normalState').show();
		            	$('#q_uparrow_'+question_id+' .activeState').hide();
		            	
		            } else {
		            	$('#q_downarrow_'+question_id+' .normalState').show();
		            	$('#q_downarrow_'+question_id+' .activeState').hide();
		            	
		            }
		            $('#q_count_'+question_id).html(result);
		        }
	      	});
		}

		function applySort(val){
			var currentLocation = '<?php echo base_url().'account/questionDetail/'.base64_encode($result['id']); ?>';
			if(val != '') {
				window.location.replace(currentLocation+'?sort-by='+val);
			} else {
				window.location.replace(currentLocation);
			}
		}
	</script>