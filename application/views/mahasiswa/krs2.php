<div class="container-fluid">
	<div class="card p-3 shadow">
		<?= $this->session->flashdata('message'); ?>
		<div class="table-responsive">
			<table class="table table-striped">
				<thead class="">
					<tr>
						<th scope="col">No.</th>
						<th scope="col">#</th>
						<th scope="col">Kode</th>
						<th scope="col">Kelas</th>
						<th scope="col">Dosen</th>
						<th scope="col">Jumlah SKS</th>
					</tr>
				</thead>
				<tbody>
					<?php $i=0; foreach($kelas_semester as $kls_s): ?>
					<tr>
						<th scope="row"><?= ++$i ?></th>
						<td>
							<div class="form-check">
								<input class="form-check-input position-static krs" type="checkbox" id="krs" <?= cek_krs($user['user_id'], $kls_s['kelas_id']); ?> data-user="<?= $user['user_id'] ?>" data-mk="<?= $kls_s['kelas_id'] ?>" data-smk="<?= $kls_s['semester'] ?>">
							</div>
						</td>
						<td><?= $kls_s['kode'] ?></td>
						<td><?= $kls_s['kelas'] ?></td>
						<td><?= $kls_s['nama'] ?></td>
						<td><?= $kls_s['jml_sks'] ?> SKS</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>