<div class="container">
	<div class="row">
		<div class="col">
			<div class="card shadow">
				<div class="card-body">	
					<div class="row">
						<div class="col-md-4">
							<form action="<?= base_url('admin/krsmhs'); ?>" method="post">
								<div class="input-group mb-3">
									<input type="text" class="form-control" placeholder="Search" name="keyword" autocomplete="off" autofocus>
									<div class="input-group-append">
										<input class="btn btn-primary" type="submit" name="submit" value="Search">
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="table-responsive">
						<?= $keyword ? '<p>Menampilkan hasil untuk ' . $keyword . '</p>' : '' ?>
						<?= $this->pagination->create_links() ?>
						<table class="table">
							<thead>
								<tr>
									<th scope="col">No</th>
									<th scope="col">NIM</th>
									<th scope="col">Nama</th>
									<th scope="col">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($mhs as $m): ?>
								<tr>
									<th scope="row"><?= ++$start ?></th>
									<td><?= $m['ni'] ?></td>
									<td><?= $m['nama'] ?></td>
									<td><a href="<?= base_url('admin/mhskrs/') . $m['user_id'] ?>">lihat KRS</a></td>
								</tr>
								<?php endforeach ?>
							</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>