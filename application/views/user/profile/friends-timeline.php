<?php
$full_name      = $user['first_name'].' '.$user['last_name'];
?>
    <input type="hidden" id="base" value="<?php echo base_url(); ?>">

                <section class="mainContent profile">
                    <div class="mainProfileWrapper">
                        <div class="profileHeaderWrapper">
                            <div class="profileBanner">
                                <figure>
                                    <?php if(empty($user['cover_image'])) {
                                        ?>
                                        <img id="currentCoverPicture" src="<?php echo base_url(); ?>assets_d/images/detail1.jpg" alt="Profile Banner">
                                    <?php } else {
                                        ?>
                                        <img id="currentCoverPicture" src="<?php echo base_url()."uploads/users/cover/".$user['cover_image']; ?>" alt="Profile Banner">
                                        <?php
                                    }?>
                                </figure>
                               <!-- <div class="changeProfileBanner">
                                    <img id="currentCoverPicture" src="<?php /*echo base_url(); */?>assets_d/images/camera_profile.svg" alt="change Profile Banner">
                                    <input type="file" name="upload_cover_image" id="upload_cover_image">
                                </div>-->
                            </div>
                            <div class="profileInfoWrapper">
                                <div class="infoWrapper">
                                    <div class="profileLogo">
                                        <figure>
                                            <?php if(empty($user['image'])) {
                                                if(strcasecmp($user['gender'] , 'male') == 0){
                                                ?>
                                                    <img id="currentProfilePicture" src="<?php echo base_url(); ?>uploads/user-male.png" alt="User">
                                                <?php } else {
                                                    ?>
                                                    <img id="currentProfilePicture" src="<?php echo base_url(); ?>uploads/user-female.png" alt="User">
                                                <?php
                                                }
                                            }
                                            else{
                                            ?>
                                                <img id="currentProfilePicture" src="<?php echo base_url(); ?>uploads/users/<?php echo $user['image']; ?>" alt="change profile banner" />
                                            <?php
                                            }
                                            ?>

                                        </figure>

                                    </div>
                                    <div class="profileDtl">
                                        <div class="profileInformation">
                                            <h4 class="name"><?php echo $full_name; ?></h4>
                                            <h6 class="username"><?php echo $user['username'];?>  <span>Joined on <?php echo date("F jS, Y", strtotime($user['added_on'])); ?></span></h6>
                                            <ul class="socialstatus">
                                                <li> <span>25</span> Followers</li>
                                                <li> <span>25</span> Following</li>
                                                <li>
                                                    <a href="javascript:void(0)">
                                                        <img src="<?php echo base_url(); ?>assets_d/images/facebook.svg" alt="facebook">
                                                    </a>

                                                    <a href="javascript:void(0)">
                                                        <img src="<?php echo base_url(); ?>assets_d/images/twitter.svg" alt="twitter">
                                                    </a>

                                                    <a href="javascript:void(0)">
                                                        <img src="<?php echo base_url(); ?>assets_d/images/linkedin.svg" alt="linkedin">
                                                    </a>

                                                    <a href="javascript:void(0)">
                                                        <img src="<?php echo base_url(); ?>assets_d/images/youtube.svg" alt="youtube">
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="location">
                                                <img src="<?php echo base_url(); ?>assets_d/images/pin.svg" alt="location"> location name
                                            </div>
                                        </div>
                                        <div class="shareProfile" id="copyShareLink" >
                                            <input type="hidden" id="sharelink" value="<?php echo base_url().'Profile/shareLink/'.$user['username']; ?>" />
                                            <img src="<?php echo base_url(); ?>assets_d/images/share-profile1.svg" alt="share profile"> Share Profile
                                        </div>
                                        <div class="shareMenu shareOption">
                                        <ul>
                                            <?php if($is_request_sent == 1){
                                                ?>
                                                <li><a href="javascript:void(0);" onclick="cancelRequest(<?= $user_id ?>)" id="add_peer">Cancel Request</a></li>

                                            <?php }else{?>
                                                <li><a href="javascript:void(0);" onclick="sendRequest(<?= $user_id ?>)" id="add_peer">Add Peer</a></li>

                                                <?php
                                            }?>
                                            <li><a>Follow</a></li>
                                            <li>
                                                <img src="<?php echo base_url(); ?>assets_d/images/messagebox.svg" alt="Message">
                                            </li>
                                            <li class="dropdown">
                                                <img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="More Option">
                                                <ul>
                                                    <li>
                                                        <a role="menuitem" href="javascript:void(0);">
                                                            <img src="<?php echo base_url(); ?>assets_d/images/report1.svg" > Report
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a role="menuitem" href="javascript:void(0);">
                                                            <img src="<?php echo base_url(); ?>assets_d/images/block.svg" > Block
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    </div>
                                </div>
                                <div class="tabularLiist">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a data-toggle="tab" href="#feed">Feeds</a></li>
                                        <li><a data-toggle="tab" href="#profile">Profile</a></li>
                                        <li><a data-toggle="tab" href="#peers">Peers <div>(10)</div></a></li>
                                        <li><a data-toggle="tab" href="#institution">Institutions</a></li>
                                        <li><a data-toggle="tab" href="#courses">Courses</a></li>
                                        <li><a data-toggle="tab" href="#professor">Professor</a></li>
                                        <li><a data-toggle="tab" href="#market">Market</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div id="feed" class="tab-pane fade in active">
                                <div class="innerFeedTabs">
                                    <div class="tabularLiist">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a data-toggle="tab" href="#all">All</a></li>
                                            <li><a data-toggle="tab" href="#posts">Posts</a></li>
                                            <li><a data-toggle="tab" href="#questions">Questions</a></li>
                                            <li><a data-toggle="tab" href="#documents">Documents</a></li>
                                            <li><a data-toggle="tab" href="#articles">Articles</a></li>
                                            <li><a data-toggle="tab" href="#studySets">Study Sets</a></li>
                                            <li><a data-toggle="tab" href="#events">Events</a></li>
                                            <li><a data-toggle="tab" href="#studySessions">Study Sessions</a></li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                            <div id="profile" class="tab-pane fade in">
                                <div class="tabPaneWrapper">
                                    <div class="left">
                                        <div class="box-card">
                                            <div class="createBox">
                                                <div class="postWrapper">
                                                    <h5>General Information</h5>
                                                    <div class="editWrapper" data-dismiss="modal" data-toggle="modal" href="#deleteUser">
                                                        <img src="images/edit.svg" alt="edit"> Edit Profile
                                                    </div>
                                                </div>
                                                <div class="infoWrapper">
                                                    <div class="list">
                                                        <div class="heading">First Name</div>
                                                        <div class="value">Loreum</div>
                                                    </div>
                                                    <div class="list">
                                                        <div class="heading">Last Name</div>
                                                        <div class="value">Ipsum</div>
                                                    </div>
                                                    <div class="list">
                                                        <div class="heading">Gender</div>
                                                        <div class="value">Female</div>
                                                    </div>
                                                    <div class="list">
                                                        <div class="heading">Date of Birth</div>
                                                        <div class="value">October 20, 1999</div>
                                                    </div>
                                                    <div class="list">
                                                        <div class="heading">Country</div>
                                                        <div class="value">India</div>
                                                    </div>
                                                    <div class="list">
                                                        <div class="heading">Field of interest</div>
                                                        <div class="value">lorem ipsum, lorem ipsum</div>
                                                    </div>
                                                </div>
                                                <div class="useraboutWrapper">
                                                    <h5>About Me</h5>
                                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy
                                                        eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam
                                                        voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita
                                                        kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
                                                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy</p>
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
                                                                <img src="images/facebook.svg" alt="facebook">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)">
                                                                <img src="images/twitter.svg" alt="twitter">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)">
                                                                <img src="images/linkedin.svg" alt="linkedin">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)">
                                                                <img src="images/youtube.svg" alt="youtube">
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
                                                                            <h5>Full Name</h5>
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
                                                                            <h5>Full Name</h5>
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
                                                                            <h5>Full Name</h5>
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
                                                                            <h5>Full Name</h5>
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
                                                                            <h5>Full Name</h5>
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
                                                                            <h5>Full Name</h5>
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
                                                                            <h5>Full Name</h5>
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
                                                            <div class="card">
                                                                <div class="messagePeerBox" data-dismiss="modal" data-toggle="modal" href="#userConnections">
                                                                    <img src="<?php echo base_url(); ?>assets_d//messagebox.svg" alt="Message">
                                                                </div>
                                                                <div class="profileSection">
                                                                    <div class="profileViewToggleWrapper">
                                                                        <figure>
                                                                            <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                                                                        </figure>
                                                                        <div class="changeView">
                                                                            <h5>Full Name</h5>
                                                                            <p>location name</p>
                                                                            <div class="followers">
                                                                                <span>25 </span> Followers
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="followOptionsWrapper">
                                                                        <ul>
                                                                            <li>
                                                                                <a href="javascript:void(0)">Following</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="javascript:void(0)">Peer</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="messagePeerBox" data-dismiss="modal" data-toggle="modal" href="#userConnections">
                                                                    <img src="<?php echo base_url(); ?>assets_d//messagebox.svg" alt="Message">
                                                                </div>
                                                                <div class="profileSection">
                                                                    <div class="profileViewToggleWrapper">
                                                                        <figure>
                                                                            <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                                                                        </figure>
                                                                        <div class="changeView">
                                                                            <h5>Full Name</h5>
                                                                            <p>location name</p>
                                                                            <div class="followers">
                                                                                <span>25 </span> Followers
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="followOptionsWrapper">
                                                                        <ul>
                                                                            <li>
                                                                                <a href="javascript:void(0)">Following</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="javascript:void(0)">Peer</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="messagePeerBox" data-dismiss="modal" data-toggle="modal" href="#userConnections">
                                                                    <img src="<?php echo base_url(); ?>assets_d//messagebox.svg" alt="Message">
                                                                </div>
                                                                <div class="profileSection">
                                                                    <div class="profileViewToggleWrapper">
                                                                        <figure>
                                                                            <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                                                                        </figure>
                                                                        <div class="changeView">
                                                                            <h5>Full Name</h5>
                                                                            <p>location name</p>
                                                                            <div class="followers">
                                                                                <span>25 </span> Followers
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="followOptionsWrapper">
                                                                        <ul>
                                                                            <li>
                                                                                <a href="javascript:void(0)">Following</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="javascript:void(0)">Peer</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="messagePeerBox" data-dismiss="modal" data-toggle="modal" href="#userConnections">
                                                                    <img src="<?php echo base_url(); ?>assets_d//messagebox.svg" alt="Message">
                                                                </div>
                                                                <div class="profileSection">
                                                                    <div class="profileViewToggleWrapper">
                                                                        <figure>
                                                                            <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                                                                        </figure>
                                                                        <div class="changeView">
                                                                            <h5>Full Name</h5>
                                                                            <p>location name</p>
                                                                            <div class="followers">
                                                                                <span>25 </span> Followers
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="followOptionsWrapper">
                                                                        <ul>
                                                                            <li>
                                                                                <a href="javascript:void(0)">Following</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="javascript:void(0)">Peer</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="messagePeerBox" data-dismiss="modal" data-toggle="modal" href="#userConnections">
                                                                    <img src="<?php echo base_url(); ?>assets_d//messagebox.svg" alt="Message">
                                                                </div>
                                                                <div class="profileSection">
                                                                    <div class="profileViewToggleWrapper">
                                                                        <figure>
                                                                            <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                                                                        </figure>
                                                                        <div class="changeView">
                                                                            <h5>Full Name</h5>
                                                                            <p>location name</p>
                                                                            <div class="followers">
                                                                                <span>25 </span> Followers
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="followOptionsWrapper">
                                                                        <ul>
                                                                            <li>
                                                                                <a href="javascript:void(0)">Following</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="javascript:void(0)">Peer</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
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
                            <div id="institution" class="tab-pane fade in">
                                <div class="TabsAndSortWrapper institute">
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
                                                <img src="<?php echo base_url(); ?>assets_d//grid-box-blue.svg" alt="Grid">
                                            </li>
                                            <li class="list">
                                                <img src="<?php echo base_url(); ?>assets_d//list-box-grey.svg" alt="List">
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tabPaneWrapper">
                                    <div class="left">
                                        <div class="userBoxWrapper gridview">
                                            <div class="card">
                                                <div class="messagePeerBox">
                                                    <img src="<?php echo base_url(); ?>assets_d//messagebox.svg" alt="Message">
                                                </div>
                                                <div class="profileSection">
                                                    <div class="profileViewToggleWrapper">
                                                        <figure>
                                                            <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                                                        </figure>
                                                        <div class="changeView">
                                                            <h5>Institution Name</h5>
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
                                                            <li>
                                                                <a href="javascript:void(0)">Attendening</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="messagePeerBox">
                                                    <img src="<?php echo base_url(); ?>assets_d//messagebox.svg" alt="Message">
                                                </div>
                                                <div class="profileSection">
                                                    <div class="profileViewToggleWrapper">
                                                        <figure>
                                                            <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                                                        </figure>
                                                        <div class="changeView">
                                                            <h5>Institution Name</h5>
                                                            <p>location name</p>
                                                            <div class="followers">
                                                                <span>25 </span> Followers
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="followOptionsWrapper">
                                                        <ul>
                                                            <li>
                                                                <a href="javascript:void(0)">Following</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0)">Attendening</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="messagePeerBox">
                                                    <img src="<?php echo base_url(); ?>assets_d//messagebox.svg" alt="Message">
                                                </div>
                                                <div class="profileSection">
                                                    <div class="profileViewToggleWrapper">
                                                        <figure>
                                                            <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                                                        </figure>
                                                        <div class="changeView">
                                                            <h5>Institution Name</h5>
                                                            <p>location name</p>
                                                            <div class="followers">
                                                                <span>25 </span> Followers
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="followOptionsWrapper">
                                                        <ul>
                                                            <li>
                                                                <a href="javascript:void(0)">Following</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0)">Attendening</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="messagePeerBox">
                                                    <img src="<?php echo base_url(); ?>assets_d//messagebox.svg" alt="Message">
                                                </div>
                                                <div class="profileSection">
                                                    <div class="profileViewToggleWrapper">
                                                        <figure>
                                                            <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                                                        </figure>
                                                        <div class="changeView">
                                                            <h5>Institution Name</h5>
                                                            <p>location name</p>
                                                            <div class="followers">
                                                                <span>25 </span> Followers
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="followOptionsWrapper">
                                                        <ul>
                                                            <li>
                                                                <a href="javascript:void(0)">Following</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0)">Attendening</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="messagePeerBox">
                                                    <img src="<?php echo base_url(); ?>assets_d//messagebox.svg" alt="Message">
                                                </div>
                                                <div class="profileSection">
                                                    <div class="profileViewToggleWrapper">
                                                        <figure>
                                                            <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                                                        </figure>
                                                        <div class="changeView">
                                                            <h5>Institution Name</h5>
                                                            <p>location name</p>
                                                            <div class="followers">
                                                                <span>25 </span> Followers
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="followOptionsWrapper">
                                                        <ul>
                                                            <li>
                                                                <a href="javascript:void(0)">Following</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0)">Attendening</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="messagePeerBox">
                                                    <img src="<?php echo base_url(); ?>assets_d//messagebox.svg" alt="Message">
                                                </div>
                                                <div class="profileSection">
                                                    <div class="profileViewToggleWrapper">
                                                        <figure>
                                                            <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                                                        </figure>
                                                        <div class="changeView">
                                                            <h5>Institution Name</h5>
                                                            <p>location name</p>
                                                            <div class="followers">
                                                                <span>25 </span> Followers
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="followOptionsWrapper">
                                                        <ul>
                                                            <li>
                                                                <a href="javascript:void(0)">Following</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0)">Attendening</a>
                                                            </li>
                                                        </ul>
                                                    </div>
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
                            <div id="courses" class="tab-pane fade in">
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
                                                <img src="<?php echo base_url(); ?>assets_d//grid-box-blue.svg" alt="Grid">
                                            </li>
                                            <li class="list">
                                                <img src="<?php echo base_url(); ?>assets_d//list-box-grey.svg" alt="List">
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tabPaneWrapper courseView">
                                    <div class="left">
                                        <div class="userBoxWrapper gridview">
                                            <div class="card">
                                                <div class="profileSection">
                                                    <div class="profileViewToggleWrapper">
                                                        <figure>
                                                            <img src="<?php echo base_url(); ?>assets_d//detail1.jpg">
                                                        </figure>
                                                        <div class="changeView">
                                                            <h5>Course Name</h5>
                                                            <div class="courseStructure">
                                                                <p>10 lessons</p>
                                                                <div class="statusourse progress">
                                                                    66% complete
                                                                </div>
                                                            </div>
                                                            <div class="professorInfo">
                                                                <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg" >
                                                                Professor name
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="courseStatusBox">
                                                        <div class="statusCheck progress">In Progress</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="profileSection">
                                                    <div class="profileViewToggleWrapper">
                                                        <figure>
                                                            <img src="<?php echo base_url(); ?>assets_d//detail1.jpg">
                                                        </figure>
                                                        <div class="changeView">
                                                            <h5>Course Name</h5>
                                                            <div class="courseStructure">
                                                                <p>10 lessons</p>
                                                                <div class="statusourse complete">
                                                                    100% complete
                                                                </div>
                                                            </div>
                                                            <div class="professorInfo">
                                                                <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg" >
                                                                Professor name
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="courseStatusBox">
                                                        <div class="statusCheck complete">In Progress</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="profileSection">
                                                    <div class="profileViewToggleWrapper">
                                                        <figure>
                                                            <img src="<?php echo base_url(); ?>assets_d//detail1.jpg">
                                                        </figure>
                                                        <div class="changeView">
                                                            <h5>Course Name</h5>
                                                            <div class="courseStructure">
                                                                <p>10 lessons</p>
                                                                <div class="statusourse enrolled">
                                                                    0% complete
                                                                </div>
                                                            </div>
                                                            <div class="professorInfo">
                                                                <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg" >
                                                                Professor name
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="courseStatusBox">
                                                        <div class="statusCheck enrolled">Enrolled</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="profileSection">
                                                    <div class="profileViewToggleWrapper">
                                                        <figure>
                                                            <img src="<?php echo base_url(); ?>assets_d//detail1.jpg">
                                                        </figure>
                                                        <div class="changeView">
                                                            <h5>Course Name</h5>
                                                            <div class="courseStructure">
                                                                <p>10 lessons</p>
                                                                <div class="statusourse complete">
                                                                    100% complete
                                                                </div>
                                                            </div>
                                                            <div class="professorInfo">
                                                                <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg" >
                                                                Professor name
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="courseStatusBox">
                                                        <div class="statusCheck complete">In Progress</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="profileSection">
                                                    <div class="profileViewToggleWrapper">
                                                        <figure>
                                                            <img src="<?php echo base_url(); ?>assets_d//detail1.jpg">
                                                        </figure>
                                                        <div class="changeView">
                                                            <h5>Course Name</h5>
                                                            <div class="courseStructure">
                                                                <p>10 lessons</p>
                                                                <div class="statusourse complete">
                                                                    100% complete
                                                                </div>
                                                            </div>
                                                            <div class="professorInfo">
                                                                <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg" >
                                                                Professor name
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="courseStatusBox">
                                                        <div class="statusCheck complete">In Progress</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="profileSection">
                                                    <div class="profileViewToggleWrapper">
                                                        <figure>
                                                            <img src="<?php echo base_url(); ?>assets_d//detail1.jpg">
                                                        </figure>
                                                        <div class="changeView">
                                                            <h5>Course Name</h5>
                                                            <div class="courseStructure">
                                                                <p>10 lessons</p>
                                                                <div class="statusourse complete">
                                                                    100% complete
                                                                </div>
                                                            </div>
                                                            <div class="professorInfo">
                                                                <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg" >
                                                                Professor name
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="courseStatusBox">
                                                        <div class="statusCheck complete">In Progress</div>
                                                    </div>
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
                            <div id="professor" class="tab-pane fade in">
                                <div class="TabsAndSortWrapper institute">
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
                                                <img src="<?php echo base_url(); ?>assets_d//grid-box-blue.svg" alt="Grid">
                                            </li>
                                            <li class="list">
                                                <img src="<?php echo base_url(); ?>assets_d//list-box-grey.svg" alt="List">
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tabPaneWrapper">
                                    <div class="left">
                                        <div class="userBoxWrapper gridview">
                                            <div class="card">
                                                <div class="messagePeerBox">
                                                    <img src="<?php echo base_url(); ?>assets_d//messagebox.svg" alt="Message">
                                                </div>
                                                <div class="profileSection">
                                                    <div class="profileViewToggleWrapper">
                                                        <figure>
                                                            <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                                                        </figure>
                                                        <div class="changeView">
                                                            <h5>Institution Name</h5>
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
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="messagePeerBox">
                                                    <img src="<?php echo base_url(); ?>assets_d//messagebox.svg" alt="Message">
                                                </div>
                                                <div class="profileSection">
                                                    <div class="profileViewToggleWrapper">
                                                        <figure>
                                                            <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                                                        </figure>
                                                        <div class="changeView">
                                                            <h5>Institution Name</h5>
                                                            <p>location name</p>
                                                            <div class="followers">
                                                                <span>25 </span> Followers
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="followOptionsWrapper">
                                                        <ul>
                                                            <li>
                                                                <a href="javascript:void(0)">Following</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="messagePeerBox">
                                                    <img src="<?php echo base_url(); ?>assets_d//messagebox.svg" alt="Message">
                                                </div>
                                                <div class="profileSection">
                                                    <div class="profileViewToggleWrapper">
                                                        <figure>
                                                            <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                                                        </figure>
                                                        <div class="changeView">
                                                            <h5>Institution Name</h5>
                                                            <p>location name</p>
                                                            <div class="followers">
                                                                <span>25 </span> Followers
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="followOptionsWrapper">
                                                        <ul>
                                                            <li>
                                                                <a href="javascript:void(0)">Following</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="messagePeerBox">
                                                    <img src="<?php echo base_url(); ?>assets_d//messagebox.svg" alt="Message">
                                                </div>
                                                <div class="profileSection">
                                                    <div class="profileViewToggleWrapper">
                                                        <figure>
                                                            <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                                                        </figure>
                                                        <div class="changeView">
                                                            <h5>Institution Name</h5>
                                                            <p>location name</p>
                                                            <div class="followers">
                                                                <span>25 </span> Followers
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="followOptionsWrapper">
                                                        <ul>
                                                            <li>
                                                                <a href="javascript:void(0)">Follow</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="messagePeerBox">
                                                    <img src="<?php echo base_url(); ?>assets_d//messagebox.svg" alt="Message">
                                                </div>
                                                <div class="profileSection">
                                                    <div class="profileViewToggleWrapper">
                                                        <figure>
                                                            <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                                                        </figure>
                                                        <div class="changeView">
                                                            <h5>Institution Name</h5>
                                                            <p>location name</p>
                                                            <div class="followers">
                                                                <span>25 </span> Followers
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="followOptionsWrapper">
                                                        <ul>
                                                            <li>
                                                                <a href="javascript:void(0)">Following</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="messagePeerBox">
                                                    <img src="<?php echo base_url(); ?>assets_d//messagebox.svg" alt="Message">
                                                </div>
                                                <div class="profileSection">
                                                    <div class="profileViewToggleWrapper">
                                                        <figure>
                                                            <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                                                        </figure>
                                                        <div class="changeView">
                                                            <h5>Institution Name</h5>
                                                            <p>location name</p>
                                                            <div class="followers">
                                                                <span>25 </span> Followers
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="followOptionsWrapper">
                                                        <ul>
                                                            <li>
                                                                <a href="javascript:void(0)">Following</a>
                                                            </li>
                                                        </ul>
                                                    </div>
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
                            <div id="market" class="tab-pane fade in">
                                <div class="innerFeedTabs">
                                    <div class="tabularLiist">
                                        <div class="TabsAndSortWrapper">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a data-toggle="tab" href="#buying">Buying</a></li>
                                                <li><a data-toggle="tab" href="#selling">Selling</a></li>
                                            </ul>
                                            <div class="search">
                                                <div class="searchIcon">
                                                    <img src="<?php echo base_url(); ?>assets_d//search.png" alt="search">
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
                                                        <img src="<?php echo base_url(); ?>assets_d//grid-box-blue.svg" alt="Grid">
                                                    </li>
                                                    <li class="list">
                                                        <img src="<?php echo base_url(); ?>assets_d//list-box-grey.svg" alt="List">
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="tab-content">
                                            <div id="buying" class="tab-pane fade in active">
                                                <div class="tabPaneWrapper market">
                                                    <div class="left">
                                                        <div class="userBoxWrapper gridview">
                                                            <div class="card">
                                                                <div class="profileSection">
                                                                    <div class="profileViewToggleWrapper">
                                                                        <figure>
                                                                            <img src="<?php echo base_url(); ?>assets_d//detail1.jpg">
                                                                        </figure>
                                                                        <div class="changeView">
                                                                            <h5>Book Name</h5>
                                                                            <div class="courseStructure">
                                                                                <p>Author name</p>
                                                                                <div class="statusourse price">
                                                                                    ₹ 600.00
                                                                                </div>
                                                                            </div>
                                                                            <div class="my-rating-4" data-rating="3.5">
                                                                                <span>1200</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="profileSection">
                                                                    <div class="profileViewToggleWrapper">
                                                                        <figure>
                                                                            <img src="<?php echo base_url(); ?>assets_d//detail1.jpg">
                                                                        </figure>
                                                                        <div class="changeView">
                                                                            <h5>Book Name</h5>
                                                                            <div class="courseStructure">
                                                                                <p>Author name</p>
                                                                                <div class="statusourse price">
                                                                                    ₹ 600.00
                                                                                </div>
                                                                            </div>
                                                                            <div class="my-rating-4" data-rating="3.5">
                                                                                <span>1200</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
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
                                            <div id="selling" class="tab-pane fade in">
                                                <div class="tabPaneWrapper market">
                                                    <div class="left">
                                                        <div class="userBoxWrapper gridview">
                                                            <div class="card">
                                                                <div class="profileSection">
                                                                    <div class="profileViewToggleWrapper">
                                                                        <figure>
                                                                            <img src="<?php echo base_url(); ?>assets_d//detail1.jpg">
                                                                        </figure>
                                                                        <div class="changeView">
                                                                            <h5>Book Name</h5>
                                                                            <div class="courseStructure">
                                                                                <p>Author name</p>
                                                                                <div class="statusourse price">
                                                                                    ₹ 600.00
                                                                                </div>
                                                                            </div>
                                                                            <div class="my-rating-4" data-rating="3.5">
                                                                                <span>1200</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="profileSection">
                                                                    <div class="profileViewToggleWrapper">
                                                                        <figure>
                                                                            <img src="<?php echo base_url(); ?>assets_d/images/detail1.jpg">
                                                                        </figure>
                                                                        <div class="changeView">
                                                                            <h5>Book Name</h5>
                                                                            <div class="courseStructure">
                                                                                <p>Author name</p>
                                                                                <div class="statusourse price">
                                                                                    ₹ 600.00
                                                                                </div>
                                                                            </div>
                                                                            <div class="my-rating-4" data-rating="3.5">
                                                                                <span>1200</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
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
                    <section class="listBar">
                        <section class="listHeader">
                            <h6>Contacts</h6>
                        </section>
                        <section class="listChatBox">
                            <section class="list">
                                <section class="left">
                                    <figure>
                                        <img src="<?php echo base_url(); ?>assets_d/images/user2.jpg" alt="user">
                                        <span class="circle online"></span>
                                    </figure>
                                    <figcaption>Angelina</figcaption>
                                </section>
                            </section>
                            <section class="list">
                                <section class="left">
                                    <figure>
                                        <img src="<?php echo base_url(); ?>assets_d/images/user2.jpg" alt="user">
                                        <span class="circle offline"></span>
                                    </figure>
                                    <figcaption>Angelina</figcaption>
                                </section>
                            </section>
                            <section class="list">
                                <section class="left">
                                    <figure>
                                        <img src="<?php echo base_url(); ?>assets_d/images/user2.jpg" alt="user">
                                        <span class="circle online"></span>
                                    </figure>
                                    <figcaption>Angelina</figcaption>
                                </section>
                            </section>
                            <section class="list">
                                <section class="left">
                                    <figure>
                                        <img src="<?php echo base_url(); ?>assets_d/images/user2.jpg" alt="user">
                                        <span class="circle offline"></span>
                                    </figure>
                                    <figcaption>Angelina</figcaption>
                                </section>
                            </section>
                            <section class="list">
                                <section class="left">
                                    <figure>
                                        <img src="<?php echo base_url(); ?>assets_d/images/user2.jpg" alt="user">
                                        <span class="circle online"></span>
                                    </figure>
                                    <figcaption>Charles</figcaption>
                                </section>
                            </section>
                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>


    <div class="modal fade" id="userConnections" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                <div class="modal-body">
                    <div class="createHeader">
                        <div class="closePost" data-dismiss="modal">
                            <img src="images/close-grey.svg" alt="close">
                        </div>
                    </div>
                    <h4>Are you sure you want to unfollow Username?</h4>
                    <div class="profileSection">
                        <div class="profileViewToggleWrapper">
                            <figure>
                                <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                            </figure>
                            <div class="changeView">
                                <h5>Full Name</h5>
                                <p>location name</p>
                                <div class="followers">
                                    <span>25 </span> Followers
                                </div>
                            </div>
                        </div>
                        <div class="followOptionsWrapper">
                            <ul>
                                <li>
                                    <a href="javascript:void(0)">Cancel</a>
                                </li>
                                <li class="unfollow">
                                    <a href="javascript:void(0)">Unfollow</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="reportuser" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                <div class="modal-body">
                    <div class="createHeader">
                        <div class="closePost" data-dismiss="modal">
                            <img src="images/close-grey.svg" alt="close">
                        </div>
                    </div>
                    <h4>Select Reason to report username</h4>
                    <div class="reportSection">
                        <ul>
                            <li class="active">
                                <a>Reason</a>
                            </li>
                            <li>
                                <a>Reason lorem ipsum</a>
                            </li>
                            <li class="active">
                                <a>Reason lorem ipsum</a>
                            </li>
                            <li>
                                <a>lorem ipsum</a>
                            </li>
                            <li>
                                <a>Reason</a>
                            </li>
                            <li>
                                <a>Reason</a>
                            </li>
                            <li>
                                <a>Reason</a>
                            </li>
                        </ul>
                    </div>
                    <div class="followOptionsWrapper">
                        <ul>
                            <li>
                                <a href="javascript:void(0)">Cancel</a>
                            </li>
                            <li class="block">
                                <a href="javascript:void(0)">Report</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="blockUser" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                <div class="modal-body">
                    <div class="createHeader">
                        <div class="closePost" data-dismiss="modal">
                            <img src="images/close-grey.svg" alt="close">
                        </div>
                    </div>
                    <h4>Are you sure you want to block Username?</h4>
                    <div class="profileSection">
                        <div class="profileViewToggleWrapper">
                            <figure>
                                <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                            </figure>
                            <div class="changeView">
                                <h5>Full Name</h5>
                                <p>location name</p>
                                <div class="followers">
                                    <span>25 </span> Followers
                                </div>
                            </div>
                        </div>
                        <div class="followOptionsWrapper">
                            <ul>
                                <li>
                                    <a href="javascript:void(0)">Cancel</a>
                                </li>
                                <li class="block" data-dismiss="modal" data-toggle="modal" href="#reportuser">
                                    <a href="javascript:void(0)">Block</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteUser" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                <div class="modal-body">
                    <div class="createHeader">
                        <div class="closePost" data-dismiss="modal">
                            <img src="images/close-grey.svg" alt="close">
                        </div>
                    </div>
                    <h4>Remove Username from your peers list?</h4>
                    <div class="profileSection">
                        <div class="profileViewToggleWrapper">
                            <figure>
                                <img src="https://likewise-stage.azureedge.net/uploads/3eb6cf23-895b-45e9-b92c-5fb1b457dd04/bill-gates-profile-pic.jpg">
                            </figure>
                            <div class="changeView">
                                <h5>Full Name</h5>
                                <p>location name</p>
                                <div class="followers">
                                    <span>25 </span> Followers
                                </div>
                            </div>
                        </div>
                        <div class="followOptionsWrapper">
                            <ul>
                                <li>
                                    <a href="javascript:void(0)">Cancel</a>
                                </li>
                                <li class="block" data-dismiss="modal" data-toggle="modal" href="#reportuser">
                                    <a href="javascript:void(0)">Remove</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

?>