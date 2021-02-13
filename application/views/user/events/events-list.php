<?php if($this->input->get()) { 
            
        $startdate_search  = $this->input->get('start-date');
        $course_search     = $this->input->get('course');
        $professor_search  = $this->input->get('professor');
        $keyword_search    = $this->input->get('keyword');
        $text_msg = 'Search result not found.';
    } else {
        $startdate_search  = '';
        $course_search     = '';
        $professor_search  = '';
        $keyword_search    = '';
        $text_msg = 'No records to show.';
    }
    $user_id = $this->session->get_userdata()['user_data']['user_id'];
 ?>
            
                <section class="mainContent">
                        <div class="scheduleWrapper">
                            <div class="header">
                                <h4>Events</h4>
                                <div class="buttonGroup">
                                    <a class="filterBtn"> 
                                        <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
                                            <path d="M469.2,45.9h-82.1V22c0-11.5-9.3-20.8-20.8-20.8s-20.8,9.3-20.8,20.8v24H143.6V22c0-11.5-9.3-20.8-20.8-20.8
                                                c-11.5,0-20.8,9.3-20.8,20.8v24H20.8C9.3,46,0,55.3,0,66.8v402.5C0,480.7,9.3,490,20.8,490h447.4c11.5-0.3,20.9-9.3,21.9-20.8V66.8
                                                C490,55.3,480.7,46,469.2,45.9z M448.4,449.6H40.5V197.9h407.8V449.6z M448.4,156.3H40.5V87.7h61.4v17.7c-0.3,11.5,8.8,21,20.3,21.3
                                                c11.5,0.3,21-8.8,21.3-20.3V87.7h201.9v17.7c0,11.5,9.3,20.7,20.8,20.8c11-0.3,19.9-8.8,20.8-19.8V87.7h61.3
                                                C448.4,87.7,448.4,156.3,448.4,156.3z"></path>
                                            <path d="M230.7,400.3c-5.3,0-10.5-2.1-14.2-5.9l-66.1-66.1c-7.8-7.9-7.6-20.7,0.3-28.4c7.8-7.6,20.3-7.6,28.1,0
                                                l51.9,51.9l114.7-114.7c7.9-7.8,20.7-7.6,28.4,0.3c7.6,7.8,7.6,20.3,0,28.1L244.9,394.4C241.2,398.2,236.1,400.3,230.7,400.3z"></path>
                                            </svg>My Events
                                    </a>
                                    <a class="event" href="<?php echo base_url(); ?>account/addEvent">                              
                                        <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path d="m463.6,144.9l-142.9-128.7c-3.7-3.3-8.6-5.2-13.7-5.2h-245c-11.3,0-20.4,9.1-20.4,20.4v449.2c0,11.3 9.1,20.4 20.4,20.4h388c11.3,0 20.4-9.1 20.4-20.4v-320.5c0-5.8-2.5-11.3-6.8-15.2zm-140.1-71.2l97.6,87.9h-97.6v-87.9zm106,386.5h-347v-408.4h200.2v130.2c0,11.3 9.1,20.4 20.4,20.4h126.5v257.8z"></path>
                                            <path d="m119.2,276.4c0,11.3 9.1,20.4 20.4,20.4h232.8c11.3,0 20.4-9.1 20.4-20.4 0-11.3-9.1-20.4-20.4-20.4h-232.8c-11.3,2.84217e-14-20.4,9.1-20.4,20.4z"></path>
                                            <path d="m372.4,355.6h-232.8c-11.3,0-20.4,9.1-20.4,20.4 0,11.3 9.1,20.4 20.4,20.4h232.8c11.3,0 20.4-9.1 20.4-20.4 5.68434e-14-11.3-9.1-20.4-20.4-20.4z"></path>
                                        </svg> New Event
                                    </a>
                                </div>
                            </div>
                            <?php if($this->session->flashdata('flash_message')) { 
                                      echo $this->session->flashdata('flash_message');
                                    }
                            ?>
                            <?php if($this->input->get()) { ?>
                                 <div class="main_subheaderLeft">
                                    <a href="<?php echo base_url(); ?>account/events">
                                        <svg class="sp-icon" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 490 490" style="enable-background:new 0 0 490 490;" xml:space="preserve">
                                            <path d="M245.9,436.3c14.8-16.4,13.9-41.5-2-56.8l-101.5-94.4l308.4-0.7c22.2-0.6,39.7-19,39.2-41.1c-0.5-21.4-17.7-38.6-39.1-39.1
                                                l-308.6,0.7l101.5-94.4c16.2-15.1,17.1-40.6,2-56.8c-15.1-16.2-40.6-17.1-56.8-2l-176.2,164C4.7,223.3,0.1,233.9,0,245
                                                c0,11.1,4.6,21.7,12.8,29.3L189,438.2c16.2,15.2,41.6,14.4,56.8-1.7c0.1-0.1,0.2-0.2,0.2-0.2H245.9z"></path>
                                        </svg>
                                        Clear Search Result
                                    </a>
                                    
                                </div>
                            <?php } ?>
                            <form method="get" action="<?php echo base_url(); ?>account/events">
                                <div class="filterWrapper flex-filter">
                                    <div class="flex-row">
                                    <div class="filtercalendar">
                                        <div class='input-group date' id='datetimepicker1'>
                                            <span class="input-group-addon" for="start-date">
                                                <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
                                                    <path d="M110.3,247.8h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
                                                        c-16.8,0-30.5-13.6-30.5-30.5l0,0C79.9,261.4,93.5,247.8,110.3,247.8z"></path>
                                                    <path d="M227.4,247.8h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
                                                        c-16.8,0-30.5-13.6-30.5-30.5l0,0C197,261.4,210.6,247.8,227.4,247.8z"></path>
                                                    <path d="M344.5,247.8h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
                                                        c-16.8,0-30.5-13.6-30.5-30.5l0,0C314.1,261.4,327.7,247.8,344.5,247.8z"></path>
                                                    <path d="M110.3,339.6h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
                                                        c-16.8,0-30.5-13.6-30.5-30.5l0,0C79.9,353.3,93.5,339.6,110.3,339.6z"></path>
                                                    <path d="M227.4,339.6h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
                                                        c-16.8,0-30.5-13.6-30.5-30.5l0,0C197,353.3,210.6,339.6,227.4,339.6z"></path>
                                                    <path d="M344.5,339.6h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
                                                        c-16.8,0-30.5-13.6-30.5-30.5l0,0C314.1,353.3,327.7,339.6,344.5,339.6z"></path>
                                                    <path d="M469.2,45.6h-82.1V21.7c0-11.5-9.3-20.8-20.8-20.8c-11.5,0-20.8,9.3-20.8,20.8v24H143.6v-24
                                                        c0-11.5-9.3-20.8-20.8-20.8s-20.8,9.3-20.8,20.8v24H20.8C9.3,45.7,0,54.9,0,66.4v402.5c0,11.5,9.3,20.7,20.8,20.8h447.4
                                                        c11.5-0.3,20.9-9.3,21.9-20.8V66.4C490,54.9,480.7,45.6,469.2,45.6z M448.3,449.3H40.5V197.5h407.8V449.3z M448.3,155.9H40.5V87.3
                                                        h61.4V105c-0.3,11.5,8.8,21,20.3,21.3s21-8.8,21.3-20.3l0,0V87.2h201.9v17.7c0,11.5,9.3,20.7,20.8,20.8c11-0.3,19.9-8.8,20.8-19.8
                                                        V87.2h61.3v68.6V155.9z"></path>
                                                </svg>
                                                <!-- <span class="glyphicon glyphicon-calendar"></span> -->
                                            </span>
                                            <input type='text' class="form-control" name="start-date" id="start-date" value="<?php if($startdate_search != '') { echo date('m/d/Y', strtotime($startdate_search)); } ?>" />
                                            
                                        </div>
                                    </div>
                                    <div class="filterSelect">
                                        <select class="form-control " name="course" id="course" placeholder="InsCoursetitution" onchange="getProfessor(this.value)">
                                          <option value="">Course</option>
                                            <?php foreach ($course as $key => $value) { ?>
                                                <option value="<?= $value['id'] ?>" <?php if($course_search == $value['id']) { echo "selected"; } ?>><?= $value['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    </div>
                                    <div class="flex-row">
                                    <div class="filterSelect">
                                        <select class="form-control " placeholder="Professor" name="professor" id="professor">
                                          <option>Professor</option>
                                          <?php foreach ($professor as $key => $value) { ?>
                                                <option value="<?= $value['id'] ?>" <?php if($professor_search == $value['id']) { echo "selected"; } ?>><?= $value['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="filterSearch">
                                        <input type="text" placeholder="Search Event..." id="keyword" name="keyword" value="<?= $keyword_search; ?>">
                                        <button type="submit" class="searchBtn">
                                            <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 489.713 489.713">
                                                <path d="M483.4,454.444l-121.3-121.4c28.7-35.2,46-80,46-128.9c0-112.5-91.5-204.1-204.1-204.1S0,91.644,0,204.144
                                                s91.5,204,204.1,204c48.8,0,93.7-17.3,128.9-46l121.3,121.3c8.3,8.3,20.9,8.3,29.2,0S491.8,462.744,483.4,454.444z M40.7,204.144
                                                c0-90.1,73.2-163.3,163.3-163.3s163.4,73.3,163.4,163.4s-73.3,163.4-163.4,163.4S40.7,294.244,40.7,204.144z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    </div>
                                
                                </div>
                            </form>
                        </div>
                        <div class="studySetWrapper list">
                            <div class="cal-schedule eventHdrWrap">
                                <div class="monthEvents">
                                    <div class="monthView">
                                        <div id="datetimepickermonth"></div>
                                    </div>
                                    <div class="events">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                </section>


                <div class="modal fade" id="removeFromScheduleModal" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="modal-body peers">
                                   <h4>Confirmation</h4>
                                   <div class="row">
                                     <h6 class="modalText">Are you sure you want to remove this event <br> from your schedule?</h6>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form method="post" action="<?php echo base_url(); ?>account/removeEvent">
                                                <div class="form-group button">
                                                    <input type="hidden" id="remove_event_id" name="remove_event_id">
                                                    <button type="button" data-dismiss="modal" class="transparentBtn highlight">No</button>
                                                    <button type="submit" class="filterBtn">Yes</button>
                                                </div>
                                            </form>
                                            
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal fade" id="peersModalShare" role="dialog">
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
                            <input type="hidden" id="invite_event">
                            <div class="listUserWrap" id="shareList">
                                
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>


<div class="modal fade" id="confirmationModalRemove" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-body peers">
                   <h4>Confirmation</h4>
                   <div class="row">
                     <h6 class="modalText">Are you sure to remove/hide this Event !</h6>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group button">
                                <input type="hidden" name="remove_event_id" id="remove_event_id">
                                <button data-dismiss="modal" class="transparentBtn highlight">No</button>
                                <button type="button" class="filterBtn" onclick="removeEvent()">Yes</button>
                            </div>
                        </div>
                    </div>
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
            <input type="hidden" id="peer_attend_event">
            <div class="listUserWrap" id="peersModalAttendingList">
                
                
            </div>
          </div>
        </div>
      </div>
    </div>
</div>


    <script type="text/javascript">

        $(document).on('click','.removeSharedEvent',function(){
            var event_id = $(this).data('id'); 
            
            $("#remove_event_id").val(event_id);
            

        });

        $(document).on('click','.peersModalAttending',function(){
            var event_id = $(this).data('id'); 
            $("#peer_attend_event").val(event_id);
            $.ajax({
                url : '<?php echo base_url();?>account/getPeersEVentAttending',
                type : 'post',
                data : {"id" : event_id},
                success:function(result) {
                    
                    $('#peersModalAttendingList').html(result);
                }
            })
            

        });

        $(document).on('click','.attendEvent',function(){
            var event_id = $(this).data('id');
            var txt = $('#attend_text_'+event_id).html(); 
            $("#attend_event_id").val(event_id);
            if(txt == 'Attend'){
                $('#confirmationModalAttendHead').html('Do you want to attend this Event !');
            } else {
                $('#confirmationModalAttendHead').html("Are you sure you don't want to attend this Event !");
            }

        });

        
        $(document).on('click','.invitePeer',function(){
            var id = $(this).data('id');
            $("#invite_event").val(id);
            $.ajax({
                url : '<?php echo base_url();?>account/getPeerToInvite',
                type : 'post',
                data : {"id" : id},
                success:function(result) {
                    
                    $('#shareList').html(result);
                }
            })

        });


        function removeEvent() 
        {
            var id = $("#remove_event_id").val(); 
            if(id != ''){
                $.ajax({
                    url : '<?php echo base_url();?>account/removeSharedEvent',
                    type : 'post',
                    data : {"id" : id},
                    success:function(result) {
                        $("#confirmationModalRemove").modal('hide');
                        $("#event_id_div_"+id).remove();
                        $("#remove_event_id").val('');
                    }   
                })
            }
        }


        function attendEvent(){
            var id = $("#attend_event_id").val();
            var txt = $('#attend_text_'+id).html();
            if(id != ''){
                $.ajax({
                    url : '<?php echo base_url();?>account/attendSharedEvent',
                    type : 'post',
                    data : {"id" : id, "type" : txt},
                    success:function(result) {
                        $("#confirmationModalAttend").modal('hide');
                        $("#attend_text_"+id).html(result);
                        $("#attend_event_id").val('');
                    }   
                })
            }
        }


        function inviteToPeer(peer_id){
            var invite_event = $('#invite_event').val();

            $.ajax({
                url : '<?php echo base_url();?>account/invitePeerEvent',
                type : 'post',
                data : {"id" : invite_event, 'peer_id': peer_id},
                success:function(result) {
                    // $('#share_count_'+share_document).html(result);
                    $("#action_"+peer_id).html('<button type="button" class="like" onclick="uninviteToPeer('+peer_id+')">invited</button>');
                    // $("#share_studyset").val('');
                }   
            })
        }

        function uninviteToPeer(peer_id){
            var invite_event = $('#invite_event').val();

            $.ajax({
                url : '<?php echo base_url();?>account/uninvitePeerEvent',
                type : 'post',
                data : {"id" : invite_event, 'peer_id': peer_id},
                success:function(result) {
                    // $('#share_count_'+share_document).html(result);
                    $("#action_"+peer_id).html('<button type="button" onclick="inviteToPeer('+peer_id+')" class="like">invite</button>');
                    // $("#share_studyset").val('');
                }   
            })
        }


        function removePeer(peer_id){
            var peer_attend_event = $('#peer_attend_event').val();

            $.ajax({
                url : '<?php echo base_url();?>account/removePeerAttending',
                type : 'post',
                data : {"id" : peer_attend_event, 'peer_id': peer_id},
                success:function(result) {
                    // $('#share_count_'+share_document).html(result);
                    $("#remove_peer_"+peer_id).hide();
                    // $("#share_studyset").val('');
                }   
            })
        }

    </script>
                
    
