<div class="modal fade" id="confirmationModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <div class="modal-body peers">
	          	   <h4>Confirmation</h4>
		           <div class="row">
		           	 <h6 class="modalText">Are you sure to delete this Event!</h6>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group button">
								<form method="post" action="<?php echo base_url(); ?>account/deleteEvent">
									<input type="hidden" name="event_id" value="<?= $event['id']; ?>">
									<button type="button" data-dismiss="modal" class="transparentBtn highlight">No</button>
									<button type="submit" class="filterBtn">Yes</button>
								</form>
							</div>
						</div>
					</div>
	        </div>
        </div>
    </div>
</div>
<div class="modal fade" id="confirmationModalList" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <div class="modal-body peers">
	          	   <h4>Confirmation</h4>
		           <div class="row">
		           	 <h6 class="modalText">Are you sure to delete this Event!</h6>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group button">
								<form method="post" action="<?php echo base_url(); ?>account/deleteEvent">
									<input type="hidden" id="event_id" name="event_id" value="">
									<button type="button" data-dismiss="modal" class="transparentBtn highlight">No</button>
									<button type="submit" class="filterBtn">Yes</button>
								</form>
							</div>
						</div>
					</div>
	        </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addEventModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <div class="modal-body peers">
	          	   <h4>Confirmation</h4>
		           <div class="row">
		           	 <h6 class="modalText">Are you sure to add this Event to Calendar</h6>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group button">
								<form method="post" action="<?php echo base_url(); ?>account/addEventToCalender">
									<input type="hidden" id="calender_event_id" name="calender_event_id" value="">
									<button type="button" data-dismiss="modal" class="transparentBtn highlight">No</button>
									<button type="submit" class="filterBtn">Yes</button>
								</form>
							</div>
						</div>
					</div>
	        </div>
        </div>
    </div>
</div>	
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
	      		<!-- <a class="transAction">Share All</a> -->
	      	</div>
	      	<div class="listUserWrap">
	      		<section class="list">
	    			<section class="left">
	    				<figure>
	    					<img src="images/user2.jpg" alt="user">
	    				</figure>
	    				<figcaption>John Phelips</figcaption>
	    			</section>
	    			<!-- <section class="action">
	    				<button type="button" class="like">share</button>
	    			</section> -->
				</section>
				<section class="list">
	    			<section class="left">
	    				<figure>
	    					<img src="images/user2.jpg" alt="user">
	    				</figure>
	    				<figcaption>John Phelips</figcaption>
	    			</section>
	    			<!-- <section class="action">
	    				<button type="button" class="like">share</button>
	    			</section> -->
				</section>
				<section class="list">
	    			<section class="left">
	    				<figure>
	    					<img src="images/user2.jpg" alt="user">
	    				</figure>
	    				<figcaption>John Phelips</figcaption>
	    			</section>
	    			<!-- <section class="action">
	    				<button type="button" class="like">share</button>
	    			</section> -->
				</section>
				<section class="list">
	    			<section class="left">
	    				<figure>
	    					<img src="images/user2.jpg" alt="user">
	    				</figure>
	    				<figcaption>John Phelips</figcaption>
	    			</section>
	    			<!-- <section class="action">
	    				<button type="button" class="like">share</button>
	    			</section> -->
				</section>
				<section class="list">
	    			<section class="left">
	    				<figure>
	    					<img src="images/user2.jpg" alt="user">
	    				</figure>
	    				<figcaption>John Phelips</figcaption>
	    			</section>
	    			<!-- <section class="action">
	    				<button type="button" class="like">share</button>
	    			</section> -->
				</section>
				<section class="list">
	    			<section class="left">
	    				<figure>
	    					<img src="images/user2.jpg" alt="user">
	    				</figure>
	    				<figcaption>John Phelips</figcaption>
	    			</section>
	    			<!-- <section class="action">
	    				<button type="button" class="like">share</button>
	    			</section> -->
				</section>
				<section class="list">
	    			<section class="left">
	    				<figure>
	    					<img src="images/user2.jpg" alt="user">
	    				</figure>
	    				<figcaption>John Phelips</figcaption>
	    			</section>
	    			<!-- <section class="action">
	    				<button type="button" class="like">share</button>
	    			</section> -->
				</section>
				<section class="list">
	    			<section class="left">
	    				<figure>
	    					<img src="images/user2.jpg" alt="user">
	    				</figure>
	    				<figcaption>John Phelips</figcaption>
	    			</section>
	    			<!-- <section class="action">
	    				<button type="button" class="like">share</button>
	    			</section> -->
				</section>
				<section class="list">
	    			<section class="left">
	    				<figure>
	    					<img src="images/user2.jpg" alt="user">
	    				</figure>
	    				<figcaption>John Phelips</figcaption>
	    			</section>
	    			<!-- <section class="action">
	    				<button type="button" class="like">share</button>
	    			</section> -->
				</section>
				<section class="list">
	    			<section class="left">
	    				<figure>
	    					<img src="images/user2.jpg" alt="user">
	    				</figure>
	    				<figcaption>John Phelips</figcaption>
	    			</section>
	    			<!-- <section class="action">
	    				<button type="button" class="like">share</button>
	    			</section> -->
				</section>
	      	</div>
	      </div>
	    </div>
	  </div>
	</div>
</div>
    <script src="<?php echo base_url(); ?>assets_d/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets_d/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets_d/js/Chart.bundle.js"></script>
    <script src="<?php echo base_url(); ?>assets_d/js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="<?php echo base_url(); ?>assets_d/js/utils.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
	<!--<script src="https://areaaperta.com/nicescroll/js/jquery.nicescroll.plus.js"></script>-->
	<!--<script src="https://areaaperta.com/nicescroll/js/jquery.nicescroll.min.js"></script>-->
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
	<script src="<?php echo base_url(); ?>assets_d/js/jquery.star-rating-svg.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets_d/js/jquery.emojipicker.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets_d/js/jquery.emojis.js"></script>
	<script src="https://momentjs.com/downloads/moment.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/js/bootstrap-datetimepicker.min.js"></script>
	<!-- <script src='js/fullcalendar.js'></script> -->
	<!-- <script src='js/fullcalendar-1.js'></script> -->
	<script src='<?php echo base_url(); ?>assets_d/js/main.js'></script>
	
    <script type="text/javascript">
        $(function () {
            $('#datetimepickermonth,#datetimepickerday,#datetimepickertask').datetimepicker({
                inline: true,
                // sideBySide: true
            });
            1
			$('#datetimepicker1,#datetimepickerstart,#datetimepickerend').datetimepicker({
                allowInputToggle: true,
                format: 'L'
			});
			$('.event').not('.disabled').on('click',() => {
				$('.eventDetail').addClass('active');
			})
			$('.close').on('click',function() {
				$(this).parents('.eventDetail').removeClass('active');
			});
			$('#selectTime1,#selectTime2').datetimepicker({
	            format: 'LT',
	            allowInputToggle: true
	        });
        });
    </script>
    <script>
    	$('.cstm-select-list').hide();
    	$('.filterSearch input').focusin(function(){
    		$('.cstm-select-list').slideDown();
    	})
    	$('.filterSearch input').focusout(function(){
    		$('.cstm-select-list').slideUp();
    	})
    	$(document).ready(function(e) {
	    	$('#input-emoji').emojiPicker({
		        width: '320px',
		        height: '328px'
		    });
	    });

	    $("#input-emoji").keypress(function(event) {
		    if (event.which == 13) {
		        comment = $("#input-emoji").val();
		        event_id = $("#comment_event_id").val();
		        if(comment != ''){
		        	var url = '<?php echo base_url('account/addComment') ?>';
		        	$.ajax({
			          url: url,
			          type: 'POST',
			          data: {'comment': comment, 'event_id': event_id},
			          success: function(result) {
			          	$('#event_comment').append(result);
			            $("#input-emoji").val('');
			          }
			      });
		        }
		     }
		});



		function postReply(event, comment_id, comment){
			if (event.which == 13) {
		        event_id = $("#comment_event_id").val();
		        if(comment != ''){
	        	var url = '<?php echo base_url('account/postReply') ?>';
	        	$.ajax({
		          url: url,
		          type: 'POST',
		          data: {'comment': comment, 'event_id': event_id, 'comment_id': comment_id},
		          success: function(result) {
		          	$('#reply_'+comment_id).append(result);
		            $("#input_reply_"+comment_id).val('');
		          }
		      	});
		     }
			}
		}

		$("#imgComment").change(function () {
		    var file_data = $('#imgComment').prop('files')[0];   
		    var form_data = new FormData();     
		    event_id = $("#comment_event_id").val();             
		    form_data.append('file', file_data);
		    form_data.append('event_id', event_id);
		    // alert(form_data);  
		    var url = '<?php echo base_url('account/postImgReply') ?>';                           
		    $.ajax({
		        url: url, // point to server-side PHP script 
		        dataType: 'text',  // what to expect back from the PHP script, if anything
		        cache: false,
		        contentType: false,
		        processData: false,
		        data: form_data,                         
		        type: 'post',
		        success: function(result){
		            $('#event_comment').append(result);
		            $("#imgComment").val('');
		        }
		     });
		});

		function showReplyUser(id){
			$('#replyBox_'+id).css('display', 'flex');
		}

		function likeComment(comment_id){
			var url = '<?php echo base_url('account/likeComment') ?>';
        	$.ajax({
	          url: url,
	          type: 'POST',
	          data: {'comment_id': comment_id},
	          success: function(result) {
	          	$('#reactmessage_'+comment_id).show();
	          	$('#like_count_'+comment_id).html(result);
	          }
	      	});
		}
    </script>
    <script>
    	 
		
		function getProfessor(course){
		    var url = '<?php echo base_url('account/getProfessor') ?>';
		    if(course != '') {

		      $.ajax({
		          url: url,
		          type: 'POST',
		          data: {'course': course},
		          success: function(result) {
		              $('#professor').html(result);
		          }
		      });
		    } else {
		      $('#professor').html('');
		    }
		  }

	var map, infoWindow;

    function initMap() { 
        var latitude = parseFloat('<?php echo $event['latitude'] ?>');
        var longitude = parseFloat('<?php echo $event['longitude'] ?>');
        var location_txt = '<?php echo $event['location_txt'] ?>';
          map = new google.maps.Map(document.getElementById("map"), {
		    center: { lat: latitude, lng: longitude },
		    zoom: 15
		  });
		  infoWindow = new google.maps.InfoWindow();
		  var pos = {
		          lat: latitude,
		          lng: longitude
		        };
		  infoWindow.setPosition(pos);
		  infoWindow.setContent(location_txt);
		  infoWindow.open(map);
		  map.setCenter(pos);
		  
	}

	function handleLocationError(browserHasGeolocation, infoWindow, pos) {
	  infoWindow.setPosition(pos);
	  infoWindow.setContent(
	    browserHasGeolocation
	      ? "Error: The Geolocation service failed."
	      : "Error: Your browser doesn't support geolocation."
	  );
	  infoWindow.open(map);
	}
        
   

    
    

   


  	$(document).on("click", ".delete_event", function () {
	     var event_id = $(this).data('id');
	     $(".modal-body #event_id").val(event_id);
	     
	});

	$(document).on("click", ".addEvents", function () {
	     var event_id = $(this).data('id');
	     $(".modal-body #calender_event_id").val(event_id);
	     
	});

</script>
    <script src="<?php echo base_url(); ?>assets_d/js/custom.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNNCJ7_zDBYPIly-R1MJcs9zLUBNEM6eU&callback=initMap&libraries=&v=weekly"
      defer async ></script> 
</body>
</html>

