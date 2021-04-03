window.addEventListener('DOMContentLoaded', function () {
    var image = document.getElementById('cropper_image');
    var cropBoxData;
    var canvasData;
    var cropper;

    $('#modal_cropper').on('shown.bs.modal', function () {
        cropper = new Cropper(image, {
            aspectRatio: 16 / 9,
            preview: '.preview'
        });
    }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
    });


    $("#crop").click(function () {
        canvas = cropper.getCroppedCanvas({
            width: 1100,
            height: 320,
        });

        canvas.toBlob(function (blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function () {
                var base64data = reader.result;
                var type = $("#crop_type").val();

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "profile-upload-cropper",
                    data: { image: base64data, type: type },
                    success: function (data) {
                        $('#modal_cropper').modal('hide');
                        location.reload();
                    }
                });
            }
        });
    });













});