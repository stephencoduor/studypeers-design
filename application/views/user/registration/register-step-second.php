<section class="home-body">
    <div class="login-container">
        <div class="flex-row align-center">
            <a href="<?php echo base_url('home/step-register'); ?>" class="prev-link"><img src="assets/registration-assets/images/prev-icon.svg" alt="Prev Icon" /></a>
            <div class="flex-item">
                <form action="<?php echo base_url('submit-step-one'); ?>" id="submit_step_one_form">
                    <div class="content-right">
                        <div class="personal-wrap text-center">
                            <img src="assets/registration-assets/images/school.png" alt="Icon" />
                            <h3>Where are you studying</h3>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select class="select-box form-control" id="university_selection" name="university" placeholder="-Select-University">

                                    </select>
                                </div>
                                <div class="badges-list" id="show_manual_added_university">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group text-right">
                                    <span class="not-listed" data-toggle="modal" data-target="#add-institute">My Institutions Not Listed</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-group user-name-wrap">
                                        <input type="email" name="email" id="institute_email_address" class="form-control form-control--lg" placeholder="Enter institute email">
                                        <a href="javascript:void(0)"><img src="assets/registration-assets/images/info.png" alt="Icon" /></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <p class="require-email-note">Your institution email address is required to verify that you attend. if you do not have an email address you may</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12 checkbox-wrap">
                                <div class="form-group checkbox">
                                    <label class="custom-check font-weight-normal">Request manual email verification
                                        <input name="manual_verification" id="manual_verification" type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="form-group checkbox">
                                    <label class="custom-check font-weight-normal">I do not have institute email address
                                        <input name="dont_have_email" id="dont_have_email_address_id" type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-group upload-institute">
                                        <input type="text" name="file_name" id="university_uplaod_file_path" readonly class="form-control form-control--lg" placeholder="Upload institute ID">
                                        <label for="upload-file"><img src="assets/registration-assets/images/upload.svg" alt="Icon"> Upload <input type="file" disabled name="file" id="upload-file" /></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-right">
                            <!-- <a href="what-are-studying.html" id="" class="filterBtn">Continue</a> -->
                            <button type="button" class="filterBtn" id="submit_button_step_one">Continue</button>
                        </div>
                    </div>
                    <input type="hidden" name="step" value="two">
                    <input type="hidden" name="manual_university" id="manual_university">
                </form>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="add-institute" role="dialog">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-body peers">
                <h4>Add institute</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <p>Tell us your university name se we can manually
                                verify it.</p>
                            <input type="text" id="input_new_university_name" class="form-control form-control--lg" placeholder="Enter institute name">
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group text-right">
                            <button type="button" id="submit_new_university_name" class="filterBtn">Continue</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>