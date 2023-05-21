<div class="container-fluid">
	<div class="card p-3 shadow">
		<?= $this->session->flashdata('message'); ?>
		<div class="table-responsive">
		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th scope="col">No.</th>
					<th scope="col">Aksi</th>
					<th scope="col">Kelas</th>
					<th scope="col">Tugas</th>
					<th scope="col">Sesi</th>
					<th scope="col">Deadline</th>
				</tr>
			</thead>
			<?php if($tugas): ?>
				<tbody>
				<?php $i=1; foreach($tugas as $tgs): ?>
					<tr>
						<th scope="row">
							<?= $i; $i++ ?>
						</th>
						<td>
							<a class="btn btn-primary" href="<?= base_url('mahasiswa/tugas/') . $tgs['tugas_id'] ?>">Kerjakan</a>
						</td>
						<td><?= $tgs['kelas'] ?></td>
						<td><?= $tgs['title'] ?></td>
						<td><?= $tgs['sesi'] ?></td>
						<td><?= $tgs['deadline'] ? date('d M Y - H:i T',$tgs['deadline']) : '' ?></td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			<?php endif; ?>
		</table>
		</div>
	</div>
</div>