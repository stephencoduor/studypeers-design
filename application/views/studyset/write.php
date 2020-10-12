
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
								<span class="studySets  write">
									<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
										<path d="m495,211.9l-194.9-194.9c-8-8-20.9-8-28.9,0l-115.4,115.4c-10.8,11.3-4.4,25.3 0,28.9l19.3,19.3-147.7,118c-6.1,4.9-8.9,12.9-7.1,20.5 0.1,0.5 12.2,55.4-8.8,156.5-1.5,7.1 0.9,14.2 6,19 3.8,4 10.8,7.6 18.9,5.9 100.1-20.6 156.1-8.9 156.5-8.8 7.6,1.7 15.6-1 20.5-7.2l118.1-147.7 19.3,19.3c11.3,10.7 24.8,4.7 28.9,0l115.3-115.4c3.8-3.8 11.2-16.2 0-28.8zm-306.1,237.9c-17.2-2.2-51-4.5-99.5,0.9l74.4-74.4c8-8 8-20.9 0-28.9-8-8-20.9-8-28.9,0l-73.5,73.5c5.2-47.7 2.9-80.8 0.7-97.8l142-113.5 98.2,98.2-113.4,142zm176.2-136.9l-166-166 86.6-86.6 166,166-86.6,86.6z"></path>
									</svg>
								</span>Write
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
							<div class="commoncard <?php if($key == 0) { echo "current first"; } ?>  <?php if($key == $count) { echo "last"; } ?>" id="writeboxes" style="<?php if($key != 0) { echo "display: none"; } ?>">
								<div class="writebox">
									<div class="flashCard_txt">
										
										<p class="text-capitalise"><?php echo $value['term_description']; ?>	</p>
                    <?php if(!empty($value['term_image'])) { ?>
                      <img src="<?php echo base_url(); ?>uploads/studyset/<?php echo $value['term_image']; ?>" alt="Study Set" style="height: 100px;border-radius:5px;">
                    <?php } ?>			
									</div>
									<div class="writebox-answer">
										<div class="form-group">
											<input type="text" name="" class="form-control form-control--lg" placeholder="Type your answer..." id="text_<?php echo $value['study_set_term_id']; ?>">
										</div>
										<div class="learnBtnWrapper">
											<button type="submit" class="createBtn checkAnswerWrite" data-id="<?php echo $value['study_set_term_id']; ?>">Answer</button>
										</div>
									</div>
								</div>
								<div class="answer-result" id="WriteAnsBox<?php echo $value['study_set_term_id']; ?>" style="display: none">
								</div>
							</div>
						<?php } ?>
					</div>
				</section>
				<section class="rightsidemsgbar">
					<section class="view message">
                		Close <i class="fa fa-arrow-right" aria-hidden="true"></i>
                	</section>
                	<section class="listBar">
                		<section class="listHeader">
	                		<h6>Peers</h6>
	                		<a data-toggle="modal" data-target="#peersMessageModal">See More</a>
                		</section>
                		<section class="listChatBox">
                			<section class="list">
	                			<section class="left">
	                				<figure>
	                					<img src="images/user2.jpg" alt="user">
	                				</figure>
	                				<figcaption>Scholasticus Ipsum</figcaption>
	                			</section>
	                			<section class="action">
	                				<i class="fa fa-ellipsis-v"></i>
	                			</section>
                			</section>
                			<section class="list">
	                			<section class="left">
	                				<figure>
	                					<img src="images/user2.jpg" alt="user">
	                					<span class="messagecount">12</span>
	                				</figure>
	                				<figcaption>Scholasticus Ipsum</figcaption>
	                			</section>
	                			<section class="action">
	                				<i class="fa fa-ellipsis-v"></i>
	                			</section>
                			</section>
                		</section>
                	</section>
                	<section class="listBar">
                		<section class="listHeader">
	                		<h6>Groups</h6>
	                		<a><i class="fa fa-plus"></i></a>
                		</section>
                		<section class="listChatBox">
                			<section class="list">
	                			<section class="left">
	                				<figure>
	                					<img src="images/user2.jpg" alt="user">
	                				</figure>
	                				<figcaption>The in group</figcaption>
	                			</section>
	                			<section class="action">
	                				<i class="fa fa-ellipsis-v"></i>
	                			</section>
                			</section>
                			<section class="list">
	                			<section class="left">
	                				<figure>
	                					<img src="images/user2.jpg" alt="user">
	                					<span class="messagecount">12</span>
	                				</figure>
	                				<figcaption>The in group</figcaption>
	                			</section>
	                			<section class="action">
	                				<i class="fa fa-ellipsis-v"></i>
	                			</section>
                			</section>
                		</section>
                	</section>
                	<section class="listBar">
                		<section class="listHeader">
	                		<h6>Contacts</h6>
                		</section>
                		<section class="listChatBox">
                			<section class="list">
	                			<section class="left">
	                				<figure>
	                					<img src="images/user2.jpg" alt="user">
	                					<span class="circle online"></span>
	                				</figure>
	                				<figcaption>Angelina</figcaption>
	                			</section>
                			</section>
                			<section class="list">
	                			<section class="left">
	                				<figure>
	                					<img src="images/user2.jpg" alt="user">
	                					<span class="circle offline"></span>
	                				</figure>
	                				<figcaption>Angelina</figcaption>
	                			</section>
                			</section>
                			<section class="list">
	                			<section class="left">
	                				<figure>
	                					<img src="images/user2.jpg" alt="user">
	                					<span class="circle online"></span>
	                				</figure>
	                				<figcaption>Angelina</figcaption>
	                			</section>
                			</section>
                			<section class="list">
	                			<section class="left">
	                				<figure>
	                					<img src="images/user2.jpg" alt="user">
	                					<span class="circle offline"></span>
	                				</figure>
	                				<figcaption>Angelina</figcaption>
	                			</section>
                			</section>
                			<section class="list">
	                			<section class="left">
	                				<figure>
	                					<img src="images/user2.jpg" alt="user">
	                					<span class="circle online"></span>
	                				</figure>
	                				<figcaption>Charles</figcaption>
	                			</section>
                			</section>
                		</section>
                	</section>
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
  // 	clearInterval(interval);
  // 	$('#timerOutModal').modal('show');
  // }
  timer2 = hours+ ':' + minutes + ':' + seconds;
  
}, 1000);

$('.checkAnswerWrite').click(function() {
	var id = $(this).data('id');
	var correct_count = parseInt($('#correct_count').html()); 
	var missed_count  = parseInt($('#missed_count').html());
	var missed_terms  = $('#missed_terms').val();
  
	var select = $('#text_'+id).val();
	var url = '<?php echo base_url(); ?>studyset/checkWriteAns';

	$.ajax({
	        url: url,
	        type: 'POST',
	        data: {'studyset_term_id': id, 'select': select},
	        dataType: "json",
	        success: function(result) {
	        $('.writebox').hide(); 
	          	if(result.type == 1){
	            	$('#WriteAnsBox'+id).removeClass('wrong').addClass('correct').html(result.html).show();
	            	var n = correct_count+1;
	            	var formattedNumber = ("0" + n).slice(-2);
	            	$('#correct_count').html(formattedNumber);
	          	} else {
	          		if(missed_terms != ""){
	          			$('#missed_terms').val(missed_terms+','+id);
	          		} else {
	          			$('#missed_terms').val(id);
	          		}
	          		
	          		$('#WriteAnsBox'+id).removeClass('correct').addClass('wrong').html(result.html).show();
	          		var n = missed_count+1;
	            	var formattedNumber = ("0" + n).slice(-2);
	            	$('#missed_count').html(formattedNumber);
	          	}
	        }
	});
  
  
});

function nextWriteAns() {
  if ($('.current').hasClass('last')) {
    var total_term = parseInt($('#total_term').val()); 
    total_term = ("0" + total_term).slice(-2);
    var correct_count = parseInt($('#correct_count').html()); 
    correct_count = ("0" + correct_count).slice(-2);
    var missed_count  = parseInt($('#missed_count').html());
    missed_count = ("0" + missed_count).slice(-2);
    var url = '<?php echo base_url(); ?>studyset/incrementWriteRound';
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
    $('.writebox').show();
    $('.current').removeClass('current').hide()
        .next().show().addClass('current');
  }
}

</script>
