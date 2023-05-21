<div class="container-fluid">
	<div class="row">
		<div class="col-lg-6">
			<div class="card card-body">
				<form action="" method="post">
					<div class="row form-group">
						<div class="col-lg-3">
							<label for="" class="col-form-label">Menu</label>
						</div>
						<div class="col-lg-9">
							<?= form_error('menu_id','<div class="alert alert-danger">', '</div>'); ?>
							<select class="custom-select" name="menu_id">
								<option value=''>Menu</option>
								<?php foreach($menu as $m): ?>
								<option value="<?= $m['menu_id'] ?>" <?= set_select('menu_id', $m['menu_id']) ?>><?= $m['menu'] ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-lg-3">
							<label for="title" class="col-form-label">Title</label>
						</div>
						<div class="col-lg-9">
							<?= form_error('title','<div class="alert alert-danger">', '</div>'); ?>
							<input type="text" class="form-control" id="title" name="title" value="<?= set_value('title') ?>">
						</div>
					</div>
					<div class="row form-group">
						<div class="col-lg-3">
							<label for="url" class="col-form-label">URL</label>
						</div>
						<div class="col-lg-9">
							<?= form_error('url','<div class="alert alert-danger">', '</div>'); ?>
							<input type="text" class="form-control" id="url" name="url" value="<?= set_value('url') ?>">
						</div>
					</div>
					<div class="row form-group">
						<div class="col-lg-3">
							<label for="icon" class="col-form-label">Icon</label>
						</div>
						<div class="col-lg-9">
							<?= form_error('icon','<div class="alert alert-danger">', '</div>'); ?>
							<input type="text" class="form-control" id="icon" name="icon" value="<?= set_value('icon') ?>">
						</div>
					</div>
					<div class="row form-group justify-content-end">
						<div class="col-lg-9">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" name="is_active" id="is_active" value="1" <?= set_checkbox('is_active', 1) ?>>
								<label class="custom-control-label" for="is_active">Active?</label>
							</div>
						</div>
					</div>
					<div class="row form-group justify-content-end">
						<div class="col-lg-9">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>