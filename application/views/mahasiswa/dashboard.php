<div class="loader justify-content-center align-items-center">
	<div class="loading mt-5"></div>
	<h2 class="text-center d-block">Loading...</h2>
</div>
<div class="container">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6 p-md-5 d-flex">
					<h1 class="align-self-center">Selamat Datang, <?= $user['nama'] ?></h1>
				</div>
				<div class="col-md-6">
					<img src="<?= base_url('assets/img/mahasiswa-img.png') ?>" alt="" width="100%">
				</div>
			</div>
		</div>
	</div>
</div>
<style>
		.loader {
			position: absolute;
			top: 0;
			bottom: 0;
			right: 0;
			left: 0;
			background-color: #fff;
			z-index: 3;
		}
		.loading {
			border: 16px solid #f3f3f3; /* Light grey */
			border-top: 16px solid #3498db; /* Blue */
			border-radius: 50%;
			width: 120px;
			height: 120px;
			margin: auto;
			animation: spin 2s linear infinite;
		}
		@keyframes spin {
		  0% { transform: rotate(0deg); }
		  100% { transform: rotate(360deg); }
		}
	</style>
