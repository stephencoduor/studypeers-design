<section class="mainContent profile ">
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
                            <h4 class="name"><?= $school['name']; ?></h4>
                            <h4 class="username"> Course: <?= $course['name']; ?></h4>
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
<!--                            <div class="location">-->
<!--                                <img src="--><?php //echo base_url(); ?><!--assets_a/images/pin.svg" alt="location">-->
<!--                                --><?//= $school['country']; ?>
<!--                            </div>-->
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
                        <li class="active"><a data-toggle="tab" href="#assignments">Assignments</a></li>
                        <li><a data-toggle="tab" href="#quizes">Quizzes</a></li>
                        <li><a data-toggle="tab" href="#discussions">Discussions</a></li>
                        <li><a data-toggle="tab" href="#notifications">Notifications</a></li>
                        <li><a data-toggle="tab" href="#results">Results</a></li>
                        <li><a data-toggle="tab" href="#files">Files</a></li>
                        <li><a data-toggle="tab" href="#submissions">Submissions</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-content">
            <div id="assignments" class="tab-pane fade in active">
                <div class="testWrapper">
                    <table class="table table-borderless sp-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Due Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (count($assignments)) ;
                        $count = 0; ?>
                        <?php foreach ($assignments as $assignment) {
                            $count++ ?>
                            <tr>
                                <td data-th="Rank"><span class="bt-content"><?= $count ?></span></td>
                                <td data-th="Rank"><span class="bt-content"><?= $assignment['name'] ?></span></td>
                                <td data-th="Rank"><span class="bt-content"><?= $assignment['due_at'] ?></span></td>
                                <td data-th="Date"><span class=" bt-content ">
                                       <a href="<?php echo base_url(); ?>school/assignment/<?= $assignment['id']; ?>">
<!--                                        <a target="_blank" href="--><? //= $assignment['html_url'];?><!--"-->
                                        <i class="fa fa-eye"></i> view
                                       </a>
                                        </span>
                                </td>
                            </tr>
                        <?php }; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="quizes" class="tab-pane fade in ">
                <div class="testWrapper">
                    <table class="table table-borderless sp-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Due at</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (count($quizzes)) ;
                        $count = 0; ?>
                        <?php foreach ($quizzes as $quiz) {
                            $count++ ?>
                            <tr>
                                <td data-th="Rank"><span class="bt-content"><?= $count ?></span></td>
                                <td data-th="Rank"><span class="bt-content"><?= $quiz['title'] ?></span></td>
                                <td data-th="Rank"><span class="bt-content"><?= $quiz['due_at'] ?></span></td>
                                <td data-th="Date"><span class=" bt-content ">
                                        <a href="<?php echo base_url() ?>school/quizz/<?= $quiz['id']; ?>"
                                        <i class="fa fa-eye"></i> view
                                        </a>
                                        </span>
                                </td>
                            </tr>
                        <?php }; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="discussions" class="tab-pane fade in ">
                <div class="testWrapper">
                    <table class="table table-borderless sp-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Podcast Url</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (count($discussions)) ;
                        $count = 0; ?>
                        <?php foreach ($discussions as $discussion) {
                            $count++ ?>
                            <tr>
                                <td data-th="Rank"><span class="bt-content"><?= $count ?></span></td>
                                <td data-th="Rank"><span class="bt-content"><?= $discussion['title'] ?></span></td>
                                <td data-th="Rank"><span class="bt-content"><?= $discussion['podcast_url'] ?></span>
                                </td>
                                <td data-th="Date"><span class=" bt-content ">
                                        <a href="<?php echo base_url() ?>school/discussion/<?= $discussion['id']; ?>"
                                        <i class="fa fa-eye"></i> view
                                        </a>
                                        </span>
                                </td>
                            </tr>
                        <?php }; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="notifications" class="tab-pane fade in ">
                <div class="testWrapper">
                    <table class="table table-borderless sp-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (count($notifications)) ;
                        $count = 0; ?>
                        <?php foreach ($notifications as $notification) {
                            $count++ ?>
                            <tr>
                                <td data-th="Rank"><span class="bt-content"><?= $count ?></span></td>
                                <td data-th="Rank"><span class="bt-content"><?= $notification['title'] ?></span>
                                </td>
                                <td data-th="Rank"><span
                                            class="bt-content"><?= $notification['description'] ?></span></td>
                                <td data-th="Date"><span class=" bt-content ">
                                        <a href="<?php echo base_url() ?>school/notification/<?= $notificstion['id']; ?>"
                                        <i class="fa fa-eye"></i> view
                                        </a>
                                        </span>
                                </td>
                            </tr>
                        <?php }; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="grades" class="tab-pane fade in ">
                <div class="testWrapper">
                    <table class="table table-borderless sp-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php /*if (count($quizzes)) ;
                        $count = 0; */ ?><!--
                        <?php /*foreach ($quizzes as $quiz) {
                            $count++ */ ?>
                            <tr>
                                <td data-th="Rank"><span class="bt-content"><? /*= $count */ ?></span></td>
                                <td data-th="Rank"><span class="bt-content"><? /*= $quiz['title'] */ ?></span></td>
                                <td data-th="Rank"><span class="bt-content"><? /*= $quiz['description'] */ ?></span></td>
                                <td data-th="Date"><span class=" bt-content ">
                                        <a target="_blank" href="<? /*= $quiz['preview_url'];*/ ?>"
                                        <i class="fa fa-eye"></i> view
                                        </a>
                                        </span>
                                </td>
                            </tr>
                        --><?php /*}; */ ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="results" class="tab-pane fade in ">
                <div class="testWrapper">
                    <table class="table table-borderless sp-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Score</th>
                            <th>Maximum Score</th>
                            <th>Comments</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (count($results)) ;
                        $count = 0; ?>
                        <?php foreach ($results as $result) {
                            $count++ ?>
                            <tr>
                                <td data-th="Rank"><span class="bt-content"><?= $count ?></span></td>
                                <td data-th="Rank"><span class="bt-content"><?= $result['resultScore'] ?></span>
                                </td>
                                <td data-th="Rank"><span class="bt-content"><?= $quiz['resultMaximum'] ?></span>
                                </td>
                                <td data-th="Rank"><span class="bt-content"><?= $quiz['comment'] ?></span></td>
                                <td data-th="Date"><span class=" bt-content ">
                                        <a href="<?php echo base_url() ?>school/result/<?= $result['id']; ?>"
                                        <i class="fa fa-eye"></i> view
                                        </a>
                                        </span>
                                </td>
                            </tr>
                        <?php }; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="files" class="tab-pane fade in ">
                <div class="testWrapper">
                    <table class="table table-borderless sp-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>File size</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (count($files)) ;
                        $count = 0; ?>
                        <?php foreach ($files as $file) {
                            $count++ ?>
                            <tr>
                                <td data-th="Rank"><span class="bt-content"><?= $count ?></span></td>
                                <td data-th="Rank"><span class="bt-content"><?= $file['display_name'] ?></span></td>
                                <td data-th="Rank"><span class="bt-content"><?= $file['content_type'] ?></span></td>
                                <td data-th="Rank"><span class="bt-content"><?= $file['size'] ?></span></td>
                                <td data-th="Date"><span class=" bt-content ">
                                        <a href="<?= $file['url']; ?>" target="_blank"
                                        <i class="fa fa-eye"></i> view
                                        </a>
                                        </span>
                                </td>
                            </tr>
                        <?php }; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="submissions" class="tab-pane fade in ">
                <div class="testWrapper">
                    <table class="table table-borderless sp-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Attempt</th>
                            <th>Score</th>
                            <th>Comment</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (count($submissions)) ;
                        $count = 0; ?>
                        <?php foreach ($submissions as $submission) {
                            $count++ ?>
                            <tr>
                                <td data-th="Rank"><span class="bt-content"><?= $count ?></span></td>
                                <td data-th="Rank"><span class="bt-content"><? $sumission['attempt'] ?></span></td>
                                <td data-th="Rank"><span class="bt-content"><? $sumission['score'] ?></span></td>
                                <td data-th="Rank"><span class="bt-content"><? $sumission['comment'] ?></span></td>
                                <td data-th="Date"><span class=" bt-content ">
                                        <a href="<?php echo base_url(); ?>school/submission/<?= $submission['id']; ?>"
                                        <i class="fa fa-eye"></i> view
                                        </a>
                                        </span>
                                </td>
                            </tr>
                        <?php }; ?>
                        </tbody>
                    </table>
                </div>
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