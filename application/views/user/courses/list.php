<section class="mainContent msgActive">
    <div class="alert alert-default">
        <?php
        if ($this->session->flashdata('flash_message')) {
            echo $this->session->flashdata('flash_message');
        }
        ?>
    </div>
    <div class="studySetWrapper list">
        <div class="header">
            <h4>List of courses</h4>
            <a href="/courses/sync" id="sync">
                Sync Courses
            </a>
        </div>
        <div class="filterWrapper">
            <div class="filterSearch">
                <input type="text" placeholder="Search Questions..." name="">
                <button type="submit" class="searchBtn">

                </button>
            </div>

        </div>

        <?php if (count($course)) : ?>
            <?php foreach ($course as $c) : ?>
                <div class="feedWrapper">
                    <div class="feedVoteWrap">
                        <div class="feed-card list">
                            <div class="right">
                                <div class="feed_card_inner">
                                    <!-- <div class="header listHeader">
                                        <p>Q&A</p>
                                        <div class="my-rating-4" data-rating="1.5">
                                            <span>1200</span>
                                        </div>
                                    </div> -->
                                    <h5 data-assignment-id="--><?= $c['id']; ?> class="inline"><a href="<?php echo base_url()?>account/courses/<?= $c['id']; ?>"><?= $c['name']; ?></a></h5>
                                    <div class="badgeList">
                                        <ul>
                                            <li class="badge badge1">
                                                <?= $c['course_code'];?>
                                            </li>
                                            <!--<li class="badge badge2">
                                                Urban Law and Policy
                                            </li>
                                            <li class="badge badge3">
                                                Professorum Ipsum
                                            </li>-->
                                        </ul>
                                    </div>
                                </div>
                                <div class="feed_card_footer">
                                    <div class="userWrap study-sets">
                                        <div class="edit">
                                            <a href="create-study-set.html">
                                                <i class="fa fa-edit"></i>
                                                Edit
                                            </a>
                                        </div>
                                        <div class="delete">
                                            <a data-toggle="modal" data-target="#confirmationModal">
                                                <i class="fa fa-recycle"></i>
                                                Delete
                                            </a>
                                        </div>
                                    </div>
                                    <div class="action">
                                        <div class="action_button">
                                            <a href="qa-detail.html">
                                        </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--                <tr>-->
                <!--                    <th scope="row" data-assignment-id="--><? //=$c['id']?><!--">--><? //= $c['name'];?><!--</th>-->
                <!--                    <td>--><? //= $c['course_code'];?><!--</td>-->
                <!---->
                <!--                    <td>--><? //= $c['start_at'];?><!--</td>-->
                <!--                    <td>--><? //= $c['end_at'];?><!--</td>-->
                <!--                </tr>-->
            <?php endforeach; ?>
        <?php else : ?>
        <!--            <tr>-->
        <!--                <td col-span="4">No Assignments found</td>-->
        <!--            </tr>-->
<?php endif; ?>