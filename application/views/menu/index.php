<div class="container-fluid">
	<div class="row">
		<div class="col-lg-6">
			<div class="card shadow">
				<div class="card-body">
				<a href="<?= base_url('menu/tambahmenu') ?>" class="btn btn-primary mb-3"><i class="fas fa-fw fa-plus-square"></i> Tambah Menu</a>
				<?= $this->session->flashdata('message'); ?>
				<div class="table-responsive">
					<table class="table">
						<thead width="100%">
							<tr>
								<th scope="col">No</th>
								<th scope="col">Menu</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=0;foreach($menu as $m): ?>
							<tr>
								<th scope="row"><?= ++$i ?></th>
								<td><?= $m['menu'] ?></td>
								<td>
									<a href="<?= base_url('menu/ubahmenu/') . $m['menu_id'] ?>" class="btn btn-success"><i class="fas fa-fw fa-edit"></i></a>
									<a href="<?= base_url('menu/hapusmenu/') . $m['menu_id'] ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')"><i class="fas fa-fw fa-trash-alt"></i></a>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		</div>
	</div>
</div>