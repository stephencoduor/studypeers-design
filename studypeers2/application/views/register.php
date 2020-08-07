    <section class="hero-section" style="padding-top: 20px">
        <div class="hero-area">
            <div class="single-hero ">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-lg-5 col-md-6 col-sm-10 centered">
                            <div class="hero-sub">
                                <div class="table-cell">
                                    <div class="hero-left" style="color: #000000;text-align: center;text-align: justify;">
                                        <h3 style="margin-bottom: 20px;">Register</h3>
                                        <div>

                                            <form action="<?php echo site_url('login/register_user') ?>" method="post" class="row">
                                                <div class="col-xl-12">
                                                    <input class="form-control" style="height: 48px;margin-bottom: 20px;"  type="text" name="username" placeholder="Username" required>
                                                </div>
                                                <p style="color:grey;font-size: 15px;padding: .375rem .75rem;margin-bottom: 16px;
">This address will be used to access your account and also to send you update notifications.</p>
                                                <div class="col-xl-12">
                                                    <input class="form-control" style="height: 48px;margin-bottom: 20px;" type="email" name="email" placeholder="Email" required>
                                                </div>
                                                <div class="col-xl-12">
                                                    <input class="form-control password" style="height: 48px;margin-bottom: 20px;" type="password" name="password" placeholder="Password" required>

                                                </div>
                                                
                                                <div class="col-xl-12">
                                                    <input class="form-control retype_password" style="height: 48px;margin-bottom: 20px;" type="password" name="conf_password" placeholder="Repeat Password" required>
                                                </div>
                                                <div id="password_details">
                                                    <h1>Password must meet the following requirements:</h1>
                                                    <ul>
                                                        <li id="letter" class="invalid">At least <strong>one letter</strong></li>
                                                        <li id="capital" class="invalid">At least <strong>one capital letter</strong></li>
                                                        <li id="number" class="invalid">At least <strong>one number</strong></li>
                                                        <li id="length" class="invalid">Be at least <strong>8 characters</strong></li>
                                                        <li id="match" class="invalid">Password fields must match</li>
                                                    </ul>
                                                </div>
                                                <label style="color: blue;padding: 20px">
                                                    <input type="checkbox" checked="checked" name="remember"><a href="<?php echo site_url('home/term'); ?>"  style="color: blue;"> I accept the terms & conditions </a> 
                                                </label>
                                                <div class="col-xl-12">
                                                    <button type="submit" class="bttn-mid btn-fill w-100">Register</button>
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
                    </div>
                </div>
            </div>
        </div>
    </section>