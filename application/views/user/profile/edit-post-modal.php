<?php
$userdata = $this->session->userdata('user_data');
$user_detail    = $this->db->query("SELECT * from user As a INNER JOIN user_info As b ON a.id = b.userID WHERE a.id = ".$userdata['user_id'])->row_array();
$full_name      = $user_detail['first_name'].' '.$user_detail['last_name'];
?>

<form method="post" id="editPostForm" action="<?php echo base_url(); ?>Profile/updatePost" enctype="multipart/form-data">
                
                <div class="modal-body">
                    <div class="createHeader">
                        <h4>Edit Post</h4>
                        <div class="closePost" data-dismiss="modal">
                            <img src="<?php echo base_url(); ?>assets_d/images/close-grey.svg" alt="close">
                        </div>
                    </div>
                    <div class="postwrapper">
                        <div class="postHeaderWrapper">
                            <div class="username">
                                <figure>
                                    <?php if(empty($user_detail['image'])) {

                                        if(strcasecmp($user_detail['gender'] , 'male') == 0){
                                            ?>
                                            <img src="<?php echo base_url(); ?>uploads/user-male.png" alt="User Post">
                                        <?php } else {
                                            ?>
                                            <img src="<?php echo base_url(); ?>uploads/user-female.png" alt="User Post">
                                            <?php
                                        }
                                    }
                                    else{
                                        ?>
                                        <img id="currentProfilePicture" src="<?php echo base_url(); ?>uploads/users/<?php echo $user_detail['image']; ?>" alt="User Post" />
                                        <?php
                                    }
                                    ?>
                                </figure>
                                <div class="right">
                                    <span><?php echo ucwords($full_name); ?></span>
                                    <div class="visibility">Visible to everyone</div>
                                </div>
                            </div>
                            <div class="settingWrapper">
                                <div class="postSetting" data-dismiss="modal" data-toggle="modal" href="#privacyPost">
                                    <img src="<?php echo base_url(); ?>assets_d/images/post-setting.svg" alt="Post Setting">
                                </div>
                                <div class="notification">
                                    <img src="<?php echo base_url(); ?>assets_d/images/alert-grey.svg" alt="notification" class="notification-disabled" id="bell-announcement">
                                </div>
                            </div>
                        </div>
                        <div class="postMessage">
                            <input type="hidden" name="editPostId" id="editPostId" value="<?= $post_details['id']; ?>">
                            <textarea id="messagepostareaedit" name="messagepostareaedit" placeholder="What's on your mind?"><?= $post_details['post_content_html']; ?></textarea>
                        </div>
                        <?php if (count($post_poll_options) > 0) { 
                                $poll_display = '';
                            } else {
                                $poll_display = 'display:none;';
                            }

                        ?>
                        <div class="pollsWrapper" style="<?= $poll_display; ?>">
                            <div class="pollsform" id="pollsformEdit">
                                <input type="hidden" id="optionCount" value="<?= count($post_poll_options); ?>">
                                <?php if(!empty($post_poll_options)) { $count = 1; foreach ($post_poll_options as $key => $value) { ?>
                                    <div class="form-group" id="edit_option_div_<?= $count; ?>">
                                        <input type="text" class="form-control" name="edit_option[<?= $count; ?>]" placeholder="Option <?= $count; ?>" value="<?= $value['options']; ?>">
                                        <?php if($count > 2) { ?>
                                            <a href="javascript:void(0)" onclick="removeOptionDivDelete('<?= $count; ?>', '<?= $value['id']; ?>')" class="cross-icon"><img src="<?php echo base_url(); ?>assets_d/images/clear-search-icon.svg" alt="Cross Icon"></a>
                                        <?php } ?>
                                        
                                        <input type="hidden" class="form-control" name="edit_option_id[<?= $count; ?>]" value="<?= $value['id']; ?>">
                                    </div>
                                <?php $count++; } } else { ?>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="edit_option[1]" placeholder="Option 1">
                                        
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="edit_option[2]" placeholder="Option 2">
                                        
                                    </div>
                                    <div class="form-group" id="edit_option_div_3">
                                        <input type="text" class="form-control" name="edit_option[3]" placeholder="Option 3">
                                        <a href="javascript:void(0)" onclick="removeOptionDivEdit('3')" class="cross-icon"><img src="<?php echo base_url(); ?>assets_d/images/clear-search-icon.svg" alt="Cross Icon"></a>
                                    </div>
                                <?php } ?>
                                
                                <!-- <div class="form-group" id="option_div_3">
                                    <input type="text" class="form-control" name="edit_option[3]" placeholder="Option 3">
                                    <a href="javascript:void(0)" onclick="removeOptionDiv('3')" class="cross-icon"><img src="<?php echo base_url(); ?>assets_d/images/clear-search-icon.svg" alt="Cross Icon"></a>
                                </div> -->
                            </div>
                            <div class="addmore" id="addmoreEditModal">
                                + Add Option
                            </div>
                            <div class="pollEndTimmings">
                                <h6>When does poll ends?</h6>
                                <div class="polltimeform">
                                    <div class="filtercalendar">
                                        <div class="input-group date" id="datetimepickerstartedit">
                                            <span class="input-group-addon" for="start-date"></span>
                                            <input type="text" class="form-control" name="poll-end-date-edit" placeholder="dd/mm/yy" id="start-date-edit" value="<?= $post_details['poll_end_date']; ?>">
                                        </div>
                                        <div class="input-group--overlap" id="selectTimeEdit">
                                            <input type="text" class="form-control form-control--lg" placeholder="hh:mm" name="poll-end-time-edit" value="<?= $post_details['poll_end_time']; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="shareDocs">
                            <h4>Share a Document</h4>
                            <div class="uploadedDocs">
                                <div id="all_documents_edit">
                                    <?php if(count($post_documents) > 0){ $count = 1;
                                        foreach($post_documents as $document){
                                        ?>
                                        <p class="feedPostMessages" id="document_div_<?= $document['id']; ?>">
                                            <a href="<?php echo base_url().$document['document_path']; ?>">Document <?= $count; ?></a>
                                            <div class="closeBtn" id="remove_document_<?= $document['id']; ?>" onclick="deleteDocument('<?= $document['id']; ?>')"><img src="<?php echo base_url(); ?>/assets_d/images/close-pink.svg" alt="close"/></div>
                                        </p>
                                    <?php
                                       $count++; }
                                    } ?>
                                </div>
                            </div>
                            <div class="shareOptionBox">
                                <ul>
                                    <li>
                                        <a href="javascript:void(0)">
                                            <button type="button" class="choose_btn shareBtn">
                                                <img src="<?php echo base_url(); ?>assets_d/images/choose-file.svg" alt="Choose File"> Choose File
                                                <input type="file" name="file_edit[]" id="document_edit" multiple="multiple"/>
                                            </button>
                                        </a>
                                    </li>
                                    <!--<li>
                                        <a href="javascript:void(0)">
                                            <button type="button" class="choose_btn dropbox">
                                                <img src="<?php /*echo base_url(); */?>assets_d/images/dropbox.svg" alt="Choose File"> Dropbox
                                            </button>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">
                                            <button type="button" class="choose_btn gdrive">
                                                <img src="<?php /*echo base_url(); */?>assets_d/images/google-drive.svg" alt="Choose File"> Google Drive
                                            </button>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">
                                            <button type="button" class="choose_btn oneDrive">
                                                <img src="<?php /*echo base_url(); */?>assets_d/images/onedrive.svg" alt="Choose File"> oneDrive
                                            </button>
                                        </a>
                                    </li>-->
                                </ul>
                            </div>
                        </div>
                        <div class="row" id="image_row_edit">
                            <?php if(count($post_images) > 0){ 
                                    foreach ($post_images as $key => $value) {
                                        
                            ?>
                                <div class="col-md-4" id="delete_img_<?= $value['id']; ?>">
                                    <div class="uloadedImage">
                                        <figure>
                                            <img src="<?php echo base_url().$value['image_path'] ?>" alt="image" id="image">
                                        </figure>
                                        <div class="close">
                                            <img src="<?php echo base_url(); ?>assets_d/images/close-pink.svg" class="remove_image_edit" onclick="deletePostImg('<?= $value['id']; ?>')" alt="close">
                                        </div>
                                    </div>
                                </div>
                            <?php } } ?>

                            <!----Show image preview here--->
                        </div>
                        <div class="hashTagWrap">
                            <button type="button" class="hashTag" onclick="applyHashTag()">#hashtag</button>
                            <p>help the right people see your post</p>
                        </div>
                    </div>
                    <div class="shareBoxWrapper">
                        <div class="shareBox">
                            <div class="imageSection" id="upload_image_section_edit">
                                <img src="<?php echo base_url(); ?>assets_d/images/image.svg" alt="image/video">
                                <span>Image/Video</span>
                                <input type="file" class="image_upload_button_edit" id="imgInp1" name="file_edit[]" multiple="multiple">
                            </div>
                            <div class="pollSection">
                                <img src="<?php echo base_url(); ?>assets_d/images/poll.svg" alt="image/video">
                                <span>Poll</span>
                            </div>
                            <div class="fileSection">
                                <img src="<?php echo base_url(); ?>assets_d/images/file.svg" alt="image/video">
                                <span>File</span>
                            </div>
                            <!-- <div class="moreSection">
                                <span>More</span>
                                <img class="more" src="<?php echo base_url(); ?>assets_d/images/more-popup.svg" alt="more">
                            </div> -->
                        </div>
                        <div class="studybuttonGroup post ">
                            <button type="button" class="event_action" id="update_post_from_ajax" >
                                Update Post
                            </button>
                        </div>
                    </div>
                    <!-- <div class="shareMoreContentWrapper">
                        <button type="button" class="shareOptionList celebrate">
                            <img src="<?php echo base_url(); ?>/assets_d/images/celebrate_occassion.svg"> Celebrate an occasion
                        </button>
                        <button type="button" class="shareOptionList doubt">
                            <img src="<?php echo base_url(); ?>/assets_d/images/doubt.svg">  Ask your doubt
                        </button>
                        <button type="button" class="shareOptionList tutor">
                            <img src="<?php echo base_url(); ?>/assets_d/images/find-tutor.svg">  Find a Tutor
                        </button>
                        <button type="button" class="shareOptionList share-profile">
                            <img src="<?php echo base_url(); ?>/assets_d/images/share-profile.svg">  Share Profile
                        </button>
                        <button type="button" class="shareOptionList offer-help">
                            <img src="<?php echo base_url(); ?>/assets_d/images/offer-help.svg">  Offer Help
                        </button>
                    </div> -->
                </div>
            </form>



            <script type="text/javascript">
                $(document).on('change', '.image_upload_button_edit', function() {

                    readURLEdit(this);
                });

                $(document).on('change', '#document_edit', function() {
                    getoutputEdit(this);
                });
                var document_counter = '<?= count($post_documents); ?>';

                function getFileEdit(filePath) {
                    return filePath.substr(filePath.lastIndexOf('\\') + 1).split('.')[0];
                }

                function getoutputEdit
                (inputfile) {
                    var file_ext = ["doc", "docx", "xls", "xlsx", "ppt", "pptx", "txt", "pdf"];
                    var extension = inputfile.value.split('.')[1];
                    var filename = getFileEdit(inputfile.value);
                    // Check if a value exists in the file_ext array
                    if (file_ext.indexOf(extension) == -1) {
                        alert("Invalid file type ! Please choose another file");
                    }
                    var img_icon = '';
                    if (extension == 'docx' || extension == 'doc') {
                        img_icon = '<img src="' + base_url + '/assets_d/images/document.svg' + '" />';
                    } else if (extension == 'pdf') {
                        img_icon = '<img src="' + base_url + '/assets_d/images/pdf.svg' + '" />';
                    } else if (extension == 'ppt' || extension == 'pptx') {
                        img_icon = '<img src="' + base_url + '/assets_d/images/pptx.svg' + '" />';
                    } else if (extension == 'xls' || extension == 'xlsx') {
                        img_icon = '<img src="' + base_url + '/assets_d/images/xlsx.svg' + '" />';
                    } else if (extension == 'txt') {
                        img_icon = '<img src="' + base_url + '/assets_d/images/txt.svg' + '" />';
                    } else {
                        alert('Invalid file format ! Please choose any other file . Supported file formats are doc/docx/pdf/ppt/xls/txt');
                        return false;
                    }
                    $('#all_documents_edit').append('<div class="filename" id="document_file_edit_' + document_counter + '">' + img_icon + '</div><div class="closeBtnDocEdit" id="remove_document_edit_' + document_counter + '"><img src="' + base_url + '/assets_d/images/close-pink.svg' + '" alt="close"/> ' + filename + '.' + extension + '</div>');
                    document_counter++;
                }

                $(document).on("click", ".closeBtnDocEdit", function() {
                    close_id = $(this).attr('id');
                    close_id = close_id.split('_');
                    $('#document_file_edit_' + close_id[2]).remove();
                    $('#remove_document_edit_' + close_id[2]).remove();
                    document_counter--;
                });



                $(function() {
                    $('#datetimepickerstartedit').datetimepicker({
                        allowInputToggle: true,
                        format: 'L'
                    });
                    $('#selectTimeEdit').datetimepicker({
                        format: 'LT',
                        allowInputToggle: true
                    });
                });

                $(document).on('click', '#update_post_from_ajax', function() {
                    var html_content = $('#messagepostareaedit').val(); 
                    if (html_content != '') {
                        
                        $('#editPostForm').submit();
                        
                    }
                    
                });

                $('#editPostForm').on("submit", function(e) {
                    e.preventDefault();
                    $('.ajax-loading').show();
                    $('#editPost').modal('hide');

                    var formData = new FormData(this);
                    var url = $(this).attr('action');
                    var html_content = $('#messagepostareaedit').val();
                    var post_id = $('#editPostId').val();
                    formData.append('html_content', html_content);
                    formData.append('post_id', post_id);
                    $.ajax({
                        type: 'POST',
                        url: url,
                        dataType: 'json',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(result) {
                            console.log(result);
                            if (result == true) {
                                window.location.href = base_url + 'account/dashboard';
                            }
                            $('.ajax-loading').hide();
                        }
                    });
                });


                indexEdit = $('#optionCount').val();
                $('#addmoreEditModal').on('click', function() { 
                    if (indexEdit < 6) {
                        indexEdit++;
                        $('#pollsformEdit').append(
                            `<div class="form-group" id="edit_option_div_${indexEdit}">
                                    <input type="text" name="edit_option[${indexEdit}]" class="form-control" placeholder="Option ${indexEdit}">
                                    <a href="javascript:void(0)" onclick="removeOptionDivEdit('${index}')" class="cross-icon"><img src="<?php echo base_url(); ?>assets_d/images/clear-search-icon.svg" alt="Cross Icon"></a>
                                </div>
                                `
                        );
                    }
                });

                function removeOptionDivEdit(id) {
                    indexEdit--;
                    $('#edit_option_div_' + id).remove();
                }

                

                function deletePostImg(id){
                    url = '<?php echo base_url(); ?>account/deletePostImage';
                    $.ajax({
                        type: 'POST',
                        url: url,
                        
                        data: {
                            "image_id": id
                        },
                        
                        success: function(result) {
                            
                            $('#delete_img_' + id).remove();
                        }
                    });
                }


                function deleteDocument(id){
                    url = '<?php echo base_url(); ?>account/deleteDocumentPost';
                    $.ajax({
                        type: 'POST',
                        url: url,
                        
                        data: {
                            "doc_id": id
                        },
                        
                        success: function(result) {
                            
                            $('#document_div_' + id).remove();
                        }
                    });
                }

                
                var counter = 1, video_counter = 1;
                var image_types = ['jpg', 'png', 'jpeg'];
                var video_types = ['mp4', '3gp', 'mpeg4', 'mkv', 'mov'];
                    function readURLEdit(input) {
                        
                        for (var i = 0; i < input.files.length; ++i) {
                            if (input.files[i] && input.files[i]) {
                                var file = input.files[i];
                                var extension = file.name.split('.').pop().toLowerCase(); //file extension from input file
                                var isImage = image_types.indexOf(extension) > -1;
                                var isVideo = video_types.indexOf(extension) > -1;
                                var reader = new FileReader();
                                if (isImage) {
                                    reader.onload = function(e) {
                                        var html_image = '<div class="col-md-4" id="delete_img_' + counter + '"><div class="uloadedImage"><figure><img src="' + e.target.result + '" alt="image" id="image' + counter + '"></figure>' +
                                            '<div class="close"><img src="' + base_url + 'assets_d/images/close-pink.svg" class="remove_image_edit" id="remove_image_' + counter + '" alt="close"></div></div></div>';
                                        $('#imgInp1' + counter).hide();
                                        $('#upload_image_section_edit').append('<input type="file" class="image_upload_button_edit" id="imgInp1' + counter + '" name="file_edit[]" multiple="multiple">');
                                        $('#image_row_edit').append(html_image);
                                        counter++;
                                    };
                                    reader.readAsDataURL(file); // convert to base64 string
                                } else {
                                    reader.onload = function() {
                                        var blob = new Blob([reader.result], {
                                            type: file.type
                                        });
                                        var url = URL.createObjectURL(blob);
                                        var video = document.createElement('video');
                                        var timeupdate = function() {
                                            if (snapImage()) {
                                                video.removeEventListener('timeupdate', timeupdate);
                                                video.pause();
                                            }
                                        };
                                        video.addEventListener('loadeddata', function() {
                                            if (snapImage()) {
                                                video.removeEventListener('timeupdate', timeupdate);
                                            }
                                        });
                                        var snapImage = function() {
                                            var canvas = document.createElement('canvas');
                                            canvas.width = video.videoWidth;
                                            canvas.height = video.videoHeight;
                                            canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
                                            var image = canvas.toDataURL();
                                            var success = image.length > 100000;
                                            if (success) {
                                                var html_image = '<div class="col-md-4" id="delete_video_' + video_counter + '"><div class="uloadedImage"><figure><img src="' + image + '" alt="image" id="image' + video_counter + '"></figure>' +
                                                    '<div class="close"><img src="' + base_url + 'assets_d/images/close-pink.svg" class="remove_video" id="remove_video_' + video_counter + '" alt="close"></div></div></div>';
                                                $('#image_row_edit').append(html_image);
                                                // URL.revokeObjectURL(url);
                                                $('#imgInp1' + video_counter).hide();
                                                $('#upload_image_section_edit').append('<input type="file" class="image_upload_button_edit" id="imgInp1' + video_counter + '" name="file_edit[]" multiple="multiple">');
                                                video_counter++;
                                            }
                                            return success;
                                        };
                                        video.addEventListener('timeupdate', timeupdate);
                                        video.preload = 'metadata';
                                        video.src = url;
                                        // Load video in Safari / IE11
                                        video.muted = true;
                                        video.playsInline = true;
                                        video.play();
                                    };
                                    reader.readAsArrayBuffer(file);
                                }

                            }
                        }
                    }


                    $(document).on('click', '.remove_image_edit', function() {
                        var img_id = $(this).attr('id').split('_');
                        $('#delete_img_' + img_id[2]).remove();
                        $('#imgInp1' + img_id[2]).val('');
                        counter--;
                    });

                
                

            </script>