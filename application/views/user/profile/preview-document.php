<div class="modal-header flex-header-wrp">
	  	<div class="title-wrp">
        	<h4 class="modal-title">Document Preview</h4>
		</div>
		<div class="download-close-wrap">
		  	<a type="button" class="filterBtn download" download="" href="<?php echo base_url(); ?>uploads/users/<?php echo $doc_detail['featured_image']; ?>"> 
				<svg class="sp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
					<path d="M480.6,364.5c-11.3,0-20.4,9.1-20.4,20.4v75.2H51.8V385c0-11.3-9.1-20.4-20.4-20.4c-11.3,0-20.4,9.1-20.4,20.4v95.6    c0,11.3,9.1,20.4,20.4,20.4h449.2c11.3,0,20.4-9.1,20.4-20.4V385C501,373.7,491.9,364.5,480.6,364.5L480.6,364.5z"></path>
					<path d="m197.2,235v-183h109.7v182.2h67.6l-118.9,118.9-118.1-118.1h59.7zm46.4,164.1c6.7,6.7 17.4,6.7 24.1,0l176.8-176.8c10.7-10.7 3.1-29.1-12.1-29.1h-84.4v-165.2c0-9.4-7.6-17-17-17h-157.8c-9.4,0-17,7.6-17,17v166h-76.6c-15.2,0-22.8,18.4-12.1,29.1l176.1,176z"></path>
				</svg>
				Download
			</a>
        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>
      </div>
      <div class="modal-body">
	  	<?php 
								$userfile_name = $doc_detail['featured_image'];
								$extn = substr($userfile_name, strrpos($userfile_name, '.')+1); 
								if($extn == 'docx' || $extn == 'doc') { ?>
									
									<iframe src='https://view.officeapps.live.com/op/embed.aspx?src=<?php echo base_url(); ?>uploads/users/<?php echo $doc_detail['featured_image']; ?>' width='100%' height='830px' frameborder='0'> </iframe>
									
								<?php } else if($extn == 'pdf') {  ?>
									<!-- <embed src="<?php echo base_url(); ?>uploads/users/<?php echo $doc_detail['featured_image']; ?>" width="100%" height="830" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html"> -->
									<div id="example-pdf" width="100%" height="830"></div>
								<?php } else if($extn == 'ppt' || $extn == 'pptx') { ?>
									<iframe src='https://view.officeapps.live.com/op/embed.aspx?src=<?php echo base_url(); ?>uploads/users/<?php echo $doc_detail['featured_image']; ?>' width='100%' height='830px' frameborder='0'> </iframe>
								<?php } else if($extn == 'xls' || $extn == 'xlsx') { ?>
									<iframe src='https://view.officeapps.live.com/op/embed.aspx?src=<?php echo base_url(); ?>uploads/users/<?php echo $doc_detail['featured_image']; ?>' width='100%' height='830px' frameborder='0'> </iframe>
									
								<?php } else {  ?>
									<img src="<?php echo base_url(); ?>uploads/users/<?php echo $doc_detail['featured_image']; ?>" alt="image" style="margin: 20px 0;">
									
								<?php }
							?>
      </div>


      <script>PDFObject.embed("<?php echo base_url(); ?>uploads/users/<?php echo $doc_detail['featured_image']; ?>", "#example-pdf");</script>