<style type="text/css">
	.error{ color: red; }
</style>
				<section class="mainContent">
						<div class="studySetWrapper">
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
								<div class="studyDetailHeaderWrapper">
									<a href="javascript:;" class="link">Study Set</a>
									<div class="my-rating-4" data-rating="2.5">
										<span>1233 votes</span>
									</div>
								</div>
								<div class="header">
									<h4><?php echo $studyset['name'];?></h4>
								</div>
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
								<div class="userWrap">
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
											<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" 
												xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												 viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
													<g>
														<g>
															<polygon points="51.2,353.28 0,512 158.72,460.8 		"/>
														</g>
													</g>
													<g>
														<g>
															
																<rect x="89.73" y="169.097" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -95.8575 260.3719)" width="353.277" height="153.599"/>
														</g>
													</g>
													<g>
														<g>
															<path d="M504.32,79.36L432.64,7.68c-10.24-10.24-25.6-10.24-35.84,0l-23.04,23.04l107.52,107.52l23.04-23.04
																C514.56,104.96,514.56,89.6,504.32,79.36z"/>
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
											<svg height="512pt" viewBox="-57 0 512 512" width="512pt" 
												xmlns="http://www.w3.org/2000/svg">
												<path d="m156.371094 30.90625h85.570312v14.398438h30.902344v-16.414063c.003906-15.929687-12.949219-28.890625-28.871094-28.890625h-89.632812c-15.921875 0-28.875 12.960938-28.875 28.890625v16.414063h30.90625zm0 0"/><path d="m344.210938 167.75h-290.109376c-7.949218 0-14.207031 6.78125-13.566406 14.707031l24.253906 299.90625c1.351563 16.742188 15.316407 29.636719 32.09375 29.636719h204.542969c16.777344 0 30.742188-12.894531 32.09375-29.640625l24.253907-299.902344c.644531-7.925781-5.613282-14.707031-13.5625-14.707031zm-219.863282 312.261719c-.324218.019531-.648437.03125-.96875.03125-8.101562 0-14.902344-6.308594-15.40625-14.503907l-15.199218-246.207031c-.523438-8.519531 5.957031-15.851562 14.472656-16.375 8.488281-.515625 15.851562 5.949219 16.375 14.472657l15.195312 246.207031c.527344 8.519531-5.953125 15.847656-14.46875 16.375zm90.433594-15.421875c0 8.53125-6.917969 15.449218-15.453125 15.449218s-15.453125-6.917968-15.453125-15.449218v-246.210938c0-8.535156 6.917969-15.453125 15.453125-15.453125 8.53125 0 15.453125 6.917969 15.453125 15.453125zm90.757812-245.300782-14.511718 246.207032c-.480469 8.210937-7.292969 14.542968-15.410156 14.542968-.304688 0-.613282-.007812-.921876-.023437-8.519531-.503906-15.019531-7.816406-14.515624-16.335937l14.507812-246.210938c.5-8.519531 7.789062-15.019531 16.332031-14.515625 8.519531.5 15.019531 7.816406 14.519531 16.335937zm0 0"/><path d="m397.648438 120.0625-10.148438-30.421875c-2.675781-8.019531-10.183594-13.429687-18.640625-13.429687h-339.410156c-8.453125 0-15.964844 5.410156-18.636719 13.429687l-10.148438 30.421875c-1.957031 5.867188.589844 11.851562 5.34375 14.835938 1.9375 1.214843 4.230469 1.945312 6.75 1.945312h372.796876c2.519531 0 4.816406-.730469 6.75-1.949219 4.753906-2.984375 7.300781-8.96875 5.34375-14.832031zm0 0"/>
											</svg> Delete
										</a>
									</div>	
								</div>
								<div class="socialActionWrapper">
									<a href="javascript:void(0)" class="like likecount" data-id="<?php echo $studyset['study_set_id'];?>">
										<i class="fa fa-thumbs-o-up <?php echo ($studyset['isLikedByUser']) ? 'fa-thumbs-up' : ''; ?>" aria-hidden="true"></i>
										Like
									</a>
									<a href="#" class="like">								
										<svg id="collapsea_1" 
											enable-background="new 0 0 511.072 511.072" height="512" viewBox="0 0 511.072 511.072" width="512" xmlns="http://www.w3.org/2000/svg"><g id="Speech_Bubble_48_"><g><path d="m74.39 480.536h-36.213l25.607-25.607c13.807-13.807 22.429-31.765 24.747-51.246-36.029-23.644-62.375-54.751-76.478-90.425-14.093-35.647-15.864-74.888-5.121-113.482 12.89-46.309 43.123-88.518 85.128-118.853 45.646-32.963 102.47-50.387 164.33-50.387 77.927 0 143.611 22.389 189.948 64.745 41.744 38.159 64.734 89.63 64.734 144.933 0 26.868-5.471 53.011-16.26 77.703-11.165 25.551-27.514 48.302-48.593 67.619-46.399 42.523-112.042 65-189.83 65-28.877 0-59.01-3.855-85.913-10.929-25.465 26.123-59.972 40.929-96.086 40.929zm182-420c-124.039 0-200.15 73.973-220.557 147.285-19.284 69.28 9.143 134.743 76.043 175.115l7.475 4.511-.23 8.727c-.456 17.274-4.574 33.912-11.945 48.952 17.949-6.073 34.236-17.083 46.99-32.151l6.342-7.493 9.405 2.813c26.393 7.894 57.104 12.241 86.477 12.241 154.372 0 224.682-93.473 224.682-180.322 0-46.776-19.524-90.384-54.976-122.79-40.713-37.216-99.397-56.888-169.706-56.888z"/></g></g>
										</svg>
										Comment
									</a>
									<a href="#" class="share" data-toggle="modal" data-target="#peersModal">
										<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
											<path d="M319.4,85.8c0,2.9,0.1,5.7,0.4,8.6l-140.7,76.7c-19-19.8-45.6-32.2-75.1-32.2c-57.2,0-104,46.8-104,104s46.8,104,104,104
												c30.7,0,58.5-13.5,77.6-34.9l139.2,76.8c-0.9,5-1.4,10.1-1.4,15.4c0,46.8,38.5,85.3,85.3,85.3c46.8,0,85.3-38.5,85.3-85.3
												s-38.5-85.3-85.3-85.3c-26.8,0-50.9,12.6-66.5,32.2l-135.6-74.8c3.6-10.5,5.5-21.7,5.5-33.4c0-13-2.4-25.4-6.8-36.9l132.5-73
												c15.4,22.9,41.5,38.1,70.9,38.1c46.8,0,85.3-38.5,85.3-85.3S451.5,0.5,404.7,0.5S319.4,39,319.4,85.8z M449.4,404.2
												c0,25-19.8,44.7-44.7,44.7S360,429.1,360,404.2c0-25,19.8-44.7,44.7-44.7S449.4,379.2,449.4,404.2z M104,305.3
												c-34.3,0-62.4-28.1-62.4-62.4s28.1-62.4,62.4-62.4s62.4,28.1,62.4,62.4C166.5,277.3,138.4,305.3,104,305.3z M449.4,85.8
												c0,25-19.8,44.7-44.7,44.7S360,110.7,360,85.8c0-25,19.8-44.7,44.7-44.7S449.4,60.9,449.4,85.8z"></path>
										</svg>
										Share
									</a>
									<a href="#" class="transAction"  data-toggle="modal" data-target="#reportModal">
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
							</div>
						</div>
						<h3 class="section-title">Study tools</h3>
						<div class="toolBox">
							<ul>
								<li>
									<a href="<?php echo base_url();?>studyset/flashcards/<?php echo $studyset['study_set_id'];?>">
										<div class="flash flashcards_detail">
											<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
												<path d="M177.9,490c-3.2,0-6.5-0.7-9.5-2.3c-8.9-4.6-13.3-14.9-10.3-24.5l51-165.4h-96.5c-7.9,0-15.1-4.5-18.6-11.5
													c-3.5-7.1-2.7-15.5,2.1-21.8L292,8.1c6.3-8.2,17.5-10.5,26.6-5.5c9,5,12.9,15.9,9.3,25.5l-60.4,158.2h109.9
													c7.9,0,15.1,4.5,18.6,11.5c3.5,7,2.7,15.5-2.1,21.7L194.5,481.8C190.4,487.1,184.3,490,177.9,490z M154.6,256.3h82.7
													c6.6,0,12.8,3.1,16.7,8.4c3.9,5.3,5.1,12.1,3.1,18.4l-24.8,80.4l103.3-135.9h-98.3c-6.8,0-13.2-3.4-17.1-9
													c-3.9-5.6-4.7-12.8-2.3-19.1l20.1-52.5L154.6,256.3z"></path>
											</svg>
										</div>
										<span>Flashcards</span>	
										<small>some description </small>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url();?>studyset/learn/<?php echo $studyset['study_set_id'];?>">
										<div class="learn flashcards_detail">
											<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
											  <path d="m327,433.5h-141.9c-11.3,0-20.4-9.1-20.4-20.4v-11c0-42-14.1-82.2-39.7-113.3-30-36.3-43.2-82.3-37.4-129.5 9.5-76.7 72.1-138.5 149-147.1 6.5-0.7 13-1.1 19.5-1.1 93.6,0 169.8,76.2 169.8,169.8 0,38.4-12.5,74.5-36.1,104.7-27.7,35.4-42.4,75.7-42.4,116.6v11c-5.68434e-14,11.1-9.2,20.3-20.4,20.3zm-121.7-40.9h101.4c2.1-46.8 19.5-92.4 50.9-132.4 17.9-22.9 27.4-50.3 27.4-79.5 0-71.1-57.9-129-129-129-4.9,0-10,0.3-15,0.8-58.3,6.5-105.8,53.4-113,111.6-4.4,35.9 5.6,70.9 28.4,98.5 29.8,36.2 46.9,82 48.9,130z"></path>
											  <path d="m313.6,501h-115.2c-11.3,0-20.4-9.1-20.4-20.4 0-11.3 9.1-20.4 20.4-20.4h115.2c11.3,0 20.4,9.1 20.4,20.4 0.1,11.3-9.1,20.4-20.4,20.4z"></path>
											</svg>
										</div>
										<span>Learn</span>	
										<small>some description </small>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url();?>studyset/match/<?php echo $studyset['study_set_id'];?>">
										<div class="match flashcards_detail">
											<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
											  <path d="m463,195l-71.7-96.1c-36.3-48.6-91.7-76.5-152.2-76.5-33.1,0-65,8.5-93.5,24.8-18.2-21.4-45.1-34.9-73.4-35.9-6-0.2-31.1,1.2-36.7,0.1-11.1-2.2-21.8,5-24,16-2.2,11.1 5,21.8 16,24 10.7,2.1 39.1,0.5 43.2,0.6 15.6,0.6 30.8,7.8 41.6,19.2-72.7,65.3-84.8,177.3-25.2,257.1l71.7,96.1c36.2,48.7 91.7,76.6 152.2,76.6 41.4,0 80.8-13.3 114.2-38.5 83.7-63.2 100.7-183.2 37.8-267.5zm-104.4-71.7l7.6,10.2-103.2,77.9-96.4-129.2c22.1-12.5 46.8-19 72.5-19 47.5,0 91,21.9 119.5,60.1zm-224.5-16.4l96.4,129.2-103.2,77.9-7.5-10c-45.3-60.7-37.9-145 14.3-197.1zm266.3,323.2c-26,19.7-56.9,30.1-89.4,30.1-47.5,0-91-21.9-119.5-60.1l-39.8-53.4 238.9-180.5 39.7,53.2c49.4,66.3 36.1,160.8-29.9,210.7z"></path>
											</svg>
										</div>
										<span>Match</span>	
										<small>some description </small>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url();?>studyset/write/<?php echo $studyset['study_set_id'];?>">
										<div class="write flashcards_detail">
											<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
												<path d="m495,211.9l-194.9-194.9c-8-8-20.9-8-28.9,0l-115.4,115.4c-10.8,11.3-4.4,25.3 0,28.9l19.3,19.3-147.7,118c-6.1,4.9-8.9,12.9-7.1,20.5 0.1,0.5 12.2,55.4-8.8,156.5-1.5,7.1 0.9,14.2 6,19 3.8,4 10.8,7.6 18.9,5.9 100.1-20.6 156.1-8.9 156.5-8.8 7.6,1.7 15.6-1 20.5-7.2l118.1-147.7 19.3,19.3c11.3,10.7 24.8,4.7 28.9,0l115.3-115.4c3.8-3.8 11.2-16.2 0-28.8zm-306.1,237.9c-17.2-2.2-51-4.5-99.5,0.9l74.4-74.4c8-8 8-20.9 0-28.9-8-8-20.9-8-28.9,0l-73.5,73.5c5.2-47.7 2.9-80.8 0.7-97.8l142-113.5 98.2,98.2-113.4,142zm176.2-136.9l-166-166 86.6-86.6 166,166-86.6,86.6z"></path>
											</svg>
										</div>
										<span>Write</span>	
										<small>some description </small>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url();?>studyset/test/<?php echo $studyset['study_set_id'];?>">
										<div class="test flashcards_detail">
											<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 501.333 501.333">
												<path d="M250.667,0C112,0,0,112,0,250.667s112,250.667,250.667,250.667s250.667-112,250.667-250.667S389.333,0,250.667,0z
													M250.667,459.733c-115.2,0-209.067-93.867-209.067-209.067S135.467,41.6,250.667,41.6s209.067,93.867,209.067,209.067
													S365.867,459.733,250.667,459.733z"></path>
												<path d="M314.667,229.333H272V129.067c0-11.733-9.6-21.333-21.333-21.333c-11.733,0-21.333,9.6-21.333,21.333v121.6
													c0,11.733,9.6,21.333,21.333,21.333h64C326.4,272,336,262.4,336,250.667C336,238.933,326.4,229.333,314.667,229.333z"></path>
											</svg>
										</div>
										<span>Test</span>	
										<small>some description </small>
									</a>
								</li>
							</ul>
						</div>										
						<div class="tabularLiist">
							<ul class="nav nav-tabs">
							    <li class="active"><a data-toggle="tab" href="#terms">Terms</a></li>
							    <li><a data-toggle="tab" href="#testResult">Test Results</a></li>
							    <li><a data-toggle="tab" href="#rating">Rating</a></li>
							    <li><a data-toggle="tab" href="#comment">Comment</a></li>
							</ul>
							<div class="tab-content">
							    <div id="terms" class="tab-pane fade in active">
							      <div class="cardWrapper">
							      	<?php
							      	foreach ($term_data as $key => $value) {
							      	?>
							      	<div class="card">
							      		<div class="left">
							      			<div class="innerLeft">
							      				<?php echo $value['term_name'];?>
							      			</div>
							      			<div class="innerRight">
							      				<figure>
							      					<?php
													if($value['term_image']) {
													?>
														<img src="<?php echo base_url();?>uploads/studyset/<?php echo $value['term_image'];?>" alt="User">
													<?php
													} else {
													?>
														<img src="<?php echo base_url();?>assets_d/images/default.png" alt="user">
													<?php
													}
													?>
							      				</figure>
							      			</div>
							      		</div>
							      		<div class="right">
								      		<?php echo $value['term_description'];?>
								      	</div>
							      	</div>
							      	<?php
							      	}
							      	?>
							      </div>
							    </div>
							    <div id="testResult" class="tab-pane fade">
							    	<div class="testWrapper">
							      		<h3 class="mb-2">Your Recent Attempts</h3>
								      	<table class="table table-borderless sp-table">
											<thead>
													<tr>
														<th>Rank</th>
														<th>User</th>
														<th>Score</th>
														<th>Time Spent</th>
														<th>Date</th>
													</tr>
											</thead>
											<tbody>
												<tr>
													<td data-th="Rank"><span class="bt-content">1</span></td>
													<td data-th="User"><span class="bt-content">				<div class="sp-avatar sp-avatar--small">
														<a href="" class="sp-avatar__image">
															<img alt="" src="images/default-avatar.svg" class="avatar avatar-30 photo avatar-default" height="30" width="30">					</a>
														<div class="sp-avatar__content">
															<span class="sp-avatar__name">Developer</span>
														</div>
													</div>
													</span></td>
													<td data-th="Score"><span class="bt-content">2 / 4</span></td>
													<td data-th="Time Spent"><span class="bt-content">56 Seconds</span></td>
													<td data-th="Date"><span class="bt-content">9 hours ago</span></td>
												</tr>
											</tbody>
										</table>
										<h3 class="mb-2">Top Ranking</h3>
										<table class="table table-borderless sp-table">
											<thead>
											<tr>
														<th>Rank</th>
														<th>User</th>
														<th>Score</th>
														<th>Time Spent</th>
														<th>Date</th>
													</tr>
											</thead>
											<tbody>
												<tr>
														<td data-th="Rank"><span class="bt-content">1</span></td>
														<td data-th="User"><span class="bt-content">		<div class="sp-avatar sp-avatar--small">
													<a href="https://studypeers.com/profile/developer/" class="sp-avatar__image">
														<img alt="" src="https://studypeers.com/wp-content/themes/studypeers/assets/images/default-avatar.svg" srcset="https://studypeers.com/wp-content/themes/studypeers/assets/images/default-avatar.svg 2x" class="avatar avatar-30 photo avatar-default" height="30" width="30">			</a>
													<div class="sp-avatar__content">
														<span class="sp-avatar__name">Developer</span>
													</div>
												</div>
												</span></td>
														<td data-th="Score"><span class="bt-content">2 / 4</span></td>
														<td data-th="Time Spent"><span class="bt-content">56 Seconds</span></td>
														<td data-th="Date"><span class="bt-content">9 hours ago</span></td>
													</tr>
											</tbody>
										</table>
										<h3 class="mb-2">Recent Attempts</h3>
										<table class="table table-borderless sp-table">
											<thead>
											<tr>
														<th>Rank</th>
														<th>User</th>
														<th>Score</th>
														<th>Time Spent</th>
														<th>Date</th>
													</tr>
											</thead>
											<tbody>
												<tr>
														<td data-th="Rank"><span class="bt-content">1</span></td>
														<td data-th="User"><span class="bt-content">		<div class="sp-avatar sp-avatar--small">
													<a href="https://studypeers.com/profile/developer/" class="sp-avatar__image">
														<img alt="" src="https://studypeers.com/wp-content/themes/studypeers/assets/images/default-avatar.svg" srcset="https://studypeers.com/wp-content/themes/studypeers/assets/images/default-avatar.svg 2x" class="avatar avatar-30 photo avatar-default" height="30" width="30">			</a>
													<div class="sp-avatar__content">
														<span class="sp-avatar__name">Developer</span>
													</div>
												</div>
												</span></td>
														<td data-th="Score"><span class="bt-content">2 / 4</span></td>
														<td data-th="Time Spent"><span class="bt-content">56 Seconds</span></td>
														<td data-th="Date"><span class="bt-content">9 hours ago</span></td>
													</tr>
											</tbody>
										</table>
								     </div>
							    </div>
							    <div id="rating" class="tab-pane fade">
							    	<section class="activity piechart">
										<h3>ANALYTICS</h3>
										<section class="analyticData">
											<p><span>Customers</span></p>
											<p><span>Users</span></p>
										</section>
										<section class="myChartDiv">
										  <canvas id="myChart" width="200" height="auto"></canvas>
										</section>
									</section>
							      <div class="ratingWrapper">
							      	<div class="ratingCard current_user_rating edit_rating hide">
							      		<div class="left">
							      			<h5>Rate this Study Set</h5>
							      			<div class="my-rating-6" data-rating="1.5"></div>
							      			<a href="#" class="filterBtn">Submit rating</a>
							      		</div>
							      		<div class="right">
							      			<textarea value="Loreum Ipsum"></textarea>
							      			<div class="custom-control custom-checkbox mb-3">
										      <input type="checkbox" class="custom-control-input" id="customCheck" name="example1">
										      <label class="custom-control-label" for="customCheck">Anonymous</label>
										    </div>
							      		</div>
							      	</div>
							      	<div class="ratingCard current_user_rating rating_view">
							      		<div class="left">
							      			<h5>Your Rating</h5>
							      			<div class="my-rating-5" data-rating="1.5"></div>
							      			<a href="javascript:void(0)" class="filterBtn edit_rating">Edit rating</a>
							      		</div>
							      		<div class="right">
							      			<span>06/14/2020</span>
							      			<p>Loreum Ipsum</p>
							      		</div>
							      	</div>
							      	<div class="ratingCard">
							      		<div class="my-rating-4" data-rating="1.5"></div>
							      		<p>Loreum Ipsum</p>
							      		<div class="sp-avatar sp-avatar--small">
											<a href="#" class="user_avatar">
												<div class="sp-avatar__image">
													<img alt="" src="images/default-avatar.svg" class="avatar avatar-96 photo avatar-default" height="96" width="96">
												</div>
												<div class="sp-avatar__content"><span class="sp-avatar__name"> </span><time>06/14/2020</time></div>
											</a>						
										</div>
							      	</div>
							      </div>
							    </div>
							    <div id="comment" class="tab-pane fade">
							    	<div class="chatCommentWrapper">
							    		<div class="listChatWrap">
							    			<div class="chatMsg">
							    				<figure>
							    					<img src="images/ct_user.jpg" alt="User">
							    				</figure>
							    				<figcaption>
							    					<span class="name"> Henric jenifer</span>
								    				Happy Birthday								    				
								    				<div class="actionmsgMenu">
								    					<ul>
								    						<li class="likeuser">Like</li>
								    						<li class="replyuser">Reply</li>
								    					</ul>
								    				</div>
								    				<div class="reactmessage">
								    					<div class="react">
								    						<img src="images/like.png" alt="Like">
								    					</div>
								    					<p>1</p>
								    				</div>
								    			</figcaption>
								    			<div class="replyBox">
								    				<figure>
								    					<img src="images/ct_user.jpg" alt="User">
								    				</figure>
								    				<div class="replyuser">
								    					<input type="text" placeholder="Write a Reply...">
								    				</div>
								    			</div>								    				
							    			</div>
							    			<div class="chatMsg">
							    				<figure>
							    					<img src="images/ct_user.jpg" alt="User">
							    				</figure>
							    				<figcaption>
							    					<span class="name"> Henric jenifer</span>
								    				पुलिस ने क़ैदी से पूछा तुम पागल कैसे हुए?

													क़ैदी: ऐसे
													.
													.
													.
													...See more							    				
								    				<div class="actionmsgMenu">
								    					<ul>
								    						<li class="likeuser">Like</li>
								    						<li class="replyuser">Reply</li>
								    					</ul>
								    				</div>
								    			</figcaption>							    				
							    			</div>
							    		<div class="chatreplyBox">
							    			<input type="text" name="" placeholder="Comment..">
							    		</div>
							    	</div>
							    </div>
							 </div>
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
        					<img src="images/user2.jpg" alt="user">
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
        					<img src="images/user2.jpg" alt="user">
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
        					<img src="images/user2.jpg" alt="user">
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
        					<img src="images/user2.jpg" alt="user">
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
        					<img src="images/user2.jpg" alt="user">
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
        					<img src="images/user2.jpg" alt="user">
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
        					<img src="images/user2.jpg" alt="user">
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
        					<img src="images/user2.jpg" alt="user">
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
        					<img src="images/user2.jpg" alt="user">
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
        					<img src="images/user2.jpg" alt="user">
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
<div class="modal fade" id="reportModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <div class="modal-body peers">
	          	   <h4>Reason</h4>
		           <div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Reason for Report</label>
								<div class="reason">
									<select class="form-control" id="report_reason">
										<option value="">Select Reason</option>
										<option value="Inappropriate Content">Inappropriate Content</option>
										<option value="Spam">Spam</option>
										<option value="Promotional">Promotional</option>
										<option value="Uncivil">Uncivil</option>
										<option value="Other">Other</option>
									</select>
									<span class="error" id="report_reason_err"></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Reason</label>
								<div class="reason droparea">
									<textarea id="report_description"></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<input type="hidden" id="report_id" value="<?php echo $studyset['study_set_id'];?>">
								<button type="button" class="filterBtn reportBtn">Submit</button>
							</div>
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
<div class="modal fade" id="courseModal" role="dialog">
	<div class="modal-dialog">
	  <!-- Modal content-->
	  <div class="modal-content">
	      <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
	    <div class="modal-body">
	      	<div class="courseHeader">
	      		<h4>Course</h4>
	      		<div class="add_course">
					<svg height="512pt" 
						viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg"><path d="m256 0c-141.164062 0-256 114.835938-256 256s114.835938 256 256 256 256-114.835938 256-256-114.835938-256-256-256zm0 0" fill="#2196f3"/><path d="m368 277.332031h-90.667969v90.667969c0 11.777344-9.554687 21.332031-21.332031 21.332031s-21.332031-9.554687-21.332031-21.332031v-90.667969h-90.667969c-11.777344 0-21.332031-9.554687-21.332031-21.332031s9.554687-21.332031 21.332031-21.332031h90.667969v-90.667969c0-11.777344 9.554687-21.332031 21.332031-21.332031s21.332031 9.554687 21.332031 21.332031v90.667969h90.667969c11.777344 0 21.332031 9.554687 21.332031 21.332031s-9.554687 21.332031-21.332031 21.332031zm0 0" fill="#fafafa"/>
					</svg>
	      			Add a course
	      		</div>
	      	</div>
	      	<div class="courseBox">
	      		<div class="removeCourseBox">
					<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" 
								xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512.001 512.001;" xml:space="preserve">
						<g>
							<g>
								<path d="M284.286,256.002L506.143,34.144c7.811-7.811,7.811-20.475,0-28.285c-7.811-7.81-20.475-7.811-28.285,0L256,227.717
									L34.143,5.859c-7.811-7.811-20.475-7.811-28.285,0c-7.81,7.811-7.811,20.475,0,28.285l221.857,221.857L5.858,477.859
									c-7.811,7.811-7.811,20.475,0,28.285c3.905,3.905,9.024,5.857,14.143,5.857c5.119,0,10.237-1.952,14.143-5.857L256,284.287
									l221.857,221.857c3.905,3.905,9.024,5.857,14.143,5.857s10.237-1.952,14.143-5.857c7.811-7.811,7.811-20.475,0-28.285
									L284.286,256.002z"/>
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

	      		</div>
	      		<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<input type="text" name="" class="form-control form-control--lg" placeholder="Course">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<input type="text" name="" class="form-control form-control--lg" placeholder="Professor First Name">
						</div>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<input type="text" name="" class="form-control form-control--lg" placeholder="Professor Last Name">
						</div>
					</div>
				</div>
	      	</div>
	      	<div class="studybuttonGroup">
				<button type="button" class="transparentBtn" onclick="">Cancel</button>
				<button type="submit" class="filterBtn">
					Add
				</button>
			</div>
	    </div>
	  </div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$(document).on('click','.deleteStudySet',function(){
		var delete_id = $(this).data('id');
		$("#ss_id").val(delete_id);

	});

	$(document).on('click','.reportBtn',function(){
		var study_set_id = $("#report_id").val();
		var report_reason = $("#report_reason").val();
		var report_description = $("#report_description").val();
		if(report_reason == ''){
			$("#report_reason_err").html('Please select reason.');
			return false;
		}
		if(study_set_id != '' && report_reason != ''){
			$.ajax({
				url : '<?php echo base_url();?>studyset/reportStudySet',
				type : 'post',
				data : {"study_set_id" : study_set_id,'report_description' : report_description, "report_reason" : report_reason},
				success:function(result) {
					$("#confirmationModal").modal('hide');
					window.location='<?php echo base_url();?>studyset';
				}	
			})
		}
	});

	$(document).on('click','.likecount',function(){
		var study_set_id = $(this).data('id');
		var that = $(this);
		$.ajax({
			url : '<?php echo base_url();?>studyset/manageLikes',
			type : 'post',
			data : {"study_set_id" : study_set_id},
			success:function(result) {
				if(result.trim() == 1) {
					that.find('i').addClass('fa-thumbs-up');
				} else {
					that.find('i').removeClass('fa-thumbs-up');
				}
			}
		})
	});

	const yLabels = {
			    0 : 100,
			      200 : 200,
			      400 : 300,
			      600 : 400,
			      800 : 500,
			      1000 : 600,
			      1200 : 700,
			      1400 : 800,
			      1600 : 900,
			      1800 : 1000
			  };
    Chart.defaults.global.elements.line.fill = false;
      const barChartData = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
        datasets: [{
        type: 'bar',
        label: 'a',
        id: "y-axis-0",
        backgroundColor: "rgba(48,63,159,0.75)",
        data: [550, 200, 200, 200,450,400,450,450,450,350,450,450]
        }, {
        type: 'bar',
        label: 'b',
        id: "y-axis-0",
        backgroundColor: "rgba(63,81,181,0.75)",
        data: [690, 210, 250, 300,650,500,780,620,700,500,620,650]
        }]
    };
      const ctx = document.getElementById("myChart");
      // allocate and initialize a chart
      const ch = new Chart(ctx, {
        type: 'bar',
        scaleOverride : true,
        data: barChartData,
        options: {
      legend: {
        display: false
      },
          title: {
            display: true,
            text: ""
          },
          tooltips: {
            mode: 'label'
          },
          responsive: true,
          scales: {
            xAxes: [{
              stacked: true,
              gridLines: {
                    display:false
                }
            }],
            yAxes: [{
              stacked: true,
              position: "left",
         ticks: {
                    beginAtZero: true,
                    callback(value, index, values) {
                        return yLabels[value];
                    }
                },
              gridLines: {
                    display:false
              },
              id: "y-axis-0",
            }, {
        display: false,
              stacked: false,
              position: "right",
              gridLines: {
                    display:false
              },
              id: "y-axis-1",
            }]
          }
        }
      });

})

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
				window.location='<?php echo base_url();?>studyset';
			}	
		})
	}
}
</script>