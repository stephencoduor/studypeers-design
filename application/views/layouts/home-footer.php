<footer>
			<div class="container">
				<div class="footer-wrapper">
					<div class="left-footer">
						<div class="list">
							<h6>Studypeers</h6>
							<ul>
								<li><a href="javascript:void(0)">Home</a></li>
								<li><a href="javascript:void(0)">Study Tools</a></li>
								<li><a href="javascript:void(0)">Connect with Peers</a></li>
								<li><a href="javascript:void(0)">For Professor</a></li>
							</ul>
						</div>
						<div class="list">
							<h6>Resources</h6>
							<ul>
								<li><a href="javascript:void(0)">About Us</a></li>
								<li><a href="javascript:void(0)">Terms and Conditions</a></li>
								<li><a href="javascript:void(0)">Privacy Policy</a></li>
							</ul>
						</div>
					</div>
					<div class="right-footer">
						<div class="footer-logo">
							<img src="<?php echo base_url(); ?>assets_home/images/logo-footer.svg" alt="Logo">
						</div>
						<div class="social-media">
							<ul>
								<li>
									<a href="javascript:void(0)">
										<img src="<?php echo base_url(); ?>assets_home/images/facebook.svg" alt="facebook">
									</a>
								</li>
								<li>
									<a href="javascript:void(0)">
										<img src="<?php echo base_url(); ?>assets_home/images/twitter.svg" alt="twitter">
									</a>
								</li>
								<li>
									<a href="javascript:void(0)">
										<img src="<?php echo base_url(); ?>assets_home/images/instagram.svg" alt="instagram">
									</a>
								</li>
								<li>
									<a href="javascript:void(0)">
										<img src="<?php echo base_url(); ?>assets_home/images/linkedin.svg" alt="linkedin">
									</a>
								</li>
							</ul>
						</div>
						<p>Copyright © 2021 Studypeers</p>
					</div>
				</div>
			</div>
		</footer>
	</div>
	<script src="<?php echo base_url(); ?>assets_home/js/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>assets_home/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://kenwheeler.github.io/slick/slick/slick.js"></script>
	<script src="<?php echo base_url(); ?>assets_home/js/custom.js"></script>
	<script type="text/javascript">
		let totalHeight = $('header').height() + $('.banner').height()
		$('body').scroll(function() {
			var sticky = $('header'),
				scroll = $(this).scrollTop();

			if (scroll >= totalHeight) {
				$('header').css('transform', 'translate(0,-100%)');
				window.setTimeout(function() {
					sticky.addClass('fixed');
				}, 500);
			} else {
				sticky.removeClass('fixed');
				$('header').css('transform', 'translate(0,-100%)');
				window.setTimeout(function() {
					$('header').css('transform', 'translate(0,0%)');
				}, 500);
			}
		});
	</script>
	<script>
		var TxtType = function(el, toRotate, period) {
			this.toRotate = toRotate;
			this.el = el;
			this.loopNum = 0;
			this.period = parseInt(period, 10) || 2000;
			this.txt = '';
			this.tick();
			this.isDeleting = false;
		};

		TxtType.prototype.tick = function() {
			var i = this.loopNum % this.toRotate.length;
			var fullTxt = this.toRotate[i];

			if (this.isDeleting) {
				this.txt = fullTxt.substring(0, this.txt.length - 1);
			} else {
				this.txt = fullTxt.substring(0, this.txt.length + 1);
			}

			this.el.innerHTML = '<span class="wrap">' + this.txt + '</span>';

			var that = this;
			var delta = 200 - Math.random() * 100;

			if (this.isDeleting) {
				delta /= 2;
			}

			if (!this.isDeleting && this.txt === fullTxt) {
				delta = this.period;
				this.isDeleting = true;
			} else if (this.isDeleting && this.txt === '') {
				this.isDeleting = false;
				this.loopNum++;
				delta = 500;
			}

			setTimeout(function() {
				that.tick();
			}, delta);
		};

		window.onload = function() {
			var elements = document.getElementsByClassName('typewrite');
			for (var i = 0; i < elements.length; i++) {
				var toRotate = elements[i].getAttribute('data-type');
				var period = elements[i].getAttribute('data-period');
				if (toRotate) {
					new TxtType(elements[i], JSON.parse(toRotate), period);
				}
			}
			// INJECT CSS
			var css = document.createElement("style");
			css.type = "text/css";
			css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
			document.body.appendChild(css);
		};
	</script>
</body>

</html>