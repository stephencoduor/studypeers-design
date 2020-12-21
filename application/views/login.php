<section class="home-body">
    <div class="login-container">
        <?php if ($this->session->flashdata('error')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error Message!</strong> <?php echo $this->session->flashdata('error'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <div class="flex-row">
            <div class="flex-item">
                <div class="img-wrapper">
                    <img src="assets/images/bg_image.jpg" alt="Image">
                    <div class="content-area">
                        <div class="content-top">
                            <h1>Welcome Back</h1>
                            <p>Sign in to with your registered email and password to continue</p>
                        </div>
                        <div class="content-bottom">
                            <h3>Not a member yet?</h3>
                            <p>Join Study Peers and use the most powerful social learning tool yet!</p>
                            <a href="signup" class="pink-btn">
                                CREATE AN ACCOUNT
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-item">
                <div class="content-right">
                    <form action="<?php echo base_url('submit-login-form'); ?>" method="post">
                        <h2>Sign In</h2>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control form-control--lg" placeholder="Email Address" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control form-control--lg" placeholder="Password" required>
                        </div>
                        <div class="form-group text-right">
                            <a href="" class="forgot-pass">Forgot Password?</a>
                        </div>
                        <div class="form-group checkbox">
                            <label class="custom-check left-space"> Remember me on this computer
                                <input name="remember_me" type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="filterBtn">Sign In</button>
                        </div>
                    </form>

                    <div class="form-group">
                        <div class="connect-with">
                            <strong>or connect with</strong>
                            <div class="link-with">
                                <a href=""><img src="assets/images/google.png" alt="Icon" /></a>
                                <a href=""><img src="assets/images/facebook.png" alt="Icon" /></a>
                                <a href=""><img src="assets/images/twitter.png" alt="Icon" /></a>
                                <a href=""><img src="assets/images/linkedin.png" alt="Icon" /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>