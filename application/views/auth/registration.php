<div class="container p-2 pt-5 p-md-5">
	<div class="row">
		<div class="col-md-6 order-md-2">
			<div class="card border-0">
				<div class="card-body">
					<h1 class="h4 text-dark mb-4">Halaman Registrasi</h1>
					<form action="<?= base_url('auth/registration') ?>" method="post">
						<div class="form-group mb-2">
							<label for="nama" class="text-dark">Nama</label>
							<input type="text" name="nama" class="form-control border-secondary" id="nama" autocomplete="off" value="<?= set_value('nama'); ?>">
							<?= form_error('nama','<small class="text-danger pl-3">','</small>'); ?>
						</div>
						<div class="form-group mb-1">
							<label for="ni" class="text-dark">Nomor Induk</label>
							<input type="text" name="ni" class="form-control border-secondary" id="ni" autocomplete="off" value="<?= set_value('ni'); ?>">
							<?= form_error('ni','<small class="text-danger pl-3">','</small>'); ?>
						</div>
						<div class="form-group mb-1">
							<label for="password" class="text-dark">Password</label>
							<input type="password" name="password" class="form-control border-secondary" id="password" autocomplete="off" value="<?= set_value('password'); ?>">
							<?= form_error('password','<small class="text-danger pl-3">','</small>'); ?>
						</div>
						<div class="form-group mb-1">
							<label for="" class="mb-1 text-dark">Role</label>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="role_id" id="dosen" value="1" checked>
								<label class="form-check-label text-dark" for="dosen">
									Dosen
								</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="role_id" id="mahasiswa" value="2">
								<label class="form-check-label text-dark" for="mahasiswa">
									Mahasiswa
								</label>
							</div>
						</div>
						<button type="submit" class="btn btn-primary mt-2">Registrasi</button>
					</form>
					<p class="mt-2 text-dark">sudah punya akun? <a href="<?= base_url('auth/login') ?>" class="badge badge-primary">login</a></p>
				</div>
			</div>
		</div>
		<div class="col-md-6 order-md-1 d-flex align-items-center">
			<img src="<?= base_url('assets/img/register-img.png') ?>" alt="" width="100%">
		</div>	
	</div>
</div>