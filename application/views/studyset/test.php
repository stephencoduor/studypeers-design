
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
								<span class="studySets  test">
									<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
									  <path d="m327,433.5h-141.9c-11.3,0-20.4-9.1-20.4-20.4v-11c0-42-14.1-82.2-39.7-113.3-30-36.3-43.2-82.3-37.4-129.5 9.5-76.7 72.1-138.5 149-147.1 6.5-0.7 13-1.1 19.5-1.1 93.6,0 169.8,76.2 169.8,169.8 0,38.4-12.5,74.5-36.1,104.7-27.7,35.4-42.4,75.7-42.4,116.6v11c-5.68434e-14,11.1-9.2,20.3-20.4,20.3zm-121.7-40.9h101.4c2.1-46.8 19.5-92.4 50.9-132.4 17.9-22.9 27.4-50.3 27.4-79.5 0-71.1-57.9-129-129-129-4.9,0-10,0.3-15,0.8-58.3,6.5-105.8,53.4-113,111.6-4.4,35.9 5.6,70.9 28.4,98.5 29.8,36.2 46.9,82 48.9,130z"></path>
									  <path d="m313.6,501h-115.2c-11.3,0-20.4-9.1-20.4-20.4 0-11.3 9.1-20.4 20.4-20.4h115.2c11.3,0 20.4,9.1 20.4,20.4 0.1,11.3-9.1,20.4-20.4,20.4z"></path>
									</svg>
								</span>Test <a href="#" onclick="window.print()" class="print-btn">Print this test</a>
							</h4>
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
						<form method="post" action="<?php echo base_url(); ?>studyset/submitTest" id="test-form" style="display: none;">
							<input type="hidden" id="studyset_id" name="studyset_id" value="<?php echo $studyset['study_set_id']; ?>">
							<input type="hidden" id="total_time" name="total_time">

							<input type="hidden" id="written_applicable" name="written_applicable" value="0">
							<input type="hidden" id="match_applicable" name="match_applicable" value="0">
							<input type="hidden" id="multiple_applicable" name="multiple_applicable" value="0">
							<input type="hidden" id="truefalse_applicable" name="truefalse_applicable" value="0">

							<div class="commoncard study-set-test-form" id="written_commoncard" style="display: none;">
								<h3><?php echo count($term_data); ?> Written Questions</h3>
								<?php $count = 1; foreach ($term_data as $key => $value) { ?>
									<div class="test-item">
										<div class="test-item-index"><?php echo $count; ?></div>
										<div class="d-flex">
											<div class="flex-fill">
												<p class="text-item-desc mb-20 text-capitalise">  <?php echo $value['term_description']; ?></p>
												<?php if(!empty($value['term_image'])) { ?>
													<img src="<?php echo base_url(); ?>uploads/studyset/<?php echo $value['term_image']; ?>" alt="Study Set" style="height: 90px;margin-right: 5px; border-radius: 5px;">
												<?php } ?>
												<div class="test-input form-group mt-20">
													<input type="text" class="form-control form-control--lg" name="written_answer[]" placeholder="Type your answer." required>
													<input type="hidden" name="written_term_id[]" value="<?php echo $value['study_set_term_id']; ?>">
												</div>
											</div>									
										</div>
									</div>	
								<?php $count++; } ?>
								
							</div>
							<div class="commoncard study-set-test-form" id="match_commoncard" style="display: none;">
								<div class="test test-item">
									<h3><?php echo count($term_data); ?> Matching Questions</h3>
									<?php $random_arr = $term_data; 
										shuffle($random_arr); 
										foreach ($term_data as $key => $value) { 
									?>
										<div class="row" style="margin-bottom: 10px;">
											<div class="col-md-8 matching-item">
												<div class="text-item-desc  mb-5">
													<input type="text" value="" name="matching_answer[]" class="form-control form-control--lg d-inline mr-2 match-input" style="max-width: 50px" required="">
													<input type="hidden" name="matching_term_id[]" value="<?php echo $value['study_set_term_id']; ?>">
													<p class="text-capitalise"><?php echo $value['term_description']; ?></p>
														<?php if(!empty($value['term_image'])) { ?>
															<div class="text-item-desc" style="margin-left: 15px;">
															<img src="<?php echo base_url(); ?>uploads/studyset/<?php echo $value['term_image']; ?>" alt="Study Set" style="height: 90px;margin-right: 5px; border-radius: 5px;"></div>
														<?php } ?>  	
												</div>
											</div>
											<div class="col-md-4">
												<div class="match-card-desc mb-3 pull-right">
													<div class="card-image--sm question-card-desc">
														<?php echo $random_arr[$key]['term_name']; ?>
													</div>
													<input type="hidden" name="letter_answer[]" value="<?php echo $letters[$key]; ?> <?php echo $random_arr[$key]['study_set_term_id']; ?>">
													<strong class="match-bet"><?php echo $letters[$key]; ?></strong>											
												</div>
											</div>
										</div>	
									<?php } ?>
								</div>
							</div>
							<div class="commoncard study-set-test-form" id="multiple_commoncard" style="display: none;">
								<div class="test test-item">
									<h3><?php echo count($term_data); ?> Multiple Choice Questions</h3>
									<?php $count = 1; foreach ($term_data as $key => $value) {  ?>
										<div class="test-item">
											<div class="test-item-index"><?php echo $count; ?></div>
											<div class="d-flex">
												<div class="flex-fill">
													<p class="text-item-desc mb-20 text-capitalise"> <?php echo $value['term_description']; ?></p>
													<?php if(!empty($value['term_image'])) { ?>
														<img src="<?php echo base_url(); ?>uploads/studyset/<?php echo $value['term_image']; ?>" alt="Study Set" style="height: 90px;margin-right: 5px; border-radius: 5px;">
													<?php } ?>
													<input type="hidden" name="multiple_term_id[]" value="<?php echo $value['study_set_term_id']; ?>">
													<div class="result"></div>
													<?php if(count($term_data) > 3) {
														$exclude_arr = $term_data; 
															unset($exclude_arr[$key]); 
															$random_keys = array_rand($exclude_arr,3);
															$random_keys[3] = $key; 
															shuffle($random_keys); 
													
													?>
													<div class="mcq-group-74 mt-20">
														<?php foreach ($random_keys as $key2 => $value2) { ?>
															<div>
																<div class="form-group">
																	<label class="custom-radio">
																		<input type="radio" name="multiple_answer_<?php echo $value['study_set_term_id']; ?>" value="<?php echo $term_data[$value2]['study_set_term_id']; ?>" required="">
																		<span class="checkmark"></span> <?php echo $term_data[$value2]['term_name'] ?>		</label>
																</div>

															</div>
														<?php } ?>
													</div>

													<?php } else { ?>
													<div class="mcq-group-74">
															<?php foreach ($term_data as $key2 => $value2) { ?>
																<div>
																	<div class="form-group">
																		<label class="custom-radio">
																			<input type="radio" name="multiple_answer_<?php echo $value2['study_set_term_id']; ?>" value="<?php echo $value2['study_set_term_id']; ?>" required="">
																			<span class="checkmark"></span> <?php echo $value2['term_name'] ?>		</label>
																	</div>

																</div>
															<?php } ?>
													</div>
													<?php } ?>
													


												</div>

																	
											</div>
										</div>
									<?php $count++; } ?>
								</div>
							</div>
							<div class="commoncard study-set-test-form" id="truefalse_commoncard" style="display: none;">
								<div class="test test-item">
									<h3><?php echo count($term_data); ?> True/False questions</h3>
									<?php $random_arr = $term_data; 
										shuffle($random_arr); $count = 1;
										$per_val = round (count($term_data) * 40 / 100); 
										
										$true_arr = array_slice($random_arr, 0, $per_val); $false_arr = array_slice($random_arr, $per_val); $false_key = 0; 
										foreach ($term_data as $key => $value) { 
									?>
										<div class="test-item">
											<div class="test-item-index"><?php echo $count; ?></div>
											<div class="d-flex">
												<div class="flex-fill">
													<p class="text-capitalise"><strong><?php echo $value['term_description']; ?></strong>
													</p><?php if(!empty($value['term_image'])) { ?>
														<img src="<?php echo base_url(); ?>uploads/studyset/<?php echo $value['term_image']; ?>" alt="Study Set" style="height: 90px;margin-right: 5px; border-radius: 5px;">
													<?php } ?><br>
													<p class="text-capitalise">
													<?php if(array_search($value['study_set_term_id'], array_column($true_arr, 'study_set_term_id')) !== false) {
														echo $value['term_name'];
														$truefalse_term = $value['study_set_term_id'];
													} else {
														echo $false_arr[$false_key]['term_name'];
														$truefalse_term = $false_arr[$false_key]['study_set_term_id'];
														$false_key++;
													} ?>

													</p>
													<input type="hidden" name="truefalse_term[]" value="<?php echo $truefalse_term; ?>">
													<input type="hidden" name="truefalse_term_id[]" value="<?php echo $value['study_set_term_id']; ?>">
													<div class="tf-group-74">
														<div>

															<label class="custom-radio">
																<input type="radio" name="truefalse_answer_<?php echo $value['study_set_term_id']; ?>" value="true" required="">
																<span class="checkmark"></span>True							
															</label>
														</div>
														<div>
															<label class="custom-radio">
																<input type="radio" name="truefalse_answer_<?php echo $value['study_set_term_id']; ?>" value="false" required="">
																<span class="checkmark"></span>False							
															</label>
														</div>
													</div>
												</div>		
											</div>
										</div>
									<?php $count ++; } ?>
								</div>
							</div>

							<div class="btnWrap">
								<button type="submit" class="filterBtn">submit Test</button>
							</div>
						</form>

						
					</div>
				</section>
				
			</section>
		</section>
	</section>
<div class="modal " id="peersMessageModal" role="dialog">
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


<div class="modal fade" id="TestModalAll" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
              <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            <div class="modal-body" >
                <div class="courseHeader">
                    <h4>Choose Test</h4>
                    
                </div>
                <div id="TestModalAllBody">
                	<div class="courseBox" style="padding-top: 10px;">
                        
                        <div class="row">
                            <div class="col-md-1 col-sm-1 col-xs-12">
                                <div class="form-group" style="margin-bottom: 0px;">
                                    <input type="checkbox" class="form-control form-control--lg option" style="margin: 0;" id="written">
                                </div>
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-12" style="padding: 0;">
                                <h4 style="margin-top: 12px;">Written Questions</h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-1 col-sm-1 col-xs-12">
                                <div class="form-group" style="margin-bottom: 0px;">
                                    <input type="checkbox" class="form-control form-control--lg option" style="margin: 0;" id="match">
                                </div>
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-12" style="padding: 0;">
                                <h4 style="margin-top: 12px;">Matching Questions</h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-1 col-sm-1 col-xs-12">
                                <div class="form-group" style="margin-bottom: 0px;">
                                    <input type="checkbox" class="form-control form-control--lg option" style="margin: 0;" id="multiple">
                                </div>
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-12" style="padding: 0;">
                                <h4 style="margin-top: 12px;">Multiple Choice Questions</h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-1 col-sm-1 col-xs-12">
                                <div class="form-group" style="margin-bottom: 0px;">
                                    <input type="checkbox" class="form-control form-control--lg option" style="margin: 0;" id="truefalse">
                                </div>
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-12" style="padding: 0;">
                                <h4 style="margin-top: 12px;">True/False Questions</h4>
                            </div>
                            <div class="col-md-12" style="margin-bottom: 10px;">
                            	<span class="custom_err" id="option_err"></span>
                            </div>
                        </div>

                        
                        
                    </div>
                </div>
                
                <div class="studybuttonGroup">
                    <button type="button" class="transparentBtn" onclick="applyTest()">Apply</button>
                </div>
                
            </div>
          </div>
        </div>
</div>

<script>

function startTimer(){

	var timer2 = "00:00:00";

	var interval = setInterval(function() {


	  var timer = timer2.split(':'); 
	  //by parsing integer, I avoid all extra string processing
	  var hours = parseInt(timer[0], 10);
	  var minutes = parseInt(timer[1], 10);
	  var seconds = parseInt(timer[2], 10);
	  ++seconds;
	  
	  hours = (hours < 10) ? '0' + hours : hours;
	  minutes = (seconds > 59) ? ++minutes : minutes;
	  minutes = (minutes < 10) ? '0' + minutes : minutes;
	  if(minutes > 59) {
	    minutes = 0;
	    hours = ++hours;
	  } else {
	    minutes = minutes;
	  }
	  // minutes = (minutes > 59) ? 0 : minutes;
	  if (minutes < 0) clearInterval(interval);
	  seconds = (seconds > 59) ? 0 : seconds;
	  seconds = (seconds < 10) ? '0' + seconds : seconds;
	  //minutes = (minutes < 10) ?  minutes : minutes;
	  $('#matchtime').html(hours + ':' + minutes + ':' + seconds);
	  // if ((seconds <= 0) && (minutes <= 0)) {
	  // 	clearInterval(interval);
	  // 	$('#timerOutModal').modal('show');
	  // }
	  timer2 = hours+ ':' + minutes + ':' + seconds;
	  val = timer2;
	  $('#total_time').val(val);
	  
	}, 1000);

}

function applyTest(){
	var len = $('.option:checked').length;
	if(len == 0){
		$('#option_err').html('Choose the test.').show();
	} else {
		$('#option_err').html('').hide();
		$('.option').each(function() {
		    var id = this.id;
		    if($('#'+id+':checked').length > 0){
			   $('#'+id+'_applicable').val(1);
			   $('#'+id+'_commoncard').show();
		    } else {
		    	$('#'+id+'_commoncard').html('');
		    }
		});
		$('#test-form').show();
	    $('#TestModalAll').modal('hide');
	    startTimer();
	}
}
</script>