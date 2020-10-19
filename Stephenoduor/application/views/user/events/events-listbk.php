<?php if($this->input->get()) { 
            
        $startdate_search  = $this->input->get('start-date');
        $course_search     = $this->input->get('course');
        $professor_search  = $this->input->get('professor');
        $keyword_search    = $this->input->get('keyword');
    } else {
    	$startdate_search  = '';
        $course_search     = '';
        $professor_search  = '';
        $keyword_search    = '';
    }
 ?>
			
				<section class="mainContent">
						<div class="scheduleWrapper">
							<div class="header">
								<h4>Events</h4>
								<div class="buttonGroup">
									<a class="filterBtn"> 
										<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
											<path d="M469.2,45.9h-82.1V22c0-11.5-9.3-20.8-20.8-20.8s-20.8,9.3-20.8,20.8v24H143.6V22c0-11.5-9.3-20.8-20.8-20.8
												c-11.5,0-20.8,9.3-20.8,20.8v24H20.8C9.3,46,0,55.3,0,66.8v402.5C0,480.7,9.3,490,20.8,490h447.4c11.5-0.3,20.9-9.3,21.9-20.8V66.8
												C490,55.3,480.7,46,469.2,45.9z M448.4,449.6H40.5V197.9h407.8V449.6z M448.4,156.3H40.5V87.7h61.4v17.7c-0.3,11.5,8.8,21,20.3,21.3
												c11.5,0.3,21-8.8,21.3-20.3V87.7h201.9v17.7c0,11.5,9.3,20.7,20.8,20.8c11-0.3,19.9-8.8,20.8-19.8V87.7h61.3
												C448.4,87.7,448.4,156.3,448.4,156.3z"></path>
											<path d="M230.7,400.3c-5.3,0-10.5-2.1-14.2-5.9l-66.1-66.1c-7.8-7.9-7.6-20.7,0.3-28.4c7.8-7.6,20.3-7.6,28.1,0
												l51.9,51.9l114.7-114.7c7.9-7.8,20.7-7.6,28.4,0.3c7.6,7.8,7.6,20.3,0,28.1L244.9,394.4C241.2,398.2,236.1,400.3,230.7,400.3z"></path>
											</svg>My Events
									</a>
									<a class="event" href="<?php echo base_url(); ?>account/addEvent">								
										<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
											<path d="m463.6,144.9l-142.9-128.7c-3.7-3.3-8.6-5.2-13.7-5.2h-245c-11.3,0-20.4,9.1-20.4,20.4v449.2c0,11.3 9.1,20.4 20.4,20.4h388c11.3,0 20.4-9.1 20.4-20.4v-320.5c0-5.8-2.5-11.3-6.8-15.2zm-140.1-71.2l97.6,87.9h-97.6v-87.9zm106,386.5h-347v-408.4h200.2v130.2c0,11.3 9.1,20.4 20.4,20.4h126.5v257.8z"></path>
											<path d="m119.2,276.4c0,11.3 9.1,20.4 20.4,20.4h232.8c11.3,0 20.4-9.1 20.4-20.4 0-11.3-9.1-20.4-20.4-20.4h-232.8c-11.3,2.84217e-14-20.4,9.1-20.4,20.4z"></path>
											<path d="m372.4,355.6h-232.8c-11.3,0-20.4,9.1-20.4,20.4 0,11.3 9.1,20.4 20.4,20.4h232.8c11.3,0 20.4-9.1 20.4-20.4 5.68434e-14-11.3-9.1-20.4-20.4-20.4z"></path>
										</svg> New Event
									</a>
								</div>
							</div>
							<?php if($this->session->flashdata('flash_message')) { 
					                  echo $this->session->flashdata('flash_message');
					                }
					         ?>
							<form method="get" action="<?php echo base_url(); ?>account/events">
								<div class="filterWrapper">
								
									<div class="filtercalendar" style="width: 24%;">
									  	<div class='input-group date' id='datetimepicker1'>
									  		<span class="input-group-addon" for="start-date">
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
												</svg>
						                        <!-- <span class="glyphicon glyphicon-calendar"></span> -->
						                    </span>
						                    <input type='text' class="form-control" name="start-date" id="start-date" value="<?php if($startdate_search != '') { echo date('m/d/Y', strtotime($startdate_search)); } ?>" />
						                    
						                </div>
									</div>
									<!-- <div class="filterSelect">
										<select class="form-control" placeholder="Institution">
										  <option>Institutions</option>
										  <option value="AL">Alabama</option>
										  <option value="WY">Wyoming</option>
										</select>
									</div> -->
									<div class="filterSelect" style="width: 24%;">
										<select class="form-control" name="course" id="course" placeholder="InsCoursetitution" onchange="getProfessor(this.value)">
										  <option>Course</option>
										  	<?php foreach ($course as $key => $value) { ?>
												<option value="<?= $value['id'] ?>" <?php if($course_search == $value['id']) { echo "selected"; } ?>><?= $value['name'] ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="filterSelect" style="width: 24%;">
										<select class="form-control" placeholder="Professor" name="professor" id="professor">
										  <option>Professor</option>
										  <?php foreach ($professor as $key => $value) { ?>
												<option value="<?= $value['id'] ?>" <?php if($professor_search == $value['id']) { echo "selected"; } ?>><?= $value['name'] ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="filterSearch" style="width: 24%;">
										<input type="text" placeholder="Search Event..." name="keyword" value="<?= $keyword_search; ?>">
										<button type="submit" class="searchBtn">
											<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 489.713 489.713">
												<path d="M483.4,454.444l-121.3-121.4c28.7-35.2,46-80,46-128.9c0-112.5-91.5-204.1-204.1-204.1S0,91.644,0,204.144
												s91.5,204,204.1,204c48.8,0,93.7-17.3,128.9-46l121.3,121.3c8.3,8.3,20.9,8.3,29.2,0S491.8,462.744,483.4,454.444z M40.7,204.144
												c0-90.1,73.2-163.3,163.3-163.3s163.4,73.3,163.4,163.4s-73.3,163.4-163.4,163.4S40.7,294.244,40.7,204.144z"></path>
											</svg>
										</button>
									</div>
								
								</div>
							</form>
						</div>
						<div class="cal-schedule eventHdrWrap">
							<div class="monthEvents">
								<div class="monthView">
									<div id="datetimepickermonth"></div>
								</div>
								<div class="events">
									<?php foreach ($event_list as $key => $value) { 
										$university = $this->db->get_where('university', array('university_id' => $value['university']))->row_array();
									?>
										<div class="feed-card list">
										<div class="right">
											<div class="feed_card_inner">
												<?php if($value['featured_image'] != '') { ?>
													<div class="col-sm-4">
														<div class="imageBoxUpload event" style="border: none;height: 130px;">
															<img src="<?php echo base_url(); ?>uploads/users/<?php echo $value['featured_image']; ?>">
														</div>
													</div>
													<div class="col-sm-8">
														<h5><a href="<?php echo base_url(); ?>account/eventDetails/<?php echo base64_encode($value['id']); ?>"><?php echo $value['event_name']; ?></a></h5>
														<div class="badgeList">
															<ul>
																<li class="badge badge1">
																	<a href="event-place.html">
																		<?php echo $university['SchoolName']; ?>
																	</a>
																</li>
															</ul>
														</div>
														<div class="timeperiod">
															<div class="timeDetail">
																<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
																			<path d="M230.3,435.3C214.5,419.5,75.7,277.6,75.7,181.9C75.7,82,151.4,0,245,0s169.3,82,169.3,181.9
																				c0,94.6-138.8,236.6-154.6,253.4C255.5,439.5,242.1,447.1,230.3,435.3z M245,41c-70.5,0-128.3,63.1-128.3,142
																				c0,58.9,83.1,159.8,128.3,209.2c46.3-49.4,128.3-149.3,128.3-209.2C373.3,104.1,315.5,41,245,41z"></path>
																			<path d="M245,246.1c-42.1,0-76.8-34.7-76.8-76.8s34.7-76.8,76.8-76.8s76.8,34.7,76.8,76.8S287.1,246.1,245,246.1z M245,132.6
																				c-20,0-36.8,16.8-36.8,36.8s16.8,36.8,36.8,36.8s36.8-16.8,36.8-36.8C281.8,148.3,265,132.6,245,132.6z"></path>
																			<path d="M345.9,490H144.1c-11.6,0-20-9.5-20-20s9.5-20,20-20H347c11.6,0,20,9.5,20,20S357.5,490,345.9,490z"></path>
																</svg> <?php echo $value['location_txt']; ?>
															</div>
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
																</svg> <?php echo date('d M, Y', strtotime($value['start_date'])); ?>											
															</div>
															<div class="timeDetail">
																<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 501.333 501.333">
																			<path d="M250.667,0C112,0,0,112,0,250.667s112,250.667,250.667,250.667s250.667-112,250.667-250.667S389.333,0,250.667,0z
																				M250.667,459.733c-115.2,0-209.067-93.867-209.067-209.067S135.467,41.6,250.667,41.6s209.067,93.867,209.067,209.067
																				S365.867,459.733,250.667,459.733z"></path>
																			<path d="M314.667,229.333H272V129.067c0-11.733-9.6-21.333-21.333-21.333c-11.733,0-21.333,9.6-21.333,21.333v121.6
																				c0,11.733,9.6,21.333,21.333,21.333h64C326.4,272,336,262.4,336,250.667C336,238.933,326.4,229.333,314.667,229.333z"></path>
																</svg><?php echo date('h:i A', strtotime($value['start_time'])); ?>	
															</div>
														</div>
													</div>
												<?php } else { ?>
													<h5><a href="<?php echo base_url(); ?>account/eventDetails/<?php echo base64_encode($value['id']); ?>"><?php echo $value['event_name']; ?></a></h5>
														<div class="badgeList">
															<ul>
																<li class="badge badge1">
																	<a href="event-place.html">
																		<?php echo $university['SchoolName']; ?>
																	</a>
																</li>
															</ul>
														</div>
														<div class="timeperiod">
															<div class="timeDetail">
																<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
																			<path d="M230.3,435.3C214.5,419.5,75.7,277.6,75.7,181.9C75.7,82,151.4,0,245,0s169.3,82,169.3,181.9
																				c0,94.6-138.8,236.6-154.6,253.4C255.5,439.5,242.1,447.1,230.3,435.3z M245,41c-70.5,0-128.3,63.1-128.3,142
																				c0,58.9,83.1,159.8,128.3,209.2c46.3-49.4,128.3-149.3,128.3-209.2C373.3,104.1,315.5,41,245,41z"></path>
																			<path d="M245,246.1c-42.1,0-76.8-34.7-76.8-76.8s34.7-76.8,76.8-76.8s76.8,34.7,76.8,76.8S287.1,246.1,245,246.1z M245,132.6
																				c-20,0-36.8,16.8-36.8,36.8s16.8,36.8,36.8,36.8s36.8-16.8,36.8-36.8C281.8,148.3,265,132.6,245,132.6z"></path>
																			<path d="M345.9,490H144.1c-11.6,0-20-9.5-20-20s9.5-20,20-20H347c11.6,0,20,9.5,20,20S357.5,490,345.9,490z"></path>
																</svg> <?php echo $value['location_txt']; ?>
															</div>
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
																</svg> <?php echo date('d M, Y', strtotime($value['start_date'])); ?>											
															</div>
															<div class="timeDetail">
																<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 501.333 501.333">
																			<path d="M250.667,0C112,0,0,112,0,250.667s112,250.667,250.667,250.667s250.667-112,250.667-250.667S389.333,0,250.667,0z
																				M250.667,459.733c-115.2,0-209.067-93.867-209.067-209.067S135.467,41.6,250.667,41.6s209.067,93.867,209.067,209.067
																				S365.867,459.733,250.667,459.733z"></path>
																			<path d="M314.667,229.333H272V129.067c0-11.733-9.6-21.333-21.333-21.333c-11.733,0-21.333,9.6-21.333,21.333v121.6
																				c0,11.733,9.6,21.333,21.333,21.333h64C326.4,272,336,262.4,336,250.667C336,238.933,326.4,229.333,314.667,229.333z"></path>
																</svg><?php echo date('h:i A', strtotime($value['start_time'])); ?>	
															</div>
														</div>
												<?php } ?>
												
											</div>
											<div class="feed_card_footer col-sm-12">
												
												<?php $user = $this->db->get_where('user_info', array('userID' => $value['created_by']))->row_array();  ?>
												<div class="userWrap eventBox">
													<div class="user-name">
														<figure>
															<img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
														</figure>
														<figcaption><?= $user['nickname']; ?></figcaption>
													</div>	
													<div class="edit">
														<a href="<?php echo base_url(); ?>account/editEvent/<?php echo base64_encode($value['id']); ?>">
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
														<a data-toggle="modal" data-id="<?= $value['id']; ?>" data-target="#confirmationModalList" class="delete_event">										
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
												<div class="userIcoList" data-toggle="modal" data-target="#peersModal">
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
														<li class="more">
															+5
														</li>
													</ul>
												</div>
												
													<div class="action">
														<?php if($value['addedToCalender'] == 0) { ?>
														<a href="#" class="addEvents" data-id="<?= $value['id']; ?>" data-toggle="modal" data-target="#addEventModal">
															<img src="<?php echo base_url(); ?>assets_d/images/calendar.svg" alt="Events Calendar"> 
														</a>
														<?php } ?>
														<a>
															<div class="action_button">
																<a href="<?php echo base_url(); ?>account/eventDetails/<?php echo base64_encode($value['id']); ?>">
																	<svg class="sp-icon sp-icon--rotate-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
																		<path d="M481.3,110.1c-11.6-11.6-30.4-11.6-42.1,0L245,304.4L50.8,110.2c-11.6-11.6-30.4-11.6-42.1,0c-11.6,11.6-11.6,30.4,0,42.1
																			l236.4,236.4l236.2-236.4C492.9,140.6,492.9,121.7,481.3,110.1z"></path>
																	</svg>
																</a>
															</div>
														</a>
													</div>
												
											</div>
										</div>
									</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</section>
				
	
