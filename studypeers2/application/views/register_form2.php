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
                                                    <input class="form-control date" style="height: 48px;margin-bottom: 20px;" type="date" name="dob" placeholder="Date Of Birth" required>

                                                </div>
                                                <div class="col-xl-12">
                                                      <input list="institutes" name="institute" id="institute"class="form-control" style="height: 48px;margin-bottom: 20px;" placeholder="Institution Name" required>
                                                      <datalist id="institutes">
                                                        <option value="UIM">
                                                        <option value="UIT">
                                                        <option value="UCER">
                                                      </datalist>
                                                </div>
                                                <div class="col-xl-12 id_email">
                                                    <input class="form-control" style="height: 48px;" type="email" name="password" placeholder="Enter Institute Email" required>

                                                </div>
                                                 <label style="color: blue;padding-left: 20px">
                                                    <input type="checkbox"name="remember" id="have_email" > I have not intitute email id
                                                </label>
                                                <div class="col-xl-12 id_file" style="display: none" >
                                                    <input class="form-control" style="height: 48px;margin-bottom: 20px;" type="file" name="password" title="Upload The Collage ID Card" required>

                                                </div>
                                                <div class="col-xl-12">
                                                    <input list="courses" name="course" id="course"class="form-control" style="height: 48px;margin-bottom: 20px;" placeholder="Course Name" required>
                                                      <datalist id="courses">
                                                        <option value="BCA">
                                                        <option value="MCA">
                                                        <option value="B.tech">
                                                      </datalist>
                                                </div>
                                                <div class="col-xl-12">
                                                    <input class="form-control" style="height: 48px; margin-bottom: 20px;" type="text" name="text" placeholder="Field Of Interest" required>

                                                </div>
                                                <div class="col-xl-12">
                                                    <input class="form-control" style="height: 48px;margin-bottom: 20px;" type="text" name="mobile_no" placeholder="Enter mobile No" required>
                                                </div>
                                                <div class="col-xl-12">
                                                    <button type="submit" class="bttn-mid btn-fill w-100">Submit</button>
                                                </div>
                                            </form>
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
