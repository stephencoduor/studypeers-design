<div class="social-tools">
			<div class="container">
			 <div class="row centered">
				<div class="col-sm-4">
				 <div class="vertical-menu">
					<a href="<?php echo base_url(); ?>FAQ">FAQs</a>
					<a href="javascript:void(0)">Contact Us</a>
  
				</div>
				</div>
				<div class="col-sm-8 divS">	         
						  
					<h4><center> Contact Us</center></h4>
					<?php if($this->session->flashdata('flash_message')) { 
                                      echo $this->session->flashdata('flash_message');
                                    }
                            ?>
					<p style="text-align: left;"><b>Fill out the details and we will get in touched with you</b></p>
					<form method="post" action="<?php echo base_url(); ?>contact-us" onsubmit="return validateContact()">
					<div class="form-group">
						<div class="col-sm-12" style="padding: 0; margin-bottom: 10px;">
							<div class="col-sm-6">
								<input  class="form-control form-control--lg p-3 sp" type="text" id="firstname" name="firstname" placeholder="Firstname*" >
								<span id="err_firstname" style="font-style: italic;"></span>
							</div>       
							<div class="col-sm-6">
								<input class="form-control form-control--lg p-3 sp" type="text" name="lastname" id="lastname"  placeholder="Lastname*" >
								<span id="err_lastname" style="font-style: italic;"></span>
							</div>
						</div>
						
					</div>
		   <!--/form-group-->
		     
					<div class="form-group">
						<div class="col-sm-12" style="padding: 0; margin-bottom: 10px;">
							<div class="col-sm-6">
	           
								<input class="form-control form-control--lg sp" type="text" id="email" name="email" placeholder="Email*" >
								<span id="err_email" style="font-style: italic;"></span>
							</div>       
							<div class="col-sm-6">
	             
								<input class="form-control form-control--lg sp num_only" type="tel" id="phoneNo" name="phoneNo" placeholder="Phone*" >
								<span id="err_phoneNo" style="font-style: italic;"></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12" style="margin-bottom: 10px;">
							<textarea rows="7" cols="80" id="message" class="form-control form-control--lg sp" name="message" placeholder="Message"></textarea>
							<span id="err_message" style="font-style: italic;"></span>
						</div>
					</div>
					<div class="form-group text-center">
							<input type="submit" class="filterBtn sp" value="Submit">
					</div>
					</form>
				</div>
			</div>
		</div>
		</div>