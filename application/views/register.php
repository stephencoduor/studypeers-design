<section class="home-body">
    <div class="login-container">
        <div class="flex-row">
            <div class="flex-item">
                <div class="content-right">
                    <?php if($message !=''){?>
                        <div class="col-xl-8 col-lg-8 col-md-12" style="text-align: center;background-color:red;color:#ffffff;padding: 10px;">
                            <span><?=$message?></span>
                        </div>
                    <?php } ?>
                    <h2>Register</h2>
                    <form action="<?php echo site_url('login/email_verification') ?>" method="post" onsubmit="return validate()">
                    <div class="form-group user-name-wrap">
                        <input type="text" name="username" class="form-control form-control--lg" placeholder="User Name" required onblur="validateUnique(this.value, 'username')">
                        <a href="javascript:void(0)"><img src="<?=base_url('front/images/info.png') ?>" alt="Icon"/></a>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control form-control--lg" placeholder="Email Address" onblur="validateUnique(this.value, 'email')" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control--lg password" type="password" name="password" id="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control--lg retype_password" type="password" id="conf_password" name="conf_password" placeholder="Repeat Password" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="filterBtn">Continue</button>
                    </div>
                    </form>
                    <div class="form-group">
                        <div class="connect-with">
                            <strong>or connect with</strong>
                            <div class="link-with">
                                <a href="<?php echo $this->fb->login_url();?>"><img src="<?=base_url('front/images/facebook.png')?>" alt="Icon"/></a>
<!--                                <a href="#schoolModal" data-toggle="modal"><img src="--><?//=base_url('uploads/canvas.png')?><!--" alt="Icon"/></a>-->
                                <a href=""><img src="<?=base_url('front/images/google.png')?>" alt="Icon"/></a>
                                <a href=""><img src="<?=base_url('front/images/twitter.png')?>" alt="Icon"/></a>
                                <a href=""><img src="<?=base_url('front/images/linkedin.png')?>" alt="Icon"/></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-item">
                <div class="img-wrapper">
                    <img src="<?=base_url('front/images/bg_image.jpg')?>" alt="Image">
                    <div class="content-area">
                        <div class="content-top">
                            <h1>Create your account</h1>
                            <p>Join Study Peers and use the most powerful social learning tool yet!</p>
                        </div>
                        <div class="content-bottom">
                            <h3>Already a member?</h3>
                            <p>Sign in to with your registered email and password to continue</p>
                            <a href="<?=base_url('home/login')?>" class="pink-btn">
                                Sign in Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>