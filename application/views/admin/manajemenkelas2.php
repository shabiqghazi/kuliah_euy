<div class="container-fluid">
	<div class="card shadow p-3">
	<?= $this->session->flashdata('message'); ?>
	<div class="table-responsive">
		<table class="table table-striped">
			<thead class="">
				<tr>
					<th scope="col">No.</th>
					<th scope="col">Kode</th>
					<th scope="col">Kelas</th>
					<th scope="col">Dosen</th>
					<th scope="col">Hari</th>
					<th scope="col">Jam</th>
				</tr>
			</thead>
			<tbody>
				<?php $i=0; foreach($kelas_semester as $kls_s): ?>
				<tr>
					<th scope="row"><?= ++$i ?></th>
					<td><?= $kls_s['kode'] ?></td>
					<td><?= $kls_s['kelas'] ?></td>
					<td>
						<div class="form-group">
							<select class="form-control manajemen-kelas" data-type="dosen" data-semester="<?= $kls_s['semester'] ?>" data-dm_id="<?= $kls_s['dm_id'] ?>">
								<?php foreach($dosen as $dsn): ?>
								<option data-utama="<?= $dsn['user_id'] ?>"
									<?= $kls_s['user_id'] == $dsn['user_id'] ? 'selected' : '' ?>><?= $dsn['nama'] ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</td>
					<td>
						<div class="form-group">
							<select class="form-control manajemen-kelas" data-type="hari" data-semester="<?= $kls_s['semester'] ?>" data-dm_id="<?= $kls_s['dm_id'] ?>">
								<?php foreach($hari as $h): ?>
								<option data-utama="<?= $h['hari_id'] ?>"
									<?= $kls_s['hari_id'] == $h['hari_id'] ? 'selected' : '' ?>><?= $h['hari'] ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</td>
					<td>
						<div class="form-group">
							<select class="form-control manajemen-kelas" data-type="jam" data-semester="<?= $kls_s['semester'] ?>" data-dm_id="<?= $kls_s['dm_id'] ?>">
								<?php foreach($jam as $j): ?>
								<option data-utama="<?= $j['jam_id'] ?>"
									<?= $kls_s['jam_id'] == $j['jam_id'] ? 'selected' : '' ?>><?= $j['jam'] ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	</div>
</div>