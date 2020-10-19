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
				<div>Announcements</div>
				<div>
					<a href="/announcements/sync" id="sync" class="btn btn-sm btn-primary btn-outline">Sync Announcements</a>

				</div>
			</div>
		</div>
		<div class="card-body">

			
				<table class="table">
					<thead>
						<tr>
							<th scope="col">Title</th>
							<th scope="col">Message</th>
							
	
						</tr>
					</thead>
					<tbody>
					<?php if (count($announcement)) : ?>
					<?php foreach ($announcement as $c) : ?>
						<tr>
							<th scope="row" data-announcement-id="<?=$c['id']?>"><?= $c['title'];?></th>
							<td><?= substr($c['message'],0,100);?></td>
							
						</tr>
					<?php endforeach; ?>
					<?php else : ?>
						<tr>
							<td col-span="4">No Announcements found</td>
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

				// console.log(data);
				$(e).removeAttr('disabled');
				$('#syncpreloader').remove();
				window.location.reload();
			});
		});
	});
</script>