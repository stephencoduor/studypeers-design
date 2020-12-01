var socket = io("https://localhost:3000/", {
  "sync disconnect on unload": true
});
var userData = $("#hidden_user_info").val();
var chatAppendElementSmall = $("#append_chat_records");
var clearTimerId;
var latestMessage = 0;

var input = document.getElementById("send_message_input");

// Execute a function when the user releases a key on the keyboard
input.addEventListener("keyup", function(event) {
  // Number 13 is the "Enter" key on the keyboard
  var UserInfo = JSON.parse(userData);

  socket.emit(
    "usertyping",
    JSON.stringify({
      user: UserInfo,
      currentGroup: $("#current_group_id").val()
    })
  );
  if (event.keyCode === 13) {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
    $("#user_typing_id").text("");

    if (input.value != "") {
      document.getElementById("send_button_chat").click();
    }
  }
});

setInterval(function() {
  //clear user is typing message
  $("#user_typing_id").html("");
}, 900);

socket.on("receivetyping", data => {
  console.log(data);
  var currenActivateGroup = $("#current_group_id").val();
  if ($("#curren_group_members").val()) {
    var currentUserGroup = JSON.parse($("#curren_group_members").val());
    console.log(
      "current index --->",
      currentUserGroup.indexOf(data.user.user_id)
    );
    if (
      currentUserGroup.indexOf(data.user.user_id) >= 0 &&
      currenActivateGroup == data.currentGroup
    ) {
      $("#user_typing_id").text(data.user.first_name + " Typing ...");
    }
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
    from_user_name: UserInfo.first_name,
    send_profile_image: UserInfo.profileImage,
    is_read: "unread",
    group_id: $("#current_group_id").val(),
    group_name: $("#curren_group_name_id").val(),
    group_members: JSON.parse($("#curren_group_members").val()),
    unread_members: unreadMembers,
    read_members: [],
    message: $("#send_message_input").val(),
    media_url: $("#current_image_upload_src").val(),
    emoji: null,
    time: moment().format("h:mm"),
    created: new Date().toISOString()
  };

  socket.emit("sendmessage", JSON.stringify(message));

  sendMessage(message, "online");

  $("#send_message_input").val("");
  $("#current_image_upload_src").val("");
  $("#append_image_after_upload").html(
    '<li class="uploadBtn add"><img class="img" src>' +
      '<input type="file"><a href="javascript:void(0);" class="removePic"><i class="fa fa-times"></i></a></li>'
  );

  return false;
});

// set user status as online or offline.

socket.on("connect", function() {
  var UserInfo = JSON.parse(userData);
  var online = {
    user_id: UserInfo.user_id,
    status: "online"
  };
  socket.emit("online", JSON.stringify(online));
});

socket.on("connection_closed", function(data) {
  if (data.user_id) {
    $(".user_id_" + data.user_id).hasClass("online")
      ? $(".user_id_" + data.user_id).removeClass("online")
      : $(".user_id_" + data.user_id).removeClass("offline");
    $(".user_id_" + data.user_id).addClass(data.status);
  }
});

// handle message after broadcast.

socket.on("receivemessage", function(msg) {
  // console.log(msg);
  // check if chat window is open or not.
  var userInfo = JSON.parse(userData);
  var userId = userInfo.user_id;
  var groupId = msg.group_id;
  var groupMemberIds = msg.group_members;

  if ($("#group_id_" + groupId).hasClass("active")) {
    $("#current_group_id").val(groupId);
    $("#curren_group_members").val(JSON.stringify(groupMemberIds));
    $("#curren_group_name_id").val(msg.group_name);
    $("#group_name_id").text(msg.group_name);

    const index = msg.unread_members.indexOf(userId);
    var readMembers = msg.read_members;
    readMembers.push(userId);
    if (index > -1) {
      msg.unread_members.splice(index, 1);
    }

    const readIndex = readMembers.indexOf(userId);
    if (readIndex > -1) {
      readMembers.splice(readIndex, 1);
    }
    socket.emit(
      "updatereceived",
      JSON.stringify({
        id: msg._id,
        unread_members: msg.unread_members,
        read_members: readMembers
      })
    );

    socket.emit(
      "isonline",
      JSON.stringify({ user_id: msg.from_user_id, message: msg })
    );
  } else {
    var batchcount = $("#group_id_" + groupId)
      .find(".badge")
      .attr("data-batch");

    batchcount = parseInt(batchcount) + 1;

    $("#group_id_" + groupId)
      .find(".badge")
      .attr("data-batch", batchcount);

    if (batchcount > 0) {
      $("#group_id_" + groupId)
        .find(".badge")
        .text(batchcount);
    }

    const index = msg.unread_members.indexOf(userId);
    var readMembers = msg.read_members;
    readMembers.push(userId);
    if (index > -1) {
      msg.unread_members.splice(index, 1);
    }

    const readIndex = readMembers.indexOf(userId);
    if (readIndex > -1) {
      readMembers.splice(readIndex, 1);
    }
    socket.emit(
      "updatereceived",
      JSON.stringify({
        id: msg._id,
        unread_members: msg.unread_members,
        read_members: readMembers
      })
    );
  }

  if ($(".chat-wrapper").hasClass("hide-chat")) {
    $("#group_id_" + groupId).addClass("active");
    $("#current_group_id").val(groupId);
    $("#curren_group_members").val(JSON.stringify(groupMemberIds));
    $("#curren_group_name_id").val(msg.group_name);
    $("#group_name_id").text(msg.group_name);
    $(".open-start-conversation").trigger("click");
    socket.emit(
      "isonline",
      JSON.stringify({ user_id: msg.from_user_id, message: msg })
    );
    createGroupHTML();
  }

  if ($(".chat-left").hasClass("hide")) {
    $("#group_id_" + groupId).addClass("active");
    $("#current_group_id").val(groupId);
    $("#curren_group_members").val(JSON.stringify(groupMemberIds));
    $("#curren_group_name_id").val(msg.group_name);
    $("#group_name_id").text(msg.group_name);
    $(".open-start-conversation").trigger("click");
    socket.emit(
      "isonline",
      JSON.stringify({ user_id: msg.from_user_id, message: msg })
    );
    createGroupHTML();
  }

  //  receivingMessage(msg);
});

socket.on("knowstatus", data => {
  if (data.status) {
    receivingMessage(data.message, data.status.status);
  } else {
    receivingMessage(data.message, "offline");
  }
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
  var messageCount = data.length;
  var messageContent = "";
  if (data.length > 0) {
    data.forEach(function(item, index) {
      messageContent += formatTopMessageHeader(item);
    });
    latestMessage = messageContent;
    $("#myUL").html(messageContent);
  }

  $("#chat_message_count").text(messageCount);
  $(".left-area").text("Messages(" + messageCount + ")");
});

socket.on("showinitmessage", data => {
  var messageContent = "";
  if (data.length > 0) {
    data.forEach(function(item, index) {
      messageContent += formatTopMessageHeader(item);
    });
    if (!latestMessage) $("#myUL").html(messageContent);
  }
});

socket.on("receivesearchmessage", data => {
  var messageContent = "";
  if (data.length > 0) {
    data.forEach(function(item, index) {
      messageContent += formatTopMessageHeader(item);
    });
  }
  $("#myUL").html(messageContent);
});

socket.on("onlinestatus", data => {
  console.log(data);
  if (data.user_id) {
    $(".user_id_" + data.user_id).hasClass("online")
      ? $(".user_id_" + data.user_id).removeClass("online")
      : $(".user_id_" + data.user_id).removeClass("offline");
    $(".user_id_" + data.user_id).addClass(data.status);
  }
});

socket.on("groupmessages", function(data) {
  var userInfo = JSON.parse(userData);
  var mainContent = "";
  var otherUserIds = [];
  if (data.length > 0) {
    data.forEach(function(item, index) {
      if (item.from_user_id == userInfo.user_id) {
        mainContent += sendInitialMessage(item, "");
      } else {
        mainContent += receivingInitialMessage(item, "");
        otherUserIds.push(item);
      }
    });

    chatAppendElementSmall.html(mainContent);

    chatWindow = document.getElementById("chat_window_content");
    var xH = chatWindow.scrollHeight;
    chatWindow.scrollTo(0, xH);

    // if (otherUserIds.length > 0) {
    //   otherUserIds.forEach(function(item, index) {
    //     socket.emit(
    //       "isonline",
    //       JSON.stringify({ user_id: item.from_user_id, message: item })
    //     );
    //   });
    // }

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
  $(".message-top-header").removeClass("active");
  $(this)
    .find(".badge")
    .text("");
  $(this)
    .find(".badge")
    .attr("data-batch", 0);
  $(this).toggleClass("active");
  socket.emit("getgroupmessages", JSON.stringify(findMessages));
});

//-------------------message formatter -------------------------------//

function receivingMessage(messageJson, status) {
  var figureHTML = messageJson.media_url
    ? "<figure>" +
      '<img src="' +
      messageJson.media_url +
      '" alt="Attached Image">' +
      "</figure>"
    : "";

  var html =
    '<div class="received-wrap"><div class="message-received"><div class="user-info">' +
    '<figure><img src="' +
    messageJson.send_profile_image +
    '" alt="Image" /><span class="user-status ' +
    status +
    " user_id_" +
    messageJson.from_user_id +
    '"></span></figure>' +
    '<div class="user-name"><strong>' +
    messageJson.from_user_name +
    '</strong><span class="msg-tile">' +
    messageJson.time +
    "</span></div></div>" +
    '<div class="chat-msg"><p>' +
    messageJson.message +
    "</p>" +
    figureHTML +
    "</div></div></div>";

  chatAppendElementSmall.append(html);
  var userInfo = JSON.parse(userData);
  var userId = userInfo.user_id;
  const index = messageJson.unread_members.indexOf(userId);
  var readMembers = messageJson.read_members;
  readMembers.push(userId);
  if (index > -1) {
    messageJson.unread_members.splice(index, 1);
  }

  const readIndex = readMembers.indexOf(userId);
  if (readIndex > -1) {
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

  chatWindow = document.getElementById("chat_window_content");
  var xH = chatWindow.scrollHeight;
  chatWindow.scrollTo(0, xH);
}

function sendMessage(messageJson, status) {
  var figureHTML = messageJson.media_url
    ? "<figure>" +
      '<img src="' +
      messageJson.media_url +
      '" alt="Attached Image">' +
      "</figure>"
    : "";

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
    '<span class="user-status ' +
    status +
    " user_id_" +
    messageJson.from_user_id +
    '"></span>' +
    "</figure>" +
    "</div>" +
    '<div class="chat-msg">' +
    "<p>" +
    messageJson.message +
    "</p>" +
    figureHTML +
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
    "<li class='message-top-header' id='group_id_" +
    messageJson.group_id +
    "' data-groupId='" +
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
    '<span class="badge badge-pill badge-primary" data-batch="0"></span>' +
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

function receivingInitialMessage(messageJson, status) {
  var figureHTML = messageJson.media_url
    ? "<figure>" +
      '<img src="' +
      messageJson.media_url +
      '" alt="Attached Image">' +
      "</figure>"
    : "";

  var html =
    '<div class="received-wrap"><div class="message-received"><div class="user-info">' +
    '<figure><img src="' +
    messageJson.send_profile_image +
    '" alt="Image" /><span class="user-status ' +
    status +
    " user_id_" +
    messageJson.from_user_id +
    '"></span></figure>' +
    '<div class="user-name"><strong>' +
    messageJson.from_user_name +
    '</strong><span class="msg-tile">' +
    messageJson.time +
    "</span></div></div>" +
    '<div class="chat-msg"><p>' +
    messageJson.message +
    "</p>" +
    figureHTML +
    "</div></div></div>";

  var userInfo = JSON.parse(userData);
  var userId = userInfo.user_id;
  const index = messageJson.unread_members.indexOf(userId);
  var readMembers = messageJson.read_members;
  readMembers.push(userId);
  if (index > -1) {
    messageJson.unread_members.splice(index, 1);
  }

  const readIndex = readMembers.indexOf(userId);
  if (readIndex > -1) {
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

function sendInitialMessage(messageJson, status) {
  var figureHTML = messageJson.media_url
    ? "<figure>" +
      '<img src="' +
      messageJson.media_url +
      '" alt="Attached Image">' +
      "</figure>"
    : "";

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
    '<span class="user-status ' +
    status +
    " user_id_" +
    messageJson.from_user_id +
    '"></span>' +
    "</figure>" +
    "</div>" +
    '<div class="chat-msg">' +
    "<p>" +
    messageJson.message +
    "</p>" +
    figureHTML +
    "</div></div></div>";

  return html;
}
