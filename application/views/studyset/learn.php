
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
								Round <span class="sp-set-progress__round-progress"><?php if($learn_round < 10) { echo 0; } echo $learn_round; ?></span>
							</div>
							<div class="set-progress">
								Correct <span class="sp-set-progress__answered-progress" id="correct_count">00</span>
							</div>
							<div class="set-progress">
								Missed <span class="sp-set-progress__missed-progress" id="missed_count">00</span>
							</div>
							<input type="hidden" id="total_term" value="<?php echo count($term_data); ?>">
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
					<input type="hidden" id="studyset_id" value="<?php echo $studyset['study_set_id']; ?>">
					<input type="hidden" id="missed_terms" value="">
					<div class="mainCardWrapper">
						<?php $count = count($term_data)-1; foreach ($term_data as $key => $value) { ?>
							<div class="commoncard <?php if($key == 0) { echo "current first"; } ?>  <?php if($key == $count) { echo "last"; } ?>" id="learnboxes" style="<?php if($key != 0) { echo "display: none"; } ?>" >
								<div class="learnQuestBox">
									<div class="flashCard_txt">
										
										<p class="text-capitalise"><?php echo $value['term_description']; ?>	</p>
                    <?php if(!empty($value['term_image'])) { ?>
                      <img src="<?php echo base_url(); ?>uploads/studyset/<?php echo $value['term_image']; ?>" alt="Study Set" style="height: 100px; border-radius:5px;">
                    <?php } ?>			
									</div>
									<div class="learnbox-answer">
										<input type="hidden" id="if_checked_<?php echo $value['study_set_term_id']; ?>" value="0">
										<?php if($count < 3) { ?>
											<div class="form-group" id="text_answer_<?php echo $value['study_set_term_id']; ?>">
												<input type="text" class="form-control single-line" name="" placeholder="Fill in the answer.." id="text_<?php echo $value['study_set_term_id']; ?>">
											</div>
										<?php } else { 
											$exclude_arr = $term_data; 
											unset($exclude_arr[$key]); 
											$random_keys = array_rand($exclude_arr,3);
											$random_keys[3] = $key; 
											shuffle($random_keys);
										?>

										<?php foreach ($random_keys as $key2 => $value2) { ?>
											<div class="form-group" id="option_answer_<?php echo $value['study_set_term_id']; ?>">
												<label class="custom-radio">
													<input type="radio" name="answer[74]" value="<?php echo $term_data[$value2]['study_set_term_id']; ?>" required="" class="checkbox_<?php echo $value['study_set_term_id']; ?>" id="check_ans_<?php echo $value['study_set_term_id']; ?>_<?php echo $term_data[$value2]['study_set_term_id']; ?>">
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
								<div class="learnAnsBox" id="learnAnsBox<?php echo $value['study_set_term_id']; ?>" style="display: none"></div>
								
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



<script>

var timer2 = "00:00:00";
// var incrementUrl = '<?php echo base_url(); ?>studyset/incrementFlashcard';
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

$('.checkAnswerLearn').click(function() {
  var id = $(this).data('id');
  var correct_count = parseInt($('#correct_count').html()); 
  var missed_count  = parseInt($('#missed_count').html());
  var missed_terms  = $('#missed_terms').val();
  if($('#text_answer_'+id).is(':visible')) {
    var select = $('#text_'+id).val();
    var url = '<?php echo base_url(); ?>studyset/checkLearnAnsText';
    
    $.ajax({
	        url: url,
	        type: 'POST',
	        data: {'studyset_term_id': id, 'select': select},
	        dataType: "json",
	        success: function(result) {
	        $('.learnQuestBox').hide(); 
	          	if(result.type == 1){
	            	$('#learnAnsBox'+id).removeClass('wrong').addClass('correct').html(result.html).show();
	            	var n = correct_count+1;
	            	var formattedNumber = ("0" + n).slice(-2);
	            	$('#correct_count').html(formattedNumber);
	          	} else {
	          		if(missed_terms != ""){
	          			$('#missed_terms').val(missed_terms+','+id);
	          		} else {
	          			$('#missed_terms').val(id);
	          		}
	          		
	          		$('#learnAnsBox'+id).removeClass('correct').addClass('wrong').html(result.html).show();
	          		var n = missed_count+1;
	            	var formattedNumber = ("0" + n).slice(-2);
	            	$('#missed_count').html(formattedNumber);
	          	}
	        }
	});
  } else {
    // option answer
    if($('.checkbox_'+id+':checked').length != 0){
      var select = $('.checkbox_'+id+':checked').val();
      	var url = '<?php echo base_url(); ?>studyset/checkLearnAns';
	        var if_checked = $('#if_checked_'+id).val();
	        $.ajax({
	          url: url,
	          type: 'POST',
	          data: {'studyset_term_id': id, 'select': select, 'if_checked': if_checked},
	          dataType: "json",
	          success: function(result) {
	          	$('.learnQuestBox').hide(); 
	          	if(result.type == 1){
	            	$('#learnAnsBox'+id).removeClass('wrong').addClass('correct').html(result.html).show();
	            	var n = correct_count+1; 
	            	var formattedNumber = ("0" + n).slice(-2);
	            	$('#correct_count').html(formattedNumber);
	          	} else {
	          		if(missed_terms != ""){
	          			$('#missed_terms').val(missed_terms+','+id);
	          		} else {
	          			$('#missed_terms').val(id);
	          		}

	          		$('#learnAnsBox'+id).removeClass('correct').addClass('wrong').html(result.html).show();
	          		var n = missed_count+1; 
	            	var formattedNumber = ("0" + n).slice(-2);
	            	$('#missed_count').html(formattedNumber);
	          	}
	          }
        	});
      
    } else {
    	$('#if_checked_'+id).val('1');
    	$('#check_ans_'+id+'_'+id).focus();
    }
  }
  
});


function nextLearnAns() {
  if ($('.current').hasClass('last')) {
    var total_term = parseInt($('#total_term').val()); 
    total_term = ("0" + total_term).slice(-2);
    var correct_count = parseInt($('#correct_count').html()); 
    correct_count = ("0" + correct_count).slice(-2);
    var missed_count  = parseInt($('#missed_count').html());
    missed_count = ("0" + missed_count).slice(-2);
    var url = '<?php echo base_url(); ?>studyset/incrementLearnRound';
    var studyset_id = $('#studyset_id').val();
    var missed_terms = $('#missed_terms').val(); 
    var time_span = $('#matchtime').html();
    $.ajax({
	        url: url,
	        type: 'POST',
	        data: {'studyset_id': studyset_id, 'total_term': total_term, 'correct_count': correct_count, 'missed_count': missed_count, 'missed_terms': missed_terms, 'time_span': time_span},
	        success: function(result) {
	        	clearInterval(interval);
	          	$('.commoncard').html(result);
          	}
	});
    
  } else {
    $('.learnQuestBox').show();
    $('.current').removeClass('current').hide()
        .next().show().addClass('current');
  }
}

</script>