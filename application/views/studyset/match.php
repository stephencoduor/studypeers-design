
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
								<span class="studySets  match">
									<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
									  <path d="m463,195l-71.7-96.1c-36.3-48.6-91.7-76.5-152.2-76.5-33.1,0-65,8.5-93.5,24.8-18.2-21.4-45.1-34.9-73.4-35.9-6-0.2-31.1,1.2-36.7,0.1-11.1-2.2-21.8,5-24,16-2.2,11.1 5,21.8 16,24 10.7,2.1 39.1,0.5 43.2,0.6 15.6,0.6 30.8,7.8 41.6,19.2-72.7,65.3-84.8,177.3-25.2,257.1l71.7,96.1c36.2,48.7 91.7,76.6 152.2,76.6 41.4,0 80.8-13.3 114.2-38.5 83.7-63.2 100.7-183.2 37.8-267.5zm-104.4-71.7l7.6,10.2-103.2,77.9-96.4-129.2c22.1-12.5 46.8-19 72.5-19 47.5,0 91,21.9 119.5,60.1zm-224.5-16.4l96.4,129.2-103.2,77.9-7.5-10c-45.3-60.7-37.9-145 14.3-197.1zm266.3,323.2c-26,19.7-56.9,30.1-89.4,30.1-47.5,0-91-21.9-119.5-60.1l-39.8-53.4 238.9-180.5 39.7,53.2c49.4,66.3 36.1,160.8-29.9,210.7z"></path>
									</svg>
								</span>Match
							</h4>
						</div>
						<div class="main_subheaderCenter">
							<div class="set-progress">
								Correct <span class="sp-set-progress__answered-progress" id="correct_count">00</span>
							</div>
							<div class="set-progress">
								Missed <span class="sp-set-progress__missed-progress" id="missed_count">00</span>
							</div>
						</div>
						<input type="hidden" id="studyset_id" value="<?php echo $studyset['study_set_id']; ?>">
						<input type="hidden" id="missed_terms" value="">
						<input type="hidden" id="total_term" value="<?php echo count($term_data); ?>">
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
						<div class="matches row">
							<?php 	$max = count($term_data); 
									$random_term = $term_data; 
									$random_desc = $term_data; 
									shuffle($random_term); shuffle($random_desc);
									for ($i=0; $i < $max; $i++) { 
										
									?>
										<div class="match-item ui-widget-content" id="item_<?php echo $i; ?>" data-id="<?php echo $random_desc[$i]['study_set_term_id']; ?>" data-type="description">
											<p>
												<?php if(!empty($random_desc[$i]['term_image'])) { ?>
													<img src="<?php echo base_url(); ?>uploads/studyset/<?php echo $random_desc[$i]['term_image']; ?>" alt="Study Set" style="height: 95px;margin-right: 5px;border-radius: 5px;"><br>
												<?php } ?> <p class="text-capitalise"><?php echo $random_desc[$i]['term_description']; ?></p>
											</p>
										</div>
										<div class="match-item ui-widget-content" id="item_<?php echo $i; ?>_<?php echo $i; ?>" data-id="<?php echo $random_term[$i]['study_set_term_id']; ?>" data-type="term">
											<p><?php echo $random_term[$i]['term_name']; ?></p>
										</div>
									<?php }
							?>
							
						</div>
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

var maxSearchIterations = 10;
var min_x = 0;
var max_x = 800;
var min_y = 0;
var max_y = 350;
var filled_areas = [];
var drag_id;

function calc_overlap(a1) {
    var overlap = 0;
    for (i = 0; i < filled_areas.length; i++) {

        var a2 = filled_areas[i];

        // no intersection cases
        if (a1.x + a1.width < a2.x) {
            continue;
        }
        if (a2.x + a2.width < a1.x) {
            continue;
        }
        if (a1.y + a1.height < a2.y) {
            continue;
        }
        if (a2.y + a2.height < a1.y) {
            continue;
        }

        // intersection exists : calculate it !
        var x1 = Math.max(a1.x, a2.x);
        var y1 = Math.max(a1.y, a2.y);
        var x2 = Math.min(a1.x + a1.width, a2.x + a2.width);
        var y2 = Math.min(a1.y + a1.height, a2.y + a2.height);

        var intersection = ((x1 - x2) * (y1 - y2));

        overlap += intersection;

        // console.log("( "+x1+" - "+x2+" ) * ( "+y1+" - "+y2+" ) = " + intersection);
    }

    // console.log("overlap = " + overlap + " on " + filled_areas.length + " filled areas ");
    return overlap;
}

function randomize() {

    filled_areas.splice(0, filled_areas.length);

    var index = 0;
    $('.match-item').each(function() {
        var rand_x = 0;
        var rand_y = 0;
        var i = 0;
        var smallest_overlap = 9007199254740992;
        var best_choice;
        var area;
        for (i = 0; i < maxSearchIterations; i++) {
            rand_x = Math.round(min_x + ((max_x - min_x) * (Math.random() % 1)));
            rand_y = Math.round(min_y + ((max_y - min_y) * (Math.random() % 1)));
            area = {
                x: rand_x,
                y: rand_y,
                width: $(this).width(),
                height: $(this).height()
            };
            var overlap = calc_overlap(area);
            if (overlap < smallest_overlap) {
                smallest_overlap = overlap;
                best_choice = area;
            }
            if (overlap === 0) {
                break;
            }
        }

        filled_areas.push(best_choice);

        $(this).css({
            position: "absolute"
        });
        $(this).animate({
            left: rand_x,
            top: rand_y
        });

        // console.log("and the winner is : " + smallest_overlap);
    });
    return false;
}

randomize();

function submitMatchData(){
	var total_term = parseInt($('#total_term').val()); 
	var correct_count = parseInt($('#correct_count').html()); 
    correct_count = ("0" + correct_count).slice(-2);
    var missed_count  = parseInt($('#missed_count').html());
    missed_count = ("0" + missed_count).slice(-2);
    var url = '<?php echo base_url(); ?>studyset/incrementMatchRound';
    var studyset_id = $('#studyset_id').val();
    var missed_terms = $('#missed_terms').val();
    var time_span = $('#matchtime').html();
    $.ajax({
	        url: url,
	        type: 'POST',
	        data: {'studyset_id': studyset_id, 'total_term':total_term, 'correct_count': correct_count, 'missed_count': missed_count, 'missed_terms': missed_terms, 'time_span': time_span},
	        success: function(result) {
	        	clearInterval(interval);
	          	$('.matches').html(result);
          	}
	});
}

</script>
