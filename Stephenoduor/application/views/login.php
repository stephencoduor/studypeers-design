<section class="hero-section" style="padding-top: 110px;background-color:#e7e5e5">
        <div class="hero-area">
            <div class="single-hero ">
                <div class="container">
				<?php if($this->session->flashdata('error_message')) { ?>
                                    <div class="alert alert-danger">  <?= $this->session->flashdata('error_message'); ?>
                                        
                                    </div>
                                <?php } ?>
                    <div class="row justify-content-center">

                                



                        <div class="col-xl-5 col-lg-5 col-md-6 col-sm-10 centered">
                            <div class="hero-sub">
                                <div class="table-cell">
                                    <div class="hero-left" style="color: #000000;text-align: center;text-align: justify;">
                                        <h3 style="margin-bottom: 20px;">Login</h3>
                                        <div>

                                            <form action="<?php echo site_url('login/validate_login') ?>" method="post" class="row" >

                                                <div class="col-xl-12">
                                                    <input class="form-control" style="height: 48px;margin-bottom: 20px;"  type="email" name="email" placeholder="Email" required onblur="validateUnique(this.value, 'email')">
                                                    <span class="ap-field-errors" id="error_email" style="display: none;"></span>
                                                </div>

                                                <div class="col-xl-12">
                                                    <input class="form-control password" style="height: 48px;margin-bottom: 20px;" type="password" name="password" id="password" placeholder="Password" required>

                                                </div>


                                                <label style="color:#000000;padding-bottom: 10px;padding-left: 15px">
                                                    <input type="checkbox" name="remember"> Remember me on this computer 
                                                </label>
                                                
                                                <div class="col-xl-12">
                                                    <button type="submit" class="bttn-mid btn-fill w-100">Login now</button>
                                                </div>                                                
                                            
                                                <div class="col-xl-12">
                                                    <span class="ap-field-errors" id="error_reg" style="display: none;"></span>
                                                </div>

                                                <label style="color: blue;padding: 20px">
                                                    <input type="checkbox" checked="checked" name="remember"><a href="<?php echo site_url('home/term'); ?>"  style="color: blue;"> I accept the terms & conditions </a> 
                                                </label>
                                             
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
                                                <a href="javascript:void(0)" style="font-size: 15px;text-decoration: none" title="google"><img src="<?=base_url('uploads/google.png')?>" style="height: 22px">&nbsp;&nbsp;&nbsp;LOGIN WITH GOOGLE</a>
                                            </div>
                                        </div>


                                           <div style="padding-bottom: 20px">
                                            <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12" style=" padding: 10px;border-radius: 10px;width: 100%;border:1px solid gray;text-align: center" >
                                                <a href="#schoolModal" style="font-size: 15px;text-decoration: none" title="canvas" data-toggle="modal" data-target="#schoolModal"><img src="<?=base_url('uploads/canvas.png')?>" style="height: 22px">&nbsp;&nbsp;&nbsp;LOGIN WITH CANVAS LMS</a>
                                            </div>
                                        </div>


                                        <div style="padding-bottom: 20px">
                                            <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12" style=" padding: 10px;border-radius: 10px;width: 100%;border:1px solid gray;text-align: center" >
                                                <a href="<?php echo $this->fb->login_url();?>" style="font-size: 15px;text-decoration: none" title="facebook"><img src="<?=base_url('uploads/fb.png')?>" style="height: 22px">&nbsp;&nbsp;&nbsp;LOGIN WITH FACEBOOK</a>
                                            </div>
                                        </div>
                                        <div style="padding-bottom: 20px">
                                            <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12" style=" padding: 10px;border-radius: 10px;width: 100%;border:1px solid gray;text-align: center" >
                                                <a href="javascript:void(0)" style="font-size: 15px;text-decoration: none" title="twitter"><img src="<?=base_url('uploads/twit.png')?>" style="height: 22px">&nbsp;&nbsp;&nbsp;LOGIN WITH TWITTER</a>
                                            </div>
                                        </div>
                                        <div style="padding-bottom: 20px">
                                            <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12" style=" padding: 10px;border-radius: 10px;width: 100%;border:1px solid gray;text-align: center" >
                                                <a href="javascript:void(0)" style="font-size: 15px;text-decoration: none" title="linkedIn"><img src="<?=base_url('uploads/link.png')?>" style="height: 22px">&nbsp;&nbsp;&nbsp;LOGIN WITH LINKED IN</a>
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