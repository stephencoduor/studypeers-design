
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Manage Users</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url(); ?>admin/manageUsers">Manage Users</a></li>
                  <li class="breadcrumb-item active" aria-current="page">View User</li>
                </ol>
              </nav>
            </div>
            
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        
        <div class="col-xl-12 order-xl-1">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">User Details </h3>
                </div>
                
              </div>
            </div>
            <div class="card-body">
              <form method="post" action="<?php echo base_url(); ?>admin/viewUser/<?php echo base64_encode($result['userID']); ?>">
                <h6 class="heading-small text-muted mb-4">Personal Information
                  
                </h6>
                
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Username</label>
                        <input type="text" id="username" class="form-control" placeholder="Username" readonly="" name="username" value="<?= $result['username']; ?>">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="form-control" readonly="" placeholder="First Name" value="<?= $result['first_name']; ?>">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="form-control" readonly="" placeholder="Last Name" value="<?= $result['last_name']; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Email</label>
                        <input type="text" id="email" name="email" class="form-control" readonly="" placeholder="Email" value="<?= $result['email']; ?>">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Phone Number</label>
                        <input type="text" id="phone" name="phone" class="form-control" readonly="" placeholder="Phone Number" value="<?php echo $result['country_code'].' '.$result['phone']; ?>">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Date Of Birth</label>
                        <input type="text" id="dob" name="dob" class="form-control" readonly="" placeholder="Date Of Birth" value="<?= $result['dob'] ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="gender">Gender</label>
                        <select class="form-control select_readonly" id="gender" name="gender">
                          <option value="male" <?php if($result['gender'] == 'male') { echo "selected"; } ?>>Male</option>
                          <option value="female" <?php if($result['gender'] == 'female') { echo "selected"; } ?>>Female</option>
                          <option value="other" <?php if($result['gender'] == 'other') { echo "selected"; } ?>>Other</option>
                          
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">University & Educational Information
                  
                </h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <?php if($result['institute_type'] == 1){
                          $university_info = $this->db->get_where($this->db->dbprefix('university'), array('university_id'=>$result['intitutionID']))->row_array();
                          $university = $university_info['SchoolName'];
                        } else {
                          $university = $result['add_institute'];
                        } ?>

                        <label class="form-control-label" for="university">University Name</label>
                        <input id="university" class="form-control" readonly="" placeholder="University Name" value="<?= $university; ?>" name="university" type="text">
                      </div>
                    </div>
                    <?php if($result['intitution_email'] != ''){ ?>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label" for="intitution_email">University Email</label>
                          <input id="intitution_email" name="intitution_email" readonly="" class="form-control" placeholder="University Email" value="<?= $result['intitution_email']; ?>" type="text">
                        </div>
                      </div>
                    <?php } else { 
                      $ext = explode(".",$result['intitution_idcard']); 
                      if($ext[1] == 'pdf'){
                        $file = base_url().'assets/images/pdf.jpg';
                      } else {
                        $file = base_url().'uploads/user_identification/'.$result['intitution_idcard'];
                      }
                      $download = base_url().'uploads/user_identification/'.$result['intitution_idcard'];
                    ?>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label" for="input-address">University Identification</label>
                          <div class="card img-container" style="width: 15rem;">
                            <img class="card-img-top" src="<?php echo $file; ?>" alt="Card image cap">
                            <div class="overlay">
                              <a href="<?= $download; ?>" class="icon" title="Download University Identification" download>
                                <i class="ni ni-cloud-download-95"></i>
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="course">Field Of Study</label>
                        <?php if($result['field_type'] == 1) { ?>
                          <select class="form-control select_readonly" id="course" name="course">
                            <?php foreach ($field_data as $key => $value) { ?>
                              <option value="<?= $value['id']; ?>" <?php if($result['course'] == $value['id']) { echo "selected"; } ?>><?= $value['name']; ?></option>
                            <?php } ?>
                          </select>
                        <?php } else { ?>
                          <input type="text" id="add_course" name="add_course" readonly="" class="form-control" placeholder="Field Of Study" value="<?= $result['add_course']; ?>">
                        <?php } ?>
                        
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Major</label>
                        <?php if($result['major_type'] == 1) { 
                          $major = $this->db->get_where($this->db->dbprefix('major_master'), array('major_master.field_id'=>$result['course']))->result_array();
                        ?>
                          <select class="form-control select_readonly" id="major" name="major">
                            <?php foreach ($major as $key => $value) { ?>
                              <option <?= $value['id']; ?> <?php if($result['major'] == $value['id']) { echo "selected"; } ?>><?= $value['name']; ?></option>
                            <?php } ?>
                          </select>
                        <?php } else { ?>
                          <input type="text" id="add_major" name="add_major" readonly="" class="form-control" placeholder="Major" value="<?= $result['add_major']; ?>">
                        <?php } ?>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="degree">Type Of Degree</label>
                        <select class="form-control select_readonly" id="degree" name="degree">
                          <option value="1" <?php if($result['degree'] == 1) { echo "selected"; } ?>>Associate</option>
                          <option value="2" <?php if($result['degree'] == 2) { echo "selected"; } ?>>Bachelor's</option>
                          <option value="3" <?php if($result['degree'] == 3) { echo "selected"; } ?>>Master's</option>
                          <option value="4" <?php if($result['degree'] == 4) { echo "selected"; } ?>>Doctoral</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="session">Session</label>
                        <select class="form-control select_readonly" id="session" name="session">
                          <option value="2017-2018" <?php if($result['session'] == "2017-2018") { echo "selected"; } ?>>Summer 2020</option>
                          <option value="2018-2019" <?php if($result['session'] == "2018-2019") { echo "selected"; } ?>>Winter 2019/20</option>
                          <option value="2019-2020" <?php if($result['session'] == "2019-2020") { echo "selected"; } ?>>Summer 2019</option>
                          <option value="2020-2021" <?php if($result['session'] == "2020-2021") { echo "selected"; } ?>>Winter 2018/19</option>
                          <option value="2019-2020" <?php if($result['session'] == "2019-2020") { echo "selected"; } ?>>Summer 2018</option>
                          <option value="2020-2021" <?php if($result['session'] == "2020-2021") { echo "selected"; } ?>>Winter 2017/18</option>
                          <option value="2019-2020" <?php if($result['session'] == "2019-2020") { echo "selected"; } ?>>Summer 2017</option>
                          <option value="2020-2021" <?php if($result['session'] == "2020-2021") { echo "selected"; } ?>>Winter 2016/17</option>
                          <option value="2019-2020" <?php if($result['session'] == "2019-2020") { echo "selected"; } ?>>Summer 2016</option>
                          <option value="2020-2021" <?php if($result['session'] == "2020-2021") { echo "selected"; } ?>>Winter 2015/16</option>
                          <option value="2019-2020" <?php if($result['session'] == "2019-2020") { echo "selected"; } ?>>Summer 2015</option>
                          <option value="2020-2021" <?php if($result['session'] == "2020-2021") { echo "selected"; } ?>>Winter 2014/15</option>
                          <option value="2019-2020" <?php if($result['session'] == "2019-2020") { echo "selected"; } ?>>Summer 2014</option>
                          <option value="2020-2021" <?php if($result['session'] == "2020-2021") { echo "selected"; } ?>>Winter 2013/14</option>
                          <option value="2019-2020" <?php if($result['session'] == "2019-2020") { echo "selected"; } ?>>Summer 2013</option>
                          <option value="2020-2021" <?php if($result['session'] == "2020-2021") { echo "selected"; } ?>>Winter 2012/13</option>
                          <option value="2019-2020" <?php if($result['session'] == "2019-2020") { echo "selected"; } ?>>Summer 2012</option>
                          <option value="2020-2021" <?php if($result['session'] == "2020-2021") { echo "selected"; } ?>>Winter 2011/12</option>
                          <option value="2019-2020" <?php if($result['session'] == "2019-2020") { echo "selected"; } ?>>Summer 2011</option>
                          <option value="2020-2021" <?php if($result['session'] == "2020-2021") { echo "selected"; } ?>>Winter 2010/11</option>
                          <option value="2019-2020" <?php if($result['session'] == "2019-2020") { echo "selected"; } ?>>Summer 2010</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-8">
                      <div class="form-group">
                        <label class="form-control-label" for="field_interest">Field Of Interest</label>
                        <input type="text" id="field_interest" name="field_interest" readonly="" class="form-control" placeholder="Field Of Interest" value="<?= $result['field_interest']; ?>">
                      </div>
                    </div>
                    
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Description -->
                <h6 class="heading-small text-muted mb-4">Privacy
                  
                </h6>
                
                <div class="pl-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Make profile public</label>
                    <label class="custom-toggle ml-2" style="vertical-align: middle;">
                      <input type="checkbox" id="profile_setting" readonly="" name="profile_setting" <?php if($result['profile_setting'] == 1) { echo "checked"; } ?>>
                      <span class="custom-toggle-slider rounded-circle"></span>
                    </label>
                  </div>
                </div>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label">Name Setting</label>
                        <select class="form-control select_readonly" id="privacy" name="privacy">
                          <option value="full_name" <?php if($result['privacy'] == "full_name") { echo "selected"; } ?>>Full Name</option>
                          <option value="initial" <?php if($result['privacy'] == "initial") { echo "selected"; } ?>>First Name and Initial</option>
                          <option value="nickname" <?php if($result['privacy'] == "nickname") { echo "selected"; } ?>>Nickname</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label">Nickname</label>
                        <input type="text" id="nickname" readonly="" name="nickname" class="form-control" placeholder="Nickname" value="<?= $result['nickname']; ?>">
                      </div>
                    </div>
                  </div>
                </div>

                <hr class="my-4" />
                <!-- Description -->
                <h6 class="heading-small text-muted mb-4">Manual Verification
                  <!--  -->
                </h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <?php if($result['institute_type'] == 2) { ?>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label" for="verify_university">Verify University</label>
                          <select class="form-control" id="verify_university" name="verify_university" onchange="showUniversityDiv(this.value)">
                            <option value="1">Pending</option>
                            <option value="2">Verified</option>
                          </select>
                        </div>
                      </div>
                    <?php } ?>
                    <?php if($result['manual_verification'] == 1) { ?>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label" for="verify_university_email">Verify University Email</label>
                          <select class="form-control" id="verify_university_email" name="verify_university_email">
                            <option value="1">Pending</option>
                            <option value="2">Verified</option>
                          </select>
                        </div>
                      </div>
                    <?php } ?>
                    <?php if($result['intitution_email'] == ''){ ?>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label" for="verify_university_id">Verify University Identification</label>
                          <select class="form-control" id="verify_university_id" name="verify_university_id">
                            <option value="1">Pending</option>
                            <option value="2">Verified</option>
                          </select>
                        </div>
                      </div>
                    <?php } ?>
                    <?php if($result['field_type'] == 2){ ?>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label" for="verify_field">Verify Field Of Study</label>
                          <select class="form-control" id="verify_field" name="verify_field">
                            <option value="1">Pending</option>
                            <option value="2">Verified</option>
                          </select>
                        </div>
                      </div>
                    <?php } ?>
                    <?php if($result['major_type'] == 2){ ?>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label" for="verify_major">Verify Major</label>
                          <select class="form-control" id="verify_major" name="verify_major">
                            <option value="1">Pending</option>
                            <option value="2">Verified</option>
                          </select>
                        </div>
                      </div>
                    <?php } ?>
                    <div class="col-lg-4 university_url_div" style="display: none;">
                        <div class="form-group">
                          <label class="form-control-label" for="university_url">University URL</label>
                          <input type="text" class="form-control" name="university_url" id="university_url" placeholder="University URL">
                        </div>
                    </div>
                    <div class="col-lg-4 university_url_div" style="display: none;">
                        <div class="form-group">
                          <label class="form-control-label" for="country">Country</label>
                          <!-- <input type="text" class="form-control" name="country" id="country" placeholder="Country"> -->
                           <select class="form-control" id="country" name="country">
                            <option value="">Select Country</option>
                            <?php foreach ($countries as $key => $value) { ?>
                              <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                    </div>
                    <div class="col-lg-4 university_url_div" style="display: none;">
                        <div class="form-group">
                          <label class="form-control-label" for="email_domain">Email Domain</label>
                          <input type="text" class="form-control" name="email_domain" id="email_domain" placeholder="Email Domain">
                        </div>
                    </div>
                    <div class="col-lg-12 mb-2">
                      <span class="custom_err mb-2" id="err_verification" style="display: inline;"></span>
                    </div>
                  </div>

                </div>

                <div class="pl-lg-4">
                  <div class="row">
                    
                    <input type="submit" name="update" onclick="return validateUpdate()" class="btn btn-primary" value="Update User">
                    <button type="button" data-toggle="modal" data-target="#reason-modal" class="btn btn-danger">Disable User</button>
                  </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="reason-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Disable User Reason</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                       <div class="pl-lg-4">
                          <div class="form-group">
                            <label class="form-control-label">Enter Reason</label>
                            <textarea class="form-control" rows="3" placeholder="Enter Reason Here.." name="disable_reason" id="disable_reason"></textarea>
                            <span class="custom_err" id="err_disable_reason" style="display: inline;"></span>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" name="disable" type="submit" onclick="return validateDisable()" class="btn btn-primary" value="Continue">
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      

<script>
  $(document).ready(function(){
    $('.select_readonly option:not(:selected)').attr('disabled', true);
    $('.custom-toggle').css('pointer-events', 'none');
  });

  function validateUpdate(){
    if($('#verify_university').is(":visible")){
      var verify_university = $('#verify_university').val();
      if(verify_university == 1){
        $('#err_verification').html("Please verify the university.").show();
        return false;
      } else {
        $('#err_verification').html("").hide();
        var university_url = $('#university_url').val();
        if(university_url == ''){
          $('#err_verification').html("Please enter university url.").show();
          return false;
        } else {
          $('#err_verification').html("").hide();
        }
        var country = $('#country').val();
        if(country == ''){
          $('#err_verification').html("Please enter country.").show();
          return false;
        } else {
          $('#err_verification').html("").hide();
        }
        var email_domain = $('#email_domain').val();
        if(email_domain == ''){
          $('#err_verification').html("Please enter email domain.").show();
          return false;
        } else {
          $('#err_verification').html("").hide();
        }
      }
    }

    if($('#verify_university_email').is(":visible")){
      var verify_university_email = $('#verify_university_email').val();
      if(verify_university_email == 1){
        $('#err_verification').html("Please verify the university email.").show();
        return false;
      } else {
        $('#err_verification').html("").hide();
      }
    }

    if($('#verify_university_id').is(":visible")){
      var verify_university_id = $('#verify_university_id').val();
      if(verify_university_id == 1){
        $('#err_verification').html("Please verify the university identification.").show();
        return false;
      } else {
        $('#err_verification').html("").hide();
      }
    }

    if($('#verify_field').is(":visible")){
      var verify_field = $('#verify_field').val();
      if(verify_field == 1){
        $('#err_verification').html("Please verify the field of study.").show();
        return false;
      } else {
        $('#err_verification').html("").hide();
      }
    }

    if($('#verify_major').is(":visible")){
      var verify_major = $('#verify_major').val();
      if(verify_major == 1){
        $('#err_verification').html("Please verify the major.").show();
        return false;
      } else {
        $('#err_verification').html("").hide();
      }
    }
  }
  function validateDisable(){
    var disable_reason = $('#disable_reason').val();
      if(disable_reason == ''){
        $('#err_disable_reason').html("Please enter disable reason.").show();
        return false;
      } else {
        $('#err_disable_reason').html("").hide();
      }
    
  }

  function showUniversityDiv(val){
    if(val == 2){
      $('.university_url_div').show();
    } else {
      $('.university_url_div').hide();
    }
  }
</script>      