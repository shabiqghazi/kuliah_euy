<!--
Nama						: Shabiq Ghazi Arkaan
NIM							: 1207050118
Kelas						: IF-F
Awal Pengerjaan	: Minggu 21 Maret 2021
-->
<div class="container p-2 pt-5 p-md-5">
	<div class="row">
		<div class="col-md-6">
			<div class="card border-0">
				<div class="card-body">
					<h1 class="h4 mb-4 text-dark">Halaman Login</h1>
					<?= $this->session->flashdata('message') ?>
					<form action="<?= base_url('auth/login'); ?>" method="post">
						<div class="form-group">
							<label for="ni" class="text-dark">Nomor Induk</label>
							<input type="text" name="ni" class="form-control border-secondary" id="ni" autocomplete="off" value="<?= set_value('ni'); ?>">
							<?= form_error('ni','<small class="text-danger pl-3">','</small>'); ?>
						</div>
						<div class="form-group">
							<label for="password" class="text-dark">Password</label>
							<input type="password" name="password" class="form-control border-secondary" id="password" autocomplete="off" value="<?= set_value('password'); ?>">
							<?= form_error('password','<small class="text-danger pl-3">','</small>'); ?>
						</div>
						<button type="submit" class="btn btn-primary">Login</button>
					</form>
					<p class="mt-2 text-dark">belum punya akun? <a href="<?= base_url('auth/registration') ?>" class="badge badge-primary">daftar</a></p>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<img src="<?= base_url('assets/img/login-img.png') ?>" alt="" width="100%">
		</div>
	</div>
</div>