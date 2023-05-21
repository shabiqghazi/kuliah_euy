<div class="container-fluid">
	<div class="row">
		<div class="col-lg-6">
			<div class="card card-body">
				<form action="" method="post">
					<div class="row form-group">
						<div class="col-lg-3">
							<label for="menu" class="col-form-label">Menu</label>
						</div>
						<div class="col-lg-9">
							<?= form_error('menu','<div class="alert alert-danger">', '</div>'); ?>
							<input type="text" class="form-control" id="menu" name="menu" value="<?= set_value('menu') ?>">
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