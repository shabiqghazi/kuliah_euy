<div class="container-fluid">
	<div class="row">
		<div class="col-lg-7">
			<div class="card card-body">
			<?= $this->session->flashdata('message'); ?>
				<form action="<?= base_url('profil/ubahpassword') ?>" method="post">
					<div class="row form-group">
						<div class="col-lg-3">
							<label for="current_pass" class="col-form-label">Password lama</label>
						</div>
						<div class="col-lg-9">
							<input type="password" class="form-control" name="current_pass" id="current_pass">
						</div>
					</div>
					<div class="row form-group">
						<div class="col-lg-3">
							<label for="new_pass1" class="col-form-label">Password baru</label>
						</div>
						<div class="col-lg-9">
							<input type="password" class="form-control" name="new_pass1" id="new_pass1">
						</div>
					</div>
					<div class="row form-group">
						<div class="col-lg-3">
							<label for="new_pass2" class="col-form-label">Konfirmasi password</label>
						</div>
						<div class="col-lg-9">
							<input type="password" class="form-control" name="new_pass2" id="new_pass2">
						</div>
					</div>
					<div class="row form-group justify-content-end">
						<div class="col-lg-9">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>