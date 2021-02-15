<script src="<?php echo base_url(); ?>assets_d/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets_d/js/Chart.bundle.js"></script>
<script src="<?php echo base_url(); ?>assets_d/js/jquery.mCustomScrollbar.js"></script>
<script src="<?php echo base_url(); ?>assets_d/js/utils.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script src="https://areaaperta.com/nicescroll/js/jquery.nicescroll.plus.js"></script>
<script src="https://areaaperta.com/nicescroll/js/jquery.nicescroll.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script src="<?php echo base_url(); ?>assets_d/js/jquery.star-rating-svg.js"></script>
<?php if ($index_menu == 'study-sets' || $index_menu == 'documents') { ?>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets_d/js/jquery.emojipicker.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets_d/js/jquery.emojis.js"></script>

<?php } ?>
<script src="https://momentjs.com/downloads/moment.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/js/bootstrap-datetimepicker.min.js"></script>
<?php if ($index_menu == 'questions') { ?>
	<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets_d/js/jquery-te-1.4.0.min.js" charset="utf-8"></script> -->
<?php } ?>
<?php if ($index_menu == 'study-sets') { ?>

	<script src='<?php echo base_url(); ?>assets_d/js/main.js'></script>
<?php } ?>

<?php if ($index_menu == 'documents') { ?>
<script>
	$(document).ready(function(e) {
		$('#input-emoji').emojiPicker({
			width: '320px',
			height: '328px'
		});
	});

	$("#input-emoji").keypress(function(event) {
		if (event.which == 13) {
			comment = $("#input-emoji").val();
			doc_id = $("#comment_document_id").val();
			if (comment != '') {
				var url = '<?php echo base_url('account/addCommentDocument') ?>';
				$.ajax({
					url: url,
					type: 'POST',
					data: {
						'comment': comment,
						'doc_id': doc_id
					},
					dataType: 'json',
					success: function(result) {
						$('#document_comment').append(result.html);
						$('#commentCount').html(result.count);
						$("#input-emoji").val('');
					}
				});
			}
		}
	});

	function showReplyBox(comment_id){
		$('#replyBox'+comment_id).css('display','flex');
	}

	function postReply(event, comment_id, comment) {
		if (event.which == 13) {
			doc_id = $("#comment_document_id").val();
			if (comment != '') {
				var url = '<?php echo base_url('account/postReplyDocument') ?>';
				$.ajax({
					url: url,
					type: 'POST',
					data: {
						'comment': comment,
						'doc_id': doc_id,
						'comment_id': comment_id
					},
					success: function(result) {
						$('#reply_' + comment_id).append(result);
						$("#input_reply_" + comment_id).val('');
					}
				});
			}
		}
	}

	function likeComment(comment_id) {
		var url = '<?php echo base_url('account/likeComment') ?>';
		$.ajax({
			url: url,
			type: 'POST',
			data: {
				'comment_id': comment_id
			},
			success: function(result) {
				if (result != 0) {
					$('#reactmessage_' + comment_id).show();
					$('#like_count_' + comment_id).html(result);
					if ($('#likeComment' + comment_id).text() == 'Like') {
                        $('#likeComment' + comment_id).text('Liked');
                    } else {
                        $('#likeComment' + comment_id).text('Like');
                    }
				} else {
					$('#reactmessage_' + comment_id).hide();
					$('#like_count_' + comment_id).html(result);
					if ($('#likeComment' + comment_id).text() == 'Like') {
                        $('#likeComment' + comment_id).text('Liked');
                    } else {
                        $('#likeComment' + comment_id).text('Like');
                    }
				}
			}
		});
	}

	$("#imgComment").change(function() {
		var file_data = $('#imgComment').prop('files')[0];
		var form_data = new FormData();
		doc_id = $("#comment_document_id").val();
		form_data.append('file', file_data);
		form_data.append('doc_id', doc_id);
		// alert(form_data);  
		var url = '<?php echo base_url('account/postImgCommentDoc') ?>';
		$.ajax({
			url: url, // point to server-side PHP script 
			dataType: 'text', // what to expect back from the PHP script, if anything
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: 'post',
			success: function(result) {
				$('#document_comment').append(result);
				$("#imgComment").val('');
			}
		});
	});


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
                // if (result != '(0)') {
                //     $('#comment_reply_count_' + comment_id).show();
                //     $('#comment_reply_count_' + comment_id).html(result);
                // } else {
                //     $('#comment_reply_count_' + comment_id).hide();
                // }
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
                    $('#commentCount').show();
                    $('#commentCount').html(result);
                } else {
                    $('#commentCount').hide();
                }
            }
        });


    }

    function selectRateDesc(id, val){
		$('#rate_description').val(val);
		$('.onhover').hide(); $('.initial').show();
		$('#'+id+' .initial').hide();
		$('#'+id+' .onhover').show();
		$("#err_rate_description").html('').hide();
	}


	function hoverRateDesc(id, val){
		var rate_description = $('#rate_description').val();
		if(rate_description != val) {
			$('#'+id+' .initial').hide();
			$('#'+id+' .onhover').show();
		}
	}

	function hoverOutRateDesc(id, val){
		var rate_description = $('#rate_description').val();
		if(rate_description != val) {
			$('#'+id+' .initial').show();
			$('#'+id+' .onhover').hide();
		}
	}


	function anonymousCheck(){
		if ($('#customCheck').is(':checked')) {
			$('#if_anonymous').val(1);
		} else {
			$('#if_anonymous').val(0);
		}
	}


	function validateRating(){
		var user_rating = $('#user_rating').val(); 
		if(user_rating == ''){
			$("#err_user_rating").html('Please select rating.').show();
			return false;
		} else {
			$("#err_user_rating").html('').hide();
		}

		var rate_description = $('#rate_description').val();
		if(rate_description == ''){
			$("#err_rate_description").html('Please select a description.').show();
			return false;
		} else {
			$("#err_rate_description").html('').hide();
		}

	}

</script>
<?php } ?>


<script>
	$('.document_dtl').on('click', function() {
		$('.subheader_top').toggleClass('active');
		$('.mainCardWrapper').slideToggle();
		$('.document_dtl i').toggleClass('fa-chevron-down fa-chevron-up');
	})
	$(document).on("click", ".doc_delete_event", function() {
		var doc_id = $(this).data('id');
		$(".modal-body #doc_id").val(doc_id);

	});

	$(document).on("click", ".question_delete_event", function() {
		var question_id = $(this).data('id');
		$(".modal-body #question_id").val(question_id);

	});

	$(document).on("click", ".reportQuestionAnswer", function() {
		var answer_id = $(this).data('id');
		$(".modal-body #answer_id").val(answer_id);

	});

	$(document).on("click", ".select_best_answer", function() {
		var answer_id = $(this).data('id');
		$(".modal-body #answer_id").val(answer_id);

	});

	CKEDITOR.replace('jqte-test', {
		extraPlugins: 'mathjax,uploadimage,codesnippet',
		codeSnippet_theme: 'monokai_sublime',
		allowedContent: true,
		mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML',
		filebrowserImageUploadUrl: '<?= base_url() ?>account/uploadEditorImg',

		height: 320
	});




	// $('#jqte-test').jqte();
</script>
<?php if ($index_menu == 'study-sets') { ?>
	<script type="text/javascript">
		$(document).ready(function(e) {
			$(document).on('click', '.deleteStudySet', function() {
				var delete_id = $(this).data('id');
				$("#ss_id").val(delete_id);

			});

			$('#input-emoji').emojiPicker({
				width: '320px',
				height: '328px',
				position: 'top'
			});

			$(document).on('click', '.reportBtn', function() {
				var study_set_id = $("#report_id").val();
				var report_reason = $("#report_reason").val();
				var report_description = $("#report_description").val();
				if (report_reason == '') {
					$("#report_reason_err").html('Please select reason.');
					return false;
				}
				if (study_set_id != '' && report_reason != '') {
					$.ajax({
						url: '<?php echo base_url(); ?>studyset/reportStudySet',
						type: 'post',
						data: {
							"study_set_id": study_set_id,
							'report_description': report_description,
							"report_reason": report_reason
						},
						success: function(result) {
							$("#confirmationModal").modal('hide');
							window.location = '<?php echo base_url(); ?>studyset';
						}
					})
				}
			});





		});
	</script>
<?php } ?>
<script src="<?php echo base_url(); ?>assets_d/js/jquery.nice-select.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets_d/js/pdfobject.min.js"></script>
<script>PDFObject.embed("<?php echo base_url(); ?>uploads/users/<?php echo $result['featured_image']; ?>", "#example1");</script>
<script src="<?php echo base_url('assets_d/js/bootstrap-select.js'); ?>"></script>

<script src="<?php echo base_url(); ?>assets_d/js/custom.js"></script>
</body>
</html>