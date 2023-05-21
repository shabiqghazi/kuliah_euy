<?php if(!isset($tugas_selesai)): ?>
<div class="container-fluid">
	<div class="col-lg-8">
		<div class="card p-4 shadow">
			<h1><?= $tugas['title']; ?></h1>
			<p class="mb-0"><?= $tugas['deskripsi'] ?></p>
			<table class="table table-sm mt-4 mb-0 table-bordered">
				<tbody>
					<tr>
						<td class="table-active">Mata Kuliah</td>
						<td><?= $tugas['kelas']; ?></td>
					</tr>
					<tr>
						<td class="table-active">Sesi</td>
						<td><?= $tugas['sesi']; ?></td>
					</tr>
					<tr>
						<td class="table-active">Deadline</td>
						<td><?= date('d M Y - H:i T', $tugas['deadline']); ?></td>
					</tr>
				</tbody>
			</table>
			<hr class="my-4">
			<?= form_open_multipart('mahasiswa/tugas/' . $tugas['tugas_id']);?>
			<?= form_error('text','<small class="text-danger pl-3">','</small>'); ?>
				<div class="form-group row">
					<div class="col-lg-2 col-form-label">
						<label for="text">Text</label>
					</div>
					<div class="col-lg-10">
						<textarea class="form-control" rows="5" id="text" name="text"></textarea>
					</div>
				</div>
				<div id="ini"></div>
				<div class="form-group row">
					<div class="col-lg-2 col-form-label">
						<label for="file">File</label>
					</div>
					<div class="col-lg-10">
						<div class="custom-file">
							<input type="file" class="custom-file-input" id="file-upload" aria-describedby="inputGroupFileAddon01" name="file[]" value="" multiple>
							<label class="custom-file-label" for="file-upload" id="file-drag">Browse</label>
						</div>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-lg-2"></div>
					<div class="col-lg-10">
						<div class="selected-images"></div>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-lg-2"></div>
					<div class="col-lg-10">
						<button type="Submit" class="btn btn-primary">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php else : ?>
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
				<div class="row">
					<div class="col-2">
					<!-- Button trigger modal -->
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ubahdotugas">
						Ubah
						</button>
					</div>
					<div class="col-2">
						<a href="<?= base_url('mahasiswa/hapusdotugas/') . $tugas_selesai['tugas_selesai_id'] ?>" onclick="return confirm('Apakah anda yakin?')" type="button" class="btn btn-primary">
						Hapus
						</a>
					</div>
				</div>
					<!-- Modal -->
					<div class="modal fade" id="ubahdotugas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-scrollable">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Ubah tugas</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<?= form_open_multipart('mahasiswa/ubahdotugas/' . $tugas_selesai['tugas_selesai_id']);?>
									<?= form_error('text','<small class="text-danger pl-3">','</small>'); ?>
									<div class="form-group row">
										<div class="col-lg-2 col-form-label">
											<label for="text">Text</label>
										</div>
										<div class="col-lg-10">
											<textarea class="form-control" rows="5" id="text" name="text"><?= $tugas_selesai['text'] ?></textarea>
										</div>
									</div>
									<div id="ini"></div>
									<div class="form-group row">
										<div class="col-lg-2 col-form-label">
											<label for="file">File</label>
										</div>
										<div class="col-lg-10">
											<div class="custom-file">
												<input type="file" class="custom-file-input" id="file-upload" aria-describedby="inputGroupFileAddon01" name="file[]" value="" multiple>
												<label class="custom-file-label" for="file-upload" id="file-drag">Browse</label>
											</div>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-lg-2"></div>
										<div class="col-lg-10">
											<div class="selected-images"></div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="Submit" class="btn btn-primary" name="submit">Submit</button>
								</div>
								</form>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>