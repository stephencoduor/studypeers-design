<section class="mainContent">
	<div class="alert alert-default">
		<?php
		if ($this->session->flashdata('flash_message')) {
			echo $this->session->flashdata('flash_message');
		}
		?>
	</div>
	<div class="card">
		<div class="card-header">
			<div class="row d-flex justify-content-between">
				<div>Assignments</div>
				<div>
					<a href="/assignments/sync" id="sync" class="btn btn-sm btn-primary btn-outline">Sync Assignments</a>

				</div>
			</div>
		</div>
		<div class="card-body">

			
				<table class="table">
					<thead>
						<tr>
							<th scope="col">Assignment</th>
							<th scope="col">Course Name</th>
							
							<th scope="col">Due At</th>
							<th scope="col">Assignment Link</th>
							<th scope="col">Submission Download Link</th>
						</tr>
					</thead>
					<tbody>
					<?php if (count($assignment)) : ?>
					<?php foreach ($assignment as $c) : ?>
						<tr>
							<th scope="row" data-assignment-id="<?=$c['id']?>"><?= $c['name'];?></th>
							<td><?= $c['course_name'];?></td>
							
							<td><?= $c['due_at'];?></td>
							<td><a target="_blank"  href="<?= $c['html_url'];?>"><?= $c['html_url'];?></a></td>
							<td><a target="_blank"  href="<?= $c['submissions_download_url'];?>"><?= $c['submissions_download_url'];?></a></td>
						</tr>
					<?php endforeach; ?>
					<?php else : ?>
						<tr>
							<td col-span="4">No Assignments found</td>
						</tr>
					<?php endif; ?>
					</tbody>
				</table>
				

		</div>
	</div>
</section>
<script>
	$(function() {
		$('#sync').click(function(e) {

			e.preventDefault();
			$(this).attr('disabled', true);
			let href = new URL(this.href);

			$(this).append('<span id="syncpreloader" class="spinner-border text-success" role="status" style="height: 1rem;width: 1rem;"></span>')


			$.ajax({
				url: href.pathname
			}).done((data) => {

				console.log(data);
				$(e).removeAttr('disabled');
				$('#syncpreloader').remove();
				window.location.reload();
			});
		});
	});
</script>