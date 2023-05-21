<div class="container-fluid">
	<div class="row">
		<div class="col-lg-7">
			<div class="card">
				<div class="card-body">
					<div class="row justify-content-center">
						<?php for($i = 1; $i <= 8; $i++): ?>
							<div class="col-md-3">
								<a href="<?= base_url('admin/manajemenkelas/' . $i); ?>" class="btn btn-primary text-light m-1 d-block" width="">Semester <?= $i ?></a>
							</div>
						<?php endfor; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>