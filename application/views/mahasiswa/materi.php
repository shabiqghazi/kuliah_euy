<div class="container">
	<div class="row">
		<div class="col-lg-7">
			<div class="card">
				<div class="card-body">
					<h2><?= $materi['title']; ?></h2>
					<p><?= $materi['teks']; ?></p>
					<table class="table table-sm">
						<tbody>
							<tr>
								<th scope="row">Sesi</th>
								<td><?= $materi['sesi']; ?></td>
							</tr>
							<tr>
								<th scope="row">Kelas</th>
								<td><?= $materi['kelas']; ?></td>
							</tr>
							<tr>
								<th scope="row">File</th>
								<td><a href="<?= base_url('file/materi/') . $materi['file'] ?>"><?= $materi['ori_filename']; ?></a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>