<div id="profile" class="tab-pane fade in" xmlns="http://www.w3.org/1999/html">
    <div class="tabPaneWrapper">
        <div class="left">
            <div class="box-card">
                <div class="createBox">
                    <div class="postWrapper">
                        <h5>General Information</h5>
                        <div class="editWrapper" id="edit_profile">
                            <img src="<?php echo base_url(); ?>assets_d/images/edit.svg" alt="edit"> Edit
                        </div>
                    </div>
                    <div class="infoWrapper">
                        <div class="profile_general_info">
                            <div class="list">
                                <div class="heading">First Name</div>
                                <div class="value"><?php echo $user_detail['first_name'];?></div>
                            </div>
                            <div class="list">
                                <div class="heading">Last Name</div>
                                <div class="value"><?php echo $user_detail['last_name'];?></div>
                            </div>
                            <div class="list">
                                <div class="heading">Gender</div>
                                <div class="value"><?php echo $user_detail['gender'];?></div>
                            </div>
                            <div class="list">
                                <div class="heading">Date of Birth</div>
                                <div class="value"><?php echo $user_detail['dob'];?></div>
                            </div>
                            <div class="list">
                                <div class="heading">Country</div>
                                <div class="value"><?php echo $user_detail['country'];?></div>
                            </div>
                            <div class="list">
                                <div class="heading">Field of interest</div>
                                <div class="value"><?php echo $user_detail['field_interest'];?></div>
                            </div>
                        </div>
                        <div class="edit_general_info" style="display: none;">
                            <form method="post" action="<?php echo base_url().'Profile/updateGeneralInfo' ?>">
                                <div class="list">
                                    <div class="heading">First Name</div>
                                    <div class="value">
                                        <input type="text" class="form-control" name="first_name" value="<?php echo $user_detail['first_name'];?>" required/>
                                    </div>
                                </div>
                                <div class="list">
                                    <div class="heading">Last Name</div>
                                    <div class="value">
                                        <input type="text" class="form-control" name="last_name" value="<?php echo $user_detail['last_name'];?>" required/>
                                    </div>
                                </div>
                                <div class="list">
                                    <div class="heading">Gender</div>
                                    <div class="value">
                                        <select class="form-control" name="gender" required>
                                            <option value="male" <?php if($user_detail['gender'] == 'male') { echo "selected"; } ?>>Male </option>
                                            <option value="female" <?php if($user_detail['gender'] == 'female') { echo "selected"; } ?>>Female</option>
                                            <option value="other" <?php if($user_detail['gender'] == 'other') { echo "selected"; } ?>>Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="list">
                                    <div class="heading">Date Of Birth</div>
                                    <div class="value">
                                        <input class="form-control date" style="height: 48px;margin-bottom: 20px;" type="text" placeholder="Date Of Birth" onfocus="(this.type='date')" onblur="(this.type='text')" title="Date of Birth" name="dob"  id="dob" value="<?= $user_detail['dob']; ?>" required>
                                    </div>
                                </div>
                               <!-- <div class="list">
                                    <div class="heading">Country</div>
                                    <div class="value">

                                    </div>
                                </div>-->
                                <div class="list">
                                    <div class="heading">Field of interest</div>
                                    <div class="value">
                                        <input type="text" class="form-control" name="field_of_interest" value="<?php echo $user_detail['field_interest'];?>" required/>
                                    </div>
                                </div>
                                <div class="list">
                                    <div class="row">
                                        <button class="btn btn-primary" type="submit" id="update_general_information">Update</button>
                                        <button class="btn btn-default" type="button" id="show_general_info">Cancel</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>


                    <div class="postWrapper">
                        <h5>About</h5>
                        <div class="editWrapper" id="edit_about">
                            <img src="<?php echo base_url(); ?>assets_d/images/edit.svg" alt="edit"> Edit
                        </div>
                    </div>
                    <div id="about_info">
                        <div class="useraboutWrapper">
                            <p><?php echo $user_detail['about'];?></p>
                        </div>
                        <div class="infoWrapper">
                            <div class="list">
                                <div class="heading">High School </div>
                                <div class="value">
                                    <span><?php echo @$user_detail['high_School']; ?></span>
                                    <br>
                                    <?php echo @$user_detail['high_school_course_name']; ?> <?php echo (@$user_detail['high_school_course_year']); ?>
                                </div>
                            </div>
                            <div class="list">
                                <div class="heading">Graduation</div>
                                <div class="value">
                                    <span>College name</span>
                                    <br>
                                    Course (yyyy-yyyy)
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="edit_about_info" style="display: none;">
                        <form method="post" action="<?php echo base_url().'Profile/updateAboutInfo' ?>">
                            <div class="row">
                                <div class="list">
                                    <div class="heading">About Me</div>
                                    <div class="value">
                                        <textarea name="about_me" class="form-control" placeholder="About Me" cols="20" rows="5"><?php echo @$user_detail['about'];?></textarea>
                                    </div>
                                </div>
                                <div class="list">
                                    <div class="heading">High School</div>
                                    <div class="value">
                                        <input type="text" class="form-control" name="high_school" placeholder="High School" value="<?php echo @$user_detail['high_School']; ?>"/>
                                    </div>
                                </div>
                                <div class="list">
                                    <div class="heading"></div>
                                    <div class="value">
                                        <input type="text" class="form-control" name="course_name" placeholder="Course Name" value="<?php echo @$user_detail['high_school_course_name']; ?>"/>
                                    </div>
                                </div>
                                <div class="list">
                                    <div class="heading"></div>
                                    <div class="value">
                                        <select class="form-control" name="course_year">
                                            <option value="">Session</option>
                                            <option value="2017-2018">Summer 2020</option>
                                            <option value="2018-2019">Winter 2019/20</option>
                                            <option value="2019-2020">Summer 2019</option>
                                            <option value="2020-2021">Winter 2018/19</option>
                                            <option value="2019-2020">Summer 2018</option>
                                            <option value="2020-2021">Winter 2017/18</option>
                                            <option value="2019-2020">Summer 2017</option>
                                            <option value="2020-2021">Winter 2016/17</option>
                                            <option value="2019-2020">Summer 2016</option>
                                            <option value="2020-2021">Winter 2015/16</option>
                                            <option value="2019-2020">Summer 2015</option>
                                            <option value="2020-2021">Winter 2014/15</option>
                                            <option value="2019-2020">Summer 2014</option>
                                            <option value="2020-2021">Winter 2013/14</option>
                                            <option value="2019-2020">Summer 2013</option>
                                            <option value="2020-2021">Winter 2012/13</option>
                                            <option value="2019-2020">Summer 2012</option>
                                            <option value="2020-2021">Winter 2011/12</option>
                                            <option value="2019-2020">Summer 2011</option>
                                            <option value="2020-2021">Winter 2010/11</option>
                                            <option value="2019-2020">Summer 2010</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="list">
                                    <div class="heading">Graduation</div>
                                    <div class="value">

                                    </div>
                                </div>
                                <div class="list">
                                    <button class="btn btn-primary" type="submit" id="update_about_info">Update</button>
                                    <button class="btn btn-default" type="button" id="show_about_info">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="useraboutWrapper social">
                        <h5>Follow</h5>
                        <div class="editWrapper" id="edit_social">
                            <img src="<?php echo base_url(); ?>assets_d/images/edit.svg" alt="edit"> Edit
                        </div>
                        <div class="row" id="social_info">
                            <ul>
                                <li>
                                    <a href="<?php echo @$user_detail['fb_link']; ?>">
                                        <img src="<?php echo base_url(); ?>assets_d/images/facebook.svg" alt="facebook">
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo @$user_detail['twitter_link']; ?>">
                                        <img src="<?php echo base_url(); ?>assets_d/images/twitter.svg" alt="twitter">
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo @$user_detail['linkedIn_link']; ?>">
                                        <img src="<?php echo base_url(); ?>assets_d/images/linkedin.svg" alt="linkedin">
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo @$user_detail['youtube_link']; ?>">
                                        <img src="<?php echo base_url(); ?>assets_d/images/youtube.svg" alt="youtube">
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div id="edit_social_info" style="display: none;">
                            <form method="post" action="<?php echo base_url().'Profile/updateSocialInfo' ?>">
                            <div class="list">
                                <div class="heading">Facebook Link</div>
                                <div class="value">
                                    <input type="text" class="form-control" name="facebook_link" />
                                </div>
                            </div>
                            <div class="list">
                                <div class="heading">Twitter Link</div>
                                <div class="value">
                                    <input type="text" class="form-control" name="twitter_link" />
                                </div>
                            </div>
                            <div class="list">
                                <div class="heading">LinkedIn Link</div>
                                <div class="value">
                                    <input type="text" class="form-control" name="linkedin_link" />
                                </div>
                            </div>
                            <div class="list">
                                <div class="heading">Youtube Link</div>
                                <div class="value">
                                    <input type="text" class="form-control" name="youtube_link" />
                                </div>
                            </div>
                            <div class="row">
                                <button class="btn btn-primary" type="submit">Submit</button>
                                <button class="btn btn-default" type="button" id="show_social_div">Cancel</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="right">
            <div class="boxwrap completeProfile">
                <h6>Complete your profile</h6>
                <p>Current status of your profile</p>

                <?php
                $complete_per = 40;
                if(isset($user_detail['about']) && isset($user_detail['high_School'])){
                    $complete_per += 30;
                }
                if(isset($user_detail['fb_link'])){
                    $complete_per += 30;
                }



                ?>



                <div class="profileProgressBar">
                    <div class="progress mx-auto" data-value='<?php echo $complete_per ; ?>'>
															          <span class="progress-left">
															             <span class="progress-bar border-primary"></span>
															          </span>
															          <span class="progress-right">
															              <span class="progress-bar border-primary"></span>
															          </span>
                        <div class="profileUser">
                            <?php if(empty($user_detail['image'])){

                                if(strcasecmp($user_detail['gender'] , 'male') == 0){
                                    ?>
                                    <img src="<?php echo base_url(); ?>uploads/user-male.png" alt="User Post">
                                <?php } else {
                                    ?>
                                    <img src="<?php echo base_url(); ?>uploads/user-female.png" alt="User Post">
                                    <?php
                                }

                            }else{
                                ?>
                                <img src="<?php echo base_url()."uploads/users/".$user_detail['image']; ?>" alt="user">
                                <?php
                            }?>
                        </div>
                    </div>
                    <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                        <div class="h2 font-weight-bold"><?php echo $complete_per ; ?><sup class="small">%</sup></div>
                        <div class="complete">Complete</div>
                    </div>
                </div>
                <?php if($complete_per != 100){
                    ?>
                    <div class="completeNow">
                        <button type="button" class="event_action">Complete Now</button>
                    </div>
                    <?php
                }?>

            </div>
            <div class="boxwrap">
                <h6>Latest Updates</h6>
                <p>Peers</p>
                <div class="listBox">
                    <div class="listWrap">
                        <div class="left">
                            <figure>
                                <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
                            </figure>
                        </div>
                        <div class="right">
                            <h6>Jane Doe</h6>
                            <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>
                        </div>
                    </div>
                    <div class="listWrap">
                        <div class="left">
                            <figure>
                                <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
                            </figure>
                        </div>
                        <div class="right">
                            <h6>Jane Doe</h6>
                            <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>
                        </div>
                    </div>
                    <div class="listWrap">
                        <div class="left">
                            <figure>
                                <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
                            </figure>
                        </div>
                        <div class="right">
                            <h6>Jane Doe</h6>
                            <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>
                        </div>
                    </div>
                </div>
                <p>Institutions</p>
                <div class="listBox last">
                    <div class="listWrap">Nothing to show</div>
                </div>
            </div>
        </div>
    </div>
</div>

