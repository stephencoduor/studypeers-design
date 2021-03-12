    <section class="hero-section" style="padding-top: 150px;background-color:#e7e5e5">
    	<div class="container margin_60" style="padding-bottom: 20px">
    		<div class="row justify-content-center">
    			<?php if ($message) { ?>
    				<div class="col-xl-6 col-lg-6 col-md-8" style="text-align: center;background-color:green;color:#ffffff;padding: 10px;margin-bottom: 20px">
    					<span><?= $message ?></span>
    				</div>
    			<?php } ?>
			</div>
			<div class="row justify-content-center">
    			<div class="col-xl-6 col-lg-6 col-md-8">
    				<div class="box_account">
    					<h3 class="client"><?php echo get_phrase('Email Verification'); ?></h3>
    					<form class="" id="verification_form" action="<?php echo base_url('login/verify-otp'); ?>" method="post">
    						<div class="form_container">
    							<div class="divider" style="padding-top: 20px"><span><?php echo get_phrase('verification Code'); ?></span></div>
    							<input type="hidden" name="right_otp" id="otp" value="<?= $otp ?>">
    							<input type="hidden" name="userData" value="<?= $userData ?>">

    							<div class="form-group">
    								<input type="text" class="form-control" id="myotp_valid" name="otp" placeholder="<?php echo get_phrase('enter verification Code'); ?>*" style="height: 48px;margin-bottom: 20px;" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" minlength="6" maxlength="6" size="6" required>
    							</div>
    							<div class="clearfix add_bottom_15">
    								<div class="float-left"><a id="<?= $userData ?>" class="resend-otp" href="<?php echo site_url('login/resend-otp-page'); ?>"> <small><?php echo get_phrase("resend_OTP") . '?'; ?></small> </a></div>
    								<div class="float-right"><a id="login" href="<?php echo site_url('login'); ?>"> <small><?php echo get_phrase('back_to_login'); ?>?</small> </a></div>
    							</div>
    							<div class="text-center"><input type="submit" value="<?php echo get_phrase('Verify Email'); ?>" class="bttn-mid btn-fill change_password"></div>
    						</div>

    					</form>
    				</div>
    			</div>
    		</div>
    	</div>
    </section>