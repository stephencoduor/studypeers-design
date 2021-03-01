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
				<div>Discussions</div>
				<div>
					<a href="/discussions/sync" id="sync" class="btn btn-sm btn-primary btn-outline">Sync Discussions</a>

				</div>
			</div>
		</div>
		<div class="card-body">

			
				<table class="table">
					<thead>
						<tr>
							<th scope="col">Topic</th>
							<th scope="col">Excerpt</th>
							
							
							<th scope="col">Link</th>
						</tr>
					</thead>
					<tbody>
					<?php if (count($discussion)) : ?>
					<?php foreach ($discussion as $c) : ?>
						<tr>
							<th scope="row" data-discussion-id="<?=$c['id']?>"><?= $c['title'];?></th>
							<td><?= htmlspecialchars(substr($c['message'],0,100));?></td>
							
							<td><a target="_blank"  href="<?= $c['html_url'];?>"><?= $c['html_url'];?></a></td>
						</tr>
					<?php endforeach; ?>
					<?php else : ?>
						<tr>
							<td col-span="4">No Discussion topics found</td>
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