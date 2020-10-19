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
				<div>Courses</div>
				<div>
					<a href="/courses/sync" id="sync"  class="btn btn-sm btn-primary btn-outline">Sync Courses</a>
					
				</div>	
			</div>
		</div>
		<div class="card-body">
			
			
		<table class="table">
					<thead>
						<tr>
							<th scope="col">Course</th>
							<th scope="col">Code</th>
							
							<th scope="col">Start</th>
							<th scope="col">End</th>
						</tr>
					</thead>
					<tbody>
					<?php if (count($course)) : ?>
					<?php foreach ($course as $c) : ?>
						<tr>
							<th scope="row" data-assignment-id="<?=$c['id']?>"><?= $c['name'];?></th>
							<td><?= $c['course_code'];?></td>
							
							<td><?= $c['start_at'];?></td>
							<td><?= $c['end_at'];?></td>
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
	$(function(){
		$('#sync').click(function(e){
			console.log([e,this]);
			e.preventDefault();
			$(this).attr('disabled',true);
			let href = new URL(this.href);
			
			$(this).append('<span id="syncpreloader" class="spinner-border text-success" role="status" style="height: 1rem;width: 1rem;"></span>')
			

			$.ajax({
				url:href.pathname
			}).done((data) => {
				
				// console.log(data);
				$(e).removeAttr('disabled');
				$('#syncpreloader').remove();
				window.location.reload();
			});
	});
});
</script>