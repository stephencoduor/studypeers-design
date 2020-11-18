var socket = io("http://localhost:3000");
$("form").submit(function(e) {
  e.preventDefault(); // prevents page reloading
  var msg = {
    to_user_id: 12,
    from_user_id: 13,
    is_read: "unread",
    message: "Hello jatin",
    media_url:
      "https://stackoverflow.com/questions/30783179/mongoose-enum-validation-on-string-arrays/32781322",
    emoji: "&#128512",
    created: new Date().toISOString()
  };

  socket.emit("sendmessage", JSON.stringify(msg));

  $("#m").val("");

  return false;
});

$("#receive_button").on("click", function() {
  var msg = { driver_id: 43 };
  socket.emit("getlocation", JSON.stringify(msg));
});

socket.on("connected", function() {
  var online = {
    user_id: 12,
    status: "online"
  };
  socket.emit("online", JSON.stringify(online));
});

socket.on("getlocation", function(msg) {
  $("#messages").append($("<li>").text(msg));
});

socket.on("receivemessage", function(msg) {
  console.log(msg);
  $("#messages").append($("<li>").text(msg));
});
