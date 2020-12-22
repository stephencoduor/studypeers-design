<section class="home-body">
    <div class="login-container">
        <div class="flex-row align-center">
            <a href="" class="prev-link"><img src="assets/registration-assets/images/prev-icon.svg" alt="Prev Icon" /></a>
            <div class="flex-item">
                <form action="<?php echo base_url('submit-step-one'); ?>" id="submit_step_one_form">
                    <div class="content-right">
                        <div class="personal-wrap text-center">
                            <img src="assets/registration-assets/images/books.png" alt="Icon" />
                            <h3>What are you studying</h3>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select class="study-field form-control" id="field_of_study" name="field" placeholder="--Select your field of study--">

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group text-right">
                                    <span class="not-listed" data-toggle="modal" data-target="#add-study">My Field of Study Not Listed</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select class="major-field form-control" id="major_field_of_study" name="major" placeholder="--Select your major--">

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group text-right">
                                    <span class="not-listed" data-toggle="modal" data-target="#add-major">My Major Not Listed</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <select class="degree-field form-control" name="degree" placeholder="--Session--">
                                        <option value="">Type Of Degree</option>
                                        <option value="1">Associate</option>
                                        <option value="2">Bachelor's</option>
                                        <option value="3">Master's</option>
                                        <option value="4">Doctoral</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <select class="session-field form-control" name="session" placeholder="--Select degree--">
                                        <?php if (!empty($session)) : ?>
                                            <?php foreach ($session as $val) : ?>
                                                <option value="<?php echo $val['value']; ?>"><?php echo $val['text'] ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <input type="text" name="field_of_interest" class="form-control" placeholder="Field of Interest">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <!-- <a href="privacy.html" class="filterBtn">Continue</a> -->
                            <button type="button" class="filterBtn" id="submit_button_step_one">Continue</button>
                        </div>
                    </div>
                    <input type="hidden" name="step" value="three">
                </form>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="add-study" role="dialog">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-body peers">
                <h4>Add Field of Study</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <p>Tell us your Field Of Study so we can manually
                                verify it.</p>
                            <input type="text" name="" class="form-control form-control--lg" placeholder="Enter your field of study">
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group text-right">
                            <button type="submit" class="filterBtn">Continue</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="add-major" role="dialog">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-body peers">
                <h4>Add Major</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <p>Tell us your Field Of Study we can manually
                                verify it.</p>
                            <input type="text" name="" class="form-control form-control--lg" placeholder="Enter your major">
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group text-right">
                            <button type="submit" class="filterBtn">Continue</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>