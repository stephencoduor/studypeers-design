// handle single chat open windows

function openChatWindow() {
  $("#single_chat_window_box").show();
}

function closeChatWindow() {
  $("#single_chat_window_box").hide();
}

socket.on("singlemessages", data => {
  var userInfo = JSON.parse(userData);
  var mainContent = "";
  var otherUserIds = [];
  if (data.length > 0) {
    chatAppendElementSmall.html("");
    data.forEach(function(item, index) {
      if (item.from_user_id == userInfo.user_id) {
        mainContent += sendMessageToSingleChat(item, "");
      } else {
        mainContent += receivingMessageSingle(item, "");
        otherUserIds.push(item);
      }
    });

    chatAppendElementSmall.html(mainContent);
    chatWindow = document.getElementById("single_chat_window_append");
    var xH = chatWindow.scrollHeight;
    chatWindow.scrollTo(0, xH);
    $(".say-hi-wrapper").hide();
  }

  openChatWindow();
});

var CHAT_GROUP_ADDITIONS_SINGLE = {
  _AJAX_SUBMIT_SINGLE_CHAT: function(data, receiverId) {
    $.ajax({
      url: $("#submit_single_chat_url").val(),
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
          $("#current_single_chat_name").html(data.data.groupInfo.group_name);
          $("#curren_group_name_id").val(data.data.groupInfo.group_name);
          $("#curren_group_members").val(JSON.stringify(groupMemberIds));
          var Image = $("#currentProfilePicture").attr("src");

          $("#single_chat_image_preview").attr("src", Image);
          $("#current_active_user_group_image_single").val(Image);
          $("#current_receiver_id").val(receiverId);
          $("#current_receiver_name_id").val(data.data.groupInfo.group_name);
          socket.emit(
            "getsinglemessages",
            JSON.stringify({ groupId: data.data.groupId })
          );
        }
      },
      error: function() {
        alert("Error process request");
      },
      complete: function() {}
    });
  }
};

function handleSingleMessage(userInfo, userId, groupId, groupMemberIds, msg) {
  var getCurrentReciverId = $("#current_receiver_id").val();

  if (getCurrentReciverId == "") {
    // open new window

    $("#current_receiver_id").val(msg.to_user_id);
    $("#current_receiver_name_id").val(msg.to_user_name);

    $("#current_group_id").val(groupId);
    $("#curren_group_members").val(JSON.stringify(groupMemberIds));
    $("#current_single_chat_name").html(msg.group_name);

    $("#curren_group_name_id").val(msg.group_name);
    $("#single_chat_image_preview").attr("src", msg.group_image);
    $("#current_active_user_group_image_single").val(msg.group_image);

    receivingMessageSingle(msg, "offline");
  } else {
    // check if the messge is for me or not.
    if (getCurrentReciverId == msg.to_user_id) {
      $("#current_receiver_id").val(msg.to_user_id);
      $("#current_receiver_name_id").val(msg.to_user_name);

      $("#current_group_id").val(groupId);
      $("#curren_group_members").val(JSON.stringify(groupMemberIds));
      $("#current_single_chat_name").html(msg.group_name);
      $("#curren_group_name_id").val(msg.group_name);
      $("#current_active_user_group_image_single").val(msg.group_image);

      receivingMessageSingle(msg, "offline");
    }
  }
}

function receivingMessageSingle(messageJson, status) {
  var figureHTML = messageJson.media_url
    ? "<figure>" +
      '<img src="' +
      messageJson.media_url +
      '" alt="Attached Image">' +
      "</figure>"
    : "";

  var html =
    '<div class="sm-received-wrap"><div class="sm-message-received"><div class="sm-user-info">' +
    '<figure><img src="' +
    messageJson.send_profile_image +
    '" alt="Image" /><span class="user-status ' +
    status +
    " user_id_" +
    messageJson.from_user_id +
    '"></span></figure>' +
    '<div class="sm-user-name"><strong>' +
    messageJson.from_user_name +
    '</strong><span class="msg-tile">' +
    messageJson.time +
    "</span></div></div>" +
    '<div class="sm-chat-msg"><p>' +
    messageJson.message +
    "</p>" +
    figureHTML +
    "</div></div></div>";

  singelChildAppendRecord.append(html);
  var userInfo = JSON.parse(userData);
  var userId = userInfo.user_id;
  const index = messageJson.unread_members.indexOf(userId);
  var readMembers = messageJson.read_members;
  readMembers.push(userId);
  if (index > -1) {
    messageJson.unread_members.splice(index, 1);
  }

  const readIndex = readMembers.indexOf(userId);
  if (readIndex == -1) {
    readMembers.splice(readIndex, 1);
  }

  socket.emit(
    "updatereceived",
    JSON.stringify({
      id: messageJson._id,
      unread_members: messageJson.unread_members,
      read_members: readMembers
    })
  );

  chatWindow = document.getElementById("single_chat_window_append");
  var xH = chatWindow.scrollHeight;
  chatWindow.scrollTo(0, xH);
  $(".say-hi-wrapper").hide();

  openChatWindow();
}

$("body").on("click", "#send_button_chat_single", function(event) {
  if (
    $.trim($("#hidden_text_message").val()) == "" &&
    $.trim($("#current_image_upload_src").val()) == ""
  )
    return false;

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

  var message = {
    to_user_id: $("#current_receiver_id").val(),
    to_user_name: $("#current_receiver_name_id").val(),
    from_user_id: UserInfo.user_id,
    from_user_name: UserInfo.first_name,
    send_profile_image: UserInfo.profileImage,
    is_read: "unread",
    group_id: $("#current_group_id").val(),
    group_name: $("#curren_group_name_id").val(),
    group_image: $("#current_active_user_group_image_single").val(),
    group_members: JSON.parse($("#curren_group_members").val()),
    unread_members: unreadMembers,
    read_members: [],
    message: $("#hidden_text_message").val(),
    media_url: $("#current_image_upload_src").val(),
    new_member_added: 0,
    document_url: null,
    emoji: null,
    time: moment().format("h:mm"),
    created: new Date().toISOString()
  };

  socket.emit("sendmessage", JSON.stringify(message));
  sendMessageToSingleChat(message, "online");

  $(".emojionearea-editor").html("");
  $("#send_message_input").val("");
  $("#current_image_upload_src").val("");
  $("#append_image_after_upload").html("");
});

$("body").on("click", ".open-single-chat-window", function() {
  $(".chat-dropdown").is(":visible") ? $(".chat-dropdown").hide() : "";
  var receiverId = $(this).attr("data-id");
  var currentGroupId = $(this).attr("data-groupId");
  var groupMembers = [];
  groupMembers.push(receiverId);
  var name = $(this).attr("data-name");

  var data = {
    sender_id: receiverId,
    name: name,
    group_id: currentGroupId
  };

  CHAT_GROUP_ADDITIONS_SINGLE._AJAX_SUBMIT_SINGLE_CHAT(data, receiverId);
});

$("body").on("click", "#close_window_single", function() {
  closeChatWindow();
});
