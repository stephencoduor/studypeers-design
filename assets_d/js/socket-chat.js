var socket = io(config.url);
var userData = $("#hidden_user_info").val();
var chatAppendElementSmall = $("#append_chat_records");

var input = document.getElementById("send_message_input");

// Execute a function when the user releases a key on the keyboard
input.addEventListener("keyup", function(event) {
  // Number 13 is the "Enter" key on the keyboard
  if (event.keyCode === 13) {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
    document.getElementById("send_button_chat").click();
  }
});

// send message stanza.

$("body").on("click", "#send_button_chat", function(event) {
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
    to_user_id: 0,
    to_user_name: "",
    from_user_id: UserInfo.user_id,
    from_user_name: UserInfo.username,
    send_profile_image: UserInfo.profileImage,
    is_read: "unread",
    group_id: $("#current_group_id").val(),
    group_name: $("#curren_group_name_id").val(),
    group_members: JSON.parse($("#curren_group_members").val()),
    unread_members: unreadMembers,
    message: $("#send_message_input").val(),
    media_url: null,
    emoji: null,
    time: moment().format("h:mm"),
    created: new Date().toISOString()
  };

  socket.emit("sendmessage", JSON.stringify(message));

  sendMessage(message);

  $("#send_message_input").val("");

  return false;
});

// set user status as online or offline.

socket.on("connected", function() {
  var UserInfo = JSON.parse(userData);
  var online = {
    user_id: UserInfo.user_id,
    status: "online"
  };
  socket.emit("online", JSON.stringify(online));
});

// handle message after broadcast.

socket.on("receivemessage", function(msg) {
  // console.log(msg);
  // check if chat window is open or not.
  var groupId = msg.group_id;
  var groupMemberIds = msg.group_members;
  $("#current_group_id").val(groupId);
  $("#curren_group_members").val(JSON.stringify(groupMemberIds));
  $("#curren_group_name_id").val(msg.group_name);
  if ($(".chat-wrapper").hasClass("hide-chat")) {
    $(".open-start-conversation").trigger("click");
    createGroupHTML();
  }
  receivingMessage(msg);
});

socket.on("loadinitgroupmessage", data => {
  var groupListMessage = "";
  if (data.length > 0) {
    data.forEach(function(item, index) {
      groupListMessage += formatTopMessageGroupListName(item);
    });
  }
  $("#userList").html(groupListMessage);
});

socket.on("initmessage", data => {
  var messageContent = "";
  var messageCount = data.length;
  if (data.length > 0) {
    data.forEach(function(item, index) {
      messageContent += formatTopMessageHeader(item);
    });
    $("#chat_message_count").text(messageCount);
  }
  $("#myUL").html(messageContent);
});

socket.on("isonline", function(data) {
  console.log(data);
});

socket.on("groupmessages", function(data) {
  var userInfo = JSON.parse(userData);
  if (data.length > 0) {
    data.forEach(function(item, index) {
      if (item.from_user_id == userInfo.user_id) {
        sendMessage(item);
      } else {
        receivingMessage(item);
      }
    });

    createGroupHTML();
  }
});

$("body").on("click", ".message-top-header", function() {
  var groupId = $(this).attr("data-groupId");
  var groupMemberIds = $(this).attr("data-groupmembers");
  var groupName = $(this).attr("data-groupname");
  $("#current_group_id").val(groupId);
  $("#curren_group_members").val(groupMemberIds);
  $("#curren_group_name_id").val(groupName);
  $("#group_name_id").html(groupName);
  var findMessages = {
    groupId: groupId
  };
  chatAppendElementSmall.html("");
  socket.emit("getgroupmessages", JSON.stringify(findMessages));
});

//-------------------message formatter -------------------------------//

function receivingMessage(messageJson) {
  var userInfo = JSON.parse(userData);
  var userId = userInfo.user_id;

  var html =
    '<div class="received-wrap"><div class="message-received"><div class="user-info">' +
    '<figure><img src="' +
    messageJson.send_profile_image +
    '" alt="Image" /></figure>' +
    '<div class="user-name"><strong>' +
    messageJson.from_user_name +
    '</strong><span class="msg-tile">' +
    messageJson.time +
    "</span></div></div>" +
    '<div class="chat-msg"><p>' +
    messageJson.message +
    "</p></div></div></div>";

  chatAppendElementSmall.append(html);

  chatWindow = document.getElementById("chat_window_content");
  var xH = chatWindow.scrollHeight;
  chatWindow.scrollTo(0, xH);
  const index = messageJson.unread_members.indexOf(userId);
  if (index > -1) {
    messageJson.unread_members.splice(index, 1);
  }
  socket.emit(
    "updatereceived",
    JSON.stringify({
      id: messageJson._id,
      unread_members: messageJson.unread_members
    })
  );
}

function sendMessage(messageJson) {
  var html =
    '<div class="sent-wrap"><div class="message-sent"><div class="user-info"><div class="user-name">' +
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
    "</figure>" +
    "</div>" +
    '<div class="chat-msg">' +
    "<p>" +
    messageJson.message +
    "</p>" +
    "</div></div></div>";

  chatAppendElementSmall.append(html);

  chatWindow = document.getElementById("chat_window_content");
  var xH = chatWindow.scrollHeight;
  chatWindow.scrollTo(0, xH);
}

function formatTopMessageHeader(messageJson) {
  var html =
    "<li class='message-top-header' data-groupId='" +
    messageJson.group_id +
    "' data-groupmembers='" +
    JSON.stringify(messageJson.group_members) +
    "' data-groupname='" +
    messageJson.group_name +
    "' '>" +
    '<a href="javascript:void(0)">' +
    "<figure>" +
    '<img src="' +
    messageJson.send_profile_image +
    '" alt="">' +
    "</figure>" +
    '<div class="time">' +
    messageJson.time +
    "</div>" +
    '<div class="info-wrap">' +
    messageJson.from_user_name +
    "<p>" +
    messageJson.message +
    "</p>" +
    "</div></a></li>";

  return html;
}

function formatTopMessageGroupListName(messageJson) {
  var html =
    "<li class='message-top-header' data-groupId='" +
    messageJson.group_id +
    "' data-groupmembers='" +
    JSON.stringify(messageJson.group_members) +
    "' data-groupname='" +
    messageJson.group_name +
    "' '>" +
    '<a href="javascript:void(0)">' +
    "<figure>" +
    '<i class="fa fa-users fa-3x" aria-hidden="true"></i>' +
    "</figure>" +
    '<div class="time">' +
    messageJson.time +
    "</div>" +
    '<div class="info-wrap">' +
    messageJson.group_name +
    "<p>" +
    messageJson.message +
    "</p>" +
    "</div></a></li>";

  return html;
}

function appendChatRecords() {
  var mainContent = '<div class="chat-date">Sept 28</div>';
}

$(document).ready(function() {
  SOCKET_CHAT._AJX_USER_CHAT_GROUP();
  // SOCKET_CHAT.AJAX_LOAD_UNREAD_MESSAGE();
});

var SOCKET_CHAT = {
  _AJX_USER_CHAT_GROUP: function() {
    $.ajax({
      url: "get-user-groups",
      success: function(data) {
        if (parseInt(data.code) == 200) {
          if (data.data) {
            socket.emit(
              "loadgroupmessage",
              JSON.stringify({ groupIds: data.data })
            );
          }
        }
      },
      error: function() {
        alert("Error process request");
      },
      complete: function() {
        var userInfo = JSON.parse(userData);
        var userId = userInfo.user_id;
        socket.emit("loadmessage", JSON.stringify({ userId: userId }));
      }
    });
  },
  AJAX_LOAD_UNREAD_MESSAGE: function() {}
};
