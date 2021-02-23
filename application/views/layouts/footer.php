<footer class="home-footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <ul>
                    <li><a href="<?php echo base_url(); ?>about-us">About Us</a></li>
                    <li><a href="<?php echo base_url(); ?>terms-conditions">Terms and Conditions</a></li>
                    <li><a href="<?php echo base_url(); ?>privacy-policy">Privacy Policy</a></li>
                    <li><a href="<?php echo base_url(); ?>contact-us">Contact Us</a></li>
                </ul>
            </div>
            <div class="col-md-4 text-right">
                <p>Copyright © 2021 Studypeers Inc.</p>
            </div>
        </div>
    </div>
</footer>
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
                    <button type='submit' class="bttn-small btn-emt" id="submit_qna">Submit</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal" aria-label="Close">Cancel</button>
                </div>
        </div>
        </form>
    </div>
</div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?= base_url('assets/js/jquery-3.2.1.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery-migrate.js') ?>"></script>

<script src="<?= base_url('assets/js/popper.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/js/owl.carousel.min.js') ?>"></script>
<script src="<?= base_url('assets/js/parallax.min.js') ?>"></script>

<script src="<?= base_url('assets/js/magnific-popup.min.js') ?>"></script>
<script src="<?= base_url('assets/js/imagesloaded.pkgd.min.js') ?>"></script>
<script src="<?= base_url('assets/js/isotope.pkgd.min.js') ?>"></script>

<script src="<?= base_url('assets/js/waypoints.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.counterup.min.js') ?>"></script>
<script src="<?= base_url('assets/js/scrollUp.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.nice-select.min.js') ?>"></script>

<script src="<?= base_url('assets/js/script.js') ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.nospace').keypress(function(e) {
            if (e.which === 32) {
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
            if (value == 10) {
                $('#otp_send').text("Resend OTP");
                $.ajax({
                    url: "<?php echo base_url(); ?>login/get_mobile_no_verification",
                    type: "post",
                    data: {
                        user_mobile: user_mobile
                    },
                    success: function(response) {
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
            if (otp == rightotp) {
                var url = '<?php echo base_url('login/register_user'); ?>';
                $('#verification_form').attr('action', url);
                $('#verification_form').submit();
            } else {
                $('#myotp_valid').css('border', '1px solid red');
            }

            // $.ajax({
            //       url: "<?php echo base_url(); ?>login/validate_otp",
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
        $("select.whru").change(function() {
            var selectedtype = $(this).children("option:selected").val();
            if (selectedtype != '') {
                $('#inst').show();
                $("select.institution").change(function() {
                    var selectedinst = $(this).children("option:selected").val();
                    if (selectedinst != '') {
                        $('#deg').show();
                        $("select.degree").change(function() {
                            var selecteddeg = $(this).children("option:selected").val();
                            if (selecteddeg != '') {
                                $('#cus').show();
                                $("select.course").change(function() {
                                    var selectedcus = $(this).children("option:selected").val();
                                    if (selectedcus != '') {
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
        $("#have_email").click(function() {
            var tt = $("#have_email").val();
            if (this.checked == false) {
                $(".id_email").css('display', 'block');
                $(".id_file").attr('required', 'false');
                $(".id_file").css('display', 'none');
            } else {
                $(".id_email").attr('required', 'false');
                $(".id_email").css('display', 'none');
                $(".id_file").css('display', 'block');
                $(".id_file").attr('required', 'true');
            }
        });



    });
</script>
<script type="text/javascript">
    function validate() {
        var password = $('#password').val();
        if (password.length < 8) {
            $('#error_reg').text('Password must be minimum 8 characters.').show();
            return false;
        } else {
            $('#error_reg').text('').hide();
        }

        var conf_password = $('#conf_password').val();
        if (conf_password != password) {
            $('#error_reg').text('Password fields must match.').show();
            return false;
        } else {
            $('#error_reg').text('').hide();
        }

        chk_err = $('#error_username').text().length;
        chk_err2 = $('#error_email').text().length;
        if ((chk_err > 5) || (chk_err2 > 5)) {
            return false;
        }

    }

    function validateUnique(value, field) {
        var url = '<?php echo base_url('login/validateUnique') ?>';
        $.ajax({
            url: url,
            type: 'post',
            data: {
                'value': value,
                'field': field
            },
            success: function(res) {
                if (res != 0) {
                    $('#error_' + field).html(res).show();
                    return false;
                } else {
                    $('#error_' + field).html('').hide();
                }

            }
        });
    }
</script>
</body>

<!-- Mirrored from weblos.net/HTML/paylup/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 May 2020 09:02:25 GMT -->
</html>