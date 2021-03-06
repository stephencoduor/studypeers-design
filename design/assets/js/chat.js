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
        $(".chat-right").find(".add-user").removeClass("active");
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
    $(document).on('click', ".done-link", function() {
        $(".chat-right").find(".start-conversation").removeClass("show");
        $(".chat-right").find(".chat-content").removeClass("hide");
        $(".chat-right").find(".chat-footer").removeClass("hide");
        $(".chat-right").find(".chat-header-left").find("h3").removeClass("show");
        $(".chat-right").find(".chat-header-left").find(".basic-user-info").removeClass("hide");
        $(".chat-right").find(".hide-on-big").find(".maximize").removeClass("hide").addClass("chat-big");
        $(".chat-right").find(".add-user").addClass("active");
    });
    $(document).on('click', ".chat-big", function() {
        $(".chat-left").removeClass("hide");
    });

});

$('#multiple').selectator({
    showAllOptionsOnFocus: true,
    searchFields: 'value text subtitle right',
    render: {
        selected_item: function (_item, escape) {
           
            var html = '';
            if (typeof _item.left !== 'undefined') 
                html += '<div class="' + 'selectator_' + 'selected_item_left"><img src="' + escape(_item.left) + '"></div>';
            if (typeof _item.right !== 'undefined') 
                html += '<div class="' + 'selectator_' + 'selected_item_right">' + escape(_item.right) + '</div>';
            html += '<div class="' + 'selectator_' + 'selected_item_title">' + ((typeof _item.text !== 'undefined') ? escape(_item.text) : '') + '</div>';
            if (typeof _item.subtitle !== 'undefined') 
                html += '<div class="' + 'selectator_' + 'selected_item_subtitle">' + escape(_item.subtitle) + '</div>';
            html += '<div class="' + 'selectator_' + 'selected_item_remove">X</div>';

            // check if the 
            $(".done-link").addClass('show');
            return html;
        },
        option: function (_item, escape) {
            console.log("asdad");
            var html = '';
            if (typeof _item.left !== 'undefined') 
                html += '<div class="' + 'selectator_' + 'option_left"><img src="' + escape(_item.left) + '"></div>';
            if (typeof _item.right !== 'undefined') 
                html += '<div class="' + 'selectator_' + 'option_right">' + escape(_item.right) + '</div>';
            html += '<div class="' + 'selectator_' + 'option_title">' + ((typeof _item.text !== 'undefined') ? escape(_item.text) : '') + '</div>';
            if (typeof _item.subtitle !== 'undefined') 
                html += '<div class="' + 'selectator_' + 'option_subtitle">' + escape(_item.subtitle) + '</div>';

            if($(".selectator_selected_items").html() == "") {
                $(".done-link").removeClass('show');
            };
            return html;
        }
    },
    
});


$(document).ready(function() {
    var count = 0;
    document.addEventListener('change', function(e) {
        var ele = e.target;
        if ($(e.target).is('input[type="file"]')) {
            var files = e.target.files;
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                if (file.type.match('image')) {
                    var picreader = new FileReader();
                    picreader.addEventListener("load", function(event) {
                        var picture = event.target;
                        showPreview(picture.result, ele);
                    });
                    picreader.readAsDataURL(file);
                }
            }
        } else {
            console.log('not file');
        }
    }, true);
    var count = 1;
    function showPreview(pic, ele) {
        ele.previousElementSibling.src = pic;
        ele.setAttribute('style', 'display:none;');
        ele.nextElementSibling.setAttribute('style', 'display:block;');
        ele.closest('li').classList.remove('add');
        if ($('.uploadBtn').length < 5) {
            $('.gallery').append(
                ' <li class="uploadBtn add"><img class="img" src><input type="file"><a href="javascript:void(0);" class="removePic"><i class="fa fa-times"></i></a></li>'
            );
            count = 1;
        } else {
            return false;
        }
    }
    
    $('body').on('click', '.removePic', function() {
        $(this).parents('.uploadBtn').remove();
        if ($('.uploadBtn.add').length) {
            return false;
        } else {
            $('.gallery').append(
                ' <li class="uploadBtn add"><img class="img" src><input type="file"><a href="javascript:void(0);" class="removePic"><i class="fa fa-times"></i></a></li>'
            );
        }
    });
});

