
				<section class="mainContent noPadding">
					<div class="main_subheader">
						<div class="main_subheaderLeft">
							<a href="<?php echo base_url();?>studyset/details/<?php echo $studyset['study_set_id'];?>">
								<svg class="sp-icon" version="1.1" id="Layer_1" 
								    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 490 490" style="enable-background:new 0 0 490 490;" xml:space="preserve">
									<path d="M245.9,436.3c14.8-16.4,13.9-41.5-2-56.8l-101.5-94.4l308.4-0.7c22.2-0.6,39.7-19,39.2-41.1c-0.5-21.4-17.7-38.6-39.1-39.1
										l-308.6,0.7l101.5-94.4c16.2-15.1,17.1-40.6,2-56.8c-15.1-16.2-40.6-17.1-56.8-2l-176.2,164C4.7,223.3,0.1,233.9,0,245
										c0,11.1,4.6,21.7,12.8,29.3L189,438.2c16.2,15.2,41.6,14.4,56.8-1.7c0.1-0.1,0.2-0.2,0.2-0.2H245.9z"></path>
								</svg>
								Back
							</a>
							<h4>
								<span class="studySets  learn">
									<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
									  <path d="m327,433.5h-141.9c-11.3,0-20.4-9.1-20.4-20.4v-11c0-42-14.1-82.2-39.7-113.3-30-36.3-43.2-82.3-37.4-129.5 9.5-76.7 72.1-138.5 149-147.1 6.5-0.7 13-1.1 19.5-1.1 93.6,0 169.8,76.2 169.8,169.8 0,38.4-12.5,74.5-36.1,104.7-27.7,35.4-42.4,75.7-42.4,116.6v11c-5.68434e-14,11.1-9.2,20.3-20.4,20.3zm-121.7-40.9h101.4c2.1-46.8 19.5-92.4 50.9-132.4 17.9-22.9 27.4-50.3 27.4-79.5 0-71.1-57.9-129-129-129-4.9,0-10,0.3-15,0.8-58.3,6.5-105.8,53.4-113,111.6-4.4,35.9 5.6,70.9 28.4,98.5 29.8,36.2 46.9,82 48.9,130z"></path>
									  <path d="m313.6,501h-115.2c-11.3,0-20.4-9.1-20.4-20.4 0-11.3 9.1-20.4 20.4-20.4h115.2c11.3,0 20.4,9.1 20.4,20.4 0.1,11.3-9.1,20.4-20.4,20.4z"></path>
									</svg>
								</span>Learn
							</h4>
						</div>
						<div class="main_subheaderCenter">
							<div class="set-progress">
								Round <span class="sp-set-progress__round-progress">00</span>
							</div>
							<div class="set-progress">
								Correct <span class="sp-set-progress__answered-progress">00</span>
							</div>
							<div class="set-progress">
								Missed <span class="sp-set-progress__missed-progress">00</span>
							</div>
						</div>
						<div class="main_subheaderRight">
							<svg class="timer-tracker__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 501.333 501.333">
								<path d="M250.667,0C112,0,0,112,0,250.667s112,250.667,250.667,250.667s250.667-112,250.667-250.667S389.333,0,250.667,0z
									M250.667,459.733c-115.2,0-209.067-93.867-209.067-209.067S135.467,41.6,250.667,41.6s209.067,93.867,209.067,209.067
									S365.867,459.733,250.667,459.733z"></path>
								<path d="M314.667,229.333H272V129.067c0-11.733-9.6-21.333-21.333-21.333c-11.733,0-21.333,9.6-21.333,21.333v121.6
									c0,11.733,9.6,21.333,21.333,21.333h64C326.4,272,336,262.4,336,250.667C336,238.933,326.4,229.333,314.667,229.333z"></path>
							</svg>
							<label class="tracker__label">Time Spent</label>
							<div id="matchtime"></div>
						</div>
					</div>
					<div class="mainCardWrapper">
						<?php $count = count($term_data)-1; foreach ($term_data as $key => $value) { ?>
							<div class="commoncard <?php if($key == 0) { echo "current first"; } else if($key == $count) { echo "last"; } ?>" id="learnboxes" style="<?php if($key != 0) { echo "display: none"; } ?>" >
								<div class="learnQuestBox">
									<div class="flashCard_txt">
										<?php if(!empty($value['term_image'])) { ?>
											<img src="<?php echo base_url(); ?>uploads/studyset/<?php echo $value['term_image']; ?>" alt="Study Set" style="height: 100px;">
										<?php } ?>
										<?php echo $value['term_description']; ?>				
									</div>
									<div class="learnbox-answer">
										<?php if($count < 3) { ?>
											<div class="form-group">
												<input type="text" class="form-control single-line" name="" placeholder="Fill in the answer..">
											</div>
										<?php } else { 
											$exclude_arr = $term_data; 
											 unset($exclude_arr[$key]); 
											$random_keys = array_rand($exclude_arr,3);
											$random_keys[3] = $key; 
											 shuffle($random_keys);
										?>

										<?php foreach ($random_keys as $key2 => $value2) { ?>
											<div class="form-group">
												<label class="custom-radio">
													<input type="radio" name="answer[74]" value="" required="" class="checkbox_<?php echo $value['study_set_term_id']; ?>">
													<span class="checkmark" style="font-size: 35px;"></span> <?php echo $term_data[$value2]['term_name'] ?>	
												</label>
											</div>
										<?php } ?>
											
										<?php } ?>
									</div>
									<div class="learnBtnWrapper">
										<button type="button" data-id="<?php echo $value['study_set_term_id']; ?>" class="createBtn checkAnswerLearn">Answer</button>
									</div>
								</div>
								<!-- <div class="learnAnsBox correct" id="learnAnsBox<?php echo $value['study_set_term_id']; ?>" style="display: none">
									<h3><svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
										  <path d="m497.6,244.7c-63.9-96.7-149.7-150-241.6-150-91.9,1.42109e-14-177.7,53.3-241.6,150-4.5,6.8-4.5,15.7 0,22.5 63.9,96.7 149.7,150 241.6,150 91.9,0 177.7-53.3 241.6-150 4.5-6.8 4.5-15.6 0-22.5zm-241.6,131.7c-74.2,0-144.8-42.6-199.9-120.4 55-77.8 125.6-120.4 199.9-120.4 74.2,0 144.8,42.6 199.9,120.4-55.1,77.8-125.6,120.4-199.9,120.4z"></path>
										  <path d="m256,148.5c-59.3,0-107.5,48.2-107.5,107.5 0,59.3 48.2,107.5 107.5,107.5s107.5-48.2 107.5-107.5c0-59.3-48.2-107.5-107.5-107.5zm0,175.5c-36.8,0-66.8-30.5-66.8-68 0-37.5 30-68 66.8-68 36.8,0 66.8,30.5 66.8,68 0,37.5-30,68-66.8,68z"></path>
										</svg> Correct! nicely done.
									</h3>
									<h6>Definition</h6>
									<div class="answer-result__card-desc">
										A model is a group or collection of elements that constitute a distributable software solution. A model is a design time concept. A package is a deployment until that may contain one or more models.	
									</div>	
									<h6><svg class="sp-icon correct-dark mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
										<path d="M440.8,11H71.3C38,11,11,38,11,71.2v369.5C11,474,38,501,71.3,501h369.5c33.2,0,60.2-27,60.2-60.2V71.2
											C501,38,474,11,440.8,11z M460.2,440.8c0,10.7-8.7,19.4-19.4,19.4H71.3c-10.7,0-19.4-8.7-19.4-19.4V71.2c0-10.7,8.7-19.4,19.4-19.4
											h369.5c10.7,0,19.4,8.7,19.4,19.4L460.2,440.8L460.2,440.8z"></path>
										<path d="M232.6,357.4c-5.4,0-10.7-2-14.8-6.2l-87.6-87.6c-8.2-8.2-8.2-21.5,0-29.7c8.2-8.2,21.5-8.2,29.7,0l72.7,72.7l151.7-151.7
											c8.2-8.2,21.5-8.2,29.7,0c8.2,8.2,8.2,21.5,0,29.7L247.4,351.3C243.3,355.4,237.9,357.4,232.6,357.4z"></path>
										</svg>
										 Correct answer
									</h6>	
									<p class="correct-dark-color">
										You are training a new dynamics 365 Finance developer. You need to explain the relationships between models, packages, and projects to the new hire. Which three design concepts should you explain? Each correct answer presents a complete solution.	
									</p>	
									<div class="learnBtnWrapper justifycenter">
										<button type="button" class="createBtn nextLearnAns">Next
											<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
												<path d="M244.1,53.7c-14.8,16.4-13.9,41.5,2,56.8l101.5,94.4l-308.4,0.7C17,206.2-0.5,224.6,0,246.7
													c0.5,21.4,17.7,38.6,39.1,39.1l308.6-0.7l-101.5,94.4c-16.2,15.1-17.1,40.6-2,56.8c15.1,16.2,40.6,17.1,56.8,2l176.2-164
													c8.1-7.6,12.7-18.2,12.8-29.3c0-11.1-4.6-21.7-12.8-29.3L301,51.8c-16.2-15.2-41.6-14.4-56.8,1.7c-0.1,0.1-0.2,0.2-0.2,0.2
													L244.1,53.7z"></path>
											</svg>
										</button>
									</div>			
								</div> -->
								<div class="learnAnsBox wrong" id="learnAnsBox<?php echo $value['study_set_term_id']; ?>" style="display: none">
									<h3><svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="fill: #ff725b;">
										  <path d="m497.6,244.7c-63.9-96.7-149.7-150-241.6-150-91.9,1.42109e-14-177.7,53.3-241.6,150-4.5,6.8-4.5,15.7 0,22.5 63.9,96.7 149.7,150 241.6,150 91.9,0 177.7-53.3 241.6-150 4.5-6.8 4.5-15.6 0-22.5zm-241.6,131.7c-74.2,0-144.8-42.6-199.9-120.4 55-77.8 125.6-120.4 199.9-120.4 74.2,0 144.8,42.6 199.9,120.4-55.1,77.8-125.6,120.4-199.9,120.4z"></path>
										  <path d="m256,148.5c-59.3,0-107.5,48.2-107.5,107.5 0,59.3 48.2,107.5 107.5,107.5s107.5-48.2 107.5-107.5c0-59.3-48.2-107.5-107.5-107.5zm0,175.5c-36.8,0-66.8-30.5-66.8-68 0-37.5 30-68 66.8-68 36.8,0 66.8,30.5 66.8,68 0,37.5-30,68-66.8,68z"></path>
										</svg> Study this one!
									</h3>
									<h6>Definition</h6>
									<div class="answer-result__card-desc">
										A model is a group or collection of elements that constitute a distributable software solution. A model is a design time concept. A package is a deployment until that may contain one or more models.	
									</div>	
									<h6>Your Answer</h6>
									<div class="wrong-dark-color answer-result__card-desc">
										A model is a group or collection of elements that constitute a distributable software solution. A model is a design time concept. A package is a deployment until that may contain one or more models.	
									</div>	
									<h6><svg class="sp-icon correct-dark mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
										<path d="M440.8,11H71.3C38,11,11,38,11,71.2v369.5C11,474,38,501,71.3,501h369.5c33.2,0,60.2-27,60.2-60.2V71.2
											C501,38,474,11,440.8,11z M460.2,440.8c0,10.7-8.7,19.4-19.4,19.4H71.3c-10.7,0-19.4-8.7-19.4-19.4V71.2c0-10.7,8.7-19.4,19.4-19.4
											h369.5c10.7,0,19.4,8.7,19.4,19.4L460.2,440.8L460.2,440.8z"></path>
										<path d="M232.6,357.4c-5.4,0-10.7-2-14.8-6.2l-87.6-87.6c-8.2-8.2-8.2-21.5,0-29.7c8.2-8.2,21.5-8.2,29.7,0l72.7,72.7l151.7-151.7
											c8.2-8.2,21.5-8.2,29.7,0c8.2,8.2,8.2,21.5,0,29.7L247.4,351.3C243.3,355.4,237.9,357.4,232.6,357.4z"></path>
										</svg>
										 Correct answer
									</h6>	
									<p class="correct-dark-color">
										You are training a new dynamics 365 Finance developer. You need to explain the relationships between models, packages, and projects to the new hire. Which three design concepts should you explain? Each correct answer presents a complete solution.	
									</p>	
									<div class="learnBtnWrapper justifycenter">
										<button type="button" class="createBtn nextLearnAns" onclick="nextLearnAns()">Next
											<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
												<path d="M244.1,53.7c-14.8,16.4-13.9,41.5,2,56.8l101.5,94.4l-308.4,0.7C17,206.2-0.5,224.6,0,246.7
													c0.5,21.4,17.7,38.6,39.1,39.1l308.6-0.7l-101.5,94.4c-16.2,15.1-17.1,40.6-2,56.8c15.1,16.2,40.6,17.1,56.8,2l176.2-164
													c8.1-7.6,12.7-18.2,12.8-29.3c0-11.1-4.6-21.7-12.8-29.3L301,51.8c-16.2-15.2-41.6-14.4-56.8,1.7c-0.1,0.1-0.2,0.2-0.2,0.2
													L244.1,53.7z"></path>
											</svg>
										</button>
									</div>			
								</div>
							</div>
						<?php } ?>
					</div>
				</section>
				
			</section>
		</section>
	</section>
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
<script>

var timer2 = "29:59";
// var incrementUrl = '<?php echo base_url(); ?>studyset/incrementFlashcard';
var interval = setInterval(function() {


  var timer = timer2.split(':');
  //by parsing integer, I avoid all extra string processing
  var minutes = parseInt(timer[0], 10);
  var seconds = parseInt(timer[1], 10);
  --seconds;
  minutes = (seconds < 0) ? --minutes : minutes;
  minutes = (minutes < 10) ? '0' + minutes : minutes;
  if (minutes < 0) clearInterval(interval);
  seconds = (seconds < 0) ? 59 : seconds;
  seconds = (seconds < 10) ? '0' + seconds : seconds;
  //minutes = (minutes < 10) ?  minutes : minutes;
  $('#matchtime').html('00:' + minutes + ':' + seconds);
  if ((seconds <= 0) && (minutes <= 0)) {
  	clearInterval(interval);
  	$('#timerOutModal').modal('show');
  }
  timer2 = minutes + ':' + seconds;
  
}, 1000);

</script>