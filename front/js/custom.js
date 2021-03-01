$('.tool-slide').slick({
    infinite: false,
    slidesToShow: 4,
    slidesToScroll: 4,
    dots: true,
    autoplay:true,
    arrow:false,
    responsive: [
        {
            breakpoint: 1100,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
            }
        },
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]
});
$('.studyTool-slide').slick({
    infinite: false,
    slidesToShow: 4,
    slidesToScroll: 4,
    dots: true,
    arrow:false,
    autoplay:true,
    responsive: [
        {
            breakpoint: 1100,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
            }
        },
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]
});
//js wow
//  wow = new WOW(
//     {
//       animateClass: 'animated',
//     // offset:       100,
//     callback:     function(box) {
//      // console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
//     }
//   }
// );
// wow.init();