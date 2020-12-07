<ul class="custom-tabs">
    <li><a href="javascript:void(0)" class="all-links active">All</a></li>
    <li><a href="javascript:void(0)" class="total-likes"><img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Image"/> <?php echo count($like_result); ?></a></li>
    <li><a href="javascript:void(0)" class="total-claps"><img src="<?php echo base_url(); ?>assets_d/images/celebrate-dashboard.svg" alt="Image"/> <?php echo count($celebrate_result); ?> </a></li>
    <li><a href="javascript:void(0)" class="support-links"><img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" alt="Image"/> <?php echo count($support_result); ?> </a></li>
    <li><a href="javascript:void(0)" class="curious-links"><img src="<?php echo base_url(); ?>assets_d/images/curious-dashboard.svg" alt="Image"/> <?php echo count($insightful_result); ?> </a></li>
    <li><a href="javascript:void(0)" class="insight-links"><img src="<?php echo base_url(); ?>assets_d/images/insight-dashboard.svg" alt="Image"/> <?php echo count($curious_result); ?> </a></li>
    <li><a href="javascript:void(0)" class="love-links"><img src="<?php echo base_url(); ?>assets_d/images/love-dashboard.svg" alt="Image"/> <?php echo count($love_result); ?> </a></li>
    
</ul>
<div class="tab-content">
    <div class="all-wrap show">
        <?php foreach ($all_result as $key => $value) { ?>
            <div class="user-info-wrap">
                <div class="user-image">
                    <span class="small-icon">
                        <?php if($value['reaction_id'] == 1) { ?>
                            <img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Image"/>
                        <?php } else if($value['reaction_id'] == 2) { ?>
                            <img src="<?php echo base_url(); ?>assets_d/images/celebrate-dashboard.svg" alt="Image"/>
                        <?php } else if($value['reaction_id'] == 3) { ?>
                            <img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" alt="Image"/>
                        <?php } else if($value['reaction_id'] == 4) { ?>
                            <img src="<?php echo base_url(); ?>assets_d/images/curious-dashboard.svg" alt="Image"/>
                        <?php } else if($value['reaction_id'] == 5) { ?>
                            <img src="<?php echo base_url(); ?>assets_d/images/insight-dashboard.svg" alt="Image"/>
                        <?php } else if($value['reaction_id'] == 6) { ?>
                            <img src="<?php echo base_url(); ?>assets_d/images/love-dashboard.svg" alt="Image"/>
                        <?php } ?>
                    </span>
                    <figure>
                        <img src="<?php echo userImage($value['user_id']); ?>" alt="Image"/>
                    </figure>
                </div>
                <div class="user-info">
                    <h3><?php echo $value['first_name'].' '.$value['last_name']; ?>
                     <!-- . <span>1st</span> -->
                    </h3>
                    <!-- <p>Software Engineer || <span>Microsoft</span></p> -->
                </div>
            </div>
        <?php } ?>
        
    </div>
    <div class="likes">
        <?php foreach ($like_result as $key => $value) { ?>
            <div class="user-info-wrap">
                <div class="user-image">
                    <span class="small-icon"><img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Image"/></span>
                    <figure>
                        <img src="<?php echo userImage($value['user_id']); ?>" alt="Image"/>
                    </figure>
                </div>
                <div class="user-info">
                    <h3><?php echo $value['first_name'].' '.$value['last_name']; ?>
                     <!-- . <span>1st</span> -->
                    </h3>
                    <!-- <p>Software Engineer || <span>Microsoft</span></p> -->
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="claps">
        <?php foreach ($celebrate_result as $key => $value) { ?>
            <div class="user-info-wrap">
                <div class="user-image">
                    <span class="small-icon"><img src="<?php echo base_url(); ?>assets_d/images/celebrate-dashboard.svg" alt="Image"/></span>  
                    <figure>
                        <img src="<?php echo userImage($value['user_id']); ?>" alt="Image"/>
                    </figure>
                </div>
                <div class="user-info">
                    <h3><?php echo $value['first_name'].' '.$value['last_name']; ?>
                     <!-- . <span>1st</span> -->
                    </h3>
                    <!-- <p>Software Engineer || <span>Microsoft</span></p> -->
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="support-wrap">
        <?php foreach ($support_result as $key => $value) { ?>
            <div class="user-info-wrap">
                <div class="user-image">
                    <span class="small-icon"><img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" alt="Image"/></span>  
                    <figure>
                        <img src="<?php echo userImage($value['user_id']); ?>" alt="Image"/>
                    </figure>
                </div>
                <div class="user-info">
                    <h3><?php echo $value['first_name'].' '.$value['last_name']; ?>
                     <!-- . <span>1st</span> -->
                    </h3>
                    <!-- <p>Software Engineer || <span>Microsoft</span></p> -->
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="curious-wrap">
        <?php foreach ($insightful_result as $key => $value) { ?>
            <div class="user-info-wrap">
                <div class="user-image">
                    <span class="small-icon"><img src="<?php echo base_url(); ?>assets_d/images/curious-dashboard.svg" alt="Image"/></span>  
                    <figure>
                        <img src="<?php echo userImage($value['user_id']); ?>" alt="Image"/>
                    </figure>
                </div>
                <div class="user-info">
                    <h3><?php echo $value['first_name'].' '.$value['last_name']; ?>
                     <!-- . <span>1st</span> -->
                    </h3>
                    <!-- <p>Software Engineer || <span>Microsoft</span></p> -->
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="insight-wrap">
        <?php foreach ($curious_result as $key => $value) { ?>
            <div class="user-info-wrap">
                <div class="user-image">
                    <span class="small-icon"><img src="<?php echo base_url(); ?>assets_d/images/insight-dashboard.svg" alt="Image"/></span>  
                    <figure>
                        <img src="<?php echo userImage($value['user_id']); ?>" alt="Image"/>
                    </figure>
                </div>
                <div class="user-info">
                    <h3><?php echo $value['first_name'].' '.$value['last_name']; ?>
                     <!-- . <span>1st</span> -->
                    </h3>
                    <!-- <p>Software Engineer || <span>Microsoft</span></p> -->
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="love-wrap">
        <?php foreach ($love_result as $key => $value) { ?>
            <div class="user-info-wrap">
                <div class="user-image">
                    <span class="small-icon"><img src="<?php echo base_url(); ?>assets_d/images/love-dashboard.svg" alt="Image"/></span>  
                    <figure>
                        <img src="<?php echo userImage($value['user_id']); ?>" alt="Image"/>
                    </figure>
                </div>
                <div class="user-info">
                    <h3><?php echo $value['first_name'].' '.$value['last_name']; ?>
                     <!-- . <span>1st</span> -->
                    </h3>
                    <!-- <p>Software Engineer || <span>Microsoft</span></p> -->
                </div>
            </div>
        <?php } ?>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        $(".all-links").click(function(){
            $(this).addClass("active");
            $(".all-wrap").addClass("show");
            $(".likes,.claps,.support-wrap,.curious-wrap,.love-wrap,.insight-wrap").removeClass("show");
            $(".total-likes,.total-claps,.support-links,.curious-links,.insight-links,.love-links").removeClass("active");
        });
        $(".total-likes").click(function(){
            $(this).addClass("active");
            $(".likes").addClass("show");
            $(".all-wrap,.claps,.support-wrap,.curious-wrap,.love-wrap,.insight-wrap").removeClass("show");
            $(".all-links,.total-claps,.support-links,.curious-links,.insight-links,.love-links").removeClass("active");
        });
        $(".total-claps").click(function(){
            $(this).addClass("active");
            $(".claps").addClass("show");
            $(".all-wrap,.likes,.support-wrap,.curious-wrap,.love-wrap,.insight-wrap").removeClass("show");
            $(".total-likes,.all-links,.support-links,.curious-links,.insight-links,.love-links").removeClass("active");
        });
        $(".support-links").click(function(){
            $(this).addClass("active");
            $(".support-wrap").addClass("show");
            $(".all-wrap,.likes,.claps,.curious-wrap,.love-wrap,.insight-wrap").removeClass("show");
            $(".all-links,.total-claps,.all-links,.curious-links,insight-links,.love-links").removeClass("active");
        });
        $(".curious-links").click(function(){
            $(this).addClass("active");
            $(".curious-wrap").addClass("show");
            $(".all-wrap,.likes,.claps,.support-wrap,.insight-wrap,.love-wrap").removeClass("show");
            $(".all-links,.total-claps,.all-links,.support-links,.insight-links,.love-links").removeClass("active");
        });
        $(".insight-links").click(function(){
            $(this).addClass("active");
            $(".insight-wrap").addClass("show");
            $(".all-wrap,.likes,.claps,.support-wrap,.curious-wrap,.love-wrap").removeClass("show");
            $(".all-links,.total-claps,.all-links,.support-links,.curious-links,.love-links").removeClass("active");
        });
        $(".love-links").click(function(){
            $(this).addClass("active");
            $(".love-wrap").addClass("show");
            $(".all-wrap,.likes,.claps,.support-wrap,.curious-wrap,.insight-wrap").removeClass("show");
            $(".all-links,.total-claps,.all-links,.support-links,.curious-links,.insight-links").removeClass("active");
        });
    });
</script>