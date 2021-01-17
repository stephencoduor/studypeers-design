<script src="<?php echo base_url(); ?>assets_d/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets_d/js/Chart.bundle.js"></script>
<script src="<?php echo base_url(); ?>assets_d/js/jquery.mCustomScrollbar.js"></script>
<script src="<?php echo base_url(); ?>assets_d/js/utils.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<!--<script src="https://areaaperta.com/nicescroll/js/jquery.nicescroll.plus.js"></script>-->
<!--<script src="https://areaaperta.com/nicescroll/js/jquery.nicescroll.min.js"></script>-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="<?php echo base_url(); ?>assets_d/js/jquery.star-rating-svg.js"></script>
<?php if ($index_menu == 'study-sets') { ?>
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

<script src="<?php echo base_url(); ?>assets_d/js/custom.js"></script>
<script>
	$(function() {
		$("select").niceSelect();
	});
</script>
</body>

</html>