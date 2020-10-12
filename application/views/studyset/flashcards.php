
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
						<div class="main_subheaderCenter">
							<div class="set-progress">
								Round <span class="sp-set-progress__round-progress"><?php if($flashcard_round < 10) { echo 0; } echo $flashcard_round; ?></span>
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
					<input type="hidden" id="studyset_id" value="<?php echo $studyset['study_set_id']; ?>">
					<div class="mainCardWrapper">
						<div class="flashcards active">
							<?php $count = count($term_data)-1; foreach ($term_data as $key => $value) { ?>
								<div class="flipper <?php if($key == 0) { echo "current first"; } else if($key == $count) { echo "last"; } ?>" style="<?php if($key != 0) { echo "display: none"; } ?>" >
									<div class="front card">
										<div class="flashCard_txt">
											<?php echo $value['term_name']; ?>		
										</div>
										<div class="click-to-flip">
											Click to flip
										</div>
									</div>
									<div class="back card">
										<div class="flashCard_txt">
											<?php if(!empty($value['term_image'])) { ?>
												<img src="<?php echo base_url(); ?>uploads/studyset/<?php echo $value['term_image']; ?>" alt="Study Set" style="height: 100px;">
											<?php } ?>
											<?php echo $value['term_description']; ?>										
										</div>
									</div>
								</div>
							<?php } ?>
							
						</div>
						<div class="flashcard-controls active">
							<a class="createBtn disabled" id="prevFlip" style="pointer-events: none;">
								<svg class="sp-icon" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 	x="0px" y="0px" viewBox="0 0 490 490" style="enable-background:new 0 0 490 490;" xml:space="preserve">
									<path d="M245.9,436.3c14.8-16.4,13.9-41.5-2-56.8l-101.5-94.4l308.4-0.7c22.2-0.6,39.7-19,39.2-41.1c-0.5-21.4-17.7-38.6-39.1-39.1
										l-308.6,0.7l101.5-94.4c16.2-15.1,17.1-40.6,2-56.8c-15.1-16.2-40.6-17.1-56.8-2l-176.2,164C4.7,223.3,0.1,233.9,0,245
										c0,11.1,4.6,21.7,12.8,29.3L189,438.2c16.2,15.2,41.6,14.4,56.8-1.7c0.1-0.1,0.2-0.2,0.2-0.2H245.9z"></path>
								</svg>
								Previous
							</a>
							<a class="createBtn <?php if($count == 0) { echo 'disabled'; } ?>" id="nextFilp" style="<?php if($count == 0) { echo 'pointer-events: none;'; } ?>">
								Next
								<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
									<path d="M244.1,53.7c-14.8,16.4-13.9,41.5,2,56.8l101.5,94.4l-308.4,0.7C17,206.2-0.5,224.6,0,246.7
										c0.5,21.4,17.7,38.6,39.1,39.1l308.6-0.7l-101.5,94.4c-16.2,15.1-17.1,40.6-2,56.8c15.1,16.2,40.6,17.1,56.8,2l176.2-164
										c8.1-7.6,12.7-18.2,12.8-29.3c0-11.1-4.6-21.7-12.8-29.3L301,51.8c-16.2-15.2-41.6-14.4-56.8,1.7c-0.1,0.1-0.2,0.2-0.2,0.2
										L244.1,53.7z">
											
									</path>
								</svg>
							</a>
							<a class="filterBtn showAnwer">show Answer</a>
							
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


<div class="modal fade" id="timerOutModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
	        <div class="modal-body peers">
	          	   <h4>Confirmation</h4>
		           <div class="row">
		           	 <h6 class="modalText">Your 30 minutes timer is out! Do you want to start over?</h6>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group button">
								<button type="button" onclick="window.location.href='<?php echo base_url(); ?>studyset';" class="transparentBtn highlight">No</button>
								<button type="button" onclick="window.location.href='<?php echo base_url(); ?>studyset';" class="filterBtn">Yes</button>
							</div>
						</div>
					</div>
	        </div>
        </div>
    </div>
</div>

<script>

var timer2 = "29:59";
var incrementUrl = '<?php echo base_url(); ?>studyset/incrementFlashcard';
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
