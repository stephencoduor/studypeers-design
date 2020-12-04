function myFunction() {
  var input = $("#myInput").val();
  if (input == "") {
    $("#myUL").html("");
  }
  socket.emit("searchmessage", JSON.stringify({ searchTerm: input }));
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

function createGroupHTML() {
  var $chatelement = $(".chat-right");
  $chatelement.find(".start-conversation").removeClass("show");
  $chatelement.find(".chat-content").removeClass("hide");
  $chatelement.find(".chat-footer").removeClass("hide");
  $chatelement
    .find(".chat-header-left")
    .find("h3")
    .removeClass("show");
  $chatelement
    .find(".chat-header-left")
    .find(".basic-user-info")
    .removeClass("hide");
  $chatelement
    .find(".hide-on-big")
    .find(".maximize")
    .removeClass("hide")
    .addClass("chat-big");
  $chatelement.find(".add-user").addClass("active");
  console.log("code block");
}

function formatTopMessageGroupListNameOnAdd(messageJson) {
  var currentProfile =
    '<img id="group_image_id_' +
    messageJson.group_id +
    '" src="../assets_d/images/default-group.png">';

  if (messageJson.group_image) {
    currentProfile =
      '<img id="group_image_id_' +
      messageJson.group_id +
      '" src="' +
      messageJson.group_image +
      '">';
  }

  var html =
    "<li class='message-top-header' id='group_id_" +
    messageJson.group_id +
    "'  data-groupId='" +
    messageJson.group_id +
    "' data-groupmembers='" +
    JSON.stringify(messageJson.group_members) +
    "' data-groupname='" +
    messageJson.group_name +
    "''>" +
    '<a href="javascript:void(0)">' +
    "<figure>" +
    currentProfile +
    "</figure>" +
    '<div class="time">' +
    messageJson.time +
    "</div>" +
    '<div class="info-wrap">' +
    '<span class="badge badge-pill badge-primary" data-batch="0"></span>' +
    messageJson.group_name +
    "<p>" +
    messageJson.message +
    "</p>" +
    "</div></a></li>";

  return html;
}

var CHAT_GROUP_ADDITIONS = {
  _AJAX_SUBMIT_CHAT: function(data) {
    $.ajax({
      url: "submit-chat-users",
      data: data,
      success: function(data) {
        if (parseInt(data.code) == 200) {
          var groupName = [];
          var groupMemberIds = [];
          $("#current_group_id").val(data.data.groupId);
          if (data.data.users.length > 0) {
            data.data.users.forEach(function(item, index) {
              groupName.push(item.first_name);
              groupMemberIds.push(item.id);
            });
          }
          $("#group_name_id").html(data.data.groupInfo.group_name);
          $("#curren_group_name_id").val(data.data.groupInfo.group_name);
          $("#multiple").selectator("removeSelection");
          $("#curren_group_members").val(JSON.stringify(groupMemberIds));

          var messageJson = {
            group_id: data.data.groupId,
            group_members: groupMemberIds,
            group_name: data.data.groupInfo.group_name,
            send_profile_image: "",
            time: moment().format("h:mm"),
            message: ""
          };

          var html = formatTopMessageGroupListNameOnAdd(messageJson);
          var currentList = $("#userList").html();
          $("#userList").html(html + currentList);
        }
        createGroupHTML();
      },
      error: function() {
        alert("Error process request");
      },
      complete: function(data) {}
    });
  },
  _AJX_USER_CHAT_GROUP_ON_ADD: function() {
    $.ajax({
      url: "get-user-groups",
      success: function(data) {
        if (parseInt(data.code) == 200) {
          if (data.data) {
            socket.emit("loadmessage", JSON.stringify({ groupIds: data.data }));
          }
        }
      },
      error: function() {
        alert("Error process request");
      },
      complete: function(data) {
        console.log(data);
      }
    });
  }
};

//--------------handle group chat create event--------------------------//

$(document).on("click", ".done-link", function() {
  var data = $("#chat_submit_group_form").serializeArray();
  CHAT_GROUP_ADDITIONS._AJAX_SUBMIT_CHAT(data);
});

$("body").on("click", "#message_icon_id", function() {
  var UserInfo = JSON.parse(userData);
  socket.emit("getmyreadmessage", JSON.stringify({ user: UserInfo }));
});

//--------------en of group chat create event-------------------------//

$(document).ready(function() {
  $("body").on("click", ".removePic", function() {
    $(this)
      .parents(".uploadBtn")
      .remove();
    $("#current_image_upload_src").val("");
  });
});

$(document).ready(function() {
  $(document).on("click", ".minimize", function() {
    $(this)
      .parents(".chat-wrapper")
      .addClass("small");
    $(this)
      .find(".change-icon")
      .prop("src", "../assets_d/chat-assets/images/maximize.svg");
    $(this)
      .parents(".chat-wrapper")
      .find(".chat-left")
      .hide();
  });
  $(document).on("click", ".maximize", function() {
    $(this)
      .parents(".chat-wrapper")
      .removeClass("small");
    $(this)
      .find(".change-icon")
      .prop("src", "../assets_d/chat-assets/images/minimize.svg");
    $(this)
      .parents(".chat-wrapper")
      .find(".chat-left")
      .show();
  });

  $(document).on("click", ".open-chat", function() {
    $(".chat-wrapper").removeClass("hide-chat");
  });

  $("#myUL").on("click", "a", function() {
    $(".chat-wrapper")
      .addClass("small")
      .removeClass("hide-chat");
    $(".chat-wrapper")
      .find(".chat-left")
      .hide();
  });
  $(".chat-right").on("click", ".chat-close", function() {
    $(".chat-wrapper")
      .addClass("hide-chat")
      .removeClass("small");
    $(".chat-wrapper")
      .find(".chat-left")
      .show();

    $(".chat-wrapper")
      .addClass("hide-chat")
      .removeClass("small");
    $(".chat-wrapper")
      .find(".chat-left")
      .removeClass("hide");
    $(".chat-header-left")
      .find("h3")
      .removeClass("show");
    $(".basic-user-info").removeClass("hide");
    $(".chat-right")
      .find(".chat-content")
      .removeClass("hide");
    $(".chat-right")
      .find(".chat-footer")
      .removeClass("hide");
    $(".chat-right")
      .find(".video-icon")
      .removeClass("hide");
    $(".chat-right")
      .find(".maximize")
      .removeClass("hide");
    $(".chat-right")
      .find(".start-conversation")
      .removeClass("show");

    $(".chat-right")
      .find(".chat-content")
      .removeClass("hide");
    $(".chat-right")
      .find(".chat-footer")
      .removeClass("hide");
    $(".chat-right")
      .find(".video-icon")
      .removeClass("hide");
    $(".chat-header-left")
      .find("h3")
      .removeClass("show");
    $(".basic-user-info").removeClass("hide");
    $(".chat-right")
      .find(".hide-on-small")
      .removeClass("hide");
    $(".chat-right")
      .find(".close-icon-wrap")
      .removeClass("show");
    $(".chat-right")
      .find(".start-conversation")
      .removeClass("show");
    $(".chat-right")
      .find(".add-user")
      .removeClass("active");
  });

  $(".open-start-conversation").click(function() {
    $(".chat-wrapper")
      .removeClass("hide-chat")
      .addClass("small");
    $(".chat-wrapper")
      .find(".chat-left")
      .addClass("hide");
    $(".chat-header-left")
      .find("h3")
      .addClass("show");
    $(".basic-user-info").addClass("hide");
    $(".chat-right")
      .find(".chat-content")
      .addClass("hide");
    $(".chat-right")
      .find(".chat-footer")
      .addClass("hide");
    $(".chat-right")
      .find(".video-icon")
      .addClass("hide");
    $(".chat-right")
      .find(".maximize")
      .addClass("hide");
    $(".chat-right")
      .find(".start-conversation")
      .addClass("show");

    $("#multiple").selectator({
      showAllOptionsOnFocus: true,
      searchFields: "value text subtitle right",
      minSearchLength: 1,
      load: function(search, callback) {
        if (search.length < this.minSearchLength) return callback();
        $.ajax({
          url: "find-my-peers",
          data: { search: search },
          type: "GET",
          dataType: "json",
          success: function(data) {
            callback(data);
          },
          error: function() {
            callback();
          }
        });
      },
      render: {
        selected_item: function(_item, escape) {
          var html = "";
          if (typeof _item.left !== "undefined")
            html +=
              '<div class="' +
              "selectator_" +
              'selected_item_left"><img src="' +
              escape(_item.left) +
              '"></div>';
          if (typeof _item.right !== "undefined")
            html +=
              '<div class="' +
              "selectator_" +
              'selected_item_right">' +
              escape(_item.right) +
              "</div>";
          html +=
            '<div class="' +
            "selectator_" +
            'selected_item_title">' +
            (typeof _item.text !== "undefined" ? escape(_item.text) : "") +
            "</div>";
          if (typeof _item.subtitle !== "undefined")
            html +=
              '<div class="' +
              "selectator_" +
              'selected_item_subtitle">' +
              escape(_item.subtitle) +
              "</div>";
          html +=
            '<div class="' + "selectator_" + 'selected_item_remove">X</div>';

          // check if the
          $(".done-link").addClass("show");
          return html;
        },
        option: function(_item, escape) {
          console.log("asdad");
          var html = "";
          if (typeof _item.left !== "undefined")
            html +=
              '<div class="' +
              "selectator_" +
              'option_left"><img src="' +
              escape(_item.left) +
              '"></div>';
          if (typeof _item.right !== "undefined")
            html +=
              '<div class="' +
              "selectator_" +
              'option_right">' +
              escape(_item.right) +
              "</div>";
          html +=
            '<div class="' +
            "selectator_" +
            'option_title">' +
            (typeof _item.text !== "undefined" ? escape(_item.text) : "") +
            "</div>";
          if (typeof _item.subtitle !== "undefined")
            html +=
              '<div class="' +
              "selectator_" +
              'option_subtitle">' +
              escape(_item.subtitle) +
              "</div>";

          if ($(".selectator_selected_items").html() == "") {
            $(".done-link").removeClass("show");
          }
          return html;
        }
      }
    });
  });

  $(".open-big-start").click(function() {
    //  $(".open-start-conversation").trigger("click");
    $(".chat-right")
      .find(".chat-content")
      .addClass("hide");
    $(".chat-right")
      .find(".chat-footer")
      .addClass("hide");
    $(".chat-right")
      .find(".video-icon")
      .addClass("hide");
    $(".chat-header-left")
      .find("h3")
      .addClass("show");
    $(".basic-user-info").addClass("hide");
    $(".chat-right")
      .find(".hide-on-small")
      .addClass("hide");
    $(".chat-right")
      .find(".close-icon-wrap")
      .addClass("show");
    $(".chat-right")
      .find(".start-conversation")
      .addClass("show");
  });

  $("#multiple").selectator({
    showAllOptionsOnFocus: true,
    searchFields: "value text subtitle right",
    minSearchLength: 1,
    load: function(search, callback) {
      if (search.length < this.minSearchLength) return callback();
      $.ajax({
        url: "find-my-peers",
        data: { search: search },
        type: "GET",
        dataType: "json",
        success: function(data) {
          callback(data);
        },
        error: function() {
          callback();
        }
      });
    },
    render: {
      selected_item: function(_item, escape) {
        var html = "";
        if (typeof _item.left !== "undefined")
          html +=
            '<div class="' +
            "selectator_" +
            'selected_item_left"><img src="' +
            escape(_item.left) +
            '"></div>';
        if (typeof _item.right !== "undefined")
          html +=
            '<div class="' +
            "selectator_" +
            'selected_item_right">' +
            escape(_item.right) +
            "</div>";
        html +=
          '<div class="' +
          "selectator_" +
          'selected_item_title">' +
          (typeof _item.text !== "undefined" ? escape(_item.text) : "") +
          "</div>";
        if (typeof _item.subtitle !== "undefined")
          html +=
            '<div class="' +
            "selectator_" +
            'selected_item_subtitle">' +
            escape(_item.subtitle) +
            "</div>";
        html +=
          '<div class="' + "selectator_" + 'selected_item_remove">X</div>';

        // check if the
        $(".done-link").addClass("show");
        return html;
      },
      option: function(_item, escape) {
        console.log("asdad");
        var html = "";
        if (typeof _item.left !== "undefined")
          html +=
            '<div class="' +
            "selectator_" +
            'option_left"><img src="' +
            escape(_item.left) +
            '"></div>';
        if (typeof _item.right !== "undefined")
          html +=
            '<div class="' +
            "selectator_" +
            'option_right">' +
            escape(_item.right) +
            "</div>";
        html +=
          '<div class="' +
          "selectator_" +
          'option_title">' +
          (typeof _item.text !== "undefined" ? escape(_item.text) : "") +
          "</div>";
        if (typeof _item.subtitle !== "undefined")
          html +=
            '<div class="' +
            "selectator_" +
            'option_subtitle">' +
            escape(_item.subtitle) +
            "</div>";

        if ($(".selectator_selected_items").html() == "") {
          $(".done-link").removeClass("show");
        }
        return html;
      }
    }
  });

  $(document).on("click", ".chat-big", function() {
    $(".chat-left").removeClass("hide");
  });
});

function readURLImage(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $("#current_group_profile_image").val(e.target.result);
      $("#imagePreview").css(
        "background-image",
        "url(" + e.target.result + ")"
      );
      $("#imagePreview").hide();
      $("#imagePreview").fadeIn(650);
    };
    reader.readAsDataURL(input.files[0]);
  }
}
var count = 0;

function showPreviewChatImage(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    var ele = input;
    reader.onload = function(e) {
      ele.previousElementSibling.src = e.target.result;
      $("#current_image_upload_src").val(e.target.result);
      $("#append_image_after_upload").html(
        ' <li class="uploadBtn uploadBtnRestImage add">' +
          '<img class="img" src="' +
          e.target.result +
          '" />' +
          '<a href="javascript:void(0);" class="removePic removePicRestImage"><i class="fa fa-times"></i></a>' +
          "</li>"
      );
      e.target.result = "";
    };
    reader.readAsDataURL(input.files[0]);
  }
}

$("#imageUpload").change(function() {
  readURLImage(this);
});

$("body").on("change", "#upload_second_image_chat", function() {
  showPreviewChatImage(this);
});

$("#image_icon_selector").click(function() {
  $("#upload_second_image_chat").trigger("click");
});

function sendMessageToUser() {
  var UserInfo = JSON.parse(userData);
  var unreadMembers = [];
  var otherGroupMembers = JSON.parse($("#curren_group_members").val());
  if (otherGroupMembers) {
    otherGroupMembers.forEach(function(item, index) {
      if (item != UserInfo.user_id) {
        unreadMembers.push(item);
      }
    });
  }

  var currentGroupId = $("#current_group_id").val();

  var message = {
    to_user_id: 0,
    to_user_name: "",
    from_user_id: UserInfo.user_id,
    from_user_name: UserInfo.first_name,
    send_profile_image: UserInfo.profileImage,
    is_read: "unread",
    group_id: $("#current_group_id").val(),
    group_name: $("#curren_group_name_id").val(),
    group_image: $("#group_image_id_" + currentGroupId).attr("src"),
    group_members: JSON.parse($("#curren_group_members").val()),
    unread_members: unreadMembers,
    read_members: [],
    message: $(".emojionearea-editor").html(),
    media_url: $("#current_image_upload_src").val(),
    emoji: null,
    time: moment().format("h:mm"),
    created: new Date().toISOString()
  };

  socket.emit("sendmessage", JSON.stringify(message));

  sendMessage(message, "online");

  $(".emojionearea-editor").html("");
  $("#send_message_input").val("");
  $("#current_image_upload_src").val("");
  $("#append_image_after_upload").html("");
}

$(".emojis-wysiwyg").emojioneArea({
  inline: true,
  hideSource: true,
  resize: true,
  events: {
    // Enter key as submit button --> working
    keyup: function(editor, event) {
      if (
        event.which == 13 &&
        ($.trim(editor.text()).length > 0 || $.trim(editor.html()).length > 0)
      ) {
        sendMessageToUser();
        event.preventDefault();
        event.stopPropagation();
        editor.focus();
      }
    }
  }
});
