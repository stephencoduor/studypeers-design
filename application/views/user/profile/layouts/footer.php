<script src="<?php echo base_url(); ?>assets_d/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets_d/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets_d/js/Chart.bundle.js"></script>
<script src="<?php echo base_url(); ?>assets_d/js/utils.js"></script>
<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script src="https://areaaperta.com/nicescroll/js/jquery.nicescroll.plus.js"></script>
<script src="https://areaaperta.com/nicescroll/js/jquery.nicescroll.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://momentjs.com/downloads/moment.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets_d/js/slick.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets_d/js/jquery.emojipicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets_d/js/jquery.emojis.js"></script>
<!-- Starr Rating -->
<script src="<?php echo base_url(); ?>assets_d/js/jquery.star-rating-svg.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets_d/js/jquery.emojipicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets_d/js/jquery.emojis.js"></script>
<script src="<?php echo base_url(); ?>assets_d/js/jquery.star-rating-svg.js"></script>
<script src="<?php echo base_url(); ?>assets_d/js/custom.js"></script>
<script src="<?php echo base_url(); ?>assets_d/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script>

    $(function() {
        $(".progress").each(function() {
            var value = $(this).attr('data-value');
            var left = $(this).find('.progress-left .progress-bar');
            var right = $(this).find('.progress-right .progress-bar');
            if (value > 0) {
                if (value <= 50) {
                    right.css('transform', 'rotate(' + percentageToDegrees(value) + 'deg)')
                } else {
                    right.css('transform', 'rotate(180deg)')
                    left.css('transform', 'rotate(' + percentageToDegrees(value - 50) + 'deg)')
                }
            }
        })
        function percentageToDegrees(percentage) {
            return percentage / 100 * 360
        }
    });
    //  dashboard Card JS Starts
    $('.fullMessage').slideUp();
    $('.feedPostMessages a').on('click',function() {
        $(this).hide();
        $('.fullMessage').slideDown();
    });
    $('.fullMessage a').on('click',function() {
        $(this).parent().slideUp();
        $('.feedPostMessages a').show();
    });
    $(document).ready(function() {
        var base_url = $('#base').val();
        console.log(base_url);
        CKEDITOR.replace('messagepostarea', {
            on: {
                instanceReady: function (evt) {
                    // Hide the editor top bar.
                    document.getElementById('cke_1_top').style.display = 'none';
                    document.getElementById('cke_1_bottom').style.display = 'none';
                }
            }
        });
        $(document).on( 'click', '#save_post_from_ajax', function () {
            var html_content = CKEDITOR.instances['messagepostarea'].getData();
            console.log(html_content);
            var privacy = $("input:radio.privacy_val:checked").val();
            console.log(privacy);
            var allow_comment = $('#allow_comment').val();
            console.log(allow_comment);
            if((html_content !== undefined) && (privacy !== undefined) && (allow_comment !== undefined)){
                $.ajax({
                    url : base_url+'Profile/savePost',
                    type : 'post',
                    data : {"html_content" : html_content,"privacy" : privacy,"allow_comment" : allow_comment},
                    success:function(result) {
                        if(result == true){
                            window.location.href = base_url+'Profile/redirect_page?status='+result;
                        }
                    }
                });

            }
        });

        $('.box-card').each(function () {
            let feedImage = $(this).children('.createBox ').children('.feeduserwrap').children('.imgWrapper ').find('figure');
            let imageLength = feedImage.length;
            if (imageLength > 3) {
                feedImage.parent('.imgWrapper').append('<div class="count"></div>');
                let imageCount = imageLength - 3;
                let counter = imageCount;
                while (counter >= 0) {
                    $(feedImage).eq(imageLength - counter).hide();
                    counter--;
                }
                feedImage.parent('.imgWrapper').find('.count').append(" + " + imageCount);
            } else {
                return
            }
        })
        let vid = document.getElementById("myVideo");
        $('.video-click').click(function () {
            $(this).parent().hide();
            vid.play();
            vid.setAttribute("controls", "controls");
        });
        $("#em_0,#em_1").emojiPicker({
            width: '320px',
            height: '328px'
        });

        $('.socialAction li.helpful a').on('click', function () {
            let togglesrc = $(this).find('img');
            let togglename = $(this).find('span');
            if (togglesrc.hasClass('helpful')) {
                togglesrc.attr('src', base_url + 'assets_d/images/up-arrow-dashboard.svg');
                togglesrc.attr('class', 'helped');
            }
            else {
                togglesrc.attr('src', base_url + 'assets_d/images/up-arrow-grey.svg');
                togglesrc.attr('class', 'helpful');
            }
        });
        $('.socialAction li.not-helpful a').on('click', function () {
            let togglesrc = $(this).find('img');
            let togglename = $(this).find('span');
            if (togglesrc.hasClass('not-helpful')) {
                togglesrc.attr('src', base_url + 'assets_d/images/down-arrow-dashboard.svg');
                togglesrc.attr('class', 'notHelped');
            }
            else {
                togglesrc.attr('src', base_url + 'assets_d/images/down-arrow-grey.svg');
                togglesrc.attr('class', 'not-helpful');
            }
        });
        $('.hashTag').on('click', function () {
            $('#messagepostarea').val($('#messagepostarea').val() + '#').focus();
        });
        $('#messagepostarea').keyup(function () {
            if ($.trim($('#messagepostarea').val()).length) {
                console.log($.trim($('#messagepostarea').val()).length);
                $(this).parents('.postwrapper').siblings('.shareBoxWrapper').find('.postActiveBtn').addClass('active');
            } else {
                $('.studybuttonGroup.post').removeClass('active');
            }
        });
        $('.shareMoreContentWrapper').hide();
        $('.moreSection').on('click', function () {
            let imgAttr = $(this).children('img');
            $(this).children('span').text($(this).children('span').text() == 'More' ? 'Less' : 'More');
            if (imgAttr.hasClass('more')) {
                imgAttr.attr('src', base_url + 'assets_d/images/less.svg');
                imgAttr.attr('class', 'less');
            } else {
                imgAttr.attr('src', base_url + 'assets_d/images/more-popup.svg');
                imgAttr.attr('class', 'more');
            }
            $('.shareMoreContentWrapper').slideToggle();
        });
        $('.privacyContent li').on('click', function () {
            // debugger;
            $('.privacyContent li').removeClass('active');
            if ($(this).children('a').find('input[type="radio"]').attr('checked', true)) {
                $(this).addClass('active');
            }
        });
        $('.shareDocs').hide();
        $('.pollsWrapper').hide();
        $('.fileSection').on('click', function () {
            if ($('.pollsWrapper').is(":Visible")) {
                $('.pollsWrapper').hide();
                $('.shareDocs').slideToggle();
            } else {
                $('.shareDocs').slideToggle();
            }
        });
        $('.pollSection').on('click', function () {
            if ($('.shareDocs').is(":Visible")) {
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
        $('.addmore').on('click', function () {
            index++;
            $('.pollsform').append(
                `<div class="form-group">
                        <input type="text" class="form-control" placeholder="Option ${index}">
                    </div>
                    `
            );
        });
        $('.closeBtn').on('click', function () {
            $(this).parents('.uploadedDocs').hide();
        });
        $('.commentBoxWrap').hide();
        $('.socialAction li:nth-child(2)').on('click', function () {
            $(this).parent().parent().siblings('.commentBoxWrap').slideDown();
        });
        $('.hoverMenu li').on('click', function () {
            let togglesrc = $(this).parent().parent().siblings('a').find('img');
            let togglename = $(this).parent().parent().siblings('a').find('span');
            if ($(this).hasClass('likeOption')) {
                togglesrc.attr('src', 'assets_d/images/liked.svg');
                togglename.text('Liked');
            } else if ($(this).hasClass('supportMenu')) {
                togglesrc.attr('src', 'assets_d/images/support-dashboard.svg');
                togglename.text('Support');
            } else if ($(this).hasClass('celebrateMenu')) {
                togglesrc.attr('src', 'assets_d/images/celebrate-dashboard.svg');
                togglename.text('Celebrate');
            } else if ($(this).hasClass('curiousMenu')) {
                togglesrc.attr('src', 'assets_d/images/curious-dashboard.svg');
                togglename.text('Curious');
            } else if ($(this).hasClass('insightMenu')) {
                togglesrc.attr('src', 'assets_d/images/insight-dashboard.svg');
                togglename.text('Insight');
            } else if ($(this).hasClass('loveMenu')) {
                togglesrc.attr('src', 'assets_d/images/love-dashboard.svg');
                togglename.text('Love');
            }
        });
        $('.innerReplyBox').slideUp();
        $('.leftStatus a.reply').on('click', function () {
            $(this).siblings('.innerReplyBox').slideDown();
        });
        $('.uloadedImage .close').click(function () {
            $(this).parent().hide();
        });
        $('.notification').on('click', function () {
            let imgsrc = $(this).children('img');
            if (imgsrc.hasClass('notification-disabled')) {
                imgsrc.attr('src', base_url + 'assets_d/images/alert.svg');
                imgsrc.attr('class', 'notification-active')
            } else {
                imgsrc.attr('src', base_url + 'assets_d/images/alert-grey.svg');
                imgsrc.attr('class', 'notification-disabled')
            }
        });
        // Ends
        $('.sortWrapper li:not(:first-child)').on('click', function () {
            let toggleImgItem = $(this).children('img');
            let toggleViewWrapper = $(this).parent().parent().parent().siblings('.tabPaneWrapper').children('.left').children('.userBoxWrapper');
            // let toggleViewWrapper = $('.userBoxWrapper');
            $('.sortWrapper li').removeClass('active');
            if ($(this).hasClass('grid')) {
                $(this).addClass('active');
                toggleImgItem.attr('src', base_url + 'assets_d/images/grid-box-blue.svg');
                $('.sortWrapper li.list').children('img').attr('src', base_url + 'assets_d/images/list-box-grey.svg');
                if (toggleViewWrapper.hasClass('listview')) {
                    toggleViewWrapper.removeClass('listview').addClass('gridview');
                }
            } else if ($(this).hasClass('list')) {
                $(this).addClass('active');
                toggleImgItem.attr('src', base_url + 'assets_d/images/list-box-blue.svg');
                $('.sortWrapper li.grid').children('img').attr('src', base_url + 'assets_d/images/grid-box-grey.svg');
                if (toggleViewWrapper.hasClass('gridview')) {
                    toggleViewWrapper.removeClass('gridview').addClass('listview');
                }
            }
        });
        // Tab sort for id="pers"
        $('#peers .sortWrapper li:not(:first-child)').on('click', function () {
            let toggleImgItem = $(this).children('img');
            // let toggleViewWrapper = $(this).parent().parent().parent().siblings('.tab-content').children('.tab-pane.active').children('tabPaneWrapper').children('.left').children('.userBoxWrapper');
            let toggleViewWrapper = $('.userBoxWrapper');
            $('.sortWrapper li').removeClass('active');
            if ($(this).hasClass('grid')) {
                $(this).addClass('active')
                toggleImgItem.attr('src', 'images/grid-box-blue.svg');
                $('.sortWrapper li.list').children('img').attr('src', 'images/list-box-grey.svg');
                if (toggleViewWrapper.hasClass('listview')) {
                    toggleViewWrapper.removeClass('listview').addClass('gridview');
                }
            } else if ($(this).hasClass('list')) {
                $(this).addClass('active')
                toggleImgItem.attr('src', 'images/list-box-blue.svg');
                $('.sortWrapper li.grid').children('img').attr('src', 'images/grid-box-grey.svg');
                if (toggleViewWrapper.hasClass('gridview')) {
                    toggleViewWrapper.removeClass('gridview').addClass('listview');
                }
            }
        });
        // Tab sort for id="market"
        $('#market .sortWrapper li:not(:first-child)').on('click', function () {
            let toggleImgItem = $(this).children('img');
            // let toggleViewWrapper = $(this).parent().parent().parent().siblings('.tab-content').children('.tab-pane.active').children('tabPaneWrapper').children('.left').children('.userBoxWrapper');
            let toggleViewWrapper = $('.userBoxWrapper');
            $('.sortWrapper li').removeClass('active');
            if ($(this).hasClass('grid')) {
                $(this).addClass('active')
                toggleImgItem.attr('src', 'images/grid-box-blue.svg');
                $('.sortWrapper li.list').children('img').attr('src', 'images/list-box-grey.svg');
                if (toggleViewWrapper.hasClass('listview')) {
                    toggleViewWrapper.removeClass('listview').addClass('gridview');
                }
            } else if ($(this).hasClass('list')) {
                $(this).addClass('active')
                toggleImgItem.attr('src', 'images/list-box-blue.svg');
                $('.sortWrapper li.grid').children('img').attr('src', 'images/grid-box-grey.svg');
                if (toggleViewWrapper.hasClass('gridview')) {
                    toggleViewWrapper.removeClass('gridview').addClass('listview');
                }
            }
        });
        $('.shareMenu.shareOption li:not(:last-child)').click(function () {
            $(this).children('a').toggleClass('active')
        });

        $('.shareMenu.shareOption li.dropdown').click(function () {
            $(this).addClass('active');
        });
        $(document).click(function (e) {
            var container = $(".shareMenu.shareOption ul li.dropdown");

            // if the target of the click isn't the container nor a descendant of the container
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                container.removeClass('active');
            }
        });
        $('.reportSection li').on('click', function () {
            $(this).toggleClass('active');
        });
    });
</script>
</body>
</html>