<style>.error { color: red; } .hide { display: none; }</style>
<?php
$getdata = (!empty($_GET)) ? $_GET : [];
$getStr = '';
foreach ($getdata as $key => $value) {
	$getStr.=$key.'='.$value."&";
}

?>
				<section class="mainContent">
					<div class="studySetWrapper list">
						<div class="header">
							<h4>Study Sets</h4>
							<a href="<?php echo base_url();?>studyset/manage">
								<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
									<path d="m463.6,144.9l-142.9-128.7c-3.7-3.3-8.6-5.2-13.7-5.2h-245c-11.3,0-20.4,9.1-20.4,20.4v449.2c0,11.3 9.1,20.4 20.4,20.4h388c11.3,0 20.4-9.1 20.4-20.4v-320.5c0-5.8-2.5-11.3-6.8-15.2zm-140.1-71.2l97.6,87.9h-97.6v-87.9zm106,386.5h-347v-408.4h200.2v130.2c0,11.3 9.1,20.4 20.4,20.4h126.5v257.8z"></path>
									<path d="m119.2,276.4c0,11.3 9.1,20.4 20.4,20.4h232.8c11.3,0 20.4-9.1 20.4-20.4 0-11.3-9.1-20.4-20.4-20.4h-232.8c-11.3,2.84217e-14-20.4,9.1-20.4,20.4z"></path>
									<path d="m372.4,355.6h-232.8c-11.3,0-20.4,9.1-20.4,20.4 0,11.3 9.1,20.4 20.4,20.4h232.8c11.3,0 20.4-9.1 20.4-20.4 5.68434e-14-11.3-9.1-20.4-20.4-20.4z"></path>
								</svg>
								Create Study Set 
							</a>
						</div>
						<form method="get" id="study_search_filter">
						<div class="filterWrapper">
							
							<div class="filterSearch">
								<input type="text" placeholder="Enter Keywords" name="study_search" id="study_search" value="<?php
								 echo (isset($_GET['study_search'])) ? $_GET['study_search'] : ''?>">
								<button type="button" class="searchBtn" onclick="checkSearch();">
									<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 489.713 489.713">
										<path d="M483.4,454.444l-121.3-121.4c28.7-35.2,46-80,46-128.9c0-112.5-91.5-204.1-204.1-204.1S0,91.644,0,204.144
										s91.5,204,204.1,204c48.8,0,93.7-17.3,128.9-46l121.3,121.3c8.3,8.3,20.9,8.3,29.2,0S491.8,462.744,483.4,454.444z M40.7,204.144
										c0-90.1,73.2-163.3,163.3-163.3s163.4,73.3,163.4,163.4s-73.3,163.4-163.4,163.4S40.7,294.244,40.7,204.144z"></path>
									</svg>
								</button>
								
							</div>
							<span class="error" id="study_search_err"></span>
							
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
						               <li><a href = "<?php echo base_url();?>studyset?<?php echo $getStr;?>order_by=created_on">Date</a></li>
						               <li><a href = "<?php echo base_url();?>studyset?<?php echo $getStr;?>order_by=name">Name</a></li>
						               <li><a href = "<?php echo base_url();?>studyset?<?php echo $getStr;?>order_by=likes_count">Popularity</a></li>
						               <li><a href = "<?php echo base_url();?>studyset?<?php echo $getStr;?>order_by=rating_count">Rating</a></li>
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
								<a href="<?php echo base_url();?>studyset" class="filterBtn"> 
									
									Clear
								</a>
							</div>
						</div>
						<div class="filterForm">
							<div class="row">
								<div class="col-md-12">
									<label>Institution</label>
									<select class="form-control" name="institution">
									 	<option value="">Select Institution</option>
										<option value="<?php echo $userdata['intitutionID'];?>" <?php echo (isset($_GET['institution']) && $_GET['institution'] == $userdata['intitutionID']) ? 'selected' : '';?>><?php echo $userdata['SchoolName'];?></option>
									</select>
								</div>
								<div class="col-md-12 courseSelect">
									<label>Course</label>
									<select class=" form-control" id="course" name="course" onchange="getProfessor();">
									  	<option value="">Select Course</option>
									  	<?php
										foreach ($courses as $key => $course) {
										?>
											<option value="<?php echo $course['id'];?>" <?php echo (isset($_GET['course']) && $_GET['course'] == $course['id']) ? 'selected' : '';?>><?php echo $course['name'];?></option>
										<?php
										}
										?>
									</select>
								</div>
								<div class="col-md-12 professorSelect">
									<label>Professor</label>
									<select class="form-control" name="professor" id="professor">
									  
									</select>
								</div>
								<div class="col-md-12">
									<div class="buttonWrapper">
										<button type="submit" class="btn-all">Apply</button>
										<a href="<?php echo base_url();?>studyset" class="btn-all" style="margin-left: 10px;">Clear</a>
									</div>
								</div>
							</div>
						</div>
						</form>
						<div class="feedWrapper">
						<?php
						foreach ($studysets as $key => $studyset) {
						?>
							<div class="feed-card list" id="study_set_id_div_<?php echo $studyset['study_set_id'];?>">
								<div class="left">
									<figure>
										<?php
										if($studyset['image']) {
										?>
											<img src="<?php echo base_url();?>uploads/studyset/<?php echo $studyset['image'];?>" alt="Study Set List">
										<?php
										} else {
										?>
											<img src="<?php echo base_url();?>assets_d/images/detail1.jpg" alt="Study Set List">
										<?php
										}
										?>
									</figure>
								</div>
								<div class="right">
									<div class="feed_card_inner">
										<div class="header listHeader">
											<p>Study Sets</p>
											<div class="my-rating-4" data-rating="1.5">
												<span><?php echo $studyset['rating_count'];?></span>
											</div>
										</div>
										<h5><a href="<?php echo base_url();?>studyset/details/<?php echo $studyset['study_set_id'];?>"><?php echo $studyset['name'];?></a></h5>
										<div class="badgeList">
											<ul>
												<li class="badge badge1">
													<?php echo $studyset['institution_name']; ?>
												</li>
												<li class="badge badge2">
													<?php echo $studyset['course_name']; ?>
												</li>
												<li class="badge badge3">
													<?php echo $studyset['professor_name']; ?>
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
												</svg> <?php echo $studyset['time_ago'];?>
											</div>
											<div class="socialAction">
												<ul>
													<li class="likecount" data-id="<?php echo $studyset['study_set_id'];?>">
														<a href="javascript:void(0)">
															<i class="fa fa-thumbs-o-up <?php echo ($studyset['isLikedByUser']) ? 'fa-thumbs-up' : ''; ?>" aria-hidden="true"></i>
															<span class="likeclass_<?php echo $studyset['study_set_id'];?>"><?php echo $studyset['likes_count'];?></span>
														</a>
													</li>
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
															</svg> <?php echo $studyset['share_count'];?>
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
												<?php
												if($studyset['image']) {
												?>
													<img src="<?php echo base_url();?>uploads/user_identification/<?php echo $studyset['user_image'];?>" alt="User">
												<?php
												} else {
												?>
													<img src="<?php echo base_url();?>assets_d/images/user.jpg" alt="user">
												<?php
												}
												?>
													
												</figure>
												<figcaption><?php echo $studyset['first_name'].' '.$studyset['last_name'];?></figcaption>
											</div>
											<div class="edit">
												<a href="<?php echo base_url();?>studyset/manage/<?php echo $studyset['study_set_id'];?>">
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
											<div class="delete deleteStudySet" data-id="<?php echo $studyset['study_set_id'];?>">
												<a data-toggle="modal" data-target="#confirmationModal">										
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
											<a>
												<div class="action_button">
													<a href="<?php echo base_url();?>studyset/details/<?php echo $studyset['study_set_id'];?>">
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
						<?php
						}
						?>
						</div>
						<?php 
							if($total_study_sets > 3) {
						?>
						<div class="loadMoreWrapper loadmore">
							<button type="button" onclick="loadStudySetData();"> Load More</button>
						</div>	
						<?php  } else { ?>
						<div class="loadMoreWrapper"  >
							<button type="button"> You've reached the end!</button>
						</div>	
						<?php
						}
						?>
						<div class="loadMoreWrapper reached" style="display: none;" >
							<button type="button"> You've reached the end!</button>
						</div>	
					</div>
				</section>
				
			</section>
		</section>
	</section>
	<!-- Modal -->
<div class="modal fade" id="peersModal" role="dialog">
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
          		<a class="transAction">Share All</a>
          	</div>
          	<div class="listUserWrap">
          		<section class="list">
        			<section class="left">
        				<figure>
        					<img src="<?php echo base_url();?>assets_d/images/user2.jpg" alt="user">
        				</figure>
        				<figcaption>John Phelips</figcaption>
        			</section>
        			<section class="action">
        				<button type="button" class="like">share</button>
        			</section>
    			</section>
    			<section class="list">
        			<section class="left">
        				<figure>
        					<img src="<?php echo base_url();?>assets_d/images/user2.jpg" alt="user">
        				</figure>
        				<figcaption>John Phelips</figcaption>
        			</section>
        			<section class="action">
        				<button type="button" class="like">share</button>
        			</section>
    			</section>
    			<section class="list">
        			<section class="left">
        				<figure>
        					<img src="<?php echo base_url();?>assets_d/images/user2.jpg" alt="user">
        				</figure>
        				<figcaption>John Phelips</figcaption>
        			</section>
        			<section class="action">
        				<button type="button" class="like">share</button>
        			</section>
    			</section>
    			<section class="list">
        			<section class="left">
        				<figure>
        					<img src="<?php echo base_url();?>assets_d/images/user2.jpg" alt="user">
        				</figure>
        				<figcaption>John Phelips</figcaption>
        			</section>
        			<section class="action">
        				<button type="button" class="like">share</button>
        			</section>
    			</section>
    			<section class="list">
        			<section class="left">
        				<figure>
        					<img src="<?php echo base_url();?>assets_d/images/user2.jpg" alt="user">
        				</figure>
        				<figcaption>John Phelips</figcaption>
        			</section>
        			<section class="action">
        				<button type="button" class="like">share</button>
        			</section>
    			</section>
    			<section class="list">
        			<section class="left">
        				<figure>
        					<img src="<?php echo base_url();?>assets_d/images/user2.jpg" alt="user">
        				</figure>
        				<figcaption>John Phelips</figcaption>
        			</section>
        			<section class="action">
        				<button type="button" class="like">share</button>
        			</section>
    			</section>
    			<section class="list">
        			<section class="left">
        				<figure>
        					<img src="<?php echo base_url();?>assets_d/images/user2.jpg" alt="user">
        				</figure>
        				<figcaption>John Phelips</figcaption>
        			</section>
        			<section class="action">
        				<button type="button" class="like">share</button>
        			</section>
    			</section>
    			<section class="list">
        			<section class="left">
        				<figure>
        					<img src="<?php echo base_url();?>assets_d/images/user2.jpg" alt="user">
        				</figure>
        				<figcaption>John Phelips</figcaption>
        			</section>
        			<section class="action">
        				<button type="button" class="like">share</button>
        			</section>
    			</section>
    			<section class="list">
        			<section class="left">
        				<figure>
        					<img src="<?php echo base_url();?>assets_d/images/user2.jpg" alt="user">
        				</figure>
        				<figcaption>John Phelips</figcaption>
        			</section>
        			<section class="action">
        				<button type="button" class="like">share</button>
        			</section>
    			</section>
    			<section class="list">
        			<section class="left">
        				<figure>
        					<img src="<?php echo base_url();?>assets_d/images/user2.jpg" alt="user">
        				</figure>
        				<figcaption>John Phelips</figcaption>
        			</section>
        			<section class="action">
        				<button type="button" class="like">share</button>
        			</section>
    			</section>
          	</div>
          </div>
        </div>
      </div>
    </div>
</div>
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
	    					<img src="<?php echo base_url();?>assets_d/images/user2.jpg" alt="user">
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
	    					<img src="<?php echo base_url();?>assets_d/images/user2.jpg" alt="user">
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
	    					<img src="<?php echo base_url();?>assets_d/images/user2.jpg" alt="user">
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
	    					<img src="<?php echo base_url();?>assets_d/images/user2.jpg" alt="user">
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
	    					<img src="<?php echo base_url();?>assets_d/images/user2.jpg" alt="user">
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
	    					<img src="<?php echo base_url();?>assets_d/images/user2.jpg" alt="user">
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
	    					<img src="<?php echo base_url();?>assets_d/images/user2.jpg" alt="user">
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
	    					<img src="<?php echo base_url();?>assets_d/images/user2.jpg" alt="user">
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
	    					<img src="<?php echo base_url();?>assets_d/images/user2.jpg" alt="user">
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
	    					<img src="<?php echo base_url();?>assets_d/images/user2.jpg" alt="user">
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
<div class="modal fade" id="confirmationModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <div class="modal-body peers">
	          	   <h4>Confirmation</h4>
		           <div class="row">
		           	 <h6 class="modalText">Are you sure to delete this Syudy-Set !</h6>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group button">
								<input type="hidden" name="ss_id" id="ss_id">
								<button data-dismiss="modal" class="transparentBtn highlight">No</button>
								<button type="button" class="filterBtn" onclick="deleteStudySet()">Yes</button>
							</div>
						</div>
					</div>
	        </div>
        </div>
    </div>
</div>



<script type="text/javascript">
var professor_id = '<?php echo isset($_GET['professor']) ? $_GET['professor'] : '';?>';
$(document).ready(function(){
	$(document).on('click','.deleteStudySet',function(){
		var delete_id = $(this).data('id');
		$("#ss_id").val(delete_id);

	});

	$(document).on('click','.likecount',function(){
		var study_set_id = $(this).data('id');
		var that = $(this);
		$.ajax({
			url : '<?php echo base_url();?>studyset/manageLikes',
			type : 'post',
			data : {"study_set_id" : study_set_id},
			success:function(result) {
				
				var likecount = $('.likeclass_'+study_set_id).text();
				if(result.trim() == 1) {
					that.find('i').addClass('fa-thumbs-up');
					likecount = parseInt(likecount) + 1;
				} else {
					that.find('i').removeClass('fa-thumbs-up');
					likecount = parseInt(likecount) - 1;
				}
				$('.likeclass_'+study_set_id).html(likecount);
			}
		})
	});

	var course_id = $("#course").val();
    if(course_id != '') {
    	getProfessor();
    }
})

var page = 1;
var total_study_sets = '<?php echo $total_study_sets;?>';
function loadStudySetData() 
{
	$.ajax({
		url : '<?php echo base_url();?>studyset/loadStudySetData?<?php echo $getStr;?>',
		type : 'post',
		data : {"page" : page},
		success:function(result) {
			$(".feedWrapper").append(result);
			page++;
			if((page * 3) >= parseInt(total_study_sets)) {
				$(".loadmore").hide();
				$(".reached").show();
			}
		}
	})
}

function checkSearch() 
{
	$('.error').html('');
	var flag = 0;
	var search = $("#study_search").val().trim();


	if(search == '') {
		$('#study_search_err').html('Please enter keywords');
		flag = 1;
	}

	if(flag == 0) {
		$("#study_search_filter").submit();
	}
}

function getProfessor() 
{
	var course_id = $("#course").val();
	$.ajax({
		url : '<?php echo base_url();?>studyset/getProfessors',
		type : 'post',
		data : {"course_id" : course_id},
		success:function(result) {
			console.log(result);
			var data = JSON.parse(result);
			var professors = '';
			for(i = 0; i < data.length; i++) {
				professors+= '<option value="'+data[i].id+'">'+data[i].name+'</option>';
			}
			$("#professor").html(professors);
			if(professor_id) {
				$("#professor").val(professor_id);
			}
		}
	})
}

function deleteStudySet() 
{
	var ss_id = $("#ss_id").val();
	if(ss_id != ''){
		$.ajax({
			url : '<?php echo base_url();?>studyset/deleteStudySet',
			type : 'post',
			data : {"study_set_id" : ss_id},
			success:function(result) {
				$("#confirmationModal").modal('hide');
				$("#study_set_id_div_"+ss_id).remove();
				$("#ss_id").val('');
			}	
		})
	}
}
</script>
