<div class="container-fluid">
	<?= form_open_multipart('profil/edit');?>
	<div class="row">
		<div class="col-lg-7">
			<div class="card card-body">
				<div class="row form-group">
					<div class="col-lg-3">
						<label for="nama" class="col-form-label">Nama</label>
					</div>
					<div class="col-lg-9">
						<input type="text" class="form-control" name="nama" id="nama" value="<?= $user['nama'] ?>" autocomplete="off">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-lg-3">
						<label for="ni" class="col-form-label">Nomor Induk</label>
					</div>
					<div class="col-lg-9">
						<input type="number" class="form-control" name="ni" id="ni" value="<?= $user['ni'] ?>" autocomplete="off" readonly>
					</div>
				</div>
				<div class="row form-group justify-content-end align-items-center">
					<div class="col-lg-3">
						<img src="<?= base_url('assets/img/profile/') . $user['foto'] ?>" alt="..." width="100%">
					</div>
					<div class="col-lg-6">
						<div class="custom-file">
							<input type="file" class="custom-file-input" id="customFile" name="foto">
							<label class="custom-file-label" for="customFile">Choose file</label>
						</div>
					</div>
				</div>
				<div id="ini"></div>
				<div class="row form-group justify-content-end">
					<div class="col-lg-9">
						<button type="submit" class="btn btn-primary" name="ubah">Submit</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	</form>
</div>