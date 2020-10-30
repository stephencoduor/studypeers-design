<div id="peers" class="tab-pane fade in">
    <div class="innerFeedTabs">
        <div class="tabularLiist">
            <div class="TabsAndSortWrapper">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#myconnections">My Connections</a></li>
                    <li><a data-toggle="tab" href="#requests">Requests</a></li>
                </ul>
                <div class="search">
                    <div class="searchIcon">
                        <img src="images/search.png" alt="search">
                    </div>
                    <input type="text" name="">
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
                            <img src="images/grid-box-blue.svg" alt="Grid">
                        </li>
                        <li class="list">
                            <img src="images/list-box-grey.svg" alt="List">
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <div id="myconnections" class="tab-pane fade in active">
                    <div class="tabPaneWrapper">
                        <div class="left">
                            <div class="userBoxWrapper gridview">
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
                                                    <a href="javascript:void(0)">Following</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Peer</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <?php } } }?>
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
                <div id="requests" class="tab-pane fade in">
                    <div class="tabPaneWrapper">
                        <div class="left">
                            <div class="userBoxWrapper gridview">
                                <?php if(isset($peers)){ foreach($peers as $peer){ if($peer['status'] == 1){?>
                                    <div class="card">
                                        <div class="messagePeerBox" data-dismiss="modal" data-toggle="modal" href="#userConnections">
                                            <img src="<?php echo base_url(); ?>assets_d/<?php echo base_url(); ?>assets_d//messagebox.svg" alt="Message">
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
                                                        <a href="javascript:void(0)">Follow</a>
                                                    </li>
                                                    <li class="follower">
                                                        <a href="javascript:void(0)">Accept</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <?php } } }?>
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
                                                <img src="<?php echo base_url(); ?>assets_d//user.jpg" alt="user">
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
                                                <img src="<?php echo base_url(); ?>assets_d//user.jpg" alt="user">
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
                                                <img src="<?php echo base_url(); ?>assets_d//user.jpg" alt="user">
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
                                                <img src="<?php echo base_url(); ?>assets_d//user.jpg" alt="user">
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
                                                <img src="<?php echo base_url(); ?>assets_d//user.jpg" alt="user">
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
                                                <img src="<?php echo base_url(); ?>assets_d//user.jpg" alt="user">
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
            </div>
        </div>
    </div>
</div>