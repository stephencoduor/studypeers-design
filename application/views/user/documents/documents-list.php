<?php  $user_id = $this->session->get_userdata()['user_data']['user_id'];
	if($this->input->get()) { 
		if($this->input->get('search')){
			$course_filter     = $this->input->get('course_search');
	        $professor_filter  = $this->input->get('professor_search');
	        $university_filter = $this->input->get('university_search');
	        $keyword_filter    = $this->input->get('keyword_search');
		} else {
			$course_filter     = $this->input->get('course');
	        $professor_filter  = $this->input->get('professor');
	        $university_filter = $this->input->get('university');
	        $keyword_filter    = $this->input->get('keyword');
		}
		$text_msg = 'Search result not found.';
    } else {
    	$course_filter = '';
    	$professor_filter = '';
    	$university_filter  = '';
    	$keyword_filter = '';
    	$text_msg = 'No records to show.';
    }
?>

<section class="mainContent">
					<div class="studySetWrapper list">
						<div class="header">
							<h4>Documents</h4>
							<a href="<?php echo base_url(); ?>account/addDocument">
								<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
									<path d="m463.6,144.9l-142.9-128.7c-3.7-3.3-8.6-5.2-13.7-5.2h-245c-11.3,0-20.4,9.1-20.4,20.4v449.2c0,11.3 9.1,20.4 20.4,20.4h388c11.3,0 20.4-9.1 20.4-20.4v-320.5c0-5.8-2.5-11.3-6.8-15.2zm-140.1-71.2l97.6,87.9h-97.6v-87.9zm106,386.5h-347v-408.4h200.2v130.2c0,11.3 9.1,20.4 20.4,20.4h126.5v257.8z"></path>
									<path d="m119.2,276.4c0,11.3 9.1,20.4 20.4,20.4h232.8c11.3,0 20.4-9.1 20.4-20.4 0-11.3-9.1-20.4-20.4-20.4h-232.8c-11.3,2.84217e-14-20.4,9.1-20.4,20.4z"></path>
									<path d="m372.4,355.6h-232.8c-11.3,0-20.4,9.1-20.4,20.4 0,11.3 9.1,20.4 20.4,20.4h232.8c11.3,0 20.4-9.1 20.4-20.4 5.68434e-14-11.3-9.1-20.4-20.4-20.4z"></path>
								</svg>
								Create New
							</a>
						</div>
							<form method="get" action="<?php echo base_url(); ?>account/documents">
        						<div class="filterWrapper">
        								<div class="filterSearch">
        									<input type="hidden" name="course_search" value="<?= $course_filter; ?>">
        									<input type="hidden" name="professor_search" value="<?= $professor_filter; ?>">
        									<input type="hidden" name="university_search" value="<?= $university_filter; ?>">
        									<input type="text" placeholder="Search Documents..." name="keyword_search" value="<?= $keyword_filter; ?>">
        									<button type="submit" class="searchBtn" name="search" value="search">
        										<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 489.713 489.713">
        											<path d="M483.4,454.444l-121.3-121.4c28.7-35.2,46-80,46-128.9c0-112.5-91.5-204.1-204.1-204.1S0,91.644,0,204.144
        											s91.5,204,204.1,204c48.8,0,93.7-17.3,128.9-46l121.3,121.3c8.3,8.3,20.9,8.3,29.2,0S491.8,462.744,483.4,454.444z M40.7,204.144
        											c0-90.1,73.2-163.3,163.3-163.3s163.4,73.3,163.4,163.4s-73.3,163.4-163.4,163.4S40.7,294.244,40.7,204.144z"></path>
        										</svg>
        									</button>
        								</div>
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
        						               <li><a href = "<?php echo base_url(); ?>account/documents?sort-by=date">Date</a></li>
        						               <li><a href = "<?php echo base_url(); ?>account/documents?sort-by=name">Name</a></li>
        						            </ul>
        								</div>
        								<button type="button" class="sortMenu viewList hide-in-mobile">
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
        						<div class="filterForm collapse">
        							<div class="row">
        								<form method="get" action="<?php echo base_url(); ?>account/documents">
        									<div class="col-md-12">
        										<div class="form-group select select_label">
        											<label>Institution</label>
        											<input type="hidden" name="keyword" value="<?= $keyword_filter; ?>">
        											<select class="form-control " name="university" id="university">
        											  <option value="<?= $university['university_id']; ?>"><?= $university['SchoolName']; ?></option>
        											</select>
        											<span class="custom_err" id="err_university"></span>
        										</div>
        									</div>
        									<div class="col-md-12 courseSelect">
        										<div class="form-group select select_label">
        											<label>Course</label>
        											<select class="form-control " name="course" id="course" onchange="getProfessor(this.value, '<?php echo base_url('account/getProfessor') ?>')">
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
        											<select class="form-control " name="professor" id="professor">
        												<?php foreach ($professor as $key => $value) { ?>
        													<option value="<?= $value['id'] ?>" <?php if($professor_filter == $value['id']) { echo "selected"; } ?>><?= $value['name'] ?></option>
        												<?php } ?>
        											</select>
        											<span class="custom_err" id="err_professor"></span>
        										</div>
        									</div>
        									<div class="col-md-12">
        										<div class="buttonWrapper">
        											<button type="submit" class="btn-all" name="filter_search" value="filter_search">Apply</button>
        											<button type="reset" class="btn-all" onclick="location.href='<?php echo base_url(); ?>account/documents'">Clear</button>
        										</div>
        									</div>
        								</form>
        							</div>
        						</div>
        					</form>
						<?php if($this->session->flashdata('flash_message')) { 
					                  echo $this->session->flashdata('flash_message');
					                }
					         ?>
						<div class="feedWrapper">
							<?php if(!empty($document_list)) {
									foreach ($document_list as $key => $value) { 
								$userfile_name = $value['featured_image'];
								$extn = substr($userfile_name, strrpos($userfile_name, '.')+1); 
								if($extn == 'docx' || $extn == 'doc') { 
									$urlI = base_url().'assets/images/document.svg';
									$type = "Word Doc";
								} else if($extn == 'pdf') { 
									$urlI = base_url().'assets/images/document.svg';
									$type = "PDF";
								} else if($extn == 'ppt' || $extn == 'pptx') { 
									$urlI = base_url().'assets/images/document.svg';
									$type = "Powerpoint";
								} else if($extn == 'xls' || $extn == 'xlsx') { 
									$urlI = base_url().'assets/images/document.svg';
									$type = "Excel";
								} else { 
									$urlI = base_url().'uploads/users/'.$value['featured_image'];
									$type = "Image";
								}
								$user_id = $this->session->get_userdata()['user_data']['user_id'];
								$chk_if_liked = $this->db->get_where('document_like_master', array('doc_id' => $value['id'], 'user_id' => $user_id))->num_rows();
								$this->db->select('AVG(rating) as average');
							    $this->db->where('document_id', $value['id']);
							    $this->db->from('document_rating_master');
							    $rating = $this->db->get()->row_array();

							    $rating_count = $this->db->get_where('document_rating_master', array('document_id' => $value['id']))->num_rows();
							?>
								
								<div class="feedVoteWrap">
								<div class="feed-card list" id="doc_id_div_<?= $value['id']; ?>">
									<div class="left">
										<figure>
											<img src="<?php echo $urlI; ?>" alt="Study Set List">
										</figure>
									</div>
									<div class="right">
										<div class="feed_card_inner">
											<div class="header listHeader">
												<p><?php  echo $type;  ?></p>
												<div class="my-rating-4" data-rating="<?= round($rating['average'], 1) ?>">
													<span><?= $rating_count; ?></span>
												</div>
											</div>
											<h5><a href="<?php echo base_url(); ?>account/documentDetail/<?php echo base64_encode($value['id']) ?>"><?php echo $value['document_name']; ?></a></h5>
											<div class="badgeList">
												<ul>
													<li class="badge badge1">
														<?php echo $value['SchoolName']; ?>
													</li>
													<li class="badge badge2">
														<?php echo $value['professor']; ?>
													</li>
													<li class="badge badge3">
														<?php echo $value['course']; ?>
													</li>
												</ul>
											</div>
											<div class="timeperiod">
												<div class="timeDetail">
													<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
														<path d="M110.3,247.8h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
															c-16.8,0-30.5-13.6-30.5-30.5l0,0C79.9,261.4,93.5,247.8,110.3,247.8z"></path>
														<path d="M227.4,247.8h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
															c-16.8,0-30.5-13.6-30.5-30.5l0,0C197,261.4,210.6,247.8,227.4,247.8z"></path>
														<path d="M344.5,247.8h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
															c-16.8,0-30.5-13.6-30.5-30.5l0,0C314.1,261.4,327.7,247.8,344.5,247.8z"></path>
														<path d="M110.3,339.6h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
															c-16.8,0-30.5-13.6-30.5-30.5l0,0C79.9,353.3,93.5,339.6,110.3,339.6z"></path>
														<path d="M227.4,339.6h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
															c-16.8,0-30.5-13.6-30.5-30.5l0,0C197,353.3,210.6,339.6,227.4,339.6z"></path>
														<path d="M344.5,339.6h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
															c-16.8,0-30.5-13.6-30.5-30.5l0,0C314.1,353.3,327.7,339.6,344.5,339.6z"></path>
														<path d="M469.2,45.6h-82.1V21.7c0-11.5-9.3-20.8-20.8-20.8c-11.5,0-20.8,9.3-20.8,20.8v24H143.6v-24
															c0-11.5-9.3-20.8-20.8-20.8s-20.8,9.3-20.8,20.8v24H20.8C9.3,45.7,0,54.9,0,66.4v402.5c0,11.5,9.3,20.7,20.8,20.8h447.4
															c11.5-0.3,20.9-9.3,21.9-20.8V66.4C490,54.9,480.7,45.6,469.2,45.6z M448.3,449.3H40.5V197.5h407.8V449.3z M448.3,155.9H40.5V87.3
															h61.4V105c-0.3,11.5,8.8,21,20.3,21.3s21-8.8,21.3-20.3l0,0V87.2h201.9v17.7c0,11.5,9.3,20.7,20.8,20.8c11-0.3,19.9-8.8,20.8-19.8
															V87.2h61.3v68.6V155.9z"></path>
													</svg> <?php echo date('M d, Y', strtotime($value['created_at'])); ?>
												</div>
												<div class="socialAction">
													<ul>
														<!-- <li class="likecountDoc">
															
															<a href="javascript:void(0)" data-id="<?php echo $value['id']; ?>">
																<?php if($chk_if_liked == 0) { ?>
																	<i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
																<?php } else { ?>
																	<i class="fa fa-thumbs-up" aria-hidden="true"></i>
																<?php } ?>
																<span id="likeCount_<?php echo $value['id']; ?>"><?php echo $value['likeCount']; ?></span>
															</a>
														</li> -->
														<li>
															<a href="javascript:void(0)"  data-toggle="modal" data-target="#peersModal">
																<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
																	 viewBox="0 0 482.202 482.202" style="enable-background:new 0 0 482.202 482.202;" xml:space="preserve">
																		<g>
																			<g>
																				<path d="M434.478,356.53c-5.977-1.794-12.185-2.705-18.426-2.702c-22.405,0.036-43.159,11.784-54.72,30.976l-237.176-121.2
																					c5.122-13.858,5.196-29.077,0.208-42.984l238.504-119.256c19.842,29.964,60.218,38.169,90.182,18.327
																					c29.964-19.842,38.169-60.219,18.327-90.182c-19.842-29.964-60.219-38.169-90.182-18.327
																					c-24.864,16.465-35.353,47.724-25.455,75.854L117.237,206.292c-19.624-29.398-59.365-37.321-88.763-17.697
																					C-0.924,208.22-8.847,247.96,10.777,277.358c19.624,29.398,59.365,37.321,88.763,17.697c6.834-4.562,12.725-10.397,17.353-17.187
																					l237.888,121.56c-10.162,33.854,9.044,69.536,42.898,79.698c33.854,10.162,69.536-9.044,79.698-42.898
																					C487.538,402.374,468.332,366.692,434.478,356.53z M416.052,17.828c26.51,0,48,21.49,48,48s-21.49,48-48,48
																					c-26.51,0-48-21.49-48-48C368.079,39.329,389.554,17.855,416.052,17.828z M64.053,289.828c-26.51,0-48-21.49-48-48
																					c0-26.51,21.49-48,48-48s48,21.49,48,48C112.026,268.327,90.551,289.802,64.053,289.828z M416.052,465.828
																					c-26.51,0-48-21.49-48-48c0-26.51,21.49-48,48-48c26.51,0,48,21.49,48,48C464.026,444.327,442.551,465.802,416.052,465.828z"/>
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
																</svg> <span id="share_count_<?= $value['id']; ?>"><?php echo $value['shareCount']; ?></span>
															</a>
														</li>
													</ul>
												</div>
											</div>
										</div>
										<div class="feed_card_footer">
											<div class="userWrap study-sets">
												<div class="user-name">
													<figure>
														<img src="<?php echo userImage($value['created_by']); ?>" alt="user">
													</figure>
													<?php  $user_name = $this->db->get_where('user', array('id' => $value['created_by']))->row_array(); ?>
													<a href="<?php echo base_url().'sp/'.$user_name['username'] ?>"><figcaption><?php echo $value['nickname']; ?></figcaption></a>
												</div>
												<div class="basic-action">
													<?php if($value['created_by'] == $user_id) { ?>
													<div class="edit">
														<a href="<?php echo base_url(); ?>account/editDocument/<?php echo base64_encode($value['id']) ?>">
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
														<a data-toggle="modal" data-target="#confirmationModal" data-id="<?= $value['id']; ?>" class="doc_delete_event">										
															<svg height="512pt" viewBox="-57 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">
																<path d="m156.371094 30.90625h85.570312v14.398438h30.902344v-16.414063c.003906-15.929687-12.949219-28.890625-28.871094-28.890625h-89.632812c-15.921875 0-28.875 12.960938-28.875 28.890625v16.414063h30.90625zm0 0"></path><path d="m344.210938 167.75h-290.109376c-7.949218 0-14.207031 6.78125-13.566406 14.707031l24.253906 299.90625c1.351563 16.742188 15.316407 29.636719 32.09375 29.636719h204.542969c16.777344 0 30.742188-12.894531 32.09375-29.640625l24.253907-299.902344c.644531-7.925781-5.613282-14.707031-13.5625-14.707031zm-219.863282 312.261719c-.324218.019531-.648437.03125-.96875.03125-8.101562 0-14.902344-6.308594-15.40625-14.503907l-15.199218-246.207031c-.523438-8.519531 5.957031-15.851562 14.472656-16.375 8.488281-.515625 15.851562 5.949219 16.375 14.472657l15.195312 246.207031c.527344 8.519531-5.953125 15.847656-14.46875 16.375zm90.433594-15.421875c0 8.53125-6.917969 15.449218-15.453125 15.449218s-15.453125-6.917968-15.453125-15.449218v-246.210938c0-8.535156 6.917969-15.453125 15.453125-15.453125 8.53125 0 15.453125 6.917969 15.453125 15.453125zm90.757812-245.300782-14.511718 246.207032c-.480469 8.210937-7.292969 14.542968-15.410156 14.542968-.304688 0-.613282-.007812-.921876-.023437-8.519531-.503906-15.019531-7.816406-14.515624-16.335937l14.507812-246.210938c.5-8.519531 7.789062-15.019531 16.332031-14.515625 8.519531.5 15.019531 7.816406 14.519531 16.335937zm0 0"></path><path d="m397.648438 120.0625-10.148438-30.421875c-2.675781-8.019531-10.183594-13.429687-18.640625-13.429687h-339.410156c-8.453125 0-15.964844 5.410156-18.636719 13.429687l-10.148438 30.421875c-1.957031 5.867188.589844 11.851562 5.34375 14.835938 1.9375 1.214843 4.230469 1.945312 6.75 1.945312h372.796876c2.519531 0 4.816406-.730469 6.75-1.949219 4.753906-2.984375 7.300781-8.96875 5.34375-14.832031zm0 0"></path>
															</svg> Delete
														</a>
													</div>	
													<?php if($value['privacy'] == 2) { ?>
														<div class="edit shareDocument" data-id="<?= $value['id']; ?>">

															<a data-toggle="modal" data-target="#peersModalShare">
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
													<?php } ?>
													<?php } else { ?>
														<div class="delete removeSharedDoc" data-id="<?php echo $value['id'];?>">
															<a data-toggle="modal" data-target="#confirmationModalRemove">										
																<svg height="512pt" viewBox="-57 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">
																	<path d="m156.371094 30.90625h85.570312v14.398438h30.902344v-16.414063c.003906-15.929687-12.949219-28.890625-28.871094-28.890625h-89.632812c-15.921875 0-28.875 12.960938-28.875 28.890625v16.414063h30.90625zm0 0"></path><path d="m344.210938 167.75h-290.109376c-7.949218 0-14.207031 6.78125-13.566406 14.707031l24.253906 299.90625c1.351563 16.742188 15.316407 29.636719 32.09375 29.636719h204.542969c16.777344 0 30.742188-12.894531 32.09375-29.640625l24.253907-299.902344c.644531-7.925781-5.613282-14.707031-13.5625-14.707031zm-219.863282 312.261719c-.324218.019531-.648437.03125-.96875.03125-8.101562 0-14.902344-6.308594-15.40625-14.503907l-15.199218-246.207031c-.523438-8.519531 5.957031-15.851562 14.472656-16.375 8.488281-.515625 15.851562 5.949219 16.375 14.472657l15.195312 246.207031c.527344 8.519531-5.953125 15.847656-14.46875 16.375zm90.433594-15.421875c0 8.53125-6.917969 15.449218-15.453125 15.449218s-15.453125-6.917968-15.453125-15.449218v-246.210938c0-8.535156 6.917969-15.453125 15.453125-15.453125 8.53125 0 15.453125 6.917969 15.453125 15.453125zm90.757812-245.300782-14.511718 246.207032c-.480469 8.210937-7.292969 14.542968-15.410156 14.542968-.304688 0-.613282-.007812-.921876-.023437-8.519531-.503906-15.019531-7.816406-14.515624-16.335937l14.507812-246.210938c.5-8.519531 7.789062-15.019531 16.332031-14.515625 8.519531.5 15.019531 7.816406 14.519531 16.335937zm0 0"></path><path d="m397.648438 120.0625-10.148438-30.421875c-2.675781-8.019531-10.183594-13.429687-18.640625-13.429687h-339.410156c-8.453125 0-15.964844 5.410156-18.636719 13.429687l-10.148438 30.421875c-1.957031 5.867188.589844 11.851562 5.34375 14.835938 1.9375 1.214843 4.230469 1.945312 6.75 1.945312h372.796876c2.519531 0 4.816406-.730469 6.75-1.949219 4.753906-2.984375 7.300781-8.96875 5.34375-14.832031zm0 0"></path>
																</svg> Remove/ Hide
															</a>
														</div>	
													<?php } ?>
												</div>
											</div>
											<div class="action">
													<!-- <div class="action_button">
														<a href="qa-detail.html">
															<svg class="sp-icon sp-icon--rotate-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
																<path d="M481.3,110.1c-11.6-11.6-30.4-11.6-42.1,0L245,304.4L50.8,110.2c-11.6-11.6-30.4-11.6-42.1,0c-11.6,11.6-11.6,30.4,0,42.1
																	l236.4,236.4l236.2-236.4C492.9,140.6,492.9,121.7,481.3,110.1z"></path>
															</svg>
														</a>
													</div> -->
													<a type="button" class="filterBtn download" href="<?php echo base_url(); ?>uploads/users/<?php echo $value['featured_image']; ?>" download> 
														<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
															<path d="M480.6,364.5c-11.3,0-20.4,9.1-20.4,20.4v75.2H51.8V385c0-11.3-9.1-20.4-20.4-20.4c-11.3,0-20.4,9.1-20.4,20.4v95.6    c0,11.3,9.1,20.4,20.4,20.4h449.2c11.3,0,20.4-9.1,20.4-20.4V385C501,373.7,491.9,364.5,480.6,364.5L480.6,364.5z"></path>
															<path d="m197.2,235v-183h109.7v182.2h67.6l-118.9,118.9-118.1-118.1h59.7zm46.4,164.1c6.7,6.7 17.4,6.7 24.1,0l176.8-176.8c10.7-10.7 3.1-29.1-12.1-29.1h-84.4v-165.2c0-9.4-7.6-17-17-17h-157.8c-9.4,0-17,7.6-17,17v166h-76.6c-15.2,0-22.8,18.4-12.1,29.1l176.1,176z"></path>
														</svg>
														Download
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
						<?php if(!empty($document_list)) { ?>
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
						           	 <h6 class="modalText">Are you sure to delete this Document !</h6>
									</div>
									<div class="row">
										<div class="col-md-12">
											<form method="post" action="<?php echo base_url(); ?>account/deleteDocument">
												<div class="form-group button">
													<input type="hidden" name="document_id" id="doc_id">
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


				<div class="modal fade" id="peersModalShare" role="dialog">
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
				          		<!-- <a class="transAction">Share All</a> -->
				          	</div>
				          	<input type="hidden" id="share_document">
				          	<div class="listUserWrap" id="shareList">
				          		
				          	</div>
				          </div>
				        </div>
				      </div>
				    </div>
				</div>

<div class="modal fade" id="confirmationModalRemove" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <div class="modal-body peers">
	          	   <h4>Confirmation</h4>
		           <div class="row">
		           	 <h6 class="modalText">Are you sure to remove/hide this Document !</h6>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group button">
								<input type="hidden" name="remove_doc_id" id="remove_doc_id">
								<button data-dismiss="modal" class="transparentBtn highlight">No</button>
								<button type="button" class="filterBtn" onclick="removeDoc()">Yes</button>
							</div>
						</div>
					</div>
	        </div>
        </div>
    </div>
</div>
				


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

    function removeDoc() 
	{
		var ss_id = $("#remove_doc_id").val();
		if(ss_id != ''){
			$.ajax({
				url : '<?php echo base_url();?>account/removeSharedDoc',
				type : 'post',
				data : {"id" : ss_id},
				success:function(result) {
					$("#confirmationModalRemove").modal('hide');
					$("#doc_id_div_"+ss_id).remove();
					$("#remove_doc_id").val('');
				}	
			})
		}
	}

    function shareToPeer(peer_id){
		var share_document = $('#share_document').val();

		$.ajax({
			url : '<?php echo base_url();?>account/shareToPeerDocument',
			type : 'post',
			data : {"id" : share_document, 'peer_id': peer_id},
			success:function(result) {
				$('#share_count_'+share_document).html(result);
				$("#action_"+peer_id).html('<button type="button" class="like" onclick="unshareToPeer('+peer_id+')">shared</button>');
				// $("#share_studyset").val('');
			}	
		})
	}

	function unshareToPeer(peer_id){
		var share_document = $('#share_document').val();

		$.ajax({
			url : '<?php echo base_url();?>account/unshareToPeerDocument',
			type : 'post',
			data : {"id" : share_document, 'peer_id': peer_id},
			success:function(result) {
				$('#share_count_'+share_document).html(result);
				$("#action_"+peer_id).html('<button type="button" class="like" onclick="shareToPeer('+peer_id+')">share</button>');
				// $("#share_studyset").val('');
			}
		})
	}

    $(document).on('click','.shareDocument',function(){
		var share_id = $(this).data('id');
		$("#share_document").val(share_id);
		$.ajax({
			url : '<?php echo base_url();?>account/getPeerToShare',
			type : 'post',
			data : {"id" : share_id},
			success:function(result) {
				
				$('#shareList').html(result);
			}
		})

	});

	$(document).on('click','.removeSharedDoc',function(){
		var delete_id = $(this).data('id');
		$("#remove_doc_id").val(delete_id);

	});

</script>