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
$("#featured_image-document").change(function() {
    readURLDocument(this);
});
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
//     if($(window).width() <= 1400) {
//     $('aside').addClass('active');
//     $('.mainContent').addClass('active');
// }
$('.desktopToggleButton').on('click',()=>{
    $('.mainContent').toggleClass('active');
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


// $("body,.sidebar-content,.listChatBox,.rightsidemsgbar,.listUserWrap,.listChatWrap,.eventWrapper").niceScroll(
//   {
//     cursorwidth:"8",
//     cursorcolor:"#000",
//     scrollspeed:"100",
//     touchbehavior:false,
//     boxzoom: true,
//     cursor:false,
//     smoothscroll:true,
//     autohidemode:false,
//     zindex:9999999,
//     background:"#e3e3e3"
//   });
$(document).ready(function(){
    // $(".sidebar-content,.listChatBox,.rightsidemsgbar,.listUserWrap,.listChatWrap,.eventWrapper").mCustomScrollbar({
    //     theme:"dark-thin",
    //     autoExpandScrollbar:true,
    //     advanced:{autoExpandHorizontalScroll:true}
    // });
});
$(document).ready(function(){
    // $("body,.sidebar-content,.listChatBox,.rightsidemsgbar,.listUserWrap,.listChatWrap,.eventWrapper").mCustomScrollbar({
    //     theme:"dark-thin",
    //     autoExpandScrollbar:true,
    //     advanced:{autoExpandHorizontalScroll:true}
    // });
});
// (function($){
//   $(window).on("load",function(){

//     $("body").mCustomScrollbar({
//       theme:"minimal"
//     });

//   });
// })(jQuery);


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
    // $('.replyuser').on('click',()=>{
        
    //     $('.chatMsg').addClass('reply');
    // })
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
$('.flipper').on('click', function(){
    $(this).toggleClass('is-flipped');
    $('.flashcard-controls').addClass('active');
})
$('.showAnwer').on('click',()=>{
    $('.flipper').toggleClass('is-flipped');
})
$('.showResult').on('click',()=>{
    $('.flashcard_result').addClass('active');
$('.flashcard-controls').removeClass('active');
$('.flashcards').removeClass('active');
})
$( ".match-item" ).draggable({
    start: function(e, ui) {
        $(this).css({"z-index": "5"});
        drag_id = $(this).attr('id');
    }
});

$(".match-item").droppable({
    drop: function( event, ui ) {
        var drop_data_id = $(this).attr('data-id');
        var drag_data_id = $('#'+drag_id).attr('data-id');

        var correct_count = parseInt($('#correct_count').html());
        var missed_count  = parseInt($('#missed_count').html());
        var missed_terms  = $('#missed_terms').val();

        var drop_type = $(this).attr("data-type");
        var drag_type = $('#'+drag_id).attr("data-type");

        if(drop_data_id == drag_data_id){
            $(this).hide(500);
            $('#'+drag_id).hide(500);

            if( (missed_terms.split(',').indexOf(drag_data_id) > -1) || (missed_terms.split(',').indexOf(drop_data_id) > -1) ) {

            } else {
                var n = correct_count+1;
                var formattedNumber = ("0" + n).slice(-2);
                $('#correct_count').html(formattedNumber);
            }


            var count = $(".match-item:visible").length;
            if(count == 2){
                submitMatchData();
            }
        } else {
            $(this).css({"border-color": "red"});
            var drop_id = $(this).attr('id');


            $('#'+drag_id).css({"border-color": "red"});

            if(drag_type == "term") {

                if(missed_terms != ""){
                    if( (missed_terms.split(',').indexOf(drag_data_id) != 0)){
                        $('#missed_terms').val(missed_terms+','+drag_data_id);
                        var n = missed_count+1;
                        var formattedNumber = ("0" + n).slice(-2);
                        $('#missed_count').html(formattedNumber);
                    }
                } else {
                    $('#missed_terms').val(drag_data_id);
                    var n = missed_count+1;
                    var formattedNumber = ("0" + n).slice(-2);
                    $('#missed_count').html(formattedNumber);
                }


            } else if(drop_type == "term") {

                if(missed_terms != ""){
                    if( (missed_terms.split(',').indexOf(drop_data_id) != 0)){
                        $('#missed_terms').val(missed_terms+','+drop_data_id);
                        var n = missed_count+1;
                        var formattedNumber = ("0" + n).slice(-2);
                        $('#missed_count').html(formattedNumber);
                    }
                } else {
                    $('#missed_terms').val(drop_data_id);
                    var n = missed_count+1;
                    var formattedNumber = ("0" + n).slice(-2);
                    $('#missed_count').html(formattedNumber);
                }


            }

            var rand_x = 0;
            var rand_y = 0;
            var i = 0;
            var smallest_overlap = 9007199254740992;
            var best_choice;
            var area;
            for (i = 0; i < maxSearchIterations; i++) {
                rand_x = Math.round(min_x + ((max_x - min_x) * (Math.random() % 1)));
                rand_y = Math.round(min_y + ((max_y - min_y) * (Math.random() % 1)));
                area = {
                    x: rand_x,
                    y: rand_y,
                    width: $(this).width(),
                    height: $(this).height()
                };
                var overlap = calc_overlap(area);
                if (overlap < smallest_overlap) {
                    smallest_overlap = overlap;
                    best_choice = area;
                }
                if (overlap === 0) {
                    break;
                }
            }

            filled_areas.push(best_choice);
            $('#'+drag_id).animate({
                left: rand_x,
                top: rand_y
            });
            setTimeout(function(){
                    $('#'+drop_id).stop().animate({"border-color": "#eee"}, "slow");
                    $('#'+drag_id).stop().animate({"border-color": "#eee"}, "slow");

                },
                500);

        }



    }
});



$('#nextFilp').click(function() {
    if (!$('.choose_btn').hasClass('selected') && !$('.current').hasClass('last')) {
        var markCount = parseInt($('#markCount').html());
        var n = markCount+1;
        var formattedNumber = ("0" + n).slice(-2);
        $('#markCount').html(formattedNumber);

        var remainingCount = parseInt($('#remainingCount').html());
        var n = remainingCount-1;
        var formattedNumber = ("0" + n).slice(-2);
        $('#remainingCount').html(formattedNumber);
    }
    $('.choose_btn').removeClass('selected');
    $('.current').removeClass('current').hide()
        .next().show().addClass('current');
    if ($('.current').hasClass('last')) {
        $('#nextFilp').addClass('disabled');
        $("#nextFilp").css("pointer-events", "none");

    }
    if($('.current').hasClass("is-flipped")){
        $('.flashcard-controls').addClass('active');
    } else {
        $('.flashcard-controls').removeClass('active');
    }

    var current = $('.current').attr("data-id");
    var termsSeen = $('#termsSeen').val();

    if(termsSeen != ''){
        if( (termsSeen.split(',').indexOf(current) > -1) ) {
            var correctTerms = $('#correctTerms').val();
            var incorrectTerms = $('#incorrectTerms').val();
            var notSureTerms = $('#notSureTerms').val();
            var hideTerms = $('#hideTerms').val();
            if(correctTerms != ''){
                if( (correctTerms.split(',').indexOf(current) > -1)) {
                    $('.correct').addClass('selected');
                }
            } if(incorrectTerms != ''){
                if( (incorrectTerms.split(',').indexOf(current) > -1)) {
                    $('.incorrect').addClass('selected');
                }
            } if(notSureTerms != ''){
                if( (notSureTerms.split(',').indexOf(current) > -1)) {
                    $('.not-sure').addClass('selected');
                }
            } if(hideTerms != ''){
                if( (hideTerms.split(',').indexOf(current) > -1)) {
                    $('.hidecard').addClass('selected');
                }
            }
        }
    }

    $('#prevFlip').removeClass('disabled');
    $("#prevFlip").css("pointer-events", "auto");
});

$('#prevFlip').click(function() {
    $('.choose_btn').removeClass('selected');
    $('.current').removeClass('current').hide()
        .prev().show().addClass('current');
    if ($('.current').hasClass('first')) {
        $('#prevFlip').addClass('disabled');
        $("#prevFlip").css("pointer-events", "none");
    }
    if($('.current').hasClass("is-flipped")){
        $('.flashcard-controls').addClass('active');
    } else {
        $('.flashcard-controls').removeClass('active');
    }

    var current = $('.current').attr("data-id");
    var termsSeen = $('#termsSeen').val();

    if(termsSeen != ''){
        if( (termsSeen.split(',').indexOf(current) > -1) ) {
            var correctTerms = $('#correctTerms').val();
            var incorrectTerms = $('#incorrectTerms').val();
            var notSureTerms = $('#notSureTerms').val();
            var hideTerms = $('#hideTerms').val();
            if(correctTerms != ''){
                if( (correctTerms.split(',').indexOf(current) > -1)) {
                    $('.correct').addClass('selected');
                }
            } if(incorrectTerms != ''){
                if( (incorrectTerms.split(',').indexOf(current) > -1)) {
                    $('.incorrect').addClass('selected');
                }
            } if(notSureTerms != ''){
                if( (notSureTerms.split(',').indexOf(current) > -1)) {
                    $('.not-sure').addClass('selected');
                }
            } if(hideTerms != ''){
                if( (hideTerms.split(',').indexOf(current) > -1)) {
                    $('.hidecard').addClass('selected');
                }
            }
        }
    }

    $('#nextFilp').removeClass('disabled');
    $("#nextFilp").css("pointer-events", "auto");
});


$(document).ready(function(){
    $('.likecount a').click(function(){
        $(this).find('i').toggleClass('fa-thumbs-o-up fa-thumbs-up');
        $(this).toggleClass('active');
    })
})


//Add Course
$('.add_course').on('click', function(){
    var coursebox = $('#courseModal .courseBox'),
        cloneBox = $('#courseModal .courseBox').eq(0).clone(true, true),
        num = $('#courseModal .courseBox').length;
    cloneBox.find('input:text').val('');
    cloneBox.find('.removeCourseBox').show();
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
});




function validateCourse(){

    var flag1 = 1; var flag2 = 1; var flag3 = 1;

    $('#course_form').find('.course_name').each(function(){
        if($(this).val() == ''){
            $(this).css('border-color', 'red');
            flag1 = 0;
        } else {
            $(this).css('border-color', '#ccc');
        }
    });

    $('#course_form').find('.professor_first_name').each(function(){
        if($(this).val() == ''){
            $(this).css('border-color', 'red');
            flag2 = 0;
        } else {
            $(this).css('border-color', '#ccc');
        }
    });

    $('#course_form').find('.professor_last_name').each(function(){
        if($(this).val() == ''){
            $(this).css('border-color', 'red');
            flag3 = 0;
        } else {
            $(this).css('border-color', '#ccc');
        }
    });


    if(flag1 == 0 || flag2 == 0 || flag3 == 0){
        return false;
    }

}


function showAllCourses(url){
    $.ajax({
        url: url,
        type: 'POST',
        data: {'val': 1},
        dataType: "json",
        success: function(result) {
            $('#courseModalAllBody').html(result.html);
            $('#courseModalAll').modal('show');
            if(result.num>=2) {
                $('#courseModalAll .modal-body').addClass('scroll');
            }
        }
    });
}




// resize
$(window).resize(function() {
    
    if($(window).width() <= 991) {
        $('.rightsidemsgbar').css("transform","translateX(800px)");
        $('.mainContent').addClass('msgActive');
    } else {
        $('.rightsidemsgbar').css("transform","translateX(0px)");
        $('.mainContent').removeClass('msgActive');
    }
})



$("#course_form").submit(function(e) {
    var pathname = window.location.pathname;
    
    e.preventDefault(); // avoid to execute the actual submit of the form.

    var chk = validateCourse(); 
    if(chk !== false) {
        var form = $(this);
        var url = form.attr('action');
    
        $.ajax({
           type: "POST",
           url: url,
           data: form.serialize() + '&page=' + pathname, // serializes the form's elements.
           success: function(data)
           {    if(pathname == '/account/dashboard') {
                    $('#courseModal').modal('hide');
                    $('#course_count_dashboard').html(data);
                    $("#course_form")[0].reset();
               } else {
                    $('#courseModal').modal('hide');
                    $('#course').html(data);
                    $("#course_form")[0].reset();
               }
               
           }
         });
    }

    
});


function validateQuestionAnswer(id){
    var answer = $('#definition_'+id).val();
    if(answer == ''){
        $('#err_definition_'+id).html("This field is required").show();
        return false;
    } else {
        $('#err_definition_'+id).html("").hide();
    }
}

$(document).on('submit','form.submitQuestionAnswer',function(e){
    var pathname = window.location.pathname;
    var form = $(this);
    var id = form.attr('id'); 
    e.preventDefault(); // avoid to execute the actual submit of the form.

    var chk = validateQuestionAnswer(id); 
    if(chk !== false) {
        
        var url = form.attr('action');
    
        $.ajax({
           type: "POST",
           url: url,
           data: form.serialize() + '&page=' + pathname, // serializes the form's elements.
           success: function(data)
           {    
               $('#replyAnswerBox'+id).append(data);
               $('#dashboard-qa-answer-'+id).hide();
           }
         });
    }

    
});

    $(function() { 
        $('#start-date'). keypress(function(event) { event. preventDefault(); return false; }); 
        $('#end-date'). keypress(function(event) { event. preventDefault(); return false; }); 
        $('#selectTime1 .form-control'). keypress(function(event) { event. preventDefault(); return false; }); 
        
        $("#start-date,#end-date").on('keydown',  function(event){
            var key = event.charCode || event.keyCode || event.which;
            var char = String.fromCharCode(event.key);
            if( key === 8 || key=== 46 ){
                event.preventDefault();
                return false;
            }	
            else {		
                $("#start-date,#end-date").append(char);
            }
        });
        $("#selectTime1 .form-control").on('keydown',  function(event){
            var key = event.charCode || event.keyCode || event.which;
            var char = String.fromCharCode(event.key);
            if( key === 8 || key=== 46 ){
                event.preventDefault();
                return false;
            }	
            else {		
                $("#selectTime1 .form-control").append(char);
            }
        });
        $("#start-date, #end-date").on('keydown',  function(event){
            var key = event.charCode || event.keyCode || event.which;// alert (key);
            var char = String.fromCharCode(event.key);
            if( key === 8 || key=== 46  ){
                event.preventDefault();
                return false;
            }	else {		
                $("#start-date, #end-date").append(char);
            }
        });
    }); 