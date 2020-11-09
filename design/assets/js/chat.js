function myFunction() {
    let input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
function searchUser() {
    let input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myUsers");
    filter = input.value.toUpperCase();
    ul = document.getElementById("userList");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}


$(document).ready(function(){
    $(document).on('click', ".minimize", function(){
        $(this).parents(".chat-wrapper").addClass("small");
        $(this).find(".change-icon").prop('src', 'assets/images/maximize.svg');
        $(this).parents(".chat-wrapper").find(".chat-left").hide();
    });
    $(document).on('click', ".maximize", function() {
        $(this).parents(".chat-wrapper").removeClass("small");
        $(this).find(".change-icon").prop('src', 'assets/images/minimize.svg'); 
        $(this).parents(".chat-wrapper").find(".chat-left").show();
    });

    $(document).on('click', ".open-chat", function() {
        $(".chat-wrapper").removeClass("hide-chat");
    });

    $("#myUL").on("click", "a", function(){
        $(".chat-wrapper").addClass("small").removeClass("hide-chat");
        $(".chat-wrapper").find(".chat-left").hide();
    });
    $(".chat-right").on("click", ".chat-close", function(){
        $(".chat-wrapper").addClass("hide-chat").removeClass("small");
        $(".chat-wrapper").find(".chat-left").show();

        $(".chat-wrapper").addClass("hide-chat").removeClass("small");
        $(".chat-wrapper").find(".chat-left").removeClass("hide");
        $(".chat-header-left").find("h3").removeClass("show");
        $(".basic-user-info").removeClass("hide");
        $(".chat-right").find(".chat-content").removeClass("hide");
        $(".chat-right").find(".chat-footer").removeClass("hide");
        $(".chat-right").find(".video-icon").removeClass("hide");
        $(".chat-right").find(".maximize").removeClass("hide");
        $(".chat-right").find(".start-conversation").removeClass("show");

        $(".chat-right").find(".chat-content").removeClass("hide");
        $(".chat-right").find(".chat-footer").removeClass("hide");
        $(".chat-right").find(".video-icon").removeClass("hide");
        $(".chat-header-left").find("h3").removeClass("show");
        $(".basic-user-info").removeClass("hide");
        $(".chat-right").find(".hide-on-small").removeClass("hide");
        $(".chat-right").find(".close-icon-wrap").removeClass("show");
        $(".chat-right").find(".start-conversation").removeClass("show");
    });
    $('#multiple').selectator({
        showAllOptionsOnFocus: true,
        searchFields: 'value text subtitle right'
    });
    $(".open-start-conversation").click(function(){
        $(".chat-wrapper").removeClass("hide-chat").addClass("small");
        $(".chat-wrapper").find(".chat-left").addClass("hide");
        $(".chat-header-left").find("h3").addClass("show");
        $(".basic-user-info").addClass("hide");
        $(".chat-right").find(".chat-content").addClass("hide");
        $(".chat-right").find(".chat-footer").addClass("hide");
        $(".chat-right").find(".video-icon").addClass("hide");
        $(".chat-right").find(".maximize").addClass("hide");
        $(".chat-right").find(".start-conversation").addClass("show");
    });

    $(".open-big-start").click(function(){
        $(".chat-right").find(".chat-content").addClass("hide");
        $(".chat-right").find(".chat-footer").addClass("hide");
        $(".chat-right").find(".video-icon").addClass("hide");
        $(".chat-header-left").find("h3").addClass("show");
        $(".basic-user-info").addClass("hide");
        $(".chat-right").find(".hide-on-small").addClass("hide");
        $(".chat-right").find(".close-icon-wrap").addClass("show");
        $(".chat-right").find(".start-conversation").addClass("show");
    });
});