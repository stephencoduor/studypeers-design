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
        	var dateToday = new Date(); 
            $('#datetimepickermonth,#datetimepickerday,#datetimepickertask').datetimepicker({
                inline: true,
                
                // sideBySide: true
            });
            1
			$('#datetimepickerstart,#datetimepickerend').datetimepicker({
                allowInputToggle: true,
                format: 'L',
                minDate: dateToday,
			});
			$('#datetimepicker1').datetimepicker({
                allowInputToggle: true,
                format: 'L',
                
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
    </script>
    <script>
    	 
		function myMap() {
			var mapProp= {
			  center:new google.maps.LatLng(51.508742,-0.120850),
			  zoom:5,
		};
			var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
		}

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

	var placeSearch, autocomplete;
    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
    };

    function initAutocomplete() {
        
            autocomplete = new google.maps.places.Autocomplete((document.getElementById('location_txt')),
        {types: ['geocode']});
        
        
    }

    
    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
            	console.log(position);
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });
                autocomplete.setBounds(circle.getBounds());
                console.log(lat); console.log(lng);
            });
        }
    }

    function validateEvent(){ 
	    var event_name = $('#event_name').val();
	    if(event_name == ''){
	      $('#err_event_name').html("This field is required").show();
	      return false;
	    } else {
	      $('#err_event_name').html("").hide();
	    }

	    var location_txt = $('#location_txt').val();
	    if(location_txt == ''){
	      $('#err_location_txt').html("This field is required").show();
	      return false;
	    } else {
	      $('#err_location_txt').html("").hide();
	    }

	    var start_date = $('#start-date').val();
	    if(start_date == ''){
	      $('#err_start').html("This field is required").show();
	      return false;
	    } else {
	      $('#err_start').html("").hide();
	    }

	    var start_time = $('#start-time').val();
	    if(start_time == ''){
	      $('#err_start').html("This field is required").show();
	      return false;
	    } else {
	      $('#err_start').html("").hide();
	    }

	    var end_date = $('#end-date').val();
	    if(end_date == ''){
	      $('#err_end').html("This field is required").show();
	      return false;
	    } else {
	      $('#err_end').html("").hide();
	    }

	    var end_time = $('#end-time').val();
	    if(end_time == ''){
	      $('#err_end').html("This field is required").show();
	      return false;
	    } else {
	      $('#err_end').html("").hide();
	    }

	    if(start_date == end_date){
	    	if(end_time <= start_time){
	    		$('#err_end').html("End time is not valid").show();
	    		return false;
	    	} else {
	    		$('#err_end').html("").hide();
	    	}
	    }

	    var description = $('#description').val();
	    if(description == ''){
	      $('#err_description').html("This field is required").show();
	      return false;
	    } else {
	      $('#err_description').html("").hide();
	    }

	    var privacy = $('#privacy').val();
      	if(privacy == ''){
	        $('#err_privacy').html("This field is required").show();
	        return false;
        } else {
        	$('#err_privacy').html("").hide();
        }

	    var university = $('#university').val();
	    if(university == ''){
	      $('#err_university').html("This field is required").show();
	      return false;
	    } else {
	      $('#err_university').html("").hide();
	    }

	    var course = $('#course').val();
	    if(course == ''){
	      $('#err_course').html("This field is required").show();
	      return false;
	    } else {
	      $('#err_course').html("").hide();
	    }

	    var professor = $('#professor').val();
	    if(professor == ''){
	      $('#err_professor').html("This field is required").show();
	      return false;
	    } else {
	      $('#err_professor').html("").hide();
	    }
  	}

  	function showPermissionText(val){
		if(val == 1) {
			$('#privcy_span').html('(Keep this studyset public)').show();
		} else if(val == 2) {
			$('#privcy_span').html('(Keep this studyset private)').show();
		} else if(val == 3) {
			$('#privcy_span').html('(Keep this studyset secret)').show();
		} else {
			$('#privcy_span').html('').hide();
		}
	}


  	$(document).on("click", ".delete_event", function () {
	     var event_id = $(this).data('id');
	     $(".modal-body #event_id").val(event_id);
	     
	});

	$(document).on("click", ".addEvents", function () {
	     var event_id = $(this).data('id');
	     $(".modal-body #calender_event_id").val(event_id);
	     
	});

	$(document).on("click", ".removeEvent", function () {
	     var event_id = $(this).data('id');
	     $(".modal-body #remove_event_id").val(event_id);
	     
	});

	function readURL(input) {
	  if (input.files && input.files[0]) {
	    var reader = new FileReader();
	    
	    reader.onload = function(e) {
	    	$('#imageBoxUpload').html('<img src="'+e.target.result+'">');
	      // $('#blah').attr('src', e.target.result);
	    }
	    
	    reader.readAsDataURL(input.files[0]); // convert to base64 string
	  }
	}

	$("#featured_image-id").change(function() {
	  readURL(this);
	});

	$('#datetimepickermonth').on('dp.change', function(e){ 
    var formatedValue = e.date.format(e.date._f);
    var fields = formatedValue.split('T');
    var url = '<?php echo base_url('account/getEventsDayWise') ?>';
    $('.events').html('<h6 class="loadingEvents">Loading Events</h6>');
     $.ajax({
          url: url,
          type: 'POST',
          data: {'date': fields[0]},
          success: function(result) {
              $('.events').html(result);
          }
      });
  });


</script>
    <script src="<?php echo base_url(); ?>assets_d/js/custom.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNNCJ7_zDBYPIly-R1MJcs9zLUBNEM6eU&libraries=places&callback=initAutocomplete" async defer></script> 
</body>
</html>

