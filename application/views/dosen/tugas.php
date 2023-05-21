<div class="container-fluid">
	<div class="card p-3 shadow">
		<div class="card-body">
		<a href="<?= base_url('dosen/tugasbaru') ?>" class="btn btn-primary mb-3"><i class="fas fa-fw fa-plus-square"></i> Tambah Tugas</a>
		<?= $this->session->flashdata('message'); ?>
		<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">No.</th>
					<th scope="col">Kelas</th>
					<th scope="col">Tugas</th>
					<th scope="col">Sesi</th>
					<th scope="col">Deadline</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
			<?php if($tugas): ?>
				<tbody>
				<?php $i=1; foreach($tugas as $tgs): ?>
					<tr>
						<th scope="row"><?= $i; $i++ ?></th>
						<td><?= $tgs['kelas'] ?></td>
						<td><?= $tgs['title'] ?></td>
						<td><?= $tgs['sesi'] ?></td>
						<td><?= $tgs['deadline'] ? date('d M Y H:i',$tgs['deadline']) : '' ?></td>
						<td>
							<a href="<?= base_url('dosen/manajementugas/') . $tgs['tugas_id'] ?>" class="btn btn-warning btn-sm"><i class="fas fa-fw fa-eye"></i></a>
							<a href="<?= base_url('dosen/ubahtugas/') . $tgs['tugas_id'] ?>" class="btn btn-success btn-sm"><i class="fas fa-fw fa-edit"></i></a>
							<a href="<?= base_url('dosen/hapustugas/') . $tgs['tugas_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin?')"><i class="fas fa-fw fa-trash-alt"></i></a>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			<?php endif; ?>
		</table>
		</div>
		</div>
	</div>
</div>