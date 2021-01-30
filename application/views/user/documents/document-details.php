<section class="mainContent noPadding">
					<div class="main_subheader">
						<div class="subheader_top">
							<div class="main_subheaderLeft">
								<a href="<?php echo base_url(); ?>account/documents">
									<svg class="sp-icon" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 490 490" style="enable-background:new 0 0 490 490;" xml:space="preserve">
										<path d="M245.9,436.3c14.8-16.4,13.9-41.5-2-56.8l-101.5-94.4l308.4-0.7c22.2-0.6,39.7-19,39.2-41.1c-0.5-21.4-17.7-38.6-39.1-39.1
											l-308.6,0.7l101.5-94.4c16.2-15.1,17.1-40.6,2-56.8c-15.1-16.2-40.6-17.1-56.8-2l-176.2,164C4.7,223.3,0.1,233.9,0,245
											c0,11.1,4.6,21.7,12.8,29.3L189,438.2c16.2,15.2,41.6,14.4,56.8-1.7c0.1-0.1,0.2-0.2,0.2-0.2H245.9z"></path>
									</svg>
									Back
								</a>
								<h4><?= $result['document_name'] ?></h4>
							</div>
							<div class="main_subheaderRight">
								<a class="document_dtl">
									<i class="fa fa-chevron-down"></i> Details
								</a>
								<a type="button" class="filterBtn download" href="<?php echo base_url(); ?>uploads/users/<?php echo $result['featured_image']; ?>" download> 
									<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
										<path d="M480.6,364.5c-11.3,0-20.4,9.1-20.4,20.4v75.2H51.8V385c0-11.3-9.1-20.4-20.4-20.4c-11.3,0-20.4,9.1-20.4,20.4v95.6    c0,11.3,9.1,20.4,20.4,20.4h449.2c11.3,0,20.4-9.1,20.4-20.4V385C501,373.7,491.9,364.5,480.6,364.5L480.6,364.5z"></path>
										<path d="m197.2,235v-183h109.7v182.2h67.6l-118.9,118.9-118.1-118.1h59.7zm46.4,164.1c6.7,6.7 17.4,6.7 24.1,0l176.8-176.8c10.7-10.7 3.1-29.1-12.1-29.1h-84.4v-165.2c0-9.4-7.6-17-17-17h-157.8c-9.4,0-17,7.6-17,17v166h-76.6c-15.2,0-22.8,18.4-12.1,29.1l176.1,176z"></path>
									</svg>
									Download
								</a>
							</div>
						</div>
						<div class="mainCardWrapper">
							<div class="subheader_doc_dtl">
								<div class="badgeList">
									<ul>
										<li class="badge badge1">
											<?php echo $result['SchoolName']; ?>
										</li>
										<li class="badge badge2">
											<?php echo $result['professor']; ?>
										</li>
										<li class="badge badge3">
											<?php echo $result['course']; ?>
										</li>
									</ul>
								</div>
								<p><?php echo $result['description']; ?></p>
								<div class="userWrap">
									<div class="user-name">
										<figure>
											<img src="<?php echo userImage($result['created_by']); ?>" alt="user">
										</figure>
										<a href="<?php echo base_url().'Profile/friends?profile_id='.$result['created_by'] ?>"><figcaption><?php echo $result['nickname']; ?></figcaption></a>
									</div>
								</div>
							</div>
						</div>
						<div class="documentDetail" style="text-align: center;">
							<?php 
								$userfile_name = $result['featured_image'];
								$extn = substr($userfile_name, strrpos($userfile_name, '.')+1); 
								if($extn == 'docx' || $extn == 'doc') { ?>
									
									<iframe src='https://view.officeapps.live.com/op/embed.aspx?src=<?php echo base_url(); ?>uploads/users/<?php echo $result['featured_image']; ?>' width='100%' height='830px' frameborder='0'> </iframe>
									
								<?php } else if($extn == 'pdf') {  ?>
									<embed src="<?php echo base_url(); ?>uploads/users/<?php echo $result['featured_image']; ?>" width="100%" height="830" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html">
									
								<?php } else if($extn == 'ppt' || $extn == 'pptx') { ?>
									<iframe src='https://view.officeapps.live.com/op/embed.aspx?src=<?php echo base_url(); ?>uploads/users/<?php echo $result['featured_image']; ?>' width='100%' height='830px' frameborder='0'> </iframe>
								<?php } else if($extn == 'xls' || $extn == 'xlsx') { ?>
									<iframe src='https://view.officeapps.live.com/op/embed.aspx?src=<?php echo base_url(); ?>uploads/users/<?php echo $result['featured_image']; ?>' width='100%' height='830px' frameborder='0'> </iframe>
									
								<?php } else {  ?>
									<img src="<?php echo base_url(); ?>uploads/users/<?php echo $result['featured_image']; ?>" width="100%" alt="image" style="margin: 20px 0;">
									
								<?php }
							?>
							 
						</div>
					</div>
				</section>



