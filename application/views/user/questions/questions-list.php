<?php  
	if($this->input->get()) { 
		if($this->input->get('search')){
			$course_filter     = $this->input->get('course_search');
	        $professor_filter  = $this->input->get('professor_search');
	        $university_filter = $this->input->get('university_search');
	        $keyword_filter    = $this->input->get('keyword_search');
	        $category_filter   = $this->input->get('category_search');
		} else {
			$course_filter     = $this->input->get('course');
	        $professor_filter  = $this->input->get('professor');
	        $university_filter = $this->input->get('university');
	        $keyword_filter    = $this->input->get('keyword');
	        $category_filter   = $this->input->get('category');
		}
		$text_msg = 'Search result not found.';
    } else {
    	$course_filter = '';
    	$professor_filter = '';
    	$university_filter  = '';
    	$keyword_filter = '';
    	$category_filter = '';
    	$text_msg = 'No records to show.';
    }
?>


<section class="mainContent">
					<div class="studySetWrapper list">
						<div class="header">
							<h4>Q&A</h4>
							<a href="<?php echo base_url(); ?>account/addQuestion">
								<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
									<path d="m463.6,144.9l-142.9-128.7c-3.7-3.3-8.6-5.2-13.7-5.2h-245c-11.3,0-20.4,9.1-20.4,20.4v449.2c0,11.3 9.1,20.4 20.4,20.4h388c11.3,0 20.4-9.1 20.4-20.4v-320.5c0-5.8-2.5-11.3-6.8-15.2zm-140.1-71.2l97.6,87.9h-97.6v-87.9zm106,386.5h-347v-408.4h200.2v130.2c0,11.3 9.1,20.4 20.4,20.4h126.5v257.8z"></path>
									<path d="m119.2,276.4c0,11.3 9.1,20.4 20.4,20.4h232.8c11.3,0 20.4-9.1 20.4-20.4 0-11.3-9.1-20.4-20.4-20.4h-232.8c-11.3,2.84217e-14-20.4,9.1-20.4,20.4z"></path>
									<path d="m372.4,355.6h-232.8c-11.3,0-20.4,9.1-20.4,20.4 0,11.3 9.1,20.4 20.4,20.4h232.8c11.3,0 20.4-9.1 20.4-20.4 5.68434e-14-11.3-9.1-20.4-20.4-20.4z"></path>
								</svg>
								Create New
							</a>
						</div>
						<div class="filterWrapper">
							<form method="get" action="<?php echo base_url(); ?>account/questions">
								<div class="filterSearch">
									<input type="hidden" name="course_search" value="<?= $course_filter; ?>">
									<input type="hidden" name="professor_search" value="<?= $professor_filter; ?>">
									<input type="hidden" name="university_search" value="<?= $university_filter; ?>">
									<input type="hidden" name="category_search" value="<?= $category_filter; ?>">
									<input type="text" placeholder="Search Questions..." name="keyword_search" value="<?= $keyword_filter; ?>">
									<button type="submit" class="searchBtn" name="search" value="search">
										<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 489.713 489.713">
											<path d="M483.4,454.444l-121.3-121.4c28.7-35.2,46-80,46-128.9c0-112.5-91.5-204.1-204.1-204.1S0,91.644,0,204.144
											s91.5,204,204.1,204c48.8,0,93.7-17.3,128.9-46l121.3,121.3c8.3,8.3,20.9,8.3,29.2,0S491.8,462.744,483.4,454.444z M40.7,204.144
											c0-90.1,73.2-163.3,163.3-163.3s163.4,73.3,163.4,163.4s-73.3,163.4-163.4,163.4S40.7,294.244,40.7,204.144z"></path>
										</svg>
									</button>
								</div>
							</form>
							<div class="buttonGroup">
								<button type="button" class="filterBtn"> 
									<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 489.9 489.9">
										<path d="M20.8,96.2h23.7c9,31.4,37.8,54.1,73,54.1s64.8-22.7,73.4-54.1h277.2c11.4,0,21.8-9.4,21.8-20.8s-9.4-20.8-20.8-20.8
											H190.6c-9-31.4-37.8-54.1-73-54.1c-34.4,0-63.8,22.7-73,54.1H20.8C9.4,54.6,0,64,0,75.4C0,86.8,9.4,96.2,20.8,96.2z M117.6,41.1
											c19.8,0,36.4,15.6,35.4,34.3c0,18.7-15.6,34.3-35.4,34.3S82.2,94.1,82.2,75.4S97.8,41.1,117.6,41.1z"></path>
										<path d="M20.8,265.8h277.6c9,31.4,37.8,54.1,73,54.1c34.4,0,63.8-22.7,73-54.1h23.8c11.4,0,20.8-9.4,20.8-20.8
											s-9.4-20.8-20.8-20.8h-23.7c-9-31.4-37.8-54.1-73-54.1c-34.4,0-63.8,22.7-73,54.1H20.8C9.4,224.2,0,233.6,0,245
											S9.4,265.8,20.8,265.8z M371.4,210.7c19.8,0,35.4,15.6,35.4,34.3s-15.6,34.3-35.4,34.3S336,263.7,336,245S351.6,210.7,371.4,210.7
											z"></path>
										<path d="M469.2,392.7H190.3c-9.3-30.8-37.9-53.1-72.7-53.1c-34,0-63.1,22.2-72.7,53.1H20.8C9.4,392.7,0,402.1,0,413.5
											s9.4,20.8,20.8,20.8h23.4c8.6,31.9,37.7,55.1,73.3,55.1s64.7-23.2,73.3-55.1h277.3c11.4,0,21.8-9.4,21.8-20.8
											S480.6,392.7,469.2,392.7z M117.6,448.9c-19.8,0-35.4-15.6-35.4-34.3c0-18.7,15.6-34.3,35.4-34.3s35.4,15.6,35.4,34.3
											C152.9,433.3,137.3,448.9,117.6,448.9z"></path>
									</svg>
									Filter
								</button>
								<div class="sortwrapper">
									<button type="button" class="sortMenu dropdown-toggle" data-toggle = "dropdown">
										<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 489.389 489.389">
											<path d="M261.294,326.102c-8.3-7.3-21.8-6.2-29.1,2.1l-77,86.8v-346.9c0-11.4-9.4-20.8-20.8-20.8s-20.8,9.4-20.8,20.8v346.9
												l-77-86.8c-8.3-8.3-20.8-9.4-29.1-2.1c-8.3,8.3-9.4,20.8-2.1,29.1l113.4,126.9c8.5,10.5,23.5,8.9,30.2,0l114.4-126.9
												C270.694,347.002,269.694,333.402,261.294,326.102z"></path>
											<path d="M483.994,134.702l-112.4-126.9c-10-10.1-22.5-10.7-31.2,0l-114.4,126.9c-7.3,8.3-6.2,21.8,2.1,29.1
												c12.8,10.2,25.7,3.2,29.1-2.1l77-86.8v345.9c0,11.4,9.4,20.8,20.8,20.8s20.8-8.3,20.8-19.8v-346.8l77,86.8
												c8.3,8.3,20.8,9.4,29.1,2.1C490.194,155.502,491.294,143.002,483.994,134.702z"></path>
										</svg>
										Sort
									</button>
									<ul class = "dropdown-menu sort">
						               <!-- <li><a href = "<?php echo base_url(); ?>account/questions?sort-by=active">Active</a></li> -->
						               <li><a href = "<?php echo base_url(); ?>account/questions?sort-by=date">Date</a></li>
						               <li><a href = "<?php echo base_url(); ?>account/questions?sort-by=name">Name</a></li>
						               <li><a href = "<?php echo base_url(); ?>account/questions?sort-by=views">Views</a></li>
						               
						               <li><a href = "<?php echo base_url(); ?>account/questions?sort-by=answers">Answers</a></li>
						               <!-- <li><a href = "<?php echo base_url(); ?>account/questions?sort-by=unanswered">Unanswerd</a></li> -->
						               <!-- <li><a href = "<?php echo base_url(); ?>account/questions?sort-by=unsolved">Unsolved</a></li> -->
						            </ul>
								</div>
								<button type="button" class="sortMenu viewList">
										<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 489 489">
											<path d="M209.1,259.1H20.8C9.4,259.1,0,268.5,0,279.9v188.3C0,479.6,9.4,489,20.8,489h188.3c11.4,0,19.8-9.4,20.8-20.8V279.9
												C229.9,268.4,220.6,259.1,209.1,259.1z M188.3,448.4H40.6V300.7h147.7L188.3,448.4L188.3,448.4z"></path>
											<path d="M209.1,0H20.8C9.4,0,0,9.4,0,20.8v187.3c0,11.4,9.4,20.8,20.8,20.8h188.3c11.4,0,19.8-8.3,20.8-19.8V20.8
												C229.9,9.4,220.6,0,209.1,0z M188.3,188.3H40.6V40.6h147.7L188.3,188.3L188.3,188.3z"></path>
											<path d="M468.2,0H279.9c-11.4,0-20.8,9.4-20.8,20.8v187.3c0,11.4,9.4,20.8,20.8,20.8h188.3c11.4,0,20.8-8.3,20.8-19.8V20.8
												C489,9.4,479.6,0,468.2,0z M448.4,188.3H300.7V40.6h147.7L448.4,188.3L448.4,188.3z"></path>
											<path d="M468.2,259.1H279.9c-11.4,0-20.8,9.4-20.8,20.8v188.3c0,11.4,9.4,20.8,20.8,20.8h188.3c11.4,0,20.8-9.4,20.8-20.8V279.9
												C489,268.4,479.6,259.1,468.2,259.1z M448.4,448.4H300.7V300.7h147.7L448.4,448.4L448.4,448.4z"></path>
										</svg>
										Grid/List
									</button>
							</div>
						</div>
						<div class="filterForm">
							<div class="row">
								<form method="get" action="<?php echo base_url(); ?>account/questions">
									<div class="col-md-12">
										<div class="form-group select select_label">
											<label>Institution</label>
											<input type="hidden" name="keyword" value="<?= $keyword_filter; ?>">
											<select class="form-control" name="university" id="university">
											  <option value="<?= $university['university_id']; ?>"><?= $university['SchoolName']; ?></option>
											</select>
											<span class="custom_err" id="err_university"></span>
										</div>
									</div>
									<div class="col-md-12 courseSelect">
										<div class="form-group select select_label">
											<label>Course</label>
											<select class="form-control" name="course" id="course" onchange="getProfessor(this.value, '<?php echo base_url('account/getProfessor') ?>')">
												<option value="">Select Course</option>
												<?php foreach ($course as $key => $value) { ?>
													<option value="<?= $value['id'] ?>" <?php if($course_filter == $value['id']) { echo "selected"; } ?>><?= $value['name'] ?></option>
												<?php } ?>
											</select>

											<span class="custom_err" id="err_course"></span>
										</div>		
									</div>
									<div class="col-md-12 professorSelect">
										<div class="form-group select select_label">
											<label>Professor</label>
											<select class="form-control" name="professor" id="professor">
												<?php foreach ($professor as $key => $value) { ?>
													<option value="<?= $value['id'] ?>" <?php if($professor_filter == $value['id']) { echo "selected"; } ?>><?= $value['name'] ?></option>
												<?php } ?>
											</select>
											<span class="custom_err" id="err_professor"></span>
										</div>
									</div>
									<div class="col-md-12 professorSelect">
										<div class="form-group select select_label">
											<label>Category</label>
											<select class="form-control" name="category" id="category">
												<option value="">Select Category</option>
												<option value="active" <?php if($category_filter == 'active') { echo "selected"; } ?>>Active</option>
												<option value="unanswered" <?php if($category_filter == 'unanswered') { echo "selected"; } ?>>Unanswerd</option>
												<option value="unsolved" <?php if($category_filter == 'unsolved') { echo "selected"; } ?>>Unsolved</option>
												
											</select>
											<span class="custom_err" id="err_professor"></span>
										</div>
									</div>
									<div class="col-md-12">
										<div class="buttonWrapper">
											<button type="submit" class="btn-all" name="filter_search" value="filter_search">Apply</button>
											<button type="reset" class="btn-all" onclick="location.href='<?php echo base_url(); ?>account/questions'">Clear</button>
										</div>
									</div>
								</form>
							</div>
						</div>
						<?php if($this->session->flashdata('flash_message')) { 
					                  echo $this->session->flashdata('flash_message');
					                }
					    ?>
						<div class="feedWrapper">
							<?php if(!empty($question_list)) {
							 foreach ($question_list as $key => $value) { 
							 	$count_ans = $this->db->get_where($this->db->dbprefix('question_answer_master'), array('question_answer_master.question_id'=>$value['id'], 'question_answer_master.status' => 1, 'question_answer_master.parent_id' => 0))->num_rows(); 
							 	$user_id = $this->session->get_userdata()['user_data']['user_id'];
						 		$chk_user_upvote = $this->db->get_where($this->db->dbprefix('vote_master'), array('reference'=> 'question', 'reference_id'=> $value['id'], 'user_id' => $user_id))->row_array();
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
								<div class="feedVoteWrap">
									<div class="voteCount">
										<div class="uparrow" id="q_uparrow_<?= $value['id']; ?>">
											<svg xmlns="http://www.w3.org/2000/svg"  class="normalState" width="18.363" height="20" viewBox="0 0 18.363 20" onclick="voteQuestion('upvote', '<?php echo $value['id']; ?>')" style="<?php echo $up_normal_q; ?>">
											    <g id="prefix__up-arrow" transform="translate(-31.008 -10.925)">
											        <path id="prefix__Path_1209" d="M37.272 29.256h5.6v-9.1a.83.83 0 0 1 .828-.833h2.828l-6.358-6.387-6.35 6.383h2.62a.83.83 0 0 1 .828.833v9.1zm6.428 1.669h-7.26a.83.83 0 0 1-.828-.833v-9.1H31.82a.844.844 0 0 1-.588-1.424l8.358-8.4a.845.845 0 0 1 1.171 0l8.354 8.4a.823.823 0 0 1-.588 1.424h-4v9.1a.825.825 0 0 1-.827.833z" data-name="Path 1209" />
											    </g>
											</svg>										
											<svg xmlns="http://www.w3.org/2000/svg"  class="activeState" width="18.363" height="20" viewBox="0 0 18.363 20" style="<?php echo $up_active_q; ?>" onclick="removeVoteQuestion('upvote', '<?php echo $value['id']; ?>')">
											    <g id="prefix__Layer_1" transform="translate(-31.008 -10.925)">
											        <g id="prefix__Group_1371" data-name="Group 1371" transform="translate(31.008 10.925)">
											            <path id="prefix__Path_1213" d="M43.7 30.925h-7.26a.83.83 0 0 1-.828-.833v-9.1H31.82a.844.844 0 0 1-.588-1.424l8.358-8.4a.845.845 0 0 1 1.171 0l8.354 8.4a.823.823 0 0 1-.588 1.424h-4v9.1a.825.825 0 0 1-.828.833z" data-name="Path 1213" transform="translate(-31.008 -10.925)" style="fill:#1ae1bd"/>
											        </g>
											    </g>
											</svg>
										</div>
										<div class="count" id="q_count_<?= $value['id']; ?>">
											<?php if($value['vote_count'] < 0) {
												echo "0";
											} else {
												echo $value['vote_count'];
											} ?>
												
										</div>
										<div class="downarrow" id="q_downarrow_<?= $value['id']; ?>">
											<svg xmlns="http://www.w3.org/2000/svg" width="18.363" height="20" class="normalState" viewBox="0 0 18.363 20" onclick="voteQuestion('downvote', '<?php echo $value['id']; ?>')" style="<?php echo $down_normal_q; ?>">
											    <g id="prefix__up-arrow" transform="rotate(180 24.686 15.463)">
											        <path id="prefix__Path_1209" d="M37.272 29.256h5.6v-9.1a.83.83 0 0 1 .828-.833h2.828l-6.358-6.387-6.35 6.383h2.62a.83.83 0 0 1 .828.833v9.1zm6.428 1.669h-7.26a.83.83 0 0 1-.828-.833v-9.1H31.82a.844.844 0 0 1-.588-1.424l8.358-8.4a.845.845 0 0 1 1.171 0l8.354 8.4a.823.823 0 0 1-.588 1.424h-4v9.1a.825.825 0 0 1-.827.833z" data-name="Path 1209" />
											    </g>
											</svg>
											<svg xmlns="http://www.w3.org/2000/svg"  class="activeState" width="18.363" height="20" viewBox="0 0 18.363 20" style="<?php echo $down_active_q; ?>" onclick="removeVoteQuestion('downvote', '<?php echo $value['id']; ?>')">
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
												
												<h5><a href=""><?php echo $value['question_title']; ?></a></h5>
												<div class="badgeList">
													<ul>
														<li class="badge badge1">
															<?php echo $value['SchoolName']; ?>
														</li>
														<li class="badge badge2">
															<?php echo $value['course']; ?>
														</li>
														<li class="badge badge3">
															<?php echo $value['professor']; ?>
														</li>
													</ul>
												</div>
												<div class="timeperiod">
													<ul>
														<li>
															<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M448 0H64C28.7 0 0 28.7 0 64v288c0 35.3 28.7 64 64 64h96v84c0 7.1 5.8 12 12 12 2.4 0 4.9-.7 7.1-2.4L304 416h144c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64zm16 352c0 8.8-7.2 16-16 16H288l-12.8 9.6L208 428v-60H64c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16h384c8.8 0 16 7.2 16 16v288zm-96-216H144c-8.8 0-16 7.2-16 16v16c0 8.8 7.2 16 16 16h224c8.8 0 16-7.2 16-16v-16c0-8.8-7.2-16-16-16zm-96 96H144c-8.8 0-16 7.2-16 16v16c0 8.8 7.2 16 16 16h128c8.8 0 16-7.2 16-16v-16c0-8.8-7.2-16-16-16z"></path></svg> <?php echo $count_ans; ?> Answers
														</li>
														<li>
															<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
															  <path d="m497.6,244.7c-63.9-96.7-149.7-150-241.6-150-91.9,1.42109e-14-177.7,53.3-241.6,150-4.5,6.8-4.5,15.7 0,22.5 63.9,96.7 149.7,150 241.6,150 91.9,0 177.7-53.3 241.6-150 4.5-6.8 4.5-15.6 0-22.5zm-241.6,131.7c-74.2,0-144.8-42.6-199.9-120.4 55-77.8 125.6-120.4 199.9-120.4 74.2,0 144.8,42.6 199.9,120.4-55.1,77.8-125.6,120.4-199.9,120.4z"></path>
															  <path d="m256,148.5c-59.3,0-107.5,48.2-107.5,107.5 0,59.3 48.2,107.5 107.5,107.5s107.5-48.2 107.5-107.5c0-59.3-48.2-107.5-107.5-107.5zm0,175.5c-36.8,0-66.8-30.5-66.8-68 0-37.5 30-68 66.8-68 36.8,0 66.8,30.5 66.8,68 0,37.5-30,68-66.8,68z"></path>
															</svg> <?php echo $value['view_count']; ?> Views
														</li>
														<li>
															<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 501.333 501.333">
																<path d="M250.667,0C112,0,0,112,0,250.667s112,250.667,250.667,250.667s250.667-112,250.667-250.667S389.333,0,250.667,0z
																M250.667,459.733c-115.2,0-209.067-93.867-209.067-209.067S135.467,41.6,250.667,41.6s209.067,93.867,209.067,209.067
																S365.867,459.733,250.667,459.733z"></path>
																<path d="M314.667,229.333H272V129.067c0-11.733-9.6-21.333-21.333-21.333c-11.733,0-21.333,9.6-21.333,21.333v121.6
																c0,11.733,9.6,21.333,21.333,21.333h64C326.4,272,336,262.4,336,250.667C336,238.933,326.4,229.333,314.667,229.333z"></path>
															</svg>  <?php echo date('M d, Y', strtotime($value['created_at'])); ?>
														</li>
													</ul>
												</div>
											</div>
											<div class="feed_card_footer">
												<div class="userWrap study-sets">
													<div class="user-name">
														<figure>
															<img src="<?php echo userImage($value['created_by']); ?>" alt="user">
														</figure>
														<a href="<?php echo base_url().'Profile/friends?profile_id='.$value['created_by'] ?>"><figcaption><?php echo $value['nickname']; ?></figcaption></a>
													</div>
													<div class="edit">
														<a href="<?php echo base_url(); ?>account/editQuestion/<?php echo base64_encode($value['id']); ?>">
															<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
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
															</svg> Edit
														</a>
													</div>			
													<div class="delete">
														<a data-toggle="modal" data-target="#confirmationModal" data-id="<?= $value['id']; ?>" class="question_delete_event">										
															<svg height="512pt" viewBox="-57 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">
																<path d="m156.371094 30.90625h85.570312v14.398438h30.902344v-16.414063c.003906-15.929687-12.949219-28.890625-28.871094-28.890625h-89.632812c-15.921875 0-28.875 12.960938-28.875 28.890625v16.414063h30.90625zm0 0"></path><path d="m344.210938 167.75h-290.109376c-7.949218 0-14.207031 6.78125-13.566406 14.707031l24.253906 299.90625c1.351563 16.742188 15.316407 29.636719 32.09375 29.636719h204.542969c16.777344 0 30.742188-12.894531 32.09375-29.640625l24.253907-299.902344c.644531-7.925781-5.613282-14.707031-13.5625-14.707031zm-219.863282 312.261719c-.324218.019531-.648437.03125-.96875.03125-8.101562 0-14.902344-6.308594-15.40625-14.503907l-15.199218-246.207031c-.523438-8.519531 5.957031-15.851562 14.472656-16.375 8.488281-.515625 15.851562 5.949219 16.375 14.472657l15.195312 246.207031c.527344 8.519531-5.953125 15.847656-14.46875 16.375zm90.433594-15.421875c0 8.53125-6.917969 15.449218-15.453125 15.449218s-15.453125-6.917968-15.453125-15.449218v-246.210938c0-8.535156 6.917969-15.453125 15.453125-15.453125 8.53125 0 15.453125 6.917969 15.453125 15.453125zm90.757812-245.300782-14.511718 246.207032c-.480469 8.210937-7.292969 14.542968-15.410156 14.542968-.304688 0-.613282-.007812-.921876-.023437-8.519531-.503906-15.019531-7.816406-14.515624-16.335937l14.507812-246.210938c.5-8.519531 7.789062-15.019531 16.332031-14.515625 8.519531.5 15.019531 7.816406 14.519531 16.335937zm0 0"></path><path d="m397.648438 120.0625-10.148438-30.421875c-2.675781-8.019531-10.183594-13.429687-18.640625-13.429687h-339.410156c-8.453125 0-15.964844 5.410156-18.636719 13.429687l-10.148438 30.421875c-1.957031 5.867188.589844 11.851562 5.34375 14.835938 1.9375 1.214843 4.230469 1.945312 6.75 1.945312h372.796876c2.519531 0 4.816406-.730469 6.75-1.949219 4.753906-2.984375 7.300781-8.96875 5.34375-14.832031zm0 0"></path>
															</svg> Delete
														</a>
													</div>	
													<div class="edit">
														<a data-toggle="modal" data-target="#peersMessageModal">
															<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
																<path d="M319.4,85.8c0,2.9,0.1,5.7,0.4,8.6l-140.7,76.7c-19-19.8-45.6-32.2-75.1-32.2c-57.2,0-104,46.8-104,104s46.8,104,104,104
																	c30.7,0,58.5-13.5,77.6-34.9l139.2,76.8c-0.9,5-1.4,10.1-1.4,15.4c0,46.8,38.5,85.3,85.3,85.3c46.8,0,85.3-38.5,85.3-85.3
																	s-38.5-85.3-85.3-85.3c-26.8,0-50.9,12.6-66.5,32.2l-135.6-74.8c3.6-10.5,5.5-21.7,5.5-33.4c0-13-2.4-25.4-6.8-36.9l132.5-73
																	c15.4,22.9,41.5,38.1,70.9,38.1c46.8,0,85.3-38.5,85.3-85.3S451.5,0.5,404.7,0.5S319.4,39,319.4,85.8z M449.4,404.2
																	c0,25-19.8,44.7-44.7,44.7S360,429.1,360,404.2c0-25,19.8-44.7,44.7-44.7S449.4,379.2,449.4,404.2z M104,305.3
																	c-34.3,0-62.4-28.1-62.4-62.4s28.1-62.4,62.4-62.4s62.4,28.1,62.4,62.4C166.5,277.3,138.4,305.3,104,305.3z M449.4,85.8
																	c0,25-19.8,44.7-44.7,44.7S360,110.7,360,85.8c0-25,19.8-44.7,44.7-44.7S449.4,60.9,449.4,85.8z"></path>
															</svg> Share
														</a>
													</div>	
												</div>
												<div class="action">
														<div class="action_button">
															<a href="<?php echo base_url(); ?>account/questionDetail/<?php echo base64_encode($value['id']) ?>">
																<svg class="sp-icon sp-icon--rotate-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
																	<path d="M481.3,110.1c-11.6-11.6-30.4-11.6-42.1,0L245,304.4L50.8,110.2c-11.6-11.6-30.4-11.6-42.1,0c-11.6,11.6-11.6,30.4,0,42.1
																		l236.4,236.4l236.2-236.4C492.9,140.6,492.9,121.7,481.3,110.1z"></path>
																</svg>
														</div>
													</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php } } else {
								echo '<p class="text-center">'.$text_msg.'</p>';
							} ?>
							
						</div>
						<?php if(!empty($question_list)) { ?>
							<div class="loadMoreWrapper">
								<button type="button"> You've reached the end!</button>
							</div>	
						<?php } ?>
					</div>
				</section>


				<div class="modal fade" id="confirmationModal" role="dialog">
				    <div class="modal-dialog">
				        <!-- Modal content-->
				        <div class="modal-content">
				          <button type="button" class="close" data-dismiss="modal">&times;</button>
					        <div class="modal-body peers">
					          	   <h4>Confirmation</h4>
						           <div class="row">
						           	 <h6 class="modalText">Are you sure to delete this Question !</h6>
									</div>
									<div class="row">
										<div class="col-md-12">
											<form method="post" action="<?php echo base_url(); ?>account/deleteQuestion">
												<div class="form-group button">
													<input type="hidden" name="question_id" id="question_id">
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

	</script>

	<script type="text/javascript">
		function getProfessor(course, url){
	        
	        if(course != '') {

	          $.ajax({
	              url: url,
	              type: 'POST',
	              data: {'course': course},
	              success: function(result) {
	                  $('#professor').html(result);
	              }
	          });
	        } else {
	          $('#professor').html('');
	        }
	    }
	</script>