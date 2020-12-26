<section class="home-body">
    <div class="login-container">
        <div class="flex-row align-center">
            <!-- <a href="<?php echo base_url('home/step-three-page'); ?>" class="prev-link"><img src="assets/registration-assets/images/prev-icon.svg" alt="Prev Icon" /></a> -->
            <form action="<?php echo base_url('submit-step-one'); ?>" id="submit_step_one_form">
                <div class="flex-item">
                    <div class="content-right">
                        <div class="personal-wrap text-center">
                            <img src="assets/registration-assets/images/privacy.png" alt="Icon" />
                            <h3>Privacy</h3>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <p>Private profiles can still be seen by other users on your course. If you are a Professor for an
                                    institution your profile will always be public.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="make-public">Make your profile public</label>
                                <label class="switch">
                                    <input type="checkbox" name="profile_setting" id="make-public" checked>
                                    <span class="slider round"></span>
                                </label>

                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label>Display Name</label>
                                <div class="flex-item-sections">
                                    <label class="custom-radio">
                                        <input type="radio" class="dispaly_name_selection" data-name="<?php echo $existinData['first_name'] . ' ' . $existinData['last_name']; ?>" name="privacy" value="full_name" checked required="">
                                        <span class="checkmark"></span>Full Name
                                    </label>
                                    <label class="custom-radio">
                                        <input type="radio" class="dispaly_name_selection" data-name="<?php echo $existinData['first_name'] . ' ' . strtoupper(substr($existinData['last_name'], 0, 1)); ?>" name="privacy" value="first_initial" required="">
                                        <span class="checkmark"></span>First Name and Initial
                                    </label>
                                    <label class="custom-radio">
                                        <input type="radio" data-name="" class="dispaly_name_selection" name="privacy" value="nick_name" required="">
                                        <span class="checkmark"></span>Nickname
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="text" value="<?php echo $existinData['first_name'] . ' ' . $existinData['last_name']; ?>" id="nick_name_selection_input" readonly name="nickname_text" class="form-control form-control--lg" placeholder="Enter your nickname">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button type="button" class="filterBtn" id="submit_button_step_one">Continue</button>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="step" value="four">
            </form>
        </div>
    </div>
</section>