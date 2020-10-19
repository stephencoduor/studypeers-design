<style type="text/css">
    }

.section-padding-3 {
    padding-top: 30px;
    padding-bottom: 0px;
}
</style>
<!--Footer Area-->
    <footer style="background-color: #e4ecfa;height: 10%">
        <div class="container">
            <div class="row mb-10">
                <!-- <a href="<?=base_url('home')?>">Home</a> -->
                <!-- <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                    <div class="footer-widget footer-nav">
                        <h3 style="color: #ffffff">Quick Link</h3>
                        <ul>
                            <li><a href="<?=base_url('home')?>">Home</a></li>
                            <li><a href="<?=base_url('home/login')?>">SIGN IN</a></li>
                            <li><a href="<?=base_url('home/register')?>">SIGN UP</a></li>
                            
                        </ul>

                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                    <div class="footer-widget footer-nav">
                        <h3 style="color: #ffffff"> Quick Links</h3>
                        <ul>
                            <li><a href="<?=base_url('home/about')?>">About Us</a></li>
                            <li><a href="<?=base_url('home/privacy')?>">Privacy Policy</a></li>
                            <li><a href="<?=base_url('home/term')?>">Terms & Conditions</a></li>
                            <li><a href="javascript::void(0)">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                    <div class="footer-widget footer-nav">
                        <h3 style="color: #ffffff">Contact Us</h3>
                        <p class="font-16"><i class="fa fa-whatsapp"></i> &nbsp; <a style="color:#fff;" target="_blank" href="//api.whatsapp.com/send?l=en&amp;text=Hi!%20I%27m%20interested%20in%20one%20of%20your%20products%20at%20Online%20Astro%20Talk&amp;phone=+917982724152">+911-*****333</a></p>
                        <p class="font-16"><i class="fa fa-phone"></i> &nbsp; <a style="color:#fff;" target="_blank" href="tel:01203548100">0120-****00</a></p>
                        <p class="font-16"><i class="fa fa-envelope"></i> &nbsp; <a style="color:#fff;" target="_blank" href="mailto:contact@onlineastrotalk.com">contact@studypeers***.com</a></p>
                    </div>
                </div> -->
            </div>
            <!-- <div class="row">
                <div class="col-xl-12 centered cl-white copyright mt-50 ">
                    <p class="mb-0">Copyright &copy; 2020 All Rights Reserved</p>
                </div>
            </div> -->
        </div>
    </footer><!--/Footer Area-->

<div class="modal fade" id="qna_modal" role="dialog" aria-labelledby="AstroGuruTips" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel" style="color: black;
                        font-size: 18px; font-family: 'Ek Mukta', sans-serif!important;">Want to know what's happening inside? </h4>
                    <button type="button" class="close" style="margin-top:-28px;" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="report_form" action="#">
                <div class="modal-body">
                    <div class="col-md-12" style="padding-top:10px">
                       <label>Who Are You</label>
                        <select class="form-control whru" id="whru" name="whru" required="">
                          <option value="" selected disabled="">Select User Type</option>
                          <option value="student">Student</option>
                          <option value="faculty">Faculty</option>
                        </select>
                    </div>
                    <div class="col-md-12 " style="padding-top:10px" id="inst">
                       <label>Institution</label>
                        <select class="form-control institution" id="institution" name="institution" required="">
                          <option value="" selected disabled="">Select your Institution</option>
                          <option value="uim">UIM</option>
                          <option value="srms">SRMS</option>
                        </select>
                    </div>
                    <div class="col-md-12" style="padding-top:10px" id="deg">
                       <label>Degree</label>
                        <select class="form-control degree" id="degree" name="degree" required="">
                          <option value="" selected disabled="">Select your Degree</option>
                          <option value="bachlor">Bachelor</option>
                          <option value="pg">Post Graduate</option>
                        </select>
                    </div>
                    <div class="col-md-12" style="padding-top:10px" id="cus">
                       <label>Course</label>
                        <select class="form-control course" id="course" name="course" required="">
                          <option value="" selected disabled="">Select your Course</option>
                          <option value="bca">BCA</option>
                          <option value="mca">MCA</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type='submit'  class="bttn-small btn-emt" id="submit_qna">Submit</button>
                    <button type="button" class="btn btn-info"  data-dismiss="modal" aria-label="Close">Cancel</button>
                </div>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?=base_url('assets/js/jquery-3.2.1.min.js')?>"></script>
    <script src="<?=base_url('assets/js/jquery-migrate.js')?>"></script>

    <script src="<?=base_url('assets/js/popper.js')?>"></script>
    <script src="<?=base_url('assets/js/bootstrap.min.js')?>"></script>
    <script src="<?=base_url('assets/js/owl.carousel.min.js')?>"></script>
    <script src="<?=base_url('assets/js/parallax.min.js')?>"></script>    

    <script src="<?=base_url('assets/js/magnific-popup.min.js')?>"></script>
    <script src="<?=base_url('assets/js/imagesloaded.pkgd.min.js')?>"></script>
    <script src="<?=base_url('assets/js/isotope.pkgd.min.js')?>"></script>
    
    <script src="<?=base_url('assets/js/waypoints.min.js')?>"></script>
    <script src="<?=base_url('assets/js/jquery.counterup.min.js')?>"></script>
    <script src="<?=base_url('assets/js/scrollUp.min.js')?>"></script>
    <script src="<?=base_url('assets/js/jquery.nice-select.min.js')?>"></script>

    <script src="<?=base_url('assets/js/script.js')?>"></script>
    <script type="text/javascript">
         $(document).ready(function(){
            $('.nospace').keypress(function( e ) {
                if(e.which === 32) {
                    return false;
                }
            });

            $('#deg').hide();
            $('#cus').hide();
            $('#inst').hide();
            $('#otp_div').hide();
            $('#otp_send').hide();
              $('#phone').focus(function() {
                  $('#otp_send').show();
              });
                $('#otp_send').click(function() {
                  var value = $('#phone').val().length;
                  var user_mobile = $('#phone').val(); 
                  if(value == 10){
                    $('#otp_send').text("Resend OTP");
                    $.ajax({
                        url: "<?php echo base_url();?>login/get_mobile_no_verification",
                        type: "post",
                        data:{user_mobile : user_mobile},
                        success: function(response){
                          console.log(response);
                          // $('#status').html('otp send your ********** mobile number');
                          $('#otp_div').show();
                      
                        }
                    });
                  }
                });
                $('#verify_email').click(function(e) {
                    e.preventDefault();
                    var otp = $('#myotp_valid').val(); 
                    var rightotp = $('#otp').val();
                    if(otp ==rightotp){
                        var url = '<?php echo base_url('login/register_user');?>';
                        $('#verification_form').attr('action',url);
                        $('#verification_form').submit(); 
                    }else{
                        $('#myotp_valid').css('border','1px solid red');
                    }
                    
                  // $.ajax({
                  //       url: "<?php echo base_url();?>login/validate_otp",
                  //       type: "post",
                  //       data:{otp : otp},
                  //       success: function(response){
                  //           console.log(response);
                  //           if(response =='success'){
                  //               $('#otp_send').html('<i class="fa fa-check" style="color:green;background-color:#ffffff" aria-hidden="true"></i>');
                  //               $('#phone').attr('readonly','true');
                  //               $('#otp_div').hide();
                  //           }else{
                  //               $('#myotp_valid').css('border','1px solid red');
                  //           }
                  //       }
                  //   });
                });
                
            $("#submit_qna").attr('disabled', true);
            $("#submit_qna").attr('title', 'First: fill all field');
            $("select.whru").change(function(){
                var selectedtype = $(this).children("option:selected").val();
                if(selectedtype !=''){
                    $('#inst').show();
                    $("select.institution").change(function(){
                    var selectedinst = $(this).children("option:selected").val();
                    if(selectedinst !=''){
                        $('#deg').show();
                        $("select.degree").change(function(){
                        var selecteddeg = $(this).children("option:selected").val();
                        if(selecteddeg !=''){
                            $('#cus').show();
                            $("select.course").change(function(){
                            var selectedcus = $(this).children("option:selected").val();
                            if(selectedcus !=''){
                                $("#submit_qna").attr('disabled', false);
                                $("#submit_qna").attr('title', 'submit');
                            }
                        });
                        }

                    });
                    }

                });
                }
            });
            $("#have_email").click(function(){
                var tt = $("#have_email").val();
                if(this.checked == false){
                    $(".id_email").css('display', 'block');
                    $(".id_file").attr('required', 'false');
                    $(".id_file").css('display', 'none');
                }else {
                    $(".id_email").attr('required', 'false');
                    $(".id_email").css('display', 'none');
                    $(".id_file").css('display', 'block');
                    $(".id_file").attr('required', 'true');
                }
            });
            


         });
    </script>
    <script type="text/javascript">
        function validate(){
            var password = $('#password').val();
            if(password.length < 8){
                $('#error_reg').text('Password must be minimum 8 characters.').show();
                return false;
            } else {
                $('#error_reg').text('').hide();
            }

            var conf_password = $('#conf_password').val();
            if(conf_password != password){
                $('#error_reg').text('Password fields must match.').show();
                return false;
            } else {
                $('#error_reg').text('').hide();
            }

            chk_err = $('#error_username').text().length; 
            chk_err2 = $('#error_email').text().length; 
            if((chk_err > 5) || (chk_err2 > 5)){
                return false;
            }
            
        }

        function validateUnique(value, field){
            var url = '<?php echo base_url('login/validateUnique') ?>';
            $.ajax({
                url: url,
                type: 'post',
                data: {'value': value, 'field': field},
                success: function(res) { 
                    if (res != 0) {
                        $('#error_'+field).html(res).show();
                        return false;
                    } else {
                       $('#error_'+field).html('').hide();
                    }
                    
                }
            });
        }
    </script>
</body>

<!-- Mirrored from weblos.net/HTML/paylup/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 May 2020 09:02:25 GMT -->
</html>