
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/intlTelInput.css">
<script src="<?php echo base_url(); ?>assets/js/intlTelInput.js"></script>
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
                <div class="col-12">
                  <h3 class="mb-0">User Details 
                    <button class="btn btn-sm btn-default pull-right" id="edit_button" onclick="editForm()">Edit</button>
                    <button class="btn btn-sm btn-danger pull-right" id="cancel_button" style="display: none;" onclick="disbaleForm()">Cancel</button>
                  </h3>
                </div>
                
              </div>
            </div>
            <div class="card-body">
              <form method="post" action="<?php echo base_url(); ?>admin/viewVerifiedUser/<?php echo base64_encode($result['userID']); ?>" id="formC">
                <h6 class="heading-small text-muted mb-4">Personal Information
                </h6>
                
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Username</label>
                        <input type="text" id="username" class="form-control" placeholder="Username" name="username" value="<?= $result['username']; ?>">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name" value="<?= $result['first_name']; ?>">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name" value="<?= $result['last_name']; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Email</label>
                        <input type="text" id="email" name="email" class="form-control" placeholder="Email" value="<?= $result['email']; ?>">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Phone Number</label>
                        <!-- <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone Number" value="<?php echo $result['country_code'].' '.$result['phone']; ?>"> -->
                        <input id="phone"  class="form-control m_b_n" name="phone" type="tel" value="<?php echo $result['phone']; ?>">
                        <input type="hidden" name="country_code" id="country_code" value="">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Date Of Birth</label>
                        <input type="text" id="dob" name="dob" class="form-control" placeholder="Date Of Birth" value="<?= $result['dob'] ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="gender">Gender</label>
                        <select class="form-control" id="gender" name="gender">
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
                        <input id="university" class="form-control" placeholder="University Name" value="<?= $university; ?>" name="university" type="text" onkeyup="searchUniversity(this.value)">
                        <input type="hidden" name="institute_id" id="institute_id" value="<?= $result['intitutionID']; ?>">
                        <div id="myInputautocomplete-list" class="autocomplete-items"></div>
                      </div>
                    </div>
                    <?php if($result['intitution_email'] != ''){ ?>
                      <div class="col-lg-4" id="intitution_email_div">
                        <div class="form-group">
                          <label class="form-control-label" for="intitution_email">University Email</label>
                          <input id="intitution_email" name="intitution_email" class="form-control" onchange="verifyEmail(this.value)" placeholder="University Email" value="<?= $result['intitution_email']; ?>" type="text">
                          <span class="custom_err" id="err_email" style="display: inline;"></span>
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
                      <div class="col-lg-4" id="intitution_idcard_div">
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
                          <select class="form-control" id="course" name="course">
                            <?php foreach ($field_data as $key => $value) { ?>
                              <option value="<?= $value['id']; ?>" <?php if($result['course'] == $value['id']) { echo "selected"; } ?>><?= $value['name']; ?></option>
                            <?php } ?>
                          </select>
                        <?php } else { ?>
                          <input type="text" id="add_course" name="add_course" class="form-control" placeholder="Field Of Study" value="<?= $result['add_course']; ?>">
                        <?php } ?>
                        
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Major</label>
                        <?php 
                          $major = $this->db->get_where($this->db->dbprefix('major_master'), array('major_master.field_id'=>$result['course']))->result_array();
                        ?>
                          <select class="form-control" id="major" name="major">
                            <?php foreach ($major as $key => $value) { ?>
                              <option <?= $value['id']; ?> <?php if($result['major'] == $value['id']) { echo "selected"; } ?>><?= $value['name']; ?></option>
                            <?php } ?>
                          </select>
                        
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="degree">Type Of Degree</label>
                        <select class="form-control" id="degree" name="degree">
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
                        <select class="form-control" id="session" name="session">
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
                        <input type="text" id="field_interest" name="field_interest" class="form-control" placeholder="Field Of Interest" value="<?= $result['field_interest']; ?>">
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
                      <input type="checkbox" id="profile_setting" name="profile_setting" <?php if($result['profile_setting'] == 1) { echo "checked"; } ?>>
                      <span class="custom-toggle-slider rounded-circle"></span>
                    </label>
                  </div>
                </div>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label">Name Setting</label>
                        <select class="form-control" id="privacy" name="privacy">
                          <option value="full_name" <?php if($result['privacy'] == "full_name") { echo "selected"; } ?>>Full Name</option>
                          <option value="initial" <?php if($result['privacy'] == "initial") { echo "selected"; } ?>>First Name and Initial</option>
                          <option value="nickname" <?php if($result['privacy'] == "nickname") { echo "selected"; } ?>>Nickname</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label">Nickname</label>
                        <input type="text" id="nickname" name="nickname" class="form-control" placeholder="Nickname" value="<?= $result['nickname']; ?>">
                      </div>
                    </div>
                  </div>
                </div>

                <hr class="my-4" />
                <!-- Description -->
                <h6 class="heading-small text-muted mb-4">User Verification
                  <!-- <button class="btn btn-sm btn-default pull-right">Edit</button> -->
                </h6>
                <div class="pl-lg-4">
                  <div class="row">
                    
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label" for="verify_user">Verify User</label>
                          <select class="form-control" id="verify_user" name="verify_user">
                            <option value="0" <?php if($result['is_verified'] == 0) { echo "selected"; } ?>>Pending</option>
                            <option value="1" <?php if($result['is_verified'] == 1) { echo "selected"; } ?>>Verified</option>
                          </select>
                        </div>
                      </div>
                  </div>

                </div>
                <?php if($result['is_disable'] == 1) { ?>
                  <div class="pl-lg-4">
                    <div class="form-group">
                      <label class="form-control-label">Disabled Reason</label>
                      <textarea class="form-control" rows="3" placeholder="Enter Reason Here.." readonly=""><?= $result['disable_reason']; ?></textarea>
                      
                    </div>
                  </div>
                <?php } ?>
                <div class="pl-lg-4">
                  <div class="row">
                    
                    <input type="submit" id="update_user" name="update" onclick="return validateUpdate()" style="display: none;" class="btn btn-primary" value="Update User">
                    <?php if($result['is_disable'] == 1) { ?>
                      <input type="submit" class="btn btn-success" value="Enable User" name="enable">
                      
                    <?php } else { ?>
                      <button type="button" data-toggle="modal" data-target="#reason-modal" class="btn btn-danger">Disable User</button>
                    <?php } ?>
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
      
<?php  
$code = explode("+",$result['country_code']);
$get_country_code = $this->db->get_where($this->db->dbprefix('countries'), array('phonecode'=>$code[1]))->row_array(); 

?>

<script>

  $(document).ready(function(){ 
    disbaleForm();
  });

  function editForm(){
    $("#formC input").attr("readonly", false);
    $('#formC select option:not(:selected)').attr('disabled', false);
    $('.custom-toggle').css('pointer-events', 'auto');
    $('#edit_button').hide();
    $('#cancel_button').show();
    $('#update_user').show();
  }

  function disbaleForm(){
    $("#formC input").attr("readonly", true);
    $('#formC select option:not(:selected)').attr('disabled', true);
    $('.custom-toggle').css('pointer-events', 'none');
    $('#edit_button').show();
    $('#cancel_button').hide();
    $('#update_user').hide();
  }

  function validateUpdate(){
    var country_code = "+"+$(".iti__selected-flag").attr("title").match(/\d+/);
    $('#country_code').val(country_code);

    var check = $('#err_email').text().length;
    if(check > 5) {
      return false;
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

  function searchUniversity(keyword){
    var url = '<?php echo base_url('home/searchUniversity') ?>';
    if((keyword != '') && (keyword.length > 2)) {

      $.ajax({
          url: url,
          type: 'POST',
          data: {'keyword': keyword},
          success: function(result) {
              $('#myInputautocomplete-list').html(result);
          }
      });
    } else {
      $('#myInputautocomplete-list').html('');
      $('#valid_div').css('display','none');
    }
}

function selectUniversity(university){
    $('#institute_id').val(university);
    var text = $('#suggestion_'+university).text();
    $('#university').val(text);
    $('#myInputautocomplete-list').html('');
    if($('#intitution_email_div').is(":visible")){
      $('#intitution_email').val('');
    } else {
      $('#intitution_idcard_div').html('<div class="form-group"><label class="form-control-label" for="intitution_email">University Email</label><input id="intitution_email" name="intitution_email" class="form-control" onchange="verifyEmail(this.value)" placeholder="University Email" value="" type="text"><span class="custom_err" id="err_email" style="display: inline;"></span></div>');
    }
}

  var input = document.querySelector("#phone");
    window.intlTelInput(input, {
      // allowDropdown: false,
      // autoHideDialCode: false,
      // autoPlaceholder: "off",
      // dropdownContainer: document.body,
      // excludeCountries: ["us"],
      // formatOnDisplay: false,
      // geoIpLookup: function(callback) {
      //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
      //     var countryCode = (resp && resp.country) ? resp.country : "";
      //     callback(countryCode);
      //   });
      // },
      // hiddenInput: "full_number",
      initialCountry: "<?php echo $get_country_code['sortname'] ?>",
      // localizedCountries: { 'de': 'Deutschland' },
      // nationalMode: false,
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
      // placeholderNumberType: "MOBILE",
      // preferredCountries: ['cn', 'jp'],
      // separateDialCode: true,
      utilsScript: "<?php echo base_url(); ?>assets/js/utils.js",
    });


    function isValidEmailAddress(email01) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(email01);
}

function verifyEmail(email){ 
    var url = '<?php echo base_url('home/verifyEmail') ?>';
        if (email != '') {
            var email2 = isValidEmailAddress(email);
            if(!email2) {
                $('#err_email').css('color', 'red').text('Email Id is not valid').show();
                $('#email').focus();
                return false;
            } else {
               
                    var institute_id = $('#institute_id').val();
                    
                    return $.ajax({
                        url: url,
                        type: 'post',
                        data: {'email': email, 'institute_id': institute_id},
                        success: function(res) { 
                            if (res != 0) {
                                $('#err_email').html(res).show();
                                return false;
                            } else {
                               $('#err_email').html('').hide();
                            }
                            
                        }
                    });
                
            }
        }
}
  
</script>      