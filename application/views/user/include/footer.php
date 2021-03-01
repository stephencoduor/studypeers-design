

<script src="<?php echo base_url(); ?>assets_a/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets_a/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="<?php echo base_url(); ?>assets_d/js/Chart.bundle.js"></script>
<script src="<?php echo base_url(); ?>assets_d/js/utils.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script src="https://areaaperta.com/nicescroll/js/jquery.nicescroll.plus.js"></script>
<script src="https://areaaperta.com/nicescroll/js/jquery.nicescroll.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="<?php echo base_url(); ?>assets_d/js/jquery.star-rating-svg.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets_a/js/slick.js"></script>
<!--<script type="text/javascript" src="--><?php //echo base_url(); ?><!--assets_a/js/select2.min.js"></script>-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://momentjs.com/downloads/moment.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/js/bootstrap-datetimepicker.min.js"></script>
<?php if ($index_menu == 'questions') { ?>
	<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets_d/js/jquery-te-1.4.0.min.js" charset="utf-8"></script> -->
<?php } ?>

<script src="<?php echo base_url(); ?>assets_d/js/custom.js"></script>
<!--<script src="--><?php //echo base_url(); ?><!--assets_a/js/custom.js"></script>-->
<script>
    $(document).ready(function() {
        $('.select2__').select2();
    });
</script>
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

</script>

</body>

</html>