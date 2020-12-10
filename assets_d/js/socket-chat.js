var socket = io("https://localhost:3000/", {
  "sync disconnect on unload": true
});
var userData = $("#hidden_user_info").val();
var chatAppendElementSmall = $("#append_chat_records");
var clearTimerId;
var latestMessage = 0;

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

$("body").on("click", "#open_add_new_group_memeber", function() {
  $("#groupMember").modal("show");
  var groupId = $("#current_group_id").val();
  $("#hidde_add_group_id").val(groupId);
  $("#multiple-select").selectator({
    showAllOptionsOnFocus: true,
    searchFields: "value text subtitle right",
    minSearchLength: 1,
    load: function(search, callback) {
      if (search.length < this.minSearchLength) return callback();
      $.ajax({
        url: "add-new-peers",
        data: { search: search, id: groupId },
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

function sendMessageAsGroupMemberAdded(msg) {
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
    message: msg,
    media_url: $("#current_image_upload_src").val(),
    new_member_added: 1,
    document_url: null,
    emoji: null,
    time: moment().format("h:mm"),
    created: new Date().toISOString()
  };

  socket.emit("sendmessage", JSON.stringify(message));

  sendMessageAsNewMemberAdded(message, "online");

  $(".emojionearea-editor").html("");
  $("#send_message_input").val("");
  $("#current_image_upload_src").val("");
  $("#append_image_after_upload").html("");
}

$("body").on("click", "#submit_new_group_member", function() {
  var formEle = $("#add_new_group_member_form");
  $.ajax({
    url: formEle.attr("action"),
    data: formEle.serializeArray(),
    beforeSend: function() {
      $("#submit_new_group_member").html(
        '<i class="fa fa-refresh fa-spin" style="font-size:24px"></i>'
      );
    },
    success: function(data) {
      if (parseInt(data.code) == 200) {
        var otherGroupMembers = JSON.parse($("#curren_group_members").val());
        var groupMembers = [];
        data.data.users.forEach(function(item, index) {
          var readCurrentIndex = otherGroupMembers.indexOf(item.id);
          if (readCurrentIndex == -1) {
            otherGroupMembers.push(item.id);
            groupMembers.push(item.first_name);
          }
        });

        if (groupMembers.length > 0) {
          var msg = "Group member added " + groupMembers.join(", ");
          $("#curren_group_members").val(JSON.stringify(otherGroupMembers));
          sendMessageAsGroupMemberAdded(msg);
        }
      } else {
        alert(data.message);
      }
    },
    error: function() {
      alert("Something went wrong. Please try again");
    },
    complete: function() {
      $("#multiple-select").selectator("destroy");
      $("#multiple-select").empty();
      $("#submit_new_group_member").html("save");
      $("#groupMember").modal("hide");
    }
  });
});

// send message stanza.

$("body").on("click", "#send_button_chat", function(event) {
  if (
    $.trim($(".emojionearea-editor").html()) == "" &&
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
    new_member_added: 0,
    document_url: null,
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
});

$("body").on("click", "#submit_button_chat_setting", function() {
  var updateSetting = {
    group_id: $("#current_group_id").val(),
    group_name: $("#group_name_setting_id").val(),
    group_image: $("#current_group_profile_image").val()
  };
  if ($("#group_id_" + updateSetting.group_id).length > 0) {
    $("#group_image_id_" + updateSetting.group_id).attr(
      "src",
      updateSetting.group_image
    );
    $("#group_id_" + updateSetting.group_id)
      .find(".info-wrap")
      .html(
        '<span class="badge badge-pill badge-primary" data-batch="0"></span>' +
          updateSetting.group_name +
          "<p></p>"
      );
  }

  var ImageData = $("#current_group_profile_image").val();
  var newGroupName = $("#group_name_setting_id").val();

  if (ImageData && newGroupName) {
    $("#common_image_group_preview").attr("src", ImageData);
    $("#group_name_id").text(newGroupName);
  }

  $("#group_name_setting_id").val("");
  $("#current_group_profile_image").val("");
  $("#imagePreview").css(
    "background-image",
    "url('../assets_d/images/default-group.png')"
  );

  $(".close").trigger("click");

  socket.emit("updategroupsetting", JSON.stringify(updateSetting));
});

socket.on("groupsettingupdated", data => {
  if ($("#group_id_" + data.group_id).length > 0) {
    $("#group_image_id_" + data.group_id).attr("src", data.group_image);
    $("#group_id_" + data.group_id)
      .find(".info-wrap")
      .html(
        '<span class="badge badge-pill badge-primary" data-batch="0"></span>' +
          data.group_name +
          "<p></p>"
      );

    $("#common_image_group_preview").attr("src", data.group_image);
    $("#group_name_id").text(data.group_name);
  }
});

// set user status as online or offline.

socket.on("connect", function() {
  var UserInfo = JSON.parse(userData);
  var online = {
    user_id: UserInfo.user_id,
    status: "online"
  };
  socket.emit("online", JSON.stringify(online));
  socket.emit(
    "loadgroupmessage",
    JSON.stringify({ user_id: UserInfo.user_id })
  );
  socket.emit("loadmessage", JSON.stringify({ userId: UserInfo.user_id }));
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
  console.log(msg);
  // check if chat window is open or not.
  var userInfo = JSON.parse(userData);
  var userId = userInfo.user_id;
  var groupId = msg.group_id;
  var groupMemberIds = msg.group_members;

  if (!$("#group_id_" + groupId).length) {
    var html = formatTopMessageGroupListName(msg);
    var currentList = $("#userList").html();
    $("#userList").html(currentList + html);
  }

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
    if (readIndex == -1) {
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
    if (readIndex == -1) {
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
    console.log("inner 1--->");
    $("#group_id_" + groupId).addClass("active");
    $("#current_group_id").val(groupId);
    $("#curren_group_members").val(JSON.stringify(groupMemberIds));
    $("#curren_group_name_id").val(msg.group_name);
    $("#group_name_id").text(msg.group_name);
    $(".open-chat").trigger("click");
    socket.emit(
      "isonline",
      JSON.stringify({ user_id: msg.from_user_id, message: msg })
    );
    socket.emit("getgroupmessages", JSON.stringify({ groupId: groupId }));
    createGroupHTML();
  }
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
  }

  $("#chat_message_count").text(messageCount);
  $(".left-area").html(
    "Messages <span class='total-message'>(" + messageCount + ")</span>"
  );
});

socket.on("showinitmessage", data => {
  var messageContent = "<span class='text-center'>No Messages Available</span>";
  if (data.length > 0) {
    messageContent = "";
    data.forEach(function(item, index) {
      messageContent += formatTopMessageHeader(item);
    });
  }
  $(".loader-wrap").hide();
  $("#myUL").html(messageContent);
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
        if (item.new_member_added) {
          mainContent += sendMessageAsNewMemberAddedByGroupId(item, "");
        } else {
          mainContent += sendInitialMessage(item, "");
        }
      } else {
        if (item.new_member_added) {
          mainContent += sendMessageAsNewMemberAddedByGroupId(item, "");
        } else {
          mainContent += receivingInitialMessage(item, "");
          otherUserIds.push(item);
        }
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

    // createGroupHTML();
    showBigGroupChatWindow();
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
  var groupImageData = $("#group_image_id_" + groupId).attr("src");
  $("#common_image_group_preview").attr("src", groupImageData);
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
  if ($("#group_id_" + groupId).length > 0) {
    $("#group_id_" + groupId)
      .removeClass("active")
      .addClass("active");
  }

  $(".open-chat").trigger("click");
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
  var total = 0;
  var message = messageJson.message;

  if (messageJson.total) {
    total = messageJson.total;
  }

  if (messageJson.document_url) {
    message = "Document";
  }

  console.log(messageJson);

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
    messageJson.group_image +
    '" alt="">' +
    "</figure>" +
    '<div class="time">' +
    moment(messageJson.created).fromNow() +
    "</div>" +
    '<div class="info-wrap">' +
    "</span>" +
    messageJson.group_name +
    "(" +
    total +
    ")" +
    "<p>" +
    message +
    "</p>" +
    "</div></a></li>";

  return html;
}

function formatTopMessageGroupListName(messageJson) {
  var message = messageJson.message;
  var total = 0;

  if (messageJson.total) {
    total = messageJson.total;
  }

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

  if (messageJson.document_url) {
    message = "Document";
  }

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
    currentProfile +
    "</figure>" +
    '<div class="time">' +
    messageJson.time +
    "</div>" +
    '<div class="info-wrap">' +
    '<span class="badge badge-pill badge-primary" data-batch="0">' +
    total +
    "</span>" +
    messageJson.group_name +
    "<p>" +
    message +
    "</p>" +
    "</div></a></li>";

  return html;
}

function appendChatRecords() {
  var mainContent = '<div class="chat-date">Sept 28</div>';
}

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
