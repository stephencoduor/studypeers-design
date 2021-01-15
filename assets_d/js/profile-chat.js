// handle single chat open windows

function openChatWindow() {
  $("#single_chat_window_box").show();
}

var CHAT_GROUP_ADDITIONS = {
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
          var Image = $("#currentCoverPicture").attr("src");

          $("#single_chat_image_preview").attr("src", Image);
          $("#current_receiver_id").val(receiverId);
          $("#current_receiver_name_id").val(data.data.groupInfo.group_name);

          openChatWindow();
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
  $("#current_receiver_id").val(msg.to_user_id);
  $("#current_receiver_name_id").val(msg.to_user_name);

  $("#current_group_id").val(groupId);
  $("#curren_group_members").val(JSON.stringify(groupMemberIds));
  $("#current_single_chat_name").html(msg.group_name);
  $("#curren_group_name_id").text(msg.group_name);
  $("#single_chat_image_preview").attr("src", msg.group_image);
  receivingMessageSingle(msg, "offline");
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

  openChatWindow();
}

$("body").on("click", ".open-single-chat-window", function() {
  var receiverId = $(this).attr("data-id");
  var groupMembers = [];
  groupMembers.push(receiverId);
  var name = $(this).attr("data-name");

  var data = {
    sender_id: receiverId,
    name: name
  };

  CHAT_GROUP_ADDITIONS._AJAX_SUBMIT_SINGLE_CHAT(data, receiverId);
});
