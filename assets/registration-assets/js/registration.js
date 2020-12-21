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
    $("#institute_email_address").prop("disabled", true);
  } else {
    $("#institute_email_address").prop("disabled", false);
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
    placeholder: "Select or search your University",
    ajax: {
      url: "get-my-university-list",
      dataType: "json"
    }
  });

  $("#field_of_study").select2({
    placeholder: "Select or search your University",
    ajax: {
      url: "get-university-field-list",
      dataType: "json"
    }
  });

  $("#major_field_of_study").select2({
    placeholder: "--Select or search your field of study--",
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
