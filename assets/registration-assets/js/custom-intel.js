$("#country_code").intlTelInput();
$("#country_code").attr("readonly", "true");

$(function() {
  $("#datetimepickerstart,#datetimepickerend").datetimepicker({
    allowInputToggle: true,
    format: "L"
  });
});
$(".form-group.checkbox input[type='checkbox']").click(function() {
  if ($(this).prop("checked") == true) {
    $(this)
      .parent()
      .parent()
      .siblings()
      .addClass("editMode");
  } else {
    $(this)
      .parent()
      .parent()
      .siblings()
      .removeClass("editMode");
  }
});
$("#selectTime1,#selectTime2").datetimepicker({
  format: "LT",
  allowInputToggle: true
});
$(".sp-input-toggler").click(function(e) {
  $(this)
    .parent(".flex-form-row")
    .addClass("isEditable");
});
$(".sp-round-btn").click(function(e) {
  $(this)
    .parent(".showInputs")
    .parent(".flex-form-row")
    .removeClass("isEditable");
});
$("#eventtype").on("change", function() {
  let data = $(this).val();
  if (data === "rotating") {
    $(".rotateevent").css("display", "flex");
  } else {
    $(".rotateevent").hide();
  }
});
