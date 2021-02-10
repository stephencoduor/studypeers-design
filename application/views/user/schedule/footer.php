<script src="<?php echo base_url(); ?>assets_d/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets_d/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets_d/js/Chart.bundle.js"></script>
<script src="<?php echo base_url(); ?>assets_d/js/jquery.mCustomScrollbar.js"></script>
<script src="<?php echo base_url(); ?>assets_d/js/utils.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<!--<script src="https://areaaperta.com/nicescroll/js/jquery.nicescroll.plus.js"></script>-->
<!--<script src="https://areaaperta.com/nicescroll/js/jquery.nicescroll.min.js"></script>-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="<?php echo base_url(); ?>assets_d/js/jquery.star-rating-svg.js"></script>
<script src="<?php echo base_url('assets_d/js/bootstrap-select.js'); ?>"></script>
<script src="https://momentjs.com/downloads/moment.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/js/bootstrap-datetimepicker.min.js"></script>

<script src='<?php echo base_url(); ?>assets_d/js/fullcalendar.min.js'></script>
<script type="text/javascript">
  $(function() {
    var dateToday = new Date();
    $('#datetimepickermonth,#datetimepickerday,#datetimepickertask').datetimepicker({
      inline: true,
      // sideBySide: true
    });
    $("#datetimepickermonth").datetimepicker().on('changeMonth', function(e) {
      var currMonth = new Date(e.date).getMonth() + 1;
      // alert(currMonth);
    });
    $('#datetimepicker1').datetimepicker({
      allowInputToggle: true,
    });
    $('#datetimepickerstart,#datetimepickerend').datetimepicker({
      allowInputToggle: true,
      minDate: dateToday,
    });
    $('body').on('click', '.event', function() {
      console.log("clicked");
      var v_id = $(this).attr('id');
      var url = '<?php echo base_url('account/getScheduleDetail') ?>';
      $.ajax({
        url: url,
        type: 'POST',
        data: {
          'id': v_id
        },
        dataType: 'json',
        success: function(result) {
          $('#eventDetailDiv').html(result.html);
          if (result.type == 2) {
            if (result.latitude != 0 && result.longitude != 0) {
              initMap(result.latitude, result.longitude, result.location_txt);
            }
          }
          $('.eventDetail').addClass('active');
        }
      });
    });



    $('.close').on('click', function() {
      $(this).parents('.eventDetail').removeClass('active');
    });
    $('.prev').on('click', function() {
      alert($('.picker-switch').html());
    });


    $('.next').on('click', function() {
      alert($('.picker-switch').html());
    });

    $('.month').on('click', function() {
      alert($(this).html());
      alert($('.picker-switch').html());
    });
  });

  var map, infoWindow;

  function initMap(latitude, longitude, location_txt) {
    latitude = parseFloat(latitude);
    longitude = parseFloat(longitude);
    map = new google.maps.Map(document.getElementById("map"), {
      center: {
        lat: latitude,
        lng: longitude
      },
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
      browserHasGeolocation ?
      "Error: The Geolocation service failed." :
      "Error: Your browser doesn't support geolocation."
    );
    infoWindow.open(map);
  }
</script>
<script>
  $(".form-group.checkbox input[type='checkbox']").click(function() {
    if ($(this).prop('checked') == true) {
      $(this).parent().parent().siblings().addClass('editMode');
    } else {
      $(this).parent().parent().siblings().removeClass('editMode');
    }
  })
  $('#selectTime1,#selectTime2').datetimepicker({
    format: 'LT',
    allowInputToggle: true
  });
  $('.sp-input-toggler').click(function(e) {
    $(this).parent('.flex-form-row').addClass('isEditable');
  })
  $('.sp-round-btn').click(function(e) {
    $(this).parent('.showInputs').parent('.flex-form-row').removeClass('isEditable');
  })

  function showFormDetails(val) {
    if (val == 'course') {
      $('#form-details').show();
      $('#schedule_name').attr("placeholder", "Course Name");
    } else if (val == 'assignment') {
      $('#form-details').show();
      $('#schedule_name').attr("placeholder", "Assignment Name");
    } else {
      $('#form-details').hide();
    }
  }

  function getProfessor(course) {
    var url = '<?php echo base_url('account/getProfessor') ?>';
    if (course != '') {

      $.ajax({
        url: url,
        type: 'POST',
        data: {
          'course': course
        },
        success: function(result) {
          $('#professor').html(result);
          
        }
      });
    } else {
      $('#professor').html('');
    }
  }

  function validateSchedule() {
    var schedule = $('#schedule').val();
    if (schedule == '') {
      $('#err_schedule').html("This field is required").show();
      return false;
    } else {
      $('#err_schedule').html("").hide();
    }

    var schedule_name = $('#schedule_name').val();
    if (schedule_name == '') {
      $('#err_schedule_name').html("This field is required").show();
      return false;
    } else {
      $('#err_schedule_name').html("").hide();
    }

    var description = $('#description').val();
    if (description == '') {
      $('#err_description').html("This field is required").show();
      return false;
    } else {
      $('#err_description').html("").hide();
    }

    var course = $('#course').val();
    if (course == '') {
      $('#err_course').html("This field is required").show();
      return false;
    } else {
      $('#err_course').html("").hide();
    }

    var startdate = $('#start-date').val();
    if (startdate == '') {
      $('#err_start-date').html("This field is required").show();
      return false;
    } else {
      $('#err_start-date').html("").hide();
    }

    var enddate = $('#end-date').val();
    if (enddate == '') {
      $('#err_end-date').html("This field is required").show();
      return false;
    } else {
      $('#err_end-date').html("").hide();
    }

    if (enddate <= startdate) {
      $('#err_end-date').html("Invalid End").show();
      return false;
    } else {
      $('#err_end-date').html("").hide();
    }

  }

  function deleteSchedule(event_id) {

    $(".modal-body #delete_schedule_id").val(event_id);

  }

  $('#datetimepickerday').on('dp.change', function(e) {
    var formatedValue = e.date.format(e.date._f);
    var fields = formatedValue.split('T');
    var url = '<?php echo base_url('account/getScheduleDayWise') ?>';
    $('#dayTabList').html('<h6 class="loadingEvents">Loading Schedule</h6>');
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        'date': fields[0]
      },
      success: function(result) {
        $('#dayTabList').html(result);
      }
    });
  });
</script>
<script src="<?php echo base_url(); ?>assets_d/js/custom.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNNCJ7_zDBYPIly-R1MJcs9zLUBNEM6eU&libraries=&v=weekly" defer async></script>
</body>

</html>