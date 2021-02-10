<section class="mainContent">
						<div class="scheduleWrapper">
								<div class="header">
									<h4>Add Schedule</h4>
								</div>
								<form method="post" action="<?php echo base_url(); ?>account/addSchedule" onsubmit="return validateSchedule()">
									<div class="addScheduleBox">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group select">
													<select class="form-control selectpicker" onchange="showFormDetails(this.value)" name="schedule" id="schedule">
														<option value="">Choose</option>
														<option value="course">Course schedule</option>
														<option value="assignment">Assignment</option>
													</select>
													<span class="custom_err" id="err_schedule"></span>
												</div>
											</div>
											<div id="form-details" style="display: none;">
												<div class="col-md-12">
													<div class="form-group">
														<input type="text" name="schedule_name" class="form-control form-control--lg" id="schedule_name" placeholder="Event Name">
														<span class="custom_err" id="err_schedule_name"></span>
													</div>
												</div>
												
												<div class="col-md-12">
													<div class="form-group">
														<textarea name="description" placeholder="Description" id="description" class="textarea-gray"></textarea>
														<span class="custom_err" id="err_description"></span>
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group select select_label">
														<label>Institution</label>
														<select class="form-control" name="university" id="university">
														  <option value="<?= $university['university_id']; ?>"><?= $university['SchoolName']; ?></option>
														</select>
														<span class="custom_err" id="err_university"></span>
													</div>

												</div>
												<div class="col-md-12">
													<div class="form-group select select_label courseMenuSelect">
														<label>Course</label>
														<select class="form-control" name="course" id="course" onchange="getProfessor(this.value)">
															<option value="">Select Course</option>
															<?php foreach ($course as $key => $value) { ?>
																<option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
															<?php } ?>
														</select>
														<span class="custom_err" id="err_course"></span>
														<a data-toggle="modal" data-target="#courseModal" style="cursor: pointer;">Add Course</a>
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group select select_label">
														<label>Professor</label>
														<select class="form-control" name="professor" id="professor">
														  
														</select>
														<span class="custom_err" id="err_professor"></span>
													</div>
												</div>
												<div class="col-md-12">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group calendar">
																<label>Start</label>
																<div class="filtercalendar">
																  	<div class="input-group date" id="datetimepickerstart">
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
													                    </span>
													                    <input type="text" class="form-control" name="start-date" id="start-date">
													                    
													                </div>
																</div>
															</div>
															<span class="custom_err" id="err_start-date"></span>
														</div>
														<div class="col-md-6">
															<div class="form-group calendar">
																<label>End</label>
																<div class="filtercalendar">
																  	<div class="input-group date" id="datetimepickerend">
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
													                    </span>
													                    <input type="text" class="form-control" name="end-date" id="end-date">

													                </div>
																</div>
															</div>
															<span class="custom_err" id="err_end-date"></span>
														</div>
													</div>
												</div>
												
												
											</div>
										</div>
									</div>
									<div class="studybuttonGroup">
										<a class="transparentBtn highlight" href="<?php echo base_url(); ?>account/schedule">Cancel</a>
										<button type="submit" class="filterBtn">
											<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 484 484">
												<path d="M477.9,100.8L383.1,6c-4-4-9.1-6-14.1-6H20.2C9.1,0,0,9.1,0,20.2v443.6C0,474.9,9.1,484,20.2,484h443.6
													c11.1,0,20.2-9.1,20.2-20.2V115C484,109.9,482,104.9,477.9,100.8z M110.9,40.4h142.2V119H110.9V40.4z M443.6,443.6H40.4V40.4
													h30.2v98.8c0,11.1,9.1,20.2,20.2,20.2h182.5c11.1,0,20.2-9.1,20.2-20.2V40.4H361l82.7,82.7v320.5H443.6z"></path>
												<path d="M130.1,255.1c-11.1,0-20.2,9.1-20.2,20.2c0,11.1,9.1,20.2,20.2,20.2h223.8c11.1,0,19.2-9.1,19.2-20.2
													c0-11.1-9.1-20.2-20.2-20.2L130.1,255.1L130.1,255.1z"></path>
												<path d="M355.9,350.9H128.1c-11.1,0-20.2,9.1-20.2,20.2c0,11.1,9.1,20.2,20.2,20.2H356c11.1,0,20.2-9.1,20.2-20.2
													C376.1,360,367,350.9,355.9,350.9z"></path>
											</svg>
											Save
										</button>
									</div>
								</form>
							</div>
						</div>
				</section>