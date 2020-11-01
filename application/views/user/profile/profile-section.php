<div id="profile" class="tab-pane fade in">
    <div class="tabPaneWrapper">
        <div class="left">
            <div class="box-card">
                <div class="createBox">
                    <div class="postWrapper">
                        <h5>General Information</h5>
                        <div class="editWrapper">
                            <img src="<?php echo base_url(); ?>assets_d/images/edit.svg" alt="edit"> Edit Profile
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
                        <div class="edit_general_info">
                            <div class="list">
                                <div class="heading">First Name</div>
                                <div class="value">
                                    <input type="text" class="form-control" name="first_name" />
                                </div>
                            </div>
                            <div class="list">
                                <div class="heading">Last Name</div>
                                <div class="value">
                                    <input type="text" class="form-control" name="last_name" />
                                </div>
                            </div>
                            <div class="list">
                                <div class="heading">Gender</div>
                                <div class="value">
                                    <select class="form-control" name="gender" >
                                         <option value="male">Male</option>
                                         <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="list">
                                <div class="heading">Date Of Birth</div>
                                <div class="value">

                                </div>
                            </div>
                            <div class="list">
                                <div class="heading">Country</div>
                                <div class="value">

                                </div>
                            </div>
                            <div class="list">
                                <div class="heading">Field of interest</div>
                                <div class="value">

                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="useraboutWrapper">
                        <h5>About Me</h5>
                        <p><?php echo $user_detail['about'];?></p>
                    </div>
                    <div class="infoWrapper">
                        <div class="list">
                            <div class="heading">High School </div>
                            <div class="value">
                                <span>School name</span>
                                <br>
                                Course (yyyy-yyyy)
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
                        <div class="list">
                            <div class="heading">Other</div>
                            <div class="value">
                                <span>Institute name</span>
                                <br>
                                Course (yyyy-yyyy)
                            </div>
                        </div>
                    </div>
                    <div class="useraboutWrapper social">
                        <h5>Follow</h5>
                        <ul>
                            <li>
                                <a href="javascript:void(0)">
                                    <img src="<?php echo base_url(); ?>assets_d/images/facebook.svg" alt="facebook">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <img src="<?php echo base_url(); ?>assets_d/images/twitter.svg" alt="twitter">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <img src="<?php echo base_url(); ?>assets_d/images/linkedin.svg" alt="linkedin">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <img src="<?php echo base_url(); ?>assets_d/images/youtube.svg" alt="youtube">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="right">
            <div class="boxwrap completeProfile">
                <h6>Complete your profile</h6>
                <p>Current status of your profile</p>
                <div class="profileProgressBar">
                    <div class="progress mx-auto" data-value="40">
											          <span class="progress-left">
											             <span class="progress-bar border-primary"></span>
											          </span>
											          <span class="progress-right">
											              <span class="progress-bar border-primary" style="transform: rotate(144deg);"></span>
											          </span>
                        <div class="profileUser">
                            <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                        </div>
                    </div>
                    <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                        <div class="h2 font-weight-bold">40<sup class="small">%</sup></div>
                        <div class="complete">Complete</div>
                    </div>
                </div>
                <div class="completeNow">
                    <button type="button" class="event_action">Complete Now</button>
                </div>
            </div>
            <div class="boxwrap">
                <h6>Latest Updates</h6>
                <p>Peers</p>
                <div class="listBox">
                    <div class="listWrap">
                        <div class="left">
                            <figure>
                                <img src="images/user.jpg" alt="user">
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
                                <img src="images/user.jpg" alt="user">
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
                                <img src="images/user.jpg" alt="user">
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
                    <div class="listWrap">
                        <div class="left">
                            <figure>
                                <img src="images/user.jpg" alt="user">
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
                                <img src="images/user.jpg" alt="user">
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
                                <img src="images/user.jpg" alt="user">
                            </figure>
                        </div>
                        <div class="right">
                            <h6>Jane Doe</h6>
                            <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>