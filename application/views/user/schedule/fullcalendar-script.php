<script type="text/javascript">
    $(document).ready(function(){
        $('#weekCalendar').on("click", function(){
            var current_date = new Date();
            var dd = String(current_date.getDate()).padStart(2, '0');
            var mm = String(current_date.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = current_date.getFullYear();
            $('#week_calendar').fullCalendar({
                header: {
                    left: 'prev,next',
                    center: 'title',
                    right: ''
                },
                defaultDate: yyyy+'-'+mm+'-'+dd,
                defaultView: 'month',
                editable: true,
                events: <?php echo $events; ?>,
                displayEventTime: false,
                eventClick: function(calEvent, jsEvent, view){
                    var v_id = calEvent.id;
                    var url = '<?php echo base_url('account/getScheduleDetail') ?>';
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {'id': v_id},
                        dataType : 'json',
                        success: function(result) {
                            console.log(result);
                            $('#eventDetailDiv').html(result.html);
                            if(result.type == 2) {
                                if(result.latitude != 0 && result.longitude != 0){
                                    initMap(result.latitude, result.longitude, result.location_txt);
                                }
                            }
                            $('.eventDetail').addClass('active');
                        }
                    });
                }
            });
            setTimeout(renderCalendar, 1000);
        });
        function renderCalendar()
        {
            $('#week_calendar').fullCalendar('render');
        }
    });
</script>