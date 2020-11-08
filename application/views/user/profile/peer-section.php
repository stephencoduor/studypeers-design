<div id="peers" class="tab-pane fade in <?php if(isset($_GET['tab']) && ($_GET['tab'] == 'peers')) { echo "active"; } ?>"">
    <div class="innerFeedTabs">
        <div class="tabularLiist">
            <div class="TabsAndSortWrapper">
                <ul class="nav nav-tabs">
                    <li class="active selection_type" data-id="1"><a data-toggle="tab" href="#myconnections">My Connections (<?php echo $connections; ?>)</a></li>
                    <li class="selection_type" data-id="0"><a data-toggle="tab" href="#requests">Requests (<?php echo $requests; ?>)</a></li>
                </ul>
                <div class="search">
                    <div class="searchIcon">
                        <img src="<?php echo base_url()."/assets_d/images/search.png" ?>" alt="search">
                    </div>
                    <input type="text" name="search_friend" id="search_friend">
                </div>
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
                            <img src="<?php echo base_url()."/assets_d/images/grid-box-blue.svg" ?>" alt="Grid">
                        </li>
                        <li class="list">
                            <img src="<?php echo base_url()."/assets_d/images/list-box-grey.svg" ?>" alt="List">
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <div id="myconnections" class="tab-pane fade in active">
                    <div class="tabPaneWrapper">
                        <div class="left">
                            <div class="userBoxWrapper gridview" id="friend_container">
                                <?php if(isset($all_connections)){ foreach($all_connections as $peer){ ?>
                                <div class="card" id="remove_friend_<?php echo $peer['peer_master_id']; ?>">
                                    <div class="profileSection">
                                        <div class="profileViewToggleWrapper">
                                            <figure>
                                                <img src="<?php echo userImage($peer['id']); ?>">
                                            </figure>
                                            <div class="changeView">
                                                <h5><?php echo $peer['first_name'].' '.$peer['last_name']; ?></h5>
                                                <p>location name</p>
                                                <div class="followers">
                                                    <span>25 </span> Followers
                                                </div>
                                            </div>
                                        </div>
                                        <div class="followOptionsWrapper">
                                            <ul>
                                                <li>
                                                    <?php $follow_status = checkFollowStatus($this->session->get_userdata()['user_data']['user_id'] , $peer['id']);
                                                        if($follow_status){
                                                            ?>
                                                            <a href="javascript:void(0)" class="follow_now follow_<?php echo $peer['id']; ?>" data-id="<?php echo $peer['id']; ?>" id="0">UnFollow</a>
                                                            <?php
                                                        }else{
                                                            ?>
                                                            <a href="javascript:void(0)" class="follow_now follow_<?php echo $peer['id']; ?>" data-id="<?php echo $peer['id']; ?>" id="1">Follow</a>
                                                            <?php
                                                        }
                                                    ?>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)" class="unfriend_peer" data-toggle="modal" data-target="#unfriend_peer" id="<?php echo $peer['peer_master_id']; ?>">Unfriend</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <?php  } }?>
                            </div>
                        </div>
                        <?php include 'right-side-content.php' ?>
                    </div>
                </div>
                <div id="requests" class="tab-pane fade in">
                    <div class="tabPaneWrapper">
                        <div class="left">
                            <div class="userBoxWrapper gridview" id="request_container">
                                <?php if(isset($all_requests)){ foreach($all_requests as $peer){ ?>
                                    <div class="card" id="action_<?php echo $peer['action_id']; ?>">
                                        <div class="profileSection">
                                            <div class="profileViewToggleWrapper">
                                                <figure>
                                                    <img src="<?php echo userImage($peer['id']); ?>">
                                                </figure>
                                                <div class="changeView">
                                                    <h5><?php echo $peer['first_name'].' '.$peer['last_name']; ?></h5>
                                                    <p>location name</p>
                                                    <div class="followers">
                                                        <span>25 </span> Followers
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="followOptionsWrapper">
                                                <ul>
                                                    <li class="follower">
                                                        <a href="javascript:void(0)">
                                                            Accept
                                                        </a>
                                                    </li>
                                                    <li class="follower">
                                                        <a href="javascript:void(0)">Reject</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <?php } } ?>
                            </div>
                        </div>
                        <?php include 'right-side-content.php' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<div class="modal fade" id="unfriend_peer" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <h4>Confirmation</h4>
                <div class="profileSection">
                <h4>Are you sure to remove this peer !</h4>

                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="<?php echo base_url(); ?>profile/unfriend">
                                <div class="form-group button">
                                    <input type="hidden" name="peer_master_id" id="peer_master_id">
                                    <button data-dismiss="modal" class="transparentBtn highlight cancelRemoveBtn">No</button>
                                    <button type="submit" class="removeBtn">Yes</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
