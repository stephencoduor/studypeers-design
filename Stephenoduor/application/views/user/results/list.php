
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
				<div>Results</div>
				<div>
					<a href="/results/sync" id="sync" class="btn btn-sm btn-primary btn-outline">Sync Assignments</a>

				</div>
			</div>
		</div>
		<div class="card-body">

			
				<table class="table">
					<thead>
						<tr>
							<th scope="col">Result URL</th>
							<th scope="col">Score</th>
							
							<!-- <th scope="col">Due At</th>
							<th scope="col">Link</th> -->
						</tr>
					</thead>
					<tbody>
					<?php if (count($result)) : ?>
					<?php foreach ($result as $c) : ?>
						<tr>
							<th scope="row" data-result-id="<?=$c['id']?>"><?= $c['name'];?></th>
							<td><?= $c['result_id'];?></td>
							
							<td><?= $c['resultScore'];?></td>
							>
						</tr>
					<?php endforeach; ?>
					<?php else : ?>
						<tr>
							<td col-span="4">No Results found</td>
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