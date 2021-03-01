<section class="home-body">
    <div class="login-container">
        <div class="flex-row">
            <div class="flex-item">
                <div class="img-wrapper">
                    <img src="<?=base_url('front/images/bg_image.jpg')?>" alt="Image">
                    <div class="content-area">
                        <div class="content-top">
                            <h1>Welcome Back</h1>
                            <p>Sign in to with your registered email and password to continue</p>
                        </div>
                        <div class="content-bottom">
                            <h3>Not a member yet?</h3>
                            <p>Join Study Peers and use the most powerful social learning tool yet!</p>
                            <a href="<?=base_url('home/register')?>" class="pink-btn">
                                CREATE AN ACCOUNT
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-item">
                <div class="content-right">
                    <?php if($this->session->flashdata('error_message')) { ?>
                        <div class="alert alert-danger">  <?= $this->session->flashdata('error_message'); ?>

                        </div>
                    <?php } ?>
                    <h2>Sign In</h2>
                    <form action="<?php echo site_url('login/validate_login') ?>" method="post" >
                    <div class="form-group">
                        <input type="email" name="email" required class="form-control form-control--lg" placeholder="Email Address" onblur="validateUnique(this.value, 'email')">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" required class="form-control form-control--lg" placeholder="Password">
                    </div>
                    <div class="form-group text-right">
                        <a href="" class="forgot-pass">Forgot Password?</a>
                    </div>
                    <div class="form-group checkbox">
                        <label class="custom-check left-space"> Remember me on this computer
                            <input value="0" type="checkbox" name="remember">
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
                                <a href="<?php echo $this->fb->login_url();?>"><img src="<?=base_url('front/images/facebook.png')?>" alt="Icon"/></a>
                                <a href="#schoolModal" data-toggle="modal"><img src="<?=base_url('uploads/canvas.png')?>" alt="Icon"/></a>
                                <a href=""><img src="<?=base_url('front/images/google.png')?>" alt="Icon"/></a>
                                <a href=""><img src="<?=base_url('front/images/twitter.png')?>" alt="Icon"/></a>
                                <a href=""><img src="<?=base_url('front/images/linkedin.png')?>" alt="Icon"/></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
 
<!-- Modal -->
<div class="modal fade" id="schoolModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Choose School </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/token_success" id="canvasChooser" method="post">
            <div class="form-group">
                <?php get_schools(); ?>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-sm float-right btn-primary btn-outline" >Proceed</button>
            </div>
        </form>
      </div>
      
    </div>
  </div>
</div>