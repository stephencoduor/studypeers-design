<script src="<?php echo base_url(); ?>assets_d/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets_d/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets_d/js/utils.js"></script>
    <script src="<?php echo base_url(); ?>assets_d/js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
	<!--<script src="https://areaaperta.com/nicescroll/js/jquery.nicescroll.plus.js"></script>-->
	<!--<script src="https://areaaperta.com/nicescroll/js/jquery.nicescroll.min.js"></script>-->
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
	<script src="<?php echo base_url(); ?>assets_d/js/jquery.star-rating-svg.js"></script>
	<script src="https://momentjs.com/downloads/moment.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/js/bootstrap-datetimepicker.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets_d/js/slick.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets_d/js/jquery.emojipicker.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets_d/js/jquery.emojis.js"></script>
    <!-- Starr Rating -->
	<script src="<?php echo base_url(); ?>assets_d/js/jquery.star-rating-svg.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets_d/js/jquery.emojipicker.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets_d/js/jquery.emojis.js"></script>
    <script src="<?php echo base_url(); ?>assets_d/js/custom.js"></script>
    <script>
		$('.storyRoom').slick({
		  infinite: false,
		  slidesToShow: 5.5,
		  autoplay: false,
		  slidesToScroll: 1,
		  responsive: [
	  		{
	  			breakpoint: 1200,
	  			settings: {
			        slidesToShow: 4.5
			    }
	  		},
	  		{
	  			breakpoint: 767,
	  			settings: {
			        slidesToShow: 3.5
			    }
	  		},
	  		{
	  			breakpoint: 567,
	  			settings: {
			        slidesToShow: 2.5
			    }
	  		},
	  		{
	  			breakpoint: 400,
	  			settings: {
			        slidesToShow: 1.5
			    }
	  		}
		  ]
		});
		$('.peerSuggestionList').slick({
		  infinite: false,
		  slidesToShow: 4.5,
		  autoplay: false,
		  slidesToScroll: 1,
		  responsive: [
	  		{
	  			breakpoint: 1200,
	  			settings: {
			        slidesToShow: 4.5
			    }
	  		},
	  		{
	  			breakpoint: 767,
	  			settings: {
			        slidesToShow: 3.5
			    }
	  		},
	  		{
	  			breakpoint: 567,
	  			settings: {
			        slidesToShow: 2.5
			    }
	  		},
	  		{
	  			breakpoint: 400,
	  			settings: {
			        slidesToShow: 1.5
			    }
	  		}
		  ]
		});
		$('.fullMessage').slideUp();
		$('.feedPostMessages a').on('click',function() {
			$(this).hide();
			$('.fullMessage').slideDown();
		})
		$('.fullMessage a').on('click',function() {
			$(this).parent().slideUp();
			$('.feedPostMessages a').show();
		});
		$('.removePeer').on('click',function() {
			$(this).parent('figure').parent('.peerList').hide('slow', function(){ $(this).parent('figure').parent('.peerList').remove(); });
			
			if($('.peerList:visible').length == 1){ 
				$('#peer_suggestion_box').hide();
			}
			// $('.fullMessage').slideDown();
		})
		function sendRequest(peer_id){
			$.ajax({
					url : '<?php echo base_url();?>account/sendPeerRequest',
					type : 'post',
					data : {"peer_id" : peer_id},
					success:function(result) {
						$('#add_peer_'+peer_id).text('Cancel Request');
						$("#add_peer_"+peer_id).attr("onclick","cancelRequest("+peer_id+")");
						
					}	
			})
		}

		function cancelRequest(peer_id){
			$.ajax({
					url : '<?php echo base_url();?>account/cancelRequest',
					type : 'post',
					data : {"peer_id" : peer_id},
					success:function(result) {
						$('#add_peer_'+peer_id).text('Add Peer');
						$("#add_peer_"+peer_id).attr("onclick","sendRequest("+peer_id+")");
						
					}	
			})
		}
		$(document).ready(function() {
			$('.box-card').each(function(){
				let feedImage = $(this).children('.createBox ').children('.feeduserwrap').children('.imgWrapper ').find('figure');
				let imageLength = feedImage.length;
				if(imageLength > 3) {
					feedImage.parent('.imgWrapper').append('<div class="count"></div>');
					let imageCount = imageLength-3;
					let counter = imageCount;
					while(counter>=0) {
						$(feedImage).eq(imageLength-counter).hide();
						counter--;
					}				
					feedImage.parent('.imgWrapper').find('.count').append(" + " + imageCount);
				} else {
					return 
				}
			})	
		});
		let vid = document.getElementById("myVideo"); 
		$('.video-click').click(function () {
			$(this).parent().hide();
		    vid.play(); 
		    vid.setAttribute("controls","controls");
		});
		$(document).ready(function(e) {
			$("#em_0,#em_1").emojiPicker({
		        width: '320px',
		        height: '328px'
			});
		});
		$('.socialAction li.helpful a').on('click', function() {
			let togglesrc = $(this).find('img');
			let togglename = $(this).find('span');
			if(togglesrc.hasClass('helpful')) {
				togglesrc.attr('src', 'images/up-arrow-dashboard.svg');
				togglesrc.attr('class', 'helped');
			}
			else {
				togglesrc.attr('src', 'images/up-arrow-grey.svg');	
				togglesrc.attr('class', 'helpful');
			}
		})
		$('.socialAction li.not-helpful a').on('click', function() {
			let togglesrc = $(this).find('img');
			let togglename = $(this).find('span');
			if(togglesrc.hasClass('not-helpful')) {
				togglesrc.attr('src', 'images/down-arrow-dashboard.svg');
				togglesrc.attr('class', 'notHelped');
			}
			else {
				togglesrc.attr('src', 'images/down-arrow-grey.svg');	
				togglesrc.attr('class', 'not-helpful');
			}
		});
		$('.hashTag').on('click', function() {
			$('#messagepostarea').val($('#messagepostarea').val()+'#').focus();
		});
		$('#messagepostarea').keyup(function () {
		    if ($.trim($('#messagepostarea').val()).length) {
		        $(this).parents('.postwrapper').siblings('.shareBoxWrapper').find('.postActiveBtn').addClass('active');
		    } else {
		        $('.studybuttonGroup.post').removeClass('active');
		    }
		});
		$('.shareMoreContentWrapper').hide();
		$('.moreSection').on('click', function(){
			let imgAttr = $(this).children('img');
			$(this).children('span').text($(this).children('span').text() == 'More'? 'Less': 'More');
			if(imgAttr.hasClass('more')){
				imgAttr.attr('src', 'images/less.svg');
				imgAttr.attr('class', 'less');
			} else {
				imgAttr.attr('src', 'images/more-popup.svg');
				imgAttr.attr('class', 'more');
			}
			$('.shareMoreContentWrapper').slideToggle();
		});
		$('.privacyContent li').on('click', function() {
			// debugger;
			$('.privacyContent li').removeClass('active');
			if($(this).children('a').find('input[type="radio"]').attr('checked', true)) {
				$(this).addClass('active');
			}
		})
		$('.shareDocs').hide();
		$('.pollsWrapper').hide();
		$('.fileSection').on('click',function() {
			if($('.pollsWrapper').is(":Visible")){
				$('.pollsWrapper').hide();
				$('.shareDocs').slideToggle();
			} else {
				$('.shareDocs').slideToggle();
			}
		});
		$('.pollSection').on('click',function() {
			if($('.shareDocs').is(":Visible")){
				$('.shareDocs').hide();
				$('.pollsWrapper').slideToggle();
			} else {
				$('.pollsWrapper').slideToggle();
			}
		});
		$(function () {
			$('#datetimepickerstart').datetimepicker({
                allowInputToggle: true,
                format: 'L'
			});
			$('#selectTime1').datetimepicker({
	            format: 'LT',
	            allowInputToggle: true
	        });
        });
        index = 3;
        $('.addmore').on('click', function() {
        	index++;
        	$('.pollsform').append(
        		`<div class="form-group">
  					<input type="text" class="form-control" placeholder="Option ${index}">
  				</div>
        		`
        	);
        });
        $('.closeBtn').on('click', function() {
        	$(this).parents('.uploadedDocs').hide();
        });
        $('.commentBoxWrap').hide();
        $('.socialAction li:nth-child(2)').on('click', function() {
        	$(this).parent().parent().siblings('.commentBoxWrap').slideDown();
        });
		$('.hoverMenu li').on('click', function(){
			let togglesrc =  $(this).parent().parent().siblings('a').find('img');
			let togglename = $(this).parent().parent().siblings('a').find('span');
			if($(this).hasClass('likeOption')) {
				togglesrc.attr('src', 'images/liked.svg');
				togglename.text('Liked');	
			} else if($(this).hasClass('supportMenu')) {
				togglesrc.attr('src', 'images/support-dashboard.svg');
				togglename.text('Support');
			} else if($(this).hasClass('celebrateMenu')) {
				togglesrc.attr('src', 'images/celebrate-dashboard.svg');
				togglename.text('Celebrate');
			} else if($(this).hasClass('curiousMenu')) {
				togglesrc.attr('src', 'images/curious-dashboard.svg');
				togglename.text('Curious');
			} else if($(this).hasClass('insightMenu')) {
				togglesrc.attr('src', 'images/insight-dashboard.svg');
				togglename.text('Insight');
			} else if($(this).hasClass('loveMenu')) {
				togglesrc.attr('src', 'images/love-dashboard.svg');
				togglename.text('Love');
			}
		});
		$('.innerReplyBox').slideUp();
		$('.leftStatus a.reply').on('click', function(){
			$(this).siblings('.innerReplyBox').slideDown();
		});
		$('.uloadedImage .close').click(function(){
			$(this).parent().hide();
		});
		$('.notification').on('click', function() {
			let imgsrc = $(this).children('img');
			if(imgsrc.hasClass('notification-disabled')) {
				imgsrc.attr('src', 'images/alert.svg');
				imgsrc.attr('class', 'notification-active')
			} else {
				imgsrc.attr('src', 'images/alert-grey.svg');
				imgsrc.attr('class', 'notification-disabled')
			}
		})
    </script>
</body>
</html>