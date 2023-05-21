<div class="container-fluid">
	<div class="col-md-6">
		<div class="card">
			<div class="card-body">
				
		<?= $this->session->flashdata('message'); ?>
		<?= validation_errors() ?>
		<form action="" method="post">
			<div class="form-group row">
				<div class="col-sm-2 col-form-label">
					<label for="kelas">Kelas</label>
				</div>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="kelas" name="kelas">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-2 col-form-label">
					<label for="kode">Kode</label>
				</div>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="kode" name="kode">
				</div>
			</div>
			<div class="form-group row">	
				<div class="col-sm-2 col-form-label">
					<label for="semester">Semester</label>
				</div>
				<div class="col-sm-4">
					<select class="form-control" id="semester" name="semester">
						<option>Semester</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
					</select>
				</div>
			</div>
			<div class="form-group row">	
				<div class="col-sm-2 col-form-label">
					<label for="dosen">Dosen</label>
				</div>
				<div class="col-sm-6">
					<select class="form-control" id="dosen" name="dosen">
						<option>Dosen</option>
						<?php foreach($dosen as $dsn): ?>
						<option value="<?= $dsn['user_id'] ?>"><?= $dsn['ni'] .' - '. $dsn['nama'] ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-2"></div>
				<div class="col-sm-10">
					<button class="btn btn-primary" type="submit">Tambah</button>
				</div>
			</div>
		</form>
			</div>
		</div>
	</div>
</div>