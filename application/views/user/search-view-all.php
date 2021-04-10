<section class="mainContent">
	<div class="main-home-wrapper">
		<?php
			if(!empty($tabType)){
				$redirectLink = "window.location.href='".base_url('account/searchResult/'.$tabType)."'";
			} else if(!empty($searchType)) {
				$redirectLink = "window.location.href='".base_url('account/searchResult/'.$searchType)."'";
			} else {
				$redirectLink = "window.history.back();";
			}
		?>
		<a class="backBtn" href="javascript:;" onclick="<?php echo $redirectLink; ?>">
		  <svg class="sp-icon" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 490 490" style="enable-background:new 0 0 490 490;" xml:space="preserve">
			 <path d="M245.9,436.3c14.8-16.4,13.9-41.5-2-56.8l-101.5-94.4l308.4-0.7c22.2-0.6,39.7-19,39.2-41.1c-0.5-21.4-17.7-38.6-39.1-39.1
				l-308.6,0.7l101.5-94.4c16.2-15.1,17.1-40.6,2-56.8c-15.1-16.2-40.6-17.1-56.8-2l-176.2,164C4.7,223.3,0.1,233.9,0,245
				c0,11.1,4.6,21.7,12.8,29.3L189,438.2c16.2,15.2,41.6,14.4,56.8-1.7c0.1-0.1,0.2-0.2,0.2-0.2H245.9z"></path>
		  </svg>
		  Back 
	   </a>
	   <div id="peers" class="tab-pane fade in active">
		  <div class="content-card">
			 <div class="title-wrap">
				<h3 class="searchThing"></h3>
			 </div>
			 <div class="searchHtml">
			 </div>
		  </div>
		  <div class="pagination-wrap" id="pagination" style="display:none;">
			 
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
							<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 489.713 489.713"><path d="M483.4,454.444l-121.3-121.4c28.7-35.2,46-80,46-128.9c0-112.5-91.5-204.1-204.1-204.1S0,91.644,0,204.144
                        s91.5,204,204.1,204c48.8,0,93.7-17.3,128.9-46l121.3,121.3c8.3,8.3,20.9,8.3,29.2,0S491.8,462.744,483.4,454.444z M40.7,204.144
                        c0-90.1,73.2-163.3,163.3-163.3s163.4,73.3,163.4,163.4s-73.3,163.4-163.4,163.4S40.7,294.244,40.7,204.144z"></path></svg>
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

<div class="modal fade" id="reportModal" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<div class="modal-body peers">
				<h4>Reason</h4>
				<form method="POST" action="<?php echo base_url('account/reportThings'); ?>">
					
					<input type="hidden" name="primary_id" id="primary_id">
					<input type="hidden" name="report_post_type" id="report_post_type">
					<input type="hidden" name="current_page" id="current_page">
				
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Reason for Report</label>
								<div class="reason">
									<select class="form-control" name="report_reason" id="report_reason" required>
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
									<textarea id="report_description" name="report_description" required ></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<button type="submit" class="filterBtn">Submit</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>