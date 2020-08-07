

				<section class="mainContent">
					<?php if($user_detail['is_verified'] == 0) { ?>
						<div class="alert alert-danger" role="alert">
						  Emails sent to you university address have not yet been verified. Please check your university email account and click on the verification link to proceed to the next step.
						</div>
					<?php } ?>
					<?php if($this->session->flashdata('flash_message')) { 
					                  echo $this->session->flashdata('flash_message');
					                }
					         ?>
					<div class="boxscheduler">
						<div class="leftschedular">
							<ul>
								<li>
									<a href="javascript:void(0)">
										<i class="fa fa-arrow-left"></i> Back
									</a>
								</li>
								<li>
									<figure class="chromomrter">
										<img src="<?php echo base_url(); ?>assets_d/images/chronometer.svg" alt="chromomrter">
									</figure>
									<figcaption>Test</figcaption>
								</li>
							</ul>
						</div>
					</div>
					<section class="container-fluid no-padding">
						<section class="row">

						</section>
					</section>
				</section>
				