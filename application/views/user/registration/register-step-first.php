<section class="home-body">
    <div class="login-container">
        <div class="flex-row align-center">
            <div class="flex-item">
                <div class="content-right">
                    <form action="<?php echo base_url('submit-step-one'); ?>" id="submit_step_one_form">
                        <div class="personal-wrap text-center">
                            <img src="assets/registration-assets/images/personal_details.png" alt="Icon" />
                            <h3>Personal Details</h3>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Full Name</label>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="first_name" maxlength="50" class="form-control form-control--lg" placeholder="First Name" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="last_name" maxlength="50" class="form-control form-control--lg" placeholder="Last Name" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Mobile</label>
                            <div class="wrap-input">
                                <div class="phone-number-wrap">
                                    <div class="dropdown">
                                        <div class="select-add-on">
                                            <input type="tel" class="country_select" id="country_code" name="country_code" placeholder="" autocomplete="off" value="">
                                        </div>
                                    </div>
                                    <input class="form-control" type="text" maxlength="15" name="mobile_no" onkeypress='validate(event)' required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Date of birth</label>
                            <div class="filtercalendar full-width">
                                <div class="input-group date" id="datetimepickerstart">
                                    <span class="input-group-addon" for="start-date">
                                        <svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490">
                                            <path d="M110.3,247.8h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
											  c-16.8,0-30.5-13.6-30.5-30.5l0,0C79.9,261.4,93.5,247.8,110.3,247.8z"></path>
                                            <path d="M227.4,247.8h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
											  c-16.8,0-30.5-13.6-30.5-30.5l0,0C197,261.4,210.6,247.8,227.4,247.8z"></path>
                                            <path d="M344.5,247.8h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
											  c-16.8,0-30.5-13.6-30.5-30.5l0,0C314.1,261.4,327.7,247.8,344.5,247.8z"></path>
                                            <path d="M110.3,339.6h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
											  c-16.8,0-30.5-13.6-30.5-30.5l0,0C79.9,353.3,93.5,339.6,110.3,339.6z"></path>
                                            <path d="M227.4,339.6h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
											  c-16.8,0-30.5-13.6-30.5-30.5l0,0C197,353.3,210.6,339.6,227.4,339.6z"></path>
                                            <path d="M344.5,339.6h30.3c16.8,0,30.5,13.6,30.5,30.5l0,0c0,16.8-13.6,30.5-30.5,30.5h-30.3
											  c-16.8,0-30.5-13.6-30.5-30.5l0,0C314.1,353.3,327.7,339.6,344.5,339.6z"></path>
                                            <path d="M469.2,45.6h-82.1V21.7c0-11.5-9.3-20.8-20.8-20.8c-11.5,0-20.8,9.3-20.8,20.8v24H143.6v-24
											  c0-11.5-9.3-20.8-20.8-20.8s-20.8,9.3-20.8,20.8v24H20.8C9.3,45.7,0,54.9,0,66.4v402.5c0,11.5,9.3,20.7,20.8,20.8h447.4
											  c11.5-0.3,20.9-9.3,21.9-20.8V66.4C490,54.9,480.7,45.6,469.2,45.6z M448.3,449.3H40.5V197.5h407.8V449.3z M448.3,155.9H40.5V87.3
											  h61.4V105c-0.3,11.5,8.8,21,20.3,21.3s21-8.8,21.3-20.3l0,0V87.2h201.9v17.7c0,11.5,9.3,20.7,20.8,20.8c11-0.3,19.9-8.8,20.8-19.8
											  V87.2h61.3v68.6V155.9z"></path>
                                        </svg>
                                    </span>
                                    <input type="text" class="form-control" name="dob" id="start-date" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label>Gender</label>
                                <div class="flex-item-row">
                                    <label class="custom-radio">
                                        <input type="radio" name="gender" checked="checked" value="male" required="">
                                        <span class="checkmark"></span>Male
                                    </label>
                                    <label class="custom-radio">
                                        <input type="radio" name="gender" value="female" required="">
                                        <span class="checkmark"></span>Female
                                    </label>
                                    <label class="custom-radio">
                                        <input type="radio" name="gender" value="other" required="">
                                        <span class="checkmark"></span>Other
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <!-- <a href="where-are-studying.html" class="filterBtn">Continue</a> -->
                            <button type="button" class="filterBtn" id="submit_button_step_one">Continue</button>
                        </div>
                        <input type="hidden" name="step" value="one">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>