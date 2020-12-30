// handle single chat open windows

function openChatWindow() {
  $(".chat-left").hide();
  $(".chat-wrapper")
    .removeClass("hide-chat")
    .addClass("small");
}

$("body").on("click", ".open-single-chat-window", function() {
  var receiverId = $(this).attr("data-id");
  var groupMembers = [];
  groupMembers.push(receiverId);
  var name = $(this).attr("data-name");
  var Image = $("#currentCoverPicture").attr("src");
  $("#group_name_id").text(name);
  $("#current_receiver_id").val(receiverId);
  $("#current_receiver_name_id").val(name);
  $("#curren_group_members").val(JSON.stringify(groupMembers));
  $("#common_image_group_preview").attr("src", Image);
  openChatWindow();
});
