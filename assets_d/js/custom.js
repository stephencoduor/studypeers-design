$(document).ready(function() {
    wrapupToggle();
    if($(window).width() <= 479) {
        $('.search').click(function(){
            $('.search').addClass('active');
            $('.removeSearch').css('display','block');
        });
        $('.removeSearch').click(function(){
            $(this).parent('.search').removeClass('active');
            $('.removeSearch').css('display','none');
        });
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
    $('.desktopToggleButton').on('click',function(){
        $('.mainContent').toggleClass('active');
        $('aside').toggleClass('active');
    })
    if($(window).width() <= 991) {
        $('aside').addClass('active');
        $('.mainContent').addClass('active');
    }
    $('#sidenav').on('click',function(){
        $('#sidenav').toggleClass('open');
        $('aside').toggleClass('active');
        $('.overlay').toggleClass('active');
    })
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
        $('#user_rating').val(currentRating);
        $("#err_user_rating").html('').hide();
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
    if($('.current .back .flashImg').find('img').length > 0) {
        $('.flashcards').addClass('flash-has-img'); 
    } else {
        $('.flashcards').removeClass('flash-has-img'); 
    }
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
    cloneBox.find('.course_name').attr("id", "course_name_"+num);
    cloneBox.find('.course_name').attr('data-id', num);
    cloneBox.find('.course_id').attr("id", "course_id_"+num);
    cloneBox.find('.professor_first_name').attr("id", "professor_first_name_"+num);
    cloneBox.find('.professor_last_name').attr("id", "professor_last_name_"+num);
    cloneBox.find('.autocomplete-items').attr("id", "myInputautocomplete-list-"+num);
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
    if($(window).width() >= 767) {
        $('aside').removeClass('active');
        $('.mainContent').removeClass('active');
    }
});
if($(window).width() >= 767) {
    $('aside').removeClass('active');
    $('.mainContent').removeClass('active');
}
$("#course_form").submit(function(e) {
    var pathname = window.location.pathname.split("/").pop();
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var chk = validateCourse(); 
    if(chk !== false) {
        var form = $(this);
        var url = form.attr('action');

        $.ajax({
           type: "POST",
           url: url,
           data: form.serialize() + '&page=' + pathname, // serializes the form's elements.
           success: function(data) {    
                if(pathname == 'dashboard') {
                        $('#courseModal').modal('hide');
                        $('#course_count_dashboard').html(data);
                        $("#course_form")[0].reset();
                } else {
                    $('#courseModal').modal('hide');
                    $('#course').html(data);
                    getProfessor();
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
            success: function(data) {    
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
$(".navbar-brand-icon").click(function(){
    $('.rightsidemsgbar').css("transform","translateX(0px)");;
    $(".mainContent").removeClass("msgActive")
});
$(document).ready(function(){
    $(".flashcards").click(function(){
        $(this).toggleClass("show");
    });
    $("#nextFilp").click(function(){
        $(".flashcards").removeClass("show");
    });
    $(".show-dropdown").click(function(){
        $(".dropdown-area").toggleClass("open");
    });
});
$(window).on("load", function () {
    $('.sidebar-content').mCustomScrollbar({ 
        theme:"dark-3"        
    });
    $('.listUserWrap').mCustomScrollbar({ 
            theme:"dark-3"        
    });
    $('.eventDetail').mCustomScrollbar({ 
        theme:"dark-3"        
    });
});

$(document).on('keydown keypress keyup click','#search-info',function(){
	$("#search-result").css("display","block");
	var search_val = $(this).val();
	$('.no-search').hide();
	
	if(search_val.length > 0 && (search_val != '' || typeof search_val !== "undefined"))
	{
		$("#searchPeeersLoader").show();
		$(".searchresulttext").html('Search for something');
		
		$.ajax({
			type: 'POST',		
			url: $("#searchAction").val(),
			data: {search_val : search_val},
			dataType:'json',
			success: function (response)
			{
				$("#searchPeeersLoader").hide();
				if(response.status == true){
					$(".removeSearchIcon").show();
					if(response.search_html == ''){
						$(".searchresulttext").html('No result found!');
						$(".no-search").show();
						$(".searchResultClass").hide();
						$(".searchResultClassView").hide();
					} else {
						$(".searchResultClass").show();
						$(".searchResultClassView").show();
						$(".searchResultClass").html(response.search_html);	
						$(".searchresulttext").html('Search for something');
						$(".no-search").hide();
					}
				} else {
					$(".searchresulttext").html('No result found!');
					$(".no-search").show();
					alert(response.message);
				}
			},
			timeout: 10000,
			error: function(e){
				$("#searchPeeersLoader").hide();
				return false;
			}
		});
	}
	else
	{
		$(".searchresulttext").html('Search for something');
		$('.no-search').show();
		$(".searchResultClass").hide();
		$(".searchResultClassView").hide();
		$(".searchResultClass").html('');
	}
});

$(document).on('keydown keypress keyup','#search-info',function(e){
	var search_val = $(this).val();
	if(search_val.length > 0 && (search_val != '' || typeof search_val !== "undefined")){
		if (e.key === 'Enter' || e.keyCode === 13) {
			
			var search_text    = $("#search-info").val();
			var search_user_id = ($(this).attr('data-user_id')) ? $(this).attr('data-user_id') : 0; 
			
			var me = $(this);
			e.preventDefault();
			
			if (me.data('requestRunning')) {
				return;
			}
			
			me.data('requestRunning', true);
			$(".removeSearchIcon").show();
			$.ajax({
				type: 'POST',		
				url: $("#searchStore").val(),
				data: {search_text : search_text,search_user_id : search_user_id},
				dataType:'json',
				success: function (response){
					window.location.href = $("#searchResultAction").val();
				},
				complete: function() {
					me.data('requestRunning', false);
				},
				timeout: 10000,
				error: function(e){
					$("#searchPeeersLoader").hide();
					return false;
				}
			});
		}
	}
});

$(document).on('focus click','#search-info',function(e){
	$(".search-info-wrp").addClass("active");
	
	if($(this).val() == ''){
		$("#searchPeeersLoader").show();
		
		var me = $(this);
		e.preventDefault();
		
		if (me.data('requestRunning')) {
			return;
		}
		
		me.data('requestRunning', true);
		
		$.ajax({
			type: 'POST',		
			url: $("#searchHistoryAction").val(),
			dataType:'json',
			success: function (response)
			{
				$("#searchPeeersLoader").hide();
				if(response.status == true){
					$(".removeSearchIcon").show();
					if(response.search_html == ''){
						$(".searchresulttext").html('No result found!');
						$(".no-search").show();
						$(".searchResultClass").hide();
						$(".searchResultClassView").hide();
					} else {
						$(".searchresulttext").html('Search for something');
						$(".no-search").hide();
						$(".searchResultClass").show();
						$(".searchResultClassView").show();
						$(".searchResultClass").html(response.search_html);	
					}
				} else {
					$(".searchresulttext").html('No result found!');
					$(".no-search").show();
					alert(response.message);
				}
			},
			complete: function() {
				me.data('requestRunning', false);
			},
			timeout: 10000,
			error: function(e){
				$("#searchPeeersLoader").hide();
				return false;
			}
		});	
	}
});

$(document).on("click touchstart", function(e) {	
	var t = $(e.target).closest('.search');
	var exceptDiv = $('.search');
	
	if(exceptDiv.is(t) == false) {
		$('.no-search').show();
		$(".search-info-wrp").removeClass("active");
		$(".searchResultClass").hide();
		$(".searchResultClassView").hide();
		$(".searchResultClass").html('');
		$(".removeSearchIcon").hide();
	}
});

$(document).on('click','.removeSearchIcon',function(){
	$('.no-search').show();
	$(".search-info-wrp").removeClass("active");
	$(".searchResultClass").hide();
	$(".searchResultClassView").hide();
	$(".searchResultClass").html('');
	$(this).hide();
});

$(document).on('click','.storeHistory',function(){
	var search_text    = $("#search-info").val();
	var search_user_id = $(this).attr('data-user_id'); 
	$.ajax({
		type: 'POST',		
		url: $("#searchStore").val(),
		data: {search_text : search_text,search_user_id : search_user_id},
		dataType:'json',
		success: function (response){
			$(".removeSearchIcon").show();
		},
		timeout: 10000,
		error: function(e){
			$("#searchPeeersLoader").hide();
			return false;
		}
	});

    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:true
            },
            600:{
                items:2,
                nav:true
            },
            1024:{
                items:3,
                nav:true,
                loop:false
            },
            1280:{
                items:4,
                nav:true,
                loop:false
            }
        }
    })

    $(activate);

    function activate() {
      $('.scroll-tabs')
        .scrollingTabs({
          enableSwiping: true
        })
        .on('ready.scrtabs', function() {
          $('.tab-content').show();
        });
    }

});

$(document).on('click','.removeBadgeIcon',function(){
	var historyId = $(this).attr('data-historyId');
	
	$.ajax({
		type: 'POST',		
		url: $("#removeStoredSearch").val(),
		data: {historyId : historyId},
		dataType:'json',
		success: function (response){
			$(".searchHistory_"+historyId).fadeOut(500);
			
			setTimeout(function(){
               $(".searchHistory_"+historyId).remove(); 

				if($(".searchResultClass li").length == 0){
					$('.no-search').show();
					$(".search-info-wrp").removeClass("active");
					$(".searchResultClass").hide();
					$(".searchResultClassView").hide();
					$(".searchResultClass").html('');
					$(".removeSearchIcon").hide();
				}
			},500);
		},
		timeout: 10000,
		error: function(e){
			$("#searchPeeersLoader").hide();
			return false;
		}
	});
});

$(document).on('click','.reportThings',function(){
	var reportType  = $(this).attr('data-reportType');
	var primaryId   = $(this).attr('data-primaryId');
	var currentPage = $(this).attr('data-currentPage');
	
	$("#reportModal").modal('show');
	$("#primary_id").val(primaryId);
	$("#report_post_type").val(reportType);
	$("#current_page").val(currentPage);
});