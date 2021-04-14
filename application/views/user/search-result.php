<section class="mainContent">
    <div class="main-home-wrapper">
		<?php 
			if ($this->session->flashdata('message')) { 
		?>
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<?php echo $this->session->flashdata('message') ?>
			</div>
		<?php 
			}
			
			if ($this->session->flashdata('exception')) { 
		?>
		<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<?php echo $this->session->flashdata('exception') ?>
		</div>
		<?php 
			} 
		?>
		
        <div class="tabs-wrappper">
            <div class="tabslisting">
                <ul class="nav nav-tabs">
					<li <?php if($tabType == '' || $tabType == 'all'){ ?>class="active" <?php } ?>><a data-toggle="tab" href="#all" aria-expanded="true">All</a></li>
                    <li <?php if($tabType != '' && $tabType == 'peers'){ ?>class="active" <?php } ?>><a data-toggle="tab" href="#peers" aria-expanded="true">Peers</a></li>
                    <li <?php if($tabType != '' && $tabType == 'posts'){ ?>class="active" <?php } ?>><a data-toggle="tab" href="#posts" aria-expanded="true">Posts</a></li>
                    <li <?php if($tabType != '' && $tabType == 'questions'){ ?>class="active" <?php } ?>><a data-toggle="tab" href="#questions" aria-expanded="true">Questions</a></li>
                    <li <?php if($tabType != '' && $tabType == 'documents'){ ?>class="active" <?php } ?>><a data-toggle="tab" href="#documents" aria-expanded="true">Documents</a></li>
                    <li <?php if($tabType != '' && $tabType == 'studySets'){ ?>class="active" <?php } ?>><a data-toggle="tab" href="#studySets" aria-expanded="true">Study Sets</a></li>
                    <li <?php if($tabType != '' && $tabType == 'events'){ ?>class="active" <?php } ?>><a data-toggle="tab" href="#events" aria-expanded="true">Events</a></li>
                    <li style="display:none;"><a data-toggle="tab" href="#articles" aria-expanded="true">Articles</a></li>
                    <li style="display:none;"><a data-toggle="tab" href="#studySessions" aria-expanded="true">Study Sessions</a></li>
                </ul>
            </div>
        </div>
        <div class="tab-content">
			<div id="all" class="tab-pane fade <?php if($tabType == '' || $tabType == 'all'){ ?>in active<?php } ?>">
				<?php
				if(!empty($AllPeers)){
				?>
				<div class="content-card">
                    <div class="title-wrap">
                        <h3>Peers</h3>
                    </div>
                    <div class="peers-listing">
						<?php
							foreach($AllPeers as $AllPeer){
						?>
                        <div class="peers-row">
                            <div class="peer-left-info">
                                <div class="peers-img-wrap" style="cursor:pointer;" onclick="window.location.href='<?php echo base_url('sp/'.$AllPeer['username']); ?>'">
                                    <img src="<?php echo $AllPeer['UserProfile']; ?>" alt="Image"/>
                                </div>
                                <div class="basic-info">
                                    <h3 style="cursor:pointer;" onclick="window.location.href='<?php echo base_url('sp/'.$AllPeer['username']); ?>'"><?php echo $AllPeer['full_name']; ?></h3>
                                    <ul>
                                        <li><?php echo $AllPeer['UniversityName']; ?></li>
                                        <li><?php echo $AllPeer['LocationName']; ?></li>
                                        <li><a href=""><?php echo $AllPeer['totalFollower']; ?></a> followers</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="peer-right-info">
                                <ul>
                                    <li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/chat-red.svg" alt="Image" data-name="<?php echo $AllPeer['full_name']; ?>" data-groupId="0" data-id="<?php echo $AllPeer['id']; ?>" class="open-single-chat-window" /></a></li>
									
									<?php
										if($AllPeer['isFollowing'] == 1){
									?>
									<li><a href="javascript:;" class="follow_now follow_<?php echo $AllPeer['id']; ?>" data-id="<?php echo $AllPeer['id']; ?>" id="0">UnFollow</a></li>
									<?php		
										} else {
									?>
									<li><a href="javascript:;" class="follow_now follow_<?php echo $AllPeer['id']; ?>" data-id="<?php echo $AllPeer['id']; ?>" id="1">Follow</a></li>
									<?php		
										}
									?>
                                    <!--li><a href="javascript:;" onclick="alert('Work in progress');">Peer</a></li-->
                                </ul>
                            </div>
                        </div>
						<?php
							}
						?>
                    </div>
                    <div class="view-all-section"><a href="<?php echo base_url('account/searchViewAll/peers/all'); ?>">View All Peers</a></div>
                </div>
				<br>
				<?php
				}
				
				if(!empty($AllPosts)){
				?>
				<div class="content-card seprate-border">
                    <div class="title-wrap">
                        <h3>Posts</h3>
                    </div>
					<?php
						foreach($AllPosts as $AllPost) {
					?>
                    <div class="post-row-wrap">
                        <div class="user-top">
                            <div class="user-top-left">
                                <div class="user-img" style="cursor:pointer;" onclick="window.location.href='<?php echo base_url('sp/'.$AllPost['username']); ?>'">
                                    <figure>
                                        <img src="<?php echo $AllPost['profile_picture']; ?>" alt="Image"/>
                                    </figure>
                                </div>
                                <div class="user-name-wrap">
                                    <h3 style="cursor:pointer;" onclick="window.location.href='<?php echo base_url('sp/'.$AllPost['username']); ?>'"><?php echo $AllPost['fullname']; ?></h3>
                                    <div class="badgeList">
                                        <ul>
                                            <li class="badge badge1">
                                                <a href=""><?php echo $AllPost['UniversityName']; ?></a>
                                            </li>
                                            <li class="badge badge3">
                                                <a href="">
                                                    Faculty
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="user-top-right">
                                <div class="timeline-action">
                                    <span class="timeline"><?php echo $AllPost['posted_date']; ?></span>
                                    <!--a href=""><img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/></a-->
									&nbsp;&nbsp;&nbsp;
									<div class="dropdown">
										<i class="dropdown-toggle" data-toggle="dropdown">
											<img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/>
										</i>
										<ul class="dropdown-menu" style="right: 0;left: auto;top: 0px;">
											<li class="removePeerSugg">
												<a href="javascript:;" class="reportThings" data-reportType="POSTS" data-currentPage="searchResult" data-primaryId="<?php echo $AllPost['post_id']; ?>">Report</a>
											</li>
										</ul>
									</div>
                                </div>
                            </div>
                        </div>  
                        <div class="content-info-area">
                            <div class="content-img clearfix">
								<?php
								if($AllPost['post_image'] != ''){
								?>
									<figure>
										<img src="<?php echo $AllPost['post_image'];?>" alt="Image"/>
									</figure>
								<?php
								} else if($AllPost['post_video'] != ''){
								?>
									<figure>
										<video width="320" height="240" controls>
											<source src="<?php echo $AllPost['post_video']; ?>" type="video/mp4">
										</video>
									</figure>
								<?php	
								}
								?>
                                <p><?php echo $AllPost['post_content_html']; ?></p>
                            </div>
                        </div>
                        <div class="like-comment-wrap">
                            <div class="like-wrap">
                                <ul>
									<?php
										if(!empty($AllPost['reactions_ids'])){
											foreach($AllPost['reactions_ids'] as $reactions_id){
												if($reactions_id == 1) {
										?>
										<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Like"></a></li>
										<?php			
												} else if($reactions_id == 2) {
										?>
										<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" alt="Icon"/></a></li>
										<?php			
												} else if($reactions_id == 3) {
										?>
										<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/celebrate-dashboard.svg" alt="Icon"></a></li>
										<?php			
												} else if($reactions_id == 4) {
										?>
										<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/curious-dashboard.svg" alt="Icon"></a></li>
										<?php			
												} else if($reactions_id == 5) {
										?>
										<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/insight-dashboard.svg" alt="Icon"></a></li>
										<?php			
												} else if($reactions_id == 6) {
										?>
										<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/love-dashboard.svg" alt="Icon"></a></li>
										<?php			
												}
											}
										}
									?>
                                    
                                    <li><a href=""><?php echo $AllPost['total_reactions']; ?></a></li>
                                </ul>
                            </div>
                            <div class="comment-wrap">
                                <ul>
                                    <li><a href="<?php echo base_url('account/searchDetail/posts/'.base64_encode($AllPost['post_id']).'/all/comment'); ?>"><img src="<?php echo base_url(); ?>assets_d/images/comment-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="<?php echo base_url('account/searchDetail/posts/'.base64_encode($AllPost['post_id']).'/all/comment'); ?>"><?php echo $AllPost['total_comments']; ?></a></li>
                                    <!--li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/share-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li-->
									
									<li>&nbsp;</li>
									<li>
										<div class="action">
											<div class="action_button">
												<a href="<?php echo base_url('account/searchDetail/posts/'.base64_encode($AllPost['post_id']).'/all'); ?>">
													<svg class="sp-icon sp-icon--rotate-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490"><path d="M481.3,110.1c-11.6-11.6-30.4-11.6-42.1,0L245,304.4L50.8,110.2c-11.6-11.6-30.4-11.6-42.1,0c-11.6,11.6-11.6,30.4,0,42.1l236.4,236.4l236.2-236.4C492.9,140.6,492.9,121.7,481.3,110.1z"></path>
													</svg>
												</a>
											</div>
										</div>
									</li>
                                </ul>
                            </div>
                        </div>
                    </div>
					<?php
						}
					?>
                    <div class="view-all-section"><a href="<?php echo base_url('account/searchViewAll/posts/all'); ?>">View All Posts</a></div>
                </div>
				<br>
				<?php
				}
				
				if(!empty($AllQuestions)){
				?>
				<div class="content-card seprate-border">
                    <div class="title-wrap">
                        <h3>Questions</h3>
                    </div>
					<?php
						foreach($AllQuestions as $AllQuestion) {
					?>
                    <div class="post-row-wrap">
                        <div class="user-top">
                            <div class="user-top-left">
                                <div class="user-img" style="cursor:pointer;" onclick="window.location.href='<?php echo base_url('sp/'.$AllQuestion['username']); ?>'">
                                    <figure>
                                        <img src="<?php echo $AllQuestion['profile_picture']; ?>" alt="Image"/>
                                    </figure>
                                </div>
                                <div class="user-name-wrap">
                                    <h3 style="cursor:pointer;" onclick="window.location.href='<?php echo base_url('sp/'.$AllQuestion['username']); ?>'"><?php echo $AllQuestion['username']; ?></h3>
                                    <div class="badgeList">
                                        <ul>
                                            <li class="badge badge1">
                                                <a href=""><?php echo $AllQuestion['UniversityName']; ?></a>
                                            </li>
                                            <li class="badge badge3">
                                                <a href="">
                                                    Faculty
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="user-top-right">
                                <div class="timeline-action">
                                    <span class="timeline"><?php echo $AllQuestion['post_at']; ?></span>
                                    <!--a href=""><img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/></a-->
									&nbsp;&nbsp;&nbsp;
									<div class="dropdown">
										<i class="dropdown-toggle" data-toggle="dropdown">
											<img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/>
										</i>
										<ul class="dropdown-menu" style="right: 0;left: auto;top: 0px;">
											<li class="removePeerSugg">
												<a href="javascript:;" class="reportThings" data-reportType="QUESTIONS" data-currentPage="searchResult" data-primaryId="<?php echo $AllQuestion['question_id']; ?>">Report</a>
											</li>
										</ul>
									</div>
                                </div>
                            </div>
                        </div>  
                        <div class="content-info-area">
							 <b><?php echo $AllQuestion['question_title']; ?></b>
                            <p><?php echo $AllQuestion['question_description']; ?></p>
                        </div>
                        <div class="like-comment-wrap">
                            <div class="like-wrap">
                                <ul>
                                    <li>
										<svg xmlns="http://www.w3.org/2000/svg"  class="activeState" width="18.363" height="20" viewBox="0 0 18.363 20">
											<g id="prefix__up-arrow" transform="translate(-31.008 -10.925)">
												<path id="prefix__Path_1209" d="M37.272 29.256h5.6v-9.1a.83.83 0 0 1 .828-.833h2.828l-6.358-6.387-6.35 6.383h2.62a.83.83 0 0 1 .828.833v9.1zm6.428 1.669h-7.26a.83.83 0 0 1-.828-.833v-9.1H31.82a.844.844 0 0 1-.588-1.424l8.358-8.4a.845.845 0 0 1 1.171 0l8.354 8.4a.823.823 0 0 1-.588 1.424h-4v9.1a.825.825 0 0 1-.827.833z" data-name="Path 1209" />
											</g>
										</svg>
									</li>
										<a href="javascript:;"><?php echo $AllQuestion['vote_count']; ?></a>
                                    <li>
									</li>
                                    <li>
										<svg xmlns="http://www.w3.org/2000/svg"  class="activeState" width="18.363" height="20" viewBox="0 0 18.363 20">
											<g id="prefix__Layer_1" transform="rotate(180 24.686 15.463)">
												<g id="prefix__Group_1371" data-name="Group 1371" transform="translate(31.008 10.925)">
													<path id="prefix__Path_1213" d="M43.7 30.925h-7.26a.83.83 0 0 1-.828-.833v-9.1H31.82a.844.844 0 0 1-.588-1.424l8.358-8.4a.845.845 0 0 1 1.171 0l8.354 8.4a.823.823 0 0 1-.588 1.424h-4v9.1a.825.825 0 0 1-.828.833z" data-name="Path 1213" transform="translate(-31.008 -10.925)" />
												</g>
											</g>
										</svg>
									</li>
                                </ul>
                            </div>
                            <div class="comment-wrap">
                                <ul>
                                    <li><a href="<?php echo base_url('account/questionDetail/'.base64_encode($AllQuestion['question_id']).'/search/all'); ?>"><img src="<?php echo base_url(); ?>assets_d/images/views.svg" alt="Icon"/></a></li>
                                    <li><a href="<?php echo base_url('account/questionDetail/'.base64_encode($AllQuestion['question_id']).'/search/all'); ?>"><?php echo $AllQuestion['view_count']; ?></a></li>
                                    <li><a href="<?php echo base_url('account/questionDetail/'.base64_encode($AllQuestion['question_id']).'/search/all'); ?>"><img src="<?php echo base_url(); ?>assets_d/images/answer.svg" alt="Icon"/></a></li>
                                    <li><a href="<?php echo base_url('account/questionDetail/'.base64_encode($AllQuestion['question_id']).'/search/all'); ?>"><?php echo $AllQuestion['answer_count']; ?></a></li>
                                    <!--li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/share-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li-->
									
									<li>&nbsp;</li>
									<li>
										<div class="action">
											<div class="action_button">
												<a href="<?php echo base_url('account/questionDetail/'.base64_encode($AllQuestion['question_id']).'/search/all'); ?>">
													<svg class="sp-icon sp-icon--rotate-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490"><path d="M481.3,110.1c-11.6-11.6-30.4-11.6-42.1,0L245,304.4L50.8,110.2c-11.6-11.6-30.4-11.6-42.1,0c-11.6,11.6-11.6,30.4,0,42.1l236.4,236.4l236.2-236.4C492.9,140.6,492.9,121.7,481.3,110.1z"></path>
													</svg>
												</a>
											</div>
										</div>
									</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php
						}
					?>
                    <div class="view-all-section"><a href="<?php echo base_url('account/searchViewAll/questions/all'); ?>">View All Questions</a></div>
                </div>
				<br>
				<?php
				}
				
				if(!empty($AllDocuments)){
				?>
				<div class="content-card seprate-border">
                    <div class="title-wrap">
                        <h3>Documents</h3>
                    </div>
					<?php
						foreach($AllDocuments as $AllDocument){
					?>
                    <div class="post-row-wrap">
                        <div class="user-top">
                            <div class="user-top-left">
                                <div class="user-img" style="cursor:pointer;" onclick="window.location.href='<?php echo base_url('sp/'.$AllDocument['username']); ?>'">
                                    <figure>
                                        <img src="<?php echo $AllDocument['profile_picture']; ?>" alt="Image"/>
                                    </figure>
                                </div>
                                <div class="user-name-wrap">
                                    <h3 style="cursor:pointer;" onclick="window.location.href='<?php echo base_url('sp/'.$AllDocument['username']); ?>'"><?php echo $AllDocument['fullname']; ?></h3>
                                    <div class="badgeList">
                                        <ul>
                                            <li class="badge badge1">
                                                <a href=""><?php echo $AllDocument['UniversityName']; ?></a>
                                            </li>
                                            <li class="badge badge3">
                                                <a href="">
                                                    Faculty
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="user-top-right">
                                <div class="timeline-action">
                                    <span class="timeline"><?php echo $AllDocument['post_at']; ?></span>
                                    <!--a href=""><img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/></a-->
									&nbsp;&nbsp;&nbsp;
									<div class="dropdown">
										<i class="dropdown-toggle" data-toggle="dropdown">
											<img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/>
										</i>
										<ul class="dropdown-menu" style="right: 0;left: auto;top: 0px;">
											<li class="removePeerSugg">
												<a href="javascript:;" class="reportThings" data-reportType="DOCUMENTS" data-currentPage="searchResult" data-primaryId="<?php echo $AllDocument['document_id']; ?>">Report</a>
											</li>
										</ul>
									</div>
                                </div>
                            </div>
                        </div>  
                        <div class="content-info-area">
							<b><?php echo $AllDocument['document_name']; ?></b>
                            <p><?php echo $AllDocument['description']; ?></p>
                            <div class="documentName">
								<?php
									if($AllDocument['document_file'] != ''){
										$ExplodedFileName = explode(".",$AllDocument['document_file']);
										
										if(strtolower($ExplodedFileName[1]) == 'pdf'){
									?>
										<img src="<?php echo base_url(); ?>/assets_d/images/application_pdf.svg" alt="pdf"> 
									<?php		
										} else if(strtolower($ExplodedFileName[1]) == 'docx') {
									?>
										<img src="<?php echo base_url(); ?>/assets_d/images/application_vnd.openxmlformats-officedocument.wordprocessingml.document.svg" style="width: 30px;" alt="doc"> 
									<?php		
										} else if(strtolower($ExplodedFileName[1]) == 'doc') {
									?>
										<img src="<?php echo base_url(); ?>/assets_d/images/application_vnd.openxmlformats-officedocument.wordprocessingml.document.svg" style="width: 30px;" alt="doc"> 
									<?php		
										} else if(strtolower($ExplodedFileName[1]) == 'png') {
									?>
									<img src="<?php echo base_url(); ?>/assets_d/images/file.svg" alt="pdf"> 
									<?php		
										} else if(strtolower($ExplodedFileName[1]) == 'xls') {
									?>
									<img src="<?php echo base_url(); ?>/assets_d/images/xlsx@2x.png" style="width: 30px;" alt="text"> 
									<?php		
										} else if(strtolower($ExplodedFileName[1]) == 'csv') {
									?>
									<img src="<?php echo base_url(); ?>/assets_d/images/file.svg" alt="csv"> 
									<?php		
										} else if(strtolower($ExplodedFileName[1]) == 'txt') {
									?>
									<img src="<?php echo base_url(); ?>/assets_d/images/txt@2x.png" style="width: 30px;" alt="text"> 
									<?php		
										} else if(strtolower($ExplodedFileName[1]) == 'pptx') {
									?>
									<img src="<?php echo base_url(); ?>/assets_d/images/pptx@2x.png" style="width: 30px;" alt="pptx"> 
									<?php		
										}
									?>
                                <a href="<?php echo $AllDocument['document_link']; ?>" download><?php echo $AllDocument['document_file']; ?></a>
								<?php
									}
								?>
                            </div>
                        </div>
                        <div class="like-comment-wrap">
                            <div class="like-wrap">
                                <ul>
									<?php
										if(!empty($AllDocument['reactions_ids'])){
											foreach($AllDocument['reactions_ids'] as $reactions_id){
												if($reactions_id == 1) {
										?>
										<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Like"></a></li>
										<?php			
												} else if($reactions_id == 2) {
										?>
										<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" alt="Icon"/></a></li>
										<?php			
												} else if($reactions_id == 3) {
										?>
										<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/celebrate-dashboard.svg" alt="Icon"></a></li>
										<?php			
												} else if($reactions_id == 4) {
										?>
										<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/curious-dashboard.svg" alt="Icon"></a></li>
										<?php			
												} else if($reactions_id == 5) {
										?>
										<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/insight-dashboard.svg" alt="Icon"></a></li>
										<?php			
												} else if($reactions_id == 6) {
										?>
										<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/love-dashboard.svg" alt="Icon"></a></li>
										<?php			
												}
											}
										}
									?>
                                    <?php
									if(!empty($AllDocument['reactions_ids'])){
									?>
									<li><a href="javascript:;"><?php echo $AllDocument['total_reactions']; ?></a></li>
									<?php
									} else {
									?>
									<li><a href="javascript:;">&nbsp;&nbsp;</a></li>	
									<li><a href="javascript:;">&nbsp;&nbsp;</a></li>
									<?php	
									}
									?>
                                </ul>
                            </div>
                            <div class="star-rating">
                                <ul>
									<?php
										for($i = 1;$i <= $AllDocument['avgRatings'];$i++){
									?>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <?php
										}
									?>
                                </ul>
                            </div>
                            <div class="comment-wrap">
                                <ul>
                                    <li><a href="<?php echo base_url('account/documentDetail/'.base64_encode($AllDocument['document_id']).'/search/all'); ?>"><img src="<?php echo base_url(); ?>assets_d/images/comment-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="<?php echo base_url('account/documentDetail/'.base64_encode($AllDocument['document_id']).'/search/all'); ?>"><?php echo $AllDocument['total_comments']; ?></a></li>
                                    <!--li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/share-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li-->
									
									<li>&nbsp;</li>
									<li>
										<div class="action">
											<div class="action_button">
												<a href="<?php echo base_url('account/documentDetail/'.base64_encode($AllDocument['document_id']).'/search/all'); ?>">
													<svg class="sp-icon sp-icon--rotate-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490"><path d="M481.3,110.1c-11.6-11.6-30.4-11.6-42.1,0L245,304.4L50.8,110.2c-11.6-11.6-30.4-11.6-42.1,0c-11.6,11.6-11.6,30.4,0,42.1l236.4,236.4l236.2-236.4C492.9,140.6,492.9,121.7,481.3,110.1z"></path>
													</svg>
												</a>
											</div>
										</div>
									</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php
						}
					?>
                    <div class="view-all-section"><a href="<?php echo base_url('account/searchViewAll/documents/all'); ?>">View All Documents</a></div>
                </div>
				<br>
				<?php
				}
				
				if(!empty($AllStudySets)){
				?>
				<div class="content-card seprate-border">
                    <div class="title-wrap">
                        <h3>Study Sets</h3>
                    </div>
					<?php
						foreach($AllStudySets as $AllStudySet){
					?>
                    <div class="post-row-wrap">
                        <div class="user-top">
                            <div class="user-top-left">
                                <div class="user-img" style="cursor:pointer;" onclick="window.location.href='<?php echo base_url('sp/'.$AllStudySet['username']); ?>'">
                                    <figure>
                                        <img src="<?php echo $AllStudySet['profile_picture']; ?>" alt="Image"/>
                                    </figure>
                                </div>
                                <div class="user-name-wrap">
                                    <h3 style="cursor:pointer;" onclick="window.location.href='<?php echo base_url('sp/'.$AllStudySet['username']); ?>'"><?php echo $AllStudySet['fullname']; ?></h3>
                                    <div class="badgeList">
                                        <ul>
                                            <li class="badge badge1">
                                                <a href=""><?php echo $AllStudySet['UniversityName']; ?></a>
                                            </li>
                                            <li class="badge badge3">
                                                <a href="">
                                                    Faculty
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="user-top-right">
                                <div class="timeline-action">
                                    <span class="timeline"><?php echo $AllStudySet['post_at']; ?></span>
                                    <!--a href=""><img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/></a-->
									&nbsp;&nbsp;&nbsp;
									<div class="dropdown">
										<i class="dropdown-toggle" data-toggle="dropdown">
											<img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/>
										</i>
										<ul class="dropdown-menu" style="right: 0;left: auto;top: 0px;">
											<li class="removePeerSugg">
												<a href="javascript:;" class="reportThings" data-reportType="STUDYSET" data-currentPage="searchResult" data-primaryId="<?php echo $AllStudySet['studyset_id']; ?>">Report</a>
											</li>
										</ul>
									</div>
                                </div>
                            </div>
                        </div>  
                        <div class="content-info-area">
                            <div class="content-img clearfix">
								<?php
									if($AllStudySet['studyset_cover'] != ''){
								?>
                                <figure>
                                    <img src="<?php echo $AllStudySet['studyset_cover']; ?>" alt="Image"/>
                                </figure>
								<?php
									}
								?>
                                <p><?php echo $AllStudySet['studyset_name']; ?></p>
                            </div>
                        </div>
                        <div class="like-comment-wrap">
                            <div class="like-wrap">
								<ul>
									<?php
										if(!empty($AllStudySet['reactions_ids'])){
											foreach($AllStudySet['reactions_ids'] as $reactions_id){
												if($reactions_id == 1) {
										?>
										<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Like"></a></li>
										<?php			
												} else if($reactions_id == 2) {
										?>
										<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" alt="Icon"/></a></li>
										<?php			
												} else if($reactions_id == 3) {
										?>
										<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/celebrate-dashboard.svg" alt="Icon"></a></li>
										<?php			
												} else if($reactions_id == 4) {
										?>
										<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/curious-dashboard.svg" alt="Icon"></a></li>
										<?php			
												} else if($reactions_id == 5) {
										?>
										<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/insight-dashboard.svg" alt="Icon"></a></li>
										<?php			
												} else if($reactions_id == 6) {
										?>
										<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/love-dashboard.svg" alt="Icon"></a></li>
										<?php			
												}
											}
										}
									
										if(!empty($AllStudySet['reactions_ids'])){
									?>
										<li><a href="javascript:;"><?php echo $AllStudySet['total_reactions']; ?></a></li>
									<?php
										} else {
									?>
										<li><a href="javascript:;">&nbsp;&nbsp;</a></li>	
										<li><a href="javascript:;">&nbsp;&nbsp;</a></li>
									<?php	
										}
									?>
								</ul>
                            </div>
                            <div class="star-rating">
                                <ul>
									<?php
										for($i = 1;$i <= $AllStudySet['avgRatings'];$i++){
									?>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <?php
										}
									?>
                                </ul>
                            </div>
                            <div class="comment-wrap">
                                <ul>
                                    <li><a href="<?php echo base_url('studyset/details/'.$AllStudySet['studyset_id'].'/search/all/comment'); ?>"><img src="<?php echo base_url(); ?>assets_d/images/comment-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="<?php echo base_url('studyset/details/'.$AllStudySet['studyset_id'].'/search/all/comment'); ?>"><?php echo $AllStudySet['total_comments']; ?></a></li>
                                    <!--li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/share-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li-->
									
									<li>&nbsp;</li>
									<li>
										<div class="action">
											<div class="action_button">
												<a href="<?php echo base_url('studyset/details/'.$AllStudySet['studyset_id'].'/search/all'); ?>">
													<svg class="sp-icon sp-icon--rotate-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490"><path d="M481.3,110.1c-11.6-11.6-30.4-11.6-42.1,0L245,304.4L50.8,110.2c-11.6-11.6-30.4-11.6-42.1,0c-11.6,11.6-11.6,30.4,0,42.1l236.4,236.4l236.2-236.4C492.9,140.6,492.9,121.7,481.3,110.1z"></path>
													</svg>
												</a>
											</div>
										</div>
									</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php
						}
					?>
                    <div class="view-all-section"><a href="<?php echo base_url('account/searchViewAll/studysets/all'); ?>">View All Study Sets</a></div>
                </div>
				<br>
				<?php
				}
				
				if(!empty($AllEvents)){
				?>
				<div class="content-card seprate-border">
                    <div class="title-wrap">
                        <h3>Events</h3>
                    </div>
					<?php
						foreach($AllEvents as $AllEvent){
					?>
                    <div class="post-row-wrap">
                        <div class="user-top">
                            <div class="user-top-left">
                                <div class="user-img" style="cursor:pointer;" onclick="window.location.href='<?php echo base_url('sp/'.$AllEvent['username']); ?>'">
                                    <figure>
                                        <img src="<?php echo $AllEvent['profile_picture']; ?>" alt="Image"/>
                                    </figure>
                                </div>
                                <div class="user-name-wrap">
                                    <h3 style="cursor:pointer;" onclick="window.location.href='<?php echo base_url('sp/'.$AllEvent['username']); ?>'"><?php echo $AllEvent['fullname']; ?></h3>
                                    <div class="badgeList">
                                        <ul>
                                            <li class="badge badge1">
                                                <a href="javascript:;"><?php echo $AllEvent['UniversityName']; ?></a>
                                            </li>
                                            <li class="badge badge3">
                                                <a href="">
                                                    Faculty
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="user-top-right">
                                <div class="timeline-action">
                                    <span class="timeline"><?php echo $AllEvent['post_at']; ?></span>
                                    <!--a href=""><img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/></a-->
									&nbsp;&nbsp;&nbsp;
									<div class="dropdown">
										<i class="dropdown-toggle" data-toggle="dropdown">
											<img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/>
										</i>
										<ul class="dropdown-menu" style="right: 0;left: auto;top: 0px;">
											<li class="removePeerSugg">
												<a href="javascript:;" class="reportThings" data-reportType="EVENTS" data-currentPage="searchResult" data-primaryId="<?php echo $AllEvent['event_primary_id']; ?>">Report</a>
											</li>
										</ul>
									</div>
                                </div>
                            </div>
                        </div>  
                        <div class="content-info-area">
                            <div class="content-img clearfix">
								<?php
									if($AllEvent['featured_image'] != ''){
								?>
                                <figure>
                                    <img src="<?php echo $AllEvent['featured_image']; ?>" alt="Image"/>
                                </figure>
								<?php
									}
								?>
                                <p><?php echo $AllEvent['event_description']; ?></p>
                                <div class="event-description">
                                    <div class="left">
                                        <img src="<?php echo base_url(); ?>assets_d/images/location.svg" alt="Location"> <?php echo $AllEvent['event_location']; ?>
                                    </div>
                                    <div class="right">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets_d/images/calendar1.svg" alt="Event Time">
                                        </figure>
                                        <figcaption><?php echo $AllEvent['event_time']; ?></figcaption>
										<?php
											$isEventScheduled = $this->db->get_where('schedule_master', array('event_master_id' => $AllEvent['event_primary_id'], 'status' => 1,'created_by' => $CurrentUserID))->row_array();
											
											if(!empty($isEventScheduled)){
										?>
										<a href="#" class="removeEvent" data-id="<?php echo $AllEvent['event_primary_id']; ?>" data-toggle="modal" data-target="#removeFromScheduleModal">Remove From Calendar</a>
										<?php		
											} else {
										?>
										<a href="#" class="addEvents" data-id="<?php echo $AllEvent['event_primary_id']; ?>" data-toggle="modal" data-target="#addEventModal">Add to Calendar</a>
										<?php		
											}
										?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="eventActionWrap">
                            <ul>
                                <?php
									$peerAttending = $this->db->get_where('share_master', array('reference_id' => $AllEvent['event_primary_id'], 'reference' => 'event', 'status' => 2))->result_array();
									
									$totalAttendingPeer = 0;
									if(!empty($peerAttending)){
										$totalAttendingPeer = count($peerAttending);
										$i = 0;
										foreach($peerAttending as $peerAttendingData){
											$i++;
											if($i <= 5){
								?>
								<li>
									<img src="<?php echo userImage($peerAttendingData['peer_id']); ?>" alt="user">
								</li>
								<?php
											}
										}
									}
									
									if($totalAttendingPeer > 5){
								?>
                                <li class="more">
                                    +<?php echo $totalAttendingPeer-5; ?>
                                </li>
								<?php
									}
								?>
                            </ul>
							<?php
								$this->db->order_by('share_master.id', 'desc');
								$attendEvent = $this->db->get_where('share_master', array('reference_id' => $AllEvent['event_primary_id'], 'reference' => 'event', 'peer_id' => $CurrentUserID))->row_array(); 
							?>
							<button type="button" class="event_action attendEvent" data-toggle="modal" data-target="#confirmationModalAttend" data-id="<?php echo $AllEvent['event_primary_id']; ?>"> 
								<span class="attend_text_<?php echo $AllEvent['event_primary_id']; ?>" id="attend_text_<?php echo $AllEvent['event_primary_id']; ?>"><?php echo (!empty($attendEvent) && $attendEvent['status'] == 2) ? 'Unattend' : 'Attend';?></span> Event
							</button>
                        </div>
                        <div class="like-comment-wrap">
                            <div class="like-wrap">
                                <ul>
                                    <?php
										if(!empty($AllEvent['reactions_ids'])){
											foreach($AllEvent['reactions_ids'] as $reactions_id){
												if($reactions_id == 1) {
										?>
										<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Like"></a></li>
										<?php			
												} else if($reactions_id == 2) {
										?>
										<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" alt="Icon"/></a></li>
										<?php			
												} else if($reactions_id == 3) {
										?>
										<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/celebrate-dashboard.svg" alt="Icon"></a></li>
										<?php			
												} else if($reactions_id == 4) {
										?>
										<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/curious-dashboard.svg" alt="Icon"></a></li>
										<?php			
												} else if($reactions_id == 5) {
										?>
										<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/insight-dashboard.svg" alt="Icon"></a></li>
										<?php			
												} else if($reactions_id == 6) {
										?>
										<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/love-dashboard.svg" alt="Icon"></a></li>
										<?php			
												}
											}
										}
									
										if(!empty($AllEvent['reactions_ids'])){
									?>
										<li><a href="javascript:;"><?php echo $AllEvent['total_reactions']; ?></a></li>
									<?php
										} else {
									?>
										<li><a href="javascript:;">&nbsp;&nbsp;</a></li>	
										<li><a href="javascript:;">&nbsp;&nbsp;</a></li>
									<?php	
										}
									?>
                                </ul>
                            </div>
                            <div class="comment-wrap">
                                <ul>
                                    <li><a href="<?php echo base_url('account/eventDetails/'.base64_encode($AllEvent['event_primary_id']).'/search/all'); ?>"><img src="<?php echo base_url(); ?>assets_d/images/comment-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="<?php echo base_url('account/eventDetails/'.base64_encode($AllEvent['event_primary_id']).'/search/all'); ?>"><?php echo $AllEvent['total_comments']; ?></a></li>
                                    <!--li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/share-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li-->
									
									<li>&nbsp;</li>
									<li>
										<div class="action">
											<div class="action_button">
												<a href="<?php echo base_url('account/eventDetails/'.base64_encode($AllEvent['event_primary_id']).'/search/all'); ?>">
													<svg class="sp-icon sp-icon--rotate-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490"><path d="M481.3,110.1c-11.6-11.6-30.4-11.6-42.1,0L245,304.4L50.8,110.2c-11.6-11.6-30.4-11.6-42.1,0c-11.6,11.6-11.6,30.4,0,42.1l236.4,236.4l236.2-236.4C492.9,140.6,492.9,121.7,481.3,110.1z"></path>
													</svg>
												</a>
											</div>
										</div>
									</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php 
						}
					?>
                    <div class="view-all-section"><a href="<?php echo base_url('account/searchViewAll/events/all'); ?>">View All Events</a></div>
                </div>
				<br>
				<?php
				}
				?>
				<div class="content-card seprate-border" style="display:none;">
                    <div class="title-wrap">
                        <h3>Articles</h3>
                    </div>
                    <div class="post-row-wrap">
                        <div class="user-top">
                            <div class="user-top-left">
                                <div class="user-img">
                                    <figure>
                                        <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="Image"/>
                                    </figure>
                                </div>
                                <div class="user-name-wrap">
                                    <h3>Lorem Ipsum</h3>
                                    <div class="badgeList">
                                        <ul>
                                            <li class="badge badge1">
                                                <a href="">University of Florida</a>
                                            </li>
                                            <li class="badge badge3">
                                                <a href="">
                                                    Faculty
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="user-top-right">
                                <div class="timeline-action">
                                    <span class="timeline">a week ago</span>
                                    <a href=""><img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/></a>
                                </div>
                            </div>
                        </div>  
                        <div class="content-info-area">
                            <div class="content-img clearfix">
                                <figure>
                                    <img src="<?php echo base_url(); ?>assets_d/images/Study-Tools-bg.jpg" alt="Image"/>
                                </figure>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ratione deleniti pariatur quasi iure voluptates! Est eaque dolorem eius nesciunt, laudantium inventore incidunt tempore impedit error voluptates, recusandae corrupti, esse consequatur!</p>
                            </div>
                        </div>
                        <div class="like-comment-wrap">
                            <div class="like-wrap">
                                <ul>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Icon"/></a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li>
                                </ul>
                            </div>
                            <div class="comment-wrap">
                                <ul>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/comment-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">20</a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/share-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="post-row-wrap">
                        <div class="user-top">
                            <div class="user-top-left">
                                <div class="user-img">
                                    <figure>
                                        <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="Image"/>
                                    </figure>
                                </div>
                                <div class="user-name-wrap">
                                    <h3>Lorem Ipsum</h3>
                                    <div class="badgeList">
                                        <ul>
                                            <li class="badge badge1">
                                                <a href="">University of Florida</a>
                                            </li>
                                            <li class="badge badge3">
                                                <a href="">
                                                    Faculty
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="user-top-right">
                                <div class="timeline-action">
                                    <span class="timeline">a week ago</span>
                                    <a href=""><img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/></a>
                                </div>
                            </div>
                        </div>  
                        <div class="content-info-area">
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ratione deleniti pariatur quasi iure voluptates! Est eaque dolorem eius nesciunt, laudantium inventore incidunt tempore impedit error voluptates, recusandae corrupti, esse consequatur!</p>
                        </div>
                        <div class="like-comment-wrap">
                            <div class="like-wrap">
                                <ul>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Icon"/></a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li>
                                </ul>
                            </div>
                            <div class="comment-wrap">
                                <ul>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/comment-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">20</a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/share-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="post-row-wrap">
                        <div class="user-top">
                            <div class="user-top-left">
                                <div class="user-img">
                                    <figure>
                                        <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="Image"/>
                                    </figure>
                                </div>
                                <div class="user-name-wrap">
                                    <h3>Lorem Ipsum</h3>
                                    <div class="badgeList">
                                        <ul>
                                            <li class="badge badge1">
                                                <a href="">University of Florida</a>
                                            </li>
                                            <li class="badge badge3">
                                                <a href="">
                                                    Faculty
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="user-top-right">
                                <div class="timeline-action">
                                    <span class="timeline">a week ago</span>
                                    <a href=""><img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/></a>
                                </div>
                            </div>
                        </div>  
                        <div class="content-info-area">
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ratione deleniti pariatur quasi iure voluptates! Est eaque dolorem eius nesciunt, laudantium inventore incidunt tempore impedit error voluptates, recusandae corrupti, esse consequatur!</p>
                        </div>
                        <div class="like-comment-wrap">
                            <div class="like-wrap">
                                <ul>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Icon"/></a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li>
                                </ul>
                            </div>
                            <div class="comment-wrap">
                                <ul>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/comment-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">20</a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/share-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="post-row-wrap">
                        <div class="user-top">
                            <div class="user-top-left">
                                <div class="user-img">
                                    <figure>
                                        <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="Image"/>
                                    </figure>
                                </div>
                                <div class="user-name-wrap">
                                    <h3>Lorem Ipsum</h3>
                                    <div class="badgeList">
                                        <ul>
                                            <li class="badge badge1">
                                                <a href="">University of Florida</a>
                                            </li>
                                            <li class="badge badge3">
                                                <a href="">
                                                    Faculty
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="user-top-right">
                                <div class="timeline-action">
                                    <span class="timeline">a week ago</span>
                                    <a href=""><img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/></a>
                                </div>
                            </div>
                        </div>  
                        <div class="content-info-area">
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ratione deleniti pariatur quasi iure voluptates! Est eaque dolorem eius nesciunt, laudantium inventore incidunt tempore impedit error voluptates, recusandae corrupti, esse consequatur!</p>
                        </div>
                        <div class="like-comment-wrap">
                            <div class="like-wrap">
                                <ul>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Icon"/></a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li>
                                </ul>
                            </div>
                            <div class="comment-wrap">
                                <ul>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/comment-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">20</a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/share-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="post-row-wrap">
                        <div class="user-top">
                            <div class="user-top-left">
                                <div class="user-img">
                                    <figure>
                                        <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="Image"/>
                                    </figure>
                                </div>
                                <div class="user-name-wrap">
                                    <h3>Lorem Ipsum</h3>
                                    <div class="badgeList">
                                        <ul>
                                            <li class="badge badge1">
                                                <a href="">University of Florida</a>
                                            </li>
                                            <li class="badge badge3">
                                                <a href="">
                                                    Faculty
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="user-top-right">
                                <div class="timeline-action">
                                    <span class="timeline">a week ago</span>
                                    <a href=""><img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/></a>
                                </div>
                            </div>
                        </div>  
                        <div class="content-info-area">
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ratione deleniti pariatur quasi iure voluptates! Est eaque dolorem eius nesciunt, laudantium inventore incidunt tempore impedit error voluptates, recusandae corrupti, esse consequatur!</p>
                        </div>
                        <div class="like-comment-wrap">
                            <div class="like-wrap">
                                <ul>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Icon"/></a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li>
                                </ul>
                            </div>
                            <div class="comment-wrap">
                                <ul>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/comment-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">20</a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/share-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="view-all-section"><a href="">View All Articles</a></div>
                </div>
				<br>
				<div class="content-card seprate-border" style="display:none;">
                    <div class="title-wrap">
                        <h3>Study Sessions</h3>
                    </div>
                    <div class="post-row-wrap">
                        <div class="user-top">
                            <div class="user-top-left">
                                <div class="user-img">
                                    <figure>
                                        <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="Image"/>
                                    </figure>
                                </div>
                                <div class="user-name-wrap">
                                    <h3>Lorem Ipsum</h3>
                                    <div class="badgeList">
                                        <ul>
                                            <li class="badge badge1">
                                                <a href="">University of Florida</a>
                                            </li>
                                            <li class="badge badge3">
                                                <a href="">
                                                    Faculty
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="user-top-right">
                                <div class="timeline-action">
                                    <span class="timeline">a week ago</span>
                                    <a href=""><img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/></a>
                                </div>
                            </div>
                        </div>  
                        <div class="content-info-area">
                            <div class="content-img clearfix">
                                <figure>
                                    <img src="<?php echo base_url(); ?>assets_d/images/Study-Tools-bg.jpg" alt="Image"/>
                                </figure>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ratione deleniti pariatur quasi iure voluptates! Est eaque dolorem eius nesciunt, laudantium inventore incidunt tempore impedit error voluptates, recusandae corrupti, esse consequatur!</p>
                                <div class="event-description">
                                    <div class="left">
                                        <img src="<?php echo base_url(); ?>assets_d/images/location.svg" alt="Location"> Location name
                                    </div>
                                    <div class="right">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets_d/images/calendar1.svg" alt="Event Time">
                                        </figure>
                                        <figcaption>July 17, 03:00 PM</figcaption>
                                        <a>Add to Calendar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="eventActionWrap">
                            <ul>
                                <li>
                                    <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
                                </li>
                                <li>
                                    <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
                                </li>
                                <li>
                                    <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
                                </li>
                                <li>
                                    <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
                                </li>
                                <li>
                                    <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
                                </li>
                                <li class="more">
                                    +5
                                </li>
                            </ul>
                            <button type="button" class="event_action"> Attend Event</button>
                        </div>
                        <div class="like-comment-wrap">
                            <div class="like-wrap">
                                <ul>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Icon"/></a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li>
                                </ul>
                            </div>
                            <div class="comment-wrap">
                                <ul>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/comment-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">20</a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/share-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="post-row-wrap">
                        <div class="user-top">
                            <div class="user-top-left">
                                <div class="user-img">
                                    <figure>
                                        <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="Image"/>
                                    </figure>
                                </div>
                                <div class="user-name-wrap">
                                    <h3>Lorem Ipsum</h3>
                                    <div class="badgeList">
                                        <ul>
                                            <li class="badge badge1">
                                                <a href="">University of Florida</a>
                                            </li>
                                            <li class="badge badge3">
                                                <a href="">
                                                    Faculty
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="user-top-right">
                                <div class="timeline-action">
                                    <span class="timeline">a week ago</span>
                                    <a href=""><img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/></a>
                                </div>
                            </div>
                        </div>  
                        <div class="content-info-area">
                            <div class="content-img clearfix">
                                <figure>
                                    <img src="<?php echo base_url(); ?>assets_d/images/Study-Tools-bg.jpg" alt="Image"/>
                                </figure>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ratione deleniti pariatur quasi iure voluptates! Est eaque dolorem eius nesciunt, laudantium inventore incidunt tempore impedit error voluptates, recusandae corrupti, esse consequatur!</p>
                                <div class="event-description">
                                    <div class="left">
                                        <img src="<?php echo base_url(); ?>assets_d/images/location.svg" alt="Location"> Location name
                                    </div>
                                    <div class="right">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets_d/images/calendar1.svg" alt="Event Time">
                                        </figure>
                                        <figcaption>July 17, 03:00 PM</figcaption>
                                        <a>Add to Calendar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="eventActionWrap">
                            <ul>
                                <li>
                                    <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
                                </li>
                                <li>
                                    <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
                                </li>
                                <li>
                                    <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
                                </li>
                                <li>
                                    <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
                                </li>
                                <li>
                                    <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
                                </li>
                                <li class="more">
                                    +5
                                </li>
                            </ul>
                            <button type="button" class="event_action"> Attend Event</button>
                        </div>
                        <div class="like-comment-wrap">
                            <div class="like-wrap">
                                <ul>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Icon"/></a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li>
                                </ul>
                            </div>
                            <div class="comment-wrap">
                                <ul>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/comment-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">20</a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/share-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="post-row-wrap">
                        <div class="user-top">
                            <div class="user-top-left">
                                <div class="user-img">
                                    <figure>
                                        <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="Image"/>
                                    </figure>
                                </div>
                                <div class="user-name-wrap">
                                    <h3>Lorem Ipsum</h3>
                                    <div class="badgeList">
                                        <ul>
                                            <li class="badge badge1">
                                                <a href="">University of Florida</a>
                                            </li>
                                            <li class="badge badge3">
                                                <a href="">
                                                    Faculty
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="user-top-right">
                                <div class="timeline-action">
                                    <span class="timeline">a week ago</span>
                                    <a href=""><img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/></a>
                                </div>
                            </div>
                        </div>  
                        <div class="content-info-area">
                            <div class="content-img clearfix">
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ratione deleniti pariatur quasi iure voluptates! Est eaque dolorem eius nesciunt, laudantium inventore incidunt tempore impedit error voluptates, recusandae corrupti, esse consequatur!</p>
                                <div class="event-description">
                                    <div class="left">
                                        <img src="<?php echo base_url(); ?>assets_d/images/location.svg" alt="Location"> Location name
                                    </div>
                                    <div class="right">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets_d/images/calendar1.svg" alt="Event Time">
                                        </figure>
                                        <figcaption>July 17, 03:00 PM</figcaption>
                                        <a>Add to Calendar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="eventActionWrap">
                            <ul>
                                <li>
                                    <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
                                </li>
                                <li>
                                    <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
                                </li>
                                <li>
                                    <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
                                </li>
                                <li>
                                    <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
                                </li>
                                <li>
                                    <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
                                </li>
                                <li class="more">
                                    +5
                                </li>
                            </ul>
                            <button type="button" class="event_action"> Attend Event</button>
                        </div>
                        <div class="like-comment-wrap">
                            <div class="like-wrap">
                                <ul>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Icon"/></a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li>
                                </ul>
                            </div>
                            <div class="comment-wrap">
                                <ul>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/comment-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">20</a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/share-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="view-all-section"><a href="">View All Study Sessions</a></div>
                </div>
				
				<?php
					if(empty($AllPeers) && empty($AllPosts) && empty($AllQuestions) && empty($AllDocuments) && empty($AllStudySets) && empty($AllEvents)) {
				?>
				<div class="mainContent">
					<div class="main-home-wrapper">
						<div class="noFeedWrapper">
							<figure>
								<img src="<?php echo base_url(); ?>assets_d/images/blank-feeds.png" alt="No Feed">
							</figure>
							<h4>Search result not found.</h4>
						</div>
					</div>
				</div>
				<?php		
					}
				?>
				
			</div>
            <div id="peers" class="tab-pane fade <?php if($tabType != '' && $tabType == 'peers'){ ?>in active<?php } ?>">
                <div class="content-card">
                    <div class="title-wrap">
                        <h3>Peers</h3>
                    </div>
                    <div class="peers-listing">
                        <?php
						if(!empty($AllPeers)){
							foreach($AllPeers as $AllPeer){
						?>
                        <div class="peers-row">
                            <div class="peer-left-info">
                                <div class="peers-img-wrap" style="cursor:pointer;" onclick="window.location.href='<?php echo base_url('sp/'.$AllPeer['username']); ?>'">
                                    <img src="<?php echo $AllPeer['UserProfile']; ?>" alt="Image"/>
                                </div>
                                <div class="basic-info">
                                    <h3 style="cursor:pointer;" onclick="window.location.href='<?php echo base_url('sp/'.$AllPeer['username']); ?>'"><?php echo $AllPeer['full_name']; ?></h3>
                                    <ul>
                                        <li><?php echo $AllPeer['UniversityName']; ?></li>
                                        <li><?php echo $AllPeer['LocationName']; ?></li>
                                        <li><a href=""><?php echo $AllPeer['totalFollower']; ?></a> followers</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="peer-right-info">
                                <ul>
                                    <li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/chat-red.svg" alt="Image" data-name="<?php echo $AllPeer['full_name']; ?>" data-groupId="0" data-id="<?php echo $AllPeer['id']; ?>" class="open-single-chat-window" /></a></li>
									
									<?php
										if($AllPeer['isFollowing'] == 1){
									?>
									<li><a href="javascript:;" class="follow_now follow_<?php echo $AllPeer['id']; ?>" data-id="<?php echo $AllPeer['id']; ?>" id="0">UnFollow</a></li>
									<?php		
										} else {
									?>
									<li><a href="javascript:;" class="follow_now follow_<?php echo $AllPeer['id']; ?>" data-id="<?php echo $AllPeer['id']; ?>" id="1">Follow</a></li>
									<?php		
										}
									?>
                                    <!--li><a href="javascript:;" onclick="alert('Work in progress');">Peer</a></li-->
                                </ul>
                            </div>
                        </div>
						<?php
							}
						} else {
						?>
						<div class="mainContent">
							<div class="main-home-wrapper">
                                <div class="noFeedWrapper">
                                    <figure>
                                        <img src="<?php echo base_url(); ?>assets_d/images/blank-feeds.png" alt="No Feed">
                                    </figure>
                                    <h4>Search result not found.</h4>
                                </div>
							</div>
						</div>
						<?php	
						}
						?>
                    </div>
					<?php
						if(!empty($AllPeers)){
					?>
                    <div class="view-all-section"><a href="<?php echo base_url('account/searchViewAll/peers'); ?>">View All Peers</a></div>
					<?php
						}
					?>
                </div>
                <!--div class="pagination-wrap">
                    <div class="prev-arrow">
                        <a href=""><img src="<?php echo base_url(); ?>assets_d/images/prev.svg" alt="Prev Icon"/></a>
                    </div>
                    <ul class="pagination">
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">6</a></li>
                        <li><a href="#">7</a></li>
                        <li><a href="#">8</a></li>
                        <li><a href="#">9</a></li>
                        <li><a href="#">10</a></li>
                    </ul>
                    <div class="next-arrow">
                        <a href=""><img src="<?php echo base_url(); ?>assets_d/images/next.svg" alt="Next Icon"/></a>
                    </div>
                </div-->
            </div>
            <div id="posts" class="tab-pane fade <?php if($tabType != '' && $tabType == 'posts'){ ?>in active<?php } ?>">
                <div class="content-card seprate-border">
                    <div class="title-wrap">
                        <h3>Posts</h3>
                    </div>
					<?php
						if(!empty($AllPosts)){
							foreach($AllPosts as $AllPost) {
					?>
                    <div class="post-row-wrap">
                        <div class="user-top">
                            <div class="user-top-left">
                                <div class="user-img" style="cursor:pointer;" onclick="window.location.href='<?php echo base_url('sp/'.$AllPost['username']); ?>'">
                                    <figure>
                                        <img src="<?php echo $AllPost['profile_picture']; ?>" alt="Image"/>
                                    </figure>
                                </div>
                                <div class="user-name-wrap">
                                    <h3 style="cursor:pointer;" onclick="window.location.href='<?php echo base_url('sp/'.$AllPost['username']); ?>'"><?php echo $AllPost['fullname']; ?></h3>
                                    <div class="badgeList">
                                        <ul>
                                            <li class="badge badge1">
                                                <a href=""><?php echo $AllPost['UniversityName']; ?></a>
                                            </li>
                                            <li class="badge badge3">
                                                <a href="">
                                                    Faculty
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="user-top-right">
                                <div class="timeline-action">
                                    <span class="timeline"><?php echo $AllPost['posted_date']; ?></span>
                                    <!--a href=""><img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/></a-->
									&nbsp;&nbsp;&nbsp;
									<div class="dropdown">
										<i class="dropdown-toggle" data-toggle="dropdown">
											<img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/>
										</i>
										<ul class="dropdown-menu" style="right: 0;left: auto;top: 0px;">
											<li class="removePeerSugg">
												<a href="javascript:;" class="reportThings" data-reportType="POSTS" data-currentPage="searchResult" data-primaryId="<?php echo $AllPost['post_id']; ?>">Report</a>
											</li>
										</ul>
									</div>
                                </div>
                            </div>
                        </div>  
                        <div class="content-info-area">
                            <div class="content-img clearfix">
								<?php
								if($AllPost['post_image'] != ''){
								?>
									<figure>
										<img src="<?php echo $AllPost['post_image'];?>" alt="Image"/>
									</figure>
								<?php
								} else if($AllPost['post_video'] != ''){
								?>
									<figure>
										<video width="320" height="240" controls>
											<source src="<?php echo $AllPost['post_video']; ?>" type="video/mp4">
										</video>
									</figure>
								<?php	
								}
								?>
                                <p><?php echo $AllPost['post_content_html']; ?></p>
                            </div>
                        </div>
                        <div class="like-comment-wrap">
                            <div class="like-wrap">
                                <ul>
									<?php
										if(!empty($AllPost['reactions_ids'])){
											foreach($AllPost['reactions_ids'] as $reactions_id){
												if($reactions_id == 1) {
										?>
										<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Like"></a></li>
										<?php			
												} else if($reactions_id == 2) {
										?>
										<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" alt="Icon"/></a></li>
										<?php			
												} else if($reactions_id == 3) {
										?>
										<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/celebrate-dashboard.svg" alt="Icon"></a></li>
										<?php			
												} else if($reactions_id == 4) {
										?>
										<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/curious-dashboard.svg" alt="Icon"></a></li>
										<?php			
												} else if($reactions_id == 5) {
										?>
										<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/insight-dashboard.svg" alt="Icon"></a></li>
										<?php			
												} else if($reactions_id == 6) {
										?>
										<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/love-dashboard.svg" alt="Icon"></a></li>
										<?php			
												}
											}
										}
									?>
                                    
                                    <li><a href=""><?php echo $AllPost['total_reactions']; ?></a></li>
                                </ul>
                            </div>
                            <div class="comment-wrap">
                                <ul>
                                    <li><a href="<?php echo base_url('account/searchDetail/posts/'.base64_encode($AllPost['post_id']).'/posts/comment'); ?>"><img src="<?php echo base_url(); ?>assets_d/images/comment-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="<?php echo base_url('account/searchDetail/posts/'.base64_encode($AllPost['post_id']).'/posts/comment'); ?>"><?php echo $AllPost['total_comments']; ?></a></li>
                                    <!--li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/share-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li-->
									
									<li>&nbsp;</li>
									<li>
										<div class="action">
											<div class="action_button">
												<a href="<?php echo base_url('account/searchDetail/posts/'.base64_encode($AllPost['post_id']).'/posts'); ?>">
													<svg class="sp-icon sp-icon--rotate-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490"><path d="M481.3,110.1c-11.6-11.6-30.4-11.6-42.1,0L245,304.4L50.8,110.2c-11.6-11.6-30.4-11.6-42.1,0c-11.6,11.6-11.6,30.4,0,42.1l236.4,236.4l236.2-236.4C492.9,140.6,492.9,121.7,481.3,110.1z"></path>
													</svg>
												</a>
											</div>
										</div>
									</li>
                                </ul>
                            </div>
                        </div>
                    </div>
					<?php
							}
						} else {
					?>
					<div class="mainContent">
						<div class="main-home-wrapper">
                            <div class="noFeedWrapper">
                                <figure>
                                    <img src="<?php echo base_url(); ?>assets_d/images/blank-feeds.png" alt="No Feed">
                                </figure>
                                <h4>Search result not found.</h4>
                            </div>
						</div>
					</div>
					<?php
						}
						
						if(!empty($AllPosts)){
					?>
                    <div class="view-all-section"><a href="<?php echo base_url('account/searchViewAll/posts'); ?>">View All Posts</a></div>
					<?php
						}
					?>
                </div>
            </div>
            <div id="questions" class="tab-pane fade <?php if($tabType != '' && $tabType == 'questions'){ ?>in active<?php } ?>">
                <div class="content-card seprate-border">
                    <div class="title-wrap">
                        <h3>Questions</h3>
                    </div>
					<?php
					if(!empty($AllQuestions)){
						foreach($AllQuestions as $AllQuestion) {
					?>
                    <div class="post-row-wrap">
                        <div class="user-top">
                            <div class="user-top-left">
                                <div class="user-img" style="cursor:pointer;" onclick="window.location.href='<?php echo base_url('sp/'.$AllQuestion['username']); ?>'">
                                    <figure>
                                        <img src="<?php echo $AllQuestion['profile_picture']; ?>" alt="Image"/>
                                    </figure>
                                </div>
                                <div class="user-name-wrap">
                                    <h3 style="cursor:pointer;" onclick="window.location.href='<?php echo base_url('sp/'.$AllQuestion['username']); ?>'"><?php echo $AllQuestion['username']; ?></h3>
                                    <div class="badgeList">
                                        <ul>
                                            <li class="badge badge1">
                                                <a href=""><?php echo $AllQuestion['UniversityName']; ?></a>
                                            </li>
                                            <li class="badge badge3">
                                                <a href="">
                                                    Faculty
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="user-top-right">
                                <div class="timeline-action">
                                    <span class="timeline"><?php echo $AllQuestion['post_at']; ?></span>
                                    <!--a href=""><img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/></a-->
									&nbsp;&nbsp;&nbsp;
									<div class="dropdown">
										<i class="dropdown-toggle" data-toggle="dropdown">
											<img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/>
										</i>
										<ul class="dropdown-menu" style="right: 0;left: auto;top: 0px;">
											<li class="removePeerSugg">
												<a href="javascript:;" class="reportThings" data-reportType="QUESTIONS" data-currentPage="searchResult" data-primaryId="<?php echo $AllQuestion['question_id']; ?>">Report</a>
											</li>
										</ul>
									</div>
                                </div>
                            </div>
                        </div>  
                        <div class="content-info-area">
							 <b><?php echo $AllQuestion['question_title']; ?></b>
                            <p><?php echo $AllQuestion['question_description']; ?></p>
                        </div>
                        <div class="like-comment-wrap">
                            <div class="like-wrap">
                                <ul>
                                    <li>
										<svg xmlns="http://www.w3.org/2000/svg"  class="activeState" width="18.363" height="20" viewBox="0 0 18.363 20">
											<g id="prefix__up-arrow" transform="translate(-31.008 -10.925)">
												<path id="prefix__Path_1209" d="M37.272 29.256h5.6v-9.1a.83.83 0 0 1 .828-.833h2.828l-6.358-6.387-6.35 6.383h2.62a.83.83 0 0 1 .828.833v9.1zm6.428 1.669h-7.26a.83.83 0 0 1-.828-.833v-9.1H31.82a.844.844 0 0 1-.588-1.424l8.358-8.4a.845.845 0 0 1 1.171 0l8.354 8.4a.823.823 0 0 1-.588 1.424h-4v9.1a.825.825 0 0 1-.827.833z" data-name="Path 1209" />
											</g>
										</svg>
									</li>
										<a href="javascript:;"><?php echo $AllQuestion['vote_count']; ?></a>
                                    <li>
									</li>
                                    <li>
										<svg xmlns="http://www.w3.org/2000/svg"  class="activeState" width="18.363" height="20" viewBox="0 0 18.363 20">
											<g id="prefix__Layer_1" transform="rotate(180 24.686 15.463)">
												<g id="prefix__Group_1371" data-name="Group 1371" transform="translate(31.008 10.925)">
													<path id="prefix__Path_1213" d="M43.7 30.925h-7.26a.83.83 0 0 1-.828-.833v-9.1H31.82a.844.844 0 0 1-.588-1.424l8.358-8.4a.845.845 0 0 1 1.171 0l8.354 8.4a.823.823 0 0 1-.588 1.424h-4v9.1a.825.825 0 0 1-.828.833z" data-name="Path 1213" transform="translate(-31.008 -10.925)" />
												</g>
											</g>
										</svg>
									</li>
                                </ul>
                            </div>
                            <div class="comment-wrap">
                                <ul>
                                    <li><a href="<?php echo base_url('account/questionDetail/'.base64_encode($AllQuestion['question_id']).'/search/questions'); ?>"><img src="<?php echo base_url(); ?>assets_d/images/views.svg" alt="Icon"/></a></li>
                                    <li><a href="<?php echo base_url('account/questionDetail/'.base64_encode($AllQuestion['question_id']).'/search/questions'); ?>"><?php echo $AllQuestion['view_count']; ?></a></li>
                                    <li><a href="<?php echo base_url('account/questionDetail/'.base64_encode($AllQuestion['question_id']).'/search/questions'); ?>"><img src="<?php echo base_url(); ?>assets_d/images/answer.svg" alt="Icon"/></a></li>
                                    <li><a href="<?php echo base_url('account/questionDetail/'.base64_encode($AllQuestion['question_id']).'/search/questions'); ?>"><?php echo $AllQuestion['answer_count']; ?></a></li>
                                    <!--li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/share-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li-->
									
									<li>&nbsp;</li>
									<li>
										<div class="action">
											<div class="action_button">
												<a href="<?php echo base_url('account/questionDetail/'.base64_encode($AllQuestion['question_id']).'/search/questions'); ?>">
													<svg class="sp-icon sp-icon--rotate-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490"><path d="M481.3,110.1c-11.6-11.6-30.4-11.6-42.1,0L245,304.4L50.8,110.2c-11.6-11.6-30.4-11.6-42.1,0c-11.6,11.6-11.6,30.4,0,42.1l236.4,236.4l236.2-236.4C492.9,140.6,492.9,121.7,481.3,110.1z"></path>
													</svg>
												</a>
											</div>
										</div>
									</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php
						}
					} else {
					?>
					<div class="mainContent">
						<div class="main-home-wrapper">
                            <div class="noFeedWrapper">
                                <figure>
                                    <img src="<?php echo base_url(); ?>assets_d/images/blank-feeds.png" alt="No Feed">
                                </figure>
                                <h4>Search result not found.</h4>
                            </div>
						</div>
					</div>
					<?php	
					}
					
					if(!empty($AllQuestions)){
					?>
                    <div class="view-all-section"><a href="<?php echo base_url('account/searchViewAll/questions'); ?>">View All Questions</a></div>
					<?php
					}
					?>
                </div>
            </div>
            <div id="documents" class="tab-pane fade <?php if($tabType != '' && $tabType == 'documents'){ ?>in active<?php } ?>">
                <div class="content-card seprate-border">
                    <div class="title-wrap">
                        <h3>Documents</h3>
                    </div>
					<?php
						if(!empty($AllDocuments)){
							foreach($AllDocuments as $AllDocument){
					?>
						<div class="post-row-wrap">
							<div class="user-top">
								<div class="user-top-left">
									<div class="user-img" style="cursor:pointer;" onclick="window.location.href='<?php echo base_url('sp/'.$AllDocument['username']); ?>'">
										<figure>
											<img src="<?php echo $AllDocument['profile_picture']; ?>" alt="Image"/>
										</figure>
									</div>
									<div class="user-name-wrap">
										<h3 style="cursor:pointer;" onclick="window.location.href='<?php echo base_url('sp/'.$AllDocument['username']); ?>'"><?php echo $AllDocument['fullname']; ?></h3>
										<div class="badgeList">
											<ul>
												<li class="badge badge1">
													<a href=""><?php echo $AllDocument['UniversityName']; ?></a>
												</li>
												<li class="badge badge3">
													<a href="">
														Faculty
													</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="user-top-right">
									<div class="timeline-action">
										<span class="timeline"><?php echo $AllDocument['post_at']; ?></span>
										<!--a href=""><img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/></a-->
										&nbsp;&nbsp;&nbsp;
										<div class="dropdown">
											<i class="dropdown-toggle" data-toggle="dropdown">
												<img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/>
											</i>
											<ul class="dropdown-menu" style="right: 0;left: auto;top: 0px;">
												<li class="removePeerSugg">
													<a href="javascript:;" class="reportThings" data-reportType="DOCUMENTS" data-currentPage="searchResult" data-primaryId="<?php echo $AllDocument['document_id']; ?>">Report</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>  
							<div class="content-info-area">
								<b><?php echo $AllDocument['document_name']; ?></b>
								<p><?php echo $AllDocument['description']; ?></p>
								<div class="documentName">
									<?php
										if($AllDocument['document_file'] != ''){
											$ExplodedFileName = explode(".",$AllDocument['document_file']);
											
											if(strtolower($ExplodedFileName[1]) == 'pdf'){
										?>
											<img src="<?php echo base_url(); ?>/assets_d/images/application_pdf.svg" alt="pdf"> 
										<?php		
											} else if(strtolower($ExplodedFileName[1]) == 'docx') {
										?>
											<img src="<?php echo base_url(); ?>/assets_d/images/application_vnd.openxmlformats-officedocument.wordprocessingml.document.svg" style="width: 30px;" alt="doc"> 
										<?php		
											} else if(strtolower($ExplodedFileName[1]) == 'doc') {
										?>
											<img src="<?php echo base_url(); ?>/assets_d/images/application_vnd.openxmlformats-officedocument.wordprocessingml.document.svg" style="width: 30px;" alt="doc"> 
										<?php		
											} else if(strtolower($ExplodedFileName[1]) == 'png') {
										?>
										<img src="<?php echo base_url(); ?>/assets_d/images/file.svg" alt="pdf"> 
										<?php		
											} else if(strtolower($ExplodedFileName[1]) == 'xls') {
										?>
										<img src="<?php echo base_url(); ?>/assets_d/images/xlsx@2x.png" style="width: 30px;" alt="text"> 
										<?php		
											} else if(strtolower($ExplodedFileName[1]) == 'csv') {
										?>
										<img src="<?php echo base_url(); ?>/assets_d/images/file.svg" alt="csv"> 
										<?php		
											} else if(strtolower($ExplodedFileName[1]) == 'txt') {
										?>
										<img src="<?php echo base_url(); ?>/assets_d/images/txt@2x.png" style="width: 30px;" alt="text"> 
										<?php		
											} else if(strtolower($ExplodedFileName[1]) == 'pptx') {
										?>
										<img src="<?php echo base_url(); ?>/assets_d/images/pptx@2x.png" style="width: 30px;" alt="pptx"> 
										<?php		
											}
										?>
									<a href="<?php echo $AllDocument['document_link']; ?>" download><?php echo $AllDocument['document_file']; ?></a>
									<?php
										}
									?>
								</div>
							</div>
							<div class="like-comment-wrap">
								<div class="like-wrap">
									<ul>
										<?php
											if(!empty($AllDocument['reactions_ids'])){
												foreach($AllDocument['reactions_ids'] as $reactions_id){
													if($reactions_id == 1) {
											?>
											<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Like"></a></li>
											<?php			
													} else if($reactions_id == 2) {
											?>
											<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" alt="Icon"/></a></li>
											<?php			
													} else if($reactions_id == 3) {
											?>
											<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/celebrate-dashboard.svg" alt="Icon"></a></li>
											<?php			
													} else if($reactions_id == 4) {
											?>
											<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/curious-dashboard.svg" alt="Icon"></a></li>
											<?php			
													} else if($reactions_id == 5) {
											?>
											<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/insight-dashboard.svg" alt="Icon"></a></li>
											<?php			
													} else if($reactions_id == 6) {
											?>
											<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/love-dashboard.svg" alt="Icon"></a></li>
											<?php			
													}
												}
											}
										?>
										<?php
										if(!empty($AllDocument['reactions_ids'])){
										?>
										<li><a href="javascript:;"><?php echo $AllDocument['total_reactions']; ?></a></li>
										<?php
										} else {
										?>
										<li><a href="javascript:;">&nbsp;&nbsp;</a></li>	
										<li><a href="javascript:;">&nbsp;&nbsp;</a></li>
										<?php	
										}
										?>
									</ul>
								</div>
								<div class="star-rating">
									<ul>
										<?php
											for($i = 1;$i <= $AllDocument['avgRatings'];$i++){
										?>
										<li>
											<a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
										</li>
										<?php
											}
										?>
									</ul>
								</div>
								<div class="comment-wrap">
									<ul>
										<li><a href="<?php echo base_url('account/documentDetail/'.base64_encode($AllDocument['document_id']).'/search/documents'); ?>"><img src="<?php echo base_url(); ?>assets_d/images/comment-grey.svg" alt="Icon"/></a></li>
										<li><a href="<?php echo base_url('account/documentDetail/'.base64_encode($AllDocument['document_id']).'/search/documents'); ?>"><?php echo $AllDocument['total_comments']; ?></a></li>
										<!--li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/share-grey.svg" alt="Icon"/></a></li>
										<li><a href="">24</a></li-->
										
										<li>&nbsp;</li>
										<li>
											<div class="action">
												<div class="action_button">
													<a href="<?php echo base_url('account/documentDetail/'.base64_encode($AllDocument['document_id']).'/search/documents'); ?>">
														<svg class="sp-icon sp-icon--rotate-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490"><path d="M481.3,110.1c-11.6-11.6-30.4-11.6-42.1,0L245,304.4L50.8,110.2c-11.6-11.6-30.4-11.6-42.1,0c-11.6,11.6-11.6,30.4,0,42.1l236.4,236.4l236.2-236.4C492.9,140.6,492.9,121.7,481.3,110.1z"></path>
														</svg>
													</a>
												</div>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<?php
							}
						} else {
					?>
					<div class="mainContent">
						<div class="main-home-wrapper">
                            <div class="noFeedWrapper">
                                <figure>
                                    <img src="<?php echo base_url(); ?>assets_d/images/blank-feeds.png" alt="No Feed">
                                </figure>
                                <h4>Search result not found.</h4>
                            </div>
						</div>
					</div>
					<?php		
						}
						
						if(!empty($AllDocuments)){
					?>
                    <div class="view-all-section"><a href="<?php echo base_url('account/searchViewAll/documents'); ?>">View All Documents</a></div>
					<?php
						}
					?>
                </div>
            </div>
            <div id="studySets" class="tab-pane fade <?php if($tabType != '' && $tabType == 'studySets'){ ?>in active<?php } ?>">
                <div class="content-card seprate-border">
                    <div class="title-wrap">
                        <h3>Study Sets</h3>
                    </div>
					<?php
						if(!empty($AllStudySets)){
							foreach($AllStudySets as $AllStudySet){
					?>
					<div class="post-row-wrap">
                        <div class="user-top">
                            <div class="user-top-left">
                                <div class="user-img" style="cursor:pointer;" onclick="window.location.href='<?php echo base_url('sp/'.$AllStudySet['username']); ?>'">
                                    <figure>
                                        <img src="<?php echo $AllStudySet['profile_picture']; ?>" alt="Image"/>
                                    </figure>
                                </div>
                                <div class="user-name-wrap">
                                    <h3 style="cursor:pointer;" onclick="window.location.href='<?php echo base_url('sp/'.$AllStudySet['username']); ?>'"><?php echo $AllStudySet['fullname']; ?></h3>
                                    <div class="badgeList">
                                        <ul>
                                            <li class="badge badge1">
                                                <a href=""><?php echo $AllStudySet['UniversityName']; ?></a>
                                            </li>
                                            <li class="badge badge3">
                                                <a href="">
                                                    Faculty
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="user-top-right">
                                <div class="timeline-action">
                                    <span class="timeline"><?php echo $AllStudySet['post_at']; ?></span>
                                    <!--a href=""><img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/></a-->
									&nbsp;&nbsp;&nbsp;
									<div class="dropdown">
										<i class="dropdown-toggle" data-toggle="dropdown">
											<img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/>
										</i>
										<ul class="dropdown-menu" style="right: 0;left: auto;top: 0px;">
											<li class="removePeerSugg">
												<a href="javascript:;" class="reportThings" data-reportType="STUDYSET" data-currentPage="searchResult" data-primaryId="<?php echo $AllStudySet['studyset_id']; ?>">Report</a>
											</li>
										</ul>
									</div>
                                </div>
                            </div>
                        </div>  
                        <div class="content-info-area">
                            <div class="content-img clearfix">
								<?php
									if($AllStudySet['studyset_cover'] != ''){
								?>
                                <figure>
                                    <img src="<?php echo $AllStudySet['studyset_cover']; ?>" alt="Image"/>
                                </figure>
								<?php
									}
								?>
                                <p><?php echo $AllStudySet['studyset_name']; ?></p>
                            </div>
                        </div>
                        <div class="like-comment-wrap">
                            <div class="like-wrap">
                                <?php
									if(!empty($AllStudySet['reactions_ids'])){
										foreach($AllStudySet['reactions_ids'] as $reactions_id){
											if($reactions_id == 1) {
									?>
									<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Like"></a></li>
									<?php			
											} else if($reactions_id == 2) {
									?>
									<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" alt="Icon"/></a></li>
									<?php			
											} else if($reactions_id == 3) {
									?>
									<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/celebrate-dashboard.svg" alt="Icon"></a></li>
									<?php			
											} else if($reactions_id == 4) {
									?>
									<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/curious-dashboard.svg" alt="Icon"></a></li>
									<?php			
											} else if($reactions_id == 5) {
									?>
									<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/insight-dashboard.svg" alt="Icon"></a></li>
									<?php			
											} else if($reactions_id == 6) {
									?>
									<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/love-dashboard.svg" alt="Icon"></a></li>
									<?php			
											}
										}
									}
								?>
							<?php
								if(!empty($AllStudySet['reactions_ids'])){
							?>
								<li><a href="javascript:;"><?php echo $AllStudySet['total_reactions']; ?></a></li>
							<?php
								} else {
							?>
								<li><a href="javascript:;">&nbsp;&nbsp;</a></li>	
								<li><a href="javascript:;">&nbsp;&nbsp;</a></li>
							<?php	
								}
							?>
                            </div>
                            <div class="star-rating">
                                <ul>
									<?php
										for($i = 1;$i <= $AllStudySet['avgRatings'];$i++){
									?>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <?php
										}
									?>
                                </ul>
                            </div>
                            <div class="comment-wrap">
                                <ul>
                                    <li><a href="<?php echo base_url('studyset/details/'.$AllStudySet['studyset_id'].'/search/studySets/comment'); ?>"><img src="<?php echo base_url(); ?>assets_d/images/comment-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="<?php echo base_url('studyset/details/'.$AllStudySet['studyset_id'].'/search/studySets/comment'); ?>"><?php echo $AllStudySet['total_comments']; ?></a></li>
                                    <!--li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/share-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li-->
									
									<li>&nbsp;</li>
									<li>
										<div class="action">
											<div class="action_button">
												<a href="<?php echo base_url('studyset/details/'.$AllStudySet['studyset_id'].'/search/studySets'); ?>">
													<svg class="sp-icon sp-icon--rotate-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490"><path d="M481.3,110.1c-11.6-11.6-30.4-11.6-42.1,0L245,304.4L50.8,110.2c-11.6-11.6-30.4-11.6-42.1,0c-11.6,11.6-11.6,30.4,0,42.1l236.4,236.4l236.2-236.4C492.9,140.6,492.9,121.7,481.3,110.1z"></path>
													</svg>
												</a>
											</div>
										</div>
									</li>
                                </ul>
                            </div>
                        </div>
                    </div>
					<?php
						}
					} else {
					?>
					<div class="mainContent">
						<div class="main-home-wrapper">
                            <div class="noFeedWrapper">
                                <figure>
                                    <img src="<?php echo base_url(); ?>assets_d/images/blank-feeds.png" alt="No Feed">
                                </figure>
                                <h4>Search result not found.</h4>
                            </div>
						</div>
					</div>
					<?php	
					}
					
					if(!empty($AllStudySets)){
					?>
                    <div class="view-all-section"><a href="<?php echo base_url('account/searchViewAll/studysets'); ?>">View All Study Sets</a></div>
					<?php
					}
					?>
                </div>
            </div>
            <div id="events" class="tab-pane fade <?php if($tabType != '' && $tabType == 'events'){ ?>in active<?php } ?>">
                <div class="content-card seprate-border">
                    <div class="title-wrap">
                        <h3>Events</h3>
                    </div>
					<?php
						if(!empty($AllEvents)){
							foreach($AllEvents as $AllEvent){
					?>
						<div class="post-row-wrap">
							<div class="user-top">
								<div class="user-top-left">
									<div class="user-img" style="cursor:pointer;" onclick="window.location.href='<?php echo base_url('sp/'.$AllEvent['username']); ?>'">
										<figure>
											<img src="<?php echo $AllEvent['profile_picture']; ?>" alt="Image"/>
										</figure>
									</div>
									<div class="user-name-wrap">
										<h3 style="cursor:pointer;" onclick="window.location.href='<?php echo base_url('sp/'.$AllEvent['username']); ?>'"><?php echo $AllEvent['fullname']; ?></h3>
										<div class="badgeList">
											<ul>
												<li class="badge badge1">
													<a href="javascript:;"><?php echo $AllEvent['UniversityName']; ?></a>
												</li>
												<li class="badge badge3">
													<a href="">
														Faculty
													</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="user-top-right">
									<div class="timeline-action">
										<span class="timeline"><?php echo $AllEvent['post_at']; ?></span>
										<!--a href=""><img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/></a-->
										&nbsp;&nbsp;&nbsp;
										<div class="dropdown">
											<i class="dropdown-toggle" data-toggle="dropdown">
												<img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/>
											</i>
											<ul class="dropdown-menu" style="right: 0;left: auto;top: 0px;">
												<li class="removePeerSugg">
													<a href="javascript:;" class="reportThings" data-reportType="EVENTS" data-currentPage="searchResult" data-primaryId="<?php echo $AllEvent['event_primary_id']; ?>">Report</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>  
							<div class="content-info-area">
								<div class="content-img clearfix">
									<?php
										if($AllEvent['featured_image'] != ''){
									?>
									<figure>
										<img src="<?php echo $AllEvent['featured_image']; ?>" alt="Image"/>
									</figure>
									<?php
										}
									?>
									<p><?php echo $AllEvent['event_description']; ?></p>
									<div class="event-description">
										<div class="left">
											<img src="<?php echo base_url(); ?>assets_d/images/location.svg" alt="Location"> <?php echo $AllEvent['event_location']; ?>
										</div>
										<div class="right">
											<figure>
												<img src="<?php echo base_url(); ?>assets_d/images/calendar1.svg" alt="Event Time">
											</figure>
											<figcaption><?php echo $AllEvent['event_time']; ?></figcaption>
											<?php
												$isEventScheduled = $this->db->get_where('schedule_master', array('event_master_id' => $AllEvent['event_primary_id'], 'status' => 1,'created_by' => $CurrentUserID))->row_array();
												
												if(!empty($isEventScheduled)){
											?>
											<a href="#" class="removeEvent" data-id="<?php echo $AllEvent['event_primary_id']; ?>" data-toggle="modal" data-target="#removeFromScheduleModal">Remove From Calendar</a>
											<?php		
												} else {
											?>
											<a href="#" class="addEvents" data-id="<?php echo $AllEvent['event_primary_id']; ?>" data-toggle="modal" data-target="#addEventModal">Add to Calendar</a>
											<?php		
												}
											?>
										</div>
									</div>
								</div>
							</div>
							<div class="eventActionWrap">
								<ul>
									<?php
										$peerAttending = $this->db->get_where('share_master', array('reference_id' => $AllEvent['event_primary_id'], 'reference' => 'event', 'status' => 2))->result_array();
										
										$totalAttendingPeer = 0;
										if(!empty($peerAttending)){
											$totalAttendingPeer = count($peerAttending);
											$i = 0;
											foreach($peerAttending as $peerAttendingData){
												$i++;
												if($i <= 5){
									?>
									<li>
										<img src="<?php echo userImage($peerAttendingData['peer_id']); ?>" alt="user">
									</li>
									<?php
												}
											}
										}
										
										if($totalAttendingPeer > 5){
									?>
									<li class="more">
										+<?php echo $totalAttendingPeer-5; ?>
									</li>
									<?php
										}
									?>
								</ul>
								<?php
									$this->db->order_by('share_master.id', 'desc');
									$attendEvent = $this->db->get_where('share_master', array('reference_id' => $AllEvent['event_primary_id'], 'reference' => 'event', 'peer_id' => $CurrentUserID))->row_array(); 
								?>
								<button type="button" class="event_action attendEvent" data-toggle="modal" data-target="#confirmationModalAttend" data-id="<?php echo $AllEvent['event_primary_id']; ?>"> 
									<span class="attend_text_<?php echo $AllEvent['event_primary_id']; ?>" id="attend_text_<?php echo $AllEvent['event_primary_id']; ?>"><?php echo (!empty($attendEvent) && $attendEvent['status'] == 2) ? 'Unattend' : 'Attend';?></span> Event
								</button>
							</div>
							<div class="like-comment-wrap">
								<div class="like-wrap">
									<ul>
										<?php
											if(!empty($AllEvent['reactions_ids'])){
												foreach($AllEvent['reactions_ids'] as $reactions_id){
													if($reactions_id == 1) {
											?>
											<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Like"></a></li>
											<?php			
													} else if($reactions_id == 2) {
											?>
											<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" alt="Icon"/></a></li>
											<?php			
													} else if($reactions_id == 3) {
											?>
											<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/celebrate-dashboard.svg" alt="Icon"></a></li>
											<?php			
													} else if($reactions_id == 4) {
											?>
											<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/curious-dashboard.svg" alt="Icon"></a></li>
											<?php			
													} else if($reactions_id == 5) {
											?>
											<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/insight-dashboard.svg" alt="Icon"></a></li>
											<?php			
													} else if($reactions_id == 6) {
											?>
											<li><a href="javascript:;"><img src="<?php echo base_url(); ?>assets_d/images/love-dashboard.svg" alt="Icon"></a></li>
											<?php			
													}
												}
											}
										
											if(!empty($AllEvent['reactions_ids'])){
										?>
											<li><a href="javascript:;"><?php echo $AllEvent['total_reactions']; ?></a></li>
										<?php
											} else {
										?>
											<li><a href="javascript:;">&nbsp;&nbsp;</a></li>	
											<li><a href="javascript:;">&nbsp;&nbsp;</a></li>
										<?php	
											}
										?>
									</ul>
								</div>
								<div class="comment-wrap">
									<ul>
										<li><a href="<?php echo base_url('account/eventDetails/'.base64_encode($AllEvent['event_primary_id']).'/search/events'); ?>"><img src="<?php echo base_url(); ?>assets_d/images/comment-grey.svg" alt="Icon"/></a></li>
										<li><a href="<?php echo base_url('account/eventDetails/'.base64_encode($AllEvent['event_primary_id']).'/search/events'); ?>"><?php echo $AllEvent['total_comments']; ?></a></li>
										<!--li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/share-grey.svg" alt="Icon"/></a></li>
										<li><a href="">24</a></li-->
										
										<li>&nbsp;</li>
										<li>
											<div class="action">
												<div class="action_button">
													<a href="<?php echo base_url('account/eventDetails/'.base64_encode($AllEvent['event_primary_id']).'/search/events'); ?>">
														<svg class="sp-icon sp-icon--rotate-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 490 490"><path d="M481.3,110.1c-11.6-11.6-30.4-11.6-42.1,0L245,304.4L50.8,110.2c-11.6-11.6-30.4-11.6-42.1,0c-11.6,11.6-11.6,30.4,0,42.1l236.4,236.4l236.2-236.4C492.9,140.6,492.9,121.7,481.3,110.1z"></path>
														</svg>
													</a>
												</div>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
                    <?php 
							}
						} else {
						?>
						<div class="mainContent">
							<div class="main-home-wrapper">
                                <div class="noFeedWrapper">
                                    <figure>
                                        <img src="<?php echo base_url(); ?>assets_d/images/blank-feeds.png" alt="No Feed">
                                    </figure>
                                    <h4>Search result not found.</h4>
                                </div>
							</div>
						</div>
						<?php	
						}
						
						if(!empty($AllEvents)){
					?>
                    <div class="view-all-section"><a href="<?php echo base_url('account/searchViewAll/events'); ?>">View All Events</a></div>
					<?php
						}
					?>
                </div>
            </div>
			
            <div id="articles" class="tab-pane fade" style="display:none;">
                <div class="content-card seprate-border">
                    <div class="title-wrap">
                        <h3>Articles</h3>
                    </div>
                    <div class="post-row-wrap">
                        <div class="user-top">
                            <div class="user-top-left">
                                <div class="user-img">
                                    <figure>
                                        <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="Image"/>
                                    </figure>
                                </div>
                                <div class="user-name-wrap">
                                    <h3>Lorem Ipsum</h3>
                                    <div class="badgeList">
                                        <ul>
                                            <li class="badge badge1">
                                                <a href="">University of Florida</a>
                                            </li>
                                            <li class="badge badge3">
                                                <a href="">
                                                    Faculty
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="user-top-right">
                                <div class="timeline-action">
                                    <span class="timeline">a week ago</span>
                                    <a href=""><img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/></a>
                                </div>
                            </div>
                        </div>  
                        <div class="content-info-area">
                            <div class="content-img clearfix">
                                <figure>
                                    <img src="<?php echo base_url(); ?>assets_d/images/Study-Tools-bg.jpg" alt="Image"/>
                                </figure>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ratione deleniti pariatur quasi iure voluptates! Est eaque dolorem eius nesciunt, laudantium inventore incidunt tempore impedit error voluptates, recusandae corrupti, esse consequatur!</p>
                            </div>
                        </div>
                        <div class="like-comment-wrap">
                            <div class="like-wrap">
                                <ul>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Icon"/></a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li>
                                </ul>
                            </div>
                            <div class="comment-wrap">
                                <ul>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/comment-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">20</a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/share-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="post-row-wrap">
                        <div class="user-top">
                            <div class="user-top-left">
                                <div class="user-img">
                                    <figure>
                                        <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="Image"/>
                                    </figure>
                                </div>
                                <div class="user-name-wrap">
                                    <h3>Lorem Ipsum</h3>
                                    <div class="badgeList">
                                        <ul>
                                            <li class="badge badge1">
                                                <a href="">University of Florida</a>
                                            </li>
                                            <li class="badge badge3">
                                                <a href="">
                                                    Faculty
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="user-top-right">
                                <div class="timeline-action">
                                    <span class="timeline">a week ago</span>
                                    <a href=""><img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/></a>
                                </div>
                            </div>
                        </div>  
                        <div class="content-info-area">
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ratione deleniti pariatur quasi iure voluptates! Est eaque dolorem eius nesciunt, laudantium inventore incidunt tempore impedit error voluptates, recusandae corrupti, esse consequatur!</p>
                        </div>
                        <div class="like-comment-wrap">
                            <div class="like-wrap">
                                <ul>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Icon"/></a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li>
                                </ul>
                            </div>
                            <div class="comment-wrap">
                                <ul>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/comment-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">20</a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/share-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="post-row-wrap">
                        <div class="user-top">
                            <div class="user-top-left">
                                <div class="user-img">
                                    <figure>
                                        <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="Image"/>
                                    </figure>
                                </div>
                                <div class="user-name-wrap">
                                    <h3>Lorem Ipsum</h3>
                                    <div class="badgeList">
                                        <ul>
                                            <li class="badge badge1">
                                                <a href="">University of Florida</a>
                                            </li>
                                            <li class="badge badge3">
                                                <a href="">
                                                    Faculty
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="user-top-right">
                                <div class="timeline-action">
                                    <span class="timeline">a week ago</span>
                                    <a href=""><img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/></a>
                                </div>
                            </div>
                        </div>  
                        <div class="content-info-area">
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ratione deleniti pariatur quasi iure voluptates! Est eaque dolorem eius nesciunt, laudantium inventore incidunt tempore impedit error voluptates, recusandae corrupti, esse consequatur!</p>
                        </div>
                        <div class="like-comment-wrap">
                            <div class="like-wrap">
                                <ul>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Icon"/></a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li>
                                </ul>
                            </div>
                            <div class="comment-wrap">
                                <ul>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/comment-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">20</a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/share-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="post-row-wrap">
                        <div class="user-top">
                            <div class="user-top-left">
                                <div class="user-img">
                                    <figure>
                                        <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="Image"/>
                                    </figure>
                                </div>
                                <div class="user-name-wrap">
                                    <h3>Lorem Ipsum</h3>
                                    <div class="badgeList">
                                        <ul>
                                            <li class="badge badge1">
                                                <a href="">University of Florida</a>
                                            </li>
                                            <li class="badge badge3">
                                                <a href="">
                                                    Faculty
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="user-top-right">
                                <div class="timeline-action">
                                    <span class="timeline">a week ago</span>
                                    <a href=""><img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/></a>
                                </div>
                            </div>
                        </div>  
                        <div class="content-info-area">
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ratione deleniti pariatur quasi iure voluptates! Est eaque dolorem eius nesciunt, laudantium inventore incidunt tempore impedit error voluptates, recusandae corrupti, esse consequatur!</p>
                        </div>
                        <div class="like-comment-wrap">
                            <div class="like-wrap">
                                <ul>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Icon"/></a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li>
                                </ul>
                            </div>
                            <div class="comment-wrap">
                                <ul>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/comment-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">20</a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/share-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="post-row-wrap">
                        <div class="user-top">
                            <div class="user-top-left">
                                <div class="user-img">
                                    <figure>
                                        <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="Image"/>
                                    </figure>
                                </div>
                                <div class="user-name-wrap">
                                    <h3>Lorem Ipsum</h3>
                                    <div class="badgeList">
                                        <ul>
                                            <li class="badge badge1">
                                                <a href="">University of Florida</a>
                                            </li>
                                            <li class="badge badge3">
                                                <a href="">
                                                    Faculty
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="user-top-right">
                                <div class="timeline-action">
                                    <span class="timeline">a week ago</span>
                                    <a href=""><img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/></a>
                                </div>
                            </div>
                        </div>  
                        <div class="content-info-area">
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ratione deleniti pariatur quasi iure voluptates! Est eaque dolorem eius nesciunt, laudantium inventore incidunt tempore impedit error voluptates, recusandae corrupti, esse consequatur!</p>
                        </div>
                        <div class="like-comment-wrap">
                            <div class="like-wrap">
                                <ul>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Icon"/></a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li>
                                </ul>
                            </div>
                            <div class="comment-wrap">
                                <ul>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/comment-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">20</a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/share-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="view-all-section"><a href="">View All Articles</a></div>
                </div>
            </div>
            <div id="studySessions" class="tab-pane fade" style="display:none;">
                <div class="content-card seprate-border">
                    <div class="title-wrap">
                        <h3>Study Sessions</h3>
                    </div>
                    <div class="post-row-wrap">
                        <div class="user-top">
                            <div class="user-top-left">
                                <div class="user-img">
                                    <figure>
                                        <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="Image"/>
                                    </figure>
                                </div>
                                <div class="user-name-wrap">
                                    <h3>Lorem Ipsum</h3>
                                    <div class="badgeList">
                                        <ul>
                                            <li class="badge badge1">
                                                <a href="">University of Florida</a>
                                            </li>
                                            <li class="badge badge3">
                                                <a href="">
                                                    Faculty
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="user-top-right">
                                <div class="timeline-action">
                                    <span class="timeline">a week ago</span>
                                    <a href=""><img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/></a>
                                </div>
                            </div>
                        </div>  
                        <div class="content-info-area">
                            <div class="content-img clearfix">
                                <figure>
                                    <img src="<?php echo base_url(); ?>assets_d/images/Study-Tools-bg.jpg" alt="Image"/>
                                </figure>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ratione deleniti pariatur quasi iure voluptates! Est eaque dolorem eius nesciunt, laudantium inventore incidunt tempore impedit error voluptates, recusandae corrupti, esse consequatur!</p>
                                <div class="event-description">
                                    <div class="left">
                                        <img src="<?php echo base_url(); ?>assets_d/images/location.svg" alt="Location"> Location name
                                    </div>
                                    <div class="right">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets_d/images/calendar1.svg" alt="Event Time">
                                        </figure>
                                        <figcaption>July 17, 03:00 PM</figcaption>
                                        <a>Add to Calendar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="eventActionWrap">
                            <ul>
                                <li>
                                    <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
                                </li>
                                <li>
                                    <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
                                </li>
                                <li>
                                    <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
                                </li>
                                <li>
                                    <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
                                </li>
                                <li>
                                    <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
                                </li>
                                <li class="more">
                                    +5
                                </li>
                            </ul>
                            <button type="button" class="event_action"> Attend Event</button>
                        </div>
                        <div class="like-comment-wrap">
                            <div class="like-wrap">
                                <ul>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Icon"/></a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li>
                                </ul>
                            </div>
                            <div class="comment-wrap">
                                <ul>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/comment-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">20</a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/share-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="post-row-wrap">
                        <div class="user-top">
                            <div class="user-top-left">
                                <div class="user-img">
                                    <figure>
                                        <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="Image"/>
                                    </figure>
                                </div>
                                <div class="user-name-wrap">
                                    <h3>Lorem Ipsum</h3>
                                    <div class="badgeList">
                                        <ul>
                                            <li class="badge badge1">
                                                <a href="">University of Florida</a>
                                            </li>
                                            <li class="badge badge3">
                                                <a href="">
                                                    Faculty
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="user-top-right">
                                <div class="timeline-action">
                                    <span class="timeline">a week ago</span>
                                    <a href=""><img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/></a>
                                </div>
                            </div>
                        </div>  
                        <div class="content-info-area">
                            <div class="content-img clearfix">
                                <figure>
                                    <img src="<?php echo base_url(); ?>assets_d/images/Study-Tools-bg.jpg" alt="Image"/>
                                </figure>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ratione deleniti pariatur quasi iure voluptates! Est eaque dolorem eius nesciunt, laudantium inventore incidunt tempore impedit error voluptates, recusandae corrupti, esse consequatur!</p>
                                <div class="event-description">
                                    <div class="left">
                                        <img src="<?php echo base_url(); ?>assets_d/images/location.svg" alt="Location"> Location name
                                    </div>
                                    <div class="right">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets_d/images/calendar1.svg" alt="Event Time">
                                        </figure>
                                        <figcaption>July 17, 03:00 PM</figcaption>
                                        <a>Add to Calendar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="eventActionWrap">
                            <ul>
                                <li>
                                    <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
                                </li>
                                <li>
                                    <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
                                </li>
                                <li>
                                    <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
                                </li>
                                <li>
                                    <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
                                </li>
                                <li>
                                    <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
                                </li>
                                <li class="more">
                                    +5
                                </li>
                            </ul>
                            <button type="button" class="event_action"> Attend Event</button>
                        </div>
                        <div class="like-comment-wrap">
                            <div class="like-wrap">
                                <ul>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Icon"/></a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li>
                                </ul>
                            </div>
                            <div class="comment-wrap">
                                <ul>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/comment-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">20</a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/share-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="post-row-wrap">
                        <div class="user-top">
                            <div class="user-top-left">
                                <div class="user-img">
                                    <figure>
                                        <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="Image"/>
                                    </figure>
                                </div>
                                <div class="user-name-wrap">
                                    <h3>Lorem Ipsum</h3>
                                    <div class="badgeList">
                                        <ul>
                                            <li class="badge badge1">
                                                <a href="">University of Florida</a>
                                            </li>
                                            <li class="badge badge3">
                                                <a href="">
                                                    Faculty
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="user-top-right">
                                <div class="timeline-action">
                                    <span class="timeline">a week ago</span>
                                    <a href=""><img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/></a>
                                </div>
                            </div>
                        </div>  
                        <div class="content-info-area">
                            <div class="content-img clearfix">
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ratione deleniti pariatur quasi iure voluptates! Est eaque dolorem eius nesciunt, laudantium inventore incidunt tempore impedit error voluptates, recusandae corrupti, esse consequatur!</p>
                                <div class="event-description">
                                    <div class="left">
                                        <img src="<?php echo base_url(); ?>assets_d/images/location.svg" alt="Location"> Location name
                                    </div>
                                    <div class="right">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets_d/images/calendar1.svg" alt="Event Time">
                                        </figure>
                                        <figcaption>July 17, 03:00 PM</figcaption>
                                        <a>Add to Calendar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="eventActionWrap">
                            <ul>
                                <li>
                                    <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
                                </li>
                                <li>
                                    <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
                                </li>
                                <li>
                                    <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
                                </li>
                                <li>
                                    <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
                                </li>
                                <li>
                                    <img src="<?php echo base_url(); ?>assets_d/images/user.jpg" alt="user">
                                </li>
                                <li class="more">
                                    +5
                                </li>
                            </ul>
                            <button type="button" class="event_action"> Attend Event</button>
                        </div>
                        <div class="like-comment-wrap">
                            <div class="like-wrap">
                                <ul>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Icon"/></a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li>
                                </ul>
                            </div>
                            <div class="comment-wrap">
                                <ul>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/comment-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">20</a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/share-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="view-all-section"><a href="">View All Study Sessions</a></div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="addEventModal" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<div class="modal-body peers">
				<h4>Confirmation</h4>
				<div class="row">
					<h6 class="modalText">Are you sure to add this Event to Calendar</h6>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group button">
							<form method="post" action="<?php echo base_url(); ?>account/addEventToCalender">
								<input type="hidden" id="calender_event_id" name="calender_event_id" value="">
								<input type="hidden" id="" name="searchResult" value="1">
								<button type="button" data-dismiss="modal" class="transparentBtn highlight">No</button>
								<button type="submit" class="filterBtn">Yes</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="removeFromScheduleModal" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<div class="modal-body peers">
				<h4>Confirmation</h4>
				<div class="row">
					<h6 class="modalText">Are you sure you want to remove this event <br> from your schedule?</h6>
				</div>
				<div class="row">
					<div class="col-md-12">
						<form method="post" action="<?php echo base_url(); ?>account/removeEvent">
							<div class="form-group button">
								<input type="hidden" id="remove_event_id" name="remove_event_id">
								<input type="hidden" id="" name="searchResult" value="1">
								<button type="button" data-dismiss="modal" class="transparentBtn highlight">No</button>
								<button type="submit" class="filterBtn">Yes</button>
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="confirmationModalAttend" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<div class="modal-body peers">
				<h4>Confirmation</h4>
				<div class="row">
					<h6 class="modalText" id="confirmationModalAttendHead">Are you sure to attend this Event !</h6>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group button">
							<input type="hidden" name="attend_event_id" id="attend_event_id">
							<button data-dismiss="modal" class="transparentBtn highlight">No</button>
							<button type="button" class="filterBtn" onclick="attendEvent()">Yes</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="peersModalAttending" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<div class="modal-body peers">
				<h4>Peers List Attending Event</h4>
				<div class="searchPeer">
					<div class="filterSearch">
						<input type="text" placeholder="Search Peers" name="">
						<button type="submit" class="searchBtn">
							<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 489.713 489.713"><path d="M483.4,454.444l-121.3-121.4c28.7-35.2,46-80,46-128.9c0-112.5-91.5-204.1-204.1-204.1S0,91.644,0,204.144
                        s91.5,204,204.1,204c48.8,0,93.7-17.3,128.9-46l121.3,121.3c8.3,8.3,20.9,8.3,29.2,0S491.8,462.744,483.4,454.444z M40.7,204.144
                        c0-90.1,73.2-163.3,163.3-163.3s163.4,73.3,163.4,163.4s-73.3,163.4-163.4,163.4S40.7,294.244,40.7,204.144z"></path></svg>
						</button>
					</div>
				</div>
				<div class="peersList">
					<div class="listHeader">
						<h6>Peers</h6>
					</div>
					<div class="listUserWrap" id="peersModalAttendingList">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="reportModal" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<div class="modal-body peers">
				<h4>Reason</h4>
				<form method="POST" action="<?php echo base_url('account/reportThings'); ?>">
					
					<input type="hidden" name="primary_id" id="primary_id">
					<input type="hidden" name="report_post_type" id="report_post_type">
					<input type="hidden" name="current_page" id="current_page">
				
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Reason for Report</label>
								<div class="reason">
									<select class="form-control" name="report_reason" id="report_reason" required>
										<option value="">Select Reason</option>
										<option value="Inappropriate Content">Inappropriate Content</option>
										<option value="Spam">Spam</option>
										<option value="Promotional">Promotional</option>
										<option value="Uncivil">Uncivil</option>
										<option value="Other">Other</option>
									</select>
									<span class="error" id="report_reason_err"></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Reason</label>
								<div class="reason droparea">
									<textarea id="report_description" name="report_description" required ></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<button type="submit" class="filterBtn">Submit</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>