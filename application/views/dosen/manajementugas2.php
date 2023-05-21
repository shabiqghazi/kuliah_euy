<div class="container">
	<div class="row">
		<div class="col-lg-6">
			<div class="card card-body">
				<table class="table table-sm">
					<tbody>
						<tr>
							<th scope="row">Nama</th>
							<td><?= $tugas_selesai['nama']; ?></td>
						</tr>
						<tr>
							<th scope="row">NIM</th>
							<td><?= $tugas_selesai['ni']; ?></td>
						</tr>
						<tr>
							<th scope="row">Mata Kuliah</th>
							<td><?= $tugas_selesai['kelas']; ?></td>
						</tr>
						<tr>
							<th scope="row">Tugas</th>
							<td><?= $tugas_selesai['title']; ?></td>
						</tr>
						<tr>
							<th scope="row">Online Text</th>
							<td><?= $tugas_selesai['text']; ?></td>
						</tr>
						<tr>
							<th scope="row">File</th>
							<td>
								<?php $files = explode('/',trim($tugas_selesai['file'],'/')); ?>
								<?php $ori_files = explode('/',trim($tugas_selesai['ori_filename'],'/')); ?>
								<?php for($i = 0 ; $i < count($files) ; $i++): ?>
								<a href="<?= base_url('file/tugas-mahasiswa/') . $files[$i]; ?>"><?= $ori_files[$i] ?></a><br>
								<?php endfor; ?>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>