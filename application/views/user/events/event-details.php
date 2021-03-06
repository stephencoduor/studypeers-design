<?php $user_id = $this->session->get_userdata()['user_data']['user_id']; ?>
<section class="mainContent">
	<div class="scheduleWrapper">
		<div class="flex-wrp">
		<a class="backBtn col-sm-12" href="<?php echo base_url(); ?>account/events">
			<svg class="sp-icon" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
				 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 490 490" style="enable-background:new 0 0 490 490;" xml:space="preserve">
									<path d="M245.9,436.3c14.8-16.4,13.9-41.5-2-56.8l-101.5-94.4l308.4-0.7c22.2-0.6,39.7-19,39.2-41.1c-0.5-21.4-17.7-38.6-39.1-39.1
										l-308.6,0.7l101.5-94.4c16.2-15.1,17.1-40.6,2-56.8c-15.1-16.2-40.6-17.1-56.8-2l-176.2,164C4.7,223.3,0.1,233.9,0,245
										c0,11.1,4.6,21.7,12.8,29.3L189,438.2c16.2,15.2,41.6,14.4,56.8-1.7c0.1-0.1,0.2-0.2,0.2-0.2H245.9z"></path>
								</svg>
			Back to events
		</a>
		
		<div class="col-md-12">
			<ul class="eventscheduledWrap">
				<li>
					<svg class="sp-icon sp-icon--s sp-icon--op4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
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
					</svg> <?php echo date('d M, Y', strtotime($event['start_date']));; ?> - <?php echo date('d M, Y', strtotime($event['end_date']));; ?>
				</li>
				<li>
					<svg class="sp-icon sp-icon--s sp-icon--op4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 501.333 501.333">
						<path d="M250.667,0C112,0,0,112,0,250.667s112,250.667,250.667,250.667s250.667-112,250.667-250.667S389.333,0,250.667,0z
												M250.667,459.733c-115.2,0-209.067-93.867-209.067-209.067S135.467,41.6,250.667,41.6s209.067,93.867,209.067,209.067
												S365.867,459.733,250.667,459.733z"></path>
						<path d="M314.667,229.333H272V129.067c0-11.733-9.6-21.333-21.333-21.333c-11.733,0-21.333,9.6-21.333,21.333v121.6
												c0,11.733,9.6,21.333,21.333,21.333h64C326.4,272,336,262.4,336,250.667C336,238.933,326.4,229.333,314.667,229.333z"></path>
					</svg> <?php echo date('h:i A', strtotime($event['start_time'])); ?> - <?php echo date('h:i A', strtotime($event['end_time'])); ?>
				</li>
				<li>
					<?php $user = $this->db->get_where('user_info', array('userID' => $event['created_by']))->row_array(); 
						  $user_name = $this->db->get_where('user', array('id' => $event['created_by']))->row_array(); 

					?>
					<div class="list-inner">
						<figure>
							<img src="<?php echo userImage($event['created_by']); ?>" alt="user">
						</figure>
						<figcaption><a href="<?php echo base_url().'sp/'.$user_name['username'] ?>"><?= $user['nickname']; ?></a></figcaption>
					</div>
				</li>
			</ul>
			
		</div>
		<div class="col-md-12">
			<?php if($event['featured_image'] != '') { ?>
				<div class="imageBoxUpload event" style="border: none;">
					<img src="<?php echo base_url(); ?>uploads/users/<?php echo $event['featured_image']; ?>">
				</div>
			<?php } ?>
		</div>
		<div class="col-md-12">
			<h4 class="eventname"><?php echo $event['event_name']; ?></h4>
			<div class="badgeList">
				<ul>
					<li class="badge badge1">
						<a href="event-place.html">
							<?php echo $university['SchoolName']; ?>
						</a>
					</li>
				</ul>
			</div>
			<div class="timeperiod detail">
				<div class="timeDetail">
					<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
						<path d="M230.3,435.3C214.5,419.5,75.7,277.6,75.7,181.9C75.7,82,151.4,0,245,0s169.3,82,169.3,181.9
														c0,94.6-138.8,236.6-154.6,253.4C255.5,439.5,242.1,447.1,230.3,435.3z M245,41c-70.5,0-128.3,63.1-128.3,142
														c0,58.9,83.1,159.8,128.3,209.2c46.3-49.4,128.3-149.3,128.3-209.2C373.3,104.1,315.5,41,245,41z"></path>
						<path d="M245,246.1c-42.1,0-76.8-34.7-76.8-76.8s34.7-76.8,76.8-76.8s76.8,34.7,76.8,76.8S287.1,246.1,245,246.1z M245,132.6
														c-20,0-36.8,16.8-36.8,36.8s16.8,36.8,36.8,36.8s36.8-16.8,36.8-36.8C281.8,148.3,265,132.6,245,132.6z"></path>
						<path d="M345.9,490H144.1c-11.6,0-20-9.5-20-20s9.5-20,20-20H347c11.6,0,20,9.5,20,20S357.5,490,345.9,490z"></path>
					</svg> <?php echo $event['location_txt']; ?>
				</div>
			</div>
			<div class="socialEventsDisplayWrapper">
				<div class="socialActionWrapper">
					<?php if($event['created_by'] != $user_id) { ?>
						<a href="#" class="transAction event">
							<svg height="512pt" viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">
								<path d="m452 512h-392c-33.085938 0-60-26.914062-60-60v-392c0-33.085938 26.914062-60 60-60h392c33.085938 0 60 26.914062 60 60v392c0 33.085938-26.914062 60-60 60zm-392-472c-11.027344 0-20 8.972656-20 20v392c0 11.027344 8.972656 20 20 20h392c11.027344 0 20-8.972656 20-20v-392c0-11.027344-8.972656-20-20-20zm370.898438 111.34375-29.800782-26.6875-184.964844 206.566406-107.351562-102.046875-27.558594 28.988281 137.21875 130.445313zm0 0"/>
							</svg>
							Attend
						</a>
					<?php } ?>
					<?php if($event['created_by'] == $user_id) { ?>
						<a href="#" class="transAction event invitePeer" data-toggle="modal" data-target="#peersModalShare" data-id="<?= $event['id']; ?>">
							<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
								<path d="M319.4,85.8c0,2.9,0.1,5.7,0.4,8.6l-140.7,76.7c-19-19.8-45.6-32.2-75.1-32.2c-57.2,0-104,46.8-104,104s46.8,104,104,104
															c30.7,0,58.5-13.5,77.6-34.9l139.2,76.8c-0.9,5-1.4,10.1-1.4,15.4c0,46.8,38.5,85.3,85.3,85.3c46.8,0,85.3-38.5,85.3-85.3
															s-38.5-85.3-85.3-85.3c-26.8,0-50.9,12.6-66.5,32.2l-135.6-74.8c3.6-10.5,5.5-21.7,5.5-33.4c0-13-2.4-25.4-6.8-36.9l132.5-73
															c15.4,22.9,41.5,38.1,70.9,38.1c46.8,0,85.3-38.5,85.3-85.3S451.5,0.5,404.7,0.5S319.4,39,319.4,85.8z M449.4,404.2
															c0,25-19.8,44.7-44.7,44.7S360,429.1,360,404.2c0-25,19.8-44.7,44.7-44.7S449.4,379.2,449.4,404.2z M104,305.3
															c-34.3,0-62.4-28.1-62.4-62.4s28.1-62.4,62.4-62.4s62.4,28.1,62.4,62.4C166.5,277.3,138.4,305.3,104,305.3z M449.4,85.8
															c0,25-19.8,44.7-44.7,44.7S360,110.7,360,85.8c0-25,19.8-44.7,44.7-44.7S449.4,60.9,449.4,85.8z"></path>
							</svg>
							Invite
						</a>
					<?php } ?>
				</div>
				<div class="userWrap eventBox">
					<?php if($event['created_by'] == $user_id) { ?>
						<div class="edit">
							<a href="<?php echo base_url(); ?>account/editEvent/<?php echo base64_encode($event['id']); ?>" style="margin-right:0;">
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
							<a data-toggle="modal" data-target="#confirmationModal" style="margin-right:0;">
								<svg height="512pt" viewBox="-57 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">
									<path d="m156.371094 30.90625h85.570312v14.398438h30.902344v-16.414063c.003906-15.929687-12.949219-28.890625-28.871094-28.890625h-89.632812c-15.921875 0-28.875 12.960938-28.875 28.890625v16.414063h30.90625zm0 0"></path><path d="m344.210938 167.75h-290.109376c-7.949218 0-14.207031 6.78125-13.566406 14.707031l24.253906 299.90625c1.351563 16.742188 15.316407 29.636719 32.09375 29.636719h204.542969c16.777344 0 30.742188-12.894531 32.09375-29.640625l24.253907-299.902344c.644531-7.925781-5.613282-14.707031-13.5625-14.707031zm-219.863282 312.261719c-.324218.019531-.648437.03125-.96875.03125-8.101562 0-14.902344-6.308594-15.40625-14.503907l-15.199218-246.207031c-.523438-8.519531 5.957031-15.851562 14.472656-16.375 8.488281-.515625 15.851562 5.949219 16.375 14.472657l15.195312 246.207031c.527344 8.519531-5.953125 15.847656-14.46875 16.375zm90.433594-15.421875c0 8.53125-6.917969 15.449218-15.453125 15.449218s-15.453125-6.917968-15.453125-15.449218v-246.210938c0-8.535156 6.917969-15.453125 15.453125-15.453125 8.53125 0 15.453125 6.917969 15.453125 15.453125zm90.757812-245.300782-14.511718 246.207032c-.480469 8.210937-7.292969 14.542968-15.410156 14.542968-.304688 0-.613282-.007812-.921876-.023437-8.519531-.503906-15.019531-7.816406-14.515624-16.335937l14.507812-246.210938c.5-8.519531 7.789062-15.019531 16.332031-14.515625 8.519531.5 15.019531 7.816406 14.519531 16.335937zm0 0"></path><path d="m397.648438 120.0625-10.148438-30.421875c-2.675781-8.019531-10.183594-13.429687-18.640625-13.429687h-339.410156c-8.453125 0-15.964844 5.410156-18.636719 13.429687l-10.148438 30.421875c-1.957031 5.867188.589844 11.851562 5.34375 14.835938 1.9375 1.214843 4.230469 1.945312 6.75 1.945312h372.796876c2.519531 0 4.816406-.730469 6.75-1.949219 4.753906-2.984375 7.300781-8.96875 5.34375-14.832031zm0 0"></path>
								</svg> Delete
							</a>
						</div>
					<?php } ?>
					<!-- <div class="edit">
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
                    </div>	 -->
				</div>
				<?php $peer_attending = $this->db->get_where('share_master', array('reference_id' => $event['id'], 'reference' => 'event', 'status' => 2))->result_array(); ?>
				<?php  if(!empty($peer_attending)) {  ?>
				<div class="userIcoList peersModalAttending" data-id="<?= $event['id'] ?>" data-toggle="modal" data-target="#peersModalAttending" style="margin-right: 15%;">
					<ul>
						<?php if(!empty($peer_attending[0])) { ?>
							<li>
								<img src="<?php echo userImage($peer_attending[0]['peer_id']); ?>" alt="user">
							</li>
						<?php } ?>
						<?php if(!empty($peer_attending[1])) { ?>
							<li>
								<img src="<?php echo userImage($peer_attending[1]['peer_id']); ?>" alt="user">
							</li>
						<?php } ?>
						<?php if(!empty($peer_attending[2])) { ?>
							<li>
								<img src="<?php echo userImage($peer_attending[2]['peer_id']); ?>" alt="user">
							</li>
						<?php } $count = count($peer_attending); ?>
						<?php if($count > 3) { ?>
							<li class="more">
								+<?= $count - 3; ?>
							</li>
						<?php } ?>
					</ul>
				</div>
			<?php } ?>
				<div class="action">
					<?php if($event['addedToCalender'] == 0) { ?>
						<a href="#" class="addEvents delete_event" data-id="<?= $event['id']; ?>" data-toggle="modal" data-target="#addEventModal" style="width: 45px;">
							<img src="<?php echo base_url(); ?>assets_d/images/calendar.svg" alt="Events Calendar">
						</a>
					<?php } else { ?>
						<a href="#" class="removeEvent" data-id="<?= $event['id']; ?>" data-toggle="modal" data-target="#removeFromScheduleModal">
							<img src="<?php echo base_url(); ?>assets_d/images/calendar.png" alt="Events Calendar" style="width: 20px;height: 20px;">
						</a>
					<?php } ?>
				</div>
			</div>
			<p class="eventdescription">Sample, I just adding an event to do a test run.</p>
		</div>
		<div class="col-sm-12">
			<div class="mapWrapper">
				<div id="map-container-google-1" class="z-depth-1-half map-container">
					<!-- <iframe src="https://maps.google.com/maps?q=manhatan&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0"
                      style="border:0" allowfullscreen></iframe> -->
					<div id="map" style="height: 100%;"></div>
				</div>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="socialActionWrapper">
				<a href="#" class="transAction" data-toggle="modal" data-target="#reportModalEvent">
					<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 501.333 501.333">
						<path d="M442.133,57.6c-26.667-14.933-54.4-21.333-86.4-21.333c-37.333,0-74.667,9.6-109.867,19.2
											    c-34.133,9.6-67.2,18.133-99.2,18.133c-20.267,0-38.4-4.267-55.467-10.667v-41.6C91.2,9.6,81.6,0,69.867,0
											    S48.533,9.6,48.533,21.333V480c0,11.733,9.6,21.333,21.333,21.333s21.333-9.6,21.333-20.267v-147.2
											    c18.133,5.333,36.267,8.533,55.467,8.533c38.4,0,74.667-9.6,109.867-18.133c34.133-9.6,67.2-18.133,99.2-18.133
											    c24.533,0,45.867,5.333,66.133,16c6.4,3.2,14.933,3.2,21.333,0c5.333-4.267,9.6-10.667,9.6-18.133V75.733
											    C452.8,68.267,448.533,60.8,442.133,57.6z M411.2,272c-17.067-6.4-36.267-8.533-55.467-8.533c-37.333,0-74.667,9.6-109.867,19.2
											    c-34.133,9.6-67.2,18.133-99.2,18.133c-20.267,0-38.4-3.2-55.467-10.667v-182.4c17.067,6.4,36.267,8.533,55.467,8.533
											    c37.333,0,74.667-9.6,109.867-19.2c34.133-9.6,67.2-18.133,99.2-18.133c20.267,0,38.4,3.2,55.467,10.667V272z"></path>
					</svg>
					Report
				</a>
			</div>
			<div class="comment-title">
				<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M448 0H64C28.7 0 0 28.7 0 64v288c0 35.3 28.7 64 64 64h96v84c0 7.1 5.8 12 12 12 2.4 0 4.9-.7 7.1-2.4L304 416h144c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64zm16 352c0 8.8-7.2 16-16 16H288l-12.8 9.6L208 428v-60H64c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16h384c8.8 0 16 7.2 16 16v288zm-96-216H144c-8.8 0-16 7.2-16 16v16c0 8.8 7.2 16 16 16h224c8.8 0 16-7.2 16-16v-16c0-8.8-7.2-16-16-16zm-96 96H144c-8.8 0-16 7.2-16 16v16c0 8.8 7.2 16 16 16h128c8.8 0 16-7.2 16-16v-16c0-8.8-7.2-16-16-16z"></path></svg>
				Comments <span id="commentCount"><?php if(!empty($comment)) { ?>(<?php echo count($comment); ?>) <?php } ?></span>
			</div>
			<div class="chatCommentWrapper">
				<div class="listChatWrap">
					<div id="event_comment">
						<?php foreach ($comment as $key => $value) {
							$user_info = $this->db->get_where('user_info', array('userID' => $value['user_id']))->row_array();
							$reply = $this->db->get_where('comment_master', array('comment_parent_id' => $value['id']))->result_array();
							$count_like = $this->db->get_where('comment_like_master', array('comment_id' => $value['id'], 'status' => 1))->num_rows();
							$user_name = $this->db->get_where('user', array('id' => $value['user_id']))->row_array();
							$if_user_liked = $this->db->get_where('comment_like_master', array('comment_id' => $value['id'], 'status' => 1, 'user_id' => $user_id))->num_rows();
							?>
							<div class="chatMsg" id="comment_id_<?= $value['id']; ?>">
								<div class="chatMsgBox">
								<figure>
									<img src="<?php echo userImage($value['user_id']); ?>" alt="User">
								</figure>
								<div class="right">
									<div class="userWrapText">
									<figcaption>
										<a href="<?php echo base_url().'sp/'.$user_name['username'] ?>"><span class="name"> <?php echo $user_info['nickname'] ?></span></a>
										<?php if($value['type'] == 1) { ?>
											<img src="<?php echo base_url(); ?>uploads/comments/<?= $value['comment']; ?>" alt="comment" style="height: 70px;">
										<?php } else { echo $value['comment']; } ?>

										<div class="actionmsgMenu">
											<ul>
												<li class="likeuser" id="likeComment<?php echo $value['id'] ?>" onclick="likeComment('<?php echo $value['id'] ?>')"><?php if($if_user_liked == 1) { echo 'Liked'; } else { echo 'Like'; } ?></li>
												<li class="replyuser" onclick="showReplyBox('<?php echo $value['id'] ?>')">Reply</li>
											</ul>
										</div>
										<?php if($count_like == 0){
											$css = 'display: none;';
										} else {
											$css = '';
										} ?>
										<div class="reactmessage" id="reactmessage_<?php echo $value['id'] ?>" style="<?= $css; ?>">
											<div class="react">
												<img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Like">
											</div>
											<p id="like_count_<?php echo $value['id'] ?>"><?= $count_like; ?></p>
										</div>
									</figcaption>
									

									<div class="reply ss" id="reply_<?php echo $value['id'] ?>">
										<?php foreach ($reply as $key2 => $value2) {
											$user_info2 = $this->db->get_where('user_info', array('userID' => $value2['user_id']))->row_array();
											$user_name2 = $this->db->get_where('user', array('id' => $value2['user_id']))->row_array();
											$if_user_liked2 = $this->db->get_where('comment_like_master', array('comment_id' => $value2['id'], 'status' => 1, 'user_id' => $user_id))->num_rows();
											$count_like2 = $this->db->get_where('comment_like_master', array('comment_id' => $value2['id'], 'status' => 1))->num_rows();
										?>
											<div class="userReplyBox" id="comment_reply_id_<?= $value2['id']; ?>">
												
												<figure>
													<img src="<?php echo userImage($value2['user_id']); ?>" alt="User">
												</figure>
												<div class="right">
													<div class="userWrapText">
														<figcaption>
															<a href="<?php echo base_url().'sp/'.$user_name2['username'] ?>"><span class="name"><?= $user_info2['nickname'] ?></span></a>
															<?php echo $value2['comment'] ?>
															<div class="actionmsgMenu">
																<ul>
																	<li class="likeuser" id="likeComment<?php echo $value2['id'] ?>" onclick="likeComment('<?php echo $value2['id'] ?>')"><?php if($if_user_liked2 == 1) { echo 'Liked'; } else { echo 'Like'; } ?></li>
																	
																</ul>
															</div>
															<?php if($count_like2 == 0){
																$css2 = 'display: none;';
															} else {
																$css2 = '';
															} ?>
															<div class="reactmessage" id="reactmessage_<?php echo $value2['id'] ?>" style="<?= $css2; ?>">
																<div class="react">
																	<img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Like">
																</div>
																<p id="like_count_<?php echo $value2['id'] ?>"><?= $count_like2; ?></p>
															</div>

														</figcaption>
													</div>
													<div class="dotsBullet dropdown">
															<img
																src="<?php echo base_url(); ?>assets_d/images/more.svg"
																alt="more"
																data-toggle="dropdown">
															<ul class="dropdown-menu"
																role="menu"
																aria-labelledby="menu1">
																<li role="presentation">
																	<a role="menuitem"
																	tabindex="-1"
																	href="javascript:void(0);">
																		<div
																			class="left">
																			<img
																				src="<?php echo base_url(); ?>assets_d/images/restricted.svg"
																				alt="Save">
																		</div>
																		<div
																			class="right">
																			<span>Hide/block</span>
																		</div>
																	</a>
																</li>
																<?php if(($user_id == $event['created_by']) || $user_id == $value2['user_id']) { ?>
																	<li role="presentation">
																		<a role="menuitem"
																		tabindex="-1"
																		href="javascript:void(0);" onclick="deleteCommentReply('<?= $value2['id']; ?>', '<?php echo $value['id']; ?>')">
																			<div
																				class="left">
																				<img
																					src="<?php echo base_url(); ?>assets_d/images/trash.svg"
																					alt="Link">
																			</div>
																			<div
																				class="right">
																				<span>Delete</span>
																			</div>
																		</a>
																	</li>
																<?php } ?>
															</ul>
													</div>

												</div>
											</div>
										<?php } ?>
									</div>

									<div class="replyBox" id="replyBox<?php echo $value['id'] ?>">
										<figure>
											<img src="<?php echo userImage($user_id); ?>" alt="User">
										</figure>
										<div class="replyuser">
											<input type="text" id="input_reply_<?php echo $value['id'] ?>" placeholder="Write a Reply..." onkeypress="postReply(event,'<?php echo $value['id'] ?>', this.value)">
										</div>
									</div>
									</div>
									<div class="dotsBullet dropdown">
											<img
												src="<?php echo base_url(); ?>assets_d/images/more.svg"
												alt="more"
												data-toggle="dropdown">
											<ul class="dropdown-menu"
												role="menu"
												aria-labelledby="menu1">
												<li role="presentation">
													<a role="menuitem"
													tabindex="-1"
													href="javascript:void(0);">
														<div
															class="left">
															<img
																src="<?php echo base_url(); ?>assets_d/images/restricted.svg"
																alt="Save">
														</div>
														<div
															class="right">
															<span>Hide/block</span>
														</div>
													</a>
												</li>
												<?php if(($user_id == $event['created_by']) || $user_id == $value['user_id']) { ?>
													<li role="presentation">
														<a role="menuitem"
														tabindex="-1"
														href="javascript:void(0);" onclick="deleteComment('<?= $value['id']; ?>', '<?php echo $event['id']; ?>', 'event')">
															<div
																class="left">
																<img
																	src="<?php echo base_url(); ?>assets_d/images/trash.svg"
																	alt="Link">
															</div>
															<div
																class="right">
																<span>Delete</span>
															</div>
														</a>
													</li>
												<?php } ?>
											</ul>
									</div>
								</div>
							</div>
							</div>
						<?php } ?>
					</div>
					<div class="chatreplyBox">
						<input type="hidden" id="comment_event_id" value="<?= $event['id']; ?>">
						<input type="text" name="" placeholder="Comment.." id="input-emoji" data-emojiable="true"
							   data-emoji-input="unicode">
						<div class="mediaAction">
							<button type="button">
								<img src="<?php echo base_url(); ?>assets_d/images/camera.svg" alt="Add Files">
								<input type="file" id="imgComment">
							</button>
						</div>
					</div>
				</div>

			</div>
		</div>
												</div>
	</div>
</section>


<div class="modal fade" id="removeFromScheduleModal" role="dialog">
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
						<form method="post" action="<?php echo base_url(); ?>account/removeEvent">
							<div class="form-group button">
								<input type="hidden" id="remove_event_id" name="remove_event_id" value="<?= $event['id']; ?>">
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
                            <input type="hidden" id="invite_event" value="<?= $event['id']; ?>">
                            <div class="listUserWrap" id="shareList">
                                
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>


<div class="modal fade" id="confirmationModalAttend" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-body peers">
                   <h4>Confirmation</h4>
                   <div class="row">
                     <h6 class="modalText" id="confirmationModalAttendHead">Are you sure to attend this Event !</h6>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group button">
                                <input type="hidden" name="attend_event_id" id="attend_event_id">
                                <button data-dismiss="modal" class="transparentBtn highlight">No</button>
                                <button type="button" class="filterBtn" onclick="attendEvent()">Yes</button>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="peersModalAttending" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div class="modal-body peers">
          <h4>Peers List Attending Event</h4>
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
            <div class="listUserWrap" id="peersModalAttendingList">
                
                
            </div>
          </div>
        </div>
      </div>
    </div>
</div>


<div class="modal fade" id="reportModalEvent" role="dialog">
				    <div class="modal-dialog">
				        <!-- Modal content-->
				        <div class="modal-content">
				          <button type="button" class="close" data-dismiss="modal">&times;</button>
					        <div class="modal-body peers">
					        	<form method="post" action="<?php echo base_url(); ?>account/reportEvent" onsubmit="return validateReport()">
					          	   <h4>Reason</h4>
						           <div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Reason for Report</label>
												<div class="reason">
													
													<input type="hidden" name="report_event_id" value="<?= $event['id']; ?>">
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

<script type="text/javascript">
	$(document).on('click','.attendEvent',function(){
        var event_id = $(this).data('id');
        var txt = $('#attend_text_'+event_id).html(); 
        $("#attend_event_id").val(event_id);
        if(txt == 'Attend'){
            $('#confirmationModalAttendHead').html('Do you want to attend this Event !');
        } else {
            $('#confirmationModalAttendHead').html("Are you sure you don't want to attend this Event !");
        }

    });

    $(document).on('click','.invitePeer',function(){
            var id = $(this).data('id');
            
            $.ajax({
                url : '<?php echo base_url();?>account/getPeerToInvite',
                type : 'post',
                data : {"id" : id},
                success:function(result) {
                    
                    $('#shareList').html(result);
                }
            })

        });

    $(document).on('click','.peersModalAttending',function(){
        var event_id = $(this).data('id'); 
        
        $.ajax({
            url : '<?php echo base_url();?>account/getPeersEVentAttending',
            type : 'post',
            data : {"id" : event_id},
            success:function(result) {
                
                $('#peersModalAttendingList').html(result);
            }
        })
        

    });

    function attendEvent(){
        var id = $("#attend_event_id").val();
        var txt = $('#attend_text_'+id).html(); 
        if(id != ''){
            $.ajax({
                url : '<?php echo base_url();?>account/attendSharedEvent',
                type : 'post',
                data : {"id" : id, "type" : txt},
                success:function(result) {
                    $("#confirmationModalAttend").modal('hide');
                    $("#attend_text_"+id).html(result);
                    $("#attend_event_id").val('');
                }   
            })
        }
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

    function inviteToPeer(peer_id){
            var invite_event = $('#invite_event').val();

            $.ajax({
                url : '<?php echo base_url();?>account/invitePeerEvent',
                type : 'post',
                data : {"id" : invite_event, 'peer_id': peer_id},
                success:function(result) {
                    // $('#share_count_'+share_document).html(result);
                    $("#action_"+peer_id).html('<button type="button" class="like" onclick="uninviteToPeer('+peer_id+')">invited</button>');
                    // $("#share_studyset").val('');
                }   
            })
        }

        function uninviteToPeer(peer_id){
            var invite_event = $('#invite_event').val();

            $.ajax({
                url : '<?php echo base_url();?>account/uninvitePeerEvent',
                type : 'post',
                data : {"id" : invite_event, 'peer_id': peer_id},
                success:function(result) {
                    // $('#share_count_'+share_document).html(result);
                    $("#action_"+peer_id).html('<button type="button" onclick="inviteToPeer('+peer_id+')" class="like">invite</button>');
                    // $("#share_studyset").val('');
                }   
            })
        }
</script>
