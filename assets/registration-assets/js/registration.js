var registration = /** @class */ (function() {
  function registration(options) {
    this.options = options;
  }

  registration.prototype.submitUserInformation = function(ele) {
    if (this.options.stepData) {
      $.ajax({
        url: this.options.stepData.url,
        data: this.options.stepData.data,
        dataType: "json",
        beforeSend: function() {
          ele.innerHTML =
            '<i class="fa fa-refresh fa-spin" style="font-size:24px"></i>';
        },
        success: function(data) {
          window.location = data.url;
        },
        error: function(data) {
          if (data.status == 422) {
            alert(data.responseJSON.message);
          } else {
            alert("Something went wrong");
          }
        },
        complete: function(data) {
          ele.innerHTML = "Continue";
        }
      });
    }
  };

  return registration;
})();

function validate(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === "paste") {
    key = event.clipboardData.getData("text/plain");
  } else {
    // Handle key press
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if (!regex.test(key)) {
    theEvent.returnValue = false;
    if (theEvent.preventDefault) theEvent.preventDefault();
  }
}

var submitButton = document.getElementById("submit_button_step_one");

submitButton.addEventListener("click", function() {
  let formData = $("#submit_step_one_form").serializeArray();
  var registerObject = new registration({
    stepData: {
      url: $("#submit_step_one_form").attr("action"),
      data: formData
    }
  });
  registerObject.submitUserInformation(this);
});

// handle checkbox event for don't have email adddress //

$("body").on("click", "#dont_have_email_address_id", function() {
  var isChecked = $(this).is(":checked");

  if (isChecked) {
    // disable email field //
    $("#institute_email_address").val("");
    $("#university_selection")
      .val(null)
      .trigger("change");

    $("#institute_email_address").prop("disabled", true);
    $("#university_selection").prop("disabled", true);
    $("#upload-file").prop("disabled", false);
    $("#manual_verification").prop("checked", true);
  } else {
    $("#institute_email_address").prop("disabled", false);
    $("#university_selection").prop("disabled", false);
    var input = $("#input_new_university_name").val();
    if ($.trim(input) == "") {
      $("#upload-file").val("");
      $("#upload-file").prop("disabled", true);
      $("#university_uplaod_file_path").val("");
    } else {
      return false;
    }
  }
});

// handle upload success
function handleSuccess(response) {
  if (response.status) {
    $("#university_uplaod_file_path").val(response.data.file_name);
  } else {
    alert(response.data);
  }
}

$("#upload-file").on("change", function(e) {
  var file = $(this)[0].files[0];
  var upload = new Upload(file);

  // maby check size or type here with upload.getSize() and upload.getType()

  // execute upload
  upload.doUpload();
});

$(document).ready(function() {
  $("#university_selection").select2({
    placeholder: "Select or search your University --",
    ajax: {
      url: "get-my-university-list",
      dataType: "json"
    }
  });

  $("#field_of_study").select2({
    placeholder: "Select or search your Field of Study --",
    ajax: {
      url: "get-university-field-list",
      dataType: "json"
    }
  });

  $("#major_field_of_study").select2({
    placeholder: "--Select or search your Major --",
    ajax: {
      url: "get-university-major-field",
      data: function(term, page) {
        return {
          q: term.term,
          id: $("#field_of_study").val()
        };
      },
      dataType: "json"
    }
  });

  $(".session-field").select2({
    placeholder: "--Session--"
  });
  $(".degree-field").select2({
    placeholder: "--Select degree--"
  });
  $(".field-of-interest").select2({
    placeholder: "--Field of interest--"
  });
});

//----------------------------------second form manual fields-------------------------//

$("body").on("click", "#submit_new_university_name", function() {
  var input = $("#input_new_university_name").val();
  if ($.trim(input) == "") return false;

  var newInput =
    '<span class="badge-item">' +
    input +
    ' <a href="javascript:void(0)" class="remove-badge" id="remove_university_data"><i class="fa fa-times" aria-hidden="true"></i></a></span>';
  $("#show_manual_added_university").html(newInput);
  $("#university_selection").prop("disabled", true);
  $("#manual_verification").prop("checked", true);
  $("#dont_have_email_address_id").prop("checked", true);
  $("#upload-file").prop("disabled", false);
  $("#manual_university").val(input);
  $(".close").trigger("click");
});

$("body").on("click", "#remove_university_data", function() {
  $("#show_manual_added_university").html("");
  $("#input_new_university_name").val("");
  $("#manual_university").val("");
  $("#university_selection").prop("disabled", false);
  $("#manual_verification").prop("checked", false);
  $("#dont_have_email_address_id").prop("checked", false);
  $("#upload-file").prop("disabled", true);
});

//------------------------------------end of second form fields ------------------------//

//-----------------------------third form manual fields ---------------------------//
$("body").on("click", "#buton_manual_fied_of_interest", function() {
  var input = $("#field_of_interest_manual_id").val();
  if ($.trim(input) == "") return false;

  var newInput =
    '<span class="badge-item">' +
    input +
    ' <a href="javascript:void(0)" class="remove-badge" id="remove_field_of_study_data"><i class="fa fa-times" aria-hidden="true"></i></a></span>';
  $("#manual_addition_field_of_study").html(newInput);
  $("#field_of_study").prop("disabled", true);
  $("#major_field_of_study").prop("disabled", true);
  $("#manual_field_of_interest").val(input);
  $("#field_of_study")
    .val(null)
    .trigger("change");
  $("#major_field_of_study")
    .val(null)
    .trigger("change");
  $(".close").trigger("click");
});

$("body").on("click", "#remove_field_of_study_data", function() {
  $("#manual_addition_field_of_study").html("");
  $("#manual_field_of_interest").val("");
  $("#field_of_interest_manual_id").val("");
  $("#field_of_study").prop("disabled", false);
  $("#major_field_of_study").prop("disabled", false);
});

//--------------------------------------form third manual field of interest ---------------------//

$("body").on("click", "#button_major_manual", function() {
  var input = $("#major_input_manual").val();
  if ($.trim(input) == "") return false;

  var newInput =
    '<span class="badge-item">' +
    input +
    ' <a href="javascript:void(0)" class="remove-badge" id="remove_field_of_study_data"><i class="fa fa-times" aria-hidden="true"></i></a></span>';
  $("#html_major_show").html(newInput);
  $("#major_field_of_study").prop("disabled", true);
  $("#manual_major_hidden").val(input);
  $("#major_field_of_study")
    .val(null)
    .trigger("change");
  $(".close").trigger("click");
});

$("body").on("click", "#remove_field_of_study_data", function() {
  $("#html_major_show").html("");
  $("#manual_major_hidden").val("");
  $("#major_input_manual").val("");
  $("#major_field_of_study").prop("disabled", false);
});

$("body").on("click", "#manual_verification", function() {
  var input = $("#input_new_university_name").val();
  if ($.trim(input) != "") return false;
});

//---------------------------- manual verification ----------------------------------------//

$("body").on("change", ".dispaly_name_selection", function() {
  $("#nick_name_selection_input").prop("readonly", true);
  if ($(this).is(":checked")) {
    var dataName = $(this).attr("data-name");
    $("#nick_name_selection_input").val(dataName);
    if ($(this).val() == "nick_name") {
      $("#nick_name_selection_input").prop("readonly", false);
    }
  }
});
