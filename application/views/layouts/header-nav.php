<div class="container">	
		<div class="flex-top-header">
				<nav class="navbar">
					<div class="container-fluid">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand logo" href="<?php echo base_url(); ?>">
								<img src="<?php echo base_url(); ?>assets_home/images/logo-desktop.svg" class="logoDesktop" alt="Logo">
								<img src="<?php echo base_url(); ?>assets_home/images/logo-mobile.svg" class="logoMobile" alt="Logo">
							</a>
						</div>
						<div class="collapse navbar-collapse" id="myNavbar">
							<ul class="nav navbar-nav pull-right">
								<li class="<?php if($active == 'studyTools') { echo "active"; } ?>"><a href="<?php echo base_url(); ?>study-tools">Study Tools</a></li>
								<li class="<?php if($active == 'connectWithPeers') { echo "active"; } ?>"><a href="<?php echo base_url(); ?>connect-with-peers">Connect with Peers</a></li>
								<li class="<?php if($active == 'forProfessor') { echo "active"; } ?>"><a href="<?php echo base_url(); ?>for-professor">For Professor</a></li>
							</ul>
						</div>
					</div>
				</nav>
				<div class="social-action">
					<ul>
						<?php if($active != 'register') { ?>
							<li><a href="<?php echo base_url('signup'); ?>" class="outline-join">Join</a></li>
						<?php } ?>
						<?php if($active != 'login') { ?>
							<li class="button"><a href="<?php echo base_url('login'); ?>">Login</a></li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>