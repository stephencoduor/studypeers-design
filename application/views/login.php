 <style type="text/css">
     .single-box::before {
    background: #ffb770;
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    content: '';
    z-index: -1;
    border-radius: 10px;
}
.hero-section .hero-area .single-hero .hero-sub {
    display: table;
   height: 80vh;
 </style>
 <!--Hero Area-->
    <section class="hero-section"  style="padding-top: 150px;background-color:#fbfbfb">
        <div class="hero-area">
            <!-- <div class="single-hero "> -->
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-lg-5 col-md-6 col-sm-10 centered">
                            <div class="hero-sub">
                                <div class="table-cell">
                                    <div class="hero-left" style="color: #000000;text-align: center;">
                                        <h2>Log In</h2>
                                        <div style="padding-top: 20px">
                                            <?php if($this->session->flashdata('error_message')) { ?>
                                                <div class="alert alert-danger">  <?= $this->session->flashdata('error_message'); ?></div>
                                            <?php } ?>
                                            <form action="<?php echo site_url('login/validate_login'); ?>" class="row" method="post">
                                                <div class="col-xl-12">
                                                    <input class="form-control" style="height: 48px;margin-bottom: 20px;" type="text" name="email" placeholder="Email" required>
                                                </div>
                                                <div class="col-xl-12">
                                                    <input class="form-control password" style="height: 48px;margin-bottom: 20px;" type="password" name="password" placeholder="Password" required>

                                                </div>
                                                <label style="color:#000000;padding-bottom: 10px;padding-left: 15px">
                                                    <input type="checkbox" name="remember"> Remember me on this computer 
                                                </label>
                                                
                                                <div class="col-xl-12">
                                                    <button type="submit" class="bttn-mid btn-fill w-100">Login now</button>
                                                </div>
                                            </form>
                                            <div>
                                                <a href="<?php echo site_url('home/forgot_password'); ?>" style="color: blue">I forgot my password</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- </div> -->
        </div>
    </section><!--/Hero Area-->
    <!--Section-->
    <section style="padding-top: 30px;background-color:#fff">
        <div>
            <div class="container">
                <div class="row justify-content-center centered">
                    <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12">
                        <div class="single-box" style="background-color:#ffb770 ">
                            <h2>Not a member yet?</h2>
                            <p>Join Study Peers and use the most powerful social learning tool yet!</p>
                            <div>
                                <a href="<?=base_url('home/register')?>"class="bttn-small btn-emt">SIGN UP</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/Section-->

