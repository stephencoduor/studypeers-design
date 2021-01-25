<section class="mainContent">
					<div class="studySetWrapper list">
						<div class="header">
							<h4>
								<a class="backBtn event" href="<?php echo base_url(); ?>account/events">
									<svg class="sp-icon" version="1.1" id="Layer_1" 
									    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 490 490" style="enable-background:new 0 0 490 490;" xml:space="preserve">
										<path d="M245.9,436.3c14.8-16.4,13.9-41.5-2-56.8l-101.5-94.4l308.4-0.7c22.2-0.6,39.7-19,39.2-41.1c-0.5-21.4-17.7-38.6-39.1-39.1
											l-308.6,0.7l101.5-94.4c16.2-15.1,17.1-40.6,2-56.8c-15.1-16.2-40.6-17.1-56.8-2l-176.2,164C4.7,223.3,0.1,233.9,0,245
											c0,11.1,4.6,21.7,12.8,29.3L189,438.2c16.2,15.2,41.6,14.4,56.8-1.7c0.1-0.1,0.2-0.2,0.2-0.2H245.9z"></path>
									</svg>
									Back
								</a>
								Edit Event
							</h4>
						</div>
						<form method="post" action="<?php echo base_url(); ?>account/editEvent/<?php echo base64_encode($event['id']) ?>" enctype="multipart/form-data" onsubmit="return validateEvent()">	
							<div class="content-box">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<!-- <label>Name</label> -->
											<input type="text" name="event_name" id="event_name" class="form-control form-control--lg" placeholder="Event Name" value="<?= $event['event_name'] ?>">
											<span class="custom_err" id="err_event_name"></span>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group location" id="location">
											<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
												<path d="M230.3,435.3C214.5,419.5,75.7,277.6,75.7,181.9C75.7,82,151.4,0,245,0s169.3,82,169.3,181.9
													c0,94.6-138.8,236.6-154.6,253.4C255.5,439.5,242.1,447.1,230.3,435.3z M245,41c-70.5,0-128.3,63.1-128.3,142
													c0,58.9,83.1,159.8,128.3,209.2c46.3-49.4,128.3-149.3,128.3-209.2C373.3,104.1,315.5,41,245,41z"></path>
												<path d="M245,246.1c-42.1,0-76.8-34.7-76.8-76.8s34.7-76.8,76.8-76.8s76.8,34.7,76.8,76.8S287.1,246.1,245,246.1z M245,132.6
													c-20,0-36.8,16.8-36.8,36.8s16.8,36.8,36.8,36.8s36.8-16.8,36.8-36.8C281.8,148.3,265,132.6,245,132.6z"></path>
												<path d="M345.9,490H144.1c-11.6,0-20-9.5-20-20s9.5-20,20-20H347c11.6,0,20,9.5,20,20S357.5,490,345.9,490z"></path>
											</svg>
											<input type="text" name="location_txt" class="form-control form-control--lg" id="location_txt" onfocus="geolocate()" placeholder="Location" value="<?= $event['location_txt'] ?>">
											<span class="custom_err" id="err_location_txt"></span>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-row align-items-center mb-2 no-gutters">
											<div class="col  eventAdd">
												<div class="col-sm-6">
													<div class="form-group calendar event">
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
											                    <input type="text" class="form-control" name="start-date" id="start-date" value="<?php echo date('m/d/Y', strtotime($event['start_date'])); ?>" >
											                    
											                </div>
														</div>
														<div class="input-group--overlap" id="selectTime1">
															<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 501.333 501.333">
																<path d="M250.667,0C112,0,0,112,0,250.667s112,250.667,250.667,250.667s250.667-112,250.667-250.667S389.333,0,250.667,0z
																	M250.667,459.733c-115.2,0-209.067-93.867-209.067-209.067S135.467,41.6,250.667,41.6s209.067,93.867,209.067,209.067
																	S365.867,459.733,250.667,459.733z"></path>
																<path d="M314.667,229.333H272V129.067c0-11.733-9.6-21.333-21.333-21.333c-11.733,0-21.333,9.6-21.333,21.333v121.6
																	c0,11.733,9.6,21.333,21.333,21.333h64C326.4,272,336,262.4,336,250.667C336,238.933,326.4,229.333,314.667,229.333z"></path>
															</svg>
															<input type="text" class="form-control  form-control--lg" name="start-time" id="start-time" value="<?php echo date('h:i A', strtotime($event['start_time'])); ?>">
															<span class="custom_err" id="err_start-time"></span>
														</div>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group calendar event">
														<label>End</label>
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
											                    <input type="text" class="form-control" name="end-date" id="end-date" value="<?php echo date('m/d/Y', strtotime($event['end_date'])); ?>">
											                    <span class="custom_err" id="err_end-date"></span>
											                </div>
														</div>
														<div class="input-group--overlap" id="selectTime2">
															<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 501.333 501.333">
																<path d="M250.667,0C112,0,0,112,0,250.667s112,250.667,250.667,250.667s250.667-112,250.667-250.667S389.333,0,250.667,0z
																	M250.667,459.733c-115.2,0-209.067-93.867-209.067-209.067S135.467,41.6,250.667,41.6s209.067,93.867,209.067,209.067
																	S365.867,459.733,250.667,459.733z"></path>
																<path d="M314.667,229.333H272V129.067c0-11.733-9.6-21.333-21.333-21.333c-11.733,0-21.333,9.6-21.333,21.333v121.6
																	c0,11.733,9.6,21.333,21.333,21.333h64C326.4,272,336,262.4,336,250.667C336,238.933,326.4,229.333,314.667,229.333z"></path>
															</svg>
															<input type="text" class="form-control  form-control--lg" name="end-time" id="end-time" value="<?php echo date('h:i A', strtotime($event['end_time'])); ?>">
															<span class="custom_err" id="err_end-time"></span>
														</div>
													</div>
												</div>
												<div class="col-sm-6">
													<span class="custom_err" id="err_start"></span>
												</div>
												<div class="col-sm-6">
													<span class="custom_err" id="err_end"></span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<textarea name="description" placeholder="Description" id="description" class="textarea-gray"><?php echo $event['description']; ?></textarea>
											<span class="custom_err" id="err_description"></span>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label>Privacy & Permission  <span style="font-size: 14px;font-weight: 400;color: gray;display: none;" id="privcy_span"></span></label>
											<select class="form-control selectpicker" id="privacy" name="privacy" onchange="showPermissionText(this.value)">
												<option value="">Select Privacy</option>
												<option value="1" <?php if($event['privacy'] == 1) { echo 'selected'; } ?>>Public</option>
												<option value="2" <?php if($event['privacy'] == 2) { echo 'selected'; } ?>>Private</option>
												<!-- <option value="3" <?php echo (isset($studyset_data) && isset($studyset_data['privacy']) && $studyset_data['privacy'] == 3) ? 'selected' : '';?>>Secret</option> -->
											</select>
											<span class="error" id="err_privacy"></span>

										</div>
									</div>
									<div class="col-md-12">
										<div class="form-row">
											<div class="col-sm-6 col-xs-12">
												<div class="form-group select select_label">
													<label>Institution</label>
													<select class="form-control selectpicker" name="university" id="university">
													  <option value="<?= $university['university_id']; ?>"><?= $university['SchoolName']; ?></option>
													</select>
													<span class="custom_err" id="err_university"></span>
												</div>
												<div class="form-group select select_label">
													<label>Course</label>
													<select class="form-control selectpicker" name="course" id="course" onchange="getProfessor(this.value)">
														<option value="">Select Course</option>
														<?php foreach ($course as $key => $value) { ?>
															<option value="<?= $value['id'] ?>" <?php if($event['course'] == $value['id']) { echo 'selected'; } ?>><?= $value['name'] ?></option>
														<?php } ?>
													</select>

													<span class="custom_err" id="err_course"></span>
													<a data-toggle="modal" data-target="#courseModal" class="add-course">Add Course</a>
												</div>											
												<div class="form-group select select_label">
													<label>Professor</label>
													<select class="form-control selectpicker" name="professor" id="professor">
														<?php foreach ($professor as $key => $value) { ?>
															<option value="<?= $value['id'] ?>" <?php if($event['professor'] == $value['id']) { echo 'selected'; } ?>><?= $value['name'] ?></option>
														<?php } ?>	  
													</select>
													<span class="custom_err" id="err_professor"></span>
												</div>
											</div>
											<div class="col-sm-6 col-xs-12">
												<labe class="imageBoxUpload event">
													<div id="imageBoxUpload">
														<?php if($event['featured_image'] == '') { ?>
															<span class="imageBoxUpload--icon">
																<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
																	<path d="M490.684082,0H21.315918C9.5085716,0,0,9.5085716,0,21.315918V490.684082C0,502.4914246,9.5085716,512,21.315918,512
																		H490.684082C502.4914246,512,512,502.4914246,512,490.684082V21.315918C512,9.5085716,502.4914246,0,490.684082,0z
																		 M50.6775513,469.3681641l108.9828644-165.3028564l92.0554962,165.3028564H50.6775513z M469.3681641,469.3681641H299.7812195
																		c-0.2089844-0.6269226-19.5396118-35.631012-42.6318359-77.217926L384,204.5910339l85.2636719,72.8293762v191.9477539H469.3681641z
																		 M469.3681641,221.204895l-75.6506042-64.6791992c-4.5975342-4.4930573-20.1665039-10.7624512-31.5559082,4.2840881
																		l-128.1045074,189.440033c-27.8987732-50.3641052-54.2301941-97.6979675-54.2301941-97.6979675
																		c-4.2840881-8.3591766-22.7787781-19.3306122-36.4669342-1.3583679L42.6318359,403.95755V42.6318359h426.6318054V221.204895
																		H469.3681641z"></path>
																	<path d="M238.1322327,205.6359253c35.1085815,0,63.6342773-28.5257263,63.6342773-63.6342926
																		s-28.5256958-63.6342926-63.6342773-63.6342926s-63.6342773,28.5257111-63.6342773,63.6342926
																		c0.1045074,35.1085663,28.6302032,63.6342773,63.6342773,63.6342773V205.6359253z M238.1322327,120.9991837
																		c11.5983734,0,20.8979797,9.4040909,20.8979797,20.8979568c0,11.5983734-9.4040985,20.8979645-20.8979797,20.8979645
																		c-11.5983734,0-20.8979492-9.4040833-20.8979492-20.8979645
																		C217.2342834,130.4032745,226.6383667,120.9991837,238.1322327,120.9991837z"></path>
																</svg>
																Add Image
															</span>	
														<?php } else { ?>
															<img src="<?php echo base_url(); ?>uploads/users/<?php echo $event['featured_image']; ?>">
														<?php } ?>
													</div>
													<input type="hidden" name="old_featured_image" value="<?php echo $event['featured_image']; ?>">
													<input type="file" name="featured_image" id="featured_image-id">
													
												</labe>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="studybuttonGroup">
								<a href="<?php echo base_url(); ?>account/events" type="button" class="transparentBtn cancelEvent" >Cancel</a>
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
									Update
								</button>
							</div>
						</form>
					</div>
				</section>