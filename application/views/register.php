<?php if ($this->session->flashdata('error')) : ?>
    <div class="alert alert-danger" role="alert">
        An error occured with message <?php echo $this->session->flashdata('error'); ?>.
    </div>
<?php endif; ?>

<section class="home-body">

    <div class="login-container">
        <form action="<?php echo base_url('submit') ?>" method="post" class="row" onsubmit="return validate()">

            <div class="flex-row">
                <div class="flex-item">
                    <div class="content-right">
                        <h2>Register</h2>
                        <div class="form-group user-name-wrap">
                            <input type="text" name="username" required onblur="validateUnique(this.value, 'username')" class="form-control form-control--lg" placeholder="User Name">
                            <span class="ap-field-errors" id="error_username" style="display: none;"></span>
                            <a href="javascript:void(0)"><img src="assets/images/info.png" alt="Icon"></a>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" required onblur="validateUnique(this.value, 'email')" class="form-control form-control--lg" placeholder="Email Address">
                            <span class="ap-field-errors" id="error_email" style="display: none;"></span>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" id="password" required class="form-control form-control--lg" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <input type="password" id="conf_password" name="conf_password" required class="form-control form-control--lg" placeholder="Confirm Password">
                        </div>
                        <div class="form-group">
                            <span class="ap-field-errors" id="error_reg"></span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="filterBtn" id="user_register">Continue</button>
                        </div>
                        <div class="form-group">
                            <div class="connect-with">
                                <strong>or connect with</strong>
                                <div class="link-with">
                                    <a href="<?php echo base_url('socialLogin/google'); ?>"><img src="assets/images/google.png" alt="Icon"></a>
                                    <a href="<?php echo base_url('socialLogin/facebook'); ?>"><img src="assets/images/facebook.png" alt="Icon"></a>
                                    <a href="<?php echo base_url('socialLogin/microsoftLogin'); ?>"><img src="assets/images/microsoft-icon.png" alt="Icon"></a>
                                    <a href="<?php echo base_url('socialLogin/linkedinCallback'); ?>"><img src="assets/images/linkedin.png" alt="Icon"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-item">
                    <div class="img-wrapper">
                        <img src="assets/images/bg_image.jpg" alt="Image">
                        <div class="content-area">
                            <div class="content-top">
                                <h1>Create your account</h1>
                                <p>Join Study Peers and use the most powerful social learning tool yet!</p>
                            </div>
                            <div class="content-bottom">
                                <h3>Already a member?</h3>
                                <p>Sign in to with your registered email and password to continue</p>
                                <a href="login" class="pink-btn">
                                    Sign in Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</section>