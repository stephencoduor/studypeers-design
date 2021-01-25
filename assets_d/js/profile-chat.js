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
    data.forEach(function(item, index) {
      if (item.from_user_id == userInfo.user_id) {
        mainContent += sendSingleChatHtml(item, "");
      } else {
        mainContent += receivingMessageSingleHtml(item, "");
        otherUserIds.push(item);
      }
    });

    console.log(mainContent);

    singelChildAppendRecord.html(mainContent);
    chatWindow = document.getElementById("single_chat_window_append");
    var xH = chatWindow.scrollHeight;
    chatWindow.scrollTo(0, xH);
    $(".say-hi-wrapper").hide();
  }

  openChatWindow();
});

var CHAT_GROUP_ADDITIONS_SINGLE = {
  _AJAX_SUBMIT_SINGLE_CHAT: function(data, receiverId, additionaInfo) {
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

          console.log(additionaInfo.group_id);
          $("#current_single_chat_name").html(additionaInfo.receiverName);
          if (parseInt(additionaInfo.group_id) != 0) {
            console.log("teting group--->");
            $("#curren_group_name_id").val(additionaInfo.receiverName);
            $("#single_chat_image_preview").attr(additionaInfo.group_image);
          } else {
            $("#current_active_user_group_image_single").val(
              additionaInfo.image
            );
            $("#curren_group_name_id").val(additionaInfo.name);
            $("#single_chat_image_preview").attr(
              "src",
              additionaInfo.receiverImage
            );
          }

          $("#curren_group_members").val(JSON.stringify(groupMemberIds));
          $("#current_receiver_id").val(receiverId);
          $("#current_receiver_name_id").val(additionaInfo.receiverName);
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
  var UserInfo = JSON.parse(userData);

  if (getCurrentReciverId == "") {
    // open new window

    $("#current_receiver_id").val(msg.from_user_id);
    $("#current_receiver_name_id").val(msg.from_user_name);

    $("#current_group_id").val(groupId);
    $("#curren_group_members").val(JSON.stringify(groupMemberIds));
    $("#current_single_chat_name").html(msg.from_user_name);

    $("#curren_group_name_id").val(msg.group_name);
    $("#single_chat_image_preview").attr("src", msg.group_image);
    $("#current_active_user_group_image_single").val(msg.group_image);

    receivingMessageSingle(msg, "offline");
  } else {
    // check if the messge is for me or not.
    if (UserInfo.user_id == msg.to_user_id) {
      $("#current_receiver_id").val(msg.from_user_id);
      $("#current_receiver_name_id").val(msg.from_user_name);
      $("#current_group_id").val(groupId);
      $("#curren_group_members").val(JSON.stringify(groupMemberIds));
      $("#current_single_chat_name").html(msg.from_user_name);
      $("#curren_group_name_id").val(msg.group_name);
      $("#single_chat_image_preview").attr("src", msg.group_image);
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
  var previewImage = $("#currentProfilePicture").attr("src");
  var receiverId = $(this).attr("data-id");
  var currentGroupId = $(this).attr("data-groupId");
  var groupImage = $(this).attr("data-image");
  var groupMembers = [];
  groupMembers.push(receiverId);
  var name = $(this).attr("data-name");
  var UserInfo = JSON.parse(userData);

  var data = {
    sender_id: receiverId,
    name: UserInfo.first_name,
    receiverName: name,
    group_id: currentGroupId,
    image: UserInfo.profileImage,
    receiverImage: previewImage,
    group_image: groupImage
  };

  additionaInfo = data;

  CHAT_GROUP_ADDITIONS_SINGLE._AJAX_SUBMIT_SINGLE_CHAT(
    data,
    receiverId,
    additionaInfo
  );
});

$("body").on("click", "#close_window_single", function() {
  closeChatWindow();
});

function sendSingleChatHtml(messageJson, status) {
  var figureHTML = messageJson.media_url
    ? "<figure>" +
      '<img src="' +
      messageJson.media_url +
      '" alt="Attached Image">' +
      "</figure>"
    : "";

  var html =
    '<div class="sm-sent-wrap"><div class="sm-message-sent"><div class="sm-user-info"><div class="sm-user-name">' +
    "<strong>" +
    messageJson.from_user_name +
    "</strong>" +
    '<span class="msg-tile">' +
    messageJson.time +
    "</span></div>" +
    "<figure>" +
    '<img src="' +
    messageJson.send_profile_image +
    '" alt="Image" />' +
    '<span class="user-status ' +
    status +
    " user_id_" +
    messageJson.from_user_id +
    '"></span>' +
    "</figure>" +
    "</div>" +
    '<div class="sm-chat-msg">' +
    "<p>" +
    messageJson.message +
    "</p>" +
    figureHTML +
    "</div></div></div>";

  return html;
}

function receivingMessageSingleHtml(messageJson, status) {
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

  return html;
}
