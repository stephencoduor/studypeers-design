<?php if($this->input->get()) { 
            
        $startdate_search  = $this->input->get('start-date');
        $course_search     = $this->input->get('course');
        $professor_search  = $this->input->get('professor');
        $keyword_search    = $this->input->get('keyword');
        $text_msg = 'Search result not found.';
    } else {
    	$startdate_search  = '';
        $course_search     = '';
        $professor_search  = '';
        $keyword_search    = '';
        $text_msg = 'No records to show.';
    }
 ?>
<style>
	 .fc-event{
		 height: 25px !important;
		 border: 1px solid !important;
	 }
	 .choose_btn {
		 padding:10px 20px;
		 border-radius:8px;
		 cursor: pointer;
		 outline: none;
		 border:0;
		 font-size: 16px;
		 font-weight:600;
	 }
	 .choose_btn img {
		 margin-right:10px;
	 }
	 .gdrive {
		 background: #d8f5f6;
		 color:#1ae2bc;
	 }
	 .import_schedules{
		 background-color: #fbfbfc !important;
	 }
 </style>
				<section class="mainContent">
						<div class="scheduleWrapper">
							<div class="header">
								<h4>Calendar</h4>
								<?php
									if($user_detail['is_imported_schedules'] == 0)
									{
								?>
										<a class="import_schedules" href="<?php echo base_url(); ?>GoogleCalendar/checkGoogleLogin" onclick="return confirm('Are you sure you want to import schedules from google ?')">
											<button type="button" class="choose_btn gdrive">
												<img src="<?=base_url('assets_d/images/google-drive.svg')?>"> Import from google
											</button>
										</a>
								<?php
									}
									else{
								?>
										<a class="import_schedules" href="<?php echo base_url(); ?>GoogleCalendar/checkGoogleLogin">
											<button type="button" class="choose_btn gdrive">
												<img src="<?=base_url('assets_d/images/google-drive.svg')?>"> Sync up with Google Calendar
											</button>
										</a>
								<?php
									}
								?>


								<a href="<?php echo base_url(); ?>account/addSchedule">								
									<svg xmlns="http://www.w3.org/2000/svg" id="prefix__Group_667" width="20" height="20" data-name="Group 667" viewBox="0 0 20 20">
									    <defs>
									        <style>
									            .prefix__cls-2{fill:none;stroke:#fff;stroke-width:2px;stroke-linecap:round}
									        </style>
									    </defs>
									    <g id="prefix__Rectangle_1424" data-name="Rectangle 1424" style="stroke:#fff;stroke-width:2px;fill:none">
									        <rect width="20" height="20" rx="2" style="stroke:none"/>
									        <rect width="18" height="18" x="1" y="1" rx="1" style="fill:none"/>
									    </g>
									    <g id="prefix__Group_666" data-name="Group 666" transform="translate(6 6)">
									        <path id="prefix__Line_1569" d="M0 0L7.6 0" class="prefix__cls-2" data-name="Line 1569" transform="translate(0 3.8)"/>
									        <path id="prefix__Line_1570" d="M0 0L7.6 0" class="prefix__cls-2" data-name="Line 1570" transform="rotate(90 1.9 1.9)"/>
									    </g>
									</svg> Create new
								</a>
							</div>
							<?php if($this->session->flashdata('flash_message')) { 
					                  echo $this->session->flashdata('flash_message');
					                }
					         ?>
					         <?php if($this->input->get()) { ?>
						         <div class="main_subheaderLeft">
									<a href="<?php echo base_url(); ?>account/schedule">
										<svg class="sp-icon" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 490 490" style="enable-background:new 0 0 490 490;" xml:space="preserve">
											<path d="M245.9,436.3c14.8-16.4,13.9-41.5-2-56.8l-101.5-94.4l308.4-0.7c22.2-0.6,39.7-19,39.2-41.1c-0.5-21.4-17.7-38.6-39.1-39.1
												l-308.6,0.7l101.5-94.4c16.2-15.1,17.1-40.6,2-56.8c-15.1-16.2-40.6-17.1-56.8-2l-176.2,164C4.7,223.3,0.1,233.9,0,245
												c0,11.1,4.6,21.7,12.8,29.3L189,438.2c16.2,15.2,41.6,14.4,56.8-1.7c0.1-0.1,0.2-0.2,0.2-0.2H245.9z"></path>
										</svg>
										Clear Search Result
									</a>
									
								</div>
							<?php } ?>
					        <form method="get" action="<?php echo base_url(); ?>account/schedule">
								<div class="filterWrapper flex-filter">
									<div  class="flex-row">
										<div class="filtercalendar">
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
												<input type='text' class="form-control" name="start-date" id="start-date" value="<?php if($startdate_search != '') { echo date('m/d/Y h:i A', strtotime($startdate_search)); } ?>" style="width: 90%;" />
												
											</div>
										</div>
									<!-- <div class="filterSelect">
										<select class="form-control" placeholder="Institution">
										  <option>Institutions</option>
										  <option value="AL">Alabama</option>
										  <option value="WY">Wyoming</option>
										</select>
									</div> -->
										<div class="filterSelect">
											<select class="form-control" name="course" id="course" placeholder="InsCoursetitution" onchange="getProfessor(this.value)">
											<option>Course</option>
												<?php foreach ($course as $key => $value) { ?>
													<option value="<?= $value['id'] ?>" <?php if($course_search == $value['id']) { echo "selected"; } ?>><?= $value['name'] ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="flex-row">
										<div class="filterSelect">
											<select class="form-control" placeholder="Professor" name="professor" id="professor">
											<option>Professor</option>
											<?php foreach ($professor as $key => $value) { ?>
													<option value="<?= $value['id'] ?>" <?php if($professor_search == $value['id']) { echo "selected"; } ?>><?= $value['name'] ?></option>
												<?php } ?>
											</select>
										</div>
										<div class="filterSearch">
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
								</div>
							</form>
						</div>
						<div class="tabularLiist">
							<ul class="nav nav-tabs">
								<li class="active">
									<a data-toggle="tab" href="#month">
										Month
									</a>
								</li>
								<li>
									<a data-toggle="tab" href="#week" id="weekCalendar">
										Week
									</a>
								</li>
								<li>
									<a data-toggle="tab" href="#day">
										Day
									</a>
								</li>
								<li>
									<a data-toggle="tab" href="#task">
										Task
									</a>
								</li>
							</ul>
							<div class="tab-content">
								<div id="month" class="tab-pane fade in active">
									<div class="cal-schedule">
										<div class="monthEvents">
											<div class="monthView">
												<div id="datetimepickermonth"></div>
											</div>
											<div class="events">
												<div class="eventList">
													<?php if(!empty($schedule_list)) {
													  $c = 0; foreach ($schedule_list as $key => $value) { ?>
														<div class="<?= $colors[$c]; ?> event" id="<?= $value['id']; ?>">
															<div class="time"><?php echo date('d M, Y h:i A', strtotime($value['start_date'])); ?> <span><?php echo date('d M, Y h:i A', strtotime($value['end_date'])); ?></span></div>
															<div class="name"><?= $value['schedule_name'] ?></div>
														</div>
													<?php if($c == 5 ) { $c = 0; } else { $c++; } } } else {
														echo '<p class="text-center">'.$text_msg.'</p>';
													} ?>
													<?php if(!empty($schedule_list)) { ?>
														<!-- <h6 class="loadingEvents">
															Loading Events
														</h6> -->
													<?php } ?>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div id="week" class="tab-pane fade">
									<div class="calendarView">
										<div id='week_calendar'></div>
									</div>
								</div>
								<div id="day" class="tab-pane fade">
									<div class="cal-schedule">
										<div class="monthEvents">
											<div class="monthView">
												<div id="datetimepickerday"></div>
											</div>
											<div class="events">
												<div class="eventList" id="dayTabList">
													<?php if(!empty($schedule_list_day)) {
													  $c = 0; foreach ($schedule_list_day as $key => $value) { ?>
														<div class="<?= $colors[$c]; ?> event" id="<?= $value['id']; ?>">
															<div class="time"><?php echo date('d M, Y h:i A', strtotime($value['start_date'])); ?> <span><?php echo date('d M, Y h:i A', strtotime($value['end_date'])); ?></span></div>
															<div class="name"><?= $value['schedule_name'] ?></div>
														</div>
													<?php if($c == 5 ) { $c = 0; } else { $c++; } } } else {
														echo '<p class="text-center">'.$text_msg.'</p>';
													} ?>
													<?php if(!empty($schedule_list)) { ?>
														<!-- <h6 class="loadingEvents">
															Loading Events
														</h6> -->
													<?php } ?>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div id="task" class="tab-pane fade">
									<div class="cal-schedule">
										<div class="monthEvents">
											<div class="monthView">
												<div id="datetimepickertask"></div>
											</div>
											<div class="events">
												<div class="eventList">
													<!-- <div class="constitition event">
														<div class="time">All day</div>
														<div class="name">Constitution Day</div>
													</div>
													<div class="mathlaton event">
														<div class="time">All day</div>
														<div class="name">Mathlaton 2020</div>
													</div>
													<div class="calculus event disabled">
														<div class="time">7:30 <span>8:30</span></div>
														<div class="name">Calculus 101</div>
													</div>
													<div class="dance event">
														<div class="time">10:30 <span>12:30</span></div>
														<div class="name">Feminist dancing therapy</div>
													</div>
													<div class="study event">
														<div class="time">16:00 <span>18:00</span></div>
														<div class="name">Study session</div>
													</div>
													<div class="mathlaton event">
														<div class="time">17:00 <span>2:00</span></div>
														<div class="name">Beer pong @ Mike's</div>
													</div>
													<div class="assignment event">
														<div class="time">23:59</div>
														<div class="name">Assignment due</div>
													</div>
													<h6 class="loadingEvents">
														Loading Events
													</h6> -->
													<p class="text-center">No records to show.</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				
    <div class="eventDetail">
  	<div class="close">
  		<img src="<?php echo base_url(); ?>assets_d/images/close1.svg">
  	</div>
  	<div class="eventWrapper" id="eventDetailDiv">
  		
  	</div>
  </div>

  <div class="modal fade" id="confirmationModal" role="dialog">
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
								<form method="post" action="<?php echo base_url(); ?>account/deleteSchedule">
									<div class="form-group button">
										<input type="hidden" id="delete_schedule_id" name="delete_schedule_id">
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
