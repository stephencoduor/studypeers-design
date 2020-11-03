<div id="peers" class="tab-pane fade in">
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
                            <div class="userBoxWrapper gridview friend_container">
                                <?php if(isset($peers)){ foreach($peers as $peer){ if($peer['status'] == 2){?>
                                <div class="card">
                                    <div class="messagePeerBox" data-dismiss="modal" data-toggle="modal" href="#userConnections">
                                        <img src="<?php echo base_url(); ?>assets_d/images/messagebox.svg" alt="Message">
                                    </div>
                                    <div class="profileSection">
                                        <div class="profileViewToggleWrapper">
                                            <figure>
                                                <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
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
                                                <li data-dismiss="modal" data-toggle="modal" href="#blockUser">
                                                    <a href="javascript:void(0)">Follow</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Unfriend</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <?php } } }?>
                            </div>
                        </div>
                        <?php include 'right-side-content.php' ?>
                    </div>
                </div>
                <div id="requests" class="tab-pane fade in">
                    <div class="tabPaneWrapper">
                        <div class="left">
                            <div class="userBoxWrapper gridview request_container">
                                <?php if(isset($peers)){ foreach($peers as $peer){ if($peer['status'] == 1){?>
                                    <div class="card">
                                        <div class="messagePeerBox" data-dismiss="modal" data-toggle="modal" href="#userConnections">
                                            <img src="<?php echo base_url(); ?>assets_d/images/messagebox.svg" alt="Message">
                                        </div>
                                        <div class="profileSection">
                                            <div class="profileViewToggleWrapper">
                                                <figure>
                                                    <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
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
                                                        <a href="javascript:void(0)">Accept</a>
                                                    </li>
                                                    <li class="follower">
                                                        <a href="javascript:void(0)">Reject</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <?php } } }?>
                            </div>
                        </div>
                        <?php include 'right-side-content.php' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>