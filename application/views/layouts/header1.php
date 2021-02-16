<!DOCTYPE html>
<html>

<head>
	<title>StudyPeers</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://kenwheeler.github.io/slick/slick/slick.css" />
	<link rel="stylesheet" type="text/css" href="https://kenwheeler.github.io/slick/slick/slick-theme.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets_home/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets_home/css/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_home/css/animate.css">

	
</head>

<body>
	<div class="home">
		<header>
			<div class="container">
				<nav class="navbar">
					<div class="container-fluid">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand logo" href="javascripr:void(0)">
								<img src="<?php echo base_url(); ?>assets_home/images/logo-desktop.svg" class="logoDesktop" alt="Logo">
								<img src="<?php echo base_url(); ?>assets_home/images/logo-mobile.svg" class="logoMobile" alt="Logo">
							</a>
						</div>
						<div class="collapse navbar-collapse" id="myNavbar">
							<ul class="nav navbar-nav pull-right">
								<li class="active"><a href="javascripr:void(0)">Study Tools</a></li>
								<li><a href="javascripr:void(0)">Connect with Peers</a></li>
								<li><a href="javascripr:void(0)">For Professor</a></li>
							</ul>
						</div>
					</div>
				</nav>
				<div class="social-action">
					<ul>
						<li><a href="<?php echo base_url('signup'); ?>">Join</a></li>
						<li class="button"><a href="<?php echo base_url('login'); ?>">Login</a></li>
					</ul>
				</div>
			</div>
		</header>