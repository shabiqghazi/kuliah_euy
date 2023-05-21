<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="card card-body">
				<div class="table-responsive">
					<table class="table">
						<thead width="100%">
							<tr>
								<th scope="col">No</th>
								<th scope="col">Mahasiswa</th>
								<th scope="col">Tugas</th>
								<th scope="col">Waktu Selesai</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=0;foreach($tugas_selesai as $tgs_sls): ?>
							<tr>
								<th scope="row"><?= ++$i ?></th>
								<td><?= $tgs_sls['nama'] ?></td>
								<td><?= $tgs_sls['title'] ?></td>
								<td><?= date('d M Y H:i',$tgs_sls['waktu_selesai']); ?></td>
								<td><a href="<?= base_url('dosen/manajementugas/').$tgs_sls['tugas_id'].'/'.$tgs_sls['tugas_selesai_id'] ?>" class="btn btn-success btn-sm"><i class="fas fa-fw fa-eye"></i></a></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>