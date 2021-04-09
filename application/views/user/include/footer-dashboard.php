<script src="<?php echo base_url(); ?>assets_d/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets_d/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets_d/js/utils.js"></script>>
<script src="<?php echo base_url(); ?>assets_d/js/jquery.mCustomScrollbar.js"></script>
<script src="<?php echo base_url('assets_d/js/fm.selectator.jquery.js'); ?>"></script>
<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<!--<script src="https://areaaperta.com/nicescroll/js/jquery.nicescroll.plus.js"></script>-->
<!--<script src="https://areaaperta.com/nicescroll/js/jquery.nicescroll.min.js"></script>-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="<?php echo base_url(); ?>assets_d/js/jquery.star-rating-svg.js"></script>
<script src="https://momentjs.com/downloads/moment.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets_d/js/slick.js"></script>
<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets_d/js/jquery.emojipicker.js"></script> -->
<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets_d/js/jquery.emojis.js"></script> -->
<!-- Starr Rating -->
<script src="<?php echo base_url(); ?>assets_d/js/jquery.star-rating-svg.js"></script>
<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets_d/js/jquery.emojipicker.js"></script> -->
<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets_d/js/jquery.emojis.js"></script> -->

<script src="<?php echo base_url(); ?>assets_d/js/custom.js"></script>
<script src="<?php echo base_url('assets_d/js/emojionearea-master/dist/emojionearea.js'); ?>"></script>
<script src="<?php echo base_url('assets_d/js/infinite-scroll.js'); ?>"></script>
<script src="<?php echo base_url('assets_d/js/chat.js'); ?>"></script>
<script src="<?php echo base_url('assets_d/js/socket-chat.js'); ?>"></script>
<script src="<?php echo base_url('assets_d/js/profile-chat.js'); ?>"></script>

<script>
    $(document).ready(function() {
        $("#multiple-select").selectator();
        $("#multiple-select-post").selectator();
        $("#multiple-select-post-update").selectator();
    });
</script>
<script type="text/javascript">
    function saveReaction(reaction_id, reference_id, reference) {

        url = '<?php echo base_url(); ?>Profile/saveReaction';
        $.ajax({
            url: url,
            type: 'post',
            data: {
                "reaction_id": reaction_id,
                "reference_id": reference_id,
                "reference": reference
            },
            success: function(result) {
                $('.' + reference + '_total_likes_' + reference_id).html(result);
                if (reaction_id == 1) {
                    $('.' + reference + '_likeMenu_' + reference_id).html('<img src="<?php echo base_url(); ?>assets_d/images/like-dashboard.svg" class="likepost" alt="Like"> <span style="color: #185aeb;">Like</span>');
                } else if (reaction_id == 2) {
                    $('.' + reference + '_likeMenu_' + reference_id).html('<img src="<?php echo base_url(); ?>assets_d/images/support-dashboard.svg" class="likepost" alt="Like"> <span style="color: #185aeb;">Support</span>');
                } else if (reaction_id == 3) {
                    $('.' + reference + '_likeMenu_' + reference_id).html('<img src="<?php echo base_url(); ?>assets_d/images/celebrate-dashboard.svg" class="likepost" alt="Like"> <span style="color: #185aeb;">Celebrate</span>');
                } else if (reaction_id == 4) {
                    $('.' + reference + '_likeMenu_' + reference_id).html('<img src="<?php echo base_url(); ?>assets_d/images/curious-dashboard.svg" class="likepost" alt="Like"> <span style="color: #185aeb;">Insightful</span>');
                } else if (reaction_id == 5) {
                    $('.' + reference + '_likeMenu_' + reference_id).html('<img src="<?php echo base_url(); ?>assets_d/images/insight-dashboard.svg" class="likepost" alt="Like"> <span style="color: #185aeb;">Curious</span>');
                } else if (reaction_id == 6) {
                    $('.' + reference + '_likeMenu_' + reference_id).html('<img src="<?php echo base_url(); ?>assets_d/images/love-dashboard.svg" class="likepost" alt="Like"> <span style="color: #185aeb;">Love</span>');
                }



            }
        });
    }

    function getAllReactionData(reference_id, reference) {
        $.ajax({
            url: '<?php echo base_url(); ?>Profile/getAllReactionData',
            type: 'post',
            data: {
                "count": 0,
                "reference_id": reference_id,
                "reference": reference
            },
            success: function(result) {

                $('#modal-reaction-body').html(result);
                $('#reations-popup').modal('show');
            }
        });
    }

    function deleteReaction(reference, reference_id) {
        url = '<?php echo base_url(); ?>Profile/deleteReaction';
        $.ajax({
            url: url,
            type: 'post',
            data: {
                "reference_id": reference_id,
                "reference": reference
            },
            success: function(result) {
                $('.' + reference + '_total_likes_' + reference_id).html(result);
                $('.' + reference + '_likeMenu_' + reference_id).html('<img src="<?php echo base_url(); ?>assets_d/images/like-grey.svg" class="likepost" alt="Like"><span>Like</span>');

            }
        });
    }

    function showCommentBoxWrap(reference, reference_id) {
        $('#' + reference + '_comment_' + reference_id).show();
    }

    function hideCommentBoxWrap(reference, reference_id) {
        $('#' + reference + '_comment_' + reference_id).hide();
    }

    function postCommentByReference(event, reference, reference_id, comment) {
        if (event.which == 13) {

            if (comment != '') {
                var url = '<?php echo base_url('profile/addCommentByRefrence') ?>';
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        'comment': comment,
                        'reference_id': reference_id,
                        'reference': reference
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#' + reference + '_commentappend_' + reference_id).append(result.html);
                        $('#' + reference + '_comment_count_' + reference_id).html(result.count);
                        $('#comment_input_' + reference + '_' + reference_id).val('');
                    }
                });
            }
        }
    }

    function postCommentReply(event, comment_id, comment) {
        if (event.which == 13) {

            if (comment != '') {
                var url = '<?php echo base_url('profile/postCommentReply') ?>';
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        'comment': comment,
                        'comment_id': comment_id
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#commentreply_box_' + comment_id).append(result.html);
                        $('#comment_reply_count_' + comment_id).show();
                        $('#comment_reply_count_' + comment_id).html(result.count);
                        $("#comment_reply_" + comment_id).val('');
                    }
                });
            }
        }
    }

    function deleteCommentReply(reply_id, comment_id) {

        var url = '<?php echo base_url('profile/deleteCommentReply') ?>';
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                'reply_id': reply_id,
                'comment_id': comment_id
            },

            success: function(result) {
                $('#comment_reply_id_' + reply_id).remove();
                if (result != '(0)') {
                    $('#comment_reply_count_' + comment_id).show();
                    $('#comment_reply_count_' + comment_id).html(result);
                } else {
                    $('#comment_reply_count_' + comment_id).hide();
                }
            }
        });


    }

    function deleteComment(comment_id, reference_id, reference) {

        var url = '<?php echo base_url('profile/deleteComment') ?>';
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                'comment_id': comment_id,
                'reference_id': reference_id,
                'reference': reference
            },

            success: function(result) {
                $('#comment_id_' + comment_id).remove();
                if (result != '0') {
                    $('#' + reference + '_comment_count_' + reference_id).show();
                    $('#' + reference + '_comment_count_' + reference_id).html(result);
                } else {
                    $('#' + reference + '_comment_count_' + reference_id).hide();
                }
            }
        });


    }

    function postImageComment(reference, reference_id) {
        var file_data = $('#comment_image_' + reference + '_' + reference_id).prop('files')[0];
        var form_data = new FormData();

        form_data.append('file', file_data);
        form_data.append('reference_id', reference_id);
        form_data.append('reference', reference);
        // alert(form_data);  
        var url = '<?php echo base_url('profile/postImgComment') ?>';
        $.ajax({
            url: url, // point to server-side PHP script 
            dataType: 'text', // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            dataType: 'json',
            success: function(result) {
                $('#' + reference + '_commentappend_' + reference_id).append(result.html);
                $('#' + reference + '_comment_count_' + reference_id).html(result.count);
                $('#comment_image_' + reference + '_' + reference_id).val('');
            }
        });
    }

    function showReplyBox(id) {
        $('#show_reply_box_' + id).show();
    }

    function likeCommentByReference(comment_id) {
        var url = '<?php echo base_url('profile/likeCommentByReference') ?>';
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                'comment_id': comment_id
            },
            success: function(result) {
                if (result != 0) {
                    $('#reactcomment_' + comment_id).show();
                    $('#comment_like_count_' + comment_id).html(result);
                    if ($('#like_text_' + comment_id).text() == 'Like') {
                        $('#like_text_' + comment_id).text('Liked');
                    } else {
                        $('#like_text_' + comment_id).text('Like');
                    }
                } else {
                    $('#reactcomment_' + comment_id).hide();
                    $('#comment_like_count_' + comment_id).html(result);
                    if ($('#like_text_' + comment_id).text() == 'Like') {
                        $('#like_text_' + comment_id).text('Liked');
                    } else {
                        $('#like_text_' + comment_id).text('Like');
                    }
                }

            }
        });
    }

    function savePollOption(post_id, option_id) {
        var url = '<?php echo base_url('profile/savePollOption') ?>';
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                'post_id': post_id,
                'option_id': option_id
            },
            success: function(result) {
                $('#poll_div_' + post_id).html(result);
            }
        });
    }


    $(document).on('click', '.userPollList', function() {
        var option_id = $(this).data('id');

        $.ajax({
            url: '<?php echo base_url(); ?>profile/getPeersPollList',
            type: 'post',
            data: {
                "id": option_id
            },
            success: function(result) {

                $('#userPollListModal').html(result);
            }
        })


    });

    $(document).on("click", ".deleteReferenceById", function() {
        var ref_id = $(this).data('id');
        $(".modal-body #delete_reference_id").val(ref_id);

    });

    // function applyHashTag() {
    //     $('#messagepostarea').val($('#messagepostarea').val() + '#').focus();
    // }
</script>
<script>
    var base_url = '<?php echo base_url(); ?>';
    $('.storyRoom').slick({
        infinite: false,
        slidesToShow: 5.5,
        autoplay: false,
        slidesToScroll: 1,
        responsive: [{
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4.5
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 3.5
                }
            },
            {
                breakpoint: 567,
                settings: {
                    slidesToShow: 2.5
                }
            },
            {
                breakpoint: 400,
                settings: {
                    slidesToShow: 1.5
                }
            }
        ]
    });
    $('.peerSuggestionList').slick({
        infinite: false,
        slidesToShow: 4,
        autoplay: false,
        slidesToScroll: 4,
        responsive: [{
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 567,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 400,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });
    $('.fullMessage').slideUp();
    $('.feedPostMessages a').on('click', function() {
        $(this).hide();
        $('.fullMessage').slideDown();
    })
    $('.fullMessage a').on('click', function() {
        $(this).parent().slideUp();
        $('.feedPostMessages a').show();
    });
    $('.removePeer').on('click', function() {
        $(this).parent('figure').parent('.peerList').hide('slow', function() {
            $(this).parent('figure').parent('.peerList').remove();
        });

        if ($('.peerList:visible').length == 1) {
            $('#peer_suggestion_box').hide();
        }
        // $('.fullMessage').slideDown();
    })

    function sendRequest(peer_id) {
        $.ajax({
            url: '<?php echo base_url(); ?>account/sendPeerRequest',
            type: 'post',
            data: {
                "peer_id": peer_id
            },
            success: function(result) {
                $('#add_peer_' + peer_id).text('Cancel Request');
                $("#add_peer_" + peer_id).attr("onclick", "cancelRequest(" + peer_id + ")");

            }
        })
    }

    function cancelRequest(peer_id) {
        $.ajax({
            url: '<?php echo base_url(); ?>account/cancelRequest',
            type: 'post',
            data: {
                "peer_id": peer_id
            },
            success: function(result) {
                $('#add_peer_' + peer_id).text('Add Peer');
                $("#add_peer_" + peer_id).attr("onclick", "sendRequest(" + peer_id + ")");

            }
        })
    }
	
	var url;
	$('.follow_now').on("click", function() {
		var peer_id = $(this).attr('data-id');
		var status = $(this).attr('id');
		url = '<?php echo base_url(); ?>Profile/follow';
		if (status == 0) {
			url = '<?php echo base_url(); ?>Profile/unfollow';
		}
		$.ajax({
			url: url,
			type: 'post',
			data: {
				"peer_id": peer_id
			},
			success: function(result) {
				if (status == 1) {
					$('.follow_' + peer_id).html('Unfollow');
					$('.follow_' + peer_id).attr('id', 0);
				} else {
					$('.follow_' + peer_id).html('Follow');
					$('.follow_' + peer_id).attr('id', 1);
				}
			}
		});
	});
	
	function attendEvent() {
		var id = $("#attend_event_id").val();
		var txt = $('#attend_text_' + id).html();
		var newtxt = txt.trim();
		if (id != '') {
			$.ajax({
				url: '<?php echo base_url(); ?>account/attendSharedEvent',
				type: 'post',
				data: {
					"id": id,
					"type": newtxt
				},
				success: function(result) {
					var resulttext = result.trim();
					$("#confirmationModalAttend").modal('hide');
					$("#attend_text_"+id).html(resulttext);
					$(".attend_text_"+id).html(resulttext);
					$("#attend_event_id").val('');
				}
			})
		}
	}
	
	$(document).on('click', '.attendEvent', function() {
		var event_id = $(this).data('id');
		var txt = $('#attend_text_' + event_id).html();
		$("#attend_event_id").val(event_id);
		var newtxt = txt.trim();
		if (newtxt == 'Attend') {
			$('#confirmationModalAttendHead').html('Do you want to attend this Event !');
		} else {
			$('#confirmationModalAttendHead').html("Are you sure you don't want to attend this Event !");
		}
	});
	
	$(document).on('click', '.peersModalAttending', function() {
		var event_id = $(this).data('id');
		$.ajax({
			url: '<?php echo base_url(); ?>account/getPeersEVentAttending',
			type: 'post',
			data: {
				"id": event_id
			},
			success: function(result) {
				$('#peersModalAttendingList').html(result);
			}
		});
	});
	
    $("#multiple-select-post").selectator({
        showAllOptionsOnFocus: true,
        searchFields: "value text subtitle right",
        minSearchLength: 1,
        load: function(search, callback) {
            if (search.length < this.minSearchLength) return callback();
            $.ajax({
                url: "find-my-peers",
                data: {
                    search: search
                },
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

    function saveSelectedPeer() {
        $('#postGroupModal').modal('hide');
        $('#createPost').modal('show');
        var output_string = "";
        $("#multiple-select-post option").each(function() {
            // Add $(this).val() to your list

            output_string = output_string + $(this).val() + ", ";
        });
        output_string = output_string.substr(0, output_string.length - 2);
        $('#shareWithPeersId').val(output_string);
    }

    function backToPostPrivacy() {
        $('#postGroupModal').modal('hide');
        $('#privacyPost').modal('show');
    }

    $(document).ready(function() {
        $('.box-card').each(function() {
            let feedImage = $(this).children('.createBox ').children('.feeduserwrap').children('.imgWrapper ').find('figure');
            let imageLength = feedImage.length;
            if (imageLength > 3) {
                feedImage.parent('.imgWrapper').append('<div class="count"></div>');
                let imageCount = imageLength - 3;
                let counter = imageCount;
                while (counter >= 0) {
                    $(feedImage).eq(imageLength - counter).hide();
                    counter--;
                }
                feedImage.parent('.imgWrapper').find('.count').append(" + " + imageCount);
            } else {
                return
            }
        });



        // CKEDITOR.replace('messagepostarea', {
        //     on: {
        //         instanceReady: function(evt) {
        //             // Hide the editor top bar.
        //             document.getElementById('cke_1_top').style.display = 'none';
        //             document.getElementById('cke_1_bottom').style.display = 'none';
        //         }
        //     }
        // });

        var counter = 1,
            video_counter = 1;
        var image_types = ['jpg', 'png', 'jpeg'];
        var video_types = ['mp4', '3gp', 'mpeg4', 'mkv', 'mov'];

        function readURL(input) {

            for (var i = 0; i < input.files.length; ++i) {
                if (input.files[i] && input.files[i]) {
                    var file = input.files[i];
                    var extension = file.name.split('.').pop().toLowerCase(); //file extension from input file
                    var isImage = image_types.indexOf(extension) > -1;
                    var isVideo = video_types.indexOf(extension) > -1;
                    var reader = new FileReader();
                    if (isImage) {
                        reader.onload = function(e) {
                            var html_image = '<div class="col-md-4" id="delete_' + counter + '"><div class="uloadedImage"><figure><img src="' + e.target.result + '" alt="image" id="image' + counter + '"></figure>' +
                                '<div class="close"><img src="' + base_url + 'assets_d/images/close-pink.svg" class="remove_image" id="remove_image_' + counter + '" alt="close"></div></div></div>';
                            $('#imgInp' + counter).hide();
                            $('#upload_image_section').append('<input type="file" class="image_upload_button" id="imgInp' + counter + '" name="file[]" multiple="multiple">');
                            $('#image_row').append(html_image);
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
                                    $('#image_row').append(html_image);
                                    // URL.revokeObjectURL(url);
                                    $('#imgInp' + video_counter).hide();
                                    $('#upload_image_section').append('<input type="file" class="image_upload_button" id="imgInp' + video_counter + '" name="file[]" multiple="multiple">');
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

        $(document).on('click', '.remove_image', function() {
            var img_id = $(this).attr('id').split('_');
            $('#delete_' + img_id[2]).remove();
            $('#imgInp' + img_id[2]).val('');
            counter--;
        });

        $(document).on('click', '.remove_video', function() {
            var video_id = $(this).attr('id').split('_');
            $('#delete_video_' + video_id[2]).remove();
            $('#imgInp' + video_id[2]).val('');
            video_counter--;
        });

        $(document).on("click", ".addEvents", function() {
            var event_id = $(this).data('id');
            $(".modal-body #calender_event_id").val(event_id);

        });

        $(document).on("click", ".removeEvent", function() {
            var event_id = $(this).data('id');
            $(".modal-body #remove_event_id").val(event_id);

        });

        $(document).on('click', '#shareWithPeerEdit', function() {
            var post_id = $(this).data('id');
            $('#privacyPostEdit').modal('hide');
            var url = '<?php echo base_url('account/getShareWithPeerById') ?>';
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    'post_id': post_id
                },
                success: function(data) {
                    
                    $("#postGroupModalEdit #multiple-select-post-update").html(data);
                }
            });
        });

        $(document).on('change', '.image_upload_button', function() {

            readURL(this);
        });

        var document_counter = 1,
            close_id;
        $(document).on('change', '#document', function() {
            getoutput(this);
        });

        function getFile(filePath) {
            return filePath.substr(filePath.lastIndexOf('\\') + 1).split('.')[0];
        }



        function getoutput(inputfile) {
            var file_ext = ["doc", "docx", "xls", "xlsx", "ppt", "pptx", "txt", "pdf"];
            var extension = inputfile.value.split('.')[1];
            var filename = getFile(inputfile.value);
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
            $('#all_documents').append('<div class="filename" id="document_file_' + document_counter + '">' + img_icon + '</div><div class="closeBtn" id="remove_document_' + document_counter + '"><img src="' + base_url + '/assets_d/images/close-pink.svg' + '" alt="close"/> ' + filename + '.' + extension + '</div>');
            document_counter++;
        }

        $(document).on("click", ".closeBtn", function() {
            close_id = $(this).attr('id');
            close_id = close_id.split('_');
            $('#document_file_' + close_id[2]).remove();
            $('#remove_document_' + close_id[2]).remove();
            document_counter--;
        });

        $(document).on('click', '#shareWithPeer', function() {
            $('#privacyPost').modal('hide');
        });


        




        $(document).on('click', '#save_post_from_ajax', function() {
            var html_content = $('#messagepostarea').val();
            if (html_content != '') {
                if ($('.pollsWrapper').is(":visible")) {
                    if ($("input[name=option]").val() != '' && $('#start-date').val() != '' && $('input[name=poll-end-time]').val() != '') {
                        $('#addPostForm').submit();
                    } else {
                        alert("Please fill poll data");
                    }
                } else {
                    $('#addPostForm').submit();
                }
            }

        });
        $('#addPostForm').on("submit", function(e) {
            e.preventDefault();
            $('.ajax-loading').show();
            $('#createPost').modal('hide');

            var formData = new FormData(this);
            var url = $(this).attr('action');
            var html_content = $('#messagepostarea').val();
            var privacy = $("input:radio.privacy_val:checked").val();

            if ($('#allow_comment').is(':checked')) {
                var allow_comment = 1;
            } else {
                var allow_comment = 0;
            }

            if ($("#bell-announcement").hasClass("notification-disabled")) {
                var announcement = 0;
            } else {
                var announcement = 1;
            }
            formData.append('html_content', html_content);
            formData.append('privacy', privacy);
            formData.append('allow_comment', allow_comment);
            formData.append('announcement', announcement);

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

    });
    let vid = document.getElementById("myVideo");
    $('.video-click').click(function() {
        $(this).parent().hide();
        vid.play();
        vid.setAttribute("controls", "controls");
    });
    // $(document).ready(function(e) {
    // 	$("#em_0,#em_1").emojiPicker({
    // 		width: '320px',
    // 		height: '328px'
    // 	});
    // });
    $('.socialAction li.helpful a').on('click', function() {
        let togglesrc = $(this).find('img');
        let togglename = $(this).find('span');
        if (togglesrc.hasClass('helpful')) {
            togglesrc.attr('src', 'images/up-arrow-dashboard.svg');
            togglesrc.attr('class', 'helped');
        } else {
            togglesrc.attr('src', 'images/up-arrow-grey.svg');
            togglesrc.attr('class', 'helpful');
        }
    })
    $('.socialAction li.not-helpful a').on('click', function() {
        let togglesrc = $(this).find('img');
        let togglename = $(this).find('span');
        if (togglesrc.hasClass('not-helpful')) {
            togglesrc.attr('src', 'images/down-arrow-dashboard.svg');
            togglesrc.attr('class', 'notHelped');
        } else {
            togglesrc.attr('src', 'images/down-arrow-grey.svg');
            togglesrc.attr('class', 'not-helpful');
        }
    });
    $('.hashTag').on('click', function() {
        $('#messagepostarea').val($('#messagepostarea').val() + '#').focus();
    });
    $('#messagepostarea').keyup(function() {
        if ($.trim($('#messagepostarea').val()).length) {
            $(this).parents('.postwrapper').siblings('.shareBoxWrapper').find('.postActiveBtn').addClass('active');
        } else {
            $('.studybuttonGroup.post').removeClass('active');
        }
    });


    $('.shareMoreContentWrapper').hide();
    $('.moreSection').on('click', function() {
        let imgAttr = $(this).children('img');
        $(this).children('span').text($(this).children('span').text() == 'More' ? 'Less' : 'More');
        if (imgAttr.hasClass('more')) {
            imgAttr.attr('src', base_url + 'assets_d/images/less.svg');
            imgAttr.attr('class', 'less');
        } else {
            imgAttr.attr('src', base_url + 'assets_d/images/more-popup.svg');
            imgAttr.attr('class', 'more');
        }
        $('.shareMoreContentWrapper').slideToggle();
    });
    $('.privacyContent li').on('click', function() {
        // debugger;
        $('.privacyContent li').removeClass('active');
        if ($(this).children('a').find('input[type="radio"]').attr('checked', true)) {
            $(this).addClass('active');
        }
    })
    $('.shareDocs').hide();
    $('.pollsWrapper').hide();
    $('.fileSection').on('click', function() {
        if ($('.pollsWrapper').is(":Visible")) {
            $('.pollsWrapper').hide();
            $('.shareDocs').slideToggle();
        } else {
            $('.shareDocs').slideToggle();
        }
    });
    $('.pollSection').on('click', function() {
        if ($('.shareDocs').is(":Visible")) {
            $('.shareDocs').hide();
            $('.pollsWrapper').slideToggle();
        } else {
            $('.pollsWrapper').slideToggle();
        }
    });

    $(function() {
        $('#datetimepickerstart').datetimepicker({
            allowInputToggle: true,
            format: 'L'
        });
        $('#selectTime1').datetimepicker({
            format: 'LT',
            allowInputToggle: true
        });
    });
    index = 3;
    $('.addmore').on('click', function() {
        if (index < 6) {
            index++;
            $('.pollsform').append(
                `<div class="form-group" id="option_div_${index}">
      					<input type="text" name="option[${index}]" class="form-control" placeholder="Option ${index}">
                        <a href="javascript:void(0)" onclick="removeOptionDiv('${index}')" class="cross-icon"><img src="<?php echo base_url(); ?>assets_d/images/clear-search-icon.svg" alt="Cross Icon"></a>
      				</div>
            		`
            );
        }
    });

    function removeOptionDiv(id) {
        index--;
        $('#option_div_' + id).remove();
    }
    $('.closeBtn').on('click', function() {
        $(this).parents('.uploadedDocs').hide();
    });
    $('.commentBoxWrap').hide();
    $('.socialAction li:nth-child(2)').on('click', function() {
        $(this).parent().parent().siblings('.commentBoxWrap').slideDown();
    });
    $('.hoverMenu li').on('click', function() {
        let togglesrc = $(this).parent().parent().siblings('a').find('img');
        let togglename = $(this).parent().parent().siblings('a').find('span');
        if ($(this).hasClass('likeOption')) {
            togglesrc.attr('src', 'images/liked.svg');
            togglename.text('Liked');
        } else if ($(this).hasClass('supportMenu')) {
            togglesrc.attr('src', 'images/support-dashboard.svg');
            togglename.text('Support');
        } else if ($(this).hasClass('celebrateMenu')) {
            togglesrc.attr('src', 'images/celebrate-dashboard.svg');
            togglename.text('Celebrate');
        } else if ($(this).hasClass('curiousMenu')) {
            togglesrc.attr('src', 'images/curious-dashboard.svg');
            togglename.text('Curious');
        } else if ($(this).hasClass('insightMenu')) {
            togglesrc.attr('src', 'images/insight-dashboard.svg');
            togglename.text('Insight');
        } else if ($(this).hasClass('loveMenu')) {
            togglesrc.attr('src', 'images/love-dashboard.svg');
            togglename.text('Love');
        }
    });
    // $('.innerReplyBox').slideUp( );
    $('.leftStatus a.reply').on('click', function() { 
        $(this).children('.innerReplyBox').slideDown();
    });
    $('.uloadedImage .close').click(function() {
        $(this).parent().hide();
    });
    $('#notification').on('click', function() {
        let imgsrc = $(this).children('img');
        if (imgsrc.hasClass('notification-disabled')) {
            imgsrc.attr('src', base_url + 'assets_d/images/alert.svg');
            imgsrc.attr('class', 'notification-active')
        } else {
            imgsrc.attr('src', base_url + 'assets_d/images/alert-grey.svg');
            imgsrc.attr('class', 'notification-disabled')
        }
    })


    

    

    function removeOptionDivDelete(id, option_id) {
        url = '<?php echo base_url(); ?>account/deletePollOption';
        $.ajax({
            type: 'POST',
            url: url,
            
            data: {
                "option_id": option_id
            },
            
            success: function(result) {
                indexEdit--;
                $('#edit_option_div_' + id).remove();
            }
        });
        
    }

</script>
<script type='text/javascript'>
$(document).ready(function() {
	
	var searchType = "<?php echo (isset($searchType)) ? $searchType : 'peers'; ?>";
	
	createPagination(0,searchType);
	$('#pagination').on('click','a',function(e){
		e.preventDefault(); 
		var pageNum = $(this).attr('data-ci-pagination-page');
		createPagination(pageNum,searchType);
	});
	
	function createPagination(pageNum,searchType){
		$.ajax({
			url: '<?php echo base_url(); ?>account/loadData/'+pageNum+'/'+searchType,
			type: 'get',
			dataType: 'json',
			success: function(responseData){
				
				$(".searchThing").html(responseData.searchThing);
				$(".searchHtml").html(responseData.searchHtml);
				
				if(responseData.pagination != ''){
					$('#pagination').css('display','flex');
					$('#pagination').html(responseData.pagination);
				} else {
					$('#pagination').css('display','none');
				}
			},
			complete: function() {
				$('.childDivTrigger').click(function (e) {          
					e.stopImmediatePropagation();
					
					var redirect_url = $(this).attr('data-userProfileUrl');
					window.location.href=redirect_url;
				}); 

				$('.mainDivTrigger').click(function () {
					var redirect_url = $(this).attr('data-userPostUrl');
					window.location.href=redirect_url;
				}).children().click(function (e) {
				});
			}
		});
	}
});
</script>
</body>

</html>