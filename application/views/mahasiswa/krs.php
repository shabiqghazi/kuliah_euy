<div class="container-fluid">
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-body">
					<?php for($i = 1; $i <= 8; $i++): ?>
							<a href="<?= base_url('mahasiswa/krs/' . $i); ?>" class="btn btn-primary text-light m-1" width="">Semester <?= $i ?></a>
					<?php endfor; ?>
				</div>
			</div>
			<a href="<?= base_url('mahasiswa/cetak_krs') ?>" class="shadow btn btn-warning m-1 mt-5"><i class="fas fa-print mr-2"></i>Cetak</a>
		</div>
	</div>
</div>