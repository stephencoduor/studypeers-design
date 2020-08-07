"use strict"; // Start of use strict


function thmOwlCarousel() {
    if ($('.app-features-carousel').length) {
        $('.app-features-carousel').owlCarousel({
            loop: true,
            margin: 30,
            nav: true,
            center: true,
            navText: [
                '<i class="fa fa-angle-left"></i>',
                '<i class="fa fa-angle-right"></i>'
            ],            
            dots: false,
            autoWidth: false,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 1
                },
                600: {
                    items: 2
                },
                768: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        });
    };
    if ($('.blog-carousel').length) {
        $('.blog-carousel').owlCarousel({
            loop: true,
            margin: 30,
            nav: true,
            center: true,
            navText: [
                '<i class="fa fa-angle-left"></i>',
                '<i class="fa fa-angle-right"></i>'
            ],            
            dots: false,
            autoWidth: false,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 1
                },
                600: {
                    items: 2
                },
                768: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        });
    }; 
    if ($('.tweets-carousel').length) {
        $('.tweets-carousel').owlCarousel({
            loop: true,
            margin: 0,
            nav: true,
            center: true,
            navText: [
                '<i class="fa fa-angle-left"></i>',
                '<i class="fa fa-angle-right"></i>'
            ],            
            dots: false,
            autoWidth: false,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            items: 1
        });
    }; 
    if ($('.team-carousel').length) {
        $('.team-carousel').owlCarousel({
            loop: true,
            margin: 30,
            nav: false,
            navText: [
                '<i class="fa fa-angle-left"></i>',
                '<i class="fa fa-angle-right"></i>'
            ],            
            dots: true,
            autoWidth: false,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1,
                    dots: false,
                    nav: true
                },
                480: {
                    items: 1,
                    dots: false,
                    nav: true
                },
                568: {
                    items: 2,
                    dots: false,
                    nav: true
                },
                600: {
                    items: 3,
                    dots: false,
                    nav: true
                },
                823: {
                    items: 3,
                    dots: false,
                    nav: true
                },
                1000: {
                    items: 4
                }
            }
        });
    }; 
    if ($('.testimonials-carousel').length) {
        $('.testimonials-carousel').owlCarousel({
            loop: true,
            margin: 0,
            nav: false,
            navText: [
                '<i class="fa fa-angle-left"></i>',
                '<i class="fa fa-angle-right"></i>'
            ],            
            dots: false,
            autoWidth: false,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 1
                },
                823: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        });
    };    
}

function thmbxSlider() {
    
    if ($('.how-app-work-slider-wrapper .slider').length) {
        $('.how-app-work-slider-wrapper .slider').bxSlider({
            // adaptiveHeight: true,
            auto:false,
            controls: false,
            pause: 3000,
            speed: 500,
            pagerCustom: '#how-app-work-slider-pager'
        });
    }
    if ($('.testimonials-slider .slider').length) {
        $('.testimonials-slider .slider').bxSlider({
            // adaptiveHeight: true,
            auto:false,            
            controls: true,
            nextText: '<i class="fa fa-arrow-right"></i>',
            prevText: '<i class="fa fa-arrow-left"></i>',
            mode: 'fade',
            pause: 3000,
            speed: 500,
            pager: true,
            pagerCustom: '#testimonials-slider-pager'
        });
    }
}




// instance of fuction while Window Load event
jQuery(window).on('load', function() {
    (function($) {
        thmbxSlider();
        
    })(jQuery);
});
