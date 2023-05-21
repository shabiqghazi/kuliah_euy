<div class="container-fluid">
	<div class="row">
		<div class="card mb-3 p-2 col-md-5">
		<?= $this->session->flashdata('message') ?>
			<div class="row no-gutters">
				<div class="col-md-4">
					<img class="" src="<?= base_url('assets/img/profile/') . $user['foto'] ?>" alt="no photo" width="100%">
				</div>
				<div class="col-md-8">
					<div class="card-body my-4">
						<h4 class="card-title"><?= $user['nama'] ?></h4>
						<h6 class="card-text"><?= $user['ni'] ?></h6>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>