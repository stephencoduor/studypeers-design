<section class="mainContent profile">
    <div class="mainProfileWrapper">
        <div class="profileHeaderWrapper">
            <div class="profileBanner">
                <figure>
                    <img src="<?php echo base_url(); ?>assets_a/images/detail1.jpg" alt="Profile Banner">
                </figure>
                <div class="changeProfileBanner">
                    <img src="<?php echo base_url(); ?>assets_a/images/camera_profile.svg" alt="change Profile Banner">
                    <input type="file">
                </div>
            </div>
            <div class="profileInfoWrapper">
                <div class="infoWrapper">
                    <div class="profileLogo">
                        <figure>
                            <img
                                src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg"
                                alt="User">
                        </figure>
                        <div class="changeProfile">
                            <img src="<?php echo base_url(); ?>assets_a/images/camera-circle.svg"
                                 alt="change Profile Banner">
                            <input type="file">
                        </div>
                    </div>
                    <div class="profileDtl">
                        <div class="profileInformation">
                            <h4 class="name"><?=$school['name']; ?></h4>
                            <h6 class="username"><?=$school['website']; ?></h6>
                            <ul class="socialstatus">
                                <li> <span>25</span> Likes</li>
                                <li> <span>25</span> Followers</li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <img src="<?php echo base_url(); ?>assets_a/images/facebook.svg" alt="facebook">
                                    </a>

                                    <a href="javascript:void(0)">
                                        <img src="<?php echo base_url(); ?>assets_a/images/twitter.svg" alt="twitter">
                                    </a>

                                    <a href="javascript:void(0)">
                                        <img src="<?php echo base_url(); ?>assets_a/images/linkedin.svg" alt="linkedin">
                                    </a>

                                    <a href="javascript:void(0)">
                                        <img src="<?php echo base_url(); ?>assets_a/images/youtube.svg" alt="youtube">
                                    </a>
                                </li>
                            </ul>
                            <div class="location">
                                <img src="<?php echo base_url(); ?>assets_a/images/pin.svg" alt="location"> <?=$school['country']; ?>
                            </div>
                        </div>
                        <div class="shareMenu shareOption">
                            <ul>
                                <li><a>Like</a></li>
                                <li><a>Follow</a></li>
                                <li>
                                    <img src="<?php echo base_url(); ?>assets_a/images/messagebox.svg" alt="Message">
                                </li>
                                <li class="dropdown">
                                    <img src="<?php echo base_url(); ?>assets_a/images/more.svg" alt="More Option">
                                    <ul>
                                        <li>
                                            <a role="menuitem" href="javascript:void(0);">
                                                <img src="<?php echo base_url(); ?>assets_a/images/report1.svg" > Report
                                            </a>
                                        </li>
                                        <li>
                                            <a role="menuitem" href="javascript:void(0);">
                                                <img src="<?php echo base_url(); ?>assets_a/images/block.svg" > Block
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tabularLiist">
                    <ul class="nav nav-tabs" style="margin-top: 0">
                        <li class="active"><a data-toggle="tab" href="#terms">Courses</a></li>
                        <li class=""><a data-toggle="tab" href="#terms">About</a></li>
                        <li class=""><a data-toggle="tab" href="#terms">Professors</a></li>
                    </ul>

                </div>
            </div>
        </div>
        <div class="tab-content">
            <div id="terms" class="tab-pane fade in active">
                <div class="TabsAndSortWrapper courses">
                    <div class="sortWrapper">
                        <ul>
                            <li>
                                <div class="selectOrder">
                                    <select name="sort" id="sort">
                                        <option value="volvo">Alphabetical</option>
                                    </select>
                                </div>
                            </li>
                            <li class="grid active">
                                <img src="<?php echo base_url(); ?>assets_a/images/grid-box-blue.svg" alt="Grid">
                            </li>
                            <li class="list">
                                <img src="<?php echo base_url(); ?>assets_a/images/list-box-grey.svg" alt="List">
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tabPaneWrapper courseView">
<!--                    <div class="left">-->
                        <div class="userBoxWrapper gridview">
                            <?php if (count($course)) ;
                        $count = 0; ?>
                            <?php foreach ($course as $c) {
                            $count++ ?>

                            <div class="card">
                                <a href="<?php echo base_url(); ?>account/schools/<?= $school['university_id']; ?>/course/<?= $c['course_id']; ?>">
                                <div class="profileSection">
                                    <div class="profileViewToggleWrapper">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets_a/images/detail1.jpg">
                                        </figure>
                                        <div class="changeView">
                                            <h5><?= $c['name'] ?></h5>
                                            <div class="courseStructure">
                                                <p>10 lessons</p>
                                                <div class="statusourse progress">
<!--                                                    66% complete-->
                                                </div>
                                            </div>
                                            <div class="professorInfo">
                                                <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg" >
                                                Professor
                                            </div>
                                        </div>
                                    </div>
                                    <div class="courseStatusBox">
                                        <div class="statusCheck progress">In Progress</div>
                                    </div>
                                </div>
                                </a>
                            </div>
                            <?php }; ?>
                        </div>
<!--                    </div>-->
<!--                    <div class="right">-->
<!--                        <div class="boxwrap universityProfile">-->
<!--                            <ul>-->
<!--                                <li>-->
<!--                                    <a>-->
<!--                                        <figure>-->
<!--                                            <img src="images/like-grey.svg" class="likepost" alt="Like">-->
<!--                                        </figure>-->
<!--                                        <figcaption>-->
<!--                                            <span>25k</span> people like this-->
<!--                                        </figcaption>-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <a>-->
<!--                                        <figure>-->
<!--                                            <img src="images/follow-grey.svg" class="Followpost" alt="Like">-->
<!--                                        </figure>-->
<!--                                        <figcaption>-->
<!--                                            <span>25k</span> people follow this-->
<!--                                        </figcaption>-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                                <li class="university">-->
<!--                                    <a>-->
<!--                                        <figure>-->
<!--                                            <img src="images/profile-type.svg" class="university" alt="university">-->
<!--                                        </figure>-->
<!--                                        <figcaption>-->
<!--                                            University-->
<!--                                        </figcaption>-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                            <div class="completeNow">-->
<!--                                <button type="button" class="event_action">Like</button>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="boxwrap">-->
<!--                            <h6>Latest Updates</h6>-->
<!--                            <p>Peers</p>-->
<!--                            <div class="listBox">-->
<!--                                <div class="listWrap">-->
<!--                                    <div class="left">-->
<!--                                        <figure>-->
<!--                                            <img src="images/user.jpg" alt="user">-->
<!--                                        </figure>-->
<!--                                    </div>-->
<!--                                    <div class="right">-->
<!--                                        <h6>Jane Doe</h6>-->
<!--                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="listWrap">-->
<!--                                    <div class="left">-->
<!--                                        <figure>-->
<!--                                            <img src="images/user.jpg" alt="user">-->
<!--                                        </figure>-->
<!--                                    </div>-->
<!--                                    <div class="right">-->
<!--                                        <h6>Jane Doe</h6>-->
<!--                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="listWrap">-->
<!--                                    <div class="left">-->
<!--                                        <figure>-->
<!--                                            <img src="images/user.jpg" alt="user">-->
<!--                                        </figure>-->
<!--                                    </div>-->
<!--                                    <div class="right">-->
<!--                                        <h6>Jane Doe</h6>-->
<!--                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <p>Institutions</p>-->
<!--                            <div class="listBox last">-->
<!--                                <div class="listWrap">-->
<!--                                    <div class="left">-->
<!--                                        <figure>-->
<!--                                            <img src="images/user.jpg" alt="user">-->
<!--                                        </figure>-->
<!--                                    </div>-->
<!--                                    <div class="right">-->
<!--                                        <h6>Jane Doe</h6>-->
<!--                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="listWrap">-->
<!--                                    <div class="left">-->
<!--                                        <figure>-->
<!--                                            <img src="images/user.jpg" alt="user">-->
<!--                                        </figure>-->
<!--                                    </div>-->
<!--                                    <div class="right">-->
<!--                                        <h6>Jane Doe</h6>-->
<!--                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="listWrap">-->
<!--                                    <div class="left">-->
<!--                                        <figure>-->
<!--                                            <img src="images/user.jpg" alt="user">-->
<!--                                        </figure>-->
<!--                                    </div>-->
<!--                                    <div class="right">-->
<!--                                        <h6>Jane Doe</h6>-->
<!--                                        <p>Lorem ipsum dolor sit amet, coelitr, sed diam nonumy eirmod</p>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
                </div>
<!--                <div class="testWrapper">-->
<!--                    <table class="table table-borderless sp-table">-->
<!--                        <thead>-->
<!--                        <tr>-->
<!--                            <th>#</th>-->
<!--                            <th>Name</th>-->
<!--                            <th>Code</th>-->
<!--                            <th>Start Date</th>-->
<!--                            <th>Action</th>-->
<!--                        </tr>-->
<!--                        </thead>-->
<!--                        <tbody>-->
<!--                        --><?php //if (count($course)) ;
//                        $count = 0; ?>
<!--                        --><?php //foreach ($course as $c) {
//                            $count++ ?>
<!--                            <tr>-->
<!--                                <td data-th="Rank"><span class="bt-content">--><?//= $count ?><!--</span></td>-->
<!--                                <td data-th="Rank"><span class="bt-content">--><?//= $c['name'] ?><!--</span></td>-->
<!--                                <td data-th="Rank"><span class="bt-content">--><?//= $c['course_code'] ?><!--</span></td>-->
<!--                                <td data-th="Rank"><span class="bt-content">--><?//= $c['start_at'] ?><!--</span></td>-->
<!--                                <td data-th="Date"><span class=" bt-content ">-->
<!--                                       <a href="--><?php //echo base_url(); ?><!--account/schools/--><?//= $school['university_id']; ?><!--/course/--><?//= $c['course_id']; ?><!--">-->
<!--                                           <i class="fa fa-eye"></i> view-->
<!--                                       </a>-->
<!--                                        </span>-->
<!--                                </td>-->
<!--                            </tr>-->
<!--                        --><?php //}; ?>
<!--                        </tbody>-->
<!--                    </table>-->
<!--                </div>-->
            </div>
        </div>
    </div>
</section>
<section class="rightsidemsgbar">
    <section class="view message">
        Close <i class="fa fa-arrow-right" aria-hidden="true"></i>
    </section>
    <section class="listBar">
        <section class="listHeader">
            <h6>Peers</h6>
            <a data-toggle="modal" data-target="#peersMessageModal">See More</a>
        </section>
        <section class="listChatBox">
            <section class="list">
                <section class="left">
                    <figure>
                        <img src="<?php echo base_url(); ?>assets_d/images/user2.jpg" alt="user">
                    </figure>
                    <figcaption>Scholasticus Ipsum</figcaption>
                </section>
                <section class="action">
                    <i class="fa fa-ellipsis-v"></i>
                </section>
            </section>
            <section class="list">
                <section class="left">
                    <figure>
                        <img src="<?php echo base_url(); ?>assets_d/images/user2.jpg" alt="user">
                        <span class="messagecount">12</span>
                    </figure>
                    <figcaption>Scholasticus Ipsum</figcaption>
                </section>
                <section class="action">
                    <i class="fa fa-ellipsis-v"></i>
                </section>
            </section>
        </section>
    </section>
    <section class="listBar">
        <section class="listHeader">
            <h6>Groups</h6>
            <a><i class="fa fa-plus"></i></a>
        </section>
        <section class="listChatBox">
            <section class="list">
                <section class="left">
                    <figure>
                        <img src="<?php echo base_url(); ?>assets_d/images/user2.jpg" alt="user">
                    </figure>
                    <figcaption>The in group</figcaption>
                </section>
                <section class="action">
                    <i class="fa fa-ellipsis-v"></i>
                </section>
            </section>
            <section class="list">
                <section class="left">
                    <figure>
                        <img src="<?php echo base_url(); ?>assets_d/images/user2.jpg" alt="user">
                        <span class="messagecount">12</span>
                    </figure>
                    <figcaption>The in group</figcaption>
                </section>
                <section class="action">
                    <i class="fa fa-ellipsis-v"></i>
                </section>
            </section>
        </section>
    </section>
</section>