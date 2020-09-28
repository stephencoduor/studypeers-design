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
								<span class="studySets  flash">
									<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
										<path d="M177.9,490c-3.2,0-6.5-0.7-9.5-2.3c-8.9-4.6-13.3-14.9-10.3-24.5l51-165.4h-96.5c-7.9,0-15.1-4.5-18.6-11.5
											c-3.5-7.1-2.7-15.5,2.1-21.8L292,8.1c6.3-8.2,17.5-10.5,26.6-5.5c9,5,12.9,15.9,9.3,25.5l-60.4,158.2h109.9
											c7.9,0,15.1,4.5,18.6,11.5c3.5,7,2.7,15.5-2.1,21.7L194.5,481.8C190.4,487.1,184.3,490,177.9,490z M154.6,256.3h82.7
											c6.6,0,12.8,3.1,16.7,8.4c3.9,5.3,5.1,12.1,3.1,18.4l-24.8,80.4l103.3-135.9h-98.3c-6.8,0-13.2-3.4-17.1-9
											c-3.9-5.6-4.7-12.8-2.3-19.1l20.1-52.5L154.6,256.3z"></path>
									</svg>
								</span>Flashcards
							</h4>
						</div>
						<div class="main_subheaderCenter newflash">
							<ul>
								<li>
									<a href="javascript:void(0)">
										<img src="<?php echo base_url(); ?>assets_d/images/correct.svg" alt="correct"> 
										<span id="correctCount">00</span>
									</a>
								</li>
								<li>
									<a href="javascript:void(0)">
										<img src="<?php echo base_url(); ?>assets_d/images/not-sure.svg" alt="e"> 
										<span id="notSureCount">00</span>
									</a>
								</li>
								<li>
									<a href="javascript:void(0)">
										<img src="<?php echo base_url(); ?>assets_d/images/incorrect.svg" alt="incorrect"> 
										<span id="incorrectCount">00</span>
									</a>
								</li>
								<li>
									<a href="javascript:void(0)">
										<img src="<?php echo base_url(); ?>assets_d/images/remaining.svg" alt="remaining"> 
										<span id="remainingCount"><?php if(count($term_data) < 10) { echo 0; } echo count($term_data); ?></span>
									</a>
								</li>
								<li>
									<a href="javascript:void(0)">
										<img src="<?php echo base_url(); ?>assets_d/images/hidden.svg" alt="hidden"> 
										<span id="hiddenCount">00</span>
									</a>
								</li>
							</ul>
							<ul class="flashMark">
								<li>
									<a href="javascript:void(0)">
										<img src="<?php echo base_url(); ?>assets_d/images/flashcards.svg" alt="flash"> <span id="markCount">00</span>/<?php if(count($term_data) < 10) { echo 0; } echo count($term_data); ?>
									</a>
								</li>
							</ul>
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
					<input type="hidden" id="termsSeen">
					<input type="hidden" id="incorrectTerms">
					<input type="hidden" id="correctTerms">
					<input type="hidden" id="notSureTerms">
					<input type="hidden" id="hideTerms">
					<input type="hidden" id="studyset_id" value="<?php echo $studyset['study_set_id']; ?>">
					<div class="mainCardWrapper newflash">
						<div class="flashcards active">
							<?php $count = count($term_data)-1; foreach ($term_data as $key => $value) { ?>
								<div class="flipper <?php if($key == 0) { echo "current first"; } else if($key == $count) { echo "last"; } ?>" style="<?php if($key != 0) { echo "display: none"; } ?>" data-id="<?php echo $value['study_set_term_id']; ?>">

									<div class="front card">
										<div class="flashCard_txt">
											<?php echo $value['term_name']; ?>	
										</div>
										<div class="click-to-flip">
											<img src="<?php echo base_url(); ?>assets_d/images/click-to-flip.svg" alt="flip"> Click to flip
										</div>
									</div>
									<div class="back card">
										<?php if(!empty($value['term_image'])) { ?>
											<div class="flashImg">
												<img src="<?php echo base_url(); ?>uploads/studyset/<?php echo $value['term_image']; ?>">
											</div>
										<?php } ?>
										<div class="flashCard_txt">
											<?php echo $value['term_description']; ?>											
										</div>
									</div>
								</div>
							<?php } ?>
						</div>
						
						<div class="flashcard-controls" style="position: relative;">
							<div class="shareOptionBox">
								<div class="prev" id="prevFlip" style="pointer-events: none;cursor: pointer;">
									<img src="<?php echo base_url(); ?>assets_d/images/prev.svg">
								</div>
			      				<ul>
			      					<li>
			      						<a href="javascript:void(0)" onclick="incrementCount('correct')">
			      							<button type="button" class="choose_btn correct">
			      								<img src="<?php echo base_url(); ?>assets_d/images/correct.svg" alt="correct"> Correct
			      							</button>
			      						</a>
			      					</li>
			      					<li>
			      						<a href="javascript:void(0)">
			      							<button type="button" class="choose_btn not-sure" onclick="incrementCount('not-sure')">
			      								<img src="<?php echo base_url(); ?>assets_d/images/not-sure.svg" alt="not-sure"> Not Sure
			      							</button>
			      						</a>
			      					</li>
			      					<li>
			      						<a href="javascript:void(0)">
			      							<button type="button" class="choose_btn incorrect" onclick="incrementCount('incorrect')">
			      								<img src="<?php echo base_url(); ?>assets_d/images/incorrect.svg" alt="incorrect"> Incorrect
			      							</button>
			      						</a>
			      					</li>
			      					<li>
			      						<a href="javascript:void(0)">
			      							<button type="button" class="choose_btn hidecard" onclick="incrementCount('hidecard')">
			      								<img src="<?php echo base_url(); ?>assets_d/images/hidden.svg" alt="hidden"> Hide Card
			      							</button>
			      						</a>
			      					</li>
			      				</ul>
			      				<div class="prev" id="nextFilp" style="cursor: pointer;<?php if($count == 0) { echo 'pointer-events: none;'; } ?>">
									<img src="<?php echo base_url(); ?>assets_d/images/next.svg">
								</div>
			      			</div>
							
						</div>
						<div class="flashcard_result">
							<h4>This flashcard session lasted  <span>8 Hours6 Minutes56 Seconds</span></h4>
							<h4>Your recent attempts</h4>
							<table class="ch-ranking-table ch-ranking-no-rank mb-50">
								<tbody>
												<tr>
										<td><div class="ch-ranking-value">8 Hours6 Minutes56 Seconds</div><small>Time Spent</small></td>
										<td><div class="ch-ranking-value">1 second ago</div><small>Date</small></td>
									</tr>
												<tr>
										<td><div class="ch-ranking-value">4 Minutes56 Seconds</div><small>Time Spent</small></td>
										<td><div class="ch-ranking-value">8 hours ago</div><small>Date</small></td>
									</tr>
												<tr>
										<td><div class="ch-ranking-value">9 Seconds</div><small>Time Spent</small></td>
										<td><div class="ch-ranking-value">8 hours ago</div><small>Date</small></td>
									</tr>
												<tr>
										<td><div class="ch-ranking-value">19 Seconds</div><small>Time Spent</small></td>
										<td><div class="ch-ranking-value">8 hours ago</div><small>Date</small></td>
									</tr>
												<tr>
										<td><div class="ch-ranking-value">18 Seconds</div><small>Time Spent</small></td>
										<td><div class="ch-ranking-value">1 day ago</div><small>Date</small></td>
									</tr>
												<tr>
										<td><div class="ch-ranking-value">6 Seconds</div><small>Time Spent</small></td>
										<td><div class="ch-ranking-value">1 day ago</div><small>Date</small></td>
									</tr>
								</tbody>
							</table>
							<h4>Recent Attempts</h4>
							<table class="ch-ranking-table mb-50">
								<tbody>
											<tr>
										<td><div class="ch-ranking-value">1</div></td>
										<td><div class="ch-ranking-value">Developer</div><small>User</small></td>
										<td><div class="ch-ranking-value">8 Hours6 Minutes56 Seconds</div><small>Time Spent</small></td>
										<td><div class="ch-ranking-value">1 second ago</div><small>Date</small></td>
									</tr>
											<tr>
										<td><div class="ch-ranking-value">2</div></td>
										<td><div class="ch-ranking-value">Developer</div><small>User</small></td>
										<td><div class="ch-ranking-value">4 Minutes56 Seconds</div><small>Time Spent</small></td>
										<td><div class="ch-ranking-value">8 hours ago</div><small>Date</small></td>
									</tr>
											<tr>
										<td><div class="ch-ranking-value">3</div></td>
										<td><div class="ch-ranking-value">Developer</div><small>User</small></td>
										<td><div class="ch-ranking-value">9 Seconds</div><small>Time Spent</small></td>
										<td><div class="ch-ranking-value">8 hours ago</div><small>Date</small></td>
									</tr>
											<tr>
										<td><div class="ch-ranking-value">4</div></td>
										<td><div class="ch-ranking-value">Developer</div><small>User</small></td>
										<td><div class="ch-ranking-value">19 Seconds</div><small>Time Spent</small></td>
										<td><div class="ch-ranking-value">8 hours ago</div><small>Date</small></td>
									</tr>
											<tr>
										<td><div class="ch-ranking-value">5</div></td>
										<td><div class="ch-ranking-value">Developer</div><small>User</small></td>
										<td><div class="ch-ranking-value">18 Seconds</div><small>Time Spent</small></td>
										<td><div class="ch-ranking-value">1 day ago</div><small>Date</small></td>
									</tr>
											<tr>
										<td><div class="ch-ranking-value">6</div></td>
										<td><div class="ch-ranking-value">Developer</div><small>User</small></td>
										<td><div class="ch-ranking-value">6 Seconds</div><small>Time Spent</small></td>
										<td><div class="ch-ranking-value">1 day ago</div><small>Date</small></td>
									</tr>
										</tbody>
							</table>
						</div>
						<div class="flashcard_correct hide">
							<h4>You can do better!</h4>
							<img src="<?php echo base_url(); ?>assets_d/images/better-emoji.svg">
							<div class="message">
								You had <a>08</a> cards correct. <br>
								Study again and be perfectly prepared for your exam.
							</div>
							<button type="button" class="study_action"> Study Again</button>	
						</div>
						<div class="flashcard_correct hide">
							<h4>You are a genius!</h4>
							<img src="<?php echo base_url(); ?>assets_d/images/genius-emoji.svg">
							<div class="message">
								You had every single cards correct. <br>
								Follow this set to save it in your study material
							</div>
							<button type="button" class="study_action"> Study Again</button>	
						</div>
						<div class="report_card hide">
							<h5>Here is your report</h5>
							<div class="report_card_count">
								<div class="card total">
									<h6>05</h6>
									<p>Total</p>
								</div>
								<div class="card correct">
									<h6>10</h6>
									<p>Correct</p>
								</div>
								<div class="card Incorrect">
									<h6>03</h6>
									<p>Incorrect</p>
								</div>
								<div class="card not-sure">
									<h6>02</h6>
									<p>Not Sure</p>
								</div>	
							</div>
							<h5>You need to study these terms</h5>
						</div>
						<div class="descp_card hide">
							<div class="left">
								<h6>Terms</h6>
								<p>Lorem ipsum dolor sit amet, consetetur sadipscing
								elitr, sed diam nonumy eirmod tempor invidunt ut
								labore et dolore </p>
							</div>
							<div class="right">
								<h6>Description</h6>
								<p>Lorem ipsum dolor sit amet, consetetur sadipscing
								elitr, sed diam nonumy eirmod tempor invidunt ut
								labore et dolore </p>
							</div>
						</div>
						<div class="descp_card hide">
							<div class="left">
								<h6>Terms</h6>
								<p>Lorem ipsum dolor sit amet, consetetur sadipscing
								elitr, sed diam nonumy eirmod tempor invidunt ut
								labore et dolore </p>
							</div>
							<div class="right">
								<h6>Description</h6>
								<div class="flashImg">
									<img src="<?php echo base_url(); ?>assets_d/images/detail1.jpg">
								</div>
								<p>Lorem ipsum dolor sit amet, consetetur sadipscing
								elitr, sed diam nonumy eirmod tempor invidunt ut
								labore et dolore </p>
							</div>
						</div>
					</div>
				</section>


<script>

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
  //  clearInterval(interval);
  //  $('#timerOutModal').modal('show');
  // }
  timer2 = hours+ ':' + minutes + ':' + seconds;
  
}, 1000);

function removeValue(list, value) {
	if( list.indexOf(','+value+',') != -1 ){
	return list.replace(new RegExp(',?'+ value + ',?'), ',');
	}
	else{
	return list.replace(new RegExp(',?'+ value + ',?'), "")
	}
}

function incrementCount(action){
	var termsSeen = $('#termsSeen').val();
	var current = $('.current').attr("data-id");
	$('.choose_btn').removeClass('selected');
	if(termsSeen != ''){
		if( (termsSeen.split(',').indexOf(current) > -1) ) {
			var correctTerms = $('#correctTerms').val();
	        var incorrectTerms = $('#incorrectTerms').val();
	        var notSureTerms = $('#notSureTerms').val();
	        var hideTerms = $('#hideTerms').val();
	        if(correctTerms != ''){
	          if( (correctTerms.split(',').indexOf(current) > -1)) { 
	            $('.correct').removeClass('selected');
	            var correct_count = parseInt($('#correctCount').html()); 
				var n = correct_count-1;
		        var formattedNumber = ("0" + n).slice(-2);
		        $('#correctCount').html(formattedNumber);
		        var newValue = removeValue(correctTerms, current);
		        $('#correctTerms').val(newValue);
	          }
	        } if(incorrectTerms != ''){
	          if( (incorrectTerms.split(',').indexOf(current) > -1)) {
	            $('.incorrect').removeClass('selected');
	            var incorrectCount = parseInt($('#incorrectCount').html()); 
				var n = incorrectCount-1;
		        var formattedNumber = ("0" + n).slice(-2);
		        $('#incorrectCount').html(formattedNumber);
		        var newValue = removeValue(incorrectTerms, current);
		        $('#incorrectTerms').val(newValue);
	          }
	        } if(notSureTerms != ''){
	          if( (notSureTerms.split(',').indexOf(current) > -1)) {
	            $('.not-sure').removeClass('selected');
	            var notSureCount = parseInt($('#notSureCount').html()); 
				var n = notSureCount-1;
		        var formattedNumber = ("0" + n).slice(-2);
		        $('#notSureCount').html(formattedNumber);
		        var newValue = removeValue(notSureTerms, current);
		        $('#notSureTerms').val(newValue);
	          }
	        } if(hideTerms != ''){
	          if( (hideTerms.split(',').indexOf(current) > -1)) {
	            $('.hidecard').removeClass('selected');
	            var hiddenCount = parseInt($('#hiddenCount').html()); 
				var n = hiddenCount-1;
		        var formattedNumber = ("0" + n).slice(-2);
		        $('#hiddenCount').html(formattedNumber);
		        var newValue = removeValue(hideTerms, current);
		        $('#hideTerms').val(newValue);
	          }
	        }

	        if(action == 'correct'){
				var correct_count = parseInt($('#correctCount').html()); 
				var n = correct_count+1;
		        var formattedNumber = ("0" + n).slice(-2);
		        $('#correctCount').html(formattedNumber);
		        $('.correct').addClass('selected');
			} else if(action == 'not-sure'){
				var notSureCount = parseInt($('#notSureCount').html()); 
				var n = notSureCount+1;
		        var formattedNumber = ("0" + n).slice(-2);
		        $('#notSureCount').html(formattedNumber);
		        $('.not-sure').addClass('selected');
			} else if(action == 'incorrect'){
				var incorrectCount = parseInt($('#incorrectCount').html()); 
				var n = incorrectCount+1;
		        var formattedNumber = ("0" + n).slice(-2);
		        $('#incorrectCount').html(formattedNumber);
		        $('.incorrect').addClass('selected');
			} else if(action == 'hidecard'){
				var hiddenCount = parseInt($('#hiddenCount').html()); 
				var n = hiddenCount+1;
		        var formattedNumber = ("0" + n).slice(-2);
		        $('#hiddenCount').html(formattedNumber);
		        $('.hidecard').addClass('selected');
			}
			if(action == 'correct'){
				var correctTerms = $('#correctTerms').val();
				if(correctTerms != ''){
					if( (correctTerms.split(',').indexOf(current) > -1) ) {

					} else {
						$('#correctTerms').val(correctTerms+','+current);
					}
				} else {
					$('#correctTerms').val(current);
				}
			} else if(action == 'incorrect'){
				var incorrectTerms = $('#incorrectTerms').val();
				if(incorrectTerms != ''){
					if( (incorrectTerms.split(',').indexOf(current) > -1) ) {

					} else {
						$('#incorrectTerms').val(incorrectTerms+','+current);
					}
				} else {
					$('#incorrectTerms').val(current);
				}
			} else if(action == 'not-sure'){
				var notSureTerms = $('#notSureTerms').val();
				if(notSureTerms != ''){
					if( (notSureTerms.split(',').indexOf(current) > -1) ) {

					} else {
						$('#notSureTerms').val(notSureTerms+','+current);
					}
				} else {
					$('#notSureTerms').val(current);
				}
			} else if(action == 'hidecard'){
				var hideTerms = $('#hideTerms').val();
				if(hideTerms != ''){
					if( (hideTerms.split(',').indexOf(current) > -1) ) {

					} else {
						$('#hideTerms').val(hideTerms+','+current);
					}
				} else {
					$('#hideTerms').val(current);
				}
			}
		} else {
			$('#termsSeen').val(termsSeen+','+current);
			if(action == 'correct'){
				var correct_count = parseInt($('#correctCount').html()); 
				var n = correct_count+1;
		        var formattedNumber = ("0" + n).slice(-2);
		        $('#correctCount').html(formattedNumber);
		        $('.correct').addClass('selected');
			} else if(action == 'not-sure'){
				var notSureCount = parseInt($('#notSureCount').html()); 
				var n = notSureCount+1;
		        var formattedNumber = ("0" + n).slice(-2);
		        $('#notSureCount').html(formattedNumber);
		        $('.not-sure').addClass('selected');
			} else if(action == 'incorrect'){
				var incorrectCount = parseInt($('#incorrectCount').html()); 
				var n = incorrectCount+1;
		        var formattedNumber = ("0" + n).slice(-2);
		        $('#incorrectCount').html(formattedNumber);
		        $('.incorrect').addClass('selected');
			} else if(action == 'hidecard'){
				var hiddenCount = parseInt($('#hiddenCount').html()); 
				var n = hiddenCount+1;
		        var formattedNumber = ("0" + n).slice(-2);
		        $('#hiddenCount').html(formattedNumber);
		        $('.hidecard').addClass('selected');
			}

			var markCount = parseInt($('#markCount').html()); 
			var n = markCount+1;
	        var formattedNumber = ("0" + n).slice(-2);
	        $('#markCount').html(formattedNumber);

	        var remainingCount = parseInt($('#remainingCount').html()); 
			var n = remainingCount-1;
	        var formattedNumber = ("0" + n).slice(-2);
	        $('#remainingCount').html(formattedNumber);

			
			if(action == 'correct'){
				var correctTerms = $('#correctTerms').val();
				if(correctTerms != ''){
					if( (correctTerms.split(',').indexOf(current) > -1) ) {

					} else {
						$('#correctTerms').val(correctTerms+','+current);
					}
				} else {
					$('#correctTerms').val(current);
				}
			} else if(action == 'incorrect'){
				var incorrectTerms = $('#incorrectTerms').val();
				if(incorrectTerms != ''){
					if( (incorrectTerms.split(',').indexOf(current) > -1) ) {

					} else {
						$('#incorrectTerms').val(incorrectTerms+','+current);
					}
				} else {
					$('#incorrectTerms').val(current);
				}
			} else if(action == 'not-sure'){
				var notSureTerms = $('#notSureTerms').val();
				if(notSureTerms != ''){
					if( (notSureTerms.split(',').indexOf(current) > -1) ) {

					} else {
						$('#notSureTerms').val(notSureTerms+','+current);
					}
				} else {
					$('#notSureTerms').val(current);
				}
			} else if(action == 'hidecard'){
				var hideTerms = $('#hideTerms').val();
				if(hideTerms != ''){
					if( (hideTerms.split(',').indexOf(current) > -1) ) {

					} else {
						$('#hideTerms').val(hideTerms+','+current);
					}
				} else {
					$('#hideTerms').val(current);
				}
			}
		}
	} else {
		$('#termsSeen').val(current);
		if(action == 'correct'){
			var correct_count = parseInt($('#correctCount').html()); 
			var n = correct_count+1;
	        var formattedNumber = ("0" + n).slice(-2);
	        $('#correctCount').html(formattedNumber);
	        $('.correct').addClass('selected');
		} else if(action == 'not-sure'){
			var notSureCount = parseInt($('#notSureCount').html()); 
			var n = notSureCount+1;
	        var formattedNumber = ("0" + n).slice(-2);
	        $('#notSureCount').html(formattedNumber);
	        $('.not-sure').addClass('selected');
		} else if(action == 'incorrect'){
			var incorrectCount = parseInt($('#incorrectCount').html()); 
			var n = incorrectCount+1;
	        var formattedNumber = ("0" + n).slice(-2);
	        $('#incorrectCount').html(formattedNumber);
	        $('.incorrect').addClass('selected');
		} else if(action == 'hidecard'){
			var hiddenCount = parseInt($('#hiddenCount').html()); 
			var n = hiddenCount+1;
	        var formattedNumber = ("0" + n).slice(-2);
	        $('#hiddenCount').html(formattedNumber);
	        $('.hidecard').addClass('selected');
		}

		var markCount = parseInt($('#markCount').html()); 
		var n = markCount+1;
        var formattedNumber = ("0" + n).slice(-2);
        $('#markCount').html(formattedNumber);

        var remainingCount = parseInt($('#remainingCount').html()); 
		var n = remainingCount-1;
        var formattedNumber = ("0" + n).slice(-2);
        $('#remainingCount').html(formattedNumber);

		if(action == 'correct'){
				var correctTerms = $('#correctTerms').val();
				if(correctTerms != ''){
					if( (correctTerms.split(',').indexOf(current) > -1) ) {

					} else {
						$('#correctTerms').val(correctTerms+','+current);
					}
				} else {
					$('#correctTerms').val(current);
				}
			} else if(action == 'incorrect'){
				var incorrectTerms = $('#incorrectTerms').val();
				if(incorrectTerms != ''){
					if( (incorrectTerms.split(',').indexOf(current) > -1) ) {

					} else {
						$('#incorrectTerms').val(incorrectTerms+','+current);
					}
				} else {
					$('#incorrectTerms').val(current);
				}
			} else if(action == 'not-sure'){
				var notSureTerms = $('#notSureTerms').val();
				if(notSureTerms != ''){
					if( (notSureTerms.split(',').indexOf(current) > -1) ) {

					} else {
						$('#notSureTerms').val(notSureTerms+','+current);
					}
				} else {
					$('#notSureTerms').val(current);
				}
			} else if(action == 'hidecard'){
				var hideTerms = $('#hideTerms').val();
				if(hideTerms != ''){
					if( (hideTerms.split(',').indexOf(current) > -1) ) {

					} else {
						$('#hideTerms').val(hideTerms+','+current);
					}
				} else {
					$('#hideTerms').val(current);
				}
			}
	}
	var incrementUrl = '<?php echo base_url(); ?>studyset/incrementFlashcard';
	if ($('.current').hasClass('last')) {
		var url = incrementUrl;
        var studyset_id = $('#studyset_id').val();
        var correctTerms = $('#correctTerms').val();
        var matchtime = $('#matchtime').html();
        var incorrectCount = $('#incorrectCount').html();
        var notSureCount = $('#notSureCount').html();
        $.ajax({
          url: url,
          type: 'POST',
          data: {'studyset_id': studyset_id, 'correctTerms': correctTerms, 'matchtime': matchtime, 'incorrectCount': incorrectCount, 'notSureCount': notSureCount},
          success: function(result) {
          	clearInterval(interval);
            $('.mainCardWrapper').html(result);
          }
      	});
	}
	
}
</script>
<script>
    let height1 = $('.front').innerHeight();
    let height2 = $('.back').innerHeight();
    if(height1 > height2){
        $('.front').parent().parent('.flashcards').css({'height': height1});
    } else if(height2 > height1) {
        $('.front').parent().parent('.flashcards').css({'height': height2});
    }
</script>