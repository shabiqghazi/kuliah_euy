<div class="container-fluid">
	<div class="row">
		<div class="col-lg-6">
			<div class="card card-body">
				<?= form_open_multipart('dosen/tambahmateri');?>
				<?= form_error('text','<small class="text-danger pl-3">','</small>'); ?>
				<?= $this->session->flashdata('message'); ?>
				<div class="form-group row">
					<div class="col-lg-2 col-form-label">
						<label for="title">Title</label>
					</div>
					<div class="col-lg-10">
						<input type="text" name="title" class="form-control" id="title" required>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-lg-2 col-form-label">
						<label for="teks">Teks</label>
					</div>
					<div class="col-lg-10">
						<textarea class="form-control" rows="5" id="teks" name="teks"></textarea>
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
						<?php foreach($kelas_dosen as $kls_dosen): ?>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="<?= $kls_dosen['kelas_id']; ?>" id="kelas_id" name="kelas_id[]">
							<label class="form-check-label" for="<?= $kls_dosen['kelas']; ?>">
								<?= $kls_dosen['kelas']; ?>
							</label>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-2">
						<label for="sesi">Sesi</label>
					</div>
					<div class="col-sm-4">
						<select class="form-control" id="sesi" name="sesi_id">
							<?php foreach($sesi as $ss): ?>
							<option value="<?= $ss['sesi_id'] ?>"><?= $ss['sesi'] ?></option>
							<?php endforeach; ?>
						</select>
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
</div>