<section class="mainContent">
    <div class="main-home-wrapper">
        <div class="tabs-wrappper">
            <div class="tabslisting">
                <ul class="nav nav-tabs">
					<li class="active" style="display:none;"><a data-toggle="tab" href="#all" aria-expanded="true">All</a></li>
                    <li><a data-toggle="tab" href="#peers" aria-expanded="true">Peers</a></li>
                    <li><a data-toggle="tab" href="#posts" aria-expanded="true">Posts</a></li>
                    <li><a data-toggle="tab" href="#questions" aria-expanded="true">Questions</a></li>
                    <li><a data-toggle="tab" href="#documents" aria-expanded="true">Documents</a></li>
                    <li><a data-toggle="tab" href="#studySets" aria-expanded="true">Study Sets</a></li>
                    <li><a data-toggle="tab" href="#events" aria-expanded="true">Events</a></li>
                    <li><a data-toggle="tab" href="#articles" aria-expanded="true">Articles</a></li>
                    <li><a data-toggle="tab" href="#studySessions" aria-expanded="true">Study Sessions</a></li>
                </ul>
            </div>
        </div>
        <div class="tab-content">
			<div id="all" class="tab-pane fade in active">
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
                                <div class="peers-img-wrap">
                                    <img src="<?php echo $AllPeer['UserProfile']; ?>" alt="Image"/>
                                </div>
                                <div class="basic-info">
                                    <h3><?php echo $AllPeer['full_name']; ?></h3>
                                    <ul>
                                        <li><?php echo $AllPeer['UniversityName']; ?></li>
                                        <li><?php echo $AllPeer['LocationName']; ?></li>
                                        <li><a href=""><?php echo $AllPeer['totalFollower']; ?></a> followers</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="peer-right-info">
                                <ul>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/chat-red.svg" alt="Image"/></a></li>
                                    <li><a href="">Following</a></li>
                                    <li><a href="">Peer</a></li>
                                </ul>
                            </div>
                        </div>
						<?php
							}
						?>
                    </div>
                    <div class="view-all-section"><a href="">View All Peers</a></div>
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
                                <div class="user-img">
                                    <figure>
                                        <img src="<?php echo $AllPost['profile_picture']; ?>" alt="Image"/>
                                    </figure>
                                </div>
                                <div class="user-name-wrap">
                                    <h3><?php echo $AllPost['fullname']; ?></h3>
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
                                    <a href=""><img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/></a>
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
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/comment-grey.svg" alt="Icon"/></a></li>
                                    <li><a href=""><?php echo $AllPost['total_comments']; ?></a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/share-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
					<?php
						}
					?>
                    <div class="view-all-section"><a href="">View All Posts</a></div>
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
                                <div class="user-img">
                                    <figure>
                                        <img src="<?php echo $AllQuestion['profile_picture']; ?>" alt="Image"/>
                                    </figure>
                                </div>
                                <div class="user-name-wrap">
                                    <h3><?php echo $AllQuestion['username']; ?></h3>
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
                                    <a href=""><img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/></a>
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
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Icon"/></a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li>
                                </ul>
                            </div>
                            <div class="comment-wrap">
                                <ul>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/views.svg" alt="Icon"/></a></li>
                                    <li><a href=""><?php echo $AllQuestion['view_count']; ?></a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/answer.svg" alt="Icon"/></a></li>
                                    <li><a href=""><?php echo $AllQuestion['answer_count']; ?></a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/share-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php
						}
					?>
                    <div class="view-all-section"><a href="">View All Questions</a></div>
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
                                <div class="user-img">
                                    <figure>
                                        <img src="<?php echo $AllDocument['profile_picture']; ?>" alt="Image"/>
                                    </figure>
                                </div>
                                <div class="user-name-wrap">
                                    <h3><?php echo $AllDocument['fullname']; ?></h3>
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
                                    <a href=""><img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/></a>
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
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Icon"/></a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li>
                                </ul>
                            </div>
                            <div class="star-rating">
                                <ul>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
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
                    <?php
						}
					?>
                    <div class="view-all-section"><a href="">View All Documents</a></div>
                </div>
				<br>
				<?php
				}
				?>
				<div class="content-card seprate-border">
                    <div class="title-wrap">
                        <h3>Study Sets</h3>
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
                            <div class="star-rating">
                                <ul>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
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
                            <div class="star-rating">
                                <ul>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
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
                            <div class="star-rating">
                                <ul>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
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
                            <div class="star-rating">
                                <ul>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
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
                    <div class="view-all-section"><a href="">View All Study Sets</a></div>
                </div>
				<br>
				<div class="content-card seprate-border">
                    <div class="title-wrap">
                        <h3>Events</h3>
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
                    <div class="view-all-section"><a href="">View All Events</a></div>
                </div>
				<br>
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
				<br>
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
            <div id="peers" class="tab-pane fade">
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
                                <div class="peers-img-wrap">
                                    <img src="<?php echo $AllPeer['UserProfile']; ?>" alt="Image"/>
                                </div>
                                <div class="basic-info">
                                    <h3><?php echo $AllPeer['full_name']; ?></h3>
                                    <ul>
                                        <li><?php echo $AllPeer['UniversityName']; ?></li>
                                        <li><?php echo $AllPeer['LocationName']; ?></li>
                                        <li><a href="">25</a> followers</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="peer-right-info">
                                <ul>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/chat-red.svg" alt="Image"/></a></li>
                                    <li><a href="">Following</a></li>
                                    <li><a href="">Peer</a></li>
                                </ul>
                            </div>
                        </div>
						<?php
							}
						} else {
						?>
						<div class="mainContent">
							<div class="main-home-wrapper">
								<div class="createBox">
									<div class="noFeedWrapper">
										<figure>
											<img src="<?php echo base_url(); ?>assets_d/images/blank-feeds.png" alt="No Feed">
										</figure>
										<h4>Search result not found.</h4>
									</div>
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
                    <div class="view-all-section"><a href="">View All Peers</a></div>
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
            <div id="posts" class="tab-pane fade">
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
                                <div class="user-img">
                                    <figure>
                                        <img src="<?php echo $AllPost['profile_picture']; ?>" alt="Image"/>
                                    </figure>
                                </div>
                                <div class="user-name-wrap">
                                    <h3><?php echo $AllPost['fullname']; ?></h3>
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
                                    <a href=""><img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/></a>
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
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/comment-grey.svg" alt="Icon"/></a></li>
                                    <li><a href=""><?php echo $AllPost['total_comments']; ?></a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/share-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li>
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
							<div class="createBox">
								<div class="noFeedWrapper">
									<figure>
										<img src="<?php echo base_url(); ?>assets_d/images/blank-feeds.png" alt="No Feed">
									</figure>
									<h4>Search result not found.</h4>
								</div>
							</div>
						</div>
					</div>
					<?php
						}
						
						if(!empty($AllPosts)){
					?>
                    <div class="view-all-section"><a href="">View All Posts</a></div>
					<?php
						}
					?>
                </div>
            </div>
            <div id="questions" class="tab-pane fade">
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
                                <div class="user-img">
                                    <figure>
                                        <img src="<?php echo $AllQuestion['profile_picture']; ?>" alt="Image"/>
                                    </figure>
                                </div>
                                <div class="user-name-wrap">
                                    <h3><?php echo $AllQuestion['username']; ?></h3>
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
                                    <a href=""><img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/></a>
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
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Icon"/></a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li>
                                </ul>
                            </div>
                            <div class="comment-wrap">
                                <ul>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/views.svg" alt="Icon"/></a></li>
                                    <li><a href=""><?php echo $AllQuestion['view_count']; ?></a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/answer.svg" alt="Icon"/></a></li>
                                    <li><a href=""><?php echo $AllQuestion['answer_count']; ?></a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/share-grey.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li>
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
							<div class="createBox">
								<div class="noFeedWrapper">
									<figure>
										<img src="<?php echo base_url(); ?>assets_d/images/blank-feeds.png" alt="No Feed">
									</figure>
									<h4>Search result not found.</h4>
								</div>
							</div>
						</div>
					</div>
					<?php	
					}
					
					if(!empty($AllQuestions)){
					?>
                    <div class="view-all-section"><a href="">View All Questions</a></div>
					<?php
					}
					?>
                </div>
            </div>
            <div id="documents" class="tab-pane fade">
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
                                <div class="user-img">
                                    <figure>
                                        <img src="<?php echo $AllDocument['profile_picture']; ?>" alt="Image"/>
                                    </figure>
                                </div>
                                <div class="user-name-wrap">
                                    <h3><?php echo $AllDocument['fullname']; ?></h3>
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
                                    <a href=""><img src="<?php echo base_url(); ?>assets_d/images/more.svg" alt="Image"/></a>
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
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" alt="Icon"/></a></li>
                                    <li><a href=""><img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" alt="Icon"/></a></li>
                                    <li><a href="">24</a></li>
                                </ul>
                            </div>
                            <div class="star-rating">
                                <ul>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
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
                    <?php
							}
						} else {
					?>
					<div class="mainContent">
						<div class="main-home-wrapper">
							<div class="createBox">
								<div class="noFeedWrapper">
									<figure>
										<img src="<?php echo base_url(); ?>assets_d/images/blank-feeds.png" alt="No Feed">
									</figure>
									<h4>Search result not found.</h4>
								</div>
							</div>
						</div>
					</div>
					<?php		
						}
						
						if(!empty($AllDocuments)){
					?>
                    <div class="view-all-section"><a href="">View All Documents</a></div>
					<?php
						}
					?>
                </div>
            </div>
            <div id="studySets" class="tab-pane fade">
                <div class="content-card seprate-border">
                    <div class="title-wrap">
                        <h3>Study Sets</h3>
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
                            <div class="star-rating">
                                <ul>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
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
                            <div class="star-rating">
                                <ul>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
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
                            <div class="star-rating">
                                <ul>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
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
                            <div class="star-rating">
                                <ul>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
                                    <li>
                                        <a><img src="<?php echo base_url(); ?>assets_d/images/Star.png" alt="Image"/></a>
                                    </li>
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
                    <div class="view-all-section"><a href="">View All Study Sets</a></div>
                </div>
            </div>
            <div id="events" class="tab-pane fade">
                <div class="content-card seprate-border">
                    <div class="title-wrap">
                        <h3>Events</h3>
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
                    <div class="view-all-section"><a href="">View All Events</a></div>
                </div>
            </div>
            <div id="articles" class="tab-pane fade">
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
            <div id="studySessions" class="tab-pane fade">
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