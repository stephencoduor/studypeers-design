
<section class="hero-section" style="padding-top: 110px;background-color:#e7e5e5">
    <?php if($this->session->flashdata('error_message')) { ?>
        <div class="alert alert-danger">  <?= $this->session->flashdata('error_message'); ?></div>
    <?php } ?>    <div class="hero-area">
            <div class="single-hero ">
                <div class="container">
                    <div class="row justify-content-center">
                        <?php if($message !=''){?>
                            <div class="col-xl-8 col-lg-8 col-md-12" style="text-align: center;background-color:red;color:#ffffff;padding: 10px;">
                                <span><?=$message?></span>
                            </div>
                        <?php } ?>

                        <div class="col-xl-5 col-lg-5 col-md-6 col-sm-10 centered">
                            <div class="hero-sub">
                                <div class="table-cell">
                                    <div class="hero-left" style="color: #000000;text-align: center;text-align: justify;">
                                        <h3 style="margin-bottom: 20px;">Register</h3>
                                        <div>

                                            <form action="<?php echo site_url('login/email_verification') ?>" method="post" class="row" onsubmit="return validate()">
                                                <div class="col-xl-12">
                                                    <input class="form-control nospace" style="height: 48px;margin-bottom: 20px;"  type="text" name="username" placeholder="Username" required onblur="validateUnique(this.value, 'username')">
                                                    <span class="ap-field-errors" id="error_username" style="display: none;"></span>
                                                </div>
                                                <p style="color:grey;font-size: 15px;padding: .375rem .75rem;margin-bottom: 16px;
">This address will be used to access your account and also to send you update notifications.</p>
                                                <div class="col-xl-12">
                                                    <input class="form-control" style="height: 48px;margin-bottom: 20px;"  type="email" name="email" placeholder="Email" required onblur="validateUnique(this.value, 'email')">
                                                    <span class="ap-field-errors" id="error_email" style="display: none;"></span>
                                                </div>
                                                <div class="col-xl-12">
                                                    <input class="form-control password" style="height: 48px;margin-bottom: 20px;" type="password" name="password" id="password" placeholder="Password" required>

                                                </div>
                                                
                                                <div class="col-xl-12">
                                                    <input class="form-control retype_password" style="height: 48px;margin-bottom: 20px;" type="password" id="conf_password" name="conf_password" placeholder="Repeat Password" required>
                                                </div>
                                                <div class="col-xl-12">
                                                    <span class="ap-field-errors" id="error_reg" style="display: none;"></span>
                                                </div>
                                                <!-- <div id="password_details">
                                                    <h1>Password must meet the following requirements:</h1>
                                                    <ul>
                                                        <li id="letter" class="invalid">At least <strong>one letter</strong></li>
                                                        <li id="capital" class="invalid">At least <strong>one capital letter</strong></li>
                                                        <li id="number" class="invalid">At least <strong>one number</strong></li>
                                                        <li id="length" class="invalid">Be at least <strong>8 characters</strong></li>
                                                        <li id="match" class="invalid">Password fields must match</li>
                                                    </ul>
                                                </div> -->
                                                <label style="color: blue;padding: 20px">
                                                    <input type="checkbox" checked="checked" name="remember"><a href="<?php echo site_url('home/term'); ?>"  style="color: blue;"> I accept the terms & conditions </a> 
                                                </label>
                                                <div class="col-xl-12">
                                                    <button type="submit" class="bttn-mid btn-fill w-100 change_password" id="user_register">Register</button>
                                                </div>
                                            </form>
                                            <div style="text-align: center;padding: 10px">
                                                <a href="<?=base_url('home/login')?>" style="color: blue">I have an account already</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-1 col-lg-1 col-md-1 centered d-sm-none d-md-block" >
                            <div class="col-xl-5 col-lg-5 col-md-6  centered">
                                <div class="hero-sub">
                                    <div class="table-cell">

                                        <div style="border-left: 1px solid gray;height: 410px;margin-bottom: 100px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 centered">
                            <div class="hero-sub">
                                <div class="table-cell">
                                    <div class="hero-left" style="color: #000000;text-align: center;text-align: justify;margin-bottom: 183px;">
                                        <div style="padding-bottom: 20px">
                                            <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12" style=" padding: 10px;border-radius: 10px;width: 100%;border:1px solid gray;text-align: center" >
                                                <a href="<?=base_url('socialLogin/google')?>" style="font-size: 15px;text-decoration: none" title="google"><img src="<?=base_url('uploads/google.png')?>" style="height: 22px">&nbsp;&nbsp;&nbsp;REGISTER WITH GOOGLE</a>
                                            </div>
                                        </div>
                                        <div style="padding-bottom: 20px">
                                            <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12" style=" padding: 10px;border-radius: 10px;width: 100%;border:1px solid gray;text-align: center" >
                                                <a href="<?=base_url('socialLogin/facebook') ?>" style="font-size: 15px;text-decoration: none" title="facebook"><img src="<?=base_url('uploads/fb.png')?>" style="height: 22px">&nbsp;&nbsp;&nbsp;REGISTER WITH FACEBOOK</a>
                                            </div>
                                        </div>

                                        <div style="padding-bottom: 20px">
                                            <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12" style=" padding: 10px;border-radius: 10px;width: 100%;border:1px solid gray;text-align: center" >
                                                <a href="<?=base_url('socialLogin/linkedinCallback') ?>" style="font-size: 15px;text-decoration: none" title="linkedIn"><img src="<?=base_url('uploads/link.png')?>" style="height: 22px">&nbsp;&nbsp;&nbsp;REGISTER WITH LINKED IN</a>
                                            </div>
                                        </div>
                                        <div style="padding-bottom: 20px">
                                            <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12" style=" padding: 10px;border-radius: 10px;width: 100%;border:1px solid gray;text-align: center" >
                                                <a href="<?=base_url('socialLogin/microsoftLogin') ?>" style="font-size: 15px;text-decoration: none" title="twitter"><img src="<?=base_url('uploads/twit.png')?>" style="height: 22px">&nbsp;&nbsp;&nbsp;REGISTER WITH MICROSOFT</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>