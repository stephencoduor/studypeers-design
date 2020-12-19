<div class="right">
    <?php
        $complete_per = 40;
        if(!empty($user_detail['about']) && !empty($user_detail['high_School'])){
            $complete_per += 30;
        }
        if(!empty($user_detail['fb_link'])){
            $complete_per += 15;
        }
        if(!empty($user_detail['user_location'])){
            $complete_per += 15;
        }
    ?>
    <?php if($complete_per != 100){ ?>
    <div class="boxwrap completeProfile">
        <h6>Complete your profile</h6>
        <p>Current status of your profile</p>

        
        
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
        
            
            <div class="completeNow">
                <button data-toggle="tab" href="#profile" class="event_action" onclick="activateProfileTab()">Complete Now</button>
            </div>
    

    </div>
    <?php } ?>
    <!-- <div class="boxwrap">
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
    </div> -->
</div>