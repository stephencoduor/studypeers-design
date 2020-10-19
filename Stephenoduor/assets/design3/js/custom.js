$(document).ready(() => {
  wrapupToggle();
  if($(window).width() <= 479) {
      $('.search').click(() =>{
        $('.search').addClass('active');
        $('.removeSearch').css('display','block');
      })
      $('.removeSearch').click(()=>{
        $(this).parent('.search').removeClass('active');
        alert();
        $('.removeSearch').css('display','none');
      })
  }
});

function wrapupToggle(){
      $('.navbar-brand').text ('');
      $('.navbar-brand').html('<span class="b-bar first"></span><span class="b-bar mid"></span><span class="b-bar last"></span>');

     // $('a.navbar-brand').on('click',function(){
          // $(this).toggleClass('active');
          // $('body').toggleClass('sidenav-open');
          // $('aside').toggleClass('active');
          // $('.mainContent').toggleClass('active');
          // if($('.navbar-collapse').hasClass('in')){
          //     $('.navbar-collapse').removeClass('in');
          // }
          // if($(window).width() <= 991) {
          //   $('.overlay').toggleClass('active');
          // }
     // })
}
$('.rightsidemsgbar').css("transform","translateX(0px)");
// $('.mainContent').addClass('msgActive');

$('.navbar-brand').on('click',()=>{
  $('.rightsidemsgbar').css("transform","translateX(0px)");
  $('.mainContent').removeClass('msgActive');
  $('.filterWrapper').addClass('active');
  if($(window).width() <= 991) {
    $('.overlay').addClass('active');
  }
});
if($(window).width() <= 991) {
  $('.rightsidemsgbar').css("transform","translateX(800px)");
}
$('.view.message').on('click',() =>{
  $('.rightsidemsgbar').css("transform","translateX(800px)");
  $('.mainContent').addClass('msgActive');
  $('.filterWrapper').removeClass('active');
  if($(window).width() <= 991) {
    $('.overlay').removeClass('active');
  }
});
$(document).ready(() => {
  if($(window).width() <= 1400) {
    $('aside').addClass('active');
    $('.mainContent').addClass('active');
  }
  $('.desktopToggleButton').on('click',()=>{
      // $('.mainContent').toggleClass('active');
      $('aside').toggleClass('active');
  })
    if($(window).width() <= 991) {
      $('aside').addClass('active');
      $('.mainContent').addClass('active');
    }
    $('#sidenav').on('click',()=>{
      $('#sidenav').toggleClass('open');
      $('aside').toggleClass('active');
      $('.overlay').toggleClass('active');
    })
});


$(".sidebar-content,.listChatBox,.rightsidemsgbar,.listUserWrap,.listChatWrap,.eventWrapper").niceScroll(
  {
    cursorwidth:"8",
    cursorcolor:"#000",
    scrollspeed:"100",
    touchbehavior:false,
    boxzoom: true,
    cursor:false,
    smoothscroll:true,
    autohidemode:false,
    zindex:9999999,
    background:"#e3e3e3"
  });



//study-set JS
$(document).ready(function() {
    $('.institutions,.course,.professor').select2();
    $('.filterForm').addClass('collapse');
    $('.filterBtn').on('click',()=>{
      $('.filterForm').toggleClass('collapse');
      $(this).toggleClass('show');
    })
    $('.viewList').on('click',()=>{
      $('.feedWrapper').toggleClass('listView');
    });

    if($(window).width() <= 767) {
      $('.filterForm').removeClass('collapse');
    }
    $('.replyuser').on('click',()=>{
      // $(this).parent('ul').parent('.actionmsgMenu').parent('figcaption').parent('.chatMsg').addClass('reply');
      $('.chatMsg').addClass('reply');
    })
});
$(".my-rating-4").starRating({
  totalStars: 5,
  starShape: 'rounded',
  starSize: 20,
  emptyColor: 'lightgray',
  hoverColor: 'salmon',
  // activeColor: 'crimson',
  strokeColor:'#ffb770',
  useGradient: false,
  readOnly: true,
  callback: function(currentRating, $el){
      console.log('The user rated: ' +  currentRating);
      // $('.live-rating').text(currentRating);
  }
  // $('.live-rating').text(currentIndex);
});
$(".my-rating-5").starRating({
  totalStars: 5,
  starShape: 'rounded',
  starSize: 32,
  emptyColor: 'lightgray',
  hoverColor: 'salmon',
  // activeColor: 'crimson',
  strokeColor:'#ffb770',
  useGradient: false,
  readOnly: true,
  callback: function(currentRating, $el){
      console.log('The user rated: ' +  currentRating);
  }
});
$(".my-rating-6").starRating({
  totalStars: 5,
  starShape: 'rounded',
  starSize: 32,
  emptyColor: 'lightgray',
  hoverColor: '#ffd700',
  activeColor: '#ffd700',
  strokeColor:'#ffd700',
  useGradient: false,
  callback: function(currentRating, $el){
      console.log('The user rated: ' +  currentRating);
  }
});
$(document).ready(()=>{
  $('.edit_rating').on('click',()=>{
      $('.rating_view').addClass('hide');
      $('.edit_rating').removeClass('hide');
  });
})
$('.flipper').on('click',()=>{
  $('.flipper').toggleClass('is-flipped');
})
$('.showAnwer').on('click',()=>{
  $('.flipper').toggleClass('is-flipped');
})
$('.showResult').on('click',()=>{
    $('.flashcard_result').addClass('active');
    $('.flashcard-controls').removeClass('active');
    $('.flashcards').removeClass('active');
})
$( ".match-item" ).draggable();

$(document).ready(function(){
  $('.likecount a').click(function(){
     $(this).find('i').toggleClass('fa-thumbs-o-up fa-thumbs-up')
  })
})
//Add Course
$('.add_course').on('click', function(){
    var coursebox = $('.courseBox'),
    cloneBox = $('.courseBox').eq(0).clone(true, true),
    num = $('.courseBox').length;
    this.disabled = num+1 >=6;
    if(num>=2) {
      $('#courseModal .modal-body').addClass('scroll');
    }
    if(num<6) {
      cloneBox.attr('data-index',num).insertAfter(coursebox.eq(num-1));
    }
      if(coursebox.length >= 6) {
        $('.add_course').addClass("disabled");
    }
  })
  $(document).on('click','.courseBox > .removeCourseBox', function(){
    $(this).closest('.courseBox').remove();
    var coursebox = $('.courseBox');
      coursebox.attr('data-index', function(i) {
        return i === 0 ? '' : i;
      });
      if(coursebox.length <= 1) {
         $('#courseModal .modal-body').removeClass('scroll');
      }
      if(coursebox.length < 6) {
        $('.add_course').removeClass("disabled");
      }
  })




