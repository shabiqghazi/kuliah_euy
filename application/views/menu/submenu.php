<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<a href="<?= base_url('menu/tambahsubmenu') ?>" class="btn btn-primary mb-3"><i class="fas fa-fw fa-plus-square"></i> Tambah submenu</a>
					<?= $this->session->flashdata('message'); ?>
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th scope="col">No</th>
									<th scope="col">Menu</th>
									<th scope="col">Title</th>
									<th scope="col">URL</th>
									<th scope="col">Icon</th>
									<th scope="col">Is Active</th>
									<th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i=0;foreach($submenu as $sm): ?>
								<tr>
									<th scope="row"><?= ++$i ?></th>
									<td><?= $sm['menu'] ?></td>
									<td><?= $sm['title'] ?></td>
									<td><?= $sm['url'] ?></td>
									<td><i class="<?= $sm['icon'] ?>"></i></td>
									<td><?= $sm['is_active'] == 1 ? 'Y' : 'N' ?></td>
									<td>
										<a href="<?= base_url('menu/ubahsubmenu/') . $sm['submenu_id'] ?>" class="btn btn-success"><i class="fas fa-fw fa-edit"></i></a>
										<a href="<?= base_url('menu/hapussubmenu/') . $sm['submenu_id'] ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')"><i class="fas fa-fw fa-trash-alt"></i></a>
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