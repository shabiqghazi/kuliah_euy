<div class="container-fluid">
<div class="row">
	<?php if($kelas): ?>
		<?php $i = 1; foreach($kelas as $kls): ?>
		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
			<a href="<?= base_url('dosen/kelas/') . $kls['kelas_id']; ?>" class="card btn text-left p-0 <?php if($i % 3 == 1){
				echo 'border-left-primary';
			} else if ($i % 3 == 2){
				echo 'border-left-success';
			} else {
				echo 'border-left-info';
			} ?> shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
							<?= $kls['kode'] ?></div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $kls['kelas'] ?></div>
						</div>
					</div>
				</div>
			</a>
		</div>
		<?php $i++; endforeach; ?>
	</div>
	<?php endif; ?>
</div>