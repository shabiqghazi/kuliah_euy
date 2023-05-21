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
					<div class="row">
						<div class="col-lg-2">
						</div>
						<div class="col-lg-10">
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ubahdotugas">
							Ubah
							</button>
							<a href="<?= base_url('dosen/hapusmateri/') . $materi['materi_id'] ?>" class="btn btn-danger btn-sm">Hapus</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="ubahdotugas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Ubah materi</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?= form_open_multipart('dosen/ubahmateri/'.$materi['materi_id']);?>
				<?= form_error('text','<small class="text-danger pl-3">','</small>'); ?>
				<?= $this->session->flashdata('message'); ?>
				<div class="form-group row">
					<div class="col-lg-2 col-form-label">
						<label for="title">Title</label>
					</div>
					<div class="col-lg-10">
						<input type="text" name="title" class="form-control" id="title" value="<?= $materi['title'] ?>" required>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-lg-2 col-form-label">
						<label for="teks">Teks</label>
					</div>
					<div class="col-lg-10">
						<textarea class="form-control" rows="5" id="teks" name="teks"><?= $materi['teks'] ?></textarea>
					</div>
				</div>
				<div id="ini"></div>
				<div class="form-group row">
					<div class="col-lg-2 col-form-label">
						<label for="file">File</label>
					</div>
					<div class="col-lg-10">
						<div class="custom-file">
							<input type="file" class="custom-file-input" id="file-upload" aria-describedby="inputGroupFileAddon01" name="file">
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
					<div class="col-sm-2 col-form-label">
						<label for="kelas_id">Kelas</label>
					</div>
					<div class="col-sm-10">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="<?= $materi['kelas_id']; ?>" id="kelas_id" name="kelas_id" checked disabled>
							<label class="form-check-label" for="<?= $materi['kelas']; ?>">
								<?= $materi['kelas']; ?>
							</label>
						</div>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-2">
						<label for="sesi">Sesi</label>
					</div>
					<div class="col-sm-4">
						<select class="form-control" id="sesi" name="sesi_id">
							<?php foreach($sesi as $ss): ?>
							<option value="<?= $ss['sesi_id'] ?>" <?= $ss['sesi_id'] == $materi['sesi_id'] ? 'selected' : '' ?>><?= $ss['sesi'] ?></option>
							<?php endforeach; ?>
						</select>
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