<div class="container">
	<div class="row">
		<div class="col-lg-10">
			<div class="card">
				<div class="card-body">
					<?php if($mhskrs): ?>
					<h3><?= $mhskrs[0]['nama']; ?></h3>
					<h5><?= $mhskrs[0]['ni']; ?></h5>
					<div class="responsive-table mt-5">
						<?= $this->session->flashdata('message'); ?>
						<table class="table">
							<thead>
								<tr>
									<th scope="col">No</th>
									<th scope="col">Kode</th>
									<th scope="col">Kelas</th>
									<th scope="col">Semester</th>
									<th scope="col">SKS</th>
									<th scope="col">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $i=1;foreach($mhskrs as $krs): ?>
								<tr>
									<th scope="row"><?= $i++ ?></th>
									<td><?= $krs['kode']; ?></td>
									<td><?= $krs['kelas']; ?></td>
									<td><?= $krs['semester']; ?></td>
									<td><?= $krs['jml_sks']; ?></td>
									<td><a href="<?= base_url('admin/batalkrs/') . $krs['mam_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin?')">Batalkan KRS</a></td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					<?php else : 
						echo 'Tidak ada data'; 
					endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>