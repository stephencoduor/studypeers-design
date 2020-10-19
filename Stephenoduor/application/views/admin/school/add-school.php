<!-- Header -->
<div class="header bg-primary pb-6">
	<div class="container-fluid">
		<div class="header-body">
			<div class="row align-items-center py-4">
				<div class="col-lg-6 col-7">
					<h6 class="h2 text-white d-inline-block mb-0">Add School</h6>
					<nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
						<ol class="breadcrumb breadcrumb-links breadcrumb-dark">
							<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fas fa-home"></i></a></li>

							<li class="breadcrumb-item active" aria-current="page">Add School</li>
						</ol>
					</nav>
				</div>

			</div>
			<?php if ($this->session->flashdata('flash_message')) {
				echo $this->session->flashdata('flash_message');
			}
			?>
		</div>
	</div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
	<div class="row">
		<div class="col">
			<div class="card">
				<h5 class="card-header">Add School</h5>
				<form action="/admin/addSchool" method="post">
					<div class="card-body">
						<div class="form-group">
							<label for="schoolName">Name</label>
							<input type="text" class="form-control" name="name" id="schoolName" placeholder="Purdue University" />
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="schoolWebsite">School Website</label>
								<input type="text" class="form-control" id="schoolWebsite" name="website" placeholder="https://example.edu" />
							</div>
							<div class="form-group col-md-6">
								<label for="canvasURL">Canvas URL</label>
								<input type="text" class="form-control" id="canvasURL" name="canvas_url" />
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="emailDomain">Email Domain</label>
								<input type="text" class="form-control" id="emailDomain" name="emailDomain" />
							</div>
							<div class="form-group col-md-4">
								<label for="alpha_two_code">Country Alpha-2 Code</label>
								<input type="text" class="form-control" id="alpha_two_code" name="alpha_two_code" placeholder="KE" />
							</div>
							<div class="form-group col-md-4">
								<label for="country">Country</label>
								<input type="text" class="form-control" id="country" name="country" placeholder="Kenya" />
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="clientID">Client ID</label>
								<input type="text" class="form-control" id="clientID" name="client_id" />
							</div>
							<div class="form-group col-md-6">
								<label for="clientSecret">Client Secret</label>
								<input type="text" class="form-control" id="clientSecret" name="client_secret" />
							</div>

						</div>
						<div class="form-row">

							<div class="form-group col-md-6">
								<label for="authEndpoint">Authorization Endpoint</label>
								<div class="input-group mb-3">
								
									<div class="input-group-prepend">
										<span class="input-group-text" id="auth_endpoint">canvasInstance.com/</span>
									</div>
									<input type="text" class="form-control" id="authEndpoint" name="auth_endpoint" />
								</div>
								
								
							</div>
							<div class="form-group col-md-6">
								<label for="tokenEndpoint">Token Endpoint</label>
								
								<div class="input-group mb-3">
								
									<div class="input-group-prepend">
										<span class="input-group-text" id="token_endpoint">canvasInstance.com/</span>
									</div>
									<input type="text" class="form-control" id="tokenEndpoint" name="token_endpoint"  />
								</div>
							</div>

						</div>
					</div>
					<div class="card-footer d-flex justify-content-end">
						<button type="submit" class="btn btn-primary btn-sm btn-outline">
							Add School
						</button>
						<button type="reset" class="btn btn-secondary clear-form">
							Clear
						</button>
					</div>
				</form>
			</div>
		</div>

	</div>
</div>